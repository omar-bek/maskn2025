@extends('layouts.app')

@section('title', __('app.consultant_profile') . ' - ' . ($user->name ?? ''))

@section('content') <div class="bg-white min-h-screen pt-24 pb-12 font-sans"> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="mb-6 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 text-sm font-bold shadow-sm flex items-center">
                <i class="fas fa-check-circle rtl:ml-2 ltr:mr-2 text-xl"></i>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-2xl bg-red-50 border border-red-200 px-6 py-4 text-sm text-red-700 shadow-sm">
                <ul class="space-y-1 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="relative z-10 mb-10">
            <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-gray-200 px-8 py-10 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#1a262a] via-[#2f5c69] to-[#f3a446]"></div>
                
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8 relative z-10">
                    @php
                        $avatarUrl = $user->avatar_url ?? optional($user->profile)->avatar_url;
                    @endphp
                    <div class="flex items-center gap-6">
                        <div class="relative">
                            @if ($avatarUrl)
                                <div class="w-32 h-32 rounded-3xl overflow-hidden border-4 border-white shadow-xl ring-1 ring-gray-200">
                                    <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-32 h-32 rounded-3xl bg-gradient-to-br from-[#2f5c69] to-[#1a262a] flex items-center justify-center text-4xl font-bold uppercase text-white shadow-xl ring-1 ring-gray-200">
                                    {{ Str::substr($user->name, 0, 2) }}
                                </div>
                            @endif
                            <div class="absolute -bottom-2 -right-2 bg-emerald-500 w-7 h-7 rounded-full border-4 border-white shadow-sm"></div>
                        </div>
                        
                        <div>
                            <h1 class="text-4xl font-extrabold text-[#1a262a] tracking-tight mb-2">{{ $user->name }}</h1>
                            <div class="flex flex-wrap items-center gap-3 text-gray-600">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-[#2f5c69] text-white shadow-sm">
                                    <i class="fas fa-certificate rtl:ml-1 ltr:mr-1 text-[10px]"></i>
                                    {{ __('app.certified_consultant') }}
                                </span>
                                <span class="text-sm font-medium bg-gray-100 px-3 py-1 rounded-full border border-gray-200">
                                    {{ $user->userType->name ?? __('app.user_type_undefined') }}
                                </span>
                            </div>
                            <p class="text-gray-500 text-sm mt-3 flex items-center font-medium">
                                <i class="far fa-calendar-alt rtl:ml-2 ltr:mr-2 text-[#f3a446]"></i>
                                {{ __('app.member_since') }} {{ optional($user->created_at)->translatedFormat('F Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('designs.create') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-xl bg-[#f3a446] text-[#1a262a] font-bold shadow-lg shadow-orange-100 hover:bg-[#f5b05a] hover:shadow-orange-200 hover:-translate-y-0.5 transition-all duration-300 border border-orange-300">
                            <i class="fas fa-plus rtl:ml-2 ltr:mr-2"></i>
                            {{ __('app.add_new_design') }}
                        </a>
                        <a href="{{ route('consultant.portfolio') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-xl bg-white border-2 border-gray-200 text-[#2f5c69] font-bold hover:bg-gray-50 hover:border-[#2f5c69] transition-all duration-300 shadow-sm">
                            <i class="fas fa-images rtl:ml-2 ltr:mr-2"></i>
                            {{ __('app.view_my_portfolio') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @php
            $designsCount = $user->designs()->count();
            $proposalsCount = $user->proposals()->count();
            $acceptedProposals = $user->proposals()->where('status', 'accepted')->count();
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white rounded-2xl shadow-[0_4px_20px_rgb(0,0,0,0.05)] p-6 border border-gray-200 hover:border-[#f3a446] transition-colors group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-500 mb-2 uppercase tracking-wide">{{ __('app.designs_count') }}</p>
                        <p class="text-4xl font-extrabold text-[#1a262a]">{{ $designsCount }}</p>
                    </div>
                    <div class="w-16 h-16 rounded-2xl bg-orange-50 border border-orange-100 text-[#f3a446] flex items-center justify-center text-3xl group-hover:bg-[#f3a446] group-hover:text-white transition-all duration-300">
                        <i class="fas fa-layer-group"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-[0_4px_20px_rgb(0,0,0,0.05)] p-6 border border-gray-200 hover:border-[#2f5c69] transition-colors group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-500 mb-2 uppercase tracking-wide">{{ __('app.proposals_count') }}</p>
                        <p class="text-4xl font-extrabold text-[#1a262a]">{{ $proposalsCount }}</p>
                    </div>
                    <div class="w-16 h-16 rounded-2xl bg-cyan-50 border border-cyan-100 text-[#2f5c69] flex items-center justify-center text-3xl group-hover:bg-[#2f5c69] group-hover:text-white transition-all duration-300">
                        <i class="fas fa-file-signature"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-[0_4px_20px_rgb(0,0,0,0.05)] p-6 border border-gray-200 hover:border-emerald-500 transition-colors group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-500 mb-2 uppercase tracking-wide">{{ __('app.accepted_proposals') }}</p>
                        <p class="text-4xl font-extrabold text-[#1a262a]">{{ $acceptedProposals }}</p>
                    </div>
                    <div class="w-16 h-16 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center text-3xl group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                        <i class="fas fa-check-double"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-white border border-gray-200 rounded-3xl shadow-[0_4px_20px_rgb(0,0,0,0.04)] overflow-hidden">
                    <div class="px-8 py-5 border-b border-gray-200 bg-gray-50/80 flex items-center justify-between">
                        <h2 class="text-xl font-extrabold text-[#1a262a] flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-[#f3a446] text-white flex items-center justify-center text-sm">
                                <i class="fas fa-user"></i>
                            </span>
                            {{ __('app.bio_section') }}
                        </h2>
                    </div>
                    <div class="p-8 space-y-8">
                        <p class="text-gray-700 leading-relaxed text-lg font-medium">
                            {{ optional($user->profile)->bio ?? __('app.no_bio') }}
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200 hover:border-gray-300 transition-colors">
                                <p class="text-xs text-gray-400 mb-2 uppercase tracking-wider font-bold">{{ __('app.specialization') }}</p>
                                <p class="text-lg font-bold text-[#2f5c69] flex items-center gap-2">
                                    <i class="fas fa-drafting-compass rtl:ml-2 ltr:mr-2 text-[#f3a446]"></i>
                                    {{ optional($user->profile)->specialization ?? __('app.default_specialization') }}
                                </p>
                            </div>
                            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200 hover:border-gray-300 transition-colors">
                                <p class="text-xs text-gray-400 mb-2 uppercase tracking-wider font-bold">{{ __('app.city') }}</p>
                                <p class="text-lg font-bold text-[#2f5c69] flex items-center gap-2">
                                    <i class="fas fa-map-marker-alt rtl:ml-2 ltr:mr-2 text-[#f3a446]"></i>
                                    {{ $user->city ?? __('app.undefined') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-3xl shadow-[0_4px_20px_rgb(0,0,0,0.04)] overflow-hidden">
                    <div class="px-8 py-5 border-b border-gray-200 bg-gray-50/80 flex items-center justify-between">
                        <h2 class="text-xl font-extrabold text-[#1a262a] flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-[#2f5c69] text-white flex items-center justify-center text-sm">
                                <i class="fas fa-cube"></i>
                            </span>
                            {{ __('app.latest_designs') }}
                        </h2>
                        <a href="{{ route('designs.index') }}" class="text-sm text-[#2f5c69] font-bold hover:text-[#1a262a] transition-colors flex items-center gap-1 bg-white px-3 py-1.5 rounded-lg border border-gray-200 hover:border-gray-300 shadow-sm">
                            {{ __('app.view_all') }}
                            <i class="fas fa-arrow-left rtl:inline ltr:hidden mr-1"></i>
                            <i class="fas fa-arrow-right rtl:hidden ltr:inline ml-1"></i>
                        </a>
                    </div>
                    <div class="p-8">
                        @php
                            $recentDesigns = $user->designs()->latest()->take(4)->get();
                        @endphp
                        @if ($recentDesigns->isEmpty())
                            <div class="text-center py-12 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-300">
                                <div class="w-16 h-16 bg-white rounded-full shadow-sm border border-gray-200 flex items-center justify-center mx-auto mb-4 text-gray-400">
                                    <i class="fas fa-folder-open text-2xl"></i>
                                </div>
                                <p class="text-gray-600 font-bold mb-4">{{ __('app.no_designs_yet') }}</p>
                                <a href="{{ route('designs.create') }}" class="inline-flex items-center px-6 py-3 bg-[#f3a446] text-[#1a262a] rounded-xl font-bold hover:bg-[#f5b05a] transition shadow-md shadow-orange-100 border border-orange-300">
                                    <i class="fas fa-plus rtl:ml-2 ltr:mr-2"></i>
                                    {{ __('app.add_first_design') }}
                                </a>
                            </div>
                        @else
                            <div class="grid gap-5">
                                @foreach ($recentDesigns as $design)
                                    <div class="group flex items-center justify-between p-5 border border-gray-200 rounded-2xl bg-white hover:border-[#2f5c69] hover:shadow-md transition-all duration-300">
                                        <div class="flex items-center gap-5">
                                            <div class="w-14 h-14 rounded-xl bg-gray-50 border border-gray-100 text-[#2f5c69] flex items-center justify-center group-hover:bg-[#2f5c69] group-hover:text-white transition-colors">
                                                <i class="fas fa-image text-xl"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-bold text-[#1a262a] group-hover:text-[#2f5c69] transition-colors">{{ $design->title }}</h3>
                                                <p class="text-sm text-gray-500 flex items-center gap-2 mt-1 font-medium">
                                                    <span class="bg-gray-100 px-2 py-0.5 rounded text-xs">{{ $design->style }}</span>
                                                    <span class="text-gray-300">•</span>
                                                    <span>{{ $design->formatted_area }}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-lg font-extrabold text-[#2f5c69]">{{ $design->formatted_price }}</p>
                                            <a href="{{ route('designs.show', $design->id) }}" class="inline-flex items-center justify-center mt-2 text-xs font-bold text-white bg-gray-800 px-3 py-1.5 rounded-lg hover:bg-[#f3a446] transition-colors">
                                                {{ __('app.view_details') }}
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
                <div class="bg-white border border-gray-200 rounded-3xl shadow-[0_4px_20px_rgb(0,0,0,0.04)] overflow-hidden">
                    <div class="px-8 py-5 border-b border-gray-200 bg-gray-50/80">
                        <h2 class="text-xl font-extrabold text-[#1a262a]">{{ __('app.contact_info') }}</h2>
                    </div>
                    <div class="p-8 space-y-6">
                        <div class="flex items-center gap-4 group p-3 rounded-xl hover:bg-gray-50 border border-transparent hover:border-gray-100 transition-all">
                            <span class="w-12 h-12 rounded-xl bg-orange-50 border border-orange-100 text-[#f3a446] flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                <i class="fas fa-envelope text-xl"></i>
                            </span>
                            <div>
                                <p class="text-xs text-gray-400 mb-1 font-bold uppercase">{{ __('app.email') }}</p>
                                <p class="text-sm font-bold text-[#1a262a] break-all">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 group p-3 rounded-xl hover:bg-gray-50 border border-transparent hover:border-gray-100 transition-all">
                            <span class="w-12 h-12 rounded-xl bg-cyan-50 border border-cyan-100 text-[#2f5c69] flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                <i class="fas fa-phone text-xl"></i>
                            </span>
                            <div>
                                <p class="text-xs text-gray-400 mb-1 font-bold uppercase">{{ __('app.phone_number') }}</p>
                                <p class="text-sm font-bold text-[#1a262a] dir-ltr text-right rtl:text-right ltr:text-left">
                                    {{ $user->phone ?? __('app.not_added') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 group p-3 rounded-xl hover:bg-gray-50 border border-transparent hover:border-gray-100 transition-all">
                            <span class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                <i class="fab fa-whatsapp text-xl"></i>
                            </span>
                            <div>
                                <p class="text-xs text-gray-400 mb-1 font-bold uppercase">{{ __('app.whatsapp') }}</p>
                                <p class="text-sm font-bold text-[#1a262a] dir-ltr text-right rtl:text-right ltr:text-left">
                                    {{ $user->whatsapp ?? __('app.not_added') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-[#1a262a] to-[#2f5c69] rounded-3xl shadow-xl shadow-gray-400 text-white overflow-hidden relative border border-gray-800">
                    <div class="absolute top-0 right-0 -mr-10 -mt-10 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 -ml-10 -mb-10 w-32 h-32 bg-[#f3a446]/30 rounded-full blur-3xl"></div>
                    
                    <div class="p-8 relative z-10">
                        <h2 class="text-xl font-bold mb-3">{{ __('app.update_profile') }}</h2>
                        <p class="text-gray-300 text-sm leading-relaxed mb-6 border-l-2 border-[#f3a446] pl-4 rtl:border-l-0 rtl:border-r-2 rtl:pl-0 rtl:pr-4">
                            {{ __('app.update_profile_tip') }}
                        </p>
                        <a href="{{ route('consultant.profile.edit') }}" class="flex items-center justify-center gap-2 w-full px-4 py-4 rounded-xl bg-white text-[#1a262a] font-bold hover:bg-gray-50 transition shadow-lg">
                            <i class="fas fa-edit rtl:ml-2 ltr:mr-2 text-[#f3a446]"></i>
                            {{ __('app.go_to_edit') }}
                        </a>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-3xl shadow-[0_4px_20px_rgb(0,0,0,0.04)] overflow-hidden">
                    <div class="px-8 py-5 border-b border-gray-200 bg-gray-50/80">
                        <h2 class="text-xl font-extrabold text-[#1a262a]">{{ __('app.quick_actions') }}</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <a href="{{ route('designs.index') }}" class="flex items-center justify-between p-4 rounded-xl border border-gray-200 bg-white hover:border-[#f3a446] hover:shadow-md transition-all duration-300 group">
                            <div class="flex items-center gap-4">
                                <span class="w-10 h-10 rounded-lg bg-orange-50 text-[#f3a446] flex items-center justify-center group-hover:bg-[#f3a446] group-hover:text-white transition-colors shadow-sm">
                                    <i class="fas fa-home"></i>
                                </span>
                                <div>
                                    <p class="text-sm font-bold text-[#1a262a]">{{ __('app.my_designs') }}</p>
                                    <p class="text-xs text-gray-500">{{ __('app.manage_designs') }}</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-left rtl:inline ltr:hidden text-gray-300 group-hover:text-[#f3a446]"></i>
                            <i class="fas fa-chevron-right rtl:hidden ltr:inline text-gray-300 group-hover:text-[#f3a446]"></i>
                        </a>

                        <a href="{{ route('proposals.index') }}" class="flex items-center justify-between p-4 rounded-xl border border-gray-200 bg-white hover:border-[#2f5c69] hover:shadow-md transition-all duration-300 group">
                            <div class="flex items-center gap-4">
                                <span class="w-10 h-10 rounded-lg bg-cyan-50 text-[#2f5c69] flex items-center justify-center group-hover:bg-[#2f5c69] group-hover:text-white transition-colors shadow-sm">
                                    <i class="fas fa-file-alt"></i>
                                </span>
                                <div>
                                    <p class="text-sm font-bold text-[#1a262a]">{{ __('app.my_proposals') }}</p>
                                    <p class="text-xs text-gray-500">{{ __('app.track_proposals') }}</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-left rtl:inline ltr:hidden text-gray-300 group-hover:text-[#2f5c69]"></i>
                            <i class="fas fa-chevron-right rtl:hidden ltr:inline text-gray-300 group-hover:text-[#2f5c69]"></i>
                        </a>

                        <a href="{{ route('tenders.index') }}" class="flex items-center justify-between p-4 rounded-xl border border-gray-200 bg-white hover:border-emerald-500 hover:shadow-md transition-all duration-300 group">
                            <div class="flex items-center gap-4">
                                <span class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-colors shadow-sm">
                                    <i class="fas fa-search"></i>
                                </span>
                                <div>
                                    <p class="text-sm font-bold text-[#1a262a]">{{ __('app.explore_tenders') }}</p>
                                    <p class="text-xs text-gray-500">{{ __('app.find_opportunities') }}</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-left rtl:inline ltr:hidden text-gray-300 group-hover:text-emerald-600"></i>
                            <i class="fas fa-chevron-right rtl:hidden ltr:inline text-gray-300 group-hover:text-emerald-600"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection