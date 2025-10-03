@extends('layouts.app')

@section('title', 'تفاصيل العرض - ' . $proposal->tender->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <div class="flex justify-between items-start">
                    <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">تفاصيل العرض</h1>
                <h2 class="text-xl text-gray-600 mb-4">{{ $proposal->tender->title }}</h2>
                <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <span><i class="fas fa-user ml-1"></i> {{ $proposal->consultant->name }}</span>
                            <span><i class="fas fa-calendar ml-1"></i> {{ $proposal->created_at->format('Y-m-d H:i') }}</span>
                    <span><i class="fas fa-map-marker-alt ml-1"></i> {{ $proposal->tender->location }}</span>
                </div>
            </div>
            <div class="text-left">
                <a href="{{ route('tenders.show', $proposal->tender->id) }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition duration-200">
                    <i class="fas fa-arrow-right ml-2"></i>
                    العودة للمناقصة
                </a>
                @if(auth()->user()->isConsultant() && auth()->id() == $proposal->consultant_id)
                    <a href="{{ route('proposals.edit', $proposal->id) }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200 ml-2">
                        <i class="fas fa-edit ml-2"></i>
                        تعديل العرض
                    </a>
                @endif
            </div>
                        </div>
                    </div>

    <!-- Proposal Status -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">حالة العرض</h3>
                <div class="flex items-center space-x-4">
                        @if($proposal->status === 'pending')
                        <span class="px-4 py-2 text-sm font-medium bg-yellow-100 text-yellow-800 rounded-full">
                            <i class="fas fa-clock ml-1"></i>
                            في الانتظار
                        </span>
                        @elseif($proposal->status === 'accepted')
                        <span class="px-4 py-2 text-sm font-medium bg-green-100 text-green-800 rounded-full">
                            <i class="fas fa-check ml-1"></i>
                            مقبول
                        </span>
                        @elseif($proposal->status === 'rejected')
                        <span class="px-4 py-2 text-sm font-medium bg-red-100 text-red-800 rounded-full">
                            <i class="fas fa-times ml-1"></i>
                            مرفوض
                        </span>
                    @endif
                    <span class="text-sm text-gray-500">
                        آخر تحديث: {{ $proposal->updated_at->format('Y-m-d H:i') }}
                    </span>
                </div>
            </div>
            @if($proposal->status === 'rejected' && $proposal->client_notes)
                <div class="text-right">
                    <h4 class="text-sm font-medium text-gray-700 mb-1">ملاحظات العميل:</h4>
                    <p class="text-sm text-gray-600 bg-red-50 border border-red-200 rounded p-2">
                        {{ $proposal->client_notes }}
                    </p>
                </div>
                        @endif
                    </div>
                </div>

    <!-- Proposal Summary -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">ملخص العرض</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-money-bill-wave text-green-600 text-2xl ml-3"></i>
                        <div>
                        <p class="text-sm text-green-600">السعر الإجمالي</p>
                        <p class="text-2xl font-bold text-green-800">{{ $proposal->formatted_price }}</p>
                    </div>
                </div>
                        </div>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-clock text-blue-600 text-2xl ml-3"></i>
                        <div>
                        <p class="text-sm text-blue-600">مدة التنفيذ</p>
                        <p class="text-2xl font-bold text-blue-800">{{ $proposal->duration_months }} شهر</p>
                    </div>
                </div>
                        </div>
            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-list text-purple-600 text-2xl ml-3"></i>
                        <div>
                        <p class="text-sm text-purple-600">عدد البنود</p>
                        <p class="text-2xl font-bold text-purple-800">{{ $proposal->proposalItems->count() }}</p>
                    </div>
                        </div>
                        </div>
                    </div>
                </div>

                <!-- Proposal Text -->
    @if($proposal->proposal_text)
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">نص العرض</h3>
        <div class="prose max-w-none">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $proposal->proposal_text }}</p>
                </div>
    </div>
    @endif

                <!-- Terms and Conditions -->
                @if($proposal->terms_conditions)
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">الشروط والأحكام</h3>
        <div class="prose max-w-none">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $proposal->terms_conditions }}</p>
        </div>
    </div>
    @endif

    <!-- Proposal Items -->
    @if($proposal->proposalItems->count() > 0)
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
        <div class="px-6 py-4 bg-gray-50 border-b">
            <h3 class="text-xl font-semibold text-gray-800">تفاصيل البنود</h3>
        </div>

        <div class="p-6">
            @php
                $itemsByCategory = $proposal->proposalItems->groupBy('tenderItem.category.category_name');
            @endphp

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
                                        <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">متوفر</th>
                                        <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">ملاحظات</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($items as $proposalItem)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                                {{ $proposalItem->tenderItem->item_name }}
                                            </td>
                                            <td class="px-4 py-3 text-center text-sm text-gray-900">
                                                {{ $proposalItem->tenderItem->formatted_quantity }}
                                            </td>
                                            <td class="px-4 py-3 text-center text-sm text-gray-900">
                                                {{ $proposalItem->tenderItem->unit ?? '-' }}
                                            </td>
                                            <td class="px-4 py-3 text-center text-sm text-gray-900">
                                                {{ $proposalItem->formatted_unit_price }}
                                            </td>
                                            <td class="px-4 py-3 text-center text-sm font-medium text-green-600">
                                                {{ $proposalItem->formatted_total_price }}
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                @if($proposalItem->is_available)
                                                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                                        متوفر
                                                    </span>
                                                @else
                                                    <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                                                        غير متوفر
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900">
                                                {{ $proposalItem->notes ?? '-' }}
                                            </td>
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

                <!-- Attachments -->
                @if($proposal->attachments && count($proposal->attachments) > 0)
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">المرفقات</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($proposal->attachments as $attachment)
                <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center">
                        <i class="fas fa-file-alt text-blue-600 text-2xl ml-3"></i>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">{{ basename($attachment) }}</p>
                            <a href="{{ Storage::url($attachment) }}"
                               target="_blank"
                               class="text-blue-600 hover:text-blue-800 text-sm">
                                <i class="fas fa-download ml-1"></i>
                                تحميل
                            </a>
                        </div>
                    </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Actions -->
    @if(auth()->user()->isConsultant() && auth()->id() == $proposal->consultant_id)
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">الإجراءات</h3>
                <div class="flex gap-4">
                        <a href="{{ route('proposals.edit', $proposal->id) }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition duration-200">
                            <i class="fas fa-edit ml-2"></i>
                            تعديل العرض
                        </a>
            <a href="{{ route('tenders.show', $proposal->tender->id) }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition duration-200">
                <i class="fas fa-eye ml-2"></i>
                عرض المناقصة
            </a>
                </div>
            </div>
            @endif
</div>
@endsection
