@extends('layouts.app')

@section('title', 'إنشاء حساب جديد - insha\'at')

@section('content')
<div class="min-h-screen bg-cover bg-center flex items-center justify-center px-4 py-12"
     style="background-image: url('{{ asset('images/login1.png') }}');">

    <div class="w-full max-w-md bg-white/10 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/20 p-8 text-white mt-20">
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 rounded-2xl bg-[#f3a446]/20 flex items-center justify-center border border-[#f3a446]/40">
                    <i class="fas fa-user-plus text-[rgb(137,78,7)] text-2xl"></i>
                </div>
            </div>
            <h2 class="text-3xl font-bold">إنشاء حساب جديد</h2>
            <p class="mt-2 text-sm text-gray-200">
                لديك حساب بالفعل؟
                <a href="{{ route('login') }}" class="font-medium text-[#5c3506] hover:underline">تسجيل الدخول</a>
            </p>
        </div>

        <form action="{{ route('register.post') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium mb-2 text-gray-100">الاسم الكامل</label>
                <input id="name" name="name" type="text" required
                    value="{{ old('name') }}"
                    class="block w-full px-4 py-2 bg-white/10 border border-white/30 rounded-xl text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-[#f3a446] focus:border-transparent">
                @error('name')
                    <p class="text-sm text-red-400 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium mb-2 text-gray-100">البريد الإلكتروني</label>
                <input id="email" name="email" type="email" required
                    value="{{ old('email') }}"
                    class="block w-full px-4 py-2 bg-white/10 border border-white/30 rounded-xl text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-[#f3a446] focus:border-transparent">
                @error('email')
                    <p class="text-sm text-red-400 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium mb-2 text-gray-100">رقم الهاتف</label>
                <input id="phone" name="phone" type="tel" required
                    value="{{ old('phone') }}"
                    class="block w-full px-4 py-2 bg-white/10 border border-white/30 rounded-xl text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-[#f3a446] focus:border-transparent">
                @error('phone')
                    <p class="text-sm text-red-400 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="user_type_id" class="block text-sm font-medium mb-2 text-gray-100">نوع الحساب</label>
                <select id="user_type_id" name="user_type_id" required
                    class="block w-full px-4 py-2 bg-white/10 border border-white/30 rounded-xl text-black focus:ring-2 focus:ring-[#f3a446] focus:border-transparent">
                    <option value="">اختر نوع الحساب</option>
                    @if(isset($userTypes) && $userTypes->count() > 0)
                        @foreach($userTypes as $userType)
                            <option value="{{ $userType->id }}" {{ old('user_type_id') == $userType->id ? 'selected' : '' }}>
                                {{ $userType->display_name_ar }}
                            </option>
                        @endforeach
                    @else
                        <option value="1">عميل</option>
                        <option value="2">استشاري</option>
                        <option value="3">مقاول</option>
                        <option value="4">مورد</option>
                    @endif
                </select>
                @error('user_type_id')
                    <p class="text-sm text-red-400 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium mb-2 text-gray-100">كلمة المرور</label>
                <input id="password" name="password" type="password" required
                    class="block w-full px-4 py-2 bg-white/10 border border-white/30 rounded-xl text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-[#f3a446] focus:border-transparent">
                @error('password')
                    <p class="text-sm text-red-400 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium mb-2 text-gray-100">تأكيد كلمة المرور</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="block w-full px-4 py-2 bg-white/10 border border-white/30 rounded-xl text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-[#f3a446] focus:border-transparent">
            </div>

            <div class="flex items-center gap-2">
                <input id="terms" name="terms" type="checkbox" required
                    class="h-4 w-4 text-[#f3a446] border-gray-400 rounded focus:ring-[#f3a446]">
                <label for="terms" class="text-sm text-gray-200">
                    أوافق على <a href="#" class="text-[#f3a446] hover:underline">الشروط والأحكام</a> و
                    <a href="#" class="text-[#f3a446] hover:underline">سياسة الخصوصية</a>
                </label>
            </div>

            <button type="submit"
                class="w-full py-3 mt-4 bg-[#f3a446] text-white font-medium rounded-xl hover:bg-[#ffb35f] transition duration-300 shadow-lg hover:shadow-[#f3a446]/40">
                إنشاء الحساب
            </button>
        </form>

        <div class="mt-8">
            <div class="relative flex items-center justify-center">
                <span class="absolute w-full border-t border-white/20"></span>
                <span class="bg-transparent text-gray-300 px-4 z-10">أو</span>
            </div>

            <div class="grid grid-cols-2 gap-3 mt-6">
                <a href="#" class="flex justify-center items-center gap-2 py-2 border border-white/20 rounded-xl bg-white/10 hover:bg-white/20 transition">
                    <i class="fab fa-google text-red-400"></i>
                    <span class="text-gray-100 text-sm">Google</span>
                </a>
                <a href="#" class="flex justify-center items-center gap-2 py-2 border border-white/20 rounded-xl bg-white/10 hover:bg-white/20 transition">
                    <i class="fab fa-facebook text-blue-400"></i>
                    <span class="text-gray-100 text-sm">Facebook</span>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
body {
    font-family: 'Tajawal', sans-serif;
}

@media (max-width: 640px) {
    .max-w-md {
        width: 100%;
        padding: 1.5rem;
    }
}
</style>
@endsection
