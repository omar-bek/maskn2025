@extends('layouts.app')

@section('title', __('app.consultant_dashboard.title'))

@section('content')

<style>
    .btn-primary {
        @apply inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-bold rounded-md text-[#1a262a] bg-[#f3a446] hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#f3a446] transition-all duration-300 transform hover:scale-105 shadow;
    }

    .btn-secondary {
        @apply  inline-flex items-center justify-center px-4 py-2 border border-[#f3a446] text-sm font-bold rounded-md  bg-transparent hover:bg-[#f3a446]/10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#f3a446] focus:ring-offset-[#dfeaee] transition-all duration-300 transform hover:scale-105;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animated-card {
        opacity: 0;
        animation: fadeInUp 0.6s ease-out forwards;
    }
</style>

<div class="min-h-screen bg-gray-100">
    <div class="bg-gradient-to-r from-[#1a262a] to-[#2f5c69] shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ __('app.consultant_dashboard.header.welcome', ['name' => Auth::user()->name]) }}</h1>
                    <p class="text-gray-300 mt-1">{{ __('app.consultant_dashboard.header.subtitle') }}</p>
                </div>
                <div class="flex space-x-3 space-x-reverse">
                    <a href="{{ route('consultant.portfolio') }}" class="btn-primary">
                        <i class="fas fa-images ml-2"></i>
                        {{ __('app.consultant_dashboard.header.portfolio_button') }}
                    </a>
                    <a href="{{ route('consultant.profile') }}" class="btn-primary">
                        <i class="fas fa-user ml-2"></i>
                        {{ __('app.consultant_dashboard.header.profile_button') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl hover:translate-y-[-2px] transition-all duration-300 animated-card" style="animation-delay: 0.1s;">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-r from-[#f3a446] to-[#ffb35f] rounded-lg flex items-center justify-center shadow-md mr-2">
                            <i class="fas fa-home text-white text-lg"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">{{ __('app.consultant_dashboard.stats.designs_created') }}</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['designs_created'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl hover:translate-y-[-2px] transition-all duration-300 animated-card" style="animation-delay: 0.2s;">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-r from-[#2f5c69] to-[#1a262a] rounded-lg flex items-center justify-center shadow-md mr-2">
                            <i class="fas fa-check-circle text-white text-lg"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">{{ __('app.consultant_dashboard.stats.accepted_proposals') }}</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['accepted_proposals'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl hover:translate-y-[-2px] transition-all duration-300 animated-card" style="animation-delay: 0.3s;">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-r from-[#f3a446] to-[#ffb35f] rounded-lg flex items-center justify-center shadow-md mr-2">
                            <i class="fas fa-money-bill-wave text-white text-lg"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">{{ __('app.consultant_dashboard.stats.monthly_earnings') }}</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['monthly_earnings'] ?? 0) }} {{ __('app.consultant_dashboard.stats.currency') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl hover:translate-y-[-2px] transition-all duration-300 animated-card" style="animation-delay: 0.4s;">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-r from-[#2f5c69] to-[#1a262a] rounded-lg flex items-center justify-center shadow-md mr-2">
                            <i class="fas fa-star text-white text-lg"></i>
                        </div>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-600">{{ __('app.consultant_dashboard.stats.average_rating') }}</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['average_rating'] ?? 0 }}/5</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-xl shadow-lg animated-card" style="animation-delay: 0.5s;">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-[#1a262a]">{{ __('app.consultant_dashboard.recent_designs.title') }}</h3>
                    </div>
                    <div class="p-6">
                        @if (isset($recentDesigns) && count($recentDesigns) > 0)
                            <div class="space-y-4">
                                @foreach ($recentDesigns as $design)
                                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <div class="w-12 h-12 bg-[#f3a446]/10 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-home text-[#f3a446]"></i>
                                                </div>
                                            </div>
                                            <div class="mr-4">
                                                <h4 class="text-sm font-medium text-gray-900">{{ $design['title'] }}</h4>
                                                <p class="text-sm text-gray-500">{{ $design['style'] }} - {{ $design['area'] }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3 space-x-reverse">
                                            <span class="text-sm font-bold text-[#1a262a]">{{ $design['price'] }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-home text-4xl text-gray-300 mb-4"></i>
                                <p class="text-gray-500">{{ __('app.consultant_dashboard.recent_designs.no_designs') }}</p>
                                <a href="{{ route('designs.create') }}" class="btn-primary mt-4">
                                    <i class="fas fa-plus ml-2"></i>
                                    {{ __('app.consultant_dashboard.recent_designs.create_design_button') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg animated-card" style="animation-delay: 0.6s;">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-[#1a262a]">{{ __('app.consultant_dashboard.recent_proposals.title') }}</h3>
                    </div>
                    <div class="p-6">
                        @if (isset($recentProposals) && count($recentProposals) > 0)
                            <div class="space-y-4">
                                @foreach ($recentProposals as $proposal)
                                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <div class="w-12 h-12 bg-[#2f5c69]/10 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-file-alt text-[#2f5c69]"></i>
                                                </div>
                                            </div>
                                            <div class="mr-4">
                                                <h4 class="text-sm font-medium text-gray-900">{{ $proposal['tender_title'] }}</h4>
                                                <p class="text-sm text-gray-500">{{ $proposal['date'] }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3 space-x-reverse">
                                            <span class="text-sm font-bold text-[#1a262a]">{{ $proposal['proposed_price'] }}</span>
                                            @if ($proposal['status'] === 'pending')
                                                <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                                    {{ __('app.consultant_dashboard.recent_proposals.status_pending') }}
                                                </span>
                                            @elseif($proposal['status'] === 'accepted')
                                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                                    {{ __('app.consultant_dashboard.recent_proposals.status_accepted') }}
                                                </span>
                                            @elseif($proposal['status'] === 'rejected')
                                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                                                    {{ __('app.consultant_dashboard.recent_proposals.status_rejected') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-file-alt text-4xl text-gray-300 mb-4"></i>
                                <p class="text-gray-500">{{ __('app.consultant_dashboard.recent_proposals.no_proposals') }}</p>
                                <a href="{{ route('tenders.index') }}" class="btn-primary mt-4">
                                    <i class="fas fa-search ml-2"></i>
                                    {{ __('app.consultant_dashboard.recent_proposals.browse_tenders_button') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-8">
                <div class="bg-white rounded-xl shadow-lg animated-card" style="animation-delay: 0.7s;">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-[#1a262a]">{{ __('app.consultant_dashboard.quick_actions.title') }}</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="{{ route('tenders.index') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-[#f3a446]/5 hover:border-[#f3a446]/30 transition-colors">
                                <i class="fas fa-search text-[#f3a446] ml-3 pr-2"></i>
                                <span class="text-sm font-medium text-gray-900">{{ __('app.consultant_dashboard.quick_actions.browse_tenders') }}</span>
                            </a>
                            <a href="{{ route('proposals.index') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-[#2f5c69]/5 hover:border-[#2f5c69]/20 transition-colors">
                                <i class="fas fa-file-alt text-[#2f5c69] ml-3 pr-2"></i>
                                <span class="text-sm font-medium text-gray-900">{{ __('app.consultant_dashboard.quick_actions.my_proposals') }}</span>
                            </a>
                            <a href="{{ route('designs.create') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-[#f3a446]/5 hover:border-[#f3a446]/30 transition-colors">
                                <i class="fas fa-plus text-[#f3a446] ml-3 pr-2"></i>
                                <span class="text-sm font-medium text-gray-900">{{ __('app.consultant_dashboard.quick_actions.create_design') }}</span>
                            </a>
                            <a href="{{ route('designs.index') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-[#2f5c69]/5 hover:border-[#2f5c69]/20 transition-colors">
                                <i class="fas fa-home text-[#2f5c69] ml-3 pr-2"></i>
                                <span class="text-sm font-medium text-gray-900">{{ __('app.consultant_dashboard.quick_actions.my_designs') }}</span>
                            </a>
                            <a href="{{ route('consultant.portfolio') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-[#f3a446]/5 hover:border-[#f3a446]/30 transition-colors">
                                <i class="fas fa-images text-[#f3a446] ml-3 pr-2"></i>
                                <span class="text-sm font-medium text-gray-900">{{ __('app.consultant_dashboard.quick_actions.portfolio') }}</span>
                            </a>
                            <a href="{{ route('consultant.profile') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-[#2f5c69]/5 hover:border-[#2f5c69]/20 transition-colors">
                                <i class="fas fa-user text-[#2f5c69] ml-3 pr-2"></i>
                                <span class="text-sm font-medium text-gray-900">{{ __('app.consultant_dashboard.quick_actions.edit_profile') }}</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg animated-card" style="animation-delay: 0.8s;">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-[#1a262a]">{{ __('app.consultant_dashboard.recent_earnings.title') }}</h3>
                    </div>
                    <div class="p-6">
                        @if (isset($recentEarnings) && count($recentEarnings) > 0)
                            <div class="space-y-4">
                                @foreach ($recentEarnings as $earning)
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-800">{{ $earning['tender'] }}</p>
                                            <p class="text-sm text-gray-500">{{ $earning['date'] }}</p>
                                        </div>
                                        <span class="text-sm font-semibold text-green-600">{{ $earning['amount'] }} {{ __('app.consultant_dashboard.stats.currency') }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <p class="text-gray-500 text-sm">{{ __('app.consultant_dashboard.recent_earnings.no_earnings') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection