@extends('layouts.app')

@section('title', 'تفاصيل العرض - insha\'at')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">تفاصيل العرض</h1>
                    <p class="text-gray-600">عرض رقم #{{ $offer->id }}</p>
                </div>
                <div class="flex space-x-3 space-x-reverse">
                    <a href="{{ route('projects.show', $offer->project) }}" class="btn-secondary">
                        <i class="fas fa-arrow-right ml-2"></i>
                        العودة للمشروع
                    </a>
                    @if(Auth::user()->id === $offer->professional_id && $offer->status === 'pending')
                        <form action="{{ route('offers.withdraw', $offer) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="btn-danger" onclick="return confirm('هل أنت متأكد من سحب العرض؟')">
                                <i class="fas fa-times ml-2"></i>
                                سحب العرض
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Offer Details -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">تفاصيل العرض</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">السعر المقترح</label>
                                <p class="mt-1 text-2xl font-bold text-teal-600">{{ number_format($offer->price) }} ريال</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">مدة التنفيذ</label>
                                <p class="mt-1 text-gray-900">{{ $offer->duration_days ?? 'غير محدد' }} يوم</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">الوصف</label>
                                <div class="mt-1 text-gray-900 whitespace-pre-wrap">{{ $offer->description }}</div>
                            </div>

                            @if($offer->terms_conditions)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">الشروط والأحكام</label>
                                    <div class="mt-1 text-gray-900 whitespace-pre-wrap">{{ $offer->terms_conditions }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Attachments -->
                @if($offer->attachments && count($offer->attachments) > 0)
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">المرفقات</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                @foreach($offer->attachments as $attachment)
                                    <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-file text-gray-400 ml-3"></i>
                                            <span class="text-sm text-gray-900">{{ basename($attachment) }}</span>
                                        </div>
                                        <a href="{{ Storage::url($attachment) }}" target="_blank" class="text-teal-600 hover:text-teal-700">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Client Response -->
                @if($offer->status !== 'pending' && $offer->client_notes)
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">رد العميل</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">الحالة</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($offer->status === 'accepted') bg-green-100 text-green-800
                                        @elseif($offer->status === 'rejected') bg-red-100 text-red-800
                                        @else bg-yellow-100 text-yellow-800 @endif">
                                        @if($offer->status === 'accepted') مقبول
                                        @elseif($offer->status === 'rejected') مرفوض
                                        @elseif($offer->status === 'withdrawn') مسحوب
                                        @else معلق @endif
                                    </span>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">ملاحظات العميل</label>
                                    <div class="mt-1 text-gray-900 whitespace-pre-wrap">{{ $offer->client_notes }}</div>
                                </div>

                                @if($offer->responded_at)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">تاريخ الرد</label>
                                        <p class="mt-1 text-gray-900">{{ $offer->responded_at->format('Y-m-d H:i') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Professional Info -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">معلومات المقدم</h3>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-2xl text-gray-600"></i>
                                </div>
                            </div>
                            <div class="mr-4">
                                <h4 class="text-lg font-medium text-gray-900">{{ $offer->professional->name }}</h4>
                                <p class="text-sm text-gray-500">{{ ucfirst($offer->professional_type) }}</p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-envelope text-gray-400 ml-2"></i>
                                <span>{{ $offer->professional->email }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-phone text-gray-400 ml-2"></i>
                                <span>{{ $offer->professional->phone }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project Info -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">معلومات المشروع</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">عنوان المشروع</label>
                                <p class="mt-1 text-gray-900">{{ $offer->project->title }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">الموقع</label>
                                <p class="mt-1 text-gray-900">{{ $offer->project->location }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">المساحة</label>
                                <p class="mt-1 text-gray-900">{{ $offer->project->area }} متر مربع</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">حالة المشروع</label>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $offer->project->status }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Offer Status -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">حالة العرض</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">الحالة الحالية</label>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($offer->status === 'accepted') bg-green-100 text-green-800
                                    @elseif($offer->status === 'rejected') bg-red-100 text-red-800
                                    @elseif($offer->status === 'withdrawn') bg-yellow-100 text-yellow-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    @if($offer->status === 'accepted') مقبول
                                    @elseif($offer->status === 'rejected') مرفوض
                                    @elseif($offer->status === 'withdrawn') مسحوب
                                    @else معلق @endif
                                </span>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">تاريخ التقديم</label>
                                <p class="mt-1 text-gray-900">{{ $offer->created_at->format('Y-m-d H:i') }}</p>
                            </div>

                            @if($offer->updated_at !== $offer->created_at)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">آخر تحديث</label>
                                    <p class="mt-1 text-gray-900">{{ $offer->updated_at->format('Y-m-d H:i') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Client Actions -->
                @if(Auth::user()->isClient() && $offer->project->client_id === Auth::user()->id && $offer->status === 'pending')
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">الرد على العرض</h3>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('offers.respond', $offer) }}" method="POST">
                                @csrf
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">القرار</label>
                                        <select name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                            <option value="">اختر القرار</option>
                                            <option value="accepted">قبول العرض</option>
                                            <option value="rejected">رفض العرض</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">ملاحظات (اختياري)</label>
                                        <textarea name="notes" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm" placeholder="أضف ملاحظاتك هنا..."></textarea>
                                    </div>

                                    <div class="flex space-x-3 space-x-reverse">
                                        <button type="submit" class="btn-primary flex-1">
                                            <i class="fas fa-check ml-2"></i>
                                            إرسال الرد
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
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

.btn-danger {
    @apply inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500;
}
</style>
@endsection
