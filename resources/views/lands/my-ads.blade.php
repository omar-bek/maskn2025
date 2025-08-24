@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-50 to-blue-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">إعلاناتي</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                إدارة إعلانات الأراضي الخاصة بك وتتبع الأداء
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

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-teal-100 rounded-lg">
                        <i class="fas fa-list text-2xl text-teal-600"></i>
                    </div>
                    <div class="mr-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ count($myLands) }}</h3>
                        <p class="text-gray-600">إعلان إجمالي</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <i class="fas fa-eye text-2xl text-green-600"></i>
                    </div>
                    <div class="mr-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ array_sum(array_column($myLands, 'views')) }}</h3>
                        <p class="text-gray-600">مشاهدات</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <i class="fas fa-handshake text-2xl text-blue-600"></i>
                    </div>
                    <div class="mr-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ array_sum(array_column($myLands, 'offers')) }}</h3>
                        <p class="text-gray-600">عروض مقدمة</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-lg">
                        <i class="fas fa-chart-line text-2xl text-purple-600"></i>
                    </div>
                    <div class="mr-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ count(array_filter($myLands, fn($land) => $land['status'] === 'نشط')) }}</h3>
                        <p class="text-gray-600">إعلانات نشطة</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Bar -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <h2 class="text-xl font-bold text-gray-900">إعلاناتي</h2>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 bg-teal-600 text-white rounded-lg text-sm font-medium hover:bg-teal-700 transition-colors">
                            الكل
                        </button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                            نشط
                        </button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                            معلق
                        </button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                            مكتمل
                        </button>
                    </div>
                </div>

                <a href="{{ route('lands.create') }}" class="bg-gradient-to-r from-teal-600 to-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-teal-700 hover:to-blue-700 transition-all transform hover:scale-105">
                    <i class="fas fa-plus ml-2"></i>
                    إضافة إعلان جديد
                </a>
            </div>
        </div>

        <!-- My Ads Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach($myLands as $land)
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <!-- Image and Status -->
                <div class="relative h-48 bg-gradient-to-br from-teal-400 to-blue-500">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="fas fa-map text-6xl text-white opacity-20"></i>
                    </div>
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $land['status'] === 'نشط' ? 'bg-green-100 text-green-800' :
                               ($land['status'] === 'معلق' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                            {{ $land['status'] }}
                        </span>
                    </div>
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $land['type'] === 'بيع' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ $land['type'] }}
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold text-gray-900">{{ $land['title'] }}</h3>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-teal-600">{{ $land['price'] }} ريال</p>
                            <p class="text-sm text-gray-500">{{ $land['created_at'] }}</p>
                        </div>
                    </div>

                    <p class="text-gray-600 mb-4">{{ $land['description'] }}</p>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-map-marker-alt text-teal-500 ml-2"></i>
                            <span>{{ $land['location'] }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-ruler-combined text-blue-500 ml-2"></i>
                            <span>{{ $land['area'] }}</span>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="flex items-center justify-between mb-4 p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-eye text-gray-400 ml-2"></i>
                            <span>{{ $land['views'] }} مشاهدة</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-handshake text-gray-400 ml-2"></i>
                            <span>{{ $land['offers'] }} عرض</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2">
                        <a href="{{ route('lands.show', $land['id']) }}" class="flex-1 bg-teal-600 text-white py-2 px-4 rounded-lg text-center font-semibold hover:bg-teal-700 transition-colors">
                            عرض التفاصيل
                        </a>
                        <button class="p-2 text-gray-400 hover:text-blue-500 transition-colors" title="تعديل">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-red-500 transition-colors" title="حذف">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if(count($myLands) === 0)
        <div class="text-center py-12">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-12">
                <i class="fas fa-list text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">لا توجد إعلانات</h3>
                <p class="text-gray-600 mb-6">ابدأ بنشر إعلانك الأول للحصول على عروض</p>
                <a href="{{ route('lands.create') }}" class="bg-gradient-to-r from-teal-600 to-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:from-teal-700 hover:to-blue-700 transition-all">
                    <i class="fas fa-plus ml-2"></i>
                    إضافة إعلان جديد
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
