@extends('layouts.app')

@section('title', 'عروضي المقدمة - انشاءات')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        <!-- Enhanced Hero Section -->
        <div class="relative bg-gradient-to-br from-green-600 via-teal-700 to-emerald-800 text-white overflow-hidden">
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
                        <i class="fas fa-file-alt text-2xl ml-3"></i>
                        <span class="text-lg font-semibold">إدارة العروض المقدمة</span>
                    </div>

                    <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                        <span class="bg-gradient-to-r from-white to-green-100 bg-clip-text text-transparent">
                            عروضي المقدمة
                        </span>
                    </h1>

                    <p class="text-xl md:text-2xl text-green-100 mb-10 max-w-3xl mx-auto leading-relaxed">
                        تتبع جميع العروض التي قدمتها على المناقصات وادارتها بسهولة
                    </p>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                        <div
                            class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300">
                            <div class="text-3xl font-bold mb-2">{{ $proposals->total() ?? 0 }}</div>
                            <div class="text-sm text-green-100">عرض مقدم</div>
                        </div>
                        <div
                            class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300">
                            <div class="text-3xl font-bold mb-2">{{ $proposals->where('status', 'accepted')->count() }}
                            </div>
                            <div class="text-sm text-green-100">عرض مقبول</div>
                        </div>
                        <div
                            class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300">
                            <div class="text-3xl font-bold mb-2">{{ $proposals->where('status', 'pending')->count() }}</div>
                            <div class="text-sm text-green-100">في الانتظار</div>
                        </div>
                        <div
                            class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300">
                            <div class="text-3xl font-bold mb-2">100%</div>
                            <div class="text-sm text-green-100">متابعة</div>
                        </div>
                    </div>

                    <a href="{{ route('tenders.index') }}"
                        class="inline-flex items-center bg-white text-green-600 px-10 py-5 rounded-2xl font-bold text-xl hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 shadow-2xl border-2 border-white/20 group">
                        <i class="fas fa-search ml-4 text-2xl group-hover:scale-110 transition-transform duration-300"></i>
                        تصفح المناقصات الجديدة
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">

            <!-- Enhanced Advanced Filters -->
            <div
                class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl p-8 mb-10 border border-gray-200/50 relative overflow-hidden">
                <!-- Background Pattern -->
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-green-100/50 to-transparent rounded-full opacity-50">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-teal-100/50 to-transparent rounded-full opacity-50">
                </div>

                <div class="relative z-10">
                    <div class="flex items-center mb-8">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-green-600 to-teal-700 rounded-2xl flex items-center justify-center ml-4 shadow-lg">
                            <i class="fas fa-filter text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">البحث والتصفية المتقدمة</h3>
                            <p class="text-gray-600">ابحث في عروضك وفلترها حسب الحالة بسهولة وسرعة</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-3">
                            <label class=" text-sm font-bold text-gray-800 flex items-center">
                                <i class="fas fa-search text-green-600 ml-2"></i>
                                البحث في العروض
                            </label>
                            <div class="relative group">
                                <input type="text" id="searchInput" placeholder="ابحث بالعنوان أو الوصف..."
                                    class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 pr-14 focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 bg-gray-50/50 backdrop-blur-sm group-hover:bg-white group-hover:shadow-lg">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                    <i
                                        class="fas fa-search text-gray-400 group-hover:text-green-600 transition-colors duration-300"></i>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class=" text-sm font-bold text-gray-800 flex items-center">
                                <i class="fas fa-flag text-teal-600 ml-2"></i>
                                حالة العرض
                            </label>
                            <div class="relative group">
                                <select id="statusFilter"
                                    class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 transition-all duration-300 bg-gray-50/50 backdrop-blur-sm group-hover:bg-white group-hover:shadow-lg appearance-none cursor-pointer">
                                    <option value="">جميع الحالات</option>
                                    <option value="pending">في الانتظار</option>
                                    <option value="accepted">مقبول</option>
                                    <option value="rejected">مرفوض</option>
                                </select>
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-end">
                            <button onclick="applyFilters()"
                                class="w-full bg-gradient-to-r from-green-800 to-teal-800 hover:from-green-900 hover:to-teal-900 text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl border-2 border-white/20 group">
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
                            <button onclick="setQuickFilter('pending')"
                                class="quick-filter-btn bg-yellow-200 text-yellow-900 hover:bg-yellow-300 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300">
                                <i class="fas fa-clock ml-2 text-xs"></i>
                                في الانتظار
                            </button>
                            <button onclick="setQuickFilter('accepted')"
                                class="quick-filter-btn bg-green-200 text-green-900 hover:bg-green-300 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300">
                                <i class="fas fa-check-circle ml-2 text-xs"></i>
                                مقبول
                            </button>
                            <button onclick="setQuickFilter('rejected')"
                                class="quick-filter-btn bg-red-200 text-red-900 hover:bg-red-300 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300">
                                <i class="fas fa-times-circle ml-2 text-xs"></i>
                                مرفوض
                            </button>
                            <button onclick="clearFilters()"
                                class="quick-filter-btn bg-gray-200 text-gray-900 hover:bg-gray-300 px-4 py-2 rounded-full text-sm font-medium transition-all duration-300">
                                <i class="fas fa-times ml-2 text-xs"></i>
                                مسح الكل
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Proposals Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8" id="proposalsGrid">
                @forelse($proposals as $proposal)
                    <div class="bg-white rounded-3xl shadow-xl hover:shadow-2xl overflow-hidden proposal-card transform hover:scale-[1.02] transition-all duration-500 border border-gray-200 group"
                        data-title="{{ $proposal->tender->title }}" data-status="{{ $proposal->status }}">
                        <!-- Tender Image -->
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ $proposal->tender->design->main_image_url }}" alt="{{ $proposal->tender->title }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>

                            <!-- Status Badge -->
                            <div class="absolute top-5 left-5">
                                @if ($proposal->status === 'pending')
                                    <span
                                        class="status-badge bg-gradient-to-r from-yellow-500 to-orange-500 text-white px-5 py-2.5 rounded-2xl text-sm font-bold shadow-2xl border-2 border-white/20 backdrop-blur-sm">
                                        <i class="fas fa-clock ml-2 text-xs"></i>
                                        في الانتظار
                                    </span>
                                @elseif($proposal->status === 'accepted')
                                    <span
                                        class="status-badge bg-gradient-to-r from-green-500 to-emerald-600 text-white px-5 py-2.5 rounded-2xl text-sm font-bold shadow-2xl border-2 border-white/20 backdrop-blur-sm">
                                        <i class="fas fa-check-circle ml-2 text-xs"></i>
                                        مقبول
                                    </span>
                                @elseif($proposal->status === 'rejected')
                                    <span
                                        class="status-badge bg-gradient-to-r from-red-500 to-pink-600 text-white px-5 py-2.5 rounded-2xl text-sm font-bold shadow-2xl border-2 border-white/20 backdrop-blur-sm">
                                        <i class="fas fa-times-circle ml-2 text-xs"></i>
                                        مرفوض
                                    </span>
                                @endif
                            </div>

                            <!-- Date -->
                            <div class="absolute top-5 right-5">
                                <div
                                    class="bg-white/95 backdrop-blur-md text-gray-800 px-4 py-2.5 rounded-2xl text-sm font-bold shadow-xl border border-white/50">
                                    <i class="fas fa-calendar ml-2 text-green-600"></i>
                                    {{ $proposal->created_at->format('Y-m-d') }}
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="absolute bottom-5 left-5">
                                <div
                                    class="bg-gradient-to-r from-green-500 to-teal-600 text-white px-4 py-2.5 rounded-2xl text-sm font-bold shadow-xl border-2 border-white/20 backdrop-blur-sm">
                                    <i class="fas fa-money-bill-wave ml-2 text-xs"></i>
                                    {{ $proposal->formatted_price }}
                                </div>
                            </div>
                        </div>

                        <!-- Proposal Content -->
                        <div class="p-7">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4 line-clamp-1 leading-tight">
                                {{ $proposal->tender->title }}</h3>
                            <p class="text-gray-600 text-sm mb-6 line-clamp-3 leading-relaxed">
                                {{ Str::limit($proposal->proposal_text, 150) }}</p>

                            <!-- Proposal Details -->
                            <div class="space-y-3 mb-7">
                                <div
                                    class="flex items-center justify-between py-3 px-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200 hover:from-teal-50 hover:to-blue-50 transition-colors duration-300">
                                    <div class="flex items-center">
                                        <i class="fas fa-user text-teal-600 ml-3 text-lg"></i>
                                        <span class="text-sm font-semibold text-gray-700">العميل</span>
                                    </div>
                                    <span
                                        class="text-sm font-bold text-gray-900">{{ $proposal->tender->client->name }}</span>
                                </div>

                                <div
                                    class="flex items-center justify-between py-3 px-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200 hover:from-blue-50 hover:to-indigo-50 transition-colors duration-300">
                                    <div class="flex items-center">
                                        <i class="fas fa-map-marker-alt text-blue-600 ml-3 text-lg"></i>
                                        <span class="text-sm font-semibold text-gray-700">الموقع</span>
                                    </div>
                                    <span class="text-sm font-bold text-gray-900">{{ $proposal->tender->location }}</span>
                                </div>

                                @if ($proposal->duration_months)
                                    <div
                                        class="flex items-center justify-between py-3 px-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200 hover:from-purple-50 hover:to-pink-50 transition-colors duration-300">
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-alt text-purple-600 ml-3 text-lg"></i>
                                            <span class="text-sm font-semibold text-gray-700">مدة التنفيذ</span>
                                        </div>
                                        <span
                                            class="text-sm font-bold text-gray-900">{{ $proposal->formatted_duration }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-4">
                                <a href="{{ route('proposals.show', $proposal->id) }}"
                                    class="flex-1 bg-gradient-to-r from-teal-600 to-blue-600 hover:from-teal-700 hover:to-blue-700 text-white text-center py-4 px-5 rounded-2xl font-bold text-sm transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl border-2 border-white/20 group">
                                    <i
                                        class="fas fa-eye ml-2 text-base group-hover:scale-110 transition-transform duration-300"></i>
                                    عرض التفاصيل
                                </a>
                                @if ($proposal->tender->isOpen())
                                    <a href="{{ route('proposals.edit', $proposal->id) }}"
                                        class="flex-1 bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 text-white text-center py-4 px-5 rounded-2xl font-bold text-sm transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl border-2 border-white/20 group">
                                        <i
                                            class="fas fa-edit ml-2 text-base group-hover:scale-110 transition-transform duration-300"></i>
                                        تعديل العرض
                                    </a>
                                @else
                                    <div
                                        class="flex-1 bg-gradient-to-r from-gray-400 to-gray-500 text-white text-center py-4 px-5 rounded-2xl font-bold text-sm cursor-not-allowed opacity-75 shadow-lg border-2 border-white/20">
                                        <i class="fas fa-lock ml-2 text-base"></i>
                                        منتهي الصلاحية
                                    </div>
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
            // Enhanced filter functionality
            window.applyFilters = function() {
                const searchTerm = document.getElementById('searchInput').value.toLowerCase();
                const statusFilter = document.getElementById('statusFilter').value;

                const cards = document.querySelectorAll('.proposal-card');
                let visibleCount = 0;

                cards.forEach((card, index) => {
                    const title = card.dataset.title.toLowerCase();
                    const status = card.dataset.status;

                    const matchesSearch = title.includes(searchTerm);
                    const matchesStatus = !statusFilter || status === statusFilter;

                    if (matchesSearch && matchesStatus) {
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
                    btn.classList.remove('ring-2', 'ring-green-500', 'bg-green-100', 'text-green-800');
                });

                if (status) {
                    const activeBtn = document.querySelector(`[onclick="setQuickFilter('${status}')"]`);
                    if (activeBtn) {
                        activeBtn.classList.add('ring-2', 'ring-green-500', 'bg-green-100', 'text-green-800');
                    }
                }

                applyFilters();
            };

            // Clear filters function
            window.clearFilters = function() {
                document.getElementById('searchInput').value = '';
                document.getElementById('statusFilter').value = '';

                // Reset quick filter buttons
                document.querySelectorAll('.quick-filter-btn').forEach(btn => {
                    btn.classList.remove('ring-2', 'ring-green-500', 'bg-green-100', 'text-green-800');
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
                        'fixed top-20 right-4 bg-green-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg z-50';
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

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
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

        .proposal-card {
            animation: fadeInUp 0.6s ease-out;
            position: relative;
            overflow: hidden;
        }

        .proposal-card::before {
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

        .proposal-card:hover::before {
            left: 100%;
        }

        .proposal-card:hover {
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
            background: linear-gradient(45deg, #10b981, #14b8a6);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #059669, #0d9488);
        }

        /* Button hover effects */
        .proposal-card a {
            position: relative;
            overflow: hidden;
        }

        .proposal-card a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.3s;
        }

        .proposal-card a:hover::before {
            left: 100%;
        }

        /* Enhanced status badges */
        .proposal-card .status-badge {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        /* Responsive improvements */
        @media (max-width: 768px) {
            .proposal-card {
                margin-bottom: 1rem;
            }

            .proposal-card:hover {
                transform: translateY(-4px) scale(1.01);
            }

            .proposal-card::before {
                display: none;
            }
        }

        @media (max-width: 640px) {
            .proposal-card {
                border-radius: 1.5rem;
            }

            .proposal-card .p-7 {
                padding: 1.5rem;
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
