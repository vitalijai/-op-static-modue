# OpenCart Static Content Module (`op-static-modue`)

## Короткий опис

Модуль керування статичним контентом для OpenCart 3.x. Дозволяє редагувати весь текстовий, мультимедійний та повторювальний контент сайту без доступу до коду шаблонів.

- **Сайт:** Real Estate Agency "REALTOR" (нерухомість)
- **Мови:** 4 (UK, EN, DE, RU)
- **Сховище:** MySQL таблиця `oc_static_content` (page → section → key → language_id)
- **Формат:** JSON repeaters для складних структур (список питань, партнери, соцмережі тощо)

---

## Архітектура

### 1. **БД: одна таблиця `oc_static_content`**

```sql
CREATE TABLE oc_static_content (
    content_id INT,
    page VARCHAR(32),        -- 'header', 'home', 'footer'
    section VARCHAR(64),     -- 'logo', 'nav', 'faq', 'achievements', 'agency' тощо
    key VARCHAR(64),         -- 'title', 'image', 'items' тощо
    type VARCHAR(16),        -- 'text', 'textarea', 'wysiwyg', 'image', 'json'
    value MEDIUMTEXT,        -- сам контент
    language_id INT,         -- 0 = глобальний, 1-4 = мова
    sort_order INT,
    UNIQUE (page, section, key, language_id)
);
```

**Переваги:**
- Нема міграцій — усе в одній таблиці
- Легко додавати нові поля/секції (просто редактуй реєстр)
- Кешування per-page+language

### 2. **Адміністративна частина: Registry Pattern**

Файл: `admin/controller/extension/module/static_content.php`

Метод `getSectionRegistry()` повертає структуру всіх сторінок → секцій → полів:

```php
return [
    'header' => [
        'logo' => [
            'label' => 'Logo',
            'fields' => [
                'image' => ['type' => 'image', 'translatable' => false]
            ]
        ],
        'nav' => [
            'label' => 'Main Navigation',
            'fields' => [
                'items' => [
                    'type' => 'json',
                    'schema' => 'repeater',
                    'columns' => ['text', 'href'],
                ]
            ]
        ]
    ],
    'home' => [ ... ],
    'footer' => [ ... ]
];
```

**Типи полів:**
- `text` — однорядковий текст
- `textarea` — багаторядковий текст
- `wysiwyg` — редактор Summernote з HTML
- `image` — вибір файлу через OpenCart File Manager
- `json` + `schema: repeater` — таблиця з повторюваними рядками

**Repeater колонки:**
- `columns: ['field1', 'field2', ...]` — список полів в рядку
- `col_types: { field: 'textarea|text|image' }` — тип кожного поля (за замовч. `text`)

**Трансльованість:**
- `translatable: true` (за замовч.) — окреме значення на кожну мову
- `translatable: false` — глобальне значення (language_id=0)

---

## Реалізовані секції

### **HEADER** (8 секцій)

1. **logo** — SVG/PNG лого + text
2. **phone** — office + mobile (без переклада)
3. **nav** — основне меню (repeater: text, href)
4. **menu_real_estate** — підменю
5. **menu_about** — підменю
6. **menu_services** — підменю
7. **menu_information** — підменю
8. **menu_socials** — соцмережі (repeater: platform, icon, url)

### **HOME** (10 секцій)

1. **key_features** — 4 блоки з іконками (repeater: icon, description)
2. **ads** — banner (title, button_text, button_url)
3. **choose_us** — 3 блоки причин (repeater: icon, title, description)
4. **achievements** — 4 статистичні карточки (repeater: value, is_percent, label, description)
5. **agency** — інформація про агенцію (title, image, text з HTML)
6. **partners** — партнери/розробники (repeater: image, alt, href)
7. **customers** — бренди клієнтів (repeater: image, alt, href)
8. **reviews** — відгуки (ПРОПУЩЕНО — динамічні)
9. **contact_fab** — floating button (title, phone, href)
10. **faq** — часті питання (repeater: question, answer)

### **FOOTER** (9 секцій)

1. **logo** — лого
2. **contacts** — адреса, телефони (з переводами labels)
3. **about_links** — про нас, реалтори, контакти (repeater: text, href)
4. **social** — соцмережі (repeater: platform, icon, url)
5. **nav** — навігація (repeater: text, href, column)
6. **listing_left** — ліва колонка каталогу (repeater: text, href, column)
7. **listing_right** — права колонка (repeater: text, href, column)
8. **partners** — партнери (repeater: image, alt, href)
9. **bottom** — нижня смуга (repeater: text, href) + copyright

---

## Файлова структура

```
op-static-modue/
├── admin/
│   ├── controller/extension/module/
│   │   ├── static_content.php           # основний контролер (install, index, save)
│   │   └── static_content_seeder.php    # заповнення БД (сідер)
│   ├── model/extension/module/
│   │   └── static_content.php           # модель (CRUD, getPageData з кешем)
│   ├── language/
│   │   ├── en-gb/extension/module/static_content.php
│   │   └── uk-ua/extension/module/static_content.php
│   └── view/template/extension/module/
│       └── static_content.twig          # шаблон адмінки (форма + JS repeater)
├── catalog/
│   ├── controller/extension/module/
│   │   └── static_content.php           # фронтенд контролер (getPageData)
│   ├── model/extension/module/
│   │   └── static_content.php           # модель каталогу (getPageData з кешем)
│   └── svg/                             # іконки (50+ файлів)
│       ├── key-features/ (4 SVG)
│       ├── choose-us/ (3 SVG)
│       ├── partners/ (4 SVG)
│       ├── customers/ (4 SVG)
│       ├── social/ (5 SVG)
│       ├── ui/ (3 SVG)
│       └── logos/ (2 SVG)
├── image/catalog/svg/                   # те ж, але для публікації на сайті
├── system/
│   └── install_ocmod.xml                # OCMOD для меню в лівій панелі
├── install.sql                          # SQL для створення таблиці
├── USAGE.md                             # документація інтеграції
├── PROJECT.md                           # цей файл
├── footer.twig, header.twig, home.twig  # приклади шаблонів (посилання)
└── README.md
```

