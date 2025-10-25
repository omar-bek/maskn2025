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

    <style>
        /* Critical CSS for better performance */
        :root {
            --primary-color: #0f766e;
            --primary-dark: #134e4a;
            --primary-light: #14b8a6;
            --secondary-color: #d97706;
            --secondary-light: #f59e0b;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --bg-light: #f8fafc;
            --white: #ffffff;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --border-radius: 0.75rem;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

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
            margin: 0 auto;
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

        /* Main content area */
        main {
            min-height: calc(100vh - 200px);
            padding: 2rem 0;
        }

        @media (max-width: 768px) {
            main {
                padding: 1rem 0;
                min-height: calc(100vh - 150px);
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
        .nav-link,
        .nav-button,
        .mobile-nav-link,
        .mobile-nav-button {
            transition: var(--transition);
            will-change: transform, opacity;
        }

        /* Optimized dropdown animations */
        .user-dropdown {
            transition: opacity 0.15s ease-in-out, transform 0.15s ease-in-out;
            will-change: opacity, transform;
        }

        .user-dropdown.hidden {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px);
            pointer-events: none;
        }

        /* Optimized header scroll effect */
        .header {
            transition: box-shadow 0.2s ease-in-out;
            will-change: box-shadow;
        }

        /* Prevent layout shifts */
        .header-content {
            min-height: 5rem;
        }

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
    <header class="header">
        <div class="container">
            <div class="header-content">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="logo" aria-label="الرئيسية">
                    <div class="logo-icon"></div>
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
                            class="nav-link {{ request()->routeIs('designs.*') ? 'active' : '' }}"
                            aria-label="التصاميم">
                            التصاميم
                        </a>
                        <a href="{{ route('tenders.index') }}"
                            class="nav-link {{ request()->routeIs('tenders.*') ? 'active' : '' }}"
                            aria-label="المناقصات">
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
                        <a href="#" class="nav-action-btn language-btn">
                            <i class="fas fa-globe"></i>
                            <span>العربية</span>
                        </a>

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
                <button class="mobile-menu-toggle" aria-label="القائمة" aria-expanded="false"
                    aria-controls="mobileMenu">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

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
                <div class="logo-icon"></div>
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
                <a href="{{ route('home') }}"
                    class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}" aria-label="الرئيسية">
                    <i class="fas fa-home"></i>
                    <span>الرئيسية</span>
                </a>
                <a href="{{ route('designs.index') }}"
                    class="mobile-nav-link {{ request()->routeIs('designs.*') ? 'active' : '' }}"
                    aria-label="التصاميم">
                    <i class="fas fa-home"></i>
                    <span>التصاميم</span>
                </a>
                <a href="{{ route('lands.create') }}"
                    class="mobile-nav-link {{ request()->routeIs('lands.create') ? 'active' : '' }}"
                    aria-label="بيع وتبادل الأراضي">
                    <i class="fas fa-exchange-alt"></i>
                    <span>بيع وتبادل الأراضي</span>
                </a>
            </div>

            <!-- Action Button -->
            @auth
                @if (auth()->user()->isConsultant())
                    <div class="mobile-nav-section">
                        <a href="{{ route('designs.create') }}"
                            class="mobile-nav-button {{ request()->routeIs('designs.create') ? 'active' : '' }}"
                            aria-label="أضف تصميم">
                            <i class="fas fa-plus"></i>
                            <span>أضف تصميم</span>
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
                        <i class="fas fa-user"></i>
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
        <div class="container">
            <div class="footer-content">
                <!-- Company Info -->
                <div class="footer-section">
                    <div class="footer-logo">
                        <div class="footer-logo-icon"></div>
                        <div class="footer-logo-text">insha'at</div>
                    </div>
                    <p class="footer-description">
                        منصة متخصصة في تصميم البيوت العصرية والإسلامية. نقدم أفضل التصاميم وأحدث التقنيات لبناء منزل
                        أحلامك.
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
                        <li><a href="{{ route('lands.create') }}" class="footer-link">بيع وتبادل الأراضي</a></li>
                        @auth
                            @if (auth()->user()->isConsultant())
                                <li><a href="{{ route('designs.create') }}" class="footer-link">أضف تصميم</a></li>
                            @endif
                        @endauth
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
        </div>
    </footer>

    <!-- Optimized Navigation JavaScript -->
    <script src="{{ asset('js/navigation.js') }}"></script>

    <!-- Flash Messages JavaScript -->
    <script>
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
    </script>
</body>

</html>
