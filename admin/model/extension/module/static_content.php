<?php
/**
 * Модель управления статическим контентом.
 * Хранит данные в oc_static_content (page → section → key → language_id).
 */
class ModelExtensionModuleStaticContent extends Model {

    /**
     * Создание таблицы при установке модуля.
     */
    public function install() {
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "static_content` (
                `content_id`  INT(11)      NOT NULL AUTO_INCREMENT,
                `page`        VARCHAR(32)  NOT NULL,
                `section`     VARCHAR(64)  NOT NULL,
                `key`         VARCHAR(64)  NOT NULL DEFAULT '',
                `type`        VARCHAR(16)  NOT NULL DEFAULT 'text',
                `value`       MEDIUMTEXT   NOT NULL,
                `language_id` INT(11)      NOT NULL DEFAULT 0,
                `sort_order`  INT(11)      NOT NULL DEFAULT 0,
                PRIMARY KEY (`content_id`),
                UNIQUE KEY `content_unique` (`page`, `section`, `key`, `language_id`),
                KEY `idx_page_lang` (`page`, `language_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
        ");
    }

    /**
     * Удаление таблицы при деинсталляции.
     */
    public function uninstall() {
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "static_content`");
    }

    /**
     * Получить все данные страницы (page) для всех языков.
     *
     * @param string $page
     * @return array [section][key][language_id] => row
     */
    public function getPageData($page) {
        $query = $this->db->query("
            SELECT * FROM `" . DB_PREFIX . "static_content`
            WHERE `page` = '" . $this->db->escape($page) . "'
            ORDER BY `section`, `sort_order`, `key`
        ");

        $result = [];
        foreach ($query->rows as $row) {
            $result[$row['section']][$row['key']][$row['language_id']] = $row;
        }
        return $result;
    }

    /**
     * Получить значение конкретного блока.
     *
     * @param string $page
     * @param string $section
     * @param string $key
     * @param int    $language_id
     * @return string|null
     */
    public function getValue($page, $section, $key, $language_id) {
        $query = $this->db->query("
            SELECT `value`, `type` FROM `" . DB_PREFIX . "static_content`
            WHERE `page`        = '" . $this->db->escape($page) . "'
              AND `section`     = '" . $this->db->escape($section) . "'
              AND `key`         = '" . $this->db->escape($key) . "'
              AND `language_id` = '" . (int)$language_id . "'
            LIMIT 1
        ");

        if ($query->num_rows) {
            return $query->row;
        }
        return null;
    }

    /**
     * Сохранить (upsert) одно значение.
     *
     * @param string $page
     * @param string $section
     * @param string $key
     * @param string $type
     * @param string $value
     * @param int    $language_id
     * @param int    $sort_order
     */
    public function setValue($page, $section, $key, $type, $value, $language_id, $sort_order = 0) {
        $this->db->query("
            INSERT INTO `" . DB_PREFIX . "static_content`
                (`page`, `section`, `key`, `type`, `value`, `language_id`, `sort_order`)
            VALUES (
                '" . $this->db->escape($page) . "',
                '" . $this->db->escape($section) . "',
                '" . $this->db->escape($key) . "',
                '" . $this->db->escape($type) . "',
                '" . $this->db->escape($value) . "',
                '" . (int)$language_id . "',
                '" . (int)$sort_order . "'
            )
            ON DUPLICATE KEY UPDATE
                `value`      = '" . $this->db->escape($value) . "',
                `type`       = '" . $this->db->escape($type) . "',
                `sort_order` = '" . (int)$sort_order . "'
        ");
    }

    /**
     * Массовое сохранение секции.
     *
     * @param string $page
     * @param string $section
     * @param array  $fields  [key => [type, translatable, value/values]]
     * @param array  $post    данные из формы
     * @param array  $languages
     */
    public function saveSection($page, $section, $fields, $post, $languages) {
        foreach ($fields as $key => $field) {
            $type = $field['type'];
            $translatable = isset($field['translatable']) ? $field['translatable'] : true;

            if (!$translatable || $type === 'image') {
                // Не зависит от языка
                $value = isset($post[$key]) ? $post[$key] : '';
                if ($type === 'json' && is_array($value)) {
                    $value = json_encode($value, JSON_UNESCAPED_UNICODE);
                }
                $this->setValue($page, $section, $key, $type, $value, 0, isset($field['sort_order']) ? $field['sort_order'] : 0);
            } else {
                // По языкам
                foreach ($languages as $language) {
                    $lang_id = $language['language_id'];
                    $value = isset($post[$key][$lang_id]) ? $post[$key][$lang_id] : '';
                    if ($type === 'json' && is_array($value)) {
                        $value = json_encode($value, JSON_UNESCAPED_UNICODE);
                    }
                    $this->setValue($page, $section, $key, $type, $value, $lang_id, isset($field['sort_order']) ? $field['sort_order'] : 0);
                }
            }
        }

        // Инвалидация кеша
        $this->cache->delete('static_content');
    }

    /**
     * Удалить секцию целиком.
     */
    public function deleteSection($page, $section) {
        $this->db->query("
            DELETE FROM `" . DB_PREFIX . "static_content`
            WHERE `page`    = '" . $this->db->escape($page) . "'
              AND `section` = '" . $this->db->escape($section) . "'
        ");
        $this->cache->delete('static_content');
    }
}
