@extends('layouts.app')

@section('title', 'عروضي المقدمة - انشاءات')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-green-600 to-teal-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="text-center">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">عروضي المقدمة</h1>
                    <p class="text-xl md:text-2xl text-green-100 mb-8">تتبع جميع العروض التي قدمتها على المناقصات</p>
                    <a href="{{ route('tenders.index') }}"
                        class="inline-flex items-center bg-white text-green-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-search ml-3"></i>
                        تصفح المناقصات الجديدة
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">

            <!-- Advanced Filters -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border border-gray-100">
                <div class="flex items-center mb-6">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-500 rounded-xl flex items-center justify-center ml-4">
                        <i class="fas fa-filter text-white text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">البحث والتصفية</h3>
                        <p class="text-gray-600">ابحث في عروضك وفلترها حسب الحالة</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">البحث في العروض</label>
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="ابحث بالعنوان أو الوصف..."
                                class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 pr-12 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">حالة العرض</label>
                        <select id="statusFilter"
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                            <option value="">جميع الحالات</option>
                            <option value="pending">في الانتظار</option>
                            <option value="accepted">مقبول</option>
                            <option value="rejected">مرفوض</option>
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button onclick="applyFilters()"
                            class="w-full bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-search ml-2"></i>
                            تطبيق البحث
                        </button>
                    </div>
                </div>
            </div>

            <!-- Proposals Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="proposalsGrid">
                @forelse($proposals as $proposal)
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl overflow-hidden proposal-card transform hover:scale-105 transition-all duration-300 border border-gray-100"
                        data-title="{{ $proposal->tender->title }}" data-status="{{ $proposal->status }}">
                        <!-- Tender Image -->
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ $proposal->tender->design->main_image_url }}" alt="{{ $proposal->tender->title }}"
                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>

                            <!-- Status Badge -->
                            <div class="absolute top-4 left-4">
                                @if ($proposal->status === 'pending')
                                    <span
                                        class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                                        <i class="fas fa-clock ml-2 text-xs"></i>
                                        في الانتظار
                                    </span>
                                @elseif($proposal->status === 'accepted')
                                    <span
                                        class="bg-gradient-to-r from-green-500 to-green-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                                        <i class="fas fa-check-circle ml-2 text-xs"></i>
                                        مقبول
                                    </span>
                                @elseif($proposal->status === 'rejected')
                                    <span
                                        class="bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                                        <i class="fas fa-times-circle ml-2 text-xs"></i>
                                        مرفوض
                                    </span>
                                @endif
                            </div>

                            <!-- Date -->
                            <div class="absolute top-4 right-4">
                                <div
                                    class="bg-white/95 backdrop-blur-sm text-gray-800 px-3 py-2 rounded-xl text-sm font-semibold shadow-lg">
                                    <i class="fas fa-calendar ml-2 text-green-600"></i>
                                    {{ $proposal->created_at->format('Y-m-d') }}
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="absolute bottom-4 left-4">
                                <div
                                    class="bg-white/95 backdrop-blur-sm text-gray-800 px-3 py-2 rounded-xl text-sm font-semibold shadow-lg">
                                    <i class="fas fa-money-bill-wave ml-2 text-green-600"></i>
                                    {{ $proposal->formatted_price }}
                                </div>
                            </div>
                        </div>

                        <!-- Proposal Content -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-1">{{ $proposal->tender->title }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-6 line-clamp-2 leading-relaxed">
                                {{ Str::limit($proposal->proposal_text, 120) }}</p>

                            <!-- Proposal Details -->
                            <div class="space-y-3 mb-6">
                                <div class="flex items-center justify-between py-2 px-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-user text-teal-600 ml-2"></i>
                                        <span class="text-sm text-gray-600">العميل</span>
                                    </div>
                                    <span
                                        class="text-sm font-semibold text-gray-900">{{ $proposal->tender->client->name }}</span>
                                </div>

                                <div class="flex items-center justify-between py-2 px-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-map-marker-alt text-blue-600 ml-2"></i>
                                        <span class="text-sm text-gray-600">الموقع</span>
                                    </div>
                                    <span
                                        class="text-sm font-semibold text-gray-900">{{ $proposal->tender->location }}</span>
                                </div>

                                @if ($proposal->duration_months)
                                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-alt text-purple-600 ml-2"></i>
                                            <span class="text-sm text-gray-600">مدة التنفيذ</span>
                                        </div>
                                        <span
                                            class="text-sm font-semibold text-gray-900">{{ $proposal->formatted_duration }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-3">
                                <a href="{{ route('proposals.show', $proposal->id) }}"
                                    class="flex-1 bg-gradient-to-r from-teal-600 to-blue-600 hover:from-teal-700 hover:to-blue-700 text-white text-center py-3 px-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                    <i class="fas fa-eye ml-2"></i>
                                    عرض التفاصيل
                                </a>
                                @if ($proposal->tender->isOpen())
                                    <a href="{{ route('proposals.edit', $proposal->id) }}"
                                        class="flex-1 bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 text-white text-center py-3 px-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                        <i class="fas fa-edit ml-2"></i>
                                        تعديل
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="bg-white rounded-2xl shadow-xl p-12 text-center border border-gray-100">
                            <div
                                class="w-24 h-24 bg-gradient-to-r from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-file-alt text-4xl text-gray-400"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">لم تقدم أي عروض بعد</h3>
                            <p class="text-gray-600 text-lg mb-8">ابدأ رحلتك في تقديم العروض على المناقصات المتاحة</p>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <button onclick="clearFilters()"
                                    class="bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 text-white px-8 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                    <i class="fas fa-refresh ml-2"></i>
                                    مسح الفلاتر
                                </button>
                                <a href="{{ route('tenders.index') }}"
                                    class="bg-gradient-to-r from-teal-600 to-blue-600 hover:from-teal-700 hover:to-blue-700 text-white px-8 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                    <i class="fas fa-search ml-2"></i>
                                    تصفح المناقصات
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($proposals->hasPages())
                <div class="mt-12 flex justify-center">
                    <div class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100">
                        {{ $proposals->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter functionality
            window.applyFilters = function() {
                const searchTerm = document.getElementById('searchInput').value.toLowerCase();
                const statusFilter = document.getElementById('statusFilter').value;

                const cards = document.querySelectorAll('.proposal-card');
                let visibleCount = 0;

                cards.forEach(card => {
                    const title = card.dataset.title.toLowerCase();
                    const status = card.dataset.status;

                    const matchesSearch = title.includes(searchTerm);
                    const matchesStatus = !statusFilter || status === statusFilter;

                    if (matchesSearch && matchesStatus) {
                        card.style.display = 'block';
                        card.style.animation = 'fadeIn 0.3s ease-in-out';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Show/hide empty state
                const emptyState = document.querySelector('.col-span-full');
                if (emptyState) {
                    if (visibleCount === 0) {
                        emptyState.style.display = 'block';
                    } else {
                        emptyState.style.display = 'none';
                    }
                }
            };

            // Clear filters function
            window.clearFilters = function() {
                document.getElementById('searchInput').value = '';
                document.getElementById('statusFilter').value = '';
                applyFilters();
            };

            // Real-time search with debounce
            let searchTimeout;
            document.getElementById('searchInput').addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(applyFilters, 300);
            });

            document.getElementById('statusFilter').addEventListener('change', applyFilters);

            // Initialize filters
            applyFilters();
        });
    </script>

    <style>
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

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

        .proposal-card {
            animation: fadeIn 0.5s ease-out;
        }

        .proposal-card:hover {
            transform: translateY(-8px) scale(1.02);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #10b981, #14b8a6);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #059669, #0d9488);
        }

        /* Responsive improvements */
        @media (max-width: 768px) {
            .proposal-card {
                margin-bottom: 1rem;
            }

            .proposal-card:hover {
                transform: none;
            }
        }

        /* Loading animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, .3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(45deg, #10b981, #14b8a6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
@endsection
