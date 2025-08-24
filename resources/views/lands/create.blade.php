@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-50 to-blue-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">إضافة أرض جديدة</h1>
            <p class="text-xl text-gray-600">
                انشر إعلانك بسهولة واحصل على أفضل العروض
            </p>
        </div>

        <!-- Quick Actions Header -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <h2 class="text-xl font-bold text-gray-900">روابط سريعة</h2>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('lands.my-ads') }}" class="inline-flex items-center px-4 py-2 bg-teal-100 text-teal-700 rounded-lg hover:bg-teal-200 transition-colors">
                        <i class="fas fa-list ml-2"></i>
                        إعلاناتي
                    </a>
                    <a href="{{ route('lands.my-offers') }}" class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors">
                        <i class="fas fa-handshake ml-2"></i>
                        العروض المقدمة
                    </a>
                    <a href="{{ route('lands.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        <i class="fas fa-search ml-2"></i>
                        تصفح الأراضي
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-teal-600 to-blue-600 px-8 py-6 text-white">
                <div class="flex items-center">
                    <div class="p-3 bg-white bg-opacity-20 rounded-lg ml-4">
                        <i class="fas fa-plus text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold">معلومات الأرض</h2>
                        <p class="text-teal-100">أدخل تفاصيل الأرض التي تريد بيعها أو تبادلها</p>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <form class="p-8" action="{{ route('lands.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Basic Information -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-info-circle text-teal-600 ml-3"></i>
                        المعلومات الأساسية
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">عنوان الإعلان *</label>
                            <input type="text" name="title" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                placeholder="مثال: أرض سكنية مميزة في الرياض">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">نوع الأرض *</label>
                            <select name="land_type" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                <option value="">اختر نوع الأرض</option>
                                <option value="residential">سكنية</option>
                                <option value="commercial">تجارية</option>
                                <option value="agricultural">زراعية</option>
                                <option value="industrial">صناعية</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">المساحة (متر مربع) *</label>
                            <input type="number" name="area" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                placeholder="مثال: 500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">السعر (ريال) *</label>
                            <input type="number" name="price" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                placeholder="مثال: 800000">
                        </div>
                    </div>
                </div>

                <!-- Location Information -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-map-marker-alt text-teal-600 ml-3"></i>
                        معلومات الموقع
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">المدينة *</label>
                            <select name="city" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                <option value="">اختر المدينة</option>
                                <option value="riyadh">الرياض</option>
                                <option value="jeddah">جدة</option>
                                <option value="dammam">الدمام</option>
                                <option value="makkah">مكة المكرمة</option>
                                <option value="medina">المدينة المنورة</option>
                                <option value="taif">الطائف</option>
                                <option value="abha">أبها</option>
                                <option value="jubail">الجبيل</option>
                                <option value="yanbu">ينبع</option>
                                <option value="other">مدينة أخرى</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الحي/المنطقة *</label>
                            <input type="text" name="district" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                placeholder="مثال: حي النرجس">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">العنوان التفصيلي</label>
                            <textarea name="address" rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                placeholder="اكتب العنوان التفصيلي للأرض..."></textarea>
                        </div>
                    </div>
                </div>

                <!-- Desired Location Information -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-exchange-alt text-blue-600 ml-3"></i>
                        الموقع المرغوب للتبادل
                    </h3>

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle text-blue-600 ml-2"></i>
                            <p class="text-blue-800 text-sm">أدخل المواقع التي ترغب في التبادل معها (اختياري)</p>
                        </div>
                    </div>

                    <div id="desired-locations-container">
                        <div class="desired-location-item bg-gray-50 border border-gray-200 rounded-lg p-4 mb-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">المدينة المرغوبة</label>
                                    <select name="desired_cities[]"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="">اختر المدينة</option>
                                        <option value="riyadh">الرياض</option>
                                        <option value="jeddah">جدة</option>
                                        <option value="dammam">الدمام</option>
                                        <option value="makkah">مكة المكرمة</option>
                                        <option value="medina">المدينة المنورة</option>
                                        <option value="taif">الطائف</option>
                                        <option value="abha">أبها</option>
                                        <option value="jubail">الجبيل</option>
                                        <option value="yanbu">ينبع</option>
                                        <option value="other">مدينة أخرى</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">الحي/المنطقة المرغوبة</label>
                                    <input type="text" name="desired_districts[]"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="مثال: حي النرجس">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">المساحة المرغوبة (متر مربع)</label>
                                    <input type="number" name="desired_areas[]"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="مثال: 600">
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">تفاصيل إضافية</label>
                                <textarea name="desired_details[]" rows="2"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="اكتب أي تفاصيل إضافية حول الموقع المرغوب..."></textarea>
                            </div>

                            <div class="mt-4 flex justify-end">
                                <button type="button" class="remove-location-btn text-red-600 hover:text-red-800 text-sm font-medium">
                                    <i class="fas fa-trash ml-1"></i>
                                    حذف هذا الموقع
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="button" id="add-desired-location"
                            class="bg-blue-100 text-blue-600 border-2 border-blue-300 px-6 py-3 rounded-lg font-semibold hover:bg-blue-200 transition-colors">
                            <i class="fas fa-plus ml-2"></i>
                            إضافة موقع مرغوب آخر
                        </button>
                    </div>
                </div>

                <!-- Transaction Type -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-handshake text-teal-600 ml-3"></i>
                        نوع المعاملة
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="transaction_type" value="sale" class="sr-only" required>
                            <div class="border-2 border-gray-200 rounded-lg p-4 text-center hover:border-teal-500 transition-colors">
                                <i class="fas fa-tag text-2xl text-gray-400 mb-2"></i>
                                <div class="font-semibold text-gray-900">بيع</div>
                                <div class="text-sm text-gray-600">بيع الأرض</div>
                            </div>
                        </label>

                        <label class="relative cursor-pointer">
                            <input type="radio" name="transaction_type" value="exchange" class="sr-only">
                            <div class="border-2 border-gray-200 rounded-lg p-4 text-center hover:border-teal-500 transition-colors">
                                <i class="fas fa-exchange-alt text-2xl text-gray-400 mb-2"></i>
                                <div class="font-semibold text-gray-900">تبادل</div>
                                <div class="text-sm text-gray-600">تبادل الأرض</div>
                            </div>
                        </label>

                        <label class="relative cursor-pointer">
                            <input type="radio" name="transaction_type" value="both" class="sr-only">
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
                        <i class="fas fa-align-right text-teal-600 ml-3"></i>
                        وصف الأرض
                    </h3>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">وصف مفصل للأرض *</label>
                        <textarea name="description" rows="5" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                            placeholder="اكتب وصفاً مفصلاً للأرض، مميزاتها، الخدمات المتوفرة، إلخ..."></textarea>
                    </div>
                </div>

                <!-- Features -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-star text-teal-600 ml-3"></i>
                        مميزات الأرض
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="features[]" value="services" class="rounded border-gray-300 text-teal-600 focus:ring-teal-500 ml-3">
                            <span class="text-gray-700">خدمات متوفرة</span>
                        </label>

                        <label class="flex items-center">
                            <input type="checkbox" name="features[]" value="paved" class="rounded border-gray-300 text-teal-600 focus:ring-teal-500 ml-3">
                            <span class="text-gray-700">طريق معبد</span>
                        </label>

                        <label class="flex items-center">
                            <input type="checkbox" name="features[]" value="flat" class="rounded border-gray-300 text-teal-600 focus:ring-teal-500 ml-3">
                            <span class="text-gray-700">أرض مستوية</span>
                        </label>

                        <label class="flex items-center">
                            <input type="checkbox" name="features[]" value="corner" class="rounded border-gray-300 text-teal-600 focus:ring-teal-500 ml-3">
                            <span class="text-gray-700">أرض زاوية</span>
                        </label>

                        <label class="flex items-center">
                            <input type="checkbox" name="features[]" value="view" class="rounded border-gray-300 text-teal-600 focus:ring-teal-500 ml-3">
                            <span class="text-gray-700">إطلالة مميزة</span>
                        </label>

                        <label class="flex items-center">
                            <input type="checkbox" name="features[]" value="security" class="rounded border-gray-300 text-teal-600 focus:ring-teal-500 ml-3">
                            <span class="text-gray-700">أمان عالي</span>
                        </label>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-phone text-teal-600 ml-3"></i>
                        معلومات التواصل
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">الاسم الكامل *</label>
                            <input type="text" name="contact_name" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                placeholder="الاسم الكامل">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">رقم الهاتف *</label>
                            <input type="tel" name="contact_phone" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                placeholder="+966 50 123 4567">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">رقم الواتساب</label>
                            <input type="tel" name="contact_whatsapp"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                placeholder="+966 50 123 4567">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">البريد الإلكتروني</label>
                            <input type="email" name="contact_email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                placeholder="example@email.com">
                        </div>
                    </div>
                </div>

                <!-- Images Upload -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-images text-teal-600 ml-3"></i>
                        صور الأرض
                    </h3>

                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-teal-500 transition-colors">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                        <p class="text-lg font-medium text-gray-900 mb-2">اسحب وأفلت الصور هنا</p>
                        <p class="text-gray-600 mb-4">أو اضغط لاختيار الملفات</p>
                        <input type="file" name="images[]" multiple accept="image/*"
                            class="hidden" id="image-upload">
                        <label for="image-upload"
                            class="bg-teal-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-teal-700 transition-colors cursor-pointer">
                            اختيار الصور
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <button type="submit"
                        class="flex-1 bg-gradient-to-r from-teal-600 to-blue-600 text-white py-4 px-6 rounded-lg font-semibold hover:from-teal-700 hover:to-blue-700 transition-all transform hover:scale-105">
                        <i class="fas fa-paper-plane ml-2"></i>
                        نشر الإعلان
                    </button>

                    <a href="{{ route('lands.index') }}"
                        class="flex-1 bg-gray-100 text-gray-700 py-4 px-6 rounded-lg font-semibold hover:bg-gray-200 transition-colors text-center">
                        <i class="fas fa-times ml-2"></i>
                        إلغاء
                    </a>
                </div>
            </form>
        </div>

        <!-- Tips Section -->
        <div class="mt-12 bg-white rounded-xl shadow-lg border border-gray-100 p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-lightbulb text-yellow-500 ml-3"></i>
                نصائح لنشر إعلان ناجح
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mt-1 ml-3"></i>
                    <p class="text-gray-700">أضف صور واضحة وعالية الجودة للأرض</p>
                </div>

                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mt-1 ml-3"></i>
                    <p class="text-gray-700">اكتب وصفاً مفصلاً وشاملاً للأرض</p>
                </div>

                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mt-1 ml-3"></i>
                    <p class="text-gray-700">اذكر جميع المميزات والخدمات المتوفرة</p>
                </div>

                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mt-1 ml-3"></i>
                    <p class="text-gray-700">أدخل معلومات التواصل الصحيحة</p>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="border-t border-gray-200 pt-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-4">روابط سريعة</h4>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('lands.my-ads') }}" class="inline-flex items-center px-4 py-2 bg-teal-100 text-teal-700 rounded-lg hover:bg-teal-200 transition-colors">
                        <i class="fas fa-list ml-2"></i>
                        إعلاناتي
                    </a>
                    <a href="{{ route('lands.my-offers') }}" class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors">
                        <i class="fas fa-handshake ml-2"></i>
                        العروض المقدمة
                    </a>
                    <a href="{{ route('lands.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        <i class="fas fa-search ml-2"></i>
                        تصفح الأراضي
                    </a>
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
            r.closest('label').querySelector('div').classList.remove('border-teal-500', 'bg-teal-50');
            r.closest('label').querySelector('div').classList.add('border-gray-200');
        });

        // Add active class to selected label
        if (this.checked) {
            this.closest('label').querySelector('div').classList.remove('border-gray-200');
            this.closest('label').querySelector('div').classList.add('border-teal-500', 'bg-teal-50');
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
