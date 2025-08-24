@extends('layouts.app')

@section('title', __('projects.actions.create') . ' - insha\'at')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div>
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900">المشاريع</h1>
                    <p class="text-sm md:text-base text-gray-600">إدارة مشاريعك</p>
                </div>
                @if(auth()->user()->isClient())
                <div class="flex space-x-2 space-x-reverse">
                    <a href="{{ route('projects.create') }}" class="bg-teal-600 text-white px-4 py-2 rounded-lg text-sm md:text-base hover:bg-teal-700 transition duration-200">
                        <i class="fas fa-plus ml-1"></i>
                        مشروع جديد
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Projects List -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @if($projects->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                @foreach($projects as $project)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition duration-200">
                    <!-- Project Header -->
                    <div class="p-4 border-b border-gray-100">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-semibold text-gray-900 line-clamp-2">{{ $project->title }}</h3>
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                @if($project->status === 'draft') bg-gray-100 text-gray-800
                                @elseif($project->status === 'published') bg-blue-100 text-blue-800
                                @elseif($project->status === 'consultant_selected') bg-purple-100 text-purple-800
                                @elseif($project->status === 'design_ready') bg-green-100 text-green-800
                                @elseif($project->status === 'contractor_bidding') bg-orange-100 text-orange-800
                                @elseif($project->status === 'contractor_selected') bg-yellow-100 text-yellow-800
                                @elseif($project->status === 'supplier_bidding') bg-red-100 text-red-800
                                @elseif($project->status === 'supplier_selected') bg-indigo-100 text-indigo-800
                                @elseif($project->status === 'in_progress') bg-teal-100 text-teal-800
                                @elseif($project->status === 'completed') bg-emerald-100 text-emerald-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ __('projects.status.' . $project->status) }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 line-clamp-2">{{ Str::limit($project->description, 100) }}</p>
                    </div>

                    <!-- Project Details -->
                    <div class="p-4">
                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div>
                                <span class="text-gray-500">النوع:</span>
                                <span class="font-medium">{{ __('projects.property_types.' . $project->property_type) }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">النمط:</span>
                                <span class="font-medium">{{ __('projects.styles.' . $project->style) }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">المساحة:</span>
                                <span class="font-medium">{{ $project->area }} م²</span>
                            </div>
                            <div>
                                <span class="text-gray-500">الموقع:</span>
                                <span class="font-medium">{{ $project->location }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">الغرف:</span>
                                <span class="font-medium">{{ $project->total_rooms }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">التشطيب:</span>
                                <span class="font-medium">{{ $project->finishing_level_text }}</span>
                            </div>
                        </div>

                        <!-- Cost -->
                        <div class="mt-3 pt-3 border-t border-gray-100">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500 text-sm">التكلفة المقدرة:</span>
                                <span class="font-semibold text-lg text-teal-600">{{ number_format($project->estimated_cost) }} درهم</span>
                            </div>
                        </div>

                        <!-- Offers Count -->
                        @if($project->offers->count() > 0)
                        <div class="mt-3 pt-3 border-t border-gray-100">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500">عدد العروض:</span>
                                <span class="font-medium text-blue-600">{{ $project->offers->count() }}</span>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="px-4 pb-4">
                        <div class="flex space-x-2 space-x-reverse">
                            <a href="{{ route('projects.show', $project) }}" class="flex-1 bg-teal-600 text-white text-center py-2 px-3 rounded-lg text-sm hover:bg-teal-700 transition duration-200">
                                <i class="fas fa-eye ml-1"></i>
                                عرض التفاصيل
                            </a>

                            @if(auth()->user()->isClient() && $project->client_id === auth()->id())
                                @if($project->status === 'draft')
                                <form action="{{ route('projects.publish', $project) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-3 rounded-lg text-sm hover:bg-blue-700 transition duration-200">
                                        <i class="fas fa-paper-plane ml-1"></i>
                                        نشر
                                    </button>
                                </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($projects->hasPages())
            <div class="mt-8">
                {{ $projects->links() }}
            </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-folder-open text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">لا توجد مشاريع</h3>
                <p class="text-gray-600 mb-6">ابدأ بإنشاء مشروعك الأول</p>
                @if(auth()->user()->isClient())
                <a href="{{ route('projects.create') }}" class="bg-teal-600 text-white px-6 py-3 rounded-lg hover:bg-teal-700 transition duration-200">
                    <i class="fas fa-plus ml-1"></i>
                    إنشاء مشروع جديد
                </a>
                @endif
            </div>
        @endif
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

@media (max-width: 768px) {
    .grid {
        grid-template-columns: 1fr;
    }

    .text-xl {
        font-size: 1.125rem;
    }

    .text-lg {
        font-size: 1rem;
    }

    .px-4 {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }

    .py-4 {
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }
}

@media (max-width: 480px) {
    .px-4 {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }

    .py-4 {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }

    .text-sm {
        font-size: 0.75rem;
    }

    .text-xs {
        font-size: 0.625rem;
    }
}
</style>
@endsection
