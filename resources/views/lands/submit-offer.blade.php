@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-50 to-blue-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">تقديم عرض</h1>
            <p class="text-xl text-gray-600">قدم عرضك على الأرض المختارة</p>
        </div>

        <!-- Quick Actions Header -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <h2 class="text-xl font-bold text-gray-900">روابط سريعة</h2>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('lands.show', $land->id) }}" class="inline-flex items-center px-4 py-2 bg-teal-100 text-teal-700 rounded-lg hover:bg-teal-200 transition-colors">
                        <i class="fas fa-arrow-right ml-2"></i>العودة للأرض
                    </a>
                    <a href="{{ route('lands.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        <i class="fas fa-search ml-2"></i>تصفح الأراضي
                    </a>
                </div>
            </div>
        </div>

        <!-- Land Info -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">معلومات الأرض</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ $land->title }}</h3>
                    <p class="text-gray-600">{{ $land->description }}</p>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">المساحة:</span>
                        <span class="font-semibold">{{ $land->formatted_area }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">السعر:</span>
                        <span class="font-semibold text-teal-600">{{ $land->formatted_price }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">الموقع:</span>
                        <span class="font-semibold">{{ $land->city_text }} - {{ $land->district }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">نوع المعاملة:</span>
                        <span class="font-semibold">{{ $land->transaction_type_text }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Offer Form -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-teal-600 to-blue-600 px-8 py-6 text-white">
                <div class="flex items-center">
                    <div class="p-3 bg-white bg-opacity-20 rounded-lg ml-4">
                        <i class="fas fa-handshake text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold">تقديم عرضك</h2>
                        <p class="text-teal-100">أدخل تفاصيل عرضك على هذه الأرض</p>
                    </div>
                </div>
            </div>

            <form class="p-8" action="{{ route('lands.offers.store', $land->id) }}" method="POST">
                @csrf

                <!-- Offer Type -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-tag text-teal-600 ml-3"></i>نوع العرض
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="offer_type" value="purchase" class="sr-only" required>
                            <div class="border-2 border-gray-200 rounded-lg p-4 text-center hover:border-teal-500 transition-colors">
                                <i class="fas fa-money-bill text-2xl text-gray-400 mb-2"></i>
                                <div class="font-semibold text-gray-900">شراء</div>
                                <div class="text-sm text-gray-600">شراء الأرض</div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="offer_type" value="exchange" class="sr-only">
                            <div class="border-2 border-gray-200 rounded-lg p-4 text-center hover:border-teal-500 transition-colors">
                                <i class="fas fa-exchange-alt text-2xl text-gray-400 mb-2"></i>
                                <div class="font-semibold text-gray-900">تبادل</div>
                                <div class="text-sm text-gray-600">تبادل الأرض</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Offer Price -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-dollar-sign text-teal-600 ml-3"></i>سعر العرض
                    </h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">السعر المقدم (ريال)</label>
                        <input type="number" name="offer_price" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                            placeholder="أدخل السعر المقدم">
                        <p class="text-sm text-gray-500 mt-2">اترك هذا الحقل فارغاً إذا كان العرض للتبادل</p>
                    </div>
                </div>

                <!-- Offer Message -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-comment text-teal-600 ml-3"></i>رسالة العرض
                    </h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">رسالة العرض *</label>
                        <textarea name="offer_message" rows="5" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                            placeholder="اكتب رسالة مفصلة حول عرضك، سبب اهتمامك بالأرض، شروطك، إلخ..."></textarea>
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
                            <input type="text" name="offerer_name" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                placeholder="الاسم الكامل">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">رقم الهاتف *</label>
                            <input type="tel" name="offerer_phone" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                placeholder="+966 50 123 4567">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">البريد الإلكتروني</label>
                            <input type="email" name="offerer_email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                placeholder="example@email.com">
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <button type="submit"
                        class="flex-1 bg-gradient-to-r from-teal-600 to-blue-600 text-white py-4 px-6 rounded-lg font-semibold hover:from-teal-700 hover:to-blue-700 transition-all transform hover:scale-105">
                        <i class="fas fa-paper-plane ml-2"></i>تقديم العرض
                    </button>
                    <a href="{{ route('lands.show', $land->id) }}"
                        class="flex-1 bg-gray-100 text-gray-700 py-4 px-6 rounded-lg font-semibold hover:bg-gray-200 transition-colors text-center">
                        <i class="fas fa-times ml-2"></i>إلغاء
                    </a>
                </div>
            </form>
        </div>

        <!-- Tips Section -->
        <div class="mt-12 bg-white rounded-xl shadow-lg border border-gray-100 p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-lightbulb text-yellow-500 ml-3"></i>نصائح لتقديم عرض ناجح
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mt-1 ml-3"></i>
                    <p class="text-gray-700">اكتب رسالة واضحة ومفصلة حول سبب اهتمامك بالأرض</p>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mt-1 ml-3"></i>
                    <p class="text-gray-700">اذكر سعراً معقولاً ومتناسباً مع قيمة الأرض</p>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mt-1 ml-3"></i>
                    <p class="text-gray-700">أدخل معلومات التواصل الصحيحة</p>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mt-1 ml-3"></i>
                    <p class="text-gray-700">كن محترفاً ومهذباً في رسالتك</p>
                </div>
            </div>
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
</script>
@endsection








