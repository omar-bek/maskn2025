<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'insha\'at - منصة تصميم البيوت')</title>
    <meta name="description" content="@yield('description', 'منصة insha\'at لتصميم البيوت العصرية والإسلامية')">
    <meta name="theme-color" content="#0f766e">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* CSS محسن ومختصر */
        :root {
            --primary: #0f766e;
            --primary-dark: #134e4a;
            --primary-light: #14b8a6;
            --secondary: #d97706;
            --secondary-light: #f59e0b;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --bg-light: #f8fafc;
            --white: #ffffff;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --radius: 12px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Cairo', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background: var(--bg-light);
            direction: rtl;
            min-height: 100vh;
        }

        /* Header Styles */
        .header {
            background: var(--white);
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 80px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--primary);
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .logo-text {
            display: flex;
            flex-direction: column;
        }

        .logo-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .logo-subtitle {
            font-size: 0.75rem;
            color: var(--text-light);
        }

        /* Navigation */
        .nav {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary);
            background: rgba(15, 118, 110, 0.1);
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            right: 1rem;
            left: 1rem;
            height: 2px;
            background: var(--primary);
            border-radius: 2px;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-action-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            color: var(--text-dark);
            transition: all 0.3s ease;
            border: none;
            background: none;
            cursor: pointer;
            font-family: inherit;
        }

        .nav-action-btn:hover {
            background: rgba(15, 118, 110, 0.1);
            color: var(--primary);
        }

        .register-btn {
            background: var(--primary);
            color: white !important;
        }

        .register-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        /* User Menu */
        .user-menu {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Mobile Menu */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-dark);
            cursor: pointer;
            padding: 0.5rem;
        }

        .mobile-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 320px;
            height: 100vh;
            background: var(--white);
            box-shadow: -4px 0 20px rgba(0, 0, 0, 0.1);
            transition: right 0.3s ease;
            z-index: 1001;
            overflow-y: auto;
        }

        .mobile-menu.active {
            right: 0;
        }

        .mobile-menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .mobile-menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .mobile-menu-header {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .mobile-menu-close {
            background: none;
            border: none;
            font-size: 1.25rem;
            color: var(--text-dark);
            cursor: pointer;
            padding: 0.5rem;
        }

        .mobile-nav {
            padding: 1rem;
        }

        .mobile-nav-section {
            margin-bottom: 2rem;
        }

        .mobile-nav-section-title {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-light);
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .mobile-nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            text-decoration: none;
            color: var(--text-dark);
            border-radius: 8px;
            transition: all 0.3s ease;
            margin-bottom: 0.25rem;
        }

        .mobile-nav-link:hover,
        .mobile-nav-link.active {
            background: rgba(15, 118, 110, 0.1);
            color: var(--primary);
        }

        .mobile-nav-button {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            text-decoration: none;
            background: var(--primary);
            color: white;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin-bottom: 0.25rem;
            border: none;
            width: 100%;
            cursor: pointer;
            font-family: inherit;
        }

        .mobile-nav-button:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .mobile-user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            background: rgba(15, 118, 110, 0.05);
            border-radius: 12px;
            margin-bottom: 1rem;
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        .user-details {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .user-type {
            font-size: 0.875rem;
            color: var(--text-light);
        }

        .logout-link {
            color: #ef4444 !important;
        }

        .logout-link:hover {
            background: rgba(239, 68, 68, 0.1) !important;
        }

        /* Main Content */
        .main-content {
            min-height: calc(100vh - 200px);
            padding: 2rem 0;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Flash Messages */
        .flash-message {
            position: fixed;
            top: 100px;
            right: 20px;
            z-index: 10000;
            max-width: 400px;
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

        .flash-close {
            background: none;
            border: none;
            color: inherit;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .flash-close:hover {
            background: rgba(255, 255, 255, 0.2);
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

        /* Footer */
        .footer {
            background: var(--text-dark);
            color: white;
            padding: 3rem 0 1rem;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .footer-logo-icon {
            width: 32px;
            height: 32px;
            background: white;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: bold;
        }

        .footer-logo-text {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .footer-description {
            color: #d1d5db;
            line-height: 1.6;
        }

        .footer-social {
            display: flex;
            gap: 0.75rem;
        }

        .social-link {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: var(--primary);
            transform: translateY(-2px);
        }

        .footer-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: white;
        }

        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .footer-link {
            color: #d1d5db;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: white;
        }

        .footer-contact {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .footer-contact-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #d1d5db;
        }

        .footer-bottom {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1rem;
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid #374151;
            color: #9ca3af;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .nav-links {
                display: none;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .header-content {
                height: 70px;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1rem 0;
                min-height: calc(100vh - 150px);
            }

            .flash-message {
                top: 80px;
                right: 10px;
                left: 10px;
                max-width: none;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .nav-actions {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .header-content {
                padding: 0 0.5rem;
            }

            .container {
                padding: 0 0.5rem;
            }

            .mobile-menu {
                width: 100%;
            }
        }

        /* Utility Classes */
        .hidden {
            display: none !important;
        }

        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        /* Focus styles */
        button:focus,
        a:focus,
        input:focus,
        select:focus,
        textarea:focus {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }

        /* Mobile optimizations */
        @media (max-width: 768px) {

            input,
            select,
            textarea {
                font-size: 16px !important;
            }

            button,
            a {
                min-height: 44px;
                min-width: 44px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="logo" aria-label="الرئيسية">
                <div class="logo-icon">إ</div>
                <div class="logo-text">
                    <div class="logo-title">insha'at</div>
                    <div class="logo-subtitle">Your Partners for Your Home of Dreams</div>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="nav" role="navigation" aria-label="القائمة الرئيسية">
                <div class="nav-links">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                        aria-label="الرئيسية">
                        الرئيسية
                    </a>
                    <a href="{{ route('designs.index') }}"
                        class="nav-link {{ request()->routeIs('designs.*') ? 'active' : '' }}" aria-label="التصاميم">
                        التصاميم
                    </a>
                    <a href="{{ route('tenders.index') }}"
                        class="nav-link {{ request()->routeIs('tenders.*') ? 'active' : '' }}" aria-label="المناقصات">
                        المناقصات
                    </a>
                    <a href="{{ route('lands.create') }}"
                        class="nav-link {{ request()->routeIs('lands.create') ? 'active' : '' }}"
                        aria-label="بيع وتبادل الأراضي">
                        بيع وتبادل الأراضي
                    </a>
                    @auth
                        @if (auth()->user()->isConsultant())
                            <a href="{{ route('designs.create') }}"
                                class="nav-link {{ request()->routeIs('designs.create') ? 'active' : '' }}"
                                aria-label="أضف تصميم">
                                أضف تصميم
                            </a>
                            <a href="{{ route('proposals.index') }}"
                                class="nav-link {{ request()->routeIs('proposals.*') ? 'active' : '' }}"
                                aria-label="عروضي">
                                عروضي
                            </a>
                        @elseif(auth()->user()->isClient())
                            <a href="{{ route('tenders.create') }}"
                                class="nav-link {{ request()->routeIs('tenders.create') ? 'active' : '' }}"
                                aria-label="إنشاء مناقصة">
                                إنشاء مناقصة
                            </a>
                        @endif
                    @endauth
                </div>

                <div class="nav-actions">
                    <!-- Language Button -->
                    <button class="nav-action-btn language-btn">
                        <i class="fas fa-globe"></i>
                        <span>العربية</span>
                    </button>

                    @auth
                        <!-- User Menu -->
                        <div class="user-menu">
                            <a href="{{ Auth::user()->getDashboardRoute() }}" class="nav-action-btn user-btn">
                                <i class="fas fa-user"></i>
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <a href="{{ route(Auth::user()->userType->name . '.profile') }}"
                                class="nav-action-btn profile-btn">
                                <i class="fas fa-cog"></i>
                                <span>الملف الشخصي</span>
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                                @csrf
                                <button type="submit" class="nav-action-btn logout-btn">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>تسجيل الخروج</span>
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- Auth Buttons -->
                        <a href="{{ route('login') }}" class="nav-action-btn login-btn">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>تسجيل الدخول</span>
                        </a>
                        <a href="{{ route('register') }}" class="nav-action-btn register-btn">
                            <i class="fas fa-user-plus"></i>
                            <span>إنشاء حساب</span>
                        </a>
                    @endauth
                </div>
            </nav>

            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" aria-label="القائمة" aria-expanded="false" aria-controls="mobileMenu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu" role="navigation" aria-label="القائمة الرئيسية">
        <!-- Mobile Menu Header -->
        <div class="mobile-menu-header">
            <button class="mobile-menu-close" aria-label="إغلاق القائمة">
                <i class="fas fa-times"></i>
            </button>
            <div class="mobile-logo">
                <div class="logo-icon">إ</div>
                <div class="logo-text">
                    <div class="logo-title">insha'at</div>
                    <div class="logo-subtitle">Your Partners for Your Home of Dreams</div>
                </div>
            </div>
        </div>

        <nav class="mobile-nav">
            <!-- Main Navigation Links -->
            <div class="mobile-nav-section">
                <h3 class="mobile-nav-section-title">القائمة الرئيسية</h3>
                <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                    aria-label="الرئيسية">
                    <i class="fas fa-home"></i>
                    <span>الرئيسية</span>
                </a>
                <a href="{{ route('designs.index') }}"
                    class="mobile-nav-link {{ request()->routeIs('designs.*') ? 'active' : '' }}"
                    aria-label="التصاميم">
                    <i class="fas fa-palette"></i>
                    <span>التصاميم</span>
                </a>
                <a href="{{ route('tenders.index') }}"
                    class="mobile-nav-link {{ request()->routeIs('tenders.*') ? 'active' : '' }}"
                    aria-label="المناقصات">
                    <i class="fas fa-file-contract"></i>
                    <span>المناقصات</span>
                </a>
                <a href="{{ route('lands.create') }}"
                    class="mobile-nav-link {{ request()->routeIs('lands.create') ? 'active' : '' }}"
                    aria-label="بيع وتبادل الأراضي">
                    <i class="fas fa-exchange-alt"></i>
                    <span>بيع وتبادل الأراضي</span>
                </a>
            </div>

            <!-- Action Buttons -->
            @auth
                @if (auth()->user()->isConsultant())
                    <div class="mobile-nav-section">
                        <a href="{{ route('designs.create') }}"
                            class="mobile-nav-button {{ request()->routeIs('designs.create') ? 'active' : '' }}"
                            aria-label="أضف تصميم">
                            <i class="fas fa-plus"></i>
                            <span>أضف تصميم</span>
                        </a>
                        <a href="{{ route('proposals.index') }}"
                            class="mobile-nav-link {{ request()->routeIs('proposals.*') ? 'active' : '' }}"
                            aria-label="عروضي">
                            <i class="fas fa-file-alt"></i>
                            <span>عروضي</span>
                        </a>
                    </div>
                @elseif(auth()->user()->isClient())
                    <div class="mobile-nav-section">
                        <a href="{{ route('tenders.create') }}"
                            class="mobile-nav-button {{ request()->routeIs('tenders.create') ? 'active' : '' }}"
                            aria-label="إنشاء مناقصة">
                            <i class="fas fa-plus"></i>
                            <span>إنشاء مناقصة</span>
                        </a>
                    </div>
                @endif
            @endauth

            @auth
                <!-- User Section -->
                <div class="mobile-nav-section">
                    <div class="mobile-user-info">
                        <div class="user-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="user-details">
                            <h4 class="user-name">{{ Auth::user()->name }}</h4>
                            <p class="user-type">
                                {{ Auth::user()->userType->display_name_ar ?? Auth::user()->userType->name }}</p>
                        </div>
                    </div>

                    <h3 class="mobile-nav-section-title">حسابي</h3>
                    <a href="{{ Auth::user()->getDashboardRoute() }}" class="mobile-nav-link" aria-label="لوحة التحكم">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>لوحة التحكم</span>
                    </a>
                    <a href="{{ route(Auth::user()->userType->name . '.profile') }}" class="mobile-nav-link"
                        aria-label="الملف الشخصي">
                        <i class="fas fa-user-cog"></i>
                        <span>الملف الشخصي</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="mobile-nav-link logout-link" aria-label="تسجيل الخروج">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>تسجيل الخروج</span>
                        </button>
                    </form>
                </div>
            @else
                <!-- Guest Section -->
                <div class="mobile-nav-section">
                    <h3 class="mobile-nav-section-title">حساب المستخدم</h3>
                    <a href="{{ route('login') }}" class="mobile-nav-link" aria-label="تسجيل الدخول">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>تسجيل الدخول</span>
                    </a>
                    <a href="{{ route('register') }}" class="mobile-nav-button" aria-label="إنشاء حساب">
                        <i class="fas fa-user-plus"></i>
                        <span>إنشاء حساب</span>
                    </a>
                </div>
            @endauth

            <!-- Language Section -->
            <div class="mobile-nav-section">
                <h3 class="mobile-nav-section-title">اللغة</h3>
                <a href="#" class="mobile-nav-link active" aria-label="العربية">
                    <i class="fas fa-globe"></i>
                    <span>العربية</span>
                    <i class="fas fa-check"></i>
                </a>
                <a href="#" class="mobile-nav-link" aria-label="English">
                    <i class="fas fa-globe"></i>
                    <span>English</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
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
    <footer class="footer">
        <div class="footer-content">
            <!-- Company Info -->
            <div class="footer-section">
                <div class="footer-logo">
                    <div class="footer-logo-icon">إ</div>
                    <div class="footer-logo-text">insha'at</div>
                </div>
                <p class="footer-description">
                    منصة متخصصة في تصميم البيوت العصرية والإسلامية. نقدم أفضل التصاميم وأحدث التقنيات لبناء منزل أحلامك.
                </p>
                <div class="footer-social">
                    <a href="#" class="social-link" aria-label="فيسبوك">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="تويتر">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="إنستغرام">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="لينكد إن">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-section">
                <h3 class="footer-title">روابط سريعة</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}" class="footer-link">الرئيسية</a></li>
                    <li><a href="{{ route('designs.index') }}" class="footer-link">التصاميم</a></li>
                    <li><a href="{{ route('tenders.index') }}" class="footer-link">المناقصات</a></li>
                    <li><a href="{{ route('lands.create') }}" class="footer-link">بيع وتبادل الأراضي</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div class="footer-section">
                <h3 class="footer-title">خدماتنا</h3>
                <ul class="footer-links">
                    <li><a href="#" class="footer-link">تصميم منازل</a></li>
                    <li><a href="#" class="footer-link">تصميم فيلات</a></li>
                    <li><a href="#" class="footer-link">تصميم شقق</a></li>
                    <li><a href="#" class="footer-link">تصميم تجاري</a></li>
                    <li><a href="#" class="footer-link">استشارات معمارية</a></li>
                    <li><a href="#" class="footer-link">إدارة المشاريع</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="footer-section">
                <h3 class="footer-title">تواصل معنا</h3>
                <ul class="footer-contact">
                    <li class="footer-contact-item">
                        <i class="fas fa-phone"></i>
                        <span>+966 50 123 4567</span>
                    </li>
                    <li class="footer-contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>info@inshaat.com</span>
                    </li>
                    <li class="footer-contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>الرياض، المملكة العربية السعودية</span>
                    </li>
                    <li class="footer-contact-item">
                        <i class="fas fa-clock"></i>
                        <span>الأحد - الخميس: 8:00 ص - 6:00 م</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>&copy; 2024 insha'at. جميع الحقوق محفوظة. | تصميم وتطوير بواسطة فريق insha'at</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Mobile Menu Functionality
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const mobileMenuClose = document.querySelector('.mobile-menu-close');

        function toggleMobileMenu() {
            mobileMenu.classList.toggle('active');
            mobileMenuOverlay.classList.toggle('active');
            document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
        }

        mobileMenuToggle.addEventListener('click', toggleMobileMenu);
        mobileMenuClose.addEventListener('click', toggleMobileMenu);
        mobileMenuOverlay.addEventListener('click', toggleMobileMenu);

        // Close mobile menu on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                toggleMobileMenu();
            }
        });

        // Flash Messages functionality
        function closeFlashMessage() {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.style.animation = 'slideInRight 0.3s ease-out reverse';
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
                    if (flashMessage && document.body.contains(flashMessage)) {
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

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.1)';
            } else {
                header.style.boxShadow = 'var(--shadow)';
            }
        });

        // Loading states
        document.addEventListener('DOMContentLoaded', () => {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', () => {
                    form.classList.add('loading');
                });
            });
        });
    </script>
</body>

</html>
