@extends('layouts.app')

@section('title', 'تعديل المناقصة - انشاءات')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <div class="border-b pb-4 mb-6">
            <h1 class="text-3xl font-bold text-gray-900">تعديل المناقصة: {{ $tender->title }}</h1>
            <p class="text-gray-600 mt-2">عدّل تفاصيل المناقصة</p>
        </div>
    </div>

    <!-- Main Form -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <form action="{{ route('tenders.update', $tender->id) }}" method="POST">
            @csrf
            @method('PUT')

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

            <!-- Basic Information -->
            <div class="border-b">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">المعلومات الأساسية</h2>
                </div>
                <div class="p-6">
                    <table class="w-full">
                        <tbody>
                            <tr>
                                <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">عنوان المناقصة *</td>
                                <td class="py-3">
                                    <input type="text" name="title" required
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="مثال: مناقصة بناء فيلا عصرية"
                                           value="{{ old('title', $tender->title) }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">التصميم المطلوب *</td>
                                <td class="py-3">
                                    <div class="space-y-4">
                                        <!-- Design Selection Cards -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-96 overflow-y-auto border border-gray-200 rounded-lg p-4">
                                            @foreach($designs as $design)
                                            <div class="design-option border-2 rounded-lg p-4 cursor-pointer transition-all duration-200 hover:border-blue-500 hover:shadow-md {{ old('design_id', $tender->design_id) == $design->id ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }}"
                                                 onclick="selectDesign({{ $design->id }})">
                                                <input type="radio" name="design_id" value="{{ $design->id }}"
                                                       id="design_{{ $design->id }}"
                                                       class="sr-only"
                                                       {{ old('design_id', $tender->design_id) == $design->id ? 'checked' : '' }}>
                                                <div class="flex gap-3">
                                                    <img src="{{ $design->main_image_url }}" alt="{{ $design->title }}"
                                                         class="w-16 h-16 object-cover rounded-lg">
                                                    <div class="flex-1">
                                                        <h4 class="font-semibold text-gray-900 text-sm">{{ $design->title }}</h4>
                                                        <p class="text-xs text-gray-600 mb-1">{{ $design->style }}</p>
                                                        <p class="text-xs text-gray-600 mb-1">{{ $design->formatted_area }}</p>
                                                        <p class="text-xs text-green-600 font-medium">{{ $design->formatted_price }}</p>
                                                        <div class="flex gap-2 mt-2">
                                                            <span class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $design->bedrooms }} غرف</span>
                                                            <span class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $design->bathrooms }} حمام</span>
                                                            <span class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $design->floors }} طابق</span>
                                                        </div>
                                                        <div class="mt-2">
                                                            <a href="{{ route('designs.show', $design->id) }}"
                                                               class="text-xs text-blue-600 hover:text-blue-800"
                                                               target="_blank">
                                                                <i class="fas fa-external-link-alt ml-1"></i>
                                                                عرض التفاصيل
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                        <!-- Selected Design Info -->
                                        <div id="selectedDesignInfo" class="hidden bg-blue-50 border border-blue-200 rounded-lg p-4">
                                            <h4 class="font-semibold text-blue-900 mb-2">التصميم المختار:</h4>
                                            <div id="selectedDesignDetails" class="text-sm text-blue-800"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 pr-4 text-sm font-medium text-gray-700">الموقع *</td>
                                <td class="py-3">
                                    <input type="text" name="location" required
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="مثال: الرياض، حي النرجس"
                                           value="{{ old('location', $tender->location) }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 pr-4 text-sm font-medium text-gray-700">الميزانية المتوقعة</td>
                                <td class="py-3">
                                    <input type="number" name="budget"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="مثال: 500000"
                                           value="{{ old('budget', $tender->budget) }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 pr-4 text-sm font-medium text-gray-700">آخر موعد للتقديم *</td>
                                <td class="py-3">
                                    <input type="date" name="deadline" required
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                           value="{{ old('deadline', $tender->deadline->format('Y-m-d')) }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Description -->
            <div class="border-b">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">وصف المشروع</h2>
                </div>
                <div class="p-6">
                    <table class="w-full">
                        <tbody>
                            <tr>
                                <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">وصف المناقصة *</td>
                                <td class="py-3">
                                    <textarea name="description" rows="4" required
                                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                              placeholder="اكتب وصفاً مفصلاً للمشروع المطلوب...">{{ old('description', $tender->description) }}</textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Client Notes for Modifications -->
            <div class="border-b">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">ملاحظات التعديل المطلوبة</h2>
                    <p class="text-sm text-gray-600 mt-1">اكتب هنا أي تعديلات أو تغييرات تريدها على التصميم الأصلي</p>
                </div>
                <div class="p-6">
                    <table class="w-full">
                        <tbody>
                            <tr>
                                <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">ملاحظات التعديل</td>
                                <td class="py-3">
                                    <textarea name="client_notes" rows="6"
                                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                              placeholder="مثال:
- تغيير موقع المطبخ إلى الجهة الشمالية
- إضافة غرفة مكتب في الطابق الأول
- تعديل تصميم الواجهة الأمامية
- إضافة شرفة في الطابق الثاني
- تغيير لون الطلاء الخارجي">{{ old('client_notes', $tender->client_notes) }}</textarea>
                                    <p class="text-xs text-gray-500 mt-2">
                                        <i class="fas fa-info-circle ml-1"></i>
                                        هذه الملاحظات ستكون مرئية للاستشاريين عند تقديم عروضهم
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Requirements -->
            <div class="border-b">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">المتطلبات والشروط</h2>
                </div>
                <div class="p-6">
                    <table class="w-full">
                        <tbody>
                            <tr>
                                <td class="py-3 pr-4 text-sm font-medium text-gray-700 w-1/4">المتطلبات الخاصة</td>
                                <td class="py-3">
                                    <textarea name="requirements" rows="4"
                                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                              placeholder="اكتب المتطلبات والشروط الخاصة بالمشروع...">{{ old('requirements', $tender->requirements) }}</textarea>
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
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition duration-200">
                        <i class="fas fa-save ml-2"></i>
                        حفظ التعديلات
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

<script>
// Design selection functionality
function selectDesign(designId) {
    // Remove selection from all options
    document.querySelectorAll('.design-option').forEach(option => {
        option.classList.remove('border-blue-500', 'bg-blue-50');
        option.classList.add('border-gray-200');
    });

    // Add selection to clicked option
    const selectedOption = document.querySelector(`[onclick="selectDesign(${designId})"]`);
    selectedOption.classList.remove('border-gray-200');
    selectedOption.classList.add('border-blue-500', 'bg-blue-50');

    // Check the radio button
    const radioButton = document.getElementById(`design_${designId}`);
    radioButton.checked = true;

    // Show selected design info
    showSelectedDesignInfo(designId);
}

function showSelectedDesignInfo(designId) {
    const selectedOption = document.querySelector(`[onclick="selectDesign(${designId})"]`);
    const designDetails = selectedOption.innerHTML;

    document.getElementById('selectedDesignDetails').innerHTML = designDetails;
    document.getElementById('selectedDesignInfo').classList.remove('hidden');
}

// Initialize on page load if there's a selected design
document.addEventListener('DOMContentLoaded', function() {
    const selectedRadio = document.querySelector('input[name="design_id"]:checked');
    if (selectedRadio) {
        const designId = selectedRadio.value;
        selectDesign(designId);
    }
});
</script>
