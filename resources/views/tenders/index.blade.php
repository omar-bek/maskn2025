@extends('layouts.app')

@section('title', 'المناقصات - انشاءات')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        <!-- Enhanced Hero Section -->
        <div class="relative bg-gradient-to-br from-teal-600 via-blue-700 to-indigo-800 text-white overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0"
                    style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><defs><pattern id=\"grid\" width=\"10\" height=\"10\" patternUnits=\"userSpaceOnUse\"><path d=\"M 10 0 L 0 0 0 10\" fill=\"none\" stroke=\"white\" stroke-width=\"0.5\"/></pattern></defs><rect width=\"100\" height=\"100\" fill=\"url(%23grid)\"/></svg>');">
                </div>
            </div>

            <!-- Floating Elements -->
            <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full animate-pulse"></div>
            <div class="absolute top-32 right-20 w-16 h-16 bg-white/5 rounded-full animate-bounce"></div>
            <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-white/10 rounded-full animate-pulse"
                style="animation-delay: 1s;"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
                <div class="text-center">
                    <div
                        class="inline-flex items-center bg-white/20 backdrop-blur-sm rounded-full px-6 py-3 mb-6 border border-white/30">
                        <i class="fas fa-file-contract text-2xl ml-3"></i>
                        <span class="text-lg font-semibold">منصة المناقصات المتطورة</span>
                    </div>

                    <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                        <span class="bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
                            المناقصات المتاحة
                        </span>
                    </h1>

                    <p class="text-xl md:text-2xl text-blue-100 mb-10 max-w-3xl mx-auto leading-relaxed">
                        اكتشف فرص العمل المناسبة لك وقدم عروضك المتميزة في بيئة تنافسية عادلة
                    </p>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                        <div
                            class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300">
                            <div class="text-3xl font-bold mb-2">{{ $tenders->total() ?? 0 }}</div>
                            <div class="text-sm text-blue-100">مناقصة نشطة</div>
                        </div>
                        <div
                            class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300">
                            <div class="text-3xl font-bold mb-2">24/7</div>
                            <div class="text-sm text-blue-100">متاح دائماً</div>
                        </div>
                        <div
                            class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300">
                            <div class="text-3xl font-bold mb-2">100%</div>
                            <div class="text-sm text-blue-100">شفافية</div>
                        </div>
                        <div
                            class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300">
                            <div class="text-3xl font-bold mb-2">أمان</div>
                            <div class="text-sm text-blue-100">مضمون</div>
                        </div>
                    </div>

                    @auth
                        @if (auth()->user()->isClient())
                            <a href="{{ route('tenders.create') }}"
                                class="inline-flex items-center bg-white text-teal-600 px-10 py-5 rounded-2xl font-bold text-xl hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 shadow-2xl border-2 border-white/20 group">
                                <i
                                    class="fas fa-plus ml-4 text-2xl group-hover:rotate-90 transition-transform duration-300"></i>
                                إنشاء مناقصة جديدة
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">

            <!-- Enhanced Advanced Filters -->
            <div
                class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl p-8 mb-10 border border-gray-200/50 relative overflow-hidden">
                <!-- Background Pattern -->
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-teal-100 to-transparent rounded-full opacity-50">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-blue-100 to-transparent rounded-full opacity-50">
                </div>

                <div class="relative z-10">
                    <div class="flex items-center mb-8">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-teal-600 to-blue-700 rounded-2xl flex items-center justify-center ml-4 shadow-lg">
                            <i class="fas fa-filter text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">البحث والتصفية المتقدمة</h3>
                            <p class="text-gray-600">ابحث عن المناقصات المناسبة لك بسهولة وسرعة</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="space-y-3">
                            <label class="block text-sm font-bold text-gray-800 flex items-center">
                                <i class="fas fa-search text-teal-600 ml-2"></i>
                                البحث في المناقصات
                            </label>
                            <div class="relative group">
                                <input type="text" id="searchInput" placeholder="ابحث بالعنوان أو الوصف..."
                                    class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 pr-14 focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 transition-all duration-300 bg-gray-50/50 backdrop-blur-sm group-hover:bg-white group-hover:shadow-lg">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                    <i
                                        class="fas fa-search text-gray-400 group-hover:text-teal-600 transition-colors duration-300"></i>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="block text-sm font-bold text-gray-800 flex items-center">
                                <i class="fas fa-flag text-blue-600 ml-2"></i>
                                حالة المناقصة
                            </label>
                            <div class="relative group">
                                <select id="statusFilter"
                                    class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-gray-50/50 backdrop-blur-sm group-hover:bg-white group-hover:shadow-lg appearance-none cursor-pointer">
                                    <option value="">جميع الحالات</option>
                                    <option value="open">مفتوحة</option>
                                    <option value="closed">مغلقة</option>
                                    <option value="awarded">ممنوحة</option>
                                </select>
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="block text-sm font-bold text-gray-800 flex items-center">
                                <i class="fas fa-map-marker-alt text-green-600 ml-2"></i>
                                الموقع
                            </label>
                            <div class="relative group">
                                <input type="text" id="locationFilter" placeholder="ابحث بالموقع..."
                                    class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 pr-14 focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 bg-gray-50/50 backdrop-blur-sm group-hover:bg-white group-hover:shadow-lg">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                    <i
                                        class="fas fa-map-marker-alt text-gray-400 group-hover:text-green-600 transition-colors duration-300"></i>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-end">
                            <button onclick="applyFilters()"
                                class="w-full bg-gradient-to-r from-teal-600 to-blue-700 hover:from-teal-700 hover:to-blue-800 text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl border-2 border-white/20 group">
                                <i
                                    class="fas fa-search ml-3 text-xl group-hover:scale-110 transition-transform duration-300"></i>
                                تطبيق البحث
                            </button>
                        </div>
                    </div>

                    <!-- Quick Filter Tags -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-tags text-gray-600 ml-2"></i>
                            <span class="text-sm font-semibold text-gray-700">فلتر سريع:</span>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <button onclick="setQuickFilter('open')"
                                class="quick-filter-btn bg-green-100 text-green-800 hover:bg-green-200 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300">
                                <i class="fas fa-circle ml-2 text-xs"></i>
                                مفتوحة
                            </button>
                            <button onclick="setQuickFilter('closed')"
                                class="quick-filter-btn bg-red-100 text-red-800 hover:bg-red-200 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300">
                                <i class="fas fa-lock ml-2 text-xs"></i>
                                مغلقة
                            </button>
                            <button onclick="setQuickFilter('awarded')"
                                class="quick-filter-btn bg-blue-100 text-blue-800 hover:bg-blue-200 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300">
                                <i class="fas fa-trophy ml-2 text-xs"></i>
                                ممنوحة
                            </button>
                            <button onclick="clearFilters()"
                                class="quick-filter-btn bg-gray-100 text-gray-800 hover:bg-gray-200 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300">
                                <i class="fas fa-times ml-2 text-xs"></i>
                                مسح الكل
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Tenders Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="tendersGrid">
                @forelse($tenders as $tender)
                    <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl hover:shadow-3xl overflow-hidden tender-card transform hover:scale-[1.02] transition-all duration-500 border border-gray-200/50 group relative"
                        data-title="{{ $tender->title }}" data-status="{{ $tender->status }}"
                        data-location="{{ $tender->location }}">

                        <!-- Background Pattern -->
                        <div
                            class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-bl from-teal-100/50 to-transparent rounded-full opacity-50">
                        </div>

                        <!-- Tender Image -->
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ $tender->design->main_image_url }}" alt="{{ $tender->title }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                            <!-- Status Badge -->
                            <div class="absolute top-5 left-5">
                                @if ($tender->status === 'open')
                                    <span
                                        class="status-badge bg-gradient-to-r from-green-500 to-emerald-600 text-white px-5 py-2.5 rounded-2xl text-sm font-bold shadow-2xl border-2 border-white/20 backdrop-blur-sm animate-pulse">
                                        <i class="fas fa-circle ml-2 text-xs"></i>
                                        مفتوحة
                                    </span>
                                @elseif($tender->status === 'closed')
                                    <span
                                        class="status-badge bg-gradient-to-r from-red-500 to-pink-600 text-white px-5 py-2.5 rounded-2xl text-sm font-bold shadow-2xl border-2 border-white/20 backdrop-blur-sm">
                                        <i class="fas fa-times-circle ml-2 text-xs"></i>
                                        مغلقة
                                    </span>
                                @elseif($tender->status === 'awarded')
                                    <span
                                        class="status-badge bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-5 py-2.5 rounded-2xl text-sm font-bold shadow-2xl border-2 border-white/20 backdrop-blur-sm">
                                        <i class="fas fa-trophy ml-2 text-xs"></i>
                                        ممنوحة
                                    </span>
                                @endif
                            </div>

                            <!-- Proposals Count -->
                            <div class="absolute top-5 right-5">
                                <div
                                    class="bg-white/95 backdrop-blur-md text-gray-800 px-4 py-2.5 rounded-2xl text-sm font-bold shadow-xl border border-white/50">
                                    <i class="fas fa-file-alt ml-2 text-teal-600"></i>
                                    {{ $tender->proposals_count }} عرض
                                </div>
                            </div>

                            <!-- Days Remaining -->
                            @if ($tender->days_remaining !== null && $tender->status === 'open')
                                <div class="absolute bottom-5 left-5">
                                    <div
                                        class="bg-white/95 backdrop-blur-md text-gray-800 px-4 py-2.5 rounded-2xl text-sm font-bold shadow-xl border border-white/50">
                                        <i
                                            class="fas fa-clock ml-2 text-{{ $tender->days_remaining > 7 ? 'green' : ($tender->days_remaining > 3 ? 'yellow' : 'red') }}-600"></i>
                                        {{ $tender->days_remaining }} يوم متبقي
                                    </div>
                                </div>
                            @endif

                            <!-- Hover Overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-teal-600/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                        </div>

                        <!-- Enhanced Tender Content -->
                        <div class="p-7 relative z-10">
                            <h3
                                class="text-2xl font-bold text-gray-900 mb-4 line-clamp-1 leading-tight group-hover:text-teal-600 transition-colors duration-300">
                                {{ $tender->title }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-7 line-clamp-2 leading-relaxed">
                                {{ Str::limit($tender->description, 120) }}
                            </p>

                            <!-- Enhanced Tender Details -->
                            <div class="space-y-4 mb-7">
                                <div
                                    class="flex items-center justify-between py-3 px-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200 hover:from-teal-50 hover:to-blue-50 transition-colors duration-300">
                                    <div class="flex items-center">
                                        <i class="fas fa-user text-teal-600 ml-3 text-lg"></i>
                                        <span class="text-sm font-semibold text-gray-700">العميل</span>
                                    </div>
                                    <span class="text-sm font-bold text-gray-900">{{ $tender->client->name }}</span>
                                </div>

                                <div
                                    class="flex items-center justify-between py-3 px-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200 hover:from-blue-50 hover:to-indigo-50 transition-colors duration-300">
                                    <div class="flex items-center">
                                        <i class="fas fa-map-marker-alt text-blue-600 ml-3 text-lg"></i>
                                        <span class="text-sm font-semibold text-gray-700">الموقع</span>
                                    </div>
                                    <span class="text-sm font-bold text-gray-900">{{ $tender->location }}</span>
                                </div>

                                @if ($tender->budget)
                                    <div
                                        class="flex items-center justify-between py-3 px-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200 hover:from-green-50 hover:to-emerald-50 transition-colors duration-300">
                                        <div class="flex items-center">
                                            <i class="fas fa-money-bill-wave text-green-600 ml-3 text-lg"></i>
                                            <span class="text-sm font-semibold text-gray-700">الميزانية</span>
                                        </div>
                                        <span
                                            class="text-sm font-bold text-green-600">{{ $tender->formatted_budget }}</span>
                                    </div>
                                @endif

                                <div
                                    class="flex items-center justify-between py-3 px-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200 hover:from-purple-50 hover:to-pink-50 transition-colors duration-300">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-alt text-purple-600 ml-3 text-lg"></i>
                                        <span class="text-sm font-semibold text-gray-700">آخر موعد</span>
                                    </div>
                                    <span class="text-sm font-bold text-gray-900">{{ $tender->formatted_deadline }}</span>
                                </div>
                            </div>

                            <!-- Enhanced Actions -->
                            <div class="flex gap-4">
                                <a href="{{ route('tenders.show', $tender->id) }}"
                                    class="flex-1 bg-gradient-to-r from-teal-600 to-blue-700 hover:from-teal-700 hover:to-blue-800 text-white text-center py-4 px-5 rounded-2xl font-bold text-sm transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl border-2 border-white/20 group">
                                    <i
                                        class="fas fa-eye ml-2 text-base group-hover:scale-110 transition-transform duration-300"></i>
                                    عرض التفاصيل
                                </a>
                                @auth
                                    @if (auth()->user()->isConsultant() && $tender->status === 'open')
                                        <a href="{{ route('proposals.create', $tender->id) }}"
                                            class="flex-1 bg-gradient-to-r from-green-600 to-teal-700 hover:from-green-700 hover:to-teal-800 text-white text-center py-4 px-5 rounded-2xl font-bold text-sm transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl border-2 border-white/20 group">
                                            <i
                                                class="fas fa-paper-plane ml-2 text-base group-hover:scale-110 transition-transform duration-300"></i>
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
            // Enhanced filter functionality
            window.applyFilters = function() {
                const searchTerm = document.getElementById('searchInput').value.toLowerCase();
                const statusFilter = document.getElementById('statusFilter').value;
                const locationFilter = document.getElementById('locationFilter').value.toLowerCase();

                const cards = document.querySelectorAll('.tender-card');
                let visibleCount = 0;

                cards.forEach((card, index) => {
                    const title = card.dataset.title.toLowerCase();
                    const status = card.dataset.status;
                    const location = card.dataset.location.toLowerCase();

                    const matchesSearch = title.includes(searchTerm);
                    const matchesStatus = !statusFilter || status === statusFilter;
                    const matchesLocation = location.includes(locationFilter);

                    if (matchesSearch && matchesStatus && matchesLocation) {
                        card.style.display = 'block';
                        card.style.animation = `fadeInUp 0.5s ease-out ${index * 0.1}s both`;
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Show/hide empty state with animation
                const emptyState = document.querySelector('.col-span-full');
                if (emptyState) {
                    if (visibleCount === 0) {
                        emptyState.style.display = 'block';
                        emptyState.style.animation = 'fadeIn 0.5s ease-out';
                    } else {
                        emptyState.style.display = 'none';
                    }
                }

                // Update results counter
                updateResultsCounter(visibleCount);
            };

            // Quick filter function
            window.setQuickFilter = function(status) {
                document.getElementById('statusFilter').value = status;

                // Update quick filter buttons
                document.querySelectorAll('.quick-filter-btn').forEach(btn => {
                    btn.classList.remove('ring-2', 'ring-teal-500', 'bg-teal-100', 'text-teal-800');
                });

                if (status) {
                    const activeBtn = document.querySelector(`[onclick="setQuickFilter('${status}')"]`);
                    if (activeBtn) {
                        activeBtn.classList.add('ring-2', 'ring-teal-500', 'bg-teal-100', 'text-teal-800');
                    }
                }

                applyFilters();
            };

            // Clear filters function
            window.clearFilters = function() {
                document.getElementById('searchInput').value = '';
                document.getElementById('statusFilter').value = '';
                document.getElementById('locationFilter').value = '';

                // Reset quick filter buttons
                document.querySelectorAll('.quick-filter-btn').forEach(btn => {
                    btn.classList.remove('ring-2', 'ring-teal-500', 'bg-teal-100', 'text-teal-800');
                });

                applyFilters();
            };

            // Update results counter
            function updateResultsCounter(count) {
                let counter = document.getElementById('resultsCounter');
                if (!counter) {
                    counter = document.createElement('div');
                    counter.id = 'resultsCounter';
                    counter.className =
                        'fixed top-20 right-4 bg-teal-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg z-50';
                    document.body.appendChild(counter);
                }

                counter.textContent = `${count} نتيجة`;
                counter.style.animation = 'bounceIn 0.5s ease-out';

                setTimeout(() => {
                    counter.style.animation = '';
                }, 500);
            }

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

        .tender-card {
            animation: fadeInUp 0.6s ease-out;
            position: relative;
            overflow: hidden;
        }

        .tender-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
            z-index: 1;
        }

        .tender-card:hover::before {
            left: 100%;
        }

        .tender-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
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
