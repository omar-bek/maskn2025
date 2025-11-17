@extends('layouts.app')
@section('title', 'انشاءات - منصة التصميم والبناء الرائدة')
@section('content')


<section class="hero-section bg-[#2f5c69] text-white relative pt-20 pb-12 lg:rounded-b-[50px] border-b-8 border-b-[#f3a446]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class=" animate-fade-in">
                

                <h1 class="text-5xl lg:text-6xl font-extrabold mb-6 leading-tight text-white">
                    {{ __('app.hero_title_line1') }}
                    <span class="text-[#f3a446]">{{ __('app.hero_title_line2') }}</span>
                </h1>

                <p class="text-xl text-gray-300 mb-10 leading-relaxed">
                    {{ __('app.hero_description') }}
                </p>

                <div class="flex flex-col sm:flex-row-reverse gap-4 justify-end">
                    <a href="{{ route('designs.index') }}"
                        class="bg-transparent text-white border-2 border-white font-bold text-lg py-3 px-8 rounded-lg shadow-sm hover:bg-white hover:text-[#2f5c69] transition-colors flex items-center justify-center gap-2">
                        <i class="fas fa-eye"></i>
                        {{ __('app.browse_designs') }}
                    </a>

                    @auth
                        @if (auth()->user()->isConsultant())
                            <a href="{{ route('designs.create') }}"
                                class="bg-[#f3a446] text-white font-bold text-lg py-3 px-8 rounded-lg shadow-md hover:bg-[#e6953a] transition-colors flex items-center justify-center gap-2">
                                <i class="fas fa-plus"></i>
                                {{ __('app.create_design') }}
                            </a>
                        @else
                            <a href="{{ route('tenders.create') }}"
                                class="bg-[#f3a446] text-white font-bold text-lg py-3 px-8 rounded-lg shadow-md hover:bg-[#e6953a] transition-colors flex items-center justify-center gap-2">
                                <i class="fas fa-file-contract"></i>
                                {{ __('app.create_tender') }}
                            </a>
                        @endif
                    @else
                        <a href="{{ route('register') }}"
                            class="bg-[#f3a446] text-white font-bold text-lg py-3 px-8 rounded-lg shadow-md hover:bg-[#e6953a] transition-colors flex items-center justify-center gap-2">
                            <i class="fas fa-user-plus"></i>
                            {{ __('app.join_now') }}
                        </a>
                    @endauth
                    
                    <button class="bg-white text-[#2f5c69] w-14 h-14 rounded-full flex items-center justify-center shadow-md hover:bg-gray-200 transition-colors">
                        <i class="fas fa-play"></i>
                    </button>
                </div>
            </div>

            <div class="relative animate-slide-in flex items-center justify-center min-h-[350px] lg:min-h-[500px]">

                <img src="{{ asset('images/home3.png') }}"
                        alt="{{ __('app.hero_image_alt') }}"
                        class="relative z-10 w-[260px] h-[260px] lg:w-[350px] lg:h-[350px] object-cover rounded-full shadow-2xl transition-transform duration-500 hover:rotate-3">

                <div class="absolute w-[310px] h-[310px] lg:w-[420px] lg:h-[420px] border-2 border-[#f3a446]/60 rounded-full animate-pulse">

                    <div class="absolute -top-4 right-10 lg:right-16 group">
                        <div class="w-12 h-12 lg:w-14 lg:h-14 bg-[#f3a446] text-white rounded-full flex items-center justify-center text-lg lg:text-xl shadow-lg 
                                    transition-all duration-300 group-hover:scale-110 group-hover:shadow-orange-400/50">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <span class="absolute opacity-0 group-hover:opacity-100 transition-all bg-[#1c3944] text-white 
                                    font-semibold text-xs px-3 py-1 rounded-md bottom-[65px] lg:bottom-[70px] right-1/2 translate-x-1/2 shadow-md whitespace-nowrap">
                            {{ __('app.certified_consultants') }}
                        </span>
                    </div>

                    <div class="absolute -bottom-4 left-10 lg:left-16 group">
                        <div class="w-12 h-12 lg:w-14 lg:h-14 bg-[#f1f7ff] border border-gray-200 text-[#2f5c69] rounded-full flex items-center justify-center text-lg lg:text-xl shadow-lg 
                                    transition-all duration-300 group-hover:scale-110 group-hover:shadow-blue-300/60">
                            <i class="fas fa-tools"></i>
                        </div>
                        <span class="absolute opacity-0 group-hover:opacity-100 transition-all bg-[#1c3944] text-white 
                                    font-semibold text-xs px-3 py-1 rounded-md top-[65px] lg:top-[70px] left-1/2 -translate-x-1/2 shadow-md whitespace-nowrap">
                            {{ __('app.trusted_contractors') }}
                        </span>
                    </div>

                    <div class="absolute top-1/2 -left-6 lg:-left-8 transform -translate-y-1/2 group">
                        <div class="w-12 h-12 lg:w-14 lg:h-14 bg-[#f3a446] text-white rounded-full flex items-center justify-center text-lg lg:text-xl shadow-lg 
                                    transition-all duration-300 group-hover:scale-110 group-hover:shadow-orange-400/50">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <span class="absolute opacity-0 group-hover:opacity-100 transition-all bg-[#1c3944] text-white 
                                    font-semibold text-xs px-3 py-1 rounded-md left-[-30px] top-1/2 -translate-y-1/2 shadow-md whitespace-nowrap">
                            {{ __('app.request_service') }}
                        </span>
                    </div>

                    <div class="absolute top-1/2 -right-6 lg:-right-8 transform -translate-y-1/2 group">
                        <div class="w-12 h-12 lg:w-14 lg:h-14 bg-[#f1f7ff] text-[#2f5c69] rounded-full flex items-center justify-center text-lg lg:text-xl shadow-lg 
                                    transition-all duration-300 group-hover:scale-110 group-hover:shadow-blue-300/60">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <span class="absolute opacity-0 group-hover:opacity-100 transition-all bg-[#1c3944] text-white 
                                    font-semibold text-xs px-3 py-1 rounded-md right-[-30px] top-1/2 -translate-y-1/2 shadow-md whitespace-nowrap">
                            {{ __('app.fast_performance') }}
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <a href="#stats-section" class="scroll-down-button">
        <i class="fas fa-chevron-down"></i>
    </a>
</section>

<style>
    .slanted-bar {
        position: relative;
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
    }

    .top-slant-strip {
        height: 6px;
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0 60%);
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        z-index: 20;
    }

    .stat-number {
        font-family: 'Cairo', sans-serif;
        color: #2f5c69;
        transition: color 0.3s ease;
    }
    
    .stat-label {
        font-family: 'Cairo', sans-serif;
        color: #3c6f7d;
        font-weight: 700;
    }

.scroll-down-button {
    position: absolute;
    bottom: -40px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 30;
    width: 80px;
    height: 80px;
    
    background-color: #2f5c69; 
    
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    text-decoration: none;
    transition: transform 0.3s ease;

    border: 4px solid transparent;

    background-image: 
        linear-gradient(#2f5c69, #2f5c69), 
        conic-gradient(from 90deg, #f3a446 0deg 180deg, transparent 180deg 360deg);
    
    background-origin: border-box;
    background-clip: padding-box, border-box;
}

.scroll-down-button:hover {
    transform: translateX(-50%) scale(1.1);
}

.scroll-down-button i {
     animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-8px);
    }
    60% {
        transform: translateY(-4px);
    }
}

@media (max-width: 768px) {
    .scroll-down-button {
        width: 50px;
        height: 50px;
        bottom: -25px;
        font-size: 1rem;
    }
}
    .scroll-down-button:hover {
        transform: translateX(-50%) scale(1.1);
    }

    .scroll-down-button i {
         animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-8px);
        }
        60% {
            transform: translateY(-4px);
        }
    }
    
    @media (max-width: 768px) {
        .scroll-down-button {
            width: 50px;
            height: 50px;
            bottom: -25px;
            font-size: 1rem;
        }
    }
</style>

<div class="relative" id="stats-section">
  <div class="top-slant-strip"></div>

  <div class="bg-[#f1f7ff] slanted-bar relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-4 py-4">
        <div class="text-center">
          <div class="text-3xl font-extrabold stat-number mb-0.5">
            {{ number_format($stats['total_consultants']) }}+
          </div>
          <div class="text-xs stat-label uppercase tracking-wider">
            {{ __('app.stats_section.consultants') }}
          </div>
        </div>

        <div class="text-center">
          <div class="text-3xl font-extrabold stat-number mb-0.5">
            {{ number_format($stats['total_projects']) }}+
          </div>
          <div class="text-xs stat-label uppercase tracking-wider">
            {{ __('app.stats_section.projects') }}
          </div>
        </div>

        <div class="text-center">
          <div class="text-3xl font-extrabold stat-number mb-0.5">
            {{ number_format($stats['total_designs']) }}+
          </div>
          <div class="text-xs stat-label uppercase tracking-wider">
            {{ __('app.stats_section.designs') }}
          </div>
        </div>

        <div class="text-center">
          <div class="text-3xl font-extrabold stat-number mb-0.5">
            {{ __('app.stats_section.support_stat') }}
          </div>
          <div class="text-xs stat-label uppercase tracking-wider">
            {{ __('app.stats_section.support_label') }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


    <!-- Features Section -->
<section class="py-20 bg-neutral-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <h2 class="text-4xl font-bold text-[#2f5c69] mb-4 tracking-tight">
        {{ __('app.why_choose_us.title') }}
        <span class="text-[#f3a446]">{{ __('app.why_choose_us.platform_name') }}</span>
      </h2>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto">
        {{ __('app.why_choose_us.subtitle') }}
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-8">
      <div
        class="feature-card animate-slideInLeft border-accent-blue group relative bg-white p-8 rounded-3xl shadow-lg overflow-hidden transition-all duration-300 ease-in-out hover:-translate-y-2 hover:shadow-2xl hover:shadow-[#f3a446]/20 lg:col-span-2"
      >
        <div
          class="w-16 h-16 bg-gradient-to-br from-[#2f5c69] to-[#3c6f7d] rounded-2xl flex items-center justify-center mb-6 transition-transform duration-300 ease-in-out group-hover:scale-110 group-hover:rotate-[10deg]"
        >
          <i class="fas fa-users text-white text-2xl"></i>
        </div>
        <h3
          class="text-2xl font-bold text-gray-900 mb-4 transition-colors duration-300 group-hover:text-[#2f5c69]"
        >
          {{ __('app.why_choose_us.features.card_1.title') }}
        </h3>
        <p class="text-gray-600 leading-relaxed">
          {{ __('app.why_choose_us.features.card_1.description') }}
        </p>
      </div>

      <div
        class="feature-card animate-slideInRight border-accent-orange group relative bg-white p-8 rounded-3xl shadow-lg overflow-hidden transition-all duration-300 ease-in-out hover:-translate-y-2 hover:shadow-2xl hover:shadow-[#f3a446]/20 lg:col-span-2"
        style="animation-delay: 0.2s"
      >
        <div
          class="w-16 h-16 bg-gradient-to-br from-[#f3a446] to-[#e6953a] rounded-2xl flex items-center justify-center mb-6 transition-transform duration-300 ease-in-out group-hover:scale-110 group-hover:rotate-[10deg]"
        >
          <i class="fas fa-shield-alt text-white text-2xl"></i>
        </div>
        <h3
          class="text-2xl font-bold text-gray-900 mb-4 transition-colors duration-300 group-hover:text-[#2f5c69]"
        >
          {{ __('app.why_choose_us.features.card_2.title') }}
        </h3>
        <p class="text-gray-600 leading-relaxed">
          {{ __('app.why_choose_us.features.card_2.description') }}
        </p>
      </div>

      <div
        class="feature-card animate-slideInLeft border-accent-blue group relative bg-white p-8 rounded-3xl shadow-lg overflow-hidden transition-all duration-300 ease-in-out hover:-translate-y-2 hover:shadow-2xl hover:shadow-[#2f5c69]/20 lg:col-span-2"
        style="animation-delay: 0.3s"
      >
        <div
          class="w-16 h-16 bg-gradient-to-br from-[#2f5c69] to-[#3c6f7d] rounded-2xl flex items-center justify-center mb-6 transition-transform duration-300 ease-in-out group-hover:scale-110 group-hover:rotate-[10deg]"
        >
          <i class="fas fa-mobile-alt text-white text-2xl"></i>
        </div>
        <h3
          class="text-2xl font-bold text-gray-900 mb-4 transition-colors duration-300 group-hover:text-[#2f5c69]"
        >
          {{ __('app.why_choose_us.features.card_3.title') }}
        </h3>
        <p class="text-gray-600 leading-relaxed">
          {{ __('app.why_choose_us.features.card_3.description') }}
        </p>
      </div>

      <div
        class="feature-card animate-fadeInUp border-accent-blue group relative bg-white p-8 rounded-3xl shadow-lg overflow-hidden transition-all duration-300 ease-in-out hover:-translate-y-2 hover:shadow-2xl hover:shadow-[#f3a446]/20 lg:col-span-2 lg:col-start-2"
        style="animation-delay: 0.4s"
      >
        <div
          class="w-16 h-16 bg-gradient-to-br from-[#2f5c69] to-[#3c6f7d] rounded-2xl flex items-center justify-center mb-6 transition-transform duration-300 ease-in-out group-hover:scale-110 group-hover:rotate-[10deg]"
        >
          <i class="fas fa-clock text-white text-2xl"></i>
        </div>
        <h3
          class="text-2xl font-bold text-gray-900 mb-4 transition-colors duration-300 group-hover:text-[#2f5c69]"
        >
          {{ __('app.why_choose_us.features.card_4.title') }}
        </h3>
        <p class="text-gray-600 leading-relaxed">
          {{ __('app.why_choose_us.features.card_4.description') }}
        </p>
      </div>

      <div
        class="feature-card animate-slideInRight border-accent-blue group relative bg-white p-8 rounded-3xl shadow-lg overflow-hidden transition-all duration-300 ease-in-out hover:-translate-y-2 hover:shadow-2xl hover:shadow-[#2f5c69]/20 lg:col-span-2 lg:col-start-4"
        style="animation-delay: 0.5s"
      >
        <div
          class="w-16 h-16 bg-gradient-to-br from-[#2f5c69] to-[#3c6f7d] rounded-2xl flex items-center justify-center mb-6 transition-transform duration-300 ease-in-out group-hover:scale-110 group-hover:rotate-[10deg]"
        >
          <i class="fas fa-headset text-white text-2xl"></i>
        </div>
        <h3
          class="text-2xl font-bold text-gray-900 mb-4 transition-colors duration-300 group-hover:text-[#2f5c69]"
        >
          {{ __('app.why_choose_us.features.card_5.title') }}
        </h3>
        <p class="text-gray-600 leading-relaxed">
          {{ __('app.why_choose_us.features.card_5.description') }}
        </p>
      </div>
    </div>
  </div>
</section>

<style>
  .feature-card::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 65px;
    height: 65px;
    border-top-width: 3px;
    border-right-width: 3px;
    border-top-right-radius: 1.5rem;
    transition: all 0.3s ease;
  }
  .feature-card::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 65px;
    height: 65px;
    border-bottom-width: 3px;
    border-left-width: 3px;
    border-bottom-left-radius: 1.5rem;
    transition: all 0.3s ease;
  }

  .feature-card:hover::before {
    width: 80px;
    height: 80px;
  }
  .feature-card:hover::after {
    width: 80px;
    height: 80px;
  }

  .border-accent-orange::before {
    border-color: #f3a446;
  }
  .border-accent-orange::after {
    border-color: #f3a446;
  }

  .border-accent-blue::before {
    border-color: #2f5c69;
  }
  .border-accent-blue::after {
    border-color: #2f5c69;
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes slideInLeft {
    from {
      opacity: 0;
      transform: translateX(-50px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  @keyframes slideInRight {
    from {
      opacity: 0;
      transform: translateX(50px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  .animate-fadeInUp {
    animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) both;
  }
  .animate-slideInLeft {
    animation: slideInLeft 0.6s cubic-bezier(0.4, 0, 0.2, 1) both;
  }
  .animate-slideInRight {
    animation: slideInRight 0.6s cubic-bezier(0.4, 0, 0.2, 1) both;
  }
</style>


<style>
  @import url("https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap");

  .future-section {
    /* background-color: #2f5c69; */
    display: flex;
    align-items: center;
    overflow: hidden;
    padding-top: 4rem;
    padding-bottom: 4rem;
  }

  @keyframes subtleFloat {
    0% {
      transform: translateY(0);
    }
    50% {
      transform: translateY(-5px);
    }
    100% {
      transform: translateY(0);
    }
  }

  .animate-subtle-float {
    animation: subtleFloat 4s ease-in-out infinite;
  }

  .process-step-modern {
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    background-color: rgba(255, 255, 255, 0.95);
    border-left: 5px solid #f3a446;
    padding: 18px;
  }

  .step-number-small {
    width: 48px;
    height: 48px;
    font-size: 1.125rem;
  }

  .content-green-frame {
    border: 2px solid #f3a446;
    border-radius: 20px;
    padding: 40px 30px;
    background-color: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    background-color: #2f5c69;
  }
</style>

<section class="future-section">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
    <div class="content-green-frame">
      <div class="text-center mb-6">
        <h2
          class="text-3xl font-extrabold text-[#f3a446] mb-2 tracking-tight"
        >
          {{ __('app.how_it_works.title') }}
        </h2>
        <p class="text-md text-gray-200 max-w-2xl mx-auto font-normal">
          {{ __('app.how_it_works.subtitle') }}
        </p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center">
        <div class="space-y-3">
          <div
            class="process-step-modern group flex items-center gap-4 rounded-xl transition-all duration-300 ease-in-out hover:shadow-2xl hover:scale-[1.01]"
          >
            <div
              class="step-number step-number-small flex-shrink-0 flex items-center justify-center rounded-full bg-[#2f5c69] border-2 border-[#f3a446] text-white font-extrabold transition-all duration-300 ease-in-out group-hover:bg-[#f3a446] group-hover:text-[#2f5c69] group-hover:scale-110 group-hover:rotate-3"
            >
              1
            </div>
            <div>
              <h3
                class="text-lg font-bold text-gray-900 mb-0.5 transition-colors duration-300 group-hover:text-[#2f5c69]"
              >
                {{ __('app.how_it_works.steps.step_1.title') }}
              </h3>
              <p class="text-gray-700 text-sm">
                {{ __('app.how_it_works.steps.step_1.description') }}
              </p>
            </div>
          </div>

          <div
            class="process-step-modern group flex items-center gap-4 rounded-xl transition-all duration-300 ease-in-out hover:shadow-2xl hover:scale-[1.01]"
          >
            <div
              class="step-number step-number-small flex-shrink-0 flex items-center justify-center rounded-full bg-[#2f5c69] border-2 border-[#f3a446] text-white font-extrabold transition-all duration-300 ease-in-out group-hover:bg-[#f3a446] group-hover:text-[#2f5c69] group-hover:scale-110 group-hover:rotate-3"
            >
              2
            </div>
            <div>
              <h3
                class="text-lg font-bold text-gray-900 mb-0.5 transition-colors duration-300 group-hover:text-[#2f5c69]"
              >
                {{ __('app.how_it_works.steps.step_2.title') }}
              </h3>
              <p class="text-gray-700 text-sm">
                {{ __('app.how_it_works.steps.step_2.description') }}
              </p>
            </div>
          </div>

          <div
            class="process-step-modern group flex items-center gap-4 rounded-xl transition-all duration-300 ease-in-out hover:shadow-2xl hover:scale-[1.01]"
          >
            <div
              class="step-number step-number-small flex-shrink-0 flex items-center justify-center rounded-full bg-[#2f5c69] border-2 border-[#f3a446] text-white font-extrabold transition-all duration-300 ease-in-out group-hover:bg-[#f3a446] group-hover:text-[#2f5c69] group-hover:scale-110 group-hover:rotate-3"
            >
              3
            </div>
            <div>
              <h3
                class="text-lg font-bold text-gray-900 mb-0.5 transition-colors duration-300 group-hover:text-[#2f5c69]"
              >
                {{ __('app.how_it_works.steps.step_3.title') }}
              </h3>
              <p class="text-gray-700 text-sm">
                {{ __('app.how_it_works.steps.step_3.description') }}
              </p>
            </div>
          </div>

          <div
            class="process-step-modern group flex items-center gap-4 rounded-xl transition-all duration-300 ease-in-out hover:shadow-2xl hover:scale-[1.01]"
          >
            <div
              class="step-number step-number-small flex-shrink-0 flex items-center justify-center rounded-full bg-[#2f5c69] border-2 border-[#f3a446] text-white font-extrabold transition-all duration-300 ease-in-out group-hover:bg-[#f3a446] group-hover:text-[#2f5c69] group-hover:scale-110 group-hover:rotate-3"
            >
              4
            </div>
            <div>
              <h3
                class="text-lg font-bold text-gray-900 mb-0.5 transition-colors duration-300 group-hover:text-[#2f5c69]"
              >
                {{ __('app.how_it_works.steps.step_4.title') }}
              </h3>
              <p class="text-gray-700 text-sm">
                {{ __('app.how_it_works.steps.step_4.description') }}
              </p>
            </div>
          </div>
        </div>

        <div
          class="relative flex justify-center items-center animate-subtle-float"
        >
          <img
            src="{{ asset('images/ensha.png') }}"
            alt="{{ __('app.how_it_works.image_alt') }}"
            class="w-[70%] h-auto object-cover rounded-2xl shadow-xl transition-all duration-500 ease-in-out hover:scale-[1.02] border-2 border-[#f3a446] shadow-[#f3a446]/30"
          />
        </div>
      </div>
    </div>
  </div>
</section>





    <!-- About Us Section -->
   

    <!-- Testimonials Section -->
<style>
  @import url("https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap");

  .modern-section {
    background-color: #f7fcf9;
    position: relative;
    overflow: hidden;
  }

  .modern-section::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    box-shadow: inset 0 0 100px rgba(47, 92, 105, 0.05),
      inset 0 0 50px rgba(243, 164, 70, 0.1);
    pointer-events: none;
    z-index: 0;
  }

  .testimonial-card-modern {
    background-color: #ffffff;
    border: 2px solid #2f5c69;
    border-radius: 16px;
    padding: 40px;
    position: relative;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
  }

  .testimonial-card-modern:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(47, 92, 105, 0.15);
  }

  .heading-primary {
    color: #2f5c69;
    font-weight: 900;
    font-family: "Cairo", sans-serif;
  }

  .sub-heading {
    color: #f3a446;
    font-weight: 700;
    font-family: "Cairo", sans-serif;
  }

  .quote-icon {
    background-color: #2f5c69;
    color: #f3a446;
    box-shadow: 0 0 15px rgba(243, 164, 70, 0.5);
  }

  .star-icon {
    color: #f3a446;
    transition: color 0.3s;
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

  .animate-fade-in-modern {
    animation: fadeIn 0.8s ease-out forwards;
    opacity: 0;
  }
</style>

<section class="py-20 modern-section">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="text-center mb-16">
      <h2 class="text-4xl font-extrabold heading-primary mb-3">
        {{ __('app.testimonials.title') }}
      </h2>
      <p class="text-xl sub-heading">{{ __('app.testimonials.subtitle') }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
      <div
        class="testimonial-card-modern animate-fade-in-modern"
        style="animation-delay: 0s"
      >
        <div class="flex justify-start items-start mb-6">
          <div
            class="w-12 h-12 rounded-full flex items-center justify-center quote-icon"
          >
            <i class="fas fa-quote-right text-lg"></i>
          </div>
        </div>

        <blockquote class="text-gray-700 text-lg mb-8 leading-relaxed font-medium">
          {{ __('app.testimonials.card_1.quote') }}
        </blockquote>

        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-3 space-x-reverse">
            <div
              class="w-14 h-14 rounded-full overflow-hidden border-2 border-[#f3a446]"
            >
              <img
                src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80"
                alt="{{ __('app.testimonials.card_1.alt_text') }}"
                class="w-full h-full object-cover"
              />
            </div>
            <div>
              <div class="font-bold text-gray-900 text-lg">
                {{ __('app.testimonials.card_1.name') }}
              </div>
              <div class="text-gray-600 text-sm">
                {{ __('app.testimonials.card_1.location') }}
              </div>
            </div>
          </div>

          <div class="flex space-x-1 space-x-reverse">
            <i class="fas fa-star star-icon"></i>
            <i class="fas fa-star star-icon"></i>
            <i class="fas fa-star star-icon"></i>
            <i class="fas fa-star star-icon"></i>
            <i class="fas fa-star star-icon"></i>
          </div>
        </div>
      </div>

      <div
        class="testimonial-card-modern animate-fade-in-modern"
        style="animation-delay: 0.2s"
      >
        <div class="flex justify-start items-start mb-6">
          <div
            class="w-12 h-12 rounded-full flex items-center justify-center quote-icon"
          >
            <i class="fas fa-quote-right text-lg"></i>
          </div>
        </div>

        <blockquote class="text-gray-700 text-lg mb-8 leading-relaxed font-medium">
          {{ __('app.testimonials.card_2.quote') }}
        </blockquote>

        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-3 space-x-reverse">
            <div
              class="w-14 h-14 rounded-full overflow-hidden border-2 border-[#f3a446]"
            >
              <img
                src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80"
                alt="{{ __('app.testimonials.card_2.alt_text') }}"
                class="w-full h-full object-cover"
              />
            </div>
            <div>
              <div class="font-bold text-gray-900 text-lg">
                {{ __('app.testimonials.card_2.name') }}
              </div>
              <div class="text-gray-600 text-sm">
                {{ __('app.testimonials.card_2.location') }}
              </div>
            </div>
          </div>

          <div class="flex space-x-1 space-x-reverse">
            <i class="fas fa-star star-icon"></i>
            <i class="fas fa-star star-icon"></i>
            <i class="fas fa-star star-icon"></i>
            <i class="fas fa-star star-icon"></i>
            <i class="fas fa-star star-icon"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- CTA Section -->
<style>
  @import url("https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap");

  .cta-section-frame {
    border: 3px solid #f3a446;
    border-radius: 20px;
    padding: 40px 30px;
    background: linear-gradient(135deg, #2f5c69 0%, #2f5c75 100%);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
  }

  .cta-button-primary {
    background-color: #f3a446;
    color: #2f5c69;
    padding: 16px 32px;
    border-radius: 12px;
    font-weight: 700;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(243, 164, 70, 0.4);
  }

  .cta-button-primary:hover {
    background-color: #e6953a;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(243, 164, 70, 0.6);
  }

  .cta-button-secondary {
    border: 2px solid #f3a446;
    color: #f3a446;
    padding: 16px 32px;
    border-radius: 12px;
    font-weight: 700;
    transition: all 0.3s ease;
  }

  .cta-button-secondary:hover {
    background-color: #f3a446;
    color: #1a2a1a;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(243, 164, 70, 0.4);
  }
</style>

<section class="py-20">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <div class="cta-section-frame">
      <h2
        class="text-4xl lg:text-5xl font-extrabold text-[#f3a446] mb-4 tracking-tight"
      >
        {{ __('app.cta_section.title') }}
      </h2>
      <p class="text-lg lg:text-xl text-gray-200 mb-10 max-w-3xl mx-auto font-normal">
        {{ __('app.cta_section.subtitle') }}
      </p>

      <div class="flex flex-col sm:flex-row gap-6 justify-center">
        @auth
          @if (auth()->user()->isConsultant())
            <a
              href="{{ route('designs.create') }}"
              class="cta-button-primary flex items-center justify-center"
            >
              <i class="fas fa-plus ml-3"></i>
              <span>{{ __('app.cta_section.create_design') }}</span>
            </a>
          @else
            <a
              href="{{ route('tenders.create') }}"
              class="cta-button-primary flex items-center justify-center"
            >
              <i class="fas fa-file-contract ml-3"></i>
              <span>{{ __('app.cta_section.create_tender') }}</span>
            </a>
          @endif
        @else
          <a
            href="{{ route('register') }}"
            class="cta-button-primary flex items-center justify-center"
          >
            <i class="fas fa-user-plus ml-3"></i>
            <span>{{ __('app.cta_section.join_now') }}</span>
          </a>
        @endauth

        <a
          href="{{ route('designs.index') }}"
          class="cta-button-secondary flex items-center justify-center"
        >
          <i class="fas fa-eye ml-3"></i>
          <span>{{ __('app.cta_section.browse_designs') }}</span>
        </a>
      </div>
    </div>
  </div>
</section>

@endsection
