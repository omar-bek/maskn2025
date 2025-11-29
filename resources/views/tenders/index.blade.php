@extends('layouts.app')

@section('title', 'المناقصات - انشاءات')

@section('content')
<style>
    .hero-title-gradient {
        background: linear-gradient(90deg, #f3a446 0%, #ffffff 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
    }

     @media (min-width:768px) {
    .home {
        border-radius: 100px;
    }
    }

       @media (max-width:768px) {
        .designs-hero{
            border-radius:0;
            margin-top:0;
            width:100%;
        }
        .home{
         margin-top:0;

        }
        
    }

    


</style>

<div class="designs-hero bg-gray-100 w-[80%] m-auto">
  <div
    class="home relative bg-gradient-to-br from-[#2f5c69] to-[#1a262a] text-white overflow-hidden mt-[100px]"
  >
    <div class="absolute inset-0 opacity-10">
      <div
        class="absolute inset-0"
        style="
          background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><defs><pattern id=\"grid\" width=\"10\" height=\"10\" patternUnits=\"userSpaceOnUse\"><path d=\"M 10 0 L 0 0 0 10\" fill=\"none\" stroke=\"white\" stroke-width=\"0.5\"/></pattern></defs><rect width=\"100\" height=\"100\" fill=\"url(%23grid)\"/></svg>');
        "
      ></div>
    </div>

    <div
      class="absolute top-10 left-10 w-20 h-20 bg-[#f3a446]/10 rounded-full animate-pulse"
    ></div>
    <div
      class="absolute top-32 right-20 w-16 h-16 bg-[#f3a446]/5 rounded-full animate-bounce"
    ></div>
    <div
      class="absolute bottom-20 left-1/4 w-12 h-12 bg-[#f3a446]/10 rounded-full animate-pulse"
      style="animation-delay: 1s"
    ></div>

    <div class="max-w-7xl mt-20 lg:mt-0 mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
      <div class="text-center">
        <div
          class="inline-flex items-center bg-[#f3a446]/20 backdrop-blur-sm rounded-full px-6 py-3 mb-6 -mt-12 border border-[#f3a446]/30"
        >
          <i class="fas fa-file-contract text-[#f3a446] text-2xl ml-3 mr-2 "></i>
          <span class="text-lg font-semibold text-white">{{
            __("app.tenders_hero.badge")
          }}</span>
        </div>

        <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
          <span class="hero-title-gradient">
            {{ __("app.tenders_hero.title") }}
          </span>
        </h1>

        <p
          class="text-lg md:text-xl text-gray-300 mb-10 max-w-3xl mx-auto leading-relaxed"
        >
          {{ __("app.tenders_hero.subtitle") }}
        </p>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
          <div
            class="bg-[#f3a446]/10 backdrop-blur-sm rounded-2xl p-4 border border-[#f3a446]/20 hover:bg-[#f3a446]/20 transition-all duration-300"
          >
            <div class="text-2xl font-bold mb-2">
              {{ $tenders->total() ?? 0 }}
            </div>
            <div class="text-sm text-gray-300">
              {{ __("app.tenders_hero.stats.active_tenders") }}
            </div>
          </div>
          <div
            class="bg-[#f3a446]/10 backdrop-blur-sm rounded-2xl p-4 border border-[#f3a446]/20 hover:bg-[#f3a446]/20 transition-all duration-300"
          >
            <div class="text-2xl font-bold mb-2">24/7</div>
            <div class="text-sm text-gray-300">
              {{ __("app.tenders_hero.stats.always_available") }}
            </div>
          </div>
          <div
            class="bg-[#f3a446]/10 backdrop-blur-sm rounded-2xl p-4 border border-[#f3a446]/20 hover:bg-[#f3a446]/20 transition-all duration-300"
          >
            <div class="text-2xl font-bold mb-2">100%</div>
            <div class="text-sm text-gray-300">
              {{ __("app.tenders_hero.stats.transparency") }}
            </div>
          </div>
          <div
            class="bg-[#f3a446]/10 backdrop-blur-sm rounded-2xl p-4 border border-[#f3a446]/20 hover:bg-[#f3a446]/20 transition-all duration-300"
          >
            <div class="text-2xl font-bold mb-2">
              {{ __("app.tenders_hero.stats.security_value") }}
            </div>
            <div class="text-sm text-gray-300">
              {{ __("app.tenders_hero.stats.security_label") }}
            </div>
          </div>
        </div>

       
      </div>
    </div>
  </div>
</div>
<div class="home2 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 mt-8">
  <div
    class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl p-8 mb-10 border border-gray-200/50 relative overflow-hidden"
  >
    <div
      class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-[#2f5c69]/10 to-transparent rounded-full opacity-50"
    ></div>
    <div
      class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-[#f3a446]/10 to-transparent rounded-full opacity-50"
    ></div>

    <div class="relative z-10">
    <div class="flex items-center mb-8">
      <div
        class="w-16 h-16 bg-[#2f5c69] rounded-2xl flex items-center justify-center me-4 shadow-lg"
      >
        <i class="fas fa-filter text-white text-xl"></i>
      </div>
      <div>
        <h3 class="text-2xl font-bold text-gray-900 mb-2">
          {{ __("app.tenders_filter.title") }}
        </h3>
        <p class="text-gray-600">
          {{ __("app.tenders_filter.subtitle") }}
        </p>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="space-y-3">
        <label class="text-sm font-bold text-gray-800 flex items-center">
          <i class="fas fa-search text-[#2f5c69] me-2"></i>
          {{ __("app.tenders_filter.search_label") }}
        </label>
        <div class="relative group">
          <input
            type="text"
            id="searchInput"
            placeholder="{{ __('app.tenders_filter.search_placeholder') }}"
            class="w-full border-2 border-gray-200 rounded-2xl ps-10 pe-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 backdrop-blur-sm group-hover:bg-white group-hover:shadow-lg"
          />
          <div class="absolute inset-y-0 start-0 ps-4 flex items-center">
            <i
              class="fas fa-search text-gray-400 group-hover:text-[#f3a446] transition-colors duration-300"
            ></i>
          </div>
        </div>
      </div>

      <div class="space-y-3">
    <label class="text-sm font-bold text-gray-800 flex items-center">
      <i class="fas fa-flag text-[#2f5c69] me-2"></i>
      {{ __("app.tenders_filter.status_label") }}
    </label>
    <div class="relative group">
      <select
        id="statusFilter"
        class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 backdrop-blur-sm group-hover:bg-white group-hover:shadow-lg appearance-none cursor-pointer"
      >
        <option value="">{{ __("app.all") }}</option>
        <option value="open">{{ __("app.open") }}</option>
        <option value="closed">{{ __("app.closed") }}</option>
        <option value="awarded">{{ __("app.awarded") }}</option>
      </select>
      <div
        class="absolute inset-y-0 end-0 pe-4 flex items-center pointer-events-none"
      >
        <i class="fas fa-chevron-down text-gray-400"></i>
      </div>
    </div>
  </div>

      <div class="space-y-3">
        <label class="text-sm font-bold text-gray-800 flex items-center">
          <i class="fas fa-map-marker-alt text-[#2f5c69] me-2"></i>
          {{ __("app.tenders_filter.location_label") }}
        </label>
        <div class="relative group">
          <input
            type="text"
            id="locationFilter"
            placeholder="{{ __('app.tenders_filter.location_placeholder') }}"
            class="w-full border-2 border-gray-200 rounded-2xl ps-10 pe-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 backdrop-blur-sm group-hover:bg-white group-hover:shadow-lg"
          />
          <div class="absolute inset-y-0 start-0 ps-4 flex items-center">
            <i
              class="fas fa-map-marker-alt text-gray-400 group-hover:text-[#f3a446] transition-colors duration-300"
            ></i>
          </div>
        </div>
      </div>

      <div class="flex items-end">
        <button
          onclick="applyFilters()"
          class="w-full bg-[#2f5c69] hover:bg-[#1a262a] text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl group"
        >
          <i
            class="fas fa-search me-3 text-xl group-hover:scale-110 transition-transform duration-300"
          ></i>
          {{ __("app.tenders_filter.apply_button") }}
        </button>
      </div>
    </div>

    <div class="mt-6 pt-6 border-t border-gray-200">
      <div class="flex items-center mb-4">
        <i class="fas fa-tags text-gray-600 me-2"></i>
        <span class="text-sm font-semibold text-gray-700">{{
          __("app.tenders_filter.quick_filter_label")
        }}</span>
      </div>
      <div class="flex flex-wrap gap-3">
        <button
          onclick="setQuickFilter('open')"
          class="quick-filter-btn bg-[#2f5c69]/10 text-[#2f5c69] hover:bg-[#2f5c69]/20 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300"
        >
          <i class="fas fa-circle text-xs me-2"></i>
          {{ __("app.open") }}
        </button>
        <button
          onclick="setQuickFilter('closed')"
          class="quick-filter-btn bg-red-100 text-red-800 hover:bg-red-200 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300"
        >
          <i class="fas fa-lock text-xs me-2"></i>
          {{ __("app.closed") }}
        </button>
        <button
          onclick="setQuickFilter('awarded')"
          class="quick-filter-btn bg-blue-100 text-blue-800 hover:bg-blue-200 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300"
        >
          <i class="fas fa-trophy text-xs me-2"></i>
          {{ __("app.awarded") }}
        </button>
        <button
          onclick="clearFilters()"
          class="quick-filter-btn bg-gray-100 text-gray-800 hover:bg-gray-200 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300"
        >
          <i class="fas fa-times text-xs me-2"></i>
          {{ __("app.tenders_filter.clear_button") }}
        </button>
      </div>
    </div>
  </div>
  </div>

 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="tendersGrid">
    @forelse($tenders as $tender)
      <div
        class="bg-white rounded-3xl shadow-2xl hover:shadow-3xl overflow-hidden tender-card transform hover:scale-[1.02] transition-all duration-500 border-2 border-transparent hover:border-[#f3a446] group relative"
        data-title="{{ $tender->title }}"
        data-status="{{ $tender->status }}"
        data-location="{{ $tender->location }}"
      >
        <div
          class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-bl from-[#2f5c69]/10 to-transparent rounded-full opacity-50"
        ></div>

        <div class="relative h-48 overflow-hidden">
          <img
            src="{{ $tender->design->main_image_url }}"
            alt="{{ $tender->title }}"
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
          />
          <div
            class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"
          ></div>

          <div class="absolute top-5 left-5">
            @if ($tender->status === 'open')
              <span
                class="status-badge bg-[#2f5c69] text-white w-28 h-10 flex items-center justify-center rounded-2xl text-sm font-bold shadow-2xl border-2 border-white/20 backdrop-blur-sm animate-pulse"
              >
                <i class="fas fa-circle text-xs pr-1 pl-1"></i>
                {{ __("app.open") }}
              </span>
            @elseif($tender->status === 'closed')
              <span
                class="status-badge bg-red-600 text-white w-28 h-10 flex items-center justify-center rounded-2xl text-sm font-bold shadow-2xl border-2 border-white/20 backdrop-blur-sm"
              >
                <i class="fas fa-times-circle text-xs pr-1 pl-1"></i>
                {{ __("app.closed") }}
              </span>
            @elseif($tender->status === 'awarded')
              <span
                class="status-badge bg-blue-600 text-white w-28 h-10 flex items-center justify-center rounded-2xl text-sm font-bold shadow-2xl border-2 border-white/20 backdrop-blur-sm"
              >
                <i class="fas fa-trophy text-xs pr-1 pl-1"></i>
                {{ __("app.awarded") }}
              </span>
            @endif
          </div>

          <div class="absolute top-5 right-5">
            <div
              class="bg-white/95 backdrop-blur-md text-gray-800 w-28 h-10 flex items-center justify-center rounded-2xl text-sm font-bold shadow-xl border border-white/50"
            >
              <i class="fas fa-file-alt text-[#2f5c69] pr-1 pl-1"></i>
              {{ $tender->proposals_count }}
              {{ __("app.tenders_list.proposal_unit") }}
            </div>
          </div>

          @if ($tender->days_remaining !== null && $tender->status === 'open')
            <div class="absolute bottom-5 left-5">
              <div
                class="bg-white/95 backdrop-blur-md text-gray-800 px-4 py-2.5 rounded-2xl text-sm font-bold shadow-xl border border-white/50"
              >
                <i
                  class="fas fa-clock ml-2 text-{{ $tender->days_remaining > 7 ? 'green' : ($tender->days_remaining > 3 ? 'yellow' : 'red') }}-600"
                ></i>
                {{ $tender->days_remaining }}
                {{ __("app.tenders_list.days_remaining") }}
              </div>
            </div>
          @endif

          <div
            class="absolute inset-0 bg-gradient-to-t from-[#f3a446]/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"
          ></div>
        </div>

        <div class="p-6 relative z-10">
          <h3
            class="text-2xl font-bold text-gray-900 mb-4 line-clamp-1 leading-tight group-hover:text-[#f3a446] transition-colors duration-300"
          >
            {{ $tender->title }}
          </h3>
          <p class="text-gray-600 text-sm mb-5 line-clamp-2 leading-relaxed">
            {{ Str::limit($tender->description, 120) }}
          </p>

          <div class="grid grid-cols-2 gap-x-4 gap-y-3 mb-5">
            <div class="flex items-center">
              <i
                class="fas fa-user text-[#2f5c69] ml-3 text-lg w-5 text-center"
              ></i>
              <span class="text-sm font-bold text-gray-900 truncate">{{
                $tender->client->name
              }}</span>
            </div>

            <div class="flex items-center">
              <i
                class="fas fa-map-marker-alt text-[#2f5c69] ml-3 text-lg w-5 text-center"
              ></i>
              <span class="text-sm font-bold text-gray-900 truncate">{{
                $tender->location
              }}</span>
            </div>

            @if ($tender->budget)
              <div class="flex items-center">
                <i
                  class="fas fa-money-bill-wave text-green-600 ml-3 text-lg w-5 text-center"
                ></i>
                <span class="text-sm font-bold text-green-600 truncate pl-2">{{
                  $tender->formatted_budget
                }}</span>
              </div>
            @endif

            <div class="flex items-center">
              <i
                class="fas fa-calendar-alt text-purple-600 ml-3 text-lg w-5 text-center"
              ></i>
              <span class="text-sm font-bold text-gray-900 truncate">{{
                $tender->formatted_deadline
              }}</span>
            </div>
          </div>
<div class="flex justify-center gap-4 w-full mt-4">
    <a href="{{ route('tenders.show', $tender->id) }}"
        class="flex items-center justify-center bg-[#f3a446] text-[#1a262a] py-3 px-6 rounded-2xl font-bold text-sm transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl hover:bg-[#f5b05a] group min-w-[140px] whitespace-nowrap">
        <i class="fas fa-eye mr-2 rtl:ml-2 rtl:mr-0 text-base group-hover:scale-110 transition-transform duration-300"></i>
        {{ __('app.tenders_list.view_details_button') }}
    </a>

    @auth
        @if (auth()->user()->isConsultant() && $tender->status === 'open')
            <a href="{{ route('proposals.create', $tender->id) }}"
                class="flex items-center justify-center bg-transparent text-[#2f5c69] border-2 border-[#2f5c69] hover:bg-[#2f5c69] hover:text-white py-3 px-6 rounded-2xl font-bold text-sm transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl group min-w-[140px] whitespace-nowrap">
                <i class="fas fa-paper-plane mr-2 rtl:ml-2 rtl:mr-0 text-base group-hover:scale-110 transition-transform duration-300"></i>
                {{ __('app.tenders_list.submit_proposal_button') }}
            </a>
        @endif
    @endauth
</div>
        </div>
      </div>
    @empty
      <div class="col-span-full">
        <div
          class="bg-white rounded-2xl shadow-xl p-12 text-center border border-gray-100"
        >
          <div
            class="w-24 h-24 bg-gradient-to-r from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6"
          >
            <i class="fas fa-inbox text-4xl text-gray-400"></i>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-4">
            {{ __("app.tenders_empty.title") }}
          </h3>
          <p class="text-gray-600 text-lg mb-8">
            {{ __("app.tenders_empty.subtitle") }}
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button
              onclick="clearFilters()"
              class="bg-[#f3a446] hover:bg-[#f5b05a] text-[#1a262a] px-8 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg"
            >
              <i class="fas fa-refresh ml-2"></i>
              {{ __("app.tenders_empty.clear_filters_button") }}
            </button>
            @auth
              @if (auth()->user()->isClient())
                <a
                  href="{{ route('tenders.create') }}"
                  class="bg-[#2f5c69] hover:bg-[#1a262a] text-white px-8 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg"
                >
                  <i class="fas fa-plus ml-2"></i>
                  {{ __("app.tenders_empty.create_tender_button") }}
                </a>
              @endif
            @endauth
          </div>
        </div>
      </div>
    @endforelse
  </div>
  @if ($tenders->hasPages())
    <div class="mt-12 flex justify-center">
      <div class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100">
        {{ $tenders->links() }}
      </div>
    </div>
  @endif
</div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced filter functionality
            window.applyFilters = function() {
                const searchTerm = document.getElementById('searchInput').value.toLowerCase();
                const statusFilter = document.getElementById('statusFilter').value;
                const locationFilter = document.getElementById('locationFilter').value.toLowerCase();

                const cards = document.querySelectorAll('.tender-card');
                let visibleCount = 0;

                cards.forEach((card, index) => {
                    const title = card.dataset.title.toLowerCase();
                    const status = card.dataset.status;
                    const location = card.dataset.location.toLowerCase();

                    const matchesSearch = title.includes(searchTerm);
                    const matchesStatus = !statusFilter || status === statusFilter;
                    const matchesLocation = location.includes(locationFilter);

                    if (matchesSearch && matchesStatus && matchesLocation) {
                        card.style.display = 'block';
                        card.style.animation = `fadeInUp 0.5s ease-out ${index * 0.1}s both`;
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Show/hide empty state with animation
                const emptyState = document.querySelector('.col-span-full');
                if (emptyState) {
                    if (visibleCount === 0) {
                        emptyState.style.display = 'block';
                        emptyState.style.animation = 'fadeIn 0.5s ease-out';
                    } else {
                        emptyState.style.display = 'none';
                    }
                }

                // Update results counter
                updateResultsCounter(visibleCount);
            };

            // Quick filter function
            window.setQuickFilter = function(status) {
                document.getElementById('statusFilter').value = status;

                // Update quick filter buttons
                document.querySelectorAll('.quick-filter-btn').forEach(btn => {
                    btn.classList.remove('ring-2', 'ring-teal-500', 'bg-teal-100', 'text-teal-800');
                });

                if (status) {
                    const activeBtn = document.querySelector(`[onclick="setQuickFilter('${status}')"]`);
                    if (activeBtn) {
                        activeBtn.classList.add('ring-2', 'ring-teal-500', 'bg-teal-100', 'text-teal-800');
                    }
                }

                applyFilters();
            };

            // Clear filters function
            window.clearFilters = function() {
                document.getElementById('searchInput').value = '';
                document.getElementById('statusFilter').value = '';
                document.getElementById('locationFilter').value = '';

                // Reset quick filter buttons
                document.querySelectorAll('.quick-filter-btn').forEach(btn => {
                    btn.classList.remove('ring-2', 'ring-teal-500', 'bg-teal-100', 'text-teal-800');
                });

                applyFilters();
            };


            // Real-time search with debounce
            let searchTimeout;
            document.getElementById('searchInput').addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(applyFilters, 300);
            });

            document.getElementById('statusFilter').addEventListener('change', applyFilters);
            document.getElementById('locationFilter').addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(applyFilters, 300);
            });

            // Initialize filters
            applyFilters();
        });
    </script>

  
@endsection
