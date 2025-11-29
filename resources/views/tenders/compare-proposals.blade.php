@extends('layouts.app')

@section('title', 'مقارنة العروض - ' . $tender->title)

@section('content')


<div class="min-h-screen bg-gray-50 py-12 mt-20"> <div class="max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-8">

    <div class="bg-white rounded-2xl shadow-lg border-t-4 border-[#f3a446] p-8 mb-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-3xl font-bold text-[#2f5c69]">{{ __('app.tender_comparison_title') }}</h1>
                    <span class="px-3 py-1 bg-[#2f5c69]/10 text-[#2f5c69] rounded-full text-sm font-bold">
                        {{ $tender->reference_number ?? 'REF-' . $tender->id }}
                    </span>
                </div>
                <h2 class="text-xl text-gray-600 mb-6 font-medium">{{ $tender->title }}</h2>
                
                <div class="flex flex-wrap items-center gap-6 text-sm text-gray-500 font-medium">
                    <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-lg">
                        <i class="fas fa-calendar text-[#f3a446] rtl:ml-2 ltr:mr-2"></i> 
                        <span>{{ $tender->created_at->format('Y-m-d') }}</span>
                    </div>
                    <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-lg">
                        <i class="fas fa-map-marker-alt text-[#2f5c69] rtl:ml-2 ltr:mr-2"></i> 
                        <span>{{ $tender->location }}</span>
                    </div>
                    <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-lg">
                        <i class="fas fa-money-bill-wave text-green-600 rtl:ml-2 ltr:mr-2"></i> 
                        <span>{{ $tender->formatted_budget }}</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('tenders.show', $tender->id) }}"
                   class="inline-flex items-center px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 transition-all">
                    <i class="fas fa-arrow-right rtl:ml-2 ltr:mr-2"></i>
                    {{ __('app.return_to_tender') }}
                </a>
                <a href="{{ route('tenders.export-pdf', $tender->id) }}"
                   class="inline-flex items-center px-5 py-2.5 bg-red-50 text-red-600 rounded-xl font-bold hover:bg-red-100 transition-all border border-red-100">
                    <i class="fas fa-file-pdf rtl:ml-2 ltr:mr-2"></i>
                    PDF
                </a>
                <a href="{{ route('tenders.export-excel', $tender->id) }}"
                   class="inline-flex items-center px-5 py-2.5 bg-green-50 text-green-600 rounded-xl font-bold hover:bg-green-100 transition-all border border-green-100">
                    <i class="fas fa-file-excel rtl:ml-2 ltr:mr-2"></i>
                    Excel
                </a>
            </div>
        </div>
    </div>

    @if($tender->proposals->count() > 0)
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 hover:border-[#2f5c69] transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-bold text-gray-500 mb-1">{{ __('app.total_proposals') }}</p>
                        <h3 class="text-3xl font-bold text-[#2f5c69]">{{ $tender->proposals->count() }}</h3>
                    </div>
                    <div class="p-3 bg-[#2f5c69]/10 rounded-xl text-[#2f5c69]">
                        <i class="fas fa-file-contract text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 hover:border-green-500 transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-bold text-gray-500 mb-1">{{ __('app.lowest_price') }}</p>
                        <h3 class="text-2xl font-bold text-green-600">{{ number_format($tender->proposals->min('proposed_price'), 2) }}</h3>
                        <span class="text-xs text-gray-400">{{ __('app.currency') }}</span>
                    </div>
                    <div class="p-3 bg-green-100 rounded-xl text-green-600">
                        <i class="fas fa-level-down-alt text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 hover:border-red-500 transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-bold text-gray-500 mb-1">{{ __('app.highest_price') }}</p>
                        <h3 class="text-2xl font-bold text-red-500">{{ number_format($tender->proposals->max('proposed_price'), 2) }}</h3>
                        <span class="text-xs text-gray-400">{{ __('app.currency') }}</span>
                    </div>
                    <div class="p-3 bg-red-100 rounded-xl text-red-500">
                        <i class="fas fa-level-up-alt text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 hover:border-[#f3a446] transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-bold text-gray-500 mb-1">{{ __('app.average_duration') }}</p>
                        <h3 class="text-3xl font-bold text-[#f3a446]">{{ round($tender->proposals->avg('duration_months'), 1) }}</h3>
                        <span class="text-xs text-gray-400">{{ __('app.month') }}</span>
                    </div>
                    <div class="p-3 bg-[#f3a446]/10 rounded-xl text-[#f3a446]">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        @php
            $originalTotal = $tender->design->items->sum('total_price');
            $minProposalPrice = $tender->proposals->min('proposed_price');
            $maxProposalPrice = $tender->proposals->max('proposed_price');
            $minDifference = $originalTotal - $minProposalPrice;
            $maxDifference = $originalTotal - $maxProposalPrice;
        @endphp

        @if($originalTotal > 0)
        <div class="bg-[#2f5c69] rounded-2xl shadow-lg p-8 mb-8 text-white relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                <i class="fas fa-chart-pie absolute -bottom-10 -left-10 text-9xl"></i>
            </div>
            
            <h4 class="text-xl font-bold mb-6 flex items-center gap-2 relative z-10">
                <i class="fas fa-balance-scale text-[#f3a446] rtl:ml-2 ltr:mr-2"></i>
                {{ __('app.comparison_original_estimate') }}
            </h4>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative z-10">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-5 border border-white/10">
                    <div class="text-sm text-gray-200 mb-1">{{ __('app.estimated_design_cost') }}</div>
                    <div class="text-3xl font-bold text-[#f3a446]">{{ number_format($originalTotal, 2) }} <span class="text-sm">{{ __('app.currency') }}</span></div>
                </div>
                
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-5 border border-white/10">
                    <div class="text-sm text-gray-200 mb-1">{{ __('app.diff_lowest_offer') }}</div>
                    <div class="flex items-end gap-2">
                        <span class="text-2xl font-bold {{ $minDifference > 0 ? 'text-green-400' : 'text-red-400' }}">
                            {{ $minDifference > 0 ? '+' : '' }}{{ number_format($minDifference, 2) }}
                        </span>
                        <span class="text-sm mb-1 text-gray-300">({{ number_format(($minDifference / $originalTotal) * 100, 1) }}%)</span>
                    </div>
                    <div class="text-xs text-gray-300 mt-2">
                        {{ $minDifference > 0 ? __('app.budget_saving') : __('app.over_budget') }}
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-5 border border-white/10">
                    <div class="text-sm text-gray-200 mb-1">{{ __('app.diff_highest_offer') }}</div>
                    <div class="flex items-end gap-2">
                        <span class="text-2xl font-bold {{ $maxDifference > 0 ? 'text-green-400' : 'text-red-400' }}">
                            {{ $maxDifference > 0 ? '+' : '' }}{{ number_format($maxDifference, 2) }}
                        </span>
                        <span class="text-sm mb-1 text-gray-300">({{ number_format(($maxDifference / $originalTotal) * 100, 1) }}%)</span>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-8">
            <div class="px-8 py-6 border-b border-gray-100 flex items-center gap-3">
                <div class="p-2 bg-[#2f5c69]/10 rounded-lg text-[#2f5c69]">
                    <i class="fas fa-list-ol"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">{{ __('app.general_comparison_table') }}</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-[#2f5c69] text-white">
                            <th class="px-6 py-4 rtl:text-right ltr:text-left text-sm font-bold">{{ __('app.consultant') }}</th>
                            <th class="px-6 py-4 text-center text-sm font-bold">{{ __('app.total_price') }}</th>
                            <th class="px-6 py-4 text-center text-sm font-bold">{{ __('app.execution_duration') }}</th>
                            <th class="px-6 py-4 text-center text-sm font-bold">{{ __('app.submission_date') }}</th>
                            <th class="px-6 py-4 text-center text-sm font-bold">{{ __('app.status') }}</th>
                            <th class="px-6 py-4 text-center text-sm font-bold">{{ __('app.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($tender->proposals->sortBy('proposed_price') as $proposal)
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center rtl:ml-3 ltr:mr-3 border-2 border-white shadow-sm group-hover:border-[#f3a446] transition-all">
                                            <i class="fas fa-user text-gray-500 group-hover:text-[#f3a446]"></i>
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900">{{ $proposal->consultant->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $proposal->consultant->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-4 py-1.5 rounded-full bg-green-50 text-green-700 font-bold border border-green-100">
                                        {{ number_format($proposal->proposed_price, 2) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="font-bold text-gray-700">{{ $proposal->duration_months }}</span> <span class="text-xs text-gray-500">{{ __('app.month') }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-sm text-gray-500 font-medium">{{ $proposal->created_at->format('Y-m-d') }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($proposal->status === 'pending')
                                        <span class="px-3 py-1 text-xs font-bold bg-yellow-50 text-yellow-700 rounded-full border border-yellow-100">
                                            {{ __('app.status_pending') }}
                                        </span>
                                    @elseif($proposal->status === 'accepted')
                                        <span class="px-3 py-1 text-xs font-bold bg-green-50 text-green-700 rounded-full border border-green-100">
                                            {{ __('app.status_accepted') }}
                                        </span>
                                    @elseif($proposal->status === 'rejected')
                                        <span class="px-3 py-1 text-xs font-bold bg-red-50 text-red-700 rounded-full border border-red-100">
                                            {{ __('app.status_rejected') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('proposals.show', $proposal->id) }}"
                                           class="p-2 text-gray-500 hover:text-[#2f5c69] hover:bg-[#2f5c69]/10 rounded-lg transition-colors" title="{{ __('app.view_details') }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($proposal->status === 'pending')
                                            <button type="button"
                                                    class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors"
                                                    onclick="showAcceptModal({{ $proposal->id }})" title="{{ __('app.confirm_accept_btn') }}">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button type="button"
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                                    onclick="showRejectModal({{ $proposal->id }})" title="{{ __('app.confirm_reject_btn') }}">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if($itemsByCategory && $itemsByCategory->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-8">
                <div class="px-8 py-6 border-b border-gray-100">
                    <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-[#f3a446]/10 rounded-lg text-[#f3a446]">
                                <i class="fas fa-th-list"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">{{ __('app.detailed_item_comparison') }}</h3>
                                <p class="text-sm text-gray-500 mt-1">{{ __('app.detailed_comparison_desc') }}</p>
                            </div>
                        </div>
                        
                        <div class="flex flex-wrap gap-3 text-xs font-bold">
                            <span class="flex items-center gap-2 px-3 py-1 rounded-full bg-[#2f5c69]/10 text-[#2f5c69]">
                                <span class="w-2 h-2 rounded-full bg-[#2f5c69]"></span> {{ __('app.original_price') }}
                            </span>
                            <span class="flex items-center gap-2 px-3 py-1 rounded-full bg-green-50 text-green-700">
                                <span class="w-2 h-2 rounded-full bg-green-500"></span> {{ __('app.offer_price') }}
                            </span>
                            <span class="flex items-center gap-2 px-3 py-1 rounded-full bg-[#f3a446]/10 text-[#f3a446]">
                                <span class="w-2 h-2 rounded-full bg-[#f3a446]"></span> {{ __('app.difference') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="space-y-8">
                        @foreach($itemsByCategory as $categoryName => $items)
                            <div class="border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                                    <h4 class="font-bold text-[#2f5c69] flex items-center gap-2">
                                        <i class="fas fa-layer-group rtl:ml-2 ltr:mr-2"></i> {{ $categoryName }}
                                    </h4>
                                    <span class="text-xs font-bold bg-white border px-2 py-1 rounded text-gray-500">{{ count($items) }} {{ __('app.items_count') }}</span>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm">
                                        <thead>
                                            <tr class="bg-white border-b border-gray-100">
                                                <th class="px-4 py-3 rtl:text-right ltr:text-left font-bold text-gray-700 bg-gray-50/50 sticky rtl:right-0 ltr:left-0 z-10 w-64">{{ __('app.item_details') }}</th>
                                                <th class="px-4 py-3 text-center font-bold text-gray-700 w-24">{{ __('app.quantity') }}</th>
                                                <th class="px-4 py-3 text-center font-bold text-white bg-[#2f5c69] w-32 border-l border-[#2f5c69]/20">{{ __('app.original_pricing') }}</th>
                                                @foreach($tender->proposals as $proposal)
                                                    <th class="px-4 py-3 text-center font-bold text-gray-800 bg-gray-100 border-l border-gray-200" colspan="2">
                                                        {{ $proposal->consultant->name }}
                                                    </th>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th class="bg-gray-50/30 sticky rtl:right-0 ltr:left-0 z-10"></th>
                                                <th class="bg-gray-50/30"></th>
                                                <th class="bg-[#2f5c69]/5"></th>
                                                @foreach($tender->proposals as $proposal)
                                                    <th class="px-2 py-1 text-center text-xs text-green-700 bg-green-50/50 border-l border-white">{{ __('app.price') }}</th>
                                                    <th class="px-2 py-1 text-center text-xs text-[#f3a446] bg-[#f3a446]/10">{{ __('app.difference') }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100">
                                            @foreach($items as $item)
                                                <tr class="hover:bg-gray-50 transition-colors">
                                                    <td class="px-4 py-4 sticky rtl:right-0 ltr:left-0 bg-white z-10 border-l border-gray-100 shadow-[4px_0_10px_-5px_rgba(0,0,0,0.05)]">
                                                        <div class="flex flex-col">
                                                            <span class="font-bold text-gray-800">{{ $item->item_name }}</span>
                                                            @if($item->description)
                                                                <span class="text-xs text-gray-400 mt-1 truncate max-w-xs" title="{{ $item->description }}">{{ Str::limit($item->description, 50) }}</span>
                                                            @endif
                                                            
                                                            @php
                                                                $isOriginalItem = $tender->design->items->where('item_name', $item->item_name)->where('category_id', $item->category_id)->count() > 0;
                                                            @endphp
                                                            
                                                            @if(!$isOriginalItem)
                                                                <span class="inline-block mt-2 px-2 py-0.5 rounded text-[10px] font-bold bg-orange-100 text-orange-700 w-fit">
                                                                    <i class="fas fa-plus rtl:ml-1 ltr:mr-1"></i> {{ __('app.additional') }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-4 text-center">
                                                        <span class="font-bold text-gray-700">{{ $item->formatted_quantity }}</span>
                                                        <span class="text-xs text-gray-400 block">{{ $item->unit ?? '-' }}</span>
                                                    </td>
                                                    
                                                    @php
                                                        $originalItem = $tender->design->items->where('item_name', $item->item_name)->where('category_id', $item->category_id)->first();
                                                        $originalUnitPrice = $originalItem ? $originalItem->unit_price : 0;
                                                    @endphp
                                                    
                                                    <td class="px-4 py-4 text-center bg-[#2f5c69]/5 border-l border-[#2f5c69]/10">
                                                        @if($isOriginalItem)
                                                            <span class="font-bold text-[#2f5c69]">{{ number_format($originalUnitPrice, 2) }}</span>
                                                        @else
                                                            <span class="text-gray-300">-</span>
                                                        @endif
                                                    </td>

                                                    @foreach($tender->proposals as $proposal)
                                                        @php
                                                            $proposalItem = $proposal->proposalItems->where('tender_item_id', $item->id)->first();
                                                            $proposedPrice = $proposalItem ? $proposalItem->unit_price : 0;
                                                            
                                                            if ($isOriginalItem) {
                                                                $priceDifference = $originalUnitPrice - $proposedPrice;
                                                                $priceChangePercent = $originalUnitPrice > 0 ? (($priceDifference / $originalUnitPrice) * 100) : 0;
                                                            } else {
                                                                $priceDifference = 0;
                                                                $priceChangePercent = 0;
                                                            }
                                                        @endphp

                                                        <td class="px-4 py-4 text-center border-l border-gray-100 {{ $proposalItem ? 'bg-green-50/20' : '' }}">
                                                            @if($proposalItem)
                                                                <span class="font-bold text-gray-900 block">{{ number_format($proposalItem->unit_price, 2) }}</span>
                                                                @if(!$proposalItem->is_available)
                                                                    <span class="text-[10px] text-red-500 font-bold"><i class="fas fa-times-circle"></i> {{ __('app.not_available') }}</span>
                                                                @endif
                                                                @if($proposalItem->notes)
                                                                    <i class="fas fa-info-circle text-[#f3a446] ml-1 cursor-help" title="{{ $proposalItem->notes }}"></i>
                                                                @endif
                                                            @else
                                                                <span class="text-gray-300">-</span>
                                                            @endif
                                                        </td>
                                                        <td class="px-4 py-4 text-center border-l border-gray-200">
                                                            @if($isOriginalItem && $proposalItem)
                                                                <div class="flex flex-col items-center">
                                                                    @if($priceDifference > 0)
                                                                        <span class="text-xs font-bold text-green-600 bg-green-100 px-1.5 py-0.5 rounded">
                                                                            +{{ number_format($priceDifference, 2) }}
                                                                        </span>
                                                                    @elseif($priceDifference < 0)
                                                                        <span class="text-xs font-bold text-red-600 bg-red-100 px-1.5 py-0.5 rounded">
                                                                            {{ number_format($priceDifference, 2) }}
                                                                        </span>
                                                                    @else
                                                                        <span class="text-xs text-gray-400">-</span>
                                                                    @endif
                                                                </div>
                                                            @elseif(!$isOriginalItem && $proposalItem)
                                                                 <span class="text-xs font-bold text-[#f3a446]">{{ __('app.new') }}</span>
                                                            @else
                                                                <span class="text-gray-300">-</span>
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($tender->proposals as $proposal)
                @php
                    $proposalTotal = $proposal->proposalItems->sum('total_price');
                    $originalTotal = $tender->design->items->sum('total_price');
                    $totalDifference = $originalTotal - $proposalTotal;
                    $percentageChange = $originalTotal > 0 ? (($totalDifference / $originalTotal) * 100) : 0;
                    $availableItems = $proposal->proposalItems->where('is_available', true)->count();
                    $totalItems = $proposal->proposalItems->count();
                    $availabilityRate = $totalItems > 0 ? (($availableItems / $totalItems) * 100) : 0;
                @endphp

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col h-full relative group">
                    <div class="absolute top-0 right-0 w-1.5 h-full {{ $proposal->status === 'accepted' ? 'bg-green-500' : ($proposal->status === 'rejected' ? 'bg-red-500' : 'bg-[#f3a446]') }}"></div>
                    
                    <div class="p-6 pb-4 border-b border-gray-50 flex items-start justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-[#2f5c69] text-white rounded-2xl flex items-center justify-center text-xl font-bold shadow-lg shadow-[#2f5c69]/20">
                                {{ substr($proposal->consultant->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg">{{ $proposal->consultant->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $proposal->consultant->email }}</p>
                            </div>
                        </div>
                        @if($proposal->status === 'pending')
                            <span class="px-2 py-1 text-[10px] font-bold bg-yellow-100 text-yellow-700 rounded uppercase tracking-wider">{{ __('app.review_badge') }}</span>
                        @elseif($proposal->status === 'accepted')
                            <span class="px-2 py-1 text-[10px] font-bold bg-green-100 text-green-700 rounded uppercase tracking-wider">{{ __('app.accepted_badge') }}</span>
                        @elseif($proposal->status === 'rejected')
                            <span class="px-2 py-1 text-[10px] font-bold bg-red-100 text-red-700 rounded uppercase tracking-wider">{{ __('app.rejected_badge') }}</span>
                        @endif
                    </div>

                    <div class="p-6 flex-grow">
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-gray-50 rounded-xl p-3 text-center">
                                <div class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">{{ __('app.total') }}</div>
                                <div class="font-bold text-[#2f5c69] text-lg">{{ number_format($proposalTotal, 2) }}</div>
                                <div class="text-[10px] text-gray-400">{{ __('app.currency') }}</div>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-3 text-center">
                                <div class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">{{ __('app.duration') }}</div>
                                <div class="font-bold text-[#f3a446] text-lg">{{ $proposal->duration_months }}</div>
                                <div class="text-[10px] text-gray-400">{{ __('app.month') }}</div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-gray-500 font-bold">{{ __('app.saving_increase_ratio') }}</span>
                                    <span class="font-bold {{ $totalDifference > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $totalDifference > 0 ? '+' : '' }}{{ number_format($percentageChange, 1) }}%
                                    </span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-1.5">
                                    <div class="h-1.5 rounded-full {{ $totalDifference > 0 ? 'bg-green-500' : 'bg-red-500' }}" style="width: {{ min(abs($percentageChange), 100) }}%"></div>
                                </div>
                            </div>

                            <div>
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-gray-500 font-bold">{{ __('app.items_availability') }}</span>
                                    <span class="font-bold text-[#2f5c69]">{{ number_format($availabilityRate, 0) }}%</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-1.5">
                                    <div class="bg-[#2f5c69] h-1.5 rounded-full" style="width: {{ $availabilityRate }}%"></div>
                                </div>
                            </div>
                        </div>
                        
                        @if($proposal->proposal_text)
                        <div class="mt-4 p-3 bg-gray-50/50 rounded-lg border border-gray-100">
                            <p class="text-xs text-gray-600 italic line-clamp-2">"{{ Str::limit($proposal->proposal_text, 100) }}"</p>
                        </div>
                        @endif
                    </div>

                    <div class="p-4 bg-gray-50 border-t border-gray-100 flex gap-2">
                        <a href="{{ route('proposals.show', $proposal->id) }}" class="flex-1 py-2 text-center text-sm font-bold text-[#2f5c69] bg-white border border-gray-200 rounded-lg hover:bg-[#2f5c69] hover:text-white transition-all shadow-sm">
                            {{ __('app.view_details') }}
                        </a>
                        @if($proposal->status === 'pending')
                            <form action="{{ route('proposals.accept', $proposal->id) }}" method="POST">
                                @csrf
                                <button type="submit" onclick="return confirm('{{ __('app.confirm_accept_q') }}')" class="w-10 h-10 flex items-center justify-center rounded-lg bg-green-100 text-green-600 hover:bg-green-600 hover:text-white transition-all">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            <form action="{{ route('proposals.reject', $proposal->id) }}" method="POST">
                                @csrf
                                <button type="submit" onclick="return confirm('{{ __('app.confirm_reject_q') }}')" class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-100 text-red-600 hover:bg-red-600 hover:text-white transition-all">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

    @else
        <div class="bg-white rounded-2xl shadow-lg p-16 text-center border border-gray-100">
            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-inbox text-4xl text-gray-300"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ __('app.no_proposals') }}</h3>
            <p class="text-gray-500 max-w-md mx-auto">{{ __('app.no_proposals_desc') }}</p>
        </div>
    @endif
</div>

<div id="acceptModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-[#1a262a]/70 transition-opacity backdrop-blur-sm" aria-hidden="true" onclick="closeAcceptModal()"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-2xl text-right overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-gray-100">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-check text-green-600 text-lg"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:mr-4 sm:text-right w-full">
                        <h3 class="text-xl leading-6 font-bold text-gray-900" id="modal-title">
                            {{ __('app.modal_accept_title') }}
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 mb-4">
                                {{ __('app.modal_accept_desc') }}
                            </p>
                            
                            <form id="acceptForm" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="accept_notes" class="block text-sm font-bold text-gray-700 mb-2">{{ __('app.additional_notes') }}</label>
                                    <div class="relative rounded-md shadow-sm">
                                        <textarea id="accept_notes" name="client_notes" rows="3"
                                            class="block w-full rounded-xl border-gray-300 pr-4 pl-12 py-3 focus:ring-[#2f5c69] focus:border-[#2f5c69] sm:text-sm bg-gray-50 transition-colors placeholder-gray-400"
                                            placeholder="{{ __('app.notes_placeholder') }}"></textarea>
                                        <div class="absolute inset-y-0 left-0 pl-3 pt-3 pointer-events-none">
                                            <i class="fas fa-pen text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-gray-50 -mx-6 -mb-6 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2 mt-6">
                                    <button type="submit"
                                        class="w-full inline-flex justify-center items-center rounded-xl border border-transparent shadow-sm px-5 py-3 bg-green-600 text-base font-bold text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm transition-all hover:scale-[1.02]">
                                        <i class="fas fa-check rtl:ml-2 ltr:mr-2"></i>
                                        {{ __('app.confirm_accept_btn') }}
                                    </button>
                                    <button type="button" onclick="closeAcceptModal()"
                                        class="mt-3 w-full inline-flex justify-center items-center rounded-xl border border-gray-300 shadow-sm px-5 py-3 bg-white text-base font-bold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2f5c69] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-all">
                                        {{ __('app.cancel') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="rejectModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-[#1a262a]/70 transition-opacity backdrop-blur-sm" aria-hidden="true" onclick="closeRejectModal()"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-2xl text-right overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-gray-100">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-times text-red-600 text-lg"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:mr-4 sm:text-right w-full">
                        <h3 class="text-xl leading-6 font-bold text-gray-900" id="modal-title">
                            {{ __('app.modal_reject_title') }}
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 mb-4">
                                {{ __('app.modal_reject_desc') }}
                            </p>
                            
                            <form id="rejectForm" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="reject_notes" class="block text-sm font-bold text-gray-700 mb-2">{{ __('app.reject_reason') }}</label>
                                    <div class="relative rounded-md shadow-sm">
                                        <textarea id="reject_notes" name="client_notes" rows="3" required
                                            class="block w-full rounded-xl border-gray-300 pr-4 pl-12 py-3 focus:ring-red-500 focus:border-red-500 sm:text-sm bg-gray-50 transition-colors placeholder-gray-400"
                                            placeholder="{{ __('app.reject_placeholder') }}"></textarea>
                                        <div class="absolute inset-y-0 left-0 pl-3 pt-3 pointer-events-none">
                                            <i class="fas fa-comment-slash text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-gray-50 -mx-6 -mb-6 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2 mt-6">
                                    <button type="submit"
                                        class="w-full inline-flex justify-center items-center rounded-xl border border-transparent shadow-sm px-5 py-3 bg-red-600 text-base font-bold text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition-all hover:scale-[1.02]">
                                        <i class="fas fa-times ml-2"></i>
                                        {{ __('app.confirm_reject_btn') }}
                                    </button>
                                    <button type="button" onclick="closeRejectModal()"
                                        class="mt-3 w-full inline-flex justify-center items-center rounded-xl border border-gray-300 shadow-sm px-5 py-3 bg-white text-base font-bold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2f5c69] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-all">
                                        {{ __('app.cancel') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function showAcceptModal(proposalId) {
    document.getElementById('acceptForm').action = `/proposals/${proposalId}/accept`;
    document.getElementById('acceptModal').classList.remove('hidden');
}

function closeAcceptModal() {
    document.getElementById('acceptModal').classList.add('hidden');
}

function showRejectModal(proposalId) {
    document.getElementById('rejectForm').action = `/proposals/${proposalId}/reject`;
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}

// Close modals when clicking outside
window.onclick = function(event) {
    const acceptModal = document.getElementById('acceptModal');
    const rejectModal = document.getElementById('rejectModal');

    if (event.target === acceptModal) {
        closeAcceptModal();
    }
    if (event.target === rejectModal) {
        closeRejectModal();
    }
}
</script>

@endsection
