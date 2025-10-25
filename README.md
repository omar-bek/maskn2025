# 🏗️ منصة انشاءات - Insha'at Platform

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-red.svg" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue.svg" alt="PHP Version">
  <img src="https://img.shields.io/badge/License-MIT-green.svg" alt="License">
  <img src="https://img.shields.io/badge/Status-Production%20Ready-brightgreen.svg" alt="Status">
</p>

## 📋 نظرة عامة

منصة **انشاءات** هي منصة متكاملة تجمع بين أفضل الاستشاريين والمقاولين والموردين لتحويل الأحلام المعمارية إلى واقع ملموس. تهدف المنصة إلى تسهيل عملية تصميم وبناء المنازل من خلال توفير بيئة تفاعلية تجمع بين العملاء والمهنيين.

## ✨ المميزات الرئيسية

### 🎨 للعملاء

-   **تصفح التصاميم**: آلاف التصاميم المعمارية المتنوعة
-   **إنشاء المناقصات**: إمكانية إنشاء مناقصات مخصصة لمشاريعهم
-   **مقارنة العروض**: مقارنة شاملة بين عروض الاستشاريين
-   **متابعة المشاريع**: متابعة دقيقة لتقدم المشروع
-   **حاسبة التكلفة**: تقدير دقيق لتكلفة المشروع

### 👨‍💼 للاستشاريين

-   **عرض التصاميم**: رفع وعرض التصاميم المعمارية
-   **المشاركة في المناقصات**: تقديم عروض للمناقصات المتاحة
-   **إدارة المحفظة**: إدارة شاملة للمشاريع والعروض
-   **التفاعل مع العملاء**: تواصل مباشر مع العملاء

### 🏗️ للمقاولين والموردين

-   **المشاركة في المشاريع**: عرض خدمات البناء والتوريد
-   **إدارة المشاريع**: متابعة وتنفيذ المشاريع المكلفة
-   **إدارة المخزون**: إدارة مواد البناء والأثاث

## 🛠️ التقنيات المستخدمة

### Backend

-   **Laravel 11.x** - إطار عمل PHP متقدم
-   **PHP 8.2+** - لغة البرمجة الأساسية
-   **MySQL** - قاعدة البيانات الرئيسية
-   **Laravel Sanctum** - إدارة المصادقة
-   **Laravel Excel** - تصدير البيانات
-   **DomPDF** - إنشاء ملفات PDF

### Frontend

-   **Tailwind CSS** - إطار عمل CSS
-   **JavaScript ES6+** - البرمجة التفاعلية
-   **Font Awesome** - الأيقونات
-   **Google Fonts (Cairo)** - الخطوط العربية

### الأدوات والتطوير

-   **Vite** - أداة البناء والتطوير
-   **Laravel Pint** - تنسيق الكود
-   **PHPUnit** - اختبار الوحدة
-   **Laravel Pail** - مراقبة السجلات

## 🚀 التثبيت والتشغيل

### المتطلبات

-   PHP 8.2 أو أحدث
-   Composer
-   Node.js 18+ و npm
-   MySQL 8.0 أو أحدث

### خطوات التثبيت

1. **استنساخ المشروع**

```bash
git clone https://github.com/your-username/inshaat-platform.git
cd inshaat-platform
```

2. **تثبيت التبعيات**

```bash
composer install
npm install
```

3. **إعداد البيئة**

```bash
cp .env.example .env
php artisan key:generate
```

4. **إعداد قاعدة البيانات**

```bash
# تحديث ملف .env بقاعدة البيانات
php artisan migrate
php artisan db:seed
```

5. **بناء الأصول**

```bash
npm run build
# أو للتطوير
npm run dev
```

6. **تشغيل الخادم**

```bash
php artisan serve
```

## 📁 هيكل المشروع

```
inshaat-platform/
├── app/
│   ├── Http/Controllers/     # المتحكمات
│   ├── Models/              # النماذج
│   ├── Exports/             # تصدير البيانات
│   └── Providers/           # مقدمي الخدمات
├── database/
│   ├── migrations/          # هجرات قاعدة البيانات
│   └── seeders/            # بذور البيانات
├── resources/
│   ├── views/              # قوالب Blade
│   ├── css/               # ملفات CSS
│   └── js/                # ملفات JavaScript
├── public/
│   ├── css/               # ملفات CSS المبنية
│   └── js/                # ملفات JS المبنية
└── routes/                # ملفات التوجيه
```

## 🔧 الإعدادات المتقدمة

### تحسين الأداء

-   **Cache**: تفعيل التخزين المؤقت
-   **Queue**: معالجة المهام في الخلفية
-   **Optimization**: تحسين قاعدة البيانات

### الأمان

-   **CSRF Protection**: حماية من هجمات CSRF
-   **XSS Protection**: حماية من هجمات XSS
-   **SQL Injection**: حماية من حقن SQL
-   **File Upload Security**: أمان رفع الملفات

## 📊 الإحصائيات

-   **500+** استشاري معتمد
-   **1000+** مشروع مكتمل
-   **50+** مدينة في المنطقة
-   **4.9/5** تقييم العملاء

## 🤝 المساهمة

نرحب بمساهماتكم! يرجى قراءة [دليل المساهمة](CONTRIBUTING.md) قبل البدء.

## 📄 الترخيص

هذا المشروع مرخص تحت [رخصة MIT](LICENSE).

## 📞 التواصل

-   **الموقع**: [inshaat.com](https://inshaat.com)
-   **البريد الإلكتروني**: info@inshaat.com
-   **الهاتف**: +966 50 123 4567

---

<p align="center">صُنع بـ ❤️ في المملكة العربية السعودية</p>

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com/)**
-   **[Tighten Co.](https://tighten.co)**
-   **[WebReinvent](https://webreinvent.com/)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
-   **[Cyber-Duck](https://cyber-duck.co.uk)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Jump24](https://jump24.co.uk)**
-   **[Redberry](https://redberry.international/laravel/)**
-   **[Active Logic](https://activelogic.com)**
-   **[byte5](https://byte5.de)**
-   **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
