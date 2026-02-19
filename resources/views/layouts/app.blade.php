<!DOCTYPE html>
@php
    $currentLocale = app()->getLocale();
    $isRtl = $currentLocale === 'ar';
    $switchLocale = $isRtl ? 'en' : 'ar';
@endphp

<html lang="{{ str_replace('_', '-', $currentLocale) }}" dir="{{ $isRtl ? 'rtl' : 'ltr' }}" class="{{ $isRtl ? 'rtl' : 'ltr' }}">

<head>
   <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title', 'انشاءات - منصة تصميم البيوت الرائدة')</title>
<meta name="description" content="@yield('description', 'منصة انشاءات لتصميم البيوت العصرية والإسلامية - تجمع بين أفضل الاستشاريين والمقاولين')">
<meta name="keywords" content="@yield('keywords', 'تصميم بيوت, بناء منازل, استشاري معماري, مقاول بناء, مناقصات, تصميم اسلامي, فيلا, شقة')">
<meta name="author" content="منصة انشاءات">
<meta name="robots" content="index, follow">

<meta name="theme-color" content="#0f766e">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="apple-mobile-web-app-title" content="انشاءات">

<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="@yield('title', 'انشاءات - منصة تصميم البيوت الرائدة')">
<meta property="og:description" content="@yield('description', 'منصة انشاءات لتصميم البيوت العصرية والإسلامية')">
<meta property="og:image" content="{{ asset('logo2.png') }}">
<meta property="og:image:secure_url" content="{{ asset('logo2.png') }}">
<meta property="og:image:height" content="630">

<meta property="og:image:width" content="1200">
<meta property="og:image:type" content="image/png">


<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ url()->current() }}">
<meta name="twitter:title" content="@yield('title', 'انشاءات - منصة تصميم البيوت الرائدة')">
<meta name="twitter:description" content="@yield('description', 'منصة انشاءات لتصميم البيوت العصرية والإسلامية')">
<meta name="twitter:image" content="{{ asset('logo2.png') }}">

<meta name="msapplication-TileColor" content="#0f766e">
<meta name="msapplication-config" content="/browserconfig.xml">


    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        as="style">
    <link rel="preload" href="{{ asset('css/custom.css') }}" as="style">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- Favicon -->
    @if (\App\Models\SiteSetting::get('site_favicon'))
        <link rel="icon" type="image/x-icon" href="{{ \App\Models\SiteSetting::get('site_favicon') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ \App\Models\SiteSetting::get('site_favicon') }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif

    <style>
        /* Base responsive styles */
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            -webkit-text-size-adjust: 100%;
        }

        body {
            font-family: 'Cairo', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: var(--bg-light);
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        html.rtl body {
    direction: rtl;
    text-align: right;
}

html.ltr body {
    direction: ltr;
    text-align: left;
}

        /* Responsive container */
        .container {
            width: 100%;
            max-width: 1400px;
            /* margin: 0 auto; */
            padding: 0 1rem;
        }

        @media (min-width: 640px) {
            .container {
                padding: 0 1.5rem;
            }
        }

        /* @media (min-width: 1024px) {
            .container {
                padding: 0 2rem;
            }
        } */


        /* Flash Messages Styles */
        .flash-message {
            position: fixed;
            top: 100px;
            right: 20px;
            z-index: 10000;
            max-width: 400px;
            min-width: 300px;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            animation: slideInRight 0.3s ease-out;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .flash-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .flash-error {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .flash-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .flash-info {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }

        .flash-content {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex: 1;
        }

        .flash-content i {
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .flash-content span {
            font-weight: 500;
            line-height: 1.4;
        }

        .flash-close {
            background: none;
            border: none;
            color: inherit;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 6px;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .flash-close:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        .flash-close i {
            font-size: 0.9rem;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        .flash-message.hide {
            animation: slideOutRight 0.3s ease-in forwards;
        }

        @media (max-width: 768px) {
            .flash-message {
                top: 80px;
                right: 10px;
                left: 10px;
                max-width: none;
                min-width: auto;
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .flash-message {
                top: 70px;
                right: 5px;
                left: 5px;
                padding: 0.75rem;
            }

            .flash-content {
                gap: 0.5rem;
            }

            .flash-content i {
                font-size: 1rem;
            }

            .flash-content span {
                font-size: 0.9rem;
            }
        }

        /* Loading states */
        .loading {
            opacity: 0.6;
            pointer-events: none;
            transition: opacity 0.2s ease-in-out;
        }

        /* Focus styles for accessibility */
        *:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }

        /* Smooth transitions */

        /* Optimized header scroll effect */


        /* @media (max-width: 768px) {
            .header-content {
                min-height: 4.5rem;
            }
        } */

        /* Mobile optimizations */
        @media (max-width: 768px) {

            /* Prevent zoom on input focus */
            input,
            select,
            textarea {
                font-size: 16px !important;
            }

            /* Better touch targets */
            button,
            a,
            input,
            select,
            textarea {
                min-height: 20px;
                min-width: 20px;
            }
        }

        @media (min-width: 1024px) {

            /* Prevent zoom on input focus */
            input,
            select,
            textarea {
                font-size: 16px !important;
            }

            /* Better touch targets */
            button,
            a,
            input,
            select,
            textarea {
                min-height: 30px;
                min-width: 30px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->

<header class="fixed top-0 w-full z-50 transition-all duration-300">
  <div
    class="header-content w-full px-4 py-3 transition-all duration-300 bg-white/95 border-b-2 border-[#f3a446] backdrop-blur-md shadow-lg flex items-center justify-between relative z-50"
  >
    <div class="flex items-center gap-6">
<a
  href="{{ route('home') }}"
  class="logo flex items-center gap-3"
  aria-label="{{ __('app.header.home') }}"
>
  <div class="logo-icon w-40 h-14">
    <img
      src="{{ asset('logo1.png') }}"
      alt="{{ __('app.header.logo_alt') }}"
      class="w-full h-full object-contain"
    />
  </div>
</a>


      <nav
        class="hidden md:block"
        role="navigation"
        aria-label="{{ __('app.header.main_menu') }}"
      >
        <div class="nav-links flex items-center gap-2">
          <a
            href="{{ route('home') }}"
            class="nav-link text-gray-700 hover:text-[#f3a446] transition-colors px-3 py-1 rounded-full {{ request()->routeIs('home') ? 'bg-[#2f5c69] text-white font-semibold' : '' }}"
            aria-label="{{ __('app.header.home') }}"
            >{{ __('app.header.home') }}</a
          >
          <a
            href="{{ route('designs.index') }}"
            class="nav-link text-gray-700 hover:text-[#f3a446] transition-colors px-3 py-1 rounded-full {{ request()->routeIs('designs.*') ? 'bg-[#2f5c69] text-white font-semibold' : '' }}"
            aria-label="{{ __('app.header.designs') }}"
            >{{ __('app.header.designs') }}</a
          >
          <a
            href="{{ route('tenders.index') }}"
            class="nav-link text-gray-700 hover:text-[#f3a446] transition-colors px-3 py-1 rounded-full {{ request()->routeIs('tenders.*') ? 'bg-[#2f5c69] text-white font-semibold' : '' }}"
            aria-label="{{ __('app.header.tenders') }}"
            >{{ __('app.header.tenders') }}</a
          >
          <a
            href="{{ route('lands.index') }}"
            class="nav-link text-gray-700 hover:text-[#f3a446] transition-colors px-3 py-1 rounded-full {{ request()->routeIs('lands.create') ? 'bg-[#2f5c69] text-white font-semibold' : '' }}"
            aria-label="{{ __('app.header.sell_exchange_lands') }}"
            >{{ __('app.header.sell_exchange_lands') }}</a
          >

          @auth
            @if (auth()->user()->isConsultant())
              <a
                href="{{ route('designs.create') }}"
                class="nav-link text-gray-700 hover:text-[#f3a446] transition-colors px-3 py-1 rounded-full {{ request()->routeIs('designs.create') ? 'bg-[#2f5c69] text-white font-semibold' : '' }}"
                aria-label="{{ __('app.header.add_design') }}"
                >{{ __('app.header.add_design') }}</a
              >
              <a
                href="{{ route('proposals.index') }}"
                class="nav-link text-gray-700 hover:text-[#f3a446] transition-colors px-3 py-1 rounded-full {{ request()->routeIs('proposals.*') ? 'bg-[#2f5c69] text-white font-semibold' : '' }}"
                aria-label="{{ __('app.header.my_proposals') }}"
                >{{ __('app.header.my_proposals') }}</a
              >
            @elseif(auth()->user()->isClient())
             
            @endif
          @endauth
        </div>
      </nav>
    </div>

    <div class="nav-actions hidden md:flex items-center gap-4">
      <div class="relative language-dropdown">
        <button
          type="button"
          id="desktopLanguageToggle"
          class="nav-action-btn language-btn flex items-center gap-2 text-gray-700 hover:text-[#f3a446] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#f3a446] focus-visible:ring-offset-2 focus-visible:ring-offset-white"
          aria-haspopup="true"
          aria-expanded="false"
        >
          <i class="fas fa-globe"></i>
          <span
            >{{ $currentLocale === 'ar' ? __('app.header.language_arabic') :
            __('app.header.language_english') }}</span
          >
          <i
            class="fas fa-chevron-down text-xs transition-transform duration-200"
            data-chevron
          ></i>
        </button>

        <div
          id="desktopLanguageMenu"
          class="language-menu hidden absolute mt-2 min-w-[140px] rounded-lg shadow-xl border border-gray-200 backdrop-blur-md bg-white/95 text-gray-800 py-2 {{ $isRtl ? 'left-0 origin-top-left' : 'right-0 origin-top-right' }}"
          role="menu"
          aria-labelledby="desktopLanguageToggle"
        >
          <a
            href="{{ route('language.switch', 'ar') }}"
            class="flex items-center gap-2 px-4 py-2 hover:bg-[#f3a446]/10 transition {{ $currentLocale === 'ar' ? 'text-[#f3a446] font-semibold' : '' }}"
            role="menuitem"
          >
            <span>{{ __('app.header.language_arabic') }}</span>
            @if ($currentLocale === 'ar')
              <i class="fas fa-check text-xs ms-auto"></i>
            @endif
          </a>
          <a
            href="{{ route('language.switch', 'en') }}"
            class="flex items-center gap-2 px-4 py-2 hover:bg-[#f3a446]/10 transition {{ $currentLocale === 'en' ? 'text-[#f3a446] font-semibold' : '' }}"
            role="menuitem"
          >
            <span>{{ __('app.header.language_english') }}</span>
            @if ($currentLocale === 'en')
              <i class="fas fa-check text-xs ms-auto"></i>
            @endif
          </a>
        </div>
      </div>

      @auth
        <div class="user-menu flex items-center gap-3">
          <a
            href="{{ Auth::user()->getDashboardRoute() }}"
            class="nav-action-btn user-btn flex items-center gap-2 text-gray-700 hover:text-[#f3a446]"
          >
            <i class="fas fa-user"></i><span>{{ Auth::user()->name }}</span>
          </a>
          <a
            href="{{ route(Auth::user()->userType->name . '.profile') }}"
            class="nav-action-btn profile-btn flex items-center gap-2 text-gray-700 hover:text-[#f3a446]"
          >
            <i class="fas fa-cog"></i
            ><span>{{ __('app.header.profile') }}</span>
          </a>
          <form
            action="{{ route('logout') }}"
            method="POST"
            class="logout-form"
          >
            @csrf
            <button
              type="submit"
              class="nav-action-btn logout-btn flex items-center gap-2 text-red-600 hover:text-red-800"
            >
              <i class="fas fa-sign-out-alt"></i
              ><span>{{ __('app.header.logout') }}</span>
            </button>
          </form>
        </div>
      @else
        <a
          href="{{ route('login') }}"
          class="nav-action-btn login-btn flex items-center gap-2 text-gray-700 hover:text-[#f3a446]"
        >
          <i class="fas fa-sign-in-alt"></i
          ><span>{{ __('app.header.login') }}</span>
        </a>
        <a
          href="{{ route('register') }}"
          class="nav-action-btn register-btn flex items-center gap-2 bg-[#f3a446] text-[#2f5c69] font-semibold px-3 py-1 rounded-full hover:bg-[#e6953a] transition-colors"
        >
          <i class="fas fa-user-plus"></i
          ><span>{{ __('app.header.register') }}</span>
        </a>
      @endauth
    </div>

   @php
    $user = Auth::user();
    $avatarUrl = null;
    if ($user) {
        $path = $user->avatar_url ?? optional($user->profile)->avatar_url;
        if ($path) {
            $avatarUrl = str_starts_with($path, 'http') ? $path : asset('storage/' . str_replace('public/', '', $path));
        }
    }
@endphp

<div class="user-avatar absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 md:hidden w-10 h-10 bg-[#f3a446] text-[#2f5c69] flex items-center justify-center rounded-full shadow-sm z-10 overflow-hidden">
    @if($avatarUrl)
        <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
    @else
        <i class="fas fa-user"></i>
    @endif
</div>

    <div class="flex items-center md:hidden">
      <div class="relative language-dropdown">
        <button
          type="button"
          id="mobileLanguageToggle"
          class="nav-action-btn language-btn flex items-center gap-2 text-gray-700 hover:text-[#f3a446] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#f3a446] focus-visible:ring-offset-2 focus-visible:ring-offset-white"
          aria-haspopup="true"
          aria-expanded="false"
        >
          <i class="fas fa-globe"></i>
          <span
            >{{ $currentLocale === 'ar' ? __('app.header.language_arabic') :
            __('app.header.language_english') }}</span
          >
          <i
            class="fas fa-chevron-down text-xs transition-transform duration-200"
            data-chevron
          ></i>
        </button>

        <div
          id="mobileLanguageMenu"
          class="language-menu hidden absolute mt-2 min-w-[140px] rounded-lg shadow-xl border border-gray-200 backdrop-blur-md bg-white/95 text-gray-800 py-2 {{ $isRtl ? 'left-0 origin-top-left' : 'right-0 origin-top-right' }}"
          role="menu"
          aria-labelledby="mobileLanguageToggle"
        >
          <a
            href="{{ route('language.switch', 'ar') }}"
            class="flex items-center gap-2 px-4 py-2 hover:bg-[#f3a446]/10 transition {{ $currentLocale === 'ar' ? 'text-[#f3a446] font-semibold' : '' }}"
            role="menuitem"
          >
            <span>{{ __('app.header.language_arabic') }}</span>
            @if ($currentLocale === 'ar')
              <i class="fas fa-check text-xs ms-auto"></i>
            @endif
          </a>
          <a
            href="{{ route('language.switch', 'en') }}"
            class="flex items-center gap-2 px-4 py-2 hover:bg-[#f3a446]/10 transition {{ $currentLocale === 'en' ? 'text-[#f3a446] font-semibold' : '' }}"
            role="menuitem"
          >
            <span>{{ __('app.header.language_english') }}</span>
            @if ($currentLocale === 'en')
              <i class="fas fa-check text-xs ms-auto"></i>
            @endif
          </a>
        </div>
      </div>

      <button
        class="mobile-menu-toggle text-[#f3a446] text-2xl ml-4 rtl:ml-0 rtl:mr-4"
        aria-label="{{ __('app.header.menu_toggle') }}"
        aria-expanded="false"
        aria-controls="mobileMenu"
      >
        <i class="fas fa-bars"></i>
      </button>
    </div>
  </div>

  <div
    class="mobile-menu absolute top-full left-0 right-0 w-full bg-white text-gray-800 shadow-2xl z-40 overflow-hidden max-h-0 opacity-0 invisible transition-all duration-500 ease-in-out"
    id="mobileMenu"
    role="navigation"
    aria-label="{{ __('app.header.main_menu') }}"
  >
    <nav class="mobile-nav p-4 space-y-6 overflow-y-auto max-h-[70vh]">
      <div class="mobile-nav-section space-y-2">
        <h3
          class="mobile-nav-section-title text-gray-500 uppercase text-xs font-semibold tracking-wider mb-3"
        >
          {{ __('app.header.main_menu') }}
        </h3>
        <a
          href="{{ route('home') }}"
          class="mobile-nav-link flex items-center gap-3 text-gray-700 hover:text-[#f3a446] p-2 rounded-lg {{ request()->routeIs('home') ? 'text-white font-semibold bg-[#2f5c69]' : '' }}"
          aria-label="{{ __('app.header.home') }}"
        >
          <i class="fas fa-home w-5 text-center"></i
          ><span>{{ __('app.header.home') }}</span>
        </a>
        <a
          href="{{ route('designs.index') }}"
          class="mobile-nav-link flex items-center gap-3 text-gray-700 hover:text-[#f3a446] p-2 rounded-lg {{ request()->routeIs('designs.*') ? 'text-white font-semibold bg-[#2f5c69]' : '' }}"
          aria-label="{{ __('app.header.designs') }}"
        >
          <i class="fas fa-paint-brush w-5 text-center"></i
          ><span>{{ __('app.header.designs') }}</span>
        </a>
        <a
          href="{{ route('tenders.index') }}"
          class="mobile-nav-link flex items-center gap-3 text-gray-700 hover:text-[#f3a446] p-2 rounded-lg {{ request()->routeIs('tenders.*') ? 'text-white font-semibold bg-[#2f5c69]' : '' }}"
          aria-label="{{ __('app.header.tenders') }}"
        >
          <i class="fas fa-gavel w-5 text-center"></i
          ><span>{{ __('app.header.tenders') }}</span>
        </a>
        <a
          href="{{ route('lands.index') }}"
          class="mobile-nav-link flex items-center gap-3 text-gray-700 hover:text-[#f3a446] p-2 rounded-lg {{ request()->routeIs('lands.create') ? 'text-white font-semibold bg-[#2f5c69]' : '' }}"
          aria-label="{{ __('app.header.sell_exchange_lands') }}"
        >
          <i class="fas fa-exchange-alt w-5 text-center"></i
          ><span>{{ __('app.header.sell_exchange_lands') }}</span>
        </a>
      </div>

      @auth
        @if (auth()->user()->isConsultant())
          <div class="mobile-nav-section space-y-2">
            <a
              href="{{ route('designs.create') }}"
              class="mobile-nav-link flex items-center gap-3 text-gray-700 hover:text-[#f3a446] p-2 rounded-lg {{ request()->routeIs('designs.create') ? 'text-white font-semibold bg-[#2f5c69]' : '' }}"
              aria-label="{{ __('app.header.add_design') }}"
            >
              <i class="fas fa-plus-square w-5 text-center"></i
              ><span>{{ __('app.header.add_design') }}</span>
            </a>
            <a
              href="{{ route('proposals.index') }}"
              class="mobile-nav-link flex items-center gap-3 text-gray-700 hover:text-[#f3a446] p-2 rounded-lg {{ request()->routeIs('proposals.*') ? 'text-white font-semibold bg-[#2f5c69]' : '' }}"
              aria-label="{{ __('app.header.my_proposals') }}"
            >
              <i class="fas fa-file-contract w-5 text-center"></i
              ><span>{{ __('app.header.my_proposals') }}</span>
            </a>
          </div>
        @elseif(auth()->user()->isClient())
          <div class="mobile-nav-section">
            <a
              href="{{ route('tenders.create') }}"
              class="mobile-nav-button flex items-center justify-center gap-2 py-2 px-4 bg-[#f3a446] text-[#2f5c69] rounded-lg font-semibold hover:bg-[#e6953a] transition-colors"
              aria-label="{{ __('app.header.create_tender') }}"
            >
              <i class="fas fa-clipboard-list"></i
              ><span>{{ __('app.header.create_tender') }}</span>
            </a>
          </div>
        @endif
      @endauth

      @auth
        <div class="mobile-nav-section space-y-2">
          <div class="mobile-user-info flex items-center gap-3 mb-3 p-2">
            <div class="user-details">
              <h4 class="user-name font-bold text-gray-900">
                {{ Auth::user()->name }}
              </h4>
              <p class="user-type text-sm text-[#f3a446] font-medium">
                {{ Auth::user()->userType->display_name_ar ?? Auth::user()->userType->name }}
              </p>
            </div>
          </div>

          <h3
            class="mobile-nav-section-title text-gray-500 uppercase text-xs font-semibold tracking-wider mb-3"
          >
            {{ __('app.header.my_account') }}
          </h3>
          <a
            href="{{ Auth::user()->getDashboardRoute() }}"
            class="mobile-nav-link flex items-center gap-3 text-gray-700 hover:text-[#f3a446] p-2 rounded-lg"
            aria-label="{{ __('app.header.dashboard') }}"
          >
            <i class="fas fa-tachometer-alt w-5 text-center"></i
            ><span>{{ __('app.header.dashboard') }}</span>
          </a>
          <a
            href="{{ route(Auth::user()->userType->name . '.profile') }}"
            class="mobile-nav-link flex items-center gap-3 text-gray-700 hover:text-[#f3a446] p-2 rounded-lg"
            aria-label="{{ __('app.header.profile') }}"
          >
            <i class="fas fa-user w-5 text-center"></i
            ><span>{{ __('app.header.profile') }}</span>
          </a>
          <form action="{{ route('logout') }}" method="POST" class="w-full">
            @csrf
            <button
              type="submit"
              class="mobile-nav-link logout-link flex items-center gap-3 text-red-600 hover:text-red-800 w-full p-2 rounded-lg"
              aria-label="{{ __('app.header.logout') }}"
            >
              <i class="fas fa-sign-out-alt w-5 text-center"></i
              ><span>{{ __('app.header.logout') }}</span>
            </button>
          </form>
        </div>
      @else
        <div class="mobile-nav-section space-y-2">
          <h3
            class="mobile-nav-section-title text-gray-500 uppercase text-xs font-semibold tracking-wider mb-3"
          >
            {{ __('app.header.user_account') }}
          </h3>
          <a
            href="{{ route('login') }}"
            class="mobile-nav-link flex items-center gap-3 text-gray-700 hover:text-[#f3a446] p-2 rounded-lg"
            aria-label="{{ __('app.header.login') }}"
          >
            <i class="fas fa-sign-in-alt w-5 text-center"></i
            ><span>{{ __('app.header.login') }}</span>
          </a>
          <a
            href="{{ route('register') }}"
            class="mobile-nav-button flex items-center justify-center gap-2 py-2 px-4 bg-[#f3a446] text-[#2f5c69] rounded-lg font-semibold hover:bg-[#e6953a] transition-colors"
            aria-label="{{ __('app.header.register') }}"
          >
            <i class="fas fa-user-plus"></i
            ><span>{{ __('app.header.register') }}</span>
          </a>
        </div>
      @endauth
    </nav>
  </div>
</header>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const menuClose = document.querySelector('.mobile-menu-close');
    const mobileMenu = document.getElementById('mobileMenu');
    const overlay = document.getElementById('mobileMenuOverlay');

    const toggleIcon = menuToggle ? menuToggle.querySelector('i') : null;

    const openMenu = () => {
      if (mobileMenu) {
        mobileMenu.classList.remove('max-h-0', 'opacity-0', 'invisible');
        mobileMenu.classList.add('max-h-screen', 'opacity-100', 'visible');
      }
      if (overlay) {
        overlay.classList.remove('hidden');
      }
      if (toggleIcon) {
        toggleIcon.classList.remove('fa-bars');
        toggleIcon.classList.add('fa-times');
      }
      if (menuToggle) {
        menuToggle.setAttribute('aria-expanded', 'true');
      }
    };

    const closeMenu = () => {
      if (mobileMenu) {
        mobileMenu.classList.add('max-h-0', 'opacity-0', 'invisible');
        mobileMenu.classList.remove('max-h-screen', 'opacity-100', 'visible');
      }
      if (overlay) {
        overlay.classList.add('hidden');
      }
      if (toggleIcon) {
        toggleIcon.classList.remove('fa-times');
        toggleIcon.classList.add('fa-bars');
      }
      if (menuToggle) {
        menuToggle.setAttribute('aria-expanded', 'false');
      }
    };

    if (menuToggle) {
      menuToggle.addEventListener('click', () => {
        const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
        if (isExpanded) {
          closeMenu();
        } else {
          openMenu();
        }
      });
    }

    if (menuClose) {
      menuClose.addEventListener('click', closeMenu);
    }

    if (overlay) {
      overlay.addEventListener('click', closeMenu);
    }

    const setupDropdown = (toggleId, menuId) => {
      const toggle = document.getElementById(toggleId);
      const menu = document.getElementById(menuId);
      const chevron = toggle ? toggle.querySelector('[data-chevron]') : null;

      if (!toggle || !menu) return;

      const openLanguageMenu = () => {
        menu.classList.remove('hidden');
        toggle.setAttribute('aria-expanded', 'true');
        if (chevron) chevron.classList.add('rotate-180');
      };

      const closeLanguageMenu = () => {
        menu.classList.add('hidden');
        toggle.setAttribute('aria-expanded', 'false');
        if (chevron) chevron.classList.remove('rotate-180');
      };

      toggle.addEventListener('click', (event) => {
        event.stopPropagation();
        const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
        if (isExpanded) {
          closeLanguageMenu();
        } else {
          openLanguageMenu();
        }
      });

      document.addEventListener('click', (event) => {
        if (!menu.contains(event.target) && !toggle.contains(event.target)) {
          closeLanguageMenu();
        }
      });

      document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
          closeLanguageMenu();
        }
      });
    };

    setupDropdown('desktopLanguageToggle', 'desktopLanguageMenu');
    setupDropdown('mobileLanguageToggle', 'mobileLanguageMenu');
  });
</script>


    <!-- Main Content -->
    <main class="main-content">
        <div class="relative min-h-screen bg-gray-50">
    <div class="fixed top-24 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-lg px-4 space-y-3">
        @if (session('success'))
            <div class="flex items-center justify-between p-4 text-green-700 bg-green-100 border border-green-400 rounded-lg shadow-md" role="alert">
                <div class="flex items-center gap-3">
                    <i class="fas fa-check-circle text-xl"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900 focus:outline-none">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="flex items-center justify-between p-4 text-red-700 bg-red-100 border border-red-400 rounded-lg shadow-md" role="alert">
                <div class="flex items-center gap-3">
                    <i class="fas fa-exclamation-circle text-xl"></i>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900 focus:outline-none">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if (session('warning'))
            <div class="flex items-center justify-between p-4 text-yellow-700 bg-yellow-100 border border-yellow-400 rounded-lg shadow-md" role="alert">
                <div class="flex items-center gap-3">
                    <i class="fas fa-exclamation-triangle text-xl"></i>
                    <span class="font-medium">{{ session('warning') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-yellow-700 hover:text-yellow-900 focus:outline-none">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if (session('info'))
            <div class="flex items-center justify-between p-4 text-blue-700 bg-blue-100 border border-blue-400 rounded-lg shadow-md" role="alert">
                <div class="flex items-center gap-3">
                    <i class="fas fa-info-circle text-xl"></i>
                    <span class="font-medium">{{ session('info') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-blue-700 hover:text-blue-900 focus:outline-none">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="flex items-start justify-between p-4 text-red-700 bg-red-100 border border-red-400 rounded-lg shadow-md" role="alert">
                <div class="flex items-start gap-3">
                    <i class="fas fa-exclamation-circle text-xl mt-1"></i>
                    <div>
                        <strong class="font-bold block mb-1">يرجى تصحيح الأخطاء التالية:</strong>
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900 focus:outline-none mt-1">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
    </div>

    <div class="">
        @yield('content')
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(function(alert) {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    });
</script>
    </main>

    <!-- Footer -->

    <footer class="bg-gradient-to-br from-[#2f5c69] to-[#1a262a] text-white pt-16 pb-8">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-12">
      <div class="md:col-span-4">
        <a href="{{ route('home') }}" class="flex items-center gap-3 mb-4">
          <div
            class="w-12 h-12 rounded-2xl bg-[#f3a446]/20 flex items-center justify-center border border-[#f3a446]/30"
          >
            <i class="fas fa-home text-[#f3a446] text-xl"></i>
          </div>
          <span class="text-3xl font-bold text-white">{{
            __("app.footer.logo_name")
          }}</span>
        </a>
        <p class="text-gray-300 leading-relaxed">
          {{ __("app.footer.description") }}
        </p>
        <div class="flex gap-3 mt-6">
          <a
            href="#"
            aria-label="{{ __('app.footer.social.facebook') }}"
            class="social-icon-btn"
          >
            <i class="fab fa-facebook-f"></i>
          </a>
          <a
            href="#"
            aria-label="{{ __('app.footer.social.twitter') }}"
            class="social-icon-btn"
          >
            <i class="fab fa-twitter"></i>
          </a>
          <a
            href="#"
            aria-label="{{ __('app.footer.social.instagram') }}"
            class="social-icon-btn"
          >
            <i class="fab fa-instagram"></i>
          </a>
          <a
            href="#"
            aria-label="{{ __('app.footer.social.linkedin') }}"
            class="social-icon-btn"
          >
            <i class="fab fa-linkedin-in"></i>
          </a>
        </div>
      </div>

      <div class="md:col-span-8 grid grid-cols-1 sm:grid-cols-3 gap-8">
        <div>
          <h3
            class="text-xl font-bold text-white mb-6 border-b-2 border-[#f3a446]/30 pb-3 inline-block"
          >
            {{ __("app.footer.links.title") }}
          </h3>
          <ul class="space-y-3">
            <li>
              <a href="{{ route('home') }}" class="footer-link-item">
                <!-- <i class="fas">{{ __("app.footer.links.icon") }}</i> -->
                <span>{{ __("app.footer.links.home") }}</span>
              </a>
            </li>
            <li>
              <a
                href="{{ route('designs.index') }}"
                class="footer-link-item"
              >
                <!-- <i class="fas">{{ __("app.footer.links.icon") }}</i> -->
                <span>{{ __("app.footer.links.designs") }}</span>
              </a>
            </li>
            <li>
              <a href="{{ route('lands.index') }}" class="footer-link-item">
                <!-- <i class="fas">{{ __("app.footer.links.icon") }}</i> -->
                <span>{{ __("app.footer.links.lands") }}</span>
              </a>
            </li>
            @auth
              @if (auth()->user()->isConsultant())
                <li>
                  <a
                    href="{{ route('designs.create') }}"
                    class="footer-link-item"
                  >
                    <!-- <i class="fas fa-chevron-left"></i> -->
                    <span>{{ __("app.footer.links.add_design") }}</span>
                  </a>
                </li>
              @endif
            @endauth
          </ul>
        </div>
<div>
    <h3 class="text-xl font-bold text-white mb-6 border-b-2 border-[#f3a446]/30 pb-3 inline-block">
        {{ __("app.footer.services.title") }}
    </h3>
    <ul class="space-y-3">
        <li>
            <a href="{{ route('designs.index') }}" class="footer-link-item">
                <i class="fas fa-home ml-2"></i>
                <span>{{ __("app.footer.services.residential_design") }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('designs.index') }}" class="footer-link-item">
                <i class="ml-2 fas fa-building"></i>
                <span>{{ __("app.footer.services.commercial_design") }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('designs.index') }}" class="footer-link-item">
                <i class="ml-2 fas fa-drafting-compass"></i>
                <span>{{ __("app.footer.services.engineering_consultations") }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('designs.index') }}" class="footer-link-item">
                <i class="ml-2 fas fa-tasks"></i>
                <span>{{ __("app.footer.services.project_management") }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('designs.index') }}" class="footer-link-item">
                <i class="ml-2 fas fa-truck-moving"></i>
                <span>{{ __("app.footer.services.material_supply") }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('designs.index') }}" class="footer-link-item">
                <i class="ml-2 fas fa-couch"></i>
                <span>{{ __("app.footer.services.interior_design") }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('designs.index') }}" class="footer-link-item">
                <i class="ml-2 fas fa-layer-group"></i>
                <span>{{ __("app.footer.services.exterior_design") }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('designs.index') }}" class="footer-link-item">
                <i class="ml-2 fas fa-chair"></i>
                <span>{{ __("app.footer.services.furniture_design") }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('designs.index') }}" class="footer-link-item">
                <i class="ml-2 fas fa-tree"></i>
                <span>{{ __("app.footer.services.landscape_design") }}</span>
            </a>
        </li>
    </ul>
</div>

        <div>
          <h3
            class="text-xl font-bold text-white mb-6 border-b-2 border-[#f3a446]/30 pb-3 inline-block"
          >
            {{ __("app.footer.contact.title") }}
          </h3>
          <ul class="space-y-4">
            
            <li class="flex items-start gap-3 text-gray-300">
              <i class="fas fa-envelope text-[#f3a446] text-lg mt-1"></i>
              <span>{{ __("app.footer.contact.email") }}</span>
            </li>
            <li class="flex items-start gap-3 text-gray-300">
              <i class="fas fa-map-marker-alt text-[#f3a446] text-lg mt-1"></i>
              <span>{{ __("app.footer.contact.address") }}</span>
            </li>
            <li class="flex items-start gap-3 text-gray-300">
              <i class="fas fa-clock text-[#f3a446] text-lg mt-1"></i>
              <span>{{ __("app.footer.contact.hours") }}</span>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="border-t border-white/10 pt-8 mt-12">
      <p class="text-center text-gray-400 text-sm">
        {!! __("app.footer.copyright") !!}
      </p>
    </div>
  </div>
</footer>

</body>

</html>
