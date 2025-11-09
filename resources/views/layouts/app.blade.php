<!DOCTYPE html>
<html lang="ar" dir="rtl">

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
    <meta name="msapplication-TileColor" content="#0f766e">
    <meta name="msapplication-config" content="/browserconfig.xml">

    <!-- Preload critical resources -->
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
            direction: rtl;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
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

        @media (min-width: 1024px) {
            .container {
                padding: 0 2rem;
            }
        }


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
  

        @media (max-width: 768px) {
            .header-content {
                min-height: 4.5rem;
            }
        }

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
                min-height: 44px;
                min-width: 44px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->

<header class="fixed top-0 w-full z-50 mt-5 transition-all duration-300">
    <div
        class="header-content w-11/12  mx-auto px-4 py-3 transition-all duration-300 bg-[#2f5c69] border-2 border-[#f3a446] rounded-full backdrop-blur-lg flex items-center justify-between relative z-50">

        <div class="flex items-center gap-6">
            <a href="{{ route('home') }}" class="logo flex items-center gap-3" aria-label="الرئيسية">
                @if (\App\Models\SiteSetting::get('site_logo'))
                    <div class="logo-icon w-10 h-10">
                        <img src="{{ \App\Models\SiteSetting::get('site_logo') }}" alt="لوجو انشاءات"
                            class="w-full h-full object-contain">
                    </div>
                @else
                    <div class="logo-icon w-10 h-10 bg-[#f3a446]/20 rounded-full"></div>
                @endif
                <div class="logo-text">
                    <div class="logo-title text-white font-bold text-lg leading-tight">insha'at</div>
                    <div class="logo-subtitle text-[#f3a446] text-sm">Your Partners for Your Home of Dreams</div>
                </div>
            </a>

            <nav class="hidden md:block" role="navigation" aria-label="القائمة الرئيسية">
                <div class="nav-links flex items-center gap-2">
                    <a href="{{ route('home') }}"
                        class="nav-link text-white hover:text-[#f3a446] transition-colors px-3 py-1 rounded-full {{ request()->routeIs('home') ? 'bg-black/25 text-[#f3a446] font-semibold' : '' }}"
                        aria-label="الرئيسية">الرئيسية</a>
                    <a href="{{ route('designs.index') }}"
                        class="nav-link text-white hover:text-[#f3a446] transition-colors px-3 py-1 rounded-full {{ request()->routeIs('designs.*') ? 'bg-black/25 text-[#f3a446] font-semibold' : '' }}"
                        aria-label="التصاميم">التصاميم</a>
                    <a href="{{ route('tenders.index') }}"
                        class="nav-link text-white hover:text-[#f3a446] transition-colors px-3 py-1 rounded-full {{ request()->routeIs('tenders.*') ? 'bg-black/25 text-[#f3a446] font-semibold' : '' }}"
                        aria-label="المناقصات">المناقصات</a>
                    <a href="{{ route('lands.create') }}"
                        class="nav-link text-white hover:text-[#f3a446] transition-colors px-3 py-1 rounded-full {{ request()->routeIs('lands.create') ? 'bg-black/25 text-[#f3a446] font-semibold' : '' }}"
                        aria-label="بيع وتبادل الأراضي">بيع وتبادل الأراضي</a>

                    @auth
                        @if (auth()->user()->isConsultant())
                            <a href="{{ route('designs.create') }}"
                                class="nav-link text-white hover:text-[#f3a446] transition-colors px-3 py-1 rounded-full {{ request()->routeIs('designs.create') ? 'bg-black/25 text-[#f3a446] font-semibold' : '' }}"
                                aria-label="أضف تصميم">أضف تصميم</a>
                            <a href="{{ route('proposals.index') }}"
                                class="nav-link text-white hover:text-[#f3a446] transition-colors px-3 py-1 rounded-full {{ request()->routeIs('proposals.*') ? 'bg-black/25 text-[#f3a446] font-semibold' : '' }}"
                                aria-label="عروضي">عروضي</a>
                        @elseif(auth()->user()->isClient())
                            <a href="{{ route('tenders.create') }}"
                                class="nav-link text-white hover:text-[#f3a446] transition-colors px-3 py-1 rounded-full {{ request()->routeIs('tenders.create') ? 'bg-black/25 text-[#f3a446] font-semibold' : '' }}"
                                aria-label="إنشاء مناقصة">إنشاء مناقصة</a>
                        @endif
                    @endauth
                </div>
            </nav>
        </div>

        <div class="nav-actions hidden md:flex items-center gap-4">
            <a href="#" class="nav-action-btn language-btn flex items-center gap-2 text-white hover:text-[#f3a446]">
                <i class="fas fa-globe"></i><span>العربية</span>
            </a>

            @auth
                <div class="user-menu flex items-center gap-3">
                    <a href="{{ Auth::user()->getDashboardRoute() }}"
                        class="nav-action-btn user-btn flex items-center gap-2 text-white hover:text-[#f3a446]">
                        <i class="fas fa-user"></i><span>{{ Auth::user()->name }}</span>
                    </a>
                    <a href="{{ route(Auth::user()->userType->name . '.profile') }}"
                        class="nav-action-btn profile-btn flex items-center gap-2 text-white hover:text-[#f3a446]">
                        <i class="fas fa-cog"></i><span>الملف الشخصي</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit"
                            class="nav-action-btn logout-btn flex items-center gap-2 text-[#f3a446] hover:text-white">
                            <i class="fas fa-sign-out-alt"></i><span>تسجيل الخروج</span>
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="nav-action-btn login-btn flex items-center gap-2 text-white hover:text-[#f3a446]">
                    <i class="fas fa-sign-in-alt"></i><span>تسجيل الدخول</span>
                </a>
                <a href="{{ route('register') }}"
                    class="nav-action-btn register-btn flex items-center gap-2 bg-[#f3a446] text-[#2f5c69] font-semibold px-3 py-1 rounded-full hover:bg-[#e6953a]">
                    <i class="fas fa-user-plus"></i><span>إنشاء حساب</span>
                </a>
            @endauth
        </div>


        <button class="mobile-menu-toggle md:hidden text-[#f3a446] text-2xl" aria-label="القائمة" aria-expanded="false"
            aria-controls="mobileMenu">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <div class="mobile-menu absolute top-full left-1/2 -translate-x-1/2 w-11/12 md:w-4/5 mt-2 bg-white text-gray-800 rounded-2xl shadow-2xl z-40 overflow-hidden max-h-0 opacity-0 invisible transition-all duration-500 ease-in-out"
        id="mobileMenu" role="navigation" aria-label="القائمة الرئيسية">

        <div class="mobile-menu-header flex items-center justify-between p-4 border-b border-gray-200">
            <button
                class="mobile-menu-close text-2xl text-[#2f5c69]" aria-label="إغلاق القائمة">
                <i
                    class="fas fa-times"></i>
            </button>
            <div class="mobile-logo flex items-center gap-3">
                @if (\App\Models\SiteSetting::get('site_logo'))
                    <div class="logo-icon w-10 h-10">
                        <img src="{{ \App\Models\SiteSetting::get('site_logo') }}" alt="لوجو انشاءات"
                            class="w-full h-full object-contain">
                    </div>
                @else
                    <div class="logo-icon w-10 h-10 bg-[#f3a446]/30 rounded-full"></div>
                @endif
                
            </div>
        </div>

        <nav class="mobile-nav p-4 space-y-6 overflow-y-auto max-h-[70vh]">
            <div class="mobile-nav-section space-y-2">
                <h3 class="mobile-nav-section-title text-[#2f5c69] font-semibold text-sm mb-2">القائمة الرئيسية</h3>
                <a href="{{ route('home') }}"
                    class="mobile-nav-link flex items-center gap-3 text-gray-700 hover:text-[#f3a446] {{ request()->routeIs('home') ? 'text-[#f3a446] font-semibold' : '' }}"
                    aria-label="الرئيسية">
                    <i class="fas fa-home"></i><span>الرئيسية</span>
                </a>
                <a href="{{ route('designs.index') }}"
                    class="mobile-nav-link flex items-center gap-3 text-gray-700 hover:text-[#f3a446] {{ request()->routeIs('designs.*') ? 'text-[#f3a446] font-semibold' : '' }}"
                    aria-label="التصاميم">
                    <i class="fas fa-paint-brush"></i><span>التصاميم</span>
                </a>
                <a href="{{ route('tenders.index') }}"
                    class="mobile-nav-link flex items-center gap-3 text-gray-700 hover:text-[#f3a446] {{ request()->routeIs('tenders.*') ? 'text-[#f3a446] font-semibold' : '' }}"
                    aria-label="المناقصات">
                    <i class="fas fa-gavel"></i><span>المناقصات</span>
                </a>
                <a href="{{ route('lands.create') }}"
                    class="mobile-nav-link flex items-center gap-3 text-gray-700 hover:text-[#f3a446] {{ request()->routeIs('lands.create') ? 'text-[#f3a446] font-semibold' : '' }}"
                    aria-label="بيع وتبادل الأراضي">
                    <i class="fas fa-exchange-alt"></i><span>بيع وتبادل الأراضي</span>
                </a>
            </div>

            @auth
                @if (auth()->user()->isConsultant())
                    <div class="mobile-nav-section space-y-2">
                        <a href="{{ route('designs.create') }}"
                            class="mobile-nav-link flex items-center gap-3 text-gray-700 hover:text-[#f3a446] {{ request()->routeIs('designs.create') ? 'text-[#f3a446] font-semibold' : '' }}"
                            aria-label="أضف تصميم">
                            <i class="fas fa-plus-square"></i><span>أضف تصميم</span>
                        </a>
                        <a href="{{ route('proposals.index') }}"
                            class="mobile-nav-link flex items-center gap-3 text-gray-700 hover:text-[#f3a446] {{ request()->routeIs('proposals.*') ? 'text-[#f3a446] font-semibold' : '' }}"
                            aria-label="عروضي">
                            <i class="fas fa-file-contract"></i><span>عروضي</span>
                        </a>
                    </div>
                @elseif(auth()->user()->isClient())
                    <div class="mobile-nav-section">
                        <a href="{{ route('tenders.create') }}"
                            class="mobile-nav-button flex items-center justify-center gap-2 py-2 px-4 bg-[#f3a446] text-[#2f5c69] rounded-lg font-semibold hover:bg-[#e6953a]"
                            aria-label="إنشاء مناقصة">
                            <i class="fas fa-clipboard-list"></i><span>إنشاء مناقصة</span>
                        </a>
                    </div>
                @endif
            @endauth

            @auth
                <div class="mobile-nav-section space-y-2">
                    <div class="mobile-user-info flex items-center gap-3 mb-3">
                        <div
                            class="user-avatar w-10 h-10 bg-[#f3a446] text-[#2f5c69] flex items-center justify-center rounded-full">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="user-details">
                            <h4 class="user-name font-bold text-gray-900">{{ Auth::user()->name }}</h4>
                            <p class="user-type text-sm text-[#f3a446]">
                                {{ Auth::user()->userType->display_name_ar ?? Auth::user()->userType->name }}</p>
                        </div>
                    </div>

                    <h3 class="mobile-nav-section-title text-[#2f5c69] font-semibold text-sm mb-2">حسابي</h3>
                    <a href="{{ Auth::user()->getDashboardRoute() }}"
                        class="mobile-nav-link flex items-center gap-3 text-gray-700 hover:text-[#f3a446]"
                        aria-label="لوحة التحكم">
                        <i class="fas fa-tachometer-alt"></i><span>لوحة التحكم</span>
                    </a>
                    <a href="{{ route(Auth::user()->userType->name . '.profile') }}"
                        class="mobile-nav-link flex items-center gap-3 text-gray-700 hover:text-[#f3a446]"
                        aria-label="الملف الشخصي">
                        <i class="fas fa-user"></i><span>الملف الشخصي</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit"
                            class="mobile-nav-link logout-link flex items-center gap-3 text-red-600 hover:text-red-800"
                            aria-label="تسجيل الخروج">
                            <i class="fas fa-sign-out-alt"></i><span>تسجيل الخروج</span>
                        </button>
                    </form>
                </div>
            @else
                <div class="mobile-nav-section space-y-2">
                    <h3 class="mobile-nav-section-title text-[#2f5c69] font-semibold text-sm mb-2">حساب المستخدم</h3>
                    <a href="{{ route('login') }}"
                        class="mobile-nav-link flex items-center gap-3 text-gray-700 hover:text-[#f3a446]"
                        aria-label="تسجيل الدخول">
                        <i class="fas fa-sign-in-alt"></i><span>تسجيل الدخول</span>
                    </a>
                    <a href="{{ route('register') }}"
                        class="mobile-nav-button flex items-center justify-center gap-2 py-2 px-4 bg-[#f3a446] text-[#2f5c69] rounded-lg font-semibold hover:bg-[#e6953a]"
                        aria-label="إنشاء حساب">
                        <i class="fas fa-user-plus"></i><span>إنشاء حساب</span>
                    </a>
                </div>
            @endauth

            <div class="mobile-nav-section space-y-2">
                <h3 class="mobile-nav-section-title text-[#2f5c69] font-semibold text-sm mb-2">اللغة</h3>
                <a href="#"
                    class="mobile-nav-link flex items-center justify-between gap-3 text-[#f3a446] font-semibold"
                    aria-label="العربية">
                    <div class="flex items-center gap-3"><i class="fas fa-globe"></i><span>العربية</span></div>
                    <i class="fas fa-check"></i>
                </a>
                <a href="#" class="mobile-nav-link flex items-center gap-3 text-gray-700 hover:text-[#f3a446]"
                    aria-label="English">
                    <i class="fas fa-globe"></i><span>English</span>
                </a>
            </div>
        </nav>
    </div>
