<?php
/**
 * Контроллер модуля статического контента.
 * Админка: страница с табами (header / home / footer), аккордеон секций, формы полей.
 */
class ControllerExtensionModuleStaticContent extends Controller {
    private $error = [];

    /**
     * Главная страница модуля.
     */
    public function index() {
        $this->load->language('extension/module/static_content');
        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/module/static_content');
        $this->load->model('localisation/language');

        // Сохранение
        if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validate()) {
            $this->saveAll();
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/module/static_content', 'user_token=' . $this->session->data['user_token'], true));
        }

        // Данные для шаблона
        $data['heading_title']  = $this->language->get('heading_title');
        $data['text_success']   = $this->language->get('text_success');
        $data['button_save']    = $this->language->get('button_save');
        $data['button_cancel']  = $this->language->get('button_cancel');
        $data['tab_header']     = $this->language->get('tab_header');
        $data['tab_home']       = $this->language->get('tab_home');
        $data['tab_footer']     = $this->language->get('tab_footer');
        $data['tab_docs']       = $this->language->get('tab_docs');

        $data['breadcrumbs'] = [];
        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true),
        ];
        $data['breadcrumbs'][] = [
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/static_content', 'user_token=' . $this->session->data['user_token'], true),
        ];

        $data['action']   = $this->url->link('extension/module/static_content', 'user_token=' . $this->session->data['user_token'], true);
        $data['cancel']   = $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true);
        $data['seed_url'] = $this->url->link('extension/module/static_content_seeder', 'user_token=' . $this->session->data['user_token'], true);

        // Ошибки / успех
        $data['error_warning'] = isset($this->error['warning']) ? $this->error['warning'] : '';
        $data['success'] = isset($this->session->data['success']) ? $this->session->data['success'] : '';
        unset($this->session->data['success']);

        // Языки — приводим language_id к string для совпадения ключей в twig
        $rawLangs = $this->model_localisation_language->getLanguages();
        $data['languages'] = [];
        foreach ($rawLangs as $lang) {
            $lang['language_id'] = (string)$lang['language_id'];
            $data['languages'][] = $lang;
        }

        // Реестр секций
        $registry = $this->getSectionRegistry();
        $data['registry'] = $registry;

        // Текущие данные из БД
        $data['content'] = [];
        foreach (array_keys($registry) as $page) {
            $data['content'][$page] = $this->model_extension_module_static_content->getPageData($page);
        }

        // Активный таб
        $data['active_tab'] = isset($this->request->get['tab']) ? $this->request->get['tab'] : 'home';

        $data['user_token'] = $this->session->data['user_token'];

        // Placeholder image for OC file manager
        $this->load->model('tool/image');
        if (is_file(DIR_IMAGE . 'no_image.png')) {
            $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        } else {
            $data['placeholder'] = '';
        }

        // Базовый URL к папке image/ для прямого отображения
        $data['image_base'] = defined('HTTPS_CATALOG') ? HTTPS_CATALOG . 'image/' : HTTP_CATALOG . 'image/';

        $data['header']      = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer']      = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/static_content', $data));
    }

    /**
     * Установка модуля.
     */
    public function install() {
        $this->load->model('extension/module/static_content');
        $this->model_extension_module_static_content->install();

        $this->load->model('setting/setting');
        $this->model_setting_setting->editSetting('module_static_content', ['module_static_content_status' => 1]);

        // Права доступа
        $this->load->model('user/user_group');
        $this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'extension/module/static_content');
        $this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'extension/module/static_content');
        $this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'extension/module/static_content_seeder');
        $this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'extension/module/static_content_seeder');

    }

    /**
     * Удаление модуля.
     */
    public function uninstall() {
        $this->load->model('extension/module/static_content');
        $this->model_extension_module_static_content->uninstall();
    }

    /**
     * Сохранение всех данных из POST.
     */
    private function saveAll() {
        $registry  = $this->getSectionRegistry();
        $languages = $this->model_localisation_language->getLanguages();

        foreach ($registry as $page => $sections) {
            foreach ($sections as $sectionKey => $sectionDef) {
                if (!isset($this->request->post[$page][$sectionKey])) {
                    continue;
                }
                $postData = $this->request->post[$page][$sectionKey];
                $this->model_extension_module_static_content->saveSection(
                    $page,
                    $sectionKey,
                    $sectionDef['fields'],
                    $postData,
                    $languages
                );
            }
        }
    }

    /**
     * Валидация прав.
     */
    private function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/static_content')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }

    /**
     * Реестр секций: определяет структуру формы.
     * Чтобы добавить новую секцию — просто добавить элемент в массив.
     *
     * type: text | textarea | wysiwyg | json | image
     * schema (для json): repeater
     * columns (для repeater): массив имён полей
     * translatable: true (по умолчанию) | false
     * col_types: типы полей в repeater (text по умолчанию, textarea, wysiwyg)
     */
    private function getSectionRegistry() {
        return [
            // ===================== HEADER =====================
            'header' => [
                'logo' => [
                    'label'      => 'Logo',
                    'sort_order' => 0,
                    'fields'     => [
                        'image'    => ['type' => 'image', 'translatable' => false],
                        'title'    => ['type' => 'text', 'translatable' => false],
                        'subtitle' => ['type' => 'text'],
                    ],
                ],
                'phone' => [
                    'label'      => 'Phone Numbers',
                    'sort_order' => 0,
                    'fields'     => [
                        'office' => ['type' => 'text', 'translatable' => false],
                        'mobile' => ['type' => 'text', 'translatable' => false],
                    ],
                ],
            ],

            // ===================== MEGA MENU =====================
            'menu' => [
                'nav' => [
                    'label'      => 'Головна навігація',
                    'sort_order' => 0,
                    'icon'       => 'fa-bars',
                    'fields'     => [
                        'title' => ['type' => 'text'],
                        'items' => [
                            'type'    => 'json',
                            'schema'  => 'repeater',
                            'columns' => ['text', 'href'],
                        ],
                    ],
                ],
                'menu_real_estate' => [
                    'label'      => 'Нерухомість',
                    'sort_order' => 1,
                    'icon'       => 'fa-building',
                    'fields'     => [
                        'title' => ['type' => 'text'],
                        'items' => [
                            'type'    => 'json',
                            'schema'  => 'repeater',
                            'columns' => ['text', 'href'],
                        ],
                    ],
                ],
                'menu_about' => [
                    'label'      => 'Про нас',
                    'sort_order' => 2,
                    'icon'       => 'fa-users',
                    'fields'     => [
                        'title' => ['type' => 'text'],
                        'items' => [
                            'type'    => 'json',
                            'schema'  => 'repeater',
                            'columns' => ['text', 'href'],
                        ],
                    ],
                ],
                'menu_services' => [
                    'label'      => 'Наші послуги',
                    'sort_order' => 3,
                    'icon'       => 'fa-briefcase',
                    'fields'     => [
                        'title' => ['type' => 'text'],
                        'items' => [
                            'type'    => 'json',
                            'schema'  => 'repeater',
                            'columns' => ['text', 'href'],
                        ],
                    ],
                ],
                'menu_information' => [
                    'label'      => 'Інформація',
                    'sort_order' => 4,
                    'icon'       => 'fa-info-circle',
                    'fields'     => [
                        'title' => ['type' => 'text'],
                        'items' => [
                            'type'    => 'json',
                            'schema'  => 'repeater',
                            'columns' => ['text', 'href'],
                        ],
                    ],
                ],
                'menu_socials' => [
                    'label'      => 'Соціальні мережі',
                    'sort_order' => 5,
                    'icon'       => 'fa-share-alt',
                    'fields'     => [
                        'items' => [
                            'type'         => 'json',
                            'schema'       => 'repeater',
                            'columns'      => ['platform', 'icon', 'url'],
                            'col_types'    => ['icon' => 'image'],
                            'translatable' => false,
                        ],
                    ],
                ],
            ],

            // ===================== HOME =====================
            'home' => [
                'first_screen' => [
                    'label'      => 'First Screen (Hero)',
                    'sort_order' => 0,
                    'fields'     => [
                        'title_highlight' => ['type' => 'text'],
                        'title'           => ['type' => 'text'],
                        'text'            => ['type' => 'textarea'],
                        'bg_image'        => ['type' => 'image', 'translatable' => false],
                    ],
                ],
                'key_features' => [
                    'label'      => 'Key Features',
                    'sort_order' => 1,
                    'fields'     => [
                        'title'           => ['type' => 'text'],
                        'title_highlight' => ['type' => 'text'],
                        'title_suffix'    => ['type' => 'text'],
                        'items' => [
                            'type'    => 'json',
                            'schema'  => 'repeater',
                            'columns' => ['icon', 'description'],
                            'col_types' => ['icon' => 'image', 'description' => 'text'],
                        ],
                    ],
                ],
                'ads' => [
                    'label'      => 'Ad Banner',
                    'sort_order' => 2,
                    'fields'     => [
                        'title'      => ['type' => 'text'],
                        'button_text' => ['type' => 'text'],
                        'button_url' => ['type' => 'text', 'translatable' => false],
                    ],
                ],
                'choose_us' => [
                    'label'      => 'Why Choose Us',
                    'sort_order' => 3,
                    'fields'     => [
                        'title' => ['type' => 'text'],
                        'items' => [
                            'type'    => 'json',
                            'schema'  => 'repeater',
                            'columns' => ['icon', 'title', 'description'],
                            'col_types' => ['icon' => 'image', 'title' => 'text', 'description' => 'textarea'],
                        ],
                    ],
                ],
                'achievements' => [
                    'label'      => 'Company Achievements',
                    'sort_order' => 4,
                    'fields'     => [
                        'title'           => ['type' => 'text'],
                        'title_highlight' => ['type' => 'text'],
                        'desc'            => ['type' => 'textarea'],
                        'image'           => ['type' => 'image', 'translatable' => false],
                        'items' => [
                            'type'    => 'json',
                            'schema'  => 'repeater',
                            'columns' => ['value', 'is_percent', 'label', 'description'],
                            'col_types' => ['description' => 'textarea'],
                        ],
                    ],
                ],
                'agency' => [
                    'label'      => 'Agency Info',
                    'sort_order' => 5,
                    'fields'     => [
                        'title' => ['type' => 'text'],
                        'image' => ['type' => 'image', 'translatable' => false],
                        'text'  => ['type' => 'wysiwyg'],
                    ],
                ],
                'partners' => [
                    'label'      => 'Partners',
                    'sort_order' => 6,
                    'fields'     => [
                        'title' => ['type' => 'text'],
                        'logos' => [
                            'type'         => 'json',
                            'schema'       => 'repeater',
                            'columns'      => ['image', 'name'],
                            'col_types'    => ['image' => 'image'],
                            'translatable' => false,
                        ],
                        'items' => [
                            'type'    => 'json',
                            'schema'  => 'repeater',
                            'columns' => ['image', 'name', 'href'],
                            'col_types' => ['image' => 'image'],
                        ],
                    ],
                ],
                'customers' => [
                    'label'      => 'Valued Customers',
                    'sort_order' => 7,
                    'fields'     => [
                        'title' => ['type' => 'text'],
                        'desc'  => ['type' => 'textarea'],
                        'items' => [
                            'type'         => 'json',
                            'schema'       => 'repeater',
                            'columns'      => ['image', 'name', 'href'],
                            'col_types'    => ['image' => 'image'],
                            'translatable' => false,
                        ],
                    ],
                ],
                'reviews' => [
                    'label'      => 'Reviews (header only)',
                    'sort_order' => 8,
                    'fields'     => [
                        'title'       => ['type' => 'text'],
                        'desc'        => ['type' => 'textarea'],
                        'button_text' => ['type' => 'text'],
                    ],
                ],
                'contact_fab' => [
                    'label'      => 'Contact FAB (floating button)',
                    'sort_order' => 9,
                    'fields'     => [
                        'callback_title' => ['type' => 'text'],
                        'callback_desc'  => ['type' => 'text'],
                        'write_title'    => ['type' => 'text'],
                        'write_desc'     => ['type' => 'text'],
                    ],
                ],
                'faq' => [
                    'label'      => 'FAQ / Questions',
                    'sort_order' => 10,
                    'fields'     => [
                        'title'           => ['type' => 'text'],
                        'title_highlight' => ['type' => 'text'],
                        'view_all_text'   => ['type' => 'text'],
                        'view_all_href'   => ['type' => 'text', 'translatable' => false],
                        'desc'            => ['type' => 'textarea'],
                        'btn_text'        => ['type' => 'text'],
                        'items' => [
                            'type'    => 'json',
                            'schema'  => 'repeater',
                            'columns' => ['question', 'answer'],
                            'col_types' => ['question' => 'text', 'answer' => 'textarea'],
                        ],
                    ],
                ],
            ],

            // ===================== FOOTER =====================
            'footer' => [
                'logo' => [
                    'label'      => 'Footer Logo',
                    'sort_order' => 0,
                    'fields'     => [
                        'image' => ['type' => 'image', 'translatable' => false],
                    ],
                ],
                'contacts' => [
                    'label'      => 'Contacts',
                    'sort_order' => 1,
                    'fields'     => [
                        'address_street'     => ['type' => 'text'],
                        'address_city'       => ['type' => 'text'],
                        'phone_office_label' => ['type' => 'text'],
                        'phone_office'       => ['type' => 'text', 'translatable' => false],
                        'phone_mobile_label' => ['type' => 'text'],
                        'phone_mobile'       => ['type' => 'text', 'translatable' => false],
                    ],
                ],
                'about_links' => [
                    'label'      => 'About Links',
                    'sort_order' => 2,
                    'fields'     => [
                        'items' => [
                            'type'    => 'json',
                            'schema'  => 'repeater',
                            'columns' => ['text', 'href'],
                        ],
                    ],
                ],
                'social' => [
                    'label'      => 'Social Links',
                    'sort_order' => 3,
                    'fields'     => [
                        'items' => [
                            'type'         => 'json',
                            'schema'       => 'repeater',
                            'columns'      => ['platform', 'url'],
                            'translatable' => false,
                        ],
                    ],
                ],
                'nav' => [
                    'label'      => 'Footer Navigation',
                    'sort_order' => 4,
                    'fields'     => [
                        'title' => ['type' => 'text'],
                        'items' => [
                            'type'    => 'json',
                            'schema'  => 'repeater',
                            'columns' => ['text', 'href', 'column'],
                        ],
                    ],
                ],
                'listing_left' => [
                    'label'      => 'Listing Form (Left)',
                    'sort_order' => 5,
                    'fields'     => [
                        'title' => ['type' => 'text'],
                        'items' => [
                            'type'    => 'json',
                            'schema'  => 'repeater',
                            'columns' => ['text', 'href', 'column'],
                        ],
                    ],
                ],
                'listing_right' => [
                    'label'      => 'Listing Form (Right)',
                    'sort_order' => 6,
                    'fields'     => [
                        'title' => ['type' => 'text'],
                        'items' => [
                            'type'    => 'json',
                            'schema'  => 'repeater',
                            'columns' => ['text', 'href', 'column'],
                        ],
                    ],
                ],
                'partners' => [
                    'label'      => 'Footer Partners (Logos)',
                    'sort_order' => 7,
                    'fields'     => [
                        'items' => [
                            'type'         => 'json',
                            'schema'       => 'repeater',
                            'columns'      => ['image', 'alt', 'href'],
                            'col_types'    => ['image' => 'image'],
                            'translatable' => false,
                        ],
                    ],
                ],
                'bottom' => [
                    'label'      => 'Bottom Bar',
                    'sort_order' => 8,
                    'fields'     => [
                        'links' => [
                            'type'    => 'json',
                            'schema'  => 'repeater',
                            'columns' => ['text', 'href'],
                        ],
                        'copyright' => ['type' => 'text'],
                    ],
                ],
            ],
        ];
    }
}
