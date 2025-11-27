@extends('layouts.app')

@section('title', __('app.portfolio_title') . ' - insha\'at')

@section('content')
    <div class="bg-gray-50 min-h-screen pb-16 mt-10">
        <div class="bg-gradient-to-r from-[#1a262a] to-[#2f5c69] pt-16 pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6  text-center ">
                <h1 class="text-4xl font-extrabold text-white tracking-tight mb-2">{{ __('app.portfolio_title') }}</h1>
                <p class="text-lg text-gray-200 opacity-90 ">{{ __('app.portfolio_subtitle') }}</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 flex items-center gap-4 hover:transform hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl shadow-sm">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-[#1a262a]">{{ $portfolio->where('status', 'completed')->count() ?? 0 }}</p>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">{{ __('app.completed_projects') }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 flex items-center gap-4 hover:transform hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-2xl shadow-sm">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-[#1a262a]">{{ $portfolio->where('status', 'in_progress')->count() ?? 0 }}</p>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">{{ __('app.in_progress_projects') }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 flex items-center gap-4 hover:transform hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 rounded-full bg-[#f3a446]/10 text-[#f3a446] flex items-center justify-center text-2xl shadow-sm">
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-[#1a262a]">4.8</p>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">{{ __('app.average_rating') }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 flex items-center gap-4 hover:transform hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 rounded-full bg-[#2f5c69]/10 text-[#2f5c69] flex items-center justify-center text-2xl shadow-sm">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-[#1a262a]">{{ $portfolio->count() ?? 0 }}</p>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">{{ __('app.total_projects') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#f3a446]/10 rounded-full -mr-16 -mt-16"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-[#2f5c69]/10 rounded-full -ml-12 -mb-12"></div>
                
                <div class="relative z-10">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-[#1a262a] to-[#2f5c69] text-white flex items-center justify-center text-3xl mx-auto mb-4 shadow-lg transform rotate-3">
                        <i class="fas fa-plus"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-[#1a262a] mb-2">{{ __('app.add_new_project_title') }}</h2>
                    <p class="text-gray-500 mb-6 max-w-xl mx-auto">{{ __('app.add_new_project_desc') }}</p>
                    <a href="{{ route('designs.create') }}" class="inline-flex items-center gap-2 px-8 py-3 rounded-xl bg-[#f3a446] text-[#1a262a] font-bold shadow-md hover:bg-[#f5b05a] hover:shadow-lg hover:-translate-y-0.5 transition-all">
                        <i class="fas fa-plus"></i>
                        {{ __('app.add_project_btn') }}
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                    <div class="w-10 h-10 rounded-lg bg-[#2f5c69]/10 text-[#2f5c69] flex items-center justify-center">
                        <i class="fas fa-filter"></i>
                    </div>
                    <h2 class="text-xl font-bold text-[#1a262a]">{{ __('app.filter_projects') }}</h2>
                </div>

                <form method="GET" action="{{ route('consultant.portfolio') }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-[#1a262a]">{{ __('app.status_label') }}</label>
                            <select name="status" class="w-full rounded-xl border-gray-200 focus:border-[#2f5c69] focus:ring focus:ring-[#2f5c69]/20 text-sm">
                                <option value="">{{ __('app.all_statuses') }}</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>{{ __('app.status_completed') }}</option>
                                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>{{ __('app.status_in_progress') }}</option>
                                <option value="planning" {{ request('status') == 'planning' ? 'selected' : '' }}>{{ __('app.status_planning') }}</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-[#1a262a]">{{ __('app.type_label') }}</label>
                            <select name="project_type" class="w-full rounded-xl border-gray-200 focus:border-[#2f5c69] focus:ring focus:ring-[#2f5c69]/20 text-sm">
                                <option value="">{{ __('app.all_types') }}</option>
                                <option value="villa" {{ request('project_type') == 'villa' ? 'selected' : '' }}>{{ __('app.type_villa') }}</option>
                                <option value="apartment" {{ request('project_type') == 'apartment' ? 'selected' : '' }}>{{ __('app.type_apartment') }}</option>
                                <option value="building" {{ request('project_type') == 'building' ? 'selected' : '' }}>{{ __('app.type_building') }}</option>
                                <option value="commercial" {{ request('project_type') == 'commercial' ? 'selected' : '' }}>{{ __('app.type_commercial') }}</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-[#1a262a]">{{ __('app.year_label') }}</label>
                            <select name="year" class="w-full rounded-xl border-gray-200 focus:border-[#2f5c69] focus:ring focus:ring-[#2f5c69]/20 text-sm">
                                <option value="">{{ __('app.all_years') }}</option>
                                <option value="2024" {{ request('year') == '2024' ? 'selected' : '' }}>2024</option>
                                <option value="2023" {{ request('year') == '2023' ? 'selected' : '' }}>2023</option>
                                <option value="2022" {{ request('year') == '2022' ? 'selected' : '' }}>2022</option>
                                <option value="2021" {{ request('year') == '2021' ? 'selected' : '' }}>2021</option>
                            </select>
                        </div>

                        <div>
                            <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl bg-[#1a262a] text-white font-semibold hover:bg-[#2f5c69] transition-all shadow-md">
                                <i class="fas fa-search"></i>
                                {{ __('app.filter_btn') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            @if(isset($portfolio) && $portfolio->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($portfolio as $project)
                        <div class="group bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                            <div class="relative h-56 bg-gray-100 overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#1a262a]/80 to-transparent z-10 opacity-60 group-hover:opacity-40 transition-opacity"></div>
                                <div class="w-full h-full flex items-center justify-center text-[#2f5c69]/30 bg-[#2f5c69]/5">
                                    <i class="fas fa-building text-5xl"></i>
                                </div>
                                <div class="absolute top-4 right-4 z-20">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/90 text-[#1a262a] shadow-sm backdrop-blur-sm">
                                        {{ $project->year ?? '2024' }}
                                    </span>
                                </div>
                                <div class="absolute bottom-4 right-4 z-20">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold 
                                        {{ ($project->status ?? '') == 'completed' ? 'bg-emerald-500 text-white' : 'bg-[#f3a446] text-[#1a262a]' }}">
                                        {{ $project->status ?? __('app.status_completed') }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6">
                                <h3 class="text-xl font-bold text-[#1a262a] mb-4 line-clamp-1 group-hover:text-[#2f5c69] transition-colors">
                                    {{ $project->title ?? __('app.default_project_title') }}
                                </h3>

                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">{{ __('app.type') }}</p>
                                        <p class="text-sm font-semibold text-[#1a262a] flex items-center gap-1">
                                            <i class="fas fa-tag text-[#f3a446] text-xs"></i>
                                            {{ $project->type ?? __('app.type_villa') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">{{ __('app.area') }}</p>
                                        <p class="text-sm font-semibold text-[#1a262a] flex items-center gap-1">
                                            <i class="fas fa-ruler-combined text-[#f3a446] text-xs"></i>
                                            {{ $project->area ?? '500' }} م²
                                        </p>
                                    </div>
                                </div>

                                <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-2 min-h-[40px]">
                                    {{ $project->description ?? __('app.default_description') }}
                                </p>

                                <div class="flex gap-3">
                                    <a href="#" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-[#1a262a] text-white text-sm font-semibold hover:bg-[#2f5c69] transition-colors">
                                        <i class="fas fa-eye"></i>
                                        {{ __('app.view_details') }}
                                    </a>
                                    <a href="#" class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-gray-200 text-gray-500 hover:bg-gray-50 hover:text-[#1a262a] transition-colors">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-16 text-center">
                    <div class="w-24 h-24 rounded-full bg-gray-50 text-gray-300 flex items-center justify-center text-4xl mx-auto mb-6">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <h3 class="text-xl font-bold text-[#1a262a] mb-2">{{ __('app.no_projects_title') }}</h3>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">{{ __('app.no_projects_desc') }}</p>
                    <a href="{{ route('designs.create') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#1a262a] text-white font-semibold hover:bg-[#2f5c69] transition-all">
                        <i class="fas fa-plus"></i>
                        {{ __('app.add_project_btn') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection