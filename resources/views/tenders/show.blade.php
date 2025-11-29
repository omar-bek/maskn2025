@extends('layouts.app')

@section('title', $tender->title . ' - انشاءات')

@section('content')
@php
    $designImages = $tender->design->images_urls ?? [];
@endphp
   
<section class="hero-section text-white relative bg-gradient-to-br from-[#2f5c69] to-[#1a262a] pt-24 pb-20 md:pt-32 md:pb-28 overflow-hidden"> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10"> <div class="flex flex-col md:flex-row justify-between items-start gap-8 md:gap-12">
<div class="flex-1 w-full animate-fade-in order-2 md:order-1">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 md:mb-8 leading-tight bg-gradient-to-r from-[#f3a446] to-white bg-clip-text text-transparent filter drop-shadow-lg pb-2">
                {{ $tender->title }}
            </h1>

            <div class="flex flex-col sm:flex-row gap-4 sm:gap-8 mb-8">
                <div class="flex items-center text-white/90 group bg-white/5 rounded-xl p-2 pr-4 border border-white/5 hover:bg-white/10 transition-colors">
                    <div class="w-10 h-10 bg-[#f3a446]/10 rounded-lg flex items-center justify-center ml-3 border border-[#f3a446]/20 mr-2">
                        <i class="fas fa-map-marker-alt text-lg text-[#f3a446]"></i>
                    </div>
                    <div>
                        <p class="text-xs text-white/60">{{ __('app.tender.location') }}</p>
                        <p class="text-base font-semibold">{{ $tender->location }}</p>
                    </div>
                </div>

                <div class="flex items-center text-white/90 group bg-white/5 rounded-xl p-2 pr-4 border border-white/5 hover:bg-white/10 transition-colors">
                    <div class="w-10 h-10 bg-[#f3a446]/10 rounded-lg flex items-center justify-center ml-3 border border-[#f3a446]/20 mr-2">
                        <i class="fas fa-user text-lg text-[#f3a446]"></i>
                    </div>
                    <div>
                        <p class="text-xs text-white/60">{{ __('app.tender.client') }}</p>
                        <p class="text-base font-semibold">{{ $tender->client->name }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
                <div class="bg-white/5 backdrop-blur-sm rounded-xl p-3 md:p-4 text-center border border-white/10 hover:border-[#f3a446]/50 hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-1">
                    <i class="fas fa-calendar-alt text-xl md:text-2xl mb-2 text-[#f3a446] opacity-80"></i>
                    <p class="text-xs text-white/60">{{ __('app.tender.deadline') }}</p>
                    <p class="font-semibold text-sm md:text-base">{{ $tender->formatted_deadline }}</p>
                </div>

                <div class="bg-white/5 backdrop-blur-sm rounded-xl p-3 md:p-4 text-center border border-white/10 hover:border-[#f3a446]/50 hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-1">
                    <i class="fas fa-file-alt text-xl md:text-2xl mb-2 text-[#f3a446] opacity-80"></i>
                    <p class="text-xs text-white/60">{{ __('app.tender.proposals_count') }}</p>
                    <p class="font-semibold text-sm md:text-base">{{ $tender->proposals_count }}</p>
                </div>

                @if ($tender->budget)
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl p-3 md:p-4 text-center border border-white/10 hover:border-[#f3a446]/50 hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-1">
                        <i class="fas fa-money-bill-wave text-xl md:text-2xl mb-2 text-[#f3a446] opacity-80"></i>
                        <p class="text-xs text-white/60">{{ __('app.tender.budget') }}</p>
                        <p class="font-semibold text-sm md:text-base">{{ $tender->formatted_budget }}</p>
                    </div>
                @endif

                @if ($tender->days_remaining !== null)
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl p-3 md:p-4 text-center border border-white/10 hover:border-[#f3a446]/50 hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-1">
                        <i class="fas fa-clock text-xl md:text-2xl mb-2 text-[#f3a446] opacity-80"></i>
                        <p class="text-xs text-white/60">{{ __('app.tender.days_remaining') }}</p>
                        <p class="font-semibold text-sm md:text-base">{{ $tender->days_remaining }} {{ __('app.tender.day_unit') }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="flex flex-col gap-4 md:gap-6 animate-slide-in w-full md:w-auto md:max-w-sm flex-shrink-0 order-1 md:order-2">
            
            @if ($tender->status === 'open')
                <div class="relative overflow-hidden bg-gradient-to-r from-[#f3a446]/20 to-[#f3a446]/10 backdrop-blur-md border border-[#f3a446]/30 rounded-2xl p-4 flex items-center justify-between shadow-[0_0_15px_rgba(243,164,70,0.15)] group">
                    <div class="flex items-center gap-3">
                        <span class="relative flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#f3a446] opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-[#f3a446]"></span>
                        </span>
                        <span class="text-lg font-bold text-[#f3a446] tracking-wide">{{ __('app.tender.status_open') }}</span>
                    </div>
                    <i class="fas fa-door-open text-[#f3a446]/40 text-2xl group-hover:scale-110 transition-transform"></i>
                </div>
            @elseif($tender->status === 'closed')
                <div class="relative overflow-hidden bg-gray-600/20 backdrop-blur-md border border-gray-500/30 rounded-2xl p-4 flex items-center justify-between shadow-lg">
                     <div class="flex items-center gap-3">
                        <span class="h-3 w-3 rounded-full bg-gray-400"></span>
                        <span class="text-lg font-bold text-gray-300 tracking-wide">{{ __('app.tender.status_closed') }}</span>
                    </div>
                    <i class="fas fa-lock text-gray-400/40 text-2xl"></i>
                </div>
            @elseif($tender->status === 'awarded')
                <div class="relative overflow-hidden bg-gradient-to-r from-yellow-500/20 to-yellow-600/10 backdrop-blur-md border border-yellow-500/30 rounded-2xl p-4 flex items-center justify-between shadow-[0_0_15px_rgba(234,179,8,0.15)]">
                    <div class="flex items-center gap-3">
                        <span class="h-3 w-3 rounded-full bg-yellow-400 shadow-[0_0_10px_rgba(250,204,21,0.5)]"></span>
                        <span class="text-lg font-bold text-yellow-400 tracking-wide">{{ __('app.tender.status_awarded') }}</span>
                    </div>
                    <i class="fas fa-trophy text-yellow-400/40 text-2xl animate-pulse"></i>
                </div>
            @endif

            <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-2xl p-5 md:p-6 w-full shadow-2xl">
                <div class="flex items-center gap-4 mb-5 border-b border-white/10 pb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-[#f3a446] to-[#d18a3a] rounded-xl flex items-center justify-center shadow-lg transform rotate-3 hover:rotate-0 transition-transform duration-300">
                        <i class="fas fa-user-tie text-white text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-xs text-white/60 font-medium uppercase tracking-wider mb-1">{{ __('app.client.info') }}</p>
                        <p class="text-lg font-bold text-white leading-tight">{{ $tender->client->name }}</p>
                    </div>
                </div>

                <div class="space-y-3 text-sm">
                    @if ($tender->client->phone)
                        <div class="flex items-center text-white/80 bg-black/20 rounded-lg p-3 hover:bg-black/30 transition-colors">
                            <i class="fas fa-phone ml-3 text-[#f3a446]"></i>
                            <span dir="ltr">{{ $tender->client->phone }}</span>
                        </div>
                    @endif

                    @if ($tender->client->city)
                        <div class="flex items-center text-white/80 bg-black/20 rounded-lg p-3 hover:bg-black/30 transition-colors">
                            <i class="fas fa-map-marker-alt ml-3 text-[#f3a446]"></i>
                            <span>{{ $tender->client->city }}</span>
                        </div>
                    @endif
                </div>
            </div>

            @auth
                @if (auth()->user()->isConsultant() && $tender->status === 'open')
                    @if ($userProposal)
                        <a href="{{ route('proposals.edit', $userProposal->id) }}"
                            class="w-full justify-center text-lg py-4 bg-[#f3a446] text-[#1a262a] rounded-xl font-bold flex items-center gap-3 hover:bg-[#ffb459] hover:shadow-[0_0_20px_rgba(243,164,70,0.4)] transition-all duration-300 transform hover:-translate-y-1">
                            <i class="fas fa-edit"></i>
                            {{ __('app.action.edit_proposal') }}
                        </a>
                    @else
                        <a href="{{ route('proposals.create', $tender->id) }}"
                            class="w-full justify-center text-lg py-4 bg-[#f3a446] text-[#1a262a] rounded-xl font-bold flex items-center gap-3 hover:bg-[#ffb459] hover:shadow-[0_0_20px_rgba(243,164,70,0.4)] transition-all duration-300 transform hover:-translate-y-1">
                            <i class="fas fa-paper-plane"></i>
                            {{ __('app.action.submit_proposal') }}
                        </a>
                    @endif
                @endif
            @else
                <a href="{{ route('login') }}"
                    class="w-full justify-center text-lg py-4 bg-[#f3a446] text-[#1a262a] rounded-xl font-bold flex items-center gap-3 hover:bg-[#ffb459] hover:shadow-[0_0_20px_rgba(243,164,70,0.4)] transition-all duration-300 transform hover:-translate-y-1">
                    <i class="fas fa-sign-in-alt"></i>
                    {{ __('app.action.login_to_participate') }}
                </a>
            @endauth
        </div>
    </div>
</div>

<div class="absolute bottom-0 left-0 w-full h-16 md:h-24 overflow-hidden" style="line-height: 0; z-index:2;">
    <svg xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)" viewBox="0 0 1200 120" preserveAspectRatio="none"
        class="absolute block w-full h-full rotate-180">
        <path fill="#ffffff"
            d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z">
        </path>
    </svg>
</div>
</section>


    <!-- Main Content -->
   <main class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8 rtl-grid">

            <div class="lg:w-2/3">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100/50 mb-8 overflow-hidden">
                    <div class="flex overflow-x-auto p-2">
    <button id="tab-overview"
        class="tab-button flex-shrink-0 px-6 py-4 font-bold transition-all duration-300 group flex items-center gap-3 tab-active">
        <i class="fas fa-info-circle text-xl text-[#f3a446]"></i>
        <span class="text-lg text-[#2f5c69]">{{ __('app.overview') }}</span>
    </button>
    <button id="tab-design"
        class="tab-button flex-shrink-0 px-6 py-4 font-bold text-gray-500 hover:text-[#2f5c69] transition-all duration-300 group flex items-center gap-3">
        <i class="fas fa-palette text-xl text-gray-400 group-hover:text-[#2f5c69] transition-all"></i>
        <span class="text-lg">{{ __('app.design') }}</span>
    </button>
    <button id="tab-items"
        class="tab-button flex-shrink-0 px-6 py-4 font-bold text-gray-500 hover:text-[#2f5c69] transition-all duration-300 group flex items-center gap-3">
        <i class="fas fa-list text-xl text-gray-400 group-hover:text-[#2f5c69] transition-all"></i>
        <span class="text-lg">{{ __('app.tender_items') }}</span>
    </button>
    <button id="tab-proposals"
        class="tab-button flex-shrink-0 px-6 py-4 font-bold text-gray-500 hover:text-[#2f5c69] transition-all duration-300 group flex items-center gap-3">
        <i class="fas fa-file-alt text-xl text-gray-400 group-hover:text-[#2f5c69] transition-all"></i>
        <span class="text-lg">{{ __('app.proposals') }}</span>
    </button>
</div>
                </div>

<div id="tab-content" class="animate-fade-in">
    <div id="content-overview" class="tab-content active">
        <div
            class="bg-white shadow-xl border border-gray-100/50 rounded-2xl p-8 mb-8 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
            <div class="flex items-center mb-6">
                <div
                    class="w-16 h-16 bg-[#2f5c69]/10 rounded-2xl flex items-center justify-center ml-4 shadow-lg mr-2">
                    <i class="fas fa-file-alt text-[#2f5c69] text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ __('app.project_description_title') }}</h2>
                    <p class="text-gray-600">{{ __('app.project_description_subtitle') }}</p>
                </div>
            </div>
            <div class="bg-gray-50/50 rounded-xl p-6 border border-gray-200/60">
                <p class="text-gray-700 leading-relaxed text-lg">{{ $tender->description }}</p>
            </div>
        </div>

        @if ($tender->requirements)
            <div
                class="bg-white shadow-xl border border-gray-100/50 rounded-2xl p-8 mb-8 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
                <div class="flex items-center mb-6">
                    <div
                        class="w-16 h-16 bg-[#2f5c69]/10 rounded-2xl flex items-center justify-center ml-4 shadow-lg mr-2">
                        <i class="fas fa-clipboard-check text-[#2f5c69] text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ __('app.requirements_title') }}</h2>
                        <p class="text-gray-600">{{ __('app.requirements_subtitle') }}</p>
                    </div>
                </div>
                <div class="bg-gray-50/50 rounded-xl p-6 border border-gray-200/60">
                    <p class="text-gray-700 leading-relaxed text-lg whitespace-pre-line">
                        {{ $tender->requirements }}</p>
                </div>
            </div>
        @endif

        @if ($tender->client_notes)
            <div
                class="bg-white shadow-xl border-2 border-[#f3a446]/30 rounded-2xl p-8 mb-8 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
                <div class="flex ittender_detailsems-center mb-6">
                    <div
                        class="w-16 h-16 bg-[#f3a446]/10 rounded-2xl flex items-center justify-center ml-4 shadow-lg mr-2">
                        <i class="fas fa-sticky-note text-[#f3a446] text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ __('app.revision_notes_title') }}</h2>
                        <p class="text-gray-600">{{ __('app.revision_notes_subtitle') }}</p>
                    </div>
                </div>
                <div class="bg-[#f3a446]/5 rounded-xl p-6 border border-[#f3a446]/30 relative">
                    <div class="absolute top-4 right-4">
                        <i class="fas fa-exclamation-triangle text-[#f3a446] text-xl"></i>
                    </div>
                    <p class="text-gray-700 leading-relaxed text-lg whitespace-pre-line pr-8">
                        {{ $tender->client_notes }}
                    </p>
                </div>
            </div>
        @endif

        <div
            class="bg-white shadow-xl border border-gray-100/50 rounded-2xl p-8 mb-8 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
            <div class="flex items-center mb-6">
                <div
                    class="w-16 h-16 bg-[#2f5c69]/10 rounded-2xl flex items-center justify-center ml-4 shadow-lg">
                    <i class="fas fa-calendar-alt text-[#2f5c69] text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ __('app.timeline_title') }}</h2>
                    <p class="text-gray-600">{{ __('app.timeline_subtitle') }}</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50/50 rounded-xl p-6 border border-gray-200/60">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-calendar-plus text-[#2f5c69] ml-3"></i>
                        <h3 class="font-semibold text-gray-800">{{ __('app.creation_date') }}</h3>
                    </div>
                    <p class="text-lg font-bold text-[#2f5c69]">
                        {{ $tender->created_at->format('Y-m-d') }}</p>
                </div>
                <div class="bg-red-50 rounded-xl p-6 border border-red-100">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-calendar-times text-red-600 ml-3"></i>
                        <h3 class="font-semibold text-gray-800">{{ __('app.submission_deadline') }}</h3>
                    </div>
                    <p class="text-lg font-bold text-red-600">{{ $tender->formatted_deadline }}</p>
                </div>
            </div>
        </div>
    </div>

    <div id="content-design" class="tab-content hidden">
        <div
            class="bg-white rounded-2xl shadow-xl border border-gray-100/50 p-6 mb-6 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
            <div class="flex items-center mb-6">
                <div
                    class="w-10 h-10 bg-[#2f5c69]/10 rounded-lg flex items-center justify-center ml-3">
                    <i class="fas fa-home text-[#2f5c69]"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-800">{{ __('app.required_design_title') }}</h2>
            </div>

            <div class="flex flex-col md:flex-row gap-6">
                <div class="md:w-1/3">
                    <div class="relative group">
                        <img src="{{ $tender->design->main_image_url }}"
                            alt="{{ $tender->design->title }}"
                            class="w-full h-64 object-cover rounded-xl shadow-md cursor-pointer"
                            onclick="openImageModal('{{ $tender->design->main_image_url }}')">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 rounded-xl flex items-center justify-center">
                            <i
                                class="fas fa-expand text-white text-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                        </div>
                    </div>

                    @if (!empty($designImages) && count($designImages) > 1)
                        <div class="mt-3 flex gap-2 overflow-x-auto pb-2">
                            @foreach ($designImages as $index => $image)
                                <img src="{{ $image }}" alt="{{ __('app.image_alt', ['number' => $index + 1]) }}"
                                    class="w-16 h-16 object-cover rounded-lg cursor-pointer hover:opacity-80 transition-opacity duration-200"
                                    onclick="openImageModal('{{ $image }}')">
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="md:w-2/3">
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ $tender->design->title }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="flex items-center p-3 bg-gray-50/50 rounded-lg border border-gray-200/60">
                            <i class="fas fa-palette text-[#2f5c69] ml-3"></i>
                            <div>
                                <p class="text-sm text-gray-500">{{ __('app.style') }}</p>
                                <p class="font-medium">{{ $tender->design->style }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 bg-gray-50/50 rounded-lg border border-gray-200/60">
                            <i class="fas fa-ruler-combined text-[#2f5c69] ml-3"></i>
                            <div>
                                <p class="text-sm text-gray-500">{{ __('app.area') }}</p>
                                <p class="font-medium">{{ $tender->design->formatted_area }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('designs.show', $tender->design->id) }}"
                            class="inline-flex items-center bg-[#f3a446] text-[#1a262a] px-5 py-3 rounded-xl font-bold hover:bg-[#f5b05a] transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-eye ml-2"></i>
                            {{ __('app.view_full_details') }}
                        </a>

                        @if (!empty($designImages) && count($designImages) > 1)
                            <button onclick="openGalleryModal()"
                                class="inline-flex items-center bg-[#2f5c69] hover:bg-[#1a262a] text-white px-5 py-3 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <i class="fas fa-images ml-2"></i>
                                {{ __('app.image_gallery') }}
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="content-items" class="tab-content hidden">
        @if ($itemsByCategory && $itemsByCategory->count() > 0)
            <div
                class="bg-white rounded-2xl shadow-xl border border-gray-100/50 overflow-hidden mb-6 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
                <div
                    class="flex flex-col md:flex-row justify-between items-start md:items-center p-6 border-b border-gray-200">
                    <div class="flex items-center mb-4 md:mb-0">
                        <div
                            class="w-10 h-10 bg-[#f3a446]/10 rounded-lg flex items-center justify-center ml-3">
                            <i class="fas fa-list text-[#f3a446]"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">{{ __('app.tender_items_title') }}</h2>
                    </div>

                    <div class="flex gap-3">
                        <button onclick="exportItemsToPDF()"
                            class="inline-flex items-center bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm transition-colors shadow-lg transform hover:scale-105">
                            <i class="fas fa-file-pdf ml-2"></i>
                            {{ __('app.export_pdf') }}
                        </button>

                        <button onclick="toggleItemsView()"
                            class="inline-flex items-center bg-[#2f5c69] hover:bg-[#1a262a] text-white px-4 py-2 rounded-lg text-sm transition-colors shadow-lg transform hover:scale-105">
                            <i class="fas fa-th-large ml-2"></i>
                            {{ __('app.toggle_view') }}
                        </button>
                    </div>
                </div>

                <div id="items-container">
                    <div id="items-table-view">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-4 text-right text-sm font-semibold text-gray-700">
                                            {{ __('app.category') }}</th>
                                        <th
                                            class="px-6 py-4 text-right text-sm font-semibold text-gray-700">
                                            {{ __('app.item_name') }}</th>
                                        <th
                                            class="px-6 py-4 text-center text-sm font-semibold text-gray-700">
                                            {{ __('app.quantity') }}</th>
                                        <th
                                            class="px-6 py-4 text-center text-sm font-semibold text-gray-700">
                                            {{ __('app.unit') }}</th>
                                        <th
                                            class="px-6 py-4 text-center text-sm font-semibold text-gray-700">
                                            {{ __('app.unit_price') }}</th>
                                        <th
                                            class="px-6 py-4 text-center text-sm font-semibold text-gray-700">
                                            {{ __('app.total') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($itemsByCategory as $categoryName => $items)
                                        @foreach ($items as $item)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                                    {{ $categoryName }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-900">
                                                    <div>
                                                        <p class="font-medium">{{ $item->item_name }}
                                                        </p>
                                                        @if ($item->notes)
                                                            <p class="text-xs text-gray-500 mt-1">
                                                                {{ $item->notes }}</p>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-center text-sm text-gray-900">
                                                    {{ $item->quantity ?? 'N/A' }}</td>
                                                <td class="px-6 py-4 text-center text-sm text-gray-900">
                                                    {{ $item->unit ?? '-' }}</td>
                                                <td class="px-6 py-4 text-center text-sm text-gray-900">
                                                    {{ $item->unit_price ?? 'N/A' }}</td>
                                                <td
                                                    class="px-6 py-4 text-center text-sm font-semibold text-green-600">
                                                    {{ $item->total_price ?? 'N/A' }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="items-card-view" class="hidden p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($itemsByCategory as $categoryName => $items)
                                @foreach ($items as $item)
                                    <div
                                        class="border border-gray-200 rounded-lg p-4 hover:border-[#f3a446]/50 transition-colors shadow-sm hover:shadow-md">
                                        <div class="flex justify-between items-start mb-2">
                                            <span
                                                class="text-xs font-medium bg-[#2f5c69]/10 text-[#2f5c69] px-2 py-1 rounded-full">{{ $categoryName }}</span>
                                            <span
                                                class="text-lg font-bold text-green-600">{{ $item->total_price ?? 'N/A' }}</span>
                                        </div>
                                        <h3 class="font-semibold text-gray-800 mb-2">
                                            {{ $item->item_name }}</h3>
                                        <div class="flex justify-between text-sm text-gray-600">
                                            <span>{{ __('app.quantity_label', ['value' => $item->quantity ?? 'N/A']) }}</span>
                                            <span>{{ __('app.unit_label', ['value' => $item->unit ?? '-']) }}</span>
                                            <span>{{ __('app.unit_price_label', ['value' => $item->unit_price ?? 'N/A']) }}</span>
                                        </div>
                                        @if ($item->notes)
                                            <p class="text-xs text-gray-500 mt-2">{{ $item->notes }}
                                            </p>
                                        @endif
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div
                class="bg-white rounded-2xl shadow-xl border border-gray-100/50 p-8 text-center transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
                <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700 mb-2">{{ __('app.no_items_title') }}</h3>
                <p class="text-gray-500">{{ __('app.no_items_subtitle') }}</p>
            </div>
        @endif
    </div>

    <div id="content-proposals" class="tab-content hidden">
        @auth
            @if (auth()->user()->isClient() && auth()->id() == $tender->client_id)
                @if ($tender->proposals->count() > 0)
                    <div
                        class="bg-white rounded-2xl shadow-xl border border-gray-100/50 overflow-hidden mb-6">
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div
                                        class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center ml-3">
                                        <i class="fas fa-file-alt text-green-600"></i>
                                    </div>
                                    <h2 class="text-xl font-bold text-gray-800">{{ __('app.proposals_submitted_title') }}</h2>
                                </div>
                                <span
                                    class="bg-[#2f5c69]/10 text-[#2f5c69] text-sm font-bold px-3 py-1 rounded-full">
                                    {{ __('app.proposals_count', ['count' => $tender->proposals_count]) }}
                                </span>
                            </div>
                        </div>

                        <div class="divide-y divide-gray-200">
                            @foreach ($tender->proposals as $proposal)
                                <div class="p-6 hover:bg-gray-50 transition-colors">
                                    <div
                                        class="flex flex-col md:flex-row md:items-center justify-between mb-4">
                                        <div class="flex items-center mb-3 md:mb-0">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-r from-[#2f5c69] to-[#1a262a] rounded-full flex items-center justify-center text-white font-bold ml-3 shadow-md">
                                                {{ substr($proposal->consultant->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-gray-800">
                                                    {{ $proposal->consultant->name }}</h3>
                                                <p class="text-sm text-gray-500">
                                                    {{ $proposal->created_at->format('Y-m-d H:i') }}</p>
                                            </div>
                                        </div>

                                        <div class="flex items-center space-x-4 space-x-reverse">
                                            <span
                                                class="text-xl font-bold text-green-600">{{ $proposal->formatted_price }}</span>

                                            @if ($proposal->status === 'pending')
                                                <span
                                                    class="px-3 py-1 text-sm font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                                    {{ __('app.pending') }}
                                                </span>
                                            @elseif($proposal->status === 'accepted')
                                                <span
                                                    class="px-3 py-1 text-sm font-medium bg-green-100 text-green-800 rounded-full">
                                                    {{ __('app.accepted') }}
                                                </span>
                                            @elseif($proposal->status === 'rejected')
                                                <span
                                                    class="px-3 py-1 text-sm font-medium bg-red-100 text-red-800 rounded-full">
                                                    {{ __('app.rejected') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <p class="text-gray-700 mb-4 line-clamp-2">
                                        {{ Str::limit($proposal->proposal_text, 150) }}</p>

                                    <div class="flex flex-wrap gap-3">
                                        <a href="{{ route('proposals.client-view', $proposal->id) }}"
                                            class="inline-flex items-center bg-[#2f5c69] hover:bg-[#1a262a] text-white px-4 py-2 rounded-lg text-sm transition-colors shadow-lg transform hover:scale-105">
                                            <i class="fas fa-eye ml-2"></i>
                                            {{ __('app.view_details') }}
                                        </a>

                                        @if ($tender->status === 'open')
                                            <form
                                                action="{{ route('proposals.accept', $proposal->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm transition-colors shadow-lg transform hover:scale-105"
                                                    onclick="return confirm('{{ __('app.accept_confirm') }}')">
                                                    <i class="fas fa-check ml-2"></i>
                                                    {{ __('app.accept_proposal') }}
                                                </button>
                                            </form>

                                            <form
                                                action="{{ route('proposals.reject', $proposal->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm transition-colors shadow-lg transform hover:scale-105"
                                                    onclick="return confirm('{{ __('app.reject_confirm') }}')">
                                                    <i class="fas fa-times ml-2"></i>
                                                    {{ __('app.reject_proposal') }}
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div
                        class="bg-white rounded-2xl shadow-xl border border-gray-100/50 p-8 text-center transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
                        <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-700 mb-2">{{ __('app.no_proposals_title') }}</h3>
                        <p class="text-gray-500">{{ __('app.no_proposals_subtitle') }}</p>
                    </div>
                @endif
            @elseif(auth()->user()->isConsultant())
                <div
                    class="bg-white rounded-2xl shadow-xl border border-gray-100/50 p-6 mb-6 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-10 h-10 bg-[#f3a446]/10 rounded-lg flex items-center justify-center ml-3">
                            <i class="fas fa-file-contract text-[#f3a446]"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">{{ __('app.your_proposal_title') }}</h2>
                    </div>

                    @if ($userProposal)
                        <div
                            class="bg-[#2f5c69]/5 border border-[#2f5c69]/20 rounded-lg p-6 mb-6 shadow-inner">
                            <div
                                class="flex flex-col md:flex-row md:items-center justify-between mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">{{ __('app.your_submitted_proposal') }}</h3>
                                    <p class="text-sm text-gray-600">{{ __('app.submitted_at') }}
                                        {{ $userProposal->created_at->format('Y-m-d H:i') }}</p>
                                </div>

                                <div
                                    class="flex items-center space-x-4 space-x-reverse mt-3 md:mt-0">
                                    <span
                                        class="text-xl font-bold text-green-600">{{ $userProposal->formatted_price }}</span>

                                    @if ($userProposal->status === 'pending')
                                        <span
                                            class="px-3 py-1 text-sm font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                            {{ __('app.pending') }}
                                        </span>
                                    @elseif($userProposal->status === 'accepted')
                                        <span
                                            class="px-3 py-1 text-sm font-medium bg-green-100 text-green-800 rounded-full">
                                            {{ __('app.accepted') }}
                                        </span>
                                    @elseif($userProposal->status === 'rejected')
                                        <span
                                            class="px-3 py-1 text-sm font-medium bg-red-100 text-red-800 rounded-full">
                                            {{ __('app.rejected') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <p class="text-gray-700 mb-4">
                                {{ Str::limit($userProposal->proposal_text, 200) }}</p>

                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('proposals.show', $userProposal->id) }}"
                                    class="inline-flex items-center bg-[#2f5c69] hover:bg-[#1a262a] text-white px-4 py-2 rounded-lg text-sm transition-colors shadow-lg transform hover:scale-105">
                                    <i class="fas fa-eye ml-2"></i>
                                    {{ __('app.view_details') }}
                                </a>

                                @if ($tender->status === 'open')
                                    <a href="{{ route('proposals.edit', $userProposal->id) }}"
                                        class="inline-flex items-center bg-[#f3a446] hover:bg-[#f5b05a] text-[#1a262a] px-4 py-2 rounded-lg text-sm font-bold transition-colors shadow-lg transform hover:scale-105">
                                        <i class="fas fa-edit ml-2"></i>
                                        {{ __('app.edit_proposal') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    @else
                        <div
                            class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
                            <i class="fas fa-exclamation-triangle text-yellow-500 text-2xl mb-3"></i>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ __('app.no_proposal_yet_title') }}
                            </h3>
                            <p class="text-gray-600 mb-4">{{ __('app.no_proposal_yet_subtitle') }}
                            </p>

                            @if ($tender->status === 'open')
                                <a href="{{ route('proposals.create', $tender->id) }}"
                                    class="inline-flex items-center bg-[#f3a446] hover:bg-[#f5b05a] text-[#1a262a] px-5 py-3 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                    <i class="fas fa-paper-plane ml-2"></i>
                                    {{ __('app.submit_proposal_now') }}
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            @endif
        @else
            <div
                class="bg-white rounded-2xl shadow-xl border border-gray-100/50 p-8 text-center transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
                <i class="fas fa-lock text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700 mb-2">{{ __('app.login_required_title') }}</h3>
                <p class="text-gray-500 mb-4">{{ __('app.login_required_subtitle') }}</p>
                <a href="{{ route('login') }}"
                    class="inline-flex items-center bg-[#f3a446] hover:bg-[#f5b05a] text-[#1a262a] px-5 py-2 rounded-lg font-bold transition-colors shadow-lg transform hover:scale-105">
                    <i class="fas fa-sign-in-alt ml-2"></i>
                    {{ __('app.login.login_button') }}
                </a>
            </div>
        @endauth
    </div>
</div>
            </div>

            <div class="lg:w-1/3">
<div class="lg:sticky top-28 space-y-8">
    <div
        class="sidebar-card bg-white shadow-xl border border-gray-100/50 rounded-2xl p-8 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
        <div class="flex items-center mb-6">
            <div
                class="w-12 h-12 bg-[#2f5c69]/10 rounded-xl flex items-center justify-center ml-4 mr-2">
                <i class="fas fa-info-circle text-[#2f5c69] text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">{{ __('app.tender_details') }}</h2>
        </div>

        <div class="space-y-4">
            <div
                class="info-item bg-gray-50/50 border-gray-200/60 rounded-xl p-4 flex items-center">
                <div
                    class="info-item-icon w-10 h-10 rounded-lg flex-shrink-0 flex items-center justify-center bg-[#2f5c69] text-white ml-3 mr-2">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-600 font-medium">{{ __('app.submission_deadline') }}</p>
                    <p class="text-lg font-bold text-[#2f5c69]">{{ $tender->formatted_deadline }}</p>
                </div>
            </div>

            @if ($tender->budget)
                <div
                    class="info-item bg-green-50 border-green-100 rounded-xl p-4 flex items-center">
                    <div
                        class="info-item-icon w-10 h-10 rounded-lg flex-shrink-0 flex items-center justify-center bg-green-500 text-white ml-3 mr-2">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-600 font-medium">{{ __('app.expected_budget') }}</p>
                        <p class="text-lg font-bold text-green-600">{{ $tender->formatted_budget }}
                        </p>
                    </div>
                </div>
            @endif

            <div
                class="info-item bg-[#f3a446]/5 border-[#f3a446]/20 rounded-xl p-4 flex items-center">
                <div
                    class="info-item-icon w-10 h-10 rounded-lg flex-shrink-0 flex items-center justify-center bg-[#f3a446] text-white ml-3 mr-2">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-600 font-medium">{{ __('app.proposals_submitted_count') }}</p>
                    <p class="text-lg font-bold text-[#f3a446]">{{ __('app.proposals_count', ['count' => $tender->proposals_count]) }}
                    </p>
                </div>
            </div>

            @if ($tender->days_remaining !== null)
                <div class="info-item bg-red-50 border-red-100 rounded-xl p-4 flex items-center">
                    <div
                        class="info-item-icon w-10 h-10 rounded-lg flex-shrink-0 flex items-center justify-center bg-red-500 text-white ml-3 mr-2">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-600 font-medium">{{ __('app.days_remaining') }}</p>
                        <p class="text-lg font-bold text-red-600">{{ __('app.days_remaining_count', ['count' => $tender->days_remaining]) }}
                        </p>
                    </div>
                </div>

                <div class="mt-4 p-4 bg-gray-50/50 rounded-xl border border-gray-200/60">
                    <div class="flex justify-between text-sm text-gray-600 mb-3">
                        <span class="font-medium">{{ __('app.time_remaining') }}</span>
                        <span class="font-bold">{{ __('app.days_remaining_count', ['count' => $tender->days_remaining]) }}</span>
                    </div>
                    <div class="progress-bar bg-gray-200 rounded-full h-2.5">
                        <div class="progress-fill bg-gradient-to-r from-orange-500 to-red-500 h-2.5 rounded-full"
                            style="width: {{ min(100, max(5, 100 - ($tender->days_remaining / 30) * 100)) }}%">
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2 text-center">{{ __('app.elapsed_time_percentage') }}</p>
                </div>
            @endif

            <div
                class="info-item bg-gray-50/50 border-gray-200/60 rounded-xl p-4 flex items-center">
                <div
                    class="info-item-icon w-10 h-10 rounded-lg flex-shrink-0 flex items-center justify-center bg-gray-500 text-white ml-3 mr-2">
                    <i class="fas fa-calendar-plus"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-600 font-medium">{{ __('app.tender_creation_date') }}</p>
                    <p class="text-lg font-bold text-gray-600">
                        {{ $tender->created_at->format('Y-m-d') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div
        class="sidebar-card bg-white shadow-xl border border-gray-100/50 rounded-2xl p-8 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
        <div class="flex items-center mb-6">
            <div
                class="w-12 h-12 bg-[#2f5c69]/10 rounded-xl flex items-center justify-center ml-4 mr-2">
                <i class="fas fa-user text-[#2f5c69] text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">{{ __('app.client_information') }}</h2>
        </div>

        <div class="space-y-4">
            <div
                class="info-item bg-gray-50/50 border-gray-200/60 rounded-xl p-4 flex items-center">
                <div
                    class="info-item-icon w-10 h-10 rounded-lg flex-shrink-0 flex items-center justify-center bg-[#2f5c69] text-white ml-3 mr-2">
                    <i class="fas fa-user"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-600 font-medium">{{ __('app.client_name') }}</p>
                    <p class="text-lg font-bold text-[#2f5c69]">{{ $tender->client->name }}</p>
                </div>
            </div>

            @if ($tender->client->phone)
                <div
                    class="info-item bg-green-50 border-green-100 rounded-xl p-4 flex items-center">
                    <div
                        class="info-item-icon w-10 h-10 rounded-lg flex-shrink-0 flex items-center justify-center bg-green-500 text-white ml-3 mr-2">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-600 font-medium">{{ __('app.phone_number') }}</p>
                        <p class="text-lg font-bold text-green-600">{{ $tender->client->phone }}</p>
                    </div>
                </div>
            @endif

            @if ($tender->client->city)
                <div
                    class="info-item bg-blue-50 border-blue-100 rounded-xl p-4 flex items-center">
                    <div
                        class="info-item-icon w-10 h-10 rounded-lg flex-shrink-0 flex items-center justify-center bg-blue-500 text-white ml-3 mr-2">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-600 font-medium">{{ __('app.city') }}</p>
                        <p class="text-lg font-bold text-blue-600">{{ $tender->client->city }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div
        class="sidebar-card bg-white shadow-xl border border-gray-100/50 rounded-2xl p-8 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
        <div class="flex items-center mb-6">
            <div
                class="w-12 h-12 bg-[#f3a446]/10 rounded-xl flex items-center justify-center ml-4 mr-2">
                <i class="fas fa-bolt text-[#f3a446] text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">{{ __('app.quick_actions') }}</h2>
        </div>

        <div class="space-y-4">
            @auth
                @if (auth()->user()->isConsultant() && $tender->status === 'open')
                    @if ($userProposal)
                        <a href="{{ route('proposals.edit', $userProposal->id) }}"
                            class="w-full flex items-center justify-center bg-[#f3a446] hover:bg-[#f5b05a] text-[#1a262a] px-6 py-4 rounded-xl font-bold transition-all duration-300 hover:scale-105 shadow-lg mr-2">
                            <i class="fas fa-edit ml-3 text-lg mr-2"></i>
                            {{ __('app.edit_proposal') }}
                        </a>
                        <a href="{{ route('proposals.show', $userProposal->id) }}"
                            class="w-full flex items-center justify-center bg-[#2f5c69] hover:bg-[#1a262a] text-white px-6 py-4 rounded-xl font-bold transition-all duration-300 hover:scale-105 shadow-lg mr-2">
                            <i class="fas fa-eye ml-3 text-lg mr-2"></i>
                            {{ __('app.view_my_proposal_details') }}
                        </a>
                    @else
                        <a href="{{ route('proposals.create', $tender->id) }}"
                            class="w-full flex items-center justify-center bg-[#f3a446] hover:bg-[#f5b05a] text-[#1a262a] px-6 py-4 rounded-xl font-bold transition-all duration-300 hover:scale-105 shadow-lg mr-2">
                            <i class="fas fa-paper-plane ml-3 text-lg mr-2"></i>
                            {{ __('app.submit_proposal_now') }}
                        </a>
                    @endif
                @endif

                @if (auth()->user()->isClient() && auth()->id() == $tender->client_id)
                    <a href="{{ route('tenders.edit', $tender->id) }}"
                        class="w-full flex items-center justify-center bg-[#f3a446] hover:bg-[#f5b05a] text-[#1a262a] px-6 py-4 rounded-xl font-bold transition-all duration-300 hover:scale-105 shadow-lg mr-2">
                        <i class="fas fa-edit ml-3 text-lg mr-2"></i>
                        {{ __('app.edit_tender') }}
                    </a>

                    @if ($tender->proposals->count() > 0)
                        <a href="{{ route('tenders.compare-proposals', $tender->id) }}"
                            class="w-full flex items-center justify-center bg-[#2f5c69] hover:bg-[#1a262a] text-white px-6 py-4 rounded-xl font-bold transition-all duration-300 hover:scale-105 shadow-lg mr-2">
                            <i class="fas fa-chart-bar ml-3 text-lg mr-2"></i>
                            {{ __('app.compare_proposals') }}
                        </a>
                    @endif

                    @if ($tender->status === 'open')
                        <form action="{{ route('tenders.close', $tender->id) }}" method="POST"
                            class="w-full">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center bg-red-600 hover:bg-red-700 text-white px-6 py-4 rounded-xl font-bold transition-all duration-300 hover:scale-105 shadow-lg"
                                onclick="return confirm('{{ __('app.close_tender_confirm') }}')">
                                <i class="fas fa-lock ml-3 text-lg mr-2"></i>
                                {{ __('app.close_tender') }}
                            </button>
                        </form>
                    @endif
                @endif
            @else
                <a href="{{ route('login') }}"
                    class="w-full flex items-center justify-center bg-[#f3a446] hover:bg-[#f5b05a] text-[#1a262a] px-6 py-4 rounded-xl font-bold transition-all duration-300 hover:scale-105 shadow-lg mr-2">
                    <i class="fas fa-sign-in-alt ml-3 text-lg mr-2"></i>
                    {{ __('app.login_to_participate') }}
                </a>
            @endauth

            <button onclick="shareTender()"
                class="w-full flex items-center justify-center bg-gray-600 hover:bg-gray-700 text-white px-6 py-4 rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg">
                <i class="fas fa-share-alt ml-3 text-lg"></i>
                {{ __('app.share_tender') }}
            </button>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</main>

<style>
    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .animate-zoom-in {
        animation: zoomIn 0.2s ease-out forwards;
    }

    .gallery-thumbnail.active {
        border-color: #f3a446;
        opacity: 1;
        transform: scale(1.05);
    }
</style>

<div id="imageModal"
    class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden items-center justify-center p-4 transition-opacity duration-300"
    onclick="closeImageModal()">
    <div class="relative max-w-4xl max-h-[90vh] animate-zoom-in" onclick="event.stopPropagation()">
        <button onclick="closeImageModal()"
            class="absolute -top-3 -right-3 w-10 h-10 rounded-full bg-gradient-to-br from-[#f3a446] to-[#d18a3a] text-[#1a262a] text-lg z-10 flex items-center justify-center shadow-lg transform hover:scale-110 transition-all duration-300">
            <i class="fas fa-times"></i>
        </button>
        <img id="modalImage" src="" alt="عرض مكبر للصورة"
            class="max-w-full max-h-[90vh] object-contain rounded-2xl shadow-2xl">
    </div>
</div>

<div id="galleryModal"
    class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden items-center justify-center p-4 transition-opacity duration-300"
    onclick="closeGalleryModal()">
    <div class="relative max-w-6xl max-h-[90vh] w-full bg-gradient-to-br from-[#2f5c69] to-[#1a262a] rounded-2xl shadow-2xl p-6 border border-[#f3a446]/20 animate-zoom-in"
        onclick="event.stopPropagation()">

        <button onclick="closeGalleryModal()"
            class="absolute -top-4 -right-4 w-12 h-12 rounded-full bg-gradient-to-br from-[#f3a446] to-[#d18a3a] text-[#1a262a] text-xl z-10 flex items-center justify-center shadow-lg transform hover:scale-110 transition-all duration-300">
            <i class="fas fa-times"></i>
        </button>

        <div class="flex flex-col h-full">
            <div class="flex-1 flex items-center justify-center mb-4 bg-black/30 rounded-lg" style="min-height: 60vh;">
                <img id="galleryMainImage" src="" alt="صورة المعرض الرئيسية"
                    class="max-w-full max-h-[60vh] object-contain rounded-lg transition-all duration-300">
            </div>

            <div class="h-24 overflow-x-auto overflow-y-hidden">
                <div id="galleryThumbnailContainer" class="flex space-x-2 space-x-reverse h-full py-2">
                    @if (!empty($designImages))
                        @foreach ($designImages as $index => $image)
                            <img src="{{ $image }}" alt="صورة مصغرة {{ $index + 1 }}"
                                class="gallery-thumbnail h-20 w-20 object-cover rounded-lg cursor-pointer border-2 border-transparent hover:border-[#f3a446]/50 opacity-70 hover:opacity-100 transition-all duration-300 transform hover:scale-105"
                                onclick="changeGalleryImage(this, '{{ $image }}')">
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const imageModal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const galleryModal = document.getElementById('galleryModal');
    const galleryMainImage = document.getElementById('galleryMainImage');

    function openImageModal(imageUrl) {
        modalImage.src = imageUrl;
        imageModal.classList.remove('hidden');
        imageModal.classList.add('flex');
    }

    function closeImageModal() {
        imageModal.classList.add('hidden');
        imageModal.classList.remove('flex');
    }

    function openGalleryModal() {
        galleryModal.classList.remove('hidden');
        galleryModal.classList.add('flex');

        const firstThumbnail = document.querySelector('.gallery-thumbnail');
        if (firstThumbnail) {
            const firstImageUrl = firstThumbnail.getAttribute('src');
            changeGalleryImage(firstThumbnail, firstImageUrl);
        }
    }

    function closeGalleryModal() {
        galleryModal.classList.add('hidden');
        galleryModal.classList.remove('flex');
    }

    function changeGalleryImage(selectedThumbnail, imageUrl) {
        galleryMainImage.src = imageUrl;

        document.querySelectorAll('.gallery-thumbnail').forEach(thumb => {
            thumb.classList.remove('active', 'border-[#f3a446]', 'opacity-100', 'scale-105');
            thumb.classList.add('border-transparent', 'opacity-70');
        });

        selectedThumbnail.classList.add('active', 'border-[#f3a446]', 'opacity-100', 'scale-105');
        selectedThumbnail.classList.remove('border-transparent', 'opacity-70');
    }

    window.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeImageModal();
            closeGalleryModal();
        }
    });
</script>

    <script>
        // Tab functionality
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all tabs and contents
                document.querySelectorAll('.tab-button').forEach(tab => {
                    tab.classList.remove('tab-active');
                });
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.remove('active');
                    content.classList.add('hidden');
                });

                // Add active class to clicked tab
                this.classList.add('tab-active');

                // Show corresponding content
                const tabId = this.id.replace('tab-', 'content-');
                document.getElementById(tabId).classList.remove('hidden');
                document.getElementById(tabId).classList.add('active');

                // Add fade-in animation
                document.getElementById(tabId).classList.add('animate-fade-in');
                setTimeout(() => {
                    document.getElementById(tabId).classList.remove('animate-fade-in');
                }, 500);
            });
        });

        // Image modal functionality
        function openImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Gallery modal functionality
        function openGalleryModal() {
    const images = @json($designImages ?? []);
            if (images.length > 0) {
                document.getElementById('galleryMainImage').src = images[0];
                document.getElementById('galleryModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeGalleryModal() {
            document.getElementById('galleryModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function changeGalleryImage(imageSrc) {
            document.getElementById('galleryMainImage').src = imageSrc;
        }

        // Items view toggle
        function toggleItemsView() {
            const tableView = document.getElementById('items-table-view');
            const cardView = document.getElementById('items-card-view');

            if (tableView.classList.contains('hidden')) {
                tableView.classList.remove('hidden');
                cardView.classList.add('hidden');
            } else {
                tableView.classList.add('hidden');
                cardView.classList.remove('hidden');
            }
        }

        // Export items to PDF (placeholder function)
        function exportItemsToPDF() {
            alert('سيتم تصدير بنود المناقصة إلى PDF. هذه الميزة قيد التطوير.');
            // In a real implementation, this would make an API call to generate a PDF
        }

        // Share tender functionality
        function shareTender() {
            if (navigator.share) {
                navigator.share({
                        title: '{{ $tender->title }}',
                        text: 'اطلع على هذه المناقصة في منصة انشاءات',
                        url: window.location.href,
                    })
                    .then(() => console.log('تمت المشاركة بنجاح'))
                    .catch((error) => console.log('خطأ في المشاركة:', error));
            } else {
                // Fallback for browsers that don't support the Web Share API
                navigator.clipboard.writeText(window.location.href)
                    .then(() => alert('تم نسخ رابط المناقصة إلى الحافظة'))
                    .catch(err => alert('تعذر نسخ الرابط: ' + err));
            }
        }

        // Close modals with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
                closeGalleryModal();
            }
        });

        // Close modals when clicking outside
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        document.getElementById('galleryModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeGalleryModal();
            }
        });
    </script>
@endsection
