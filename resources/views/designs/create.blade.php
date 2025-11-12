@extends('layouts.app')

@section('title', 'إنشاء تصميم جديد - انشاءات')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
<div class="bg-gradient-to-br from-[#2f5c69] to-[#1a262a] rounded-lg shadow-lg p-6 mb-6">
    <div class="flex items-center gap-4 border-b-2 border-[#f3a446]/30 pb-4 mb-6 pt-20">
        <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-[#f3a446]/20 flex items-center justify-center border border-[#f3a446]/30 ">
            <i class="fas fa-palette text-[#f3a446] text-xl"></i>
        </div>
        <div>
            <h1 class="text-3xl font-bold text-white">{{ __('app.create_design.title') }}</h1>
            <p class="text-gray-300 mt-1">{{ __('app.create_design.subtitle') }}</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <form action="{{ route('designs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @auth
        <div class="mb-6 bg-[#f3a446]/10 border border-[#f3a446]/30 rounded-lg p-4">
            <div class="flex items-center">
                <i class="fas fa-info-circle text-[#f3a446] ml-2"></i>
                <p class="text-yellow-800 text-sm">
                    {{ __('app.create_design.autofill_notice') }}
                </p>
            </div>
        </div>
        @endauth

        @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex items-start">
                <i class="fas fa-exclamation-triangle text-red-600 ml-2 mt-1"></i>
                <div>
                    <h3 class="text-red-800 font-medium mb-2">{{ __('app.global.errors.title') }}</h3>
                    <ul class="text-red-700 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <div class="border-b">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <h2 class="text-xl font-semibold text-[#2f5c69]">{{ __('app.form.sections.basic_info') }}</h2>
            </div>
            <div class="p-6">
                <table class="w-full">
                    <tbody class="space-y-4">
                        <tr>
                            <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">{{ __('app.form.labels.title') }}</td>
                            <td class="py-3">
                                <input type="text" name="title" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                    placeholder="{{ __('app.form.placeholders.title') }}"
                                    value="{{ old('title', '') }}">
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3 pr-4 text-sm font-medium text-gray-700">{{ __('app.form.labels.style') }}</td>
                            <td class="py-3">
                                <select name="style" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]">
                                    <option value="">{{ __('app.form.options.select_style') }}</option>
                                    <option value="modern" {{ old('style') == 'modern' ? 'selected' : '' }}>{{ __('app.form.options.style.modern') }}</option>
                                    <option value="islamic" {{ old('style') == 'islamic' ? 'selected' : '' }}>{{ __('app.form.options.style.islamic') }}</option>
                                    <option value="traditional" {{ old('style') == 'traditional' ? 'selected' : '' }}>{{ __('app.form.options.style.traditional') }}</option>
                                    <option value="classic" {{ old('style') == 'classic' ? 'selected' : '' }}>{{ __('app.form.options.style.classic') }}</option>
                                    <option value="minimalist" {{ old('style') == 'minimalist' ? 'selected' : '' }}>{{ __('app.form.options.style.minimalist') }}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3 pr-4 text-sm font-medium text-gray-700">{{ __('app.form.labels.price') }}</td>
                            <td class="py-3">
                                <input type="number" name="price" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                    placeholder="{{ __('app.form.placeholders.price') }}"
                                    value="{{ old('price', '') }}">
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3 pr-4 text-sm font-medium text-gray-700">{{ __('app.form.labels.area') }}</td>
                            <td class="py-3">
                                <input type="number" name="area" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                    placeholder="{{ __('app.form.placeholders.area') }}"
                                    value="{{ old('area', '') }}">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="border-b">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <h2 class="text-xl font-semibold text-[#2f5c69]">{{ __('app.form.sections.specifications') }}</h2>
            </div>
            <div class="p-6">
                <table class="w-full">
                    <tbody>
                        <tr>
                            <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">{{ __('app.form.labels.bedrooms') }}</td>
                            <td class="py-3">
                                <input type="number" name="bedrooms"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                    placeholder="{{ __('app.form.placeholders.bedrooms') }}"
                                    value="{{ old('bedrooms', '') }}">
                            </td>
                            <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">{{ __('app.form.labels.bathrooms') }}</td>
                            <td class="py-3">
                                <input type="number" name="bathrooms"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                    placeholder="{{ __('app.form.placeholders.bathrooms') }}"
                                    value="{{ old('bathrooms', '') }}">
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3 pr-4 text-sm font-medium text-gray-700">{{ __('app.form.labels.floors') }}</td>
                            <td class="py-3">
                                <input type="number" name="floors"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                    placeholder="{{ __('app.form.placeholders.floors') }}"
                                    value="{{ old('floors', '') }}">
                            </td>
                            <td class="py-3 pr-4 text-sm font-medium text-gray-700">{{ __('app.form.labels.location') }}</td>
                            <td class="py-3">
                                <input type="text" name="location"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                    placeholder="{{ __('app.form.placeholders.location') }}"
                                    value="{{ old('location', '') }}">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="border-b">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <h2 class="text-xl font-semibold text-[#2f5c69]">{{ __('app.form.sections.description') }}</h2>
            </div>
            <div class="p-6">
                <table class="w-full">
                    <tbody>
                        <tr>
                            <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">{{ __('app.form.labels.description_detailed') }}</td>
                            <td class="py-3">
                                <textarea name="description" rows="4" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                    placeholder="{{ __('app.form.placeholders.description_detailed') }}">{{ old('description', '') }}</textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="border-b">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <h2 class="text-xl font-semibold text-[#2f5c69]">{{ __('app.form.sections.features') }}</h2>
            </div>
            <div class="p-6">
                <table class="w-full">
                    <tbody>
                        <tr>
                            <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">{{ __('app.form.labels.features_available') }}</td>
                            <td class="py-3">
                                <div class="grid grid-cols-2 gap-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="features[]" value="حديقة خارجية" class="ml-3 rounded text-[#f3a446] focus:ring-[#f3a446]" {{ in_array('حديقة خارجية', old('features', [])) ? 'checked' : '' }}>
                                        <span class="text-sm text-gray-700">{{ __('app.form.features.garden') }}</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="features[]" value="موقف سيارات" class="ml-3 rounded text-[#f3a446] focus:ring-[#f3a446]" {{ in_array('موقف سيارات', old('features', [])) ? 'checked' : '' }}>
                                        <span class="text-sm text-gray-700">{{ __('app.form.features.parking') }}</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="features[]" value="مطبخ مجهز" class="ml-3 rounded text-[#f3a446] focus:ring-[#f3a446]" {{ in_array('مطبخ مجهز', old('features', [])) ? 'checked' : '' }}>
                                        <span class="text-sm text-gray-700">{{ __('app.form.features.kitchen') }}</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="features[]" value="غرفة معيشة واسعة" class="ml-3 rounded text-[#f3a446] focus:ring-[#f3a446]" {{ in_array('غرفة معيشة واسعة', old('features', [])) ? 'checked' : '' }}>
                                        <span class="text-sm text-gray-700">{{ __('app.form.features.living_room') }}</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="features[]" value="مسبح خاص" class="ml-3 rounded text-[#f3a446] focus:ring-[#f3a446]" {{ in_array('مسبح خاص', old('features', [])) ? 'checked' : '' }}>
                                        <span class="text-sm text-gray-700">{{ __('app.form.features.pool') }}</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="features[]" value="مصعد داخلي" class="ml-3 rounded text-[#f3a446] focus:ring-[#f3a446]" {{ in_array('مصعد داخلي', old('features', [])) ? 'checked' : '' }}>
                                        <span class="text-sm text-gray-700">{{ __('app.form.features.elevator') }}</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="features[]" value="شرفات" class="ml-3 rounded text-[#f3a446] focus:ring-[#f3a446]" {{ in_array('شرفات', old('features', [])) ? 'checked' : '' }}>
                                        <span class="text-sm text-gray-700">{{ __('app.form.features.balconies') }}</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="features[]" value="مخازن" class="ml-3 rounded text-[#f3a446] focus:ring-[#f3a446]" {{ in_array('مخازن', old('features', [])) ? 'checked' : '' }}>
                                        <span class="text-sm text-gray-700">{{ __('app.form.features.storage') }}</span>
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="border-b">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <h2 class="text-xl font-semibold text-[#2f5c69]">{{ __('app.form.sections.contact_info') }}</h2>
            </div>
            <div class="p-6">
                <table class="w-full">
                    <tbody>
                        <tr>
                            <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">{{ __('app.form.labels.consultant_name') }}</td>
                            <td class="py-3">
                                <input type="text" name="consultant_name" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                    placeholder="{{ __('app.form.placeholders.consultant_name') }}"
                                    value="{{ old('consultant_name', auth()->user()->name ?? '') }}">
                            </td>
                            <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">{{ __('app.form.labels.consultant_phone') }}</td>
                            <td class="py-3">
                                <input type="tel" name="consultant_phone"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                    placeholder="{{ __('app.form.placeholders.consultant_phone') }}"
                                    value="{{ old('consultant_phone', auth()->user()->phone ?? '') }}">
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3 pr-4 text-sm font-medium text-gray-700">{{ __('app.form.labels.consultant_email') }}</td>
                            <td class="py-3">
                                <input type="email" name="consultant_email"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                    placeholder="{{ __('app.form.placeholders.consultant_email') }}"
                                    value="{{ old('consultant_email', auth()->user()->email ?? '') }}">
                            </td>
                            <td class="py-3 pr-4 text-sm font-medium text-gray-700">{{ __('app.form.labels.location') }}</td>
                            <td class="py-3">
                                <input type="text" name="location"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                    placeholder="{{ __('app.form.placeholders.location') }}">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="border-b">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <h2 class="text-xl font-semibold text-[#2f5c69]">{{ __('app.form.sections.design_images') }}</h2>
            </div>
            <div class="p-6">
                <table class="w-full">
                    <tbody>
                        <tr>
                            <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">{{ __('app.form.labels.main_image') }}</td>
                            <td class="py-3">
                                <input type="file" name="main_image" accept="image/*" required
                                    class="w-full text-gray-600 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#f3a446] focus:border-[#f3a446] file:bg-[#2f5c69] file:text-white file:font-semibold file:border-none file:py-2 file:px-4 file:mr-4 hover:file:bg-[#2f5c69]/90">
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3 pr-4 text-sm font-medium text-gray-700">{{ __('app.form.labels.additional_images') }}</td>
                            <td class="py-3">
                                <input type="file" name="images[]" accept="image/*" multiple
                                    class="w-full text-gray-600 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#f3a446] focus:border-[#f3a446] file:bg-[#2f5c69] file:text-white file:font-semibold file:border-none file:py-2 file:px-4 file:mr-4 hover:file:bg-[#2f5c69]/90">
                                <p class="text-sm text-gray-500 mt-1">{{ __('app.form.help.multiple_images') }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
            <!-- Pricing Section -->
<div class="border-b">
    <div class="bg-gray-50 px-6 py-4 border-b">
        <h2 class="text-xl font-semibold text-[#2f5c69]">{{ __('app.pricing.title') }}</h2>
        <p class="text-sm text-gray-600 mt-1">{{ __('app.pricing.subtitle') }}</p>
    </div>
    <div class="p-6 bg-white">
        <div class="space-y-6">
            <div class="border rounded-lg bg-gray-50 overflow-hidden shadow-sm">
                <div class="bg-[#2f5c69] text-white px-4 py-3">
                    <h3 class="text-lg font-semibold">{{ __('app.pricing.categories.preparatory') }}</h3>
                </div>
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="bg-white">
                                <tr>
                                    <th class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">{{ __('app.pricing.table.item_name') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.quantity') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit_price') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.total') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody id="category-1-items">
                                <tr class="pricing-row">
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="text" name="pricing[1][0][item_name]"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            placeholder="{{ __('app.pricing.placeholders.preparatory') }}">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="pricing[1][0][quantity]" step="0.01"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            placeholder="0.00">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <select name="pricing[1][0][unit]" class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]">
                                            <option value="م³">{{ __('app.pricing.units.cubic_meter') }}</option>
                                            <option value="م²">{{ __('app.pricing.units.square_meter') }}</option>
                                            <option value="م">{{ __('app.pricing.units.meter') }}</option>
                                            <option value="قطعة">{{ __('app.pricing.units.piece') }}</option>
                                        </select>
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="pricing[1][0][unit_price]" step="0.01"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            placeholder="0.00">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="pricing[1][0][total_price]" step="0.01"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            readonly>
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                        <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="pricing[1][0][category_id]" value="1">
                    <button type="button" class="mt-2 text-[#2f5c69] hover:text-[#1e3c44] text-sm font-semibold add-item-btn" data-category="1">
                        <i class="fas fa-plus ml-1"></i> {{ __('app.pricing.buttons.add_item') }}
                    </button>
                </div>
            </div>

            <div class="border rounded-lg bg-gray-50 overflow-hidden shadow-sm">
                <div class="bg-[#2f5c69] text-white px-4 py-3">
                    <h3 class="text-lg font-semibold">{{ __('app.pricing.categories.excavation_below_ground') }}</h3>
                </div>
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="bg-white">
                                <tr>
                                    <th class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">{{ __('app.pricing.table.item_name') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.quantity') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit_price') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.total') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody id="category-2-items">
                                <tr class="pricing-row">
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="text" name="pricing[2][0][item_name]"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            placeholder="{{ __('app.pricing.placeholders.excavation_below_ground') }}">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="pricing[2][0][quantity]" step="0.01"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            placeholder="0.00">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <select name="pricing[2][0][unit]" class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]">
                                            <option value="م²">{{ __('app.pricing.units.square_meter') }}</option>
                                            <option value="م³">{{ __('app.pricing.units.cubic_meter') }}</option>
                                            <option value="م">{{ __('app.pricing.units.meter') }}</option>
                                            <option value="قطعة">{{ __('app.pricing.units.piece') }}</option>
                                        </select>
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="pricing[2][0][unit_price]" step="0.01"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            placeholder="0.00">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="pricing[2][0][total_price]" step="0.01"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            readonly>
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                        <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="pricing[2][0][category_id]" value="2">
                    <button type="button" class="mt-2 text-[#2f5c69] hover:text-[#1e3c44] text-sm font-semibold add-item-btn" data-category="2">
                        <i class="fas fa-plus ml-1"></i> {{ __('app.pricing.buttons.add_item') }}
                    </button>
                </div>
            </div>

            <div class="border rounded-lg bg-gray-50 overflow-hidden shadow-sm">
                <div class="bg-[#2f5c69] text-white px-4 py-3">
                    <h3 class="text-lg font-semibold">{{ __('app.pricing.categories.concrete_above_ground') }}</h3>
                </div>
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="bg-white">
                                <tr>
                                    <th class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">{{ __('app.pricing.table.item_name') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.quantity') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit_price') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.total') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody id="category-3-items">
                                <tr class="pricing-row">
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="text" name="pricing[3][0][item_name]"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            placeholder="{{ __('app.pricing.placeholders.concrete_above_ground') }}">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="pricing[3][0][quantity]" step="0.01"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            placeholder="0.00">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <select name="pricing[3][0][unit]" class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]">
                                            <option value="م²">{{ __('app.pricing.units.square_meter') }}</option>
                                            <option value="م³">{{ __('app.pricing.units.cubic_meter') }}</option>
                                            <option value="م">{{ __('app.pricing.units.meter') }}</option>
                                            <option value="قطعة">{{ __('app.pricing.units.piece') }}</option>
                                        </select>
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="pricing[3][0][unit_price]" step="0.01"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            placeholder="0.00">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="pricing[3][0][total_price]" step="0.01"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            readonly>
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                        <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="pricing[3][0][category_id]" value="3">
                    <button type="button" class="mt-2 text-[#2f5c69] hover:text-[#1e3c44] text-sm font-semibold add-item-btn" data-category="3">
                        <i class="fas fa-plus ml-1"></i> {{ __('app.pricing.buttons.add_item') }}
                    </button>
                </div>
            </div>

            <div class="border rounded-lg bg-gray-50 overflow-hidden shadow-sm">
                <div class="bg-[#2f5c69] text-white px-4 py-3">
                    <h3 class="text-lg font-semibold">{{ __('app.pricing.categories.brickwork') }}</h3>
                </div>
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="bg-white">
                                <tr>
                                    <th class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">{{ __('app.pricing.table.item_name') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.quantity') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit_price') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.total') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody id="category-4-items">
                                <tr class="pricing-row">
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="text" name="pricing[4][0][item_name]"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            placeholder="{{ __('app.pricing.placeholders.brickwork') }}">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="pricing[4][0][quantity]" step="0.01"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            placeholder="0.00">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <select name="pricing[4][0][unit]" class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]">
                                            <option value="م">{{ __('app.pricing.units.meter') }}</option>
                                            <option value="م²">{{ __('app.pricing.units.square_meter') }}</option>
                                            <option value="م³">{{ __('app.pricing.units.cubic_meter') }}</option>
                                            <option value="قطعة">{{ __('app.pricing.units.piece') }}</option>
                                        </select>
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="pricing[4][0][unit_price]" step="0.01"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            placeholder="0.00">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="pricing[4][0][total_price]" step="0.01"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            readonly>
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                        <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="pricing[4][0][category_id]" value="4">
                    <button type="button" class="mt-2 text-[#2f5c69] hover:text-[#1e3c44] text-sm font-semibold add-item-btn" data-category="4">
                        <i class="fas fa-plus ml-1"></i> {{ __('app.pricing.buttons.add_item') }}
                    </button>
                </div>
            </div>

            <div class="border rounded-lg bg-gray-50 overflow-hidden shadow-sm">
                <div class="bg-[#2f5c69] text-white px-4 py-3">
                    <h3 class="text-lg font-semibold">{{ __('app.pricing.categories.insulation') }}</h3>
                </div>
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="bg-white">
                                <tr>
                                    <th class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">{{ __('app.pricing.table.item_name') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.quantity') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit_price') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.total') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody id="category-5-items">
                                <tr class="pricing-row">
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="text" name="pricing[5][0][item_name]"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            placeholder="{{ __('app.pricing.placeholders.insulation') }}">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="pricing[5][0][quantity]" step="0.01"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            placeholder="0.00">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <select name="pricing[5][0][unit]" class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]">
                                            <option value="م">{{ __('app.pricing.units.meter') }}</option>
                                            <option value="م²">{{ __('app.pricing.units.square_meter') }}</option>
                                            <option value="م³">{{ __('app.pricing.units.cubic_meter') }}</option>
                                            <option value="قطعة">{{ __('app.pricing.units.piece') }}</option>
                                        </select>
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="pricing[5][0][unit_price]" step="0.01"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            placeholder="0.00">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="pricing[5][0][total_price]" step="0.01"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            readonly>
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                        <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="pricing[5][0][category_id]" value="5">
                    <button type="button" class="mt-2 text-[#2f5c69] hover:text-[#1e3c44] text-sm font-semibold add-item-btn" data-category="5">
                        <i class="fas fa-plus ml-1"></i> {{ __('app.pricing.buttons.add_item') }}
                    </button>
                </div>
            </div>

            <div class="border rounded-lg bg-gray-50 overflow-hidden shadow-sm">
                <div class="bg-[#2f5c69] text-white px-4 py-3">
                    <h3 class="text-lg font-semibold">{{ __('app.pricing.categories.finishing') }}</h3>
                </div>
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="bg-white">
                                <tr>
                                    <th class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">{{ __('app.pricing.table.item_name') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.quantity') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit_price') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.total') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody id="category-6-items">
                                <tr class="pricing-row">
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="text" name="pricing[6][0][item_name]"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            placeholder="{{ __('app.pricing.placeholders.finishing') }}">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="pricing[6][0][quantity]" step="0.01"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            placeholder="0.00">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <select name="pricing[6][0][unit]" class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]">
                                            <option value="قطعة">{{ __('app.pricing.units.piece') }}</option>
                                            <option value="م²">{{ __('app.pricing.units.square_meter') }}</option>
                                            <option value="م">{{ __('app.pricing.units.meter') }}</option>
                                            <option value="م³">{{ __('app.pricing.units.cubic_meter') }}</option>
                                        </select>
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="pricing[6][0][unit_price]" step="0.01"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            placeholder="0.00">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="pricing[6][0][total_price]" step="0.01"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            readonly>
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                        <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="pricing[6][0][category_id]" value="6">
                    <button type="button" class="mt-2 text-[#2f5c69] hover:text-[#1e3c44] text-sm font-semibold add-item-btn" data-category="6">
                        <i class="fas fa-plus ml-1"></i> {{ __('app.pricing.buttons.add_item') }}
                    </button>
                </div>
            </div>

            <div class="border rounded-lg bg-gray-50 overflow-hidden shadow-sm">
                <div class="bg-[#2f5c69] text-white px-4 py-3">
                    <h3 class="text-lg font-semibold">{{ __('app.pricing.categories.carpentry') }}</h3>
                </div>
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="bg-white">
                                <tr>
                                    <th class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">{{ __('app.pricing.table.item_name') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.quantity') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit_price') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.total') }}</th>
                                    <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody id="category-7-items">
                                <tr class="pricing-row">
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="text" name="pricing[7][0][item_name]"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            placeholder="{{ __('app.pricing.placeholders.carpentry') }}">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="pricing[7][0][quantity]" step="0.01"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            placeholder="0.00">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <select name="pricing[7][0][unit]" class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]">
                                            <option value="م²">{{ __('app.pricing.units.square_meter') }}</option>
                                            <option value="لتر">{{ __('app.pricing.units.liter') }}</option>
                                            <option value="كيلو">{{ __('app.pricing.units.kilo') }}</option>
                                            <option value="قطعة">{{ __('app.pricing.units.piece') }}</option>
                                        </select>
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="pricing[7][0][unit_price]" step="0.01"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            placeholder="0.00">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <input type="number" name="pricing[7][0][total_price]" step="0.01"
                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                            readonly>
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                        <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="pricing[7][0][category_id]" value="7">
                    <button type="button" class="mt-2 text-[#2f5c69] hover:text-[#1e3c44] text-sm font-semibold add-item-btn" data-category="7">
                        <i class="fas fa-plus ml-1"></i> {{ __('app.pricing.buttons.add_item') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

                        <!-- أعمال الألومنيوم والزجاج -->
<div class="border rounded-lg bg-gray-50 overflow-hidden shadow-sm">
    <div class="bg-[#2f5c69] text-white px-4 py-3">
        <h3 class="text-lg font-semibold">{{ __('app.pricing.categories.aluminum') }}</h3>
    </div>
    <div class="p-4">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-white">
                    <tr>
                        <th class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">{{ __('app.pricing.table.item_name') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.quantity') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit_price') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.total') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.actions') }}</th>
                    </tr>
                </thead>
                <tbody id="category-8-items">
                    <tr class="pricing-row">
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="text" name="pricing[8][0][item_name]"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                placeholder="{{ __('app.pricing.placeholders.aluminum') }}">
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="number" name="pricing[8][0][quantity]" step="0.01"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                placeholder="0.00">
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <select name="pricing[8][0][unit]" class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]">
                                <option value="م²">{{ __('app.pricing.units.square_meter') }}</option>
                                <option value="قطعة">{{ __('app.pricing.units.piece') }}</option>
                                <option value="م">{{ __('app.pricing.units.meter') }}</option>
                                <option value="كيلو">{{ __('app.pricing.units.kilo') }}</option>
                            </select>
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="number" name="pricing[8][0][unit_price]" step="0.01"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                placeholder="0.00">
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="number" name="pricing[8][0][total_price]" step="0.01"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                readonly>
                        </td>
                        <td class="border border-gray-300 px-3 py-2 text-center">
                            <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <input type="hidden" name="pricing[8][0][category_id]" value="8">
        <button type="button" class="mt-2 text-[#2f5c69] hover:text-[#1e3c44] text-sm font-semibold add-item-btn" data-category="8">
            <i class="fas fa-plus ml-1"></i> {{ __('app.pricing.buttons.add_item') }}
        </button>
    </div>
</div>

<div class="border rounded-lg bg-gray-50 overflow-hidden shadow-sm">
    <div class="bg-[#2f5c69] text-white px-4 py-3">
        <h3 class="text-lg font-semibold">{{ __('app.pricing.categories.electrical') }}</h3>
    </div>
    <div class="p-4">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-white">
                    <tr>
                        <th class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">{{ __('app.pricing.table.item_name') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.quantity') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit_price') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.total') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.actions') }}</th>
                    </tr>
                </thead>
                <tbody id="category-9-items">
                    <tr class="pricing-row">
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="text" name="pricing[9][0][item_name]"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                placeholder="{{ __('app.pricing.placeholders.electrical') }}">
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="number" name="pricing[9][0][quantity]" step="0.01"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                placeholder="0.00">
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <select name="pricing[9][0][unit]" class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]">
                                <option value="قطعة">{{ __('app.pricing.units.piece') }}</option>
                                <option value="م²">{{ __('app.pricing.units.square_meter') }}</option>
                                <option value="كيلو">{{ __('app.pricing.units.kilo') }}</option>
                                <option value="طن">{{ __('app.pricing.units.ton') }}</option>
                            </select>
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="number" name="pricing[9][0][unit_price]" step="0.01"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                placeholder="0.00">
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="number" name="pricing[9][0][total_price]" step="0.01"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                readonly>
                        </td>
                        <td class="border border-gray-300 px-3 py-2 text-center">
                            <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <input type="hidden" name="pricing[9][0][category_id]" value="9">
        <button type="button" class="mt-2 text-[#2f5c69] hover:text-[#1e3c44] text-sm font-semibold add-item-btn" data-category="9">
            <i class="fas fa-plus ml-1"></i> {{ __('app.pricing.buttons.add_item') }}
        </button>
    </div>
