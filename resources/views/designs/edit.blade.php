@extends('layouts.app')

@section('title', 'تعديل التصميم - انشاءات')

@section('content')
    @php
        $designFeatures =
            is_array($design->features) ? $design->features : (json_decode($design->features ?? '[]', true) ?: []);
    @endphp
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="border-b pb-4 mb-6">
                <h1 class="text-3xl font-bold text-gray-900">تعديل التصميم: {{ $design->title }}</h1>
                <p class="text-gray-600 mt-2">أدخل تفاصيل المشروع والتسعير التفصيلي</p>
            </div>
        </div>

        <!-- Main Form -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <form action="{{ route('designs.update', $design->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @auth
                    <!-- Auto-fill notification -->
                    <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle text-blue-600 ml-2"></i>
                            <p class="text-blue-800 text-sm">
                                تم ملء بيانات الاستشاري تلقائياً من حسابك. يمكنك تعديلها حسب الحاجة.
                            </p>
                        </div>
                    </div>
                @endauth

                @if ($errors->any())
                    <!-- Error messages -->
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-red-600 ml-2 mt-1"></i>
                            <div>
                                <h3 class="text-red-800 font-medium mb-2">يرجى تصحيح الأخطاء التالية:</h3>
                                <ul class="text-red-700 text-sm space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>• {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Basic Information Table -->
                <div class="border-b">
                    <div class="bg-gray-50 px-6 py-4 border-b">
                        <h2 class="text-xl font-semibold text-gray-800">المعلومات الأساسية</h2>
                    </div>
                    <div class="p-6">
                        <table class="w-full">
                            <tbody class="space-y-4">
                                <tr>
                                    <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">عنوان التصميم *</td>
                                    <td class="py-3">
                                        <input type="text" name="title" required
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="مثال: فيلا عصرية فاخرة" value="{{ old('title', $design->title) }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3 pr-4 text-sm font-medium text-gray-700">نمط التصميم *</td>
                                    <td class="py-3">
                                        <select name="style" required
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">اختر النمط</option>
                                            <option value="modern"
                                                {{ old('style', $design->style) == 'modern' ? 'selected' : '' }}>عصري
                                            </option>
                                            <option value="islamic"
                                                {{ old('style', $design->style) == 'islamic' ? 'selected' : '' }}>إسلامي
                                            </option>
                                            <option value="traditional"
                                                {{ old('style', $design->style) == 'traditional' ? 'selected' : '' }}>تقليدي
                                            </option>
                                            <option value="classic"
                                                {{ old('style', $design->style) == 'classic' ? 'selected' : '' }}>كلاسيكي
                                            </option>
                                            <option value="minimalist"
                                                {{ old('style', $design->style) == 'minimalist' ? 'selected' : '' }}>مينيمال
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3 pr-4 text-sm font-medium text-gray-700">سعر التصميم (درهم) *</td>
                                    <td class="py-3">
                                        <input type="number" name="price" required
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="مثال: 500000" value="{{ old('price', $design->price) }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3 pr-4 text-sm font-medium text-gray-700">المساحة (متر مربع) *</td>
                                    <td class="py-3">
                                        <input type="number" name="area" required
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="مثال: 400" value="{{ old('area', $design->area) }}">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Specifications Table -->
                <div class="border-b">
                    <div class="bg-gray-50 px-6 py-4 border-b">
                        <h2 class="text-xl font-semibold text-gray-800">المواصفات</h2>
                    </div>
                    <div class="p-6">
                        <table class="w-full">
                            <tbody>
                                <tr>
                                    <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">عدد غرف النوم</td>
                                    <td class="py-3">
                                        <input type="number" name="bedrooms"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="مثال: 5" value="{{ old('bedrooms', $design->bedrooms) }}">
                                    </td>
                                    <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">عدد الحمامات</td>
                                    <td class="py-3">
                                        <input type="number" name="bathrooms"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="مثال: 4" value="{{ old('bathrooms', $design->bathrooms) }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3 pr-4 text-sm font-medium text-gray-700">عدد الطوابق</td>
                                    <td class="py-3">
                                        <input type="number" name="floors"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="مثال: 3" value="{{ old('floors', $design->floors) }}">
                                    </td>
                                    <td class="py-3 pr-4 text-sm font-medium text-gray-700">الموقع</td>
                                    <td class="py-3">
                                        <input type="text" name="location"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="مثال: الرياض، المملكة العربية السعودية"
                                            value="{{ old('location', $design->location) }}">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Description -->
                <div class="border-b">
                    <div class="bg-gray-50 px-6 py-4 border-b">
                        <h2 class="text-xl font-semibold text-gray-800">وصف التصميم</h2>
                    </div>
                    <div class="p-6">
                        <table class="w-full">
                            <tbody>
                                <tr>
                                    <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">الوصف التفصيلي *</td>
                                    <td class="py-3">
                                        <textarea name="description" rows="4" required
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="اكتب وصفاً مفصلاً للتصميم...">{{ old('description', $design->description) }}</textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Features -->
                <div class="border-b">
                    <div class="bg-gray-50 px-6 py-4 border-b">
                        <h2 class="text-xl font-semibold text-gray-800">المميزات</h2>
                    </div>
                    <div class="p-6">
                        <table class="w-full">
                            <tbody>
                                <tr>
                                    <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">المميزات المتاحة</td>
                                    <td class="py-3">
                                        <div class="grid grid-cols-2 gap-4">
                                            <label class="flex items-center">
                                                <input type="checkbox" name="features[]" value="حديقة خارجية"
                                                    class="ml-3"
                                                    {{ in_array('حديقة خارجية', old('features', $designFeatures)) ? 'checked' : '' }}>
                                                <span class="text-sm text-gray-700">حديقة خارجية</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="checkbox" name="features[]" value="موقف سيارات"
                                                    class="ml-3"
                                                    {{ in_array('موقف سيارات', old('features', $designFeatures)) ? 'checked' : '' }}>
                                                <span class="text-sm text-gray-700">موقف سيارات</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="checkbox" name="features[]" value="مطبخ مجهز"
                                                    class="ml-3"
                                                    {{ in_array('مطبخ مجهز', old('features', $designFeatures)) ? 'checked' : '' }}>
                                                <span class="text-sm text-gray-700">مطبخ مجهز</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="checkbox" name="features[]" value="غرفة معيشة واسعة"
                                                    class="ml-3"
                                                    {{ in_array('غرفة معيشة واسعة', old('features', $designFeatures)) ? 'checked' : '' }}>
                                                <span class="text-sm text-gray-700">غرفة معيشة واسعة</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="checkbox" name="features[]" value="مسبح خاص" class="ml-3"
                                                    {{ in_array('مسبح خاص', old('features', $designFeatures)) ? 'checked' : '' }}>
                                                <span class="text-sm text-gray-700">مسبح خاص</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="checkbox" name="features[]" value="مصعد داخلي"
                                                    class="ml-3"
                                                    {{ in_array('مصعد داخلي', old('features', $designFeatures)) ? 'checked' : '' }}>
                                                <span class="text-sm text-gray-700">مصعد داخلي</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="checkbox" name="features[]" value="شرفات" class="ml-3"
                                                    {{ in_array('شرفات', old('features', $designFeatures)) ? 'checked' : '' }}>
                                                <span class="text-sm text-gray-700">شرفات</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="checkbox" name="features[]" value="مخازن" class="ml-3"
                                                    {{ in_array('مخازن', old('features', $designFeatures)) ? 'checked' : '' }}>
                                                <span class="text-sm text-gray-700">مخازن</span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="border-b">
                    <div class="bg-gray-50 px-6 py-4 border-b">
                        <h2 class="text-xl font-semibold text-gray-800">معلومات التواصل</h2>
                    </div>
                    <div class="p-6">
                        <table class="w-full">
                            <tbody>
                                <tr>
                                    <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">اسم المصمم *</td>
                                    <td class="py-3">
                                        <input type="text" name="consultant_name" required
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="مثال: أحمد محمد"
                                            value="{{ old('consultant_name', $design->consultant_name) }}">
                                    </td>
                                    <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">رقم الهاتف</td>
                                    <td class="py-3">
                                        <input type="tel" name="consultant_phone"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="مثال: +966501234567"
                                            value="{{ old('consultant_phone', $design->consultant_phone) }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3 pr-4 text-sm font-medium text-gray-700">البريد الإلكتروني</td>
                                    <td class="py-3">
                                        <input type="email" name="consultant_email"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="مثال: info@example.com"
                                            value="{{ old('consultant_email', $design->consultant_email) }}">
                                    </td>
                                    <td class="py-3 pr-4 text-sm font-medium text-gray-700">الموقع</td>
                                    <td class="py-3">
                                        <input type="text" name="location"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="مثال: الرياض، المملكة العربية السعودية">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Images -->
                <div class="border-b">
                    <div class="bg-gray-50 px-6 py-4 border-b">
                        <h2 class="text-xl font-semibold text-gray-800">صور التصميم</h2>
                    </div>
                    <div class="p-6">
                        <table class="w-full">
                            <tbody>
                                <tr>
                                    <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">الصورة الرئيسية</td>
                                    <td class="py-3">
                                        @if ($design->main_image)
                                            <div class="mb-4">
                                                <p class="text-sm text-gray-600 mb-2">الصورة الحالية:</p>
                                                <img src="{{ asset('storage/' . $design->main_image) }}"
                                                    alt="الصورة الحالية" class="w-32 h-32 object-cover rounded-lg">
                                            </div>
                                        @endif
                                        <input type="file" name="main_image" accept="image/*"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <p class="text-sm text-gray-500 mt-1">اتركه فارغاً للاحتفاظ بالصورة الحالية</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3 pr-4 text-sm font-medium text-gray-700">صور إضافية</td>
                                    <td class="py-3">
                                        @if ($design->images && count($design->images) > 0)
                                            <div class="mb-4">
                                                <p class="text-sm text-gray-600 mb-2">الصور الحالية:</p>
                                                <div class="grid grid-cols-3 gap-2">
                                                    @foreach ($design->images as $image)
                                                        <img src="{{ asset('storage/' . $image) }}" alt="صورة إضافية"
                                                            class="w-20 h-20 object-cover rounded-lg">
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        <input type="file" name="images[]" accept="image/*" multiple
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <p class="text-sm text-gray-500 mt-1">اتركه فارغاً للاحتفاظ بالصور الحالية، أو اختر
                                            صوراً جديدة لاستبدالها</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pricing Section -->
                <div class="border-b">
                    <div class="bg-gray-50 px-6 py-4 border-b">
                        <h2 class="text-xl font-semibold text-gray-800">التسعير التفصيلي للمشروع</h2>
                        <p class="text-sm text-gray-600 mt-1">حدد تفاصيل التكلفة لكل فئة من فئات البناء</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6">
                            <div class="border rounded-lg bg-gray-50">
                                <div class="bg-blue-600 text-white px-4 py-3 rounded-t-lg">
                                    <h3 class="text-lg font-semibold">الاعمال التحضيرية</h3>
                                </div>
                                <div class="p-4">
                                    <div class="overflow-x-auto">
                                        <table class="w-full border-collapse border border-gray-300">
                                            <thead class="bg-white">
                                                <tr>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">
                                                        اسم البند</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الكمية</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الوحدة</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        سعر الوحدة (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        المجموع (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody id="category-1-items">
                                                <tr class="pricing-row">
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="text" name="pricing[1][0][item_name]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm"
                                                            placeholder="مثال: حفر وتأسيس القواعد">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[1][0][quantity]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <select name="pricing[1][0][unit]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm">
                                                            <option value="م³">م³</option>
                                                            <option value="م²">م²</option>
                                                            <option value="م">م</option>
                                                            <option value="قطعة">قطعة</option>
                                                        </select>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[1][0][unit_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[1][0][total_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                                            readonly>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                                        <button type="button"
                                                            class="text-red-600 hover:text-red-800 remove-item-btn">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <input type="hidden" name="pricing[1][0][category_id]" value="1">
                                    <button type="button"
                                        class="mt-2 text-blue-600 hover:text-blue-800 text-sm add-item-btn"
                                        data-category="1">
                                        <i class="fas fa-plus ml-1"></i> إضافة بند
                                    </button>
                                </div>
                            </div>

                            <div class="border rounded-lg bg-gray-50">
                                <div class="bg-blue-600 text-white px-4 py-3 rounded-t-lg">
                                    <h3 class="text-lg font-semibold">أعمال الحفر والخرسانة أسفل منسوب الدور الأرضي</h3>
                                </div>
                                <div class="p-4">
                                    <div class="overflow-x-auto">
                                        <table class="w-full border-collapse border border-gray-300">
                                            <thead class="bg-white">
                                                <tr>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">
                                                        اسم البند</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الكمية</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الوحدة</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        سعر الوحدة (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        المجموع (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody id="category-2-items">
                                                <tr class="pricing-row">
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="text" name="pricing[2][0][item_name]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm"
                                                            placeholder="مثال: بناء الجدران الخارجية">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[2][0][quantity]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <select name="pricing[2][0][unit]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm">
                                                            <option value="م²">م²</option>
                                                            <option value="م³">م³</option>
                                                            <option value="م">م</option>
                                                            <option value="قطعة">قطعة</option>
                                                        </select>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[2][0][unit_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[2][0][total_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                                            readonly>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                                        <button type="button"
                                                            class="text-red-600 hover:text-red-800 remove-item-btn">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <input type="hidden" name="pricing[2][0][category_id]" value="2">
                                    <button type="button"
                                        class="mt-2 text-blue-600 hover:text-blue-800 text-sm add-item-btn"
                                        data-category="2">
                                        <i class="fas fa-plus ml-1"></i> إضافة بند
                                    </button>
                                </div>
                            </div>

                            <!-- أعمال الخرسانة للدور الأرضي وما فوق -->
                            <div class="border rounded-lg bg-gray-50">
                                <div class="bg-blue-600 text-white px-4 py-3 rounded-t-lg">
                                    <h3 class="text-lg font-semibold">أعمال الخرسانة للدور الأرضي وما فوق</h3>
                                </div>
                                <div class="p-4">
                                    <div class="overflow-x-auto">
                                        <table class="w-full border-collapse border border-gray-300">
                                            <thead class="bg-white">
                                                <tr>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">
                                                        اسم البند</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الكمية</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الوحدة</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        سعر الوحدة (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        المجموع (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody id="category-3-items">
                                                <tr class="pricing-row">
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="text" name="pricing[3][0][item_name]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm"
                                                            placeholder="مثال: تبييض الجدران الداخلية">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[3][0][quantity]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <select name="pricing[3][0][unit]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm">
                                                            <option value="م²">م²</option>
                                                            <option value="م³">م³</option>
                                                            <option value="م">م</option>
                                                            <option value="قطعة">قطعة</option>
                                                        </select>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[3][0][unit_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[3][0][total_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                                            readonly>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                                        <button type="button"
                                                            class="text-red-600 hover:text-red-800 remove-item-btn">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <input type="hidden" name="pricing[3][0][category_id]" value="3">
                                    <button type="button"
                                        class="mt-2 text-blue-600 hover:text-blue-800 text-sm add-item-btn"
                                        data-category="3">
                                        <i class="fas fa-plus ml-1"></i> إضافة بند
                                    </button>
                                </div>
                            </div>

                            <!-- أعمال الطابوق -->
                            <div class="border rounded-lg bg-gray-50">
                                <div class="bg-blue-600 text-white px-4 py-3 rounded-t-lg">
                                    <h3 class="text-lg font-semibold">أعمال الطابوق</h3>
                                </div>
                                <div class="p-4">
                                    <div class="overflow-x-auto">
                                        <table class="w-full border-collapse border border-gray-300">
                                            <thead class="bg-white">
                                                <tr>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">
                                                        اسم البند</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الكمية</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الوحدة</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        سعر الوحدة (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        المجموع (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody id="category-4-items">
                                                <tr class="pricing-row">
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="text" name="pricing[4][0][item_name]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm"
                                                            placeholder="مثال: تركيب شبكة المياه الرئيسية">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[4][0][quantity]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <select name="pricing[4][0][unit]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm">
                                                            <option value="م">م</option>
                                                            <option value="م²">م²</option>
                                                            <option value="م³">م³</option>
                                                            <option value="قطعة">قطعة</option>
                                                        </select>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[4][0][unit_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[4][0][total_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                                            readonly>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                                        <button type="button"
                                                            class="text-red-600 hover:text-red-800 remove-item-btn">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <input type="hidden" name="pricing[4][0][category_id]" value="4">
                                    <button type="button"
                                        class="mt-2 text-blue-600 hover:text-blue-800 text-sm add-item-btn"
                                        data-category="4">
                                        <i class="fas fa-plus ml-1"></i> إضافة بند
                                    </button>
                                </div>
                            </div>

                            <!-- أعمال العزل -->
                            <div class="border rounded-lg bg-gray-50">
                                <div class="bg-blue-600 text-white px-4 py-3 rounded-t-lg">
                                    <h3 class="text-lg font-semibold">أعمال العزل</h3>
                                </div>
                                <div class="p-4">
                                    <div class="overflow-x-auto">
                                        <table class="w-full border-collapse border border-gray-300">
                                            <thead class="bg-white">
                                                <tr>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">
                                                        اسم البند</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الكمية</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الوحدة</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        سعر الوحدة (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        المجموع (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody id="category-5-items">
                                                <tr class="pricing-row">
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="text" name="pricing[5][0][item_name]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm"
                                                            placeholder="مثال: تركيب شبكة الكهرباء الرئيسية">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[5][0][quantity]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <select name="pricing[5][0][unit]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm">
                                                            <option value="م">م</option>
                                                            <option value="م²">م²</option>
                                                            <option value="م³">م³</option>
                                                            <option value="قطعة">قطعة</option>
                                                        </select>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[5][0][unit_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[5][0][total_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                                            readonly>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                                        <button type="button"
                                                            class="text-red-600 hover:text-red-800 remove-item-btn">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <input type="hidden" name="pricing[5][0][category_id]" value="5">
                                    <button type="button"
                                        class="mt-2 text-blue-600 hover:text-blue-800 text-sm add-item-btn"
                                        data-category="5">
                                        <i class="fas fa-plus ml-1"></i> إضافة بند
                                    </button>
                                </div>
                            </div>

                            <!-- أعمال التشطيب -->
                            <div class="border rounded-lg bg-gray-50">
                                <div class="bg-blue-600 text-white px-4 py-3 rounded-t-lg">
                                    <h3 class="text-lg font-semibold">أعمال التشطيب</h3>
                                </div>
                                <div class="p-4">
                                    <div class="overflow-x-auto">
                                        <table class="w-full border-collapse border border-gray-300">
                                            <thead class="bg-white">
                                                <tr>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">
                                                        اسم البند</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الكمية</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الوحدة</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        سعر الوحدة (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        المجموع (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody id="category-6-items">
                                                <tr class="pricing-row">
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="text" name="pricing[6][0][item_name]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm"
                                                            placeholder="مثال: صنع الأبواب الخشبية">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[6][0][quantity]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <select name="pricing[6][0][unit]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm">
                                                            <option value="قطعة">قطعة</option>
                                                            <option value="م²">م²</option>
                                                            <option value="م">م</option>
                                                            <option value="م³">م³</option>
                                                        </select>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[6][0][unit_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[6][0][total_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                                            readonly>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                                        <button type="button"
                                                            class="text-red-600 hover:text-red-800 remove-item-btn">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <input type="hidden" name="pricing[6][0][category_id]" value="6">
                                    <button type="button"
                                        class="mt-2 text-blue-600 hover:text-blue-800 text-sm add-item-btn"
                                        data-category="6">
                                        <i class="fas fa-plus ml-1"></i> إضافة بند
                                    </button>
                                </div>
                            </div>

                            <!-- أعمال النجارة -->
                            <div class="border rounded-lg bg-gray-50">
                                <div class="bg-blue-600 text-white px-4 py-3 rounded-t-lg">
                                    <h3 class="text-lg font-semibold">أعمال النجارة</h3>
                                </div>
                                <div class="p-4">
                                    <div class="overflow-x-auto">
                                        <table class="w-full border-collapse border border-gray-300">
                                            <thead class="bg-white">
                                                <tr>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">
                                                        اسم البند</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الكمية</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الوحدة</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        سعر الوحدة (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        المجموع (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody id="category-7-items">
                                                <tr class="pricing-row">
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="text" name="pricing[7][0][item_name]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm"
                                                            placeholder="مثال: دهان الجدران الداخلية">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[7][0][quantity]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <select name="pricing[7][0][unit]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm">
                                                            <option value="م²">م²</option>
                                                            <option value="لتر">لتر</option>
                                                            <option value="كيلو">كيلو</option>
                                                            <option value="قطعة">قطعة</option>
                                                        </select>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[7][0][unit_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[7][0][total_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                                            readonly>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                                        <button type="button"
                                                            class="text-red-600 hover:text-red-800 remove-item-btn">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <input type="hidden" name="pricing[7][0][category_id]" value="7">
                                    <button type="button"
                                        class="mt-2 text-blue-600 hover:text-blue-800 text-sm add-item-btn"
                                        data-category="7">
                                        <i class="fas fa-plus ml-1"></i> إضافة بند
                                    </button>
                                </div>
                            </div>

                            <!-- أعمال الألومنيوم والزجاج -->
                            <div class="border rounded-lg bg-gray-50">
                                <div class="bg-blue-600 text-white px-4 py-3 rounded-t-lg">
                                    <h3 class="text-lg font-semibold">أعمال الألومنيوم والزجاج</h3>
                                </div>
                                <div class="p-4">
                                    <div class="overflow-x-auto">
                                        <table class="w-full border-collapse border border-gray-300">
                                            <thead class="bg-white">
                                                <tr>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">
                                                        اسم البند</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الكمية</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الوحدة</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        سعر الوحدة (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        المجموع (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody id="category-8-items">
                                                <tr class="pricing-row">
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="text" name="pricing[8][0][item_name]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm"
                                                            placeholder="مثال: تركيب بلاط الحمامات">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[8][0][quantity]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <select name="pricing[8][0][unit]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm">
                                                            <option value="م²">م²</option>
                                                            <option value="قطعة">قطعة</option>
                                                            <option value="م">م</option>
                                                            <option value="كيلو">كيلو</option>
                                                        </select>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[8][0][unit_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[8][0][total_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                                            readonly>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                                        <button type="button"
                                                            class="text-red-600 hover:text-red-800 remove-item-btn">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <input type="hidden" name="pricing[8][0][category_id]" value="8">
                                    <button type="button"
                                        class="mt-2 text-blue-600 hover:text-blue-800 text-sm add-item-btn"
                                        data-category="8">
                                        <i class="fas fa-plus ml-1"></i> إضافة بند
                                    </button>
                                </div>
                            </div>

                            <!-- أعمال الكهرباء -->
                            <div class="border rounded-lg bg-gray-50">
                                <div class="bg-blue-600 text-white px-4 py-3 rounded-t-lg">
                                    <h3 class="text-lg font-semibold">أعمال الكهرباء</h3>
                                </div>
                                <div class="p-4">
                                    <div class="overflow-x-auto">
                                        <table class="w-full border-collapse border border-gray-300">
                                            <thead class="bg-white">
                                                <tr>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">
                                                        اسم البند</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الكمية</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الوحدة</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        سعر الوحدة (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        المجموع (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody id="category-9-items">
                                                <tr class="pricing-row">
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="text" name="pricing[9][0][item_name]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm"
                                                            placeholder="مثال: صنع أبواب حديدية">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[9][0][quantity]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <select name="pricing[9][0][unit]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm">
                                                            <option value="قطعة">قطعة</option>
                                                            <option value="م²">م²</option>
                                                            <option value="كيلو">كيلو</option>
                                                            <option value="طن">طن</option>
                                                        </select>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[9][0][unit_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[9][0][total_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                                            readonly>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                                        <button type="button"
                                                            class="text-red-600 hover:text-red-800 remove-item-btn">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <input type="hidden" name="pricing[9][0][category_id]" value="9">
                                    <button type="button"
                                        class="mt-2 text-blue-600 hover:text-blue-800 text-sm add-item-btn"
                                        data-category="9">
                                        <i class="fas fa-plus ml-1"></i> إضافة بند
                                    </button>
                                </div>
                            </div>

                            <!-- أعمال التكييف -->
                            <div class="border rounded-lg bg-gray-50">
                                <div class="bg-blue-600 text-white px-4 py-3 rounded-t-lg">
                                    <h3 class="text-lg font-semibold">أعمال التكييف</h3>
                                </div>
                                <div class="p-4">
                                    <div class="overflow-x-auto">
                                        <table class="w-full border-collapse border border-gray-300">
                                            <thead class="bg-white">
                                                <tr>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">
                                                        اسم البند</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الكمية</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الوحدة</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        سعر الوحدة (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        المجموع (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody id="category-10-items">
                                                <tr class="pricing-row">
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="text" name="pricing[10][0][item_name]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm"
                                                            placeholder="مثال: عزل أسقف المباني">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[10][0][quantity]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <select name="pricing[10][0][unit]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm">
                                                            <option value="م²">م²</option>
                                                            <option value="م³">م³</option>
                                                            <option value="كيلو">كيلو</option>
                                                            <option value="لتر">لتر</option>
                                                        </select>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[10][0][unit_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[10][0][total_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                                            readonly>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                                        <button type="button"
                                                            class="text-red-600 hover:text-red-800 remove-item-btn">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <input type="hidden" name="pricing[10][0][category_id]" value="10">
                                    <button type="button"
                                        class="mt-2 text-blue-600 hover:text-blue-800 text-sm add-item-btn"
                                        data-category="10">
                                        <i class="fas fa-plus ml-1"></i> إضافة بند
                                    </button>
                                </div>
                            </div>

                            <!-- أعمال الصحية -->
                            <div class="border rounded-lg bg-gray-50">
                                <div class="bg-blue-600 text-white px-4 py-3 rounded-t-lg">
                                    <h3 class="text-lg font-semibold">أعمال الصحية</h3>
                                </div>
                                <div class="p-4">
                                    <div class="overflow-x-auto">
                                        <table class="w-full border-collapse border border-gray-300">
                                            <thead class="bg-white">
                                                <tr>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">
                                                        اسم البند</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الكمية</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الوحدة</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        سعر الوحدة (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        المجموع (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody id="category-11-items">
                                                <tr class="pricing-row">
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="text" name="pricing[11][0][item_name]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm"
                                                            placeholder="مثال: تركيب شبكة الصرف الصحي">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[11][0][quantity]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <select name="pricing[11][0][unit]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm">
                                                            <option value="م">م</option>
                                                            <option value="قطعة">قطعة</option>
                                                            <option value="م²">م²</option>
                                                            <option value="م³">م³</option>
                                                        </select>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[11][0][unit_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[11][0][total_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                                            readonly>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                                        <button type="button"
                                                            class="text-red-600 hover:text-red-800 remove-item-btn">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <input type="hidden" name="pricing[11][0][category_id]" value="11">
                                    <button type="button"
                                        class="mt-2 text-blue-600 hover:text-blue-800 text-sm add-item-btn"
                                        data-category="11">
                                        <i class="fas fa-plus ml-1"></i> إضافة بند
                                    </button>
                                </div>
                            </div>

                            <!-- الأعمال الخارجية -->
                            <div class="border rounded-lg bg-gray-50">
                                <div class="bg-blue-600 text-white px-4 py-3 rounded-t-lg">
                                    <h3 class="text-lg font-semibold">الأعمال الخارجية</h3>
                                </div>
                                <div class="p-4">
                                    <div class="overflow-x-auto">
                                        <table class="w-full border-collapse border border-gray-300">
                                            <thead class="bg-white">
                                                <tr>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-right text-sm font-semibold text-gray-700">
                                                        اسم البند</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الكمية</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        الوحدة</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        سعر الوحدة (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        المجموع (درهم)</th>
                                                    <th
                                                        class="border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700">
                                                        العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody id="category-12-items">
                                                <tr class="pricing-row">
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="text" name="pricing[12][0][item_name]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm"
                                                            placeholder="مثال: أعمال الحدائق والأسوار">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[12][0][quantity]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-quantity"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <select name="pricing[12][0][unit]"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm">
                                                            <option value="م²">م²</option>
                                                            <option value="م">م</option>
                                                            <option value="قطعة">قطعة</option>
                                                            <option value="م³">م³</option>
                                                        </select>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[12][0][unit_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-unit-price"
                                                            placeholder="0.00">
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2">
                                                        <input type="number" name="pricing[12][0][total_price]"
                                                            step="0.01"
                                                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm pricing-total bg-gray-100"
                                                            readonly>
                                                    </td>
                                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                                        <button type="button"
                                                            class="text-red-600 hover:text-red-800 remove-item-btn">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <input type="hidden" name="pricing[12][0][category_id]" value="12">
                                    <button type="button"
                                        class="mt-2 text-blue-600 hover:text-blue-800 text-sm add-item-btn"
                                        data-category="12">
                                        <i class="fas fa-plus ml-1"></i> إضافة بند
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Total Summary -->
                        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h3 class="text-lg font-bold text-blue-800 mb-3">ملخص التكلفة الإجمالية</h3>
                            <table class="w-full">
                                <tbody>
                                    <tr>
                                        <td class="py-2 text-right text-sm font-medium text-blue-700 w-1/4">المجموع الكلي:
                                        </td>
                                        <td class="py-2">
                                            <span class="text-2xl font-bold text-blue-600" id="total-cost">0.00</span>
                                            <span class="text-sm text-blue-700 mr-2">درهم</span>
                                        </td>
                                        <td class="py-2 text-right text-sm font-medium text-green-700 w-1/4">عدد البنود:
                                        </td>
                                        <td class="py-2">
                                            <span class="text-xl font-bold text-green-600" id="total-items">0</span>
                                            <span class="text-sm text-green-700 mr-2">بند</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 text-right text-sm font-medium text-purple-700 w-1/4">عدد الفئات:
                                        </td>
                                        <td class="py-2">
                                            <span class="text-xl font-bold text-purple-600">12</span>
                                            <span class="text-sm text-purple-700 mr-2">فئة</span>
                                        </td>
                                        <td class="py-2 text-right text-sm font-medium text-orange-700 w-1/4">متوسط
                                            التكلفة:</td>
                                        <td class="py-2">
                                            <span class="text-xl font-bold text-orange-600" id="avg-cost">0.00</span>
                                            <span class="text-sm text-orange-700 mr-2">درهم/بند</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="bg-gray-50 px-6 py-4">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button type="submit"
                            class="flex-1 bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                            <i class="fas fa-save ml-2"></i>
                            حفظ التصميم
                        </button>
                        <a href="{{ route('designs.index') }}"
                            class="flex-1 border border-gray-300 text-gray-700 py-3 rounded-lg font-semibold text-center hover:bg-gray-50 transition duration-300">
                            إلغاء
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
