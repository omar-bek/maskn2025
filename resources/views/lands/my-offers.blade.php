@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-50 to-blue-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">العروض المقدمة</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                إدارة العروض المقدمة على أراضيك والرد عليها
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
                        <i class="fas fa-handshake text-2xl text-teal-600"></i>
                    </div>
                    <div class="mr-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $offers->count() }}</h3>
                        <p class="text-gray-600">عرض إجمالي</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 rounded-lg">
                        <i class="fas fa-clock text-2xl text-yellow-600"></i>
                    </div>
                    <div class="mr-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $offers->where('status', 'معلق')->count() }}</h3>
                        <p class="text-gray-600">في انتظار الرد</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <i class="fas fa-check text-2xl text-green-600"></i>
                    </div>
                    <div class="mr-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $offers->where('status', 'مقبول')->count() }}</h3>
                        <p class="text-gray-600">مقبول</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 rounded-lg">
                        <i class="fas fa-times text-2xl text-red-600"></i>
                    </div>
                    <div class="mr-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $offers->where('status', 'مرفوض')->count() }}</h3>
                        <p class="text-gray-600">مرفوض</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Bar -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <h2 class="text-xl font-bold text-gray-900">العروض المقدمة</h2>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 bg-teal-600 text-white rounded-lg text-sm font-medium hover:bg-teal-700 transition-colors">
                            الكل
                        </button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                            في انتظار الرد
                        </button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                            مقبول
                        </button>
                        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                            مرفوض
                        </button>
                    </div>
                </div>

                <a href="{{ route('lands.my-ads') }}" class="bg-gradient-to-r from-teal-600 to-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-teal-700 hover:to-blue-700 transition-all transform hover:scale-105">
                    <i class="fas fa-list ml-2"></i>
                    عرض إعلاناتي
                </a>
            </div>
        </div>

        <!-- Offers List -->
        <div class="space-y-6">
            @foreach($offers as $offer)
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="p-6">
                    <div class="flex flex-col lg:flex-row gap-6">
                        <!-- Land Image -->
                        <div class="lg:w-1/4">
                            <div class="relative h-48 lg:h-32 bg-gradient-to-br from-teal-400 to-blue-500 rounded-lg overflow-hidden">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <i class="fas fa-map text-4xl text-white opacity-20"></i>
                                </div>
                                <div class="absolute top-2 right-2">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                                        {{ $offer['status'] === 'معلق' ? 'bg-yellow-100 text-yellow-800' :
                                           ($offer['status'] === 'مقبول' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $offer['status'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Offer Details -->
                        <div class="lg:w-3/4">
                            <div class="flex flex-col lg:flex-row justify-between items-start gap-4 mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $offer['land_title'] }}</h3>
                                    <div class="flex items-center gap-4 text-sm text-gray-600">
                                        <span class="flex items-center">
                                            <i class="fas fa-user text-teal-500 ml-1"></i>
                                            {{ $offer['offerer_name'] }}
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-calendar text-blue-500 ml-1"></i>
                                            {{ $offer['created_at'] }}
                                        </span>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <div class="text-lg font-bold text-teal-600">{{ $offer['offer_price'] }}</div>
                                    <div class="text-sm text-gray-500">{{ $offer['offer_type'] }}</div>
                                </div>
                            </div>

                            <!-- Offer Message -->
                            <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                <p class="text-gray-700">{{ $offer['offer_message'] }}</p>
                            </div>

                            <!-- Contact Info -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-phone text-green-500 ml-2"></i>
                                    <span>{{ $offer['offerer_phone'] }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-envelope text-blue-500 ml-2"></i>
                                    <span>{{ $offer['offerer_email'] }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-clock text-purple-500 ml-2"></i>
                                    <span>{{ $offer['created_at'] }}</span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex flex-wrap gap-2">
                                @if($offer['status'] === 'معلق')
                                <button class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition-colors">
                                    <i class="fas fa-check ml-1"></i>
                                    قبول العرض
                                </button>
                                <button class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors">
                                    <i class="fas fa-times ml-1"></i>
                                    رفض العرض
                                </button>
                                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-comment ml-1"></i>
                                    رد على العرض
                                </button>
                                @else
                                <span class="px-4 py-2 rounded-lg text-sm font-semibold
                                    {{ $offer['status'] === 'مقبول' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $offer['status'] }}
                                </span>
                                @endif

                                <a href="{{ route('lands.show', $offer['land_id']) }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-700 transition-colors">
                                    <i class="fas fa-eye ml-1"></i>
                                    عرض الأرض
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if(count($offers) === 0)
        <div class="text-center py-12">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-12">
                <i class="fas fa-handshake text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">لا توجد عروض</h3>
                <p class="text-gray-600 mb-6">لم يتم تقديم أي عروض على أراضيك بعد</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('lands.create') }}" class="bg-gradient-to-r from-teal-600 to-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:from-teal-700 hover:to-blue-700 transition-all">
                        <i class="fas fa-plus ml-2"></i>
                        إضافة إعلان جديد
                    </a>
                    <a href="{{ route('lands.index') }}" class="bg-gray-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-700 transition-all">
                        <i class="fas fa-search ml-2"></i>
                        تصفح الأراضي
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
