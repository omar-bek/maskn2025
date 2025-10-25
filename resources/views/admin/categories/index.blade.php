@extends('layouts.admin')

@section('title', 'إدارة الفئات - انشاءات')
@section('page-title', 'إدارة الفئات')

@section('content')
    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">إدارة الفئات</h1>
                <p class="text-gray-600">إدارة فئات بنود التصاميم</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="openCreateModal()" class="admin-btn admin-btn-primary">
                    <i class="fas fa-plus"></i>
                    إضافة فئة جديدة
                </button>
            </div>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($categories as $category)
                <div class="admin-card p-6 hover:shadow-lg transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-lg ml-4">
                                {{ substr($category->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">{{ $category->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $category->items_count }} بند</p>
                            </div>
                        </div>
                    </div>

                    @if ($category->description)
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $category->description }}</p>
                    @endif

                    <div class="flex items-center justify-between mb-4">
                        <div class="text-center">
                            <p class="text-sm text-gray-500">إجمالي السعر</p>
                            <p class="font-semibold text-gray-900">{{ number_format($category->getTotalPrice(), 2) }} درهم
                            </p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-gray-500">ترتيب العرض</p>
                            <p class="font-semibold text-gray-900">{{ $category->category_order ?? 'غير محدد' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button
                            onclick="openEditModal({{ $category->id }}, '{{ $category->name }}', '{{ $category->description }}', {{ $category->category_order ?? 0 }})"
                            class="admin-btn admin-btn-primary flex-1 text-sm">
                            <i class="fas fa-edit"></i>
                            تعديل
                        </button>

                        <form action="{{ route('admin.categories.delete', $category) }}" method="POST" class="delete-btn">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-btn admin-btn-danger text-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="admin-card p-12 text-center">
                        <i class="fas fa-tags text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">لا يوجد فئات</h3>
                        <p class="text-gray-500 mb-4">لم يتم إضافة أي فئات بعد</p>
                        <button onclick="openCreateModal()" class="admin-btn admin-btn-primary">
                            <i class="fas fa-plus"></i>
                            إضافة فئة جديدة
                        </button>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($categories->hasPages())
            <div class="flex justify-center">
                {{ $categories->links() }}
            </div>
        @endif
    </div>

    <!-- Create/Edit Modal -->
    <div id="categoryModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="admin-card max-w-md w-full">
            <div class="flex items-center justify-between mb-6">
                <h3 id="modalTitle" class="text-xl font-bold text-gray-900">إضافة فئة جديدة</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form id="categoryForm" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">اسم الفئة</label>
                        <input type="text" name="name" id="categoryName" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">الوصف</label>
                        <textarea name="description" id="categoryDescription" rows="3"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">ترتيب العرض</label>
                        <input type="number" name="category_order" id="categoryOrder" min="0"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="flex items-center gap-3 mt-6">
                    <button type="submit" class="admin-btn admin-btn-primary flex-1">
                        <i class="fas fa-save"></i>
                        حفظ
                    </button>
                    <button type="button" onclick="closeModal()" class="admin-btn admin-btn-secondary flex-1">
                        <i class="fas fa-times"></i>
                        إلغاء
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openCreateModal() {
            document.getElementById('modalTitle').textContent = 'إضافة فئة جديدة';
            document.getElementById('categoryForm').action = '{{ route('admin.categories.store') }}';
            document.getElementById('categoryForm').method = 'POST';
            document.getElementById('categoryName').value = '';
            document.getElementById('categoryDescription').value = '';
            document.getElementById('categoryOrder').value = '';
            document.getElementById('categoryModal').classList.remove('hidden');
        }

        function openEditModal(id, name, description, order) {
            document.getElementById('modalTitle').textContent = 'تعديل الفئة';
            document.getElementById('categoryForm').action = `{{ url('admin/categories') }}/${id}`;
            document.getElementById('categoryForm').method = 'POST';
            document.getElementById('categoryForm').innerHTML += '<input type="hidden" name="_method" value="PUT">';
            document.getElementById('categoryName').value = name;
            document.getElementById('categoryDescription').value = description;
            document.getElementById('categoryOrder').value = order;
            document.getElementById('categoryModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('categoryModal').classList.add('hidden');
            // Reset form
            document.getElementById('categoryForm').innerHTML = `
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">اسم الفئة</label>
                    <input type="text" name="name" id="categoryName" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الوصف</label>
                    <textarea name="description" id="categoryDescription" rows="3"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">ترتيب العرض</label>
                    <input type="number" name="category_order" id="categoryOrder" min="0"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="flex items-center gap-3 mt-6">
                <button type="submit" class="admin-btn admin-btn-primary flex-1">
                    <i class="fas fa-save"></i>
                    حفظ
                </button>
                <button type="button" onclick="closeModal()" class="admin-btn admin-btn-secondary flex-1">
                    <i class="fas fa-times"></i>
                    إلغاء
                </button>
            </div>
        `;
        }

        // Close modal when clicking outside
        document.getElementById('categoryModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
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
