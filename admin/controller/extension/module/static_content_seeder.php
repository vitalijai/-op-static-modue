<?php
/**
 * Сидер статического контента.
 * Заполняет oc_static_content данными из шаблонов на 4 языка.
 *
 * Языки: 1=UK, 2=EN, 3=DE, 4=RU
 * SVG иконки хранятся в catalog/svg/ как файлы.
 *
 * Вызов: Admin → extension/module/static_content_seeder
 */
class ControllerExtensionModuleStaticContentSeeder extends Controller {

    public function index() {
        $this->load->model('extension/module/static_content');
        $m = $this->model_extension_module_static_content;

        $this->db->query("TRUNCATE TABLE `" . DB_PREFIX . "static_content`");

        $this->seedHeader($m);
        $this->seedMenu($m);
        $this->seedMobile($m);
        $this->seedCommon($m);
        $this->seedBlog($m);
        $this->seedCustomers($m);
        $this->seedPartners($m);
        $this->seedHome($m);
        $this->seedFooter($m);

        $this->session->data['success'] = 'Static content seeded! (4 languages, SVG as files)';
        $this->response->redirect($this->url->link('extension/module/static_content', 'user_token=' . $this->session->data['user_token'], true));
    }

    // ============================================================
    //  HEADER
    // ============================================================
    private function seedHeader($m) {
        $p = 'header';

        // --- logo ---
        $this->setGlobal($m, $p, 'logo', 'image', 'image', 'catalog/svg/logos/realtor-logo.svg');
        $this->setGlobal($m, $p, 'logo', 'title', 'text', 'REALTOR');
        $this->setT($m, $p, 'logo', 'subtitle', [
            1 => 'Агенція нерухомості',
            2 => 'Estate Agency',
            3 => 'Immobilienagentur',
            4 => 'Агентство недвижимости',
        ]);

        // --- logo ---
        $m->setValue($p, 'logo', 'image', 'image', 'catalog/svg/logo.svg', 0);

        // --- phone ---
        $m->setValue($p, 'phone', 'office', 'text', '+38 (0342) 501-303', 0);
        $m->setValue($p, 'phone', 'mobile', 'text', '+38 (067) 343-80-74', 0);

    }

