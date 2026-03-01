<?php
/**
 * Контроллер страницы "Наши клиенты".
 * Статический контент из модуля static_content + пагинация OC3.
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

        // Все клиенты из repeater
        $all_customers = [];
        if (!empty($data['sc']['items']['list']) && is_array($data['sc']['items']['list'])) {
            $all_customers = $data['sc']['items']['list'];
        }

        // Топ-10 по active_objects для рейтинга
        $rated = $all_customers;
        usort($rated, function($a, $b) {
            return (int)($b['active_objects'] ?? 0) - (int)($a['active_objects'] ?? 0);
        });
        $data['top_customers'] = array_slice($rated, 0, 10);
        $data['max_objects'] = !empty($data['top_customers'])
            ? (int)$data['top_customers'][0]['active_objects']
            : 1;

        // Пагинация
        $limit = 12;
        $page  = isset($this->request->get['page']) ? max(1, (int)$this->request->get['page']) : 1;
        $total = count($all_customers);

        $start = ($page - 1) * $limit;
        $data['customers'] = array_slice($all_customers, $start, $limit);

        // Индекс вставки рейтинг-блока (после 8-й карточки на первой странице)
        $data['rating_after'] = ($page === 1) ? 8 : -1;

        // Текст "Showing X - Y of Z"
        $end = min($start + $limit, $total);
        $data['text_results'] = sprintf(
            $this->language->get('text_results'),
            ($total > 0 ? $start + 1 : 0),
            $end,
            $total
        );

        // Пагинация — массив данных для шаблона
        $total_pages = ceil($total / $limit);
        $url_base = $this->url->link('information/customers');

        $pages = [];
        for ($i = 1; $i <= $total_pages; $i++) {
            $pages[] = [
                'number' => $i,
                'href'   => $i == 1 ? $url_base : $url_base . '&page=' . $i,
                'active' => ($i == $page),
            ];
        }

        $data['pagination'] = [
            'total_pages' => $total_pages,
            'current'     => $page,
            'first'       => $url_base,
            'last'        => $total_pages > 1 ? $url_base . '&page=' . $total_pages : $url_base,
            'prev'        => $page > 1 ? $url_base . '&page=' . ($page - 1) : '',
            'next'        => $page < $total_pages ? $url_base . '&page=' . ($page + 1) : '',
            'pages'       => $pages,
        ];

        $this->document->setTitle($this->language->get('heading_title'));

        $data['header'] = $this->load->controller('common/header');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput(
            $this->load->view('information/customers', $data)
        );
    }
}
