@extends('layouts.app')

@section('title', 'insha\'at - منصة تصميم البيوت في الإمارات')

@section('content')
<style>
/* UAE Theme Styles */
.hero-gradient {
    background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 30%, #e0f2fe 60%, #faf5ff 100%) !important;
    position: relative;
    overflow: hidden;
}

.hero-gradient::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23f0f9ff" opacity="0.3"/><circle cx="75" cy="75" r="1" fill="%23e0f2fe" opacity="0.3"/><circle cx="50" cy="10" r="0.5" fill="%23faf5ff" opacity="0.4"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    pointer-events: none;
}

.uae-gradient {
    background: linear-gradient(135deg, #0f766e 0%, #14b8a6 25%, #d97706 50%, #f59e0b 75%, #0f766e 100%) !important;
    background-size: 200% 200% !important;
    animation: uaeShimmer 3s ease-in-out infinite !important;
}

@keyframes uaeShimmer {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.stats-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%) !important;
    border: 1px solid #e2e8f0 !important;
    transition: all 0.3s ease !important;
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
    transform: translateY(-5px) !important;
    box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1) !important;
}

.testimonial-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%) !important;
    border: 1px solid #e2e8f0 !important;
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

.language-toggle {
    backdrop-filter: blur(10px) !important;
    background: rgba(255, 255, 255, 0.95) !important;
    border: 1px solid rgba(15, 118, 110, 0.2) !important;
}