    // ============================================================
    //  MEGA MENU
    // ============================================================
    private function seedMenu($m) {
        $p = 'menu';

        // --- nav (головна навігація) ---
        $this->setT($m, $p, 'nav', 'title', [
            1 => 'Головна', 2 => 'Main', 3 => 'Hauptmenü', 4 => 'Главная',
        ]);
        $this->setJson($m, $p, 'nav', 'items', 1, [
            ['text' => 'Головна',                    'href' => '/'],
            ['text' => 'Про нас',                     'href' => '#'],
            ['text' => 'Ексклюзиви',                  'href' => '#'],
            ['text' => 'Нерухомість у Карпатах',      'href' => '#'],
            ['text' => 'Блог',                        'href' => '#'],
            ['text' => 'Контакти',                    'href' => '#'],
        ]);
        $this->setJson($m, $p, 'nav', 'items', 2, [
            ['text' => 'Home',                        'href' => '/'],
            ['text' => 'About Us',                    'href' => '#'],
            ['text' => 'Exclusives',                  'href' => '#'],
            ['text' => 'Real Estate in the Carpathians','href' => '#'],
            ['text' => 'Blog',                        'href' => '#'],
            ['text' => 'Contact',                     'href' => '#'],
        ]);
        $this->setJson($m, $p, 'nav', 'items', 3, [
            ['text' => 'Startseite',                  'href' => '/'],
            ['text' => 'Über uns',                    'href' => '#'],
            ['text' => 'Exklusiv',                    'href' => '#'],
            ['text' => 'Immobilien in den Karpaten',  'href' => '#'],
            ['text' => 'Blog',                        'href' => '#'],
            ['text' => 'Kontakt',                     'href' => '#'],
        ]);
        $this->setJson($m, $p, 'nav', 'items', 4, [
            ['text' => 'Главная',                     'href' => '/'],
            ['text' => 'О нас',                       'href' => '#'],
            ['text' => 'Эксклюзивы',                  'href' => '#'],
            ['text' => 'Недвижимость в Карпатах',     'href' => '#'],
            ['text' => 'Блог',                        'href' => '#'],
            ['text' => 'Контакты',                    'href' => '#'],
        ]);

        // --- menu_real_estate ---
        $this->setT($m, $p, 'menu_real_estate', 'title', [
            1 => 'Нерухомість', 2 => 'Real Estate', 3 => 'Immobilien', 4 => 'Недвижимость',
        ]);
        $this->setJson($m, $p, 'menu_real_estate', 'items', 1, [
            ['text' => 'Квартири', 'href' => '#'], ['text' => 'Особняки', 'href' => '#'],
            ['text' => 'Офіси', 'href' => '#'], ['text' => 'Комерційна нерухомість', 'href' => '#'],
            ['text' => 'Гаражі', 'href' => '#'], ['text' => 'Земельні ділянки', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_real_estate', 'items', 2, [
            ['text' => 'Flats', 'href' => '#'], ['text' => 'Mansions', 'href' => '#'],
            ['text' => 'Offices', 'href' => '#'], ['text' => 'Commercial Real Estate', 'href' => '#'],
            ['text' => 'Garages', 'href' => '#'], ['text' => 'Land', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_real_estate', 'items', 3, [
            ['text' => 'Wohnungen', 'href' => '#'], ['text' => 'Villen', 'href' => '#'],
            ['text' => 'Büros', 'href' => '#'], ['text' => 'Gewerbeimmobilien', 'href' => '#'],
            ['text' => 'Garagen', 'href' => '#'], ['text' => 'Grundstücke', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_real_estate', 'items', 4, [
            ['text' => 'Квартиры', 'href' => '#'], ['text' => 'Особняки', 'href' => '#'],
            ['text' => 'Офисы', 'href' => '#'], ['text' => 'Коммерческая недвижимость', 'href' => '#'],
            ['text' => 'Гаражи', 'href' => '#'], ['text' => 'Земельные участки', 'href' => '#'],
        ]);

        // --- menu_about ---
        $this->setT($m, $p, 'menu_about', 'title', [
            1 => 'Про нас', 2 => 'About Us', 3 => 'Über uns', 4 => 'О нас',
        ]);
        $this->setJson($m, $p, 'menu_about', 'items', 1, [
            ['text' => 'Відгуки', 'href' => '#'], ['text' => 'Партнери', 'href' => '#'],
            ['text' => 'Наші клієнти', 'href' => '#'], ['text' => 'Наші ріелтори', 'href' => '#'],
            ['text' => 'Вакансії', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_about', 'items', 2, [
            ['text' => 'Reviews', 'href' => '#'], ['text' => 'Partners', 'href' => '#'],
            ['text' => 'Our Customers', 'href' => '#'], ['text' => 'Our Realtors', 'href' => '#'],
            ['text' => 'Vacancies Jobs', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_about', 'items', 3, [
            ['text' => 'Bewertungen', 'href' => '#'], ['text' => 'Partner', 'href' => '#'],
            ['text' => 'Unsere Kunden', 'href' => '#'], ['text' => 'Unsere Makler', 'href' => '#'],
            ['text' => 'Stellenangebote', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_about', 'items', 4, [
            ['text' => 'Отзывы', 'href' => '#'], ['text' => 'Партнёры', 'href' => '#'],
            ['text' => 'Наши клиенты', 'href' => '#'], ['text' => 'Наши риелторы', 'href' => '#'],
            ['text' => 'Вакансии', 'href' => '#'],
        ]);

        // --- menu_services ---
        $this->setT($m, $p, 'menu_services', 'title', [
            1 => 'Наші послуги', 2 => 'Our Services', 3 => 'Unsere Dienstleistungen', 4 => 'Наши услуги',
        ]);
        $this->setJson($m, $p, 'menu_services', 'items', 1, [
            ['text' => 'Продаж', 'href' => '#'], ['text' => 'Оренда', 'href' => '#'],
            ['text' => 'Подобова оренда', 'href' => '#'], ['text' => 'Інвестиційні проекти', 'href' => '#'],
            ['text' => 'Елітна нерухомість', 'href' => '#'], ['text' => 'Будівництво будинків', 'href' => '#'],
            ['text' => 'Бронювання готелів', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_services', 'items', 2, [
            ['text' => 'Selling', 'href' => '#'], ['text' => 'Rent', 'href' => '#'],
            ['text' => 'Daily Rent', 'href' => '#'], ['text' => 'Investment Projects', 'href' => '#'],
            ['text' => 'Luxury Real Estate', 'href' => '#'], ['text' => 'Construction of Houses', 'href' => '#'],
            ['text' => 'Hotel Booking', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_services', 'items', 3, [
            ['text' => 'Verkauf', 'href' => '#'], ['text' => 'Miete', 'href' => '#'],
            ['text' => 'Tagesmiete', 'href' => '#'], ['text' => 'Investitionsprojekte', 'href' => '#'],
            ['text' => 'Luxusimmobilien', 'href' => '#'], ['text' => 'Hausbau', 'href' => '#'],
            ['text' => 'Hotelbuchung', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_services', 'items', 4, [
            ['text' => 'Продажа', 'href' => '#'], ['text' => 'Аренда', 'href' => '#'],
            ['text' => 'Посуточная аренда', 'href' => '#'], ['text' => 'Инвестиционные проекты', 'href' => '#'],
            ['text' => 'Элитная недвижимость', 'href' => '#'], ['text' => 'Строительство домов', 'href' => '#'],
            ['text' => 'Бронирование отелей', 'href' => '#'],
        ]);

        // --- menu_information ---
        $this->setT($m, $p, 'menu_information', 'title', [
            1 => 'Інформація', 2 => 'Information', 3 => 'Information', 4 => 'Информация',
        ]);
        $this->setJson($m, $p, 'menu_information', 'items', 1, [
            ['text' => 'Довідник', 'href' => '#'], ['text' => 'Погода', 'href' => '#'],
            ['text' => 'FAQ', 'href' => '#'], ['text' => 'Допомога', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_information', 'items', 2, [
            ['text' => 'Directory', 'href' => '#'], ['text' => 'Weather', 'href' => '#'],
            ['text' => 'FAQ', 'href' => '#'], ['text' => 'Help', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_information', 'items', 3, [
            ['text' => 'Verzeichnis', 'href' => '#'], ['text' => 'Wetter', 'href' => '#'],
            ['text' => 'FAQ', 'href' => '#'], ['text' => 'Hilfe', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_information', 'items', 4, [
            ['text' => 'Справочник', 'href' => '#'], ['text' => 'Погода', 'href' => '#'],
            ['text' => 'FAQ', 'href' => '#'], ['text' => 'Помощь', 'href' => '#'],
        ]);

        // --- menu_socials ---
        $this->setJson($m, $p, 'menu_socials', 'items', 0, [
            ['platform' => 'youtube', 'icon' => 'catalog/svg/social/youtube.svg', 'url' => '#'],
            ['platform' => 'facebook', 'icon' => 'catalog/svg/social/facebook.svg', 'url' => '#'],
            ['platform' => 'instagram', 'icon' => 'catalog/svg/social/instagram.svg', 'url' => '#'],
            ['platform' => 'twitter', 'icon' => 'catalog/svg/social/twitter.svg', 'url' => '#'],
            ['platform' => 'tiktok', 'icon' => 'catalog/svg/social/tiktok.svg', 'url' => '#'],
        ]);

    }

    // ============================================================
    //  MOBILE MENU
    // ============================================================
    private function seedMobile($m) {
        $p = 'mobile';

        // --- bottom_menu (mobile bottom nav bar) ---
        $this->setT($m, $p, 'bottom_menu', 'items', [
            1 => json_encode([
                ['text' => 'Головна', 'href' => '/', 'icon' => 'catalog/svg/ui/home.svg'],
                ['text' => 'Нерухомість', 'href' => '#', 'icon' => 'catalog/svg/ui/realty.svg'],
                ['text' => 'Блог', 'href' => '#', 'icon' => 'catalog/svg/ui/blog.svg'],
                ['text' => 'Профіль', 'href' => '#', 'icon' => 'catalog/svg/ui/profile.svg'],
            ], JSON_UNESCAPED_UNICODE),
            2 => json_encode([
                ['text' => 'Home', 'href' => '/', 'icon' => 'catalog/svg/ui/home.svg'],
                ['text' => 'Realty', 'href' => '#', 'icon' => 'catalog/svg/ui/realty.svg'],
                ['text' => 'Blog', 'href' => '#', 'icon' => 'catalog/svg/ui/blog.svg'],
                ['text' => 'Profile', 'href' => '#', 'icon' => 'catalog/svg/ui/profile.svg'],
            ], JSON_UNESCAPED_UNICODE),
            3 => json_encode([
                ['text' => 'Startseite', 'href' => '/', 'icon' => 'catalog/svg/ui/home.svg'],
                ['text' => 'Immobilien', 'href' => '#', 'icon' => 'catalog/svg/ui/realty.svg'],
                ['text' => 'Blog', 'href' => '#', 'icon' => 'catalog/svg/ui/blog.svg'],
                ['text' => 'Profil', 'href' => '#', 'icon' => 'catalog/svg/ui/profile.svg'],
            ], JSON_UNESCAPED_UNICODE),
            4 => json_encode([
                ['text' => 'Главная', 'href' => '/', 'icon' => 'catalog/svg/ui/home.svg'],
                ['text' => 'Недвижимость', 'href' => '#', 'icon' => 'catalog/svg/ui/realty.svg'],
                ['text' => 'Блог', 'href' => '#', 'icon' => 'catalog/svg/ui/blog.svg'],
                ['text' => 'Профиль', 'href' => '#', 'icon' => 'catalog/svg/ui/profile.svg'],
            ], JSON_UNESCAPED_UNICODE),
        ]);

        // --- drop_realty (mobile dropdown: realty) ---
        // style: '' (default), 'active', 'green', 'blue'
        // icon: опціонально, шлях до SVG
        $excIcon = 'catalog/svg/ui/exclusive-star.svg';
        $this->setJson($m, $p, 'drop_realty', 'items', 1, [
            ['text' => 'Квартири на продаж', 'href' => '#', 'style' => 'active', 'icon' => ''],
            ['text' => 'Особняки на продаж', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Офіси на продаж', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Комерційна нерухомість на продаж', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Гаражі на продаж', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Земельні ділянки на продаж', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Нерухомість у Карпатах', 'href' => '#', 'style' => 'green', 'icon' => ''],
            ['text' => 'Квартири в оренду', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Особняки в оренду', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Офіси в оренду', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Комерційна нерухомість в оренду', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Гаражі в оренду', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Земельні ділянки в оренду', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Ексклюзиви', 'href' => '#', 'style' => 'blue', 'icon' => $excIcon],
        ]);
        $this->setJson($m, $p, 'drop_realty', 'items', 2, [
            ['text' => 'Flats for Sale', 'href' => '#', 'style' => 'active', 'icon' => ''],
            ['text' => 'Mansions for Sale', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Offices for Sale', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Commercial Real Estate for Sale', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Garages for Sale', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Land for Sale', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Real Estate in the Carpathians', 'href' => '#', 'style' => 'green', 'icon' => ''],
            ['text' => 'Flats for Rent', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Mansions for Rent', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Offices for Rent', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Commercial Real Estate for Rent', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Garages for Rent', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Land for Rent', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Exclusive', 'href' => '#', 'style' => 'blue', 'icon' => $excIcon],
        ]);
        $this->setJson($m, $p, 'drop_realty', 'items', 3, [
            ['text' => 'Wohnungen zum Verkauf', 'href' => '#', 'style' => 'active', 'icon' => ''],
            ['text' => 'Villen zum Verkauf', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Büros zum Verkauf', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Gewerbeimmobilien zum Verkauf', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Garagen zum Verkauf', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Grundstücke zum Verkauf', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Immobilien in den Karpaten', 'href' => '#', 'style' => 'green', 'icon' => ''],
            ['text' => 'Wohnungen zur Miete', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Villen zur Miete', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Büros zur Miete', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Gewerbeimmobilien zur Miete', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Garagen zur Miete', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Grundstücke zur Miete', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Exklusiv', 'href' => '#', 'style' => 'blue', 'icon' => $excIcon],
        ]);
        $this->setJson($m, $p, 'drop_realty', 'items', 4, [
            ['text' => 'Квартиры на продажу', 'href' => '#', 'style' => 'active', 'icon' => ''],
            ['text' => 'Особняки на продажу', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Офисы на продажу', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Коммерческая недвижимость на продажу', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Гаражи на продажу', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Земельные участки на продажу', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Недвижимость в Карпатах', 'href' => '#', 'style' => 'green', 'icon' => ''],
            ['text' => 'Квартиры в аренду', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Особняки в аренду', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Офисы в аренду', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Коммерческая недвижимость в аренду', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Гаражи в аренду', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Земельные участки в аренду', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Эксклюзивы', 'href' => '#', 'style' => 'blue', 'icon' => $excIcon],
        ]);

        // --- drop_blog (mobile dropdown: blog) ---
        $this->setJson($m, $p, 'drop_blog', 'items', 1, [
            ['text' => 'Новини', 'href' => '#', 'style' => 'active', 'icon' => ''],
            ['text' => 'Корисне', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Новини нерухомості', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Інвестиційні проекти', 'href' => '#', 'style' => '', 'icon' => ''],
        ]);
        $this->setJson($m, $p, 'drop_blog', 'items', 2, [
            ['text' => 'News', 'href' => '#', 'style' => 'active', 'icon' => ''],
            ['text' => 'Useful', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Real Estate News', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Investment Projects', 'href' => '#', 'style' => '', 'icon' => ''],
        ]);
        $this->setJson($m, $p, 'drop_blog', 'items', 3, [
            ['text' => 'Nachrichten', 'href' => '#', 'style' => 'active', 'icon' => ''],
            ['text' => 'Nützliches', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Immobilien-News', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Investitionsprojekte', 'href' => '#', 'style' => '', 'icon' => ''],
        ]);
        $this->setJson($m, $p, 'drop_blog', 'items', 4, [
            ['text' => 'Новости', 'href' => '#', 'style' => 'active', 'icon' => ''],
            ['text' => 'Полезное', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Новости недвижимости', 'href' => '#', 'style' => '', 'icon' => ''],
            ['text' => 'Инвестиционные проекты', 'href' => '#', 'style' => '', 'icon' => ''],
        ]);
    }

    // ============================================================
    //  COMMON (shared sections)
    // ============================================================
    private function seedCommon($m) {
        $p = 'common';

        // --- ads ---
        $this->setT($m, $p, 'ads', 'title', [
            1 => 'Місце для вашої реклами', 2 => 'Place for your advertisement',
            3 => 'Platz für Ihre Werbung', 4 => 'Место для вашей рекламы',
        ]);
        $this->setT($m, $p, 'ads', 'button_text', [
            1 => 'Забронювати', 2 => 'Book Now', 3 => 'Jetzt buchen', 4 => 'Забронировать',
        ]);
        $this->setGlobal($m, $p, 'ads', 'button_url', 'text', '#');

        // --- agency ---
        $this->setT($m, $p, 'agency', 'title', [
            1 => 'Агенція нерухомості «РІЕЛТОР»', 2 => 'Real Estate Agency "REALTOR"',
            3 => 'Immobilienagentur „REALTOR"', 4 => 'Агентство недвижимости «РИЕЛТОР»',
        ]);
        $this->setGlobal($m, $p, 'agency', 'image', 'image', 'images/logo/logo-old.png');
        $this->setT($m, $p, 'agency', 'text', [
            1 => '<p>• інформаційні послуги у напрямку продажу та оренди, включаючи подобову, обміну, купівлі житлової нерухомості — квартир, особняків, житлових будинків, котеджів<br />• первинний та вторинний ринки; комерційна нерухомість<br />• гіпермаркети, торговельні центри, магазини, мінімаркети, ресторани, кафе, бари, офіси, розважальні заклади, оптові бази тощо; промислова нерухомість<br />• цілісні майнові комплекси, готовий бізнес, окремі цехи, склади, агропромислові комплекси тощо; земельні ділянки</p><br /><p>Малі та великі інвестиційні проекти. Експертна оцінка. Супровід при складанні договору купівлі-продажу, оформленні кредиту тощо. Комісію нам сплачують власники нерухомості за ексклюзивними договорами. Велика база нерухомості ведеться з 2006 року.</p><br /><p>Допоможемо власникам швидко та вигідно продати нерухомість. В агенції працюють два сертифіковані ріелтори та один сертифікований оцінювач. Агенція є членом Української асоціації фахівців з нерухомості та Національної асоціації ріелторів (НАР).</p>',
            2 => '<p>• information services in the direction of sale and rental, including daily, exchange, purchase of residential real estate - apartments, mansions, residential buildings, cottages<br />• primary and secondary markets; commercial real estate<br />• hypermarkets, shopping centers, shops, minimarkets, restaurants, cafes, bars, offices, entertainment venues, wholesale bases, etc.; industrial real estate<br />• integral property complexes, ready-made businesses, separate workshops, warehouses, agro-industrial complexes, etc.; land plots</p><br /><p>Small and large investment projects. Expert assessment. Support in drawing up a purchase and sale agreement, drawing up a loan, etc. The commission is paid to us by property owners under exclusive agreements. The large real estate database has been maintained since 2006.</p><br /><p>We will help owners quickly and profitably sell their real estate, whether it is an apartment or a mansion, commercial real estate or land. The agency employs two certified realtors and one certified appraiser. The agency is a member of the Ukrainian Association of Real Estate Professionals and the National Association of Realtors (NAR).</p>',
            3 => '<p>• Informationsdienste im Bereich Verkauf und Vermietung, einschließlich täglicher Vermietung, Tausch, Kauf von Wohnimmobilien<br />• Primär- und Sekundärmarkt; Gewerbeimmobilien<br />• Hypermärkte, Einkaufszentren, Geschäfte, Büros usw.; Industrieimmobilien<br />• Grundstücke</p><br /><p>Kleine und große Investitionsprojekte. Expertenbewertung. Unterstützung bei Verträgen. Große Immobiliendatenbank seit 2006.</p><br /><p>Wir helfen Eigentümern, ihre Immobilien schnell und profitabel zu verkaufen. Mitglied der Ukrainischen Vereinigung der Immobilienfachleute und NAR.</p>',
            4 => '<p>• информационные услуги в направлении продажи и аренды, включая посуточную, обмена, покупки жилой недвижимости — квартир, особняков, жилых домов, коттеджей<br />• первичный и вторичный рынки; коммерческая недвижимость<br />• гипермаркеты, торговые центры, магазины, офисы и т.д.; промышленная недвижимость<br />• земельные участки</p><br /><p>Малые и крупные инвестиционные проекты. Экспертная оценка. Сопровождение при составлении договора купли-продажи. Большая база недвижимости ведётся с 2006 года.</p><br /><p>Поможем собственникам быстро и выгодно продать недвижимость. В агентстве работают два сертифицированных риелтора и один сертифицированный оценщик. Агентство является членом Украинской ассоциации специалистов по недвижимости и НАР.</p>',
        ]);
    }

    // ============================================================
    //  BLOG
    // ============================================================
    private function seedBlog($m) {
        $p = 'blog';

        // --- hero ---
        $this->setT($m, $p, 'hero', 'title_highlight', [
            1 => 'Блог', 2 => 'Blog', 3 => 'Blog', 4 => 'Блог',
        ]);
        $this->setT($m, $p, 'hero', 'text', [
            1 => 'Тут ви знайдете багато варіацій статей Lorem Ipsum, але більшість зазнали змін у тій чи іншій формі',
            2 => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable',
            3 => 'Es gibt viele Variationen von Lorem Ipsum Passagen, aber die Mehrheit hat in irgendeiner Form Veränderungen erfahren',
            4 => 'Существует множество вариаций отрывков Lorem Ipsum, но большинство из них претерпели изменения в той или иной форме',
        ]);
        $this->setGlobal($m, $p, 'hero', 'hero_image', 'image', 'images/blog/hero.jpg');
    }

    // ============================================================
    //  CUSTOMERS
    // ============================================================
    private function seedCustomers($m) {
        $p = 'customers';

        // --- hero ---
        $this->setT($m, $p, 'hero', 'title', [
            1 => 'Наші цінні', 2 => 'Our Valued', 3 => 'Unsere geschätzten', 4 => 'Наши ценные',
        ]);
        $this->setT($m, $p, 'hero', 'title_highlight', [
            1 => 'Клієнти', 2 => 'Customers', 3 => 'Kunden', 4 => 'Клиенты',
        ]);
        $this->setT($m, $p, 'hero', 'desc', [
            1 => 'Ми мали честь працювати з різними клієнтами з різних галузей. Ось деякі з клієнтів, яких ми мали задоволення обслуговувати:',
            2 => 'We have had the honor of working with a variety of clients from various industries. Here are some of the clients we have had the pleasure of serving:',
            3 => 'Wir hatten die Ehre, mit einer Vielzahl von Kunden aus verschiedenen Branchen zusammenzuarbeiten.',
            4 => 'Мы имели честь работать с различными клиентами из разных отраслей.',
        ]);
        $this->setT($m, $p, 'hero', 'review_invite', [
            1 => 'Ви наш клієнт і хочете залишити відгук про нас?',
            2 => 'Are you our Customer and would like to leave a review about us?',
            3 => 'Sind Sie unser Kunde und möchten eine Bewertung hinterlassen?',
            4 => 'Вы наш клиент и хотите оставить отзыв о нас?',
        ]);
        $this->setT($m, $p, 'hero', 'review_btn', [
            1 => '+ Написати відгук', 2 => '+ Write to Review', 3 => '+ Bewertung schreiben', 4 => '+ Написать отзыв',
        ]);
        // --- rating ---
        $this->setT($m, $p, 'rating', 'title', [
            1 => 'Рейтинг найбільш', 2 => 'Rating of the Most', 3 => 'Bewertung der', 4 => 'Рейтинг самых',
        ]);
        $this->setT($m, $p, 'rating', 'title_highlight', [
            1 => 'Активних клієнтів', 2 => 'Active Customers', 3 => 'Aktivsten Kunden', 4 => 'Активных клиентов',
        ]);
        $this->setT($m, $p, 'rating', 'desc', [
            1 => 'Ми мали честь працювати з різними клієнтами з різних галузей.',
            2 => 'We have had the honor of working with a variety of clients from various industries. Here are some of the clients we have had the pleasure of serving:',
            3 => 'Wir hatten die Ehre, mit verschiedenen Kunden zusammenzuarbeiten.',
            4 => 'Мы имели честь работать с различными клиентами из разных отраслей.',
        ]);
        $this->setT($m, $p, 'rating', 'btn_text', [
            1 => 'Переглянути весь рейтинг', 2 => 'View All Rating', 3 => 'Alle Bewertungen', 4 => 'Смотреть весь рейтинг',
        ]);
        $this->setGlobal($m, $p, 'rating', 'btn_href', 'text', '#');
        $this->setT($m, $p, 'rating', 'tooltip', [
            1 => 'тут короткий текст з інформацією', 2 => 'here is a short informational text',
            3 => 'hier ist ein kurzer Informationstext', 4 => 'тут короткий текст с информацией',
        ]);

        // --- items (customers) ---
        $customers_uk = [
            ['logo' => 'images/logos-custumers/ieg.svg', 'name' => 'Infinity Energy Group', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'infinity-energy-group.com', 'review' => '"Багато настільних видавничих пакетів та редакторів веб-сторінок тепер використовують Lorem Ipsum"', 'active_objects' => '52'],
            ['logo' => 'images/logos-custumers/raif.png', 'name' => 'Raiffeisen Bank', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'raiffeisen.ua', 'review' => '"Багато настільних видавничих пакетів та редакторів веб-сторінок"', 'active_objects' => '41'],
            ['logo' => 'images/logos-custumers/pv.svg', 'name' => 'PrivatBank', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'privatbank.ua', 'review' => '"Чудовий сервіс та професійний підхід до кожного клієнта"', 'active_objects' => '34'],
            ['logo' => 'images/logos-custumers/pod.svg', 'name' => 'Подорожник', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'podorozhnyk.ua', 'review' => '"Рекомендуємо всім, хто шукає надійного партнера"', 'active_objects' => '27'],
            ['logo' => 'images/logos-custumers/np.svg', 'name' => 'Нова Пошта', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'novaposhta.ua', 'review' => '"Професійна робота з нерухомістю на найвищому рівні"', 'active_objects' => '20'],
            ['logo' => 'images/logos-custumers/ub.svg', 'name' => 'Universal Bank', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'universalbank.com.ua', 'review' => '"Завжди допомагають знайти найкращі варіанти"', 'active_objects' => '18'],
            ['logo' => 'images/logos-custumers/ob.svg', 'name' => 'OTP Bank', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'otpbank.com.ua', 'review' => '"Відмінна якість послуг та швидка комунікація"', 'active_objects' => '10'],
            ['logo' => 'images/logos-custumers/ukrp.svg', 'name' => 'Укрпошта', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'ukrposhta.ua', 'review' => '"Надійний партнер у сфері нерухомості"', 'active_objects' => '5'],
            ['logo' => 'images/logos-custumers/mzoo.svg', 'name' => 'Master Zoo', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'masterzoo.ua', 'review' => '"Дуже задоволені співпрацею"', 'active_objects' => '3'],
            ['logo' => 'images/logos-custumers/rztk.png', 'name' => 'Rozetka', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'rozetka.com.ua', 'review' => '"Професіонали своєї справи"', 'active_objects' => '15'],
            ['logo' => 'images/logos-custumers/atb.svg', 'name' => 'АТБ', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'atbmarket.com', 'review' => '"Рекомендуємо агенцію РІЕЛТОР"', 'active_objects' => '12'],
            ['logo' => 'images/logos-custumers/epicentr.svg', 'name' => 'Епіцентр', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'epicentrk.ua', 'review' => '"Швидко та якісно допомогли з пошуком"', 'active_objects' => '8'],
            ['logo' => 'images/logos-custumers/ib.svg', 'name' => 'Idea Bank', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'ideabank.ua', 'review' => '"Відповідальний підхід до роботи"', 'active_objects' => '4'],
            ['logo' => 'images/logos-custumers/eva.svg', 'name' => 'EVA', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'eva.ua', 'review' => '"Чудовий досвід співпраці"', 'active_objects' => '7'],
            ['logo' => 'images/logos-custumers/kyiv.svg', 'name' => 'Київміськбуд', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'kyivmiskbud.ua', 'review' => '"Найкращі фахівці з нерухомості"', 'active_objects' => '9'],
            ['logo' => 'images/logos-custumers/allo.svg', 'name' => 'Алло', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'allo.ua', 'review' => '"Вражаючий рівень обслуговування"', 'active_objects' => '6'],
        ];

        $customers_en = [
            ['logo' => 'images/logos-custumers/ieg.svg', 'name' => 'Infinity Energy Group', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'infinity-energy-group.com', 'review' => '"Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text"', 'active_objects' => '52'],
            ['logo' => 'images/logos-custumers/raif.png', 'name' => 'Raiffeisen Bank', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'raiffeisen.ua', 'review' => '"Many desktop publishing packages and web page editors now use Lorem Ipsum"', 'active_objects' => '41'],
            ['logo' => 'images/logos-custumers/pv.svg', 'name' => 'PrivatBank', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'privatbank.ua', 'review' => '"Excellent service and professional approach to every client"', 'active_objects' => '34'],
            ['logo' => 'images/logos-custumers/pod.svg', 'name' => 'Podorozhnyk', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'podorozhnyk.ua', 'review' => '"We recommend to everyone looking for a reliable partner"', 'active_objects' => '27'],
            ['logo' => 'images/logos-custumers/np.svg', 'name' => 'Nova Poshta', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'novaposhta.ua', 'review' => '"Professional work with real estate at the highest level"', 'active_objects' => '20'],
            ['logo' => 'images/logos-custumers/ub.svg', 'name' => 'Universal Bank', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'universalbank.com.ua', 'review' => '"Always help find the best options"', 'active_objects' => '18'],
            ['logo' => 'images/logos-custumers/ob.svg', 'name' => 'OTP Bank', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'otpbank.com.ua', 'review' => '"Excellent quality of services and fast communication"', 'active_objects' => '10'],
            ['logo' => 'images/logos-custumers/ukrp.svg', 'name' => 'Ukrposhta', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'ukrposhta.ua', 'review' => '"Reliable partner in the real estate industry"', 'active_objects' => '5'],
            ['logo' => 'images/logos-custumers/mzoo.svg', 'name' => 'Master Zoo', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'masterzoo.ua', 'review' => '"Very satisfied with the cooperation"', 'active_objects' => '3'],
            ['logo' => 'images/logos-custumers/rztk.png', 'name' => 'Rozetka', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'rozetka.com.ua', 'review' => '"True professionals in their field"', 'active_objects' => '15'],
            ['logo' => 'images/logos-custumers/atb.svg', 'name' => 'ATB', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'atbmarket.com', 'review' => '"We recommend REALTOR agency"', 'active_objects' => '12'],
            ['logo' => 'images/logos-custumers/epicentr.svg', 'name' => 'Epicentr', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'epicentrk.ua', 'review' => '"Quickly and efficiently helped with the search"', 'active_objects' => '8'],
            ['logo' => 'images/logos-custumers/ib.svg', 'name' => 'Idea Bank', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'ideabank.ua', 'review' => '"Responsible approach to work"', 'active_objects' => '4'],
            ['logo' => 'images/logos-custumers/eva.svg', 'name' => 'EVA', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'eva.ua', 'review' => '"Wonderful cooperation experience"', 'active_objects' => '7'],
            ['logo' => 'images/logos-custumers/kyiv.svg', 'name' => 'Kyivmiskbud', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'kyivmiskbud.ua', 'review' => '"The best real estate specialists"', 'active_objects' => '9'],
            ['logo' => 'images/logos-custumers/allo.svg', 'name' => 'Allo', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'allo.ua', 'review' => '"Impressive level of service"', 'active_objects' => '6'],
        ];

        $this->setJson($m, $p, 'items', 'list', 1, $customers_uk);
        $this->setJson($m, $p, 'items', 'list', 2, $customers_en);
        $this->setJson($m, $p, 'items', 'list', 3, $customers_en); // DE = EN placeholder
        $this->setJson($m, $p, 'items', 'list', 4, $customers_uk); // RU ≈ UK placeholder
    }

    // ============================================================
    //  PARTNERS
    // ============================================================
    private function seedPartners($m) {
        $p = 'partners';

        // --- hero ---
        $this->setT($m, $p, 'hero', 'title', [
            1 => 'Наші цінні',
            2 => 'Our',
            3 => 'Unsere geschätzten',
            4 => 'Наши ценные',
        ]);
        $this->setT($m, $p, 'hero', 'title_highlight', [
            1 => 'Партнери',
            2 => 'Partners',
            3 => 'Partner',
            4 => 'Партнеры',
        ]);
        $this->setT($m, $p, 'hero', 'desc', [
            1 => 'Ми пишаємося співпрацею з провідними компаніями та організаціями, які поділяють наші цінності та прагнення до інновацій.',
            2 => 'We take pride in collaborating with leading companies and organizations that share our values and commitment to innovation. Through partnerships, we implement bold projects, introduce cutting-edge technologies, and create high-quality products and services for our customers.',
            3 => 'Wir sind stolz auf die Zusammenarbeit mit führenden Unternehmen und Organisationen.',
            4 => 'Мы гордимся сотрудничеством с ведущими компаниями и организациями.',
        ]);
        $this->setT($m, $p, 'hero', 'review_invite', [
            1 => 'Ви наш партнер і хочете залишити відгук про нас?',
            2 => 'Are you our Customer and would like to leave a review about us?',
            3 => 'Sind Sie unser Partner und möchten eine Bewertung hinterlassen?',
            4 => 'Вы наш партнер и хотите оставить отзыв о нас?',
        ]);
        $this->setT($m, $p, 'hero', 'review_btn', [
            1 => '+ Написати відгук',
            2 => '+ Write to Review',
            3 => '+ Bewertung schreiben',
            4 => '+ Написать отзыв',
        ]);

        // --- items (партнеры) ---
        $partners_uk = [
            ['logo' => 'images/logos-custumers/ivano-fr.svg', 'name' => 'Івано-Франківська ОДА', 'since_year' => '2016', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'if.gov.ua', 'review' => '"Багато настільних видавничих пакетів та редакторів веб-сторінок тепер використовують Lorem Ipsum"'],
            ['logo' => 'images/logos-custumers/dom.svg', 'name' => 'DIM Development', 'since_year' => '2016', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'dim.ua', 'review' => '"Багато настільних видавничих пакетів та редакторів веб-сторінок тепер використовують Lorem Ipsum"'],
            ['logo' => 'images/logos-custumers/ibud.svg', 'name' => 'iBud', 'since_year' => '2016', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'ibud.ua', 'review' => '"Багато настільних видавничих пакетів та редакторів веб-сторінок тепер використовують Lorem Ipsum"'],
            ['logo' => 'images/logos-custumers/vox.svg', 'name' => 'VOX Architecture', 'since_year' => '2016', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'vox.com.ua', 'review' => '"Багато настільних видавничих пакетів та редакторів веб-сторінок тепер використовують Lorem Ipsum"'],
            ['logo' => 'images/logos-custumers/ivano-fr.svg', 'name' => 'Карпатський Дім', 'since_year' => '2016', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'karpatskiy-dim.ua', 'review' => '"Багато настільних видавничих пакетів та редакторів веб-сторінок тепер використовують Lorem Ipsum"'],
            ['logo' => 'images/logos-custumers/dom.svg', 'name' => 'Будівельний Альянс', 'since_year' => '2016', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'bud-alliance.ua', 'review' => '"Багато настільних видавничих пакетів та редакторів веб-сторінок тепер використовують Lorem Ipsum"'],
            ['logo' => 'images/logos-custumers/ibud.svg', 'name' => 'Галицький Стандарт', 'since_year' => '2016', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'galstandard.ua', 'review' => '"Багато настільних видавничих пакетів та редакторів веб-сторінок тепер використовують Lorem Ipsum"'],
            ['logo' => 'images/logos-custumers/vox.svg', 'name' => 'Преміум Естейт', 'since_year' => '2016', 'activity' => 'Комерційна нерухомість', 'category' => 'Будівництво будинків', 'website' => 'premium-estate.ua', 'review' => '"Багато настільних видавничих пакетів та редакторів веб-сторінок тепер використовують Lorem Ipsum"'],
        ];
        $partners_en = [
            ['logo' => 'images/logos-custumers/ivano-fr.svg', 'name' => 'Ivano-Frankivsk Regional Administration', 'since_year' => '2016', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'if.gov.ua', 'review' => '"Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites"'],
            ['logo' => 'images/logos-custumers/dom.svg', 'name' => 'DIM Development', 'since_year' => '2016', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'dim.ua', 'review' => '"Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites"'],
            ['logo' => 'images/logos-custumers/ibud.svg', 'name' => 'iBud', 'since_year' => '2016', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'ibud.ua', 'review' => '"Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites"'],
            ['logo' => 'images/logos-custumers/vox.svg', 'name' => 'VOX Architecture', 'since_year' => '2016', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'vox.com.ua', 'review' => '"Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites"'],
            ['logo' => 'images/logos-custumers/ivano-fr.svg', 'name' => 'Carpathian Home', 'since_year' => '2016', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'karpatskiy-dim.ua', 'review' => '"Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites"'],
            ['logo' => 'images/logos-custumers/dom.svg', 'name' => 'Construction Alliance', 'since_year' => '2016', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'bud-alliance.ua', 'review' => '"Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites"'],
            ['logo' => 'images/logos-custumers/ibud.svg', 'name' => 'Galician Standard', 'since_year' => '2016', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'galstandard.ua', 'review' => '"Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites"'],
            ['logo' => 'images/logos-custumers/vox.svg', 'name' => 'Premium Estate', 'since_year' => '2016', 'activity' => 'Commercial Real Estate', 'category' => 'Construction of Houses', 'website' => 'premium-estate.ua', 'review' => '"Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites"'],
        ];

        $this->setJson($m, $p, 'items', 'list', 1, $partners_uk);
        $this->setJson($m, $p, 'items', 'list', 2, $partners_en);
        $this->setJson($m, $p, 'items', 'list', 3, $partners_en);
        $this->setJson($m, $p, 'items', 'list', 4, $partners_uk);
    }

    // ============================================================
    //  HOME
    // ============================================================
    private function seedHome($m) {
        $p = 'home';

        // --- first_screen (hero) ---
        $this->setT($m, $p, 'first_screen', 'title_highlight', [
            1 => 'Realtor',
            2 => 'Realtor',
            3 => 'Realtor',
            4 => 'Realtor',
        ]);
        $this->setT($m, $p, 'first_screen', 'title', [
            1 => '- Ваш надійний партнер у світі нерухомості',
            2 => '- Your Reliable Partner in the World of Real Estate',
            3 => '- Ihr zuverlässiger Partner in der Welt der Immobilien',
            4 => '- Ваш надёжный партнер в мире недвижимости',
        ]);
        $this->setT($m, $p, 'first_screen', 'text', [
            1 => 'Це команда професіоналів, які допоможуть знайти ідеальний дім або вигідну нерухомість для інвестицій та бізнесу',
            2 => 'This is a team of professionals who help you find the perfect home or a profitable property for investment and business',
            3 => 'Ein Team von Fachleuten, das Ihnen hilft, das perfekte Zuhause oder eine profitable Immobilie für Investitionen und Geschäft zu finden',
            4 => 'Это команда профессионалов, которые помогут найти идеальный дом или выгодную недвижимость для инвестиций и бизнеса',
        ]);
        $this->setGlobal($m, $p, 'first_screen', 'bg_image', 'image', 'images/home/main-image.png');

        // --- key_features ---
        $this->setT($m, $p, 'key_features', 'title', [
            1 => 'Агенція нерухомості', 2 => 'Estate Agency',
            3 => 'Immobilienagentur', 4 => 'Агентство недвижимости',
        ]);
        $this->setT($m, $p, 'key_features', 'title_highlight', [
            1 => '«Ріелтор»', 2 => '"Realtor"',
            3 => '„Realtor"', 4 => '«Риелтор»',
        ]);
        $this->setT($m, $p, 'key_features', 'title_suffix', [
            1 => '— це', 2 => 'Is This',
            3 => '— das ist', 4 => '— это',
        ]);
        $this->setJson($m, $p, 'key_features', 'items', 1, [
            ['icon' => 'catalog/svg/key-features/database.svg', 'description' => 'Найбільша база продажу та оренди нерухомості'],
            ['icon' => 'catalog/svg/key-features/handshake.svg', 'description' => 'Вигідні умови співпраці для продавців і покупців'],
            ['icon' => 'catalog/svg/key-features/consulting.svg', 'description' => 'Консультаційна та юридична підтримка'],
            ['icon' => 'catalog/svg/key-features/team.svg', 'description' => 'Кваліфікований персонал'],
        ]);
        $this->setJson($m, $p, 'key_features', 'items', 2, [
            ['icon' => 'catalog/svg/key-features/database.svg', 'description' => 'The largest database of real estate sales and rentals'],
            ['icon' => 'catalog/svg/key-features/handshake.svg', 'description' => 'Favourable terms of cooperation for sellers and buyers'],
            ['icon' => 'catalog/svg/key-features/consulting.svg', 'description' => 'Consulting and legal support'],
            ['icon' => 'catalog/svg/key-features/team.svg', 'description' => 'Qualified staff'],
        ]);
        $this->setJson($m, $p, 'key_features', 'items', 3, [
            ['icon' => 'catalog/svg/key-features/database.svg', 'description' => 'Die größte Datenbank für Immobilienverkauf und -vermietung'],
            ['icon' => 'catalog/svg/key-features/handshake.svg', 'description' => 'Günstige Kooperationsbedingungen für Verkäufer und Käufer'],
            ['icon' => 'catalog/svg/key-features/consulting.svg', 'description' => 'Beratung und rechtliche Unterstützung'],
            ['icon' => 'catalog/svg/key-features/team.svg', 'description' => 'Qualifiziertes Personal'],
        ]);
        $this->setJson($m, $p, 'key_features', 'items', 4, [
            ['icon' => 'catalog/svg/key-features/database.svg', 'description' => 'Крупнейшая база продажи и аренды недвижимости'],
            ['icon' => 'catalog/svg/key-features/handshake.svg', 'description' => 'Выгодные условия сотрудничества для продавцов и покупателей'],
            ['icon' => 'catalog/svg/key-features/consulting.svg', 'description' => 'Консультационная и юридическая поддержка'],
            ['icon' => 'catalog/svg/key-features/team.svg', 'description' => 'Квалифицированный персонал'],
        ]);

        // --- choose_us ---
        $this->setT($m, $p, 'choose_us', 'title', [
            1 => 'Чому', 2 => 'Why', 3 => 'Warum', 4 => 'Почему',
        ]);
        $this->setT($m, $p, 'choose_us', 'title_highlight', [
            1 => 'обирають', 2 => 'Choose', 3 => 'uns', 4 => 'выбирают',
        ]);
        $this->setT($m, $p, 'choose_us', 'title_suffix', [
            1 => 'нас?', 2 => 'Us?', 3 => 'wählen?', 4 => 'нас?',
        ]);
        $this->setGlobal($m, $p, 'choose_us', 'mobile_image', 'image', 'images/home/image-block-why-choose-us-mob.jpg');
        $this->setJson($m, $p, 'choose_us', 'items', 1, [
            ['icon' => 'catalog/svg/choose-us/security.svg', 'title' => 'Максимальна безпека угоди', 'description' => 'Ми гарантуємо юридичну чистоту кожної угоди. Перевіряємо документи, супроводжуємо клієнта на всіх етапах і захищаємо від ризиків'],
            ['icon' => 'catalog/svg/choose-us/database-objects.svg', 'title' => 'Велика база перевірених об\'єктів', 'description' => 'Доступ до ексклюзивних пропозицій ринку! Ми знаємо, де знайти ідеальну квартиру чи будинок під ваші вимоги'],
            ['icon' => 'catalog/svg/choose-us/time-saving.svg', 'title' => 'Економія вашого часу', 'description' => 'Ми беремо на себе всі клопоти: підбір, перегляди, переговори та закриття угоди. Вам залишається лише забрати ключі від ідеального дому!'],
        ]);
        $this->setJson($m, $p, 'choose_us', 'items', 2, [
            ['icon' => 'catalog/svg/choose-us/security.svg', 'title' => 'Maximum transaction security', 'description' => 'We guarantee the legal purity of each transaction. We check documents, accompany the client at all stages and protect against risks'],
            ['icon' => 'catalog/svg/choose-us/database-objects.svg', 'title' => 'Large database of verified objects', 'description' => 'Access to exclusive market offers! We know where to find the perfect apartment or house for your requirements'],
            ['icon' => 'catalog/svg/choose-us/time-saving.svg', 'title' => 'Saving your time', 'description' => 'We take care of all the hassle: selection, viewings, negotiations, and closing the deal. All you have to do is take the keys to your ideal home!'],
        ]);
        $this->setJson($m, $p, 'choose_us', 'items', 3, [
            ['icon' => 'catalog/svg/choose-us/security.svg', 'title' => 'Maximale Transaktionssicherheit', 'description' => 'Wir garantieren die rechtliche Sauberkeit jeder Transaktion. Wir prüfen Dokumente, begleiten den Kunden in allen Phasen und schützen vor Risiken'],
            ['icon' => 'catalog/svg/choose-us/database-objects.svg', 'title' => 'Große Datenbank geprüfter Objekte', 'description' => 'Zugang zu exklusiven Marktangeboten! Wir wissen, wo die perfekte Wohnung oder das perfekte Haus für Ihre Anforderungen zu finden ist'],
            ['icon' => 'catalog/svg/choose-us/time-saving.svg', 'title' => 'Zeitersparnis', 'description' => 'Wir kümmern uns um alles: Auswahl, Besichtigungen, Verhandlungen und Geschäftsabschluss. Sie müssen nur noch die Schlüssel zu Ihrem Traumhaus abholen!'],
        ]);
        $this->setJson($m, $p, 'choose_us', 'items', 4, [
            ['icon' => 'catalog/svg/choose-us/security.svg', 'title' => 'Максимальная безопасность сделки', 'description' => 'Мы гарантируем юридическую чистоту каждой сделки. Проверяем документы, сопровождаем клиента на всех этапах и защищаем от рисков'],
            ['icon' => 'catalog/svg/choose-us/database-objects.svg', 'title' => 'Большая база проверенных объектов', 'description' => 'Доступ к эксклюзивным предложениям рынка! Мы знаем, где найти идеальную квартиру или дом под ваши требования'],
            ['icon' => 'catalog/svg/choose-us/time-saving.svg', 'title' => 'Экономия вашего времени', 'description' => 'Мы берём на себя все хлопоты: подбор, просмотры, переговоры и закрытие сделки. Вам остаётся лишь забрать ключи от идеального дома!'],
        ]);

        // --- achievements ---
        $this->setT($m, $p, 'achievements', 'title', [
            1 => 'Досягнення', 2 => 'Company',
            3 => 'Unternehmens', 4 => 'Достижения',
        ]);
        $this->setT($m, $p, 'achievements', 'title_highlight', [
            1 => 'компанії', 2 => 'Achievements',
            3 => 'leistungen', 4 => 'компании',
        ]);
        $this->setT($m, $p, 'achievements', 'desc', [
            1 => 'Наша компанія не просто займається нерухомістю — ми створюємо безклопітні, вигідні та комфортні угоди, змінюючи ринок на краще. За роки роботи ми досягли значних результатів:',
            2 => 'Our company doesn\'t just deal with real estate - we create hassle-free, profitable and comfortable deals, changing the market for the better. Over the years of work, we have achieved significant results:',
            3 => 'Unser Unternehmen handelt nicht nur mit Immobilien — wir schaffen unkomplizierte, profitable und komfortable Geschäfte. Im Laufe der Jahre haben wir bedeutende Ergebnisse erzielt:',
            4 => 'Наша компания не просто занимается недвижимостью — мы создаём беспроблемные, выгодные и комфортные сделки, меняя рынок к лучшему. За годы работы мы достигли значительных результатов:',
        ]);
        $m->setValue($p, 'achievements', 'image', 'image', 'catalog/company-achivment-image.png', 0);
        $this->setJson($m, $p, 'achievements', 'items', 1, [
            ['value' => '19', 'is_percent' => '', 'label' => 'років досвіду роботи', 'description' => 'Ми працюємо для вас з 2006 року, пропонуючи лише найкращі рішення у сфері нерухомості'],
            ['value' => '10108', 'is_percent' => '', 'label' => 'успішних угод', 'description' => 'Успішні угоди — це не просто цифра, а сотні задоволених клієнтів, які знайшли своє ідеальне житло'],
            ['value' => '2453', 'is_percent' => '', 'label' => 'ексклюзивних об\'єктів', 'description' => 'Ми пропонуємо нерухомість, яку ви не знайдете у відкритому доступі'],
            ['value' => '80', 'is_percent' => '1', 'label' => 'нових клієнтів', 'description' => 'Більшість клієнтів — ті, хто прийшов за рекомендацією друзів, колег або партнерів'],
        ]);
        $this->setJson($m, $p, 'achievements', 'items', 2, [
            ['value' => '19', 'is_percent' => '', 'label' => 'years of work experience', 'description' => 'We have been working for you since 2006, offering only the best real estate solutions'],
            ['value' => '10108', 'is_percent' => '', 'label' => 'successful deals', 'description' => 'Successful deals are not just a number, but hundreds of satisfied clients who found their perfect home'],
            ['value' => '2453', 'is_percent' => '', 'label' => 'exclusive objects', 'description' => 'We offer real estate that you will not find in the public domain'],
            ['value' => '80', 'is_percent' => '1', 'label' => 'new customers', 'description' => 'Most of our clients came on the recommendation of friends, colleagues or partners'],
        ]);
        $this->setJson($m, $p, 'achievements', 'items', 3, [
            ['value' => '19', 'is_percent' => '', 'label' => 'Jahre Erfahrung', 'description' => 'Seit 2006 für Sie tätig mit den besten Immobilienlösungen'],
            ['value' => '10108', 'is_percent' => '', 'label' => 'erfolgreiche Geschäfte', 'description' => 'Hunderte zufriedener Kunden fanden ihr perfektes Zuhause'],
            ['value' => '2453', 'is_percent' => '', 'label' => 'exklusive Objekte', 'description' => 'Immobilien, die Sie nicht öffentlich finden werden'],
            ['value' => '80', 'is_percent' => '1', 'label' => 'Neukunden', 'description' => 'Kamen auf Empfehlung von Freunden, Kollegen oder Partnern'],
        ]);
        $this->setJson($m, $p, 'achievements', 'items', 4, [
            ['value' => '19', 'is_percent' => '', 'label' => 'лет опыта работы', 'description' => 'Работаем для вас с 2006 года, предлагая лучшие решения в сфере недвижимости'],
            ['value' => '10108', 'is_percent' => '', 'label' => 'успешных сделок', 'description' => 'Сотни довольных клиентов нашли своё идеальное жильё'],
            ['value' => '2453', 'is_percent' => '', 'label' => 'эксклюзивных объектов', 'description' => 'Недвижимость, которую не найдёте в открытом доступе'],
            ['value' => '80', 'is_percent' => '1', 'label' => 'новых клиентов', 'description' => 'Большинство пришли по рекомендации друзей, коллег или партнёров'],
        ]);

        // --- partners ---
        $this->setT($m, $p, 'partners', 'title', [
            1 => 'Наші', 2 => 'Our', 3 => 'Unsere', 4 => 'Наши',
        ]);
        $this->setT($m, $p, 'partners', 'title_highlight', [
            1 => 'Партнери', 2 => 'Partners', 3 => 'Partner', 4 => 'Партнёры',
        ]);
        $this->setT($m, $p, 'partners', 'view_all_text', [
            1 => 'Переглянути всі', 2 => 'View All', 3 => 'Alle anzeigen', 4 => 'Смотреть все',
        ]);
        $this->setGlobal($m, $p, 'partners', 'view_all_href', 'text', '/partners');
        // Top row — SVG logos (developers/builders)
        $this->setJson($m, $p, 'partners', 'logos', 0, [
            ['image' => 'catalog/svg/partners/partner-1.svg', 'name' => 'Місто для людей'],
            ['image' => 'catalog/svg/partners/partner-2.svg', 'name' => 'Doom Development'],
            ['image' => 'catalog/svg/partners/partner-3.svg', 'name' => 'iBud'],
            ['image' => 'catalog/svg/partners/partner-4.svg', 'name' => 'Partner 4'],
        ]);
        // Bottom row — PNG links (services)
        $this->setJson($m, $p, 'partners', 'items', 1, [
            ['image' => 'images/partners/luxury.png', 'name' => 'Елітна нерухомість', 'href' => '#'],
            ['image' => 'images/partners/carphathians.png', 'name' => 'Нерухомість у Карпатах', 'href' => '#'],
            ['image' => 'images/partners/exlusives.png', 'name' => 'Ексклюзиви', 'href' => '#'],
            ['image' => 'images/partners/investment.png', 'name' => 'Інвестиційні проекти', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'partners', 'items', 2, [
            ['image' => 'images/partners/luxury.png', 'name' => 'Luxury Real Estate', 'href' => '#'],
            ['image' => 'images/partners/carphathians.png', 'name' => 'Real Estate in the Carpathians', 'href' => '#'],
            ['image' => 'images/partners/exlusives.png', 'name' => 'Exclusives', 'href' => '#'],
            ['image' => 'images/partners/investment.png', 'name' => 'Investment Projects', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'partners', 'items', 3, [
            ['image' => 'images/partners/luxury.png', 'name' => 'Luxusimmobilien', 'href' => '#'],
            ['image' => 'images/partners/carphathians.png', 'name' => 'Karpaten-Immobilien', 'href' => '#'],
            ['image' => 'images/partners/exlusives.png', 'name' => 'Exklusiv', 'href' => '#'],
            ['image' => 'images/partners/investment.png', 'name' => 'Investitionsprojekte', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'partners', 'items', 4, [
            ['image' => 'images/partners/luxury.png', 'name' => 'Элитная недвижимость', 'href' => '#'],
            ['image' => 'images/partners/carphathians.png', 'name' => 'Недвижимость в Карпатах', 'href' => '#'],
            ['image' => 'images/partners/exlusives.png', 'name' => 'Эксклюзивы', 'href' => '#'],
            ['image' => 'images/partners/investment.png', 'name' => 'Инвестиционные проекты', 'href' => '#'],
        ]);

        // --- customers ---
        $this->setT($m, $p, 'customers', 'title', [
            1 => 'Наші цінні', 2 => 'Our Valued', 3 => 'Unsere geschätzten', 4 => 'Наши ценные',
        ]);
        $this->setT($m, $p, 'customers', 'title_highlight', [
            1 => 'Клієнти', 2 => 'Customers', 3 => 'Kunden', 4 => 'Клиенты',
        ]);
        $this->setT($m, $p, 'customers', 'view_all_text', [
            1 => 'Переглянути всі', 2 => 'View All', 3 => 'Alle anzeigen', 4 => 'Смотреть все',
        ]);
        $this->setGlobal($m, $p, 'customers', 'view_all_href', 'text', '/customers');
        $this->setT($m, $p, 'customers', 'desc', [
            1 => 'Ми мали честь працювати з різноманітними клієнтами з різних галузей. Ось деякі з клієнтів, яких ми мали задоволення обслуговувати:',
            2 => 'We have had the honor of working with a variety of clients from various industries. Here are some of the clients we have had the pleasure of serving:',
            3 => 'Wir hatten die Ehre, mit Kunden aus verschiedenen Branchen zusammenzuarbeiten. Hier sind einige der Kunden, die wir betreuen durften:',
            4 => 'Мы имели честь работать с клиентами из различных отраслей. Вот некоторые из клиентов, которых мы имели удовольствие обслуживать:',
        ]);
        // Top row — big SVG logos
        $this->setJson($m, $p, 'customers', 'logos', 0, [
            ['image' => 'catalog/svg/customers/customer-1.svg', 'name' => 'Raiffeisen Bank'],
            ['image' => 'catalog/svg/customers/customer-2.svg', 'name' => 'SoftServe'],
            ['image' => 'catalog/svg/customers/customer-3.svg', 'name' => 'GlobalLogic'],
            ['image' => 'catalog/svg/customers/customer-4.svg', 'name' => 'Eleks'],
        ]);
        // Bottom row — smaller image cards
        $this->setJson($m, $p, 'customers', 'items', 0, [
            ['image' => 'catalog/svg/customers/customer-1.svg', 'name' => 'Raiffeisen Bank', 'href' => '#'],
            ['image' => 'catalog/svg/customers/customer-2.svg', 'name' => 'SoftServe', 'href' => '#'],
            ['image' => 'catalog/svg/customers/customer-3.svg', 'name' => 'GlobalLogic', 'href' => '#'],
            ['image' => 'catalog/svg/customers/customer-4.svg', 'name' => 'Eleks', 'href' => '#'],
        ]);

        // --- reviews (header only, cards are dynamic) ---
        $this->setT($m, $p, 'reviews', 'title', [
            1 => 'Відгуки наших клієнтів', 2 => 'Feedback from Our Clients',
            3 => 'Feedback unserer Kunden', 4 => 'Отзывы наших клиентов',
        ]);
        $this->setT($m, $p, 'reviews', 'desc', [
            1 => 'Ми дуже вдячні нашим клієнтам за співпрацю і будемо раді зустрітися знову. Ви також можете залишити свої враження після роботи з нами!',
            2 => 'We are very grateful to our customers for their cooperation and will be glad to meet again. You can also leave your impressions after working with us!',
            3 => 'Wir sind unseren Kunden sehr dankbar für die Zusammenarbeit und freuen uns auf ein Wiedersehen. Sie können auch Ihre Eindrücke nach der Arbeit mit uns hinterlassen!',
            4 => 'Мы очень благодарны нашим клиентам за сотрудничество и будем рады встретиться снова. Вы также можете оставить свои впечатления после работы с нами!',
        ]);
        $this->setT($m, $p, 'reviews', 'button_text', [
            1 => '+ Написати відгук', 2 => '+ Write Review',
            3 => '+ Bewertung schreiben', 4 => '+ Написать отзыв',
        ]);

        // --- contact_fab (floating contact button) ---
        $this->setT($m, $p, 'contact_fab', 'callback_title', [
            1 => 'Замовити зворотній дзвінок', 2 => 'Request a Callback',
            3 => 'Rückruf anfordern', 4 => 'Заказать обратный звонок',
        ]);
        $this->setT($m, $p, 'contact_fab', 'callback_desc', [
            1 => 'Залиште нам свій номер телефону і ми зв\'яжемося з вами',
            2 => 'Leave us your phone number and we will contact you',
            3 => 'Hinterlassen Sie uns Ihre Telefonnummer und wir melden uns bei Ihnen',
            4 => 'Оставьте нам свой номер телефона и мы свяжемся с вами',
        ]);
        $this->setT($m, $p, 'contact_fab', 'write_title', [
            1 => 'Написати нам', 2 => 'Write to Us',
            3 => 'Schreiben Sie uns', 4 => 'Написать нам',
        ]);
        $this->setT($m, $p, 'contact_fab', 'write_desc', [
            1 => 'Залиште нам свій e-mail і ми зв\'яжемося з вами',
            2 => 'Leave us your e-mail and we will contact you',
            3 => 'Hinterlassen Sie uns Ihre E-Mail und wir melden uns',
            4 => 'Оставьте нам свой e-mail и мы свяжемся с вами',
        ]);

        // --- faq ---
        $this->setT($m, $p, 'faq', 'title', [
            1 => 'Загальні', 2 => 'General',
            3 => 'Allgemeine', 4 => 'Общие',
        ]);
        $this->setT($m, $p, 'faq', 'title_highlight', [
            1 => 'Питання', 2 => 'Questions',
            3 => 'Fragen', 4 => 'Вопросы',
        ]);
        $this->setT($m, $p, 'faq', 'view_all_text', [
            1 => 'Переглянути все', 2 => 'View All',
            3 => 'Alle ansehen', 4 => 'Смотреть все',
        ]);
        $m->setValue($p, 'faq', 'view_all_href', 'text', '#', 0);
        $this->setT($m, $p, 'faq', 'desc', [
            1 => 'Тут ви знайдете найпоширеніші запитання про нашу агенцію. Якщо не знайшли відповіді — перегляньте сторінку <a href="#">FAQ</a> або задайте своє питання там.',
            2 => 'Here you will find the most frequently asked questions about our agency. If you did not find what you were looking for, perhaps your question will be found on the <a href="#">FAQ</a> page or you can ask your question there.',
            3 => 'Hier finden Sie die häufigsten Fragen zu unserer Agentur. Falls Sie nichts gefunden haben, besuchen Sie die <a href="#">FAQ</a>-Seite.',
            4 => 'Здесь вы найдёте самые частые вопросы о нашем агентстве. Если не нашли — загляните на страницу <a href="#">FAQ</a>.',
        ]);
        $this->setT($m, $p, 'faq', 'btn_text', [
            1 => 'Переглянути все', 2 => 'View All',
            3 => 'Alle ansehen', 4 => 'Смотреть все',
        ]);
        $this->setJson($m, $p, 'faq', 'items', 1, [
            ['question' => 'Як зв\'язатися з ріелтором?', 'answer' => 'Зателефонуйте, напишіть на email або заповніть форму на сайті. Відповідь протягом 30 хвилин.'],
            ['question' => 'Що станеться при скасуванні бронювання?', 'answer' => 'Повне повернення коштів протягом 3–5 робочих днів.'],
            ['question' => 'Як визначити орендну вартість?', 'answer' => 'Безкоштовний аналіз ринку на основі розташування, стану та попиту.'],
            ['question' => 'Чи можна застрахувати квартиру?', 'answer' => 'Так, страхові пакети від $10/місяць.'],
            ['question' => 'Як продовжити оренду?', 'answer' => 'Повідомте нас за 30 днів до закінчення договору.'],
        ]);
        $this->setJson($m, $p, 'faq', 'items', 2, [
            ['question' => 'How to contact a realtor?', 'answer' => 'Call us, email us or fill out the form. Response within 30 minutes.'],
            ['question' => 'What if my booking is cancelled?', 'answer' => 'Full refund within 3–5 business days.'],
            ['question' => 'How to determine rental value?', 'answer' => 'Free market analysis based on location, condition, and demand.'],
            ['question' => 'Can I insure my apartment?', 'answer' => 'Yes, insurance packages from $10/month.'],
            ['question' => 'How does lease extension work?', 'answer' => 'Notify us 30 days before the contract ends.'],
        ]);
        $this->setJson($m, $p, 'faq', 'items', 3, [
            ['question' => 'Wie kontaktiere ich einen Makler?', 'answer' => 'Anrufen, E-Mail senden oder Formular ausfüllen. Antwort innerhalb von 30 Minuten.'],
            ['question' => 'Was bei Stornierung?', 'answer' => 'Vollständige Rückerstattung innerhalb von 3–5 Werktagen.'],
            ['question' => 'Wie bestimme ich den Mietwert?', 'answer' => 'Kostenlose Marktanalyse basierend auf Lage, Zustand und Nachfrage.'],
            ['question' => 'Kann ich die Wohnung versichern?', 'answer' => 'Ja, Versicherungspakete ab 10 $/Monat.'],
            ['question' => 'Wie funktioniert die Verlängerung?', 'answer' => '30 Tage vor Vertragsende benachrichtigen.'],
        ]);
        $this->setJson($m, $p, 'faq', 'items', 4, [
            ['question' => 'Как связаться с риелтором?', 'answer' => 'Позвоните, напишите на email или заполните форму. Ответ в течение 30 минут.'],
            ['question' => 'Что при отмене бронирования?', 'answer' => 'Полный возврат в течение 3–5 рабочих дней.'],
            ['question' => 'Как определить арендную стоимость?', 'answer' => 'Бесплатный анализ рынка по расположению, состоянию и спросу.'],
            ['question' => 'Можно ли застраховать квартиру?', 'answer' => 'Да, страховые пакеты от $10/месяц.'],
            ['question' => 'Как продлить аренду?', 'answer' => 'Уведомите за 30 дней до окончания договора.'],
        ]);
    }

    // ============================================================
    //  FOOTER
    // ============================================================
    private function seedFooter($m) {
        $p = 'footer';

        // --- logo ---
        $m->setValue($p, 'logo', 'image', 'image', 'catalog/svg/logo-footer.svg', 0);

        // --- contacts ---
        $this->setT($m, $p, 'contacts', 'address_street', [
            1 => 'пл. Ринок, 10/4', 2 => '10/4 Market Square St.',
            3 => 'Marktplatz 10/4', 4 => 'пл. Рынок, 10/4',
        ]);
        $this->setT($m, $p, 'contacts', 'address_city', [
            1 => 'Івано-Франківськ', 2 => 'Ivano-Frankivsk',
            3 => 'Iwano-Frankiwsk', 4 => 'Ивано-Франковск',
        ]);
        $this->setT($m, $p, 'contacts', 'phone_office_label', [
            1 => 'офіс:', 2 => 'office:', 3 => 'Büro:', 4 => 'офис:',
        ]);
        $m->setValue($p, 'contacts', 'phone_office', 'text', '+38 (0342) 501-303', 0);
        $this->setT($m, $p, 'contacts', 'phone_mobile_label', [
            1 => 'моб.:', 2 => 'mobile:', 3 => 'Mobil:', 4 => 'моб.:',
        ]);
        $m->setValue($p, 'contacts', 'phone_mobile', 'text', '+38 (067) 343-80-74', 0);

        // --- about_links ---
        $this->setJson($m, $p, 'about_links', 'items', 1, [
            ['text' => 'Про нас', 'href' => '#'], ['text' => 'Наші ріелтори', 'href' => '#'],
            ['text' => 'Зв\'яжіться з нами', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'about_links', 'items', 2, [
            ['text' => 'About Us', 'href' => '#'], ['text' => 'Our Realtors', 'href' => '#'],
            ['text' => 'Contact Us', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'about_links', 'items', 3, [
            ['text' => 'Über uns', 'href' => '#'], ['text' => 'Unsere Makler', 'href' => '#'],
            ['text' => 'Kontaktieren Sie uns', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'about_links', 'items', 4, [
            ['text' => 'О нас', 'href' => '#'], ['text' => 'Наши риелторы', 'href' => '#'],
            ['text' => 'Свяжитесь с нами', 'href' => '#'],
        ]);

        // --- social ---
        $this->setJson($m, $p, 'social', 'items', 0, [
            ['platform' => 'youtube', 'icon' => 'catalog/svg/social/youtube.svg', 'url' => '#'],
            ['platform' => 'facebook', 'icon' => 'catalog/svg/social/facebook.svg', 'url' => '#'],
            ['platform' => 'instagram', 'icon' => 'catalog/svg/social/instagram.svg', 'url' => '#'],
            ['platform' => 'twitter', 'icon' => 'catalog/svg/social/twitter.svg', 'url' => '#'],
            ['platform' => 'tiktok', 'icon' => 'catalog/svg/social/tiktok.svg', 'url' => '#'],
        ]);

        // --- nav ---
        $this->setT($m, $p, 'nav', 'title', [
            1 => 'Навігація', 2 => 'Navigation', 3 => 'Navigation', 4 => 'Навигация',
        ]);
        $navItems = [
            1 => [['text'=>'Квартири','href'=>'#','column'=>'1'],['text'=>'Особняки','href'=>'#','column'=>'1'],['text'=>'Офіси','href'=>'#','column'=>'1'],['text'=>'Комерційна нерухомість','href'=>'#','column'=>'1'],['text'=>'Гаражі','href'=>'#','column'=>'1'],['text'=>'Земельні ділянки','href'=>'#','column'=>'1'],['text'=>'Елітна нерухомість','href'=>'#','column'=>'2'],['text'=>'Нерухомість у Карпатах','href'=>'#','column'=>'2'],['text'=>'Ексклюзиви','href'=>'#','column'=>'2'],['text'=>'Інвестиційні проекти','href'=>'#','column'=>'2']],
            2 => [['text'=>'Flats','href'=>'#','column'=>'1'],['text'=>'Mansions','href'=>'#','column'=>'1'],['text'=>'Offices','href'=>'#','column'=>'1'],['text'=>'Commercial Properties','href'=>'#','column'=>'1'],['text'=>'Garages','href'=>'#','column'=>'1'],['text'=>'Land','href'=>'#','column'=>'1'],['text'=>'Luxury Real Estate','href'=>'#','column'=>'2'],['text'=>'Carpathian Real Estate','href'=>'#','column'=>'2'],['text'=>'Exclusives','href'=>'#','column'=>'2'],['text'=>'Investment Projects','href'=>'#','column'=>'2']],
            3 => [['text'=>'Wohnungen','href'=>'#','column'=>'1'],['text'=>'Villen','href'=>'#','column'=>'1'],['text'=>'Büros','href'=>'#','column'=>'1'],['text'=>'Gewerbeimmobilien','href'=>'#','column'=>'1'],['text'=>'Garagen','href'=>'#','column'=>'1'],['text'=>'Grundstücke','href'=>'#','column'=>'1'],['text'=>'Luxusimmobilien','href'=>'#','column'=>'2'],['text'=>'Karpaten-Immobilien','href'=>'#','column'=>'2'],['text'=>'Exklusiv','href'=>'#','column'=>'2'],['text'=>'Investitionsprojekte','href'=>'#','column'=>'2']],
            4 => [['text'=>'Квартиры','href'=>'#','column'=>'1'],['text'=>'Особняки','href'=>'#','column'=>'1'],['text'=>'Офисы','href'=>'#','column'=>'1'],['text'=>'Коммерческая недвижимость','href'=>'#','column'=>'1'],['text'=>'Гаражи','href'=>'#','column'=>'1'],['text'=>'Земельные участки','href'=>'#','column'=>'1'],['text'=>'Элитная недвижимость','href'=>'#','column'=>'2'],['text'=>'Недвижимость в Карпатах','href'=>'#','column'=>'2'],['text'=>'Эксклюзивы','href'=>'#','column'=>'2'],['text'=>'Инвестиционные проекты','href'=>'#','column'=>'2']],
        ];
        foreach ($navItems as $lang => $items) { $this->setJson($m, $p, 'nav', 'items', $lang, $items); }

        // --- listing_left ---
        $this->setT($m, $p, 'listing_left', 'title', [
            1 => 'Форма лістингу', 2 => 'Listing Form', 3 => 'Auflistungsformular', 4 => 'Форма листинга',
        ]);
        $listLeft = [
            1 => [['text'=>'Квартири в новобудовах','href'=>'#','column'=>'1'],['text'=>'Однокімнатні квартири','href'=>'#','column'=>'1'],['text'=>'Двокімнатні квартири','href'=>'#','column'=>'1'],['text'=>'Трикімнатні квартири','href'=>'#','column'=>'1'],['text'=>'Вторинний ринок','href'=>'#','column'=>'2'],['text'=>'Оренда квартир','href'=>'#','column'=>'2'],['text'=>'Оренда особняків','href'=>'#','column'=>'2'],['text'=>'Подобова оренда','href'=>'#','column'=>'2']],
            2 => [['text'=>'New buildings','href'=>'#','column'=>'1'],['text'=>'One-room','href'=>'#','column'=>'1'],['text'=>'Two-room','href'=>'#','column'=>'1'],['text'=>'Three-room','href'=>'#','column'=>'1'],['text'=>'Secondary market','href'=>'#','column'=>'2'],['text'=>'Apartment rentals','href'=>'#','column'=>'2'],['text'=>'Mansion rentals','href'=>'#','column'=>'2'],['text'=>'Daily rentals','href'=>'#','column'=>'2']],
            3 => [['text'=>'Neubauwohnungen','href'=>'#','column'=>'1'],['text'=>'Einzimmerwohnungen','href'=>'#','column'=>'1'],['text'=>'Zweizimmerwohnungen','href'=>'#','column'=>'1'],['text'=>'Dreizimmerwohnungen','href'=>'#','column'=>'1'],['text'=>'Sekundärmarkt','href'=>'#','column'=>'2'],['text'=>'Wohnungsvermietung','href'=>'#','column'=>'2'],['text'=>'Villenvermietung','href'=>'#','column'=>'2'],['text'=>'Tagesmiete','href'=>'#','column'=>'2']],
            4 => [['text'=>'Новостройки','href'=>'#','column'=>'1'],['text'=>'Однокомнатные','href'=>'#','column'=>'1'],['text'=>'Двухкомнатные','href'=>'#','column'=>'1'],['text'=>'Трёхкомнатные','href'=>'#','column'=>'1'],['text'=>'Вторичный рынок','href'=>'#','column'=>'2'],['text'=>'Аренда квартир','href'=>'#','column'=>'2'],['text'=>'Аренда особняков','href'=>'#','column'=>'2'],['text'=>'Посуточная аренда','href'=>'#','column'=>'2']],
        ];
        foreach ($listLeft as $lang => $items) { $this->setJson($m, $p, 'listing_left', 'items', $lang, $items); }

        // --- listing_right ---
        $this->setT($m, $p, 'listing_right', 'title', [
            1 => 'Форма лістингу', 2 => 'Listing Form', 3 => 'Auflistungsformular', 4 => 'Форма листинга',
        ]);
        foreach ($listLeft as $lang => $items) { $this->setJson($m, $p, 'listing_right', 'items', $lang, $items); }

        // --- partners (footer logos — multi-logo block) ---
        $this->setJson($m, $p, 'partners', 'items', 0, [
            ['image' => 'images/b1.png', 'alt' => 'R White', 'href' => '#'],
            ['image' => 'images/b2.png', 'alt' => 'Київміськбуд', 'href' => '#'],
            ['image' => 'images/b3.png', 'alt' => 'RP Realtor', 'href' => '#'],
            ['image' => 'images/b4.png', 'alt' => 'DOM.RIA', 'href' => '#'],
            ['image' => 'images/b5.png', 'alt' => 'OLX Нерухомість', 'href' => '#'],
        ]);

        // --- bottom ---
        $this->setJson($m, $p, 'bottom', 'links', 1, [
            ['text' => 'Умови та положення', 'href' => '#'], ['text' => 'Політика конфіденційності', 'href' => '#'],
            ['text' => 'Допомога', 'href' => '#'], ['text' => 'FAQ', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'bottom', 'links', 2, [
            ['text' => 'Terms & Conditions', 'href' => '#'], ['text' => 'Privacy Policy', 'href' => '#'],
            ['text' => 'Help', 'href' => '#'], ['text' => 'FAQ', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'bottom', 'links', 3, [
            ['text' => 'AGB', 'href' => '#'], ['text' => 'Datenschutz', 'href' => '#'],
            ['text' => 'Hilfe', 'href' => '#'], ['text' => 'FAQ', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'bottom', 'links', 4, [
            ['text' => 'Условия', 'href' => '#'], ['text' => 'Конфиденциальность', 'href' => '#'],
            ['text' => 'Помощь', 'href' => '#'], ['text' => 'FAQ', 'href' => '#'],
        ]);
        $this->setT($m, $p, 'bottom', 'copyright', [
            1 => '© 2006-2025 Всі права захищені', 2 => '© 2006-2025 All rights reserved',
            3 => '© 2006-2025 Alle Rechte vorbehalten', 4 => '© 2006-2025 Все права защищены',
        ]);
    }

    // ============================================================
    //  Helpers
    // ============================================================
    private function setT($m, $page, $section, $key, $values) {
        foreach ($values as $langId => $value) {
            $m->setValue($page, $section, $key, 'text', $value, $langId);
        }
    }

    private function setGlobal($m, $page, $section, $key, $type, $value) {
        $m->setValue($page, $section, $key, $type, $value, 0);
    }

    private function setJson($m, $page, $section, $key, $langId, $data) {
        $m->setValue($page, $section, $key, 'json', json_encode($data, JSON_UNESCAPED_UNICODE), $langId);
    }
}
