@extends('layouts.app')

@section('title', 'تقديم عرض - insha\'at')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">تقديم عرض</h1>
                    <p class="text-gray-600">مشروع: {{ $project->title }}</p>
                </div>
                <a href="{{ route('projects.show', $project) }}" class="btn-secondary">
                    <i class="fas fa-arrow-right ml-2"></i>
                    العودة للمشروع
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">تفاصيل العرض</h3>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('offers.store', $project) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="space-y-6">
                                <!-- Price -->
                                <div>
                                    <label for="price" class="block text-sm font-medium text-gray-700">
                                        السعر المقترح <span class="text-red-500">*</span>
                                    </label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <input type="number" name="price" id="price" step="0.01" min="0" required
                                               class="block w-full pr-12 border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                                               value="{{ old('price') }}" placeholder="0.00">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">ريال</span>
                                        </div>
                                    </div>
                                    @error('price')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Duration -->
                                <div>
                                    <label for="duration_days" class="block text-sm font-medium text-gray-700">
                                        مدة التنفيذ (بالأيام)
                                    </label>
                                    <input type="number" name="duration_days" id="duration_days" min="1"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                                           value="{{ old('duration_days') }}" placeholder="مثال: 30">
                                    @error('duration_days')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700">
                                        وصف العرض <span class="text-red-500">*</span>
                                    </label>
                                    <textarea name="description" id="description" rows="6" required
                                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                                              placeholder="اشرح تفاصيل عرضك وخطة العمل المقترحة...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Terms and Conditions -->
                                <div>
                                    <label for="terms_conditions" class="block text-sm font-medium text-gray-700">
                                        الشروط والأحكام
                                    </label>
                                    <textarea name="terms_conditions" id="terms_conditions" rows="4"
                                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                                              placeholder="أضف أي شروط أو أحكام خاصة بعرضك...">{{ old('terms_conditions') }}</textarea>
                                    @error('terms_conditions')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Attachments -->
                                <div>
                                    <label for="attachments" class="block text-sm font-medium text-gray-700">
                                        المرفقات
                                    </label>
                                    <div class="mt-1">
                                        <input type="file" name="attachments[]" id="attachments" multiple
                                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100"
                                               accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500">
                                        يمكنك رفع ملفات PDF، صور، أو مستندات Word. الحد الأقصى 5 ميجابايت لكل ملف.
                                    </p>
                                    @error('attachments.*')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="flex justify-end">
                                    <button type="submit" class="btn-primary">
                                        <i class="fas fa-paper-plane ml-2"></i>
                                        تقديم العرض
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Project Info -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">معلومات المشروع</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">عنوان المشروع</label>
                                <p class="mt-1 text-gray-900">{{ $project->title }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">الموقع</label>
                                <p class="mt-1 text-gray-900">{{ $project->location }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">الحي</label>
                                <p class="mt-1 text-gray-900">{{ $project->neighborhood }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">المساحة</label>
                                <p class="mt-1 text-gray-900">{{ $project->area }} متر مربع</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">نوع التصميم</label>
                                <p class="mt-1 text-gray-900">{{ $project->style }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">الوصف</label>
                                <p class="mt-1 text-gray-900">{{ Str::limit($project->description, 150) }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">حالة المشروع</label>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $project->status }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tips -->
                <div class="bg-blue-50 rounded-lg p-6">
                    <h4 class="text-sm font-medium text-blue-900 mb-3">نصائح لتقديم عرض ناجح</h4>
                    <ul class="space-y-2 text-sm text-blue-800">
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mt-1 ml-2"></i>
                            <span>قدم سعراً تنافسياً وعادلاً</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mt-1 ml-2"></i>
                            <span>اشرح خطتك بالتفصيل</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mt-1 ml-2"></i>
                            <span>أضف مرفقات مفيدة</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-blue-600 mt-1 ml-2"></i>
                            <span>حدد مدة تنفيذ واقعية</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.btn-primary {
    @apply inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500;
}

.btn-secondary {
    @apply inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500;
}
</style>
@endsection
