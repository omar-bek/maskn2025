@extends('layouts.app')

@section('title', 'مشاريعي - insha\'at')

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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">مشاريعي</h1>
                    <p class="text-gray-600">إدارة جميع مشاريعك</p>
                </div>
                <a href="{{ route('projects.create') }}" class="btn-primary">
                    <i class="fas fa-plus ml-2"></i>
                    مشروع جديد
                </a>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-project-diagram text-white"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">إجمالي المشاريع</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_projects'] }}</p>
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
                        <p class="text-sm font-medium text-gray-600">المشاريع المنشورة</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['published_projects'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-edit text-white"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">المشاريع المسودة</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['draft_projects'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-flag-checkered text-white"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">المشاريع المكتملة</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['completed_projects'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-6">
                <form method="GET" class="flex flex-wrap gap-4 items-center">
                    <!-- Search -->
                    <div class="flex-1 min-w-64">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="البحث في المشاريع..."
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500">
                    </div>

                    <!-- Status Filter -->
                    <select name="status" class="px-4 py-2 border border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500">
                        <option value="">جميع الحالات</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>منشور</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>مسودة</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>مكتمل</option>
                    </select>

                    <!-- Submit Button -->
                    <button type="submit" class="px-6 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700">
                        <i class="fas fa-search ml-2"></i>
                        بحث
                    </button>

                    <!-- Clear Filters -->
                    @if(request('search') || request('status'))
                        <a href="{{ route('client.projects') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                            <i class="fas fa-times ml-2"></i>
                            مسح الفلاتر
                        </a>
                    @endif
                </form>
            </div>
        </div>

        @if($projects->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @foreach($projects as $project)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">{{ $project->title }}</h3>
                                    <p class="text-sm text-gray-500">{{ $project->location }}</p>
                                </div>
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
                            </div>

                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-ruler-combined text-blue-500 ml-2"></i>
                                    <span>{{ $project->area }} متر مربع</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-money-bill-wave text-green-500 ml-2"></i>
                                    <span>{{ number_format($project->estimated_cost) }} ريال</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-home text-purple-500 ml-2"></i>
                                    <span>{{ $project->property_type == 'villa' ? 'فيلا' : ($project->property_type == 'apartment' ? 'شقة' : $project->property_type) }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-calendar text-orange-500 ml-2"></i>
                                    <span>{{ $project->created_at->format('Y-m-d') }}</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex space-x-2 space-x-reverse">
                                    <a href="{{ route('projects.show', $project->id) }}" class="text-teal-600 hover:text-teal-700" title="عرض المشروع">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('projects.edit', $project->id) }}" class="text-blue-600 hover:text-blue-700" title="تعديل المشروع">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="text-red-600 hover:text-red-700" title="حذف المشروع" onclick="deleteProject({{ $project->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <div class="text-sm text-gray-500">
                                    @if($project->selected_consultant_id)
                                        <span class="text-green-600">تم تعيين استشاري</span>
                                    @else
                                        <span class="text-yellow-600">في انتظار استشاري</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $projects->links() }}
            </div>
        @else

            <div class="text-center py-12">
                <div class="mx-auto h-24 w-24 text-gray-300 mb-4">
                    <i class="fas fa-project-diagram text-6xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">لا توجد مشاريع</h3>
                <p class="text-gray-500 mb-6">ابدأ بإنشاء مشروعك الأول</p>
                <a href="{{ route('projects.create') }}" class="btn-primary">
                    <i class="fas fa-plus ml-2"></i>
                    إنشاء مشروع جديد
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

<script>
function deleteProject(projectId) {
    if (confirm('هل أنت متأكد من حذف هذا المشروع؟')) {
        fetch(`/projects/${projectId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('حدث خطأ أثناء حذف المشروع');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('حدث خطأ أثناء حذف المشروع');
        });
    }
}
</script>
@endif
@endsection
