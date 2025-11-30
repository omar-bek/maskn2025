@extends('layouts.app')

@section('title', __('app.saved_designs') . ' - insha\'at')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 mt-16">
    
    <div class="bg-white shadow-sm border-b border-gray-100 mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center py-8 gap-4">
                <div class="text-center md:text-right md:rtl:text-right md:ltr:text-left">
                    <h1 class="text-3xl font-bold text-[#2f5c69] flex items-center justify-center md:justify-start">
                        <i class="fas fa-bookmark mx-2 text-[#f3a446]"></i>
                        {{ __('app.saved_designs') }}
                    </h1>
                    <p class="text-gray-500 mt-2 text-sm">{{ __('app.saved_designs_desc') }}</p>
                </div>
                
                <a href="{{ route('designs.index') }}" 
                   class="inline-flex justify-center items-center px-6 py-3 rounded-xl border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 hover:text-[#2f5c69] transition-all duration-200 shadow-sm">
                    <i class="fas fa-search mx-2"></i>
                    {{ __('app.browse_designs') }}
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        @if(count($savedDesigns) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($savedDesigns as $design)
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden group flex flex-col h-full">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ $design['image'] ?? '/images/placeholder.jpg' }}" alt="{{ $design['title'] }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <span class="absolute top-4 right-4 rtl:right-4 rtl:left-auto ltr:left-4 ltr:right-auto bg-white/90 backdrop-blur-sm px-3 py-1 text-xs font-bold rounded-full text-[#2f5c69] shadow-sm">
                                {{ $design['style'] }}
                            </span>
                        </div>
                        
                        <div class="p-6 flex-grow flex flex-col">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-bold text-[#2f5c69] line-clamp-1 group-hover:text-[#f3a446] transition-colors">{{ $design['title'] }}</h3>
                            </div>
                            
                            <p class="text-gray-500 text-sm mb-4 line-clamp-2 flex-grow">{{ $design['description'] }}</p>

                            <div class="flex items-center text-xs font-medium text-gray-500 mb-4 bg-gray-50 p-2 rounded-lg w-fit">
                                <i class="fas fa-ruler-combined mx-2 text-[#f3a446]"></i>
                                <span>{{ $design['area'] }} {{ __('app.square_meter') }}</span>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
                                <span class="text-lg font-bold text-[#2f5c69]">{{ $design['price'] }} <span class="text-xs font-normal text-gray-500">{{ __('app.currency') }}</span></span>
                                <div class="flex space-x-2 space-x-reverse">
                                    <button class="w-10 h-10 rounded-full bg-gray-50 text-[#2f5c69] hover:bg-[#2f5c69] hover:text-white transition-all duration-200 flex items-center justify-center" title="{{ __('app.view_design') }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="w-10 h-10 rounded-full bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-200 flex items-center justify-center" title="{{ __('app.remove_design') }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 bg-white rounded-3xl shadow-sm border border-gray-100">
                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-bookmark text-4xl text-gray-300"></i>
                </div>
                <h3 class="text-xl font-bold text-[#2f5c69] mb-2">{{ __('app.no_saved_designs') }}</h3>
                <p class="text-gray-500 mb-8">{{ __('app.no_saved_designs_hint') }}</p>
                <a href="{{ route('designs.index') }}" 
                   class="inline-flex justify-center items-center px-8 py-3 rounded-xl bg-[#2f5c69] text-white font-bold hover:bg-[#244852] shadow-lg shadow-[#2f5c69]/20 transition-all duration-200">
                    <i class="fas fa-search mx-2"></i>
                    {{ __('app.browse_designs') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection