@extends('layouts.app')

@section('title', 'العروض المقدمة - insha\'at')

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
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">العروض المقدمة</h1>
                    <p class="text-gray-600">إدارة العروض المقدمة على مشاريعك</p>
                </div>
                <div class="flex space-x-3 space-x-reverse">
                    <a href="{{ route('client.dashboard') }}" class="btn-secondary">
                        <i class="fas fa-arrow-right ml-2"></i>
                        العودة للداشبورد
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">إجمالي العروض</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_offers'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-check text-white"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">العروض المقبولة</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['accepted_offers'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-clock text-white"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">في الانتظار</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['pending_offers'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-red-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-times text-white"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">مرفوضة</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['rejected_offers'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if($projectsWithOffers->count() > 0)
            <div class="space-y-8">
                @foreach($projectsWithOffers as $projectData)
                    @php
                        $project = $projectData['project'];
                        $consultantOffers = $projectData['consultant_offers'];
                        $contractorOffers = $projectData['contractor_offers'];
                        $supplierOffers = $projectData['supplier_offers'];
                    @endphp

                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <!-- Project Header -->
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">{{ $project->title }}</h3>
                                    <p class="text-sm text-gray-500">{{ $project->location }}</p>
                                </div>
                                <div class="flex items-center space-x-3 space-x-reverse">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($project->status === 'published') bg-green-100 text-green-800
                                        @elseif($project->status === 'completed') bg-blue-100 text-blue-800
                                        @elseif($project->status === 'draft') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        @if($project->status === 'published') منشور
                                        @elseif($project->status === 'completed') مكتمل
                                        @elseif($project->status === 'draft') مسودة
                                        @else {{ $project->status }} @endif
                                    </span>
                                    <a href="{{ route('projects.show', $project) }}" class="text-teal-600 hover:text-teal-700 text-sm">
                                        عرض المشروع
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Offers Content -->
                        <div class="p-6">
                            <!-- Consultant Offers -->
                            @if($consultantOffers->count() > 0)
                                <div class="mb-8">
                                    <div class="flex items-center justify-between mb-4">
                                        <h4 class="text-lg font-medium text-gray-900">
                                            <i class="fas fa-user-tie text-blue-600 ml-2"></i>
                                            عروض الاستشاريين
                                            <span class="text-sm text-gray-500">({{ $consultantOffers->count() }} عرض)</span>
                                        </h4>
                                        @if($projectData['has_accepted_consultant'])
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check ml-1"></i>
                                                تم اختيار استشاري
                                            </span>
                                        @endif
                                    </div>

                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                        @foreach($consultantOffers as $offer)
                                            <div class="border border-gray-200 rounded-lg p-4 @if($offer->status === 'accepted') bg-green-50 border-green-200 @elseif($offer->status === 'rejected') bg-red-50 border-red-200 @else bg-gray-50 @endif">
                                                <div class="flex items-start justify-between mb-3">
                                                    <div class="flex items-center">
                                                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                            <i class="fas fa-user-tie text-blue-600"></i>
                                                        </div>
                                                        <div class="mr-3">
                                                            <h5 class="font-medium text-gray-900">{{ $offer->professional->name ?? 'غير محدد' }}</h5>
                                                            <p class="text-sm text-gray-500">{{ $offer->professional->userType->display_name_ar ?? 'استشاري' }}</p>
                                                        </div>
                                                    </div>
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                        @if($offer->status === 'accepted') bg-green-100 text-green-800
                                                        @elseif($offer->status === 'rejected') bg-red-100 text-red-800
                                                        @else bg-yellow-100 text-yellow-800 @endif">
                                                        @if($offer->status === 'accepted') مقبول
                                                        @elseif($offer->status === 'rejected') مرفوض
                                                        @else في الانتظار @endif
                                                    </span>
                                                </div>

                                                <div class="space-y-2 text-sm">
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-600">السعر:</span>
                                                        <span class="font-medium">{{ number_format($offer->price) }} ريال</span>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-600">المدة:</span>
                                                        <span class="font-medium">{{ $offer->duration }} يوم</span>
                                                    </div>
                                                    @if($offer->description)
                                                        <div class="mt-3">
                                                            <p class="text-gray-600 text-xs">{{ Str::limit($offer->description, 100) }}</p>
                                                        </div>
                                                    @endif
                                                </div>

                                                @if($offer->status === 'pending')
                                                    <div class="mt-4 flex space-x-2 space-x-reverse">
                                                        <form action="{{ route('projects.select-consultant', ['project' => $project, 'offer' => $offer]) }}" method="POST" class="inline">
                                                            @csrf
                                                            <button type="submit" class="px-3 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                                                قبول العرض
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('offers.respond', $offer) }}" method="POST" class="inline">
                                                            @csrf
                                                            <input type="hidden" name="response" value="reject">
                                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700">
                                                                رفض العرض
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Contractor Offers -->
                            @if($contractorOffers->count() > 0)
                                <div class="mb-8">
                                    <div class="flex items-center justify-between mb-4">
                                        <h4 class="text-lg font-medium text-gray-900">
                                            <i class="fas fa-hard-hat text-orange-600 ml-2"></i>
                                            عروض المقاولين
                                            <span class="text-sm text-gray-500">({{ $contractorOffers->count() }} عرض)</span>
                                        </h4>
                                        @if($projectData['has_accepted_contractor'])
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check ml-1"></i>
                                                تم اختيار مقاول
                                            </span>
                                        @endif
                                    </div>

                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                        @foreach($contractorOffers as $offer)
                                            <div class="border border-gray-200 rounded-lg p-4 @if($offer->status === 'accepted') bg-green-50 border-green-200 @elseif($offer->status === 'rejected') bg-red-50 border-red-200 @else bg-gray-50 @endif">
                                                <div class="flex items-start justify-between mb-3">
                                                    <div class="flex items-center">
                                                        <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                                            <i class="fas fa-hard-hat text-orange-600"></i>
                                                        </div>
                                                        <div class="mr-3">
                                                            <h5 class="font-medium text-gray-900">{{ $offer->professional->name ?? 'غير محدد' }}</h5>
                                                            <p class="text-sm text-gray-500">{{ $offer->professional->userType->display_name_ar ?? 'مقاول' }}</p>
                                                        </div>
                                                    </div>
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                        @if($offer->status === 'accepted') bg-green-100 text-green-800
                                                        @elseif($offer->status === 'rejected') bg-red-100 text-red-800
                                                        @else bg-yellow-100 text-yellow-800 @endif">
                                                        @if($offer->status === 'accepted') مقبول
                                                        @elseif($offer->status === 'rejected') مرفوض
                                                        @else في الانتظار @endif
                                                    </span>
                                                </div>

                                                <div class="space-y-2 text-sm">
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-600">السعر:</span>
                                                        <span class="font-medium">{{ number_format($offer->price) }} ريال</span>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-600">المدة:</span>
                                                        <span class="font-medium">{{ $offer->duration }} يوم</span>
                                                    </div>
                                                    @if($offer->description)
                                                        <div class="mt-3">
                                                            <p class="text-gray-600 text-xs">{{ Str::limit($offer->description, 100) }}</p>
                                                        </div>
                                                    @endif
                                                </div>

                                                @if($offer->status === 'pending')
                                                    <div class="mt-4 flex space-x-2 space-x-reverse">
                                                        <form action="{{ route('projects.select-contractor', ['project' => $project, 'offer' => $offer]) }}" method="POST" class="inline">
                                                            @csrf
                                                            <button type="submit" class="px-3 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                                                قبول العرض
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('offers.respond', $offer) }}" method="POST" class="inline">
                                                            @csrf
                                                            <input type="hidden" name="response" value="reject">
                                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700">
                                                                رفض العرض
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Supplier Offers -->
                            @if($supplierOffers->count() > 0)
                                <div class="mb-8">
                                    <div class="flex items-center justify-between mb-4">
                                        <h4 class="text-lg font-medium text-gray-900">
                                            <i class="fas fa-truck text-purple-600 ml-2"></i>
                                            عروض الموردين
                                            <span class="text-sm text-gray-500">({{ $supplierOffers->count() }} عرض)</span>
                                        </h4>
                                        @if($projectData['has_accepted_supplier'])
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check ml-1"></i>
                                                تم اختيار مورد
                                            </span>
                                        @endif
                                    </div>

                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                        @foreach($supplierOffers as $offer)
                                            <div class="border border-gray-200 rounded-lg p-4 @if($offer->status === 'accepted') bg-green-50 border-green-200 @elseif($offer->status === 'rejected') bg-red-50 border-red-200 @else bg-gray-50 @endif">
                                                <div class="flex items-start justify-between mb-3">
                                                    <div class="flex items-center">
                                                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                                            <i class="fas fa-truck text-purple-600"></i>
                                                        </div>
                                                        <div class="mr-3">
                                                            <h5 class="font-medium text-gray-900">{{ $offer->professional->name ?? 'غير محدد' }}</h5>
                                                            <p class="text-sm text-gray-500">{{ $offer->professional->userType->display_name_ar ?? 'مورد' }}</p>
                                                        </div>
                                                    </div>
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                        @if($offer->status === 'accepted') bg-green-100 text-green-800
                                                        @elseif($offer->status === 'rejected') bg-red-100 text-red-800
                                                        @else bg-yellow-100 text-yellow-800 @endif">
                                                        @if($offer->status === 'accepted') مقبول
                                                        @elseif($offer->status === 'rejected') مرفوض
                                                        @else في الانتظار @endif
                                                    </span>
                                                </div>

                                                <div class="space-y-2 text-sm">
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-600">السعر:</span>
                                                        <span class="font-medium">{{ number_format($offer->price) }} ريال</span>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-600">المدة:</span>
                                                        <span class="font-medium">{{ $offer->duration }} يوم</span>
                                                    </div>
                                                    @if($offer->description)
                                                        <div class="mt-3">
                                                            <p class="text-gray-600 text-xs">{{ Str::limit($offer->description, 100) }}</p>
                                                        </div>
                                                    @endif
                                                </div>

                                                @if($offer->status === 'pending')
                                                    <div class="mt-4 flex space-x-2 space-x-reverse">
                                                        <form action="{{ route('projects.select-supplier', ['project' => $project, 'offer' => $offer]) }}" method="POST" class="inline">
                                                            @csrf
                                                            <button type="submit" class="px-3 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                                                قبول العرض
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('offers.respond', $offer) }}" method="POST" class="inline">
                                                            @csrf
                                                            <input type="hidden" name="response" value="reject">
                                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700">
                                                                رفض العرض
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- No Offers Message -->
                            @if($consultantOffers->count() === 0 && $contractorOffers->count() === 0 && $supplierOffers->count() === 0)
                                <div class="text-center py-8">
                                    <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                                    <p class="text-gray-500">لا توجد عروض مقدمة على هذا المشروع بعد</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-file-alt text-6xl text-gray-300 mb-6"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">لا توجد عروض</h3>
                <p class="text-gray-500 mb-6">لم يتم تقديم أي عروض على مشاريعك بعد</p>
                <a href="{{ route('client.projects') }}" class="btn-primary">
                    <i class="fas fa-project-diagram ml-2"></i>
                    عرض مشاريعك
                </a>
            </div>
        @endif
    </div>
</div>
@endif
@endsection
