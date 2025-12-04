@extends('layouts.app')

@section('title', 'تعديل التصميم - انشاءات')

@section('content')
    @php
        $designFeatures =
            is_array($design->features) ? $design->features : (json_decode($design->features ?? '[]', true) ?: []);
    @endphp
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md border border-gray-100 p-4 md:p-6 mb-6 mt-20">
    <div class="border-b border-[#f3a446]/30 pb-4 mb-4">
        <div class="flex items-center mb-2">
            <div class="w-10 h-10 rounded-lg bg-[#2f5c69]/10 flex items-center justify-center ml-3 rtl:ml-3 ltr:mr-3">
                <i class="fas fa-edit text-[#2f5c69] text-lg"></i>
            </div>
            <h1 class="text-2xl md:text-3xl font-bold text-[#1a262a]">
                {{ __('app.edit_header.title') }} <span class="text-[#2f5c69]">{{ $design->title }}</span>
            </h1>
        </div>
        <p class="text-gray-500 text-sm md:text-base pr-[3.25rem] rtl:pr-[3.25rem] ltr:pl-[3.25rem]">
            {{ __('app.edit_header.subtitle') }}
        </p>
    </div>
</div>

        <!-- Main Form -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <form action="{{ route('designs.update', $design->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
@auth
    <div class="mb-6 bg-[#2f5c69]/10 border border-[#2f5c69]/20 rounded-lg p-4">
        <div class="flex items-center">
            <i class="fas fa-info-circle text-[#2f5c69] mr-2 ml-2"></i>
            <p class="text-[#1a262a] text-sm">
                {{ __('app.design_form.auto_fill_info') }}
            </p>
        </div>
    </div>
@endauth

