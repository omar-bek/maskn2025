@extends('layouts.app')

@section('title', 'الملف الشخصي - insha\'at')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-3xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900">الملف الشخصي</h1>
                <p class="text-gray-600">إدارة معلومات حسابك الشخصية</p>
            </div>

            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">المعلومات الشخصية</h3>
                </div>

                <div class="p-6">
                    <form action="#" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    الاسم الكامل
                                </label>
                                <input type="text" name="name" id="name" value="{{ $user->name }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    البريد الإلكتروني
                                </label>
                                <input type="email" name="email" id="email" value="{{ $user->email }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">
                                    رقم الهاتف
                                </label>
                                <input type="tel" name="phone" id="phone" value="{{ $user->phone }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="user_type" class="block text-sm font-medium text-gray-700">
                                    نوع الحساب
                                </label>
                                <input type="text" id="user_type" value="{{ $user->userType->display_name_ar }}" readonly
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-50 sm:text-sm">
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save ml-2"></i>
                                حفظ التغييرات
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Change Password Section -->
            <div class="bg-white shadow rounded-lg mt-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">تغيير كلمة المرور</h3>
                </div>

                <div class="p-6">
                    <form action="#" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700">
                                    كلمة المرور الحالية
                                </label>
                                <input type="password" name="current_password" id="current_password"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            </div>

                            <div></div>

                            <div>
                                <label for="new_password" class="block text-sm font-medium text-gray-700">
                                    كلمة المرور الجديدة
                                </label>
                                <input type="password" name="new_password" id="new_password"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">
                                    تأكيد كلمة المرور الجديدة
                                </label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="btn-secondary">
                                <i class="fas fa-key ml-2"></i>
                                تغيير كلمة المرور
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Account Settings -->
            <div class="bg-white shadow rounded-lg mt-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">إعدادات الحساب</h3>
                </div>

                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">الإشعارات عبر البريد الإلكتروني</h4>
                                <p class="text-sm text-gray-500">استلام إشعارات حول مشاريعك</p>
                            </div>
                            <button type="button" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 bg-teal-600" role="switch" aria-checked="true">
                                <span class="translate-x-5 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                            </button>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">الإشعارات عبر الهاتف</h4>
                                <p class="text-sm text-gray-500">استلام إشعارات عبر الرسائل النصية</p>
                            </div>
                            <button type="button" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 bg-gray-200" role="switch" aria-checked="false">
                                <span class="translate-x-0 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                            </button>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">حساب نشط</h4>
                                <p class="text-sm text-gray-500">حسابك نشط ومتاح للاستخدام</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                نشط
                            </span>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <button type="button" class="text-red-600 hover:text-red-700 text-sm font-medium">
                            <i class="fas fa-trash ml-1"></i>
                            حذف الحساب
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.btn-primary {
    @apply inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500;
}

.btn-secondary {
    @apply inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500;
}
</style>
@endsection
