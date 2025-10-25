@extends('layouts.admin')

@section('title', 'إدارة صور الموقع - انشاءات')
@section('page-title', 'إدارة صور الموقع')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">إدارة صور الموقع</h1>
                <p class="text-gray-600">إدارة لوجو الموقع والصور الرئيسية</p>
            </div>
        </div>

        <!-- Images Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Site Logo -->
            <div class="admin-card p-6">
                <div class="text-center">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">لوجو الموقع</h3>
                    <div class="mb-4">
                        <div id="logo-preview"
                            class="w-32 h-32 mx-auto bg-gray-100 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300">
                            @if ($images->where('key', 'site_logo')->first()?->value)
                                <img src="{{ Storage::url($images->where('key', 'site_logo')->first()->value) }}"
                                    alt="Logo" class="max-w-full max-h-full object-contain">
                            @else
                                <i class="fas fa-image text-4xl text-gray-400"></i>
                            @endif
                        </div>
                    </div>
                    <div class="space-y-2">
                        <input type="file" id="logo-upload" accept="image/*" class="hidden"
                            onchange="uploadImage('site_logo', this)">
                        <button onclick="document.getElementById('logo-upload').click()"
                            class="admin-btn admin-btn-primary w-full">
                            <i class="fas fa-upload"></i>
                            رفع لوجو
                        </button>
                        @if ($images->where('key', 'site_logo')->first()?->value)
                            <button onclick="deleteImage('site_logo')" class="admin-btn admin-btn-danger w-full">
                                <i class="fas fa-trash"></i>
                                حذف
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Site Favicon -->
            <div class="admin-card p-6">
                <div class="text-center">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">أيقونة الموقع</h3>
                    <div class="mb-4">
                        <div id="favicon-preview"
                            class="w-16 h-16 mx-auto bg-gray-100 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300">
                            @if ($images->where('key', 'site_favicon')->first()?->value)
                                <img src="{{ Storage::url($images->where('key', 'site_favicon')->first()->value) }}"
                                    alt="Favicon" class="max-w-full max-h-full object-contain">
                            @else
                                <i class="fas fa-image text-2xl text-gray-400"></i>
                            @endif
                        </div>
                    </div>
                    <div class="space-y-2">
                        <input type="file" id="favicon-upload" accept="image/*" class="hidden"
                            onchange="uploadImage('site_favicon', this)">
                        <button onclick="document.getElementById('favicon-upload').click()"
                            class="admin-btn admin-btn-primary w-full">
                            <i class="fas fa-upload"></i>
                            رفع أيقونة
                        </button>
                        @if ($images->where('key', 'site_favicon')->first()?->value)
                            <button onclick="deleteImage('site_favicon')" class="admin-btn admin-btn-danger w-full">
                                <i class="fas fa-trash"></i>
                                حذف
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Hero Background -->
            <div class="admin-card p-6">
                <div class="text-center">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">خلفية الصفحة الرئيسية</h3>
                    <div class="mb-4">
                        <div id="hero-preview"
                            class="w-full h-24 bg-gray-100 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300">
                            @if ($images->where('key', 'hero_background')->first()?->value)
                                <img src="{{ Storage::url($images->where('key', 'hero_background')->first()->value) }}"
                                    alt="Hero Background" class="w-full h-full object-cover rounded-lg">
                            @else
                                <i class="fas fa-image text-2xl text-gray-400"></i>
                            @endif
                        </div>
                    </div>
                    <div class="space-y-2">
                        <input type="file" id="hero-upload" accept="image/*" class="hidden"
                            onchange="uploadImage('hero_background', this)">
                        <button onclick="document.getElementById('hero-upload').click()"
                            class="admin-btn admin-btn-primary w-full">
                            <i class="fas fa-upload"></i>
                            رفع خلفية
                        </button>
                        @if ($images->where('key', 'hero_background')->first()?->value)
                            <button onclick="deleteImage('hero_background')" class="admin-btn admin-btn-danger w-full">
                                <i class="fas fa-trash"></i>
                                حذف
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- About Image -->
            <div class="admin-card p-6">
                <div class="text-center">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">صورة قسم من نحن</h3>
                    <div class="mb-4">
                        <div id="about-preview"
                            class="w-full h-24 bg-gray-100 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300">
                            @if ($images->where('key', 'about_image')->first()?->value)
                                <img src="{{ Storage::url($images->where('key', 'about_image')->first()->value) }}"
                                    alt="About Image" class="w-full h-full object-cover rounded-lg">
                            @else
                                <i class="fas fa-image text-2xl text-gray-400"></i>
                            @endif
                        </div>
                    </div>
                    <div class="space-y-2">
                        <input type="file" id="about-upload" accept="image/*" class="hidden"
                            onchange="uploadImage('about_image', this)">
                        <button onclick="document.getElementById('about-upload').click()"
                            class="admin-btn admin-btn-primary w-full">
                            <i class="fas fa-upload"></i>
                            رفع صورة
                        </button>
                        @if ($images->where('key', 'about_image')->first()?->value)
                            <button onclick="deleteImage('about_image')" class="admin-btn admin-btn-danger w-full">
                                <i class="fas fa-trash"></i>
                                حذف
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Guidelines -->
        <div class="admin-card p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">إرشادات رفع الصور</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">لوجو الموقع:</h3>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• الحجم الموصى به: 200x200 بكسل</li>
                        <li>• التنسيقات المقبولة: PNG, JPG, SVG</li>
                        <li>• الحد الأقصى: 2 ميجابايت</li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">أيقونة الموقع:</h3>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• الحجم الموصى به: 32x32 بكسل</li>
                        <li>• التنسيقات المقبولة: ICO, PNG</li>
                        <li>• الحد الأقصى: 1 ميجابايت</li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">خلفية الصفحة الرئيسية:</h3>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• الحجم الموصى به: 1920x1080 بكسل</li>
                        <li>• التنسيقات المقبولة: JPG, PNG</li>
                        <li>• الحد الأقصى: 5 ميجابايت</li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">صورة قسم من نحن:</h3>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• الحجم الموصى به: 800x600 بكسل</li>
                        <li>• التنسيقات المقبولة: JPG, PNG</li>
                        <li>• الحد الأقصى: 3 ميجابايت</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        function uploadImage(key, input) {
            const file = input.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append('key', key);
            formData.append('image', file);

            // Show loading state
            const preview = document.getElementById(key.replace('_', '-') + '-preview');
            preview.innerHTML = '<i class="fas fa-spinner fa-spin text-2xl text-blue-500"></i>';

            fetch('{{ route('admin.upload-site-image') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update preview
                        if (key === 'site_logo' || key === 'site_favicon') {
                            preview.innerHTML =
                                `<img src="${data.url}" alt="${key}" class="max-w-full max-h-full object-contain">`;
                        } else {
                            preview.innerHTML =
                                `<img src="${data.url}" alt="${key}" class="w-full h-full object-cover rounded-lg">`;
                        }

                        // Show success message
                        showNotification('تم رفع الصورة بنجاح', 'success');

                        // Reload page to update buttons
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        preview.innerHTML = '<i class="fas fa-image text-2xl text-gray-400"></i>';
                        showNotification(data.message || 'حدث خطأ أثناء رفع الصورة', 'error');
                    }
                })
                .catch(error => {
                    preview.innerHTML = '<i class="fas fa-image text-2xl text-gray-400"></i>';
                    showNotification('حدث خطأ أثناء رفع الصورة', 'error');
                });
        }

        function deleteImage(key) {
            if (!confirm('هل أنت متأكد من حذف هذه الصورة؟')) {
                return;
            }

            fetch('{{ route('admin.delete-site-image') }}', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        key: key
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update preview
                        const preview = document.getElementById(key.replace('_', '-') + '-preview');
                        preview.innerHTML = '<i class="fas fa-image text-2xl text-gray-400"></i>';

                        showNotification('تم حذف الصورة بنجاح', 'success');

                        // Reload page to update buttons
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        showNotification(data.message || 'حدث خطأ أثناء حذف الصورة', 'error');
                    }
                })
                .catch(error => {
                    showNotification('حدث خطأ أثناء حذف الصورة', 'error');
                });
        }

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
    </script>
@endsection
