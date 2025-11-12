@extends('layouts.app')

@section('title', __('app.profile.title'))

@section('content')

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .profile-card {
        opacity: 0;
        animation: fadeInUp 0.7s ease-out forwards;
    }
    
    .profile-card:nth-child(1) { animation-delay: 0.1s; }
    .profile-card:nth-child(2) { animation-delay: 0.3s; }
    .profile-card:nth-child(3) { animation-delay: 0.5s; }
</style>

<div class="min-h-screen bg-gray-50 text-gray-900" dir="rtl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-3xl mx-auto">
            
            <div class="mb-10 profile-card">
                <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-[#2f5c69] to-[#f3a446] mb-2">{{ __('app.profile.page_title') }}</h1>
                <p class="text-gray-600 text-lg">{{ __('app.profile.page_subtitle') }}</p>
            </div>

            <div class="bg-gradient-to-br from-[#1a262a] to-[#2f5c69] text-white rounded-2xl shadow-2xl profile-card">
                <div class="px-6 py-5 border-b border-white/10">
                    <h3 class="text-xl font-semibold text-white">{{ __('app.profile.info_card.title') }}</h3>
                </div>

                <div class="p-6 sm:p-8">
                    <form action="#" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-300">
                                    {{ __('app.profile.info_card.name') }}
                                </label>
                                <input type="text" name="name" id="name" value="{{ $user->name }}"
                                       class="mt-2 block w-full bg-white/5 border-white/20 rounded-md shadow-sm text-white focus:ring-[#f3a446] focus:border-[#f3a446] sm:text-sm transition duration-300">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-300">
                                    {{ __('app.profile.info_card.email') }}
                                </label>
                                <input type="email" name="email" id="email" value="{{ $user->email }}"
                                       class="mt-2 block w-full bg-white/5 border-white/20 rounded-md shadow-sm text-white focus:ring-[#f3a446] focus:border-[#f3a446] sm:text-sm transition duration-300">
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-300">
                                    {{ __('app.profile.info_card.phone') }}
                                </label>
                                <input type="tel" name="phone" id="phone" value="{{ $user->phone }}"
                                       class="mt-2 block w-full bg-white/5 border-white/20 rounded-md shadow-sm text-white focus:ring-[#f3a446] focus:border-[#f3a446] sm:text-sm transition duration-300">
                            </div>

                            <div>
                                <label for="user_type" class="block text-sm font-medium text-gray-300">
                                    {{ __('app.profile.info_card.account_type') }}
                                </label>
                                <input type="text" id="user_type" value="{{ $user->userType->display_name_ar }}" readonly
                                       class="mt-2 block w-full bg-white/10 border-white/20 rounded-md shadow-sm text-gray-300 cursor-not-allowed sm:text-sm">
                            </div>
                        </div>

                        <div class="mt-8">
                            <button type="submit" class="inline-flex items-center justify-center px-6 py-2 border border-transparent text-sm font-bold rounded-md text-[#1a262a] bg-[#f3a446] hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#f3a446] focus:ring-offset-[#1a262a] transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <i class="fas fa-save ml-2"></i>
                                {{ __('app.profile.info_card.save_button') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-gradient-to-br from-[#1a262a] to-[#2f5c69] text-white rounded-2xl shadow-2xl mt-8 profile-card">
                <div class="px-6 py-5 border-b border-white/10">
                    <h3 class="text-xl font-semibold text-white">{{ __('app.profile.password_card.title') }}</h3>
                </div>

                <div class="p-6 sm:p-8">
                    <form action="#" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2">
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-300">
                                    {{ __('app.profile.password_card.current_password') }}
                                </label>
                                <input type="password" name="current_password" id="current_password"
                                       class="mt-2 block w-full bg-white/5 border-white/20 rounded-md shadow-sm text-white focus:ring-[#f3a446] focus:border-[#f3a446] sm:text-sm transition duration-300">
                            </div>

                            <div></div>

                            <div>
                                <label for="new_password" class="block text-sm font-medium text-gray-300">
                                    {{ __('app.profile.password_card.new_password') }}
                                </label>
                                <input type="password" name="new_password" id="new_password"
                                       class="mt-2 block w-full bg-white/5 border-white/20 rounded-md shadow-sm text-white focus:ring-[#f3a446] focus:border-[#f3a446] sm:text-sm transition duration-300">
                            </div>

                            <div>
                                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-300">
                                    {{ __('app.profile.password_card.confirm_password') }}
                                </label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                       class="mt-2 block w-full bg-white/5 border-white/20 rounded-md shadow-sm text-white focus:ring-[#f3a446] focus:border-[#f3a446] sm:text-sm transition duration-300">
                            </div>
                        </div>

                        <div class="mt-8">
                            <button type="submit" class="inline-flex items-center justify-center px-6 py-2 border border-[#f3a446] text-sm font-bold rounded-md text-[#f3a446] bg-transparent hover:bg-[#f3a446]/10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#f3a446] focus:ring-offset-[#1a262a] transition-all duration-300 transform hover:scale-105">
                                <i class="fas fa-key ml-2"></i>
                                {{ __('app.profile.password_card.update_button') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-gradient-to-br from-[#1a262a] to-[#2f5c69] text-white rounded-2xl shadow-2xl mt-8 profile-card">
                <div class="px-6 py-5 border-b border-white/10">
                    <h3 class="text-xl font-semibold text-white">{{ __('app.profile.settings_card.title') }}</h3>
                </div>

                <div class="p-6 sm:p-8">
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-white">{{ __('app.profile.settings_card.email_notifications') }}</h4>
                                <p class="text-sm text-gray-300">{{ __('app.profile.settings_card.email_notifications_desc') }}</p>
                            </div>
                            <button type="button" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#f3a446] focus:ring-offset-2 focus:ring-offset-[#1a262a]" role="switch" aria-checked="true">
                                <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                            </button>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-white">{{ __('app.profile.settings_card.sms_notifications') }}</h4>
                                <p class="text-sm text-gray-300">{{ __('app.profile.settings_card.sms_notifications_desc') }}</p>
                            </div>
                            <button type="button" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#f3a446] focus:ring-offset-2 focus:ring-offset-[#1a262a]" role="switch" aria-checked="false">
                                <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                            </button>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-white">{{ __('app.profile.settings_card.account_status') }}</h4>
                                <p class="text-sm text-gray-300">{{ __('app.profile.settings_card.account_status_desc') }}</p>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-500/20 text-green-300">
                                <span class="w-2 h-2 mr-2 bg-green-400 rounded-full"></span>
                                {{ __('app.profile.settings_card.status_active') }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-8 pt-8 border-t border-white/10">
                        <button type="button" class="inline-flex items-center text-sm font-medium text-red-400 bg-red-600/10 hover:bg-red-600/20 px-4 py-2 rounded-lg transition-colors duration-300">
                            <i class="fas fa-trash ml-2"></i>
                            {{ __('app.profile.settings_card.delete_account_button') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButtons = document.querySelectorAll('[role="switch"]');
        toggleButtons.forEach(button => {
            
            const knob = button.querySelector('span');
            if (button.getAttribute('aria-checked') === 'true') {
                button.classList.add('bg-[#f3a446]');
                knob.classList.add('translate-x-5');
            } else {
                button.classList.add('bg-gray-600');
                knob.classList.add('translate-x-0');
            }

            button.addEventListener('click', function () {
                const isChecked = this.getAttribute('aria-checked') === 'true';
                
                if (isChecked) {
                    this.setAttribute('aria-checked', 'false');
                    this.classList.remove('bg-[#f3a446]');
                    this.classList.add('bg-gray-600');
                    knob.classList.remove('translate-x-5');
                    knob.classList.add('translate-x-0');
                } else {
                    this.setAttribute('aria-checked', 'true');
                    this.classList.remove('bg-gray-600');
                    this.classList.add('bg-[#f3a446]');
                    knob.classList.remove('translate-x-0');
                    knob.classList.add('translate-x-5');
                }
            });
        });
    });
</script>

@endsection