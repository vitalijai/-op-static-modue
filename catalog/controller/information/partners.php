<?php
/**
 * Контролер страницы "Наши партнеры".
 * Статический контент из модуля static_content + пагинация OC3.
 */
class ControllerInformationPartners extends Controller {

    public function index() {
        $this->load->language('information/partners');
        $this->load->model('extension/module/static_content');
        $m = $this->model_extension_module_static_content;

        $data['sp']   = $m->getPageData('partners');
        $data['scom'] = $m->getPageData('common');

        // Лейблы из языкового файла
        $data['text_activity']  = $this->language->get('text_activity');
        $data['text_category']  = $this->language->get('text_category');
        $data['text_review']    = $this->language->get('text_review');
        $data['text_since']     = $this->language->get('text_since');
        $data['text_breadcrumb_home']     = $this->language->get('text_breadcrumb_home');
        $data['text_breadcrumb_about']    = $this->language->get('text_breadcrumb_about');
        $data['text_breadcrumb_partners'] = $this->language->get('text_breadcrumb_partners');

        // Все партнеры из repeater
        $all_partners = [];
        if (!empty($data['sp']['items']['list']) && is_array($data['sp']['items']['list'])) {
            $all_partners = $data['sp']['items']['list'];
        }

        // Пагинация
        $limit = 8;
        $page  = isset($this->request->get['page']) ? max(1, (int)$this->request->get['page']) : 1;
        $total = count($all_partners);

        $start = ($page - 1) * $limit;
        $data['partners'] = array_slice($all_partners, $start, $limit);

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
        $url_base = $this->url->link('information/partners');

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
            $this->load->view('information/partners', $data)
        );
    }
}
