@extends('layouts.admin')

@section('title', 'إعدادات النظام - انشاءات')
@section('page-title', 'إعدادات النظام')

@section('content')
    <style>
        /* Image preview styles */
        .image-preview-container {
            position: relative;
            transition: all 0.3s ease;
        }

        .image-preview-container:hover {
            transform: scale(1.05);
        }

        .image-preview {
            border: 2px dashed #d1d5db;
            transition: border-color 0.3s ease;
        }

        .image-preview.has-image {
            border-color: #10b981;
            border-style: solid;
        }

        .upload-progress {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
        }

        .upload-progress.hidden {
            display: none;
        }

        /* Notification styles */
        .notification {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Button hover effects */
        .admin-btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        }
    </style>

    <div class="space-y-8">
        <!-- General Settings -->
        <div class="admin-card p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">الإعدادات العامة</h2>

            <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">اسم الموقع</label>
                        <input type="text" name="site_name"
                            value="{{ \App\Models\SiteSetting::get('site_name', 'منصة انشاءات') }}" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">البريد الإلكتروني للتواصل</label>
                        <input type="email" name="contact_email"
                            value="{{ \App\Models\SiteSetting::get('contact_email', 'info@inshaat.com') }}" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">رقم الهاتف</label>
                        <input type="text" name="contact_phone"
                            value="{{ \App\Models\SiteSetting::get('contact_phone', '+966 50 123 4567') }}" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">العنوان</label>
                        <input type="text" name="contact_address"
                            value="{{ \App\Models\SiteSetting::get('contact_address', 'الرياض، المملكة العربية السعودية') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">وصف الموقع</label>
                    <textarea name="site_description" rows="3" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ \App\Models\SiteSetting::get('site_description', 'منصة انشاءات لتصميم البيوت العصرية والإسلامية - تجمع بين أفضل الاستشاريين والمقاولين') }}</textarea>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="maintenance_mode" id="maintenance_mode"
                        {{ \App\Models\SiteSetting::get('maintenance_mode', '0') == '1' ? 'checked' : '' }}
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="maintenance_mode" class="mr-2 block text-sm text-gray-900">
                        وضع الصيانة
                    </label>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fas fa-save"></i>
                        حفظ الإعدادات
                    </button>
                </div>
            </form>
        </div>

        <!-- Site Images Quick Access -->
        <div class="admin-card p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">صور الموقع</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="text-center">
                    <div class="image-preview-container">
                        <div
                            class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center mx-auto mb-2 image-preview {{ \App\Models\SiteSetting::get('site_logo') ? 'has-image' : '' }}">
                            <img id="preview-site-logo"
                                src="{{ \App\Models\SiteSetting::get('site_logo') ?: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDgiIGhlaWdodD0iNDgiIHZpZXdCb3g9IjAgMCA0OCA0OCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTI0IDQ0QzM1LjA0NTcgNDQgNDQgMzUuMDQ1NyA0NCAyNEM0NCAxMi45NTQzIDM1LjA0NTcgNCAyNCA0QzEyLjk1NDMgNCA0IDEyLjk1NDMgNCAyNEM0IDM1LjA0NTcgMTIuOTU0MyA0NCAyNCA0NFoiIGZpbGw9IiNGM0Y0RjYiLz4KPHBhdGggZD0iTTI0IDQwQzMzLjk0MTEgNDAgNDIgMzEuOTQxMSA0MiAyMkM0MiAxMi4wNTg5IDMzLjk0MTEgNCAyNCA0QzE0LjA1ODkgNCA2IDEyLjA1ODkgNiAyMkM2IDMxLjk0MTEgMTQuMDU4OSA0MCAyNCA0MFoiIGZpbGw9IiNEMUQ1REIiLz4KPHBhdGggZD0iTTI0IDM2QzMwLjYyNzQgMzYgMzYgMzAuNjI3NCAzNiAyNEMzNiAxNy4zNzI2IDMwLjYyNzQgMTIgMjQgMTJDMTcuMzcyNiAxMiAxMiAxNy4zNzI2IDEyIDI0QzEyIDMwLjYyNzQgMTcuMzcyNiAzNiAyNCAzNloiIGZpbGw9IiM5Q0EzQUYiLz4KPC9zdmc+Cg==' }}"
                                alt="Logo" class="max-w-full max-h-full object-contain">
                        </div>
                        <div class="upload-progress hidden" id="progress-site-logo">
                            <i class="fas fa-spinner fa-spin text-blue-500"></i>
                        </div>
                    </div>
                    <p class="text-sm font-medium text-gray-900">لوجو الموقع</p>
                    <div class="mt-2">
                        <input type="file" id="site-logo-upload" accept="image/*" class="hidden"
                            onchange="previewImage(this, 'preview-site-logo', 'site_logo')">
                        <button onclick="document.getElementById('site-logo-upload').click()"
                            class="text-blue-600 hover:text-blue-800 text-sm mr-2">رفع</button>
                        <a href="{{ route('admin.site-images') }}"
                            class="text-gray-600 hover:text-gray-800 text-sm">إدارة</a>
                    </div>
                </div>

                <div class="text-center">
                    <div class="image-preview-container">
                        <div
                            class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center mx-auto mb-2 image-preview {{ \App\Models\SiteSetting::get('site_favicon') ? 'has-image' : '' }}">
                            <img id="preview-site-favicon"
                                src="{{ \App\Models\SiteSetting::get('site_favicon') ?: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDgiIGhlaWdodD0iNDgiIHZpZXdCb3g9IjAgMCA0OCA0OCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTI0IDQ0QzM1LjA0NTcgNDQgNDQgMzUuMDQ1NyA0NCAyNEM0NCAxMi45NTQzIDM1LjA0NTcgNCAyNCA0QzEyLjk1NDMgNCA0IDEyLjk1NDMgNCAyNEM0IDM1LjA0NTcgMTIuOTU0MyA0NCAyNCA0NFoiIGZpbGw9IiNGM0Y0RjYiLz4KPHBhdGggZD0iTTI0IDQwQzMzLjk0MTEgNDAgNDIgMzEuOTQxMSA0MiAyMkM0MiAxMi4wNTg5IDMzLjk0MTEgNCAyNCA0QzE0LjA1ODkgNCA2IDEyLjA1ODkgNiAyMkM2IDMxLjk0MTEgMTQuMDU4OSA0MCAyNCA0MFoiIGZpbGw9IiNEMUQ1REIiLz4KPHBhdGggZD0iTTI0IDM2QzMwLjYyNzQgMzYgMzYgMzAuNjI3NCAzNiAyNEMzNiAxNy4zNzI2IDMwLjYyNzQgMTIgMjQgMTJDMTcuMzcyNiAxMiAxMiAxNy4zNzI2IDEyIDI0QzEyIDMwLjYyNzQgMTcuMzcyNiAzNiAyNCAzNloiIGZpbGw9IiM5Q0EzQUYiLz4KPC9zdmc+Cg==' }}"
                                alt="Favicon" class="max-w-full max-h-full object-contain">
                        </div>
                        <div class="upload-progress hidden" id="progress-site-favicon">
                            <i class="fas fa-spinner fa-spin text-blue-500"></i>
                        </div>
                    </div>
                    <p class="text-sm font-medium text-gray-900">أيقونة الموقع</p>
                    <div class="mt-2">
                        <input type="file" id="site-favicon-upload" accept="image/*" class="hidden"
                            onchange="previewImage(this, 'preview-site-favicon', 'site_favicon')">
                        <button onclick="document.getElementById('site-favicon-upload').click()"
                            class="text-blue-600 hover:text-blue-800 text-sm mr-2">رفع</button>
                        <a href="{{ route('admin.site-images') }}"
                            class="text-gray-600 hover:text-gray-800 text-sm">إدارة</a>
                    </div>
                </div>

                <div class="text-center">
                    <div class="image-preview-container">
                        <div
                            class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center mx-auto mb-2 image-preview {{ \App\Models\SiteSetting::get('hero_background') ? 'has-image' : '' }}">
                            <img id="preview-hero-background"
                                src="{{ \App\Models\SiteSetting::get('hero_background') ?: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDgiIGhlaWdodD0iNDgiIHZpZXdCb3g9IjAgMCA0OCA0OCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTI0IDQ0QzM1LjA0NTcgNDQgNDQgMzUuMDQ1NyA0NCAyNEM0NCAxMi45NTQzIDM1LjA0NTcgNCAyNCA0QzEyLjk1NDMgNCA0IDEyLjk1NDMgNCAyNEM0IDM1LjA0NTcgMTIuOTU0MyA0NCAyNCA0NFoiIGZpbGw9IiNGM0Y0RjYiLz4KPHBhdGggZD0iTTI0IDQwQzMzLjk0MTEgNDAgNDIgMzEuOTQxMSA0MiAyMkM0MiAxMi4wNTg5IDMzLjk0MTEgNCAyNCA0QzE0LjA1ODkgNCA2IDEyLjA1ODkgNiAyMkM2IDMxLjk0MTEgMTQuMDU4OSA0MCAyNCA0MFoiIGZpbGw9IiNEMUQ1REIiLz4KPHBhdGggZD0iTTI0IDM2QzMwLjYyNzQgMzYgMzYgMzAuNjI3NCAzNiAyNEMzNiAxNy4zNzI2IDMwLjYyNzQgMTIgMjQgMTJDMTcuMzcyNiAxMiAxMiAxNy4zNzI2IDEyIDI0QzEyIDMwLjYyNzQgMTcuMzcyNiAzNiAyNCAzNloiIGZpbGw9IiM5Q0EzQUYiLz4KPC9zdmc+Cg==' }}"
                                alt="Hero" class="w-full h-full object-cover rounded-lg">
                        </div>
                        <div class="upload-progress hidden" id="progress-hero-background">
                            <i class="fas fa-spinner fa-spin text-blue-500"></i>
                        </div>
                    </div>
                    <p class="text-sm font-medium text-gray-900">خلفية الصفحة الرئيسية</p>
                    <div class="mt-2">
                        <input type="file" id="hero-background-upload" accept="image/*" class="hidden"
                            onchange="previewImage(this, 'preview-hero-background', 'hero_background')">
                        <button onclick="document.getElementById('hero-background-upload').click()"
                            class="text-blue-600 hover:text-blue-800 text-sm mr-2">رفع</button>
                        <a href="{{ route('admin.site-images') }}"
                            class="text-gray-600 hover:text-gray-800 text-sm">إدارة</a>
                    </div>
                </div>

                <div class="text-center">
                    <div class="image-preview-container">
                        <div
                            class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center mx-auto mb-2 image-preview {{ \App\Models\SiteSetting::get('about_image') ? 'has-image' : '' }}">
                            <img id="preview-about-image"
                                src="{{ \App\Models\SiteSetting::get('about_image') ?: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDgiIGhlaWdodD0iNDgiIHZpZXdCb3g9IjAgMCA0OCA0OCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTI0IDQ0QzM1LjA0NTcgNDQgNDQgMzUuMDQ1NyA0NCAyNEM0NCAxMi45NTQzIDM1LjA0NTcgNCAyNCA0QzEyLjk1NDMgNCA0IDEyLjk1NDMgNCAyNEM0IDM1LjA0NTcgMTIuOTU0MyA0NCAyNCA0NFoiIGZpbGw9IiNGM0Y0RjYiLz4KPHBhdGggZD0iTTI0IDQwQzMzLjk0MTEgNDAgNDIgMzEuOTQxMSA0MiAyMkM0MiAxMi4wNTg5IDMzLjk0MTEgNCAyNCA0QzE0LjA1ODkgNCA2IDEyLjA1ODkgNiAyMkM2IDMxLjk0MTEgMTQuMDU4OSA0MCAyNCA0MFoiIGZpbGw9IiNEMUQ1REIiLz4KPHBhdGggZD0iTTI0IDM2QzMwLjYyNzQgMzYgMzYgMzAuNjI3NCAzNiAyNEMzNiAxNy4zNzI2IDMwLjYyNzQgMTIgMjQgMTJDMTcuMzcyNiAxMiAxMiAxNy4zNzI2IDEyIDI0QzEyIDMwLjYyNzQgMTcuMzcyNiAzNiAyNCAzNloiIGZpbGw9IiM5Q0EzQUYiLz4KPC9zdmc+Cg==' }}"
                                alt="About" class="w-full h-full object-cover rounded-lg">
                        </div>
                        <div class="upload-progress hidden" id="progress-about-image">
                            <i class="fas fa-spinner fa-spin text-blue-500"></i>
                        </div>
                    </div>
                    <p class="text-sm font-medium text-gray-900">صورة قسم من نحن</p>
                    <div class="mt-2">
                        <input type="file" id="about-image-upload" accept="image/*" class="hidden"
                            onchange="previewImage(this, 'preview-about-image', 'about_image')">
                        <button onclick="document.getElementById('about-image-upload').click()"
                            class="text-blue-600 hover:text-blue-800 text-sm mr-2">رفع</button>
                        <a href="{{ route('admin.site-images') }}"
                            class="text-gray-600 hover:text-gray-800 text-sm">إدارة</a>
                    </div>
                </div>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('admin.site-images') }}" class="admin-btn admin-btn-primary">
                    <i class="fas fa-images"></i>
                    إدارة جميع صور الموقع
                </a>
            </div>
        </div>

        <!-- System Information -->
        <div class="admin-card p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">معلومات النظام</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-600">إصدار Laravel</span>
                        <span class="font-semibold text-gray-900">{{ app()->version() }}</span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-600">إصدار PHP</span>
                        <span class="font-semibold text-gray-900">{{ PHP_VERSION }}</span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-600">بيئة التشغيل</span>
                        <span class="font-semibold text-gray-900">{{ app()->environment() }}</span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-600">الخادم</span>
                        <span class="font-semibold text-gray-900">{{ $_SERVER['SERVER_SOFTWARE'] ?? 'غير محدد' }}</span>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-600">مساحة القرص المتاحة</span>
                        <span
                            class="font-semibold text-gray-900">{{ number_format(disk_free_space('/') / 1024 / 1024 / 1024, 2) }}
                            GB</span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-600">ذاكرة PHP</span>
                        <span class="font-semibold text-gray-900">{{ ini_get('memory_limit') }}</span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-600">الحد الأقصى لرفع الملفات</span>
                        <span class="font-semibold text-gray-900">{{ ini_get('upload_max_filesize') }}</span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-600">وقت تنفيذ PHP</span>
                        <span class="font-semibold text-gray-900">{{ ini_get('max_execution_time') }} ثانية</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Database Information -->
        <div class="admin-card p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">معلومات قاعدة البيانات</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-600">نوع قاعدة البيانات</span>
                        <span class="font-semibold text-gray-900">{{ config('database.default') }}</span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-600">اسم قاعدة البيانات</span>
                        <span
                            class="font-semibold text-gray-900">{{ config('database.connections.mysql.database') }}</span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-600">مضيف قاعدة البيانات</span>
                        <span class="font-semibold text-gray-900">{{ config('database.connections.mysql.host') }}</span>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-600">إجمالي الجداول</span>
                        <span
                            class="font-semibold text-gray-900">{{ DB::select('SHOW TABLES')[0]->{'Tables_in_' . config('database.connections.mysql.database')} ?? 'غير محدد' }}</span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-600">حجم قاعدة البيانات</span>
                        <span class="font-semibold text-gray-900">غير محدد</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cache Management -->
        <div class="admin-card p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">إدارة التخزين المؤقت</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <button onclick="clearCache('config')" class="admin-btn admin-btn-warning">
                    <i class="fas fa-cog"></i>
                    مسح إعدادات التخزين المؤقت
                </button>

                <button onclick="clearCache('route')" class="admin-btn admin-btn-warning">
                    <i class="fas fa-route"></i>
                    مسح طرق التخزين المؤقت
                </button>

                <button onclick="clearCache('view')" class="admin-btn admin-btn-warning">
                    <i class="fas fa-eye"></i>
                    مسح عروض التخزين المؤقت
                </button>
            </div>
        </div>

        <!-- Backup & Maintenance -->
        <div class="admin-card p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">النسخ الاحتياطي والصيانة</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <button onclick="createBackup()" class="admin-btn admin-btn-success">
                    <i class="fas fa-download"></i>
                    إنشاء نسخة احتياطية
                </button>

                <button onclick="optimizeDatabase()" class="admin-btn admin-btn-primary">
                    <i class="fas fa-database"></i>
                    تحسين قاعدة البيانات
                </button>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="admin-card p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">إعدادات الأمان</h2>

            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-gray-900">تسجيل محاولات الدخول الفاشلة</h3>
                        <p class="text-sm text-gray-600">تسجيل جميع محاولات الدخول الفاشلة للمراقبة</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-gray-900">تشفير البيانات الحساسة</h3>
                        <p class="text-sm text-gray-600">تشفير البيانات الحساسة في قاعدة البيانات</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-gray-900">حماية من هجمات CSRF</h3>
                        <p class="text-sm text-gray-600">حماية النماذج من هجمات Cross-Site Request Forgery</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Preview image function
        function previewImage(input, previewId, imageKey) {
            if (input.files && input.files[0]) {
                const file = input.files[0];

                // Validate file type
                if (!file.type.startsWith('image/')) {
                    alert('يرجى اختيار ملف صورة صالح');
                    return;
                }

                // Validate file size (max 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('حجم الملف يجب أن يكون أقل من 5 ميجابايت');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById(previewId);
                    preview.src = e.target.result;

                    // Show upload button
                    showUploadButton(imageKey, file);
                };
                reader.readAsDataURL(file);
            }
        }

        // Show upload button after preview
        function showUploadButton(imageKey, file) {
            const uploadBtn = document.createElement('button');
            uploadBtn.className = 'admin-btn admin-btn-success text-sm mt-2';
            uploadBtn.innerHTML = '<i class="fas fa-upload"></i> حفظ الصورة';
            uploadBtn.onclick = () => uploadImage(imageKey, file);

            // Remove existing upload button if any
            const existingBtn = document.querySelector(`[data-upload-btn="${imageKey}"]`);
            if (existingBtn) {
                existingBtn.remove();
            }

            uploadBtn.setAttribute('data-upload-btn', imageKey);

            // Find the parent container and add the button
            const preview = document.getElementById(`preview-${imageKey.replace('_', '-')}`);
            const container = preview.closest('.text-center');
            container.appendChild(uploadBtn);
        }

        // Upload image function
        function uploadImage(imageKey, file) {
            const formData = new FormData();
            formData.append('key', imageKey);
            formData.append('image', file);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            // Show loading state
            const uploadBtn = document.querySelector(`[data-upload-btn="${imageKey}"]`);
            const progressDiv = document.getElementById(`progress-${imageKey.replace('_', '-')}`);

            if (uploadBtn) {
                uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الرفع...';
                uploadBtn.disabled = true;
            }

            if (progressDiv) {
                progressDiv.classList.remove('hidden');
            }

            fetch('{{ route('admin.upload-site-image') }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('تم رفع الصورة بنجاح', 'success');

                        // Remove upload button
                        if (uploadBtn) {
                            uploadBtn.remove();
                        }

                        // Update preview with server URL
                        const preview = document.getElementById(`preview-${imageKey.replace('_', '-')}`);
                        preview.src = data.url;

                        // Update border color to indicate success
                        const previewContainer = preview.closest('.image-preview');
                        if (previewContainer) {
                            previewContainer.classList.add('has-image');
                        }
                    } else {
                        showNotification(data.message || 'حدث خطأ أثناء رفع الصورة', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('حدث خطأ أثناء رفع الصورة', 'error');
                })
                .finally(() => {
                    if (uploadBtn) {
                        uploadBtn.disabled = false;
                    }
                    if (progressDiv) {
                        progressDiv.classList.add('hidden');
                    }
                });
        }

        // Show notification function
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.textContent = message;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        function clearCache(type) {
            if (confirm(`هل أنت متأكد من مسح ${type} cache؟`)) {
                // إرسال طلب AJAX لمسح التخزين المؤقت
                fetch(`/admin/clear-cache/${type}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('تم مسح التخزين المؤقت بنجاح');
                        } else {
                            alert('حدث خطأ أثناء مسح التخزين المؤقت');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('حدث خطأ أثناء مسح التخزين المؤقت');
                    });
            }
        }

        function createBackup() {
            if (confirm('هل تريد إنشاء نسخة احتياطية من قاعدة البيانات؟')) {
                // إرسال طلب AJAX لإنشاء نسخة احتياطية
                fetch('/admin/create-backup', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('تم إنشاء النسخة الاحتياطية بنجاح');
                        } else {
                            alert('حدث خطأ أثناء إنشاء النسخة الاحتياطية');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('حدث خطأ أثناء إنشاء النسخة الاحتياطية');
                    });
            }
        }

        function optimizeDatabase() {
            if (confirm('هل تريد تحسين قاعدة البيانات؟')) {
                // إرسال طلب AJAX لتحسين قاعدة البيانات
                fetch('/admin/optimize-database', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('تم تحسين قاعدة البيانات بنجاح');
                        } else {
                            alert('حدث خطأ أثناء تحسين قاعدة البيانات');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('حدث خطأ أثناء تحسين قاعدة البيانات');
                    });
            }
        }
    </script>
@endsection
