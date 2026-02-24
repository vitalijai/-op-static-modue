<?php
/**
 * Сидер статического контента.
 * Заполняет oc_static_content данными из шаблонов на 4 языка.
 *
 * Языки: 1=UK, 2=EN, 3=DE, 4=RU
 *
 * Вызов: Admin → extension/module/static_content/seed
 */
class ControllerExtensionModuleStaticContentSeeder extends Controller {

    public function index() {
        $this->load->model('extension/module/static_content');
        $m = $this->model_extension_module_static_content;

        // Очистка старых данных
        $this->db->query("TRUNCATE TABLE `" . DB_PREFIX . "static_content`");

        $this->seedHeader($m);
        $this->seedHome($m);
        $this->seedFooter($m);

        $this->session->data['success'] = 'Static content seeded successfully! (4 languages)';
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
            ['text' => 'Квартири',                    'href' => '#'],
            ['text' => 'Особняки',                    'href' => '#'],
            ['text' => 'Офіси',                       'href' => '#'],
            ['text' => 'Комерційна нерухомість',      'href' => '#'],
            ['text' => 'Гаражі',                      'href' => '#'],
            ['text' => 'Земельні ділянки',             'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_real_estate', 'items', 2, [
            ['text' => 'Flats',                       'href' => '#'],
            ['text' => 'Mansions',                    'href' => '#'],
            ['text' => 'Offices',                     'href' => '#'],
            ['text' => 'Commercial Real Estate',      'href' => '#'],
            ['text' => 'Garages',                     'href' => '#'],
            ['text' => 'Land',                        'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_real_estate', 'items', 3, [
            ['text' => 'Wohnungen',                   'href' => '#'],
            ['text' => 'Villen',                      'href' => '#'],
            ['text' => 'Büros',                       'href' => '#'],
            ['text' => 'Gewerbeimmobilien',           'href' => '#'],
            ['text' => 'Garagen',                     'href' => '#'],
            ['text' => 'Grundstücke',                 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_real_estate', 'items', 4, [
            ['text' => 'Квартиры',                    'href' => '#'],
            ['text' => 'Особняки',                    'href' => '#'],
            ['text' => 'Офисы',                       'href' => '#'],
            ['text' => 'Коммерческая недвижимость',   'href' => '#'],
            ['text' => 'Гаражи',                      'href' => '#'],
            ['text' => 'Земельные участки',            'href' => '#'],
        ]);

        // --- menu_about ---
        $this->setJson($m, $p, 'menu_about', 'items', 1, [
            ['text' => 'Відгуки',        'href' => '#'],
            ['text' => 'Партнери',       'href' => '#'],
            ['text' => 'Наші клієнти',   'href' => '#'],
            ['text' => 'Наші ріелтори',  'href' => '#'],
            ['text' => 'Вакансії',       'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_about', 'items', 2, [
            ['text' => 'Reviews',        'href' => '#'],
            ['text' => 'Partners',       'href' => '#'],
            ['text' => 'Our Customers',  'href' => '#'],
            ['text' => 'Our Realtors',   'href' => '#'],
            ['text' => 'Vacancies Jobs', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_about', 'items', 3, [
            ['text' => 'Bewertungen',     'href' => '#'],
            ['text' => 'Partner',         'href' => '#'],
            ['text' => 'Unsere Kunden',   'href' => '#'],
            ['text' => 'Unsere Makler',   'href' => '#'],
            ['text' => 'Stellenangebote', 'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_about', 'items', 4, [
            ['text' => 'Отзывы',          'href' => '#'],
            ['text' => 'Партнёры',        'href' => '#'],
            ['text' => 'Наши клиенты',    'href' => '#'],
            ['text' => 'Наши риелторы',   'href' => '#'],
            ['text' => 'Вакансии',        'href' => '#'],
        ]);

        // --- menu_services ---
        $this->setJson($m, $p, 'menu_services', 'items', 1, [
            ['text' => 'Продаж',                  'href' => '#'],
            ['text' => 'Оренда',                  'href' => '#'],
            ['text' => 'Подобова оренда',         'href' => '#'],
            ['text' => 'Інвестиційні проекти',    'href' => '#'],
            ['text' => 'Елітна нерухомість',      'href' => '#'],
            ['text' => 'Будівництво будинків',    'href' => '#'],
            ['text' => 'Бронювання готелів',      'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_services', 'items', 2, [
            ['text' => 'Selling',                 'href' => '#'],
            ['text' => 'Rent',                    'href' => '#'],
            ['text' => 'Daily Rent',              'href' => '#'],
            ['text' => 'Investment Projects',     'href' => '#'],
            ['text' => 'Luxury Real Estate',      'href' => '#'],
            ['text' => 'Construction of Houses',  'href' => '#'],
            ['text' => 'Hotel Booking',           'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_services', 'items', 3, [
            ['text' => 'Verkauf',                 'href' => '#'],
            ['text' => 'Miete',                   'href' => '#'],
            ['text' => 'Tagesmiete',              'href' => '#'],
            ['text' => 'Investitionsprojekte',    'href' => '#'],
            ['text' => 'Luxusimmobilien',         'href' => '#'],
            ['text' => 'Hausbau',                 'href' => '#'],
            ['text' => 'Hotelbuchung',            'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_services', 'items', 4, [
            ['text' => 'Продажа',                 'href' => '#'],
            ['text' => 'Аренда',                  'href' => '#'],
            ['text' => 'Посуточная аренда',       'href' => '#'],
            ['text' => 'Инвестиционные проекты',  'href' => '#'],
            ['text' => 'Элитная недвижимость',    'href' => '#'],
            ['text' => 'Строительство домов',     'href' => '#'],
            ['text' => 'Бронирование отелей',     'href' => '#'],
        ]);

        // --- menu_information ---
        $this->setJson($m, $p, 'menu_information', 'items', 1, [
            ['text' => 'Довідник', 'href' => '#'], ['text' => 'Погода', 'href' => '#'],
            ['text' => 'FAQ',      'href' => '#'], ['text' => 'Допомога','href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_information', 'items', 2, [
            ['text' => 'Directory','href' => '#'], ['text' => 'Weather', 'href' => '#'],
            ['text' => 'FAQ',      'href' => '#'], ['text' => 'Help',    'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_information', 'items', 3, [
            ['text' => 'Verzeichnis','href'=>'#'], ['text' => 'Wetter',  'href' => '#'],
            ['text' => 'FAQ',        'href'=>'#'], ['text' => 'Hilfe',   'href' => '#'],
        ]);
        $this->setJson($m, $p, 'menu_information', 'items', 4, [
            ['text' => 'Справочник','href' => '#'], ['text' => 'Погода', 'href' => '#'],
            ['text' => 'FAQ',       'href' => '#'], ['text' => 'Помощь', 'href' => '#'],
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

        $featureIcons = $this->getKeyFeatureIcons();

        $this->setJson($m, $p, 'key_features', 'items', 1, [
            ['icon' => $featureIcons[0], 'description' => 'Найбільша база продажу та оренди нерухомості'],
            ['icon' => $featureIcons[1], 'description' => 'Вигідні умови співпраці для продавців і покупців'],
            ['icon' => $featureIcons[2], 'description' => 'Консультаційна та юридична підтримка'],
            ['icon' => $featureIcons[3], 'description' => 'Кваліфікований персонал'],
        ]);
        $this->setJson($m, $p, 'key_features', 'items', 2, [
            ['icon' => $featureIcons[0], 'description' => 'The largest database of real estate sales and rentals'],
            ['icon' => $featureIcons[1], 'description' => 'Favourable terms of cooperation for sellers and buyers'],
            ['icon' => $featureIcons[2], 'description' => 'Consulting and legal support'],
            ['icon' => $featureIcons[3], 'description' => 'Qualified staff'],
        ]);
        $this->setJson($m, $p, 'key_features', 'items', 3, [
            ['icon' => $featureIcons[0], 'description' => 'Die größte Datenbank für Immobilienverkauf und -vermietung'],
            ['icon' => $featureIcons[1], 'description' => 'Günstige Kooperationsbedingungen für Verkäufer und Käufer'],
            ['icon' => $featureIcons[2], 'description' => 'Beratung und rechtliche Unterstützung'],
            ['icon' => $featureIcons[3], 'description' => 'Qualifiziertes Personal'],
        ]);
        $this->setJson($m, $p, 'key_features', 'items', 4, [
            ['icon' => $featureIcons[0], 'description' => 'Крупнейшая база продажи и аренды недвижимости'],
            ['icon' => $featureIcons[1], 'description' => 'Выгодные условия сотрудничества для продавцов и покупателей'],
            ['icon' => $featureIcons[2], 'description' => 'Консультационная и юридическая поддержка'],
            ['icon' => $featureIcons[3], 'description' => 'Квалифицированный персонал'],
        ]);

        // --- ads ---
        $this->setT($m, $p, 'ads', 'title', [
            1 => 'Місце для вашої реклами',
            2 => 'Place for your advertisement',
            3 => 'Platz für Ihre Werbung',
            4 => 'Место для вашей рекламы',
        ]);
        $this->setT($m, $p, 'ads', 'button_text', [
            1 => 'Забронювати',
            2 => 'Book Now',
            3 => 'Jetzt buchen',
            4 => 'Забронировать',
        ]);
        $m->setValue($p, 'ads', 'button_url', 'text', '#', 0);

        // --- choose_us ---
        $this->setT($m, $p, 'choose_us', 'title', [
            1 => 'Чому обирають нас?',
            2 => 'Why Choose Us?',
            3 => 'Warum uns wählen?',
            4 => 'Почему выбирают нас?',
        ]);

        $cuIcons = $this->getChooseUsIcons();

        $this->setJson($m, $p, 'choose_us', 'items', 1, [
            ['icon' => $cuIcons[0], 'title' => 'Максимальна безпека угоди', 'description' => 'Ми гарантуємо юридичну чистоту кожної угоди. Перевіряємо документи, супроводжуємо клієнта на всіх етапах і захищаємо від ризиків'],
            ['icon' => $cuIcons[1], 'title' => 'Велика база перевірених об\'єктів', 'description' => 'Доступ до ексклюзивних пропозицій ринку! Ми знаємо, де знайти ідеальну квартиру чи будинок під ваші вимоги'],
            ['icon' => $cuIcons[2], 'title' => 'Економія вашого часу', 'description' => 'Ми беремо на себе всі клопоти: підбір, перегляди, переговори та закриття угоди. Вам залишається лише забрати ключі від ідеального дому!'],
        ]);
        $this->setJson($m, $p, 'choose_us', 'items', 2, [
            ['icon' => $cuIcons[0], 'title' => 'Maximum transaction security', 'description' => 'We guarantee the legal purity of each transaction. We check documents, accompany the client at all stages and protect against risks'],
            ['icon' => $cuIcons[1], 'title' => 'Large database of verified objects', 'description' => 'Access to exclusive market offers! We know where to find the perfect apartment or house for your requirements'],
            ['icon' => $cuIcons[2], 'title' => 'Saving your time', 'description' => 'We take care of all the hassle: selection, viewings, negotiations, and closing the deal. All you have to do is take the keys to your ideal home!'],
        ]);
        $this->setJson($m, $p, 'choose_us', 'items', 3, [
            ['icon' => $cuIcons[0], 'title' => 'Maximale Transaktionssicherheit', 'description' => 'Wir garantieren die rechtliche Sauberkeit jeder Transaktion. Wir prüfen Dokumente, begleiten den Kunden in allen Phasen und schützen vor Risiken'],
            ['icon' => $cuIcons[1], 'title' => 'Große Datenbank geprüfter Objekte', 'description' => 'Zugang zu exklusiven Marktangeboten! Wir wissen, wo die perfekte Wohnung oder das perfekte Haus für Ihre Anforderungen zu finden ist'],
            ['icon' => $cuIcons[2], 'title' => 'Zeitersparnis', 'description' => 'Wir kümmern uns um alles: Auswahl, Besichtigungen, Verhandlungen und Geschäftsabschluss. Sie müssen nur noch die Schlüssel zu Ihrem Traumhaus abholen!'],
        ]);
        $this->setJson($m, $p, 'choose_us', 'items', 4, [
            ['icon' => $cuIcons[0], 'title' => 'Максимальная безопасность сделки', 'description' => 'Мы гарантируем юридическую чистоту каждой сделки. Проверяем документы, сопровождаем клиента на всех этапах и защищаем от рисков'],
            ['icon' => $cuIcons[1], 'title' => 'Большая база проверенных объектов', 'description' => 'Доступ к эксклюзивным предложениям рынка! Мы знаем, где найти идеальную квартиру или дом под ваши требования'],
            ['icon' => $cuIcons[2], 'title' => 'Экономия вашего времени', 'description' => 'Мы берём на себя все хлопоты: подбор, просмотры, переговоры и закрытие сделки. Вам остаётся лишь забрать ключи от идеального дома!'],
        ]);

        // --- achievements ---
        $this->setT($m, $p, 'achievements', 'title', [
            1 => 'Досягнення компанії',
            2 => 'Company Achievements',
            3 => 'Unternehmensleistungen',
            4 => 'Достижения компании',
        ]);
        $this->setT($m, $p, 'achievements', 'desc', [
            1 => 'Наша компанія не просто займається нерухомістю — ми створюємо безклопітні, вигідні та комфортні угоди, змінюючи ринок на краще. За роки роботи ми досягли значних результатів:',
            2 => 'Our company doesn\'t just deal with real estate - we create hassle-free, profitable and comfortable deals, changing the market for the better. Over the years of work, we have achieved significant results:',
            3 => 'Unser Unternehmen handelt nicht nur mit Immobilien — wir schaffen unkomplizierte, profitable und komfortable Geschäfte und verändern den Markt zum Besseren. Im Laufe der Jahre haben wir bedeutende Ergebnisse erzielt:',
            4 => 'Наша компания не просто занимается недвижимостью — мы создаём беспроблемные, выгодные и комфортные сделки, меняя рынок к лучшему. За годы работы мы достигли значительных результатов:',
        ]);

        $this->setJson($m, $p, 'achievements', 'items', 1, [
            ['value' => '19', 'suffix' => '',  'label' => 'років досвіду роботи',     'description' => 'Ми працюємо для вас з 2006 року, пропонуючи лише найкращі рішення у сфері нерухомості'],
            ['value' => '10108','suffix' => '', 'label' => 'успішних угод',             'description' => 'Успішні угоди — це не просто число, а сотні задоволених клієнтів, які знайшли своє ідеальне житло'],
            ['value' => '2453', 'suffix' => '', 'label' => 'ексклюзивних об\'єктів',    'description' => 'Ми пропонуємо нерухомість, яку ви не знайдете у відкритому доступі'],
            ['value' => '80',   'suffix' => '%','label' => 'нових клієнтів',            'description' => 'Більшість наших клієнтів — це ті, хто прийшов за рекомендацією друзів, колег чи партнерів'],
        ]);
        $this->setJson($m, $p, 'achievements', 'items', 2, [
            ['value' => '19', 'suffix' => '',  'label' => 'years of work experience',  'description' => 'We have been working for you since 2006, offering only the best real estate solutions'],
            ['value' => '10108','suffix' => '', 'label' => 'successful deals',          'description' => 'Successful deals are not just a number, but hundreds of satisfied clients who found their perfect home'],
            ['value' => '2453', 'suffix' => '', 'label' => 'exclusive objects',         'description' => 'We offer real estate that you will not find in the public domain'],
            ['value' => '80',   'suffix' => '%','label' => 'new customers',             'description' => 'Most of our clients are those who came on the recommendation of friends, colleagues or partners'],
        ]);
        $this->setJson($m, $p, 'achievements', 'items', 3, [
            ['value' => '19', 'suffix' => '',  'label' => 'Jahre Berufserfahrung',      'description' => 'Seit 2006 arbeiten wir für Sie und bieten nur die besten Immobilienlösungen'],
            ['value' => '10108','suffix' => '', 'label' => 'erfolgreiche Geschäfte',     'description' => 'Erfolgreiche Geschäfte sind nicht nur eine Zahl, sondern Hunderte zufriedener Kunden, die ihr perfektes Zuhause gefunden haben'],
            ['value' => '2453', 'suffix' => '', 'label' => 'exklusive Objekte',          'description' => 'Wir bieten Immobilien, die Sie nicht öffentlich finden werden'],
            ['value' => '80',   'suffix' => '%','label' => 'Neukunden',                  'description' => 'Die meisten unserer Kunden kommen auf Empfehlung von Freunden, Kollegen oder Partnern'],
        ]);
        $this->setJson($m, $p, 'achievements', 'items', 4, [
            ['value' => '19', 'suffix' => '',  'label' => 'лет опыта работы',           'description' => 'Мы работаем для вас с 2006 года, предлагая только лучшие решения в сфере недвижимости'],
            ['value' => '10108','suffix' => '', 'label' => 'успешных сделок',            'description' => 'Успешные сделки — это не просто число, а сотни довольных клиентов, нашедших своё идеальное жильё'],
            ['value' => '2453', 'suffix' => '', 'label' => 'эксклюзивных объектов',      'description' => 'Мы предлагаем недвижимость, которую вы не найдёте в открытом доступе'],
            ['value' => '80',   'suffix' => '%','label' => 'новых клиентов',              'description' => 'Большинство наших клиентов пришли по рекомендации друзей, коллег или партнёров'],
        ]);

        // --- agency ---
        $this->setT($m, $p, 'agency', 'title', [
            1 => 'Агенція нерухомості «РІЕЛТОР»',
            2 => 'Real Estate Agency "REALTOR"',
            3 => 'Immobilienagentur „REALTOR"',
            4 => 'Агентство недвижимости «РИЕЛТОР»',
        ]);
        $this->setT($m, $p, 'agency', 'text', [
            1 => '<p>• інформаційні послуги у напрямку продажу та оренди, включаючи подобову, обміну, купівлі житлової нерухомості — квартир, особняків, житлових будинків, котеджів</p><p>• первинний та вторинний ринки; комерційна нерухомість</p><p>• гіпермаркети, торговельні центри, магазини, мінімаркети, ресторани, кафе, бари, офіси, розважальні заклади тощо; промислова нерухомість</p><p>• цілісні майнові комплекси, готовий бізнес, окремі цехи, склади, агропромислові комплекси тощо; земельні ділянки</p><p>Малі та великі інвестиційні проекти. Експертна оцінка. Супровід при складанні договору купівлі-продажу, оформленні кредиту тощо. Комісію нам сплачують власники нерухомості за ексклюзивними договорами. Для покупців ми маємо варіанти на будь-який смак і цінову категорію — Велика база нерухомості ведеться з 2006 року.</p>',
            2 => '<p>• information services in the direction of sale and rental, including daily, exchange, purchase of residential real estate - apartments, mansions, residential buildings, cottages</p><p>• primary and secondary markets; commercial real estate</p><p>• hypermarkets, shopping centers, shops, minimarkets, restaurants, cafes, bars, offices, entertainment venues, etc.; industrial real estate</p><p>• integral property complexes, ready-made businesses, separate workshops, warehouses, agro-industrial complexes, etc.; land plots</p><p>Small and large investment projects. Expert assessment. Support in drawing up a purchase and sale agreement, drawing up a loan, etc. The commission is paid to us by property owners under exclusive agreements. For buyers, we have options for every taste and price range — The large real estate database has been maintained since 2006.</p>',
            3 => '<p>• Informationsdienstleistungen im Bereich Verkauf und Vermietung, einschließlich täglicher Vermietung, Tausch, Kauf von Wohnimmobilien — Wohnungen, Villen, Wohnhäuser, Cottages</p><p>• Primär- und Sekundärmarkt; Gewerbeimmobilien</p><p>• Hypermärkte, Einkaufszentren, Geschäfte, Minimärkte, Restaurants, Cafés, Bars, Büros, Unterhaltungsstätten usw.; Industrieimmobilien</p><p>• Integrale Eigentumskomplexe, fertige Geschäfte, separate Werkstätten, Lagerhäuser, Agrarkomplexe usw.; Grundstücke</p><p>Kleine und große Investitionsprojekte. Expertenbewertung. Unterstützung bei der Erstellung eines Kaufvertrags, Kreditbearbeitung usw. Die Provision wird uns von Immobilieneigentümern im Rahmen exklusiver Vereinbarungen gezahlt. Für Käufer haben wir Optionen für jeden Geschmack und jede Preisklasse — Die große Immobiliendatenbank wird seit 2006 gepflegt.</p>',
            4 => '<p>• информационные услуги в направлении продажи и аренды, включая посуточную, обмена, покупки жилой недвижимости — квартир, особняков, жилых домов, коттеджей</p><p>• первичный и вторичный рынки; коммерческая недвижимость</p><p>• гипермаркеты, торговые центры, магазины, мини-маркеты, рестораны, кафе, бары, офисы, развлекательные заведения и т.д.; промышленная недвижимость</p><p>• целостные имущественные комплексы, готовый бизнес, отдельные цеха, склады, агропромышленные комплексы и т.д.; земельные участки</p><p>Малые и крупные инвестиционные проекты. Экспертная оценка. Сопровождение при составлении договора купли-продажи, оформлении кредита и т.д. Комиссию нам оплачивают собственники недвижимости по эксклюзивным договорам. Для покупателей у нас есть варианты на любой вкус и ценовую категорию — Большая база недвижимости ведётся с 2006 года.</p>',
        ]);

        // --- partners ---
        $this->setT($m, $p, 'partners', 'title', [
            1 => 'Наші партнери',
            2 => 'Our Partners',
            3 => 'Unsere Partner',
            4 => 'Наши партнёры',
        ]);
        // partners items — untranslatable (images)
        $this->setJson($m, $p, 'partners', 'items', 0, [
            ['image' => 'catalog/partners/luxury.png',  'name' => 'Luxury Real Estate', 'href' => '#'],
            ['image' => 'catalog/partners/novobud.png', 'name' => 'Novobud',            'href' => '#'],
            ['image' => 'catalog/partners/partner3.png','name' => 'Partner 3',           'href' => '#'],
            ['image' => 'catalog/partners/partner4.png','name' => 'Partner 4',           'href' => '#'],
        ]);

        // --- customers ---
        $this->setT($m, $p, 'customers', 'title', [
            1 => 'Наші цінні клієнти',
            2 => 'Our Valued Customers',
            3 => 'Unsere geschätzten Kunden',
            4 => 'Наши ценные клиенты',
        ]);
        $this->setT($m, $p, 'customers', 'desc', [
            1 => 'Ми мали честь працювати з різноманітними клієнтами з різних галузей. Ось деякі з клієнтів, яких ми мали задоволення обслуговувати:',
            2 => 'We have had the honor of working with a variety of clients from various industries. Here are some of the clients we have had the pleasure of serving:',
            3 => 'Wir hatten die Ehre, mit einer Vielzahl von Kunden aus verschiedenen Branchen zusammenzuarbeiten. Hier sind einige der Kunden, die wir bedienen durften:',
            4 => 'Мы имели честь работать с разнообразными клиентами из различных отраслей. Вот некоторые из клиентов, которых нам довелось обслуживать:',
        ]);
        // customers items — untranslatable (logos/svgs)
        $this->setJson($m, $p, 'customers', 'items', 0, [
            ['image' => 'catalog/customers/raiffeisen.svg', 'name' => 'Raiffeisen Bank', 'href' => '#'],
            ['image' => 'catalog/customers/privatbank.svg', 'name' => 'PrivatBank',      'href' => '#'],
            ['image' => 'catalog/customers/client3.svg',    'name' => 'Client 3',        'href' => '#'],
            ['image' => 'catalog/customers/client4.svg',    'name' => 'Client 4',        'href' => '#'],
        ]);

        // --- faq ---
        $this->setT($m, $p, 'faq', 'title', [
            1 => 'Загальні питання',
            2 => 'General Questions',
            3 => 'Allgemeine Fragen',
            4 => 'Общие вопросы',
        ]);
        $this->setT($m, $p, 'faq', 'desc', [
            1 => 'Тут ви знайдете найпоширеніші запитання про нашу агенцію. Якщо ви не знайшли те, що шукали, можливо, ваше запитання є на сторінці FAQ або ви можете задати його там.',
            2 => 'Here you will find the most frequently asked questions about our agency. If you did not find what you were looking for, perhaps your question will be found on the FAQ page or you can ask your question there.',
            3 => 'Hier finden Sie die am häufigsten gestellten Fragen zu unserer Agentur. Wenn Sie nicht fündig geworden sind, finden Sie Ihre Frage vielleicht auf der FAQ-Seite oder können sie dort stellen.',
            4 => 'Здесь вы найдёте самые часто задаваемые вопросы о нашем агентстве. Если вы не нашли то, что искали, возможно, ваш вопрос есть на странице FAQ или вы можете задать его там.',
        ]);

        $this->setJson($m, $p, 'faq', 'items', 1, [
            ['question' => 'Як зв\'язатися з ріелтором?',                                 'answer' => 'Ви можете зателефонувати нам, написати на email або заповнити форму зворотного зв\'язку на сайті. Наші спеціалісти зв\'яжуться з вами протягом 30 хвилин.'],
            ['question' => 'Що станеться, якщо моє бронювання буде скасоване?',             'answer' => 'Ви отримаєте повне повернення коштів протягом 3–5 робочих днів.'],
            ['question' => 'Як визначити орендну вартість моєї нерухомості?',                'answer' => 'Ми проводимо безкоштовний аналіз ринку на основі розташування, стану та попиту.'],
            ['question' => 'Чи можу я застрахувати квартиру від шкоди, заподіяної орендою?',  'answer' => 'Так, ми пропонуємо страхові пакети від $10/місяць.'],
            ['question' => 'Як працює процедура продовження оренди?',                        'answer' => 'Вам потрібно повідомити нас за 30 днів до закінчення договору.'],
        ]);
        $this->setJson($m, $p, 'faq', 'items', 2, [
            ['question' => 'How can I contact a realtor?',                                  'answer' => 'You can call us, email us or fill out the contact form on the website. Our specialists will contact you within 30 minutes.'],
            ['question' => 'What happens if my booking is cancelled?',                       'answer' => 'You will receive a full refund within 3–5 business days.'],
            ['question' => 'How do I determine the rental value of my property?',            'answer' => 'We conduct a free market analysis based on location, condition, and demand.'],
            ['question' => 'Can I insure my apartment against damage caused by rent?',       'answer' => 'Yes, we offer insurance packages starting at $10/month.'],
            ['question' => 'How does the lease extension procedure work?',                   'answer' => 'You need to notify us 30 days before the end of the contract.'],
        ]);
        $this->setJson($m, $p, 'faq', 'items', 3, [
            ['question' => 'Wie kann ich einen Makler kontaktieren?',                        'answer' => 'Sie können uns anrufen, eine E-Mail senden oder das Kontaktformular auf der Website ausfüllen. Unsere Spezialisten werden sich innerhalb von 30 Minuten bei Ihnen melden.'],
            ['question' => 'Was passiert, wenn meine Buchung storniert wird?',               'answer' => 'Sie erhalten eine vollständige Rückerstattung innerhalb von 3–5 Werktagen.'],
            ['question' => 'Wie bestimme ich den Mietwert meiner Immobilie?',                'answer' => 'Wir führen eine kostenlose Marktanalyse basierend auf Lage, Zustand und Nachfrage durch.'],
            ['question' => 'Kann ich meine Wohnung gegen Mietschäden versichern?',           'answer' => 'Ja, wir bieten Versicherungspakete ab 10 $/Monat an.'],
            ['question' => 'Wie funktioniert die Mietverlängerung?',                         'answer' => 'Sie müssen uns 30 Tage vor Vertragsende benachrichtigen.'],
        ]);
        $this->setJson($m, $p, 'faq', 'items', 4, [
            ['question' => 'Как связаться с риелтором?',                                     'answer' => 'Вы можете позвонить нам, написать на email или заполнить форму обратной связи на сайте. Наши специалисты свяжутся с вами в течение 30 минут.'],
            ['question' => 'Что произойдёт, если моё бронирование будет отменено?',            'answer' => 'Вы получите полный возврат средств в течение 3–5 рабочих дней.'],
            ['question' => 'Как определить арендную стоимость моей недвижимости?',              'answer' => 'Мы проводим бесплатный анализ рынка на основе расположения, состояния и спроса.'],
            ['question' => 'Могу ли я застраховать квартиру от ущерба, причинённого арендой?',  'answer' => 'Да, мы предлагаем страховые пакеты от $10/месяц.'],
            ['question' => 'Как работает процедура продления аренды?',                          'answer' => 'Вам необходимо уведомить нас за 30 дней до окончания договора.'],
        ]);
    }

    // ============================================================
    //  FOOTER
    // ============================================================
    private function seedFooter($m) {
        $p = 'footer';

        // --- contacts ---
        $this->setT($m, $p, 'contacts', 'address_street', [
            1 => 'пл. Ринок, 10/4',
            2 => '10/4 Market Square St.',
            3 => 'Marktplatz 10/4',
            4 => 'пл. Рынок, 10/4',
        ]);
        $this->setT($m, $p, 'contacts', 'address_city', [
            1 => 'Івано-Франківськ',
            2 => 'Ivano-Frankivsk',
            3 => 'Iwano-Frankiwsk',
            4 => 'Ивано-Франковск',
        ]);
        $m->setValue($p, 'contacts', 'phone_office', 'text', '+38 (0342) 501-303', 0);
        $m->setValue($p, 'contacts', 'phone_mobile', 'text', '+38 (067) 343-80-74', 0);

        // --- about_links ---
        $this->setJson($m, $p, 'about_links', 'items', 1, [
            ['text' => 'Про нас',        'href' => '#'],
            ['text' => 'Наші ріелтори',  'href' => '#'],
            ['text' => 'Зв\'яжіться з нами','href' => '#'],
        ]);
        $this->setJson($m, $p, 'about_links', 'items', 2, [
            ['text' => 'About Us',       'href' => '#'],
            ['text' => 'Our Realtors',   'href' => '#'],
            ['text' => 'Contact Us',     'href' => '#'],
        ]);
        $this->setJson($m, $p, 'about_links', 'items', 3, [
            ['text' => 'Über uns',        'href' => '#'],
            ['text' => 'Unsere Makler',   'href' => '#'],
            ['text' => 'Kontaktieren Sie uns','href' => '#'],
        ]);
        $this->setJson($m, $p, 'about_links', 'items', 4, [
            ['text' => 'О нас',           'href' => '#'],
            ['text' => 'Наши риелторы',   'href' => '#'],
            ['text' => 'Свяжитесь с нами','href' => '#'],
        ]);

        // --- social ---
        $this->setJson($m, $p, 'social', 'items', 0, [
            ['platform' => 'youtube',   'url' => '#'],
            ['platform' => 'facebook',  'url' => '#'],
            ['platform' => 'instagram', 'url' => '#'],
            ['platform' => 'twitter',   'url' => '#'],
            ['platform' => 'tiktok',    'url' => '#'],
        ]);

        // --- nav ---
        $this->setT($m, $p, 'nav', 'title', [
            1 => 'Навігація', 2 => 'Navigation', 3 => 'Navigation', 4 => 'Навигация',
        ]);
        $this->setJson($m, $p, 'nav', 'items', 1, [
            ['text' => 'Квартири', 'href' => '#', 'column' => '1'],
            ['text' => 'Особняки', 'href' => '#', 'column' => '1'],
            ['text' => 'Офіси',    'href' => '#', 'column' => '1'],
            ['text' => 'Комерційна нерухомість','href'=>'#','column'=>'1'],
            ['text' => 'Гаражі',  'href' => '#', 'column' => '1'],
            ['text' => 'Земельні ділянки','href'=>'#','column'=>'1'],
            ['text' => 'Елітна нерухомість','href'=>'#','column'=>'2'],
            ['text' => 'Нерухомість у Карпатах','href'=>'#','column'=>'2'],
            ['text' => 'Ексклюзиви','href' => '#','column'=>'2'],
            ['text' => 'Інвестиційні проекти','href'=>'#','column'=>'2'],
        ]);
        $this->setJson($m, $p, 'nav', 'items', 2, [
            ['text'=>'Flats','href'=>'#','column'=>'1'],['text'=>'Mansions','href'=>'#','column'=>'1'],
            ['text'=>'Offices','href'=>'#','column'=>'1'],['text'=>'Commercial Properties','href'=>'#','column'=>'1'],
            ['text'=>'Garages','href'=>'#','column'=>'1'],['text'=>'Land','href'=>'#','column'=>'1'],
            ['text'=>'Luxury Real Estate','href'=>'#','column'=>'2'],['text'=>'Real Estate in the Carpathians','href'=>'#','column'=>'2'],
            ['text'=>'Exclusives','href'=>'#','column'=>'2'],['text'=>'Investment Projects','href'=>'#','column'=>'2'],
        ]);
        $this->setJson($m, $p, 'nav', 'items', 3, [
            ['text'=>'Wohnungen','href'=>'#','column'=>'1'],['text'=>'Villen','href'=>'#','column'=>'1'],
            ['text'=>'Büros','href'=>'#','column'=>'1'],['text'=>'Gewerbeimmobilien','href'=>'#','column'=>'1'],
            ['text'=>'Garagen','href'=>'#','column'=>'1'],['text'=>'Grundstücke','href'=>'#','column'=>'1'],
            ['text'=>'Luxusimmobilien','href'=>'#','column'=>'2'],['text'=>'Immobilien in den Karpaten','href'=>'#','column'=>'2'],
            ['text'=>'Exklusiv','href'=>'#','column'=>'2'],['text'=>'Investitionsprojekte','href'=>'#','column'=>'2'],
        ]);
        $this->setJson($m, $p, 'nav', 'items', 4, [
            ['text'=>'Квартиры','href'=>'#','column'=>'1'],['text'=>'Особняки','href'=>'#','column'=>'1'],
            ['text'=>'Офисы','href'=>'#','column'=>'1'],['text'=>'Коммерческая недвижимость','href'=>'#','column'=>'1'],
            ['text'=>'Гаражи','href'=>'#','column'=>'1'],['text'=>'Земельные участки','href'=>'#','column'=>'1'],
            ['text'=>'Элитная недвижимость','href'=>'#','column'=>'2'],['text'=>'Недвижимость в Карпатах','href'=>'#','column'=>'2'],
            ['text'=>'Эксклюзивы','href'=>'#','column'=>'2'],['text'=>'Инвестиционные проекты','href'=>'#','column'=>'2'],
        ]);

        // --- listing_left ---
        $this->setT($m, $p, 'listing_left', 'title', [
            1 => 'Форма лістингу', 2 => 'Listing Form', 3 => 'Auflistungsformular', 4 => 'Форма листинга',
        ]);
        $this->setJson($m, $p, 'listing_left', 'items', 1, [
            ['text'=>'Квартири в новобудовах','href'=>'#','column'=>'1'],['text'=>'Однокімнатні квартири','href'=>'#','column'=>'1'],
            ['text'=>'Двокімнатні квартири','href'=>'#','column'=>'1'],['text'=>'Трикімнатні квартири','href'=>'#','column'=>'1'],
            ['text'=>'Вторинний ринок','href'=>'#','column'=>'2'],['text'=>'Оренда квартир','href'=>'#','column'=>'2'],
            ['text'=>'Оренда особняків','href'=>'#','column'=>'2'],['text'=>'Подобова оренда','href'=>'#','column'=>'2'],
            ['text'=>'Будинки з ремонтом','href'=>'#','column'=>'2'],['text'=>'Будинки без ремонту','href'=>'#','column'=>'2'],
        ]);
        $this->setJson($m, $p, 'listing_left', 'items', 2, [
            ['text'=>'Apartments in new buildings','href'=>'#','column'=>'1'],['text'=>'One-room apartments','href'=>'#','column'=>'1'],
            ['text'=>'Two-room apartments','href'=>'#','column'=>'1'],['text'=>'Three-room apartments','href'=>'#','column'=>'1'],
            ['text'=>'Secondary market','href'=>'#','column'=>'2'],['text'=>'Apartment rentals','href'=>'#','column'=>'2'],
            ['text'=>'Mansions rentals','href'=>'#','column'=>'2'],['text'=>'Daily rentals','href'=>'#','column'=>'2'],
            ['text'=>'Houses with renovation','href'=>'#','column'=>'2'],['text'=>'Raw houses','href'=>'#','column'=>'2'],
        ]);
        $this->setJson($m, $p, 'listing_left', 'items', 3, [
            ['text'=>'Neubauwohnungen','href'=>'#','column'=>'1'],['text'=>'Einzimmerwohnungen','href'=>'#','column'=>'1'],
            ['text'=>'Zweizimmerwohnungen','href'=>'#','column'=>'1'],['text'=>'Dreizimmerwohnungen','href'=>'#','column'=>'1'],
            ['text'=>'Sekundärmarkt','href'=>'#','column'=>'2'],['text'=>'Wohnungsvermietung','href'=>'#','column'=>'2'],
            ['text'=>'Villenvermietung','href'=>'#','column'=>'2'],['text'=>'Tagesmiete','href'=>'#','column'=>'2'],
            ['text'=>'Häuser mit Renovierung','href'=>'#','column'=>'2'],['text'=>'Rohbauhäuser','href'=>'#','column'=>'2'],
        ]);
        $this->setJson($m, $p, 'listing_left', 'items', 4, [
            ['text'=>'Квартиры в новостройках','href'=>'#','column'=>'1'],['text'=>'Однокомнатные квартиры','href'=>'#','column'=>'1'],
            ['text'=>'Двухкомнатные квартиры','href'=>'#','column'=>'1'],['text'=>'Трёхкомнатные квартиры','href'=>'#','column'=>'1'],
            ['text'=>'Вторичный рынок','href'=>'#','column'=>'2'],['text'=>'Аренда квартир','href'=>'#','column'=>'2'],
            ['text'=>'Аренда особняков','href'=>'#','column'=>'2'],['text'=>'Посуточная аренда','href'=>'#','column'=>'2'],
            ['text'=>'Дома с ремонтом','href'=>'#','column'=>'2'],['text'=>'Дома без ремонта','href'=>'#','column'=>'2'],
        ]);

        // --- listing_right ---
        $this->setT($m, $p, 'listing_right', 'title', [
            1 => 'Форма лістингу', 2 => 'Listing Form', 3 => 'Auflistungsformular', 4 => 'Форма листинга',
        ]);
        $this->setJson($m, $p, 'listing_right', 'items', 1, [
            ['text'=>'Квартири в новобудовах','href'=>'#','column'=>'1'],['text'=>'Однокімнатні квартири','href'=>'#','column'=>'1'],
            ['text'=>'Двокімнатні квартири','href'=>'#','column'=>'1'],['text'=>'Трикімнатні квартири','href'=>'#','column'=>'1'],
            ['text'=>'Вторинний ринок','href'=>'#','column'=>'2'],['text'=>'Оренда квартир','href'=>'#','column'=>'2'],
            ['text'=>'Оренда особняків','href'=>'#','column'=>'2'],['text'=>'Подобова оренда','href'=>'#','column'=>'2'],
        ]);
        $this->setJson($m, $p, 'listing_right', 'items', 2, [
            ['text'=>'Apartments in new buildings','href'=>'#','column'=>'1'],['text'=>'One-room apartments','href'=>'#','column'=>'1'],
            ['text'=>'Two-room apartments','href'=>'#','column'=>'1'],['text'=>'Three-room apartments','href'=>'#','column'=>'1'],
            ['text'=>'Secondary market','href'=>'#','column'=>'2'],['text'=>'Apartment rentals','href'=>'#','column'=>'2'],
            ['text'=>'Mansions rentals','href'=>'#','column'=>'2'],['text'=>'Daily rentals','href'=>'#','column'=>'2'],
        ]);
        $this->setJson($m, $p, 'listing_right', 'items', 3, [
            ['text'=>'Neubauwohnungen','href'=>'#','column'=>'1'],['text'=>'Einzimmerwohnungen','href'=>'#','column'=>'1'],
            ['text'=>'Zweizimmerwohnungen','href'=>'#','column'=>'1'],['text'=>'Dreizimmerwohnungen','href'=>'#','column'=>'1'],
            ['text'=>'Sekundärmarkt','href'=>'#','column'=>'2'],['text'=>'Wohnungsvermietung','href'=>'#','column'=>'2'],
            ['text'=>'Villenvermietung','href'=>'#','column'=>'2'],['text'=>'Tagesmiete','href'=>'#','column'=>'2'],
        ]);
        $this->setJson($m, $p, 'listing_right', 'items', 4, [
            ['text'=>'Квартиры в новостройках','href'=>'#','column'=>'1'],['text'=>'Однокомнатные квартиры','href'=>'#','column'=>'1'],
            ['text'=>'Двухкомнатные квартиры','href'=>'#','column'=>'1'],['text'=>'Трёхкомнатные квартиры','href'=>'#','column'=>'1'],
            ['text'=>'Вторичный рынок','href'=>'#','column'=>'2'],['text'=>'Аренда квартир','href'=>'#','column'=>'2'],
            ['text'=>'Аренда особняков','href'=>'#','column'=>'2'],['text'=>'Посуточная аренда','href'=>'#','column'=>'2'],
        ]);

        // --- partners (footer logos) ---
        $this->setJson($m, $p, 'partners', 'items', 0, [
            ['image' => 'catalog/partners/b1.png', 'alt' => 'Partner 1', 'href' => '#'],
            ['image' => 'catalog/partners/b2.png', 'alt' => 'Partner 2', 'href' => '#'],
            ['image' => 'catalog/partners/b3.png', 'alt' => 'Partner 3', 'href' => '#'],
            ['image' => 'catalog/partners/b4.png', 'alt' => 'Partner 4', 'href' => '#'],
            ['image' => 'catalog/partners/b5.png', 'alt' => 'Partner 5', 'href' => '#'],
        ]);

        // --- bottom ---
        $this->setJson($m, $p, 'bottom', 'links', 1, [
            ['text' => 'Умови та положення',  'href' => '#'],
            ['text' => 'Політика конфіденційності','href' => '#'],
            ['text' => 'Допомога',             'href' => '#'],
            ['text' => 'FAQ',                  'href' => '#'],
            ['text' => 'Корисна інформація',   'href' => '#'],
        ]);
        $this->setJson($m, $p, 'bottom', 'links', 2, [
            ['text' => 'Terms and Conditions', 'href' => '#'],
            ['text' => 'Privacy Policy',       'href' => '#'],
            ['text' => 'Help',                 'href' => '#'],
            ['text' => 'FAQ',                  'href' => '#'],
            ['text' => 'Useful Information',   'href' => '#'],
        ]);
        $this->setJson($m, $p, 'bottom', 'links', 3, [
            ['text' => 'Allgemeine Geschäftsbedingungen','href' => '#'],
            ['text' => 'Datenschutzrichtlinie','href' => '#'],
            ['text' => 'Hilfe',                'href' => '#'],
            ['text' => 'FAQ',                  'href' => '#'],
            ['text' => 'Nützliche Informationen','href' => '#'],
        ]);
        $this->setJson($m, $p, 'bottom', 'links', 4, [
            ['text' => 'Условия и положения',  'href' => '#'],
            ['text' => 'Политика конфиденциальности','href' => '#'],
            ['text' => 'Помощь',               'href' => '#'],
            ['text' => 'FAQ',                  'href' => '#'],
            ['text' => 'Полезная информация',  'href' => '#'],
        ]);

        $this->setT($m, $p, 'bottom', 'copyright', [
            1 => '© 2006-2025 Всі права на матеріали захищені',
            2 => '© 2006-2025 All rights on the materials',
            3 => '© 2006-2025 Alle Rechte an den Materialien vorbehalten',
            4 => '© 2006-2025 Все права на материалы защищены',
        ]);
    }

    // ============================================================
    //  SVG Icons (extracted from templates)
    // ============================================================
    private function getKeyFeatureIcons() {
        return [
            // 1: Building icon
            '<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 52 52" fill="none"><path d="M47.8044 42.2262V37.9864C48.7724 37.7318 49.4916 36.8568 49.4916 35.81V28.7255C49.4916 27.48 48.479 26.4669 47.2336 26.4669C45.9882 26.4669 44.975 27.48 44.975 28.7255V35.81C44.975 36.8568 45.6948 37.7318 46.6628 37.9864V42.2262H43.2381V14.7162H35.7381V8.57349H16.2031V14.7162H8.70359V42.2268H5.2789V37.987C6.24694 37.7324 6.9667 36.8574 6.9667 35.8106V28.7255C6.9667 27.48 5.95356 26.4669 4.70812 26.4669C3.46267 26.4669 2.44954 27.48 2.44954 28.7255V35.81C2.44954 36.8568 3.16929 37.7318 4.13734 37.9864V42.2262H0.285706V43.3677H51.656V42.2262H47.8044Z" fill="#593DFF"/></svg>',
            // 2: Handshake icon
            '<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 52 52" fill="none"><path d="M39.3197 31.0497L44.765 27.959L40.2084 13.2471C36.5366 11.5673 30.6227 10.4765 25.2734 10.6831C20.1421 10.6831 12.6214 19.5828 13.739 23.0012C15.5906 24.4686 18.456 24.669 22.1461 20.7432C23.3944 20.8659 25.2974 20.0365 26.2939 19.3527L29.1712 21.4572L39.3197 31.0497Z" fill="#593DFF"/><path d="M0.285715 10.0844V27.5166H4.94843L9.88226 11.5861C6.28348 10.8104 3.16531 10.3224 0.285715 10.0844Z" fill="#593DFF"/><path d="M42.0578 11.5861L46.9922 27.5166H51.656V10.0844C48.7764 10.3224 45.6577 10.8104 42.0578 11.5861Z" fill="#593DFF"/><path d="M38.9773 33.8745L27.7049 23.218L26.1267 22.0645C25.2585 22.4771 24.194 22.8624 23.1387 22.9948C17.8361 28.1245 13.8326 25.9949 12.3178 24.7939L11.5638 23.7123C10.7207 21.1341 12.3868 18.0507 13.9325 15.9177C14.7048 14.8526 15.6295 13.7881 16.6466 12.8047H11.8686L7.41648 27.1787C15.166 36.2689 22.9457 44.4442 27.7626 40.6371L28.2506 41.1314C29.1992 42.0909 30.7603 42.1006 31.7198 41.1531C32.6793 40.2056 32.689 38.6434 31.7415 37.6839L33.2141 39.1748C34.1627 40.1343 35.7238 40.144 36.6833 39.1965C37.6428 38.2484 37.6525 36.6867 36.705 35.7273L36.8551 35.8945C37.8037 36.854 39.5138 37.0035 40.4739 36.056C41.3426 35.1976 41.4248 33.8425 40.7313 32.8802L38.9773 33.8745Z" fill="#593DFF"/></svg>',
            // 3: Chat check icon
            '<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 52 52" fill="none"><path d="M50.2976 5.10486H20.9999C20.2494 5.10486 19.6415 5.71331 19.6415 6.46332V15.69H30.9418C33.5794 15.69 35.725 17.8356 35.725 20.4731V27.5503H39.8426L46.6942 34.2746V27.5508H50.2976C51.0481 27.5508 51.656 26.9424 51.656 26.1924V6.46332C51.656 5.71331 51.0476 5.10486 50.2976 5.10486Z" fill="#593DFF"/><path d="M30.8436 19.1146H1.54599C0.795412 19.1146 0.187531 19.7231 0.187531 20.4731V40.2016C0.187531 40.9521 0.795983 41.56 1.54599 41.56H5.14933V48.2844L12.001 41.56H30.8436C31.5942 41.56 32.2021 40.9516 32.2021 40.2016V20.4737C32.2021 19.7231 31.5942 19.1146 30.8436 19.1146ZM13.9987 35.8785L9.53636 30.077L10.88 29.0445L14.1774 33.3311L23.3881 24.3002L24.5747 25.5108L13.9987 35.8785Z" fill="#593DFF"/></svg>',
            // 4: Team star icon
            '<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 52 52" fill="none"><path d="M20.3463 12.4759C20.4822 12.6083 20.5444 12.799 20.5119 12.9862L19.4839 18.9783C19.4028 19.4492 19.8977 19.8082 20.3207 19.5861L25.702 16.7568C25.8698 16.6683 26.0707 16.6683 26.2385 16.7568L31.6198 19.5861C32.0428 19.8087 32.5371 19.4492 32.4566 18.9783L31.4286 12.9862C31.3967 12.799 31.4583 12.6083 31.5942 12.4759L35.9481 8.23216C36.2905 7.89883 36.1016 7.3172 35.6284 7.24871L29.6124 6.37427C29.4246 6.34687 29.2625 6.22929 29.1786 6.05863L26.4879 0.606527C26.2762 0.17787 25.6655 0.17787 25.4537 0.606527L22.763 6.05863C22.6791 6.22872 22.5165 6.34687 22.3292 6.37427L16.3126 7.24871C15.84 7.3172 15.6511 7.89883 15.993 8.23216L20.3463 12.4759Z" fill="#593DFF"/><path d="M31.2848 31.0748V28.6318C31.2848 25.6969 28.9058 23.3179 25.9708 23.3179C23.0359 23.3179 20.6569 25.6969 20.6569 28.6318V31.0748C20.6569 34.0097 23.0359 36.3888 25.9708 36.3888C28.9058 36.3888 31.2848 34.0097 31.2848 31.0748Z" fill="#593DFF"/><path d="M25.9709 36.3888C20.7756 36.3888 16.5644 40.6 16.5644 45.7953V47.0732L25.9709 51.6561L35.3773 47.0727V45.7947C35.3773 40.6 31.1661 36.3888 25.9709 36.3888Z" fill="#593DFF"/><path d="M51.3677 39.2815C50.5977 34.8614 46.7513 31.4983 42.1114 31.4978C45.0458 31.4978 47.4248 29.1188 47.4248 26.1838V23.7409C47.4248 20.8059 45.0458 18.4269 42.1108 18.4269C39.1758 18.4269 36.7968 20.8059 36.7968 23.7409V26.1838C36.7968 29.1182 39.1758 31.4978 42.1102 31.4978C38.3311 31.4978 35.0816 33.7318 33.5862 36.9464C36.0754 39.092 37.6593 42.2593 37.6593 45.7953V45.9608L51.3677 39.2815Z" fill="#593DFF"/><path d="M18.3549 36.9464C16.8595 33.7318 13.61 31.4983 9.83087 31.4978C12.7653 31.4978 15.1443 29.1188 15.1443 26.1838V23.7409C15.1443 20.8059 12.7653 18.4269 9.8303 18.4269C6.89534 18.4269 4.51632 20.8059 4.51632 23.7409V26.1838C4.51632 29.1182 6.89534 31.4978 9.82973 31.4978C5.18927 31.4978 1.34335 34.8614 0.573364 39.2815L14.2812 45.9608V45.7953C14.2818 42.2593 15.8657 39.0914 18.3549 36.9464Z" fill="#593DFF"/></svg>',
        ];
    }

    private function getChooseUsIcons() {
        return [
            // 1: Dollar shield
            '<svg xmlns="http://www.w3.org/2000/svg" width="56" height="52" viewBox="0 0 56 52" fill="none"><path d="M19.1989 0.202515C14.1662 0.893013 9.61161 3.24336 6.05291 7.00126C-1.83467 15.3005-2.03385 28.2473 5.57487 36.9184C8.04472 39.7335 11.5105 42.0174 15.0957 43.2125C17.7249 44.0889 18.9333 44.2748 22.0538 44.2881C25.5328 44.2881 27.0997 44.0225 30.1538 42.8805L31.2161 42.4822L31.1763 36.3474C31.1365 32.0716 31.1763 30.0665 31.2825 29.708C31.4817 29.0573 32.1457 28.3004 32.8096 28.0083C33.1017 27.8755 33.8852 27.7029 34.5358 27.6232C37.3908 27.278 39.688 26.3617 42.6624 24.423L44.3356 22.8694C44.4285 21.7805 44.216 19.2177 43.8974 17.7305C41.5205 6.32404 30.6717-1.36438 19.1989 0.202515Z" fill="white"/><path d="M43.2334 26.9059C40.5245 28.6056 37.9617 29.6015 35.3326 29.9733L33.6993 30.3185L33.5665 36.0417C33.6329 42.2827 33.6329 42.3491 34.6022 44.2878C35.7575 46.6249 38.2273 48.8955 41.5337 50.6616C43.2069 51.5513 44.5746 52.0825 44.9464 51.9895C45.6103 51.8169 48.7972 50.2234 49.7666 49.5595C52.17 47.9395 53.8299 46.1336 54.8523 44.0222C55.5295 42.628 55.6623 42.0039 55.8482 39.5738C56.0076 37.3696 56.0209 30.677 55.8615 30.4248L54.1087 29.9998C51.3467 29.6015 48.7441 28.579 46.0485 26.8262L44.7206 26.0295L43.2334 26.9059ZM50.4703 34.2225C50.643 34.4748 50.643 34.581 50.5102 34.8466C50.1251 35.5636 43.9505 44.3542 43.7778 44.4206C43.3396 44.5932 43.3662 44.6331 39.9536 40.1183L38.9842 38.6709C38.9842 38.3655 39.6216 37.8476 39.9934 37.8476C40.2457 37.8476 40.83 38.2061 41.9188 39.0427L43.5388 40.2378L46.3539 37.0509C48.6777 34.3686 49.3549 33.6382 49.5674 33.5984L49.9259 33.7577C50.1118 33.8374 50.3641 34.0499 50.4703 34.2225Z" fill="white"/></svg>',
            // 2: House database
            '<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 52 52" fill="none"><path d="M6.05311 4.50923C4.7328 4.69204 3.29061 5.68735 2.66093 6.82485C2.11249 7.84048 2.01093 8.47017 2.01093 11.3342V13.9545H25.9797H49.9484V11.3342C49.9484 8.47017 49.8672 7.86079 49.2984 6.82485C48.9125 6.11392 47.9172 5.19985 47.1656 4.87485L45.8656 4.48892C45.0328 4.36704 7.0078 4.36704 6.05311 4.50923Z" fill="white"/><path d="M2.03125 29.8592C2.03125 41.3967 2.05156 43.367 2.19375 43.9154C2.68125 45.8248 4.14375 47.1654 6.07344 47.4701C7.08906 47.6326 44.8906 47.6326 45.9062 47.4701C47.8156 47.1654 49.2984 45.8045 49.8062 43.9357L49.9688 29.8389V16.4326H26H2.03125V29.8592ZM31.7078 28.2748L37.375 33.9217L35.6688 35.6279L33.2313 36.6232V39.7311V42.8389H30.8141H28.3969V39.2436V35.6482H26H23.6438V39.2436V42.8389H21.2266H18.7891V39.7311V36.6029L18.0578 37.3342L16.3516 35.6279L14.625 33.9217L20.2719 28.2748C23.3797 25.167 25.9594 22.6076 25.9797 22.6076C26 22.6076 28.6 25.167 31.7078 28.2748Z" fill="white"/></svg>',
            // 3: Clock hand
            '<svg xmlns="http://www.w3.org/2000/svg" width="49" height="52" viewBox="0 0 49 52" fill="none"><path d="M24.3942 0.0543251C18.5681 0.767307 13.9235 4.8313 12.5179 10.4639C12.3244 11.2685 12.2429 11.8796 12.2022 13.1019C12.1207 15.3733 12.3957 17.0539 13.1596 18.8974C14.9522 23.2364 18.8533 26.3735 23.4876 27.2189C24.7405 27.443 26.9711 27.443 28.2443 27.2087C32.5527 26.4245 36.3519 23.5216 38.226 19.5798C39.1427 17.6548 39.5094 15.9844 39.5094 13.7028C39.5094 11.9102 39.3871 11.075 38.8881 9.47587C37.4417 4.85168 33.3064 1.1951 28.4683 0.258034C27.2766 0.0237675 25.4229-0.0679016 24.3942 0.0543251ZM27.3479 9.11938V12.175H30.4036H33.4592V13.7028V15.2307H28.8758H24.2923V10.6472V6.06374H25.8201H27.3479V9.11938Z" fill="white"/><path d="M42.5752 29.8874C41.1085 30.305 40.9761 30.417 36.1584 35.2144L31.6666 39.6756H23.396H15.1254V38.1478V36.62H22.0006H28.8758V36.3348C28.8758 36.182 28.8045 35.7338 28.723 35.3468C28.285 33.2791 26.7165 31.5374 24.6488 30.8346L23.834 30.5596L17.0606 30.5392L10.2873 30.5087L5.14366 34.919C2.3121 37.3431 0 39.3802 0 39.4515C0 39.6145 8.42337 51.9898 8.53541 52L10.9799 50.4213L13.3429 48.8425H22.9682H32.5935L40.1307 40.5821C44.2762 36.0394 47.8513 32.118 48.0754 31.8634L48.4726 31.3948L48.0244 31.0078C47.4846 30.5392 46.5373 30.0707 45.7123 29.8568C44.8873 29.6429 43.3697 29.6531 42.5752 29.8874Z" fill="white"/></svg>',
        ];
    }

    // ============================================================
    //  Хелперы
    // ============================================================

    /**
     * Установить translatable text для всех 4 языков.
     */
    private function setT($m, $page, $section, $key, $values) {
        foreach ($values as $langId => $value) {
            $m->setValue($page, $section, $key, 'text', $value, $langId);
        }
    }

    /**
     * Установить JSON-значение.
     */
    private function setJson($m, $page, $section, $key, $langId, $data) {
        $m->setValue($page, $section, $key, 'json', json_encode($data, JSON_UNESCAPED_UNICODE), $langId);
    }
}
