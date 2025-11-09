@extends('layouts.app')

@section('title', 'عرض التصميم مع التسعير')

@section('content')
<div class="container mx-auto px-4 py-8 mt-40">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        
        <div class="lg:col-span-2">
            <div
                class="bg-white rounded-2xl shadow-xl border border-gray-100/50 p-6 md:p-8 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
                <div class="border-b border-gray-200 pb-6 mb-6">
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">{{ $design->title }}</h1>
                    <div class="flex flex-wrap gap-x-6 gap-y-3 text-base text-gray-700">
                        <span class="flex items-center"><i
                                class="fas fa-palette text-[#f3a446] ml-2"></i><strong>النمط:</strong><span
                                class="mr-1">{{ $design->style }}</span></span>
                        <span class="flex items-center"><i
                                class="fas fa-ruler-combined text-[#f3a446] ml-2"></i><strong>المساحة:</strong><span
                                class="mr-1">{{ $design->area }} م²</span></span>
                        <span class="flex items-center"><i
                                class="fas fa-map-marker-alt text-[#f3a446] ml-2"></i><strong>الموقع:</strong><span
                                class="mr-1">{{ $design->location }}</span></span>
                        <span class="flex items-center"><i class="fas fa-layer-group text-[#f3a446] ml-2"></i><strong>عدد
                                الطوابق:</strong><span class="mr-1">{{ $design->floors }}</span></span>
                        <span class="flex items-center"><i class="fas fa-bed text-[#f3a446] ml-2"></i><strong>غرف
                                النوم:</strong><span class="mr-1">{{ $design->bedrooms }}</span></span>
                        <span class="flex items-center"><i class="fas fa-bath text-[#f3a446] ml-2"></i><strong>عدد
                                الحمامات:</strong><span class="mr-1">{{ $design->bathrooms }}</span></span>
                    </div>
                </div>

                @if ($design->description)
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3 flex items-center"><i
                                class="fas fa-info-circle text-[#2f5c69] mr-2"></i>وصف المشروع</h3>
                        <p class="text-gray-700 leading-relaxed text-base">{{ $design->description }}</p>
                    </div>
                @endif

                @if ($design->features)
                    @php
                        $features = is_array($design->features) ? $design->features : json_decode($design->features, true);
                        $features = $features ?: [];
                    @endphp
                    @if (count($features) > 0)
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-3 flex items-center"><i
                                    class="fas fa-star text-[#2f5c69] mr-2"></i>المميزات</h3>
                            <div class="flex flex-wrap gap-3">
                                @foreach ($features as $feature)
                                    <span
                                        class="bg-[#f3a446]/10 text-[#f3a446] px-4 py-2 rounded-full text-sm font-medium border border-[#f3a446]/30">{{ $feature }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="lg:sticky top-28">
                <div
                    class="bg-white rounded-2xl shadow-xl border border-gray-100/50 p-6 md:p-8 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">ملخص التكلفة</h2>
                    <div class="grid grid-cols-2 gap-6">
                        <div
                            class="text-center bg-gray-50/50 border border-gray-200/60 rounded-xl p-4 transform transition-all duration-300 hover:scale-105 hover:shadow-md">
                            <div class="text-3xl font-bold text-[#f3a446]">{{ number_format($totalAmount, 2) }}</div>
                            <div class="text-sm font-medium text-gray-600 mt-2">المجموع (ريال)</div>
                        </div>
                        <div
                            class="text-center bg-gray-50/50 border border-gray-200/60 rounded-xl p-4 transform transition-all duration-300 hover:scale-105 hover:shadow-md">
                            <div class="text-3xl font-bold text-[#f3a446]">
                                {{ number_format($totalAmount / $design->area, 2) }}
                            </div>
                            <div class="text-sm font-medium text-gray-600 mt-2">تكلفة م²</div>
                        </div>
                        <div
                            class="text-center bg-gray-50/50 border border-gray-200/60 rounded-xl p-4 transform transition-all duration-300 hover:scale-105 hover:shadow-md">
                            <div class="text-3xl font-bold text-[#2f5c69]">{{ $design->items()->count() }}</div>
                            <div class="text-sm font-medium text-gray-600 mt-2">عدد البنود</div>
                        </div>
                        <div
                            class="text-center bg-gray-50/50 border border-gray-200/60 rounded-xl p-4 transform transition-all duration-300 hover:scale-105 hover:shadow-md">
                            <div class="text-3xl font-bold text-[#2f5c69]">{{ $categoryTotals->count() }}</div>
                            <div class="text-sm font-medium text-gray-600 mt-2">عدد الفئات</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div
        class="bg-white rounded-2xl shadow-xl border border-gray-100/50 p-6 md:p-8 mb-8 overflow-hidden transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">إجمالي التكلفة حسب الفئة</h2>
        <div class="overflow-x-auto rounded-lg border border-gray-200/60">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-[#2f5c69] to-[#1a262a]">
                    <tr>
                        <th class="px-6 py-4 text-right text-sm font-bold text-white uppercase tracking-wider">الفئة
                        </th>
                        <th class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider">عدد
                            البنود</th>
                        <th class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider">المجموع
                        </th>
                        <th class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider">النسبة
                            المئوية</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($categoryTotals as $categoryTotal)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                {{ $categoryTotal->category_name }}
                            </td>
                            <td class="px-6 py-4 text-center text-sm text-gray-900">
                                {{ $design->items()->where('category_id', $categoryTotal->id)->count() }}
                            </td>
                            <td class="px-6 py-4 text-center text-sm font-bold text-gray-900">
                                {{ number_format($categoryTotal->total, 2) }} ريال
                            </td>
                            <td class="px-6 py-4 text-center text-sm text-gray-900">
                                {{ $totalAmount > 0 ? number_format(($categoryTotal->total / $totalAmount) * 100, 1) : 0 }}%
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-100 border-t-2 border-[#f3a446]">
                    <tr>
                        <td class="px-6 py-4 text-right text-sm font-bold text-gray-900">المجموع الكلي</td>
                        <td class="px-6 py-4 text-center text-sm font-bold text-gray-900">
                            {{ $design->items()->count() }}</td>
                        <td class="px-6 py-4 text-center text-base font-bold text-gray-900">
                            {{ number_format($totalAmount, 2) }} ريال</td>
                        <td class="px-6 py-4 text-center text-sm font-bold text-gray-900">100%</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    @if ($itemsByCategory->count() > 0)
        <div class="space-y-8">
            @foreach ($itemsByCategory as $categoryName => $items)
                <div
                    class="bg-white rounded-2xl shadow-xl border border-gray-100/50 overflow-hidden transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
                    <div
                        class="bg-gradient-to-r from-[#2f5c69] to-[#1a262a] px-6 py-4 border-b border-[#f3a446]/50">
                        <h3 class="text-xl font-bold text-white">{{ $categoryName }}</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-right text-sm font-medium text-gray-700">اسم البند
                                    </th>
                                    <th class="px-6 py-3 text-center text-sm font-medium text-gray-700">الكمية</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium text-gray-700">الوحدة</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium text-gray-700">سعر الوحدة
                                    </th>
                                    <th class="px-6 py-3 text-center text-sm font-medium text-gray-700">المجموع</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($items as $item)
                                    <tr class="hover:bg-gray-50/50 transition-colors duration-200">
                                        <td class="px-6 py-4">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $item->item_name }}
                                                </div>
                                                @if ($item->notes)
                                                    <div class="text-xs text-gray-500 mt-1">{{ $item->notes }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center text-sm text-gray-900">
                                            {{ $item->quantity ? number_format($item->quantity, 2) : '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-center text-sm text-gray-900">
                                            {{ $item->unit ?? '-' }}</td>
                                        <td class="px-6 py-4 text-center text-sm text-gray-900">
                                            {{ $item->unit_price ? number_format($item->unit_price, 2) : '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-center text-sm font-medium text-gray-900">
                                            {{ number_format($item->total_price, 2) }} ريال
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-100">
                                <tr>
                                    <td colspan="4"
                                        class="px-6 py-3 text-right text-sm font-bold text-gray-800">
                                        مجموع {{ $categoryName }}:
                                    </td>
                                    <td class="px-6 py-3 text-center text-sm font-bold text-gray-900">
                                        {{ number_format($items->sum('total_price'), 2) }} ريال
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>

        <div
            class="mt-8 bg-gradient-to-br from-[#1a262a] to-[#2f5c69] border border-[#f3a446]/30 rounded-2xl p-8 shadow-2xl">
            <div class="text-center">
                <div class="text-4xl font-bold text-[#f3a446] mb-2">
                    {{ number_format($totalAmount, 2) }} ريال
                </div>
                <div class="text-xl text-white opacity-90 mb-6">المجموع الكلي للمشروع</div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20">
                        <div class="font-medium text-white/80">تكلفة المتر المربع</div>
                        <div class="text-lg font-bold text-white">
                            {{ number_format($totalAmount / $design->area, 2) }} ريال/م²</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20">
                        <div class="font-medium text-white/80">عدد البنود</div>
                        <div class="text-lg font-bold text-white">{{ $design->items()->count() }} بند</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20">
                        <div class="font-medium text-white/80">عدد الفئات</div>
                        <div class="text-lg font-bold text-white">{{ $categoryTotals->count() }} فئة</div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div
            class="bg-white rounded-2xl shadow-xl border border-gray-100/50 p-8 text-center transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
            <div class="text-gray-500 text-lg mb-4">لا توجد بنود تسعير لهذا المشروع بعد</div>
            <a href="{{ route('designs.create') }}"
                class="bg-[#f3a446] hover:bg-[#f5b05a] text-[#1a262a] px-6 py-3 rounded-xl font-bold transition duration-300 transform hover:scale-105 shadow-lg">
                إضافة بنود التسعير
            </a>
        </div>
    @endif

    <div class="flex flex-wrap justify-center gap-4 mt-8 mb-20">
        <a href="{{ route('designs.show', $design->id) }}"
            class="bg-[#2f5c69] hover:bg-[#1a262a] text-white px-6 py-3 rounded-xl font-bold transition duration-300 transform hover:scale-105 shadow-lg">
            عرض التسعير التفصيلي
        </a>
        @auth
            <a href="{{ route('tenders.create-from-design', $design->id) }}"
                class="bg-[#f3a446] hover:bg-[#f5b05a] text-[#1a262a] px-6 py-3 rounded-xl font-bold transition duration-300 transform hover:scale-105 shadow-lg">
                إنشاء مناقصة من هذا التصميم
            </a>
        @endauth
        <a href="{{ route('designs.create') }}"
            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-bold transition duration-300 transform hover:scale-105 shadow-lg">
            إضافة بند جديد
        </a>
        <a href="{{ route('designs.index') }}"
            class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-xl font-bold transition duration-300 transform hover:scale-105 shadow-lg">
            العودة للتصاميم
        </a>
    </div>
</div>
@endsection