</div>

<div class="border rounded-lg bg-gray-50 overflow-hidden shadow-sm">
    <div class="bg-[#2f5c69] text-white px-4 py-3">
        <h3 class="text-lg font-semibold">{{ __('app.pricing.categories.ac') }}</h3>
    </div>
    <div class="p-4">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-white">
                    <tr>
                        <th class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">{{ __('app.pricing.table.item_name') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.quantity') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit_price') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.total') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.actions') }}</th>
                    </tr>
                </thead>
                <tbody id="category-10-items">
                    <tr class="pricing-row">
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="text" name="pricing[10][0][item_name]"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                placeholder="{{ __('app.pricing.placeholders.ac') }}">
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="number" name="pricing[10][0][quantity]" step="0.01"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                placeholder="0.00">
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <select name="pricing[10][0][unit]" class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]">
                                <option value="م²">{{ __('app.pricing.units.square_meter') }}</option>
                                <option value="م³">{{ __('app.pricing.units.cubic_meter') }}</option>
                                <option value="كيلو">{{ __('app.pricing.units.kilo') }}</option>
                                <option value="لتر">{{ __('app.pricing.units.liter') }}</option>
                            </select>
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="number" name="pricing[10][0][unit_price]" step="0.01"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                placeholder="0.00">
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="number" name="pricing[10][0][total_price]" step="0.01"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                readonly>
                        </td>
                        <td class="border border-gray-300 px-3 py-2 text-center">
                            <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <input type="hidden" name="pricing[10][0][category_id]" value="10">
        <button type="button" class="mt-2 text-[#2f5c69] hover:text-[#1e3c44] text-sm font-semibold add-item-btn" data-category="10">
            <i class="fas fa-plus ml-1"></i> {{ __('app.pricing.buttons.add_item') }}
        </button>
    </div>
