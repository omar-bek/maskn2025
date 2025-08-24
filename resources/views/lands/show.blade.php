@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-50 to-blue-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-500 hover:text-teal-600">الرئيسية</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-left text-gray-400 mx-2"></i>
                        <a href="{{ route('lands.index') }}" class="text-gray-500 hover:text-teal-600">الأراضي</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-left text-gray-400 mx-2"></i>
                        <span class="text-gray-900 font-medium">{{ $land['title'] }}</span>
                    </div>
                </li>
            </ol>
        </nav>

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
                    <a href="{{ route('lands.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        <i class="fas fa-search ml-2"></i>
                        تصفح الأراضي
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Image Gallery -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden mb-8">
                    <div class="relative h-96 bg-gradient-to-br from-teal-400 to-blue-500">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-map text-8xl text-white opacity-20"></i>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span class="px-4 py-2 rounded-full text-sm font-semibold {{ $land['type'] === 'بيع' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $land['type'] }}
                            </span>
                        </div>
                        <div class="absolute top-4 left-4">
                            <button class="p-2 bg-white bg-opacity-90 rounded-lg text-gray-600 hover:text-red-500 transition-colors">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Thumbnail Images -->
                    <div class="p-4 border-t border-gray-100">
                        <div class="flex space-x-2 space-x-reverse">
                            @foreach($land['images'] as $image)
                            <div class="w-20 h-20 bg-gradient-to-br from-teal-300 to-blue-400 rounded-lg cursor-pointer hover:opacity-80 transition-opacity">
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-map text-white opacity-60"></i>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Property Details -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $land['title'] }}</h1>
                    <p class="text-gray-600 text-lg mb-6">{{ $land['description'] }}</p>

                    <!-- Key Features -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="p-3 bg-teal-100 rounded-lg ml-4">
                                <i class="fas fa-map-marker-alt text-xl text-teal-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">الموقع</p>
                                <p class="font-semibold text-gray-900">{{ $land['location'] }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="p-3 bg-blue-100 rounded-lg ml-4">
                                <i class="fas fa-ruler-combined text-xl text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">المساحة</p>
                                <p class="font-semibold text-gray-900">{{ $land['area'] }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="p-3 bg-green-100 rounded-lg ml-4">
                                <i class="fas fa-tag text-xl text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">السعر</p>
                                <p class="font-semibold text-gray-900">{{ $land['price'] }} ريال</p>
                            </div>
                        </div>

                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="p-3 bg-purple-100 rounded-lg ml-4">
                                <i class="fas fa-calendar-alt text-xl text-purple-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">تاريخ النشر</p>
                                <p class="font-semibold text-gray-900">منذ 3 أيام</p>
                            </div>
                        </div>
                    </div>

                    <!-- Features List -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">مميزات الأرض</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach($land['features'] as $feature)
                            <div class="flex items-center">
                                <i class="fas fa-check text-green-500 ml-3"></i>
                                <span class="text-gray-700">{{ $feature }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Location Map -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">الموقع على الخريطة</h3>
                    <div class="h-64 bg-gradient-to-br from-gray-200 to-gray-300 rounded-lg flex items-center justify-center">
                        <div class="text-center">
                            <i class="fas fa-map-marked-alt text-4xl text-gray-400 mb-2"></i>
                            <p class="text-gray-600">خريطة تفاعلية للموقع</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Contact Card -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-6 sticky top-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">معلومات التواصل</h3>

                    <div class="space-y-4 mb-6">
                        <div class="flex items-center">
                            <div class="p-2 bg-teal-100 rounded-lg ml-3">
                                <i class="fas fa-user text-teal-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">المعلن</p>
                                <p class="font-semibold text-gray-900">أحمد محمد</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="p-2 bg-blue-100 rounded-lg ml-3">
                                <i class="fas fa-phone text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">الهاتف</p>
                                <p class="font-semibold text-gray-900">+966 50 123 4567</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="p-2 bg-green-100 rounded-lg ml-3">
                                <i class="fab fa-whatsapp text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">واتساب</p>
                                <p class="font-semibold text-gray-900">+966 50 123 4567</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <button class="w-full bg-teal-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-teal-700 transition-colors">
                            <i class="fas fa-phone ml-2"></i>
                            اتصل الآن
                        </button>

                        <button class="w-full bg-green-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-green-700 transition-colors">
                            <i class="fab fa-whatsapp ml-2"></i>
                            واتساب
                        </button>

                        <button class="w-full border-2 border-teal-600 text-teal-600 py-3 px-4 rounded-lg font-semibold hover:bg-teal-600 hover:text-white transition-colors">
                            <i class="fas fa-envelope ml-2"></i>
                            إرسال رسالة
                        </button>
                    </div>
                </div>

                <!-- Similar Properties -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">أراضي مشابهة</h3>

                    <div class="space-y-4">
                        <div class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                            <div class="w-16 h-16 bg-gradient-to-br from-teal-300 to-blue-400 rounded-lg ml-3 flex items-center justify-center">
                                <i class="fas fa-map text-white opacity-60"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 text-sm">أرض سكنية في جدة</h4>
                                <p class="text-gray-600 text-sm">600 متر مربع</p>
                                <p class="text-teal-600 font-semibold text-sm">750,000 ريال</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                            <div class="w-16 h-16 bg-gradient-to-br from-teal-300 to-blue-400 rounded-lg ml-3 flex items-center justify-center">
                                <i class="fas fa-map text-white opacity-60"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 text-sm">أرض تجارية في الدمام</h4>
                                <p class="text-gray-600 text-sm">800 متر مربع</p>
                                <p class="text-teal-600 font-semibold text-sm">1,200,000 ريال</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                            <div class="w-16 h-16 bg-gradient-to-br from-teal-300 to-blue-400 rounded-lg ml-3 flex items-center justify-center">
                                <i class="fas fa-map text-white opacity-60"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 text-sm">أرض زراعية في القصيم</h4>
                                <p class="text-gray-600 text-sm">1500 متر مربع</p>
                                <p class="text-teal-600 font-semibold text-sm">450,000 ريال</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
