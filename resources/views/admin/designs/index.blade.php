@extends('layouts.admin')

@section('title', 'إدارة التصاميم - انشاءات')
@section('page-title', 'إدارة التصاميم')

@section('content')
    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">إدارة التصاميم</h1>
                <p class="text-gray-600">إدارة جميع التصاميم في المنصة</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="admin-card p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">البحث</label>
                    <input type="text" id="searchInput" placeholder="ابحث بالعنوان أو الوصف..."
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الاستشاري</label>
                    <select id="consultantFilter"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">جميع الاستشاريين</option>
                        @foreach ($designs->pluck('consultant.name')->unique() as $consultantName)
                            <option value="{{ $consultantName }}">{{ $consultantName }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الحالة</label>
                    <select id="statusFilter"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">جميع الحالات</option>
                        <option value="published">منشور</option>
                        <option value="unpublished">غير منشور</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button onclick="applyFilters()" class="admin-btn admin-btn-primary w-full">
                        <i class="fas fa-search"></i>
                        تطبيق البحث
                    </button>
                </div>
            </div>
        </div>

        <!-- Designs Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($designs as $design)
                <div class="admin-card overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <!-- Design Image -->
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $design->main_image_url }}" alt="{{ $design->title }}"
                            class="w-full h-full object-cover">
                        <div class="absolute top-4 left-4">
                            @if ($design->is_published)
                                <span class="status-badge status-published">منشور</span>
                            @else
                                <span class="status-badge status-pending">غير منشور</span>
                            @endif
                        </div>
                        <div class="absolute top-4 right-4">
                            <span class="bg-black/50 text-white px-2 py-1 rounded text-sm">
                                {{ $design->formatted_price }}
                            </span>
                        </div>
                    </div>

                    <!-- Design Content -->
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $design->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $design->description }}</p>

                        <!-- Design Details -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="text-center">
                                <p class="text-sm text-gray-500">المساحة</p>
                                <p class="font-semibold text-gray-900">{{ $design->formatted_area }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-gray-500">النمط</p>
                                <p class="font-semibold text-gray-900">{{ $design->style }}</p>
                            </div>
                        </div>

                        <!-- Consultant Info -->
                        <div class="flex items-center mb-4">
                            <div
                                class="w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-bold text-sm ml-3">
                                {{ substr($design->consultant->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 text-sm">{{ $design->consultant->name }}</p>
                                <p class="text-xs text-gray-500">استشاري</p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center gap-2">
                            <a href="{{ route('designs.show', $design->id) }}"
                                class="admin-btn admin-btn-primary flex-1 text-center text-sm">
                                <i class="fas fa-eye"></i>
                                عرض
                            </a>

                            <form action="{{ route('admin.designs.toggle-status', $design) }}" method="POST"
                                class="flex-1">
                                @csrf
                                <button type="submit"
                                    class="admin-btn {{ $design->is_published ? 'admin-btn-warning' : 'admin-btn-success' }} w-full text-sm">
                                    <i class="fas {{ $design->is_published ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    {{ $design->is_published ? 'إخفاء' : 'نشر' }}
                                </button>
                            </form>

                            <form action="{{ route('admin.designs.delete', $design) }}" method="POST" class="delete-btn">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-btn admin-btn-danger text-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="admin-card p-12 text-center">
                        <i class="fas fa-drafting-compass text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">لا يوجد تصاميم</h3>
                        <p class="text-gray-500">لم يتم إضافة أي تصاميم بعد</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($designs->hasPages())
            <div class="flex justify-center">
                {{ $designs->links() }}
            </div>
        @endif
    </div>

    <script>
        function applyFilters() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const consultantFilter = document.getElementById('consultantFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;

            const cards = document.querySelectorAll('.grid > div');

            cards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                const description = card.querySelector('p').textContent.toLowerCase();
                const consultant = card.querySelector('.font-semibold').textContent.toLowerCase();
                const status = card.querySelector('.status-badge').textContent.toLowerCase();

                const matchesSearch = title.includes(searchTerm) || description.includes(searchTerm);
                const matchesConsultant = !consultantFilter || consultant.includes(consultantFilter);
                const matchesStatus = !statusFilter ||
                    (statusFilter === 'published' && status.includes('منشور')) ||
                    (statusFilter === 'unpublished' && status.includes('غير منشور'));

                if (matchesSearch && matchesConsultant && matchesStatus) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Real-time search
        document.getElementById('searchInput').addEventListener('input', applyFilters);
        document.getElementById('consultantFilter').addEventListener('change', applyFilters);
        document.getElementById('statusFilter').addEventListener('change', applyFilters);
    </script>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
