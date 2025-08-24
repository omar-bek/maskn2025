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
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
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
                        <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-check-circle text-white"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">المشاريع المكتملة</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['completed_projects'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-money-bill-wave text-white"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">الأرباح الشهرية</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['monthly_earnings'] ?? 0) }} ريال</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-orange-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-star text-white"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">التقييم العام</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['average_rating'] ?? 0 }}/5</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent Projects -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">المشاريع الحديثة</h3>
                    </div>
                    <div class="p-6">
                        @if(count($recentProjects) > 0)
                            <div class="space-y-4">
                                @foreach($recentProjects as $project)
                                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-home text-teal-600"></i>
                                                </div>
                                            </div>
                                            <div class="mr-4">
                                                <h4 class="text-sm font-medium text-gray-900">{{ $project['title'] }}</h4>
                                                <p class="text-sm text-gray-500">{{ $project['location'] }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3 space-x-reverse">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($project['status'] === 'active') bg-green-100 text-green-800
                                                @elseif($project['status'] === 'completed') bg-blue-100 text-blue-800
                                                @else bg-yellow-100 text-yellow-800 @endif">
                                                {{ $project['status'] }}
                                            </span>
                                            <span class="text-sm font-medium text-teal-600">{{ $project['budget'] }} ريال</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-project-diagram text-4xl text-gray-300 mb-4"></i>
                                <p class="text-gray-500">لا توجد مشاريع حديثة</p>
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
                            <a href="{{ route('consultant.projects') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-project-diagram text-blue-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">جميع المشاريع</span>
                            </a>

                            <a href="{{ route('consultant.portfolio') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-images text-purple-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">معرض الأعمال</span>
                            </a>

                            <a href="{{ route('consultant.earnings') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-chart-line text-green-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">التقارير المالية</span>
                            </a>

                            <a href="{{ route('consultant.inquiries') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-envelope text-orange-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">الاستفسارات</span>
                            </a>

                            <a href="{{ route('consultant.profile') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
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
                        @if(count($recentEarnings) > 0)
                            <div class="space-y-4">
                                @foreach($recentEarnings as $earning)
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $earning['project'] }}</p>
                                            <p class="text-sm text-gray-500">{{ $earning['date'] }}</p>
                                        </div>
                                        <span class="text-sm font-semibold text-green-600">{{ $earning['amount'] }} ريال</span>
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
