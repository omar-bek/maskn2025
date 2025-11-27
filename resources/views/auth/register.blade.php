@extends('layouts.app')

@section('title', __('app.register.title'))

@section('content')

<div class="min-h-screen relative flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-[#f8fafc] overflow-hidden font-tajawal selection:bg-[#f3a446] selection:text-white mt-20">
    
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-full bg-[#f8fafc]"></div>
        
        <div class="absolute -top-[10%] -right-[10%] w-[600px] h-[600px] bg-[#2f5c69] rounded-full mix-blend-multiply filter blur-[120px] opacity-[0.05] animate-blob"></div>
        <div class="absolute top-[40%] left-[5%] w-[500px] h-[500px] bg-[#f3a446] rounded-full mix-blend-multiply filter blur-[120px] opacity-[0.08] animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-[10%] right-[20%] w-[600px] h-[600px] bg-[#2f5c69] rounded-full mix-blend-multiply filter blur-[120px] opacity-[0.05] animate-blob animation-delay-4000"></div>

        <svg class="absolute inset-0 w-full h-full opacity-[0.4]" xmlns="http://www.w3.org/2000/svg">
            <pattern id="grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                <path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="#e2e8f0" stroke-width="1" fill="none"/>
            </pattern>
            <rect width="100%" height="100%" fill="url(#grid-pattern)"/>
        </svg>
    </div>

    <div class="w-full max-w-2xl z-10 relative perspective-1000">
        <div class="relative bg-gradient-to-b from-[#2f5c69] to-[#1a262a] rounded-3xl shadow-[0_25px_60px_-15px_rgba(47,92,105,0.4)] overflow-hidden transform transition-all duration-500 hover:shadow-[0_35px_70px_-15px_rgba(47,92,105,0.5)] animate-fade-in-up border border-white/10">
            
            <div class="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-[#f3a446] to-transparent opacity-50"></div>
            <div class="absolute bottom-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-[#2f5c69] to-transparent opacity-20"></div>

            <div class="p-8 sm:p-10 relative">
                <div class="text-center mb-10">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-[#1a262a] shadow-lg shadow-black/30 border border-white/5 mb-6 group relative overflow-hidden animate-float">
                        <div class="absolute inset-0 bg-gradient-to-tr from-[#2f5c69]/40 to-[#f3a446]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <i class="fas fa-user-plus text-3xl text-[#f3a446] drop-shadow-[0_0_15px_rgba(243,164,70,0.3)] transform group-hover:scale-110 transition-transform duration-500"></i>
                    </div>
                    
                    <h2 class="text-3xl font-bold text-white tracking-tight mb-2">{{ __('app.register.page_title') }}</h2>
                    <p class="text-sm text-gray-400 font-medium">
                        {{ __('app.register.have_account') }}
                        <a href="{{ route('login') }}" class="text-[#f3a446] hover:text-[#ffc278] transition-all duration-300 font-bold hover:underline decoration-2 underline-offset-4">
                            {{ __('app.register.login_link') }}
                        </a>
                    </p>
                </div>

                <form action="{{ route('register.post') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2 group">
                            <label for="name" class="block text-sm font-bold text-gray-300 ml-1 transition-colors group-focus-within:text-[#f3a446]">{{ __('app.register.name') }}</label>
                            <div class="relative transition-all duration-300 transform group-focus-within:scale-[1.01]">
                                <div class="absolute inset-y-0  pl-4 flex items-center pointer-events-none z-10">
                                    <i class="fas fa-user pr-3 text-gray-500 group-focus-within:text-[#f3a446] transition-colors duration-300"></i>
                                </div>
                                <input id="name" name="name" type="text" required value="{{ old('name') }}"
                                    class="block w-full pl-11 pr-8 py-3.5 bg-[#0a0f1c]/40 border border-white/10 rounded-xl text-gray-100 placeholder-gray-500 focus:ring-1 focus:ring-[#f3a446] focus:border-[#f3a446] transition-all duration-300 sm:text-sm shadow-inner backdrop-blur-sm"
                                    placeholder="{{ __('app.register.name') }}">
                            </div>
                            @error('name')
                                <p class="mt-1 text-xs text-red-400 font-medium flex items-center animate-shake"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 group">
                            <label for="email" class="block text-sm font-bold text-gray-300 ml-1 transition-colors group-focus-within:text-[#f3a446]">{{ __('app.register.email') }}</label>
                            <div class="relative transition-all duration-300 transform group-focus-within:scale-[1.01]">
                                <div class="absolute inset-y-0   pl-4 flex items-center pointer-events-none z-10">
                                    <i class="fas fa-envelope pr-3 text-gray-500 group-focus-within:text-[#f3a446] transition-colors duration-300"></i>
                                </div>
                                <input id="email" name="email" type="email" required value="{{ old('email') }}"
                                    class="block w-full pl-11 pr-8 py-3.5 bg-[#0a0f1c]/40 border border-white/10 rounded-xl text-gray-100 placeholder-gray-500 focus:ring-1 focus:ring-[#f3a446] focus:border-[#f3a446] transition-all duration-300 sm:text-sm shadow-inner backdrop-blur-sm"
                                    placeholder="name@example.com">
                            </div>
                            @error('email')
                                <p class="mt-1 text-xs text-red-400 font-medium flex items-center animate-shake"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2 group">
                            <label for="phone" class="block text-sm font-bold text-gray-300 ml-1 transition-colors group-focus-within:text-[#f3a446]">{{ __('app.register.phone') }}</label>
                            <div class="relative transition-all duration-300 transform group-focus-within:scale-[1.01]">
                                <div class="absolute inset-y-0 start-2 pl-4 flex items-center pointer-events-none z-10">
                                    <i class="fas fa-phone pr-3 text-gray-500 group-focus-within:text-[#f3a446] transition-colors duration-300"></i>
                                </div>
                                <input id="phone" name="phone" type="tel" required value="{{ old('phone') }}"
                                    class="block w-full pl-11 pr-8 py-3.5 bg-[#0a0f1c]/40 border border-white/10 rounded-xl text-gray-100 placeholder-gray-500 focus:ring-1 focus:ring-[#f3a446] focus:border-[#f3a446] transition-all duration-300 sm:text-sm shadow-inner backdrop-blur-sm"
                                    placeholder="01xxxxxxxxx">
                            </div>
                            @error('phone')
                                <p class="mt-1 text-xs text-red-400 font-medium flex items-center animate-shake"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 group">
                            <label for="user_type_id" class="block text-sm font-bold text-gray-300 ml-1 transition-colors group-focus-within:text-[#f3a446]">{{ __('app.register.account_type') }}</label>
                            <div class="relative transition-all duration-300 transform group-focus-within:scale-[1.01]">
                                <div class="absolute inset-y-0 pl-4 flex items-center pointer-events-none z-10">
                                    <i class="fas fa-briefcase pr-3 text-gray-500 group-focus-within:text-[#f3a446] transition-colors duration-300"></i>
                                </div>
                                <select id="user_type_id" name="user_type_id" required
                                    class="block w-full pl-11 pr-10 py-3.5 bg-[#0a0f1c]/40 border border-white/10 rounded-xl text-gray-100 placeholder-gray-500 focus:ring-1 focus:ring-[#f3a446] focus:border-[#f3a446] transition-all duration-300 sm:text-sm shadow-inner backdrop-blur-sm appearance-none">
                                    <option value="" class="bg-[#1a262a] text-gray-400">{{ __('app.register.select_account_type') }}</option>
                                    @if(isset($userTypes) && $userTypes->count() > 0)
                                        @foreach($userTypes as $userType)
                                            <option value="{{ $userType->id }}" class="bg-[#1a262a]" {{ old('user_type_id') == $userType->id ? 'selected' : '' }}>
                                                {{ $userType->display_name_ar }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="1" class="bg-[#1a262a]">{{ __('app.register.user_type_customer') }}</option>
                                        <option value="2" class="bg-[#1a262a]">{{ __('app.register.user_type_consultant') }}</option>
                                        <option value="3" class="bg-[#1a262a]">{{ __('app.register.user_type_contractor') }}</option>
                                        <option value="4" class="bg-[#1a262a]">{{ __('app.register.user_type_supplier') }}</option>
                                    @endif
                                </select>
                                <div class="absolute inset-y-0 end-3 flex items-center px-2 pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-500 text-xs mr-2"></i>
                                </div>
                            </div>
                            @error('user_type_id')
                                <p class="mt-1 text-xs text-red-400 font-medium flex items-center animate-shake"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2 group">
                            <label for="password" class="block text-sm font-bold text-gray-300 ml-1 transition-colors group-focus-within:text-[#f3a446]">{{ __('app.register.password') }}</label>
                            <div class="relative transition-all duration-300 transform group-focus-within:scale-[1.01]">
                                <div class="absolute inset-y-0 pl-4 flex items-center pointer-events-none z-10">
                                    <i class="fas fa-lock pr-3 text-gray-500 group-focus-within:text-[#f3a446] transition-colors duration-300"></i>
                                </div>
                                <input id="password" name="password" type="password" required
                                    class="block w-full pl-11 pr-8 py-3.5 bg-[#0a0f1c]/40 border border-white/10 rounded-xl text-gray-100 placeholder-gray-500 focus:ring-1 focus:ring-[#f3a446] focus:border-[#f3a446] transition-all duration-300 sm:text-sm shadow-inner backdrop-blur-sm"
                                    placeholder="••••••••">
                            </div>
                            @error('password')
                                <p class="mt-1 text-xs text-red-400 font-medium flex items-center animate-shake"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 group">
                            <label for="password_confirmation" class="block text-sm font-bold text-gray-300 ml-1 transition-colors group-focus-within:text-[#f3a446]">{{ __('app.register.password_confirmation') }}</label>
                            <div class="relative transition-all duration-300 transform group-focus-within:scale-[1.01]">
                                <div class="absolute inset-y-0  pl-4 flex items-center pointer-events-none z-10">
                                    <i class="fas fa-shield-alt pr-3 text-gray-500 group-focus-within:text-[#f3a446] transition-colors duration-300"></i>
                                </div>
                                <input id="password_confirmation" name="password_confirmation" type="password" required
                                    class="block w-full pl-11 pr-8 py-3.5 bg-[#0a0f1c]/40 border border-white/10 rounded-xl text-gray-100 placeholder-gray-500 focus:ring-1 focus:ring-[#f3a446] focus:border-[#f3a446] transition-all duration-300 sm:text-sm shadow-inner backdrop-blur-sm"
                                    placeholder="••••••••">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 pt-2">
                        <input id="terms" name="terms" type="checkbox" required
                            class="h-2 w-2 text-[#f3a446] bg-[#0a0f1c]/50 border-white/20 rounded focus:ring-[#f3a446] focus:ring-offset-0 focus:ring-offset-[#1a262a] transition-all duration-200 cursor-pointer hover:border-[#f3a446]">
                        <label for="terms" class="text-xs sm:text-sm text-gray-400 select-none">
                            {{ __('app.register.terms_agree') }} 
                            <button type="button" onclick="toggleModal('termsModal')" class="text-[#f3a446] hover:text-white transition-colors duration-200 underline decoration-1 underline-offset-2 focus:outline-none">
                                {{ __('app.register.terms_link') }}
                            </button> 
                            {{ __('app.register.terms_and') }}
                            <button type="button" onclick="toggleModal('privacyModal')" class="text-[#f3a446] hover:text-white transition-colors duration-200 underline decoration-1 underline-offset-2 focus:outline-none">
                                {{ __('app.register.privacy_link') }}
                            </button>
                        </label>
                    </div>

                    <button type="submit"
                        class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-gradient-to-r from-[#f3a446] to-[#d18a3a] hover:from-[#ffc278] hover:to-[#e69c45] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#f3a446] focus:ring-offset-[#1a262a] shadow-[0_4px_20px_rgba(243,164,70,0.25)] hover:shadow-[0_4px_25px_rgba(243,164,70,0.4)] transition-all duration-300 transform hover:-translate-y-1 active:scale-[0.98] overflow-hidden">
                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 skew-y-12"></div>
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-user-plus text-white/80 group-hover:text-white group-hover:translate-x-1 transition-all duration-300"></i>
                        </span>
                        <span class="relative uppercase tracking-wider">{{ __('app.register.create_account_button') }}</span>
                    </button>
                </form>

                <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-white/10"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-[#1e282d] text-gray-400 rounded-full border border-white/5">{{ __('app.register.or_divider') }}</span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <a href="#" class="relative flex items-center justify-center w-full px-4 py-3 border border-white/10 rounded-xl shadow-lg bg-[#0a0f1c]/30 text-sm font-bold text-gray-300 hover:bg-[#2f5c69] hover:border-[#f3a446]/30 hover:text-white transition-all duration-300 group overflow-hidden">
                            <i class="fab fa-google text-red-500 text-lg mr-2 group-hover:text-white transition-colors relative z-10"></i>
                            <span class="relative z-10">{{ __('app.register.google_button') }}</span>
                        </a>
                        <a href="#" class="relative flex items-center justify-center w-full px-4 py-3 border border-white/10 rounded-xl shadow-lg bg-[#0a0f1c]/30 text-sm font-bold text-gray-300 hover:bg-[#2f5c69] hover:border-[#f3a446]/30 hover:text-white transition-all duration-300 group overflow-hidden">
                            <i class="fab fa-facebook text-blue-500 text-lg mr-2 group-hover:text-white transition-colors relative z-10"></i>
                            <span class="relative z-10">{{ __('app.register.facebook_button') }}</span>
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<div id="termsModal" class="fixed inset-0 z-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm transition-opacity" onclick="toggleModal('termsModal')"></div>
    <div class="relative bg-white rounded-2xl w-full max-w-4xl max-h-[85vh] m-4 shadow-[0_25px_50px_-12px_rgba(0,0,0,0.5)] border border-gray-100 transform scale-95 transition-all duration-300 flex flex-col modal-content overflow-hidden">
        
        <div class="flex items-center justify-between p-6 bg-gradient-to-r from-[#2f5c69] to-[#1a262a] border-b-4 border-[#f3a446]">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-white/10 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-scroll text-[#f3a446] text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white tracking-wide">{{ __('app.terms.title') }}</h3>
            </div>
            <button onclick="toggleModal('termsModal')" class="w-8 h-8 flex items-center justify-center rounded-full bg-white/10 text-white/80 hover:bg-white/20 hover:text-white transition-all duration-200 focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="p-8 overflow-y-auto custom-scrollbar text-start text-gray-600 text-sm leading-relaxed bg-white relative" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
             <div class="absolute inset-0 flex items-center justify-center opacity-[0.02] pointer-events-none">
                <i class="fas fa-building text-[400px]"></i>
            </div>
            
            <div class="relative z-10">
                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.terms.intro_title') }}
                </h4>
                <p class="mb-6 leading-8 border-gray-100 {{ app()->getLocale() == 'ar' ? 'border-r-2 pr-4' : 'border-l-2 pl-4' }}">
                    {{ __('app.terms.intro_text') }}
                </p>

                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.terms.definitions_title') }}
                </h4>
                <ul class="list-none space-y-3 mb-6 {{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check-circle text-[#f3a446] mt-1 text-xs"></i>
                        <span><strong class="text-[#2f5c69]">{{ __('app.terms.platform') }}</strong> {{ __('app.terms.platform_desc') }}</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check-circle text-[#f3a446] mt-1 text-xs"></i>
                        <span><strong class="text-[#2f5c69]">{{ __('app.terms.user') }}</strong> {{ __('app.terms.user_desc') }}</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check-circle text-[#f3a446] mt-1 text-xs"></i>
                        <span><strong class="text-[#2f5c69]">{{ __('app.terms.client') }}</strong> {{ __('app.terms.client_desc') }}</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check-circle text-[#f3a446] mt-1 text-xs"></i>
                        <span><strong class="text-[#2f5c69]">{{ __('app.terms.provider') }}</strong> {{ __('app.terms.provider_desc') }}</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check-circle text-[#f3a446] mt-1 text-xs"></i>
                        <span><strong class="text-[#2f5c69]">{{ __('app.terms.services') }}</strong> {{ __('app.terms.services_desc') }}</span>
                    </li>
                </ul>

                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.terms.eligibility_title') }}
                </h4>
                <ul class="list-none space-y-2 mb-6 border-gray-100 {{ app()->getLocale() == 'ar' ? 'pr-2 border-r-2' : 'pl-2 border-l-2' }}">
                    <li class="flex items-center gap-2 before:content-[''] before:w-1.5 before:h-1.5 before:bg-[#2f5c69] before:rounded-full {{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.terms.eligibility_1') }}</li>
                    <li class="flex items-center gap-2 before:content-[''] before:w-1.5 before:h-1.5 before:bg-[#2f5c69] before:rounded-full {{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.terms.eligibility_2') }}</li>
                    <li class="flex items-center gap-2 before:content-[''] before:w-1.5 before:h-1.5 before:bg-[#2f5c69] before:rounded-full {{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.terms.eligibility_3') }}</li>
                    <li class="flex items-center gap-2 before:content-[''] before:w-1.5 before:h-1.5 before:bg-[#2f5c69] before:rounded-full {{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.terms.eligibility_4') }}</li>
                </ul>

                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.terms.usage_title') }}
                </h4>
                <ul class="list-none space-y-2 mb-6 border-gray-100 {{ app()->getLocale() == 'ar' ? 'pr-2 border-r-2' : 'pl-2 border-l-2' }}">
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }} text-gray-700">{{ __('app.terms.usage_1') }}</li>
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }} text-gray-700">{{ __('app.terms.usage_2') }}</li>
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }} text-gray-700">{{ __('app.terms.usage_3') }}</li>
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }} text-gray-700">{{ __('app.terms.usage_4') }}</li>
                </ul>

                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                      <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.terms.verification_title') }}
                </h4>
                <p class="mb-2 leading-7">{{ __('app.terms.verification_text') }}</p>
                <ul class="list-none space-y-2 mb-6 border-gray-100 {{ app()->getLocale() == 'ar' ? 'pr-2 border-r-2' : 'pl-2 border-l-2' }}">
                    <li class="flex items-center gap-2 before:content-[''] before:w-1.5 before:h-1.5 before:bg-[#2f5c69] before:rounded-full {{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.terms.verification_1') }}</li>
                    <li class="flex items-center gap-2 before:content-[''] before:w-1.5 before:h-1.5 before:bg-[#2f5c69] before:rounded-full {{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.terms.verification_2') }}</li>
                </ul>

                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                      <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.terms.contracts_title') }}
                </h4>
                <ul class="list-none space-y-2 mb-6 border-gray-100 {{ app()->getLocale() == 'ar' ? 'pr-2 border-r-2' : 'pl-2 border-l-2' }}">
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.terms.contracts_1') }}</li>
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.terms.contracts_2') }}</li>
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.terms.contracts_3') }}</li>
                </ul>

                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                      <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.terms.payment_title') }}
                </h4>
                <ul class="list-none space-y-2 mb-6 border-gray-100 {{ app()->getLocale() == 'ar' ? 'pr-2 border-r-2' : 'pl-2 border-l-2' }}">
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.terms.payment_1') }}</li>
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.terms.payment_2') }}</li>
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.terms.payment_3') }}</li>
                </ul>

                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                      <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.terms.reviews_title') }}
                </h4>
                <ul class="list-none space-y-2 mb-6 border-gray-100 {{ app()->getLocale() == 'ar' ? 'pr-2 border-r-2' : 'pl-2 border-l-2' }}">
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.terms.reviews_1') }}</li>
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.terms.reviews_2') }}</li>
                </ul>

                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                      <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.terms.ip_title') }}
                </h4>
                <p class="mb-6 leading-8 border-gray-100 {{ app()->getLocale() == 'ar' ? 'border-r-2 pr-4' : 'border-l-2 pl-4' }}">
                    {{ __('app.terms.ip_text') }}
                </p>

                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                      <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.terms.suspension_title') }}
                </h4>
                <p class="mb-2">{{ __('app.terms.suspension_text') }}</p>
                <ul class="list-none space-y-2 mb-6 border-gray-100 {{ app()->getLocale() == 'ar' ? 'pr-2 border-r-2' : 'pl-2 border-l-2' }}">
                    <li class="flex items-center gap-2 before:content-[''] before:w-1.5 before:h-1.5 before:bg-[#2f5c69] before:rounded-full {{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.terms.suspension_1') }}</li>
                    <li class="flex items-center gap-2 before:content-[''] before:w-1.5 before:h-1.5 before:bg-[#2f5c69] before:rounded-full {{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.terms.suspension_2') }}</li>
                    <li class="flex items-center gap-2 before:content-[''] before:w-1.5 before:h-1.5 before:bg-[#2f5c69] before:rounded-full {{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.terms.suspension_3') }}</li>
                </ul>

                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                      <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.terms.disclaimer_title') }}
                </h4>
                <ul class="list-none space-y-2 mb-6 border-gray-100 {{ app()->getLocale() == 'ar' ? 'pr-2 border-r-2' : 'pl-2 border-l-2' }}">
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.terms.disclaimer_1') }}</li>
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.terms.disclaimer_2') }}</li>
                </ul>

                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                      <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.terms.amendments_title') }}
                </h4>
                <p class="mb-2 leading-8 border-gray-100 {{ app()->getLocale() == 'ar' ? 'border-r-2 pr-4' : 'border-l-2 pl-4' }}">
                    {{ __('app.terms.amendments_text') }}
                </p>
            </div>
        </div>
        
        <div class="p-6 bg-[#eff6f8] border-t border-[#e2e8f0] flex justify-end">
            <button onclick="toggleModal('termsModal')" class="px-8 py-2.5 bg-gradient-to-r from-[#f3a446] to-[#d18a3a] hover:from-[#ffc278] hover:to-[#e69c45] text-white font-bold rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5 flex items-center gap-2">
                <i class="fas fa-check"></i>
                {{ __('app.terms.agree_button') }}
            </button>
        </div>
    </div>
</div>

<div id="privacyModal" class="fixed inset-0 z-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm transition-opacity" onclick="toggleModal('privacyModal')"></div>
    <div class="relative bg-white rounded-2xl w-full max-w-4xl max-h-[85vh] m-4 shadow-[0_25px_50px_-12px_rgba(0,0,0,0.5)] border border-gray-100 transform scale-95 transition-all duration-300 flex flex-col modal-content overflow-hidden">
        
        <div class="flex items-center justify-between p-6 bg-gradient-to-r from-[#2f5c69] to-[#1a262a] border-b-4 border-[#f3a446]">
            <div class="flex items-center gap-3">
                 <div class="p-2 bg-white/10 rounded-lg backdrop-blur-sm">
                    <i class="fas fa-shield-alt text-[#f3a446] text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white tracking-wide">{{ __('app.privacy.title') }}</h3>
            </div>
            <button onclick="toggleModal('privacyModal')" class="w-8 h-8 flex items-center justify-center rounded-full bg-white/10 text-white/80 hover:bg-white/20 hover:text-white transition-all duration-200 focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="p-8 overflow-y-auto custom-scrollbar text-start text-gray-600 text-sm leading-relaxed bg-white relative" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
             <div class="absolute inset-0 flex items-center justify-center opacity-[0.02] pointer-events-none">
                <i class="fas fa-user-shield text-[400px]"></i>
            </div>

            <div class="relative z-10">
                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                      <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.privacy.intro_title') }}
                </h4>
                <p class="mb-6 leading-8 border-gray-100 {{ app()->getLocale() == 'ar' ? 'border-r-2 pr-4' : 'border-l-2 pl-4' }}">
                    {{ __('app.privacy.intro_text') }}
                </p>

                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                      <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.privacy.data_title') }}
                </h4>
                <ul class="list-none space-y-3 mb-6 {{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-dot-circle text-[#f3a446] mt-1.5 text-[8px]"></i>
                        <span><strong class="text-[#2f5c69]">{{ __('app.privacy.personal_data') }}</strong> {{ __('app.privacy.personal_data_desc') }}</span>
                    </li>
                    <li class="flex items-start gap-2">
                         <i class="fas fa-dot-circle text-[#f3a446] mt-1.5 text-[8px]"></i>
                        <span><strong class="text-[#2f5c69]">{{ __('app.privacy.project_data') }}</strong> {{ __('app.privacy.project_data_desc') }}</span>
                    </li>
                    <li class="flex items-start gap-2">
                         <i class="fas fa-dot-circle text-[#f3a446] mt-1.5 text-[8px]"></i>
                        <span><strong class="text-[#2f5c69]">{{ __('app.privacy.tech_data') }}</strong> {{ __('app.privacy.tech_data_desc') }}</span>
                    </li>
                    <li class="flex items-start gap-2">
                         <i class="fas fa-dot-circle text-[#f3a446] mt-1.5 text-[8px]"></i>
                        <span><strong class="text-[#2f5c69]">{{ __('app.privacy.interaction_data') }}</strong> {{ __('app.privacy.interaction_data_desc') }}</span>
                    </li>
                </ul>

                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                      <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.privacy.usage_title') }}
                </h4>
                <ul class="list-none space-y-2 mb-6 border-gray-100 {{ app()->getLocale() == 'ar' ? 'pr-2 border-r-2' : 'pl-2 border-l-2' }}">
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.usage_1') }}</li>
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.usage_2') }}</li>
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.usage_3') }}</li>
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.usage_4') }}</li>
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.usage_5') }}</li>
                </ul>

                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                      <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.privacy.legal_title') }}
                </h4>
                <p class="mb-2">{{ __('app.privacy.legal_text') }}</p>
                <ul class="list-none space-y-2 mb-6 border-gray-100 {{ app()->getLocale() == 'ar' ? 'pr-2 border-r-2' : 'pl-2 border-l-2' }}">
                    <li class="flex items-center gap-2 before:content-[''] before:w-1.5 before:h-1.5 before:bg-[#2f5c69] before:rounded-full {{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.legal_1') }}</li>
                    <li class="flex items-center gap-2 before:content-[''] before:w-1.5 before:h-1.5 before:bg-[#2f5c69] before:rounded-full {{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.legal_2') }}</li>
                    <li class="flex items-center gap-2 before:content-[''] before:w-1.5 before:h-1.5 before:bg-[#2f5c69] before:rounded-full {{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.legal_3') }}</li>
                    <li class="flex items-center gap-2 before:content-[''] before:w-1.5 before:h-1.5 before:bg-[#2f5c69] before:rounded-full {{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.legal_4') }}</li>
                </ul>

                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                      <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.privacy.sharing_title') }}
                </h4>
                <p class="mb-2">{{ __('app.privacy.sharing_text') }}</p>
                <ul class="list-none space-y-2 mb-5 border-gray-100 {{ app()->getLocale() == 'ar' ? 'pr-2 border-r-2' : 'pl-2 border-l-2' }}">
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.sharing_1') }}</li>
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.sharing_2') }}</li>
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.sharing_3') }}</li>
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.sharing_4') }}</li>
                </ul>
                <p class="mb-6 text-[#d13a3a] font-bold bg-[#f3a446]/5 p-4 rounded-xl border border-[#f3a446]/20 flex items-center gap-3">
                    <i class="fas fa-exclamation-triangle text-[#f34646]"></i>
                    {{ __('app.privacy.selling_warning') }}
                </p>

                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                      <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.privacy.protection_title') }}
                </h4>
                <ul class="list-none space-y-2 mb-6 border-gray-100 {{ app()->getLocale() == 'ar' ? 'pr-2 border-r-2' : 'pl-2 border-l-2' }}">
                    <li class="flex items-center gap-2 before:content-[''] before:w-1.5 before:h-1.5 before:bg-[#2f5c69] before:rounded-full {{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.protection_1') }}</li>
                    <li class="flex items-center gap-2 before:content-[''] before:w-1.5 before:h-1.5 before:bg-[#2f5c69] before:rounded-full {{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.protection_2') }}</li>
                    <li class="flex items-center gap-2 before:content-[''] before:w-1.5 before:h-1.5 before:bg-[#2f5c69] before:rounded-full {{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.protection_3') }}</li>
                </ul>

                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                      <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.privacy.rights_title') }}
                </h4>
                <ul class="list-none space-y-2 mb-6 border-gray-100 {{ app()->getLocale() == 'ar' ? 'pr-2 border-r-2' : 'pl-2 border-l-2' }}">
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.rights_1') }}</li>
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.rights_2') }}</li>
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.rights_3') }}</li>
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.rights_4') }}</li>
                </ul>

                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                      <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.privacy.retention_title') }}
                </h4>
                <ul class="list-none space-y-2 mb-6 border-gray-100 {{ app()->getLocale() == 'ar' ? 'pr-2 border-r-2' : 'pl-2 border-l-2' }}">
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.retention_1') }}</li>
                    <li class="{{ app()->getLocale() == 'ar' ? 'pr-2' : 'pl-2' }}">{{ __('app.privacy.retention_2') }}</li>
                </ul>

                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                      <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.privacy.cookies_title') }}</h4>
                <p class="mb-6 leading-8 border-gray-100 {{ app()->getLocale() == 'ar' ? 'border-r-2 pr-4' : 'border-l-2 pl-4' }}">
                    {{ __('app.privacy.cookies_text') }}
                </p>

                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                      <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.privacy.transfer_title') }}
                </h4>
                <p class="mb-6 leading-8 border-gray-100 {{ app()->getLocale() == 'ar' ? 'border-r-2 pr-4' : 'border-l-2 pl-4' }}">
                    {{ __('app.privacy.transfer_text') }}
                </p>

                <h4 class="text-[#2f5c69] font-bold mb-3 text-lg flex items-center gap-2">
                      <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                    {{ __('app.privacy.updates_title') }}
                </h4>
                <p class="mb-6 leading-8 border-gray-100 {{ app()->getLocale() == 'ar' ? 'border-r-2 pr-4' : 'border-l-2 pl-4' }}">
                    {{ __('app.privacy.updates_text') }}
                </p>
            </div>
        </div>
        
        <div class="p-6 bg-[#eff6f8] border-t border-[#e2e8f0] flex justify-end">
            <button onclick="toggleModal('privacyModal')" class="px-8 py-2.5 bg-gradient-to-r from-[#f3a446] to-[#d18a3a] hover:from-[#ffc278] hover:to-[#e69c45] text-white font-bold rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5 flex items-center gap-2">
                 <i class="fas fa-check"></i>
                {{ __('app.privacy.agree_button') }}
            </button>
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

    /* Custom Scrollbar for Light Mode */
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9; /* Light gray track */
        border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1; /* Gray-300 thumb */
        border-radius: 4px;
        transition: background-color 0.2s;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #2f5c69; /* Brand Teal on hover */
    }
</style>

<script>
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        const modalContent = modal.querySelector('.modal-content');
        
        if (modal.classList.contains('opacity-0')) {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            setTimeout(() => {
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 10);
            document.body.style.overflow = 'hidden';
        } else {
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            modal.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = 'auto';
        }
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            const openModals = document.querySelectorAll('[role="dialog"]:not(.opacity-0)');
            openModals.forEach(modal => toggleModal(modal.id));
        }
    });
</script>

@endsection