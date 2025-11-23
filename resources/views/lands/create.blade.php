@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    {{ __('app.lands_create.page_title') }}
                </h1>
                <p class="text-xl text-gray-600">
                    {{ __('app.lands_create.page_subtitle') }}
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-[#2f5c69] to-[#1a262a] px-8 py-6 text-white">
                            <div class="flex items-center">
                                <div class="p-3 bg-white bg-opacity-20 rounded-2xl ml-4">
                                    <i class="fas fa-plus text-2xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold">
                                        {{ __('app.lands_create.form_header_title') }}
                                    </h2>
                                    <p class="text-white/80">
                                        {{ __('app.lands_create.form_header_subtitle') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <form class="p-8" action="{{ route('lands.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            @if ($errors->any())
                                <div class="mb-6 bg-red-50 border-2 border-red-200 rounded-2xl p-4">
                                    <div class="flex items-center mb-3">
                                        <i class="fas fa-exclamation-circle text-red-600 ml-3 text-xl"></i>
                                        <h3 class="text-lg font-bold text-red-800">
                                            {{ __('app.validation_errors_title') ?? 'يرجى تصحيح الأخطاء التالية:' }}
                                        </h3>
                                    </div>
                                    <ul class="list-disc list-inside space-y-1 text-red-700">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="mb-8">
                                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-info-circle text-[#2f5c69] ml-3"></i>
                                    {{ __('app.lands_create.section_basic_info') }}
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label
                                            class="block text-sm font-bold text-gray-800">{{ __('app.lands_create.label_title') }}</label>
                                        <input type="text" name="title" required value="{{ old('title') }}"
                                            class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 backdrop-blur-sm hover:bg-white hover:shadow-lg"
                                            placeholder="{{ __('app.lands_create.placeholder_title') }}" />
                                    </div>

                                    <div class="space-y-2">
                                        <label
                                            class="block text-sm font-bold text-gray-800">{{ __('app.lands_create.label_land_type') }}</label>
                                        <select name="land_type" required
                                            class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 backdrop-blur-sm hover:bg-white hover:shadow-lg appearance-none">
                                            <option value="">
                                                {{ __('app.lands_create.select_land_type') }}
                                            </option>
                                            <option value="residential"
                                                {{ old('land_type') == 'residential' ? 'selected' : '' }}>
                                                {{ __('app.lands_create.land_type_residential') }}
                                            </option>
                                            <option value="commercial"
                                                {{ old('land_type') == 'commercial' ? 'selected' : '' }}>
                                                {{ __('app.lands_create.land_type_commercial') }}
                                            </option>
                                            <option value="agricultural"
                                                {{ old('land_type') == 'agricultural' ? 'selected' : '' }}>
                                                {{ __('app.lands_create.land_type_agricultural') }}
                                            </option>
                                            <option value="industrial"
                                                {{ old('land_type') == 'industrial' ? 'selected' : '' }}>
                                                {{ __('app.lands_create.land_type_industrial') }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="space-y-2">
                                        <label
                                            class="block text-sm font-bold text-gray-800">{{ __('app.lands_create.label_area') }}</label>
                                        <input type="number" name="area" required value="{{ old('area') }}"
                                            class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 backdrop-blur-sm hover:bg-white hover:shadow-lg"
                                            placeholder="{{ __('app.lands_create.placeholder_area') }}" />
                                    </div>

                                    <div class="space-y-2">
                                        <label
                                            class="block text-sm font-bold text-gray-800">{{ __('app.lands_create.label_price') }}</label>
                                        <input type="number" name="price" required value="{{ old('price') }}"
                                            class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 backdrop-blur-sm hover:bg-white hover:shadow-lg"
                                            placeholder="{{ __('app.lands_create.placeholder_price') }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-8">
                                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-map-marker-alt text-[#2f5c69] ml-3"></i>
                                    {{ __('app.lands_create.section_location_info') }}
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label
                                            class="block text-sm font-bold text-gray-800">{{ __('app.lands_create.label_city') }}</label>
                                        <select name="city" required
                                            class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 backdrop-blur-sm hover:bg-white hover:shadow-lg appearance-none">
                                            <option value="">
                                                {{ __('app.lands_create.select_city') }}
                                            </option>
                                            <option value="abu_dhabi" {{ old('city') == 'abu_dhabi' ? 'selected' : '' }}>
                                                أبوظبي / Abu Dhabi
                                            </option>
                                            <option value="dubai" {{ old('city') == 'dubai' ? 'selected' : '' }}>
                                                دبي / Dubai
                                            </option>
                                            <option value="sharjah" {{ old('city') == 'sharjah' ? 'selected' : '' }}>
                                                الشارقة / Sharjah
                                            </option>
                                            <option value="ajman" {{ old('city') == 'ajman' ? 'selected' : '' }}>
                                                عجمان / Ajman
                                            </option>
                                            <option value="ras_al_khaimah"
                                                {{ old('city') == 'ras_al_khaimah' ? 'selected' : '' }}>
                                                رأس الخيمة / Ras Al Khaimah
                                            </option>
                                            <option value="fujairah" {{ old('city') == 'fujairah' ? 'selected' : '' }}>
                                                الفجيرة / Fujairah
                                            </option>
                                            <option value="umm_al_quwain"
                                                {{ old('city') == 'umm_al_quwain' ? 'selected' : '' }}>
                                                أم القيوين / Umm Al Quwain
                                            </option>
                                            <option value="other" {{ old('city') == 'other' ? 'selected' : '' }}>
                                                {{ __('app.lands_create.city_other') }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="space-y-2">
                                        <label
                                            class="block text-sm font-bold text-gray-800">{{ __('app.lands_create.label_district') }}</label>
                                        <input type="text" name="district" required value="{{ old('district') }}"
                                            class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 backdrop-blur-sm hover:bg-white hover:shadow-lg"
                                            placeholder="{{ __('app.lands_create.placeholder_district') }}" />
                                    </div>

                                    <div class="md:col-span-2 space-y-2">
                                        <label
                                            class="block text-sm font-bold text-gray-800">{{ __('app.lands_create.label_address') }}</label>
                                        <textarea name="address" rows="3"
                                            class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 backdrop-blur-sm hover:bg-white hover:shadow-lg"
                                            placeholder="{{ __('app.lands_create.placeholder_address') }}">{{ old('address') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-8">
                                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-exchange-alt text-[#2f5c69] ml-3"></i>
                                    {{ __('app.lands_create.section_desired_location') }}
                                </h3>

                                <div class="bg-[#f3a446]/10 border border-[#f3a446]/20 rounded-2xl p-4 mb-6">
                                    <div class="flex items-center">
                                        <i class="fas fa-info-circle text-[#f3a446] ml-2"></i>
                                        <p class="text-[#f3a446] text-sm font-medium">
                                            {{ __('app.lands_create.desired_location_note') }}
                                        </p>
                                    </div>
                                </div>

                                <div id="desired-locations-container">
                                    @php
                                        $oldDesiredCities = old('desired_cities', []);
                                        $oldDesiredDistricts = old('desired_districts', []);
                                        $oldDesiredAreas = old('desired_areas', []);
                                        $oldDesiredDetails = old('desired_details', []);
                                        $desiredLocationsCount = max(
                                            count($oldDesiredCities),
                                            count($oldDesiredDistricts),
                                            count($oldDesiredAreas),
                                            count($oldDesiredDetails),
                                            1,
                                        );
                                    @endphp
                                    @for ($i = 0; $i < $desiredLocationsCount; $i++)
                                        <div
                                            class="desired-location-item bg-white border-2 border-gray-200 rounded-2xl p-4 mb-4 transition-all duration-300">
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                <div class="space-y-2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-2">{{ __('app.lands_create.label_desired_city') }}</label>
                                                    <select name="desired_cities[]"
                                                        class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 backdrop-blur-sm hover:bg-white hover:shadow-lg appearance-none">
                                                        <option value="">
                                                            {{ __('app.lands_create.select_city') }}
                                                        </option>
                                                        <option value="abu_dhabi"
                                                            {{ isset($oldDesiredCities[$i]) && $oldDesiredCities[$i] == 'abu_dhabi' ? 'selected' : '' }}>
                                                            أبوظبي / Abu Dhabi
                                                        </option>
                                                        <option value="dubai"
                                                            {{ isset($oldDesiredCities[$i]) && $oldDesiredCities[$i] == 'dubai' ? 'selected' : '' }}>
                                                            دبي / Dubai
                                                        </option>
                                                        <option value="sharjah"
                                                            {{ isset($oldDesiredCities[$i]) && $oldDesiredCities[$i] == 'sharjah' ? 'selected' : '' }}>
                                                            الشارقة / Sharjah
                                                        </option>
                                                        <option value="ajman"
                                                            {{ isset($oldDesiredCities[$i]) && $oldDesiredCities[$i] == 'ajman' ? 'selected' : '' }}>
                                                            عجمان / Ajman
                                                        </option>
                                                        <option value="ras_al_khaimah"
                                                            {{ isset($oldDesiredCities[$i]) && $oldDesiredCities[$i] == 'ras_al_khaimah' ? 'selected' : '' }}>
                                                            رأس الخيمة / Ras Al Khaimah
                                                        </option>
                                                        <option value="fujairah"
                                                            {{ isset($oldDesiredCities[$i]) && $oldDesiredCities[$i] == 'fujairah' ? 'selected' : '' }}>
                                                            الفجيرة / Fujairah
                                                        </option>
                                                        <option value="umm_al_quwain"
                                                            {{ isset($oldDesiredCities[$i]) && $oldDesiredCities[$i] == 'umm_al_quwain' ? 'selected' : '' }}>
                                                            أم القيوين / Umm Al Quwain
                                                        </option>
                                                        <option value="other"
                                                            {{ isset($oldDesiredCities[$i]) && $oldDesiredCities[$i] == 'other' ? 'selected' : '' }}>
                                                            {{ __('app.lands_create.city_other') }}
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="space-y-2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-2">{{ __('app.lands_create.label_desired_district') }}</label>
                                                    <input type="text" name="desired_districts[]"
                                                        value="{{ isset($oldDesiredDistricts[$i]) ? $oldDesiredDistricts[$i] : '' }}"
                                                        class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 backdrop-blur-sm hover:bg-white hover:shadow-lg"
                                                        placeholder="{{ __('app.lands_create.placeholder_district') }}" />
                                                </div>

                                                <div class="space-y-2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-2">{{ __('app.lands_create.label_desired_area') }}</label>
                                                    <input type="number" name="desired_areas[]"
                                                        value="{{ isset($oldDesiredAreas[$i]) ? $oldDesiredAreas[$i] : '' }}"
                                                        class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 backdrop-blur-sm hover:bg-white hover:shadow-lg"
                                                        placeholder="{{ __('app.lands_create.placeholder_desired_area') }}" />
                                                </div>
                                            </div>

                                            <div class="mt-4 space-y-2">
                                                <label
                                                    class="block text-sm font-medium text-gray-700 mb-2">{{ __('app.lands_create.label_desired_details') }}</label>
                                                <textarea name="desired_details[]" rows="2"
                                                    class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 backdrop-blur-sm hover:bg-white hover:shadow-lg"
                                                    placeholder="{{ __('app.lands_create.placeholder_desired_details') }}">{{ isset($oldDesiredDetails[$i]) ? $oldDesiredDetails[$i] : '' }}</textarea>
                                            </div>

                                            <div class="mt-4 flex justify-end">
                                                <button type="button"
                                                    class="remove-location-btn text-red-600 hover:text-red-800 text-sm font-medium transition-colors duration-300">
                                                    <i class="fas fa-trash ml-1"></i>
                                                    {{ __('app.lands_create.button_remove_location') }}
                                                </button>
                                            </div>
                                        </div>
                                    @endfor
                                </div>

                                <div class="text-center mt-6">
                                    <button type="button" id="add-desired-location"
                                        class="bg-transparent text-[#2f5c69] border-2 border-[#2f5c69] hover:bg-[#2f5c69] hover:text-white px-6 py-3 rounded-2xl font-bold text-sm transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                        <i class="fas fa-plus ml-2"></i>
                                        {{ __('app.lands_create.button_add_location') }}
                                    </button>
                                </div>
                            </div>

                            <div class="mb-8">
                                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-handshake text-[#2f5c69] ml-3"></i>
                                    {{ __('app.lands_create.section_transaction_type') }}
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <label class="relative cursor-pointer group">
                                        <input type="radio" name="transaction_type" value="sale"
                                            class="sr-only peer" required
                                            {{ old('transaction_type') == 'sale' ? 'checked' : '' }} />
                                        <div
                                            class="border-2 border-gray-200 rounded-2xl p-4 text-center transition-all duration-300 group-hover:shadow-xl group-hover:border-[#f3a446]/50 peer-checked:border-[#f3a446] peer-checked:bg-[#f3a446]/5 peer-checked:shadow-2xl">
                                            <i
                                                class="fas fa-tag text-4xl text-gray-400 mb-3 transition-all duration-300 peer-checked:text-[#f3a446]"></i>
                                            <div class="font-semibold text-gray-900 text-lg">
                                                {{ __('app.lands_create.transaction_sale_title') }}
                                            </div>
                                            <div class="text-sm text-gray-600">
                                                {{ __('app.lands_create.transaction_sale_desc') }}
                                            </div>
                                        </div>
                                    </label>

                                    <label class="relative cursor-pointer group">
                                        <input type="radio" name="transaction_type" value="exchange"
                                            class="sr-only peer"
                                            {{ old('transaction_type') == 'exchange' ? 'checked' : '' }} />
                                        <div
                                            class="border-2 border-gray-200 rounded-2xl p-4 text-center transition-all duration-300 group-hover:shadow-xl group-hover:border-[#f3a446]/50 peer-checked:border-[#f3a446] peer-checked:bg-[#f3a446]/5 peer-checked:shadow-2xl">
                                            <i
                                                class="fas fa-exchange-alt text-4xl text-gray-400 mb-3 transition-all duration-300 peer-checked:text-[#f3a446]"></i>
                                            <div class="font-semibold text-gray-900 text-lg">
                                                {{ __('app.lands_create.transaction_exchange_title') }}
                                            </div>
                                            <div class="text-sm text-gray-600">
                                                {{ __('app.lands_create.transaction_exchange_desc') }}
                                            </div>
                                        </div>
                                    </label>

                                    <label class="relative cursor-pointer group">
                                        <input type="radio" name="transaction_type" value="both"
                                            class="sr-only peer"
                                            {{ old('transaction_type') == 'both' ? 'checked' : '' }} />
                                        <div
                                            class="border-2 border-gray-200 rounded-2xl p-4 text-center transition-all duration-300 group-hover:shadow-xl group-hover:border-[#f3a446]/50 peer-checked:border-[#f3a446] peer-checked:bg-[#f3a446]/5 peer-checked:shadow-2xl">
                                            <i
                                                class="fas fa-arrows-alt-h text-4xl text-gray-400 mb-3 transition-all duration-300 peer-checked:text-[#f3a446]"></i>
                                            <div class="font-semibold text-gray-900 text-lg">
                                                {{ __('app.lands_create.transaction_both_title') }}
                                            </div>
                                            <div class="text-sm text-gray-600">
                                                {{ __('app.lands_create.transaction_both_desc') }}
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-8">
                                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-align-right text-[#2f5c69] ml-3"></i>
                                    {{ __('app.lands_create.section_description') }}
                                </h3>

                                <div class="space-y-2">
                                    <label
                                        class="block text-sm font-bold text-gray-800">{{ __('app.lands_create.label_description') }}</label>
                                    <textarea name="description" rows="5"
                                        class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 backdrop-blur-sm hover:bg-white hover:shadow-lg"
                                        placeholder="{{ __('app.lands_create.placeholder_description') }}">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <div class="mb-8">
                                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-star text-[#2f5c69] ml-3"></i>
                                    {{ __('app.lands_create.section_features') }}
                                </h3>

                                <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
                                    <label class="flex items-center space-x-3 cursor-pointer">
                                        <input type="checkbox" name="features[]" value="services"
                                            class="rounded border-gray-300 text-[#2f5c69] focus:ring-[#2f5c69]/50 shadow-sm ml-3"
                                            {{ in_array('services', old('features', [])) ? 'checked' : '' }} />
                                        <span
                                            class="text-gray-700 font-medium">{{ __('app.lands_create.feature_services') }}</span>
                                    </label>

                                    <label class="flex items-center space-x-3 cursor-pointer">
                                        <input type="checkbox" name="features[]" value="paved"
                                            class="rounded border-gray-300 text-[#2f5c69] focus:ring-[#2f5c69]/50 shadow-sm ml-3"
                                            {{ in_array('paved', old('features', [])) ? 'checked' : '' }} />
                                        <span
                                            class="text-gray-700 font-medium">{{ __('app.lands_create.feature_paved') }}</span>
                                    </label>

                                    <label class="flex items-center space-x-3 cursor-pointer">
                                        <input type="checkbox" name="features[]" value="flat"
                                            class="rounded border-gray-300 text-[#2f5c69] focus:ring-[#2f5c69]/50 shadow-sm ml-3"
                                            {{ in_array('flat', old('features', [])) ? 'checked' : '' }} />
                                        <span
                                            class="text-gray-700 font-medium">{{ __('app.lands_create.feature_flat') }}</span>
                                    </label>

                                    <label class="flex items-center space-x-3 cursor-pointer">
                                        <input type="checkbox" name="features[]" value="corner"
                                            class="rounded border-gray-300 text-[#2f5c69] focus:ring-[#2f5c69]/50 shadow-sm ml-3"
                                            {{ in_array('corner', old('features', [])) ? 'checked' : '' }} />
                                        <span
                                            class="text-gray-700 font-medium">{{ __('app.lands_create.feature_corner') }}</span>
                                    </label>

                                    <label class="flex items-center space-x-3 cursor-pointer">
                                        <input type="checkbox" name="features[]" value="view"
                                            class="rounded border-gray-300 text-[#2f5c69] focus:ring-[#2f5c69]/50 shadow-sm ml-3"
                                            {{ in_array('view', old('features', [])) ? 'checked' : '' }} />
                                        <span
                                            class="text-gray-700 font-medium">{{ __('app.lands_create.feature_view') }}</span>
                                    </label>

                                    <label class="flex items-center space-x-3 cursor-pointer">
                                        <input type="checkbox" name="features[]" value="security"
                                            class="rounded border-gray-300 text-[#2f5c69] focus:ring-[#2f5c69]/50 shadow-sm ml-3"
                                            {{ in_array('security', old('features', [])) ? 'checked' : '' }} />
                                        <span
                                            class="text-gray-700 font-medium">{{ __('app.lands_create.feature_security') }}</span>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-8">
                                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-phone text-[#2f5c69] ml-3"></i>
                                    {{ __('app.lands_create.section_contact') }}
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label
                                            class="block text-sm font-bold text-gray-800">{{ __('app.lands_create.label_contact_name') }}</label>
                                        <input type="text" name="contact_name" required
                                            value="{{ old('contact_name') }}"
                                            class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 backdrop-blur-sm hover:bg-white hover:shadow-lg"
                                            placeholder="{{ __('app.lands_create.placeholder_contact_name') }}" />
                                    </div>

                                    <div class="space-y-2">
                                        <label
                                            class="block text-sm font-bold text-gray-800">{{ __('app.lands_create.label_contact_phone') }}</label>
                                        <input type="tel" name="contact_phone" required
                                            value="{{ old('contact_phone') }}"
                                            class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 backdrop-blur-sm hover:bg-white hover:shadow-lg"
                                            placeholder="{{ __('app.lands_create.placeholder_contact_phone') }}" />
                                    </div>

                                    <div class="space-y-2">
                                        <label
                                            class="block text-sm font-bold text-gray-800">{{ __('app.lands_create.label_contact_whatsapp') }}</label>
                                        <input type="tel" name="contact_whatsapp"
                                            value="{{ old('contact_whatsapp') }}"
                                            class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 backdrop-blur-sm hover:bg-white hover:shadow-lg"
                                            placeholder="{{ __('app.lands_create.placeholder_contact_phone') }}" />
                                    </div>

                                    <div class="space-y-2">
                                        <label
                                            class="block text-sm font-bold text-gray-800">{{ __('app.lands_create.label_contact_email') }}</label>
                                        <input type="email" name="contact_email" value="{{ old('contact_email') }}"
                                            class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 backdrop-blur-sm hover:bg-white hover:shadow-lg"
                                            placeholder="{{ __('app.lands_create.placeholder_contact_email') }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-8">
                                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-images text-[#2f5c69] ml-3"></i>
                                    {{ __('app.lands_create.section_images') }}
                                </h3>

                                <div
                                    class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-[#f3a446] transition-all duration-300">
                                    <i class="fas fa-cloud-upload-alt text-5xl text-gray-400 mb-4"></i>
                                    <p class="text-lg font-medium text-gray-900 mb-2">
                                        {{ __('app.lands_create.image_upload_drag') }}
                                    </p>
                                    <p class="text-gray-600 mb-4">
                                        {{ __('app.lands_create.image_upload_click') }}
                                    </p>
                                    <input type="file" name="images[]" multiple accept="image/*" class="hidden"
                                        id="image-upload" />
                                    <label for="image-upload"
                                        class="bg-[#f3a446] text-[#1a262a] px-8 py-3 rounded-2xl font-bold text-sm hover:bg-[#f5b05a] transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl cursor-pointer inline-block">
                                        {{ __('app.lands_create.button_image_upload') }}
                                    </label>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                                <button type="submit"
                                    class="flex-1 bg-[#2f5c69] text-white py-4 px-6 rounded-2xl font-bold text-lg hover:bg-[#1a262a] transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                                    <i class="fas fa-paper-plane ml-2"></i>
                                    {{ __('app.lands_create.button_submit') }}
                                </button>

                                <a href="{{ route('lands.index') }}"
                                    class="flex-1 bg-gray-100 text-gray-700 py-4 px-6 rounded-2xl font-bold text-lg hover:bg-gray-200 transition-colors text-center">
                                    <i class="fas fa-times ml-2"></i>
                                    {{ __('app.lands_create.button_cancel') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="lg:sticky lg:top-28">
                        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <i class="fas fa-lightbulb text-[#f3a446] ml-3 text-2xl"></i>
                                {{ __('app.lands_create.sidebar_title') }}
                            </h3>

                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <i class="fas fa-check-circle text-[#2f5c69] mt-1 ml-3"></i>
                                    <p class="text-gray-700">
                                        {{ __('app.lands_create.tip_1') }}
                                    </p>
                                </div>

                                <div class="flex items-start">
                                    <i class="fas fa-check-circle text-[#2f5c69] mt-1 ml-3"></i>
                                    <p class="text-gray-700">
                                        {{ __('app.lands_create.tip_2') }}
                                    </p>
                                </div>

                                <div class="flex items-start">
                                    <i class="fas fa-check-circle text-[#2f5c69] mt-1 ml-3"></i>
                                    <p class="text-gray-700">
                                        {{ __('app.lands_create.tip_3') }}
                                    </p>
                                </div>

                                <div class="flex items-start">
                                    <i class="fas fa-check-circle text-[#2f5c69] mt-1 ml-3"></i>
                                    <p class="text-gray-700">
                                        {{ __('app.lands_create.tip_4') }}
                                    </p>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 pt-6 mt-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">
                                    {{ __('app.lands_create.sidebar_links_title') }}
                                </h4>
                                <div class="flex flex-wrap gap-3">
                                    <a href="{{ route('lands.my-ads') }}"
                                        class="inline-flex items-center px-5 py-2.5 bg-[#f3a446]/10 text-[#f3a446] rounded-xl hover:bg-[#f3a446]/20 transition-all duration-300 font-medium">
                                        <i class="fas fa-list ml-2"></i>
                                        {{ __('app.lands_create.link_my_ads') }}
                                    </a>
                                    <a href="{{ route('lands.my-offers') }}"
                                        class="inline-flex items-center px-5 py-2.5 bg-[#2f5c69]/10 text-[#2f5c69] rounded-xl hover:bg-[#2f5c69]/20 transition-all duration-300 font-medium">
                                        <i class="fas fa-handshake ml-2"></i>
                                        {{ __('app.lands_create.link_my_offers') }}
                                    </a>
                                    <a href="{{ route('lands.index') }}"
                                        class="inline-flex items-center px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-300 font-medium">
                                        <i class="fas fa-search ml-2"></i>
                                        {{ __('app.lands_create.link_browse_lands') }}
                                    </a>
                                </div>
                            </div>
                        </div>
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
