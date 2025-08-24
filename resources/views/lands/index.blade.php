@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-50 to-blue-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">بيع وتبادل الأراضي</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                منصة موثوقة لبيع وتبادل الأراضي السكنية والتجارية في المملكة العربية السعودية
            </p>
        </div>

        <!-- Quick Actions Header -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <h2 class="text-xl font-bold text-gray-900">روابط سريعة</h2>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('lands.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-teal-600 to-blue-600 text-white rounded-lg font-semibold hover:from-teal-700 hover:to-blue-700 transition-all transform hover:scale-105">
                        <i class="fas fa-plus ml-2"></i>
                        إضافة أرض جديدة
                    </a>
                    <a href="{{ route('lands.my-ads') }}" class="inline-flex items-center px-4 py-2 bg-teal-100 text-teal-700 rounded-lg hover:bg-teal-200 transition-colors">
                        <i class="fas fa-list ml-2"></i>
                        إعلاناتي
                    </a>
                    <a href="{{ route('lands.my-offers') }}" class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors">
                        <i class="fas fa-handshake ml-2"></i>
                        العروض المقدمة
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-teal-100 rounded-lg">
                        <i class="fas fa-map-marker-alt text-2xl text-teal-600"></i>
                    </div>
                    <div class="mr-4">
                        <h3 class="text-2xl font-bold text-gray-900">150+</h3>
                        <p class="text-gray-600">أرض متاحة</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <i class="fas fa-handshake text-2xl text-blue-600"></i>
                    </div>
                    <div class="mr-4">
                        <h3 class="text-2xl font-bold text-gray-900">89</h3>
                        <p class="text-gray-600">صفقة مكتملة</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <i class="fas fa-users text-2xl text-green-600"></i>
                    </div>
                    <div class="mr-4">
                        <h3 class="text-2xl font-bold text-gray-900">2,500+</h3>
                        <p class="text-gray-600">مستخدم نشط</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">المدينة</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        <option value="">جميع المدن</option>
                        <option value="riyadh">الرياض</option>
                        <option value="jeddah">جدة</option>
                        <option value="dammam">الدمام</option>
                        <option value="makkah">مكة المكرمة</option>
                        <option value="medina">المدينة المنورة</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">نوع الأرض</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        <option value="">جميع الأنواع</option>
                        <option value="residential">سكنية</option>
                        <option value="commercial">تجارية</option>
                        <option value="agricultural">زراعية</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">نوع الإعلان</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        <option value="">الكل</option>
                        <option value="sale">بيع</option>
                        <option value="exchange">تبادل</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">السعر</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        <option value="">جميع الأسعار</option>
                        <option value="0-500000">حتى 500,000 ريال</option>
                        <option value="500000-1000000">500,000 - 1,000,000 ريال</option>
                        <option value="1000000+">أكثر من 1,000,000 ريال</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Lands Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($lands as $land)
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <!-- Image -->
                <div class="relative h-48 bg-gradient-to-br from-teal-400 to-blue-500">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="fas fa-map text-6xl text-white opacity-20"></i>
                    </div>
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $land['type'] === 'بيع' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ $land['type'] }}
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $land['title'] }}</h3>
                    <p class="text-gray-600 mb-4">{{ $land['description'] }}</p>

                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-map-marker-alt text-teal-500 ml-2"></i>
                            <span>{{ $land['location'] }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-ruler-combined text-blue-500 ml-2"></i>
                            <span>{{ $land['area'] }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-tag text-green-500 ml-2"></i>
                            <span>{{ $land['price'] }} ريال</span>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('lands.show', $land['id']) }}" class="flex-1 bg-teal-600 text-white py-2 px-4 rounded-lg text-center font-semibold hover:bg-teal-700 transition-colors">
                            عرض التفاصيل
                        </a>
                        <button class="p-2 text-gray-400 hover:text-red-500 transition-colors" title="إضافة للمفضلة">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-12">
            <button class="bg-white text-teal-600 border-2 border-teal-600 px-8 py-3 rounded-lg font-semibold hover:bg-teal-600 hover:text-white transition-colors">
                تحميل المزيد
            </button>
        </div>

        <!-- CTA Section -->
        <div class="mt-16 bg-gradient-to-r from-teal-600 to-blue-600 rounded-2xl p-8 text-center text-white">
            <h2 class="text-3xl font-bold mb-4">هل لديك أرض للبيع أو التبادل؟</h2>
            <p class="text-xl mb-6 opacity-90">انشر إعلانك الآن واحصل على أفضل العروض</p>
            <a href="{{ route('lands.create') }}" class="bg-white text-teal-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors inline-block">
                <i class="fas fa-plus ml-2"></i>
                إضافة أرض جديدة
            </a>
        </div>
    </div>
</div>
@endsection
