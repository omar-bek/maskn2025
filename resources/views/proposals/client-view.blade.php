@extends('layouts.app')

@section('title', 'تفاصيل العرض - ' . $proposal->tender->title)

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="container mx-auto px-4 py-8">
            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 mb-8 overflow-hidden">
                <div class="bg-gradient-to-r from-teal-600 to-teal-700 px-8 py-6">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                        <div class="text-white">
                            <h1 class="text-3xl font-bold mb-2">تفاصيل العرض</h1>
                            <h2 class="text-xl text-teal-100 mb-4">{{ $proposal->tender->title }}</h2>
                            <div class="flex flex-wrap items-center gap-6 text-teal-100">
                                <span class="flex items-center">
                                    <i class="fas fa-user ml-2"></i>
                                    {{ $proposal->consultant->name }}
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-calendar ml-2"></i>
                                    {{ $proposal->created_at->format('Y-m-d H:i') }}
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-map-marker-alt ml-2"></i>
                                    {{ $proposal->tender->location }}
                                </span>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ route('tenders.show', $proposal->tender->id) }}"
                                class="bg-white/20 hover:bg-white/30 text-white px-6 py-3 rounded-xl transition-all duration-200 backdrop-blur-sm">
                                <i class="fas fa-arrow-right ml-2"></i>
                                العودة للمناقصة
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status and Actions Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Proposal Status Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center ml-4">
                            <i class="fas fa-info-circle text-white text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">حالة العرض</h3>
                    </div>

                    <div class="space-y-4">
                        @if ($proposal->status === 'pending')
                            <div
                                class="flex items-center justify-between p-4 bg-yellow-50 border border-yellow-200 rounded-xl">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-yellow-500 rounded-full ml-3"></div>
                                    <span class="font-medium text-yellow-800">في الانتظار</span>
                                </div>
                                <i class="fas fa-clock text-yellow-600"></i>
                            </div>
                        @elseif($proposal->status === 'accepted')
                            <div
                                class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-xl">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-green-500 rounded-full ml-3"></div>
                                    <span class="font-medium text-green-800">مقبول</span>
                                </div>
                                <i class="fas fa-check-circle text-green-600"></i>
                            </div>
                        @elseif($proposal->status === 'rejected')
                            <div class="flex items-center justify-between p-4 bg-red-50 border border-red-200 rounded-xl">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-red-500 rounded-full ml-3"></div>
                                    <span class="font-medium text-red-800">مرفوض</span>
                                </div>
                                <i class="fas fa-times-circle text-red-600"></i>
                            </div>
                        @endif

                        <div class="text-sm text-gray-500 text-center">
                            آخر تحديث: {{ $proposal->updated_at->format('Y-m-d H:i') }}
                        </div>
                    </div>
                </div>

                <!-- Proposal Summary Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center ml-4">
                            <i class="fas fa-calculator text-white text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">ملخص العرض</h3>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-xl">
                            <span class="text-sm text-green-700">السعر الإجمالي</span>
                            <span class="text-lg font-bold text-green-800">{{ $proposal->formatted_price }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-blue-50 rounded-xl">
                            <span class="text-sm text-blue-700">مدة التنفيذ</span>
                            <span class="text-lg font-bold text-blue-800">{{ $proposal->duration_months }} شهر</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-purple-50 rounded-xl">
                            <span class="text-sm text-purple-700">عدد البنود</span>
                            <span class="text-lg font-bold text-purple-800">{{ $proposal->proposalItems->count() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Consultant Info Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center ml-4">
                            <i class="fas fa-user-tie text-white text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">معلومات الاستشاري</h3>
                    </div>

                    <div class="text-center">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-2xl mx-auto mb-4">
                            {{ substr($proposal->consultant->name, 0, 1) }}
                        </div>
                        <h4 class="font-bold text-gray-800 mb-2">{{ $proposal->consultant->name }}</h4>
                        <p class="text-sm text-gray-600">استشاري معتمد</p>
                    </div>
                </div>
            </div>

            @if ($proposal->status === 'rejected' && $proposal->client_notes)
                <!-- Client Notes Section -->
                <div class="bg-red-50 border border-red-200 rounded-2xl p-6 mb-8">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center ml-4">
                            <i class="fas fa-comment-alt text-red-600"></i>
                        </div>
                        <h3 class="text-lg font-bold text-red-800">ملاحظاتك على العرض</h3>
                    </div>
                    <p class="text-red-700 leading-relaxed">{{ $proposal->client_notes }}</p>
                </div>
            @endif

            <!-- Proposal Text Section -->
            @if ($proposal->proposal_text)
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center ml-4">
                            <i class="fas fa-file-alt text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">نص العرض</h3>
                    </div>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line text-lg">{{ $proposal->proposal_text }}
                        </p>
                    </div>
                </div>
            @endif

            <!-- Terms and Conditions Section -->
            @if ($proposal->terms_conditions)
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center ml-4">
                            <i class="fas fa-clipboard-list text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">الشروط والأحكام</h3>
                    </div>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line text-lg">
                            {{ $proposal->terms_conditions }}</p>
                    </div>
                </div>
            @endif

            <!-- Proposal Items Section -->
            @if ($proposal->proposalItems->count() > 0)
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-8">
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-8 py-6 border-b border-gray-200">
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center ml-4">
                                <i class="fas fa-list text-white text-xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800">تفاصيل البنود</h3>
                        </div>
                    </div>

                    <div class="p-8">
                        @php
                            $itemsByCategory = $proposal->proposalItems->groupBy('tenderItem.category.category_name');
                        @endphp

                        <div class="space-y-8">
                            @foreach ($itemsByCategory as $categoryName => $items)
                                <div class="border border-gray-200 rounded-2xl overflow-hidden">
                                    <div
                                        class="bg-gradient-to-r from-teal-50 to-teal-100 px-6 py-4 border-b border-teal-200">
                                        <h4 class="font-bold text-teal-800 text-lg">{{ $categoryName }}</h4>
                                    </div>
                                    <div class="overflow-x-auto">
                                        <table class="w-full">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-4 text-right text-sm font-bold text-gray-700">اسم
                                                        البند</th>
                                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-700">
                                                        الكمية</th>
                                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-700">
                                                        الوحدة</th>
                                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-700">سعر
                                                        الوحدة</th>
                                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-700">
                                                        الإجمالي</th>
                                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-700">متوفر
                                                    </th>
                                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-700">
                                                        ملاحظات</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                @foreach ($items as $proposalItem)
                                                    <tr class="hover:bg-gray-50 transition-colors">
                                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                                            {{ $proposalItem->tenderItem->item_name }}
                                                        </td>
                                                        <td class="px-6 py-4 text-center text-sm text-gray-900">
                                                            {{ $proposalItem->tenderItem->formatted_quantity }}
                                                        </td>
                                                        <td class="px-6 py-4 text-center text-sm text-gray-900">
                                                            {{ $proposalItem->tenderItem->unit ?? '-' }}
                                                        </td>
                                                        <td class="px-6 py-4 text-center text-sm text-gray-900">
                                                            {{ $proposalItem->formatted_unit_price }}
                                                        </td>
                                                        <td class="px-6 py-4 text-center text-sm font-bold text-green-600">
                                                            {{ $proposalItem->formatted_total_price }}
                                                        </td>
                                                        <td class="px-6 py-4 text-center">
                                                            @if ($proposalItem->is_available)
                                                                <span
                                                                    class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                                                    متوفر
                                                                </span>
                                                            @else
                                                                <span
                                                                    class="px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                                                                    غير متوفر
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td class="px-6 py-4 text-sm text-gray-900">
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

            <!-- Attachments Section -->
            @if ($proposal->attachments && count($proposal->attachments) > 0)
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center ml-4">
                            <i class="fas fa-paperclip text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">المرفقات</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($proposal->attachments as $attachment)
                            <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-shadow">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center ml-4">
                                        <i class="fas fa-file-alt text-blue-600 text-xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ basename($attachment) }}
                                        </p>
                                        <a href="{{ Storage::url($attachment) }}" target="_blank"
                                            class="text-blue-600 hover:text-blue-800 text-sm font-medium">
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

            <!-- Actions Section (if tender is still open) -->
            @if ($proposal->tender->status === 'open' && $proposal->status === 'pending')
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center ml-4">
                            <i class="fas fa-cogs text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">إجراءات على العرض</h3>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <form action="{{ route('proposals.accept', $proposal->id) }}" method="POST" class="flex-1">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label for="accept_notes" class="block text-sm font-medium text-gray-700 mb-2">ملاحظات
                                        (اختياري)</label>
                                    <textarea id="accept_notes" name="client_notes" rows="3"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none"
                                        placeholder="أضف أي ملاحظات حول قبول هذا العرض..."></textarea>
                                </div>
                                <button type="submit"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white px-6 py-4 rounded-xl font-semibold transition-all duration-200 flex items-center justify-center"
                                    onclick="return confirm('هل أنت متأكد من قبول هذا العرض؟')">
                                    <i class="fas fa-check ml-2"></i>
                                    قبول العرض
                                </button>
                            </div>
                        </form>

                        <form action="{{ route('proposals.reject', $proposal->id) }}" method="POST" class="flex-1">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label for="reject_notes" class="block text-sm font-medium text-gray-700 mb-2">سبب
                                        الرفض</label>
                                    <textarea id="reject_notes" name="client_notes" rows="3"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent resize-none"
                                        placeholder="اذكر سبب رفض هذا العرض..."></textarea>
                                </div>
                                <button type="submit"
                                    class="w-full bg-red-600 hover:bg-red-700 text-white px-6 py-4 rounded-xl font-semibold transition-all duration-200 flex items-center justify-center"
                                    onclick="return confirm('هل أنت متأكد من رفض هذا العرض؟')">
                                    <i class="fas fa-times ml-2"></i>
                                    رفض العرض
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection




