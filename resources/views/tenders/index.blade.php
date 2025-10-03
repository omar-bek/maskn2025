@extends('layouts.app')

@section('title', 'المناقصات - انشاءات')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-teal-600 to-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="text-center">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">المناقصات المتاحة</h1>
                    <p class="text-xl md:text-2xl text-teal-100 mb-8">اكتشف فرص العمل المناسبة لك وقدم عروضك</p>
                    @auth
                        @if (auth()->user()->isClient())
                            <a href="{{ route('tenders.create') }}"
                                class="inline-flex items-center bg-white text-teal-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <i class="fas fa-plus ml-3"></i>
                                إنشاء مناقصة جديدة
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">

            <!-- Advanced Filters -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border border-gray-100">
                <div class="flex items-center mb-6">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-teal-500 to-blue-500 rounded-xl flex items-center justify-center ml-4">
                        <i class="fas fa-filter text-white text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">البحث والتصفية</h3>
                        <p class="text-gray-600">ابحث عن المناقصات المناسبة لك</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">البحث في المناقصات</label>
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="ابحث بالعنوان أو الوصف..."
                                class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 pr-12 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">حالة المناقصة</label>
                        <select id="statusFilter"
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200">
                            <option value="">جميع الحالات</option>
                            <option value="open">مفتوحة</option>
                            <option value="closed">مغلقة</option>
                            <option value="awarded">ممنوحة</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">الموقع</label>
                        <div class="relative">
                            <input type="text" id="locationFilter" placeholder="ابحث بالموقع..."
                                class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 pr-12 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-end">
                        <button onclick="applyFilters()"
                            class="w-full bg-gradient-to-r from-teal-600 to-blue-600 hover:from-teal-700 hover:to-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-search ml-2"></i>
                            تطبيق البحث
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tenders Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="tendersGrid">
                @forelse($tenders as $tender)
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl overflow-hidden tender-card transform hover:scale-105 transition-all duration-300 border border-gray-100"
                        data-title="{{ $tender->title }}" data-status="{{ $tender->status }}"
                        data-location="{{ $tender->location }}">
                        <!-- Tender Image -->
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ $tender->design->main_image_url }}" alt="{{ $tender->title }}"
                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>

                            <!-- Status Badge -->
                            <div class="absolute top-4 left-4">
                                @if ($tender->status === 'open')
                                    <span
                                        class="bg-gradient-to-r from-green-500 to-green-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                                        <i class="fas fa-circle ml-2 text-xs"></i>
                                        مفتوحة
                                    </span>
                                @elseif($tender->status === 'closed')
                                    <span
                                        class="bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                                        <i class="fas fa-times-circle ml-2 text-xs"></i>
                                        مغلقة
                                    </span>
                                @elseif($tender->status === 'awarded')
                                    <span
                                        class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                                        <i class="fas fa-trophy ml-2 text-xs"></i>
                                        ممنوحة
                                    </span>
                                @endif
                            </div>

                            <!-- Proposals Count -->
                            <div class="absolute top-4 right-4">
                                <div
                                    class="bg-white/95 backdrop-blur-sm text-gray-800 px-3 py-2 rounded-xl text-sm font-semibold shadow-lg">
                                    <i class="fas fa-file-alt ml-2 text-teal-600"></i>
                                    {{ $tender->proposals_count }} عرض
                                </div>
                            </div>

                            <!-- Days Remaining -->
                            @if ($tender->days_remaining !== null && $tender->status === 'open')
                                <div class="absolute bottom-4 left-4">
                                    <div
                                        class="bg-white/95 backdrop-blur-sm text-gray-800 px-3 py-2 rounded-xl text-sm font-semibold shadow-lg">
                                        <i
                                            class="fas fa-clock ml-2 text-{{ $tender->days_remaining > 7 ? 'green' : ($tender->days_remaining > 3 ? 'yellow' : 'red') }}-600"></i>
                                        {{ $tender->days_remaining }} يوم متبقي
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Tender Content -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-1">{{ $tender->title }}</h3>
                            <p class="text-gray-600 text-sm mb-6 line-clamp-2 leading-relaxed">
                                {{ Str::limit($tender->description, 120) }}</p>

                            <!-- Tender Details -->
                            <div class="space-y-3 mb-6">
                                <div class="flex items-center justify-between py-2 px-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-user text-teal-600 ml-2"></i>
                                        <span class="text-sm text-gray-600">العميل</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-900">{{ $tender->client->name }}</span>
                                </div>

                                <div class="flex items-center justify-between py-2 px-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-map-marker-alt text-blue-600 ml-2"></i>
                                        <span class="text-sm text-gray-600">الموقع</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-900">{{ $tender->location }}</span>
                                </div>

                                @if ($tender->budget)
                                    <div class="flex items-center justify-between py-2 px-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-money-bill-wave text-green-600 ml-2"></i>
                                            <span class="text-sm text-gray-600">الميزانية</span>
                                        </div>
                                        <span
                                            class="text-sm font-semibold text-green-600">{{ $tender->formatted_budget }}</span>
                                    </div>
                                @endif

                                <div class="flex items-center justify-between py-2 px-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-alt text-purple-600 ml-2"></i>
                                        <span class="text-sm text-gray-600">آخر موعد</span>
                                    </div>
                                    <span
                                        class="text-sm font-semibold text-gray-900">{{ $tender->formatted_deadline }}</span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-3">
                                <a href="{{ route('tenders.show', $tender->id) }}"
                                    class="flex-1 bg-gradient-to-r from-teal-600 to-blue-600 hover:from-teal-700 hover:to-blue-700 text-white text-center py-3 px-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                    <i class="fas fa-eye ml-2"></i>
                                    عرض التفاصيل
                                </a>
                                @auth
                                    @if (auth()->user()->isConsultant() && $tender->status === 'open')
                                        <a href="{{ route('proposals.create', $tender->id) }}"
                                            class="flex-1 bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 text-white text-center py-3 px-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                            <i class="fas fa-paper-plane ml-2"></i>
                                            قدم عرض
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="bg-white rounded-2xl shadow-xl p-12 text-center border border-gray-100">
                            <div
                                class="w-24 h-24 bg-gradient-to-r from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-inbox text-4xl text-gray-400"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">لا توجد مناقصات متاحة</h3>
                            <p class="text-gray-600 text-lg mb-8">لم يتم العثور على مناقصات تطابق معايير البحث المحددة</p>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <button onclick="clearFilters()"
                                    class="bg-gradient-to-r from-teal-600 to-blue-600 hover:from-teal-700 hover:to-blue-700 text-white px-8 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                    <i class="fas fa-refresh ml-2"></i>
                                    مسح الفلاتر
                                </button>
                                @auth
                                    @if (auth()->user()->isClient())
                                        <a href="{{ route('tenders.create') }}"
                                            class="bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 text-white px-8 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                            <i class="fas fa-plus ml-2"></i>
                                            إنشاء مناقصة جديدة
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($tenders->hasPages())
                <div class="mt-12 flex justify-center">
                    <div class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100">
                        {{ $tenders->links() }}
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
                const locationFilter = document.getElementById('locationFilter').value.toLowerCase();

                const cards = document.querySelectorAll('.tender-card');
                let visibleCount = 0;

                cards.forEach(card => {
                    const title = card.dataset.title.toLowerCase();
                    const status = card.dataset.status;
                    const location = card.dataset.location.toLowerCase();

                    const matchesSearch = title.includes(searchTerm);
                    const matchesStatus = !statusFilter || status === statusFilter;
                    const matchesLocation = location.includes(locationFilter);

                    if (matchesSearch && matchesStatus && matchesLocation) {
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
                document.getElementById('locationFilter').value = '';
                applyFilters();
            };

            // Real-time search with debounce
            let searchTimeout;
            document.getElementById('searchInput').addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(applyFilters, 300);
            });

            document.getElementById('statusFilter').addEventListener('change', applyFilters);
            document.getElementById('locationFilter').addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(applyFilters, 300);
            });

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

        .tender-card {
            animation: fadeIn 0.5s ease-out;
        }

        .tender-card:hover {
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
            background: linear-gradient(45deg, #14b8a6, #3b82f6);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #0d9488, #2563eb);
        }

        /* Responsive improvements */
        @media (max-width: 768px) {
            .tender-card {
                margin-bottom: 1rem;
            }

            .tender-card:hover {
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
            background: linear-gradient(45deg, #14b8a6, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
@endsection
