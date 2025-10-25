@extends('layouts.app')

@section('content')
    <style>
        .designs-hero {
            background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 50%, #faf5ff 100%);
            position: relative;
            overflow: hidden;
        }

        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
        }

        .floating-shape {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .floating-shape:nth-child(1) {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-shape:nth-child(2) {
            top: 20%;
            right: 15%;
            animation-delay: 2s;
        }

        .floating-shape:nth-child(3) {
            bottom: 20%;
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

        .hero-title {
            background: linear-gradient(135deg, #14b8a6, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .filter-tabs {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            border: 2px solid transparent;
            background: white;
            color: #6b7280;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .filter-tab.active {
            background: linear-gradient(135deg, #14b8a6, #f59e0b);
            color: white;
            box-shadow: 0 4px 15px rgba(20, 184, 166, 0.3);
            transform: translateY(-2px);
        }

        .filter-tab:hover:not(.active) {
            border-color: #14b8a6;
            color: #14b8a6;
            transform: translateY(-1px);
        }

        .designs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .design-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
        }

        .design-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .design-image {
            position: relative;
            height: 280px;
            overflow: hidden;
        }

        .design-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .design-card:hover .design-image img {
            transform: scale(1.05);
        }

        .design-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(20, 184, 166, 0.8), rgba(245, 158, 11, 0.8));
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .design-card:hover .design-overlay {
            opacity: 1;
        }

        .overlay-content {
            text-align: center;
            color: white;
        }

        .overlay-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .overlay-subtitle {
            font-size: 1rem;
            opacity: 0.9;
        }

        .design-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.9);
            color: #14b8a6;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            backdrop-filter: blur(10px);
        }

        .design-content {
            padding: 1.5rem;
        }

        .design-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .design-description {
            color: #6b7280;
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .design-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .design-price {
            font-size: 1.1rem;
            font-weight: bold;
            color: #14b8a6;
        }

        .design-area {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .design-features {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .feature-tag {
            background: #f3f4f6;
            color: #374151;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .design-actions {
            display: flex;
            gap: 0.75rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #14b8a6, #f59e0b);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            flex: 1;
            text-align: center;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(20, 184, 166, 0.3);
        }

        .btn-secondary {
            background: #f8f9fa;
            color: #6b7280;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid #e5e7eb;
            flex: 1;
            text-align: center;
        }

        .btn-secondary:hover {
            background: #e9ecef;
            color: #495057;
            transform: translateY(-2px);
        }

        .inspiration-section {
            background: linear-gradient(135deg, #f0f9ff 0%, #faf5ff 100%);
            padding: 4rem 0;
            margin: 4rem 0;
        }

        .inspiration-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .inspiration-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .inspiration-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .inspiration-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #14b8a6, #f59e0b);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 2rem;
        }

        .inspiration-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .inspiration-description {
            color: #6b7280;
            line-height: 1.6;
        }

        .cta-section {
            background: linear-gradient(135deg, #14b8a6, #f59e0b);
            color: white;
            padding: 4rem 0;
            text-align: center;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .cta-description {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-btn {
            background: white;
            color: #14b8a6;
            padding: 1rem 2rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .cta-btn:hover {
            background: transparent;
            color: white;
            border-color: white;
            transform: translateY(-2px);
        }

        .cta-btn.outline {
            background: transparent;
            color: white;
            border-color: white;
        }

        .cta-btn.outline:hover {
            background: white;
            color: #14b8a6;
        }

        @media (max-width: 768px) {
            .designs-hero {
                padding: 2rem 0;
            }

            .hero-title {
                font-size: 2.5rem;
                line-height: 1.2;
            }

            .designs-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                margin: 0 1rem 2rem 1rem;
            }

            .design-card {
                margin: 0 0.5rem;
            }

            .design-image {
                height: 220px;
            }

            .design-content {
                padding: 1rem;
            }

            .design-title {
                font-size: 1.1rem;
            }

            .design-description {
                font-size: 0.85rem;
            }

            .design-meta {
                flex-direction: column;
                gap: 0.5rem;
                align-items: flex-start;
            }

            .design-features {
                gap: 0.25rem;
            }

            .feature-tag {
                font-size: 0.75rem;
                padding: 0.2rem 0.5rem;
            }

            .design-actions {
                flex-direction: column;
                gap: 0.5rem;
            }

            .btn-primary,
            .btn-secondary {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }

            .filter-tabs {
                flex-direction: column;
                align-items: center;
                gap: 0.75rem;
                margin: 0 1rem 2rem 1rem;
            }

            .filter-tab {
                width: 100%;
                max-width: 300px;
                text-align: center;
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }

            .inspiration-section {
                padding: 2rem 0;
                margin: 2rem 0;
            }

            .inspiration-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                margin: 0 1rem;
            }

            .inspiration-card {
                padding: 1.5rem;
            }

            .inspiration-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }

            .cta-section {
                padding: 2rem 0;
            }

            .cta-title {
                font-size: 1.8rem;
                margin: 0 1rem 1rem 1rem;
            }

            .cta-description {
                font-size: 1rem;
                margin: 0 1rem 2rem 1rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
                gap: 0.75rem;
                margin: 0 1rem;
            }

            .cta-btn {
                width: 100%;
                max-width: 300px;
                padding: 0.8rem 1.5rem;
                font-size: 0.9rem;
            }

            .floating-shapes {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .designs-hero {
                padding: 1rem 0;
                width: 100% !important;
                max-width: 100% !important;
                overflow-x: hidden !important;
            }

            .hero-title {
                font-size: 1.8rem;
                line-height: 1.2;
                margin-bottom: 0.5rem;
            }

            .designs-hero p {
                font-size: 0.9rem;
                line-height: 1.4;
            }

            .designs-grid {
                margin: 0 0.25rem 1rem 0.25rem;
                gap: 1rem;
                width: 100% !important;
                max-width: 100% !important;
                overflow-x: hidden !important;
            }

            .design-card {
                margin: 0;
                border-radius: 12px;
            }

            .design-image {
                height: 180px;
            }

            .design-content {
                padding: 0.6rem;
            }

            .design-title {
                font-size: 0.95rem;
                line-height: 1.3;
                margin-bottom: 0.4rem;
            }

            .design-description {
                font-size: 0.75rem;
                line-height: 1.4;
                margin-bottom: 0.8rem;
            }

            .design-meta {
                margin-bottom: 0.8rem;
            }

            .design-price {
                font-size: 0.9rem;
            }

            .design-area {
                font-size: 0.75rem;
            }

            .design-features {
                gap: 0.2rem;
                margin-bottom: 0.8rem;
            }

            .feature-tag {
                font-size: 0.7rem;
                padding: 0.15rem 0.4rem;
                border-radius: 10px;
            }

            .design-actions {
                gap: 0.4rem;
            }

            .btn-primary,
            .btn-secondary {
                padding: 0.5rem 0.8rem;
                font-size: 0.8rem;
                border-radius: 8px;
            }

            .filter-tabs {
                margin: 0 0.25rem 1rem 0.25rem;
                gap: 0.5rem;
            }

            .filter-tab {
                max-width: 200px;
                padding: 0.4rem 0.6rem;
                font-size: 0.8rem;
                border-radius: 20px;
            }

            .inspiration-section {
                padding: 1.5rem 0;
                margin: 1.5rem 0;
            }

            .inspiration-grid {
                margin: 0 0.25rem;
                gap: 1rem;
                width: 100% !important;
                max-width: 100% !important;
                overflow-x: hidden !important;
            }

            .inspiration-card {
                padding: 0.8rem;
                border-radius: 12px;
            }

            .inspiration-icon {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
                margin-bottom: 1rem;
            }

            .inspiration-title {
                font-size: 1rem;
                margin-bottom: 0.8rem;
            }

            .inspiration-description {
                font-size: 0.8rem;
                line-height: 1.4;
            }

            .cta-section {
                padding: 1.5rem 0;
            }

            .cta-title {
                font-size: 1.3rem;
                margin: 0 0.25rem 0.8rem 0.25rem;
                line-height: 1.3;
            }

            .cta-description {
                font-size: 0.8rem;
                margin: 0 0.25rem 1.5rem 0.25rem;
                line-height: 1.4;
            }

            .cta-buttons {
                margin: 0 0.25rem;
                gap: 0.5rem;
            }

            .cta-btn {
                max-width: 200px;
                padding: 0.6rem 1rem;
                font-size: 0.8rem;
                border-radius: 8px;
            }

            .floating-shapes {
                display: none;
            }
        }

        @media (max-width: 360px) {
            .hero-title {
                font-size: 1.6rem;
            }

            .designs-hero p {
                font-size: 0.85rem;
            }

            .design-image {
                height: 160px;
            }

            .design-content {
                padding: 0.5rem;
            }

            .design-title {
                font-size: 0.9rem;
            }

            .design-description {
                font-size: 0.7rem;
            }

            .design-price {
                font-size: 0.85rem;
            }

            .design-area {
                font-size: 0.7rem;
            }

            .feature-tag {
                font-size: 0.65rem;
                padding: 0.1rem 0.3rem;
            }

            .btn-primary,
            .btn-secondary {
                padding: 0.4rem 0.7rem;
                font-size: 0.75rem;
            }

            .filter-tab {
                max-width: 180px;
                padding: 0.35rem 0.5rem;
                font-size: 0.75rem;
            }

            .inspiration-card {
                padding: 0.6rem;
            }

            .inspiration-icon {
                width: 45px;
                height: 45px;
                font-size: 1.1rem;
            }

            .inspiration-title {
                font-size: 0.9rem;
            }

            .inspiration-description {
                font-size: 0.75rem;
            }

            .cta-title {
                font-size: 1.2rem;
            }

            .cta-description {
                font-size: 0.75rem;
            }

            .cta-btn {
                max-width: 180px;
                padding: 0.5rem 0.8rem;
                font-size: 0.75rem;
            }
        }
    </style>

    <!-- Hero Section -->
    <section class="designs-hero py-20">
        <div class="floating-shapes">
            <div class="floating-shape">
                <i class="fas fa-home text-6xl text-teal-600"></i>
            </div>
            <div class="floating-shape">
                <i class="fas fa-building text-5xl text-amber-600"></i>
            </div>
            <div class="floating-shape">
                <i class="fas fa-drafting-compass text-4xl text-teal-500"></i>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h1 class="hero-title text-5xl font-bold mb-6">
                    تصاميم تلهمك
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    اكتشف مجموعة مذهلة من التصاميم المعمارية المبتكرة التي تجمع بين الأناقة والوظائفية.
                    من الفلل الفاخرة إلى الشقق العصرية، كل تصميم يحكي قصة فريدة من نوعها.
                </p>
            </div>

            <!-- Filter Tabs -->
            <div class="filter-tabs">
                <div class="filter-tab active" onclick="filterDesigns('all')">جميع التصاميم</div>
                <div class="filter-tab" onclick="filterDesigns('modern')">عصري</div>
                <div class="filter-tab" onclick="filterDesigns('classic')">كلاسيكي</div>
                <div class="filter-tab" onclick="filterDesigns('traditional')">تراثي</div>
                <div class="filter-tab" onclick="filterDesigns('luxury')">فاخر</div>
                <div class="filter-tab" onclick="filterDesigns('minimal')">بسيط</div>
            </div>
        </div>
    </section>

    <!-- Designs Grid -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="designs-grid" id="designsGrid">
                @forelse($designs as $design)
                    <div class="design-card" data-category="{{ $design->style }}">
                        <div class="design-image">
                            <img src="{{ $design->main_image_url }}" alt="{{ $design->title }}">
                            <div class="design-overlay">
                                <div class="overlay-content">
                                    <div class="overlay-title">{{ $design->title }}</div>
                                    <div class="overlay-subtitle">{{ $design->description }}</div>
                                </div>
                            </div>
                            <div class="design-badge">{{ $design->style }}</div>
                        </div>
                        <div class="design-content">
                            <h3 class="design-title">{{ $design->title }}</h3>
                            <p class="design-description">
                                {{ Str::limit($design->description, 100) }}
                            </p>
                            <div class="design-meta">
                                <div class="design-price">{{ $design->formatted_price }}</div>
                                <div class="design-area">{{ $design->formatted_area }}</div>
                            </div>
                            <div class="design-features">
                                <span class="feature-tag">{{ $design->bedrooms }} غرف نوم</span>
                                <span class="feature-tag">{{ $design->bathrooms }} حمامات</span>
                                <span class="feature-tag">{{ $design->floors }} طوابق</span>
                                @if ($design->features)
                                    @php
                                        $features = is_array($design->features)
                                            ? $design->features
                                            : json_decode($design->features, true);
                                        $features = $features ? array_slice($features, 0, 2) : [];
                                    @endphp
                                    @foreach ($features as $feature)
                                        <span class="feature-tag">{{ $feature }}</span>
                                    @endforeach
                                @endif
                            </div>
                            <div class="design-actions">
                                <a href="{{ route('designs.show-with-pricing', $design->id) }}" class="btn-primary">عرض مع
                                    التسعير</a>
                                <a href="{{ route('designs.show', $design->id) }}" class="btn-secondary">عرض التفاصيل</a>

                                @auth
                                    @if (auth()->user()->isConsultant() && auth()->id() == $design->consultant_id)
                                        <a href="{{ route('designs.edit', $design->id) }}"
                                            class="btn-primary bg-blue-600 hover:bg-blue-700">تعديل</a>
                                        <button onclick="deleteDesign({{ $design->id }})"
                                            class="btn-secondary bg-red-600 hover:bg-red-700 text-white">حذف</button>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="text-gray-500 text-lg">
                            <i class="fas fa-home text-4xl mb-4"></i>
                            <p>لا توجد تصاميم متاحة حالياً</p>
                            <p class="text-sm mt-2">كن أول من يضيف تصميم جديد</p>
                        </div>
                    </div>
                @endforelse

            </div>

            <!-- Pagination -->
            @if ($designs->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $designs->links() }}
                </div>
            @endif
        </div>
    </section>

    <!-- Inspiration Section -->
    <section class="inspiration-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">لماذا تختار تصاميمنا؟</h2>
                <p class="text-xl text-gray-600">
                    نقدم لك تجربة تصميم استثنائية تجمع بين الإبداع والوظائفية
                </p>
            </div>

            <div class="inspiration-grid">
                <div class="inspiration-card">
                    <div class="inspiration-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">تصاميم مبدعة</h3>
                    <p class="text-gray-600">
                        فريق من المصممين المبدعين الذين يبتكرون حلول معمارية فريدة تناسب احتياجاتك
                    </p>
                </div>

                <div class="inspiration-card">
                    <div class="inspiration-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">تسعير دقيق</h3>
                    <p class="text-gray-600">
                        حساب دقيق للتكاليف مع تفاصيل شاملة لكل بند في التصميم لضمان الشفافية
                    </p>
                </div>

                <div class="inspiration-card">
                    <div class="inspiration-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">دعم مستمر</h3>
                    <p class="text-gray-600">
                        فريق دعم متخصص لمساعدتك في كل خطوة من رحلة التصميم والتنفيذ
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section bg-gradient-to-r from-teal-600 to-amber-600 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="cta-title text-3xl font-bold mb-4">هل لديك رؤية لمشروعك؟</h2>
            <p class="cta-description text-lg mb-8">
                ابدأ رحلتك نحو منزل أحلامك مع فريقنا من الخبراء
            </p>
            <div class="cta-buttons flex flex-wrap justify-center gap-4">
                <a href="{{ route('designs.create') }}"
                    class="cta-btn bg-white text-teal-600 hover:bg-gray-100 transition duration-300">
                    ابدأ تصميمك الآن
                </a>
                <a href="{{ route('designs.create') }}"
                    class="cta-btn border-2 border-white text-white hover:bg-white hover:text-teal-600 transition duration-300">
                    احسب التكلفة
                </a>
            </div>
        </div>
    </section>

    <script>
        function filterDesigns(category) {
            const cards = document.querySelectorAll('.design-card');
            const tabs = document.querySelectorAll('.filter-tab');

            // Update active tab
            tabs.forEach(tab => tab.classList.remove('active'));
            event.target.classList.add('active');

            // Filter cards
            cards.forEach(card => {
                if (category === 'all' || card.dataset.category.includes(category)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>

    <div class="design-image">
        <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
            alt="فيلا كلاسيكية">
        <div class="design-overlay">
            <div class="overlay-content">
                <div class="overlay-title">فيلا كلاسيكية</div>
                <div class="overlay-subtitle">أناقة خالدة مع تفاصيل فاخرة</div>
            </div>
        </div>
        <div class="design-badge">كلاسيكي</div>
    </div>
    <div class="design-content">
        <h3 class="design-title">فيلا كلاسيكية في أبوظبي</h3>
        <p class="design-description">
            فيلا كلاسيكية بتصميم أنيق يجمع بين التراث والحداثة. تتميز بالتفاصيل الفاخرة والمساحات المريحة.
        </p>
        <div class="design-meta">
            <div class="design-price">3,200,000 درهم</div>
            <div class="design-area">520 متر مربع</div>
        </div>
        <div class="design-features">
            <span class="feature-tag">6 غرف نوم</span>
            <span class="feature-tag">مسبح داخلي</span>
            <span class="feature-tag">قبو</span>
            <span class="feature-tag">مطبخ فاخر</span>
        </div>
        <div class="design-actions">
            <a href="{{ route('designs.show-with-pricing', 1) }}" class="btn-primary">عرض مع التسعير</a>
            <a href="#" class="btn-secondary">احسب التكلفة</a>
        </div>
    </div>
    </div>

    <!-- Design Card 3 -->
    <div class="design-card" data-category="traditional">
        <div class="design-image">
            <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                alt="فيلا تراثية">
            <div class="design-overlay">
                <div class="overlay-content">
                    <div class="overlay-title">فيلا تراثية</div>
                    <div class="overlay-subtitle">أصالة التراث مع راحة العصر</div>
                </div>
            </div>
            <div class="design-badge">تراثي</div>
        </div>
        <div class="design-content">
            <h3 class="design-title">فيلا تراثية في الشارقة</h3>
            <p class="design-description">
                فيلا تراثية تجمع بين الأصالة والحداثة. تصميم مستوحى من العمارة العربية مع لمسات عصرية.
            </p>
            <div class="design-meta">
                <div class="design-price">1,800,000 درهم</div>
                <div class="design-area">380 متر مربع</div>
            </div>
            <div class="design-features">
                <span class="feature-tag">4 غرف نوم</span>
                <span class="feature-tag">مجلس عربي</span>
                <span class="feature-tag">حديقة عربية</span>
                <span class="feature-tag">نافورة</span>
            </div>
            <div class="design-actions">
                <a href="{{ route('designs.show-with-pricing', 1) }}" class="btn-primary">عرض مع التسعير</a>
                <a href="#" class="btn-secondary">احسب التكلفة</a>
            </div>
        </div>
    </div>

    <!-- Design Card 4 -->
    <div class="design-card" data-category="minimal modern">
        <div class="design-image">
            <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                alt="شقة بسيطة">
            <div class="design-overlay">
                <div class="overlay-content">
                    <div class="overlay-title">شقة بسيطة</div>
                    <div class="overlay-subtitle">بساطة أنيقة مع وظائفية مثالية</div>
                </div>
            </div>
            <div class="design-badge">بسيط</div>
        </div>
        <div class="design-content">
            <h3 class="design-title">شقة بسيطة في دبي</h3>
            <p class="design-description">
                شقة بتصميم بسيط وأنيق يجمع بين الوظائفية والجمال. مثالية للعائلات الصغيرة.
            </p>
            <div class="design-meta">
                <div class="design-price">850,000 درهم</div>
                <div class="design-area">120 متر مربع</div>
            </div>
            <div class="design-features">
                <span class="feature-tag">3 غرف نوم</span>
                <span class="feature-tag">مطبخ مفتوح</span>
                <span class="feature-tag">شرفة</span>
                <span class="feature-tag">موقف سيارات</span>
            </div>
            <div class="design-actions">
                <a href="{{ route('designs.show-with-pricing', 1) }}" class="btn-primary">عرض مع التسعير</a>
                <a href="#" class="btn-secondary">احسب التكلفة</a>
            </div>
        </div>
    </div>

    <!-- Design Card 5 -->
    <div class="design-card" data-category="luxury modern">
        <div class="design-image">
            <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                alt="فيلا فاخرة">
            <div class="design-overlay">
                <div class="overlay-content">
                    <div class="overlay-title">فيلا فاخرة</div>
                    <div class="overlay-subtitle">فخامة لا مثيل لها مع راحة مطلقة</div>
                </div>
            </div>
            <div class="design-badge">فاخر</div>
        </div>
        <div class="design-content">
            <h3 class="design-title">فيلا فاخرة في أبوظبي</h3>
            <p class="design-description">
                فيلا فاخرة بتصميم عصري يجمع بين الفخامة والراحة. تتميز بمساحات واسعة وخدمات فاخرة.
            </p>
            <div class="design-meta">
                <div class="design-price">5,500,000 درهم</div>
                <div class="design-area">750 متر مربع</div>
            </div>
            <div class="design-features">
                <span class="feature-tag">7 غرف نوم</span>
                <span class="feature-tag">مسبح أولمبي</span>
                <span class="feature-tag">مصعد زجاجي</span>
                <span class="feature-tag">قبو للسيارات</span>
            </div>
            <div class="design-actions">
                <a href="{{ route('designs.show-with-pricing', 1) }}" class="btn-primary">عرض مع التسعير</a>
                <a href="#" class="btn-secondary">احسب التكلفة</a>
            </div>
        </div>
    </div>

    <!-- Design Card 6 -->
    <div class="design-card" data-category="classic">
        <div class="design-image">
            <img src="https://images.unsplash.com/photo-1600607687644-c7171b42498b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                alt="فيلا كلاسيكية">
            <div class="design-overlay">
                <div class="overlay-content">
                    <div class="overlay-title">فيلا كلاسيكية</div>
                    <div class="overlay-subtitle">أناقة خالدة مع تفاصيل دقيقة</div>
                </div>
            </div>
            <div class="design-badge">كلاسيكي</div>
        </div>
        <div class="design-content">
            <h3 class="design-title">فيلا كلاسيكية في الشارقة</h3>
            <p class="design-description">
                فيلا كلاسيكية بتصميم أنيق يجمع بين الأناقة والراحة. مثالية للعائلات الكبيرة.
            </p>
            <div class="design-meta">
                <div class="design-price">2,800,000 درهم</div>
                <div class="design-area">480 متر مربع</div>
            </div>
            <div class="design-features">
                <span class="feature-tag">5 غرف نوم</span>
                <span class="feature-tag">مسبح</span>
                <span class="feature-tag">حديقة</span>
                <span class="feature-tag">مطبخ كبير</span>
            </div>
            <div class="design-actions">
                <a href="{{ route('designs.show-with-pricing', 1) }}" class="btn-primary">عرض مع التسعير</a>
                <a href="#" class="btn-secondary">احسب التكلفة</a>
            </div>
        </div>
    </div>
    </div>
    </div>
    </section>

    <!-- Inspiration Section -->
    <section class="inspiration-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">لماذا تختار تصاميمنا؟</h2>
                <p class="text-xl text-gray-600">
                    نقدم تجربة تصميم فريدة تجمع بين الإبداع والوظائفية
                </p>
            </div>

            <div class="inspiration-grid">
                <div class="inspiration-card">
                    <div class="inspiration-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3 class="inspiration-title">تصاميم مبتكرة</h3>
                    <p class="inspiration-description">
                        نبتكر تصاميم فريدة تجمع بين الجمال والوظائفية، مع مراعاة احتياجاتك الشخصية.
                    </p>
                </div>

                <div class="inspiration-card">
                    <div class="inspiration-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3 class="inspiration-title">جودة عالية</h3>
                    <p class="inspiration-description">
                        نستخدم أفضل المواد والتقنيات لضمان جودة عالية وديمومة طويلة الأمد.
                    </p>
                </div>

                <div class="inspiration-card">
                    <div class="inspiration-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="inspiration-title">تسليم سريع</h3>
                    <p class="inspiration-description">
                        نلتزم بمواعيد دقيقة وتسليم المشاريع في الوقت المحدد مع الحفاظ على الجودة.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="cta-title">ابدأ رحلة تصميم منزلك اليوم</h2>
            <p class="cta-description">
                دع خبراءنا يساعدونك في تحويل رؤيتك إلى واقع ملموس.
                احصل على تصميم فريد يناسب احتياجاتك وميزانيتك.
            </p>
            <div class="cta-buttons">
                <a href="{{ route('designs.create') }}" class="cta-btn">
                    <i class="fas fa-plus ml-2"></i>
                    أضف تصميمك
                </a>
            </div>
        </div>
    </section>

    <script>
        function filterDesigns(category) {
            // إزالة الفئة النشطة من جميع التبويبات
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.classList.remove('active');
            });

            // إضافة الفئة النشطة للتبويب المحدد
            event.target.classList.add('active');

            // الحصول على جميع بطاقات التصميم
            const designCards = document.querySelectorAll('.design-card');

            // إظهار أو إخفاء البطاقات حسب الفئة
            designCards.forEach(card => {
                if (category === 'all' || card.dataset.category.includes(category)) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeIn 0.5s ease-in-out';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // إضافة تأثيرات التمرير
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // مراقبة بطاقات التصميم
            document.querySelectorAll('.design-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        });

        // Delete design function
        function deleteDesign(designId) {
            if (confirm('هل أنت متأكد من حذف هذا التصميم؟ لا يمكن التراجع عن هذا الإجراء.')) {
                // Create form and submit
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/designs/${designId}`;

                // Add CSRF token
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);

                // Add method override
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';
                form.appendChild(methodField);

                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>

    <style>
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
@endsection