---

## Інтеграція в контролери

### Для сторінки `home`

```php
class ControllerCommonHome extends Controller {
    public function index() {
        // ... інший код ...

        // Завантажити контент
        $this->load->model('extension/module/static_content');
        $data['sh'] = $this->model_extension_module_static_content->getPageData('home');

        // Тепер у шаблоні доступні:
        // sh.key_features.title, sh.key_features.items
        // sh.faq.title, sh.faq.items
        // sh.achievements, sh.agency, тощо

        $this->response->setOutput($this->load->view('path/to/home', $data));
    }
}
```

### Для сторінки `footer`

```php
// В будь-якому базовому контролері
$this->load->model('extension/module/static_content');
$data['sf'] = $this->model_extension_module_static_content->getPageData('footer');
```

Тепер кожний шаблон може використовувати `{{ sf.logo.image }}`, `{{ sf.contacts.phone_office }}` тощо.

---

## Використання в шаблонах (Twig)

### Простий текст

```twig
{{ sh.key_features.title }}
```

### Картинка

```twig
{% if sh.logo.image %}
  <img src="image/{{ sh.logo.image }}" alt="Logo" />
{% endif %}
```

### SVG (inline, зі стилями)

```twig
{{ load_svg('image/catalog/svg/key-features/database.svg') }}
```

> **Важливо:** функція `load_svg()` мусить бути зареєстрована в Twig:
> У файлі `system/library/template/twig.php` після `$twig = new \Twig\Environment()`:
> ```php
> $twig->addFunction(new \Twig\TwigFunction('load_svg', function($path) {
>     $file = DIR_APPLICATION . '../' . $path;
>     return is_file($file) ? file_get_contents($file) : '';
> }, ['is_safe' => ['html']]));
> ```

### Repeater (FAQ)

```twig
{% set faq = sh.faq %}
{% if faq.items %}
  {% for item in faq.items %}
    <div class="faq-item">
      <h3>{{ item.question }}</h3>
      <p>{{ item.answer }}</p>
    </div>
  {% endfor %}
{% endif %}
```

### HTML контент (wysiwyg)

```twig
{{ ag.text|raw }}
```

---

## Сідер (заповнення БД)

Файл: `admin/controller/extension/module/static_content_seeder.php`

### Запуск сідера

1. Установи модуль (Admin → Extensions → Modules → Content Editor → Install ✓)
2. Перейди до редактора: Admin → Редактор контенту
3. Натисни синю кнопку `⟲` (Seed)

### Що робить сідер

- Заповнює **весь контент** всіх 27 секцій на **4 мовах**
- Вказує шляхи до SVG файлів (`catalog/svg/...`)
- Вказує шляхи до зображень (`catalog/logo-old.png`, тощо)
- Задає реальні дані для тестування

Сідер можна запускати багато разів — він перезаписує без дублювання.

---

## Ключові рішення й виправлення

### 1. **HTML Entity Encoding (Фікс 2026-02-25)**

**Проблема:** OC3 `Request::clean()` пропускає все через `htmlspecialchars()`, що переводить `"` → `&quot;`. При JSON repeaters це ламало парсинг.

**Рішення:** `html_entity_decode()` перед записом в БД.

```php
$value = html_entity_decode($value, ENT_QUOTES, 'UTF-8');
```

### 2. **Repeater Data Sync (Фікс 2026-02-25)**

**Проблема:** дані repeater-а не збирались перед submit.

**Рішення:** слухач на `submit` форми, що вимушує `collectFromDom()` для всіх repeater-ів.

```javascript
form.addEventListener('submit', function() {
  document.querySelectorAll('.repeater-container').forEach(...);
});
```

### 3. **Repeater JSON у `<script>` (не HTML атрибуті)**

**Проблема:** SVG іконки в `data-rows` атрибуті ламали HTML escaping.

**Рішення:** зберігати JSON у `<script type="application/json">` елементах.

```html
<div class="repeater-container" id="rep-home-faq-items-1"></div>
<script type="application/json" data-for="rep-home-faq-items-1">
[{"question":"...", "answer":"..."}]
</script>
```

### 4. **Image Manager Integration**

Всі `type: 'image'` поля використовують нативний OC3 `data-toggle="image"` pattern:
- Клік на мініатюру → File Manager
- Вибір файлу → оновлення мініатюри + hidden input
- Можна використовувати для SVG, PNG, JPG

---

## Ключові файли для редагування

Якщо потрібно **додати нову секцію** або **поле**:

1. **`admin/controller/extension/module/static_content.php`** — додай в `getSectionRegistry()`
2. **`admin/controller/extension/module/static_content_seeder.php`** — додай контент для всіх 4 мов
3. **Шаблон** (footer.twig, header.twig, home.twig) — додай Twig код

Нема міграцій! БД таблиця завжди готова приймати нові поля.

---

## Сумарна статистика

- **Таблиця:** 1 (`oc_static_content`)
- **Сторінок:** 3 (header, home, footer)
- **Секцій:** 27
- **Полів:** 70+
- **Мов:** 4 (UK, EN, DE, RU)
- **SVG файлів:** 25+
- **Типів полів:** 5 (text, textarea, wysiwyg, image, json)

---

## Посилання

- **GitHub:** https://github.com/vitalijai/-op-static-modue
- **Документація módule:** USAGE.md
- **SQL Schema:** install.sql
