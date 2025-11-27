@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-500 hover:text-[#f3a446] transition-colors font-medium">{{ __('app.home') }}</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-left text-gray-400 mx-2"></i>
                        <a href="{{ route('lands.index') }}" class="text-gray-500 hover:text-[#f3a446] transition-colors font-medium">{{ __('app.lands') }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-left text-gray-400 mx-2"></i>
                        <span class="text-[#2f5c69] font-bold">{{ $land['title'] }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ __('app.quick_links') }}</h2>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('lands.create') }}" class="inline-flex items-center px-5 py-2.5 bg-[#f3a446] text-[#1a262a] rounded-xl font-bold hover:bg-[#f5b05a] transition-all transform hover:scale-105 shadow-md">
                        <i class="fas fa-plus mx-2"></i>
                        {{ __('app.add_new_land') }}
                    </a>
                    <a href="{{ route('lands.my-ads') }}" class="inline-flex items-center px-5 py-2.5 bg-[#2f5c69]/10 text-[#2f5c69] rounded-xl font-medium hover:bg-[#2f5c69]/20 transition-colors">
                        <i class="fas fa-list mx-2"></i>
                        {{ __('app.my_ads') }}
                    </a>
                    <a href="{{ route('lands.my-offers') }}" class="inline-flex items-center px-5 py-2.5 bg-[#2f5c69]/10 text-[#2f5c69] rounded-xl font-medium hover:bg-[#2f5c69]/20 transition-colors">
                        <i class="fas fa-handshake mx-2"></i>
                        {{ __('app.submitted_offers') }}
                    </a>
                    <a href="{{ route('lands.index') }}" class="inline-flex items-center px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200 transition-colors">
                        <i class="fas fa-search mx-2"></i>
                        {{ __('app.browse_lands') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-8">
                    @if($land->images && is_array($land->images) && count($land->images) > 0)
                        <div class="relative h-96 group">
                            <img id="main-image" src="{{ $land->images[0] }}" alt="{{ $land->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-60"></div>
                            
                            <div class="absolute top-4 right-4 rtl:right-4 ltr:left-auto ltr:right-4">
                                <span class="px-4 py-2 rounded-full text-sm font-bold shadow-lg {{ $land->transaction_type === 'sale' ? 'bg-[#f3a446] text-[#1a262a]' : 'bg-[#2f5c69] text-white' }}">
                                    {{ $land->transaction_type === 'sale' ? __('app.sale') : __('app.exchange') }}
                                </span>
                            </div>
                            <div class="absolute top-4 left-4 rtl:left-4 ltr:right-auto ltr:left-4">
                                
                            </div>
                        </div>

                        @if(is_array($land->images) && count($land->images) > 1)
                        <div class="p-4 border-t border-gray-100 bg-gray-50">
                            <div class="flex space-x-2 space-x-reverse overflow-x-auto pb-2">
                                @foreach($land->images as $index => $image)
                                <div class="w-24 h-24 rounded-xl cursor-pointer overflow-hidden border-2 transition-all thumbnail {{ $index === 0 ? 'border-[#f3a446] ring-2 ring-[#f3a446]/20' : 'border-transparent hover:border-gray-300' }}" onclick="changeMainImage('{{ $image }}', this)">
                                    <img src="{{ $image }}" alt="{{ $land->title }}" class="w-full h-full object-cover">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    @else
                        <div class="relative h-96 bg-gradient-to-br from-[#2f5c69] to-[#1a262a]">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <i class="fas fa-map text-8xl text-white opacity-10"></i>
                            </div>
                            <div class="absolute top-4 right-4">
                                <span class="px-4 py-2 rounded-full text-sm font-bold shadow-lg {{ $land->transaction_type === 'sale' ? 'bg-[#f3a446] text-[#1a262a]' : 'bg-white/20 text-white' }}">
                                    {{ $land->transaction_type === 'sale' ? __('app.sale') : __('app.exchange') }}
                                </span>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $land->title }}</h1>
                    <p class="text-gray-600 text-lg mb-8 leading-relaxed">{{ $land->description }}</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                        <div class="flex items-center p-4 bg-gray-50 rounded-2xl border border-gray-100 hover:border-[#f3a446]/30 transition-colors">
                            <div class="p-3 bg-[#2f5c69]/10 rounded-xl mx-4">
                                <i class="fas fa-map-marker-alt text-2xl text-[#2f5c69]"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-500 mb-1">{{ __('app.location') }}</p>
                                <p class="font-bold text-gray-900 text-lg">{{ $land->location }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-4 bg-gray-50 rounded-2xl border border-gray-100 hover:border-[#f3a446]/30 transition-colors">
                            <div class="p-3 bg-[#2f5c69]/10 rounded-xl mx-4">
                                <i class="fas fa-ruler-combined text-2xl text-[#2f5c69]"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-500 mb-1">{{ __('app.area') }}</p>
                                <p class="font-bold text-gray-900 text-lg">{{ $land->formatted_area }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-4 bg-gray-50 rounded-2xl border border-gray-100 hover:border-[#f3a446]/30 transition-colors">
                            <div class="p-3 bg-[#f3a446]/10 rounded-xl mx-4">
                                <i class="fas fa-tag text-2xl text-[#f3a446]"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-500 mb-1">{{ __('app.price') }}</p>
                                <p class="font-bold text-gray-900 text-lg">{{ $land->formatted_price }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-4 bg-gray-50 rounded-2xl border border-gray-100 hover:border-[#f3a446]/30 transition-colors">
                            <div class="p-3 bg-purple-50 rounded-xl mx-4">
                                <i class="fas fa-calendar-alt text-2xl text-purple-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-500 mb-1">{{ __('app.publish_date') }}</p>
                                <p class="font-bold text-gray-900 text-lg">{{ $land->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                            <span class="w-2 h-8 bg-[#f3a446] rounded-full mx-3"></span>
                            {{ __('app.features') }}
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($land['features'] as $feature)
                            <div class="flex items-center p-3 rounded-xl bg-gray-50/50">
                                <div class="w-6 h-6 rounded-full bg-[#2f5c69] flex items-center justify-center mx-3 flex-shrink-0">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <span class="text-gray-700 font-medium">{{ $feature }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="w-2 h-8 bg-[#2f5c69] rounded-full mx-3"></span>
                        {{ __('app.location_map') }}
                    </h3>
                    <div class="h-80 bg-gray-200 rounded-2xl flex items-center justify-center border-2 border-dashed border-gray-300">
                        <div class="text-center">
                            <i class="fas fa-map-marked-alt text-5xl text-gray-400 mb-3"></i>
                            <p class="text-gray-500 font-medium">{{ __('app.interactive_map') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl border border-[#f3a446]/20 p-6 mb-6 sticky top-24">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 border-b border-gray-100 pb-4">{{ __('app.contact_info') }}</h3>

                    <div class="space-y-5 mb-8">
                        <div class="flex items-center">
                            <div class="p-3 bg-[#2f5c69]/10 rounded-xl mx-3">
                                <i class="fas fa-user text-[#2f5c69]"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-500">{{ __('app.advertiser') }}</p>
                                <p class="font-bold text-gray-900">{{ $land->contact_name }}</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="p-3 bg-[#2f5c69]/10 rounded-xl mx-3">
                                <i class="fas fa-phone text-[#2f5c69]"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-500">{{ __('app.phone') }}</p>
                                <p class="font-bold text-gray-900" dir="ltr">{{ $land->contact_phone }}</p>
                            </div>
                        </div>

                        @if($land->contact_whatsapp)
                        <div class="flex items-center">
                            <div class="p-3 bg-green-100 rounded-xl mx-3">
                                <i class="fab fa-whatsapp text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-500">{{ __('app.whatsapp') }}</p>
                                <p class="font-bold text-gray-900" dir="ltr">{{ $land->contact_whatsapp }}</p>
                            </div>
                        </div>
                        @endif

                        @if($land->contact_email)
                        <div class="flex items-center">
                            <div class="p-3 bg-gray-100 rounded-xl mx-3">
                                <i class="fas fa-envelope text-gray-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-500">{{ __('app.email') }}</p>
                                <p class="font-bold text-gray-900">{{ $land->contact_email }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="space-y-3">
                        @auth
                            @if(auth()->id() !== $land->user_id)
                                <a href="{{ route('lands.submit-offer', $land->id) }}" class="w-full bg-[#f3a446] text-[#1a262a] py-3.5 px-4 rounded-xl font-bold hover:bg-[#f5b05a] transition-all transform hover:scale-[1.02] shadow-lg flex items-center justify-center">
                                    <i class="fas fa-handshake mx-2"></i>
                                    {{ __('app.submit_offer') }}
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="w-full bg-[#f3a446] text-[#1a262a] py-3.5 px-4 rounded-xl font-bold hover:bg-[#f5b05a] transition-all transform hover:scale-[1.02] shadow-lg flex items-center justify-center">
                                <i class="fas fa-handshake mx-2"></i>
                                {{ __('app.login_to_offer') }}
                            </a>
                        @endauth

                        <button class="w-full bg-[#2f5c69] text-white py-3.5 px-4 rounded-xl font-bold hover:bg-[#1a262a] transition-colors flex items-center justify-center shadow-lg">
                            <i class="fas fa-phone mx-2"></i>
                            {{ __('app.call_now') }}
                        </button>

                        <button class="w-full bg-green-500 text-white py-3.5 px-4 rounded-xl font-bold hover:bg-green-600 transition-colors flex items-center justify-center shadow-lg">
                            <i class="fab fa-whatsapp mx-2"></i>
                            {{ __('app.whatsapp') }}
                        </button>

                        <button class="w-full border-2 border-[#2f5c69] text-[#2f5c69] py-3.5 px-4 rounded-xl font-bold hover:bg-[#2f5c69] hover:text-white transition-all flex items-center justify-center">
                            <i class="fas fa-envelope mx-2"></i>
                            {{ __('app.send_message') }}
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">{{ __('app.similar_lands') }}</h3>

                    <div class="space-y-4">
                        <div class="flex items-center p-3 border-2 border-transparent rounded-xl hover:border-[#f3a446]/50 hover:bg-gray-50 transition-all cursor-pointer group">
                            <div class="w-16 h-16 bg-gradient-to-br from-[#2f5c69] to-[#1a262a] rounded-lg mx-3 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-map text-white opacity-60"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900 text-sm group-hover:text-[#2f5c69] transition-colors">أرض سكنية في جدة</h4>
                                <p class="text-gray-500 text-xs mt-1">600 {{ __('app.square') }} </p>
                                <p class="text-[#f3a446] font-bold text-sm mt-1">750,000 {{ __('app.currency') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 border-2 border-transparent rounded-xl hover:border-[#f3a446]/50 hover:bg-gray-50 transition-all cursor-pointer group">
                            <div class="w-16 h-16 bg-gradient-to-br from-[#2f5c69] to-[#1a262a] rounded-lg mx-3 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-map text-white opacity-60"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900 text-sm group-hover:text-[#2f5c69] transition-colors">أرض تجارية في الدمام</h4>
                                <p class="text-gray-500 text-xs mt-1">800  {{ __('app.square') }}</p>
                                <p class="text-[#f3a446] font-bold text-sm mt-1">1,200,000 {{ __('app.currency') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 border-2 border-transparent rounded-xl hover:border-[#f3a446]/50 hover:bg-gray-50 transition-all cursor-pointer group">
                            <div class="w-16 h-16 bg-gradient-to-br from-[#2f5c69] to-[#1a262a] rounded-lg mx-3 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-map text-white opacity-60"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900 text-sm group-hover:text-[#2f5c69] transition-colors">أرض زراعية في القصيم</h4>
                                <p class="text-gray-500 text-xs mt-1">1500  {{ __('app.square') }}</p>
                                <p class="text-[#f3a446] font-bold text-sm mt-1">450,000 {{ __('app.currency') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function changeMainImage(imageSrc, thumbnail) {
    // Update main image
    const mainImg = document.getElementById('main-image');
    mainImg.style.opacity = '0';
    setTimeout(() => {
        mainImg.src = imageSrc;
        mainImg.style.opacity = '1';
    }, 200);

    // Update thumbnail selection
    document.querySelectorAll('.thumbnail').forEach(thumb => {
        thumb.classList.remove('border-[#f3a446]', 'ring-2', 'ring-[#f3a446]/20');
        thumb.classList.add('border-transparent');
    });
    thumbnail.classList.remove('border-transparent');
    thumbnail.classList.add('border-[#f3a446]', 'ring-2', 'ring-[#f3a446]/20');
}
</script>
@endsection