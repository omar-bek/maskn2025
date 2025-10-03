<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مقارنة العروض - {{ $tender->title }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            direction: rtl;
            text-align: right;
            margin: 0;
            padding: 20px;
            background-color: #fff;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }

        .header h1 {
            color: #333;
            margin: 0;
            font-size: 24px;
        }

        .header h2 {
            color: #666;
            margin: 10px 0;
            font-size: 18px;
        }

        .tender-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            font-size: 12px;
            color: #666;
        }

        .summary-section {
            margin-bottom: 30px;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .summary-card {
            background-color: white;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .summary-card h4 {
            margin: 0 0 5px 0;
            font-size: 12px;
            color: #666;
        }

        .summary-card .value {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .category-section {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }

        .category-title {
            background-color: #333;
            color: white;
            padding: 10px;
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 10px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .items-table th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }

        .items-table .item-name {
            text-align: right;
            font-weight: bold;
        }

        .original-price {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        .proposed-price {
            background-color: #e8f5e8;
            color: #2e7d32;
        }

        .difference {
            background-color: #fff3e0;
            color: #f57c00;
        }

        .additional-item {
            background-color: #fff8e1;
            color: #f9a825;
        }

        .additional-badge {
            background-color: #ff9800;
            color: white;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            margin-right: 5px;
        }

        .not-available {
            color: #999;
            font-style: italic;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        @media print {
            body { margin: 0; }
            .page-break { page-break-before: always; }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>مقارنة العروض</h1>
        <h2>{{ $tender->title }}</h2>
        <div class="tender-info">
            <span>التاريخ: {{ $tender->created_at->format('Y-m-d') }}</span>
            <span>الموقع: {{ $tender->location }}</span>
            <span>الميزانية: {{ $tender->formatted_budget }}</span>
        </div>
    </div>

    @if($tender->proposals->count() > 0)
        <!-- Summary Section -->
        <div class="summary-section">
            <h3 style="margin-top: 0;">ملخص العروض المقدمة</h3>
            <div class="summary-grid">
                <div class="summary-card">
                    <h4>إجمالي العروض</h4>
                    <div class="value">{{ $tender->proposals->count() }}</div>
                </div>
                <div class="summary-card">
                    <h4>أقل سعر</h4>
                    <div class="value">{{ number_format($tender->proposals->min('proposed_price'), 2) }} درهم</div>
                </div>
                <div class="summary-card">
                    <h4>أعلى سعر</h4>
                    <div class="value">{{ number_format($tender->proposals->max('proposed_price'), 2) }} درهم</div>
                </div>
                <div class="summary-card">
                    <h4>متوسط السعر</h4>
                    <div class="value">{{ number_format($tender->proposals->avg('proposed_price'), 2) }} درهم</div>
                </div>
            </div>
        </div>

        <!-- Detailed Items by Category -->
        <h3>البنود التفصيلية حسب الفئة</h3>

        @foreach($itemsByCategory as $categoryName => $items)
            <div class="category-section">
                <h4 class="category-title">{{ $categoryName }}</h4>

                <table class="items-table">
                    <thead>
                        <tr>
                            <th style="width: 20%;">اسم البند</th>
                            <th style="width: 8%;">الكمية</th>
                            <th style="width: 8%;">الوحدة</th>
                            <th style="width: 12%;">السعر الأصلي</th>
                            <th style="width: 12%;">الإجمالي الأصلي</th>
                            @foreach($tender->proposals as $proposal)
                                <th style="width: 12%;">{{ $proposal->consultant->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            @php
                                $isOriginalItem = $tender->design->items->where('item_name', $item->item_name)->where('category_id', $item->category_id)->count() > 0;
                                $originalItem = $tender->design->items->where('item_name', $item->item_name)->where('category_id', $item->category_id)->first();
                                $originalUnitPrice = $originalItem ? $originalItem->unit_price : 0;
                                $originalTotalPrice = $originalItem ? $originalItem->total_price : 0;
                            @endphp
                            <tr>
                                <td class="item-name">
                                    @if(!$isOriginalItem)
                                        <span class="additional-badge">إضافي</span>
                                    @endif
                                    {{ $item->item_name }}
                                </td>
                                <td>{{ number_format($item->quantity, 2) }}</td>
                                <td>{{ $item->unit ?? '-' }}</td>
                                <td class="original-price">
                                    @if($isOriginalItem)
                                        {{ number_format($originalUnitPrice, 2) }} درهم
                                    @else
                                        <span class="not-available">غير موجود</span>
                                    @endif
                                </td>
                                <td class="original-price">
                                    @if($isOriginalItem)
                                        {{ number_format($originalTotalPrice, 2) }} درهم
                                    @else
                                        <span class="not-available">غير موجود</span>
                                    @endif
                                </td>
                                @foreach($tender->proposals as $proposal)
                                    @php
                                        $proposalItem = $proposal->proposalItems->where('tender_item_id', $item->id)->first();
                                    @endphp
                                    <td class="proposed-price">
                                        @if($proposalItem)
                                            <div>
                                                <strong>{{ number_format($proposalItem->unit_price, 2) }} درهم</strong>
                                            </div>
                                            <div style="font-size: 8px; color: #666;">
                                                إجمالي: {{ number_format($proposalItem->total_price, 2) }} درهم
                                            </div>
                                            <div style="font-size: 8px;">
                                                @if($proposalItem->is_available)
                                                    <span style="color: green;">✓ متوفر</span>
                                                @else
                                                    <span style="color: red;">✗ غير متوفر</span>
                                                @endif
                                            </div>
                                            @if($proposalItem->notes)
                                                <div style="font-size: 8px; color: #666; margin-top: 2px;">
                                                    {{ $proposalItem->notes }}
                                                </div>
                                            @endif
                                        @else
                                            <span class="not-available">لم يقدم عرض</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach

        <!-- Detailed Analysis -->
        <div class="page-break"></div>
        <h3>تحليل مفصل لكل استشاري</h3>

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

            <div style="margin-bottom: 30px; border: 1px solid #ddd; padding: 15px; border-radius: 5px;">
                <h4 style="margin-top: 0; color: #333;">{{ $proposal->consultant->name }}</h4>

                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-bottom: 15px;">
                    <div>
                        <strong>السعر المقترح:</strong> {{ number_format($proposal->proposed_price, 2) }} درهم
                    </div>
                    <div>
                        <strong>مدة التنفيذ:</strong> {{ $proposal->duration_months }} شهر
                    </div>
                    <div>
                        <strong>تاريخ التقديم:</strong> {{ $proposal->created_at->format('Y-m-d') }}
                    </div>
                    <div>
                        <strong>الحالة:</strong>
                        @if($proposal->status === 'pending')
                            في الانتظار
                        @elseif($proposal->status === 'accepted')
                            مقبول
                        @elseif($proposal->status === 'rejected')
                            مرفوض
                        @endif
                    </div>
                </div>

                <div style="background-color: #f8f9fa; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; text-align: center;">
                        <div>
                            <div style="font-size: 12px; color: #666;">مقارنة مع السعر الأصلي</div>
                            <div style="font-weight: bold; color: {{ $totalDifference > 0 ? 'green' : 'red' }};">
                                {{ $totalDifference > 0 ? '+' : '' }}{{ number_format($totalDifference, 2) }} درهم
                                ({{ number_format($percentageChange, 1) }}%)
                            </div>
                        </div>
                        <div>
                            <div style="font-size: 12px; color: #666;">معدل توفر البنود</div>
                            <div style="font-weight: bold;">{{ number_format($availabilityRate, 1) }}%</div>
                        </div>
                        <div>
                            <div style="font-size: 12px; color: #666;">عدد البنود المتاحة</div>
                            <div style="font-weight: bold;">{{ $availableItems }}/{{ $totalItems }}</div>
                        </div>
                    </div>
                </div>

                @if($proposal->proposal_text)
                    <div>
                        <strong>نص العرض:</strong>
                        <div style="background-color: #f8f9fa; padding: 10px; border-radius: 5px; margin-top: 5px;">
                            {{ $proposal->proposal_text }}
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    @else
        <div style="text-align: center; padding: 40px; color: #666;">
            <h3>لا توجد عروض مقدمة لهذه المناقصة</h3>
        </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <p>تم إنشاء هذا التقرير في {{ date('Y-m-d H:i:s') }}</p>
        <p>منصة مسكن - مقارنة العروض</p>
    </div>
</body>
</html>

