@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4 font-heading">
                {{ __('app.lands_create.page_title') }}
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                {{ __('app.lands_create.page_subtitle') }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <div class="lg:col-span-1 lg:sticky lg:top-28 order-1">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-[#f3a446]/10 p-6 border-b border-[#f3a446]/20">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center gap-3">
                            <span class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-[#f3a446] shadow-sm">
                                <i class="fas fa-lightbulb text-lg"></i>
                            </span>
                            {{ __('app.lands_create.sidebar_title') }}
                        </h3>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 mt-1">
                                <i class="fas fa-check-circle text-[#2f5c69] text-lg"></i>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                {{ __('app.lands_create.tip_1') }}
                            </p>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-shrink-0 mt-1">
                                <i class="fas fa-check-circle text-[#2f5c69] text-lg"></i>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                {{ __('app.lands_create.tip_2') }}
                            </p>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-shrink-0 mt-1">
                                <i class="fas fa-check-circle text-[#2f5c69] text-lg"></i>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                {{ __('app.lands_create.tip_3') }}
                            </p>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-shrink-0 mt-1">
                                <i class="fas fa-check-circle text-[#2f5c69] text-lg"></i>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                {{ __('app.lands_create.tip_4') }}
                            </p>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 border-t border-gray-100">
                        <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">
                            {{ __('app.lands_create.sidebar_links_title') }}
                        </h4>
                        <div class="space-y-3">
                            <a href="{{ route('lands.my-ads') }}"
                               class="flex items-center justify-between p-3 bg-white border border-gray-200 rounded-xl text-gray-700 hover:border-[#f3a446] hover:text-[#f3a446] hover:shadow-md transition-all duration-300 group">
                                <span class="flex items-center gap-3">
                                    <i class="fas fa-list text-gray-400 group-hover:text-[#f3a446] transition-colors"></i>
                                    {{ __('app.lands_create.link_my_ads') }}
                                </span>
                                <i class="fas fa-chevron-left text-xs text-gray-300 group-hover:text-[#f3a446] rtl:rotate-0 ltr:rotate-180"></i>
                            </a>

                            <a href="{{ route('lands.my-offers') }}"
                               class="flex items-center justify-between p-3 bg-white border border-gray-200 rounded-xl text-gray-700 hover:border-[#2f5c69] hover:text-[#2f5c69] hover:shadow-md transition-all duration-300 group">
                                <span class="flex items-center gap-3">
                                    <i class="fas fa-handshake text-gray-400 group-hover:text-[#2f5c69] transition-colors"></i>
                                    {{ __('app.lands_create.link_my_offers') }}
                                </span>
                                <i class="fas fa-chevron-left text-xs text-gray-300 group-hover:text-[#2f5c69] rtl:rotate-0 ltr:rotate-180"></i>
                            </a>

                            <a href="{{ route('lands.index') }}"
                               class="flex items-center justify-between p-3 bg-white border border-gray-200 rounded-xl text-gray-700 hover:border-gray-400 hover:text-gray-900 hover:shadow-md transition-all duration-300 group">
                                <span class="flex items-center gap-3">
                                    <i class="fas fa-search text-gray-400 group-hover:text-gray-900 transition-colors"></i>
                                    {{ __('app.lands_create.link_browse_lands') }}
                                </span>
                                <i class="fas fa-chevron-left text-xs text-gray-300 group-hover:text-gray-900 rtl:rotate-0 ltr:rotate-180"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 order-2">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    
                    <div class="bg-gradient-to-r from-[#2f5c69] to-[#1a262a] px-8 py-8 text-white relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                        <div class="relative flex items-center gap-6">
                            <div class="p-4 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 shadow-inner">
                                <i class="fas fa-plus text-2xl text-[#f3a446]"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold mb-2">
                                    {{ __('app.lands_create.form_header_title') }}
                                </h2>
                                <p class="text-white/80 text-sm">
                                    {{ __('app.lands_create.form_header_subtitle') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <form class="p-8" action="{{ route('lands.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if ($errors->any())
                            <div class="mb-8 bg-red-50 border border-red-100 rounded-2xl p-6 animate-pulse-soft">
                                <div class="flex items-center mb-3 text-red-800">
                                    <i class="fas fa-exclamation-circle text-xl me-3"></i>
                                    <h3 class="font-bold">
                                        {{ __('app.validation_errors_title') ?? 'يرجى تصحيح الأخطاء التالية:' }}
                                    </h3>
                                </div>
                                <ul class="list-disc list-inside space-y-1 text-red-600 text-sm ps-5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-10">
                            <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-3 pb-3 border-b border-gray-100">
                                <span class="w-8 h-8 rounded-lg bg-[#2f5c69]/10 flex items-center justify-center text-[#2f5c69]">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                {{ __('app.lands_create.section_basic_info') }}
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">{{ __('app.lands_create.label_title') }}</label>
                                    <input type="text" name="title" required value="{{ old('title') }}"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50 focus:bg-white hover:bg-white"
                                        placeholder="{{ __('app.lands_create.placeholder_title') }}" />
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">{{ __('app.lands_create.label_land_type') }}</label>
                                    <select name="land_type" required
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50 focus:bg-white hover:bg-white appearance-none">
                                        <option value="">{{ __('app.lands_create.select_land_type') }}</option>
                                        <option value="residential" {{ old('land_type') == 'residential' ? 'selected' : '' }}>{{ __('app.lands_create.land_type_residential') }}</option>
                                        <option value="commercial" {{ old('land_type') == 'commercial' ? 'selected' : '' }}>{{ __('app.lands_create.land_type_commercial') }}</option>
                                        <option value="agricultural" {{ old('land_type') == 'agricultural' ? 'selected' : '' }}>{{ __('app.lands_create.land_type_agricultural') }}</option>
                                        <option value="industrial" {{ old('land_type') == 'industrial' ? 'selected' : '' }}>{{ __('app.lands_create.land_type_industrial') }}</option>
                                    </select>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">{{ __('app.lands_create.label_area') }}</label>
                                    <div class="relative">
                                        <input type="number" name="area" required value="{{ old('area') }}"
                                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50 focus:bg-white hover:bg-white"
                                            placeholder="{{ __('app.lands_create.placeholder_area') }}" />
                                        <span class="absolute end-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs">m²</span>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">{{ __('app.lands_create.label_price') }}</label>
                                    <input type="number" name="price" required value="{{ old('price') }}"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50 focus:bg-white hover:bg-white"
                                        placeholder="{{ __('app.lands_create.placeholder_price') }}" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-10">
                            <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-3 pb-3 border-b border-gray-100">
                                <span class="w-8 h-8 rounded-lg bg-[#2f5c69]/10 flex items-center justify-center text-[#2f5c69]">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                                {{ __('app.lands_create.section_location_info') }}
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">{{ __('app.lands_create.label_city') }}</label>
                                    <select name="city" required
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50 focus:bg-white hover:bg-white appearance-none">
                                        <option value="">{{ __('app.lands_create.select_city') }}</option>
                                        <option value="abu_dhabi" {{ old('city') == 'abu_dhabi' ? 'selected' : '' }}>أبوظبي / Abu Dhabi</option>
                                        <option value="dubai" {{ old('city') == 'dubai' ? 'selected' : '' }}>دبي / Dubai</option>
                                        <option value="sharjah" {{ old('city') == 'sharjah' ? 'selected' : '' }}>الشارقة / Sharjah</option>
                                        <option value="ajman" {{ old('city') == 'ajman' ? 'selected' : '' }}>عجمان / Ajman</option>
                                        <option value="ras_al_khaimah" {{ old('city') == 'ras_al_khaimah' ? 'selected' : '' }}>رأس الخيمة / Ras Al Khaimah</option>
                                        <option value="fujairah" {{ old('city') == 'fujairah' ? 'selected' : '' }}>الفجيرة / Fujairah</option>
                                        <option value="umm_al_quwain" {{ old('city') == 'umm_al_quwain' ? 'selected' : '' }}>أم القيوين / Umm Al Quwain</option>
                                        <option value="other" {{ old('city') == 'other' ? 'selected' : '' }}>{{ __('app.lands_create.city_other') }}</option>
                                    </select>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">{{ __('app.lands_create.label_district') }}</label>
                                    <input type="text" name="district" required value="{{ old('district') }}"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50 focus:bg-white hover:bg-white"
                                        placeholder="{{ __('app.lands_create.placeholder_district') }}" />
                                </div>

                                <div class="md:col-span-2 space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">{{ __('app.lands_create.label_address') }}</label>
                                    <textarea name="address" rows="3"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50 focus:bg-white hover:bg-white resize-none"
                                        placeholder="{{ __('app.lands_create.placeholder_address') }}">{{ old('address') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mb-10">
                            <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-3 pb-3 border-b border-gray-100">
                                <span class="w-8 h-8 rounded-lg bg-[#2f5c69]/10 flex items-center justify-center text-[#2f5c69]">
                                    <i class="fas fa-exchange-alt"></i>
                                </span>
                                {{ __('app.lands_create.section_desired_location') }}
                            </h3>

                            <div class="bg-[#f3a446]/5 border border-[#f3a446]/20 rounded-xl p-4 mb-6 flex items-start gap-3">
                                <i class="fas fa-info-circle text-[#f3a446] mt-1"></i>
                                <p class="text-[#f3a446] text-sm font-medium leading-relaxed">
                                    {{ __('app.lands_create.desired_location_note') }}
                                </p>
                            </div>

                            <div id="desired-locations-container" class="space-y-4">
                                @php
                                    $oldDesiredCities = old('desired_cities', []);
                                    $oldDesiredDistricts = old('desired_districts', []);
                                    $oldDesiredAreas = old('desired_areas', []);
                                    $oldDesiredDetails = old('desired_details', []);
                                    $desiredLocationsCount = max(count($oldDesiredCities), count($oldDesiredDistricts), count($oldDesiredAreas), count($oldDesiredDetails), 1);
                                @endphp
                                @for ($i = 0; $i < $desiredLocationsCount; $i++)
                                    <div class="desired-location-item bg-gray-50 border border-gray-200 rounded-xl p-5 relative group hover:shadow-md transition-shadow duration-300">
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div class="space-y-2">
                                                <label class="block text-xs font-bold uppercase text-gray-500">{{ __('app.lands_create.label_desired_city') }}</label>
                                                <select name="desired_cities[]"
                                                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-[#f3a446]/20 focus:border-[#f3a446] bg-white">
                                                    <option value="">{{ __('app.lands_create.select_city') }}</option>
                                                    <option value="abu_dhabi" {{ isset($oldDesiredCities[$i]) && $oldDesiredCities[$i] == 'abu_dhabi' ? 'selected' : '' }}>أبوظبي</option>
                                                    <option value="dubai" {{ isset($oldDesiredCities[$i]) && $oldDesiredCities[$i] == 'dubai' ? 'selected' : '' }}>دبي</option>
                                                    <option value="sharjah" {{ isset($oldDesiredCities[$i]) && $oldDesiredCities[$i] == 'sharjah' ? 'selected' : '' }}>الشارقة</option>
                                                    <option value="ajman" {{ isset($oldDesiredCities[$i]) && $oldDesiredCities[$i] == 'ajman' ? 'selected' : '' }}>عجمان</option>
                                                    <option value="ras_al_khaimah" {{ isset($oldDesiredCities[$i]) && $oldDesiredCities[$i] == 'ras_al_khaimah' ? 'selected' : '' }}>رأس الخيمة</option>
                                                    <option value="fujairah" {{ isset($oldDesiredCities[$i]) && $oldDesiredCities[$i] == 'fujairah' ? 'selected' : '' }}>الفجيرة</option>
                                                    <option value="umm_al_quwain" {{ isset($oldDesiredCities[$i]) && $oldDesiredCities[$i] == 'umm_al_quwain' ? 'selected' : '' }}>أم القيوين</option>
                                                    <option value="other" {{ isset($oldDesiredCities[$i]) && $oldDesiredCities[$i] == 'other' ? 'selected' : '' }}>{{ __('app.lands_create.city_other') }}</option>
                                                </select>
                                            </div>

                                            <div class="space-y-2">
                                                <label class="block text-xs font-bold uppercase text-gray-500">{{ __('app.lands_create.label_desired_district') }}</label>
                                                <input type="text" name="desired_districts[]" value="{{ isset($oldDesiredDistricts[$i]) ? $oldDesiredDistricts[$i] : '' }}"
                                                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-[#f3a446]/20 focus:border-[#f3a446] bg-white"
                                                    placeholder="{{ __('app.lands_create.placeholder_district') }}" />
                                            </div>

                                            <div class="space-y-2">
                                                <label class="block text-xs font-bold uppercase text-gray-500">{{ __('app.lands_create.label_desired_area') }}</label>
                                                <input type="number" name="desired_areas[]" value="{{ isset($oldDesiredAreas[$i]) ? $oldDesiredAreas[$i] : '' }}"
                                                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-[#f3a446]/20 focus:border-[#f3a446] bg-white"
                                                    placeholder="{{ __('app.lands_create.placeholder_desired_area') }}" />
                                            </div>
                                        </div>

                                        <div class="mt-4 space-y-2">
                                            <label class="block text-xs font-bold uppercase text-gray-500">{{ __('app.lands_create.label_desired_details') }}</label>
                                            <textarea name="desired_details[]" rows="2"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-[#f3a446]/20 focus:border-[#f3a446] bg-white resize-none"
                                                placeholder="{{ __('app.lands_create.placeholder_desired_details') }}">{{ isset($oldDesiredDetails[$i]) ? $oldDesiredDetails[$i] : '' }}</textarea>
                                        </div>

                                        <div class="mt-3 flex justify-end">
                                            <button type="button" class="remove-location-btn text-red-500 hover:text-red-700 text-xs font-bold uppercase tracking-wide transition-colors flex items-center gap-1">
                                                <i class="fas fa-trash-alt"></i>
                                                {{ __('app.lands_create.button_remove_location') }}
                                            </button>
                                        </div>
                                    </div>
                                @endfor
                            </div>

                            <div class="text-center mt-6">
                                <button type="button" id="add-desired-location"
                                    class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full border-2 border-[#2f5c69] text-[#2f5c69] font-bold text-sm hover:bg-[#2f5c69] hover:text-white transition-all duration-300 shadow-sm hover:shadow-md">
                                    <i class="fas fa-plus"></i>
                                    {{ __('app.lands_create.button_add_location') }}
                                </button>
                            </div>
                        </div>

                        <div class="mb-10">
                            <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-3 pb-3 border-b border-gray-100">
                                <span class="w-8 h-8 rounded-lg bg-[#2f5c69]/10 flex items-center justify-center text-[#2f5c69]">
                                    <i class="fas fa-handshake"></i>
                                </span>
                                {{ __('app.lands_create.section_transaction_type') }}
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="transaction_type" value="sale" class="sr-only peer" required {{ old('transaction_type') == 'sale' ? 'checked' : '' }} />
                                    <div class="h-full border-2 border-gray-100 rounded-2xl p-6 text-center transition-all duration-300 hover:border-[#f3a446]/30 peer-checked:border-[#f3a446] peer-checked:bg-[#f3a446]/5 peer-checked:shadow-lg">
                                        <div class="w-12 h-12 mx-auto rounded-full bg-gray-50 flex items-center justify-center mb-4 transition-colors peer-checked:bg-[#f3a446] peer-checked:text-white">
                                            <i class="fas fa-tag text-xl text-gray-400 peer-checked:text-white transition-colors"></i>
                                        </div>
                                        <div class="font-bold text-gray-900 mb-1">{{ __('app.lands_create.transaction_sale_title') }}</div>
                                        <div class="text-xs text-gray-500">{{ __('app.lands_create.transaction_sale_desc') }}</div>
                                    </div>
                                </label>

                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="transaction_type" value="exchange" class="sr-only peer" {{ old('transaction_type') == 'exchange' ? 'checked' : '' }} />
                                    <div class="h-full border-2 border-gray-100 rounded-2xl p-6 text-center transition-all duration-300 hover:border-[#f3a446]/30 peer-checked:border-[#f3a446] peer-checked:bg-[#f3a446]/5 peer-checked:shadow-lg">
                                        <div class="w-12 h-12 mx-auto rounded-full bg-gray-50 flex items-center justify-center mb-4 transition-colors peer-checked:bg-[#f3a446] peer-checked:text-white">
                                            <i class="fas fa-exchange-alt text-xl text-gray-400 peer-checked:text-white transition-colors"></i>
                                        </div>
                                        <div class="font-bold text-gray-900 mb-1">{{ __('app.lands_create.transaction_exchange_title') }}</div>
                                        <div class="text-xs text-gray-500">{{ __('app.lands_create.transaction_exchange_desc') }}</div>
                                    </div>
                                </label>

                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="transaction_type" value="both" class="sr-only peer" {{ old('transaction_type') == 'both' ? 'checked' : '' }} />
                                    <div class="h-full border-2 border-gray-100 rounded-2xl p-6 text-center transition-all duration-300 hover:border-[#f3a446]/30 peer-checked:border-[#f3a446] peer-checked:bg-[#f3a446]/5 peer-checked:shadow-lg">
                                        <div class="w-12 h-12 mx-auto rounded-full bg-gray-50 flex items-center justify-center mb-4 transition-colors peer-checked:bg-[#f3a446] peer-checked:text-white">
                                            <i class="fas fa-arrows-alt-h text-xl text-gray-400 peer-checked:text-white transition-colors"></i>
                                        </div>
                                        <div class="font-bold text-gray-900 mb-1">{{ __('app.lands_create.transaction_both_title') }}</div>
                                        <div class="text-xs text-gray-500">{{ __('app.lands_create.transaction_both_desc') }}</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="mb-10">
                            <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-3 pb-3 border-b border-gray-100">
                                <span class="w-8 h-8 rounded-lg bg-[#2f5c69]/10 flex items-center justify-center text-[#2f5c69]">
                                    <i class="fas fa-align-right"></i>
                                </span>
                                {{ __('app.lands_create.section_description') }}
                            </h3>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">{{ __('app.lands_create.label_description') }}</label>
                                <textarea name="description" rows="5"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50 focus:bg-white hover:bg-white"
                                    placeholder="{{ __('app.lands_create.placeholder_description') }}">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="mb-10">
                            <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-3 pb-3 border-b border-gray-100">
                                <span class="w-8 h-8 rounded-lg bg-[#2f5c69]/10 flex items-center justify-center text-[#2f5c69]">
                                    <i class="fas fa-star"></i>
                                </span>
                                {{ __('app.lands_create.section_features') }}
                            </h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
                                @php $features = ['services', 'paved', 'flat', 'corner', 'view', 'security']; @endphp
                                @foreach($features as $feature)
                                    <label class="flex items-center p-3 rounded-xl border border-gray-200 cursor-pointer hover:border-[#f3a446] hover:bg-[#f3a446]/5 transition-all duration-200">
                                        <input type="checkbox" name="features[]" value="{{ $feature }}"
                                            class="rounded text-[#2f5c69] focus:ring-[#2f5c69] border-gray-300 w-5 h-5"
                                            {{ in_array($feature, old('features', [])) ? 'checked' : '' }} />
                                        <span class="ms-3 text-gray-700 font-medium text-sm">{{ __('app.lands_create.feature_' . $feature) }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-10">
                            <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-3 pb-3 border-b border-gray-100">
                                <span class="w-8 h-8 rounded-lg bg-[#2f5c69]/10 flex items-center justify-center text-[#2f5c69]">
                                    <i class="fas fa-phone"></i>
                                </span>
                                {{ __('app.lands_create.section_contact') }}
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">{{ __('app.lands_create.label_contact_name') }}</label>
                                    <div class="relative">
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-user"></i></span>
                                        <input type="text" name="contact_name" required value="{{ old('contact_name') }}"
                                            class="w-full border border-gray-300 rounded-xl ps-10 pe-4 py-3 focus:ring-2 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50 focus:bg-white"
                                            placeholder="{{ __('app.lands_create.placeholder_contact_name') }}" />
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">{{ __('app.lands_create.label_contact_phone') }}</label>
                                    <div class="relative">
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-mobile-alt"></i></span>
                                        <input type="tel" name="contact_phone" required value="{{ old('contact_phone') }}"
                                            class="w-full border border-gray-300 rounded-xl ps-10 pe-4 py-3 focus:ring-2 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50 focus:bg-white"
                                            placeholder="{{ __('app.lands_create.placeholder_contact_phone') }}" />
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">{{ __('app.lands_create.label_contact_whatsapp') }}</label>
                                    <div class="relative">
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fab fa-whatsapp"></i></span>
                                        <input type="tel" name="contact_whatsapp" value="{{ old('contact_whatsapp') }}"
                                            class="w-full border border-gray-300 rounded-xl ps-10 pe-4 py-3 focus:ring-2 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50 focus:bg-white"
                                            placeholder="{{ __('app.lands_create.placeholder_contact_phone') }}" />
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">{{ __('app.lands_create.label_contact_email') }}</label>
                                    <div class="relative">
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-envelope"></i></span>
                                        <input type="email" name="contact_email" value="{{ old('contact_email') }}"
                                            class="w-full border border-gray-300 rounded-xl ps-10 pe-4 py-3 focus:ring-2 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50 focus:bg-white"
                                            placeholder="{{ __('app.lands_create.placeholder_contact_email') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-10">
                            <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-3 pb-3 border-b border-gray-100">
                                <span class="w-8 h-8 rounded-lg bg-[#2f5c69]/10 flex items-center justify-center text-[#2f5c69]">
                                    <i class="fas fa-images"></i>
                                </span>
                                {{ __('app.lands_create.section_images') }}
                            </h3>

                            <div class="border-2 border-dashed border-gray-300 rounded-2xl p-10 text-center hover:border-[#f3a446] hover:bg-gray-50 transition-all duration-300 group">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 group-hover:text-[#f3a446]"></i>
                                </div>
                                <h4 class="text-lg font-bold text-gray-900 mb-2">{{ __('app.lands_create.image_upload_drag') }}</h4>
                                <p class="text-gray-500 mb-6 text-sm">{{ __('app.lands_create.image_upload_click') }}</p>
                                
                                <input type="file" name="images[]" multiple accept="image/*" class="hidden" id="image-upload" />
                                <label for="image-upload"
                                    class="inline-block bg-[#f3a446] text-[#2f5c69] px-8 py-3 rounded-full font-bold text-sm hover:bg-[#e08e33] transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer transform hover:-translate-y-1">
                                    <i class="fas fa-upload me-2"></i>
                                    {{ __('app.lands_create.button_image_upload') }}
                                </label>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-gray-100">
                            <button type="submit"
                                class="flex-1 bg-[#2f5c69] text-white py-4 px-6 rounded-xl font-bold text-lg hover:bg-[#1a262a] transition-all duration-300 shadow-lg hover:shadow-xl hover:shadow-[#2f5c69]/20 transform hover:-translate-y-1">
                                <i class="fas fa-paper-plane me-2"></i>
                                {{ __('app.lands_create.button_submit') }}
                            </button>

                            <a href="{{ route('lands.index') }}"
                                class="flex-1 bg-white border border-gray-200 text-gray-700 py-4 px-6 rounded-xl font-bold text-lg hover:bg-gray-50 hover:border-gray-300 transition-all duration-300 text-center">
                                <i class="fas fa-times me-2"></i>
                                {{ __('app.lands_create.button_cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        // Handle radio button styling
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                // Remove active class from all labels
                document.querySelectorAll('input[type="radio"]').forEach(r => {
                    r.closest('label').querySelector('div').classList.remove('border-teal-500',
                        'bg-teal-50');
                    r.closest('label').querySelector('div').classList.add('border-gray-200');
                });

                // Add active class to selected label
                if (this.checked) {
                    this.closest('label').querySelector('div').classList.remove('border-gray-200');
                    this.closest('label').querySelector('div').classList.add('border-teal-500',
                        'bg-teal-50');
                }
            });
        });

        // Handle file upload
        document.getElementById('image-upload').addEventListener('change', function(e) {
            const files = e.target.files;
            if (files.length > 0) {
                const uploadArea = this.closest('.border-dashed');
                uploadArea.classList.add('border-teal-500', 'bg-teal-50');

                // Show selected files count
                const text = uploadArea.querySelector('p');
                text.textContent = `تم اختيار ${files.length} ملف`;
            }
        });

        // Handle desired locations
        document.getElementById('add-desired-location').addEventListener('click', function() {
            const container = document.getElementById('desired-locations-container');
            const newLocation = document.querySelector('.desired-location-item').cloneNode(true);

            // Clear the values
            newLocation.querySelectorAll('input, select, textarea').forEach(input => {
                input.value = '';
            });

            // Add remove functionality
            newLocation.querySelector('.remove-location-btn').addEventListener('click', function() {
                newLocation.remove();
            });

            container.appendChild(newLocation);
        });

        // Handle remove location buttons
        document.querySelectorAll('.remove-location-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const locationItem = this.closest('.desired-location-item');
                if (document.querySelectorAll('.desired-location-item').length > 1) {
                    locationItem.remove();
                } else {
                    alert('يجب أن يكون هناك موقع مرغوب واحد على الأقل');
                }
            });
        });
    </script>
@endsection
