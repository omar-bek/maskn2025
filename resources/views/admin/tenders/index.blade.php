@extends('layouts.admin')

@section('title', 'إدارة المناقصات - انشاءات')
@section('page-title', 'إدارة المناقصات')

@section('content')
    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">إدارة المناقصات</h1>
                <p class="text-gray-600">إدارة جميع المناقصات في المنصة</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.tenders.export') }}" class="admin-btn admin-btn-secondary">
                    <i class="fas fa-download"></i>
                    تصدير Excel
                </a>
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
                    <label class="block text-sm font-medium text-gray-700 mb-2">العميل</label>
                    <select id="clientFilter"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">جميع العملاء</option>
                        @foreach ($tenders->pluck('client.name')->unique() as $clientName)
                            <option value="{{ $clientName }}">{{ $clientName }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الحالة</label>
                    <select id="statusFilter"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">جميع الحالات</option>
                        <option value="open">مفتوحة</option>
                        <option value="closed">مغلقة</option>
                        <option value="awarded">ممنوحة</option>
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

        <!-- Tenders Table -->
        <div class="admin-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="admin-table w-full">
                    <thead>
                        <tr>
                            <th>المناقصة</th>
                            <th>العميل</th>
                            <th>التصميم</th>
                            <th>الميزانية</th>
                            <th>آخر موعد</th>
                            <th>عدد العروض</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tenders as $tender)
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <img src="{{ $tender->design->main_image_url }}" alt="{{ $tender->title }}"
                                            class="w-12 h-12 rounded-lg object-cover ml-3">
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ Str::limit($tender->title, 30) }}</p>
                                            <p class="text-sm text-gray-500">{{ $tender->location }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center">
                                        <div
                                            class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm ml-3">
                                            {{ substr($tender->client->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $tender->client->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $tender->client->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="font-semibold text-gray-900">{{ Str::limit($tender->design->title, 25) }}</p>
                                    <p class="text-sm text-gray-500">{{ $tender->design->style }}</p>
                                </td>
                                <td>
                                    @if ($tender->budget)
                                        <p class="font-semibold text-gray-900">{{ $tender->formatted_budget }}</p>
                                    @else
                                        <p class="text-gray-500">غير محدد</p>
                                    @endif
                                </td>
                                <td>
                                    <p class="font-semibold text-gray-900">{{ $tender->formatted_deadline }}</p>
                                    @if ($tender->days_remaining !== null)
                                        <p
                                            class="text-sm {{ $tender->days_remaining > 7 ? 'text-green-600' : ($tender->days_remaining > 3 ? 'text-yellow-600' : 'text-red-600') }}">
                                            {{ $tender->days_remaining }} يوم متبقي
                                        </p>
                                    @endif
                                </td>
                                <td>
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-file-alt ml-1"></i>
                                        {{ $tender->proposals_count }} عرض
                                    </span>
                                </td>
                                <td>
                                    @if ($tender->status === 'open')
                                        <span class="status-badge status-open">مفتوحة</span>
                                    @elseif($tender->status === 'closed')
                                        <span class="status-badge status-closed">مغلقة</span>
                                    @elseif($tender->status === 'awarded')
                                        <span class="status-badge status-awarded">ممنوحة</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('tenders.show', $tender->id) }}"
                                            class="admin-btn admin-btn-primary text-sm">
                                            <i class="fas fa-eye"></i>
                                            عرض
                                        </a>

                                        @if ($tender->status === 'open')
                                            <form action="{{ route('admin.tenders.close', $tender) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                <button type="submit" class="admin-btn admin-btn-warning text-sm"
                                                    onclick="return confirm('هل أنت متأكد من إغلاق هذه المناقصة؟')">
                                                    <i class="fas fa-lock"></i>
                                                    إغلاق
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('admin.tenders.delete', $tender) }}" method="POST"
                                            class="inline delete-btn">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="admin-btn admin-btn-danger text-sm">
                                                <i class="fas fa-trash"></i>
                                                حذف
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-8 text-gray-500">
                                    <i class="fas fa-file-contract text-4xl mb-4 block"></i>
                                    لا يوجد مناقصات
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if ($tenders->hasPages())
            <div class="flex justify-center">
                {{ $tenders->links() }}
            </div>
        @endif
    </div>

    <script>
        function applyFilters() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const clientFilter = document.getElementById('clientFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;

            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const title = row.querySelector('td:first-child p:first-child').textContent.toLowerCase();
                const location = row.querySelector('td:first-child p:last-child').textContent.toLowerCase();
                const client = row.querySelector('td:nth-child(2) p:first-child').textContent.toLowerCase();
                const status = row.querySelector('td:nth-child(7) span').textContent.toLowerCase();

                const matchesSearch = title.includes(searchTerm) || location.includes(searchTerm);
                const matchesClient = !clientFilter || client.includes(clientFilter);
                const matchesStatus = !statusFilter ||
                    (statusFilter === 'open' && status.includes('مفتوحة')) ||
                    (statusFilter === 'closed' && status.includes('مغلقة')) ||
                    (statusFilter === 'awarded' && status.includes('ممنوحة'));

                if (matchesSearch && matchesClient && matchesStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Real-time search
        document.getElementById('searchInput').addEventListener('input', applyFilters);
        document.getElementById('clientFilter').addEventListener('change', applyFilters);
        document.getElementById('statusFilter').addEventListener('change', applyFilters);
    </script>
@endsection
