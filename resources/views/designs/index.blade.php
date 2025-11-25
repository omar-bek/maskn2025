@extends('layouts.app')

@section('content')


    <!-- Hero Section -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap');

        /* --- Hero Section (Updated Colors) --- */
        .designs-hero {
            background: linear-gradient(135deg, #2f5c69 0%, #1a262a 100%);
            position: relative;
            overflow: hidden;
            border-radius: 100px;
            width: 80%;
            margin: auto;
            margin-top: 100px;

        }

        .hero-title {
            background: linear-gradient(90deg, #f3a446 0%, #fafad2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            color: transparent;
            filter: drop-shadow(0 2px 5px rgba(0, 0, 0, 0.5));
        }

        .designs-hero .text-gray-600 {
            color: #d1d5db;
            /* Light Gray for dark background */
        }

        /* --- Floating Icons Animation (Updated Colors) --- */
        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            pointer-events: none;
        }

        .floating-shape {
            position: absolute;
            opacity: 0.15;
            animation: float 10s ease-in-out infinite alternate;
        }

        .floating-shape:nth-child(1) {
            top: 10%;
            left: 15%;
            animation-duration: 12s;
        }

        .floating-shape:nth-child(2) {
            top: 50%;
            left: 80%;
            animation-duration: 10s;
            animation-delay: -3s;
        }

        .floating-shape:nth-child(3) {
            top: 80%;
            left: 25%;
            animation-duration: 8s;
            animation-delay: -1s;
        }

        .floating-shape i {
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.2));
        }

        /* [تعديل] استبدال الألوان القديمة باللون الذهبي الجديد */
        .floating-shape .text-teal-600,
        .floating-shape .text-teal-500 {
            color: #f3a446;
        }

        .floating-shape .text-amber-600 {
            color: #ffffff;
        }


        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg) scale(1);
            }

            100% {
                transform: translateY(-40px) rotate(15deg) scale(1.1);
            }
        }

        /* --- Filter Tabs (Updated Colors) --- */
        .filter-tabs {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 12px;
            background-color: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            padding: 12px;
            border-radius: 16px;
            border: 1px solid rgba(243, 164, 70, 0.2);
        }

        .filter-tab {
            padding: 10px 24px;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            color: #ffffff;
            cursor: pointer;
            transition: all 0.3s ease;
            border-bottom: 2px solid transparent;
            background-color: transparent;
        }

        .filter-tab:hover {
            color: #f3a446;
            background-color: rgba(255, 255, 255, 0.05);
        }

        /* "Awesome" Active State (Updated Colors) */
        .filter-tab.active {
            background-color: #f3a446;
            color: #1a262a;
            box-shadow: 0 5px 15px rgba(243, 164, 70, 0.4);
            transform: scale(1.05);
        }

        /* --- Designs Grid --- */
        .designs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
        }

        /* --- Design Card (Fahma/Luxury) (Updated Colors) --- */
        .design-card {
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: 2px solid transparent;
            /* Base border */
            transition: all 0.35s ease-in-out;
            will-change: transform, box-shadow, border-color;
        }

        /* "Global" Hover Effect (Updated Colors) */
        .design-card:hover {
            transform: translateY(-10px);
            border-color: #f3a446;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1), 0 0 25px rgba(243, 164, 70, 0.5);
        }

        .design-image {
            position: relative;
            overflow: hidden;
            /* Crucial for image zoom */
            height: 220px;
        }

        .design-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.35s ease-in-out;
        }

        .design-card:hover .design-image img {
            transform: scale(1.05);
        }

        .design-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg, transparent 50%, rgba(0, 0, 0, 0.7) 100%);
            opacity: 0;
            transition: opacity 0.35s ease;
        }

        .design-card:hover .design-overlay {
            opacity: 1;
        }

        .overlay-content {
            position: absolute;
            bottom: 15px;
            left: 15px;
            color: white;
        }

        .overlay-title {
            font-weight: 900;
            font-size: 1.2rem;
        }

        .overlay-subtitle {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .design-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: #f3a446;
            color: #1a262a;
            padding: 4px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 700;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .design-content {
            padding: 1.5rem;
        }

        .design-title {
            font-size: 1.25rem;
            font-weight: 900;
            color: #1a262a;
            margin-bottom: 0.5rem;
            transition: color 0.3s ease;
        }

        .design-card:hover .design-title {
            color: #f3a446;
        }

        .design-description {
            color: #4b5563;
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .design-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #e5e7eb;
            padding-top: 1rem;
            margin-bottom: 1rem;
        }

        .design-price {
            font-size: 1.1rem;
            font-weight: 900;
            color: #2f5c69;
        }

        .design-area {
            font-size: 0.9rem;
            color: #4b5563;
            font-weight: 700;
        }

        .design-features {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 1.5rem;
        }

        .feature-tag {
            background-color: #f3f4f6;
            color: #2f5c69;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        /* --- Card Buttons (Re-styled & Updated) --- */
        .design-actions {
            display: flex;
            /* flex-wrap: wrap; */
            /* gap: 10px; */
            width: 100%;
            margin: auto;


        }

        .design-actions a {
            text-align: center;
        }

        .btn-primary,
        .btn-secondary {
            /* flex-grow: 1; */
            /* padding: 10px 16px; */
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            text-align: center;

        }

        .btn-primary {
            background-color: #f3a446;
            color: #1a262a;
            border-color: #f3a446;
            text-align: center;

        }

        .btn-primary:hover {
            background-color: #f5b05a;
            border-color: #f5b05a;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(243, 164, 70, 0.4);
        }

        .btn-secondary {
            background-color: transparent;
            color: #2f5c69;
            border-color: #2f5c69;
        }

        .btn-secondary:hover {
            background-color: #2f5c69;
            color: #ffffff;
            transform: translateY(-2px);
        }

        /* Edit/Delete Buttons (No change needed) */
        .btn-primary.bg-blue-600 {
            background-color: #2563eb;
            border-color: #2563eb;
            color: white;
        }

        .btn-primary.bg-blue-600:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
        }

        .btn-secondary.bg-red-600 {
            background-color: #dc2626;
            border-color: #dc2626;
            color: white;
        }

        .btn-secondary.bg-red-600:hover {
            background-color: #b91c1c;
            border-color: #b91c1c;
        }


        /* --- Pagination Styling (Updated Colors) --- */
        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            gap: 8px;
        }

        .pagination li a,
        .pagination li span {
            display: block;
            padding: 8px 14px;
            border-radius: 8px;
            color: #2f5c69;
            background-color: #f3f4f6;
            transition: all 0.3s ease;
            font-weight: 700;
        }

        .pagination li a:hover {
            background-color: #e5e7eb;
        }

        .pagination li.active span {
            background-color: #f3a446;
            color: #1a262a;
            box-shadow: 0 2px 5px rgba(243, 164, 70, 0.3);
        }

        .pagination li.disabled span {
            background-color: #f9fafb;
            color: #9ca3af;
        }

        /* --- Animation for Filtering --- */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .design-card[style*="display: block"] {
            animation: fadeIn 0.5s ease-out;
        }

        @media (max-width:768px) {
            .designs-hero {
                border-radius: 0;
                margin-top: 0;
                width: 100%;
            }

        }


        @media (max-width:700px) {
            .hero-title {
                margin-top: 30px;
            }

        }
    </style>

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
                    {{ __('app.designs_hero.title') }}
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    {{ __('app.designs_hero.subtitle') }}
                </p>
            </div>

            <div class="filter-tabs">
                <div class="filter-tab active" onclick="filterDesigns('all')">
                    {{ __('app.designs_hero.filters.all') }}
                </div>
                <div class="filter-tab" onclick="filterDesigns('modern')">
                    {{ __('app.designs_hero.filters.modern') }}
                </div>
                <div class="filter-tab" onclick="filterDesigns('classic')">
                    {{ __('app.designs_hero.filters.classic') }}
                </div>
                <div class="filter-tab" onclick="filterDesigns('traditional')">
                    {{ __('app.designs_hero.filters.traditional') }}
                </div>
                <div class="filter-tab" onclick="filterDesigns('luxury')">
                    {{ __('app.designs_hero.filters.luxury') }}
                </div>
                <div class="filter-tab" onclick="filterDesigns('minimal')">
                    {{ __('app.designs_hero.filters.minimal') }}
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="designs-grid" id="designsGrid">
                @forelse($designs as $design)
                    <div class="design-card" data-category="{{ strtolower($design->style) }}">
                        <div class="design-image">
                            <img src="{{ $design->main_image_url }}" alt="{{ $design->title }}" />
                            <div class="design-overlay">
                                <div class="overlay-content">
                                    <div class="overlay-title">{{ $design->title }}</div>
                                    <div class="overlay-subtitle">
                                        {{ Str::limit($design->description, 50) }}
                                    </div>
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
                                <span class="feature-tag">{{ $design->bedrooms }}
                                    {{ __('app.designs_grid.bedrooms') }}</span>
                                <span class="feature-tag">{{ $design->bathrooms }}
                                    {{ __('app.designs_grid.bathrooms') }}</span>
                                <span class="feature-tag">{{ $design->floors }} {{ __('app.designs_grid.floors') }}</span>
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
                                <a href="{{ route('designs.show-with-pricing', $design->id) }}"
                                    class="btn-primary  text-center">{{ __('app.designs_grid.view_with_pricing') }}</a>
                                <a href="{{ route('designs.show', $design->id) }}"
                                    class="btn-secondary text-center">{{ __('app.view_details') }}</a>

                                @auth
                                    @if (auth()->user()->isConsultant() && auth()->id() == $design->consultant_id)
                                        <a href="{{ route('designs.edit', $design->id) }}"
                                            class="btn-primary bg-blue-600 hover:bg-blue-700">{{ __('app.designs_grid.edit') }}</a>
                                        <button onclick="deleteDesign({{ $design->id }})"
                                            class="btn-secondary bg-red-600 hover:bg-red-700 text-white">
                                            {{ __('app.designs_grid.delete') }}
                                        </button>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="text-gray-500 text-lg">
                            <i class="fas fa-home text-4xl mb-4 text-gray-400"></i>
                            <p class="font-bold">
                                {{ __('app.designs_grid.no_designs_title') }}
                            </p>
                            <p class="text-sm mt-2">
                                {{ __('app.designs_grid.no_designs_subtitle') }}
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($designs->hasPages())
                <div class="mt-12">
                    {{ $designs->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </section>

    <script>
        function filterDesigns(category) {
            // 1. Handle Active Tab State
            const tabs = document.querySelectorAll('.filter-tab');
            tabs.forEach(tab => {
                tab.classList.remove('active');
                if (tab.getAttribute('onclick') === `filterDesigns('${category}')`) {
                    tab.classList.add('active');
                }
            });

            // 2. Filter Design Cards
            const cards = document.querySelectorAll('.design-card');
            cards.forEach(card => {
                const cardCategory = card.getAttribute('data-category').toLowerCase();

                if (category === 'all' || cardCategory === category.toLowerCase()) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // (Assume deleteDesign function exists elsewhere in your main JS)
        // function deleteDesign(id) { ... }
    </script>




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



    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap');

        /* --- Section 1: Inspiration (Why Choose Us) --- */
        .inspiration-section {
            padding-top: 5rem;
            padding-bottom: 5rem;
            background-color: #f9fafb;
        }

        .inspiration-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .inspiration-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 2rem;
            }
        }

        .inspiration-card {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 2.5rem 2rem;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border-bottom: 4px solid transparent;
            transition: all 0.3s ease-in-out;

            opacity: 0;
            transform: translateY(20px);
        }

        .inspiration-section.is-visible .inspiration-card {
            opacity: 1;
            transform: translateY(0);
        }

        .inspiration-section.is-visible .inspiration-card:nth-child(1) {
            transition-delay: 0.1s;
        }

        .inspiration-section.is-visible .inspiration-card:nth-child(2) {
            transition-delay: 0.2s;
        }

        .inspiration-section.is-visible .inspiration-card:nth-child(3) {
            transition-delay: 0.3s;
        }


        .inspiration-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border-bottom-color: #f3a446;
        }

        .inspiration-icon {
            margin: 0 auto 1.5rem auto;
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background-color: #f3a446;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(243, 164, 70, 0.4);
            transition: all 0.3s ease;
        }

        .inspiration-icon i {
            font-size: 2rem;
            color: #1a262a;
        }

        .inspiration-card:hover .inspiration-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 6px 20px rgba(243, 164, 70, 0.6);
        }

        .inspiration-title {
            font-size: 1.5rem;
            font-weight: 900;
            color: #2f5c69;
            margin-bottom: 0.75rem;
        }

        .inspiration-description {
            font-size: 1rem;
            color: #4b5563;
            line-height: 1.7;
        }

        /* --- Section 2: CTA (Call to Action) --- */
        .cta-section {
            padding-top: 5rem;
            padding-bottom: 5rem;
        }

        .cta-frame-dark {
            border: 3px solid #f3a446;
            border-radius: 20px;
            padding: 3.5rem 2rem;
            background: linear-gradient(135deg, #2f5c69 0%, #1a262a 100%);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
            text-align: center;
            animation: subtleGlow 4s ease-in-out infinite;
        }

        @keyframes subtleGlow {
            0% {
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5), 0 0 15px rgba(243, 164, 70, 0.2);
            }

            50% {
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5), 0 0 30px rgba(243, 164, 70, 0.4);
            }

            100% {
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5), 0 0 15px rgba(243, 164, 70, 0.2);
            }
        }


        .cta-title {
            font-size: 2.5rem;
            font-weight: 900;
            color: #f3a446;
            margin-bottom: 1rem;
        }

        .cta-description {
            font-size: 1.125rem;
            color: #d1d5db;
            max-width: 2xl;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 2.5rem;
            line-height: 1.8;
        }

        .cta-buttons {
            display: flex;
            justify-content: center;
        }

        .cta-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #f3a446;
            color: #1a262a;
            padding: 1rem 2.5rem;
            border-radius: 12px;
            font-size: 1.125rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(243, 164, 70, 0.4);
        }

        .cta-btn:hover {
            background-color: #f5b05a;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(243, 164, 70, 0.6);
        }

        .cta-btn i {
            margin-left: 0.75rem;
        }
    </style>

    <section class="inspiration-section" id="inspiration-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-extrabold text-[#1a2a1a] mb-4">
                    {{ __('app.inspiration_section.title') }}
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    {{ __('app.inspiration_section.subtitle') }}
                </p>
            </div>

            <div class="inspiration-grid">
                <div class="inspiration-card">
                    <div class="inspiration-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3 class="inspiration-title">
                        {{ __('app.inspiration_section.cards.card_1.title') }}
                    </h3>
                    <p class="inspiration-description">
                        {{ __('app.inspiration_section.cards.card_1.description') }}
                    </p>
                </div>

                <div class="inspiration-card">
                    <div class="inspiration-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3 class="inspiration-title">
                        {{ __('app.inspiration_section.cards.card_2.title') }}
                    </h3>
                    <p class="inspiration-description">
                        {{ __('app.inspiration_section.cards.card_2.description') }}
                    </p>
                </div>

                <div class="inspiration-card">
                    <div class="inspiration-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="inspiration-title">
                        {{ __('app.inspiration_section.cards.card_3.title') }}
                    </h3>
                    <p class="inspiration-description">
                        {{ __('app.inspiration_section.cards.card_3.description') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="cta-frame-dark">
                <h2 class="cta-title">
                    {{ __('app.cta_section_designs.title') }}
                </h2>
                <p class="cta-description">
                    {{ __('app.cta_section_designs.description') }}
                </p>
                <div class="cta-buttons">
                    <a href="{{ route('designs.create') }}" class="cta-btn">
                        <i class="fas fa-plus"></i>
                        <span>{{ __('app.cta_section_designs.button') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const inspirationSection = document.getElementById('inspiration-section');

            if (!inspirationSection) return;

            // Create an observer
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    // When the section is 10% visible
                    if (entry.isIntersecting) {
                        inspirationSection.classList.add('is-visible');
                        // Stop observing once animation is triggered
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            }); // Trigger when 10% of the section is visible

            // Start observing the section
            observer.observe(inspirationSection);
        });
    </script>

    <script>
        function filterDesigns(category) {
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.classList.remove('active');
            });

            event.target.classList.add('active');

            const designCards = document.querySelectorAll('.design-card');

            designCards.forEach(card => {
                if (category === 'all' || card.dataset.category.includes(category)) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeIn 0.5s ease-in-out';
                } else {
                    card.style.display = 'none';
                }
            });
        }

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
