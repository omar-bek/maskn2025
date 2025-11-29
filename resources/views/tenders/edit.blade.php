@extends('layouts.app')

@section('title', __('app.edit_tender') . ' - انشاءات')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-[#2f5c69] flex items-center">
                    <i class="fas fa-edit mx-2 text-[#f3a446]"></i>{{ __('app.edit_tender') }}
                </h1>
                <p class="text-gray-500 mt-2 text-sm">{{ __('app.update_tender_data') }}: <span class="font-bold text-gray-700">{{ $tender->title }}</span></p>
            </div>
            <a href="{{ route('tenders.show', $tender->id) }}" class="inline-flex items-center text-gray-500 hover:text-[#2f5c69] transition-colors w-fit">
                <i class="fas fa-arrow-right mx-2 rtl:rotate-180"></i> {{ __('app.back_to_tender') }}
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            <form action="{{ route('tenders.update', $tender->id) }}" method="POST">
                @csrf
                @method('PUT')

                @if ($errors->any())
                <div class="bg-red-50 border-r-4 border-red-500 p-4 m-6 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                        </div>
                        <div class="mx-3">
                            <h3 class="text-sm font-bold text-red-800">{{ __('app.review_errors') }}:</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 p-4 sm:p-8">
                    
                    <div class="lg:col-span-2 space-y-8">
                        
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                            <h3 class="text-lg font-bold text-[#2f5c69] mb-4 flex items-center border-b border-gray-200 pb-3">
                                <span class="bg-[#2f5c69] w-2 h-6 rounded-full mx-3"></span>
                                {{ __('app.basic_info') }}
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="col-span-2">
                                    <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('app.tender_title') }} <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 right-0 px-3 flex items-center pointer-events-none rtl:right-0 rtl:left-auto ltr:left-auto ltr:right-0">
                                            <i class="fas fa-heading text-gray-400"></i>
                                        </div>
                                        <input type="text" name="title" required
                                            class="w-full px-10 border-gray-300 rounded-xl focus:ring-[#2f5c69] focus:border-[#2f5c69] transition-colors py-3"
                                            placeholder="{{ __('app.tender_title_placeholder') }}"
                                            value="{{ old('title', $tender->title) }}">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('app.location') }} <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 right-0 px-3 flex items-center pointer-events-none rtl:right-0 rtl:left-auto ltr:left-auto ltr:right-0">
                                            <i class="fas fa-map-marker-alt text-gray-400"></i>
                                        </div>
                                        <input type="text" name="location" required
                                            class="w-full px-10 border-gray-300 rounded-xl focus:ring-[#2f5c69] focus:border-[#2f5c69] transition-colors py-3"
                                            placeholder="{{ __('app.location_placeholder') }}"
                                            value="{{ old('location', $tender->location) }}">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('app.deadline') }} <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 right-0 px-3 flex items-center pointer-events-none rtl:right-0 rtl:left-auto ltr:left-auto ltr:right-0">
                                            <i class="far fa-calendar-alt text-gray-400"></i>
                                        </div>
                                        <input type="date" name="deadline" required
                                            class="w-full px-10 border-gray-300 rounded-xl focus:ring-[#2f5c69] focus:border-[#2f5c69] transition-colors py-3"
                                            min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                            value="{{ old('deadline', $tender->deadline->format('Y-m-d')) }}">
                                    </div>
                                </div>

                                <div class="col-span-2">
                                    <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('app.expected_budget') }}</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 right-0 px-3 flex items-center pointer-events-none rtl:right-0 rtl:left-auto ltr:left-auto ltr:right-0">
                                            <i class="fas fa-coins text-gray-400"></i>
                                        </div>
                                        <input type="number" name="budget"
                                            class="w-full px-10 border-gray-300 rounded-xl focus:ring-[#2f5c69] focus:border-[#2f5c69] transition-colors py-3"
                                            placeholder="{{ __('app.budget_placeholder') }}"
                                            value="{{ old('budget', $tender->budget) }}">
                                        <div class="absolute inset-y-0 left-0 px-3 flex items-center pointer-events-none rtl:left-0 rtl:right-auto ltr:right-auto ltr:left-0">
                                            <span class="text-gray-500 text-sm font-bold">{{ __('app.currency_sar') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                            <h3 class="text-lg font-bold text-[#2f5c69] mb-4 flex items-center border-b border-gray-200 pb-3">
                                <span class="bg-[#f3a446] w-2 h-6 rounded-full mx-3"></span>
                                {{ __('app.select_design') }} <span class="text-red-500 mx-1">*</span>
                            </h3>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-h-[500px] overflow-y-auto pr-2 custom-scrollbar">
                                @foreach($designs as $design)
                                <div class="design-option relative group cursor-pointer transition-all duration-300 border-2 rounded-2xl overflow-hidden hover:shadow-lg bg-white
                                    {{ old('design_id', $tender->design_id) == $design->id ? 'border-[#2f5c69] ring-2 ring-[#2f5c69]/20' : 'border-gray-100 hover:border-[#f3a446]' }}"
                                    onclick="selectDesign({{ $design->id }})">
                                    
                                    <input type="radio" name="design_id" value="{{ $design->id }}" id="design_{{ $design->id }}"
                                        class="sr-only" {{ old('design_id', $tender->design_id) == $design->id ? 'checked' : '' }}>
                                    
                                    <div class="absolute top-3 right-3 rtl:right-3 rtl:left-auto ltr:left-3 ltr:right-auto z-10 opacity-0 transition-opacity duration-300 check-icon {{ old('design_id', $tender->design_id) == $design->id ? 'opacity-100' : '' }}">
                                        <span class="bg-[#2f5c69] text-white w-8 h-8 flex items-center justify-center rounded-full shadow-md">
                                            <i class="fas fa-check"></i>
                                        </span>
                                    </div>

                                    <div class="flex flex-row p-3 gap-4">
                                        <div class="w-24 h-24 flex-shrink-0">
                                            <img src="{{ $design->main_image_url }}" alt="{{ $design->title }}" class="w-full h-full object-cover rounded-xl shadow-sm group-hover:scale-105 transition-transform duration-500">
                                        </div>
                                        <div class="flex-1 flex flex-col justify-center">
                                            <h4 class="font-bold text-gray-800 text-sm mb-1 line-clamp-1">{{ $design->title }}</h4>
                                            <p class="text-xs text-gray-500 mb-2">{{ $design->style }} | {{ $design->formatted_area }}</p>
                                            
                                            <div class="flex gap-2 text-[10px] text-gray-600 font-medium mb-2">
                                                <span class="bg-gray-100 px-2 py-1 rounded flex items-center"><i class="fas fa-bed mx-1 text-[#f3a446]"></i>{{ $design->bedrooms }}</span>
                                                <span class="bg-gray-100 px-2 py-1 rounded flex items-center"><i class="fas fa-bath mx-1 text-[#f3a446]"></i>{{ $design->bathrooms }}</span>
                                            </div>
                                            
                                            <p class="text-sm font-bold text-[#2f5c69]">{{ $design->formatted_price }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('designs.show', $design->id) }}" target="_blank" 
                                       class="absolute bottom-2 left-3 rtl:left-3 rtl:right-auto ltr:right-3 ltr:left-auto text-[10px] text-gray-400 hover:text-[#2f5c69] z-20 flex items-center bg-white/80 px-2 py-1 rounded-full backdrop-blur-sm">
                                        <i class="fas fa-external-link-alt mx-1"></i> {{ __('app.details') }}
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="space-y-8">
                        
                        <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm h-fit">
                            <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('app.project_description') }} <span class="text-red-500">*</span></label>
                            <textarea name="description" rows="5" required
                                class="w-full border-gray-300 rounded-xl focus:ring-[#2f5c69] focus:border-[#2f5c69] transition-colors p-4 text-sm leading-relaxed"
                                placeholder="{{ __('app.description_placeholder') }}">{{ old('description', $tender->description) }}</textarea>
                        </div>

                        <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm h-fit">
                            <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('app.requirements') }}</label>
                            <textarea name="requirements" rows="5"
                                class="w-full border-gray-300 rounded-xl focus:ring-[#2f5c69] focus:border-[#2f5c69] transition-colors p-4 text-sm leading-relaxed"
                                placeholder="{{ __('app.requirements_placeholder') }}">{{ old('requirements', $tender->requirements) }}</textarea>
                        </div>

                        <div class="bg-[#fff9f0] rounded-2xl p-6 border border-[#f3a446]/30 shadow-sm relative overflow-hidden">
                            <div class="absolute top-0 right-0 rtl:right-0 ltr:left-0 w-2 h-full bg-[#f3a446]"></div>
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fas fa-pen-fancy text-[#f3a446] text-xl mx-2"></i>
                                <label class="block text-base font-bold text-[#2f5c69]">{{ __('app.edit_notes') }}</label>
                            </div>
                            <p class="text-xs text-gray-500 mb-3">{{ __('app.edit_notes_hint') }}</p>
                            
                            <textarea name="client_notes" rows="8"
                                class="w-full border-[#f3a446]/30 bg-white rounded-xl focus:ring-[#f3a446] focus:border-[#f3a446] transition-colors p-4 text-sm leading-relaxed"
                                placeholder="{{ __('app.edit_notes_placeholder') }}">{{ old('client_notes', $tender->client_notes) }}</textarea>
                        </div>
                    </div>

                </div>

                <div class="bg-gray-50 px-8 py-6 border-t border-gray-200 flex flex-col-reverse sm:flex-row justify-end gap-4 items-center">
                    <a href="{{ route('tenders.show', $tender->id) }}"
                        class="w-full sm:w-auto text-center px-6 py-3 rounded-xl border border-gray-300 text-gray-700 font-bold hover:bg-gray-100 transition-all duration-200">
                        {{ __('app.cancel_edits') }}
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto flex justify-center items-center px-8 py-3 rounded-xl bg-[#2f5c69] text-white font-bold hover:bg-[#244852] shadow-lg shadow-[#2f5c69]/20 hover:shadow-none transition-all duration-200">
                        <i class="fas fa-save mx-2"></i>
                        {{ __('app.save_changes') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
@endsection

@push('scripts')
<script>
function selectDesign(designId) {
    document.querySelectorAll('.design-option').forEach(option => {
        option.classList.remove('border-[#2f5c69]', 'ring-2', 'ring-[#2f5c69]/20');
        option.classList.add('border-gray-100');
        option.querySelector('.check-icon').classList.remove('opacity-100');
        option.querySelector('.check-icon').classList.add('opacity-0');
    });

    const selectedOption = document.querySelector(`[onclick="selectDesign(${designId})"]`);
    selectedOption.classList.remove('border-gray-100');
    selectedOption.classList.add('border-[#2f5c69]', 'ring-2', 'ring-[#2f5c69]/20');
    
    selectedOption.querySelector('.check-icon').classList.remove('opacity-0');
    selectedOption.querySelector('.check-icon').classList.add('opacity-100');

    document.getElementById(`design_${designId}`).checked = true;
}

document.addEventListener('DOMContentLoaded', function() {
    const checkedRadio = document.querySelector('input[name="design_id"]:checked');
    if(checkedRadio) {
        selectDesign(checkedRadio.value);
    }
});
</script>
@endpush