</div>

                        <!-- أعمال الصحية -->
                 <div class="border rounded-lg bg-gray-50 overflow-hidden shadow-sm">
    <div class="bg-[#2f5c69] text-white px-4 py-3">
        <h3 class="text-lg font-semibold">{{ __('app.pricing.categories.plumbing') }}</h3>
    </div>
    <div class="p-4">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-white">
                    <tr>
                        <th class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">{{ __('app.pricing.table.item_name') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.quantity') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit_price') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.total') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.actions') }}</th>
                    </tr>
                </thead>
                <tbody id="category-11-items">
                    <tr class="pricing-row">
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="text" name="pricing[11][0][item_name]"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                placeholder="{{ __('app.pricing.placeholders.plumbing') }}">
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="number" name="pricing[11][0][quantity]" step="0.01"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                placeholder="0.00">
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <select name="pricing[11][0][unit]" class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]">
                                <option value="م">{{ __('app.pricing.units.meter') }}</option>
                                <option value="قطعة">{{ __('app.pricing.units.piece') }}</option>
                                <option value="م²">{{ __('app.pricing.units.square_meter') }}</option>
                                <option value="م³">{{ __('app.pricing.units.cubic_meter') }}</option>
                            </select>
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="number" name="pricing[11][0][unit_price]" step="0.01"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                placeholder="0.00">
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="number" name="pricing[11][0][total_price]" step="0.01"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                readonly>
                        </td>
                        <td class="border border-gray-300 px-3 py-2 text-center">
                            <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <input type="hidden" name="pricing[11][0][category_id]" value="11">
        <button type="button" class="mt-2 text-[#2f5c69] hover:text-[#1e3c44] text-sm font-semibold add-item-btn" data-category="11">
            <i class="fas fa-plus ml-1"></i> {{ __('app.pricing.buttons.add_item') }}
        </button>
    </div>
