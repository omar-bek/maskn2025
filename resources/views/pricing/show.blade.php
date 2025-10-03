@extends('layouts.app')

@section('title', 'تسعير التصميم - ' . $design->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">تسعير التصميم</h1>
                <h2 class="text-xl text-gray-600 mb-4">{{ $design->title }}</h2>
                <div class="flex items-center space-x-4 text-sm text-gray-500">
                    <span><i class="fas fa-user ml-1"></i> {{ $design->consultant->name }}</span>
                    <span><i class="fas fa-calendar ml-1"></i> {{ $design->created_at->format('Y-m-d') }}</span>
                    <span><i class="fas fa-map-marker-alt ml-1"></i> {{ $design->location }}</span>
                </div>
            </div>
            <div class="text-left">
                <a href="{{ route('designs.show', $design->id) }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition duration-200">
                    <i class="fas fa-arrow-right ml-2"></i>
                    العودة للتصميم
                </a>
                @if(auth()->user()->isConsultant() && auth()->id() == $design->consultant_id)
                    <a href="{{ route('designs.pricing.create', $design->id) }}" 
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition duration-200 ml-2">
                        <i class="fas fa-plus ml-2"></i>
                        إضافة بند
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Pricing Summary -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">ملخص التسعير</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-money-bill-wave text-green-600 text-2xl ml-3"></i>
                    <div>
                        <p class="text-sm text-green-600">التكلفة الإجمالية</p>
                        <p class="text-2xl font-bold text-green-800">{{ number_format($totalCost, 2) }} درهم إماراتي</p>
                    </div>
                </div>
            </div>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-list text-blue-600 text-2xl ml-3"></i>
                    <div>
                        <p class="text-sm text-blue-600">عدد البنود</p>
                        <p class="text-2xl font-bold text-blue-800">{{ $totalItems }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-layer-group text-purple-600 text-2xl ml-3"></i>
                    <div>
                        <p class="text-sm text-purple-600">عدد الفئات</p>
                        <p class="text-2xl font-bold text-purple-800">{{ $itemsByCategory->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pricing Items -->
    @if($itemsByCategory->count() > 0)
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
        <div class="px-6 py-4 bg-gray-50 border-b">
            <h3 class="text-xl font-semibold text-gray-800">تفاصيل البنود</h3>
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
                                        <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">سعر الوحدة</th>
                                        <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">الإجمالي</th>
                                        <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">ملاحظات</th>
                                        @if(auth()->user()->isConsultant() && auth()->id() == $design->consultant_id)
                                        <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">إجراءات</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($items as $item)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $item->item_name }}</td>
                                            <td class="px-4 py-3 text-center text-sm text-gray-900">{{ number_format($item->quantity, 2) }}</td>
                                            <td class="px-4 py-3 text-center text-sm text-gray-900">{{ $item->unit ?? '-' }}</td>
                                            <td class="px-4 py-3 text-center text-sm text-gray-900">{{ number_format($item->unit_price, 2) }} درهم</td>
                                            <td class="px-4 py-3 text-center text-sm font-medium text-green-600">{{ number_format($item->total_price, 2) }} درهم</td>
                                            <td class="px-4 py-3 text-sm text-gray-900">{{ $item->notes ?? '-' }}</td>
                                            @if(auth()->user()->isConsultant() && auth()->id() == $design->consultant_id)
                                            <td class="px-4 py-3 text-center">
                                                <div class="flex space-x-2 justify-center">
                                                    <a href="{{ route('designs.pricing.edit', [$design->id, $item->id]) }}" 
                                                       class="text-blue-600 hover:text-blue-800 text-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('designs.pricing.destroy', [$design->id, $item->id]) }}" 
                                                          method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="text-red-600 hover:text-red-800 text-sm"
                                                                onclick="return confirm('هل أنت متأكد من حذف هذا البند؟')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                            @endif
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
    @else
    <div class="bg-white rounded-lg shadow-lg p-6 text-center">
        <i class="fas fa-calculator text-6xl text-gray-300 mb-4"></i>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">لا توجد بنود تسعير</h3>
        <p class="text-gray-500 mb-4">لم يتم إضافة أي بنود تسعير لهذا التصميم بعد</p>
        @if(auth()->user()->isConsultant() && auth()->id() == $design->consultant_id)
            <a href="{{ route('designs.pricing.create', $design->id) }}" 
               class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition duration-200">
                <i class="fas fa-plus ml-2"></i>
                إضافة أول بند
            </a>
        @endif
    </div>
    @endif
</div>
@endsection

