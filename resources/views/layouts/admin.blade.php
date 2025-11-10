<!DOCTYPE html>
@php
    $currentLocale = app()->getLocale();
    $isRtl = $currentLocale === 'ar';
@endphp
<html lang="{{ str_replace('_', '-', $currentLocale) }}" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'لوحة الإدارة - انشاءات')</title>
    <meta name="description" content="@yield('description', 'لوحة تحكم إدارة منصة انشاءات')">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#dc2626">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .admin-sidebar {
            background: linear-gradient(180deg, #1f2937 0%, #111827 100%);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        .admin-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .admin-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .admin-nav-item {
            transition: all 0.3s ease;
            border-radius: 12px;
            margin: 4px 0;
        }

        .admin-nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(-5px);
        }

        .admin-nav-item.active {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
        }

        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-card.success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .stats-card.warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .stats-card.danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .stats-card.info {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }

        .admin-table {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .admin-table th {
            background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
            color: white;
            font-weight: 600;
            padding: 1rem;
        }

        .admin-table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .admin-table tr:hover {
            background: rgba(0, 0, 0, 0.02);
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-active {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .status-inactive {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .status-pending {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .status-published {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }

        .status-open {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .status-closed {
            background: linear-gradient(135deg, #6b7280, #4b5563);
            color: white;
        }

        .status-awarded {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
        }

        .admin-btn {
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .admin-btn-primary {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            color: white;
        }

        .admin-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(220, 38, 38, 0.3);
        }

        .admin-btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .admin-btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        }

        .admin-btn-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .admin-btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
        }

        .admin-btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .admin-btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
        }

        .admin-btn-secondary {
            background: linear-gradient(135deg, #6b7280, #4b5563);
            color: white;
        }

        .admin-btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(107, 114, 128, 0.3);
        }

        .admin-btn-info {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }

        .admin-btn-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
        }

        .chart-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .notification-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .admin-sidebar.open {
                transform: translateX(0);
            }
        }
    </style>
</head>

<body>
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="admin-sidebar w-64 text-white p-6 overflow-y-auto">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-crown text-2xl"></i>
                </div>
                <h1 class="text-xl font-bold">لوحة الإدارة</h1>
                <p class="text-gray-300 text-sm">منصة انشاءات</p>
            </div>

            <!-- Navigation -->
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="admin-nav-item flex items-center px-4 py-3 text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt ml-3"></i>
                    <span>لوحة التحكم</span>
                </a>

                <a href="{{ route('admin.users') }}"
                    class="admin-nav-item flex items-center px-4 py-3 text-white {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <i class="fas fa-users ml-3"></i>
                    <span>المستخدمين</span>
                </a>

                <a href="{{ route('admin.designs') }}"
                    class="admin-nav-item flex items-center px-4 py-3 text-white {{ request()->routeIs('admin.designs*') ? 'active' : '' }}">
                    <i class="fas fa-drafting-compass ml-3"></i>
                    <span>التصاميم</span>
                </a>

                <a href="{{ route('admin.tenders') }}"
                    class="admin-nav-item flex items-center px-4 py-3 text-white {{ request()->routeIs('admin.tenders*') ? 'active' : '' }}">
                    <i class="fas fa-file-contract ml-3"></i>
                    <span>المناقصات</span>
                </a>

                <a href="{{ route('admin.proposals') }}"
                    class="admin-nav-item flex items-center px-4 py-3 text-white {{ request()->routeIs('admin.proposals*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt ml-3"></i>
                    <span>العروض</span>
                </a>

                <a href="{{ route('admin.categories') }}"
                    class="admin-nav-item flex items-center px-4 py-3 text-white {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                    <i class="fas fa-tags ml-3"></i>
                    <span>الفئات</span>
                </a>

                <a href="{{ route('admin.site-images') }}"
                    class="admin-nav-item flex items-center px-4 py-3 text-white {{ request()->routeIs('admin.site-images*') ? 'active' : '' }}">
                    <i class="fas fa-images ml-3"></i>
                    <span>صور الموقع</span>
                </a>

                <a href="{{ route('admin.settings') }}"
                    class="admin-nav-item flex items-center px-4 py-3 text-white {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                    <i class="fas fa-cog ml-3"></i>
                    <span>الإعدادات</span>
                </a>
            </nav>

            <!-- User Info -->
            <div class="mt-8 pt-6 border-t border-gray-600">
                <div class="flex items-center">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center ml-3">
                        <i class="fas fa-user text-sm"></i>
                    </div>
                    <div>
                        <p class="font-semibold">{{ auth()->user()->name }}</p>
                        <p class="text-gray-300 text-sm">مدير النظام</p>
                    </div>
                </div>
                <a href="{{ route('admin.profile') }}"
                    class="block mt-4 px-4 py-2 text-gray-300 hover:text-white transition-colors">
                    <i class="fas fa-user-edit ml-2"></i>
                    الملف الشخصي
                </a>
                <a href="{{ route('logout') }}"
                    class="block mt-2 px-4 py-2 text-red-300 hover:text-red-200 transition-colors">
                    <i class="fas fa-sign-out-alt ml-2"></i>
                    تسجيل الخروج
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <button class="lg:hidden text-gray-600 hover:text-gray-900 ml-4" onclick="toggleSidebar()">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h2 class="text-2xl font-bold text-gray-900">@yield('page-title', 'لوحة التحكم')</h2>
                    </div>

                    <div class="flex items-center space-x-4 space-x-reverse">
                        <!-- Notifications -->
                        <div class="relative">
                            <button class="text-gray-600 hover:text-gray-900 relative">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="notification-badge">3</span>
                            </button>
                        </div>

                        <!-- Quick Actions -->
                        <div class="flex items-center space-x-2 space-x-reverse">
                            <a href="{{ route('home') }}" class="admin-btn admin-btn-secondary text-sm">
                                <i class="fas fa-home"></i>
                                الموقع الرئيسي
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle ml-2"></i>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle ml-2"></i>
                            {{ session('error') }}
                        </div>
                    </div>
                @endif

                @if (session('warning'))
                    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle ml-2"></i>
                            {{ session('warning') }}
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.admin-sidebar');
            sidebar.classList.toggle('open');
        }

        // Auto-hide flash messages
        setTimeout(function() {
            const flashMessages = document.querySelectorAll('.bg-green-100, .bg-red-100, .bg-yellow-100');
            flashMessages.forEach(function(message) {
                message.style.transition = 'opacity 0.5s ease';
                message.style.opacity = '0';
                setTimeout(function() {
                    message.remove();
                }, 500);
            });
        }, 5000);

        // Confirm delete actions
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('delete-btn') || e.target.closest('.delete-btn')) {
                if (!confirm('هل أنت متأكد من الحذف؟ لا يمكن التراجع عن هذا الإجراء.')) {
                    e.preventDefault();
                }
            }
        });
    </script>
</body>

</html>
