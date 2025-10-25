@extends('layouts.admin')

@section('title', 'الملف الشخصي - إدارة انشاءات')
@section('page-title', 'الملف الشخصي')

@section('content')
    <div class="space-y-6">
        <!-- Profile Header -->
        <div class="admin-card p-8">
            <div class="flex items-center">
                <div
                    class="w-20 h-20 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center text-white font-bold text-2xl ml-6">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                    <p class="text-gray-600 text-lg">{{ $user->userType->display_name ?? 'مدير النظام' }}</p>
                    <p class="text-gray-500">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <!-- Profile Form -->
        <div class="admin-card p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">تحديث الملف الشخصي</h2>

            <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">الاسم الكامل</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">البريد الإلكتروني</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">رقم الهاتف</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('phone')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">المدينة</label>
                        <input type="text" name="city" value="{{ old('city', $user->city) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('city')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fas fa-save"></i>
                        حفظ التغييرات
                    </button>
                </div>
            </form>
        </div>

        <!-- Account Information -->
        <div class="admin-card p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">معلومات الحساب</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-600">نوع المستخدم</span>
                        <span
                            class="font-semibold text-gray-900">{{ $user->userType->display_name ?? 'مدير النظام' }}</span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-600">حالة الحساب</span>
                        <span class="font-semibold {{ $user->is_active ? 'text-green-600' : 'text-red-600' }}">
                            {{ $user->is_active ? 'نشط' : 'غير نشط' }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-600">البريد الإلكتروني محقق</span>
                        <span class="font-semibold {{ $user->email_verified_at ? 'text-green-600' : 'text-red-600' }}">
                            {{ $user->email_verified_at ? 'محقق' : 'غير محقق' }}
                        </span>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-600">تاريخ التسجيل</span>
                        <span class="font-semibold text-gray-900">{{ $user->created_at->format('Y-m-d') }}</span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-600">آخر تحديث</span>
                        <span class="font-semibold text-gray-900">{{ $user->updated_at->format('Y-m-d') }}</span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                        <span class="text-gray-600">آخر دخول</span>
                        <span
                            class="font-semibold text-gray-900">{{ $user->last_login_at ? $user->last_login_at->format('Y-m-d H:i') : 'غير محدد' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="admin-card p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">إعدادات الأمان</h2>

            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-gray-900">تغيير كلمة المرور</h3>
                        <p class="text-sm text-gray-600">قم بتحديث كلمة المرور لحسابك</p>
                    </div>
                    <button onclick="openPasswordModal()" class="admin-btn admin-btn-warning">
                        <i class="fas fa-key"></i>
                        تغيير كلمة المرور
                    </button>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-gray-900">المصادقة الثنائية</h3>
                        <p class="text-sm text-gray-600">إضافة طبقة إضافية من الأمان لحسابك</p>
                    </div>
                    <button class="admin-btn admin-btn-secondary">
                        <i class="fas fa-shield-alt"></i>
                        تفعيل
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Password Change Modal -->
    <div id="passwordModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="admin-card max-w-md w-full">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-900">تغيير كلمة المرور</h3>
                <button onclick="closePasswordModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">كلمة المرور الحالية</label>
                        <input type="password" name="current_password" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">كلمة المرور الجديدة</label>
                        <input type="password" name="password" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">تأكيد كلمة المرور الجديدة</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="flex items-center gap-3 mt-6">
                    <button type="submit" class="admin-btn admin-btn-primary flex-1">
                        <i class="fas fa-save"></i>
                        حفظ
                    </button>
                    <button type="button" onclick="closePasswordModal()" class="admin-btn admin-btn-secondary flex-1">
                        <i class="fas fa-times"></i>
                        إلغاء
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openPasswordModal() {
            document.getElementById('passwordModal').classList.remove('hidden');
        }

        function closePasswordModal() {
            document.getElementById('passwordModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('passwordModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePasswordModal();
            }
        });
    </script>
@endsection
