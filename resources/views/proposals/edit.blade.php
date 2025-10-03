@extends('layouts.app')

@section('title', 'تعديل العرض - ' . $proposal->tender->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <div class="flex justify-between items-start">
                <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">تعديل العرض</h1>
                <h2 class="text-xl text-gray-600 mb-4">{{ $proposal->tender->title }}</h2>
                <div class="flex items-center space-x-4 text-sm text-gray-500">
                    <span><i class="fas fa-calendar ml-1"></i> {{ $proposal->created_at->format('Y-m-d') }}</span>
                    <span><i class="fas fa-map-marker-alt ml-1"></i> {{ $proposal->tender->location }}</span>
                    <span><i class="fas fa-money-bill-wave ml-1"></i> {{ $proposal->tender->formatted_budget }}</span>
                </div>
                </div>
            <div class="text-left">
                <a href="{{ route('tenders.show', $proposal->tender->id) }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition duration-200">
                    <i class="fas fa-arrow-right ml-2"></i>
                    العودة للمناقصة
                </a>
            </div>
        </div>
    </div>

        <form action="{{ route('proposals.update', $proposal->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Proposal Details -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="border-b mb-6">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">تفاصيل العرض</h2>
                </div>
                <div class="p-6">
                    <table class="w-full">
                        <tbody>
                            <tr>
                                <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">مدة التنفيذ</td>
                                <td class="py-3">
                                    <input type="number" name="duration_months" readonly
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100 text-gray-600"
                                           value="16">
                                    <p class="text-sm text-gray-500 mt-1">مدة التنفيذ محددة بـ 16 شهر</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Proposal Text -->
            <div class="border-b">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">نص العرض</h2>
                </div>
                <div class="p-6">
                                    <textarea name="proposal_text" rows="6" required
                                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="اكتب هنا تفاصيل عرضك، الخبرة، المنهجية، والضمانات...">{{ old('proposal_text', $proposal->proposal_text) }}</textarea>
                    @error('proposal_text')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Terms and Conditions -->
            <div class="border-b">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">الشروط والأحكام</h2>
                </div>
                <div class="p-6">
                                    <textarea name="terms_conditions" rows="4"
                                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="اكتب هنا الشروط والأحكام الخاصة بعرضك...">{{ old('terms_conditions', $proposal->terms_conditions) }}</textarea>
                    @error('terms_conditions')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Attachments -->
            <div>
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">المرفقات</h2>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">إضافة مرفقات جديدة</label>
                        <input type="file" name="attachments[]" multiple
                               accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <p class="text-xs text-gray-500 mt-1">يمكن رفع ملفات PDF، Word، أو صور (حجم أقصى 2MB لكل ملف)</p>
                    </div>

                    @if($proposal->attachments && count($proposal->attachments) > 0)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">المرفقات الحالية</label>
                        <div class="space-y-2">
                        @foreach($proposal->attachments as $attachment)
                                <div class="flex items-center justify-between bg-gray-50 border border-gray-200 rounded-lg p-3">
                            <div class="flex items-center">
                                        <i class="fas fa-file-alt text-blue-600 ml-3"></i>
                                <span class="text-sm text-gray-700">{{ basename($attachment) }}</span>
                            </div>
                                    <a href="{{ Storage::url($attachment) }}" target="_blank"
                               class="text-blue-600 hover:text-blue-800 text-sm">
                                <i class="fas fa-download ml-1"></i>
                                تحميل
                            </a>
                        </div>
                        @endforeach
                        </div>
                    </div>
                    @endif
                    </div>
                </div>
            </div>

        @if($itemsByCategory && $itemsByCategory->count() > 0)
        <!-- Item Pricing -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="border-b">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">تسعير البنود</h2>
                    <p class="text-sm text-gray-600 mt-1">يرجى تحديد سعر الوحدة لكل بند من بنود المناقصة</p>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        @foreach($itemsByCategory as $categoryName => $items)
                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                <div class="bg-gray-100 px-4 py-3 border-b flex justify-between items-center">
                                    <h4 class="font-semibold text-gray-800">{{ $categoryName }}</h4>
                                    <button type="button"
                                            onclick="showAddItemForm({{ $items->first()->category_id }}, '{{ $categoryName }}')"
                                            class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm transition duration-200">
                                        <i class="fas fa-plus ml-1"></i>
                                        إضافة بند
                                    </button>
                                </div>
                                <div class="overflow-x-auto">
                    <table class="w-full">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-4 py-3 text-right text-sm font-medium text-gray-700">اسم البند</th>
                                                <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">الكمية</th>
                                                <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">الوحدة</th>
                                                <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">سعر الوحدة (درهم) *</th>
                                                <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">إجمالي البند</th>
                                                <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">متوفر</th>
                                                <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">ملاحظات</th>
                                                <th class="px-4 py-3 text-center text-sm font-medium text-gray-700">إجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200" id="category-{{ $items->first()->category_id }}-items">
                                            @foreach($items as $item)
                                                @php
                                                    $proposalItem = $proposal->proposalItems->where('tender_item_id', $item->id)->first();
                                                @endphp
                                                <tr class="hover:bg-gray-50">
                                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $item->item_name }}</td>
                                                    <td class="px-4 py-3 text-center text-sm text-gray-900">
                                                        <span class="quantity-display" data-quantity="{{ $item->quantity }}">{{ $item->formatted_quantity }}</span>
                                                    </td>
                                                    <td class="px-4 py-3 text-center text-sm text-gray-900">{{ $item->unit ?? '-' }}</td>
                                                    <td class="px-4 py-3 text-center">
                                                        <input type="number"
                                                               name="item_prices[{{ $item->id }}]"
                                                               required
                                                               min="0"
                                                               step="0.01"
                                                               class="item-price w-24 border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                               placeholder="0.00"
                                                               data-item-id="{{ $item->id }}"
                                                               data-quantity="{{ $item->quantity }}"
                                                               value="{{ old('item_prices.' . $item->id, $proposalItem ? $proposalItem->unit_price : '') }}"
                                                               onchange="calculateItemTotal({{ $item->id }})">
                                                    </td>
                                                    <td class="px-4 py-3 text-center">
                                                        <span class="item-total text-sm font-medium text-green-600" id="total-{{ $item->id }}">
                                                            {{ $proposalItem ? number_format($proposalItem->total_price, 2) . ' درهم' : '0.00 درهم' }}
                                                        </span>
                                                    </td>
                                                    <td class="px-4 py-3 text-center">
                                                        <input type="checkbox"
                                                               name="item_available[{{ $item->id }}]"
                                                               value="1"
                                                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                                               {{ old('item_available.' . $item->id, $proposalItem ? $proposalItem->is_available : true) ? 'checked' : '' }}>
                                                    </td>
                                                    <td class="px-4 py-3 text-center">
                                                        <input type="text"
                                                               name="item_notes[{{ $item->id }}]"
                                                               class="w-32 border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                               placeholder="ملاحظات"
                                                               value="{{ old('item_notes.' . $item->id, $proposalItem ? $proposalItem->notes : '') }}">
                                                    </td>
                                                    <td class="px-4 py-3 text-center">
                                                        <button type="button"
                                                                onclick="removeItemFromCategory({{ $item->id }})"
                                                                class="text-red-600 hover:text-red-800 text-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
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
        </div>
        @endif

        <!-- Total Summary -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="border-b">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">ملخص التكلفة</h2>
                </div>
                <div class="p-6">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-medium text-green-800">إجمالي التكلفة:</span>
                            <span class="text-2xl font-bold text-green-600" id="grand-total">
                                {{ number_format($proposal->proposed_price, 2) }} درهم
                            </span>
                        </div>
                        <div class="mt-2 text-sm text-green-700">
                            <span id="items-count">{{ $proposal->proposalItems->count() }}</span> بند
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <!-- Submit Button -->
                <div class="flex justify-end gap-4">
            <a href="{{ route('tenders.show', $proposal->tender->id) }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition duration-200">
                        إلغاء
                    </a>
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition duration-200">
                        <i class="fas fa-save ml-2"></i>
                        حفظ التعديلات
                    </button>
            </div>
        </form>
    </div>

