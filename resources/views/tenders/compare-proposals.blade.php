@extends('layouts.app')

@section('title', 'مقارنة العروض - ' . $tender->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">مقارنة العروض</h1>
                <h2 class="text-xl text-gray-600 mb-4">{{ $tender->title }}</h2>
                <div class="flex items-center space-x-4 text-sm text-gray-500">
                    <span><i class="fas fa-calendar ml-1"></i> {{ $tender->created_at->format('Y-m-d') }}</span>
                    <span><i class="fas fa-map-marker-alt ml-1"></i> {{ $tender->location }}</span>
                    <span><i class="fas fa-money-bill-wave ml-1"></i> {{ $tender->formatted_budget }}</span>
                </div>
            </div>
            <div class="text-left">
                <div class="flex space-x-3 space-x-reverse">
                    <a href="{{ route('tenders.show', $tender->id) }}"
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        <i class="fas fa-arrow-right ml-2"></i>
                        العودة للمناقصة
                    </a>
                    <a href="{{ route('tenders.export-pdf', $tender->id) }}"
                       class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        <i class="fas fa-file-pdf ml-2"></i>
                        تصدير PDF
                    </a>
                    <a href="{{ route('tenders.export-excel', $tender->id) }}"
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        <i class="fas fa-file-excel ml-2"></i>
                        تصدير Excel
                    </a>
                </div>
            </div>
        </div>
    </div>


    @if($tender->proposals->count() > 0)
        <!-- Proposals Summary -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">ملخص العروض المقدمة</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <i class="fas fa-file-alt text-blue-600 text-2xl ml-3"></i>
                        <div>
                            <p class="text-sm text-blue-600">إجمالي العروض</p>
                            <p class="text-2xl font-bold text-blue-800">{{ $tender->proposals->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <i class="fas fa-money-bill-wave text-green-600 text-2xl ml-3"></i>
                        <div>
                            <p class="text-sm text-green-600">أقل سعر</p>
                            <p class="text-2xl font-bold text-green-800">
                                {{ number_format($tender->proposals->min('proposed_price'), 2) }} درهم
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <i class="fas fa-money-bill-wave text-red-600 text-2xl ml-3"></i>
                        <div>
                            <p class="text-sm text-red-600">أعلى سعر</p>
                            <p class="text-2xl font-bold text-red-800">
                                {{ number_format($tender->proposals->max('proposed_price'), 2) }} درهم
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <i class="fas fa-clock text-orange-600 text-2xl ml-3"></i>
                        <div>
                            <p class="text-sm text-orange-600">متوسط المدة</p>
                            <p class="text-2xl font-bold text-orange-800">
                                {{ round($tender->proposals->avg('duration_months'), 1) }} شهر
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- مقارنة مع السعر الأصلي -->
            @php
                $originalTotal = $tender->design->items->sum('total_price');
                $minProposalPrice = $tender->proposals->min('proposed_price');
                $maxProposalPrice = $tender->proposals->max('proposed_price');
                $avgProposalPrice = $tender->proposals->avg('proposed_price');
                $minDifference = $originalTotal - $minProposalPrice; // السعر الأصلي - أقل سعر مقترح
                $maxDifference = $originalTotal - $maxProposalPrice; // السعر الأصلي - أعلى سعر مقترح
                $avgDifference = $originalTotal - $avgProposalPrice; // السعر الأصلي - متوسط السعر المقترح
            @endphp

            @if($originalTotal > 0)
            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                <h4 class="text-lg font-semibold text-gray-800 mb-3">مقارنة مع السعر الأصلي للتصميم</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="text-center">
                        <div class="text-sm text-gray-600">السعر الأصلي للتصميم</div>
                        <div class="text-xl font-bold text-blue-600">{{ number_format($originalTotal, 2) }} درهم</div>
                    </div>
                    <div class="text-center">
                        <div class="text-sm text-gray-600">أقل عرض مقارنة بالأصلي</div>
                        <div class="text-xl font-bold {{ $minDifference > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $minDifference > 0 ? '+' : '' }}{{ number_format($minDifference, 2) }} درهم
                            ({{ number_format(($minDifference / $originalTotal) * 100, 1) }}%)
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="text-sm text-gray-600">أعلى عرض مقارنة بالأصلي</div>
                        <div class="text-xl font-bold {{ $maxDifference > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $maxDifference > 0 ? '+' : '' }}{{ number_format($maxDifference, 2) }} درهم
                            ({{ number_format(($maxDifference / $originalTotal) * 100, 1) }}%)
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Proposals Comparison Table -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h3 class="text-xl font-semibold text-gray-800">مقارنة تفصيلية للعروض</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-right text-sm font-medium text-gray-700">الاستشاري</th>
                            <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">السعر الإجمالي</th>
                            <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">مدة التنفيذ</th>
                            <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">تاريخ التقديم</th>
                            <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">الحالة</th>
                            <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($tender->proposals->sortBy('proposed_price') as $proposal)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center ml-3">
                                            <i class="fas fa-user text-blue-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $proposal->consultant->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $proposal->consultant->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="text-lg font-bold text-green-600">
                                        {{ number_format($proposal->proposed_price, 2) }} درهم
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="text-sm text-gray-900">{{ $proposal->duration_months }} شهر</span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="text-sm text-gray-500">{{ $proposal->created_at->format('Y-m-d') }}</span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if($proposal->status === 'pending')
                                        <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                            في الانتظار
                                        </span>
                                    @elseif($proposal->status === 'accepted')
                                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                            مقبول
                                        </span>
                                    @elseif($proposal->status === 'rejected')
                                        <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                                            مرفوض
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex space-x-2 justify-center">
                                        <a href="{{ route('proposals.show', $proposal->id) }}"
                                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm transition duration-200">
                                            <i class="fas fa-eye ml-1"></i>
                                            عرض التفاصيل
                                        </a>
                                        @if($proposal->status === 'pending')
                                            <button type="button"
                                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm transition duration-200"
                                                    onclick="showAcceptModal({{ $proposal->id }})">
                                                <i class="fas fa-check ml-1"></i>
                                                قبول
                                            </button>
                                            <button type="button"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm transition duration-200"
                                                    onclick="showRejectModal({{ $proposal->id }})">
                                                <i class="fas fa-times ml-1"></i>
                                                رفض
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

        <!-- Items Comparison -->
        @if($itemsByCategory && $itemsByCategory->count() > 0)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <h3 class="text-xl font-semibold text-gray-800">مقارنة تفصيلية لأسعار البنود</h3>
                    <p class="text-sm text-gray-600 mt-1">مقارنة شاملة بين الأسعار الأصلية في التصميم والأسعار المقدمة في العروض</p>
                    <div class="mt-2 flex flex-wrap gap-4 text-xs">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-blue-100 rounded ml-2"></div>
                            <span class="text-gray-600">السعر الأصلي من التصميم</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-100 rounded ml-2"></div>
                            <span class="text-gray-600">السعر المقترح من الاستشاري</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-yellow-100 rounded ml-2"></div>
                            <span class="text-gray-600">الفرق بين السعرين</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-purple-100 rounded ml-2"></div>
                            <span class="text-gray-600">ملاحظات الاستشاري</span>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="space-y-6">
                        @foreach($itemsByCategory as $categoryName => $items)
                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                <div class="bg-gray-100 px-4 py-3 border-b">
                                    <h4 class="font-semibold text-gray-800">{{ $categoryName }}</h4>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="w-full">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-4 py-3 text-right text-sm font-medium text-gray-700">اسم البند</th>
                                                <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">الكمية</th>
                                                <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">الوحدة</th>
                                                <th class="px-4 py-3 text-center text-sm font-medium text-gray-700 bg-blue-50">السعر الأصلي</th>
                                                <th class="px-4 py-3 text-center text-sm font-medium text-gray-700 bg-blue-50">الإجمالي الأصلي</th>
                                                @foreach($tender->proposals as $proposal)
                                                    <th class="px-4 py-3 text-center text-sm font-medium text-gray-700" colspan="3">
                                                        {{ $proposal->consultant->name }}
                                                    </th>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th colspan="5" class="px-4 py-2 text-center text-xs text-gray-500 bg-gray-100">البيانات الأساسية</th>
                                                @foreach($tender->proposals as $proposal)
                                                    <th class="px-4 py-2 text-center text-xs text-gray-500 bg-green-50">السعر المقترح</th>
                                                    <th class="px-4 py-2 text-center text-xs text-gray-500 bg-yellow-50">الفرق</th>
                                                    <th class="px-4 py-2 text-center text-xs text-gray-500 bg-purple-50">ملاحظات</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            @foreach($items as $item)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                                        <div>
                                                            <div class="flex items-center">
                                                                {{ $item->item_name }}
                                                                @php
                                                                    // تحقق إذا كان البند أصلي من التصميم أم إضافي من الاستشاري
                                                                    $isOriginalItem = $tender->design->items->where('item_name', $item->item_name)->where('category_id', $item->category_id)->count() > 0;
                                                                @endphp
                                                                @if(!$isOriginalItem)
                                                                    <span class="mr-2 px-2 py-1 text-xs bg-orange-100 text-orange-800 rounded-full">
                                                                        <i class="fas fa-plus ml-1"></i>إضافي
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            @if($item->description)
                                                                <div class="text-xs text-gray-500 mt-1">{{ $item->description }}</div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-3 text-center text-sm text-gray-900">{{ $item->formatted_quantity }}</td>
                                                    <td class="px-4 py-3 text-center text-sm text-gray-900">{{ $item->unit ?? '-' }}</td>

                                                    <!-- السعر الأصلي من التصميم -->
                                                    @php
                                                        // البحث عن البند الأصلي في التصميم بناءً على الاسم والفئة
                                                        $originalItem = $tender->design->items->where('item_name', $item->item_name)->where('category_id', $item->category_id)->first();
                                                        $originalUnitPrice = $originalItem ? $originalItem->unit_price : 0;
                                                        $originalTotalPrice = $originalItem ? $originalItem->total_price : 0;
                                                    @endphp
                                                    <td class="px-4 py-3 text-center bg-blue-50">
                                                        <div class="text-sm">
                                                            @if($isOriginalItem)
                                                                <div class="font-medium text-blue-800">
                                                                    {{ number_format($originalUnitPrice, 2) }} درهم
                                                                </div>
                                                            @else
                                                                <div class="font-medium text-gray-500">
                                                                    <i class="fas fa-minus ml-1"></i>غير موجود
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </td>

                                                    <!-- الإجمالي الأصلي من التصميم -->
                                                    <td class="px-4 py-3 text-center bg-blue-50">
                                                        <div class="text-sm">
                                                            @if($isOriginalItem)
                                                                <div class="font-medium text-blue-800">
                                                                    {{ number_format($originalTotalPrice, 2) }} درهم
                                                                </div>
                                                            @else
                                                                <div class="font-medium text-gray-500">
                                                                    <i class="fas fa-minus ml-1"></i>غير موجود
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </td>

                                                    @foreach($tender->proposals as $proposal)
                                                        @php
                                                            $proposalItem = $proposal->proposalItems->where('tender_item_id', $item->id)->first();
                                                            $proposedPrice = $proposalItem ? $proposalItem->unit_price : 0;
                                                            $proposedTotal = $proposalItem ? $proposalItem->total_price : 0;
                                                            // حساب الفرق فقط للبنود الأصلية
                                                            if ($isOriginalItem) {
                                                                $priceDifference = $originalUnitPrice - $proposedPrice; // السعر الأصلي - السعر المقترح
                                                                $totalDifference = $originalTotalPrice - $proposedTotal; // الإجمالي الأصلي - الإجمالي المقترح
                                                                $priceChangePercent = $originalUnitPrice > 0 ? (($priceDifference / $originalUnitPrice) * 100) : 0;
                                                            } else {
                                                                $priceDifference = 0; // لا يوجد سعر أصلي للمقارنة
                                                                $totalDifference = 0;
                                                                $priceChangePercent = 0;
                                                            }
                                                        @endphp

                                                        <!-- السعر المقترح -->
                                                        <td class="px-4 py-3 text-center bg-green-50">
                                                            @if($proposalItem)
                                                                <div class="text-sm">
                                                                    <div class="font-medium text-gray-900">
                                                                        {{ number_format($proposalItem->unit_price, 2) }} درهم
                                                                    </div>
                                                                    <div class="text-xs text-gray-600 mt-1">
                                                                        إجمالي: {{ number_format($proposalItem->total_price, 2) }} درهم
                                                                    </div>
                                                                    <div class="text-xs mt-1">
                                                                        @if($proposalItem->is_available)
                                                                            <span class="text-green-600 font-medium">
                                                                                <i class="fas fa-check-circle ml-1"></i>متوفر
                                                                            </span>
                                                                        @else
                                                                            <span class="text-red-600 font-medium">
                                                                                <i class="fas fa-times-circle ml-1"></i>غير متوفر
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <span class="text-gray-400 text-sm">لم يقدم عرض</span>
                                                            @endif
                                                        </td>

                                                        <!-- الفرق -->
                                                        <td class="px-4 py-3 text-center bg-yellow-50">
                                                            @if($proposalItem)
                                                                <div class="text-sm">
                                                                    @if($isOriginalItem)
                                                                        <!-- الفرق في السعر للبنود الأصلية -->
                                                                        <div class="font-medium">
                                                                            @if($priceDifference > 0)
                                                                                <span class="text-green-600">
                                                                                    +{{ number_format($priceDifference, 2) }} درهم
                                                                                </span>
                                                                            @elseif($priceDifference < 0)
                                                                                <span class="text-red-600">
                                                                                    {{ number_format($priceDifference, 2) }} درهم
                                                                                </span>
                                                                            @else
                                                                                <span class="text-gray-500">بدون تغيير</span>
                                                                            @endif
                                                                        </div>
                                                                    @else
                                                                        <!-- للبنود الإضافية -->
                                                                        <div class="font-medium text-orange-600">
                                                                            <i class="fas fa-plus ml-1"></i>بند إضافي
                                                                        </div>
                                                                    @endif
                                                                </div>

                                                                    @if($isOriginalItem)
                                                                        <!-- النسبة المئوية للبنود الأصلية -->
                                                                        <div class="text-xs mt-1">
                                                                            @if($priceChangePercent != 0)
                                                                                <span class="{{ $priceChangePercent > 0 ? 'text-green-600' : 'text-red-600' }}">
                                                                                    ({{ number_format($priceChangePercent, 1) }}%)
                                                                                </span>
                                                                            @endif
                                                                        </div>

                                                                        <!-- الفرق في الإجمالي للبنود الأصلية -->
                                                                        <div class="text-xs mt-1 text-gray-600">
                                                                            @if($totalDifference > 0)
                                                                                <span class="text-green-600">
                                                                                    إجمالي: +{{ number_format($totalDifference, 2) }} درهم
                                                                                </span>
                                                                            @elseif($totalDifference < 0)
                                                                                <span class="text-red-600">
                                                                                    إجمالي: {{ number_format($totalDifference, 2) }} درهم
                                                                                </span>
                                                                            @else
                                                                                <span class="text-gray-500">إجمالي: بدون تغيير</span>
                                                                            @endif
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @else
                                                                <span class="text-gray-400 text-sm">-</span>
                                                            @endif
                                                        </td>

                                                        <!-- الملاحظات -->
                                                        <td class="px-4 py-3 text-center bg-purple-50">
                                                            @if($proposalItem && $proposalItem->notes)
                                                                <div class="text-xs text-blue-600 p-2 bg-blue-50 rounded">
                                                                    <i class="fas fa-sticky-note ml-1"></i>
                                                                    {{ $proposalItem->notes }}
                                                                </div>
                                                            @else
                                                                <span class="text-gray-400 text-sm">-</span>
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

        <!-- تحليل مفصل لكل استشاري -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h3 class="text-xl font-semibold text-gray-800">تحليل مفصل لكل استشاري</h3>
                <p class="text-sm text-gray-600 mt-1">تحليل شامل لأداء كل استشاري مقارنة بالسعر الأصلي</p>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @foreach($tender->proposals as $proposal)
                        @php
                            $proposalTotal = $proposal->proposalItems->sum('total_price');
                            $originalTotal = $tender->design->items->sum('total_price');
                            $totalDifference = $originalTotal - $proposalTotal; // السعر الأصلي - السعر المقترح
                            $percentageChange = $originalTotal > 0 ? (($totalDifference / $originalTotal) * 100) : 0;
                            $availableItems = $proposal->proposalItems->where('is_available', true)->count();
                            $totalItems = $proposal->proposalItems->count();
                            $availabilityRate = $totalItems > 0 ? (($availableItems / $totalItems) * 100) : 0;
                        @endphp

                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center ml-3">
                                        <i class="fas fa-user text-blue-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">{{ $proposal->consultant->name }}</h4>
                                        <p class="text-sm text-gray-500">{{ $proposal->consultant->email }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    @if($proposal->status === 'pending')
                                        <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                            في الانتظار
                                        </span>
                                    @elseif($proposal->status === 'accepted')
                                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                            مقبول
                                        </span>
                                    @elseif($proposal->status === 'rejected')
                                        <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                                            مرفوض
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- إحصائيات العرض -->
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div class="text-center p-3 bg-gray-50 rounded-lg">
                                    <div class="text-sm text-gray-600">السعر الإجمالي</div>
                                    <div class="text-lg font-bold text-gray-900">{{ number_format($proposalTotal, 2) }} درهم</div>
                                </div>
                                <div class="text-center p-3 bg-gray-50 rounded-lg">
                                    <div class="text-sm text-gray-600">مدة التنفيذ</div>
                                    <div class="text-lg font-bold text-gray-900">{{ $proposal->duration_months }} شهر</div>
                                </div>
                            </div>

                            <!-- مقارنة مع السعر الأصلي -->
                            <div class="mb-4 p-3 bg-blue-50 rounded-lg">
                                <div class="text-sm text-blue-600 mb-2">مقارنة مع السعر الأصلي</div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">الفرق:</span>
                                    <span class="font-bold {{ $totalDifference > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $totalDifference > 0 ? '+' : '' }}{{ number_format($totalDifference, 2) }} درهم
                                        ({{ number_format($percentageChange, 1) }}%)
                                    </span>
                                </div>
                            </div>

                            <!-- معدل التوفر -->
                            <div class="mb-4 p-3 bg-green-50 rounded-lg">
                                <div class="text-sm text-green-600 mb-2">معدل توفر البنود</div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">البنود المتاحة:</span>
                                    <span class="font-bold text-green-600">
                                        {{ $availableItems }}/{{ $totalItems }}
                                        ({{ number_format($availabilityRate, 1) }}%)
                                    </span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                                    <div class="bg-green-600 h-2 rounded-full" style="width: {{ $availabilityRate }}%"></div>
                                </div>
                            </div>

                            <!-- ملخص البنود -->
                            <div class="mb-4">
                                <div class="text-sm text-gray-600 mb-2">ملخص البنود</div>
                                <div class="space-y-1">
                                    @php
                                        $itemsByCategory = $proposal->proposalItems->groupBy('tenderItem.category.category_name');
                                    @endphp
                                    @foreach($itemsByCategory as $categoryName => $items)
                                        <div class="flex justify-between text-xs">
                                            <span class="text-gray-600">{{ $categoryName }}:</span>
                                            <span class="font-medium">{{ $items->count() }} بند - {{ number_format($items->sum('total_price'), 2) }} درهم</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- نص العرض -->
                            @if($proposal->proposal_text)
                            <div class="mb-4">
                                <div class="text-sm text-gray-600 mb-2">نص العرض</div>
                                <div class="text-xs text-gray-700 bg-gray-50 p-2 rounded max-h-20 overflow-y-auto">
                                    {{ Str::limit($proposal->proposal_text, 150) }}
                                </div>
                            </div>
                            @endif

                            <!-- الإجراءات -->
                            <div class="flex space-x-2">
                                <a href="{{ route('proposals.show', $proposal->id) }}"
                                   class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-3 rounded text-sm transition duration-200">
                                    <i class="fas fa-eye ml-1"></i>
                                    عرض التفاصيل
                                </a>
                                @if($proposal->status === 'pending')
                                    <form action="{{ route('proposals.accept', $proposal->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit"
                                                class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-3 rounded text-sm transition duration-200"
                                                onclick="return confirm('هل أنت متأكد من قبول هذا العرض؟')">
                                            <i class="fas fa-check ml-1"></i>
                                            قبول
                                        </button>
                                    </form>
                                    <form action="{{ route('proposals.reject', $proposal->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit"
                                                class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-3 rounded text-sm transition duration-200"
                                                onclick="return confirm('هل أنت متأكد من رفض هذا العرض؟')">
                                            <i class="fas fa-times ml-1"></i>
                                            رفض
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <!-- No Proposals -->
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">لا توجد عروض مقدمة بعد</h3>
            <p class="text-gray-500">لم يتم تقديم أي عروض على هذه المناقصة حتى الآن.</p>
        </div>
    @endif
</div>

<!-- Accept Proposal Modal -->
<div id="acceptModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">قبول العرض</h3>
            <form id="acceptForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="accept_notes" class="block text-sm font-medium text-gray-700 mb-2">ملاحظات العميل (اختياري)</label>
                    <textarea id="accept_notes" name="client_notes" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="أضف أي ملاحظات أو تعليقات..."></textarea>
                </div>
                <div class="flex justify-end space-x-3 space-x-reverse">
                    <button type="button" onclick="closeAcceptModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-200">
                        إلغاء
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-200">
                        تأكيد القبول
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Proposal Modal -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">رفض العرض</h3>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="reject_notes" class="block text-sm font-medium text-gray-700 mb-2">سبب الرفض (اختياري)</label>
                    <textarea id="reject_notes" name="client_notes" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="أضف سبب الرفض أو أي ملاحظات..."></textarea>
                </div>
                <div class="flex justify-end space-x-3 space-x-reverse">
                    <button type="button" onclick="closeRejectModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-200">
                        إلغاء
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition duration-200">
                        تأكيد الرفض
                    </button>
                </div>
            </form>
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
