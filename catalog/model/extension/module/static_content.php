<?php
/**
 * Каталог-модель: чтение статического контента с кешированием.
 */
class ModelExtensionModuleStaticContent extends Model {

    /**
     * Получить все данные страницы для текущего языка.
     * Возвращает массив: [section][key] => value (уже декодирован JSON).
     *
     * @param string $page
     * @param int|null $language_id  null = текущий язык магазина
     * @return array
     */
    public function getPageData($page, $language_id = null) {
        if ($language_id === null) {
            $language_id = (int)$this->config->get('config_language_id');
        }

        $cache_key = 'static_content.' . $page . '.' . $language_id;
        $data = $this->cache->get($cache_key);

        if ($data !== false && $data !== null) {
            return $data;
        }

        // Берём записи для нужного языка + language_id=0 (общие)
        $query = $this->db->query("
            SELECT `section`, `key`, `type`, `value`, `language_id`
            FROM `" . DB_PREFIX . "static_content`
            WHERE `page` = '" . $this->db->escape($page) . "'
              AND `language_id` IN (0, " . (int)$language_id . ")
            ORDER BY `section`, `sort_order`, `key`
        ");

        $data = [];
        foreach ($query->rows as $row) {
            $value = $row['value'];

            // Декодируем JSON
            if ($row['type'] === 'json') {
                $decoded = json_decode($value, true);
                $value = is_array($decoded) ? $decoded : [];
            }

            $section = $row['section'];
            $key     = $row['key'];

            // Языковые записи имеют приоритет над language_id=0
            if (!isset($data[$section][$key]) || $row['language_id'] > 0) {
                $data[$section][$key] = $value;
            }
        }

        $this->cache->set($cache_key, $data);

        return $data;
    }

    /**
     * Получить всю секцию как плоский массив key => value.
     *
     * @param string $page
     * @param string $section
     * @param int|null $language_id
     * @return array
     */
    public function getSection($page, $section, $language_id = null) {
        $pageData = $this->getPageData($page, $language_id);
        return isset($pageData[$section]) ? $pageData[$section] : [];
    }

    /**
     * Получить одно значение.
     *
     * @param string $page
     * @param string $section
     * @param string $key
     * @param int|null $language_id
     * @return mixed|null
     */
    public function getValue($page, $section, $key, $language_id = null) {
        $sectionData = $this->getSection($page, $section, $language_id);
        return isset($sectionData[$key]) ? $sectionData[$key] : null;
    }
}
