@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ __('app.page_title') }}</h1>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-4">
                        <h2 class="text-xl font-bold text-gray-900">{{ __('app.quick_links') }}</h2>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('lands.create') }}"
                            class="inline-flex items-center px-5 py-2.5 bg-[#f3a446] text-[#1a262a] rounded-xl font-bold hover:bg-[#f5b05a] transition-all transform hover:scale-105 shadow-lg">
                            <i class="fas fa-plus mx-2"></i>
                            {{ __('app.add_new_land') }}
                        </a>
                        <a href="{{ route('lands.my-ads') }}"
                            class="inline-flex items-center px-5 py-2.5 bg-[#2f5c69]/10 text-[#2f5c69] rounded-xl font-medium hover:bg-[#2f5c69]/20 transition-colors">
                            <i class="fas fa-list mx-2"></i>
                            {{ __('app.my_ads') }}
                        </a>
                        <a href="{{ route('lands.my-offers') }}"
                            class="inline-flex items-center px-5 py-2.5 bg-[#2f5c69]/10 text-[#2f5c69] rounded-xl font-medium hover:bg-[#2f5c69]/20 transition-colors">
                            <i class="fas fa-handshake mx-2"></i>
                            {{ __('app.submitted_offers') }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 bg-[#2f5c69]/10 rounded-xl">
                            <i class="fas fa-map-marker-alt text-2xl text-[#2f5c69]"></i>
                        </div>
                        <div class="mx-4">
                            <h3 class="text-2xl font-bold text-gray-900">150+</h3>
                            <p class="text-gray-600">{{ __('app.available_lands') }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 bg-[#f3a446]/10 rounded-xl">
                            <i class="fas fa-handshake text-2xl text-[#f3a446]"></i>
                        </div>
                        <div class="mx-4">
                            <h3 class="text-2xl font-bold text-gray-900">89</h3>
                            <p class="text-gray-600">{{ __('app.completed_deals') }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-xl">
                            <i class="fas fa-users text-2xl text-green-600"></i>
                        </div>
                        <div class="mx-4">
                            <h3 class="text-2xl font-bold text-gray-900">2,500+</h3>
                            <p class="text-gray-600">{{ __('app.active_users') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 mb-8">
                <div class="flex items-center mb-6">
                    <i class="fas fa-filter text-2xl text-[#f3a446] mx-3"></i>
                    <h3 class="text-2xl font-bold text-gray-900">{{ __('app.advanced_search') }}</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-800">{{ __('app.city') }}</label>
                        <select
                            class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 appearance-none">
                            <option value="">{{ __('app.all_cities') }}</option>
                            <option value="riyadh">{{ __('app.riyadh') }}</option>
                            <option value="jeddah">{{ __('app.jeddah') }}</option>
                            <option value="dammam">{{ __('app.dammam') }}</option>
                            <option value="makkah">{{ __('app.makkah') }}</option>
                            <option value="medina">{{ __('app.medina') }}</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-800">{{ __('app.land_type') }}</label>
                        <select
                            class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 appearance-none">
                            <option value="">{{ __('app.all_types') }}</option>
                            <option value="residential">{{ __('app.residential') }}</option>
                            <option value="commercial">{{ __('app.commercial') }}</option>
                            <option value="agricultural">{{ __('app.agricultural') }}</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-800">{{ __('app.ad_type') }}</label>
                        <select
                            class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 appearance-none">
                            <option value="">{{ __('app.all') }}</option>
                            <option value="sale">{{ __('app.sale') }}</option>
                            <option value="exchange">{{ __('app.exchange') }}</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-800">{{ __('app.price') }}</label>
                        <select
                            class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 appearance-none">
                            <option value="">{{ __('app.all_prices') }}</option>
                            <option value="0-500000">{{ __('app.price_upto_500k') }}</option>
                            <option value="500000-1000000">{{ __('app.price_500k_1m') }}</option>
                            <option value="1000000+">{{ __('app.price_1m_plus') }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($lands as $land)
                    <div
                        class="group bg-white rounded-2xl shadow-lg border-2 border-transparent overflow-hidden hover:shadow-xl hover:border-[#f3a446] transition-all duration-300 transform hover:-translate-y-1">
                        <div class="relative h-48 overflow-hidden">
                            <div
                                class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#2f5c69] to-[#1a262a] transition-transform duration-500 group-hover:scale-105">
                                <i class="fas fa-map text-6xl text-white opacity-10"></i>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute top-4 right-4 rtl:right-4 ltr:left-auto ltr:right-4">
                                <span
                                    class="px-3 py-1.5 rounded-full text-xs font-bold shadow-lg
                                {{ $land['type'] === 'بيع' ? 'bg-[#f3a446]/20 text-[#f3a446]' : 'bg-[#2f5c69]/20 text-[#2f5c69]' }}">
                                    
                                    {{ $land['type'] === 'بيع' ? __('app.sale') : __('app.exchange') }}
                                </span>
                            </div>
                            <div class="absolute bottom-4 left-4 rtl:left-4 ltr:right-auto ltr:left-4">
                                <p class="text-2xl font-bold text-white shadow-lg">{{ $land['price'] }} {{ __('app.currency') }}</p>
                            </div>
                        </div>

                        <div class="p-6">
                            <h3
                                class="text-2xl font-bold text-gray-900 mb-2 truncate transition-colors duration-300 group-hover:text-[#2f5c69]">
                                {{ $land['title'] }}</h3>
                            <p class="text-gray-600 mb-4 h-12 line-clamp-2">{{ $land['description'] }}</p>

                            <div class="space-y-3 mb-5 pt-4 border-t border-gray-100">
                                <div class="flex items-center text-sm text-gray-700 font-medium">
                                    <i class="fas fa-map-marker-alt text-[#2f5c69] mx-3 w-4 text-center"></i>
                                    <span>{{ $land['location'] }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-700 font-medium">
                                    <i class="fas fa-ruler-combined text-[#2f5c69] mx-3 w-4 text-center"></i>
                                    <span>{{ $land['area'] }}</span>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <a href="{{ route('lands.show', $land['id']) }}"
                                    class="flex-1 bg-[#f3a446] text-[#1a262a] text-center py-3 px-4 rounded-xl font-bold hover:bg-[#f5b05a] transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
                                    {{ __('app.view_details') }}
                                </a>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <button
                    class="bg-transparent text-[#2f5c69] border-2 border-[#2f5c69] px-8 py-3 rounded-xl font-bold hover:bg-[#2f5c69] hover:text-white transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    {{ __('app.load_more') }}
                </button>
            </div>

            <div
                class="mt-16 bg-gradient-to-br from-[#2f5c69] to-[#1a262a] rounded-2xl p-10 text-center text-white shadow-2xl">
                <h2 class="text-3xl font-bold mb-4">{{ __('app.cta_title') }}</h2>
                <p class="text-xl mb-8 opacity-90 max-w-lg mx-auto">{{ __('app.cta_description') }}</p>
                <a href="{{ route('lands.create') }}"
                    class="bg-[#f3a446] text-[#1a262a] px-8 py-4 rounded-xl font-bold text-lg hover:bg-[#f5b05a] transition-all inline-block transform hover:scale-105 shadow-xl">
                    <i class="fas fa-plus mx-2"></i>
                    {{ __('app.add_new_land') }}
                </a>
            </div>
        </div>
    </div>
@endsection