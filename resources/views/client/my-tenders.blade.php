@extends('layouts.app')

@section('title', 'مناقصاتي - insha\'at')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">مناقصاتي</h1>
                        <p class="text-gray-600">إدارة مناقصاتك والعروض المقدمة عليها</p>
                    </div>
                    <div class="flex space-x-3 space-x-reverse">
                        <a href="{{ route('tenders.create') }}" class="btn-primary">
                            <i class="fas fa-plus ml-2"></i>
                            إنشاء مناقصة جديدة
                        </a>
                        <a href="{{ route('client.dashboard') }}" class="btn-secondary">
                            <i class="fas fa-arrow-right ml-2"></i>
                            العودة للداشبورد
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if ($tenders->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach ($tenders as $tender)
                        <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $tender->title }}</h3>
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full
                                    @if ($tender->status === 'active') bg-green-100 text-green-800
                                    @elseif($tender->status === 'closed') bg-red-100 text-red-800
                                    @elseif($tender->status === 'awarded') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                        @if ($tender->status === 'active')
                                            نشط
                                        @elseif($tender->status === 'closed')
                                            مغلق
                                        @elseif($tender->status === 'awarded')
                                            مُمنوح
                                        @else
                                            {{ $tender->status }}
                                        @endif
                                    </span>
                                </div>

                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-map-marker-alt ml-2"></i>
                                        <span>{{ $tender->location }}</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-calendar ml-2"></i>
                                        <span>{{ $tender->created_at->format('Y-m-d') }}</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-money-bill-wave ml-2"></i>
                                        <span>{{ $tender->formatted_budget }}</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-file-alt ml-2"></i>
                                        <span>{{ $tender->proposals->count() }} عرض</span>
                                    </div>
                                </div>

                                @if ($tender->proposals->count() > 0)
                                    <div class="border-t pt-4 mb-4">
                                        <h4 class="text-sm font-medium text-gray-900 mb-2">أحدث العروض:</h4>
                                        <div class="space-y-2">
                                            @foreach ($tender->proposals->take(2) as $proposal)
                                                <div class="flex items-center justify-between text-sm">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="w-6 h-6 bg-teal-100 rounded-full flex items-center justify-center ml-2">
                                                            <i class="fas fa-user text-teal-600 text-xs"></i>
                                                        </div>
                                                        <span
                                                            class="text-gray-700">{{ $proposal->consultant->name ?? 'غير محدد' }}</span>
                                                    </div>
                                                    <div class="flex items-center space-x-2 space-x-reverse">
                                                        <span class="text-gray-600">{{ $proposal->formatted_price }}</span>
                                                        <span
                                                            class="px-2 py-1 text-xs rounded-full
                                                        @if ($proposal->status === 'pending') bg-yellow-100 text-yellow-800
                                                        @elseif($proposal->status === 'accepted') bg-green-100 text-green-800
                                                        @elseif($proposal->status === 'rejected') bg-red-100 text-red-800
                                                        @else bg-gray-100 text-gray-800 @endif">
                                                            @if ($proposal->status === 'pending')
                                                                في الانتظار
                                                            @elseif($proposal->status === 'accepted')
                                                                مقبول
                                                            @elseif($proposal->status === 'rejected')
                                                                مرفوض
                                                            @else
                                                                {{ $proposal->status }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if ($tender->proposals->count() > 2)
                                                <p class="text-xs text-gray-500">و {{ $tender->proposals->count() - 2 }}
                                                    عرض آخر</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <div class="flex space-x-2 space-x-reverse">
                                    <a href="{{ route('tenders.show', $tender->id) }}"
                                        class="flex-1 btn-primary text-center">
                                        <i class="fas fa-eye ml-2"></i>
                                        عرض التفاصيل
                                    </a>
                                    @if ($tender->proposals->count() > 0)
                                        <a href="{{ route('tenders.compare-proposals', $tender->id) }}"
                                            class="flex-1 btn-secondary text-center">
                                            <i class="fas fa-balance-scale ml-2"></i>
                                            مقارنة العروض
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $tenders->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-gavel text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">لا توجد مناقصات</h3>
                    <p class="text-gray-600 mb-6">لم تقم بإنشاء أي مناقصات بعد</p>
                    <a href="{{ route('tenders.create') }}" class="btn-primary">
                        <i class="fas fa-plus ml-2"></i>
                        إنشاء مناقصة جديدة
                    </a>
                </div>
            @endif
        </div>
    </div>

    <style>
        .btn-primary {
            @apply inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500;
        }

        .btn-secondary {
            @apply inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500;
        }
    </style>
@endsection








