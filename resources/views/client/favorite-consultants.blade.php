@extends('layouts.app')

@section('title', 'الاستشاريين المفضلين - insha\'at')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">الاستشاريين المفضلين</h1>
            <p class="text-gray-600">إدارة قائمة الاستشاريين المفضلين لديك</p>
        </div>

        @if(count($favoriteConsultants) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($favoriteConsultants as $consultant)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-2xl text-gray-600"></i>
                                    </div>
                                </div>
                                <div class="mr-4">
                                    <h3 class="text-lg font-medium text-gray-900">{{ $consultant['name'] }}</h3>
                                    <p class="text-sm text-gray-500">{{ $consultant['specialization'] }}</p>
                                </div>
                            </div>

                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-star text-yellow-400 ml-2"></i>
                                    <span>{{ $consultant['rating'] }}/5</span>
                                    <span class="text-gray-400 mr-2">({{ $consultant['reviews_count'] }} تقييم)</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-project-diagram text-blue-500 ml-2"></i>
                                    <span>{{ $consultant['projects_count'] }} مشروع مكتمل</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-map-marker-alt text-red-500 ml-2"></i>
                                    <span>{{ $consultant['location'] }}</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-lg font-semibold text-teal-600">{{ $consultant['hourly_rate'] }} درهم/ساعة</span>
                                <div class="flex space-x-2 space-x-reverse">
                                    <button class="text-teal-600 hover:text-teal-700">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-700">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="mx-auto h-24 w-24 text-gray-300 mb-4">
                    <i class="fas fa-heart text-6xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">لا توجد استشاريين مفضلين</h3>
                <p class="text-gray-500 mb-6">ابدأ بإضافة الاستشاريين الذين تفضل العمل معهم</p>
                <a href="#" class="btn-primary">
                    <i class="fas fa-search ml-2"></i>
                    استعرض الاستشاريين
                </a>
            </div>
        @endif
    </div>
</div>

<style>
.btn-primary {
    @apply inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500;
}
</style>
@endsection
