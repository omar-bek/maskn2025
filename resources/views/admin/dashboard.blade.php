@extends('layouts.admin')

@section('title', 'لوحة التحكم - إدارة انشاءات')
@section('page-title', 'لوحة التحكم الرئيسية')

@section('content')
    <div class="space-y-8">
        <!-- Welcome Section -->
        <div class="admin-card p-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">مرحباً، {{ auth()->user()->name }}</h1>
                    <p class="text-gray-600 text-lg">إليك نظرة عامة على نشاط المنصة اليوم</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">آخر تحديث</p>
                    <p class="text-lg font-semibold text-gray-900">{{ now()->format('Y-m-d H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Users -->
            <div class="stats-card info">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white/80 text-sm font-medium">إجمالي المستخدمين</p>
                        <p class="text-3xl font-bold text-white">{{ number_format($stats['total_users']) }}</p>
                        <p class="text-white/80 text-sm mt-1">+{{ $newUsers }} جديد هذا الشهر</p>
                    </div>
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-users text-2xl text-white"></i>
                    </div>
                </div>
            </div>

            <!-- Total Designs -->
            <div class="stats-card success">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white/80 text-sm font-medium">إجمالي التصاميم</p>
                        <p class="text-3xl font-bold text-white">{{ number_format($stats['total_designs']) }}</p>
                        <p class="text-white/80 text-sm mt-1">+{{ $newDesigns }} جديد هذا الشهر</p>
                    </div>
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-drafting-compass text-2xl text-white"></i>
                    </div>
                </div>
            </div>

            <!-- Total Tenders -->
            <div class="stats-card warning">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white/80 text-sm font-medium">إجمالي المناقصات</p>
                        <p class="text-3xl font-bold text-white">{{ number_format($stats['total_tenders']) }}</p>
                        <p class="text-white/80 text-sm mt-1">+{{ $newTenders }} جديد هذا الشهر</p>
                    </div>
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-file-contract text-2xl text-white"></i>
                    </div>
                </div>
            </div>

            <!-- Total Proposals -->
            <div class="stats-card danger">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white/80 text-sm font-medium">إجمالي العروض</p>
                        <p class="text-3xl font-bold text-white">{{ number_format($stats['total_proposals']) }}</p>
                        <p class="text-white/80 text-sm mt-1">{{ $monthlyStats['proposals_this_month'] }} هذا الشهر</p>
                    </div>
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-file-alt text-2xl text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- User Types Distribution -->
            <div class="admin-card p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">توزيع المستخدمين</h3>
                <div class="space-y-3">
                    @foreach ($userTypeDistribution as $type)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full bg-blue-500 ml-3"></div>
                                <span class="text-gray-700">{{ ucfirst($type->name) }}</span>
                            </div>
                            <span class="font-semibold text-gray-900">{{ $type->count }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Site Images Status -->
            <div class="admin-card p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">حالة صور الموقع</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div
                                class="w-3 h-3 rounded-full {{ \App\Models\SiteSetting::get('site_logo') ? 'bg-green-500' : 'bg-red-500' }} ml-3">
                            </div>
                            <span class="text-gray-700">لوجو الموقع</span>
                        </div>
                        <span
                            class="font-semibold {{ \App\Models\SiteSetting::get('site_logo') ? 'text-green-600' : 'text-red-600' }}">
                            {{ \App\Models\SiteSetting::get('site_logo') ? 'مرفوع' : 'غير مرفوع' }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div
                                class="w-3 h-3 rounded-full {{ \App\Models\SiteSetting::get('site_favicon') ? 'bg-green-500' : 'bg-red-500' }} ml-3">
                            </div>
                            <span class="text-gray-700">أيقونة الموقع</span>
                        </div>
                        <span
                            class="font-semibold {{ \App\Models\SiteSetting::get('site_favicon') ? 'text-green-600' : 'text-red-600' }}">
                            {{ \App\Models\SiteSetting::get('site_favicon') ? 'مرفوع' : 'غير مرفوع' }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div
                                class="w-3 h-3 rounded-full {{ \App\Models\SiteSetting::get('hero_background') ? 'bg-green-500' : 'bg-red-500' }} ml-3">
                            </div>
                            <span class="text-gray-700">خلفية الصفحة الرئيسية</span>
                        </div>
                        <span
                            class="font-semibold {{ \App\Models\SiteSetting::get('hero_background') ? 'text-green-600' : 'text-red-600' }}">
                            {{ \App\Models\SiteSetting::get('hero_background') ? 'مرفوع' : 'غير مرفوع' }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div
                                class="w-3 h-3 rounded-full {{ \App\Models\SiteSetting::get('about_image') ? 'bg-green-500' : 'bg-red-500' }} ml-3">
                            </div>
                            <span class="text-gray-700">صورة قسم من نحن</span>
                        </div>
                        <span
                            class="font-semibold {{ \App\Models\SiteSetting::get('about_image') ? 'text-green-600' : 'text-red-600' }}">
                            {{ \App\Models\SiteSetting::get('about_image') ? 'مرفوع' : 'غير مرفوع' }}
                        </span>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('admin.site-images') }}" class="admin-btn admin-btn-info w-full text-center text-sm">
                        <i class="fas fa-images"></i>
                        إدارة صور الموقع
                    </a>
                </div>
            </div>

            <!-- Tender Status Distribution -->
            <div class="admin-card p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">حالة المناقصات</h3>
                <div class="space-y-3">
                    @foreach ($tenderStatusDistribution as $status)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div
                                    class="w-3 h-3 rounded-full
                                @if ($status->status === 'open') bg-green-500
                                @elseif($status->status === 'closed')
                                @elseif($status->status === 'awarded')
                                @else @endif ml-3">
                                </div>
                                <span class="text-gray-700">
                                    @if ($status->status === 'open')
                                        مفتوحة
                                    @elseif($status->status === 'closed')
                                        مغلقة
                                    @elseif($status->status === 'awarded')
                                        ممنوحة
                                    @else
                                        {{ $status->status }}
                                    @endif
                                </span>
                            </div>
                            <span class="font-semibold text-gray-900">{{ $status->count }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Proposal Status Distribution -->
            <div class="admin-card p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">حالة العروض</h3>
                <div class="space-y-3">
                    @foreach ($proposalStatusDistribution as $status)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div
                                    class="w-3 h-3 rounded-full
                                @if ($status->status === 'pending') bg-yellow-500
                                @elseif($status->status === 'accepted')
                                @elseif($status->status === 'rejected')
                                @else @endif ml-3">
                                </div>
                                <span class="text-gray-700">
                                    @if ($status->status === 'pending')
                                        في الانتظار
                                    @elseif($status->status === 'accepted')
                                        مقبول
                                    @elseif($status->status === 'rejected')
                                        مرفوض
                                    @else
                                        {{ $status->status }}
                                    @endif
                                </span>
                            </div>
                            <span class="font-semibold text-gray-900">{{ $status->count }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Users -->
            <div class="admin-card p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-900">المستخدمين الجدد</h3>
                    <a href="{{ route('admin.users') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        عرض الكل
                    </a>
                </div>
                <div class="space-y-4">
                    @forelse($recentUsers as $user)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold ml-3">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $user->userType->name ?? 'غير محدد' }}</p>
                                </div>
                            </div>
                            <span class="text-sm text-gray-500">{{ $user->created_at->diffForHumans() }}</span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">لا يوجد مستخدمين جدد</p>
                    @endforelse
                </div>
            </div>

            <!-- Recent Designs -->
            <div class="admin-card p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-900">التصاميم الجديدة</h3>
                    <a href="{{ route('admin.designs') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        عرض الكل
                    </a>
                </div>
                <div class="space-y-4">
                    @forelse($recentDesigns as $design)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="{{ $design->main_image_url }}" alt="{{ $design->title }}"
                                    class="w-10 h-10 rounded-lg object-cover ml-3">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ Str::limit($design->title, 20) }}</p>
                                    <p class="text-sm text-gray-500">{{ $design->consultant->name }}</p>
                                </div>
                            </div>
                            <span class="text-sm text-gray-500">{{ $design->created_at->diffForHumans() }}</span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">لا يوجد تصاميم جديدة</p>
                    @endforelse
                </div>
            </div>

            <!-- Recent Tenders -->
            <div class="admin-card p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-900">المناقصات الجديدة</h3>
                    <a href="{{ route('admin.tenders') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        عرض الكل
                    </a>
                </div>
                <div class="space-y-4">
                    @forelse($recentTenders as $tender)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="{{ $tender->design->main_image_url }}" alt="{{ $tender->title }}"
                                    class="w-10 h-10 rounded-lg object-cover ml-3">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ Str::limit($tender->title, 20) }}</p>
                                    <p class="text-sm text-gray-500">{{ $tender->client->name }}</p>
                                </div>
                            </div>
                            <span class="text-sm text-gray-500">{{ $tender->created_at->diffForHumans() }}</span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">لا يوجد مناقصات جديدة</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="admin-card p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-6">الإجراءات السريعة</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <a href="{{ route('admin.users') }}" class="admin-btn admin-btn-primary text-center">
                    <i class="fas fa-users"></i>
                    <span>إدارة المستخدمين</span>
                </a>

                <a href="{{ route('admin.designs') }}" class="admin-btn admin-btn-success text-center">
                    <i class="fas fa-drafting-compass"></i>
                    <span>إدارة التصاميم</span>
                </a>

                <a href="{{ route('admin.tenders') }}" class="admin-btn admin-btn-warning text-center">
                    <i class="fas fa-file-contract"></i>
                    <span>إدارة المناقصات</span>
                </a>

                <a href="{{ route('admin.site-images') }}" class="admin-btn admin-btn-info text-center">
                    <i class="fas fa-images"></i>
                    <span>صور الموقع</span>
                </a>

                <a href="{{ route('admin.settings') }}" class="admin-btn admin-btn-secondary text-center">
                    <i class="fas fa-cog"></i>
                    <span>إعدادات النظام</span>
                </a>
            </div>
        </div>
    </div>
@endsection
