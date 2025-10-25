@extends('layouts.admin')

@section('title', 'إدارة المستخدمين - انشاءات')
@section('page-title', 'إدارة المستخدمين')

@section('content')
    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">إدارة المستخدمين</h1>
                <p class="text-gray-600">إدارة جميع المستخدمين في المنصة</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.users.export') }}" class="admin-btn admin-btn-secondary">
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
                    <input type="text" id="searchInput" placeholder="ابحث بالاسم أو البريد الإلكتروني..."
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">نوع المستخدم</label>
                    <select id="userTypeFilter"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">جميع الأنواع</option>
                        <option value="admin">مدير</option>
                        <option value="client">عميل</option>
                        <option value="consultant">استشاري</option>
                        <option value="contractor">مقاول</option>
                        <option value="supplier">مورد</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الحالة</label>
                    <select id="statusFilter"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">جميع الحالات</option>
                        <option value="active">نشط</option>
                        <option value="inactive">غير نشط</option>
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

        <!-- Users Table -->
        <div class="admin-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="admin-table w-full">
                    <thead>
                        <tr>
                            <th>المستخدم</th>
                            <th>نوع المستخدم</th>
                            <th>البريد الإلكتروني</th>
                            <th>تاريخ التسجيل</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold ml-3">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $user->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $user->phone ?? 'لا يوجد رقم هاتف' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    @if ($user->userType->name === 'admin') bg-red-100 text-red-800
                                    @elseif($user->userType->name === 'client') bg-blue-100 text-blue-800
                                    @elseif($user->userType->name === 'consultant') bg-green-100 text-green-800
                                    @elseif($user->userType->name === 'contractor') bg-yellow-100 text-yellow-800
                                    @elseif($user->userType->name === 'supplier') bg-purple-100 text-purple-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                        @if ($user->userType->name === 'admin')
                                            مدير
                                        @elseif($user->userType->name === 'client')
                                            عميل
                                        @elseif($user->userType->name === 'consultant')
                                            استشاري
                                        @elseif($user->userType->name === 'contractor')
                                            مقاول
                                        @elseif($user->userType->name === 'supplier')
                                            مورد
                                        @else
                                            {{ $user->userType->name }}
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <p class="text-gray-900">{{ $user->email }}</p>
                                    @if ($user->email_verified_at)
                                        <p class="text-sm text-green-600">✓ محقق</p>
                                    @else
                                        <p class="text-sm text-red-600">✗ غير محقق</p>
                                    @endif
                                </td>
                                <td>
                                    <p class="text-gray-900">{{ $user->created_at->format('Y-m-d') }}</p>
                                    <p class="text-sm text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                                </td>
                                <td>
                                    @if ($user->is_active)
                                        <span class="status-badge status-active">نشط</span>
                                    @else
                                        <span class="status-badge status-inactive">غير نشط</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="admin-btn {{ $user->is_active ? 'admin-btn-warning' : 'admin-btn-success' }} text-sm">
                                                <i class="fas {{ $user->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                                {{ $user->is_active ? 'تعطيل' : 'تفعيل' }}
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.users.delete', $user) }}" method="POST"
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
                                <td colspan="6" class="text-center py-8 text-gray-500">
                                    <i class="fas fa-users text-4xl mb-4 block"></i>
                                    لا يوجد مستخدمين
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if ($users->hasPages())
            <div class="flex justify-center">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    <script>
        function applyFilters() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const userTypeFilter = document.getElementById('userTypeFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;

            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const name = row.querySelector('td:first-child p:first-child').textContent.toLowerCase();
                const email = row.querySelector('td:nth-child(3) p:first-child').textContent.toLowerCase();
                const userType = row.querySelector('td:nth-child(2) span').textContent.toLowerCase();
                const status = row.querySelector('td:nth-child(5) span').textContent.toLowerCase();

                const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm);
                const matchesUserType = !userTypeFilter || userType.includes(userTypeFilter);
                const matchesStatus = !statusFilter ||
                    (statusFilter === 'active' && status.includes('نشط')) ||
                    (statusFilter === 'inactive' && status.includes('غير نشط'));

                if (matchesSearch && matchesUserType && matchesStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Real-time search
        document.getElementById('searchInput').addEventListener('input', applyFilters);
        document.getElementById('userTypeFilter').addEventListener('change', applyFilters);
        document.getElementById('statusFilter').addEventListener('change', applyFilters);
    </script>
@endsection
