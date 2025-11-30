@extends('layouts.app')

@section('title', __('app.supplier_dashboard_title'))

@section('content')
<div class="min-h-screen bg-gray-50 pb-12 mt-16">
    
    <div class="bg-[#1a262a] relative overflow-hidden pb-24">
        <div class="absolute inset-0 bg-gradient-to-r from-[#2f5c69]/40 to-[#f3a446]/10 opacity-60"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div>
                    <h1 class="text-3xl font-bold text-white tracking-wide">{{ __('app.welcome_user', ['name' => Auth::user()->name]) }}</h1>
                    <p class="text-gray-300 mt-2 text-sm md:text-base">{{ __('app.dashboard_desc') }}</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('supplier.catalog') }}" 
                       class="inline-flex items-center px-5 py-2.5 rounded-xl bg-[#f3a446] text-[#1a262a] font-bold shadow-lg shadow-orange-500/20 hover:bg-[#f5b05a] hover:-translate-y-0.5 transition-all duration-200">
                        <i class="fas fa-boxes mr-2 rtl:ml-2 rtl:mr-0"></i>
                        {{ __('app.catalog') }}
                    </a>
                    <a href="{{ route('supplier.profile') }}" 
                       class="inline-flex items-center px-5 py-2.5 rounded-xl bg-white/10 text-white border border-white/20 hover:bg-white/20 backdrop-blur-sm transition-all duration-200">
                        <i class="fas fa-user mr-2 rtl:ml-2 rtl:mr-0"></i>
                        {{ __('app.my_profile') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 p-6 border-b-4 border-blue-500 transform hover:scale-[1.02] transition duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">{{ __('app.available_products') }}</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['available_products'] ?? 0 }}</h3>
                    </div>
                    <div class="p-3 bg-blue-50 rounded-xl text-blue-600">
                        <i class="fas fa-box text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 p-6 border-b-4 border-emerald-500 transform hover:scale-[1.02] transition duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">{{ __('app.monthly_orders') }}</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['monthly_orders'] ?? 0 }}</h3>
                    </div>
                    <div class="p-3 bg-emerald-50 rounded-xl text-emerald-600">
                        <i class="fas fa-shopping-cart text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 p-6 border-b-4 border-[#f3a446] transform hover:scale-[1.02] transition duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">{{ __('app.monthly_revenue') }}</p>
                        <div class="flex items-baseline gap-1 mt-2">
                            <h3 class="text-3xl font-bold text-gray-800">{{ number_format($stats['monthly_revenue'] ?? 0) }}</h3>
                            <span class="text-xs font-bold text-gray-400">{{ __('app.currency') }}</span>
                        </div>
                    </div>
                    <div class="p-3 bg-orange-50 rounded-xl text-[#f3a446]">
                        <i class="fas fa-wallet text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 p-6 border-b-4 border-red-500 transform hover:scale-[1.02] transition duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">{{ __('app.low_stock_products') }}</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['low_stock_products'] ?? 0 }}</h3>
                    </div>
                    <div class="p-3 bg-red-50 rounded-xl text-red-600">
                        <i class="fas fa-exclamation-triangle text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                        <h3 class="text-lg font-bold text-[#1a262a]">{{ __('app.recent_orders') }}</h3>
                        <div class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></div>
                    </div>
                    <div class="p-6">
                        @if(count($recentOrders) > 0)
                            <div class="space-y-4">
                                @foreach($recentOrders as $order)
                                    <div class="group flex flex-col sm:flex-row items-center justify-between p-4 rounded-2xl border border-gray-100 hover:border-[#f3a446]/30 hover:bg-orange-50/30 transition duration-200">
                                        <div class="flex items-center w-full sm:w-auto">
                                            <div class="flex-shrink-0">
                                                <div class="w-12 h-12 bg-white rounded-xl border border-gray-200 flex items-center justify-center shadow-sm group-hover:scale-110 transition duration-200">
                                                    <i class="fas fa-shopping-bag text-[#2f5c69]"></i>
                                                </div>
                                            </div>
                                            <div class="mr-4 rtl:ml-4 rtl:mr-0">
                                                <h4 class="text-sm font-bold text-gray-900">{{ __('app.order_number', ['number' => $order['id']]) }}</h4>
                                                <p class="text-xs text-gray-500">{{ $order['customer'] }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between w-full sm:w-auto mt-4 sm:mt-0 gap-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                                @if($order['status'] === 'pending') bg-yellow-100 text-yellow-700
                                                @elseif($order['status'] === 'processing')
                                                @elseif($order['status'] === 'shipped')
                                                @else @endif">
                                                @if($order['status'] === 'pending') {{ __('app.status_pending') }}
                                                @elseif($order['status'] === 'processing') {{ __('app.status_processing') }}
                                                @elseif($order['status'] === 'shipped') {{ __('app.status_shipped') }}
                                                @else {{ __('app.status_completed') }} @endif
                                            </span>
                                            <span class="text-sm font-bold text-[#1a262a]">{{ $order['total'] }} {{ __('app.currency') }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-shopping-basket text-3xl text-gray-300"></i>
                                </div>
                                <p class="text-gray-500 font-medium">{{ __('app.no_recent_orders') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-8">
                
              

                <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 bg-red-50/30 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-red-700">{{ __('app.stock_alerts') }}</h3>
                        <i class="fas fa-bell text-red-400 animate-bounce"></i>
                    </div>
                    <div class="p-6">
                        @if(count($lowStockAlerts) > 0)
                            <div class="space-y-3">
                                @foreach($lowStockAlerts as $product)
                                    <div class="flex items-center justify-between p-3 bg-red-50 border border-red-100 rounded-xl hover:bg-red-100 transition duration-200">
                                        <div>
                                            <p class="text-sm font-bold text-[#1a262a]">{{ $product['name'] }}</p>
                                            <p class="text-xs text-red-600 font-semibold mt-1">{{ __('app.stock_count', ['count' => $product['stock']]) }}</p>
                                        </div>
                                        <button class="w-8 h-8 rounded-lg bg-white text-red-500 flex items-center justify-center shadow-sm hover:bg-red-500 hover:text-white transition duration-200">
                                            <i class="fas fa-plus text-xs"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-6">
                                <div class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-check text-2xl text-emerald-500"></i>
                                </div>
                                <p class="text-sm text-gray-500 font-medium">{{ __('app.all_stock_good') }}</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection