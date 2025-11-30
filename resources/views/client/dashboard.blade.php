@extends('layouts.app')

@section('title', __('app.client_dashboard.title'))

@section('content')
  @if (!Auth::user()->isClient())
    <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
      <div class="text-center max-w-md bg-white p-10 rounded-xl shadow-xl">
        <i class="fas fa-lock text-6xl text-red-500 mb-6"></i>
        <h1 class="text-3xl font-bold text-gray-900 mb-3">
          {{ __('app.client_dashboard.access_denied.title') }}
        </h1>
        <p class="text-gray-600 mb-8 text-lg">
          {{ __('app.client_dashboard.access_denied.message') }}
        </p>
        <a href="{{ Auth::user()->getDashboardRoute() }}" class="btn-primary">
          <i class="fas fa-tachometer-alt me-2"></i>
          {{ __('app.client_dashboard.access_denied.button') }}
        </a>
      </div>
    </div>
  @else
    <div class="min-h-screen bg-gray-50 page-fade-in">
      <div
        class="bg-gradient-to-br from-[#2f5c69] to-[#1a262a] text-white shadow-lg pb-20"
      >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-6">
          <div class="flex justify-between items-center pt-20">
            <div>
              <h1 class="text-3xl font-bold text-white">
                {{ __('app.client_dashboard.header.welcome') }}
                {{ Auth::user()->name }}
              </h1>
              <p class="text-gray-300 mt-2 text-lg">
                {{ __('app.client_dashboard.header.subtitle') }}
              </p>
            </div>
            <div class="flex gap-3">
              
              <a href="{{ route('tenders.index') }}" class="btn-primary">
                <i class="fas fa-list me-2"></i>
                {{ __('app.client_dashboard.header.all_tenders') }}
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
          <div
            class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1"
          >
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div
                  class="w-12 h-12 bg-[#f3a446]/20 rounded-lg flex items-center justify-center border border-[#f3a446]/30 "
                >
                  <i class="fas fa-gavel text-[#f3a446] text-xl"></i>
                </div>
              </div>
              <div class="ms-4">
                <p class="text-sm font-medium text-gray-600">
                  {{ __('app.client_dashboard.stats.tenders_created') }}
                </p>
                <p class="text-3xl font-bold text-gray-900">
                  {{ $stats['tenders_created'] ?? 0 }}
                </p>
              </div>
            </div>
          </div>

          <div
            class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1"
          >
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div
                  class="w-12 h-12 bg-[#f3a446]/20 rounded-lg flex items-center justify-center border border-[#f3a446]/30"
                >
                  <i class="fas fa-file-alt text-[#f3a446] text-xl"></i>
                </div>
              </div>
              <div class="ms-4">
                <p class="text-sm font-medium text-gray-600">
                  {{ __('app.client_dashboard.stats.proposals_received') }}
                </p>
                <p class="text-3xl font-bold text-gray-900">
                  {{ $stats['proposals_received'] ?? 0 }}
                </p>
              </div>
            </div>
          </div>

          <div
            class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1"
          >
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div
                  class="w-12 h-12 bg-[#f3a446]/20 rounded-lg flex items-center justify-center border border-[#f3a446]/30"
                >
                  <i class="fas fa-check-circle text-[#f3a446] text-xl"></i>
                </div>
              </div>
              <div class="ms-4">
                <p class="text-sm font-medium text-gray-600">
                  {{ __('app.client_dashboard.stats.accepted_proposals') }}
                </p>
                <p class="text-3xl font-bold text-gray-900">
                  {{ $stats['accepted_proposals'] ?? 0 }}
                </p>
              </div>
            </div>
          </div>

          <div
            class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1"
          >
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div
                  class="w-12 h-12 bg-[#f3a446]/20 rounded-lg flex items-center justify-center border border-[#f3a446]/30"
                >
                  <i class="fas fa-clock text-[#f3a446] text-xl"></i>
                </div>
              </div>
              <div class="ms-4">
                <p class="text-sm font-medium text-gray-600">
                  {{ __('app.client_dashboard.stats.active_tenders') }}
                </p>
                <p class="text-3xl font-bold text-gray-900">
                  {{ $stats['active_tenders'] ?? 0 }}
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
          <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
              <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-xl font-bold text-gray-900">
                  {{ __('app.client_dashboard.recent_activities.title') }}
                </h3>
              </div>
              <div class="p-6">
                @if (count($recentActivities) > 0)
                  <div class="space-y-5">
                    @foreach ($recentActivities as $activity)
                      <div class="flex items-start gap-3">
                        <div class="flex-shrink-0">
                          <div
                            class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center"
                          >
                            <i class="fas fa-info text-gray-500"></i>
                          </div>
                        </div>
                        <div class="flex-1 min-w-0">
                          <p class="text-sm text-gray-800">
                            {{ $activity['description'] }}
                          </p>
                          <p class="text-sm text-gray-500 mt-1">
                            {{ $activity['time'] }}
                          </p>
                        </div>
                      </div>
                    @endforeach
                  </div>
                @else
                  <div class="text-center py-10">
                    <i class="fas fa-inbox text-5xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">
                      {{ __('app.client_dashboard.recent_activities.empty') }}
                    </p>
                  </div>
                @endif
              </div>
            </div>
          </div>

          <div class="lg:col-span-1 space-y-8">
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
              <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-xl font-bold text-gray-900">
                  {{ __('app.client_dashboard.quick_actions.title') }}
                </h3>
              </div>
              <div class="p-6">
                <div class="space-y-3">
                  
                  <a
                    href="{{ route('client.my-tenders') }}"
                    class="flex items-center p-4 rounded-lg border border-gray-200 hover:bg-[#f3a446]/10 hover:border-[#f3a446]/30 transition-colors duration-200"
                  >
                    <i class="fas fa-list text-[#2f5c69] me-3"></i>
                    <span class="text-sm font-medium text-gray-800">{{
                      __('app.client_dashboard.quick_actions.my_tenders')
                    }}</span>
                  </a>
                
                  <a
                    href="{{ route('designs.index') }}"
                    class="flex items-center p-4 rounded-lg border border-gray-200 hover:bg-[#f3a446]/10 hover:border-[#f3a446]/30 transition-colors duration-200"
                  >
                    <i class="fas fa-home text-[#2f5c69] me-3"></i>
                    <span class="text-sm font-medium text-gray-800">{{
                      __('app.client_dashboard.quick_actions.browse_designs')
                    }}</span>
                  </a>
                  <a
                    href="{{ route('client.profile') }}"
                    class="flex items-center p-4 rounded-lg border border-gray-200 hover:bg-[#f3a446]/10 hover:border-[#f3a446]/30 transition-colors duration-200"
                  >
                    <i class="fas fa-user text-[#2f5c69] me-3"></i>
                    <span class="text-sm font-medium text-gray-800">{{
                      __('app.client_dashboard.quick_actions.edit_profile')
                    }}</span>
                  </a>
                </div>
              </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
              <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-xl font-bold text-gray-900">
                  {{ __('app.client_dashboard.recommended.title') }}
                </h3>
              </div>
              <div class="p-6">
                @if (count($recommendedConsultants) > 0)
                  <div class="space-y-4">
                    @foreach ($recommendedConsultants as $consultant)
                      <div class="flex items-center gap-3">
                        <div class="flex-shrink-0">
                          <div
                            class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center"
                          >
                            <i class="fas fa-user text-gray-500"></i>
                          </div>
                        </div>
                        <div class="flex-1 min-w-0">
                          <p class="text-sm font-medium text-gray-800">
                            {{ $consultant['name'] }}
                          </p>
                          <p class="text-sm text-gray-500">
                            {{ $consultant['specialization'] }}
                          </p>
                        </div>
                        <button
                          class="text-[#2f5c69] hover:text-[#f3a446] transition-colors"
                        >
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                    @endforeach
                  </div>
                @else
                  <div class="text-center py-4">
                    <p class="text-gray-500 text-sm">
                      {{ __('app.client_dashboard.recommended.empty') }}
                    </p>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <style>
      @layer components {
        .btn-primary {
          @apply inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-bold rounded-lg text-gray-900 bg-[#f3a446] hover:bg-[#e6983c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-[#f3a446] transition-all duration-300 transform hover:scale-105 shadow-lg shadow-[#f3a446]/30;
        }

        .btn-secondary {
          @apply inline-flex items-center px-5 py-2.5 border border-gray-300 text-sm font-medium rounded-lg text-[#2f5c69] bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2f5c69]/50 transition-all duration-300;
        }

        .btn-secondary-light {
          @apply inline-flex items-center px-5 py-2.5 border border-white/30 text-sm font-medium rounded-lg text-white bg-white/10 hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[#1a262a] focus:ring-white transition-all duration-300;
        }
      }

      .page-fade-in {
        animation: fadeIn 0.6s ease-out;
      }

      @keyframes fadeIn {
        from {
          opacity: 0;
          transform: translateY(20px);
        }

        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
    </style>
  @endif
@endsection