</div>

<div class="border rounded-lg bg-gray-50 overflow-hidden shadow-sm">
    <div class="bg-[#2f5c69] text-white px-4 py-3">
        <h3 class="text-lg font-semibold">{{ __('app.pricing.categories.exterior') }}</h3>
    </div>
    <div class="p-4">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-white">
                    <tr>
                        <th class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">{{ __('app.pricing.table.item_name') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.quantity') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.unit_price') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.total') }}</th>
                        <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">{{ __('app.pricing.table.actions') }}</th>
                    </tr>
                </thead>
                <tbody id="category-12-items">
                    <tr class="pricing-row">
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="text" name="pricing[12][0][item_name]"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                placeholder="{{ __('app.pricing.placeholders.exterior') }}">
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="number" name="pricing[12][0][quantity]" step="0.01"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                placeholder="0.00">
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <select name="pricing[12][0][unit]" class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]">
                                <option value="م²">{{ __('app.pricing.units.square_meter') }}</option>
                                <option value="م">{{ __('app.pricing.units.meter') }}</option>
                                <option value="قطعة">{{ __('app.pricing.units.piece') }}</option>
                                <option value="م³">{{ __('app.pricing.units.cubic_meter') }}</option>
                            </select>
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="number" name="pricing[12][0][unit_price]" step="0.01"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                placeholder="0.00">
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="number" name="pricing[12][0][total_price]" step="0.01"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446]"
                                readonly>
                        </td>
                        <td class="border border-gray-300 px-3 py-2 text-center">
                            <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <input type="hidden" name="pricing[12][0][category_id]" value="12">
        <button type="button" class="mt-2 text-[#2f5c69] hover:text-[#1e3c44] text-sm font-semibold add-item-btn" data-category="12">
            <i class="fas fa-plus ml-1"></i> {{ __('app.pricing.buttons.add_item') }}
        </button>
    </div>
