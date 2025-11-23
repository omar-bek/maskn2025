@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-50 to-blue-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">تعديل الإعلان</h1>
            <p class="text-xl text-gray-600">قم بتحديث معلومات إعلانك للحصول على أفضل النتائج</p>
        </div>

        <!-- Quick Actions Header -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <h2 class="text-xl font-bold text-gray-900">روابط سريعة</h2>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('lands.my-ads') }}" class="inline-flex items-center px-4 py-2 bg-teal-100 text-teal-700 rounded-lg hover:bg-teal-200 transition-colors">
                        <i class="fas fa-list ml-2"></i>إعلاناتي
                    </a>
                    <a href="{{ route('lands.my-offers') }}" class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors">
                        <i class="fas fa-handshake ml-2"></i>العروض المقدمة
                    </a>
                    <a href="{{ route('lands.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        <i class="fas fa-search ml-2"></i>تصفح الأراضي
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-teal-600 to-blue-600 px-8 py-6 text-white">
                <div class="flex items-center">
                    <div class="p-3 bg-white bg-opacity-20 rounded-lg ml-4">
                        <i class="fas fa-edit text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold">تعديل معلومات الأرض</h2>
                        <p class="text-teal-100">قم بتحديث تفاصيل الأرض التي تريد بيعها أو تبادلها</p>
                    </div>
                </div>
            </div>

            <form class="p-8" action="{{ route('lands.update', $land['id']) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Basic Information -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-info-circle text-teal-600 ml-3"></i>المعلومات الأساسية
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">عنوان الإعلان *</label>
                            <input type="text" name="title" value="{{ $land['title'] }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">نوع الأرض *</label>
                            <select name="land_type" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                <option value="">اختر نوع الأرض</option>
                                <option value="residential" {{ $land['land_type'] === 'residential' ? 'selected' : '' }}>سكنية</option>
                                <option value="commercial" {{ $land['land_type'] === 'commercial' ? 'selected' : '' }}>تجارية</option>
                                <option value="agricultural" {{ $land['land_type'] === 'agricultural' ? 'selected' : '' }}>زراعية</option>
                                <option value="industrial" {{ $land['land_type'] === 'industrial' ? 'selected' : '' }}>صناعية</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">المساحة (متر مربع) *</label>
                            <input type="number" name="area" value="{{ $land['area'] }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">السعر (درهم) *</label>
                            <input type="number" name="price" value="{{ $land['price'] }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- Location Information -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-map-marker-alt text-teal-600 ml-3"></i>معلومات الموقع
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">المدينة *</label>
                            <select name="city" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                <option value="">اختر المدينة</option>
                                <option value="riyadh" {{ $land['city'] === 'riyadh' ? 'selected' : '' }}>الرياض</option>
                                <option value="jeddah" {{ $land['city'] === 'jeddah' ? 'selected' : '' }}>جدة</option>
                                <option value="dammam" {{ $land['city'] === 'dammam' ? 'selected' : '' }}>الدمام</option>
                                <option value="makkah" {{ $land['city'] === 'makkah' ? 'selected' : '' }}>مكة المكرمة</option>
                                <option value="medina" {{ $land['city'] === 'medina' ? 'selected' : '' }}>المدينة المنورة</option>
                                <option value="taif" {{ $land['city'] === 'taif' ? 'selected' : '' }}>الطائف</option>
                                <option value="abha" {{ $land['city'] === 'abha' ? 'selected' : '' }}>أبها</option>
                                <option value="jubail" {{ $land['city'] === 'jubail' ? 'selected' : '' }}>الجبيل</option>
                                <option value="yanbu" {{ $land['city'] === 'yanbu' ? 'selected' : '' }}>ينبع</option>
                                <option value="other" {{ $land['city'] === 'other' ? 'selected' : '' }}>مدينة أخرى</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الحي/المنطقة *</label>
                            <input type="text" name="district" value="{{ $land['district'] }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">العنوان التفصيلي</label>
                            <textarea name="address" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">{{ $land['address'] }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Transaction Type -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-handshake text-teal-600 ml-3"></i>نوع المعاملة
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="transaction_type" value="sale" {{ $land['transaction_type'] === 'sale' ? 'checked' : '' }} class="sr-only" required>
                            <div class="border-2 border-gray-200 rounded-lg p-4 text-center hover:border-teal-500 transition-colors">
                                <i class="fas fa-tag text-2xl text-gray-400 mb-2"></i>
                                <div class="font-semibold text-gray-900">بيع</div>
                                <div class="text-sm text-gray-600">بيع الأرض</div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="transaction_type" value="exchange" {{ $land['transaction_type'] === 'exchange' ? 'checked' : '' }} class="sr-only">
                            <div class="border-2 border-gray-200 rounded-lg p-4 text-center hover:border-teal-500 transition-colors">
                                <i class="fas fa-exchange-alt text-2xl text-gray-400 mb-2"></i>
                                <div class="font-semibold text-gray-900">تبادل</div>
                                <div class="text-sm text-gray-600">تبادل الأرض</div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="transaction_type" value="both" {{ $land['transaction_type'] === 'both' ? 'checked' : '' }} class="sr-only">
                            <div class="border-2 border-gray-200 rounded-lg p-4 text-center hover:border-teal-500 transition-colors">
                                <i class="fas fa-arrows-alt-h text-2xl text-gray-400 mb-2"></i>
                                <div class="font-semibold text-gray-900">الكل</div>
                                <div class="text-sm text-gray-600">بيع أو تبادل</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-align-right text-teal-600 ml-3"></i>وصف الأرض
                    </h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">وصف مفصل للأرض *</label>
                        <textarea name="description" rows="5" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">{{ $land['description'] }}</textarea>
                    </div>
                </div>

                <!-- Features -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-star text-teal-600 ml-3"></i>مميزات الأرض
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="features[]" value="services" {{ in_array('services', $land['features'] ?? []) ? 'checked' : '' }} class="rounded border-gray-300 text-teal-600 focus:ring-teal-500 ml-3">
                            <span class="text-gray-700">خدمات متوفرة</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="features[]" value="paved" {{ in_array('paved', $land['features'] ?? []) ? 'checked' : '' }} class="rounded border-gray-300 text-teal-600 focus:ring-teal-500 ml-3">
                            <span class="text-gray-700">طريق معبد</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="features[]" value="flat" {{ in_array('flat', $land['features'] ?? []) ? 'checked' : '' }} class="rounded border-gray-300 text-teal-600 focus:ring-teal-500 ml-3">
                            <span class="text-gray-700">أرض مستوية</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="features[]" value="corner" {{ in_array('corner', $land['features'] ?? []) ? 'checked' : '' }} class="rounded border-gray-300 text-teal-600 focus:ring-teal-500 ml-3">
                            <span class="text-gray-700">أرض زاوية</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="features[]" value="view" {{ in_array('view', $land['features'] ?? []) ? 'checked' : '' }} class="rounded border-gray-300 text-teal-600 focus:ring-teal-500 ml-3">
                            <span class="text-gray-700">إطلالة مميزة</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="features[]" value="security" {{ in_array('security', $land['features'] ?? []) ? 'checked' : '' }} class="rounded border-gray-300 text-teal-600 focus:ring-teal-500 ml-3">
                            <span class="text-gray-700">أمان عالي</span>
                        </label>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-phone text-teal-600 ml-3"></i>معلومات التواصل
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الاسم الكامل *</label>
                            <input type="text" name="contact_name" value="{{ $land['contact_name'] }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">رقم الهاتف *</label>
                            <input type="tel" name="contact_phone" value="{{ $land['contact_phone'] }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">رقم الواتساب</label>
                            <input type="tel" name="contact_whatsapp" value="{{ $land['contact_whatsapp'] }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">البريد الإلكتروني</label>
                            <input type="email" name="contact_email" value="{{ $land['contact_email'] }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-teal-600 to-blue-600 text-white py-4 px-6 rounded-lg font-semibold hover:from-teal-700 hover:to-blue-700 transition-all transform hover:scale-105">
                        <i class="fas fa-save ml-2"></i>حفظ التعديلات
                    </button>
                    <a href="{{ route('lands.my-ads') }}" class="flex-1 bg-gray-100 text-gray-700 py-4 px-6 rounded-lg font-semibold hover:bg-gray-200 transition-colors text-center">
                        <i class="fas fa-times ml-2"></i>إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Handle radio button styling
document.querySelectorAll('input[type="radio"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.querySelectorAll('input[type="radio"]').forEach(r => {
            r.closest('label').querySelector('div').classList.remove('border-teal-500', 'bg-teal-50');
            r.closest('label').querySelector('div').classList.add('border-gray-200');
        });
        if (this.checked) {
            this.closest('label').querySelector('div').classList.remove('border-gray-200');
            this.closest('label').querySelector('div').classList.add('border-teal-500', 'bg-teal-50');
        }
    });
});

// Initialize radio button styling on page load
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('input[type="radio"]:checked').forEach(radio => {
        radio.closest('label').querySelector('div').classList.remove('border-gray-200');
        radio.closest('label').querySelector('div').classList.add('border-teal-500', 'bg-teal-50');
    });
});
</script>
@endsection
