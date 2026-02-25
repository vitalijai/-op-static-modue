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

        // --- nav ---
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

        // --- menu_socials (mobile menu social links) ---
        $this->setJson($m, $p, 'menu_socials', 'items', 0, [
            ['platform' => 'youtube', 'icon' => 'catalog/svg/social/youtube.svg', 'url' => '#'],
            ['platform' => 'facebook', 'icon' => 'catalog/svg/social/facebook.svg', 'url' => '#'],
            ['platform' => 'instagram', 'icon' => 'catalog/svg/social/instagram.svg', 'url' => '#'],
            ['platform' => 'twitter', 'icon' => 'catalog/svg/social/twitter.svg', 'url' => '#'],
            ['platform' => 'tiktok', 'icon' => 'catalog/svg/social/tiktok.svg', 'url' => '#'],
        ]);

        // --- logo ---
        $m->setValue($p, 'logo', 'image', 'image', 'catalog/svg/logo.svg', 0);

        // --- phone ---
        $m->setValue($p, 'phone', 'office', 'text', '+38 (0342) 501-303', 0);
        $m->setValue($p, 'phone', 'mobile', 'text', '+38 (067) 343-80-74', 0);

        // --- menu_information ---
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
    }

    // ============================================================
    //  HOME
    // ============================================================
    private function seedHome($m) {
        $p = 'home';

        // --- key_features ---
        $this->setT($m, $p, 'key_features', 'title', [
            1 => 'Агенція нерухомості «Ріелтор» — це',
            2 => 'Estate Agency "Realtor" Is This',
            3 => 'Immobilienagentur „Realtor" — das ist',
            4 => 'Агентство недвижимости «Риелтор» — это',
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

        // --- ads ---
        $this->setT($m, $p, 'ads', 'title', [
            1 => 'Місце для вашої реклами', 2 => 'Place for your advertisement',
            3 => 'Platz für Ihre Werbung', 4 => 'Место для вашей рекламы',
        ]);
        $this->setT($m, $p, 'ads', 'button_text', [
            1 => 'Забронювати', 2 => 'Book Now', 3 => 'Jetzt buchen', 4 => 'Забронировать',
        ]);
        $m->setValue($p, 'ads', 'button_url', 'text', '#', 0);

        // --- choose_us ---
        $this->setT($m, $p, 'choose_us', 'title', [
            1 => 'Чому обирають нас?', 2 => 'Why Choose Us?',
            3 => 'Warum uns wählen?', 4 => 'Почему выбирают нас?',
        ]);
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

        // --- agency ---
        $this->setT($m, $p, 'agency', 'title', [
            1 => 'Агенція нерухомості «РІЕЛТОР»', 2 => 'Real Estate Agency "REALTOR"',
            3 => 'Immobilienagentur „REALTOR"', 4 => 'Агентство недвижимости «РИЕЛТОР»',
        ]);
        $m->setValue($p, 'agency', 'image', 'image', 'catalog/logo/logo-old.png', 0);
        $this->setT($m, $p, 'agency', 'text', [
            1 => '<p>• інформаційні послуги у напрямку продажу та оренди, включаючи подобову, обміну, купівлі житлової нерухомості — квартир, особняків, житлових будинків, котеджів<br />• первинний та вторинний ринки; комерційна нерухомість<br />• гіпермаркети, торговельні центри, магазини, мінімаркети, ресторани, кафе, бари, офіси, розважальні заклади, оптові бази тощо; промислова нерухомість<br />• цілісні майнові комплекси, готовий бізнес, окремі цехи, склади, агропромислові комплекси тощо; земельні ділянки — під будівництво гіпермаркетів від 1 до 10 га, торговельних центрів, промислових підприємств, житлових багатоповерхових будинків, приватних будинків, котеджів.</p><br /><p>Малі та великі інвестиційні проекти. Експертна оцінка. Супровід при складанні договору купівлі-продажу, оформленні кредиту тощо. Комісію нам сплачують власники нерухомості за ексклюзивними договорами. Для покупців у нас є варіанти на будь-який смак і гаманець — Велика база нерухомості ведеться з 2006 року.</p><br /><p>Допоможемо власникам швидко та вигідно продати нерухомість, будь то квартира чи особняк, комерційна нерухомість чи земля. В агенції працюють два сертифіковані ріелтори та один сертифікований оцінювач. Агенція є членом Української асоціації фахівців з нерухомості та Національної асоціації ріелторів (НАР).</p>',
            2 => '<p>• information services in the direction of sale and rental, including daily, exchange, purchase of residential real estate - apartments, mansions, residential buildings, cottages<br />• primary and secondary markets; commercial real estate<br />• hypermarkets, shopping centers, shops, minimarkets, restaurants, cafes, bars, offices, entertainment venues, wholesale bases, etc.; industrial real estate<br />• integral property complexes, ready-made businesses, separate workshops, warehouses, agro-industrial complexes, etc.; land plots - for the construction of hypermarkets from 1 to 10 hectares, shopping centers, industrial enterprises, residential high-rise buildings, residential private houses, cottages.</p><br /><p>Small and large investment projects. Expert assessment. Support in drawing up a purchase and sale agreement, drawing up a loan, etc. The commission is paid to us by property owners under exclusive agreements. For buyers, we have options for every taste and price range - The large real estate database has been maintained since 2006.</p><br /><p>We will help owners quickly and profitably sell their real estate, whether it is an apartment or a mansion, commercial real estate or land. The agency employs two certified realtors and one certified appraiser. The agency is a member of the Ukrainian Association of Real Estate Professionals and the National Association of Realtors (NAR).</p>',
            3 => '<p>• Informationsdienste im Bereich Verkauf und Vermietung, einschließlich täglicher Vermietung, Tausch, Kauf von Wohnimmobilien — Wohnungen, Villen, Wohnhäuser, Cottages<br />• Primär- und Sekundärmarkt; Gewerbeimmobilien<br />• Hypermärkte, Einkaufszentren, Geschäfte, Minimärkte, Restaurants, Cafés, Bars, Büros, Unterhaltungsstätten, Großhandelslager usw.; Industrieimmobilien<br />• Eigentumskomplexe, fertige Geschäfte, einzelne Werkstätten, Lagerhäuser, Agrarkomplexe usw.; Grundstücke — für den Bau von Hypermärkten von 1 bis 10 Hektar, Einkaufszentren, Industrieunternehmen, Wohnhochhäuser, Privathäuser, Cottages.</p><br /><p>Kleine und große Investitionsprojekte. Expertenbewertung. Unterstützung bei Kauf- und Verkaufsverträgen, Kreditbearbeitung usw. Die Provision wird von Immobilieneigentümern im Rahmen exklusiver Vereinbarungen gezahlt. Große Immobiliendatenbank seit 2006.</p><br /><p>Wir helfen Eigentümern, ihre Immobilien schnell und profitabel zu verkaufen. Die Agentur beschäftigt zwei zertifizierte Makler und einen zertifizierten Gutachter. Mitglied der Ukrainischen Vereinigung der Immobilienfachleute und der Nationalen Vereinigung der Makler (NAR).</p>',
            4 => '<p>• информационные услуги в направлении продажи и аренды, включая посуточную, обмена, покупки жилой недвижимости — квартир, особняков, жилых домов, коттеджей<br />• первичный и вторичный рынки; коммерческая недвижимость<br />• гипермаркеты, торговые центры, магазины, минимаркеты, рестораны, кафе, бары, офисы, развлекательные заведения, оптовые базы и т.д.; промышленная недвижимость<br />• целостные имущественные комплексы, готовый бизнес, отдельные цеха, склады, агропромышленные комплексы и т.д.; земельные участки — под строительство гипермаркетов от 1 до 10 га, торговых центров, промышленных предприятий, жилых многоэтажных домов, частных домов, коттеджей.</p><br /><p>Малые и крупные инвестиционные проекты. Экспертная оценка. Сопровождение при составлении договора купли-продажи, оформлении кредита и т.д. Комиссию нам оплачивают собственники недвижимости по эксклюзивным договорам. Для покупателей у нас есть варианты на любой вкус и кошелёк — Большая база недвижимости ведётся с 2006 года.</p><br /><p>Поможем собственникам быстро и выгодно продать недвижимость, будь то квартира или особняк, коммерческая недвижимость или земля. В агентстве работают два сертифицированных риелтора и один сертифицированный оценщик. Агентство является членом Украинской ассоциации специалистов по недвижимости и Национальной ассоциации риелторов (НАР).</p>',
        ]);

        // --- partners ---
        $this->setT($m, $p, 'partners', 'title', [
            1 => 'Наші партнери', 2 => 'Our Partners', 3 => 'Unsere Partner', 4 => 'Наши партнёры',
        ]);
        // Top row — SVG logos (developers/builders)
        $this->setJson($m, $p, 'partners', 'logos', 0, [
            ['image' => 'catalog/svg/partners/partner-1.svg', 'name' => 'Місто для людей'],
            ['image' => 'catalog/svg/partners/partner-2.svg', 'name' => 'Doom Development'],
            ['image' => 'catalog/svg/partners/partner-3.svg', 'name' => 'iBud'],
            ['image' => 'catalog/svg/partners/partner-4.svg', 'name' => 'Partner 4'],
        ]);
        // Bottom row — PNG links (services)
        $this->setJson($m, $p, 'partners', 'items', 1, [
            ['image' => 'catalog/partners/luxury.png', 'name' => 'Елітна нерухомість', 'href' => '#'],
            ['image' => 'catalog/partners/carpathians.png', 'name' => 'Нерухомість у Карпатах', 'href' => '#'],
            ['image' => 'catalog/partners/exclusives.png', 'name' => 'Ексклюзиви', 'href' => '#'],
            ['image' => 'catalog/partners/investment.png', 'name' => 'Інвестиційні проекти', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'partners', 'items', 2, [
            ['image' => 'catalog/partners/luxury.png', 'name' => 'Luxury Real Estate', 'href' => '#'],
            ['image' => 'catalog/partners/carpathians.png', 'name' => 'Real Estate in the Carpathians', 'href' => '#'],
            ['image' => 'catalog/partners/exclusives.png', 'name' => 'Exclusives', 'href' => '#'],
            ['image' => 'catalog/partners/investment.png', 'name' => 'Investment Projects', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'partners', 'items', 3, [
            ['image' => 'catalog/partners/luxury.png', 'name' => 'Luxusimmobilien', 'href' => '#'],
            ['image' => 'catalog/partners/carpathians.png', 'name' => 'Karpaten-Immobilien', 'href' => '#'],
            ['image' => 'catalog/partners/exclusives.png', 'name' => 'Exklusiv', 'href' => '#'],
            ['image' => 'catalog/partners/investment.png', 'name' => 'Investitionsprojekte', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'partners', 'items', 4, [
            ['image' => 'catalog/partners/luxury.png', 'name' => 'Элитная недвижимость', 'href' => '#'],
            ['image' => 'catalog/partners/carpathians.png', 'name' => 'Недвижимость в Карпатах', 'href' => '#'],
            ['image' => 'catalog/partners/exclusives.png', 'name' => 'Эксклюзивы', 'href' => '#'],
            ['image' => 'catalog/partners/investment.png', 'name' => 'Инвестиционные проекты', 'href' => '#'],
        ]);

        // --- customers ---
        $this->setT($m, $p, 'customers', 'title', [
            1 => 'Наші цінні клієнти', 2 => 'Our Valued Customers',
            3 => 'Unsere geschätzten Kunden', 4 => 'Наши ценные клиенты',
        ]);
        $this->setT($m, $p, 'customers', 'desc', [
            1 => 'Ми мали честь працювати з різноманітними клієнтами з різних галузей.',
            2 => 'We have had the honor of working with a variety of clients from various industries.',
            3 => 'Wir hatten die Ehre, mit Kunden aus verschiedenen Branchen zusammenzuarbeiten.',
            4 => 'Мы имели честь работать с клиентами из различных отраслей.',
        ]);
        $this->setJson($m, $p, 'customers', 'items', 0, [
            ['image' => 'catalog/svg/customers/customer-1.svg', 'name' => 'Customer 1', 'href' => '#'],
            ['image' => 'catalog/svg/customers/customer-2.svg', 'name' => 'Customer 2', 'href' => '#'],
            ['image' => 'catalog/svg/customers/customer-3.svg', 'name' => 'Customer 3', 'href' => '#'],
            ['image' => 'catalog/svg/customers/customer-4.svg', 'name' => 'Customer 4', 'href' => '#'],
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

        // --- partners (footer logos) ---
        $this->setJson($m, $p, 'partners', 'items', 0, [
            ['image' => 'catalog/svg/partners/partner-1.svg', 'alt' => 'Partner 1', 'href' => '#'],
            ['image' => 'catalog/svg/partners/partner-2.svg', 'alt' => 'Partner 2', 'href' => '#'],
            ['image' => 'catalog/svg/partners/partner-3.svg', 'alt' => 'Partner 3', 'href' => '#'],
            ['image' => 'catalog/svg/partners/partner-4.svg', 'alt' => 'Partner 4', 'href' => '#'],
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

    private function setJson($m, $page, $section, $key, $langId, $data) {
        $m->setValue($page, $section, $key, 'json', json_encode($data, JSON_UNESCAPED_UNICODE), $langId);
    }
}