</div>
</div>

<div class="mt-6 bg-[#f3a446]/10 border border-[#f3a446]/30 rounded-lg p-6 shadow-sm">
    <h3 class="text-xl font-semibold text-yellow-900 mb-4">{{ __('app.pricing.summary.title') }}</h3>
    <table class="w-full">
        <tbody>
            <tr>
                <td class="py-2 text-right text-sm font-medium text-yellow-800 w-1/4">{{ __('app.pricing.summary.total_cost') }}</td>
                <td class="py-2">
                    <span class="text-3xl font-bold text-yellow-900" id="total-cost">0.00</span>
                    <span class="text-sm text-yellow-800 mr-2">{{ __('app.pricing.summary.currency') }}</span>
                </td>
                <td class="py-2 text-right text-sm font-medium text-yellow-800 w-1/4">{{ __('app.pricing.summary.total_items') }}</td>
                <td class="py-2">
                    <span class="text-2xl font-bold text-yellow-900" id="total-items">0</span>
                    <span class="text-sm text-yellow-800 mr-2">{{ __('app.pricing.summary.item_unit') }}</span>
                </td>
            </tr>
            <tr>
                <td class="py-2 text-right text-sm font-medium text-yellow-800 w-1/4">{{ __('app.pricing.summary.total_categories') }}</td>
                <td class="py-2">
                    <span class="text-2xl font-bold text-yellow-900">12</span>
                    <span class="text-sm text-yellow-800 mr-2">{{ __('app.pricing.summary.category_unit') }}</span>
                </td>
                <td class="py-2 text-right text-sm font-medium text-yellow-800 w-1/4">{{ __('app.pricing.summary.avg_cost') }}</td>
                <td class="py-2">
                    <span class="text-2xl font-bold text-yellow-900" id="avg-cost">0.00</span>
                    <span class="text-sm text-yellow-800 mr-2">{{ __('app.pricing.summary.avg_cost_unit') }}</span>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</div>

