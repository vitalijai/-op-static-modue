<?php
/**
 * Каталог-контроллер: хелпер для получения статического контента в шаблонах.
 *
 * Использование в контроллере страницы:
 *   $static = $this->load->controller('extension/module/static_content');
 *   $data['faq'] = $static->section('home', 'faq');
 *   $data['footer_contacts'] = $static->section('footer', 'contacts');
 *
 * Или напрямую через модель:
 *   $this->load->model('extension/module/static_content');
 *   $data['static_home'] = $this->model_extension_module_static_content->getPageData('home');
 */
class ControllerExtensionModuleStaticContent extends Controller {

    private $model;

    public function __construct($registry) {
        parent::__construct($registry);
        $this->load->model('extension/module/static_content');
        $this->model = $this->model_extension_module_static_content;
    }

    /**
     * Получить данные всей страницы.
     * @param string $page  'header' | 'home' | 'footer'
     * @return array
     */
    public function page($page) {
        return $this->model->getPageData($page);
    }

    /**
     * Получить данные секции.
     * @param string $page
     * @param string $section
     * @return array
     */
    public function section($page, $section) {
        return $this->model->getSection($page, $section);
    }

    /**
     * Получить одно значение.
     * @param string $page
     * @param string $section
     * @param string $key
     * @return mixed|null
     */
    public function get($page, $section, $key) {
        return $this->model->getValue($page, $section, $key);
    }

    /**
     * Метод index — можно использовать как module для layout-позиций.
     * Не рендерит ничего, просто отдаёт данные.
     */
    public function index($setting = []) {
        return '';
    }
}
