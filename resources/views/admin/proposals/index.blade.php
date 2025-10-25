@extends('layouts.admin')

@section('title', 'إدارة العروض - انشاءات')
@section('page-title', 'إدارة العروض')

@section('content')
    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">إدارة العروض</h1>
                <p class="text-gray-600">إدارة جميع العروض المقدمة في المنصة</p>
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
                        @foreach ($proposals->pluck('consultant.name')->unique() as $consultantName)
                            <option value="{{ $consultantName }}">{{ $consultantName }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الحالة</label>
                    <select id="statusFilter"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">جميع الحالات</option>
                        <option value="pending">في الانتظار</option>
                        <option value="accepted">مقبول</option>
                        <option value="rejected">مرفوض</option>
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

        <!-- Proposals Table -->
        <div class="admin-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="admin-table w-full">
                    <thead>
                        <tr>
                            <th>العرض</th>
                            <th>المناقصة</th>
                            <th>الاستشاري</th>
                            <th>السعر</th>
                            <th>المدة</th>
                            <th>تاريخ التقديم</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($proposals as $proposal)
                            <tr>
                                <td>
                                    <div>
                                        <p class="font-semibold text-gray-900">
                                            {{ Str::limit($proposal->tender->title, 30) }}</p>
                                        <p class="text-sm text-gray-500 line-clamp-2">
                                            {{ Str::limit($proposal->proposal_text, 50) }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center">
                                        <img src="{{ $proposal->tender->design->main_image_url }}"
                                            alt="{{ $proposal->tender->title }}"
                                            class="w-10 h-10 rounded-lg object-cover ml-3">
                                        <div>
                                            <p class="font-semibold text-gray-900">
                                                {{ Str::limit($proposal->tender->title, 20) }}</p>
                                            <p class="text-sm text-gray-500">{{ $proposal->tender->client->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center">
                                        <div
                                            class="w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-bold text-sm ml-3">
                                            {{ substr($proposal->consultant->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $proposal->consultant->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $proposal->consultant->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="font-semibold text-gray-900">{{ $proposal->formatted_price }}</p>
                                </td>
                                <td>
                                    <p class="font-semibold text-gray-900">{{ $proposal->formatted_duration }}</p>
                                </td>
                                <td>
                                    <p class="font-semibold text-gray-900">{{ $proposal->created_at->format('Y-m-d') }}</p>
                                    <p class="text-sm text-gray-500">{{ $proposal->created_at->diffForHumans() }}</p>
                                </td>
                                <td>
                                    @if ($proposal->status === 'pending')
                                        <span class="status-badge status-pending">في الانتظار</span>
                                    @elseif($proposal->status === 'accepted')
                                        <span class="status-badge status-active">مقبول</span>
                                    @elseif($proposal->status === 'rejected')
                                        <span class="status-badge status-inactive">مرفوض</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('proposals.show', $proposal->id) }}"
                                            class="admin-btn admin-btn-primary text-sm">
                                            <i class="fas fa-eye"></i>
                                            عرض
                                        </a>

                                        <form action="{{ route('admin.proposals.delete', $proposal) }}" method="POST"
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
                                    <i class="fas fa-file-alt text-4xl mb-4 block"></i>
                                    لا يوجد عروض
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if ($proposals->hasPages())
            <div class="flex justify-center">
                {{ $proposals->links() }}
            </div>
        @endif
    </div>

    <script>
        function applyFilters() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const consultantFilter = document.getElementById('consultantFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;

            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const title = row.querySelector('td:first-child p:first-child').textContent.toLowerCase();
                const description = row.querySelector('td:first-child p:last-child').textContent.toLowerCase();
                const consultant = row.querySelector('td:nth-child(3) p:first-child').textContent.toLowerCase();
                const status = row.querySelector('td:nth-child(7) span').textContent.toLowerCase();

                const matchesSearch = title.includes(searchTerm) || description.includes(searchTerm);
                const matchesConsultant = !consultantFilter || consultant.includes(consultantFilter);
                const matchesStatus = !statusFilter ||
                    (statusFilter === 'pending' && status.includes('في الانتظار')) ||
                    (statusFilter === 'accepted' && status.includes('مقبول')) ||
                    (statusFilter === 'rejected' && status.includes('مرفوض'));

                if (matchesSearch && matchesConsultant && matchesStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
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
