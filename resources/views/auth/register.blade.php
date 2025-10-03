@extends('layouts.app')

@section('title', 'إنشاء حساب جديد - insha\'at')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">إنشاء حساب جديد</h2>
            <p class="mt-2 text-sm text-gray-600">
                أو
                <a href="{{ route('login') }}" class="font-medium text-teal-600 hover:text-teal-500">
                    تسجيل الدخول إلى حسابك
                </a>
            </p>
        </div>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form class="space-y-6" action="{{ route('register.post') }}" method="POST">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        الاسم الكامل
                    </label>
                    <div class="mt-1">
                        <input id="name" name="name" type="text" autocomplete="name" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                               value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        البريد الإلكتروني
                    </label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                               value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">
                        رقم الهاتف
                    </label>
                    <div class="mt-1">
                        <input id="phone" name="phone" type="tel" autocomplete="tel" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                               value="{{ old('phone') }}">
                    </div>
                    @error('phone')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="user_type_id" class="block text-sm font-medium text-gray-700 mb-3">
                        نوع الحساب
                    </label>

                    <!-- Account Type Cards -->
                    <div class="grid grid-cols-1 gap-3 mb-4">
                        @if(isset($userTypes) && $userTypes->count() > 0)
                            @foreach($userTypes as $userType)
                            <label class="relative cursor-pointer">
                                <input type="radio" name="user_type_id" value="{{ $userType->id }}" class="sr-only peer" {{ old('user_type_id') == $userType->id ? 'checked' : '' }}>
                                <div class="p-4 border-2 border-gray-200 rounded-lg peer-checked:border-teal-500 peer-checked:bg-teal-50 transition-all duration-200 hover:border-teal-300 hover:bg-gray-50">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            @if($userType->name === 'client')
                                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-home text-blue-600 text-lg"></i>
                                                </div>
                                            @elseif($userType->name === 'consultant')
                                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-user-tie text-purple-600 text-lg"></i>
                                                </div>
                                            @elseif($userType->name === 'contractor')
                                                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-hard-hat text-orange-600 text-lg"></i>
                                                </div>
                                            @elseif($userType->name === 'supplier')
                                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-truck text-green-600 text-lg"></i>
                                                </div>
                                            @else
                                                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-user text-gray-600 text-lg"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="mr-3">
                                            <h3 class="text-sm font-medium text-gray-900">{{ $userType->display_name_ar }}</h3>
                                            <p class="text-xs text-gray-500">{{ $userType->description_ar }}</p>
                                        </div>
                                        <div class="mr-auto">
                                            <div class="w-4 h-4 border-2 border-gray-300 rounded-full peer-checked:border-teal-500 peer-checked:bg-teal-500 flex items-center justify-center">
                                                <div class="w-2 h-2 bg-white rounded-full opacity-0 peer-checked:opacity-100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            @endforeach
                        @else
                            <!-- Fallback: Use traditional select dropdown -->
                            <select name="user_type_id" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                <option value="">اختر نوع الحساب</option>
                                <option value="1" {{ old('user_type_id') == '1' ? 'selected' : '' }}>عميل</option>
                                <option value="2" {{ old('user_type_id') == '2' ? 'selected' : '' }}>استشاري</option>
                                <option value="3" {{ old('user_type_id') == '3' ? 'selected' : '' }}>مقاول</option>
                                <option value="4" {{ old('user_type_id') == '4' ? 'selected' : '' }}>مورد</option>
                            </select>
                        @endif
                    </div>

                    @error('user_type_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        كلمة المرور
                    </label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                        تأكيد كلمة المرور
                    </label>
                    <div class="mt-1">
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="terms" name="terms" type="checkbox" required
                           class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded">
                    <label for="terms" class="mr-2 block text-sm text-gray-900">
                        أوافق على
                        <a href="#" class="font-medium text-teal-600 hover:text-teal-500">الشروط والأحكام</a>
                        و
                        <a href="#" class="font-medium text-teal-600 hover:text-teal-500">سياسة الخصوصية</a>
                    </label>
                </div>

                <div>
                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        إنشاء الحساب
                    </button>
                </div>
            </form>

            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300" />
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">أو</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <div>
                        <a href="#"
                           class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <i class="fab fa-google text-red-500"></i>
                            <span class="mr-2">Google</span>
                        </a>
                    </div>

                    <div>
                        <a href="#"
                           class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <i class="fab fa-facebook text-blue-600"></i>
                            <span class="mr-2">Facebook</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media (max-width: 640px) {
    .sm\:px-6 {
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .sm\:max-w-md {
        max-width: 100%;
    }

    .sm\:mx-auto {
        margin-left: 1rem;
        margin-right: 1rem;
    }
}

/* Custom Radio Button Styles */
.peer:checked + div {
    border-color: #0d9488;
    background-color: #f0fdfa;
    box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
}

.peer:checked + div .peer-checked\:border-teal-500 {
    border-color: #0d9488;
}

.peer:checked + div .peer-checked\:bg-teal-500 {
    background-color: #0d9488;
}

.peer:checked + div .peer-checked\:opacity-100 {
    opacity: 1;
}

/* Hover Effects */
label:hover .peer + div {
    border-color: #5eead4;
    background-color: #f8fafc;
}

/* Focus Styles */
.peer:focus + div {
    outline: 2px solid #0d9488;
    outline-offset: 2px;
}
</style>
@endsection
