@extends('layouts.app')

@section('title', __('projects.actions.create') . ' - insha\'at')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center py-4">
                <a href="{{ route('projects.index') }}" class="text-gray-500 hover:text-gray-700 mr-4">
                    <i class="fas fa-arrow-right text-lg"></i>
                </a>
                <div>
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900">إنشاء مشروع جديد</h1>
                    <p class="text-sm md:text-base text-gray-600">أضف تفاصيل مشروعك</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <form action="{{ route('projects.store') }}" method="POST" class="p-6">
                @csrf

                <!-- Project Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('projects.labels.title') }} *
                    </label>
                    <input type="text" name="title" id="title"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                           placeholder="أدخل عنوان المشروع" value="{{ old('title') }}" required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Project Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('projects.labels.description') }} *
                    </label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                              placeholder="اكتب وصفاً مفصلاً للمشروع" required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Property Type and Style -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="property_type" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('projects.labels.property_type') }} *
                        </label>
                        <select name="property_type" id="property_type"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base">
                            <option value="">اختر نوع العقار</option>
                            <option value="residential" {{ old('property_type') === 'residential' ? 'selected' : '' }}>
                                {{ __('projects.property_types.residential') }}
                            </option>
                            <option value="commercial" {{ old('property_type') === 'commercial' ? 'selected' : '' }}>
                                {{ __('projects.property_types.commercial') }}
                            </option>
                            <option value="villa" {{ old('property_type') === 'villa' ? 'selected' : '' }}>
                                {{ __('projects.property_types.villa') }}
                            </option>
                        </select>
                        @error('property_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="style" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('projects.labels.style') }} *
                        </label>
                        <select name="style" id="style"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base">
                            <option value="">اختر النمط</option>
                            <option value="modern" {{ old('style') === 'modern' ? 'selected' : '' }}>
                                {{ __('projects.styles.modern') }}
                            </option>
                            <option value="classic" {{ old('style') === 'classic' ? 'selected' : '' }}>
                                {{ __('projects.styles.classic') }}
                            </option>
                            <option value="traditional" {{ old('style') === 'traditional' ? 'selected' : '' }}>
                                {{ __('projects.styles.traditional') }}
                            </option>
                        </select>
                        @error('style')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Area and Location -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="area" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('projects.labels.area') }} *
                        </label>
                        <input type="number" name="area" id="area" step="0.01" min="1"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                               placeholder="المساحة بالمتر المربع" value="{{ old('area') }}" required>
                        @error('area')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('projects.labels.location') }} *
                        </label>
                        <input type="text" name="location" id="location"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                               placeholder="المدينة أو الإمارة" value="{{ old('location') }}" required>
                        @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Neighborhood -->
                <div class="mb-6">
                    <label for="neighborhood" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('projects.labels.neighborhood') }}
                    </label>
                    <input type="text" name="neighborhood" id="neighborhood"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                           placeholder="الحي أو المنطقة (اختياري)" value="{{ old('neighborhood') }}">
                    @error('neighborhood')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Building Details Section -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">تفاصيل البناء</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="floors" class="block text-sm font-medium text-gray-700 mb-2">
                                عدد الطوابق
                            </label>
                            <input type="number" name="floors" id="floors" min="1" max="10"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                                   placeholder="عدد الطوابق" value="{{ old('floors', 1) }}">
                            @error('floors')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="majlis_count" class="block text-sm font-medium text-gray-700 mb-2">
                                عدد المجالس
                            </label>
                            <input type="number" name="majlis_count" id="majlis_count" min="1" max="10"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                                   placeholder="عدد المجالس" value="{{ old('majlis_count', 1) }}">
                            @error('majlis_count')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="bedrooms" class="block text-sm font-medium text-gray-700 mb-2">
                                غرف النوم
                            </label>
                            <input type="number" name="bedrooms" id="bedrooms" min="1" max="20"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                                   placeholder="عدد غرف النوم" value="{{ old('bedrooms', 1) }}">
                            @error('bedrooms')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="guest_bedrooms" class="block text-sm font-medium text-gray-700 mb-2">
                                غرف نوم الضيوف
                            </label>
                            <input type="number" name="guest_bedrooms" id="guest_bedrooms" min="0" max="10"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                                   placeholder="عدد غرف الضيوف" value="{{ old('guest_bedrooms', 0) }}">
                            @error('guest_bedrooms')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="bathrooms" class="block text-sm font-medium text-gray-700 mb-2">
                                الحمامات
                            </label>
                            <input type="number" name="bathrooms" id="bathrooms" min="1" max="15"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                                   placeholder="عدد الحمامات" value="{{ old('bathrooms', 1) }}">
                            @error('bathrooms')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="parking_spaces" class="block text-sm font-medium text-gray-700 mb-2">
                                مواقف السيارات
                            </label>
                            <input type="number" name="parking_spaces" id="parking_spaces" min="1" max="10"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                                   placeholder="عدد المواقف" value="{{ old('parking_spaces', 1) }}">
                            @error('parking_spaces')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="other_rooms" class="block text-sm font-medium text-gray-700 mb-2">
                                غرف أخرى
                            </label>
                            <input type="number" name="other_rooms" id="other_rooms" min="0" max="10"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                                   placeholder="غرف أخرى" value="{{ old('other_rooms', 0) }}">
                            @error('other_rooms')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="finishing_level" class="block text-sm font-medium text-gray-700 mb-2">
                                مستوى التشطيب
                            </label>
                            <select name="finishing_level" id="finishing_level"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base">
                                <option value="low" {{ old('finishing_level') === 'low' ? 'selected' : '' }}>منخفض</option>
                                <option value="medium" {{ old('finishing_level', 'medium') === 'medium' ? 'selected' : '' }}>متوسط</option>
                                <option value="high" {{ old('finishing_level') === 'high' ? 'selected' : '' }}>عالي</option>
                            </select>
                            @error('finishing_level')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Additional Features Section -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">الإضافات</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">إضافات أخرى</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="additional_features[]" value="garden"
                                           class="rounded border-gray-300 text-teal-600 focus:ring-teal-500"
                                           {{ in_array('garden', old('additional_features', [])) ? 'checked' : '' }}>
                                    <span class="mr-2 text-sm text-gray-700">حديقة</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="additional_features[]" value="pool"
                                           class="rounded border-gray-300 text-teal-600 focus:ring-teal-500"
                                           {{ in_array('pool', old('additional_features', [])) ? 'checked' : '' }}>
                                    <span class="mr-2 text-sm text-gray-700">مسبح</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="additional_features[]" value="elevator"
                                           class="rounded border-gray-300 text-teal-600 focus:ring-teal-500"
                                           {{ in_array('elevator', old('additional_features', [])) ? 'checked' : '' }}>
                                    <span class="mr-2 text-sm text-gray-700">مصعد</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="additional_features[]" value="basement"
                                           class="rounded border-gray-300 text-teal-600 focus:ring-teal-500"
                                           {{ in_array('basement', old('additional_features', [])) ? 'checked' : '' }}>
                                    <span class="mr-2 text-sm text-gray-700">قبو</span>
                                </label>
                            </div>
                            @error('additional_features')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="additional_notes" class="block text-sm font-medium text-gray-700 mb-2">
                                ملاحظات إضافية
                            </label>
                            <textarea name="additional_notes" id="additional_notes" rows="4"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                                      placeholder="أضف أي ملاحظات أو متطلبات خاصة للمشروع...">{{ old('additional_notes') }}</textarea>
                            @error('additional_notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Cost Estimation -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('projects.sections.cost_estimation') }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="estimated_cost" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('projects.labels.estimated_cost') }} *
                            </label>
                            <input type="number" name="estimated_cost" id="estimated_cost" step="0.01" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                                   placeholder="التكلفة المقدرة" value="{{ old('estimated_cost') }}" required>
                            @error('estimated_cost')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="budget_min" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('projects.labels.budget_min') }}
                            </label>
                            <input type="number" name="budget_min" id="budget_min" step="0.01" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                                   placeholder="الحد الأدنى" value="{{ old('budget_min') }}">
                            @error('budget_min')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="budget_max" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('projects.labels.budget_max') }}
                            </label>
                            <input type="number" name="budget_max" id="budget_max" step="0.01" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                                   placeholder="الحد الأقصى" value="{{ old('budget_max') }}">
                            @error('budget_max')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit" class="flex-1 bg-teal-600 text-white py-3 px-6 rounded-lg font-medium hover:bg-teal-700 transition duration-200 text-sm md:text-base">
                        <i class="fas fa-save ml-2"></i>
                        إنشاء المشروع
                    </button>
                    <a href="{{ route('projects.index') }}" class="flex-1 bg-gray-300 text-gray-700 py-3 px-6 rounded-lg font-medium hover:bg-gray-400 transition duration-200 text-center text-sm md:text-base">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
@media (max-width: 768px) {
    .grid {
        grid-template-columns: 1fr;
    }

    .text-xl {
        font-size: 1.125rem;
    }

    .text-lg {
        font-size: 1rem;
    }

    .px-4 {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }

    .py-4 {
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }

    .p-6 {
        padding: 1rem;
    }
}

@media (max-width: 480px) {
    .px-4 {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }

    .py-4 {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }

    .p-6 {
        padding: 0.75rem;
    }

    .text-sm {
        font-size: 0.75rem;
    }

    .py-3 {
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }

    .px-6 {
        padding-left: 1rem;
        padding-right: 1rem;
    }
}

/* Fix input sizing for mobile */
input, select, textarea {
    font-size: 16px !important;
    max-width: 100% !important;
    box-sizing: border-box !important;
}

/* Ensure form elements don't overflow */
.form-container {
    width: 100% !important;
    max-width: 100% !important;
    overflow-x: hidden !important;
}
</style>
@endsection
