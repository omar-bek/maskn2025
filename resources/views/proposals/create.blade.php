@extends('layouts.app')

@section('title', 'تقديم عرض على مناقصة - انشاءات')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <div class="border-b pb-4 mb-6">
            <h1 class="text-3xl font-bold text-gray-900">تقديم عرض على المناقصة</h1>
            <p class="text-gray-600 mt-2">قدم عرضك للعمل على هذه المناقصة</p>
        </div>

        <!-- Tender Info -->
        <div class="bg-blue-50 rounded-lg p-4">
            <h3 class="font-semibold text-blue-900 mb-2">{{ $tender->title }}</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div>
                    <span class="text-blue-700">العميل:</span>
                    <span class="text-blue-900">{{ $tender->client->name }}</span>
                </div>
                <div>
                    <span class="text-blue-700">الموقع:</span>
                    <span class="text-blue-900">{{ $tender->location }}</span>
                </div>
                <div>
                    <span class="text-blue-700">آخر موعد:</span>
                    <span class="text-blue-900">{{ $tender->formatted_deadline }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Form -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <form action="{{ route('proposals.store', $tender->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
            <!-- Error messages -->
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle text-red-600 ml-2 mt-1"></i>
                    <div>
                        <h3 class="text-red-800 font-medium mb-2">يرجى تصحيح الأخطاء التالية:</h3>
                        <ul class="text-red-700 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <!-- Proposal Details -->
            <div class="border-b">
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
                    <table class="w-full">
                        <tbody>
                            <tr>
                                <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">وصف العرض *</td>
                                <td class="py-3">
                                    <textarea name="proposal_text" rows="6" required
                                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                              placeholder="اكتب وصفاً مفصلاً لعرضك، بما في ذلك الخدمات المقدمة، المواد المستخدمة، وخطة العمل...">{{ old('proposal_text', '') }}</textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Terms and Conditions -->
            <div class="border-b">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">الشروط والأحكام</h2>
                </div>
                <div class="p-6">
                    <table class="w-full">
                        <tbody>
                            <tr>
                                <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">الشروط والأحكام</td>
                                <td class="py-3">
                                    <textarea name="terms_conditions" rows="4"
                                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                              placeholder="اكتب الشروط والأحكام الخاصة بعرضك...">{{ old('terms_conditions', '') }}</textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Item Pricing -->
            @if($itemsByCategory && $itemsByCategory->count() > 0)
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
                                                               value="{{ old('item_prices.' . $item->id, '') }}"
                                                               onchange="calculateItemTotal({{ $item->id }})">
                                                    </td>
                                                    <td class="px-4 py-3 text-center">
                                                        <span class="item-total text-sm font-medium text-green-600" id="total-{{ $item->id }}">0.00 درهم</span>
                                                    </td>
                                                    <td class="px-4 py-3 text-center">
                                                        <input type="checkbox"
                                                               name="item_available[{{ $item->id }}]"
                                                               value="1"
                                                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                                               {{ old('item_available.' . $item->id, true) ? 'checked' : '' }}>
                                                    </td>
                                                    <td class="px-4 py-3 text-center">
                                                        <input type="text"
                                                               name="item_notes[{{ $item->id }}]"
                                                               class="w-32 border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                               placeholder="ملاحظات"
                                                               value="{{ old('item_notes.' . $item->id, '') }}">
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
            @endif


            <!-- Total Summary -->
            <div class="border-b">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">ملخص التكلفة</h2>
                </div>
                <div class="p-6">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-medium text-green-800">إجمالي التكلفة:</span>
                            <span class="text-2xl font-bold text-green-600" id="grand-total">0.00 ريال</span>
                        </div>
                        <div class="mt-2 text-sm text-green-700">
                            <span id="items-count">0</span> بند
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attachments -->
            <div class="border-b">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">المرفقات</h2>
                </div>
                <div class="p-6">
                    <table class="w-full">
                        <tbody>
                            <tr>
                                <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">الملفات المرفقة</td>
                                <td class="py-3">
                                    <input type="file" name="attachments[]" multiple
                                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <p class="text-sm text-gray-500 mt-1">
                                        يمكنك رفع ملفات PDF، Word، أو صور (حجم أقصى 2MB لكل ملف)
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="p-6 bg-gray-50">
                <div class="flex justify-end gap-4">
                    <a href="{{ route('tenders.show', $tender->id) }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition duration-200">
                        إلغاء
                    </a>
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition duration-200">
                        <i class="fas fa-paper-plane ml-2"></i>
                        تقديم العرض
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
let additionalItemCounter = 0;

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


