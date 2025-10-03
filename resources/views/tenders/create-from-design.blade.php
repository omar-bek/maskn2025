@extends('layouts.app')

@section('title', 'إنشاء مناقصة من التصميم - انشاءات')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <div class="border-b pb-4 mb-6">
            <h1 class="text-3xl font-bold text-gray-900">إنشاء مناقصة من التصميم</h1>
            <p class="text-gray-600 mt-2">أنشئ مناقصة بناءً على التصميم المختار مع إمكانية إضافة ملاحظات التعديل</p>
        </div>
    </div>

    <!-- Design Preview -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">التصميم المختار</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <img src="{{ $design->main_image_url }}" alt="{{ $design->title }}"
                     class="w-full h-64 object-cover rounded-lg mb-4">
                <div class="flex gap-2 flex-wrap">
                    @if($design->images && count($design->images) > 0)
                        @foreach(array_slice($design->images, 0, 3) as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $design->title }}"
                                 class="w-16 h-16 object-cover rounded">
                        @endforeach
                    @endif
                </div>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $design->title }}</h3>
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">النمط:</span>
                        <span class="font-medium">{{ $design->style }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">المساحة:</span>
                        <span class="font-medium">{{ $design->formatted_area }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">الموقع:</span>
                        <span class="font-medium">{{ $design->location }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">عدد الطوابق:</span>
                        <span class="font-medium">{{ $design->floors }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">غرف النوم:</span>
                        <span class="font-medium">{{ $design->bedrooms }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">الحمامات:</span>
                        <span class="font-medium">{{ $design->bathrooms }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">السعر التقديري:</span>
                        <span class="font-medium text-green-600">{{ $design->formatted_price }}</span>
                    </div>
                </div>

                @if($design->features && count($design->features) > 0)
                <div class="mb-4">
                    <h4 class="font-semibold text-gray-800 mb-2">المميزات:</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($design->features as $feature)
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">{{ $feature }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($design->description)
                <div class="mb-4">
                    <h4 class="font-semibold text-gray-800 mb-2">الوصف:</h4>
                    <p class="text-gray-700 text-sm">{{ $design->description }}</p>
                </div>
                @endif

                <div class="border-t pt-4">
                    <h4 class="font-semibold text-gray-800 mb-2">معلومات الاستشاري:</h4>
                    <div class="text-sm text-gray-600">
                        <p><strong>الاسم:</strong> {{ $design->consultant_name }}</p>
                        @if($design->consultant_phone)
                            <p><strong>الهاتف:</strong> {{ $design->consultant_phone }}</p>
                        @endif
                        @if($design->consultant_email)
                            <p><strong>البريد الإلكتروني:</strong> {{ $design->consultant_email }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Form -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <form action="{{ route('tenders.store') }}" method="POST">
            @csrf
            <input type="hidden" name="design_id" value="{{ $design->id }}">

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
                    <h2 class="text-xl font-semibold text-gray-800">معلومات المناقصة</h2>
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
                                           value="{{ old('title', 'مناقصة بناء ' . $design->title) }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 pr-4 text-sm font-medium text-gray-700">الموقع *</td>
                                <td class="py-3">
                                    <input type="text" name="location" required
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="مثال: الرياض، حي النرجس"
                                           value="{{ old('location', $design->location) }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 pr-4 text-sm font-medium text-gray-700">الميزانية المتوقعة</td>
                                <td class="py-3">
                                    <input type="number" name="budget"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="مثال: 500000"
                                           value="{{ old('budget', $design->price) }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3 pr-4 text-sm font-medium text-gray-700">آخر موعد للتقديم *</td>
                                <td class="py-3">
                                    <input type="date" name="deadline" required
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                           value="{{ old('deadline', '') }}">
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
                                              placeholder="اكتب وصفاً مفصلاً للمشروع المطلوب...">{{ old('description', 'نطلب تنفيذ مشروع بناء فيلا حسب التصميم المرفق مع إمكانية التعديل حسب الملاحظات المذكورة أدناه.') }}</textarea>
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
- تغيير لون الطلاء الخارجي">{{ old('client_notes', '') }}</textarea>
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
                                              placeholder="اكتب المتطلبات والشروط الخاصة بالمشروع...">{{ old('requirements', '') }}</textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="p-6 bg-gray-50">
                <div class="flex justify-end gap-4">
                    <a href="{{ route('designs.show-with-pricing', $design->id) }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition duration-200">
                        إلغاء
                    </a>
                    <button type="submit"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg transition duration-200">
                        <i class="fas fa-save ml-2"></i>
                        إنشاء المناقصة
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

