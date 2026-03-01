<?php
/**
 * Контроллер страницы "Наши клиенты".
 * Подтягивает статический контент из модуля static_content + языковой файл для лейблов.
 */
class ControllerInformationCustomers extends Controller {

    public function index() {
        $this->load->language('information/customers');
        $this->load->model('extension/module/static_content');
        $m = $this->model_extension_module_static_content;

        $data['sc']   = $m->getPageData('customers');
        $data['scom'] = $m->getPageData('common');

        // Лейблы из языкового файла
        $data['text_activity'] = $this->language->get('text_activity');
        $data['text_category'] = $this->language->get('text_category');
        $data['text_review']   = $this->language->get('text_review');
        $data['text_objects']  = $this->language->get('text_objects');
        $data['text_breadcrumb_home']      = $this->language->get('text_breadcrumb_home');
        $data['text_breadcrumb_about']     = $this->language->get('text_breadcrumb_about');
        $data['text_breadcrumb_customers'] = $this->language->get('text_breadcrumb_customers');

        // Сортируем клиентов по active_objects desc для рейтинга (топ-10)
        $customers = [];
        if (!empty($data['sc']['items']['list']) && is_array($data['sc']['items']['list'])) {
            $customers = $data['sc']['items']['list'];
        }

        $rated = $customers;
        usort($rated, function($a, $b) {
            return (int)($b['active_objects'] ?? 0) - (int)($a['active_objects'] ?? 0);
        });
        $data['top_customers'] = array_slice($rated, 0, 10);

        // max для прогрессбара
        $data['max_objects'] = !empty($data['top_customers'])
            ? (int)$data['top_customers'][0]['active_objects']
            : 1;

        $this->document->setTitle($this->language->get('heading_title'));

        $this->response->setOutput(
            $this->load->view('information/customers', $data)
        );
    }
}
