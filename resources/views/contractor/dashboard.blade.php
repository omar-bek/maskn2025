@extends('layouts.app')

@section('title', __('app.dashboard_title'))

@section('content')
<div class="min-h-screen bg-[#f8fafc] mt-20">
    
    <div class="relative bg-gradient-to-r from-[#2f5c69] to-[#1a262a] pb-32 overflow-hidden">
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <i class="fas fa-building text-9xl absolute -left-10 -bottom-10 transform rotate-12 text-white"></i>
            <i class="fas fa-drafting-compass text-9xl absolute -right-10 top-0 transform -rotate-12 text-white"></i>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="text-white">
                    <h1 class="text-3xl font-bold tracking-wide flex items-center gap-3">
                        <span class="w-1.5 h-8 bg-[#f3a446] rounded-full inline-block"></span>
                        {{ __('app.welcome') }} {{ Auth::user()->name }}
                    </h1>
                    <p class="mt-2 text-gray-300 text-lg mr-5">{{ __('app.dashboard_subtitle') }}</p>
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('tenders.index') }}" class="group px-6 py-3 bg-[#f3a446] hover:bg-[#d18a3a] text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex items-center gap-2">
                        <i class="fas fa-gavel group-hover:rotate-12 transition-transform duration-300"></i>
                        {{ __('app.tenders') }}
                    </a>
                    <a href="{{ route('contractor.profile') }}" class="group px-6 py-3 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white font-bold rounded-xl border border-white/20 transition-all duration-300 flex items-center gap-2">
                        <i class="fas fa-user-cog"></i>
                        {{ __('app.profile') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-10">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            
            <div class="bg-white rounded-2xl shadow-xl border-b-4 border-[#2f5c69] p-6 hover:shadow-2xl transition-all duration-300 group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider">{{ __('app.ongoing_projects') }}</p>
                        <p class="text-3xl font-bold text-[#2f5c69] mt-2 group-hover:scale-110 transition-transform origin-right">{{ $stats['ongoing_projects'] ?? 0 }}</p>
                    </div>
                    <div class="w-14 h-14 bg-[#2f5c69]/10 rounded-2xl flex items-center justify-center group-hover:bg-[#2f5c69] transition-colors duration-300">
                        <i class="fas fa-hard-hat text-2xl text-[#2f5c69] group-hover:text-white transition-colors"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl border-b-4 border-[#f3a446] p-6 hover:shadow-2xl transition-all duration-300 group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider">{{ __('app.completed_projects') }}</p>
                        <p class="text-3xl font-bold text-[#2f5c69] mt-2 group-hover:scale-110 transition-transform origin-right">{{ $stats['completed_projects'] ?? 0 }}</p>
                    </div>
                    <div class="w-14 h-14 bg-[#f3a446]/10 rounded-2xl flex items-center justify-center group-hover:bg-[#f3a446] transition-colors duration-300">
                        <i class="fas fa-check-circle text-2xl text-[#f3a446] group-hover:text-white transition-colors"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl border-b-4 border-[#2f5c69] p-6 hover:shadow-2xl transition-all duration-300 group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider">{{ __('app.monthly_earnings') }}</p>
                        <p class="text-3xl font-bold text-[#2f5c69] mt-2 group-hover:scale-110 transition-transform origin-right">{{ number_format($stats['monthly_earnings'] ?? 0) }} <span class="text-sm text-gray-400 font-normal">{{ __('app.currency') }}</span></p>
                    </div>
                    <div class="w-14 h-14 bg-[#2f5c69]/10 rounded-2xl flex items-center justify-center group-hover:bg-[#2f5c69] transition-colors duration-300">
                        <i class="fas fa-wallet text-2xl text-[#2f5c69] group-hover:text-white transition-colors"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl border-b-4 border-[#f3a446] p-6 hover:shadow-2xl transition-all duration-300 group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider">{{ __('app.team_members') }}</p>
                        <p class="text-3xl font-bold text-[#2f5c69] mt-2 group-hover:scale-110 transition-transform origin-right">{{ $stats['team_members'] ?? 0 }} <span class="text-sm text-gray-400 font-normal">{{ __('app.member_unit') }}</span></p>
                    </div>
                    <div class="w-14 h-14 bg-[#f3a446]/10 rounded-2xl flex items-center justify-center group-hover:bg-[#f3a446] transition-colors duration-300">
                        <i class="fas fa-users text-2xl text-[#f3a446] group-hover:text-white transition-colors"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-[#2f5c69] flex items-center gap-2">
                            <i class="fas fa-project-diagram text-[#f3a446]"></i>
                            {{ __('app.recent_projects') }}
                        </h3>
                        <!-- <a href="{{ route('contractor.projects') }}" class="text-sm text-[#2f5c69] hover:text-[#f3a446] font-medium transition-colors">{{ __('app.view_all') }}</a> -->
                    </div>
                    <div class="p-6">
                        @if(isset($recentProjects) && count($recentProjects) > 0)
                            <div class="space-y-4">
                                @foreach($recentProjects as $project)
                                    <div class="group flex flex-col sm:flex-row items-center justify-between p-4 rounded-xl border border-gray-100 hover:border-[#f3a446]/30 hover:bg-[#fff9f2] transition-all duration-300">
                                        <div class="flex items-center w-full sm:w-auto mb-4 sm:mb-0">
                                            <div class="flex-shrink-0 ml-4">
                                                <div class="w-12 h-12 bg-white border border-gray-100 rounded-xl shadow-sm flex items-center justify-center group-hover:scale-110 transition-transform">
                                                    <i class="fas fa-building text-[#2f5c69]"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <h4 class="text-base font-bold text-gray-800 group-hover:text-[#2f5c69] transition-colors">{{ $project['title'] }}</h4>
                                                <p class="text-sm text-gray-500 flex items-center gap-1">
                                                    <i class="fas fa-map-marker-alt text-[#f3a446] text-xs"></i>
                                                    {{ $project['location'] }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between w-full sm:w-auto gap-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-bold border
                                                @if($project['status'] === 'ongoing') bg-teal-50 text-teal-700 border-teal-100
                                                @elseif($project['status'] === 'completed')
                                                @else @endif">
                                                @if($project['status'] === 'ongoing') {{ __('app.status_ongoing') }}
                                                @elseif($project['status'] === 'completed') {{ __('app.status_completed') }}
                                                @else {{ __('app.status_pending') }} @endif
                                            </span>
                                            <span class="text-sm font-bold text-[#2f5c69] bg-[#2f5c69]/5 px-3 py-1 rounded-lg">
                                                {{ $project['budget'] }} {{ __('app.currency') }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-10">
                                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-clipboard-list text-3xl text-gray-300"></i>
                                </div>
                                <p class="text-gray-500 font-medium">{{ __('app.no_recent_projects') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-8">
                
               

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-[#2f5c69] flex items-center gap-2">
                            <i class="fas fa-user-friends text-[#f3a446]"></i>
                            {{ __('app.team_status') }}
                        </h3>
                        <span class="text-xs font-bold bg-[#2f5c69] text-white px-2 py-1 rounded-md">{{ count($teamStatus) }}</span>
                    </div>
                    <div class="p-6">
                        @if(count($teamStatus) > 0)
                            <div class="space-y-4">
                                @foreach($teamStatus as $member)
                                    <div class="flex items-center justify-between group">
                                        <div class="flex items-center gap-3">
                                            <div class="relative">
                                                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center border-2 border-white shadow-sm">
                                                    <i class="fas fa-user text-gray-400"></i>
                                                </div>
                                                <div class="absolute bottom-0 right-0 w-3 h-3 rounded-full border-2 border-white
                                                    @if($member['status'] === 'available') bg-green-500
                                                    @else @endif"></div>
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-gray-800">{{ $member['name'] }}</p>
                                                <p class="text-xs text-gray-500">{{ $member['role'] }}</p>
                                            </div>
                                        </div>
                                        <span class="text-[10px] font-bold px-2 py-1 rounded-md
                                            @if($member['status'] === 'available') bg-green-50 text-green-600
                                            @else @endif">
                                            @if($member['status'] === 'available') {{ __('app.status_available') }}
                                            @else {{ __('app.status_busy') }} @endif
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-6">
                                <p class="text-gray-400 text-sm">{{ __('app.no_available_members') }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 text-center">
                         <!-- <a href="{{ route('contractor.team') }}" class="text-xs font-bold text-[#2f5c69] hover:text-[#f3a446] transition-colors">{{ __('app.manage_full_team') }}</a> -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection