@extends('layouts.app')

@section('title', 'لوحة تحكم العميل - insha\'at')

@section('content')
@if(!Auth::user()->isClient())
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
                    <p class="text-gray-600">إدارة مشاريعك وتصميماتك</p>
                </div>
                <div class="flex space-x-3 space-x-reverse">
                    <a href="{{ route('client.projects') }}" class="btn-primary">
                        <i class="fas fa-project-diagram ml-2"></i>
                        إدارة المشاريع
                    </a>
                    <a href="{{ route('projects.create') }}" class="btn-secondary">
                        <i class="fas fa-plus ml-2"></i>
                        مشروع جديد
                    </a>
                    <a href="{{ route('cost-calculator.index') }}" class="btn-secondary">
                        <i class="fas fa-calculator ml-2"></i>
                        حساب التكلفة
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
                        <p class="text-sm font-medium text-gray-600">المشاريع الجارية</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['ongoing_projects'] }}</p>
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
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['completed_projects'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-heart text-white"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">الاستشاريين المفضلين</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['favorite_consultants'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-orange-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-bookmark text-white"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">التصميمات المحفوظة</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['saved_designs'] }}</p>
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
                        @if(count($recentActivities) > 0)
                            <div class="space-y-4">
                                @foreach($recentActivities as $activity)
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
                            <a href="{{ route('projects.create') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-plus text-teal-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">إنشاء مشروع جديد</span>
                            </a>

                            <a href="{{ route('cost-calculator.index') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-calculator text-blue-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">حساب تكلفة المشروع</span>
                            </a>

                            <a href="{{ route('client.saved-designs') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-bookmark text-purple-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">التصميمات المحفوظة</span>
                            </a>

                            <a href="{{ route('client.favorite-consultants') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-heart text-red-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">الاستشاريين المفضلين</span>
                            </a>

                            <a href="{{ route('client.projects') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-project-diagram text-green-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">جميع المشاريع</span>
                            </a>

                            <a href="{{ route('client.offers') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-file-alt text-blue-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">العروض المقدمة</span>
                            </a>

                            <a href="{{ route('client.profile') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
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
                        @if(count($recommendedConsultants) > 0)
                            <div class="space-y-4">
                                @foreach($recommendedConsultants as $consultant)
                                    <div class="flex items-center space-x-3 space-x-reverse">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-gray-600"></i>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900">{{ $consultant['name'] }}</p>
                                            <p class="text-sm text-gray-500">{{ $consultant['specialization'] }}</p>
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
