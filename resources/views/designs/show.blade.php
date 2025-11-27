@extends('layouts.app')

@section('title', $design->title . ' - ' . config('app.name'))

@section('content')
<section class="bg-gray-50 pt-24 pb-8 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
       
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                    <div class="bg-gray-200 h-96 relative group">
                        <img src="{{ $design->main_image_url }}" alt="{{ $design->title }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    @php
                        $galleryImages = $design->images_urls ?? [];
                    @endphp
                    @if (count($galleryImages) > 0)
                        <div class="p-4 bg-gray-50 border-t border-gray-100">
                            <div class="grid grid-cols-4 gap-4">
                                @foreach ($galleryImages as $imageUrl)
                                    <div class="h-24 rounded-lg overflow-hidden cursor-pointer border-2 border-transparent hover:border-[#f3a446] transition-all duration-300">
                                        <img src="{{ $imageUrl }}" alt="{{ $design->title }}"
                                             class="w-full h-full object-cover hover:opacity-90">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-8 border-t-4 border-[#2f5c69]">
                    <h2 class="text-2xl font-bold text-[#2f5c69] mb-6 flex items-center gap-3">
                        <i class="fas fa-align-right text-[#f3a446]"></i>
                        {{ __('app.design_description') }}
                    </h2>
                    <p class="text-gray-600 leading-loose text-lg text-justify">{{ $design->description }}</p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-[#2f5c69] mb-6 flex items-center gap-3">
                        <i class="fas fa-star text-[#f3a446]"></i>
                        {{ __('app.features') }}
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ">
                        @php
                            $features = is_array($design->features)
                                ? $design->features
                                : (json_decode($design->features ?? '[]', true) ?:
                                []);
                        @endphp
                        @foreach ($features as $feature)
                            <div class="flex items-center bg-gray-50 p-3 rounded-lg border border-gray-100 hover:border-[#f3a446]/30 transition-colors">
                                <div class="w-8 h-8 rounded-full bg-[#2f5c69]/10 flex items-center justify-center ml-3 shrink-0 mr-3">
                                    <i class="fas fa-check text-[#2f5c69] text-sm"></i>
                                </div>
                                <span class="text-gray-700 font-medium">{{ $feature }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-[#2f5c69] mb-6 flex items-center gap-3">
                        <i class="fas fa-list-ul text-[#f3a446]"></i>
                        {{ __('app.specifications') }}
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                        <div class="text-center p-6 bg-gray-50 rounded-xl hover:shadow-md transition-shadow border border-gray-100 group">
                            <i class="fas fa-bed text-3xl text-[#2f5c69] mb-3 group-hover:text-[#f3a446] transition-colors"></i>
                            <div class="text-3xl font-bold text-gray-800 mb-1">{{ $design->bedrooms }}</div>
                            <div class="text-gray-500 text-sm">{{ __('app.bedrooms') }}</div>
                        </div>
                        <div class="text-center p-6 bg-gray-50 rounded-xl hover:shadow-md transition-shadow border border-gray-100 group">
                            <i class="fas fa-bath text-3xl text-[#2f5c69] mb-3 group-hover:text-[#f3a446] transition-colors"></i>
                            <div class="text-3xl font-bold text-gray-800 mb-1">{{ $design->bathrooms }}</div>
                            <div class="text-gray-500 text-sm">{{ __('app.bathrooms') }}</div>
                        </div>
                        <div class="text-center p-6 bg-gray-50 rounded-xl hover:shadow-md transition-shadow border border-gray-100 group">
                            <i class="fas fa-building text-3xl text-[#2f5c69] mb-3 group-hover:text-[#f3a446] transition-colors"></i>
                            <div class="text-3xl font-bold text-gray-800 mb-1">{{ $design->floors }}</div>
                            <div class="text-gray-500 text-sm">{{ __('app.floors') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-6">
                    <div class="bg-white rounded-2xl shadow-lg p-6 border-t-4 border-[#f3a446]">
                        <div class="text-center mb-8 pb-6 border-b border-gray-100">
                            <div class="text-4xl font-bold text-[#2f5c69] mb-2">{{ $design->price }} <span class="text-lg text-gray-500 font-normal">{{ __('app.price_currency') }}</span></div>
                            <div class="text-[#f3a446] font-medium">{{ __('app.design_price') }}</div>
                        </div>

                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between items-center py-2 border-b border-gray-50">
                                <span class="text-gray-500 flex items-center gap-2"><i class="fas fa-ruler-combined text-gray-400"></i> {{ __('app.area') }}</span>
                                <span class="font-bold text-gray-800">{{ $design->area }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-50">
                                <span class="text-gray-500 flex items-center gap-2"><i class="fas fa-layer-group text-gray-400"></i> {{ __('app.style') }}</span>
                                <span class="bg-[#2f5c69]/10 text-[#2f5c69] px-3 py-1 rounded-full text-sm font-semibold">{{ $design->style }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-50">
                                <span class="text-gray-500 flex items-center gap-2"><i class="fas fa-user-tie text-gray-400"></i> {{ __('app.architect') }}</span>
                                <span class="font-bold text-gray-800">{{ $design->architect }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-500 flex items-center gap-2"><i class="fas fa-star text-gray-400"></i> {{ __('app.rating') }}</span>
                                <div class="flex items-center bg-yellow-50 px-2 py-1 rounded-lg">
                                    <i class="fas fa-star text-[#f3a446] ml-1 text-sm"></i>
                                    <span class="font-bold text-gray-800">{{ $design->rating }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <button onclick="openCostModal()"
                                class="w-full bg-[#2f5c69] text-white py-4 rounded-xl font-bold hover:bg-[#244852] transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center gap-2 group">
                                <i class="fas fa-calculator group-hover:rotate-12 transition-transform"></i>
                                {{ __('app.calculate_cost_btn') }}
                            </button>
                            <button
                                class="w-full bg-[#f3a446] text-[#2f5c69] py-4 rounded-xl font-bold hover:bg-[#e09235] transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center gap-2 ">
                                <i class="fas fa-phone"></i>
                                {{ __('app.contact_architect') }}
                            </button>
                            <button
                                class="w-full border-2 border-gray-200 text-gray-600 py-3 rounded-xl font-semibold hover:border-[#f3a446] hover:text-[#f3a446] hover:bg-white transition-all duration-300 flex items-center justify-center gap-2">
                                <i class="fas fa-heart"></i>
                                {{ __('app.add_favorite') }}
                            </button>

                            @auth
                                @if (auth()->user()->isConsultant() && auth()->id() == $design->consultant_id)
                                    <div class="border-t border-gray-100 pt-4 mt-4 grid grid-cols-2 gap-3">
                                        <button onclick="editDesign()"
                                            class="bg-blue-50 text-blue-600 py-2 rounded-lg font-semibold hover:bg-blue-100 transition duration-300 text-sm">
                                            <i class="fas fa-edit ml-1"></i> {{ __('app.edit') }}
                                        </button>
                                        <button onclick="deleteDesign()"
                                            class="bg-red-50 text-red-600 py-2 rounded-lg font-semibold hover:bg-red-100 transition duration-300 text-sm">
                                            <i class="fas fa-trash ml-1"></i> {{ __('app.delete') }}
                                        </button>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-[#2f5c69] mb-4 pb-2 border-b border-gray-100">{{ __('app.architect_info') }}</h3>
                        <div class="flex items-center mb-6">
                            <div class="w-14 h-14 bg-[#f3a446]/10 rounded-full flex items-center justify-center ml-4 shrink-0 border border-[#f3a446]/20 mr-3">
                                <i class="fas fa-user text-[#f3a446] text-xl"></i>
                            </div>
                            <div>
                                <div class="font-bold text-gray-900 text-lg">{{ $design->architect }}</div>
                                <div class="text-gray-500 text-sm">{{ __('app.certified_architect') }}</div>
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4 grid grid-cols-2 gap-4">
                            <div class="text-center border-l border-gray-200">
                                <div class="text-[#2f5c69] font-bold text-lg">4.8</div>
                                <div class="text-xs text-gray-500">{{ __('app.general_rating') }}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-[#2f5c69] font-bold text-lg">15</div>
                                <div class="text-xs text-gray-500">{{ __('app.completed_project') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-[#2f5c69] mb-4 pb-2 border-b border-gray-100">{{ __('app.similar_designs') }}</h3>
                        <div class="space-y-4">
                            <div class="flex items-center group cursor-pointer p-2 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="w-16 h-16 bg-gray-200 rounded-lg overflow-hidden ml-3 relative mr-3">
                                    <div class="absolute inset-0 bg-[#2f5c69]/20 group-hover:bg-transparent transition-colors"></div>
                                    <i class="fas fa-home text-gray-400 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="font-bold text-gray-800 group-hover:text-[#f3a446] transition-colors">{{ __('app.modern_villa') }}</div>
                                    <div class="text-[#2f5c69] text-sm font-semibold">400,000 {{ __('app.price_currency') }}</div>
                                </div>
                            </div>
                            <div class="flex items-center group cursor-pointer p-2 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="w-16 h-16 bg-gray-200 rounded-lg overflow-hidden ml-3 relative mr-3">
                                    <div class="absolute inset-0 bg-[#2f5c69]/20 group-hover:bg-transparent transition-colors"></div>
                                    <i class="fas fa-home text-gray-400 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="font-bold text-gray-800 group-hover:text-[#f3a446] transition-colors">{{ __('app.islamic_house') }}</div>
                                    <div class="text-[#2f5c69] text-sm font-semibold">300,000 {{ __('app.price_currency') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="costModal" class="fixed inset-0 bg-[#2f5c69]/80 backdrop-blur-sm hidden z-[60] flex items-center justify-center p-4 transition-all duration-300">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full overflow-hidden transform transition-all scale-100">
        <div class="bg-[#2f5c69] p-4 flex justify-between items-center">
            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                <i class="fas fa-calculator text-[#f3a446]"></i>
                {{ __('app.cost_calculator_title') }}
            </h3>
            <button onclick="closeCostModal()" class="text-white/80 hover:text-white transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="p-6 space-y-5">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('app.area_sqm') }}</label>
                <div class="relative">
                    <input type="number"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#f3a446] focus:border-transparent transition-all bg-gray-50 pl-10"
                        value="400">
                    <i class="fas fa-ruler-combined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('app.construction_type') }}</label>
                <div class="relative">
                    <select
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#f3a446] focus:border-transparent transition-all bg-gray-50 appearance-none">
                        <option value="economy">{{ __('app.type_economy') }}</option>
                        <option value="standard">{{ __('app.type_standard') }}</option>
                        <option value="luxury">{{ __('app.type_luxury') }}</option>
                    </select>
                    <i class="fas fa-chevron-down absolute end-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            <div class="bg-[#f3a446]/10 p-5 rounded-xl border border-[#f3a446]/30">
                <div class="text-center">
                    <div class="text-3xl font-bold text-[#2f5c69] mb-1">1,200,000 {{ __('app.price_currency') }}</div>
                    <div class="text-gray-600 text-sm">{{ __('app.estimated_build_cost') }}</div>
                </div>
            </div>
            <button class="w-full bg-[#f3a446] text-[#2f5c69] py-3 rounded-xl font-bold hover:bg-[#e09235] transition duration-300 shadow-md">
                {{ __('app.calculate_action') }}
            </button>
        </div>
    </div>
</div>

<script>
    function openCostModal() {
        document.getElementById('costModal').classList.remove('hidden');
        setTimeout(() => {
            document.getElementById('costModal').classList.remove('opacity-0');
        }, 10);
    }

    function closeCostModal() {
        document.getElementById('costModal').classList.add('opacity-0');
        setTimeout(() => {
            document.getElementById('costModal').classList.add('hidden');
        }, 300);
    }

    document.getElementById('costModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeCostModal();
        }
    });

    function editDesign() {
        window.location.href = '{{ route('designs.edit', $design->id) }}';
    }

    function deleteDesign() {
        if (confirm('{{ __('app.delete_confirmation') }}')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('designs.destroy', $design->id) }}';

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            form.appendChild(methodField);

            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
@endsection