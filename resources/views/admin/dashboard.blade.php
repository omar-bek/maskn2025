@extends('layouts.app')

@section('title', 'لوحة تحكم المدير - insha\'at')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">مرحباً، {{ Auth::user()->name }}</h1>
                    <p class="text-gray-600">إدارة النظام والمراقبة</p>
                </div>
                <div class="flex space-x-3 space-x-reverse">
                    <a href="{{ route('admin.users') }}" class="btn-primary">
                        <i class="fas fa-users ml-2"></i>
                        إدارة المستخدمين
                    </a>
                    <a href="{{ route('admin.user-types') }}" class="btn-secondary">
                        <i class="fas fa-cog ml-2"></i>
                        إعدادات النظام
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-users text-white"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">إجمالي المستخدمين</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_users'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-project-diagram text-white"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">المشاريع النشطة</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['active_projects'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-handshake text-white"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">العروض المقدمة</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_offers'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-orange-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-chart-line text-white"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">النشاط اليومي</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['daily_activity'] ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- User Statistics -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">إحصائيات المستخدمين</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-user text-blue-600 ml-2"></i>
                                        <span class="text-sm font-medium text-gray-900">العملاء</span>
                                    </div>
                                    <span class="text-lg font-semibold text-blue-600">{{ $userStats['clients'] ?? 0 }}</span>
                                </div>

                                <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-user-tie text-green-600 ml-2"></i>
                                        <span class="text-sm font-medium text-gray-900">الاستشاريين</span>
                                    </div>
                                    <span class="text-lg font-semibold text-green-600">{{ $userStats['consultants'] ?? 0 }}</span>
                                </div>

                                <div class="flex items-center justify-between p-3 bg-orange-50 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-hard-hat text-orange-600 ml-2"></i>
                                        <span class="text-sm font-medium text-gray-900">المقاولين</span>
                                    </div>
                                    <span class="text-lg font-semibold text-orange-600">{{ $userStats['contractors'] ?? 0 }}</span>
                                </div>

                                <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-box text-purple-600 ml-2"></i>
                                        <span class="text-sm font-medium text-gray-900">الموردين</span>
                                    </div>
                                    <span class="text-lg font-semibold text-purple-600">{{ $userStats['suppliers'] ?? 0 }}</span>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="text-center">
                                    <h4 class="text-sm font-medium text-gray-900 mb-2">المستخدمين الجدد هذا الشهر</h4>
                                    <div class="text-3xl font-bold text-teal-600">{{ $userStats['new_users_this_month'] ?? 0 }}</div>
                                </div>

                                <div class="text-center">
                                    <h4 class="text-sm font-medium text-gray-900 mb-2">المستخدمين النشطين</h4>
                                    <div class="text-3xl font-bold text-green-600">{{ $userStats['active_users'] ?? 0 }}</div>
                                </div>

                                <div class="text-center">
                                    <h4 class="text-sm font-medium text-gray-900 mb-2">المستخدمين المعلقين</h4>
                                    <div class="text-3xl font-bold text-red-600">{{ $userStats['suspended_users'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>
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
                            <a href="{{ route('admin.users') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-users text-blue-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">إدارة المستخدمين</span>
                            </a>

                            <a href="{{ route('admin.user-types') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-user-tag text-green-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">أنواع المستخدمين</span>
                            </a>

                            <a href="#" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-chart-bar text-purple-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">التقارير</span>
                            </a>

                            <a href="#" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-cog text-orange-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">إعدادات النظام</span>
                            </a>

                            <a href="#" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-shield-alt text-red-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">الأمان</span>
                            </a>

                            <a href="#" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-database text-gray-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">النسخ الاحتياطية</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- System Status -->
                <div class="bg-white rounded-lg shadow mt-6">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">حالة النظام</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-green-500 rounded-full ml-2"></div>
                                    <span class="text-sm text-gray-900">الخادم</span>
                                </div>
                                <span class="text-sm text-green-600">متصل</span>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-green-500 rounded-full ml-2"></div>
                                    <span class="text-sm text-gray-900">قاعدة البيانات</span>
                                </div>
                                <span class="text-sm text-green-600">متصل</span>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-green-500 rounded-full ml-2"></div>
                                    <span class="text-sm text-gray-900">التخزين</span>
                                </div>
                                <span class="text-sm text-green-600">متاح</span>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-yellow-500 rounded-full ml-2"></div>
                                    <span class="text-sm text-gray-900">الذاكرة</span>
                                </div>
                                <span class="text-sm text-yellow-600">75%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-lg shadow mt-6">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">النشاطات الأخيرة</h3>
                    </div>
                    <div class="p-6">
                        @if(count($recentActivity) > 0)
                            <div class="space-y-4">
                                @foreach($recentActivity as $activity)
                                    <div class="flex items-start space-x-3 space-x-reverse">
                                        <div class="flex-shrink-0">
                                            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
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
                            <div class="text-center py-4">
                                <p class="text-gray-500 text-sm">لا توجد نشاطات حديثة</p>
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