</header>


<script>
    document.addEventListener('DOMContentLoaded', function() {
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
    });
</script>

    
    <!-- Main Content -->
    <main class="main-content">
        <div class="">
            <!-- Flash Messages -->
            @if (session('success'))
                <div class="flash-message flash-success" id="flash-message">
                    <div class="flash-content">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button class="flash-close" onclick="closeFlashMessage()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="flash-message flash-error" id="flash-message">
                    <div class="flash-content">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button class="flash-close" onclick="closeFlashMessage()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if (session('warning'))
                <div class="flash-message flash-warning" id="flash-message">
                    <div class="flash-content">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>{{ session('warning') }}</span>
                    </div>
                    <button class="flash-close" onclick="closeFlashMessage()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if (session('info'))
                <div class="flash-message flash-info" id="flash-message">
                    <div class="flash-content">
                        <i class="fas fa-info-circle"></i>
                        <span>{{ session('info') }}</span>
                    </div>
                    <button class="flash-close" onclick="closeFlashMessage()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div class="flash-message flash-error" id="flash-message">
                    <div class="flash-content">
                        <i class="fas fa-exclamation-circle"></i>
                        <div>
                            <strong>يرجى تصحيح الأخطاء التالية:</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button class="flash-close" onclick="closeFlashMessage()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->


