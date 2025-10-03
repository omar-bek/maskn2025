@extends('layouts.app')

@section('title', 'عرض التصميم مع التسعير')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Project Header -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <div class="border-b pb-4 mb-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $design->title }}</h1>
            <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                <span><strong>النمط:</strong> {{ $design->style }}</span>
                <span><strong>المساحة:</strong> {{ $design->area }} م²</span>
                <span><strong>الموقع:</strong> {{ $design->location }}</span>
                <span><strong>عدد الطوابق:</strong> {{ $design->floors }}</span>
                <span><strong>عدد غرف النوم:</strong> {{ $design->bedrooms }}</span>
                <span><strong>عدد الحمامات:</strong> {{ $design->bathrooms }}</span>
            </div>
        </div>

        <!-- Description -->
        @if($design->description)
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">وصف المشروع</h3>
            <p class="text-gray-700 leading-relaxed">{{ $design->description }}</p>
        </div>
        @endif

        <!-- Features -->
        @if($design->features)
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">المميزات</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($design->features as $feature)
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">{{ $feature }}</span>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Pricing Summary -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-6 mb-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">ملخص التكلفة الإجمالية</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="text-center">
                <div class="text-3xl font-bold text-blue-600">{{ number_format($totalAmount, 2) }}</div>
                <div class="text-sm text-gray-600">المجموع الكلي (ريال)</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-green-600">{{ $design->items()->count() }}</div>
                <div class="text-sm text-gray-600">عدد البنود</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-purple-600">{{ $categoryTotals->count() }}</div>
                <div class="text-sm text-gray-600">عدد الفئات</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-orange-600">{{ number_format($totalAmount / $design->area, 2) }}</div>
                <div class="text-sm text-gray-600">تكلفة المتر المربع</div>
            </div>
        </div>
    </div>

    <!-- Category Totals -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">إجمالي التكلفة حسب الفئة</h2>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-right text-sm font-medium text-gray-700">الفئة</th>
                        <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">عدد البنود</th>
                        <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">المجموع</th>
                        <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">النسبة المئوية</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($categoryTotals as $categoryTotal)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $categoryTotal->category_name }}</td>
                            <td class="px-4 py-3 text-center text-sm text-gray-900">
                                {{ $design->items()->where('category_id', $categoryTotal->id)->count() }}
                            </td>
                            <td class="px-4 py-3 text-center text-sm font-medium text-gray-900">
                                {{ number_format($categoryTotal->total, 2) }} ريال
                            </td>
                            <td class="px-4 py-3 text-center text-sm text-gray-900">
                                {{ $totalAmount > 0 ? number_format(($categoryTotal->total / $totalAmount) * 100, 1) : 0 }}%
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-100">
                    <tr>
                        <td class="px-4 py-3 text-right text-sm font-bold text-gray-900">المجموع الكلي</td>
                        <td class="px-4 py-3 text-center text-sm font-bold text-gray-900">{{ $design->items()->count() }}</td>
                        <td class="px-4 py-3 text-center text-sm font-bold text-gray-900">{{ number_format($totalAmount, 2) }} ريال</td>
                        <td class="px-4 py-3 text-center text-sm font-bold text-gray-900">100%</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Detailed Items by Category -->
    @if($itemsByCategory->count() > 0)
        <div class="space-y-6">
            @foreach($itemsByCategory as $categoryName => $items)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="bg-gray-100 px-6 py-4 border-b">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $categoryName }}</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-right text-sm font-medium text-gray-700">اسم البند</th>
                                    <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">الكمية</th>
                                    <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">الوحدة</th>
                                    <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">سعر الوحدة</th>
                                    <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">المجموع</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($items as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $item->item_name }}</div>
                                                @if($item->notes)
                                                    <div class="text-xs text-gray-500 mt-1">{{ $item->notes }}</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-center text-sm text-gray-900">
                                            {{ $item->quantity ? number_format($item->quantity, 2) : '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-center text-sm text-gray-900">{{ $item->unit ?? '-' }}</td>
                                        <td class="px-4 py-3 text-center text-sm text-gray-900">
                                            {{ $item->unit_price ? number_format($item->unit_price, 2) : '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-center text-sm font-medium text-gray-900">
                                            {{ number_format($item->total_price, 2) }} ريال
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-100">
                                <tr>
                                    <td colspan="4" class="px-4 py-3 text-right text-sm font-medium text-gray-700">
                                        مجموع {{ $categoryName }}:
                                    </td>
                                    <td class="px-4 py-3 text-center text-sm font-bold text-gray-900">
                                        {{ number_format($items->sum('total_price'), 2) }} ريال
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Grand Total -->
        <div class="mt-8 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-lg p-6">
            <div class="text-center">
                <div class="text-4xl font-bold text-green-600 mb-2">
                    {{ number_format($totalAmount, 2) }} ريال
                </div>
                <div class="text-xl text-green-700 mb-4">المجموع الكلي للمشروع</div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div class="bg-white rounded-lg p-3">
                        <div class="font-medium text-gray-700">تكلفة المتر المربع</div>
                        <div class="text-lg font-bold text-blue-600">{{ number_format($totalAmount / $design->area, 2) }} ريال/م²</div>
                    </div>
                    <div class="bg-white rounded-lg p-3">
                        <div class="font-medium text-gray-700">عدد البنود</div>
                        <div class="text-lg font-bold text-purple-600">{{ $design->items()->count() }} بند</div>
                    </div>
                    <div class="bg-white rounded-lg p-3">
                        <div class="font-medium text-gray-700">عدد الفئات</div>
                        <div class="text-lg font-bold text-orange-600">{{ $categoryTotals->count() }} فئة</div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            <div class="text-gray-500 text-lg mb-4">لا توجد بنود تسعير لهذا المشروع بعد</div>
            <a href="{{ route('designs.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition duration-200">
                إضافة بنود التسعير
            </a>
        </div>
    @endif

    <!-- Actions -->
    <div class="flex justify-center gap-4 mt-8">
        <a href="{{ route('designs.show', $design->id) }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition duration-200">
            عرض التسعير التفصيلي
        </a>
        @auth
            <a href="{{ route('tenders.create-from-design', $design->id) }}"
               class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg transition duration-200">
                إنشاء مناقصة من هذا التصميم
            </a>
        @endauth
        <a href="{{ route('designs.create') }}"
           class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition duration-200">
            إضافة بند جديد
        </a>
        <a href="{{ route('designs.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition duration-200">
            العودة للتصاميم
        </a>
    </div>
</div>
@endsection
