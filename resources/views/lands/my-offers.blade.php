@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ __('app.offers_title') }}</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                {{ __('app.offers_desc') }}
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ __('app.quick_links') }}</h2>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('lands.create') }}"
                        class="inline-flex items-center px-5 py-2.5 bg-[#f3a446] text-[#1a262a] rounded-xl font-bold hover:bg-[#f5b05a] transition-all transform hover:scale-105 shadow-lg">
                        <i class="fas fa-plus ml-2 mr-2"></i>
                        {{ __('app.add_new_land') }}
                    </a>
                    <a href="{{ route('lands.my-ads') }}"
                        class="inline-flex items-center px-5 py-2.5 bg-[#2f5c69]/10 text-[#2f5c69] rounded-xl font-medium hover:bg-[#2f5c69]/20 transition-colors">
                        <i class="fas fa-list ml-2 mr-2"></i>
                        {{ __('app.my_ads') }}
                    </a>
                    <a href="{{ route('lands.index') }}"
                        class="inline-flex items-center px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200 transition-colors">
                        <i class="fas fa-search ml-2 mr-2"></i>
                        {{ __('app.browse_lands') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-[#2f5c69]/10 rounded-xl mr-2">
                        <i class="fas fa-handshake text-2xl text-[#2f5c69]"></i>
                    </div>
                    <div class="mr-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $offers->count() }}</h3>
                        <p class="text-gray-600">{{ __('app.total_offers') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-[#f3a446]/10 rounded-xl mr-2">
                        <i class="fas fa-clock text-2xl text-[#f3a446]"></i>
                    </div>
                    <div class="mr-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $offers->where('status', 'معلق')->count() }}</h3>
                        <p class="text-gray-600">{{ __('app.pending') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-xl mr-2">
                        <i class="fas fa-check text-2xl text-green-600"></i>
                    </div>
                    <div class="mr-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $offers->where('status', 'مقبول')->count() }}</h3>
                        <p class="text-gray-600">{{ __('app.accepted') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 rounded-xl mr-2">
                        <i class="fas fa-times text-2xl text-red-600"></i>
                    </div>
                    <div class="mr-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $offers->where('status', 'مرفوض')->count() }}</h3>
                        <p class="text-gray-600">{{ __('app.rejected') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ __('app.offers_title') }}</h2>
                    <div class="flex gap-2">
                        <button
                            class="px-4 py-2 bg-[#f3a446] text-[#1a262a] rounded-xl text-sm font-bold hover:bg-[#f5b05a] transition-colors">
                            {{ __('app.all') }}
                        </button>
                        <button
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl text-sm font-medium hover:bg-gray-200 transition-colors">
                            {{ __('app.pending') }}
                        </button>
                        <button
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl text-sm font-medium hover:bg-gray-200 transition-colors">
                            {{ __('app.accepted') }}
                        </button>
                        <button
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl text-sm font-medium hover:bg-gray-200 transition-colors">
                            {{ __('app.rejected') }}
                        </button>
                    </div>
                </div>

                <a href="{{ route('lands.my-ads') }}"
                    class="bg-[#2f5c69] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#1a262a] transition-all transform hover:scale-105 shadow-lg">
                    <i class="fas fa-list ml-2 mr-2"></i>
                    {{ __('app.view_my_ads') }}
                </a>
            </div>
        </div>

        <div class="space-y-6">
            @foreach($offers as $offer)
                <div
                    class="bg-white rounded-2xl shadow-lg border-2 border-transparent overflow-hidden hover:shadow-xl hover:border-[#f3a446] transition-all duration-300">
                    <div class="p-6">
                        <div class="flex flex-col lg:flex-row gap-6">
                            <div class="lg:w-1/4">
                                <div
                                    class="relative h-48 lg:h-full bg-gradient-to-br from-[#2f5c69] to-[#1a262a] rounded-2xl overflow-hidden">
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <i class="fas fa-map text-6xl text-white opacity-10"></i>
                                    </div>
                                    <div class="absolute top-3 right-3">
                                        <span class="px-3 py-1.5 rounded-full text-xs font-bold
                                            {{ $offer['status'] === 'معلق' ? 'bg-yellow-100 text-yellow-800' :
                                                ($offer['status'] === 'مقبول' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $offer['status'] }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="lg:w-3/4">
                                <div class="flex flex-col lg:flex-row justify-between items-start gap-4 mb-4">
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-900 mb-2 hover:text-[#f3a446] transition-colors">
                                            {{ $offer['land_title'] }}</h3>
                                        <div class="flex items-center gap-4 text-sm text-gray-600">
                                            <span class="flex items-center font-medium">
                                                <i class="fas fa-user text-[#2f5c69] ml-2"></i>
                                                {{ $offer['offerer_name'] }}
                                            </span>
                                            <span class="flex items-center">
                                                <i class="fas fa-calendar text-[#2f5c69] ml-2"></i>
                                                {{ $offer['created_at'] }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="text-right flex-shrink-0">
                                        <div class="text-2xl font-bold text-[#f3a446]">{{ $offer['offer_price'] }}</div>
                                        <div class="text-sm text-gray-500 font-medium">{{ $offer['offer_type'] }}</div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 rounded-xl p-4 mb-5 border border-gray-200">
                                    <p class="text-gray-700">{{ $offer['offer_message'] }}</p>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">
                                    <div class="flex items-center text-sm text-gray-700 font-medium">
                                        <i class="fas fa-phone text-green-500 ml-2"></i>
                                        <span>{{ $offer['offerer_phone'] }}</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-700 font-medium">
                                        <i class="fas fa-envelope text-blue-500 ml-2"></i>
                                        <span>{{ $offer['offerer_email'] }}</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-700 font-medium">
                                        <i class="fas fa-clock text-purple-500 ml-2"></i>
                                        <span>{{ $offer['created_at'] }}</span>
                                    </div>
                                </div>

                                <div class="flex flex-wrap gap-3">
                                    @if($offer['status'] === 'معلق')
                                        <button
                                            class="bg-green-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-green-700 transition-colors shadow-lg hover:shadow-xl">
                                            <i class="fas fa-check ml-1"></i>
                                            {{ __('app.accept_offer') }}
                                        </button>
                                        <button
                                            class="bg-red-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-red-700 transition-colors shadow-lg hover:shadow-xl">
                                            <i class="fas fa-times ml-1"></i>
                                            {{ __('app.reject_offer') }}
                                        </button>
                                        <button
                                            class="bg-[#2f5c69] text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#1a262a] transition-colors shadow-lg hover:shadow-xl">
                                            <i class="fas fa-comment ml-1"></i>
                                            {{ __('app.reply_offer') }}
                                        </button>
                                    @else
                                        <span class="px-5 py-2.5 rounded-xl text-sm font-bold
                                            {{ $offer['status'] === 'مقبول' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $offer['status'] }}
                                        </span>
                                    @endif

                                    <a href="{{ route('lands.show', $offer['land_id']) }}"
                                        class="bg-gray-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-700 transition-colors shadow-lg hover:shadow-xl">
                                        <i class="fas fa-eye ml-1"></i>
                                        {{ __('app.view_land') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if(count($offers) === 0)
            <div class="text-center py-12">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-12">
                    <i class="fas fa-handshake text-6xl text-gray-300 mb-6"></i>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ __('app.no_offers') }}</h3>
                    <p class="text-gray-600 text-lg mb-8">{{ __('app.no_offers_desc') }}</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('lands.create') }}"
                            class="bg-[#f3a446] text-[#1a262a] px-8 py-3 rounded-xl font-bold text-lg hover:bg-[#f5b05a] transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
                            <i class="fas fa-plus ml-2"></i>
                            {{ __('app.add_new_ad') }}
                        </a>
                        <a href="{{ route('lands.index') }}"
                            class="bg-[#2f5c69] text-white px-8 py-3 rounded-xl font-bold text-lg hover:bg-[#1a262a] transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
                            <i class="fas fa-search ml-2"></i>
                            {{ __('app.browse_lands') }}
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection