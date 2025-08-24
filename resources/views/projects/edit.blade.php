@extends('layouts.app')

@section('title', 'تعديل المشروع - insha\'at')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center py-4">
                <a href="{{ route('projects.show', $project) }}" class="text-gray-500 hover:text-gray-700 mr-4">
                    <i class="fas fa-arrow-right text-lg"></i>
                </a>
                <div>
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900">تعديل المشروع</h1>
                    <p class="text-sm md:text-base text-gray-600">تعديل تفاصيل مشروعك</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <form action="{{ route('projects.update', $project) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <!-- Project Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        عنوان المشروع *
                    </label>
                    <input type="text" name="title" id="title"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                           placeholder="أدخل عنوان المشروع" value="{{ old('title', $project->title) }}" required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Project Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        وصف المشروع *
                    </label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                              placeholder="اكتب وصفاً مفصلاً للمشروع" required>{{ old('description', $project->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Property Type and Style -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="property_type" class="block text-sm font-medium text-gray-700 mb-2">
                            نوع العقار *
                        </label>
                        <select name="property_type" id="property_type"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base">
                            <option value="">اختر نوع العقار</option>
                            <option value="residential" {{ old('property_type', $project->property_type) === 'residential' ? 'selected' : '' }}>
                                سكني
                            </option>
                            <option value="commercial" {{ old('property_type', $project->property_type) === 'commercial' ? 'selected' : '' }}>
                                تجاري
                            </option>
                            <option value="villa" {{ old('property_type', $project->property_type) === 'villa' ? 'selected' : '' }}>
                                فيلا
                            </option>
                            <option value="apartment" {{ old('property_type', $project->property_type) === 'apartment' ? 'selected' : '' }}>
                                شقة
                            </option>
                        </select>
                        @error('property_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="style" class="block text-sm font-medium text-gray-700 mb-2">
                            النمط *
                        </label>
                        <select name="style" id="style"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base">
                            <option value="">اختر النمط</option>
                            <option value="modern" {{ old('style', $project->style) === 'modern' ? 'selected' : '' }}>
                                عصري
                            </option>
                            <option value="classic" {{ old('style', $project->style) === 'classic' ? 'selected' : '' }}>
                                كلاسيكي
                            </option>
                            <option value="traditional" {{ old('style', $project->style) === 'traditional' ? 'selected' : '' }}>
                                تقليدي
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
                            المساحة (متر مربع) *
                        </label>
                        <input type="number" name="area" id="area" min="1" step="0.01"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                               placeholder="أدخل المساحة" value="{{ old('area', $project->area) }}" required>
                        @error('area')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                            الموقع *
                        </label>
                        <input type="text" name="location" id="location"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                               placeholder="أدخل الموقع" value="{{ old('location', $project->location) }}" required>
                        @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Neighborhood -->
                <div class="mb-6">
                    <label for="neighborhood" class="block text-sm font-medium text-gray-700 mb-2">
                        الحي
                    </label>
                    <input type="text" name="neighborhood" id="neighborhood"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                           placeholder="أدخل اسم الحي" value="{{ old('neighborhood', $project->neighborhood) }}">
                    @error('neighborhood')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Estimated Cost -->
                <div class="mb-6">
                    <label for="estimated_cost" class="block text-sm font-medium text-gray-700 mb-2">
                        التكلفة التقديرية (ريال) *
                    </label>
                    <input type="number" name="estimated_cost" id="estimated_cost" min="0" step="0.01"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                           placeholder="أدخل التكلفة التقديرية" value="{{ old('estimated_cost', $project->estimated_cost) }}" required>
                    @error('estimated_cost')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Budget Range -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="budget_min" class="block text-sm font-medium text-gray-700 mb-2">
                            الحد الأدنى للميزانية (ريال)
                        </label>
                        <input type="number" name="budget_min" id="budget_min" min="0" step="0.01"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                               placeholder="الحد الأدنى" value="{{ old('budget_min', $project->budget_min) }}">
                        @error('budget_min')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="budget_max" class="block text-sm font-medium text-gray-700 mb-2">
                            الحد الأقصى للميزانية (ريال)
                        </label>
                        <input type="number" name="budget_max" id="budget_max" min="0" step="0.01"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                               placeholder="الحد الأقصى" value="{{ old('budget_max', $project->budget_max) }}">
                        @error('budget_max')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Finishing Level -->
                <div class="mb-6">
                    <label for="finishing_level" class="block text-sm font-medium text-gray-700 mb-2">
                        مستوى التشطيب
                    </label>
                    <select name="finishing_level" id="finishing_level"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base">
                        <option value="">اختر مستوى التشطيب</option>
                        <option value="economic" {{ old('finishing_level', $project->finishing_level) === 'economic' ? 'selected' : '' }}>
                            اقتصادي
                        </option>
                        <option value="standard" {{ old('finishing_level', $project->finishing_level) === 'standard' ? 'selected' : '' }}>
                            عادي
                        </option>
                        <option value="luxury" {{ old('finishing_level', $project->finishing_level) === 'luxury' ? 'selected' : '' }}>
                            فاخر
                        </option>
                        <option value="super_luxury" {{ old('finishing_level', $project->finishing_level) === 'super_luxury' ? 'selected' : '' }}>
                            فاخر جداً
                        </option>
                    </select>
                    @error('finishing_level')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Additional Features -->
                <div class="mb-6">
                    <label for="additional_features" class="block text-sm font-medium text-gray-700 mb-2">
                        المميزات الإضافية
                    </label>
                    <textarea name="additional_features" id="additional_features" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                              placeholder="اكتب المميزات الإضافية المطلوبة">{{ old('additional_features', $project->additional_features) }}</textarea>
                    @error('additional_features')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notes -->
                <div class="mb-6">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                        ملاحظات
                    </label>
                    <textarea name="notes" id="notes" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-sm md:text-base"
                              placeholder="أي ملاحظات إضافية">{{ old('notes', $project->notes) }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('projects.show', $project) }}" 
                       class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        إلغاء
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">
                        حفظ التغييرات
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
