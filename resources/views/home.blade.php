@extends('layouts.app')

@section('title', 'انشاءات - منصة التصميم والبناء الرائدة')

@section('content')
    <style>
        /* Modern Design System */
        :root {
            --primary: #0f766e;
            --primary-dark: #0d9488;
            --secondary: #f59e0b;
            --accent: #8b5cf6;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --light: #f8fafc;
            --dark: #1e293b;
            --gradient-primary: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
            --gradient-secondary: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
            --gradient-accent: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
        }

        /* Hero Section */
        .hero-section {
            @if (\App\Models\SiteSetting::get('hero_background'))
                background: linear-gradient(135deg, rgba(15, 118, 110, 0.8) 0%, rgba(20, 184, 166, 0.8) 50%, rgba(13, 148, 136, 0.8) 100%), url('{{ \App\Models\SiteSetting::get('hero_background') }}');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            @else
                background: linear-gradient(135deg, #0f766e 0%, #14b8a6 50%, #0d9488 100%);
            @endif
            position: relative;
            overflow: hidden;
            min-height: 100vh;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
            pointer-events: none;
        }

        /* Glass Morphism Cards */
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            background: rgba(255, 255, 255, 0.98);
        }

        /* Modern Buttons */
        .btn-primary {
            background: var(--gradient-primary);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0d9488, #0f766e);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .btn-secondary {
            background: var(--gradient-secondary);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #f97316, #f59e0b);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Feature Cards */
        .feature-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Stats Cards */
        .stats-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(15, 118, 110, 0.1), transparent);
            transition: left 0.5s;
        }

        .stats-card:hover::before {
            left: 100%;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        /* Process Steps */
        .process-step {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-bottom: 1rem;
        }

        .process-step:hover {
            background: linear-gradient(135deg, #f0fdfa 0%, #fef3c7 100%);
            transform: translateX(-8px);
            box-shadow: 0 10px 25px rgba(15, 118, 110, 0.1);
        }

        .step-number {
            width: 48px;
            height: 48px;
            background: var(--gradient-primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.25rem;
            margin-left: 1rem;
            box-shadow: 0 4px 15px rgba(15, 118, 110, 0.3);
        }

        /* Testimonial Card */
        .testimonial-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
            position: relative;
        }

        .testimonial-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 30px 30px 0;
            border-color: transparent #0f766e transparent transparent;
        }

        /* Animations */
        .animate-fade-in {
            animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .animate-slide-in {
            animation: slideInRight 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .animate-bounce-in {
            animation: bounceIn 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
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

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }

            50% {
                opacity: 1;
                transform: scale(1.05);
            }

            70% {
                transform: scale(0.9);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Floating Elements */
        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }

        .floating-element {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            top: 20%;
            right: 15%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            bottom: 30%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-section {
                min-height: 80vh;
                padding: 2rem 0;
            }

            .feature-card,
            .stats-card,
            .testimonial-card {
                padding: 1.5rem;
            }

            .process-step:hover {
                transform: translateY(-5px);
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gradient-primary);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #0d9488, #0f766e);
        }
    </style>

    <!-- Hero Section -->
    <section class="hero-section text-white relative">
        <div class="floating-elements">
            <div class="floating-element">
                <i class="fas fa-building text-4xl text-white"></i>
            </div>
            <div class="floating-element">
                <i class="fas fa-home text-3xl text-white"></i>
            </div>
            <div class="floating-element">
                <i class="fas fa-drafting-compass text-2xl text-white"></i>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Content -->
                <div class="text-right animate-fade-in">
                    <div class="mb-6 flex items-center justify-end gap-4">
                        @if (\App\Models\SiteSetting::get('site_logo'))
                            <div class="w-20 h-20 bg-white rounded-full p-3 shadow-lg">
                                <img src="{{ \App\Models\SiteSetting::get('site_logo') }}" alt="لوجو انشاءات"
                                    class="w-full h-full object-contain">
                            </div>
                        @else
                            <span class="glass-card text-gray-800 px-4 py-2 rounded-full text-sm font-medium">
                                🏗️ منصة التصميم والبناء الرائدة
                            </span>
                        @endif
                    </div>

                    <h1 class="text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                        ابدأ رحلة مشروعك
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-orange-300">
                            مع انشاءات
                        </span>
                    </h1>

                    <p class="text-xl text-white/90 mb-8 leading-relaxed">
                        منصة متكاملة تجمع بين أفضل الاستشاريين والمقاولين والموردين لتحويل أحلامك المعمارية إلى واقع ملموس.
                        من التصميم حتى التسليم النهائي.
                    </p>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                        <div class="glass-card text-center p-4">
                            <div class="text-2xl font-bold text-gray-800 mb-1">
                                {{ number_format($stats['total_consultants']) }}+</div>
                            <div class="text-sm text-gray-600">استشاري معتمد</div>
                        </div>
                        <div class="glass-card text-center p-4">
                            <div class="text-2xl font-bold text-gray-800 mb-1">
                                {{ number_format($stats['total_projects']) }}+</div>
                            <div class="text-sm text-gray-600">مشروع مكتمل</div>
                        </div>
                        <div class="glass-card text-center p-4">
                            <div class="text-2xl font-bold text-gray-800 mb-1">{{ number_format($stats['total_designs']) }}+
                            </div>
                            <div class="text-sm text-gray-600">تصميم متاح</div>
                        </div>
                        <div class="glass-card text-center p-4">
                            <div class="text-2xl font-bold text-gray-800 mb-1">24/7</div>
                            <div class="text-sm text-gray-600">دعم فني</div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        @auth
                            @if (auth()->user()->isConsultant())
                                <a href="{{ route('designs.create') }}" class="btn-primary text-lg py-4 px-8">
                                    <i class="fas fa-plus"></i>
                                    إنشاء تصميم جديد
                                </a>
                            @else
                                <a href="{{ route('tenders.create') }}" class="btn-primary text-lg py-4 px-8">
                                    <i class="fas fa-file-contract"></i>
                                    إنشاء مناقصة
                                </a>
                            @endif
                        @else
                            <a href="{{ route('register') }}" class="btn-primary text-lg py-4 px-8">
                                <i class="fas fa-user-plus"></i>
                                انضم إلينا الآن
                            </a>
                        @endauth

                        <a href="{{ route('designs.index') }}" class="btn-secondary text-lg py-4 px-8">
                            <i class="fas fa-eye"></i>
                            تصفح التصميمات
                        </a>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="relative animate-slide-in">
                    <div class="glass-card p-8">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                                alt="مباني حديثة" class="w-full h-96 object-cover rounded-xl">
                            <div class="absolute inset-0 bg-gradient-to-br from-teal-600/30 to-amber-600/30 rounded-xl">
                            </div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="glass-card p-6 text-center">
                                    <i class="fas fa-building text-4xl text-teal-600 mb-3"></i>
                                    <p class="font-semibold text-gray-800">تصميم وبناء احترافي</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    لماذا تختار منصة انشاءات؟
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    نقدم حلول متكاملة تجمع بين التكنولوجيا الحديثة والخبرة العملية لضمان نجاح مشروعك
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="feature-card animate-fade-in">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">شبكة واسعة من الخبراء</h3>
                    <p class="text-gray-600 leading-relaxed">
                        أكثر من 500 استشاري ومقاول معتمد في جميع أنحاء المنطقة، مع ضمان الجودة والاحترافية
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card animate-fade-in" style="animation-delay: 0.1s">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-500 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-calculator text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">حاسبة تكلفة ذكية</h3>
                    <p class="text-gray-600 leading-relaxed">
                        احصل على تقدير دقيق لتكلفة مشروعك بناءً على المواصفات والموقع والمواد المطلوبة
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card animate-fade-in" style="animation-delay: 0.2s">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">ضمان الجودة</h3>
                    <p class="text-gray-600 leading-relaxed">
                        جميع المشاريع تخضع لمراجعة دقيقة وضمان الجودة مع متابعة مستمرة حتى التسليم
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card animate-fade-in" style="animation-delay: 0.3s">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-mobile-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">منصة متكاملة</h3>
                    <p class="text-gray-600 leading-relaxed">
                        إدارة مشروعك من مكان واحد: التصميم، المناقصات، المتابعة، والدفع الآمن
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="feature-card animate-fade-in" style="animation-delay: 0.4s">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-clock text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">تسليم في الوقت المحدد</h3>
                    <p class="text-gray-600 leading-relaxed">
                        التزامنا بتسليم مشروعك في الوقت المحدد مع الحفاظ على أعلى معايير الجودة
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="feature-card animate-fade-in" style="animation-delay: 0.5s">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-headset text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">دعم فني 24/7</h3>
                    <p class="text-gray-600 leading-relaxed">
                        فريق دعم فني متاح على مدار الساعة لمساعدتك في أي استفسار أو مشكلة تواجهها
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    كيف تعمل منصة انشاءات؟
                </h2>
                <p class="text-xl text-gray-600">
                    خطوات بسيطة لتحويل فكرتك إلى مشروع حقيقي
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Steps -->
                <div class="space-y-6">
                    <div class="process-step">
                        <div class="step-number">1</div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">أرفق متطلباتك</h3>
                            <p class="text-gray-600 text-sm">اكتب تفاصيل مشروعك، المساحة، الموقع، والميزانية المتوقعة</p>
                        </div>
                    </div>

                    <div class="process-step">
                        <div class="step-number">2</div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">احصل على عروض متنوعة</h3>
                            <p class="text-gray-600 text-sm">استقبل عروض من أفضل الاستشاريين والمقاولين في منطقتك</p>
                        </div>
                    </div>

                    <div class="process-step">
                        <div class="step-number">3</div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">قارن واختر الأفضل</h3>
                            <p class="text-gray-600 text-sm">قارن العروض واختر الأنسب لمشروعك وميزانيتك</p>
                        </div>
                    </div>

                    <div class="process-step">
                        <div class="step-number">4</div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">ابدأ مشروعك</h3>
                            <p class="text-gray-600 text-sm">تابع تقدم المشروع مع فريق الدعم حتى التسليم النهائي</p>
                        </div>
                    </div>
                </div>

                <!-- Image -->
                <div class="relative">
                    <div class="glass-card p-8">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=2073&q=80"
                                alt="مكتب تصميم معماري" class="w-full h-96 object-cover rounded-xl">
                            <div class="absolute inset-0 bg-gradient-to-br from-teal-600/20 to-amber-600/20 rounded-xl">
                            </div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="glass-card p-6 text-center">
                                    <i class="fas fa-drafting-compass text-4xl text-teal-600 mb-3"></i>
                                    <p class="font-semibold text-gray-800">تصميم احترافي</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">أرقام تتحدث عن نفسها</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    منصة انشاءات في أرقام - إنجازاتنا تتحدث عن جودة خدماتنا
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="stats-card animate-bounce-in">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-teal-500 to-teal-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <div class="text-4xl font-bold text-teal-600 mb-2">{{ number_format($stats['total_consultants']) }}+
                    </div>
                    <p class="text-gray-600">استشاري ومقاول معتمد</p>
                </div>

                <div class="stats-card animate-bounce-in" style="animation-delay: 0.1s">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-amber-500 to-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-home text-white text-2xl"></i>
                    </div>
                    <div class="text-4xl font-bold text-amber-600 mb-2">{{ number_format($stats['total_projects']) }}+
                    </div>
                    <p class="text-gray-600">مشروع مكتمل بنجاح</p>
                </div>

                <div class="stats-card animate-bounce-in" style="animation-delay: 0.2s">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-drafting-compass text-white text-2xl"></i>
                    </div>
                    <div class="text-4xl font-bold text-purple-600 mb-2">{{ number_format($stats['total_designs']) }}+
                    </div>
                    <p class="text-gray-600">تصميم متاح</p>
                </div>

                <div class="stats-card animate-bounce-in" style="animation-delay: 0.3s">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-star text-white text-2xl"></i>
                    </div>
                    <div class="text-4xl font-bold text-green-600 mb-2">4.9</div>
                    <p class="text-gray-600">تقييم العملاء</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Site Gallery Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    <span class="gradient-text">معرض صور الموقع</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    اكتشف جمال التصاميم المعمارية والإنجازات الهندسية في معرضنا المتنوع
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Site Logo -->
                <div class="glass-card p-6 text-center hover-lift">
                    <div
                        class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center overflow-hidden border-2 border-gray-200">
                        @if (\App\Models\SiteSetting::get('site_logo'))
                            <img src="{{ \App\Models\SiteSetting::get('site_logo') }}" alt="لوجو الموقع"
                                class="max-w-full max-h-full object-contain">
                        @else
                            <i class="fas fa-image text-3xl text-gray-400"></i>
                        @endif
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">لوجو الموقع</h3>
                    <p class="text-sm text-gray-600">الهوية البصرية لمنصة انشاءات</p>
                </div>

                <!-- Hero Background -->
                <div class="glass-card p-6 text-center hover-lift">
                    <div
                        class="w-full h-20 mb-4 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden border-2 border-gray-200">
                        @if (\App\Models\SiteSetting::get('hero_background'))
                            <img src="{{ \App\Models\SiteSetting::get('hero_background') }}" alt="خلفية الصفحة الرئيسية"
                                class="w-full h-full object-cover">
                        @else
                            <i class="fas fa-image text-2xl text-gray-400"></i>
                        @endif
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">خلفية الصفحة الرئيسية</h3>
                    <p class="text-sm text-gray-600">صورة تعبيرية عن رؤيتنا</p>
                </div>

                <!-- About Image -->
                <div class="glass-card p-6 text-center hover-lift">
                    <div
                        class="w-full h-20 mb-4 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden border-2 border-gray-200">
                        @if (\App\Models\SiteSetting::get('about_image'))
                            <img src="{{ \App\Models\SiteSetting::get('about_image') }}" alt="صورة قسم من نحن"
                                class="w-full h-full object-cover">
                        @else
                            <i class="fas fa-image text-2xl text-gray-400"></i>
                        @endif
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">صورة قسم من نحن</h3>
                    <p class="text-sm text-gray-600">تعرف على فريقنا وخبراتنا</p>
                </div>

                <!-- Site Favicon -->
                <div class="glass-card p-6 text-center hover-lift">
                    <div
                        class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden border-2 border-gray-200">
                        @if (\App\Models\SiteSetting::get('site_favicon'))
                            <img src="{{ \App\Models\SiteSetting::get('site_favicon') }}" alt="أيقونة الموقع"
                                class="max-w-full max-h-full object-contain">
                        @else
                            <i class="fas fa-image text-xl text-gray-400"></i>
                        @endif
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">أيقونة الموقع</h3>
                    <p class="text-sm text-gray-600">الرمز المميز للمنصة</p>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="text-center mt-12">
                <div class="glass-card p-8 max-w-2xl mx-auto">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">هل تريد رؤية المزيد؟</h3>
                    <p class="text-gray-600 mb-6">استكشف مجموعتنا الكاملة من التصاميم والمشاريع المتنوعة</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('designs.index') }}" class="btn btn-primary">
                            <i class="fas fa-drafting-compass ml-2"></i>
                            تصفح التصاميم
                        </a>
                        <a href="{{ route('tenders.index') }}" class="btn btn-secondary">
                            <i class="fas fa-file-contract ml-2"></i>
                            المناقصات المتاحة
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="py-20 bg-gradient-to-br from-gray-50 to-teal-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Content -->
                <div class="text-right">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">
                        <span class="gradient-text">من نحن</span>
                    </h2>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        منصة انشاءات هي منصة رائدة في مجال التصميم والبناء، تجمع بين أفضل الاستشاريين والمقاولين والموردين
                        لتقديم حلول متكاملة لمشاريعكم المعمارية.
                    </p>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        نؤمن بأن كل مشروع له قصة فريدة، ونسعى لتحويل أحلامكم المعمارية إلى واقع ملموس من خلال فريق من
                        الخبراء المتخصصين والتقنيات الحديثة.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('designs.index') }}" class="btn btn-primary">
                            <i class="fas fa-drafting-compass ml-2"></i>
                            تصفح التصاميم
                        </a>
                        <a href="{{ route('tenders.index') }}" class="btn btn-secondary">
                            <i class="fas fa-file-contract ml-2"></i>
                            المناقصات المتاحة
                        </a>
                    </div>
                </div>

                <!-- Image -->
                <div class="text-center">
                    <div class="glass-card p-8">
                        @if (\App\Models\SiteSetting::get('about_image'))
                            <img src="{{ \App\Models\SiteSetting::get('about_image') }}" alt="من نحن - انشاءات"
                                class="w-full h-80 object-cover rounded-lg shadow-lg">
                        @else
                            <div
                                class="w-full h-80 bg-gradient-to-br from-teal-100 to-blue-100 rounded-lg flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-building text-6xl text-teal-500 mb-4"></i>
                                    <h3 class="text-2xl font-bold text-gray-700">منصة انشاءات</h3>
                                    <p class="text-gray-600">شركاؤك في بناء أحلامك</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-gradient-to-br from-gray-50 to-teal-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">ماذا يقول عملاؤنا؟</h2>
                <p class="text-xl text-gray-600">تجارب حقيقية من عملائنا الكرام</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Testimonial 1 -->
                <div class="testimonial-card animate-fade-in">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-quote-right text-amber-600"></i>
                        </div>
                    </div>

                    <blockquote class="text-gray-700 text-lg mb-6 leading-relaxed">
                        "منصة انشاءات ساعدتني في بناء منزل أحلامي. الفريق متخصص ومحترف، والتكلفة كانت معقولة جداً. أنصح
                        الجميع بالتعامل معهم."
                    </blockquote>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3 space-x-reverse">
                            <div class="w-12 h-12 rounded-full overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80"
                                    alt="أحمد محمد" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">أحمد محمد</div>
                                <div class="text-gray-600 text-sm">عميل من دبي</div>
                            </div>
                        </div>

                        <div class="flex space-x-1 space-x-reverse">
                            <i class="fas fa-star text-amber-400"></i>
                            <i class="fas fa-star text-amber-400"></i>
                            <i class="fas fa-star text-amber-400"></i>
                            <i class="fas fa-star text-amber-400"></i>
                            <i class="fas fa-star text-amber-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="testimonial-card animate-fade-in" style="animation-delay: 0.1s">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-quote-right text-teal-600"></i>
                        </div>
                    </div>

                    <blockquote class="text-gray-700 text-lg mb-6 leading-relaxed">
                        "خدمة ممتازة ومتابعة دقيقة للمشروع. فريق الدعم متاح دائماً للإجابة على استفساراتي. مشروعي تم تسليمه
                        في الوقت المحدد."
                    </blockquote>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3 space-x-reverse">
                            <div class="w-12 h-12 rounded-full overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80"
                                    alt="فاطمة علي" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">فاطمة علي</div>
                                <div class="text-gray-600 text-sm">عميلة من أبوظبي</div>
                            </div>
                        </div>

                        <div class="flex space-x-1 space-x-reverse">
                            <i class="fas fa-star text-amber-400"></i>
                            <i class="fas fa-star text-amber-400"></i>
                            <i class="fas fa-star text-amber-400"></i>
                            <i class="fas fa-star text-amber-400"></i>
                            <i class="fas fa-star text-amber-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-teal-600 to-teal-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold mb-4">جاهز لبدء مشروعك؟</h2>
            <p class="text-xl text-teal-100 mb-8 max-w-2xl mx-auto">
                انضم إلى آلاف العملاء الذين اختاروا منصة انشاءات لتحويل أحلامهم المعمارية إلى واقع
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                    @if (auth()->user()->isConsultant())
                        <a href="{{ route('designs.create') }}"
                            class="bg-white text-teal-600 px-8 py-4 rounded-xl font-semibold hover:bg-gray-100 transition duration-300 text-lg">
                            <i class="fas fa-plus ml-2"></i>
                            إنشاء تصميم جديد
                        </a>
                    @else
                        <a href="{{ route('tenders.create') }}"
                            class="bg-white text-teal-600 px-8 py-4 rounded-xl font-semibold hover:bg-gray-100 transition duration-300 text-lg">
                            <i class="fas fa-file-contract ml-2"></i>
                            إنشاء مناقصة
                        </a>
                    @endif
                @else
                    <a href="{{ route('register') }}"
                        class="bg-white text-teal-600 px-8 py-4 rounded-xl font-semibold hover:bg-gray-100 transition duration-300 text-lg">
                        <i class="fas fa-user-plus ml-2"></i>
                        انضم إلينا الآن
                    </a>
                @endauth

                <a href="{{ route('designs.index') }}"
                    class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold hover:bg-white hover:text-teal-600 transition duration-300 text-lg">
                    <i class="fas fa-eye ml-2"></i>
                    تصفح التصميمات
                </a>
            </div>
        </div>
    </section>

@endsection
