<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'insha\'at - منصة تصميم البيوت')</title>
    <meta name="description" content="@yield('description', 'منصة insha\'at لتصميم البيوت العصرية والإسلامية')">

    <!-- Preload critical resources -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style">
    <link rel="preload" href="{{ asset('css/custom.css') }}" as="style">

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
        }

        /* Optimized transitions */
        .nav-link, .nav-button, .mobile-nav-link, .mobile-nav-button {
            transition: all 0.2s ease-in-out;
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

        /* Optimized mobile menu */
        .mobile-menu {
            transition: opacity 0.2s ease-in-out, transform 0.2s ease-in-out;
            will-change: opacity, transform;
        }

        .mobile-menu:not(.active) {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            pointer-events: none;
        }

        /* Optimized header scroll effect */
        .header {
            transition: box-shadow 0.2s ease-in-out;
            will-change: box-shadow;
        }

        /* Prevent layout shifts */
        .header-content {
            min-height: 4rem;
        }

        @media (max-width: 768px) {
            .header-content {
                min-height: 3.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-container">
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
                <nav class="nav" role="navigation">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" aria-label="الرئيسية">
                        الرئيسية
                    </a>
                    <a href="{{ route('designs.index') }}" class="nav-link {{ request()->routeIs('designs.*') ? 'active' : '' }}" aria-label="التصاميم">
                        التصاميم
                    </a>
                    <a href="{{ route('projects.index') }}" class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}" aria-label="المشاريع">
                        المشاريع
                    </a>
                    <a href="{{ route('lands.create') }}" class="nav-link {{ request()->routeIs('lands.create') ? 'active' : '' }}" aria-label="بيع وتبادل الأراضي">
                        بيع وتبادل الأراضي
                    </a>
                    <a href="{{ route('cost-calculator.index') }}" class="nav-link {{ request()->routeIs('cost-calculator.*') ? 'active' : '' }}" aria-label="حاسبة التكلفة">
                        حاسبة التكلفة
                    </a>
                    <a href="{{ route('designs.create') }}" class="nav-button" aria-label="أضف تصميم">
                        <i class="fas fa-plus ml-1"></i>
                        أضف تصميم
                    </a>
                    @auth
                        <!-- User Dropdown -->
                        <div class="relative inline-block text-right">
                            <button onclick="toggleUserDropdown()" class="flex items-center space-x-2 space-x-reverse nav-link hover:bg-gray-100 rounded-lg px-3 py-2 transition-colors" aria-label="قائمة المستخدم" aria-expanded="false" aria-haspopup="true">
                                <div class="w-8 h-8 bg-teal-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <span class="hidden md:block">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-gray-500 text-xs"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="userDropdown" class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 border border-gray-200 hidden user-dropdown" role="menu">
                                <div class="py-1">
                                    <!-- Dashboard -->
                                    <a href="{{ Auth::user()->getDashboardRoute() }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors" role="menuitem">
                                        <i class="fas fa-tachometer-alt ml-3 text-teal-600"></i>
                                        لوحة التحكم
                                    </a>

                                    @if(Auth::user()->isClient())
                                        <!-- Manage Projects -->
                                        <a href="{{ route('client.projects') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors" role="menuitem">
                                            <i class="fas fa-project-diagram ml-3 text-green-600"></i>
                                            إدارة المشاريع
                                        </a>

                                        <!-- Manage Offers -->
                                        <a href="{{ route('client.offers') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors" role="menuitem">
                                            <i class="fas fa-file-alt ml-3 text-blue-600"></i>
                                            العروض المقدمة
                                        </a>
                                    @endif

                                    <!-- Profile -->
                                    <a href="{{ route(Auth::user()->userType->name . '.profile') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors" role="menuitem">
                                        <i class="fas fa-user ml-3 text-blue-600"></i>
                                        الملف الشخصي
                                    </a>

                                    <div class="border-t border-gray-200 my-1"></div>

                                    <!-- Logout -->
                                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                                        @csrf
                                        <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors" role="menuitem">
                                            <i class="fas fa-sign-out-alt ml-3"></i>
                                            تسجيل الخروج
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="nav-link" aria-label="تسجيل الدخول">
                            <i class="fas fa-sign-in-alt ml-1"></i>
                            تسجيل الدخول
                        </a>
                        <a href="{{ route('register') }}" class="nav-button" aria-label="إنشاء حساب">
                            <i class="fas fa-user-plus ml-1"></i>
                            إنشاء حساب
                        </a>
                    @endauth
                </nav>

                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" onclick="toggleMobileMenu()" aria-label="القائمة" aria-expanded="false" aria-controls="mobileMenu">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div class="mobile-menu" id="mobileMenu" role="navigation" aria-label="القائمة الرئيسية">
                <nav class="mobile-nav">
                    <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}" aria-label="الرئيسية">
                        <i class="fas fa-home ml-2"></i>
                        الرئيسية
                    </a>
                    <a href="{{ route('designs.index') }}" class="mobile-nav-link {{ request()->routeIs('designs.*') ? 'active' : '' }}" aria-label="التصاميم">
                        <i class="fas fa-home ml-2"></i>
                        التصاميم
                    </a>
                    <a href="{{ route('projects.index') }}" class="mobile-nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}" aria-label="المشاريع">
                        <i class="fas fa-project-diagram ml-2"></i>
                        المشاريع
                    </a>
                    <a href="{{ route('lands.create') }}" class="mobile-nav-link {{ request()->routeIs('lands.create') ? 'active' : '' }}" aria-label="بيع وتبادل الأراضي">
                        <i class="fas fa-exchange-alt ml-2"></i>
                        بيع وتبادل الأراضي
                    </a>
                    <a href="{{ route('cost-calculator.index') }}" class="mobile-nav-link {{ request()->routeIs('cost-calculator.*') ? 'active' : '' }}" aria-label="حاسبة التكلفة">
                        <i class="fas fa-calculator ml-2"></i>
                        حاسبة التكلفة
                    </a>
                    <a href="{{ route('designs.create') }}" class="mobile-nav-button" aria-label="أضف تصميم">
                        <i class="fas fa-plus ml-2"></i>
                        أضف تصميم
                    </a>
                    @auth
                        <!-- User Info -->
                        <div class="border-t border-gray-200 pt-4 mt-4">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-teal-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div class="mr-3">
                                    <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ Auth::user()->userType->display_name_ar ?? Auth::user()->userType->name }}</p>
                                </div>
                            </div>

                            <!-- Dashboard -->
                            <a href="{{ Auth::user()->getDashboardRoute() }}" class="mobile-nav-link" aria-label="لوحة التحكم">
                                <i class="fas fa-tachometer-alt ml-2 text-teal-600"></i>
                                لوحة التحكم
                            </a>

                            @if(Auth::user()->isClient())
                                <!-- Manage Projects -->
                                <a href="{{ route('client.projects') }}" class="mobile-nav-link" aria-label="إدارة المشاريع">
                                    <i class="fas fa-project-diagram ml-2 text-green-600"></i>
                                    إدارة المشاريع
                                </a>

                                <!-- Manage Offers -->
                                <a href="{{ route('client.offers') }}" class="mobile-nav-link" aria-label="العروض المقدمة">
                                    <i class="fas fa-file-alt ml-2 text-blue-600"></i>
                                    العروض المقدمة
                                </a>
                            @endif

                            <!-- Profile -->
                            <a href="{{ route(Auth::user()->userType->name . '.profile') }}" class="mobile-nav-link" aria-label="الملف الشخصي">
                                <i class="fas fa-user ml-2 text-blue-600"></i>
                                الملف الشخصي
                            </a>

                            <!-- Logout -->
                            <form action="{{ route('logout') }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="mobile-nav-link text-red-600 hover:text-red-700 w-full text-right" aria-label="تسجيل الخروج">
                                    <i class="fas fa-sign-out-alt ml-2"></i>
                                    تسجيل الخروج
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="mobile-nav-link" aria-label="تسجيل الدخول">
                            <i class="fas fa-sign-in-alt ml-2"></i>
                            تسجيل الدخول
                        </a>
                        <a href="{{ route('register') }}" class="mobile-nav-button" aria-label="إنشاء حساب">
                            <i class="fas fa-user-plus ml-2"></i>
                            إنشاء حساب
                        </a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main style="min-height: calc(100vh - 200px);">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <!-- Company Info -->
                <div class="footer-section">
                    <div class="footer-logo">
                        <div class="footer-logo-icon"></div>
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
                        <li><a href="{{ route('projects.index') }}" class="footer-link">المشاريع</a></li>
                        <li><a href="{{ route('lands.create') }}" class="footer-link">بيع وتبادل الأراضي</a></li>
                        <li><a href="{{ route('designs.create') }}" class="footer-link">أضف تصميم</a></li>
                        <li><a href="{{ route('cost-calculator.index') }}" class="footer-link">حاسبة التكلفة</a></li>
                        <li><a href="#" class="footer-link">المصممين</a></li>
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
</body>
</html>