<script>
let additionalItemCounter = {{ $proposal->proposalItems->count() }};

// Calculate item total
function calculateItemTotal(itemId) {
    const priceInput = document.querySelector(`input[data-item-id="${itemId}"]`);
    const quantity = parseFloat(priceInput.dataset.quantity) || 0;
    const price = parseFloat(priceInput.value) || 0;
    const total = quantity * price;

    const totalElement = document.getElementById(`total-${itemId}`);
    totalElement.textContent = total.toFixed(2) + ' درهم';

    updateGrandTotal();
}

// Update grand total
function updateGrandTotal() {
    let grandTotal = 0;
    let itemsCount = 0;

    // Calculate from tender items
    document.querySelectorAll('.item-price').forEach(input => {
        const quantity = parseFloat(input.dataset.quantity) || 0;
        const price = parseFloat(input.value) || 0;
        if (price > 0) {
            grandTotal += quantity * price;
            itemsCount++;
        }
    });

    document.getElementById('grand-total').textContent = grandTotal.toFixed(2) + ' درهم';
    document.getElementById('items-count').textContent = itemsCount;
}

// Show add item form in table
function showAddItemForm(categoryId, categoryName) {
    additionalItemCounter++;

    const categoryItemsTbody = document.getElementById(`category-${categoryId}-items`);
    const newRowHtml = `
        <tr class="bg-blue-50 border-2 border-blue-200" id="new-item-row-${additionalItemCounter}">
            <td class="px-4 py-3">
                <input type="text"
                       id="new-item-name-${additionalItemCounter}"
                       class="w-full border border-blue-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="اسم البند">
            </td>
            <td class="px-4 py-3">
                <input type="number"
                       id="new-item-quantity-${additionalItemCounter}"
                       min="0"
                       step="0.01"
                       class="w-full border border-blue-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="الكمية"
                       onchange="calculateNewItemTotal(${additionalItemCounter})">
            </td>
            <td class="px-4 py-3">
                <input type="text"
                       id="new-item-unit-${additionalItemCounter}"
                       class="w-full border border-blue-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="الوحدة">
            </td>
            <td class="px-4 py-3">
                <input type="number"
                       id="new-item-price-${additionalItemCounter}"
                       min="0"
                       step="0.01"
                       class="w-full border border-blue-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="سعر الوحدة"
                       onchange="calculateNewItemTotal(${additionalItemCounter})">
            </td>
            <td class="px-4 py-3 text-center">
                <span class="text-sm font-medium text-green-600" id="new-item-total-${additionalItemCounter}">0.00 درهم</span>
            </td>
            <td class="px-4 py-3 text-center">
                <input type="checkbox"
                       id="new-item-available-${additionalItemCounter}"
                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                       checked>
            </td>
            <td class="px-4 py-3">
                <input type="text"
                       id="new-item-notes-${additionalItemCounter}"
                       class="w-full border border-blue-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="ملاحظات">
            </td>
            <td class="px-4 py-3 text-center">
                <div class="flex space-x-2 justify-center">
                    <button type="button"
                            onclick="saveNewItem(${additionalItemCounter}, ${categoryId})"
                            class="bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded text-xs transition duration-200">
                        <i class="fas fa-check"></i>
                    </button>
                    <button type="button"
                            onclick="cancelNewItem(${additionalItemCounter})"
                            class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-xs transition duration-200">
                        <i class="fas fa-times"></i>
                    </button>
</div>
            </td>
        </tr>
    `;

    categoryItemsTbody.insertAdjacentHTML('beforeend', newRowHtml);

    // Focus on the name input
    document.getElementById(`new-item-name-${additionalItemCounter}`).focus();
}

