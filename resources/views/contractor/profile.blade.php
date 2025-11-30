@extends('layouts.app')

@section('title', __('app.contractor_profile') . ' - ' . ($user->name ?? ''))

@section('content')

<div class="min-h-screen bg-[#f8fafc] pt-24 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-6 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 text-sm font-semibold shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-gradient-to-r from-[#2f5c69] to-[#1a262a] text-white rounded-3xl shadow-2xl overflow-hidden mb-10 relative">
            <div class="absolute inset-0 opacity-10 pointer-events-none">
                <i class="fas fa-building text-9xl absolute -left-10 -bottom-10 transform rotate-12 text-white"></i>
                <i class="fas fa-drafting-compass text-9xl absolute -right-10 top-0 transform -rotate-12 text-white"></i>
            </div>

            <div class="relative z-10 px-8 py-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
                @php
                    $avatarUrl = $user->avatar_url ?? ($user->profile ? $user->profile->avatar_url : null);
                @endphp
                <div class="flex items-center gap-6">
                    <div class="w-28 h-28 rounded-2xl overflow-hidden border-4 border-white/20 shadow-xl bg-white">
                        @if ($avatarUrl)
                            <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-[#f8fafc] flex items-center justify-center text-4xl font-bold uppercase text-[#2f5c69]">
                                {{ Str::substr($user->name, 0, 2) }}
                            </div>
                        @endif
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="w-1.5 h-6 bg-[#f3a446] rounded-full inline-block"></span>
                            <p class="text-sm uppercase tracking-widest text-gray-300">{{ __('app.contractor_profile') }}</p>
                        </div>
                        <h1 class="text-3xl font-bold tracking-wide">{{ $user->name }}</h1>
                        <p class="text-gray-300 mt-2 flex items-center gap-2">
                            <i class="far fa-calendar-alt text-[#f3a446]"></i>
                            {{ __('app.member_since') }} {{ optional($user->created_at)->translatedFormat('F Y') }}
                        </p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('contractor.profile.edit') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#f3a446] text-white font-bold shadow-lg hover:bg-[#d18a3a] hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <i class="fas fa-edit"></i>
                        {{ __('app.edit_profile') }}
                    </a>
                    <a href="{{ route('contractor.dashboard') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 text-white font-bold hover:bg-white/20 transition-all duration-300">
                        <i class="fas fa-tachometer-alt"></i>
                        {{ __('app.dashboard') }}
                    </a>
                </div>
            </div>

            <div class="relative z-10 grid grid-cols-1 md:grid-cols-3 gap-6 px-8 pb-8">
                @php
                    $projectsCompleted = data_get($user->profile, 'projects_completed', 0);
                    $teamSize = data_get($user->profile, 'team_size', 0);
                    $activeBids = data_get($user->profile, 'active_bids', 0);
                @endphp
                <div class="bg-white/10 rounded-2xl p-5 border border-white/10 backdrop-blur hover:bg-white/20 transition-colors duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-300 mb-1 font-medium">{{ __('app.projects_completed') }}</p>
                            <p class="text-3xl font-bold text-white">{{ $projectsCompleted }}</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-[#f3a446]/20 flex items-center justify-center">
                            <i class="fas fa-check-circle text-[#f3a446]"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white/10 rounded-2xl p-5 border border-white/10 backdrop-blur hover:bg-white/20 transition-colors duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-300 mb-1 font-medium">{{ __('app.team_members') }}</p>
                            <p class="text-3xl font-bold text-white">{{ $teamSize }}</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-[#f3a446]/20 flex items-center justify-center">
                            <i class="fas fa-users text-[#f3a446]"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white/10 rounded-2xl p-5 border border-white/10 backdrop-blur hover:bg-white/20 transition-colors duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-300 mb-1 font-medium">{{ __('app.active_bids') }}</p>
                            <p class="text-3xl font-bold text-white">{{ $activeBids }}</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-[#f3a446]/20 flex items-center justify-center">
                            <i class="fas fa-gavel text-[#f3a446]"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                        <i class="fas fa-building text-[#f3a446] text-xl"></i>
                        <h2 class="text-xl font-bold text-[#2f5c69]">{{ __('app.company_info') }}</h2>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 hover:border-[#2f5c69]/30 transition-colors">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">{{ __('app.company_name') }}</p>
                            <p class="text-lg font-bold text-[#2f5c69]">
                                {{ $user->profile && $user->profile->company_name ? $user->profile->company_name : __('app.not_specified') }}
                            </p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 hover:border-[#2f5c69]/30 transition-colors">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">{{ __('app.specialization') }}</p>
                            <p class="text-lg font-bold text-[#2f5c69]">
                                {{ $user->profile && $user->profile->specializations && is_array($user->profile->specializations) && !empty($user->profile->specializations) ? $user->profile->specializations[0] : __('app.general_contracting') }}
                            </p>
                        </div>
                        <div class="md:col-span-2 bg-gray-50 rounded-xl p-4 border border-gray-100 hover:border-[#2f5c69]/30 transition-colors">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">{{ __('app.bio') }}</p>
                            <p class="text-gray-600 leading-relaxed">
                                {{ $user->profile && $user->profile->bio ? $user->profile->bio : __('app.bio_placeholder') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-history text-[#f3a446] text-xl"></i>
                            <h2 class="text-xl font-bold text-[#2f5c69]">{{ __('app.recent_activities') }}</h2>
                        </div>
                       
                    </div>
                    <div class="p-6 space-y-4">
                        @php
                            $recentActivities = [
                                [
                                    'title' => __('app.activity_bid_submission'),
                                    'status' => __('app.status_under_review'),
                                    'time' => __('app.time_hours_ago'),
                                    'icon' => 'fa-file-contract',
                                    'color' => 'blue'
                                ],
                                [
                                    'title' => __('app.activity_profile_updated'),
                                    'status' => __('app.status_completed'),
                                    'time' => __('app.time_day_ago'),
                                    'icon' => 'fa-user-edit',
                                    'color' => 'green'
                                ],
                                [
                                    'title' => __('app.activity_invite_received'),
                                    'status' => __('app.status_new'),
                                    'time' => __('app.time_days_ago'),
                                    'icon' => 'fa-envelope-open-text',
                                    'color' => 'orange'
                                ],
                            ];
                        @endphp

                        @foreach ($recentActivities as $activity)
                            <div class="flex items-center justify-between p-4 rounded-xl border border-gray-100 hover:border-[#f3a446]/30 hover:bg-[#fff9f2] transition-all duration-300 group">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center border border-gray-100 group-hover:scale-110 transition-transform">
                                        <i class="fas {{ $activity['icon'] }} text-[#2f5c69]"></i>
                                    </div>
                                    <div>
                                        <p class="text-base font-bold text-gray-800 group-hover:text-[#2f5c69] transition-colors">{{ $activity['title'] }}</p>
                                        <p class="text-xs text-gray-500 flex items-center gap-1">
                                            <i class="far fa-clock text-[#f3a446]"></i>
                                            {{ $activity['time'] }}
                                        </p>
                                    </div>
                                </div>
                                <span class="text-xs font-bold px-3 py-1.5 rounded-lg
                                    {{ $activity['status'] === __('app.status_completed') ? 'bg-green-50 text-green-700' :
                                       ($activity['status'] === __('app.status_new') ? 'bg-[#f3a446]/10 text-[#d18a3a]' : 'bg-blue-50 text-blue-700') }}">
                                    {{ $activity['status'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                        <i class="fas fa-address-card text-[#f3a446] text-xl"></i>
                        <h2 class="text-xl font-bold text-[#2f5c69]">{{ __('app.contact_info') }}</h2>
                    </div>
                    <div class="p-6 space-y-5">
                        <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                            <span class="w-12 h-12 rounded-xl bg-[#2f5c69]/10 text-[#2f5c69] flex items-center justify-center shadow-sm">
                                <i class="fas fa-envelope text-lg"></i>
                            </span>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase">{{ __('app.email') }}</p>
                                <p class="text-sm font-bold text-gray-800">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                            <span class="w-12 h-12 rounded-xl bg-[#f3a446]/10 text-[#f3a446] flex items-center justify-center shadow-sm">
                                <i class="fas fa-phone text-lg"></i>
                            </span>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase">{{ __('app.phone') }}</p>
                                <p class="text-sm font-bold text-gray-800 dir-ltr text-right">{{ $user->phone ?? __('app.not_added') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                            <span class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shadow-sm">
                                <i class="fab fa-whatsapp text-xl"></i>
                            </span>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase">{{ __('app.whatsapp') }}</p>
                                <p class="text-sm font-bold text-gray-800 dir-ltr text-right">{{ $user->whatsapp ?? __('app.not_added') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                            <span class="w-12 h-12 rounded-xl bg-[#2f5c69]/10 text-[#2f5c69] flex items-center justify-center shadow-sm">
                                <i class="fas fa-map-marker-alt text-lg"></i>
                            </span>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase">{{ __('app.city') }}</p>
                                <p class="text-sm font-bold text-gray-800">{{ $user->city ?? __('app.not_specified') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
</div>
@endsection