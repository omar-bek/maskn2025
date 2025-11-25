@extends('layouts.app')

@section('title', 'ملف المقاول - ' . ($user->name ?? ''))

@section('content')
    <div class="bg-[#0f1c1f] pt-24 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 text-sm font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gradient-to-r from-[#1a262a] via-[#1f3940] to-[#2f5c69] text-white rounded-3xl shadow-2xl overflow-hidden mb-10">
                <div class="px-8 py-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
                    @php
                        $avatarUrl = $user->avatar_url ?? ($user->profile ? $user->profile->avatar_url : null);
                    @endphp
                    <div class="flex items-center gap-4">
                        <div class="w-24 h-24 rounded-2xl overflow-hidden border-2 border-white/40 shadow-lg">
                            @if ($avatarUrl)
                                <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-white/10 flex items-center justify-center text-3xl font-bold uppercase border border-white/30">
                                    {{ Str::substr($user->name, 0, 2) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm uppercase tracking-widest text-white/70">ملف المقاول</p>
                            <h1 class="text-3xl font-extrabold">{{ $user->name }}</h1>
                            <p class="text-gray-300 mt-2">عضو منذ {{ optional($user->created_at)->translatedFormat('F Y') }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('contractor.profile.edit') }}"
                            class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-white text-[#1a262a] font-semibold shadow-lg hover:bg-gray-100 transition">
                            <i class="fas fa-edit"></i>
                            تعديل الملف الشخصي
                        </a>
                        <a href="{{ route('contractor.dashboard') }}"
                            class="inline-flex items-center gap-2 px-5 py-3 rounded-xl border border-white/40 text-white font-semibold hover:bg-white/10 transition">
                            <i class="fas fa-tachometer-alt"></i>
                            لوحة التحكم
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-8 pb-8">
                    @php
                        $projectsCompleted = data_get($user->profile, 'projects_completed', 0);
                        $teamSize = data_get($user->profile, 'team_size', 0);
                        $activeBids = data_get($user->profile, 'active_bids', 0);
                    @endphp
                    <div class="bg-white/10 rounded-2xl p-5 border border-white/10 backdrop-blur">
                        <p class="text-sm text-gray-200 mb-1">المشاريع المكتملة</p>
                        <p class="text-3xl font-bold">{{ $projectsCompleted }}</p>
                    </div>
                    <div class="bg-white/10 rounded-2xl p-5 border border-white/10 backdrop-blur">
                        <p class="text-sm text-gray-200 mb-1">أفراد الفريق</p>
                        <p class="text-3xl font-bold">{{ $teamSize }}</p>
                    </div>
                    <div class="bg-white/10 rounded-2xl p-5 border border-white/10 backdrop-blur">
                        <p class="text-sm text-gray-200 mb-1">العطاءات النشطة</p>
                        <p class="text-3xl font-bold">{{ $activeBids }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                            <h2 class="text-xl font-bold text-[#1a262a]">بيانات الشركة</h2>
                        </div>
                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="border border-gray-100 rounded-xl p-4">
                                <p class="text-sm text-gray-500 mb-1">اسم الشركة</p>
                                <p class="text-base font-semibold text-[#1a262a]">
                                    {{ $user->profile && $user->profile->company_name ? $user->profile->company_name : 'غير محدد' }}
                                </p>
                            </div>
                            <div class="border border-gray-100 rounded-xl p-4">
                                <p class="text-sm text-gray-500 mb-1">التخصص</p>
                                <p class="text-base font-semibold text-[#1a262a]">
                                    {{ $user->profile && $user->profile->specializations && is_array($user->profile->specializations) && !empty($user->profile->specializations) ? $user->profile->specializations[0] : 'مقاولات عامة' }}
                                </p>
                            </div>
                            <div class="md:col-span-2 border border-gray-100 rounded-xl p-4">
                                <p class="text-sm text-gray-500 mb-1">نبذة مختصرة</p>
                                <p class="text-gray-700 leading-relaxed">
                                    {{ $user->profile && $user->profile->bio ? $user->profile->bio : 'لم تتم إضافة نبذة بعد. قم بتحديث ملفك لإبراز خبراتك ومشاريعك السابقة.' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                            <h2 class="text-xl font-bold text-[#1a262a]">العمليات الأخيرة</h2>
                            <a href="{{ route('contractor.bids') }}" class="text-sm text-[#2f5c69] font-semibold hover:underline">
                                عرض جميع العطاءات
                            </a>
                        </div>
                        <div class="p-6 space-y-4">
                            @php
                                $recentActivities = [
                                    [
                                        'title' => 'تقديم عرض لمناقصة بناء فيلا',
                                        'status' => 'قيد المراجعة',
                                        'time' => 'منذ 3 ساعات',
                                    ],
                                    [
                                        'title' => 'تم تحديث ملف الشركة',
                                        'status' => 'مكتمل',
                                        'time' => 'منذ يوم واحد',
                                    ],
                                    [
                                        'title' => 'استلام دعوة لمناقصة جديدة',
                                        'status' => 'جديد',
                                        'time' => 'منذ يومين',
                                    ],
                                ];
                            @endphp

                            @foreach ($recentActivities as $activity)
                                <div class="flex items-center justify-between border border-gray-100 rounded-xl p-4 hover:bg-gray-50 transition">
                                    <div>
                                        <p class="text-base font-semibold text-[#1a262a]">{{ $activity['title'] }}</p>
                                        <p class="text-sm text-gray-500">{{ $activity['time'] }}</p>
                                    </div>
                                    <span class="text-xs font-bold px-3 py-1 rounded-full bg-[#f3a446]/15 text-[#f3a446]">
                                        {{ $activity['status'] }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h2 class="text-xl font-bold text-[#1a262a]">معلومات التواصل</h2>
                        </div>
                        <div class="p-6 space-y-5">
                            <div class="flex items-center gap-4">
                                <span class="w-10 h-10 rounded-xl bg-[#f3a446]/15 text-[#f3a446] flex items-center justify-center">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <div>
                                    <p class="text-xs text-gray-500">البريد الإلكتروني</p>
                                    <p class="text-sm font-semibold text-[#1a262a]">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="w-10 h-10 rounded-xl bg-[#2f5c69]/15 text-[#2f5c69] flex items-center justify-center">
                                    <i class="fas fa-phone"></i>
                                </span>
                                <div>
                                    <p class="text-xs text-gray-500">رقم الهاتف</p>
                                    <p class="text-sm font-semibold text-[#1a262a]">{{ $user->phone ?? 'غير مضاف' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                    <i class="fab fa-whatsapp"></i>
                                </span>
                                <div>
                                    <p class="text-xs text-gray-500">واتساب</p>
                                    <p class="text-sm font-semibold text-[#1a262a]">{{ $user->whatsapp ?? 'غير مضاف' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="w-10 h-10 rounded-xl bg-[#f3a446]/15 text-[#f3a446] flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                                <div>
                                    <p class="text-xs text-gray-500">المدينة</p>
                                    <p class="text-sm font-semibold text-[#1a262a]">{{ $user->city ?? 'غير محدد' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h2 class="text-xl font-bold text-[#1a262a]">إجراءات سريعة</h2>
                        </div>
                        <div class="p-6 space-y-3">
                            <a href="{{ route('contractor.bids') }}"
                                class="flex items-center justify-between p-3 rounded-xl border border-gray-100 hover:bg-gray-50 transition">
                                <div class="flex items-center gap-3">
                                    <span class="w-10 h-10 rounded-xl bg-[#f3a446]/15 text-[#f3a446] flex items-center justify-center">
                                        <i class="fas fa-file-signature"></i>
                                    </span>
                                    <div>
                                        <p class="text-sm font-semibold text-[#1a262a]">عطاءاتي</p>
                                        <p class="text-xs text-gray-500">إدارة ومتابعة العطاءات</p>
                                    </div>
                                </div>
                                <i class="fas fa-chevron-left text-gray-400"></i>
                            </a>
                            <a href="{{ route('contractor.projects') }}"
                                class="flex items-center justify-between p-3 rounded-xl border border-gray-100 hover:bg-gray-50 transition">
                                <div class="flex items-center gap-3">
                                    <span class="w-10 h-10 rounded-xl bg-[#2f5c69]/15 text-[#2f5c69] flex items-center justify-center">
                                        <i class="fas fa-project-diagram"></i>
                                    </span>
                                    <div>
                                        <p class="text-sm font-semibold text-[#1a262a]">مشاريعي</p>
                                        <p class="text-xs text-gray-500">تفاصيل العمل الجاري</p>
                                    </div>
                                </div>
                                <i class="fas fa-chevron-left text-gray-400"></i>
                            </a>
                            <a href="{{ route('contractor.team') }}"
                                class="flex items-center justify-between p-3 rounded-xl border border-gray-100 hover:bg-gray-50 transition">
                                <div class="flex items-center gap-3">
                                    <span class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                        <i class="fas fa-users"></i>
                                    </span>
                                    <div>
                                        <p class="text-sm font-semibold text-[#1a262a]">فريقي</p>
                                        <p class="text-xs text-gray-500">إدارة أعضاء الفريق</p>
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

