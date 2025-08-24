@extends('layouts.app')

@section('title', 'إضافة تصميم جديد - انشاءات')

@section('content')
<!-- Header Section -->
<section class="bg-gradient-to-r from-teal-700 to-teal-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">أضف تصميمك</h1>
            <p class="text-xl text-blue-100">شارك تصاميمك مع مجتمع انشاءات</p>
        </div>
    </div>
</section>

<!-- Form Section -->
<section class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            <form action="{{ route('designs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Basic Information -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">المعلومات الأساسية</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">عنوان التصميم *</label>
                            <input type="text" id="title" name="title" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="مثال: فيلا عصرية فاخرة">
                        </div>

                        <div>
                            <label for="style" class="block text-sm font-medium text-gray-700 mb-2">نمط التصميم *</label>
                            <select id="style" name="style" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500">
                                <option value="">اختر النمط</option>
                                <option value="modern">عصري</option>
                                <option value="islamic">إسلامي</option>
                                <option value="traditional">تقليدي</option>
                                <option value="classic">كلاسيكي</option>
                                <option value="minimalist">مينيمال</option>
                            </select>
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">سعر التصميم (ريال) *</label>
                            <input type="number" id="price" name="price" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="مثال: 500000">
                        </div>

                        <div>
                            <label for="area" class="block text-sm font-medium text-gray-700 mb-2">المساحة (متر مربع) *</label>
                            <input type="number" id="area" name="area" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="مثال: 400">
                        </div>
                    </div>
                </div>

                <!-- Specifications -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">المواصفات</h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="bedrooms" class="block text-sm font-medium text-gray-700 mb-2">عدد غرف النوم</label>
                            <input type="number" id="bedrooms" name="bedrooms"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="مثال: 5">
                        </div>

                        <div>
                            <label for="bathrooms" class="block text-sm font-medium text-gray-700 mb-2">عدد الحمامات</label>
                            <input type="number" id="bathrooms" name="bathrooms"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="مثال: 4">
                        </div>

                        <div>
                            <label for="floors" class="block text-sm font-medium text-gray-700 mb-2">عدد الطوابق</label>
                            <input type="number" id="floors" name="floors"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="مثال: 3">
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">وصف التصميم</h2>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">الوصف التفصيلي *</label>
                        <textarea id="description" name="description" rows="6" required
                                  class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="اكتب وصفاً مفصلاً للتصميم..."></textarea>
                    </div>
                </div>

                <!-- Features -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">المميزات</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="garden" name="features[]" value="حديقة خارجية" class="ml-3">
                            <label for="garden" class="text-gray-700">حديقة خارجية</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="parking" name="features[]" value="موقف سيارات" class="ml-3">
                            <label for="parking" class="text-gray-700">موقف سيارات</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="kitchen" name="features[]" value="مطبخ مجهز" class="ml-3">
                            <label for="kitchen" class="text-gray-700">مطبخ مجهز</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="living" name="features[]" value="غرفة معيشة واسعة" class="ml-3">
                            <label for="living" class="text-gray-700">غرفة معيشة واسعة</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="pool" name="features[]" value="مسبح خاص" class="ml-3">
                            <label for="pool" class="text-gray-700">مسبح خاص</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="elevator" name="features[]" value="مصعد داخلي" class="ml-3">
                            <label for="elevator" class="text-gray-700">مصعد داخلي</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="balcony" name="features[]" value="شرفات" class="ml-3">
                            <label for="balcony" class="text-gray-700">شرفات</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="storage" name="features[]" value="مخازن" class="ml-3">
                            <label for="storage" class="text-gray-700">مخازن</label>
                        </div>
                    </div>
                </div>

                <!-- Images -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">صور التصميم</h2>

                    <div class="space-y-4">
                        <div>
                            <label for="main_image" class="block text-sm font-medium text-gray-700 mb-2">الصورة الرئيسية *</label>
                            <input type="file" id="main_image" name="main_image" accept="image/*" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="images" class="block text-sm font-medium text-gray-700 mb-2">صور إضافية</label>
                            <input type="file" id="images" name="images[]" accept="image/*" multiple
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <p class="text-sm text-gray-500 mt-1">يمكنك اختيار أكثر من صورة</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">معلومات التواصل</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="architect_name" class="block text-sm font-medium text-gray-700 mb-2">اسم المصمم *</label>
                            <input type="text" id="architect_name" name="architect_name" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="مثال: أحمد محمد">
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">رقم الهاتف</label>
                            <input type="tel" id="phone" name="phone"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="مثال: +966501234567">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">البريد الإلكتروني</label>
                            <input type="email" id="email" name="email"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="مثال: info@example.com">
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">الموقع</label>
                            <input type="text" id="location" name="location"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="مثال: الرياض، المملكة العربية السعودية">
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                                         <button type="submit" class="flex-1 bg-teal-600 text-white py-3 rounded-lg font-semibold hover:bg-teal-700 transition duration-300">
                         <i class="fas fa-save ml-2"></i>
                         حفظ التصميم
                     </button>
                    <a href="{{ route('designs.index') }}" class="flex-1 border border-gray-300 text-gray-700 py-3 rounded-lg font-semibold text-center hover:bg-gray-50 transition duration-300">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
