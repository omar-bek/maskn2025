@extends('layouts.app')

@section('title', 'لوحة تحكم المورد - insha\'at')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">مرحباً، {{ Auth::user()->name }}</h1>
                    <p class="text-gray-600">إدارة مخزونك ومبيعاتك</p>
                </div>
                <div class="flex space-x-3 space-x-reverse">
                    <a href="{{ route('supplier.catalog') }}" class="btn-primary">
                        <i class="fas fa-boxes ml-2"></i>
                        الكتالوج
                    </a>
                    <a href="{{ route('supplier.profile') }}" class="btn-secondary">
                        <i class="fas fa-user ml-2"></i>
                        الملف الشخصي
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-box text-white"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">المنتجات المتوفرة</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['available_products'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-shopping-cart text-white"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">الطلبات الشهرية</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['monthly_orders'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-money-bill-wave text-white"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">الإيرادات الشهرية</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['monthly_revenue'] ?? 0) }} درهم</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-orange-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">المنتجات منخفضة المخزون</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['low_stock_products'] ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent Orders -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">الطلبات الحديثة</h3>
                    </div>
                    <div class="p-6">
                        @if(count($recentOrders) > 0)
                            <div class="space-y-4">
                                @foreach($recentOrders as $order)
                                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-shopping-bag text-green-600"></i>
                                                </div>
                                            </div>
                                            <div class="mr-4">
                                                <h4 class="text-sm font-medium text-gray-900">طلب #{{ $order['id'] }}</h4>
                                                <p class="text-sm text-gray-500">{{ $order['customer'] }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3 space-x-reverse">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($order['status'] === 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($order['status'] === 'processing') bg-blue-100 text-blue-800
                                                @elseif($order['status'] === 'shipped') bg-purple-100 text-purple-800
                                                @else bg-green-100 text-green-800 @endif">
                                                @if($order['status'] === 'pending') في الانتظار
                                                @elseif($order['status'] === 'processing') قيد المعالجة
                                                @elseif($order['status'] === 'shipped') تم الشحن
                                                @else مكتمل @endif
                                            </span>
                                            <span class="text-sm font-medium text-teal-600">{{ $order['total'] }} درهم</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-shopping-cart text-4xl text-gray-300 mb-4"></i>
                                <p class="text-gray-500">لا توجد طلبات حديثة</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">إجراءات سريعة</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="{{ route('supplier.catalog') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-boxes text-blue-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">إدارة الكتالوج</span>
                            </a>

                            <a href="{{ route('supplier.products') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-box text-purple-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">المنتجات</span>
                            </a>

                            <a href="{{ route('supplier.orders') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-shopping-cart text-green-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">الطلبات</span>
                            </a>

                            <a href="{{ route('supplier.inventory') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-warehouse text-orange-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">المخزون</span>
                            </a>

                            <a href="{{ route('supplier.revenue') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-chart-line text-red-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">التقارير المالية</span>
                            </a>

                            <a href="{{ route('supplier.profile') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-user text-gray-600 ml-3"></i>
                                <span class="text-sm font-medium text-gray-900">تعديل الملف الشخصي</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Low Stock Alert -->
                <div class="bg-white rounded-lg shadow mt-6">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">تنبيهات المخزون</h3>
                    </div>
                    <div class="p-6">
                        @if(count($lowStockAlerts) > 0)
                            <div class="space-y-4">
                                @foreach($lowStockAlerts as $product)
                                    <div class="flex items-center justify-between p-3 bg-red-50 border border-red-200 rounded-lg">
                                        <div>
                                            <p class="text-sm font-medium text-red-900">{{ $product['name'] }}</p>
                                            <p class="text-xs text-red-600">المخزون: {{ $product['stock'] }} وحدة</p>
                                        </div>
                                        <button class="text-red-600 hover:text-red-700">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-check-circle text-green-500 text-2xl mb-2"></i>
                                <p class="text-gray-500 text-sm">جميع المنتجات متوفرة</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
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
