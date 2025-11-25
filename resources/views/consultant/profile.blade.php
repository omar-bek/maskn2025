@extends('layouts.app')

@section('title', 'الملف الشخصي للمستشار - ' . ($user->name ?? ''))

@section('content')
    <div class="bg-[#1a262a] pt-24 pb-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div
                    class="mb-6 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 text-sm font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-2xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                    <ul class="space-y-1 list-disc mr-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-[#1a262a] via-[#264753] to-[#2f5c69] px-8 py-10 text-white">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                        @php
                            $avatarUrl = $user->avatar_url ?? optional($user->profile)->avatar_url;
                        @endphp
                        <div class="flex items-center gap-4">
                            @if ($avatarUrl)
                                <div class="w-24 h-24 rounded-2xl overflow-hidden border-2 border-white/40 shadow-lg">
                                    <img src="{{ $avatarUrl }}" alt="{{ $user->name }}"
                                        class="w-full h-full object-cover">
                                </div>
                            @else
                                <div
                                    class="w-20 h-20 rounded-2xl bg-white/10 flex items-center justify-center text-3xl font-bold uppercase border border-white/30">
                                    {{ Str::substr($user->name, 0, 2) }}
                                </div>
                            @endif
                            <div>
                                <h1 class="text-3xl font-extrabold">{{ $user->name }}</h1>
                                <p class="text-gray-300 mt-1">
                                    مستشار معتمد · {{ $user->userType->name ?? 'نوع المستخدم غير محدد' }}
                                </p>
                                <p class="text-gray-300 text-sm">
                                    عضو منذ {{ optional($user->created_at)->translatedFormat('F Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('designs.create') }}"
                                class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-[#f3a446] text-[#1a262a] font-semibold shadow-lg hover:bg-[#f5b05a] transition">
                                <i class="fas fa-plus"></i>
                                أضف تصميماً جديداً
                            </a>
                            <a href="{{ route('consultant.portfolio') }}"
                                class="inline-flex items-center gap-2 px-5 py-3 rounded-xl border border-white/40 text-white font-semibold hover:bg-white/10 transition">
                                <i class="fas fa-images"></i>
                                استعرض أعمالي
                            </a>
                        </div>
                    </div>
                </div>

                @php
                    $designsCount = $user->designs()->count();
                    $proposalsCount = $user->proposals()->count();
                    $acceptedProposals = $user->proposals()->where('status', 'accepted')->count();
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-8 -mt-12 mb-4">
                    <div class="bg-white rounded-2xl shadow p-6 border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">عدد التصاميم</p>
                                <p class="text-3xl font-bold text-[#1a262a]">{{ $designsCount }}</p>
                            </div>
                            <span
                                class="w-12 h-12 rounded-xl bg-[#f3a446]/15 text-[#f3a446] flex items-center justify-center">
                                <i class="fas fa-home text-xl"></i>
                            </span>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow p-6 border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">العروض المقدمة</p>
                                <p class="text-3xl font-bold text-[#1a262a]">{{ $proposalsCount }}</p>
                            </div>
                            <span
                                class="w-12 h-12 rounded-xl bg-[#2f5c69]/15 text-[#2f5c69] flex items-center justify-center">
                                <i class="fas fa-file-alt text-xl"></i>
                            </span>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow p-6 border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">العروض المقبولة</p>
                                <p class="text-3xl font-bold text-[#1a262a]">{{ $acceptedProposals }}</p>
                            </div>
                            <span
                                class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                <i class="fas fa-check-circle text-xl"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="px-8 pb-10">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2 space-y-8">
                            <div class="bg-white border border-gray-100 rounded-2xl shadow">
                                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                                    <h2 class="text-xl font-bold text-[#1a262a]">
                                        نبذة تعريفية
                                    </h2>
                                </div>
                                <div class="p-6 space-y-4">
                                    <p class="text-gray-600 leading-relaxed">
                                        {{ optional($user->profile)->bio ?? 'لا توجد نبذة مضافة بعد. قم بتحديث ملفك الشخصي لإبراز خبراتك وخدماتك.' }}
                                    </p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="bg-gray-50 rounded-xl p-4">
                                            <p class="text-sm text-gray-500">التخصص</p>
                                            <p class="text-base font-semibold text-[#1a262a]">
                                                {{ optional($user->profile)->specialization ?? 'تصميم معماري سكني' }}
                                            </p>
                                        </div>
                                        <div class="bg-gray-50 rounded-xl p-4">
                                            <p class="text-sm text-gray-500">المدينة</p>
                                            <p class="text-base font-semibold text-[#1a262a]">
                                                {{ $user->city ?? 'غير محدد' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white border border-gray-100 rounded-2xl shadow">
                                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                                    <h2 class="text-xl font-bold text-[#1a262a]">
                                        أحدث التصاميم
                                    </h2>
                                    <a href="{{ route('designs.index') }}"
                                        class="text-sm text-[#2f5c69] font-semibold hover:underline">
                                        عرض الكل
                                    </a>
                                </div>
                                <div class="p-6">
                                    @php
                                        $recentDesigns = $user->designs()->latest()->take(4)->get();
                                    @endphp
                                    @if ($recentDesigns->isEmpty())
                                        <div class="text-center py-10">
                                            <i class="fas fa-home text-4xl text-gray-300 mb-4"></i>
                                            <p class="text-gray-500">لم تقم بإضافة أي تصميم حتى الآن.</p>
                                            <a href="{{ route('designs.create') }}"
                                                class="inline-flex items-center mt-4 px-4 py-2 bg-[#f3a446] text-[#1a262a] rounded-lg font-semibold hover:bg-[#f5b05a] transition">
                                                <i class="fas fa-plus ml-2"></i>
                                                أضف أول تصميم لك
                                            </a>
                                        </div>
                                    @else
                                        <div class="space-y-4">
                                            @foreach ($recentDesigns as $design)
                                                <div
                                                    class="flex items-center justify-between p-4 border border-gray-100 rounded-xl hover:bg-gray-50 transition">
                                                    <div>
                                                        <h3 class="text-base font-semibold text-[#1a262a]">
                                                            {{ $design->title }}</h3>
                                                        <p class="text-sm text-gray-500">{{ $design->style }} ·
                                                            {{ $design->formatted_area }}</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <p class="text-sm font-bold text-[#2f5c69]">
                                                            {{ $design->formatted_price }}</p>
                                                        <a href="{{ route('designs.show', $design->id) }}"
                                                            class="text-xs text-[#2f5c69] font-semibold hover:underline">
                                                            عرض التفاصيل
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="space-y-8">
                            <div class="bg-white border border-gray-100 rounded-2xl shadow">
                                <div class="px-6 py-4 border-b border-gray-100">
                                    <h2 class="text-xl font-bold text-[#1a262a]">معلومات التواصل</h2>
                                </div>
                                <div class="p-6 space-y-4">
                                    <div class="flex items-center gap-4">
                                        <span
                                            class="w-10 h-10 rounded-xl bg-[#f3a446]/15 text-[#f3a446] flex items-center justify-center">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <div>
                                            <p class="text-xs text-gray-500">البريد الإلكتروني</p>
                                            <p class="text-sm font-semibold text-[#1a262a]">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <span
                                            class="w-10 h-10 rounded-xl bg-[#2f5c69]/15 text-[#2f5c69] flex items-center justify-center">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                        <div>
                                            <p class="text-xs text-gray-500">رقم الهاتف</p>
                                            <p class="text-sm font-semibold text-[#1a262a]">
                                                {{ $user->phone ?? 'غير مضاف' }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <span
                                            class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                            <i class="fab fa-whatsapp"></i>
                                        </span>
                                        <div>
                                            <p class="text-xs text-gray-500">واتساب</p>
                                            <p class="text-sm font-semibold text-[#1a262a]">
                                                {{ $user->whatsapp ?? 'غير مضاف' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white border border-gray-100 rounded-2xl shadow">
                                <div class="px-6 py-4 border-b border-gray-100">
                                    <h2 class="text-xl font-bold text-[#1a262a]">تحديث الملف الشخصي</h2>
                                    <p class="text-sm text-gray-500 mt-1">يمكنك تعديل بياناتك الشخصية وصورة الملف من خلال
                                        صفحة
                                        مخصصة.</p>
                                </div>
                                <div class="p-6 space-y-4">
                                    <p class="text-gray-600 text-sm leading-relaxed">
                                        احرص على إبقاء معلومات تواصلك وتخصصك محدثة ليتمكن العملاء من الوصول إليك بسهولة.
                                    </p>
                                    <a href="{{ route('consultant.profile.edit') }}"
                                        class="inline-flex items-center justify-center gap-2 w-full px-4 py-3 rounded-xl bg-[#f3a446] text-[#1a262a] font-semibold hover:bg-[#f5b05a] transition">
                                        <i class="fas fa-edit"></i>
                                        انتقل لصفحة التعديل
                                    </a>
                                </div>
                            </div>

                            <div class="bg-white border border-gray-100 rounded-2xl shadow">
                                <div class="px-6 py-4 border-b border-gray-100">
                                    <h2 class="text-xl font-bold text-[#1a262a]">إجراءات سريعة</h2>
                                </div>
                                <div class="p-6 space-y-3">
                                    <a href="{{ route('designs.index') }}"
                                        class="flex items-center justify-between p-3 rounded-xl border border-gray-100 hover:bg-gray-50 transition">
                                        <div class="flex items-center gap-3">
                                            <span
                                                class="w-10 h-10 rounded-xl bg-[#f3a446]/15 text-[#f3a446] flex items-center justify-center">
                                                <i class="fas fa-home"></i>
                                            </span>
                                            <div>
                                                <p class="text-sm font-semibold text-[#1a262a]">تصاميمي</p>
                                                <p class="text-xs text-gray-500">إدارة ونشر التصاميم</p>
                                            </div>
                                        </div>
                                        <i class="fas fa-chevron-left text-gray-400"></i>
                                    </a>
                                    <a href="{{ route('proposals.index') }}"
                                        class="flex items-center justify-between p-3 rounded-xl border border-gray-100 hover:bg-gray-50 transition">
                                        <div class="flex items-center gap-3">
                                            <span
                                                class="w-10 h-10 rounded-xl bg-[#2f5c69]/15 text-[#2f5c69] flex items-center justify-center">
                                                <i class="fas fa-file-alt"></i>
                                            </span>
                                            <div>
                                                <p class="text-sm font-semibold text-[#1a262a]">عروضي</p>
                                                <p class="text-xs text-gray-500">متابعة حالة المقترحات</p>
                                            </div>
                                        </div>
                                        <i class="fas fa-chevron-left text-gray-400"></i>
                                    </a>
                                    <a href="{{ route('tenders.index') }}"
                                        class="flex items-center justify-between p-3 rounded-xl border border-gray-100 hover:bg-gray-50 transition">
                                        <div class="flex items-center gap-3">
                                            <span
                                                class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                                <i class="fas fa-search"></i>
                                            </span>
                                            <div>
                                                <p class="text-sm font-semibold text-[#1a262a]">استكشاف المنافسات</p>
                                                <p class="text-xs text-gray-500">ابحث عن فرص جديدة</p>
                                            </div>
                                        </div>
                                        <i class="fas fa-chevron-left text-gray-400"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
