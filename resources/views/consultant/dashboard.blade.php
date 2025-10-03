@extends('layouts.app')

@section('title', 'لوحة تحكم الاستشاري - insha\'at')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">مرحباً، {{ Auth::user()->name }}</h1>
                        <p class="text-gray-600">إدارة مشاريعك الاستشارية</p>
                    </div>
                    <div class="flex space-x-3 space-x-reverse">
                        <a href="{{ route('consultant.portfolio') }}" class="btn-primary">
                            <i class="fas fa-images ml-2"></i>
                            معرض الأعمال
                        </a>
                        <a href="{{ route('consultant.profile') }}" class="btn-secondary">
                            <i class="fas fa-user ml-2"></i>
                            الملف الشخصي
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow duration-300">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-home text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="mr-4">
                            <p class="text-sm font-medium text-gray-600">التصاميم المنشأة</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['designs_created'] ?? 0 }}</p>
                            <p class="text-xs text-gray-500 mt-1">إجمالي التصاميم</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow duration-300">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-check-circle text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="mr-4">
                            <p class="text-sm font-medium text-gray-600">العروض المقبولة</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['accepted_proposals'] ?? 0 }}</p>
                            <p class="text-xs text-gray-500 mt-1">عروض تم قبولها</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow duration-300">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-money-bill-wave text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="mr-4">
                            <p class="text-sm font-medium text-gray-600">الأرباح الشهرية</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['monthly_earnings'] ?? 0) }}
                                ريال</p>
                            <p class="text-xs text-gray-500 mt-1">هذا الشهر</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow duration-300">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-star text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="mr-4">
                            <p class="text-sm font-medium text-gray-600">التقييم العام</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['average_rating'] ?? 0 }}/5</p>
                            <p class="text-xs text-gray-500 mt-1">تقييم العملاء</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Designs -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">التصاميم الحديثة</h3>
                        </div>
                        <div class="p-6">
                            @if (isset($recentDesigns) && count($recentDesigns) > 0)
                                <div class="space-y-4">
                                    @foreach ($recentDesigns as $design)
                                        <div
                                            class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0">
                                                    <div
                                                        class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center">
                                                        <i class="fas fa-home text-teal-600"></i>
                                                    </div>
                                                </div>
                                                <div class="mr-4">
                                                    <h4 class="text-sm font-medium text-gray-900">{{ $design['title'] }}
                                                    </h4>
                                                    <p class="text-sm text-gray-500">{{ $design['style'] }} -
                                                        {{ $design['area'] }}</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-3 space-x-reverse">
                                                <span
                                                    class="text-sm font-medium text-teal-600">{{ $design['price'] }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <i class="fas fa-home text-4xl text-gray-300 mb-4"></i>
                                    <p class="text-gray-500">لا توجد تصاميم حديثة</p>
                                    <a href="{{ route('designs.create') }}" class="btn-primary mt-4">
                                        <i class="fas fa-plus ml-2"></i>
                                        إنشاء تصميم جديد
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Recent Proposals -->
                    <div class="bg-white rounded-lg shadow mt-6">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">العروض الحديثة</h3>
                        </div>
                        <div class="p-6">
                            @if (isset($recentProposals) && count($recentProposals) > 0)
                                <div class="space-y-4">
                                    @foreach ($recentProposals as $proposal)
                                        <div
                                            class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0">
                                                    <div
                                                        class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                                        <i class="fas fa-file-alt text-blue-600"></i>
                                                    </div>
                                                </div>
                                                <div class="mr-4">
                                                    <h4 class="text-sm font-medium text-gray-900">
                                                        {{ $proposal['tender_title'] }}</h4>
                                                    <p class="text-sm text-gray-500">{{ $proposal['date'] }}</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-3 space-x-reverse">
                                                <span
                                                    class="text-sm font-medium text-blue-600">{{ $proposal['proposed_price'] }}</span>
                                                @if ($proposal['status'] === 'pending')
                                                    <span
                                                        class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                                        في الانتظار
                                                    </span>
                                                @elseif($proposal['status'] === 'accepted')
                                                    <span
                                                        class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                                        مقبول
                                                    </span>
                                                @elseif($proposal['status'] === 'rejected')
                                                    <span
                                                        class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                                                        مرفوض
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <i class="fas fa-file-alt text-4xl text-gray-300 mb-4"></i>
                                    <p class="text-gray-500">لا توجد عروض حديثة</p>
                                    <a href="{{ route('tenders.index') }}" class="btn-primary mt-4">
                                        <i class="fas fa-search ml-2"></i>
                                        تصفح المناقصات
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">إجراءات سريعة</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                <a href="{{ route('tenders.index') }}"
                                    class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-search text-blue-600 ml-3"></i>
                                    <span class="text-sm font-medium text-gray-900">تصفح المناقصات</span>
                                </a>

                                <a href="{{ route('proposals.index') }}"
                                    class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-file-alt text-green-600 ml-3"></i>
                                    <span class="text-sm font-medium text-gray-900">عروضي المقدمة</span>
                                </a>

                                <a href="{{ route('designs.create') }}"
                                    class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-plus text-teal-600 ml-3"></i>
                                    <span class="text-sm font-medium text-gray-900">إنشاء تصميم جديد</span>
                                </a>

                                <a href="{{ route('designs.index') }}"
                                    class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-home text-purple-600 ml-3"></i>
                                    <span class="text-sm font-medium text-gray-900">تصاميمي</span>
                                </a>

                                <a href="{{ route('consultant.portfolio') }}"
                                    class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-images text-orange-600 ml-3"></i>
                                    <span class="text-sm font-medium text-gray-900">معرض الأعمال</span>
                                </a>

                                <a href="{{ route('consultant.profile') }}"
                                    class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-user text-gray-600 ml-3"></i>
                                    <span class="text-sm font-medium text-gray-900">تعديل الملف الشخصي</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Earnings -->
                    <div class="bg-white rounded-lg shadow mt-6">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">الأرباح الأخيرة</h3>
                        </div>
                        <div class="p-6">
                            @if (count($recentEarnings) > 0)
                                <div class="space-y-4">
                                    @foreach ($recentEarnings as $earning)
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $earning['tender'] }}</p>
                                                <p class="text-sm text-gray-500">{{ $earning['date'] }}</p>
                                            </div>
                                            <span class="text-sm font-semibold text-green-600">{{ $earning['amount'] }}
                                                ريال</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <p class="text-gray-500 text-sm">لا توجد أرباح حديثة</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .btn-primary {
            @apply inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500;
        }

        .btn-secondary {
            @apply inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500;
        }
    </style>
@endsection
