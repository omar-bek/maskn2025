@extends('layouts.app')

@section('title', __('app.create_tender_from_design'))

@section('content')
    <div class="container mx-auto px-4 py-8 mt-20">
        
        <div class="bg-white rounded-xl shadow-xl p-6 mb-8 border-t-4 border-[#f3a446]">
            <h1 class="text-3xl font-extrabold text-[#2f5c69]">{{ __('app.create_tender_from_design') }}</h1>
            <p class="text-gray-600 mt-2">{{ __('app.create_tender_desc') }}</p>
            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100 text-sm">
                <span class="font-bold text-[#f3a446] flex items-center">
                    <i class="fas fa-check-circle text-lg ml-2 pr-1"></i>
                    {{ __('app.step_1') }}
                </span>
                <span class="font-semibold text-[#2f5c69] flex items-center">
                    <i class="fas fa-edit text-lg ml-2 pr-1"></i>
                    {{ __('app.step_2') }}
                </span>
                <span class="text-gray-400 flex items-center">
                    <i class="fas fa-paper-plane text-lg ml-2 pr-1"></i>
                    {{ __('app.step_3') }}
                </span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-2xl p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3 flex items-center">
                <i class="fas fa-drafting-compass ml-3 text-[#f3a446] pr-1"></i>
                {{ __('app.selected_design_summary') }}
            </h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="lg:col-span-1">
                    <img src="{{ $design->main_image_url }}" alt="{{ $design->title }}"
                        class="w-full h-72 object-cover rounded-xl shadow-lg border-4 border-[#f3a446]/20 mb-4">
                    <div class="flex gap-2 flex-wrap justify-center">
                        @if ($design->images && is_array($design->images) && count($design->images) > 0)
                            @foreach (array_slice($design->images, 0, 3) as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="{{ $design->title }}"
                                    class="w-16 h-16 object-cover rounded-lg shadow-md hover:scale-105 transition duration-300 cursor-pointer">
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <h3 class="text-3xl font-extrabold text-[#2f5c69] mb-4">{{ $design->title }}</h3>
                    
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-6 p-4 bg-gray-50 rounded-lg">
                        <div class="flex flex-col items-start">
                            <span class="text-sm text-gray-500">{{ __('app.style') }}</span>
                            <span class="font-bold text-gray-800">{{ $design->style }}</span>
                        </div>
                        <div class="flex flex-col items-start">
                            <span class="text-sm text-gray-500">{{ __('app.area') }}</span>
                            <span class="font-bold text-gray-800">{{ $design->formatted_area }}</span>
                        </div>
                        <div class="flex flex-col items-start">
                            <span class="text-sm text-gray-500">{{ __('app.floors') }}</span>
                            <span class="font-bold text-gray-800">{{ $design->floors }}</span>
                        </div>
                        <div class="flex flex-col items-start">
                            <span class="text-sm text-gray-500">{{ __('app.bedrooms') }}</span>
                            <span class="font-bold text-gray-800">{{ $design->bedrooms }}</span>
                        </div>
                        <div class="flex flex-col items-start">
                            <span class="text-sm text-gray-500">{{ __('app.bathrooms') }}</span>
                            <span class="font-bold text-gray-800">{{ $design->bathrooms }}</span>
                        </div>
                        <div class="flex flex-col items-start">
                            <span class="text-sm text-gray-500">{{ __('app.estimated_price') }}</span>
                            <span class="font-extrabold text-green-600 text-lg">{{ $design->formatted_price }}</span>
                        </div>
                    </div>

                    @if ($design->description)
                        <div class="mb-4">
                            <h4 class="font-semibold text-gray-800 mb-2 border-b border-gray-200 pb-1">{{ __('app.design_description') }}</h4>
                            <p class="text-gray-700 text-sm italic">{{ $design->description }}</p>
                        </div>
                    @endif

                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <h4 class="font-bold text-[#2f5c69] mb-2">{{ __('app.consultant_info') }}</h4>
                        <div class="text-sm text-gray-600 space-y-1">
                            <p class="flex items-center"><i class="fas fa-user-tie ml-2 text-[#f3a446] pr-1"></i> <strong>{{ __('app.name') }}</strong> {{ $design->consultant_name }}</p>
                            @if ($design->consultant_phone)
                                <p class="flex items-center"><i class="fas fa-phone ml-2 text-[#f3a446] pr-1"></i> <strong>{{ __('app.phone') }}</strong> {{ $design->consultant_phone }}</p>
                            @endif
                            @if ($design->consultant_email)
                                <p class="flex items-center"><i class="fas fa-envelope ml-2 text-[#f3a446] pr-1"></i> <strong>{{ __('app.email') }}</strong> {{ $design->consultant_email }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-2xl overflow-hidden border-t-4 border-[#2f5c69]">
            <form action="{{ route('tenders.store') }}" method="POST">
                @csrf
                <input type="hidden" name="design_id" value="{{ $design->id }}">

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-300 rounded-lg p-4 mx-6 mt-6">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-red-600 ml-3 mt-1 text-lg pr-1"></i>
                            <div>
                                <h3 class="text-red-800 font-bold mb-2">{{ __('app.input_errors_title') }}</h3>
                                <ul class="text-red-700 text-sm space-y-1 list-disc pr-5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="border-b border-gray-200">
                    <div class="bg-[#2f5c69]/5 px-6 py-4 border-b border-gray-100">
                        <h2 class="text-xl font-bold text-[#2f5c69] flex items-center">
                            <i class="fas fa-file-alt ml-2 text-[#f3a446] pr-1"></i>
                            {{ __('app.basic_tender_details') }}
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6">
                            
                            <div class="flex flex-col md:flex-row items-start md:items-center">
                                <label for="title" class="md:w-1/4 text-sm font-medium text-gray-700 mb-1 md:mb-0">{{ __('app.tender_title') }} <span class="text-red-500">*</span></label>
                                <div class="md:w-3/4 w-full">
                                    <input type="text" name="title" id="title" required
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition duration-150"
                                        placeholder="{{ __('app.tender_title_placeholder') }}"
                                        value="{{ old('title', __('app.tender_title_prefix') . $design->title) }}">
                                </div>
                            </div>
                            
                            <div class="flex flex-col md:flex-row items-start md:items-center">
                                <label for="location" class="md:w-1/4 text-sm font-medium text-gray-700 mb-1 md:mb-0">{{ __('app.location') }} <span class="text-red-500">*</span></label>
                                <div class="md:w-3/4 w-full">
                                    <input type="text" name="location" id="location" required
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition duration-150"
                                        placeholder="{{ __('app.location_placeholder') }}"
                                        value="{{ old('location', $design->location) }}">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="flex flex-col">
                                    <label for="budget" class="text-sm font-medium text-gray-700 mb-1">{{ __('app.expected_budget') }}</label>
                                    <input type="number" name="budget" id="budget"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition duration-150"
                                        placeholder="{{ __('app.budget_placeholder') }}" value="{{ old('budget', $design->price) }}">
                                </div>

                                <div class="flex flex-col">
                                    <label for="deadline" class="text-sm font-medium text-gray-700 mb-1">{{ __('app.submission_deadline') }} <span class="text-red-500">*</span></label>
                                    <input type="date" name="deadline" id="deadline" required
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition duration-150"
                                        min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                        value="{{ old('deadline', '') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-b border-gray-200">
                    <div class="bg-[#2f5c69]/5 px-6 py-4 border-b border-gray-100">
                        <h2 class="text-xl font-bold text-[#2f5c69] flex items-center">
                            <i class="fas fa-pencil-alt ml-2 text-[#f3a446] pr-1"></i>
                            {{ __('app.project_desc_notes') }}
                        </h2>
                    </div>
                    <div class="p-6 space-y-6">
                        
                        <div class="flex flex-col">
                            <label for="description" class="text-sm font-medium text-gray-700 mb-1">{{ __('app.tender_description_label') }} <span class="text-red-500">*</span></label>
                            <textarea name="description" id="description" rows="4" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition duration-150"
                                placeholder="{{ __('app.tender_description_placeholder') }}">{{ old('description', __('app.tender_desc_default_1') . $design->location . __('app.tender_desc_default_2') . $design->formatted_area . '.') }}</textarea>
                        </div>

                        <div class="flex flex-col">
                            <label for="client_notes" class="text-sm font-medium text-gray-700 mb-1">{{ __('app.modification_notes') }}</label>
                            <textarea name="client_notes" id="client_notes" rows="6"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition duration-150"
                                placeholder="{{ __('app.modification_notes_placeholder') }}">{{ old('client_notes', '') }}</textarea>
                            <p class="text-xs text-gray-500 mt-2 flex items-center">
                                <i class="fas fa-info-circle ml-1 text-[#f3a446] pr-1"></i>
                                {{ __('app.notes_visibility_warning') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="bg-[#2f5c69]/5 px-6 py-4 border-b border-gray-100">
                        <h2 class="text-xl font-bold text-[#2f5c69] flex items-center">
                            <i class="fas fa-clipboard-list ml-2 text-[#f3a446] pr-1"></i>
                            {{ __('app.special_requirements_conditions') }}
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-col">
                            <label for="requirements" class="text-sm font-medium text-gray-700 mb-1">{{ __('app.special_requirements_optional') }}</label>
                            <textarea name="requirements" id="requirements" rows="4"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition duration-150"
                                placeholder="{{ __('app.special_requirements_placeholder') }}">{{ old('requirements', '') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-gray-100 border-t border-gray-200">
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('designs.show-with-pricing', $design->id) }}"
                            class="inline-flex items-center justify-center bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-xl transition duration-300 shadow-lg font-semibold">
                            <i class="fas fa-times ml-2 pr-1"></i>
                            {{ __('app.cancel') }}
                        </a>
                        <button type="submit"
                            class="inline-flex items-center justify-center bg-[#f3a446] hover:bg-[#d8923a] text-white px-8 py-3 rounded-xl transition duration-300 shadow-xl shadow-[#f3a446]/30 font-bold text-lg">
                            <i class="fas fa-plus-circle ml-2 pr-1"></i>
                            {{ __('app.create_tender_btn') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection