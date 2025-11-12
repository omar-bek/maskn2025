@extends('layouts.app')

@section('title', __('app.login.title'))

@section('content')
<div class="min-h-screen bg-cover bg-center flex items-center justify-center px-4 py-12"
     style="background-image: url('{{ asset('images/login1.png') }}');">

    <div class="w-full max-w-md bg-white/10 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/20 p-8 text-white mt-20">
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 rounded-2xl bg-[#f3a446]/20 flex items-center justify-center border border-[#f3a446]/40">
                    <i class="fas fa-door-open text-[#72450d] text-2xl"></i>
                </div>
            </div>
            <h2 class="text-3xl font-bold">{{ __('app.login.page_title') }}</h2>
            <p class="mt-2 text-sm text-gray-200">
                {{ __('app.login.no_account') }}
                <a href="{{ route('register') }}" class="font-medium text-[#f3a446] hover:underline">
                    {{ __('app.login.create_account_link') }}
                </a>
            </p>
        </div>

        <form class="space-y-6" action="{{ route('login.post') }}" method="POST">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium mb-2 text-gray-100">{{ __('app.login.email') }}</label>
                <input id="email" name="email" type="email" autocomplete="email" required
                       value="{{ old('email') }}"
                       class="block w-full px-4 py-2 bg-white/10 border border-white/30 rounded-xl text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-[#f3a446] focus:border-transparent">
                @error('email')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium mb-2 text-gray-100">{{ __('app.login.password') }}</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required
                       class="block w-full px-4 py-2 bg-white/10 border border-white/30 rounded-xl text-gray-100 placeholder-gray-300 focus:ring-2 focus:ring-[#f3a446] focus:border-transparent">
                @error('password')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <input id="remember_me" name="remember" type="checkbox"
                           class="h-4 w-4 text-[#f3a446] border-gray-400 rounded focus:ring-[#f3a446]">
                    <label for="remember_me" class="text-sm text-gray-200">{{ __('app.login.remember_me') }}</label>
                </div>

                <div class="text-sm">
                    <a href="{{ route('password.request') }}" class="font-medium text-[#f3a446] hover:underline">
                        {{ __('app.login.forgot_password_link') }}
                    </a>
                </div>
            </div>

            <button type="submit"
                    class="w-full py-3 mt-4 bg-[#f3a446] text-white font-medium rounded-xl hover:bg-[#ffb35f] transition duration-300 shadow-lg hover:shadow-[#f3a446]/40">
                {{ __('app.login.login_button') }}
            </button>
        </form>

        <div class="mt-8">
            <div class="relative flex items-center justify-center">
                <span class="absolute w-full border-t border-white/20"></span>
                <span class="bg-transparent text-gray-300 px-4 z-10">{{ __('app.login.or_divider') }}</span>
            </div>

            <div class="grid grid-cols-2 gap-3 mt-6">
                <a href="#" class="flex justify-center items-center gap-2 py-2 border border-white/20 rounded-xl bg-white/10 hover:bg-white/20 transition">
                    <i class="fab fa-google text-red-400"></i>
                    <span class="text-gray-100 text-sm">{{ __('app.login.google_button') }}</span>
                </a>
                <a href="#" class="flex justify-center items-center gap-2 py-2 border border-white/20 rounded-xl bg-white/10 hover:bg-white/20 transition">
                    <i class="fab fa-facebook text-blue-400"></i>
                    <span class="text-gray-100 text-sm">{{ __('app.login.facebook_button') }}</span>
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