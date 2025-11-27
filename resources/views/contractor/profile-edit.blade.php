@extends('layouts.app')

@section('title', __('app.edit_contractor_profile_title'))

@section('content')
    <div class="bg-[#0f1c1f] min-h-screen py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
                <div>
                    <p class="text-sm uppercase tracking-widest text-[#f3a446]">{{ __('app.my_profile_label') }}</p>
                    <h1 class="text-3xl font-extrabold text-white">{{ __('app.update_contractor_data') }}</h1>
                    <p class="text-gray-300 mt-2">{{ __('app.update_info_hint') }}</p>
                </div>
                <a href="{{ route('contractor.profile') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/10 text-white border border-white/30 hover:bg-white/20 transition">
                    <i class="fas fa-arrow-left"></i>
                    {{ __('app.back_to_profile') }}
                </a>
            </div>

            @if ($errors->any())
                <div class="mb-6 rounded-2xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                    <ul class="space-y-1 list-disc mr-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-2xl p-8">
                <form action="{{ route('contractor.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="flex flex-col md:flex-row items-center gap-6">
                        @php
                            $avatarUrl = $user->avatar_url ?? optional($user->profile)->avatar_url;
                        @endphp
                        <div class="w-24 h-24 rounded-2xl overflow-hidden border-2 border-[#2f5c69]/20 bg-gray-100 flex items-center justify-center">
                            @if ($avatarUrl)
                                <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-2xl font-bold text-[#2f5c69]">{{ Str::substr($user->name, 0, 2) }}</span>
                            @endif
                        </div>
                        <div class="flex-1 w-full">
                            <label class="block text-sm font-semibold text-[#1a262a] mb-2">{{ __('app.profile_picture') }}</label>
                            <input type="file" name="avatar" accept="image/*"
                                class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-[#f3a446]/90 file:text-[#1a262a] hover:file:bg-[#f5b05a] border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#f3a446] focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">{{ __('app.allowed_file_types') }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-[#1a262a] mb-2">{{ __('app.company_name') }}</label>
                            <input type="text" name="company_name"
                                value="{{ old('company_name', optional($user->profile)->company_name) }}"
                                class="w-full rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2f5c69] focus:border-transparent text-sm text-right">
                        </div>
                        @php
                            $currentSpecialization = data_get(optional($user->profile)->specializations, 0);
                        @endphp
                        <div>
                            <label class="block text-sm font-semibold text-[#1a262a] mb-2">{{ __('app.specialization') }}</label>
                            <input type="text" name="specialization" value="{{ old('specialization', $currentSpecialization ?? '') }}"
                                class="w-full rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2f5c69] focus:border-transparent text-sm text-right">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-[#1a262a] mb-2">{{ __('app.bio_label') }}</label>
                        <textarea name="bio" rows="4"
                            class="w-full rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2f5c69] focus:border-transparent text-sm text-right">{{ old('bio', optional($user->profile)->bio_ar ?? (optional($user->profile)->bio ?? '')) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-[#1a262a] mb-2">{{ __('app.city') }}</label>
                            <input type="text" name="city" value="{{ old('city', $user->city) }}"
                                class="w-full rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2f5c69] focus:border-transparent text-sm text-right">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#1a262a] mb-2">{{ __('app.phone_number') }}</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                class="w-full rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2f5c69] focus:border-transparent text-sm text-right">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#1a262a] mb-2">{{ __('app.whatsapp') }}</label>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp', $user->whatsapp) }}"
                                class="w-full rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2f5c69] focus:border-transparent text-sm text-right">
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4">
                        <a href="{{ route('contractor.profile') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-50 transition">
                            {{ __('app.cancel') }}
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center items-center gap-2 px-6 py-3 rounded-xl bg-[#f3a446] text-[#1a262a] font-semibold hover:bg-[#f5b05a] transition">
                            <i class="fas fa-save"></i>
                            {{ __('app.save_changes') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection