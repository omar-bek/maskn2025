@extends('layouts.app')

@section('title', 'لوحة تحكم العميل - insha\'at')

@section('content')
    @if (!Auth::user()->isClient())
        <div class="min-h-screen bg-gray-50 flex items-center justify-center">
            <div class="text-center">
                <i class="fas fa-lock text-6xl text-red-500 mb-4"></i>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">غير مسموح</h1>
                <p class="text-gray-600 mb-4">هذه الصفحة متاحة للعملاء فقط</p>
                <a href="{{ Auth::user()->getDashboardRoute() }}" class="btn-primary">
                    العودة للداشبورد
                </a>
            </div>
        </div>
    @else
        <div class="min-h-screen bg-gray-50">
            <!-- Header -->
            <div class="bg-white shadow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center py-6">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">مرحباً، {{ Auth::user()->name }}</h1>
                            <p class="text-gray-600">إدارة مناقصاتك والعروض المقدمة</p>
                        </div>
                        <div class="flex space-x-3 space-x-reverse">
                            <a href="{{ route('tenders.create') }}" class="btn-primary">
                                <i class="fas fa-gavel ml-2"></i>
                                إنشاء مناقصة جديدة
                            </a>
                            <a href="{{ route('tenders.index') }}" class="btn-secondary">
                                <i class="fas fa-list ml-2"></i>
                                جميع المناقصات
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
                                    <i class="fas fa-gavel text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="mr-4">
                                <p class="text-sm font-medium text-gray-600">المناقصات المنشأة</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['tenders_created'] ?? 0 }}</p>
                                <p class="text-xs text-gray-500 mt-1">إجمالي المناقصات</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow duration-300">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-file-alt text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="mr-4">
                                <p class="text-sm font-medium text-gray-600">العروض المستلمة</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['proposals_received'] ?? 0 }}</p>
                                <p class="text-xs text-gray-500 mt-1">عروض من الاستشاريين</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow duration-300">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
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
                                    class="w-12 h-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-clock text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="mr-4">
                                <p class="text-sm font-medium text-gray-600">المناقصات النشطة</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['active_tenders'] ?? 0 }}</p>
                                <p class="text-xs text-gray-500 mt-1">مناقصات مفتوحة</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Recent Activities -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-lg shadow">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900">النشاطات الأخيرة</h3>
                            </div>
                            <div class="p-6">
                                @if (count($recentActivities) > 0)
                                    <div class="space-y-4">
                                        @foreach ($recentActivities as $activity)
                                            <div class="flex items-start space-x-3 space-x-reverse">
                                                <div class="flex-shrink-0">
                                                    <div
                                                        class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-info text-gray-600"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm text-gray-900">{{ $activity['description'] }}</p>
                                                    <p class="text-sm text-gray-500">{{ $activity['time'] }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-8">
                                        <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                                        <p class="text-gray-500">لا توجد نشاطات حديثة</p>
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
                                    <a href="{{ route('tenders.create') }}"
                                        class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                        <i class="fas fa-plus text-teal-600 ml-3"></i>
                                        <span class="text-sm font-medium text-gray-900">إنشاء مناقصة جديدة</span>
                                    </a>

                                    <a href="{{ route('client.my-tenders') }}"
                                        class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                        <i class="fas fa-list text-blue-600 ml-3"></i>
                                        <span class="text-sm font-medium text-gray-900">مناقصاتي</span>
                                    </a>

                                    <a href="{{ route('client.saved-designs') }}"
                                        class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                        <i class="fas fa-bookmark text-purple-600 ml-3"></i>
                                        <span class="text-sm font-medium text-gray-900">التصميمات المحفوظة</span>
                                    </a>

                                    <a href="{{ route('client.favorite-consultants') }}"
                                        class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                        <i class="fas fa-heart text-red-600 ml-3"></i>
                                        <span class="text-sm font-medium text-gray-900">الاستشاريين المفضلين</span>
                                    </a>

                                    <a href="{{ route('designs.index') }}"
                                        class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                        <i class="fas fa-home text-green-600 ml-3"></i>
                                        <span class="text-sm font-medium text-gray-900">تصفح التصاميم</span>
                                    </a>

                                    <a href="{{ route('client.profile') }}"
                                        class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                        <i class="fas fa-user text-gray-600 ml-3"></i>
                                        <span class="text-sm font-medium text-gray-900">تعديل الملف الشخصي</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Recommended Consultants -->
                        <div class="bg-white rounded-lg shadow mt-6">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900">استشاريون موصى بهم</h3>
                            </div>
                            <div class="p-6">
                                @if (count($recommendedConsultants) > 0)
                                    <div class="space-y-4">
                                        @foreach ($recommendedConsultants as $consultant)
                                            <div class="flex items-center space-x-3 space-x-reverse">
                                                <div class="flex-shrink-0">
                                                    <div
                                                        class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-user text-gray-600"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-900">{{ $consultant['name'] }}
                                                    </p>
                                                    <p class="text-sm text-gray-500">{{ $consultant['specialization'] }}
                                                    </p>
                                                </div>
                                                <button class="text-teal-600 hover:text-teal-700">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <p class="text-gray-500 text-sm">لا توجد توصيات حالياً</p>
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
    @endif
@endsection
