@extends('layouts.app')

@section('title', $project->title . ' - insha\'at')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-4">
                <div class="flex items-center">
                    <a href="{{ route('projects.index') }}" class="text-gray-500 hover:text-gray-700 mr-4">
                        <i class="fas fa-arrow-right text-lg"></i>
                    </a>
                    <div>
                        <h1 class="text-xl md:text-2xl font-bold text-gray-900 line-clamp-1">{{ $project->title }}</h1>
                        <p class="text-sm md:text-base text-gray-600">{{ __('projects.labels.status') }}:
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                @if($project->status === 'draft') bg-gray-100 text-gray-800
                                @elseif($project->status === 'published') bg-blue-100 text-blue-800
                                @elseif($project->status === 'consultant_selected') bg-purple-100 text-purple-800
                                @elseif($project->status === 'design_ready') bg-green-100 text-green-800
                                @elseif($project->status === 'contractor_bidding') bg-orange-100 text-orange-800
                                @elseif($project->status === 'contractor_selected') bg-yellow-100 text-yellow-800
                                @elseif($project->status === 'supplier_bidding') bg-red-100 text-red-800
                                @elseif($project->status === 'supplier_selected') bg-indigo-100 text-indigo-800
                                @elseif($project->status === 'in_progress') bg-teal-100 text-teal-800
                                @elseif($project->status === 'completed') bg-emerald-100 text-emerald-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ __('projects.status.' . $project->status) }}
                            </span>
                        </p>
                    </div>
                </div>

                @if(auth()->user()->isClient() && $project->client_id === auth()->id())
                    @if($project->status === 'draft')
                    <form action="{{ route('projects.publish', $project) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm md:text-base hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-paper-plane ml-1"></i>
                            {{ __('projects.actions.publish') }}
                        </button>
                    </form>
                    @endif
                @endif
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Project Details -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">{{ __('projects.sections.project_details') }}</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-500">{{ __('projects.labels.property_type') }}:</span>
                                <span class="font-medium">{{ __('projects.property_types.' . $project->property_type) }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">{{ __('projects.labels.style') }}:</span>
                                <span class="font-medium">{{ __('projects.styles.' . $project->style) }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">{{ __('projects.labels.area') }}:</span>
                                <span class="font-medium">{{ $project->area }} م²</span>
                            </div>
                            <div>
                                <span class="text-gray-500">{{ __('projects.labels.location') }}:</span>
                                <span class="font-medium">{{ $project->location }}</span>
                            </div>
                            @if($project->neighborhood)
                            <div>
                                <span class="text-gray-500">{{ __('projects.labels.neighborhood') }}:</span>
                                <span class="font-medium">{{ $project->neighborhood }}</span>
                            </div>
                            @endif
                            <div>
                                <span class="text-gray-500">مستوى التشطيب:</span>
                                <span class="font-medium">{{ $project->finishing_level_text }}</span>
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <h3 class="font-medium text-gray-900 mb-2">الوصف:</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $project->description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Building Details -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">تفاصيل البناء</h2>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                            <div>
                                <span class="text-gray-500">عدد الطوابق:</span>
                                <span class="font-medium">{{ $project->floors }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">عدد المجالس:</span>
                                <span class="font-medium">{{ $project->majlis_count }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">غرف النوم:</span>
                                <span class="font-medium">{{ $project->bedrooms }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">غرف نوم الضيوف:</span>
                                <span class="font-medium">{{ $project->guest_bedrooms }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">الحمامات:</span>
                                <span class="font-medium">{{ $project->bathrooms }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">مواقف السيارات:</span>
                                <span class="font-medium">{{ $project->parking_spaces }}</span>
                            </div>
                            @if($project->other_rooms > 0)
                            <div>
                                <span class="text-gray-500">غرف أخرى:</span>
                                <span class="font-medium">{{ $project->other_rooms }}</span>
                            </div>
                            @endif
                        </div>

                        @if($project->additional_features && count($project->additional_features) > 0)
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <h3 class="font-medium text-gray-900 mb-2">الإضافات:</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($project->additional_features as $feature)
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-teal-100 text-teal-800">
                                        {{ $project->additional_features_text }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if($project->additional_notes)
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <h3 class="font-medium text-gray-900 mb-2">ملاحظات إضافية:</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $project->additional_notes }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Cost Estimation -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">{{ __('projects.sections.cost_estimation') }}</h2>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="text-center p-4 bg-teal-50 rounded-lg">
                                <div class="text-2xl font-bold text-teal-600">{{ number_format($project->estimated_cost) }}</div>
                                <div class="text-sm text-gray-600">درهم</div>
                                <div class="text-xs text-gray-500 mt-1">التكلفة المقدرة</div>
                            </div>

                            @if($project->budget_min)
                            <div class="text-center p-4 bg-blue-50 rounded-lg">
                                <div class="text-xl font-bold text-blue-600">{{ number_format($project->budget_min) }}</div>
                                <div class="text-sm text-gray-600">درهم</div>
                                <div class="text-xs text-gray-500 mt-1">الحد الأدنى</div>
                            </div>
                            @endif

                            @if($project->budget_max)
                            <div class="text-center p-4 bg-orange-50 rounded-lg">
                                <div class="text-xl font-bold text-orange-600">{{ number_format($project->budget_max) }}</div>
                                <div class="text-sm text-gray-600">درهم</div>
                                <div class="text-xs text-gray-500 mt-1">الحد الأقصى</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Selected Professionals -->
                @if($project->selectedConsultant || $project->selectedContractor || $project->selectedSupplier)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">{{ __('projects.sections.selected_professionals') }}</h2>

                        <div class="space-y-4">
                            @if($project->selectedConsultant)
                            <div class="flex items-center p-3 bg-purple-50 rounded-lg">
                                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user-tie text-purple-600"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="font-medium text-gray-900">{{ $project->selectedConsultant->name }}</div>
                                    <div class="text-sm text-gray-600">{{ __('projects.labels.consultant') }}</div>
                                </div>
                            </div>
                            @endif

                            @if($project->selectedContractor)
                            <div class="flex items-center p-3 bg-orange-50 rounded-lg">
                                <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-hard-hat text-orange-600"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="font-medium text-gray-900">{{ $project->selectedContractor->name }}</div>
                                    <div class="text-sm text-gray-600">{{ __('projects.labels.contractor') }}</div>
                                </div>
                            </div>
                            @endif

                            @if($project->selectedSupplier)
                            <div class="flex items-center p-3 bg-red-50 rounded-lg">
                                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-truck text-red-600"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="font-medium text-gray-900">{{ $project->selectedSupplier->name }}</div>
                                    <div class="text-sm text-gray-600">{{ __('projects.labels.supplier') }}</div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <!-- Files -->
                @if($files->count() > 0)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">{{ __('projects.sections.files') }}</h2>

                        <div class="space-y-3">
                            @foreach($files as $file)
                            <div class="flex items-center p-3 border border-gray-200 rounded-lg">
                                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                                    @if($file->isImage())
                                        <i class="fas fa-image text-gray-600"></i>
                                    @elseif($file->isPdf())
                                        <i class="fas fa-file-pdf text-red-600"></i>
                                    @elseif($file->isDocument())
                                        <i class="fas fa-file-word text-blue-600"></i>
                                    @else
                                        <i class="fas fa-file text-gray-600"></i>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <div class="font-medium text-gray-900">{{ $file->title ?: $file->original_name }}</div>
                                    <div class="text-sm text-gray-600">{{ $file->formatted_file_size }} • {{ $file->file_type_text }}</div>
                                </div>
                                <a href="{{ Storage::url($file->file_path) }}" target="_blank" class="text-teal-600 hover:text-teal-700">
                                    <i class="fas fa-download"></i>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Actions -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">الإجراءات</h3>

                        <div class="space-y-3">
                            @if(auth()->user()->isConsultant() && $project->status === 'published')
                            <a href="{{ route('offers.create', $project) }}" class="w-full bg-purple-600 text-white py-2 px-4 rounded-lg text-center hover:bg-purple-700 transition duration-200 text-sm">
                                <i class="fas fa-plus ml-1"></i>
                                {{ __('offers.actions.create') }}
                            </a>
                            @endif

                            @if(auth()->user()->isContractor() && $project->status === 'contractor_bidding')
                            <a href="{{ route('offers.create', $project) }}" class="w-full bg-orange-600 text-white py-2 px-4 rounded-lg text-center hover:bg-orange-700 transition duration-200 text-sm">
                                <i class="fas fa-plus ml-1"></i>
                                {{ __('offers.actions.create') }}
                            </a>
                            @endif

                            @if(auth()->user()->isSupplier() && $project->status === 'supplier_bidding')
                            <a href="{{ route('offers.create', $project) }}" class="w-full bg-red-600 text-white py-2 px-4 rounded-lg text-center hover:bg-red-700 transition duration-200 text-sm">
                                <i class="fas fa-plus ml-1"></i>
                                {{ __('offers.actions.create') }}
                            </a>
                            @endif

                            @if(auth()->user()->isConsultant() && $project->selected_consultant_id === auth()->id() && $project->status === 'consultant_selected')
                            <button onclick="openDesignUpload()" class="w-full bg-green-600 text-white py-2 px-4 rounded-lg text-center hover:bg-green-700 transition duration-200 text-sm">
                                <i class="fas fa-upload ml-1"></i>
                                {{ __('projects.actions.upload_design') }}
                            </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Offers Summary -->
                @if($offers->count() > 0)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('projects.sections.offers') }}</h3>

                        <div class="space-y-3">
                            @foreach($offers->groupBy('professional_type') as $type => $typeOffers)
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-medium text-gray-900">{{ __('offers.professional_types.' . $type) }}</span>
                                    <span class="text-sm text-gray-600">{{ $typeOffers->count() }} عرض</span>
                                </div>
                                <div class="text-sm text-gray-600">
                                    @if($typeOffers->where('status', 'accepted')->count() > 0)
                                        <span class="text-green-600">تم اختيار عرض</span>
                                    @else
                                        <span class="text-blue-600">في الانتظار</span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <a href="#offers" class="w-full bg-teal-600 text-white py-2 px-4 rounded-lg text-center hover:bg-teal-700 transition duration-200 text-sm mt-4 block">
                            <i class="fas fa-eye ml-1"></i>
                            {{ __('projects.actions.view_offers') }}
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Offers Section -->
        @if($offers->count() > 0)
        <div id="offers" class="mt-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">{{ __('projects.sections.offers') }}</h2>

                    <div class="space-y-4">
                        @foreach($offers as $offer)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <div class="font-medium text-gray-900">{{ $offer->professional->name }}</div>
                                    <div class="text-sm text-gray-600">{{ __('offers.professional_types.' . $offer->professional_type) }}</div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-lg text-teal-600">{{ number_format($offer->price) }} درهم</div>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        @if($offer->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($offer->status === 'accepted') bg-green-100 text-green-800
                                        @elseif($offer->status === 'rejected') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ __('offers.status.' . $offer->status) }}
                                    </span>
                                </div>
                            </div>

                            <p class="text-gray-700 text-sm mb-3">{{ Str::limit($offer->description, 150) }}</p>

                            <div class="flex justify-between items-center">
                                <div class="text-sm text-gray-600">
                                    @if($offer->duration_days)
                                        <i class="fas fa-clock ml-1"></i>
                                        {{ $offer->duration_text }}
                                    @endif
                                </div>

                                <div class="flex space-x-2 space-x-reverse">
                                    <a href="{{ route('offers.show', $offer) }}" class="text-teal-600 hover:text-teal-700 text-sm">
                                        <i class="fas fa-eye ml-1"></i>
                                        {{ __('offers.actions.view') }}
                                    </a>

                                    @if(auth()->user()->isClient() && $project->client_id === auth()->id() && $offer->status === 'pending')
                                    <button onclick="respondToOffer({{ $offer->id }})" class="text-blue-600 hover:text-blue-700 text-sm">
                                        <i class="fas fa-reply ml-1"></i>
                                        {{ __('offers.actions.respond') }}
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Design Upload Modal -->
@if(auth()->user()->isConsultant() && $project->selected_consultant_id === auth()->id() && $project->status === 'consultant_selected')
<div id="designUploadModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('projects.actions.upload_design') }}</h3>

                <form action="{{ route('projects.upload-design', $project) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="design_title" class="block text-sm font-medium text-gray-700 mb-2">عنوان التصميم</label>
                        <input type="text" name="title" id="design_title" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                    </div>

                    <div class="mb-4">
                        <label for="design_file" class="block text-sm font-medium text-gray-700 mb-2">ملف التصميم</label>
                        <input type="file" name="design_file" id="design_file" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                               accept=".pdf,.jpg,.jpeg,.png,.zip,.rar">
                    </div>

                    <div class="mb-4">
                        <label for="design_description" class="block text-sm font-medium text-gray-700 mb-2">وصف التصميم</label>
                        <textarea name="description" id="design_description" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"></textarea>
                    </div>

                    <div class="flex space-x-3 space-x-reverse">
                        <button type="submit" class="flex-1 bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-700 transition duration-200">
                            رفع التصميم
                        </button>
                        <button type="button" onclick="closeDesignUpload()" class="flex-1 bg-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-400 transition duration-200">
                            إلغاء
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

<style>
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

@media (max-width: 768px) {
    .grid {
        grid-template-columns: 1fr;
    }

    .text-xl {
        font-size: 1.125rem;
    }

    .text-lg {
        font-size: 1rem;
    }

    .px-4 {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }

    .py-4 {
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }

    .p-6 {
        padding: 1rem;
    }
}

@media (max-width: 480px) {
    .px-4 {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }

    .py-4 {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }

    .p-6 {
        padding: 0.75rem;
    }

    .text-sm {
        font-size: 0.75rem;
    }

    .text-lg {
        font-size: 0.875rem;
    }

    .text-xl {
        font-size: 1rem;
    }
}

/* Fix input sizing for mobile */
input, select, textarea {
    font-size: 16px !important;
    max-width: 100% !important;
    box-sizing: border-box !important;
}
</style>

<script>
function openDesignUpload() {
    document.getElementById('designUploadModal').classList.remove('hidden');
}

function closeDesignUpload() {
    document.getElementById('designUploadModal').classList.add('hidden');
}

function respondToOffer(offerId) {
    // Implement offer response functionality
    console.log('Respond to offer:', offerId);
}
</script>
@endsection