<footer class="bg-gradient-to-br from-[#2f5c69] to-[#1a262a] text-white pt-16 pb-8">


  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-12">

      <div class="md:col-span-4">
        <a href="{{ route('home') }}" class="flex items-center gap-3 mb-4">
          <div class="w-12 h-12 rounded-2xl bg-[#f3a446]/20 flex items-center justify-center border border-[#f3a446]/30">
            <i class="fas fa-home text-[#f3a446] text-xl"></i>
          </div>
          <span class="text-3xl font-bold text-white">insha'at</span>
        </a>
        <p class="text-gray-300 leading-relaxed">
          منصة متخصصة في تصميم البيوت العصرية والإسلامية. نقدم أفضل التصاميم وأحدث التقنيات لبناء منزل
          أحلامك.
        </p>
        <div class="flex gap-3 mt-6">
          <a href="#" aria-label="فيسبوك" class="social-icon-btn">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" aria-label="تويتر" class="social-icon-btn">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" aria-label="إنستغرام" class="social-icon-btn">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="#" aria-label="لينكد إن" class="social-icon-btn">
            <i class="fab fa-linkedin-in"></i>
          </a>
        </div>
      </div>

      <div class="md:col-span-8 grid grid-cols-1 sm:grid-cols-3 gap-8">
        <div>
          <h3 class="text-xl font-bold text-white mb-6 border-b-2 border-[#f3a446]/30 pb-3 inline-block">
            روابط سريعة</h3>
          <ul class="space-y-3">
            <li>
              <a href="{{ route('home') }}" class="footer-link-item">
                <i class="fas fa-chevron-left"></i>
                <span>الرئيسية</span>
              </a>
            </li>
            <li>
              <a href="{{ route('designs.index') }}" class="footer-link-item">
                <i class="fas fa-chevron-left"></i>
                <span>التصاميم</span>
              </a>
            </li>
            <li>
              <a href="{{ route('lands.create') }}" class="footer-link-item">
                <i class="fas fa-chevron-left"></i>
                <span>بيع وتبادل الأراضي</span>
              </a>
            </li>
            @auth
              @if (auth()->user()->isConsultant())
                <li>
                  <a href="{{ route('designs.create') }}" class="footer-link-item">
                    <i class="fas fa-chevron-left"></i>
                    <span>أضف تصميم</span>
                  </a>
                </li>
              @endif
            @endauth
          </ul>
        </div>

        <div>
          <h3 class="text-xl font-bold text-white mb-6 border-b-2 border-[#f3a446]/30 pb-3 inline-block">
            خدماتنا</h3>
          <ul class="space-y-3">
            <li>
              <a href="#" class="footer-link-item">
                <i class="fas fa-hammer"></i>
                <span>تصميم منازل</span>
              </a>
            </li>
            <li>
              <a href="#" class="footer-link-item">
                <i class="fas fa-city"></i>
                <span>تصميم فيلات</span>
              </a>
            </li>
            <li>
              <a href="#" class="footer-link-item">
                <i class="fas fa-building"></i>
                <span>تصميم شقق</span>
              </a>
            </li>
            <li>
              <a href="#" class="footer-link-item">
                <i class="fas fa-store"></i>
                <span>تصميم تجاري</span>
              </a>
            </li>
            <li>
              <a href="#" class="footer-link-item">
                <i class="fas fa-lightbulb"></i>
                <span>استشارات معمارية</span>
              </a>
            </li>
            <li>
              <a href="#" class="footer-link-item">
                <i class="fas fa-tasks"></i>
                <span>إدارة المشاريع</span>
              </a>
            </li>
          </ul>
        </div>

        <div>
          <h3 class="text-xl font-bold text-white mb-6 border-b-2 border-[#f3a446]/30 pb-3 inline-block">
            تواصل معنا</h3>
          <ul class="space-y-4">
            <li class="flex items-start gap-3 text-gray-300">
              <i class="fas fa-phone text-[#f3a446] text-lg mt-1"></i>
              <span dir="ltr">+966 50 123 4567</span>
            </li>
            <li class="flex items-start gap-3 text-gray-300">
              <i class="fas fa-envelope text-[#f3a446] text-lg mt-1"></i>
              <span>info@inshaat.com</span>
            </li>
            <li class="flex items-start gap-3 text-gray-300">
              <i class="fas fa-map-marker-alt text-[#f3a446] text-lg mt-1"></i>
              <span>الرياض، المملكة العربية السعودية</span>
            </li>
            <li class="flex items-start gap-3 text-gray-300">
              <i class="fas fa-clock text-[#f3a446] text-lg mt-1"></i>
              <span>الأحد - الخميس: 8:00 ص - 6:00 م</span>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="border-t border-white/10 pt-8 mt-12">
      <p class="text-center text-gray-400 text-sm">
        &copy; 2024 insha'at. جميع الحقوق محفوظة. | تصميم وتطوير بواسطة فريق insha'at
      </p>
    </div>
  </div>
</footer>
    <!-- Optimized Navigation JavaScript -->
    <!-- <script src="{{ asset('js/navigation.js') }}"></script> -->

    <!-- Flash Messages JavaScript -->
    <!-- <script>
        // Flash Messages functionality
        function closeFlashMessage() {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.classList.add('hide');
                setTimeout(() => {
                    flashMessage.remove();
                }, 300);
            }
        }

        // Auto-hide flash messages after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                setTimeout(() => {
                    if (flashMessage && !flashMessage.classList.contains('hide')) {
                        closeFlashMessage();
                    }
                }, 5000);
            }
        });

        // Close flash message on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeFlashMessage();
            }
        });

        // Close flash message when clicking outside
        document.addEventListener('click', function(e) {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage && !flashMessage.contains(e.target) && !e.target.closest('.flash-close')) {
                closeFlashMessage();
            }
        });
    </script> -->
</body>

</html>