@if ($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
        <div class="flex items-start">
            <i class="fas fa-exclamation-triangle text-red-600 mr-2 ml-2 mt-1"></i>
            <div>
                <h3 class="text-red-800 font-medium mb-2">{{ __('app.design_form.error_title') }}</h3>
                <ul class="text-red-700 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

<div class="border-b border-gray-200">
    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-[#1a262a]">{{ __('app.design_form.sections.basic_info') }}</h2>
    </div>
    <div class="p-4 md:p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    {{ __('app.design_form.fields.title') }} *
                </label>
                <input type="text" name="title" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition-colors"
                    placeholder="{{ __('app.design_form.fields.title_placeholder') }}" 
                    value="{{ old('title', $design->title) }}">
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    {{ __('app.design_form.fields.style') }} *
                </label>
                <select name="style" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition-colors">
                    <option value="">{{ __('app.design_form.fields.select_style') }}</option>
                    @foreach(['modern', 'islamic', 'traditional', 'classic', 'minimalist'] as $style)
                        <option value="{{ $style }}" {{ old('style', $design->style) == $style ? 'selected' : '' }}>
                            {{ __('app.design_form.styles.' . $style) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    {{ __('app.design_form.fields.price') }} *
                </label>
                <input type="number" name="price" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition-colors"
                    placeholder="{{ __('app.design_form.fields.price_placeholder') }}" 
                    value="{{ old('price', $design->price) }}">
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    {{ __('app.design_form.fields.area') }} *
                </label>
                <input type="number" name="area" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition-colors"
                    placeholder="{{ __('app.design_form.fields.area_placeholder') }}" 
                    value="{{ old('area', $design->area) }}">
            </div>
        </div>
    </div>
</div>

<div class="border-b border-gray-200">
    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-[#1a262a]">{{ __('app.design_form.sections.specifications') }}</h2>
    </div>
    <div class="p-4 md:p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    {{ __('app.design_form.fields.bedrooms') }}
                </label>
                <input type="number" name="bedrooms"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition-colors"
                    placeholder="{{ __('app.design_form.fields.bedrooms_placeholder') }}" 
                    value="{{ old('bedrooms', $design->bedrooms) }}">
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    {{ __('app.design_form.fields.bathrooms') }}
                </label>
                <input type="number" name="bathrooms"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition-colors"
                    placeholder="{{ __('app.design_form.fields.bathrooms_placeholder') }}" 
                    value="{{ old('bathrooms', $design->bathrooms) }}">
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    {{ __('app.design_form.fields.floors') }}
                </label>
                <input type="number" name="floors"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition-colors"
                    placeholder="{{ __('app.design_form.fields.floors_placeholder') }}" 
                    value="{{ old('floors', $design->floors) }}">
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    {{ __('app.design_form.fields.location') }}
                </label>
                <input type="text" name="location"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition-colors"
                    placeholder="{{ __('app.design_form.fields.location_placeholder') }}"
                    value="{{ old('location', $design->location) }}">
            </div>
        </div>
    </div>
</div>

<div class="border-b border-gray-200">
    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-[#1a262a]">{{ __('app.design_form.sections.description') }}</h2>
    </div>
    <div class="p-4 md:p-6">
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">
                {{ __('app.design_form.fields.description') }} *
            </label>
            <textarea name="description" rows="4" required
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition-colors"
                placeholder="{{ __('app.design_form.fields.description_placeholder') }}">{{ old('description', $design->description) }}</textarea>
        </div>
    </div>
</div>

<div class="border-b border-gray-200">
    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-[#1a262a]">{{ __('app.design_form.sections.features') }}</h2>
    </div>
    <div class="p-4 md:p-6">
        <div class="space-y-4">
            <label class="block text-sm font-medium text-gray-700">
                {{ __('app.design_form.fields.available_features') }}
            </label>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @php
                    $featuresList = [
                        'garden', 'parking', 'kitchen', 'living_room', 
                        'pool', 'elevator', 'balcony', 'storage'
                    ];
                @endphp
                
                @foreach($featuresList as $featureKey)
                    <label class="flex items-center p-3 border border-gray-100 rounded-lg hover:bg-gray-50 transition-colors">
                        <input type="checkbox" name="features[]" value="{{ $featureKey }}"
                            class="rounded text-[#f3a446] focus:ring-[#f3a446] mr-2 ml-2"
                            {{ in_array($featureKey, old('features', $designFeatures ?? [])) ? 'checked' : '' }}>
                        <span class="text-sm text-gray-700">{{ __('app.design_form.features.' . $featureKey) }}</span>
                    </label>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="border-b border-gray-200">
    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-[#1a262a]">{{ __('app.design_form.sections.contact') }}</h2>
    </div>
    <div class="p-4 md:p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    {{ __('app.design_form.fields.consultant_name') }} *
                </label>
                <input type="text" name="consultant_name" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition-colors"
                    placeholder="{{ __('app.design_form.fields.consultant_name_placeholder') }}"
                    value="{{ old('consultant_name', $design->consultant_name) }}">
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    {{ __('app.design_form.fields.consultant_phone') }}
                </label>
                <input type="tel" name="consultant_phone"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition-colors"
                    placeholder="{{ __('app.design_form.fields.consultant_phone_placeholder') }}"
                    value="{{ old('consultant_phone', $design->consultant_phone) }}">
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    {{ __('app.design_form.fields.consultant_email') }}
                </label>
                <input type="email" name="consultant_email"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition-colors"
                    placeholder="{{ __('app.design_form.fields.consultant_email_placeholder') }}"
                    value="{{ old('consultant_email', $design->consultant_email) }}">
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    {{ __('app.design_form.fields.location') }}
                </label>
                <input type="text" name="location"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition-colors"
                    placeholder="{{ __('app.design_form.fields.location_placeholder') }}">
            </div>
        </div>
    </div>
</div>

<div class="border-b border-gray-200">
    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-[#1a262a]">{{ __('app.design_form.sections.images') }}</h2>
    </div>
    <div class="p-4 md:p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    {{ __('app.design_form.fields.main_image') }}
                </label>
                @if ($design->main_image)
                    <div class="mb-4 p-2 border border-gray-100 rounded-lg bg-gray-50">
                        <p class="text-sm text-[#1a262a] mb-2 font-medium">{{ __('app.design_form.fields.current_image') }}</p>
                        <img src="{{ asset('storage/' . $design->main_image) }}"
                            alt="Main Image" class="w-32 h-32 object-cover rounded-lg shadow-sm">
                    </div>
                @endif
                <input type="file" name="main_image" accept="image/*"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#f3a446]/10 file:text-[#f3a446] hover:file:bg-[#f3a446]/20">
                <p class="text-xs text-gray-500 mt-1">{{ __('app.design_form.fields.keep_image_hint') }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    {{ __('app.design_form.fields.additional_images') }}
                </label>
                @if ($design->images && is_array($design->images) && count($design->images) > 0)
                    <div class="mb-4 p-2 border border-gray-100 rounded-lg bg-gray-50">
                        <p class="text-sm text-[#1a262a] mb-2 font-medium">{{ __('app.design_form.fields.current_image') }}</p>
                        <div class="grid grid-cols-3 gap-2">
                            @foreach ($design->images as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="Additional Image"
                                    class="w-20 h-20 object-cover rounded-lg shadow-sm">
                            @endforeach
                        </div>
                    </div>
                @endif
                <input type="file" name="images[]" accept="image/*" multiple
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#f3a446]/10 file:text-[#f3a446] hover:file:bg-[#f3a446]/20">
                <p class="text-xs text-gray-500 mt-1">{{ __('app.design_form.fields.keep_images_hint') }}</p>
            </div>
        </div>
    </div>
</div>

                <!-- Pricing Section -->
                <div class="border-b">
                   <div class="bg-white rounded-lg shadow-md border border-gray-100 p-4 md:p-6 mb-6">
    <div class="border-b border-[#f3a446]/30 pb-4 mb-4">
        <div class="flex items-center mb-2">
            <div class="w-10 h-10 rounded-lg bg-[#2f5c69]/10 flex items-center justify-center ml-3 rtl:ml-3 ltr:mr-3">
                <i class="fas fa-edit text-[#2f5c69] text-lg"></i>
            </div>
            <h1 class="text-2xl md:text-3xl font-bold text-[#1a262a]">
                {{ __('app.edit_header.title') }} <span class="text-[#2f5c69]">{{ $design->title }}</span>
            </h1>
        </div>
        <p class="text-gray-500 text-sm md:text-base pr-[3.25rem] rtl:pr-[3.25rem] ltr:pl-[3.25rem]">
            {{ __('app.edit_header.subtitle') }}
        </p>
    </div>
</div>
                    <div class="p-6">
                        <div class="space-y-6">
                            <div class="border border-gray-200 rounded-xl shadow-lg bg-white">
    <div class="bg-gradient-to-br from-[#2f5c69] to-[#1a262a] text-white px-4 py-3 rounded-t-xl">
        <h3 class="text-xl font-bold ">{{ __('app.preparatory_works') }}</h3>
    </div>
    <div class="p-4 sm:p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-300">
                <thead class="bg-blue-50">
                    <tr>
                        <th class="border border-gray-300 px-3 py-3 text-right text-sm font-bold text-gray-700 w-2/5 sm:w-1/3">
                            {{ __('app.item_name') }}
                        </th>
                        <th class="border border-gray-300 px-3 py-3 text-center text-sm font-bold text-gray-700 w-1/12">
                            {{ __('app.quantity') }}
                        </th>
                        <th class="border border-gray-300 px-3 py-3 text-center text-sm font-bold text-gray-700 w-1/12">
                            {{ __('app.unit') }}
                        </th>
                        <th class="border border-gray-300 px-3 py-3 text-center text-sm font-bold text-gray-700 w-1/6">
                            {{ __('app.unit_price_aed') }}
                        </th>
                        <th class="border border-gray-300 px-3 py-3 text-center text-sm font-bold text-gray-700 w-1/6">
                            {{ __('app.total_aed') }}
                        </th>
                        <th class="border border-gray-300 px-3 py-3 text-center text-sm font-bold text-gray-700 w-1/12">
                            {{ __('app.operations') }}
                        </th>
                    </tr>
                </thead>
                <tbody id="category-1-items">
                    <tr class="pricing-row bg-white hover:bg-gray-50 transition duration-150">
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="text" name="pricing[1][0][item_name]"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm text-right focus:ring-blue-500 focus:border-blue-500"
                                placeholder="{{ __('app.item_name_placeholder') }}">
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="number" name="pricing[1][0][quantity]" step="0.01"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm text-center pricing-quantity focus:ring-blue-500 focus:border-blue-500"
                                placeholder="0.00">
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <select name="pricing[1][0][unit]"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm text-center focus:ring-blue-500 focus:border-blue-500">
                                <option value="م³">م³</option>
                                <option value="م²">م²</option>
                                <option value="م">م</option>
                                <option value="قطعة">قطعة</option>
                            </select>
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="number" name="pricing[1][0][unit_price]" step="0.01"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm text-center pricing-unit-price focus:ring-blue-500 focus:border-blue-500"
                                placeholder="0.00">
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            <input type="number" name="pricing[1][0][total_price]" step="0.01"
                                class="w-full border border-gray-300 rounded px-2 py-1 text-sm text-center pricing-total bg-gray-100 text-gray-700 cursor-not-allowed"
                                readonly>
                        </td>
                        <td class="border border-gray-300 px-3 py-2 text-center">
                            <button type="button"
                                class="text-red-600 hover:text-red-800 remove-item-btn transition duration-150"
                                aria-label="حذف البند">
                                <i class="fas fa-trash"></i> 
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <input type="hidden" name="pricing[1][0][category_id]" value="1">
        <button type="button"
            class="mt-4 text-blue-600 hover:text-blue-800 text-sm font-medium add-item-btn flex items-center"
            data-category="1">
            <i class="fas fa-plus ml-2" dir="ltr"></i>
            {{ __('app.add_item') }}
        </button>
    </div>
</div>

    <div class="border rounded-lg bg-gray-50 shadow-sm overflow-hidden">
        <div class="bg-gradient-to-br from-[#2f5c69] to-[#1a262a] text-white px-4 py-3">
            <h3 class="text-lg font-semibold">{{ __('app.construction.below_ground_title') }}</h3>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 min-w-[600px]">
                    <thead class="bg-white">
                        <tr>
                            <th class="border border-gray-300 px-3 py-2 text-start text-sm font-semibold text-gray-700">
                                {{ __('app.construction.table.item_name') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.quantity') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.unit') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.unit_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.total_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-16">
                                {{ __('app.construction.table.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody id="category-2-items">
                        <tr class="pricing-row bg-white hover:bg-gray-50 transition-colors">
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="text" name="pricing[2][0][item_name]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="{{ __('app.construction.placeholders.walls') }}">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[2][0][quantity]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <select name="pricing[2][0][unit]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none">
                                    <option value="m2">{{ __('app.construction.units.m2') }}</option>
                                    <option value="m3">{{ __('app.construction.units.m3') }}</option>
                                    <option value="m">{{ __('app.construction.units.m') }}</option>
                                    <option value="piece">{{ __('app.construction.units.piece') }}</option>
                                </select>
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[2][0][unit_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[2][0][total_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                    readonly>
                            </td>
                            <td class="border border-gray-300 px-3 py-2 text-center">
                                <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="pricing[2][0][category_id]" value="2">
            <button type="button"
                class="mt-3 text-[#2f5c69] hover:text-[#1a262a] font-medium text-sm add-item-btn flex items-center transition-colors"
                data-category="2">
                <i class="fas fa-plus mr-2"></i> {{ __('app.construction.buttons.add_item') }}
            </button>
        </div>
    </div>

    <div class="border rounded-lg bg-gray-50 shadow-sm overflow-hidden">
        <div class="bg-gradient-to-br from-[#2f5c69] to-[#1a262a] text-white px-4 py-3">
            <h3 class="text-lg font-semibold">{{ __('app.construction.concrete_upper_title') }}</h3>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 min-w-[600px]">
                    <thead class="bg-white">
                        <tr>
                            <th class="border border-gray-300 px-3 py-2 text-start text-sm font-semibold text-gray-700">
                                {{ __('app.construction.table.item_name') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.quantity') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.unit') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.unit_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.total_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-16">
                                {{ __('app.construction.table.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody id="category-3-items">
                        <tr class="pricing-row bg-white hover:bg-gray-50 transition-colors">
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="text" name="pricing[3][0][item_name]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="{{ __('app.construction.placeholders.plaster') }}">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[3][0][quantity]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <select name="pricing[3][0][unit]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none">
                                    <option value="m2">{{ __('app.construction.units.m2') }}</option>
                                    <option value="m3">{{ __('app.construction.units.m3') }}</option>
                                    <option value="m">{{ __('app.construction.units.m') }}</option>
                                    <option value="piece">{{ __('app.construction.units.piece') }}</option>
                                </select>
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[3][0][unit_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[3][0][total_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                    readonly>
                            </td>
                            <td class="border border-gray-300 px-3 py-2 text-center">
                                <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="pricing[3][0][category_id]" value="3">
            <button type="button"
                class="mt-3 text-[#2f5c69] hover:text-[#1a262a] font-medium text-sm add-item-btn flex items-center transition-colors"
                data-category="3">
                <i class="fas fa-plus mr-2"></i> {{ __('app.construction.buttons.add_item') }}
            </button>
        </div>
    </div>

    <div class="border rounded-lg bg-gray-50 shadow-sm overflow-hidden">
        <div class="bg-gradient-to-br from-[#2f5c69] to-[#1a262a] text-white px-4 py-3">
            <h3 class="text-lg font-semibold">{{ __('app.construction.brickwork_title') }}</h3>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 min-w-[600px]">
                    <thead class="bg-white">
                        <tr>
                            <th class="border border-gray-300 px-3 py-2 text-start text-sm font-semibold text-gray-700">
                                {{ __('app.construction.table.item_name') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.quantity') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.unit') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.unit_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.total_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-16">
                                {{ __('app.construction.table.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody id="category-4-items">
                        <tr class="pricing-row bg-white hover:bg-gray-50 transition-colors">
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="text" name="pricing[4][0][item_name]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="{{ __('app.construction.placeholders.water') }}">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[4][0][quantity]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <select name="pricing[4][0][unit]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none">
                                    <option value="m">{{ __('app.construction.units.m') }}</option>
                                    <option value="m2">{{ __('app.construction.units.m2') }}</option>
                                    <option value="m3">{{ __('app.construction.units.m3') }}</option>
                                    <option value="piece">{{ __('app.construction.units.piece') }}</option>
                                </select>
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[4][0][unit_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[4][0][total_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                    readonly>
                            </td>
                            <td class="border border-gray-300 px-3 py-2 text-center">
                                <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="pricing[4][0][category_id]" value="4">
            <button type="button"
                class="mt-3 text-[#2f5c69] hover:text-[#1a262a] font-medium text-sm add-item-btn flex items-center transition-colors"
                data-category="4">
                <i class="fas fa-plus mr-2"></i> {{ __('app.construction.buttons.add_item') }}
            </button>
        </div>
    </div>

    <div class="border rounded-lg bg-gray-50 shadow-sm overflow-hidden">
        <div class="bg-gradient-to-br from-[#2f5c69] to-[#1a262a] text-white px-4 py-3">
            <h3 class="text-lg font-semibold">{{ __('app.construction.insulation_title') }}</h3>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 min-w-[600px]">
                    <thead class="bg-white">
                        <tr>
                            <th class="border border-gray-300 px-3 py-2 text-start text-sm font-semibold text-gray-700">
                                {{ __('app.construction.table.item_name') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.quantity') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.unit') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.unit_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.total_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-16">
                                {{ __('app.construction.table.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody id="category-5-items">
                        <tr class="pricing-row bg-white hover:bg-gray-50 transition-colors">
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="text" name="pricing[5][0][item_name]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="{{ __('app.construction.placeholders.electric') }}">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[5][0][quantity]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <select name="pricing[5][0][unit]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none">
                                    <option value="m">{{ __('app.construction.units.m') }}</option>
                                    <option value="m2">{{ __('app.construction.units.m2') }}</option>
                                    <option value="m3">{{ __('app.construction.units.m3') }}</option>
                                    <option value="piece">{{ __('app.construction.units.piece') }}</option>
                                </select>
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[5][0][unit_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[5][0][total_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                    readonly>
                            </td>
                            <td class="border border-gray-300 px-3 py-2 text-center">
                                <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="pricing[5][0][category_id]" value="5">
            <button type="button"
                class="mt-3 text-[#2f5c69] hover:text-[#1a262a] font-medium text-sm add-item-btn flex items-center transition-colors"
                data-category="5">
                <i class="fas fa-plus mr-2"></i> {{ __('app.construction.buttons.add_item') }}
            </button>
        </div>
    </div>

    <div class="border rounded-lg bg-gray-50 shadow-sm overflow-hidden">
        <div class="bg-gradient-to-br from-[#2f5c69] to-[#1a262a] text-white px-4 py-3">
            <h3 class="text-lg font-semibold">{{ __('app.construction.finishing_title') }}</h3>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 min-w-[600px]">
                    <thead class="bg-white">
                        <tr>
                            <th class="border border-gray-300 px-3 py-2 text-start text-sm font-semibold text-gray-700">
                                {{ __('app.construction.table.item_name') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.quantity') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.unit') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.unit_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.total_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-16">
                                {{ __('app.construction.table.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody id="category-6-items">
                        <tr class="pricing-row bg-white hover:bg-gray-50 transition-colors">
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="text" name="pricing[6][0][item_name]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="{{ __('app.construction.placeholders.wooden_doors') }}">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[6][0][quantity]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <select name="pricing[6][0][unit]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none">
                                    <option value="piece">{{ __('app.construction.units.piece') }}</option>
                                    <option value="m2">{{ __('app.construction.units.m2') }}</option>
                                    <option value="m">{{ __('app.construction.units.m') }}</option>
                                    <option value="m3">{{ __('app.construction.units.m3') }}</option>
                                </select>
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[6][0][unit_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[6][0][total_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                    readonly>
                            </td>
                            <td class="border border-gray-300 px-3 py-2 text-center">
                                <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="pricing[6][0][category_id]" value="6">
            <button type="button"
                class="mt-3 text-[#2f5c69] hover:text-[#1a262a] font-medium text-sm add-item-btn flex items-center transition-colors"
                data-category="6">
                <i class="fas fa-plus mr-2"></i> {{ __('app.construction.buttons.add_item') }}
            </button>
        </div>
    </div>

    <div class="border rounded-lg bg-gray-50 shadow-sm overflow-hidden">
        <div class="bg-gradient-to-br from-[#2f5c69] to-[#1a262a] text-white px-4 py-3">
            <h3 class="text-lg font-semibold">{{ __('app.construction.carpentry_title') }}</h3>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 min-w-[600px]">
                    <thead class="bg-white">
                        <tr>
                            <th class="border border-gray-300 px-3 py-2 text-start text-sm font-semibold text-gray-700">
                                {{ __('app.construction.table.item_name') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.quantity') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.unit') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.unit_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.total_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-16">
                                {{ __('app.construction.table.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody id="category-7-items">
                        <tr class="pricing-row bg-white hover:bg-gray-50 transition-colors">
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="text" name="pricing[7][0][item_name]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="{{ __('app.construction.placeholders.painting') }}">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[7][0][quantity]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <select name="pricing[7][0][unit]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none">
                                    <option value="m2">{{ __('app.construction.units.m2') }}</option>
                                    <option value="liter">{{ __('app.construction.units.liter') }}</option>
                                    <option value="kg">{{ __('app.construction.units.kg') }}</option>
                                    <option value="piece">{{ __('app.construction.units.piece') }}</option>
                                </select>
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[7][0][unit_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[7][0][total_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                    readonly>
                            </td>
                            <td class="border border-gray-300 px-3 py-2 text-center">
                                <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="pricing[7][0][category_id]" value="7">
            <button type="button"
                class="mt-3 text-[#2f5c69] hover:text-[#1a262a] font-medium text-sm add-item-btn flex items-center transition-colors"
                data-category="7">
                <i class="fas fa-plus mr-2"></i> {{ __('app.construction.buttons.add_item') }}
            </button>
        </div>
    </div>

    <div class="border rounded-lg bg-gray-50 shadow-sm overflow-hidden">
        <div class="bg-gradient-to-br from-[#2f5c69] to-[#1a262a] text-white px-4 py-3">
            <h3 class="text-lg font-semibold">{{ __('app.construction.aluminum_glass_title') }}</h3>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 min-w-[600px]">
                    <thead class="bg-white">
                        <tr>
                            <th class="border border-gray-300 px-3 py-2 text-start text-sm font-semibold text-gray-700">
                                {{ __('app.construction.table.item_name') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.quantity') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.unit') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.unit_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.total_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-16">
                                {{ __('app.construction.table.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody id="category-8-items">
                        <tr class="pricing-row bg-white hover:bg-gray-50 transition-colors">
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="text" name="pricing[8][0][item_name]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="{{ __('app.construction.placeholders.tiles') }}">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[8][0][quantity]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <select name="pricing[8][0][unit]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none">
                                    <option value="m2">{{ __('app.construction.units.m2') }}</option>
                                    <option value="piece">{{ __('app.construction.units.piece') }}</option>
                                    <option value="m">{{ __('app.construction.units.m') }}</option>
                                    <option value="kg">{{ __('app.construction.units.kg') }}</option>
                                </select>
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[8][0][unit_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[8][0][total_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                    readonly>
                            </td>
                            <td class="border border-gray-300 px-3 py-2 text-center">
                                <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="pricing[8][0][category_id]" value="8">
            <button type="button"
                class="mt-3 text-[#2f5c69] hover:text-[#1a262a] font-medium text-sm add-item-btn flex items-center transition-colors"
                data-category="8">
                <i class="fas fa-plus mr-2"></i> {{ __('app.construction.buttons.add_item') }}
            </button>
        </div>
    </div>

    <div class="border rounded-lg bg-gray-50 shadow-sm overflow-hidden">
        <div class="bg-gradient-to-br from-[#2f5c69] to-[#1a262a] text-white px-4 py-3">
            <h3 class="text-lg font-semibold">{{ __('app.construction.electrical_title') }}</h3>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 min-w-[600px]">
                    <thead class="bg-white">
                        <tr>
                            <th class="border border-gray-300 px-3 py-2 text-start text-sm font-semibold text-gray-700">
                                {{ __('app.construction.table.item_name') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.quantity') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.unit') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.unit_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.total_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-16">
                                {{ __('app.construction.table.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody id="category-9-items">
                        <tr class="pricing-row bg-white hover:bg-gray-50 transition-colors">
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="text" name="pricing[9][0][item_name]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="{{ __('app.construction.placeholders.iron_doors') }}">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[9][0][quantity]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <select name="pricing[9][0][unit]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none">
                                    <option value="piece">{{ __('app.construction.units.piece') }}</option>
                                    <option value="m2">{{ __('app.construction.units.m2') }}</option>
                                    <option value="kg">{{ __('app.construction.units.kg') }}</option>
                                    <option value="ton">{{ __('app.construction.units.ton') }}</option>
                                </select>
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[9][0][unit_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[9][0][total_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                    readonly>
                            </td>
                            <td class="border border-gray-300 px-3 py-2 text-center">
                                <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="pricing[9][0][category_id]" value="9">
            <button type="button"
                class="mt-3 text-[#2f5c69] hover:text-[#1a262a] font-medium text-sm add-item-btn flex items-center transition-colors"
                data-category="9">
                <i class="fas fa-plus mr-2"></i> {{ __('app.construction.buttons.add_item') }}
            </button>
        </div>
    </div>
    <div class="border rounded-lg bg-gray-50 shadow-sm overflow-hidden">
        <div class="bg-gradient-to-br from-[#2f5c69] to-[#1a262a] text-white px-4 py-3">
            <h3 class="text-lg font-semibold">{{ __('app.construction.ac_title') }}</h3>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 min-w-[600px]">
                    <thead class="bg-white">
                        <tr>
                            <th class="border border-gray-300 px-3 py-2 text-start text-sm font-semibold text-gray-700">
                                {{ __('app.construction.table.item_name') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.quantity') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.unit') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.unit_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.total_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-16">
                                {{ __('app.construction.table.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody id="category-10-items">
                        <tr class="pricing-row bg-white hover:bg-gray-50 transition-colors">
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="text" name="pricing[10][0][item_name]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="{{ __('app.construction.placeholders.insulation_roof') }}">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[10][0][quantity]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <select name="pricing[10][0][unit]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none">
                                    <option value="m2">{{ __('app.construction.units.m2') }}</option>
                                    <option value="m3">{{ __('app.construction.units.m3') }}</option>
                                    <option value="kg">{{ __('app.construction.units.kg') }}</option>
                                    <option value="liter">{{ __('app.construction.units.liter') }}</option>
                                </select>
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[10][0][unit_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[10][0][total_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                    readonly>
                            </td>
                            <td class="border border-gray-300 px-3 py-2 text-center">
                                <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="pricing[10][0][category_id]" value="10">
            <button type="button"
                class="mt-3 text-[#2f5c69] hover:text-[#1a262a] font-medium text-sm add-item-btn flex items-center transition-colors"
                data-category="10">
                <i class="fas fa-plus mr-2"></i> {{ __('app.construction.buttons.add_item') }}
            </button>
        </div>
    </div>

    <div class="border rounded-lg bg-gray-50 shadow-sm overflow-hidden">
        <div class="bg-gradient-to-br from-[#2f5c69] to-[#1a262a] text-white px-4 py-3">
            <h3 class="text-lg font-semibold">{{ __('app.construction.sanitary_title') }}</h3>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 min-w-[600px]">
                    <thead class="bg-white">
                        <tr>
                            <th class="border border-gray-300 px-3 py-2 text-start text-sm font-semibold text-gray-700">
                                {{ __('app.construction.table.item_name') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.quantity') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.unit') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.unit_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.total_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-16">
                                {{ __('app.construction.table.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody id="category-11-items">
                        <tr class="pricing-row bg-white hover:bg-gray-50 transition-colors">
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="text" name="pricing[11][0][item_name]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="{{ __('app.construction.placeholders.sewage') }}">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[11][0][quantity]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <select name="pricing[11][0][unit]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none">
                                    <option value="m">{{ __('app.construction.units.m') }}</option>
                                    <option value="piece">{{ __('app.construction.units.piece') }}</option>
                                    <option value="m2">{{ __('app.construction.units.m2') }}</option>
                                    <option value="m3">{{ __('app.construction.units.m3') }}</option>
                                </select>
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[11][0][unit_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[11][0][total_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                    readonly>
                            </td>
                            <td class="border border-gray-300 px-3 py-2 text-center">
                                <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="pricing[11][0][category_id]" value="11">
            <button type="button"
                class="mt-3 text-[#2f5c69] hover:text-[#1a262a] font-medium text-sm add-item-btn flex items-center transition-colors"
                data-category="11">
                <i class="fas fa-plus mr-2"></i> {{ __('app.construction.buttons.add_item') }}
            </button>
        </div>
    </div>

    <div class="border rounded-lg bg-gray-50 shadow-sm overflow-hidden">
        <div class="bg-gradient-to-br from-[#2f5c69] to-[#1a262a] text-white px-4 py-3">
            <h3 class="text-lg font-semibold">{{ __('app.construction.external_title') }}</h3>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 min-w-[600px]">
                    <thead class="bg-white">
                        <tr>
                            <th class="border border-gray-300 px-3 py-2 text-start text-sm font-semibold text-gray-700">
                                {{ __('app.construction.table.item_name') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.quantity') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-24">
                                {{ __('app.construction.table.unit') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.unit_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-32">
                                {{ __('app.construction.table.total_price') }}
                            </th>
                            <th class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 w-16">
                                {{ __('app.construction.table.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody id="category-12-items">
                        <tr class="pricing-row bg-white hover:bg-gray-50 transition-colors">
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="text" name="pricing[12][0][item_name]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="{{ __('app.construction.placeholders.garden') }}">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[12][0][quantity]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <select name="pricing[12][0][unit]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-[#f3a446] focus:border-[#f3a446] outline-none">
                                    <option value="m2">{{ __('app.construction.units.m2') }}</option>
                                    <option value="m">{{ __('app.construction.units.m') }}</option>
                                    <option value="piece">{{ __('app.construction.units.piece') }}</option>
                                    <option value="m3">{{ __('app.construction.units.m3') }}</option>
                                </select>
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[12][0][unit_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price focus:ring-[#f3a446] focus:border-[#f3a446] outline-none"
                                    placeholder="0.00">
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                <input type="number" name="pricing[12][0][total_price]" step="0.01"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                    readonly>
                            </td>
                            <td class="border border-gray-300 px-3 py-2 text-center">
                                <button type="button" class="text-red-600 hover:text-red-800 remove-item-btn transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="pricing[12][0][category_id]" value="12">
            <button type="button"
                class="mt-3 text-[#2f5c69] hover:text-[#1a262a] font-medium text-sm add-item-btn flex items-center transition-colors"
                data-category="12">
                <i class="fas fa-plus mr-2"></i> {{ __('app.construction.buttons.add_item') }}
            </button>
        </div>
    </div>

    <div class="mt-6 bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm">
        <h3 class="text-lg font-bold text-[#2f5c69] mb-3">{{ __('app.construction.summary.title') }}</h3>
        <table class="w-full">
            <tbody>
                <tr>
                    <td class="py-2 text-start text-sm font-medium text-gray-700 w-1/4">
                        {{ __('app.construction.summary.total_cost') }}
                    </td>
                    <td class="py-2">
                        <span class="text-2xl font-bold text-[#2f5c69]" id="total-cost">0.00</span>
                        <span class="text-sm text-gray-600 mr-2">{{ __('app.construction.summary.currency') }}</span>
                    </td>
                    <td class="py-2 text-start text-sm font-medium text-gray-700 w-1/4">
                        {{ __('app.construction.summary.total_items') }}
                    </td>
                    <td class="py-2">
                        <span class="text-xl font-bold text-green-600" id="total-items">0</span>
                        <span class="text-sm text-gray-600 mr-2">{{ __('app.construction.summary.item_unit') }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="py-2 text-start text-sm font-medium text-gray-700 w-1/4">
                        {{ __('app.construction.summary.total_categories') }}
                    </td>
                    <td class="py-2">
                        <span class="text-xl font-bold text-purple-600">12</span>
                        <span
                            class="text-sm text-gray-600 mr-2">{{ __('app.construction.summary.category_unit') }}</span>
                    </td>
                    <td class="py-2 text-start text-sm font-medium text-gray-700 w-1/4">
                        {{ __('app.construction.summary.avg_cost') }}
                    </td>
                    <td class="py-2">
                        <span class="text-xl font-bold text-[#f3a446]" id="avg-cost">0.00</span>
                        <span
                            class="text-sm text-gray-600 mr-2">{{ __('app.construction.summary.currency_per_item') }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="bg-white py-4">
        <div class="flex flex-col sm:flex-row gap-4">
            <button type="submit"
                class="flex-1 bg-gradient-to-r from-[#2f5c69] to-[#1a262a] text-white py-3 rounded-lg font-semibold hover:opacity-90 transition duration-300 flex items-center justify-center">
                <i class="fas fa-save mr-2 ml-2"></i>
                {{ __('app.construction.actions.save') }}
            </button>
            <a href="{{ route('designs.index') }}"
                class="flex-1 border border-gray-300 text-gray-700 py-3 rounded-lg font-semibold text-center hover:bg-gray-50 transition duration-300">
                {{ __('app.construction.actions.cancel') }}
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
                    name: '{{ auth()->user()->name ?? '' }}',
                    phone: '{{ auth()->user()->phone ?? '' }}',
                    email: '{{ auth()->user()->email ?? '' }}',
                    city: '{{ auth()->user()->city ?? '' }}'
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

        // Restore pricing data from old() input or current design data
        function restorePricingData() {
            @php
                $currentPricing = [];
                if (isset($design) && $design->items) {
                    foreach ($design->items as $item) {
                        $currentPricing[$item->category_id][] = [
                            'item_name' => $item->item_name,
                            'quantity' => $item->quantity,
                            'unit' => $item->unit,
                            'unit_price' => $item->unit_price,
                            'total_price' => $item->total_price,
                        ];
                    }
                }
            @endphp

            @if (old('pricing'))
                const oldPricing = @json(old('pricing'));
            @else
                const oldPricing = @json($currentPricing);
            @endif

            // Loop through each category
            Object.keys(oldPricing).forEach(categoryId => {
                const categoryItems = oldPricing[categoryId];

                // Loop through items in this category
                categoryItems.forEach((item, index) => {
                    if (item.item_name) {
                        // Find the category table
                        const categoryTable = document.querySelector(
                            `[data-category-id="${categoryId}"] tbody`);

                        // Add item row if it doesn't exist
                        let row = categoryTable.querySelector(`tr:nth-child(${index + 1})`);
                        if (!row) {
                            addItemToCategory(categoryId);
                            row = categoryTable.querySelector(`tr:nth-child(${index + 1})`);
                        }

                        // Fill the data
                        if (row) {
                            row.querySelector('input[name*="[item_name]"]').value = item
                                .item_name || '';
                            row.querySelector('input[name*="[quantity]"]').value = item.quantity ||
                                '';
                            row.querySelector('input[name*="[unit]"]').value = item.unit || '';
                            row.querySelector('input[name*="[unit_price]"]').value = item
                                .unit_price || '';
                            row.querySelector('input[name*="[total_price]"]').value = item
                                .total_price || '';
                        }
                    }
                });
            });

            // Update totals
            updateGrandTotal();
        }

        // Initialize
        addEventListeners(); updateGrandTotal(); autoFillConsultantData(); restorePricingData();
        });
    </script>
@endsection