// Calculate new item total
function calculateNewItemTotal(counter) {
    const quantity = parseFloat(document.getElementById(`new-item-quantity-${counter}`).value) || 0;
    const price = parseFloat(document.getElementById(`new-item-price-${counter}`).value) || 0;
    const total = quantity * price;

    const totalElement = document.getElementById(`new-item-total-${counter}`);
    totalElement.textContent = total.toFixed(2) + ' درهم';
}

// Save new item
function saveNewItem(counter, categoryId) {
    const name = document.getElementById(`new-item-name-${counter}`).value;
    const quantity = document.getElementById(`new-item-quantity-${counter}`).value;
    const unit = document.getElementById(`new-item-unit-${counter}`).value;
    const price = document.getElementById(`new-item-price-${counter}`).value;
    const notes = document.getElementById(`new-item-notes-${counter}`).value;
    const isAvailable = document.getElementById(`new-item-available-${counter}`).checked;

    if (!name || !quantity || !price) {
        alert('يرجى ملء جميع الحقول المطلوبة (الاسم، الكمية، السعر)');
        return;
    }

    const total = parseFloat(quantity) * parseFloat(price);

    // Replace the form row with the actual item row
    const formRow = document.getElementById(`new-item-row-${counter}`);
    const newItemRow = `
        <tr class="hover:bg-gray-50">
            <td class="px-4 py-3 text-sm font-medium text-gray-900">${name}</td>
            <td class="px-4 py-3 text-center text-sm text-gray-900">${quantity}</td>
            <td class="px-4 py-3 text-center text-sm text-gray-900">${unit || '-'}</td>
            <td class="px-4 py-3 text-center">
                <input type="number"
                       name="item_prices[new_${counter}]"
                       required
                       min="0"
                       step="0.01"
                       class="item-price w-24 border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       value="${price}"
                       data-item-id="new_${counter}"
                       data-quantity="${quantity}"
                       onchange="calculateItemTotal('new_${counter}')">
                <input type="hidden" name="item_names[new_${counter}]" value="${name}">
                <input type="hidden" name="item_quantities[new_${counter}]" value="${quantity}">
                <input type="hidden" name="item_units[new_${counter}]" value="${unit}">
            </td>
            <td class="px-4 py-3 text-center">
                <span class="item-total text-sm font-medium text-green-600" id="total-new_${counter}">${total.toFixed(2)} درهم</span>
            </td>
            <td class="px-4 py-3 text-center">
                <input type="checkbox"
                       name="item_available[new_${counter}]"
                       value="1"
                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                       ${isAvailable ? 'checked' : ''}>
            </td>
            <td class="px-4 py-3 text-center">
                <input type="text"
                       name="item_notes[new_${counter}]"
                       class="w-32 border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       value="${notes}">
            </td>
            <td class="px-4 py-3 text-center">
                <button type="button"
                        onclick="removeItemFromCategory('new_${counter}')"
                        class="text-red-600 hover:text-red-800 text-sm">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
    `;

    formRow.outerHTML = newItemRow;

    // Update grand total
    updateGrandTotal();
}

// Cancel new item
function cancelNewItem(counter) {
    const formRow = document.getElementById(`new-item-row-${counter}`);
    if (formRow) {
        formRow.remove();
    }
}

// Remove item from category
function removeItemFromCategory(itemId) {
    if (confirm('هل أنت متأكد من حذف هذا البند؟')) {
        const row = document.querySelector(`input[data-item-id="${itemId}"]`).closest('tr');
        if (row) {
            row.remove();
            updateGrandTotal();
        }
    }
}

// Initialize calculations on page load
document.addEventListener('DOMContentLoaded', function() {
    // Calculate initial totals for existing items
    document.querySelectorAll('.item-price').forEach(input => {
        if (input.value) {
            calculateItemTotal(input.dataset.itemId);
        }
    });

    updateGrandTotal();
});
</script>
@endsection
