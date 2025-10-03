<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tender->title }} - انشاءات</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #1d4ed8;
            --secondary: #10b981;
            --accent: #f59e0b;
            --danger: #ef4444;
            --light: #f8fafc;
            --dark: #1e293b;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .tab-active {
            border-bottom: 3px solid var(--primary);
            color: var(--primary);
            font-weight: bold;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }

        .status-open {
            background-color: #dcfce7;
            color: #166534;
        }

        .status-closed {
            background-color: #fef2f2;
            color: #991b1b;
        }

        .status-awarded {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .progress-bar {
            height: 8px;
            border-radius: 4px;
            background-color: #e5e7eb;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 0.5s ease;
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .sticky-sidebar {
            position: sticky;
            top: 2rem;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #c5c5c5;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* RTL specific adjustments */
        .rtl-grid {
            direction: rtl;
        }

        .flip-icon {
            transform: scaleX(-1);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="gradient-bg text-white shadow-lg">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl md:text-3xl font-bold">{{ $tender->title }}</h1>
                    <p class="text-blue-100 mt-2">{{ $tender->location }}</p>
                </div>

                <div class="flex items-center space-x-4 space-x-reverse">
                    <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                        <div class="flex items-center">
                            <i class="fas fa-user flip-icon ml-2"></i>
                            <span>{{ $tender->client->name }}</span>
                        </div>
                    </div>

                    @if ($tender->status === 'open')
                        <div class="status-badge status-open">
                            <i class="fas fa-circle ml-2 text-xs animate-pulse"></i>
                            مناقصة مفتوحة
                        </div>
                    @elseif($tender->status === 'closed')
                        <div class="status-badge status-closed">
                            <i class="fas fa-lock ml-2 text-xs"></i>
                            مناقصة مغلقة
                        </div>
                    @elseif($tender->status === 'awarded')
                        <div class="status-badge status-awarded">
                            <i class="fas fa-trophy ml-2 text-xs"></i>
                            مناقصة ممنوحة
                        </div>
                    @endif
                </div>
            </div>

            <!-- Breadcrumb -->
            <nav class="flex items-center mt-6 text-sm">
                <a href="{{ route('home') }}" class="text-blue-200 hover:text-white transition-colors">الرئيسية</a>
                <i class="fas fa-chevron-left mx-2 text-blue-300 text-xs"></i>
                <a href="{{ route('tenders.index') }}"
                    class="text-blue-200 hover:text-white transition-colors">المناقصات</a>
                <i class="fas fa-chevron-left mx-2 text-blue-300 text-xs"></i>
                <span class="text-white font-medium">{{ Str::limit($tender->title, 30) }}</span>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8 rtl-grid">
            <!-- Left Column - Main Content -->
            <div class="lg:w-2/3">
                <!-- Tabs Navigation -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6 overflow-hidden">
                    <div class="flex overflow-x-auto">
                        <button id="tab-overview"
                            class="tab-button flex-shrink-0 px-6 py-4 font-medium text-gray-600 hover:text-blue-600 transition-colors tab-active">
                            <i class="fas fa-info-circle ml-2"></i>
                            نظرة عامة
                        </button>
                        <button id="tab-design"
                            class="tab-button flex-shrink-0 px-6 py-4 font-medium text-gray-600 hover:text-blue-600 transition-colors">
                            <i class="fas fa-palette ml-2"></i>
                            التصميم
                        </button>
                        <button id="tab-items"
                            class="tab-button flex-shrink-0 px-6 py-4 font-medium text-gray-600 hover:text-blue-600 transition-colors">
                            <i class="fas fa-list ml-2"></i>
                            بنود المناقصة
                        </button>
                        <button id="tab-proposals"
                            class="tab-button flex-shrink-0 px-6 py-4 font-medium text-gray-600 hover:text-blue-600 transition-colors">
                            <i class="fas fa-file-alt ml-2"></i>
                            العروض
                        </button>
                    </div>
                </div>

                <!-- Tab Content -->
                <div id="tab-content" class="animate-fade-in">
                    <!-- Overview Tab -->
                    <div id="content-overview" class="tab-content active">
                        <!-- Description Card -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6 card-hover">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center ml-3">
                                    <i class="fas fa-file-alt text-blue-600"></i>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">وصف المشروع</h2>
                            </div>
                            <p class="text-gray-700 leading-relaxed">{{ $tender->description }}</p>
                        </div>

                        <!-- Requirements Card -->
                        @if ($tender->requirements)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6 card-hover">
                                <div class="flex items-center mb-4">
                                    <div
                                        class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center ml-3">
                                        <i class="fas fa-clipboard-check text-green-600"></i>
                                    </div>
                                    <h2 class="text-xl font-bold text-gray-800">المتطلبات والشروط</h2>
                                </div>
                                <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $tender->requirements }}
                                </p>
                            </div>
                        @endif

                        <!-- Client Notes Card -->
                        @if ($tender->client_notes)
                            <div class="bg-white rounded-xl shadow-sm border border-yellow-200 p-6 mb-6 card-hover">
                                <div class="flex items-center mb-4">
                                    <div
                                        class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center ml-3">
                                        <i class="fas fa-sticky-note text-yellow-600"></i>
                                    </div>
                                    <h2 class="text-xl font-bold text-gray-800">ملاحظات التعديل المطلوبة</h2>
                                </div>
                                <div class="bg-yellow-50 border border-yellow-100 rounded-lg p-4">
                                    <div class="flex items-start">
                                        <i class="fas fa-exclamation-triangle text-yellow-500 ml-3 mt-1"></i>
                                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                                            {{ $tender->client_notes }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
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
                                                                <td
                                                                    class="px-6 py-4 text-sm font-medium text-gray-900">
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
                                                                <td
                                                                    class="px-6 py-4 text-center text-sm text-gray-900">
                                                                    {{ $item->quantity ?? 'N/A' }}</td>
                                                                <td
                                                                    class="px-6 py-4 text-center text-sm text-gray-900">
                                                                    {{ $item->unit ?? '-' }}</td>
                                                                <td
                                                                    class="px-6 py-4 text-center text-sm text-gray-900">
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
                                                        <a href="{{ route('proposals.show', $proposal->id) }}"
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
                                        <div
                                            class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center ml-3">
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

            <!-- Right Column - Sidebar -->
            <div class="lg:w-1/3">
                <div class="sticky-sidebar space-y-6">
                    <!-- Tender Details Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">تفاصيل المناقصة</h2>

                        <div class="space-y-4">
                            <!-- Deadline -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-alt text-blue-500 ml-2"></i>
                                    <span class="text-gray-600">آخر موعد</span>
                                </div>
                                <span class="font-semibold text-gray-800">{{ $tender->formatted_deadline }}</span>
                            </div>

                            <!-- Budget -->
                            @if ($tender->budget)
                                <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-money-bill-wave text-green-500 ml-2"></i>
                                        <span class="text-gray-600">الميزانية</span>
                                    </div>
                                    <span class="font-semibold text-green-600">{{ $tender->formatted_budget }}</span>
                                </div>
                            @endif

                            <!-- Proposals Count -->
                            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-file-alt text-blue-500 ml-2"></i>
                                    <span class="text-gray-600">عدد العروض</span>
                                </div>
                                <span class="font-semibold text-blue-600">{{ $tender->proposals_count }}</span>
                            </div>

                            <!-- Days Remaining -->
                            @if ($tender->days_remaining !== null)
                                <div class="flex items-center justify-between p-3 bg-orange-50 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-clock text-orange-500 ml-2"></i>
                                        <span class="text-gray-600">الأيام المتبقية</span>
                                    </div>
                                    <span class="font-semibold text-orange-600">{{ $tender->days_remaining }}
                                        يوم</span>
                                </div>

                                <!-- Progress Bar -->
                                <div class="mt-2">
                                    <div class="flex justify-between text-sm text-gray-600 mb-1">
                                        <span>وقت متبقي</span>
                                        <span>{{ $tender->days_remaining }} يوم</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-fill bg-orange-500"
                                            style="width: {{ min(100, max(5, 100 - ($tender->days_remaining / 30) * 100)) }}%">
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Created Date -->
                            <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar text-purple-500 ml-2"></i>
                                    <span class="text-gray-600">تاريخ الإنشاء</span>
                                </div>
                                <span
                                    class="font-semibold text-purple-600">{{ $tender->created_at->format('Y-m-d') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Client Info Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">معلومات العميل</h2>

                        <div class="space-y-4">
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <i class="fas fa-user text-indigo-500 ml-2"></i>
                                <div class="flex-1 mr-2">
                                    <p class="text-sm text-gray-500">الاسم</p>
                                    <p class="font-semibold text-gray-800">{{ $tender->client->name }}</p>
                                </div>
                            </div>

                            @if ($tender->client->phone)
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <i class="fas fa-phone text-green-500 ml-2"></i>
                                    <div class="flex-1 mr-2">
                                        <p class="text-sm text-gray-500">الهاتف</p>
                                        <p class="font-semibold text-gray-800">{{ $tender->client->phone }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($tender->client->city)
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <i class="fas fa-map-marker-alt text-blue-500 ml-2"></i>
                                    <div class="flex-1 mr-2">
                                        <p class="text-sm text-gray-500">المدينة</p>
                                        <p class="font-semibold text-gray-800">{{ $tender->client->city }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">الإجراءات</h2>

                        <div class="space-y-3">
                            @auth
                                @if (auth()->user()->isConsultant() && $tender->status === 'open')
                                    @if ($userProposal)
                                        <a href="{{ route('proposals.edit', $userProposal->id) }}"
                                            class="w-full flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg font-medium transition-colors">
                                            <i class="fas fa-edit ml-2"></i>
                                            تعديل العرض
                                        </a>
                                        <a href="{{ route('proposals.show', $userProposal->id) }}"
                                            class="w-full flex items-center justify-center bg-purple-600 hover:bg-purple-700 text-white px-4 py-3 rounded-lg font-medium transition-colors">
                                            <i class="fas fa-eye ml-2"></i>
                                            عرض تفاصيل عرضي
                                        </a>
                                    @else
                                        <a href="{{ route('proposals.create', $tender->id) }}"
                                            class="w-full flex items-center justify-center bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded-lg font-medium transition-colors">
                                            <i class="fas fa-paper-plane ml-2"></i>
                                            قدم عرض
                                        </a>
                                    @endif
                                @endif

                                @if (auth()->user()->isClient() && auth()->id() == $tender->client_id)
                                    <a href="{{ route('tenders.edit', $tender->id) }}"
                                        class="w-full flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg font-medium transition-colors">
                                        <i class="fas fa-edit ml-2"></i>
                                        تعديل المناقصة
                                    </a>

                                    @if ($tender->proposals->count() > 0)
                                        <a href="{{ route('tenders.compare-proposals', $tender->id) }}"
                                            class="w-full flex items-center justify-center bg-purple-600 hover:bg-purple-700 text-white px-4 py-3 rounded-lg font-medium transition-colors">
                                            <i class="fas fa-chart-bar ml-2"></i>
                                            مقارنة العروض
                                        </a>
                                    @endif

                                    @if ($tender->status === 'open')
                                        <form action="{{ route('tenders.close', $tender->id) }}" method="POST"
                                            class="w-full">
                                            @csrf
                                            <button type="submit"
                                                class="w-full flex items-center justify-center bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-lg font-medium transition-colors"
                                                onclick="return confirm('هل أنت متأكد من إغلاق المناقصة؟')">
                                                <i class="fas fa-lock ml-2"></i>
                                                إغلاق المناقصة
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            @else
                                <a href="{{ route('login') }}"
                                    class="w-full flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg font-medium transition-colors">
                                    <i class="fas fa-sign-in-alt ml-2"></i>
                                    تسجيل الدخول للمشاركة
                                </a>
                            @endauth

                            <!-- Share Button -->
                            <button onclick="shareTender()"
                                class="w-full flex items-center justify-center bg-gray-600 hover:bg-gray-700 text-white px-4 py-3 rounded-lg font-medium transition-colors">
                                <i class="fas fa-share-alt ml-2"></i>
                                مشاركة المناقصة
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Image Modal -->
    <div id="imageModal"
        class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-full">
            <button onclick="closeImageModal()"
                class="absolute top-4 left-4 text-white text-2xl hover:text-gray-300 z-10">
                <i class="fas fa-times"></i>
            </button>
            <img id="modalImage" src="" alt=""
                class="max-w-full max-h-full object-contain rounded-lg">
        </div>
    </div>

    <!-- Gallery Modal -->
    <div id="galleryModal"
        class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
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
</body>

</html>
