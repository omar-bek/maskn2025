@extends('layouts.app')

@section('title', __('app.edit_profile_title'))

@section('content')
    <div class="bg-gray-50 min-h-screen py-12 mt-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
                <div>
                    <span class="inline-block py-1 px-3 rounded-lg bg-[#1a262a]/5 text-[#1a262a] text-xs font-bold uppercase tracking-wider mb-3">
                        {{ __('app.client_account') }}
                    </span>
                    <h1 class="text-3xl font-extrabold text-[#1a262a] tracking-tight">{{ __('app.update_profile') }}</h1>
                    <p class="text-gray-500 mt-2 max-w-2xl text-lg">{{ __('app.update_profile_desc') }}</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('client.profile') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-medium hover:bg-gray-50 hover:text-[#1a262a] transition-all shadow-sm">
                        @if(app()->getLocale() == 'ar')
                            <i class="fas fa-arrow-right"></i>
                        @else
                            <i class="fas fa-arrow-left"></i>
                        @endif
                        {{ __('app.back_to_profile') }}
                    </a>
                    <a href="{{ route('client.dashboard') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#1a262a] text-white font-medium hover:bg-[#2f5c69] transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        <i class="fas fa-tachometer-alt"></i>
                        {{ __('app.dashboard') }}
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-8 rounded-2xl bg-emerald-50 border border-emerald-100 p-4 flex items-center gap-4 animate-fade-in-up">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                        <i class="fas fa-check"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-emerald-800">OK</h3>
                        <p class="text-emerald-700 text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-8 rounded-2xl bg-red-50 border border-red-100 p-4">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <ul class="space-y-1 text-sm text-red-700 mt-1 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                <form action="{{ route('client.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="text-lg font-bold text-[#1a262a] mb-6">{{ __('app.profile_image') }}</h3>
                        <div class="flex flex-col sm:flex-row gap-6 items-center">
                            @php
                                $avatarUrl = $user->avatar_url ?? optional($user->profile)->avatar_url;
                            @endphp
                            <div class="relative group">
                                <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-lg ring-1 ring-gray-100">
                                    @if ($avatarUrl)
                                        <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" class="w-full h-full object-cover transition duration-300 group-hover:scale-110">
                                    @else
                                        <div class="w-full h-full bg-[#2f5c69] flex items-center justify-center text-4xl font-bold text-white uppercase">
                                            {{ Str::substr($user->name, 0, 2) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="absolute bottom-0 right-0 bg-white rounded-full p-1.5 shadow-md border border-gray-100">
                                     <div class="w-8 h-8 rounded-full bg-[#f3a446] text-[#1a262a] flex items-center justify-center text-sm">
                                        <i class="fas fa-camera"></i>
                                     </div>
                                </div>
                            </div>
                            
                            <div class="flex-1 w-full text-center sm:text-right">
                                <div class="relative">
                                    <input type="file" name="avatar" id="avatar_upload" accept="image/*" class="hidden">
                                    <label for="avatar_upload" 
                                        class="cursor-pointer inline-flex items-center gap-2 px-6 py-2.5 rounded-xl border border-dashed border-[#2f5c69] text-[#2f5c69] font-semibold hover:bg-[#2f5c69]/5 transition-colors">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        {{ __('app.upload_photo') }}
                                    </label>
                                </div>
                                <p class="text-xs text-gray-400 mt-3">{{ __('app.allowed_file_types') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-8 space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-[#1a262a]">{{ __('app.full_name') }}</label>
                                <div class="relative">
                                    <span class="absolute top-1/2 start-4 -translate-y-1/2 text-gray-400">
                                        <i class="far fa-user"></i>
                                    </span>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                        class="w-full pr-11 pl-10 py-3 rounded-xl border border-gray-200 bg-white text-gray-800 placeholder-gray-400 focus:ring-2 focus:ring-[#f3a446]/50 focus:border-[#f3a446] transition-all text-sm"
                                        placeholder="{{ __('app.enter_full_name') }}">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-[#1a262a]">{{ __('app.email') }}</label>
                                <div class="relative">
                                    <span class="absolute top-1/2 start-4 -translate-y-1/2 text-gray-400">
                                        <i class="far fa-envelope"></i>
                                    </span>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                        class="w-full pr-11 pl-10 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-500 cursor-not-allowed text-sm"
                                        readonly>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-[#1a262a]">{{ __('app.phone') }}</label>
                                <div class="relative">
                                    <span class="absolute top-1/2 start-4 -translate-y-1/2 text-gray-400">
                                        <i class="fas fa-mobile-alt"></i>
                                    </span>
                                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                        class="w-full pr-11 pl-10 py-3 rounded-xl border border-gray-200 bg-white text-gray-800 placeholder-gray-400 focus:ring-2 focus:ring-[#f3a446]/50 focus:border-[#f3a446] transition-all text-sm"
                                        placeholder="{{ __('app.phone_placeholder') }}" dir="ltr" style="text-align: right;">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-[#1a262a]">{{ __('app.whatsapp') }}</label>
                                <div class="relative">
                                    <span class="absolute top-1/2 start-4 -translate-y-1/2 text-gray-400">
                                        <i class="fab fa-whatsapp"></i>
                                    </span>
                                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $user->whatsapp) }}"
                                        class="w-full pr-11 pl-10 py-3 rounded-xl border border-gray-200 bg-white text-gray-800 placeholder-gray-400 focus:ring-2 focus:ring-[#f3a446]/50 focus:border-[#f3a446] transition-all text-sm"
                                        dir="ltr" style="text-align: right;">
                                </div>
                            </div>

                            <div class="space-y-2 md:col-span-2">
                                <label class="text-sm font-semibold text-[#1a262a]">{{ __('app.city') }}</label>
                                <div class="relative">
                                    <span class="absolute top-1/2 start-4 -translate-y-1/2 text-gray-400">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input type="text" name="city" value="{{ old('city', $user->city) }}"
                                        class="w-full pr-11 pl-10 py-3 rounded-xl border border-gray-200 bg-white text-gray-800 placeholder-gray-400 focus:ring-2 focus:ring-[#f3a446]/50 focus:border-[#f3a446] transition-all text-sm">
                                </div>
                            </div>

                            <div class="md:col-span-2 space-y-2">
                                <label class="text-sm font-semibold text-[#1a262a]">{{ __('app.bio') }}</label>
                                <textarea name="bio" rows="5"
                                    class="w-full p-4 rounded-xl border border-gray-200 bg-white text-gray-800 placeholder-gray-400 focus:ring-2 focus:ring-[#f3a446]/50 focus:border-[#f3a446] transition-all text-sm leading-relaxed resize-none"
                                    placeholder="{{ __('app.bio_placeholder') }}">{{ old('bio', optional($user->profile)->bio ?? optional($user->profile)->bio_ar) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="px-8 py-6 bg-gray-50 flex flex-col-reverse sm:flex-row items-center justify-end gap-4 border-t border-gray-100">
                        <a href="{{ route('client.profile') }}"
                            class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-6 py-3 rounded-xl border border-gray-300 text-gray-700 font-medium hover:bg-white hover:border-gray-400 hover:text-gray-900 transition-all">
                            {{ __('app.cancel') }}
                        </a>
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-[#f3a446] to-[#f5b05a] text-[#1a262a] font-bold shadow-md hover:shadow-lg hover:from-[#f3a446] hover:to-[#e09b3e] transition-all transform hover:-translate-y-0.5">
                            <i class="fas fa-save"></i>
                            {{ __('app.save_changes') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection