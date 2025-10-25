@extends('layouts.app')

@section('title', $tender->title . ' - انشاءات')

@section('content')
    <style>
        /* Modern Design System - Fixed Colors */
        body {
            background-color: #f8fafc !important;
            color: #0f172a !important;
        }

        /* Enhanced Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 50%, #0d9488 100%);
            position: relative;
            overflow: hidden;
            min-height: 400px;
        }

        /* Modern Glass Cards */
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

        /* Enhanced Status Badges */
        .status-badge {
            padding: 0.75rem 1.5rem;
            border-radius: 20px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
        }

        .status-badge:hover {
            transform: scale(1.05);
        }

        .status-open {
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
            color: #166534;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        .status-closed {
            background: linear-gradient(135deg, #fef2f2, #fee2e2);
            color: #991b1b;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .status-awarded {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        /* Modern Tabs */
        .tab-button {
            position: relative;
            padding: 1rem 1.5rem;
            font-weight: 500;
            color: #475569;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 12px 12px 0 0;
            background: transparent;
            border: none;
            cursor: pointer;
        }

        .tab-button:hover {
            color: #0f766e;
            background: rgba(15, 118, 110, 0.05);
        }

        .tab-button.tab-active {
            color: #0f766e;
            background: #ffffff;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }

        .tab-button.tab-active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #0f766e, #14b8a6);
            border-radius: 2px 2px 0 0;
        }

        /* Enhanced Progress Bar */
        .progress-bar {
            height: 12px;
            border-radius: 12px;
            background: #f1f5f9;
            overflow: hidden;
            position: relative;
        }

        .progress-fill {
            height: 100%;
            border-radius: 12px;
            transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        /* Enhanced Animations */
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

        /* Enhanced Text Effects */
        .gradient-text {
            background: linear-gradient(135deg, #0f766e, #14b8a6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .text-shadow {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .icon-glow {
            filter: drop-shadow(0 0 8px rgba(15, 118, 110, 0.3));
        }

        /* Enhanced Hover Effects */
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Modern Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #0f766e, #14b8a6);
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
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0d9488, #0f766e);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Enhanced Sidebar */
        .sticky-sidebar {
            position: sticky;
            top: 2rem;
        }

        .sidebar-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px);
        }

        /* Enhanced Info Items */
        .info-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-bottom: 0.75rem;
        }

        .info-item:hover {
            background: #f1f5f9;
            transform: translateX(-4px);
        }

        .info-item-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 1rem;
            font-size: 1.1rem;
        }

        /* Enhanced Tables */
        .modern-table {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .modern-table th {
            background: #f1f5f9;
            padding: 1rem;
            font-weight: 600;
            color: #0f172a;
            border-bottom: 2px solid #e2e8f0;
        }

        .modern-table td {
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .modern-table tr:hover td {
            background: #f8fafc;
        }

        /* Enhanced Modals */
        .fullscreen-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #ffffff;
            z-index: 9999;
            overflow-y: auto;
            animation: fadeIn 0.3s ease-out;
        }

        .fullscreen-header {
            position: sticky;
            top: 0;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 10000;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .fullscreen-content {
            padding: 2rem;
        }

        /* Enhanced Image Slider */
        .image-slider {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease-out;
        }

        .slider-container {
            position: relative;
            max-width: 90%;
            max-height: 90%;
            border-radius: 12px;
            overflow: hidden;
        }

        .slider-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 12px;
        }

        .slider-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 1.5rem;
            padding: 1rem;
            cursor: pointer;
            border-radius: 50%;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
        }

        .slider-nav:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-50%) scale(1.1);
        }

        .slider-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 1.5rem;
            padding: 0.75rem;
            cursor: pointer;
            border-radius: 50%;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
        }

        .slider-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .slider-counter {
            position: absolute;
            bottom: 1rem;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            backdrop-filter: blur(10px);
        }

        .slider-thumbnails {
            position: absolute;
            bottom: 4rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 0.5rem;
            max-width: 80%;
            overflow-x: auto;
            padding: 0.5rem;
        }

        .slider-thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            opacity: 0.6;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
        }

        .slider-thumbnail.active {
            opacity: 1;
            border-color: white;
            transform: scale(1.1);
        }

        .slider-thumbnail:hover {
            opacity: 0.8;
            transform: scale(1.05);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 12px;
        }

        ::-webkit-scrollbar-thumb {
            background: #0f766e;
            border-radius: 12px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #0d9488;
        }

        /* RTL Adjustments */
        .rtl-grid {
            direction: rtl;
        }

        .flip-icon {
            transform: scaleX(-1);
        }

        /* Breadcrumb Enhancement */
        .breadcrumb-item {
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .breadcrumb-item:not(:last-child)::after {
            content: '';
            position: absolute;
            right: -1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 0.5rem;
            height: 0.5rem;
            border-right: 2px solid rgba(255, 255, 255, 0.6);
            border-bottom: 2px solid rgba(255, 255, 255, 0.6);
            transform: translateY(-50%) rotate(-45deg);
        }

        .breadcrumb-item:hover {
            color: white !important;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-section {
                min-height: 300px;
                padding: 1.5rem 1rem;
            }

            .glass-card {
                margin: 0.5rem;
                padding: 1rem;
            }

            .tab-button {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }

            .sidebar-card {
                margin: 0.5rem;
            }

            .slider-nav {
                font-size: 1.2rem;
                padding: 0.75rem;
            }

            .slider-close {
                font-size: 1.2rem;
                padding: 0.5rem;
            }
        }

        @media (max-width: 480px) {
            .hero-section {
                min-height: 250px;
            }

            .glass-card {
                margin: 0.25rem;
                padding: 0.75rem;
            }

            .tab-button {
                padding: 0.5rem 0.75rem;
                font-size: 0.8rem;
            }
        }

        /* Loading States */
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        /* Focus States */
        *:focus {
            outline: 2px solid #0f766e;
            outline-offset: 2px;
        }

        /* Print Styles */
        @media print {

            .hero-section,
            .sidebar-card,
            .tab-button,
            .btn-primary {
                display: none !important;
            }

            .glass-card {
                box-shadow: none;
                border: 1px solid #ccc;
            }
        }

        /* Additional Enhancements */
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="10" cy="60" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="90" cy="40" r="0.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
            pointer-events: none;
        }

        /* Floating Animation */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        /* Shimmer Effect */
        @keyframes shimmer {
            0% {
                background-position: -200px 0;
            }

            100% {
                background-position: calc(200px + 100%) 0;
            }
        }

        .shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200px 100%;
            animation: shimmer 1.5s infinite;
        }

        /* Ripple Effect */
        .ripple {
            position: relative;
            overflow: hidden;
        }

        .ripple::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .ripple:active::before {
            width: 300px;
            height: 300px;
        }

        /* Glass Morphism Enhancement */
        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            border-radius: inherit;
            pointer-events: none;
        }

        /* Enhanced Focus States */
        .tab-button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.3);
        }

        .btn-primary:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.3);
        }

        /* Loading States */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        /* Notification Styles */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #10b981;
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            z-index: 10000;
            transform: translateX(100%);
            transition: transform 0.3s ease-out;
        }

        .notification.show {
            transform: translateX(0);
        }

        /* Enhanced Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #0f766e, #14b8a6);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #0d9488, #0f766e);
        }
    </style>
    <!-- Enhanced Hero Section -->
    <section class="hero-section text-white relative">
        <div class="container mx-auto px-4 py-16 relative z-10">
            <!-- Main Hero Content -->
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8">
                <!-- Left Content -->
                <div class="flex-1 animate-fade-in">
                    <!-- Title with enhanced styling -->
                    <h1 class="text-4xl lg:text-5xl font-bold text-shadow mb-6 leading-tight">
                        {{ $tender->title }}
                    </h1>

                    <!-- Location and Client Info -->
                    <div class="space-y-4 mb-8">
                        <div class="flex items-center text-white/90 group">
                            <div
                                class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center ml-4 group-hover:bg-white/30 transition-all duration-300">
                                <i class="fas fa-map-marker-alt text-xl icon-glow"></i>
                            </div>
                            <div>
                                <p class="text-sm text-white/70">الموقع</p>
                                <p class="text-xl font-semibold">{{ $tender->location }}</p>
                            </div>
                        </div>

                        <div class="flex items-center text-white/90 group">
                            <div
                                class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center ml-4 group-hover:bg-white/30 transition-all duration-300">
                                <i class="fas fa-user text-xl icon-glow"></i>
                            </div>
                            <div>
                                <p class="text-sm text-white/70">العميل</p>
                                <p class="text-xl font-semibold">{{ $tender->client->name }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div
                            class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center hover:bg-white/20 transition-all duration-300">
                            <i class="fas fa-calendar-alt text-2xl mb-2"></i>
                            <p class="text-sm text-white/70">آخر موعد</p>
                            <p class="font-semibold">{{ $tender->formatted_deadline }}</p>
                        </div>

                        <div
                            class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center hover:bg-white/20 transition-all duration-300">
                            <i class="fas fa-file-alt text-2xl mb-2"></i>
                            <p class="text-sm text-white/70">عدد العروض</p>
                            <p class="font-semibold">{{ $tender->proposals_count }}</p>
                        </div>

                        @if ($tender->budget)
                            <div
                                class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center hover:bg-white/20 transition-all duration-300">
                                <i class="fas fa-money-bill-wave text-2xl mb-2"></i>
                                <p class="text-sm text-white/70">الميزانية</p>
                                <p class="font-semibold">{{ $tender->formatted_budget }}</p>
                            </div>
                        @endif

                        @if ($tender->days_remaining !== null)
                            <div
                                class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center hover:bg-white/20 transition-all duration-300">
                                <i class="fas fa-clock text-2xl mb-2"></i>
                                <p class="text-sm text-white/70">الأيام المتبقية</p>
                                <p class="font-semibold">{{ $tender->days_remaining }} يوم</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Right Content - Status and Actions -->
                <div class="flex flex-col items-center lg:items-end gap-6 animate-slide-in">
                    <!-- Enhanced Status Badge -->
                    @if ($tender->status === 'open')
                        <div class="status-badge status-open animate-bounce-in">
                            <div class="w-3 h-3 bg-green-500 rounded-full ml-3 animate-pulse"></div>
                            <span class="text-lg font-bold">مناقصة مفتوحة</span>
                        </div>
                    @elseif($tender->status === 'closed')
                        <div class="status-badge status-closed animate-bounce-in">
                            <i class="fas fa-lock ml-3 text-lg"></i>
                            <span class="text-lg font-bold">مناقصة مغلقة</span>
                        </div>
                    @elseif($tender->status === 'awarded')
                        <div class="status-badge status-awarded animate-bounce-in">
                            <i class="fas fa-trophy ml-3 text-lg"></i>
                            <span class="text-lg font-bold">مناقصة ممنوحة</span>
                        </div>
                    @endif

                    <!-- Client Info Card -->
                    <div class="glass-card rounded-2xl p-6 w-full max-w-sm">
                        <div class="flex items-center mb-4">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center ml-4">
                                <i class="fas fa-user text-white text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-medium">معلومات العميل</p>
                                <p class="text-lg font-bold text-gray-800">{{ $tender->client->name }}</p>
                            </div>
                        </div>

                        @if ($tender->client->phone)
                            <div class="flex items-center text-gray-600 mb-2">
                                <i class="fas fa-phone ml-3"></i>
                                <span>{{ $tender->client->phone }}</span>
                            </div>
                        @endif

                        @if ($tender->client->city)
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-map-marker-alt ml-3"></i>
                                <span>{{ $tender->client->city }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Quick Actions -->
                    @auth
                        @if (auth()->user()->isConsultant() && $tender->status === 'open')
                            @if ($userProposal)
                                <a href="{{ route('proposals.edit', $userProposal->id) }}"
                                    class="btn-primary w-full justify-center text-lg py-4">
                                    <i class="fas fa-edit"></i>
                                    تعديل العرض
                                </a>
                            @else
                                <a href="{{ route('proposals.create', $tender->id) }}"
                                    class="btn-primary w-full justify-center text-lg py-4">
                                    <i class="fas fa-paper-plane"></i>
                                    قدم عرض الآن
                                </a>
                            @endif
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn-primary w-full justify-center text-lg py-4">
                            <i class="fas fa-sign-in-alt"></i>
                            سجل دخول للمشاركة
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Enhanced Breadcrumb -->
            <nav class="flex items-center mt-12 text-sm animate-fade-in">
                <a href="{{ route('home') }}"
                    class="breadcrumb-item text-white/80 hover:text-white transition-all duration-300 hover:scale-105">
                    <i class="fas fa-home ml-2"></i>
                    الرئيسية
                </a>
                <a href="{{ route('tenders.index') }}"
                    class="breadcrumb-item text-white/80 hover:text-white transition-all duration-300 hover:scale-105">
                    <i class="fas fa-file-contract ml-2"></i>
                    المناقصات
                </a>
                <span class="text-white font-medium flex items-center">
                    <i class="fas fa-arrow-left ml-2"></i>
                    {{ Str::limit($tender->title, 30) }}
                </span>
            </nav>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8 rtl-grid">
            <!-- Left Column - Main Content -->
            <div class="lg:w-2/3">
                <!-- Enhanced Tabs Navigation -->
                <div class="glass-card rounded-2xl mb-8 overflow-hidden">
                    <div class="flex overflow-x-auto bg-gradient-to-r from-gray-50 to-gray-100 p-2">
                        <button id="tab-overview"
                            class="tab-button flex-shrink-0 px-8 py-4 font-semibold text-gray-700 hover:text-teal-600 transition-all duration-300 tab-active group">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 bg-teal-100 group-hover:bg-teal-200 rounded-xl flex items-center justify-center ml-3 transition-all duration-300">
                                    <i class="fas fa-info-circle text-teal-600"></i>
                                </div>
                                <span>نظرة عامة</span>
                            </div>
                        </button>
                        <button id="tab-design"
                            class="tab-button flex-shrink-0 px-8 py-4 font-semibold text-gray-700 hover:text-purple-600 transition-all duration-300 group">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 bg-purple-100 group-hover:bg-purple-200 rounded-xl flex items-center justify-center ml-3 transition-all duration-300">
                                    <i class="fas fa-palette text-purple-600"></i>
                                </div>
                                <span>التصميم</span>
                            </div>
                        </button>
                        <button id="tab-items"
                            class="tab-button flex-shrink-0 px-8 py-4 font-semibold text-gray-700 hover:text-orange-600 transition-all duration-300 group">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 bg-orange-100 group-hover:bg-orange-200 rounded-xl flex items-center justify-center ml-3 transition-all duration-300">
                                    <i class="fas fa-list text-orange-600"></i>
                                </div>
                                <span>بنود المناقصة</span>
                            </div>
                        </button>
                        <button id="tab-proposals"
                            class="tab-button flex-shrink-0 px-8 py-4 font-semibold text-gray-700 hover:text-green-600 transition-all duration-300 group">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 bg-green-100 group-hover:bg-green-200 rounded-xl flex items-center justify-center ml-3 transition-all duration-300">
                                    <i class="fas fa-file-alt text-green-600"></i>
                                </div>
                                <span>العروض</span>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Tab Content -->
                <div id="tab-content" class="animate-fade-in">
                    <!-- Overview Tab -->
                    <div id="content-overview" class="tab-content active">
                        <!-- Description Card -->
                        <div class="glass-card rounded-2xl p-8 mb-8 hover-lift">
                            <div class="flex items-center mb-6">
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center ml-4 shadow-lg">
                                    <i class="fas fa-file-alt text-white text-2xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-800 mb-2">وصف المشروع</h2>
                                    <p class="text-gray-600">تفاصيل المشروع والمتطلبات الأساسية</p>
                                </div>
                            </div>
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-100">
                                <p class="text-gray-700 leading-relaxed text-lg">{{ $tender->description }}</p>
                            </div>
                        </div>

                        <!-- Requirements Card -->
                        @if ($tender->requirements)
                            <div class="glass-card rounded-2xl p-8 mb-8 hover-lift">
                                <div class="flex items-center mb-6">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center ml-4 shadow-lg">
                                        <i class="fas fa-clipboard-check text-white text-2xl"></i>
                                    </div>
                                    <div>
                                        <h2 class="text-2xl font-bold text-gray-800 mb-2">المتطلبات والشروط</h2>
                                        <p class="text-gray-600">الشروط والمتطلبات الفنية للمشروع</p>
                                    </div>
                                </div>
                                <div
                                    class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border border-green-100">
                                    <p class="text-gray-700 leading-relaxed text-lg whitespace-pre-line">
                                        {{ $tender->requirements }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Client Notes Card -->
                        @if ($tender->client_notes)
                            <div class="glass-card rounded-2xl p-8 mb-8 hover-lift border-2 border-yellow-200">
                                <div class="flex items-center mb-6">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-2xl flex items-center justify-center ml-4 shadow-lg">
                                        <i class="fas fa-sticky-note text-white text-2xl"></i>
                                    </div>
                                    <div>
                                        <h2 class="text-2xl font-bold text-gray-800 mb-2">ملاحظات التعديل المطلوبة</h2>
                                        <p class="text-gray-600">تعديلات إضافية مطلوبة من العميل</p>
                                    </div>
                                </div>
                                <div
                                    class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl p-6 border border-yellow-200 relative">
                                    <div class="absolute top-4 right-4">
                                        <i class="fas fa-exclamation-triangle text-yellow-500 text-xl"></i>
                                    </div>
                                    <p class="text-gray-700 leading-relaxed text-lg whitespace-pre-line pr-8">
                                        {{ $tender->client_notes }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        <!-- Project Timeline Card -->
                        <div class="glass-card rounded-2xl p-8 mb-8 hover-lift">
                            <div class="flex items-center mb-6">
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center ml-4 shadow-lg">
                                    <i class="fas fa-calendar-alt text-white text-2xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-800 mb-2">الجدول الزمني</h2>
                                    <p class="text-gray-600">معلومات المواعيد والمراحل</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div
                                    class="bg-gradient-to-r from-purple-50 to-violet-50 rounded-xl p-6 border border-purple-100">
                                    <div class="flex items-center mb-3">
                                        <i class="fas fa-calendar-plus text-purple-600 ml-3"></i>
                                        <h3 class="font-semibold text-gray-800">تاريخ الإنشاء</h3>
                                    </div>
                                    <p class="text-lg font-bold text-purple-600">
                                        {{ $tender->created_at->format('Y-m-d') }}</p>
                                </div>
                                <div class="bg-gradient-to-r from-red-50 to-pink-50 rounded-xl p-6 border border-red-100">
                                    <div class="flex items-center mb-3">
                                        <i class="fas fa-calendar-times text-red-600 ml-3"></i>
                                        <h3 class="font-semibold text-gray-800">آخر موعد للتقديم</h3>
                                    </div>
                                    <p class="text-lg font-bold text-red-600">{{ $tender->formatted_deadline }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Design Tab -->
                    <div id="content-design" class="tab-content hidden">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6 card-hover">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center ml-3">
                                    <i class="fas fa-home text-purple-600"></i>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">التصميم المطلوب</h2>
                            </div>

                            <div class="flex flex-col md:flex-row gap-6">
                                <div class="md:w-1/3">
                                    <div class="relative group">
                                        <img src="{{ $tender->design->main_image_url }}"
                                            alt="{{ $tender->design->title }}"
                                            class="w-full h-64 object-cover rounded-xl shadow-md cursor-pointer"
                                            onclick="openImageModal('{{ $tender->design->main_image_url }}')">
                                        <div
                                            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 rounded-xl flex items-center justify-center">
                                            <i
                                                class="fas fa-expand text-white text-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                                        </div>
                                    </div>

                                    @if ($tender->design->images && count($tender->design->images) > 1)
                                        <div class="mt-3 flex gap-2 overflow-x-auto pb-2">
                                            @foreach ($tender->design->images as $index => $image)
                                                <img src="{{ $image }}" alt="صورة {{ $index + 1 }}"
                                                    class="w-16 h-16 object-cover rounded-lg cursor-pointer hover:opacity-80 transition-opacity duration-200"
                                                    onclick="openImageModal('{{ $image }}')">
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <div class="md:w-2/3">
                                    <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ $tender->design->title }}</h3>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                            <i class="fas fa-palette text-purple-500 ml-3"></i>
                                            <div>
                                                <p class="text-sm text-gray-500">النمط</p>
                                                <p class="font-medium">{{ $tender->design->style }}</p>
                                            </div>
                                        </div>

                                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                            <i class="fas fa-ruler-combined text-blue-500 ml-3"></i>
                                            <div>
                                                <p class="text-sm text-gray-500">المساحة</p>
                                                <p class="font-medium">{{ $tender->design->formatted_area }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-wrap gap-3">
                                        <a href="{{ route('designs.show', $tender->design->id) }}"
                                            class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg font-medium transition-colors">
                                            <i class="fas fa-eye ml-2"></i>
                                            عرض التفاصيل الكاملة
                                        </a>

                                        @if ($tender->design->images && count($tender->design->images) > 1)
                                            <button onclick="openGalleryModal()"
                                                class="inline-flex items-center bg-purple-600 hover:bg-purple-700 text-white px-5 py-3 rounded-lg font-medium transition-colors">
                                                <i class="fas fa-images ml-2"></i>
                                                معرض الصور
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Items Tab -->
                    <div id="content-items" class="tab-content hidden">
                        @if ($itemsByCategory && $itemsByCategory->count() > 0)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                                <div
                                    class="flex flex-col md:flex-row justify-between items-start md:items-center p-6 border-b border-gray-200">
                                    <div class="flex items-center mb-4 md:mb-0">
                                        <div
                                            class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center ml-3">
                                            <i class="fas fa-list text-orange-600"></i>
                                        </div>
                                        <h2 class="text-xl font-bold text-gray-800">بنود المناقصة</h2>
                                    </div>

                                    <div class="flex gap-3">
                                        <button onclick="exportItemsToPDF()"
                                            class="inline-flex items-center bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                            <i class="fas fa-file-pdf ml-2"></i>
                                            تصدير PDF
                                        </button>

                                        <button onclick="toggleItemsView()"
                                            class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                            <i class="fas fa-th-large ml-2"></i>
                                            تبديل العرض
                                        </button>
                                    </div>
                                </div>

                                <div id="items-container">
                                    <!-- Default Table View -->
                                    <div id="items-table-view">
                                        <div class="overflow-x-auto">
                                            <table class="w-full">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th
                                                            class="px-6 py-4 text-right text-sm font-semibold text-gray-700">
                                                            الفئة</th>
                                                        <th
                                                            class="px-6 py-4 text-right text-sm font-semibold text-gray-700">
                                                            اسم البند</th>
                                                        <th
                                                            class="px-6 py-4 text-center text-sm font-semibold text-gray-700">
                                                            الكمية</th>
                                                        <th
                                                            class="px-6 py-4 text-center text-sm font-semibold text-gray-700">
                                                            الوحدة</th>
                                                        <th
                                                            class="px-6 py-4 text-center text-sm font-semibold text-gray-700">
                                                            سعر الوحدة</th>
                                                        <th
                                                            class="px-6 py-4 text-center text-sm font-semibold text-gray-700">
                                                            الإجمالي</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-gray-200">
                                                    @foreach ($itemsByCategory as $categoryName => $items)
                                                        @foreach ($items as $item)
                                                            <tr class="hover:bg-gray-50 transition-colors">
                                                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                                                    {{ $categoryName }}</td>
                                                                <td class="px-6 py-4 text-sm text-gray-900">
                                                                    <div>
                                                                        <p class="font-medium">{{ $item->item_name }}
                                                                        </p>
                                                                        @if ($item->notes)
                                                                            <p class="text-xs text-gray-500 mt-1">
                                                                                {{ $item->notes }}</p>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                                <td class="px-6 py-4 text-center text-sm text-gray-900">
                                                                    {{ $item->quantity ?? 'N/A' }}</td>
                                                                <td class="px-6 py-4 text-center text-sm text-gray-900">
                                                                    {{ $item->unit ?? '-' }}</td>
                                                                <td class="px-6 py-4 text-center text-sm text-gray-900">
                                                                    {{ $item->unit_price ?? 'N/A' }}</td>
                                                                <td
                                                                    class="px-6 py-4 text-center text-sm font-semibold text-green-600">
                                                                    {{ $item->total_price ?? 'N/A' }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Card View (Hidden by default) -->
                                    <div id="items-card-view" class="hidden p-6">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            @foreach ($itemsByCategory as $categoryName => $items)
                                                @foreach ($items as $item)
                                                    <div
                                                        class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 transition-colors">
                                                        <div class="flex justify-between items-start mb-2">
                                                            <span
                                                                class="text-xs font-medium bg-blue-100 text-blue-800 px-2 py-1 rounded-full">{{ $categoryName }}</span>
                                                            <span
                                                                class="text-lg font-bold text-green-600">{{ $item->total_price ?? 'N/A' }}</span>
                                                        </div>
                                                        <h3 class="font-semibold text-gray-800 mb-2">
                                                            {{ $item->item_name }}</h3>
                                                        <div class="flex justify-between text-sm text-gray-600">
                                                            <span>الكمية: {{ $item->quantity ?? 'N/A' }}</span>
                                                            <span>الوحدة: {{ $item->unit ?? '-' }}</span>
                                                            <span>سعر الوحدة: {{ $item->unit_price ?? 'N/A' }}</span>
                                                        </div>
                                                        @if ($item->notes)
                                                            <p class="text-xs text-gray-500 mt-2">{{ $item->notes }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                                <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                                <h3 class="text-lg font-medium text-gray-700 mb-2">لا توجد بنود</h3>
                                <p class="text-gray-500">لم يتم إضافة بنود لهذه المناقصة بعد</p>
                            </div>
                        @endif
                    </div>

                    <!-- Proposals Tab -->
                    <div id="content-proposals" class="tab-content hidden">
                        @auth
                            @if (auth()->user()->isClient() && auth()->id() == $tender->client_id)
                                <!-- Client View -->
                                @if ($tender->proposals->count() > 0)
                                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                                        <div class="p-6 border-b border-gray-200">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center">
                                                    <div
                                                        class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center ml-3">
                                                        <i class="fas fa-file-alt text-green-600"></i>
                                                    </div>
                                                    <h2 class="text-xl font-bold text-gray-800">العروض المقدمة</h2>
                                                </div>
                                                <span
                                                    class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                                                    {{ $tender->proposals_count }} عرض
                                                </span>
                                            </div>
                                        </div>

                                        <div class="divide-y divide-gray-200">
                                            @foreach ($tender->proposals as $proposal)
                                                <div class="p-6 hover:bg-gray-50 transition-colors">
                                                    <div
                                                        class="flex flex-col md:flex-row md:items-center justify-between mb-4">
                                                        <div class="flex items-center mb-3 md:mb-0">
                                                            <div
                                                                class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold ml-3">
                                                                {{ substr($proposal->consultant->name, 0, 1) }}
                                                            </div>
                                                            <div>
                                                                <h3 class="font-semibold text-gray-800">
                                                                    {{ $proposal->consultant->name }}</h3>
                                                                <p class="text-sm text-gray-500">
                                                                    {{ $proposal->created_at->format('Y-m-d H:i') }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="flex items-center space-x-4 space-x-reverse">
                                                            <span
                                                                class="text-xl font-bold text-green-600">{{ $proposal->formatted_price }}</span>

                                                            @if ($proposal->status === 'pending')
                                                                <span
                                                                    class="px-3 py-1 text-sm font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                                                    في الانتظار
                                                                </span>
                                                            @elseif($proposal->status === 'accepted')
                                                                <span
                                                                    class="px-3 py-1 text-sm font-medium bg-green-100 text-green-800 rounded-full">
                                                                    مقبول
                                                                </span>
                                                            @elseif($proposal->status === 'rejected')
                                                                <span
                                                                    class="px-3 py-1 text-sm font-medium bg-red-100 text-red-800 rounded-full">
                                                                    مرفوض
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <p class="text-gray-700 mb-4 line-clamp-2">
                                                        {{ Str::limit($proposal->proposal_text, 150) }}</p>

                                                    <div class="flex flex-wrap gap-3">
                                                        <a href="{{ route('proposals.client-view', $proposal->id) }}"
                                                            class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                                            <i class="fas fa-eye ml-2"></i>
                                                            عرض التفاصيل
                                                        </a>

                                                        @if ($tender->status === 'open')
                                                            <form action="{{ route('proposals.accept', $proposal->id) }}"
                                                                method="POST" class="inline">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm transition-colors"
                                                                    onclick="return confirm('هل أنت متأكد من قبول هذا العرض؟')">
                                                                    <i class="fas fa-check ml-2"></i>
                                                                    قبول العرض
                                                                </button>
                                                            </form>

                                                            <form action="{{ route('proposals.reject', $proposal->id) }}"
                                                                method="POST" class="inline">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm transition-colors"
                                                                    onclick="return confirm('هل أنت متأكد من رفض هذا العرض؟')">
                                                                    <i class="fas fa-times ml-2"></i>
                                                                    رفض العرض
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                                        <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                                        <h3 class="text-lg font-medium text-gray-700 mb-2">لا توجد عروض</h3>
                                        <p class="text-gray-500">لم يتم تقديم أي عروض لهذه المناقصة بعد</p>
                                    </div>
                                @endif
                            @elseif(auth()->user()->isConsultant())
                                <!-- Consultant View -->
                                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                                    <div class="flex items-center mb-6">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center ml-3">
                                            <i class="fas fa-file-contract text-blue-600"></i>
                                        </div>
                                        <h2 class="text-xl font-bold text-gray-800">عرضك</h2>
                                    </div>

                                    @if ($userProposal)
                                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                                            <div class="flex flex-col md:flex-row md:items-center justify-between mb-4">
                                                <div>
                                                    <h3 class="text-lg font-semibold text-gray-800">عرضك المقدم</h3>
                                                    <p class="text-sm text-gray-600">تم التقديم في
                                                        {{ $userProposal->created_at->format('Y-m-d H:i') }}</p>
                                                </div>

                                                <div class="flex items-center space-x-4 space-x-reverse mt-3 md:mt-0">
                                                    <span
                                                        class="text-xl font-bold text-green-600">{{ $userProposal->formatted_price }}</span>

                                                    @if ($userProposal->status === 'pending')
                                                        <span
                                                            class="px-3 py-1 text-sm font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                                            في الانتظار
                                                        </span>
                                                    @elseif($userProposal->status === 'accepted')
                                                        <span
                                                            class="px-3 py-1 text-sm font-medium bg-green-100 text-green-800 rounded-full">
                                                            مقبول
                                                        </span>
                                                    @elseif($userProposal->status === 'rejected')
                                                        <span
                                                            class="px-3 py-1 text-sm font-medium bg-red-100 text-red-800 rounded-full">
                                                            مرفوض
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <p class="text-gray-700 mb-4">
                                                {{ Str::limit($userProposal->proposal_text, 200) }}</p>

                                            <div class="flex flex-wrap gap-3">
                                                <a href="{{ route('proposals.show', $userProposal->id) }}"
                                                    class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                                    <i class="fas fa-eye ml-2"></i>
                                                    عرض التفاصيل
                                                </a>

                                                @if ($tender->status === 'open')
                                                    <a href="{{ route('proposals.edit', $userProposal->id) }}"
                                                        class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                                        <i class="fas fa-edit ml-2"></i>
                                                        تعديل العرض
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
                                            <i class="fas fa-exclamation-triangle text-yellow-500 text-2xl mb-3"></i>
                                            <h3 class="text-lg font-semibold text-gray-800 mb-2">لم تقدم عرضاً بعد</h3>
                                            <p class="text-gray-600 mb-4">يمكنك تقديم عرض لهذه المناقصة قبل انتهاء الموعد
                                                النهائي</p>

                                            @if ($tender->status === 'open')
                                                <a href="{{ route('proposals.create', $tender->id) }}"
                                                    class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-lg font-medium transition-colors">
                                                    <i class="fas fa-paper-plane ml-2"></i>
                                                    قدم عرض الآن
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @else
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                                <i class="fas fa-lock text-4xl text-gray-300 mb-4"></i>
                                <h3 class="text-lg font-medium text-gray-700 mb-2">يجب تسجيل الدخول</h3>
                                <p class="text-gray-500 mb-4">يجب تسجيل الدخول لعرض العروض المقدمة</p>
                                <a href="{{ route('login') }}"
                                    class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition-colors">
                                    <i class="fas fa-sign-in-alt ml-2"></i>
                                    تسجيل الدخول
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Right Column - Enhanced Sidebar -->
            <div class="lg:w-1/3">
                <div class="sticky-sidebar space-y-8">
                    <!-- Enhanced Tender Details Card -->
                    <div class="sidebar-card hover-lift">
                        <div class="flex items-center mb-6">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center ml-4">
                                <i class="fas fa-info-circle text-white text-xl"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">تفاصيل المناقصة</h2>
                        </div>

                        <div class="space-y-4">
                            <!-- Deadline -->
                            <div class="info-item bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100">
                                <div class="info-item-icon bg-blue-500 text-white">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600 font-medium">آخر موعد للتقديم</p>
                                    <p class="text-lg font-bold text-blue-600">{{ $tender->formatted_deadline }}</p>
                                </div>
                            </div>

                            <!-- Budget -->
                            @if ($tender->budget)
                                <div
                                    class="info-item bg-gradient-to-r from-green-50 to-emerald-50 border border-green-100">
                                    <div class="info-item-icon bg-green-500 text-white">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-600 font-medium">الميزانية المتوقعة</p>
                                        <p class="text-lg font-bold text-green-600">{{ $tender->formatted_budget }}</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Proposals Count -->
                            <div class="info-item bg-gradient-to-r from-purple-50 to-violet-50 border border-purple-100">
                                <div class="info-item-icon bg-purple-500 text-white">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600 font-medium">عدد العروض المقدمة</p>
                                    <p class="text-lg font-bold text-purple-600">{{ $tender->proposals_count }} عرض</p>
                                </div>
                            </div>

                            <!-- Days Remaining -->
                            @if ($tender->days_remaining !== null)
                                <div class="info-item bg-gradient-to-r from-orange-50 to-red-50 border border-orange-100">
                                    <div class="info-item-icon bg-orange-500 text-white">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-600 font-medium">الأيام المتبقية</p>
                                        <p class="text-lg font-bold text-orange-600">{{ $tender->days_remaining }} يوم</p>
                                    </div>
                                </div>

                                <!-- Enhanced Progress Bar -->
                                <div class="mt-4 p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl">
                                    <div class="flex justify-between text-sm text-gray-600 mb-3">
                                        <span class="font-medium">وقت متبقي</span>
                                        <span class="font-bold">{{ $tender->days_remaining }} يوم</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-fill bg-gradient-to-r from-orange-500 to-red-500"
                                            style="width: {{ min(100, max(5, 100 - ($tender->days_remaining / 30) * 100)) }}%">
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2 text-center">نسبة الوقت المنقضي</p>
                                </div>
                            @endif

                            <!-- Created Date -->
                            <div class="info-item bg-gradient-to-r from-indigo-50 to-blue-50 border border-indigo-100">
                                <div class="info-item-icon bg-indigo-500 text-white">
                                    <i class="fas fa-calendar-plus"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600 font-medium">تاريخ إنشاء المناقصة</p>
                                    <p class="text-lg font-bold text-indigo-600">
                                        {{ $tender->created_at->format('Y-m-d') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Client Info Card -->
                    <div class="sidebar-card hover-lift">
                        <div class="flex items-center mb-6">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center ml-4">
                                <i class="fas fa-user text-white text-xl"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">معلومات العميل</h2>
                        </div>

                        <div class="space-y-4">
                            <div class="info-item bg-gradient-to-r from-indigo-50 to-purple-50 border border-indigo-100">
                                <div class="info-item-icon bg-indigo-500 text-white">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600 font-medium">اسم العميل</p>
                                    <p class="text-lg font-bold text-indigo-600">{{ $tender->client->name }}</p>
                                </div>
                            </div>

                            @if ($tender->client->phone)
                                <div
                                    class="info-item bg-gradient-to-r from-green-50 to-emerald-50 border border-green-100">
                                    <div class="info-item-icon bg-green-500 text-white">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-600 font-medium">رقم الهاتف</p>
                                        <p class="text-lg font-bold text-green-600">{{ $tender->client->phone }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($tender->client->city)
                                <div class="info-item bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-100">
                                    <div class="info-item-icon bg-blue-500 text-white">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-600 font-medium">المدينة</p>
                                        <p class="text-lg font-bold text-blue-600">{{ $tender->client->city }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Enhanced Actions Card -->
                    <div class="sidebar-card hover-lift">
                        <div class="flex items-center mb-6">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center ml-4">
                                <i class="fas fa-bolt text-white text-xl"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">الإجراءات السريعة</h2>
                        </div>

                        <div class="space-y-4">
                            @auth
                                @if (auth()->user()->isConsultant() && $tender->status === 'open')
                                    @if ($userProposal)
                                        <a href="{{ route('proposals.edit', $userProposal->id) }}"
                                            class="w-full flex items-center justify-center bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-4 rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg">
                                            <i class="fas fa-edit ml-3 text-lg"></i>
                                            تعديل العرض
                                        </a>
                                        <a href="{{ route('proposals.show', $userProposal->id) }}"
                                            class="w-full flex items-center justify-center bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white px-6 py-4 rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg">
                                            <i class="fas fa-eye ml-3 text-lg"></i>
                                            عرض تفاصيل عرضي
                                        </a>
                                    @else
                                        <a href="{{ route('proposals.create', $tender->id) }}"
                                            class="w-full flex items-center justify-center bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-6 py-4 rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg">
                                            <i class="fas fa-paper-plane ml-3 text-lg"></i>
                                            قدم عرض الآن
                                        </a>
                                    @endif
                                @endif

                                @if (auth()->user()->isClient() && auth()->id() == $tender->client_id)
                                    <a href="{{ route('tenders.edit', $tender->id) }}"
                                        class="w-full flex items-center justify-center bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-4 rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg">
                                        <i class="fas fa-edit ml-3 text-lg"></i>
                                        تعديل المناقصة
                                    </a>

                                    @if ($tender->proposals->count() > 0)
                                        <a href="{{ route('tenders.compare-proposals', $tender->id) }}"
                                            class="w-full flex items-center justify-center bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white px-6 py-4 rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg">
                                            <i class="fas fa-chart-bar ml-3 text-lg"></i>
                                            مقارنة العروض
                                        </a>
                                    @endif

                                    @if ($tender->status === 'open')
                                        <form action="{{ route('tenders.close', $tender->id) }}" method="POST"
                                            class="w-full">
                                            @csrf
                                            <button type="submit"
                                                class="w-full flex items-center justify-center bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-6 py-4 rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg"
                                                onclick="return confirm('هل أنت متأكد من إغلاق المناقصة؟')">
                                                <i class="fas fa-lock ml-3 text-lg"></i>
                                                إغلاق المناقصة
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            @else
                                <a href="{{ route('login') }}"
                                    class="w-full flex items-center justify-center bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-4 rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg">
                                    <i class="fas fa-sign-in-alt ml-3 text-lg"></i>
                                    سجل دخول للمشاركة
                                </a>
                            @endauth

                            <!-- Enhanced Share Button -->
                            <button onclick="shareTender()"
                                class="w-full flex items-center justify-center bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white px-6 py-4 rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg">
                                <i class="fas fa-share-alt ml-3 text-lg"></i>
                                مشاركة المناقصة
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-full">
            <button onclick="closeImageModal()"
                class="absolute top-4 left-4 text-white text-2xl hover:text-gray-300 z-10">
                <i class="fas fa-times"></i>
            </button>
            <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
        </div>
    </div>

    <!-- Gallery Modal -->
    <div id="galleryModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
        <div class="relative max-w-6xl max-h-full w-full">
            <button onclick="closeGalleryModal()"
                class="absolute top-4 left-4 text-white text-2xl hover:text-gray-300 z-10">
                <i class="fas fa-times"></i>
            </button>

            <div class="flex flex-col h-full">
                <div class="flex-1 flex items-center justify-center mb-4">
                    <img id="galleryMainImage" src="" alt=""
                        class="max-w-full max-h-96 object-contain rounded-lg">
                </div>

                <div class="h-24 overflow-x-auto">
                    <div class="flex space-x-2 space-x-reverse">
                        @if ($tender->design->images)
                            @foreach ($tender->design->images as $index => $image)
                                <img src="{{ $image }}" alt="صورة {{ $index + 1 }}"
                                    class="h-20 w-20 object-cover rounded-lg cursor-pointer hover:opacity-80 transition-opacity"
                                    onclick="changeGalleryImage('{{ $image }}')">
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab functionality
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all tabs and contents
                document.querySelectorAll('.tab-button').forEach(tab => {
                    tab.classList.remove('tab-active');
                });
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.remove('active');
                    content.classList.add('hidden');
                });

                // Add active class to clicked tab
                this.classList.add('tab-active');

                // Show corresponding content
                const tabId = this.id.replace('tab-', 'content-');
                document.getElementById(tabId).classList.remove('hidden');
                document.getElementById(tabId).classList.add('active');

                // Add fade-in animation
                document.getElementById(tabId).classList.add('animate-fade-in');
                setTimeout(() => {
                    document.getElementById(tabId).classList.remove('animate-fade-in');
                }, 500);
            });
        });

        // Image modal functionality
        function openImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Gallery modal functionality
        function openGalleryModal() {
            const images = @json($tender->design->images ?? []);
            if (images.length > 0) {
                document.getElementById('galleryMainImage').src = images[0];
                document.getElementById('galleryModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeGalleryModal() {
            document.getElementById('galleryModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function changeGalleryImage(imageSrc) {
            document.getElementById('galleryMainImage').src = imageSrc;
        }

        // Items view toggle
        function toggleItemsView() {
            const tableView = document.getElementById('items-table-view');
            const cardView = document.getElementById('items-card-view');

            if (tableView.classList.contains('hidden')) {
                tableView.classList.remove('hidden');
                cardView.classList.add('hidden');
            } else {
                tableView.classList.add('hidden');
                cardView.classList.remove('hidden');
            }
        }

        // Export items to PDF (placeholder function)
        function exportItemsToPDF() {
            alert('سيتم تصدير بنود المناقصة إلى PDF. هذه الميزة قيد التطوير.');
            // In a real implementation, this would make an API call to generate a PDF
        }

        // Share tender functionality
        function shareTender() {
            if (navigator.share) {
                navigator.share({
                        title: '{{ $tender->title }}',
                        text: 'اطلع على هذه المناقصة في منصة انشاءات',
                        url: window.location.href,
                    })
                    .then(() => console.log('تمت المشاركة بنجاح'))
                    .catch((error) => console.log('خطأ في المشاركة:', error));
            } else {
                // Fallback for browsers that don't support the Web Share API
                navigator.clipboard.writeText(window.location.href)
                    .then(() => alert('تم نسخ رابط المناقصة إلى الحافظة'))
                    .catch(err => alert('تعذر نسخ الرابط: ' + err));
            }
        }

        // Close modals with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
                closeGalleryModal();
            }
        });

        // Close modals when clicking outside
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        document.getElementById('galleryModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeGalleryModal();
            }
        });
    </script>
@endsection
