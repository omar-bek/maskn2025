@extends('layouts.app')

@section('title', __('app.profile') . ' - ' . ($user->name ?? ''))

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
                        $path = $user->avatar_url ?? optional($user->profile)->avatar_url;
                        $avatarUrl = null;
                        if ($path) {
                            $avatarUrl = str_starts_with($path, 'http') ? $path : asset('storage/' . str_replace('public/', '', $path));
                        }
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
                            <p class="text-sm uppercase tracking-widest text-white/70">{{ __('app.profile') }}</p>
                            <h1 class="text-3xl font-extrabold">{{ $user->name }}</h1>
                            <p class="text-gray-300 mt-2">{{ __('app.member_since') }} {{ optional($user->created_at)->translatedFormat('F Y') }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('client.profile.edit') }}"
                            class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-white text-[#1a262a] font-semibold shadow-lg hover:bg-gray-100 transition">
                            <i class="fas fa-edit"></i>
                            {{ __('app.edit_profile') }}
                        </a>
                        <a href="{{ route('client.dashboard') }}"
                            class="inline-flex items-center gap-2 px-5 py-3 rounded-xl border border-white/40 text-white font-semibold hover:bg-white/10 transition">
                            <i class="fas fa-tachometer-alt"></i>
                            {{ __('app.dashboard') }}
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
                        <p class="text-sm text-gray-200 mb-1">{{ __('app.total_tenders') }}</p>
                        <p class="text-3xl font-bold">{{ $totalTenders }}</p>
                    </div>
                    <div class="bg-white/10 rounded-2xl p-5 border border-white/10">
                        <p class="text-sm text-gray-200 mb-1">{{ __('app.active_tenders') }}</p>
                        <p class="text-3xl font-bold">{{ $activeTenders }}</p>
                    </div>
                    <div class="bg-white/10 rounded-2xl p-5 border border-white/10">
                        <p class="text-sm text-gray-200 mb-1">{{ __('app.awarded_tenders') }}</p>
                        <p class="text-3xl font-bold">{{ $awardedTenders }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                            <h2 class="text-xl font-bold text-[#1a262a]">{{ __('app.contact_info') }}</h2>
                            <a href="{{ route('client.profile.edit') }}" class="text-sm text-[#2f5c69] font-semibold hover:underline">
                                {{ __('app.edit_info') }}
                            </a>
                        </div>
                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="border border-gray-100 rounded-xl p-4">
                                <p class="text-sm text-gray-500 mb-1">{{ __('app.email') }}</p>
                                <p class="text-base font-semibold text-[#1a262a]">{{ $user->email }}</p>
                            </div>
                            <div class="border border-gray-100 rounded-xl p-4">
                                <p class="text-sm text-gray-500 mb-1">{{ __('app.phone') }}</p>
                                <p class="text-base font-semibold text-[#1a262a]">{{ $user->phone ?? __('app.not_added') }}</p>
                            </div>
                            <div class="border border-gray-100 rounded-xl p-4">
                                <p class="text-sm text-gray-500 mb-1">{{ __('app.whatsapp') }}</p>
                                <p class="text-base font-semibold text-[#1a262a]">{{ $user->whatsapp ?? __('app.not_added') }}</p>
                            </div>
                            <div class="border border-gray-100 rounded-xl p-4">
                                <p class="text-sm text-gray-500 mb-1">{{ __('app.city') }}</p>
                                <p class="text-base font-semibold text-[#1a262a]">{{ $user->city ?? __('app.not_added') }}</p>
                            </div>
                            <div class="md:col-span-2 border border-gray-100 rounded-xl p-4">
                                <p class="text-sm text-gray-500 mb-1">{{ __('app.bio') }}</p>
                                <p class="text-gray-700 leading-relaxed">
                                    {{ optional($user->profile)->bio ?? __('app.no_bio_added') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                            <h2 class="text-xl font-bold text-[#1a262a]">{{ __('app.recent_tenders') }}</h2>
                            <a href="{{ route('client.my-tenders') }}" class="text-sm text-[#2f5c69] font-semibold hover:underline">
                                {{ __('app.view_all_tenders') }}
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
                                            {{ $tender->status ?? __('app.active') }}
                                        </span>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-8 text-gray-500">
                                    <p>{{ __('app.no_tenders_yet') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h2 class="text-xl font-bold text-[#1a262a]">{{ __('app.account_status') }}</h2>
                        </div>
                        <div class="p-6 space-y-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-[#1a262a]">{{ __('app.account_active') }}</p>
                                    <p class="text-xs text-gray-500">{{ __('app.all_features_available') }}</p>
                                </div>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-600">{{ __('app.yes') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-[#1a262a]">{{ __('app.email') }}</p>
                                    <p class="text-xs text-gray-500">{{ __('app.email_verified') }}</p>
                                </div>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-600">{{ __('app.yes') }}</span>
                            </div>
                            <div class="pt-4 border-t border-gray-100">
                                <a href="{{ route('client.profile.edit') }}"
                                    class="inline-flex items-center justify-center w-full gap-2 px-4 py-2 rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-50 transition">
                                    <i class="fas fa-shield-alt"></i>
                                    {{ __('app.security_management') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h2 class="text-xl font-bold text-[#1a262a]">{{ __('app.quick_actions') }}</h2>
                        </div>
                        <div class="p-6 space-y-3">
                            <a href="{{ route('tenders.create') }}"
                                class="flex items-center justify-between p-3 rounded-xl border border-gray-100 hover:bg-gray-50 transition">
                                <div class="flex items-center gap-3">
                                    <span class="w-10 h-10 rounded-xl bg-[#f3a446]/15 text-[#f3a446] flex items-center justify-center">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <div>
                                        <p class="text-sm font-semibold text-[#1a262a]">{{ __('app.create_tender') }}</p>
                                        <p class="text-xs text-gray-500">{{ __('app.start_new_tender') }}</p>
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
                                        <p class="text-sm font-semibold text-[#1a262a]">{{ __('app.my_tenders') }}</p>
                                        <p class="text-xs text-gray-500">{{ __('app.view_my_tenders') }}</p>
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
                                        <p class="text-sm font-semibold text-[#1a262a]">{{ __('app.saved_designs') }}</p>
                                        <p class="text-xs text-gray-500">{{ __('app.view_saved_designs') }}</p>
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