@extends('layouts.app')

@section('title', __('app.my_tenders') . ' - insha\'at')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 mt-16">
    
    <div class="bg-white shadow-sm border-b border-gray-100 mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center py-8 gap-4">
                <div class="text-center md:text-right md:rtl:text-right md:ltr:text-left w-full md:w-auto">
                    <h1 class="text-3xl font-bold text-[#2f5c69] flex items-center justify-center md:justify-start">
                        <i class="fas fa-gavel mx-2 text-[#f3a446]"></i>
                        {{ __('app.my_tenders') }}
                    </h1>
                    <p class="text-gray-500 mt-2 text-sm">{{ __('app.manage_tenders_desc') }}</p>
                </div>
                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3 sm:space-x-reverse w-full md:w-auto">
                   
                    <a href="{{ route('client.dashboard') }}" 
                       class="inline-flex justify-center items-center px-6 py-3 rounded-xl border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 hover:text-[#2f5c69] transition-all duration-200">
                        <i class="fas fa-arrow-right mx-2 rtl:rotate-180"></i>
                        {{ __('app.back_to_dashboard') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        @if ($tenders->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8">
                @foreach ($tenders as $tender)
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col h-full group">
                        <div class="p-6 flex-grow">
                            <div class="flex items-start justify-between mb-6">
                                <h3 class="text-lg font-bold text-[#2f5c69] line-clamp-2 group-hover:text-[#f3a446] transition-colors">
                                    {{ $tender->title }}
                                </h3>
                                <span class="flex-shrink-0 px-3 py-1 text-xs font-bold rounded-full border
                                    @if ($tender->status === 'active') bg-green-50 text-green-700 border-green-200
                                    @elseif($tender->status === 'closed')
                                    @elseif($tender->status === 'awarded')
                                    @else @endif">
                                    @if ($tender->status === 'active') {{ __('app.status_active') }}
                                    @elseif($tender->status === 'closed') {{ __('app.status_closed') }}
                                    @elseif($tender->status === 'awarded') {{ __('app.status_awarded') }}
                                    @else {{ $tender->status }} @endif
                                </span>
                            </div>

                            <div class="space-y-3 mb-6">
                                <div class="flex items-center text-sm text-gray-600">
                                    <div class="w-8 flex justify-center"><i class="fas fa-map-marker-alt text-[#f3a446]"></i></div>
                                    <span class="mx-2">{{ $tender->location }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <div class="w-8 flex justify-center"><i class="fas fa-calendar-alt text-[#f3a446]"></i></div>
                                    <span class="mx-2">{{ $tender->created_at->format('Y-m-d') }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <div class="w-8 flex justify-center"><i class="fas fa-coins text-[#f3a446]"></i></div>
                                    <span class="mx-2">{{ $tender->formatted_budget }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <div class="w-8 flex justify-center"><i class="fas fa-file-contract text-[#f3a446]"></i></div>
                                    <span class="mx-2">{{ $tender->proposals->count() }} {{ __('app.proposals_count') }}</span>
                                </div>
                            </div>

                            @if ($tender->proposals->count() > 0)
                                <div class="bg-gray-50 rounded-xl p-4 mb-2 border border-gray-100">
                                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">{{ __('app.latest_proposals') }}</h4>
                                    <div class="space-y-3">
                                        @foreach ($tender->proposals->take(2) as $proposal)
                                            <div class="flex items-center justify-between text-sm">
                                                <div class="flex items-center">
                                                    <div class="w-6 h-6 bg-[#2f5c69]/10 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-user text-[#2f5c69] text-[10px]"></i>
                                                    </div>
                                                    <span class="text-gray-700 mx-2 font-medium">{{ $proposal->consultant->name ?? __('app.consultant_unspecified') }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <span class="text-[#2f5c69] font-bold text-xs mx-2">{{ $proposal->formatted_price }}</span>
                                                    <span class="w-2 h-2 rounded-full
                                                        @if ($proposal->status === 'pending') bg-yellow-400
                                                        @elseif($proposal->status === 'accepted')
                                                        @elseif($proposal->status === 'rejected')
                                                        @else @endif"
                                                        title="{{ __('app.status_' . $proposal->status) }}">
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if ($tender->proposals->count() > 2)
                                            <p class="text-xs text-center text-gray-400 font-medium pt-1">
                                                {{ __('app.other_proposals_count', ['count' => $tender->proposals->count() - 2]) }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="p-4 bg-gray-50 border-t border-gray-100 flex gap-3">
                            <a href="{{ route('tenders.show', $tender->id) }}"
                               class="flex-1 inline-flex justify-center items-center px-4 py-2 rounded-lg bg-[#2f5c69] text-white text-sm font-bold hover:bg-[#244852] transition-colors">
                                <i class="fas fa-eye mx-2"></i>
                                {{ __('app.view_details') }}
                            </a>
                            @if ($tender->proposals->count() > 0)
                                <a href="{{ route('tenders.compare-proposals', $tender->id) }}"
                                   class="flex-1 inline-flex justify-center items-center px-4 py-2 rounded-lg border border-[#2f5c69] text-[#2f5c69] text-sm font-bold hover:bg-[#2f5c69] hover:text-white transition-colors">
                                    <i class="fas fa-balance-scale mx-2"></i>
                                    {{ __('app.compare_proposals') }}
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $tenders->links() }}
            </div>
        @else
            <div class="text-center py-16 bg-white rounded-3xl shadow-sm border border-gray-100">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-folder-open text-3xl text-gray-300"></i>
                </div>
                <h3 class="text-xl font-bold text-[#2f5c69] mb-2">{{ __('app.no_tenders') }}</h3>
                <p class="text-gray-500 mb-8">{{ __('app.no_tenders_hint') }}</p>
               
            </div>
        @endif
    </div>
</div>
@endsection