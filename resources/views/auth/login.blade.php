@extends('layouts.app')

@section('title', __('app.login.title'))

@section('content')

<div class="min-h-screen relative flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-[#f8fafc] overflow-hidden font-tajawal selection:bg-[#f3a446] selection:text-white mt-20">
    
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-full bg-[#f8fafc]"></div>
        
        <div class="absolute -top-[10%] -left-[10%] w-[600px] h-[600px] bg-[#2f5c69] rounded-full mix-blend-multiply filter blur-[120px] opacity-[0.05] animate-blob"></div>
        <div class="absolute top-[30%] right-[5%] w-[500px] h-[500px] bg-[#f3a446] rounded-full mix-blend-multiply filter blur-[120px] opacity-[0.08] animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-[10%] left-[20%] w-[600px] h-[600px] bg-[#2f5c69] rounded-full mix-blend-multiply filter blur-[120px] opacity-[0.05] animate-blob animation-delay-4000"></div>

        <svg class="absolute inset-0 w-full h-full opacity-[0.4]" xmlns="http://www.w3.org/2000/svg">
            <pattern id="grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                <path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="#e2e8f0" stroke-width="1" fill="none"/>
            </pattern>
            <rect width="100%" height="100%" fill="url(#grid-pattern)"/>
        </svg>
    </div>

    <div class="w-full max-w-[500px] z-10 relative perspective-1000">
        <div class="relative bg-gradient-to-b from-[#2f5c69] to-[#1a262a] rounded-3xl shadow-[0_25px_60px_-15px_rgba(47,92,105,0.4)] overflow-hidden transform transition-all duration-500 hover:shadow-[0_35px_70px_-15px_rgba(47,92,105,0.5)] animate-fade-in-up border border-white/10">
            
            <div class="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-[#f3a446] to-transparent opacity-50"></div>
            <div class="absolute bottom-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-[#2f5c69] to-transparent opacity-20"></div>

            <div class="p-8 sm:p-10 relative">
                <div class="text-center mb-10">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-[#1a262a] shadow-lg shadow-black/30 border border-white/5 mb-6 group relative overflow-hidden animate-float">
                        <div class="absolute inset-0 bg-gradient-to-tr from-[#2f5c69]/40 to-[#f3a446]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <i class="fas fa-fingerprint text-3xl text-[#f3a446] drop-shadow-[0_0_15px_rgba(243,164,70,0.3)] transform group-hover:scale-110 transition-transform duration-500"></i>
                    </div>
                    
                    <h2 class="text-3xl font-bold text-white tracking-tight mb-2">{{ __('app.login.page_title') }}</h2>
                    <p class="text-sm text-gray-400 font-medium">
                        {{ __('app.login.no_account') }}
                        <a href="{{ route('register') }}" class="text-[#f3a446] hover:text-[#ffc278] transition-all duration-300 font-bold hover:underline decoration-2 underline-offset-4">
                            {{ __('app.login.create_account_link') }}
                        </a>
                    </p>
                </div>

                <form class="space-y-6" action="{{ route('login.post') }}" method="POST">
                    @csrf

                    <div class="space-y-2 group">
                        <label for="email" class="block text-sm font-bold text-gray-300 ml-1 transition-colors group-focus-within:text-[#f3a446]">{{ __('app.login.email') }}</label>
                        <div class="relative transition-all duration-300 transform group-focus-within:scale-[1.01]">
                            <div class="absolute inset-y-0 pl-4 flex items-center pointer-events-none z-10">
                                <i class="fas fa-envelope pr-3 text-gray-500 group-focus-within:text-[#f3a446] transition-colors duration-300"></i>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                value="{{ old('email') }}"
                                class="block w-full pl-11 pr-8 py-4 bg-[#0a0f1c]/40 border border-white/10 rounded-xl text-gray-100 placeholder-gray-500 focus:ring-1 focus:ring-[#f3a446] focus:border-[#f3a446] transition-all duration-300 sm:text-sm shadow-inner backdrop-blur-sm"
                                placeholder="name@example.com">
                        </div>
                        @error('email')
                            <p class="mt-1 text-xs text-red-400 font-medium flex items-center animate-shake"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2 group">
                        <div class="flex items-center justify-between ml-1">
                            <label for="password" class="block text-sm font-bold text-gray-300 transition-colors group-focus-within:text-[#f3a446]">{{ __('app.login.password') }}</label>
                        </div>
                        <div class="relative transition-all duration-300 transform group-focus-within:scale-[1.01]">
                            <div class="absolute inset-y-0  pl-4 flex items-center pointer-events-none z-10">
                                <i class="fas fa-lock pr-3 text-gray-500 group-focus-within:text-[#f3a446] transition-colors duration-300"></i>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                class="block w-full pl-11 pr-8 py-4 bg-[#0a0f1c]/40 border border-white/10 rounded-xl text-gray-100 placeholder-gray-500 focus:ring-1 focus:ring-[#f3a446] focus:border-[#f3a446] transition-all duration-300 sm:text-sm shadow-inner backdrop-blur-sm"
                                placeholder="••••••••">
                        </div>
                        @error('password')
                            <p class="mt-1 text-xs text-red-400 font-medium flex items-center animate-shake"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox"
                                class="h-4 w-4 text-[#f3a446] bg-[#0a0f1c]/50 border-white/20 rounded focus:ring-[#f3a446] focus:ring-offset-0 focus:ring-offset-[#1a262a] transition-all duration-200 cursor-pointer hover:border-[#f3a446]">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-400 cursor-pointer select-none hover:text-white transition-colors">
                                {{ __('app.login.remember_me') }}
                            </label>
                        </div>
                        
                        <a href="{{ route('password.request') }}" class="text-sm font-bold text-gray-400 hover:text-[#f3a446] transition-colors duration-300 hover:underline">
                            {{ __('app.login.forgot_password_link') }}
                        </a>
                    </div>

                    <button type="submit"
                        class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-gradient-to-r from-[#f3a446] to-[#d18a3a] hover:from-[#ffc278] hover:to-[#e69c45] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#f3a446] focus:ring-offset-[#1a262a] shadow-[0_4px_20px_rgba(243,164,70,0.25)] hover:shadow-[0_4px_25px_rgba(243,164,70,0.4)] transition-all duration-300 transform hover:-translate-y-1 active:scale-[0.98] overflow-hidden">
                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 skew-y-12"></div>
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-arrow-right text-white/80 group-hover:text-white group-hover:translate-x-1 transition-all duration-300"></i>
                        </span>
                        <span class="relative uppercase tracking-wider">{{ __('app.login.login_button') }}</span>
                    </button>
                </form>

                <!-- <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-white/10"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-[#1e282d] text-gray-400 rounded-full border border-white/5">{{ __('app.login.or_divider') }}</span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <a href="#" class="relative flex items-center justify-center w-full px-4 py-3 border border-white/10 rounded-xl shadow-lg bg-[#0a0f1c]/30 text-sm font-bold text-gray-300 hover:bg-[#2f5c69] hover:border-[#f3a446]/30 hover:text-white transition-all duration-300 group overflow-hidden">
                            <i class="fab fa-google text-red-500 text-lg mr-2 group-hover:text-white transition-colors relative z-10"></i>
                            <span class="relative z-10">{{ __('app.login.google_button') }}</span>
                        </a>
                        <a href="#" class="relative flex items-center justify-center w-full px-4 py-3 border border-white/10 rounded-xl shadow-lg bg-[#0a0f1c]/30 text-sm font-bold text-gray-300 hover:bg-[#2f5c69] hover:border-[#f3a446]/30 hover:text-white transition-all duration-300 group overflow-hidden">
                            <i class="fab fa-facebook text-blue-500 text-lg mr-2 group-hover:text-white transition-colors relative z-10"></i>
                            <span class="relative z-10">{{ __('app.login.facebook_button') }}</span>
                        </a>
                    </div>
                </div> -->
            </div>
            
            
        </div>
    </div>
</div>

<style>
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
        100% { transform: translateY(0px); }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-4px); }
        20%, 40%, 60%, 80% { transform: translateX(4px); }
    }
    .animate-blob { animation: blob 10s infinite alternate cubic-bezier(0.4, 0, 0.2, 1); }
    .animate-float { animation: float 5s ease-in-out infinite; }
    .animate-fade-in-up { animation: fadeInUp 0.7s ease-out forwards; }
    .animate-shake { animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both; }
    .animation-delay-2000 { animation-delay: 2s; }
    .animation-delay-4000 { animation-delay: 4s; }
    .font-tajawal { font-family: 'Tajawal', sans-serif; }
    .perspective-1000 { perspective: 1000px; }
</style>

@endsection