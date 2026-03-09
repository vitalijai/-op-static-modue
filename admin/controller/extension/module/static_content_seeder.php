<?php
/**
 * Сидер статического контента.
 * Читает JSON файлы из admin/seed/ и заполняет oc_static_content.
 *
 * Формат JSON: { section: { key: { language_id: { type, value } } } }
 * Файлы: admin/seed/{page}.json
 *
 * Вызов: Admin → extension/module/static_content_seeder
 */
class ControllerExtensionModuleStaticContentSeeder extends Controller {

    /**
     * Страницы для сидинга (= имена JSON файлов без расширения).
     */
    private $pages = [
        'header', 'menu', 'mobile', 'common', 'blog',
        'customers', 'partners', 'home', 'footer', 'add',
    ];

    /**
     * Сидинг из JSON → БД.
     * TRUNCATE + INSERT.
     */
    public function index() {
        $this->load->model('extension/module/static_content');
        $m = $this->model_extension_module_static_content;

        $this->db->query("TRUNCATE TABLE `" . DB_PREFIX . "static_content`");

        $seedDir = DIR_APPLICATION . 'seed/';
        $stats   = ['pages' => 0, 'sections' => 0, 'rows' => 0];

        foreach ($this->pages as $page) {
            $file = $seedDir . $page . '.json';

            if (!is_file($file)) {
                continue;
            }

            $json = file_get_contents($file);
            $sections = json_decode($json, true);

            if (!$sections) {
                continue;
            }

            $stats['pages']++;

            foreach ($sections as $sectionKey => $fields) {
                $stats['sections']++;

                foreach ($fields as $key => $languages) {
                    foreach ($languages as $langId => $entry) {
                        $type  = isset($entry['type'])  ? $entry['type']  : 'text';
                        $value = isset($entry['value']) ? $entry['value'] : '';
                        $m->setValue($page, $sectionKey, $key, $type, $value, (int)$langId);
                        $stats['rows']++;
                    }
                }
            }
        }

        $this->session->data['success'] = sprintf(
            'Static content seeded from JSON! %d pages, %d sections, %d rows.',
            $stats['pages'], $stats['sections'], $stats['rows']
        );

        $this->response->redirect($this->url->link(
            'extension/module/static_content',
            'user_token=' . $this->session->data['user_token'],
            true
        ));
    }

    /**
     * Экспорт БД → JSON файлы.
     * Вызов: Admin → extension/module/static_content_seeder/export
     */
    public function export() {
        if (!$this->user->hasPermission('modify', 'extension/module/static_content')) {
            $this->session->data['error_warning'] = 'Permission denied';
            $this->response->redirect($this->url->link(
                'extension/module/static_content',
                'user_token=' . $this->session->data['user_token'],
                true
            ));
            return;
        }

        $this->load->model('extension/module/static_content');

        $seedDir = DIR_APPLICATION . 'seed/';

        if (!is_dir($seedDir)) {
            mkdir($seedDir, 0755, true);
        }

        $stats = ['pages' => 0, 'sections' => 0];

        foreach ($this->pages as $page) {
            $pageData = $this->model_extension_module_static_content->getPageData($page);

            if (empty($pageData)) {
                continue;
            }

            // Конвертируем формат getPageData() → формат JSON сида
            $output = [];
            foreach ($pageData as $section => $fields) {
                $stats['sections']++;
                foreach ($fields as $key => $languages) {
                    foreach ($languages as $langId => $row) {
                        $output[$section][$key][$langId] = [
                            'type'  => $row['type'],
                            'value' => $row['value'],
                        ];
                    }
                }
            }

            $file = $seedDir . $page . '.json';
            file_put_contents(
                $file,
                json_encode($output, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . "\n"
            );
            $stats['pages']++;
        }

        $this->session->data['success'] = sprintf(
            'Static content exported to JSON! %d pages, %d sections.',
            $stats['pages'], $stats['sections']
        );

        $this->response->redirect($this->url->link(
            'extension/module/static_content',
            'user_token=' . $this->session->data['user_token'],
            true
        ));
    }
}