.uae-badge {
    backdrop-filter: blur(10px) !important;
    background: linear-gradient(135deg, #0f766e 0%, #d97706 100%) !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
}

.process-step {
    transition: all 0.3s ease;
    border-radius: 12px;
    padding: 16px;
}

.process-step:hover {
    background: linear-gradient(135deg, #f0fdfa 0%, #fef3c7 100%);
    transform: translateX(-8px);
    box-shadow: 0 10px 25px rgba(15, 118, 110, 0.1);
}

.step-number {
    background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
    box-shadow: 0 4px 15px rgba(15, 118, 110, 0.3);
}

.cost-step {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.cost-step::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(135deg, #0f766e 0%, #d97706 100%);
    transform: scaleY(0);
    transition: transform 0.3s ease;
}

.cost-step:hover::before {
    transform: scaleY(1);
}

.cost-step:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.hero-image {
    background: linear-gradient(135deg, #0f766e 0%, #14b8a6 25%, #d97706 50%, #f59e0b 75%, #0f766e 100%);
    background-size: 200% 200%;
    animation: uaeShimmer 4s ease-in-out infinite;
}

.image-hover {
    transition: all 0.3s ease;
}

.image-hover:hover {
    transform: scale(1.05);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.stats-image {
    transition: all 0.3s ease;
}

.stats-image:hover {
    transform: scale(1.1);
    border-radius: 50%;
}

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
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

/* Responsive improvements */
@media (max-width: 768px) {
    .hero-gradient {
        background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 100%) !important;
    }

    .process-step:hover {
        transform: translateY(-5px);
    }
}
</style>

<!-- Hero Section -->
<section class="relative hero-gradient py-20">
    <div class="floating-elements">
        <div class="floating-element">
            <i class="fas fa-building text-4xl text-teal-600"></i>
        </div>
        <div class="floating-element">
            <i class="fas fa-home text-3xl text-amber-600"></i>
        </div>
        <div class="floating-element">
            <i class="fas fa-drafting-compass text-2xl text-teal-500"></i>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Content -->
            <div class="text-right">
                <div class="mb-4">
                    <span class="bg-gradient-to-r from-teal-600 to-amber-600 text-white px-4 py-2 rounded-full text-sm font-medium">
                        🇦🇪 الإمارات العربية المتحدة
                    </span>
                </div>

                <h1 class="text-5xl font-bold text-gray-900 mb-6 leading-tight">
                    أبدأ رحلة مشروعك في
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-amber-600">
                        الإمارات
                    </span>
                </h1>

                <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                    منصة انشاءات الرائدة في الإمارات العربية المتحدة لتصميم وبناء المشاريع السكنية والتجارية. نقدم حلول متكاملة من التصميم حتى التسليم النهائي مع ضمان الجودة العالمية.
                </p>

                <!-- Stats Card -->
                <div class="stats-card rounded-2xl p-6 shadow-lg mb-8">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-teal-600 mb-2">3.5k+</div>
                        <div class="text-gray-600 mb-4">مشروع مكتمل في الإمارات</div>
                        <p class="text-sm text-gray-500 mb-4">
                            منصة متكاملة لتقدير تكلفة مشاريع البناء مع انشاءات
                        </p>
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <a href="{{ route('cost-calculator.index') }}" class="uae-gradient text-white px-6 py-3 rounded-lg font-semibold hover:scale-105 transition duration-300 transform inline-block text-sm">
                                🚀 ابدأ مشروعك الآن
                            </a>
                            <a href="{{ route('lands.create') }}" class="bg-gradient-to-r from-amber-600 to-orange-600 text-white px-6 py-3 rounded-lg font-semibold hover:scale-105 transition duration-300 transform inline-block text-sm">
                                <i class="fas fa-exchange-alt ml-1"></i>
                                بيع وتبادل الأراضي
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image -->
            <div class="relative">
                <div class="bg-gradient-to-br from-teal-100 to-amber-100 rounded-3xl p-8 transform hover:scale-105 transition duration-300">
                    <div class="bg-white rounded-2xl p-6 shadow-lg">
                        <div class="hero-image h-80 rounded-xl relative overflow-hidden image-hover">
                            <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                                 alt="مباني حديثة في دبي"
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-br from-teal-600/30 to-amber-600/30"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white/90 backdrop-blur-sm rounded-lg p-4 text-center">
                                    <i class="fas fa-building text-4xl text-teal-600 mb-2"></i>
                                    <p class="text-sm font-semibold text-gray-800">تصميم وبناء في دبي</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <p class="text-sm text-gray-600">تصميم وبناء في دبي، أبوظبي، الشارقة</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                تعرف على مراحل ومتطلبات بناء منزلك في الإمارات
            </h2>
            <p class="text-xl text-gray-600">
                نتبع أعلى معايير الجودة العالمية مع مراعاة القوانين المحلية
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Image -->
            <div class="relative">
                <div class="bg-gradient-to-br from-teal-50 to-amber-50 rounded-3xl p-8">
                    <div class="bg-white rounded-2xl p-6 shadow-lg">
                        <div class="h-96 rounded-xl relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2075&q=80"
                                 alt="فيلا فاخرة في الإمارات"
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-br from-teal-600/20 to-amber-600/20"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white/90 backdrop-blur-sm rounded-lg p-4 text-center">
                                    <i class="fas fa-home text-4xl text-teal-600 mb-2"></i>
                                    <p class="text-sm font-semibold text-gray-800">فيلا فاخرة</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <p class="text-sm text-gray-600">مشاريع سكنية وتجارية في جميع الإمارات</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div>
                <div class="space-y-6">
                    <div class="process-step">
                        <div class="flex items-start space-x-4 space-x-reverse">
                            <div class="step-number w-8 h-8 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0 mt-1">
                                1
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">مراجعة المستندات والتراخيص</h3>
                                <p class="text-gray-600 text-sm">فحص وتدقيق جميع المستندات المطلوبة وفقاً لقوانين الإمارات</p>
                            </div>
                        </div>
                    </div>

                    <div class="process-step">
                        <div class="flex items-start space-x-4 space-x-reverse">
                            <div class="step-number w-8 h-8 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0 mt-1">
                                2
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">اختيار التصميم الداخلي والخارجي</h3>
                                <p class="text-gray-600 text-sm">تصميم شامل للمنزل مع مراعاة الطقس والبيئة الإماراتية</p>
                            </div>
                        </div>
                    </div>

                    <div class="process-step">
                        <div class="flex items-start space-x-4 space-x-reverse">
                            <div class="step-number w-8 h-8 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0 mt-1">
                                3
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">اختيار المواد والمواصفات</h3>
                                <p class="text-gray-600 text-sm">اختيار أفضل المواد المناسبة للمناخ الإماراتي</p>
                            </div>
                        </div>
                    </div>

                    <div class="process-step">
                        <div class="flex items-start space-x-4 space-x-reverse">
                            <div class="step-number w-8 h-8 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0 mt-1">
                                4
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">الحصول على التراخيص</h3>
                                <p class="text-gray-600 text-sm">إتمام جميع الإجراءات القانونية مع البلديات المحلية</p>
                            </div>
                        </div>
                    </div>

                    <div class="process-step">
                        <div class="flex items-start space-x-4 space-x-reverse">
                            <div class="step-number w-8 h-8 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0 mt-1">
                                5
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">بدء التنفيذ</h3>
                                <p class="text-gray-600 text-sm">بدء العمل على المشروع مع فريق متخصص إماراتي</p>
                            </div>
                        </div>
                    </div>

                    <div class="process-step">
                        <div class="flex items-start space-x-4 space-x-reverse">
                            <div class="step-number w-8 h-8 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0 mt-1">
                                6
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">التسليم النهائي</h3>
                                <p class="text-gray-600 text-sm">تسليم المشروع مكتملاً مع ضمان الجودة الإماراتية</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Cost Estimation Section -->
<section class="py-20 bg-gradient-to-br from-blue-50 to-purple-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                قدر التكلفة التقديرية لمشروعك في الإمارات
            </h2>
            <p class="text-xl text-gray-600">
                حاسبة ذكية تعتمد على أسعار السوق الإماراتي
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Content -->
            <div>
                <div class="space-y-6 mb-8">
                    <div class="cost-step rounded-xl p-6 shadow-md">
                        <div class="flex items-center space-x-4 space-x-reverse">
                            <div class="w-10 h-10 bg-teal-600 text-white rounded-full flex items-center justify-center font-bold">
                                1
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">اختر الإمارة والمنطقة</h3>
                                <p class="text-gray-600 text-sm">دبي، أبوظبي، الشارقة، عجمان، رأس الخيمة، الفجيرة، أم القيوين</p>
                            </div>
                        </div>
                    </div>

                    <div class="cost-step rounded-xl p-6 shadow-md">
                        <div class="flex items-center space-x-4 space-x-reverse">
                            <div class="w-10 h-10 bg-teal-600 text-white rounded-full flex items-center justify-center font-bold">
                                2
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">أكمل تفاصيل المشروع</h3>
                                <p class="text-gray-600 text-sm">أدخل مواصفات المشروع والمساحة المطلوبة</p>
                            </div>
                        </div>
                    </div>

                    <div class="cost-step rounded-xl p-6 shadow-md">
                        <div class="flex items-center space-x-4 space-x-reverse">
                            <div class="w-10 h-10 bg-teal-600 text-white rounded-full flex items-center justify-center font-bold">
                                3
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">أدخل تفاصيل التصميم</h3>
                                <p class="text-gray-600 text-sm">اختر نمط التصميم والمواد المفضلة</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('cost-calculator.index') }}" class="uae-gradient text-white px-8 py-4 rounded-xl font-semibold hover:scale-105 transition duration-300 transform text-lg inline-block">
                        احسب التكلفة الآن
                    </a>
                    <a href="{{ route('lands.create') }}" class="bg-gradient-to-r from-amber-600 to-orange-600 text-white px-8 py-4 rounded-xl font-semibold hover:scale-105 transition duration-300 transform text-lg inline-block">
                        <i class="fas fa-exchange-alt ml-2"></i>
                        بيع وتبادل الأراضي
                    </a>
                </div>
            </div>

            <!-- Image -->
            <div class="relative">
                <div class="bg-gradient-to-br from-amber-50 to-red-50 rounded-3xl p-8">
                    <div class="bg-white rounded-2xl p-6 shadow-lg">
                        <div class="h-96 rounded-xl relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2073&q=80"
                                 alt="مكتب تصميم معماري"
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-br from-amber-600/20 to-red-600/20"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white/90 backdrop-blur-sm rounded-lg p-4 text-center">
                                    <i class="fas fa-calculator text-4xl text-amber-600 mb-2"></i>
                                    <p class="text-sm font-semibold text-gray-800">حاسبة التكلفة</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <p class="text-sm text-gray-600">حاسبة تكلفة دقيقة لجميع الإمارات</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Us & Statistics Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">عن منصة انشاءات</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                انشاءات منصة رائدة في الإمارات العربية المتحدة في البناء وتصميم المشاريع الضخمة. نقدم حلول متكاملة من التصميم حتى التسليم النهائي مع ضمان الجودة العالمية.
            </p>
        </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="stats-card rounded-2xl p-8 shadow-lg text-center">
                <div class="w-20 h-20 rounded-full overflow-hidden mx-auto mb-4">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80"
                         alt="مهندس معماري"
                         class="w-full h-full object-cover stats-image">
                </div>
                <div class="text-3xl font-bold text-teal-600 mb-2">500+</div>
                <p class="text-gray-600">مهندس معماري معتمد في الإمارات</p>
            </div>

            <div class="stats-card rounded-2xl p-8 shadow-lg text-center">
                <div class="w-20 h-20 rounded-full overflow-hidden mx-auto mb-4">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80"
                         alt="مستشار عقاري"
                         class="w-full h-full object-cover">
                </div>
                <div class="text-3xl font-bold text-teal-600 mb-2">400+</div>
                <p class="text-gray-600">مستشار عقاري مرخص في الإمارات</p>
            </div>

            <div class="stats-card rounded-2xl p-8 shadow-lg text-center">
                <div class="w-20 h-20 rounded-full overflow-hidden mx-auto mb-4">
                    <img src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                         alt="مشروع مكتمل"
                         class="w-full h-full object-cover">
                </div>
                <div class="text-3xl font-bold text-teal-600 mb-2">1500+</div>
                <p class="text-gray-600">مشروع مكتمل في جميع الإمارات</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">ماذا يقول عملاؤنا في الإمارات</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Testimonial Card -->
            <div class="testimonial-card rounded-2xl p-8 shadow-lg">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-quote-right text-amber-600"></i>
                    </div>
                </div>

                <blockquote class="text-gray-700 text-lg mb-6 leading-relaxed">
                    "منصة انشاءات ساعدتني في بناء منزل أحلامي في دبي. الفريق متخصص ومحترف، والتكلفة كانت معقولة جداً. أنصح الجميع بالتعامل معهم."
                </blockquote>

                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3 space-x-reverse">
                        <div class="w-12 h-12 rounded-full overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80"
                                 alt="يحيى بن علي"
                                 class="w-full h-full object-cover">
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">يحيى بن علي</div>
                            <div class="text-gray-600 text-sm">عميل من دبي 🇦🇪</div>
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

            <!-- Navigation Arrows -->
            <div class="flex justify-center space-x-4 space-x-reverse">
                <button class="w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-teal-50 transition duration-300">
                    <i class="fas fa-chevron-right text-teal-600"></i>
                </button>
                <button class="w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-teal-50 transition duration-300">
                    <i class="fas fa-chevron-left text-teal-600"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Language Toggle -->
<div class="fixed bottom-6 left-6 z-50">
    <div class="language-toggle rounded-full shadow-lg p-2">
        <div class="flex space-x-2 space-x-reverse">
            <button class="px-4 py-2 rounded-full bg-teal-600 text-white text-sm font-medium">
                عربي
            </button>
            <button class="px-4 py-2 rounded-full text-gray-600 text-sm font-medium hover:bg-gray-100">
                English
            </button>
        </div>
    </div>
</div>


@endsection