<div class="bg-gray-50 px-6 py-4">
    <div class="flex flex-col sm:flex-row gap-4">
        <button type="submit" class="flex-1 bg-[#f3a446] text-[#1a262a] py-3 rounded-lg font-semibold hover:bg-yellow-600 transition duration-300 shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
            <i class="fas fa-save ml-2"></i>
            {{ __('app.global.buttons.save_design') }}
        </button>
        <a href="{{ route('designs.index') }}" class="flex-1 border border-gray-300 text-gray-700 py-3 rounded-lg font-semibold text-center hover:bg-gray-100 transition duration-300">
            {{ __('app.global.buttons.cancel') }}
        </a>
    </div>
</div>
            </form>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-calculate totals when quantity or unit price changes
    function calculateTotal(quantityInput, unitPriceInput, totalInput) {
        const quantity = parseFloat(quantityInput.value) || 0;
        const unitPrice = parseFloat(unitPriceInput.value) || 0;
        const total = quantity * unitPrice;
        totalInput.value = total.toFixed(2);
        updateGrandTotal();
    }

    // Update grand total
    function updateGrandTotal() {
        const totalInputs = document.querySelectorAll('.pricing-total');
        let grandTotal = 0;
        let itemCount = 0;

        totalInputs.forEach(input => {
            const value = parseFloat(input.value) || 0;
            grandTotal += value;
            if (value > 0) itemCount++;
        });

        const avgCost = itemCount > 0 ? grandTotal / itemCount : 0;

        document.getElementById('total-cost').textContent = grandTotal.toFixed(2);
        document.getElementById('total-items').textContent = itemCount;
        document.getElementById('avg-cost').textContent = avgCost.toFixed(2);
    }

    // Add event listeners to all quantity and unit price inputs
    function addEventListeners() {
        document.querySelectorAll('.pricing-quantity, .pricing-unit-price').forEach(input => {
            input.addEventListener('input', function() {
                const row = this.closest('tr');
                const quantityInput = row.querySelector('.pricing-quantity');
                const unitPriceInput = row.querySelector('.pricing-unit-price');
                const totalInput = row.querySelector('.pricing-total');

                if (quantityInput && unitPriceInput && totalInput) {
                    calculateTotal(quantityInput, unitPriceInput, totalInput);
                }
            });
        });
    }

    // Add new item to specific category
    function addItemToCategory(categoryId) {
        const tbody = document.getElementById(`category-${categoryId}-items`);
        const rowCount = tbody.children.length;

        const newRow = document.createElement('tr');
        newRow.className = 'pricing-row';
        newRow.innerHTML = `
            <td class="border border-gray-300 px-3 py-2">
                <input type="text" name="pricing[${categoryId}][${rowCount}][item_name]"
                       class="w-full border border-gray-300 rounded px-2 py-1 text-sm"
                       placeholder="اسم البند">
            </td>
            <td class="border border-gray-300 px-3 py-2">
                <input type="number" name="pricing[${categoryId}][${rowCount}][quantity]" step="0.01"
                       class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity"
                       placeholder="0.00">
            </td>
            <td class="border border-gray-300 px-3 py-2">
                <select name="pricing[${categoryId}][${rowCount}][unit]" class="w-full border border-gray-300 rounded px-2 py-1 text-sm">
                    <option value="م²">م²</option>
                    <option value="م³">م³</option>
                    <option value="م">م</option>
                    <option value="قطعة">قطعة</option>
                </select>
            </td>
            <td class="border border-gray-300 px-3 py-2">
                <input type="number" name="pricing[${categoryId}][${rowCount}][unit_price]" step="0.01"
                       class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price"
                       placeholder="0.00">
            </td>
            <td class="border border-gray-300 px-3 py-2">
                <input type="number" name="pricing[${categoryId}][${rowCount}][total_price]" step="0.01"
                       class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                       readonly>
            </td>
            <td class="border border-gray-300 px-3 py-2 text-center">
                <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;

        tbody.appendChild(newRow);

        // Add event listeners to new inputs
        const quantityInput = newRow.querySelector('.pricing-quantity');
        const unitPriceInput = newRow.querySelector('.pricing-unit-price');
        const totalInput = newRow.querySelector('.pricing-total');

        [quantityInput, unitPriceInput].forEach(input => {
            input.addEventListener('input', function() {
                calculateTotal(quantityInput, unitPriceInput, totalInput);
            });
        });
    }

    // Remove item from table
    function removeItem(button) {
        const row = button.closest('tr');
        row.remove();
        updateGrandTotal();
    }

    // Event listeners
    document.querySelectorAll('.add-item-btn').forEach(button => {
        button.addEventListener('click', function() {
            const categoryId = this.getAttribute('data-category');
            addItemToCategory(categoryId);
        });
    });

    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-item-btn')) {
            removeItem(e.target.closest('.remove-item-btn'));
        }
    });

    // Auto-fill consultant data
    function autoFillConsultantData() {
        @auth
        const consultantData = {
            name: '{{ auth()->user()->name ?? "" }}',
            phone: '{{ auth()->user()->phone ?? "" }}',
            email: '{{ auth()->user()->email ?? "" }}',
            city: '{{ auth()->user()->city ?? "" }}'
        };

        // Fill the fields only if old() data is not available
        if (!document.querySelector('input[name="consultant_name"]').value) {
            if (consultantData.name) {
                document.querySelector('input[name="consultant_name"]').value = consultantData.name;
            }
        }
        if (!document.querySelector('input[name="consultant_phone"]').value) {
            if (consultantData.phone) {
                document.querySelector('input[name="consultant_phone"]').value = consultantData.phone;
            }
        }
        if (!document.querySelector('input[name="consultant_email"]').value) {
            if (consultantData.email) {
                document.querySelector('input[name="consultant_email"]').value = consultantData.email;
            }
        }
        if (!document.querySelector('input[name="location"]').value) {
            if (consultantData.city) {
                document.querySelector('input[name="location"]').value = consultantData.city;
            }
        }
        
        console.log('تم ملء بيانات الاستشاري تلقائياً:', consultantData);
        @endauth
    }

    // Restore pricing data from old() input
    function restorePricingData() {
        @if(old('pricing'))
        const oldPricing = @json(old('pricing'));
        
        // Loop through each category
        Object.keys(oldPricing).forEach(categoryId => {
            const categoryItems = oldPricing[categoryId];
            
            // Loop through items in this category
            categoryItems.forEach((item, index) => {
                if (item.item_name) {
                    // Find the category table
                    const categoryTable = document.querySelector(`[data-category-id="${categoryId}"] tbody`);
                    
                    // Add item row if it doesn't exist
                    let row = categoryTable.querySelector(`tr:nth-child(${index + 1})`);
                    if (!row) {
                        addItemToCategory(categoryId);
                        row = categoryTable.querySelector(`tr:nth-child(${index + 1})`);
                    }
                    
                    // Fill the data
                    if (row) {
                        row.querySelector('input[name*="[item_name]"]').value = item.item_name || '';
                        row.querySelector('input[name*="[quantity]"]').value = item.quantity || '';
                        row.querySelector('input[name*="[unit]"]').value = item.unit || '';
                        row.querySelector('input[name*="[unit_price]"]').value = item.unit_price || '';
                        row.querySelector('input[name*="[total_price]"]').value = item.total_price || '';
                    }
                }
            });
        });
        
        // Update totals
        updateGrandTotal();
        @endif
    }

    // Initialize
    addEventListeners();
    updateGrandTotal();
    autoFillConsultantData();
    restorePricingData();
});
</script>
@endsection
