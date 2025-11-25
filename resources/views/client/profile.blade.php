@extends('layouts.app')

@section('title', 'الملف الشخصي - ' . ($user->name ?? ''))

@section('content')
    <div class="bg-gray-50 py-16 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 text-sm font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gradient-to-r from-[#1a262a] to-[#2f5c69] text-white rounded-3xl shadow-2xl overflow-hidden mb-10">
                <div class="px-8 py-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    @php
                        $avatarUrl = $user->avatar_url ?? optional($user->profile)->avatar_url;
                    @endphp
                    <div class="flex items-center gap-4">
                        <div class="w-24 h-24 rounded-2xl overflow-hidden border-2 border-white/40 shadow-lg">
                            @if ($avatarUrl)
                                <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-white/10 flex items-center justify-center text-3xl font-bold uppercase">
                                    {{ Str::substr($user->name, 0, 2) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm uppercase tracking-widest text-white/70">الملف الشخصي</p>
                            <h1 class="text-3xl font-extrabold">{{ $user->name }}</h1>
                            <p class="text-gray-300 mt-2">عضو منذ {{ optional($user->created_at)->translatedFormat('F Y') }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('client.profile.edit') }}"
                            class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-white text-[#1a262a] font-semibold shadow-lg hover:bg-gray-100 transition">
                            <i class="fas fa-edit"></i>
                            تعديل الملف الشخصي
                        </a>
                        <a href="{{ route('client.dashboard') }}"
                            class="inline-flex items-center gap-2 px-5 py-3 rounded-xl border border-white/40 text-white font-semibold hover:bg-white/10 transition">
                            <i class="fas fa-tachometer-alt"></i>
                            لوحة التحكم
                        </a>
                    </div>
                </div>

                @php
                    $totalTenders = $user->tenders()->count();
                    $activeTenders = $user->tenders()->where('status', 'active')->count();
                    $awardedTenders = $user->tenders()->where('status', 'awarded')->count();
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-8 pb-8">
                    <div class="bg-white/10 rounded-2xl p-5 border border-white/10">
                        <p class="text-sm text-gray-200 mb-1">إجمالي المنافسات</p>
                        <p class="text-3xl font-bold">{{ $totalTenders }}</p>
                    </div>
                    <div class="bg-white/10 rounded-2xl p-5 border border-white/10">
                        <p class="text-sm text-gray-200 mb-1">المنافسات النشطة</p>
                        <p class="text-3xl font-bold">{{ $activeTenders }}</p>
                    </div>
                    <div class="bg-white/10 rounded-2xl p-5 border border-white/10">
                        <p class="text-sm text-gray-200 mb-1">المنافسات الممنوحة</p>
                        <p class="text-3xl font-bold">{{ $awardedTenders }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                            <h2 class="text-xl font-bold text-[#1a262a]">معلومات التواصل</h2>
                            <a href="{{ route('client.profile.edit') }}" class="text-sm text-[#2f5c69] font-semibold hover:underline">
                                تعديل المعلومات
                            </a>
                        </div>
                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="border border-gray-100 rounded-xl p-4">
                                <p class="text-sm text-gray-500 mb-1">البريد الإلكتروني</p>
                                <p class="text-base font-semibold text-[#1a262a]">{{ $user->email }}</p>
                            </div>
                            <div class="border border-gray-100 rounded-xl p-4">
                                <p class="text-sm text-gray-500 mb-1">رقم الهاتف</p>
                                <p class="text-base font-semibold text-[#1a262a]">{{ $user->phone ?? 'غير مضاف' }}</p>
                            </div>
                            <div class="border border-gray-100 rounded-xl p-4">
                                <p class="text-sm text-gray-500 mb-1">واتساب</p>
                                <p class="text-base font-semibold text-[#1a262a]">{{ $user->whatsapp ?? 'غير مضاف' }}</p>
                            </div>
                            <div class="border border-gray-100 rounded-xl p-4">
                                <p class="text-sm text-gray-500 mb-1">المدينة</p>
                                <p class="text-base font-semibold text-[#1a262a]">{{ $user->city ?? 'غير مضاف' }}</p>
                            </div>
                            <div class="md:col-span-2 border border-gray-100 rounded-xl p-4">
                                <p class="text-sm text-gray-500 mb-1">نبذة تعريفية</p>
                                <p class="text-gray-700 leading-relaxed">
                                    {{ optional($user->profile)->bio ?? 'لا توجد نبذة مضافة بعد. قم بتحديث ملفك الشخصي لإبراز معلوماتك.' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                            <h2 class="text-xl font-bold text-[#1a262a]">آخر المنافسات</h2>
                            <a href="{{ route('client.my-tenders') }}" class="text-sm text-[#2f5c69] font-semibold hover:underline">
                                عرض جميع المنافسات
                            </a>
                        </div>
                        <div class="p-6 space-y-4">
                            @php
                                $recentTenders = $user->tenders()->latest()->take(3)->get();
                            @endphp
                            @if($recentTenders->count() > 0)
                                @foreach ($recentTenders as $tender)
                                    <div class="flex items-center justify-between border border-gray-100 rounded-xl p-4 hover:bg-gray-50 transition">
                                        <div>
                                            <p class="text-base font-semibold text-[#1a262a]">{{ $tender->title }}</p>
                                            <p class="text-sm text-gray-500">{{ $tender->created_at->diffForHumans() }}</p>
                                        </div>
                                        <span class="text-xs font-bold px-3 py-1 rounded-full bg-[#f3a446]/15 text-[#f3a446]">
                                            {{ $tender->status ?? 'نشط' }}
                                        </span>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-8 text-gray-500">
                                    <p>لا توجد منافسات حتى الآن</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h2 class="text-xl font-bold text-[#1a262a]">حالة الحساب</h2>
                        </div>
                        <div class="p-6 space-y-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-[#1a262a]">الحساب مفعّل</p>
                                    <p class="text-xs text-gray-500">يمكنك استخدام جميع الميزات</p>
                                </div>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-600">نعم</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-[#1a262a]">البريد الإلكتروني</p>
                                    <p class="text-xs text-gray-500">تم التحقق من البريد</p>
                                </div>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-600">نعم</span>
                            </div>
                            <div class="pt-4 border-t border-gray-100">
                                <a href="{{ route('client.profile.edit') }}"
                                    class="inline-flex items-center justify-center w-full gap-2 px-4 py-2 rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-50 transition">
                                    <i class="fas fa-shield-alt"></i>
                                    إدارة الأمان
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h2 class="text-xl font-bold text-[#1a262a]">إجراءات سريعة</h2>
                        </div>
                        <div class="p-6 space-y-3">
                            <a href="{{ route('tenders.create') }}"
                                class="flex items-center justify-between p-3 rounded-xl border border-gray-100 hover:bg-gray-50 transition">
                                <div class="flex items-center gap-3">
                                    <span class="w-10 h-10 rounded-xl bg-[#f3a446]/15 text-[#f3a446] flex items-center justify-center">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <div>
                                        <p class="text-sm font-semibold text-[#1a262a]">إنشاء منافسة</p>
                                        <p class="text-xs text-gray-500">ابدأ منافسة جديدة</p>
                                    </div>
                                </div>
                                <i class="fas fa-chevron-left text-gray-400"></i>
                            </a>
                            <a href="{{ route('client.my-tenders') }}"
                                class="flex items-center justify-between p-3 rounded-xl border border-gray-100 hover:bg-gray-50 transition">
                                <div class="flex items-center gap-3">
                                    <span class="w-10 h-10 rounded-xl bg-[#2f5c69]/15 text-[#2f5c69] flex items-center justify-center">
                                        <i class="fas fa-file-alt"></i>
                                    </span>
                                    <div>
                                        <p class="text-sm font-semibold text-[#1a262a]">منافساتي</p>
                                        <p class="text-xs text-gray-500">عرض جميع منافساتي</p>
                                    </div>
                                </div>
                                <i class="fas fa-chevron-left text-gray-400"></i>
                            </a>
                            <a href="{{ route('client.saved-designs') }}"
                                class="flex items-center justify-between p-3 rounded-xl border border-gray-100 hover:bg-gray-50 transition">
                                <div class="flex items-center gap-3">
                                    <span class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                        <i class="fas fa-bookmark"></i>
                                    </span>
                                    <div>
                                        <p class="text-sm font-semibold text-[#1a262a]">التصاميم المحفوظة</p>
                                        <p class="text-xs text-gray-500">عرض التصاميم المحفوظة</p>
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
@endsection
