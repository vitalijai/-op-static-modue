# Static Content Module — Usage Guide

## Установка

1. Скопировать файлы модуля в соответствующие директории OpenCart
2. Перейти в Admin → Extensions → Modules → Static Content → Install
3. Модуль создаст таблицу `oc_static_content`
4. Перейти на страницу модуля и заполнить контент

## Структура файлов

```
admin/
├── controller/extension/module/static_content.php
├── model/extension/module/static_content.php
├── language/en-gb/extension/module/static_content.php
├── language/uk-ua/extension/module/static_content.php
└── view/template/extension/module/static_content.twig

catalog/
├── controller/extension/module/static_content.php
└── model/extension/module/static_content.php
```

## Использование в контроллере (catalog)

### Подключение

```php
// В любом контроллере каталога
$this->load->model('extension/module/static_content');
$model = $this->model_extension_module_static_content;
```

### Получить всю страницу

```php
$data['static_home']   = $model->getPageData('home');
$data['static_header'] = $model->getPageData('header');
$data['static_footer'] = $model->getPageData('footer');
```

### Получить секцию

```php
$data['faq']       = $model->getSection('home', 'faq');
$data['contacts']  = $model->getSection('footer', 'contacts');
$data['features']  = $model->getSection('home', 'key_features');
```

### Получить конкретное значение

```php
$copyright = $model->getValue('footer', 'bottom', 'copyright');
```

## Использование в шаблонах (twig)

### Пример: FAQ

```twig
{% set faq = static_home.faq %}
{% if faq %}
<section class="questions">
  <h2 class="global-h">
    {{ faq.title }}
  </h2>
  <p>{{ faq.desc }}</p>
  <ul class="faq-list">
    {% for item in faq.items %}
    <li class="faq-item">
      <div class="faq-label">
        <span class="faq-question-text">{{ item.question }}</span>
      </div>
      <ul class="faq-answer-list">
        <li><div class="faq-answer-content"><p>{{ item.answer }}</p></div></li>
      </ul>
    </li>
    {% endfor %}
  </ul>
</section>
{% endif %}
```

### Пример: Footer Contacts

```twig
{% set contacts = static_footer.contacts %}
<div class="footer__logo-address">
  <span class="logo-address-street">{{ contacts.address_street }}</span>
  <span class="logo-address-city">{{ contacts.address_city }}</span>
  <a href="tel:{{ contacts.phone_office|replace({' ':'',' ':''}) }}">
    office: {{ contacts.phone_office }}
  </a>
  <a href="tel:{{ contacts.phone_mobile|replace({' ':'',' ':''}) }}">
    mobile: {{ contacts.phone_mobile }}
  </a>
</div>
```

### Пример: Key Features

```twig
{% set features = static_home.key_features %}
<section class="key-features">
  <h2 class="global-h">{{ features.title }}</h2>
  <div class="key-features-blocks-container">
    {% for item in features.items %}
    <div class="key-features-block">
      {{ item.icon|raw }}
      <div class="key-features__content">
        <p class="key-features__description">{{ item.description }}</p>
      </div>
    </div>
    {% endfor %}
  </div>
</section>
```

### Пример: Header Navigation

```twig
{% set nav = static_header.nav %}
<nav class="nav">
  <ul class="ul">
    {% for item in nav.items %}
    <li class="nav-list">
      <a href="{{ item.href }}" class="nav-link">{{ item.text }}</a>
    </li>
    {% endfor %}
  </ul>
</nav>
```

### Пример: Company Achievements

```twig
{% set ach = static_home.achievements %}
<section class="company-achivements">
  <h2 class="global-h">{{ ach.title }}</h2>
  <p>{{ ach.desc }}</p>
  {% for item in ach.items %}
  <div class="right-container-box">
    <div class="right-container-box__top">
      <p class="container-box-value" data-target="{{ item.value }}"
         {% if item.suffix %}data-is-percent="true"{% endif %}>
        0{{ item.suffix }}
      </p>
      <p class="container-box-text">{{ item.label }}</p>
    </div>
    <p class="container-box-content">{{ item.description }}</p>
  </div>
  {% endfor %}
</section>
```

## Добавление нового блока

### 1. Новое поле в существующую секцию

В `admin/controller/extension/module/static_content.php` → `getSectionRegistry()`:

```php
'faq' => [
    'fields' => [
        'title' => ['type' => 'text'],
        'desc'  => ['type' => 'textarea'],
        'items' => [...],
        // ↓ ДОБАВИТЬ НОВОЕ ПОЛЕ ↓
        'cta_text' => ['type' => 'text'],
    ],
],
```

### 2. Новая секция на существующую страницу

```php
'home' => [
    // ...существующие секции...
    'testimonials' => [
        'label'      => 'Testimonials',
        'sort_order' => 9,
        'fields'     => [
            'title' => ['type' => 'text'],
            'items' => [
                'type'    => 'json',
                'schema'  => 'repeater',
                'columns' => ['name', 'text', 'rating'],
            ],
        ],
    ],
],
```

### 3. Новая страница (новый таб)

```php
'about' => [
    'hero' => [
        'label'  => 'Hero Section',
        'fields' => [
            'title' => ['type' => 'text'],
            'text'  => ['type' => 'wysiwyg'],
        ],
    ],
],
```

## Кеширование

- Данные кешируются по ключу `static_content.{page}.{language_id}`
- Кеш инвалидируется при сохранении в админке
- Один SQL-запрос на всю страницу (page)
