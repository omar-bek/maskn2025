@extends('layouts.app')

@section('title', 'التصميمات المحفوظة - insha\'at')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">التصميمات المحفوظة</h1>
            <p class="text-gray-600">إدارة التصميمات التي قمت بحفظها</p>
        </div>

        @if(count($savedDesigns) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($savedDesigns as $design)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                            <img src="{{ $design['image'] ?? '/images/placeholder.jpg' }}" alt="{{ $design['title'] }}" class="w-full h-48 object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $design['title'] }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ $design['description'] }}</p>

                            <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                <span>{{ $design['style'] }}</span>
                                <span>{{ $design['area'] }} متر مربع</span>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-lg font-semibold text-teal-600">{{ $design['price'] }} ريال</span>
                                <div class="flex space-x-2 space-x-reverse">
                                    <button class="text-teal-600 hover:text-teal-700">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
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
                    <i class="fas fa-bookmark text-6xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">لا توجد تصميمات محفوظة</h3>
                <p class="text-gray-500 mb-6">ابدأ بحفظ التصميمات التي تعجبك لمراجعتها لاحقاً</p>
                <a href="{{ route('designs.index') }}" class="btn-primary">
                    <i class="fas fa-search ml-2"></i>
                    استعرض التصميمات
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
