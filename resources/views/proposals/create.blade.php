@extends('layouts.app')

@section('title', __('app.submit_proposal_title'))

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-gradient-to-r from-[#1a262a] to-[#2f5c69] rounded-3xl shadow-xl overflow-hidden mb-10">
                <div class="px-8 py-10">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                        <div>
                            <h1 class="text-3xl font-extrabold text-white mb-2">{{ __('app.submit_proposal_title') }}</h1>
                            <p class="text-blue-100 opacity-90 text-lg">{{ __('app.submit_proposal_desc') }}</p>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20 min-w-[300px]">
                            <h3 class="font-bold text-white text-lg mb-3 border-b border-white/10 pb-2">{{ $tender->title }}</h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between text-blue-100">
                                    <span>{{ __('app.client') }}:</span>
                                    <span class="font-semibold text-white">{{ $tender->client->name }}</span>
                                </div>
                                <div class="flex justify-between text-blue-100">
                                    <span>{{ __('app.location') }}:</span>
                                    <span class="font-semibold text-white">{{ $tender->location }}</span>
                                </div>
                                <div class="flex justify-between text-blue-100">
                                    <span>{{ __('app.deadline') }}:</span>
                                    <span class="font-semibold text-[#f3a446]">{{ $tender->formatted_deadline }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('proposals.store', $tender->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if ($errors->any())
                    <div class="mb-8 rounded-2xl bg-red-50 border border-red-100 p-4 animate-pulse">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div>
                                <h3 class="text-red-800 font-bold mb-2">{{ __('app.correction_needed') }}</h3>
                                <ul class="text-red-700 text-sm space-y-1 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="space-y-8">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#2f5c69]/10 text-[#2f5c69] flex items-center justify-center">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <h2 class="text-xl font-bold text-[#1a262a]">{{ __('app.proposal_details') }}</h2>
                        </div>
                        <div class="p-8">
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-[#1a262a] mb-2">{{ __('app.execution_duration') }}</label>
                                    <div class="relative">
                                        <input type="number" name="duration_months" readonly
                                            class="w-full rounded-xl border-gray-200 bg-gray-50 text-gray-500 font-medium focus:ring-0 cursor-not-allowed"
                                            value="16">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-400 text-sm">{{ __('app.duration_note') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#2f5c69]/10 text-[#2f5c69] flex items-center justify-center">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <h2 class="text-xl font-bold text-[#1a262a]">{{ __('app.proposal_text_section') }}</h2>
                        </div>
                        <div class="p-8 space-y-6">
                            <div>
                                <label class="block text-sm font-semibold text-[#1a262a] mb-2">{{ __('app.proposal_description') }} <span class="text-red-500">*</span></label>
                                <textarea name="proposal_text" rows="6" required
                                    class="w-full rounded-xl border-gray-200 focus:border-[#2f5c69] focus:ring focus:ring-[#2f5c69]/20 transition-all text-sm leading-relaxed placeholder-gray-400"
                                    placeholder="{{ __('app.proposal_placeholder') }}">{{ old('proposal_text', '') }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-[#1a262a] mb-2">{{ __('app.terms_section') }}</label>
                                <textarea name="terms_conditions" rows="4"
                                    class="w-full rounded-xl border-gray-200 focus:border-[#2f5c69] focus:ring focus:ring-[#2f5c69]/20 transition-all text-sm leading-relaxed placeholder-gray-400"
                                    placeholder="{{ __('app.terms_placeholder') }}">{{ old('terms_conditions', '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    @if($itemsByCategory && $itemsByCategory->count() > 0)
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                            <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-[#2f5c69]/10 text-[#2f5c69] flex items-center justify-center">
                                        <i class="fas fa-calculator"></i>
                                    </div>
                                    <div>
                                        <h2 class="text-xl font-bold text-[#1a262a]">{{ __('app.pricing_section') }}</h2>
                                        <p class="text-sm text-gray-500">{{ __('app.pricing_desc') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="p-8 space-y-8">
                                @foreach($itemsByCategory as $categoryName => $items)
                                    <div class="border border-gray-100 rounded-2xl overflow-hidden shadow-sm">
                                        <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                                            <h4 class="font-bold text-[#1a262a]">{{ $categoryName }}</h4>
                                            <button type="button"
                                                onclick="showAddItemForm({{ $items->first()->category_id }}, '{{ $categoryName }}')"
                                                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-[#2f5c69]/10 text-[#2f5c69] hover:bg-[#2f5c69] hover:text-white transition-all text-sm font-semibold">
                                                <i class="fas fa-plus"></i>
                                                {{ __('app.add_item') }}
                                            </button>
                                        </div>
                                        <div class="overflow-x-auto">
                                            <table class="w-full text-sm text-right">
                                                <thead class="bg-gray-50/50 text-gray-500 font-medium">
                                                    <tr>
                                                        <th class="px-6 py-4">{{ __('app.item_name') }}</th>
                                                        <th class="px-6 py-4 text-center">{{ __('app.quantity') }}</th>
                                                        <th class="px-6 py-4 text-center">{{ __('app.unit') }}</th>
                                                        <th class="px-6 py-4 text-center">{{ __('app.unit_price') }} ({{ __('app.currency') }}) <span class="text-red-500">*</span></th>
                                                        <th class="px-6 py-4 text-center">{{ __('app.total_item') }}</th>
                                                        <th class="px-6 py-4 text-center">{{ __('app.available') }}</th>
                                                        <th class="px-6 py-4 text-center">{{ __('app.notes') }}</th>
                                                        <th class="px-6 py-4 text-center">{{ __('app.actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-gray-100" id="category-{{ $items->first()->category_id }}-items">
                                                    @foreach($items as $item)
                                                        <tr class="hover:bg-gray-50/50 transition-colors group">
                                                            <td class="px-6 py-4 font-medium text-[#1a262a]">{{ $item->item_name }}</td>
                                                            <td class="px-6 py-4 text-center text-gray-600">
                                                                <span class="quantity-display bg-gray-100 px-2 py-1 rounded-md" data-quantity="{{ $item->quantity }}">{{ $item->formatted_quantity }}</span>
                                                            </td>
                                                            <td class="px-6 py-4 text-center text-gray-500">{{ $item->unit ?? '-' }}</td>
                                                            <td class="px-6 py-4 text-center">
                                                                <input type="number"
                                                                       name="item_prices[{{ $item->id }}]"
                                                                       required
                                                                       min="0"
                                                                       step="0.01"
                                                                       class="item-price w-28 rounded-lg border-gray-200 text-center focus:border-[#f3a446] focus:ring focus:ring-[#f3a446]/20 transition-all"
                                                                       placeholder="0.00"
                                                                       data-item-id="{{ $item->id }}"
                                                                       data-quantity="{{ $item->quantity }}"
                                                                       value="{{ old('item_prices.' . $item->id, '') }}"
                                                                       onchange="calculateItemTotal({{ $item->id }})">
                                                            </td>
                                                            <td class="px-6 py-4 text-center">
                                                                <span class="item-total font-bold text-[#2f5c69]" id="total-{{ $item->id }}">0.00 {{ __('app.currency') }}</span>
                                                            </td>
                                                            <td class="px-6 py-4 text-center">
                                                                <input type="checkbox"
                                                                       name="item_available[{{ $item->id }}]"
                                                                       value="1"
                                                                       class="rounded-md border-gray-300 text-[#2f5c69] focus:ring-[#2f5c69]"
                                                                       {{ old('item_available.' . $item->id, true) ? 'checked' : '' }}>
                                                            </td>
                                                            <td class="px-6 py-4 text-center">
                                                                <input type="text"
                                                                       name="item_notes[{{ $item->id }}]"
                                                                       class="w-full rounded-lg border-gray-200 text-xs focus:border-[#2f5c69] focus:ring focus:ring-[#2f5c69]/20"
                                                                       placeholder="{{ __('app.notes') }}"
                                                                       value="{{ old('item_notes.' . $item->id, '') }}">
                                                            </td>
                                                            <td class="px-6 py-4 text-center">
                                                                <button type="button"
                                                                        onclick="removeItemFromCategory({{ $item->id }})"
                                                                        class="w-8 h-8 rounded-lg flex items-center justify-center text-red-400 hover:bg-red-50 hover:text-red-600 transition-all">
                                                                    <i class="fas fa-trash-alt"></i>
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
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                         <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden h-fit">
                            <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-[#2f5c69]/10 text-[#2f5c69] flex items-center justify-center">
                                    <i class="fas fa-paperclip"></i>
                                </div>
                                <h2 class="text-xl font-bold text-[#1a262a]">{{ __('app.attachments_section') }}</h2>
                            </div>
                            <div class="p-8">
                                <label class="block text-sm font-semibold text-[#1a262a] mb-2">{{ __('app.attached_files') }}</label>
                                <div class="relative group">
                                    <input type="file" name="attachments[]" multiple
                                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-[#2f5c69]/10 file:text-[#2f5c69] hover:file:bg-[#2f5c69]/20 cursor-pointer border border-gray-200 rounded-xl">
                                </div>
                                <p class="text-xs text-gray-400 mt-2 flex items-center gap-1">
                                    <i class="fas fa-info-circle"></i>
                                    {{ __('app.attachments_note') }}
                                </p>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden h-fit">
                            <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-[#2f5c69]/10 text-[#2f5c69] flex items-center justify-center">
                                    <i class="fas fa-coins"></i>
                                </div>
                                <h2 class="text-xl font-bold text-[#1a262a]">{{ __('app.cost_summary') }}</h2>
                            </div>
                            <div class="p-8">
                                <div class="bg-gradient-to-br from-emerald-50 to-white border border-emerald-100 rounded-2xl p-6 text-center">
                                    <p class="text-emerald-800 font-medium mb-2">{{ __('app.total_cost') }}</p>
                                    <p class="text-4xl font-extrabold text-emerald-600 tracking-tight" id="grand-total">0.00 {{ __('app.currency') }}</p>
                                    <div class="mt-4 inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100/50 text-emerald-700 text-xs font-bold">
                                        <span id="items-count">0</span> {{ __('app.items_count') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col-reverse sm:flex-row justify-end gap-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('tenders.show', $tender->id) }}"
                           class="inline-flex justify-center items-center gap-2 px-6 py-3 rounded-xl border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition-all">
                            {{ __('app.cancel') }}
                        </a>
                        <button type="submit"
                                class="inline-flex justify-center items-center gap-2 px-8 py-3 rounded-xl bg-[#f3a446] text-[#1a262a] font-bold shadow-md hover:bg-[#f5b05a] hover:shadow-lg hover:-translate-y-0.5 transition-all">
                            <i class="fas fa-paper-plane"></i>
                            {{ __('app.submit_btn') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const currency = "{{ __('app.currency') }}";
        const msgFillRequired = "{{ __('app.js_fill_required') }}";
        const msgConfirmDelete = "{{ __('app.js_confirm_delete') }}";
        const labelSave = "{{ __('app.save') }}";
        const labelRemove = "{{ __('app.remove') }}";

        let additionalItemCounter = 0;

        function calculateItemTotal(itemId) {
            const priceInput = document.querySelector(`input[data-item-id="${itemId}"]`);
            const quantity = parseFloat(priceInput.dataset.quantity) || 0;
            const price = parseFloat(priceInput.value) || 0;
            const total = quantity * price;

            const totalElement = document.getElementById(`total-${itemId}`);
            totalElement.textContent = total.toFixed(2) + ' ' + currency;

            updateGrandTotal();
        }

        function updateGrandTotal() {
            let grandTotal = 0;
            let itemsCount = 0;

            document.querySelectorAll('.item-price').forEach(input => {
                const quantity = parseFloat(input.dataset.quantity) || 0;
                const price = parseFloat(input.value) || 0;
                if (price > 0) {
                    grandTotal += quantity * price;
                    itemsCount++;
                }
            });

            document.getElementById('grand-total').textContent = grandTotal.toFixed(2) + ' ' + currency;
            document.getElementById('items-count').textContent = itemsCount;
        }

        function showAddItemForm(categoryId, categoryName) {
            additionalItemCounter++;

            const categoryItemsTbody = document.getElementById(`category-${categoryId}-items`);
            const newRowHtml = `
                <tr class="bg-[#2f5c69]/5 border-2 border-[#2f5c69]/20" id="new-item-row-${additionalItemCounter}">
                    <td class="px-6 py-4">
                        <input type="text" id="new-item-name-${additionalItemCounter}" class="w-full rounded-lg border-gray-300 text-sm focus:border-[#2f5c69] focus:ring focus:ring-[#2f5c69]/20" placeholder="{{ __('app.item_name') }}">
                    </td>
                    <td class="px-6 py-4">
                        <input type="number" id="new-item-quantity-${additionalItemCounter}" min="0" step="0.01" class="w-full rounded-lg border-gray-300 text-sm text-center focus:border-[#2f5c69] focus:ring focus:ring-[#2f5c69]/20" placeholder="{{ __('app.quantity') }}" onchange="calculateNewItemTotal(${additionalItemCounter})">
                    </td>
                    <td class="px-6 py-4">
                        <input type="text" id="new-item-unit-${additionalItemCounter}" class="w-full rounded-lg border-gray-300 text-sm text-center focus:border-[#2f5c69] focus:ring focus:ring-[#2f5c69]/20" placeholder="{{ __('app.unit') }}">
                    </td>
                    <td class="px-6 py-4">
                        <input type="number" id="new-item-price-${additionalItemCounter}" min="0" step="0.01" class="w-full rounded-lg border-gray-300 text-sm text-center focus:border-[#2f5c69] focus:ring focus:ring-[#2f5c69]/20" placeholder="{{ __('app.unit_price') }}" onchange="calculateNewItemTotal(${additionalItemCounter})">
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="font-bold text-[#2f5c69]" id="new-item-total-${additionalItemCounter}">0.00 ${currency}</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <input type="checkbox" id="new-item-available-${additionalItemCounter}" class="rounded-md border-gray-300 text-[#2f5c69] focus:ring-[#2f5c69]" checked>
                    </td>
                    <td class="px-6 py-4">
                        <input type="text" id="new-item-notes-${additionalItemCounter}" class="w-full rounded-lg border-gray-300 text-xs focus:border-[#2f5c69] focus:ring focus:ring-[#2f5c69]/20" placeholder="{{ __('app.notes') }}">
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button type="button" onclick="saveNewItem(${additionalItemCounter}, ${categoryId})" class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 hover:bg-emerald-200 flex items-center justify-center transition-all" title="${labelSave}">
                                <i class="fas fa-check"></i>
                            </button>
                            <button type="button" onclick="cancelNewItem(${additionalItemCounter})" class="w-8 h-8 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 flex items-center justify-center transition-all" title="${labelRemove}">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;

            categoryItemsTbody.insertAdjacentHTML('beforeend', newRowHtml);
            document.getElementById(`new-item-name-${additionalItemCounter}`).focus();
        }

        function calculateNewItemTotal(counter) {
            const quantity = parseFloat(document.getElementById(`new-item-quantity-${counter}`).value) || 0;
            const price = parseFloat(document.getElementById(`new-item-price-${counter}`).value) || 0;
            const total = quantity * price;
            document.getElementById(`new-item-total-${counter}`).textContent = total.toFixed(2) + ' ' + currency;
        }

        function saveNewItem(counter, categoryId) {
            const name = document.getElementById(`new-item-name-${counter}`).value;
            const quantity = document.getElementById(`new-item-quantity-${counter}`).value;
            const unit = document.getElementById(`new-item-unit-${counter}`).value;
            const price = document.getElementById(`new-item-price-${counter}`).value;
            const notes = document.getElementById(`new-item-notes-${counter}`).value;
            const isAvailable = document.getElementById(`new-item-available-${counter}`).checked;

            if (!name || !quantity || !price) {
                alert(msgFillRequired);
                return;
            }

            const total = parseFloat(quantity) * parseFloat(price);
            const formRow = document.getElementById(`new-item-row-${counter}`);
            
            const newItemRow = `
                <tr class="hover:bg-gray-50/50 transition-colors group">
                    <td class="px-6 py-4 font-medium text-[#1a262a]">${name}</td>
                    <td class="px-6 py-4 text-center text-gray-600">${quantity}</td>
                    <td class="px-6 py-4 text-center text-gray-500">${unit || '-'}</td>
                    <td class="px-6 py-4 text-center">
                        <input type="number" name="item_prices[new_${counter}]" required min="0" step="0.01" class="item-price w-28 rounded-lg border-gray-200 text-center focus:border-[#f3a446] focus:ring focus:ring-[#f3a446]/20 transition-all" value="${price}" data-item-id="new_${counter}" data-quantity="${quantity}" onchange="calculateItemTotal('new_${counter}')">
                        <input type="hidden" name="item_names[new_${counter}]" value="${name}">
                        <input type="hidden" name="item_quantities[new_${counter}]" value="${quantity}">
                        <input type="hidden" name="item_units[new_${counter}]" value="${unit}">
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="item-total font-bold text-[#2f5c69]" id="total-new_${counter}">${total.toFixed(2)} ${currency}</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <input type="checkbox" name="item_available[new_${counter}]" value="1" class="rounded-md border-gray-300 text-[#2f5c69] focus:ring-[#2f5c69]" ${isAvailable ? 'checked' : ''}>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <input type="text" name="item_notes[new_${counter}]" class="w-full rounded-lg border-gray-200 text-xs focus:border-[#2f5c69] focus:ring focus:ring-[#2f5c69]/20" value="${notes}">
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button type="button" onclick="removeItemFromCategory('new_${counter}')" class="w-8 h-8 rounded-lg flex items-center justify-center text-red-400 hover:bg-red-50 hover:text-red-600 transition-all">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            `;

            formRow.outerHTML = newItemRow;
            updateGrandTotal();
        }

        function cancelNewItem(counter) {
            const formRow = document.getElementById(`new-item-row-${counter}`);
            if (formRow) formRow.remove();
        }

        function removeItemFromCategory(itemId) {
            if (confirm(msgConfirmDelete)) {
                const row = document.querySelector(`input[data-item-id="${itemId}"]`).closest('tr');
                if (row) {
                    row.remove();
                    updateGrandTotal();
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.item-price').forEach(input => {
                if (input.value) {
                    calculateItemTotal(input.dataset.itemId);
                }
            });
            updateGrandTotal();
        });
    </script>
@endsection