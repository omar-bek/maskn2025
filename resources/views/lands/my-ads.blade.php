@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">إعلاناتي</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                إدارة إعلانات الأراضي الخاصة بك وتتبع الأداء
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <h2 class="text-xl font-bold text-gray-900">روابط سريعة</h2>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('lands.create') }}"
                        class="inline-flex items-center px-5 py-2.5 bg-[#f3a446] text-[#1a262a] rounded-xl font-bold hover:bg-[#f5b05a] transition-all transform hover:scale-105 shadow-lg">
                        <i class="fas fa-plus ml-2"></i>
                        إضافة أرض جديدة
                    </a>
                    <a href="{{ route('lands.my-offers') }}"
                        class="inline-flex items-center px-5 py-2.5 bg-[#2f5c69]/10 text-[#2f5c69] rounded-xl font-medium hover:bg-[#2f5c69]/20 transition-colors">
                        <i class="fas fa-handshake ml-2"></i>
                        العروض المقدمة
                    </a>
                    <a href="{{ route('lands.index') }}"
                        class="inline-flex items-center px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200 transition-colors">
                        <i class="fas fa-search ml-2"></i>
                        تصفح الأراضي
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-[#2f5c69]/10 rounded-xl">
                        <i class="fas fa-list text-2xl text-[#2f5c69]"></i>
                    </div>
                    <div class="mr-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ count($myLands) }}</h3>
                        <p class="text-gray-600">إعلان إجمالي</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-xl">
                        <i class="fas fa-eye text-2xl text-green-600"></i>
                    </div>
                    <div class="mr-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $myLands->sum('views') }}</h3>
                        <p class="text-gray-600">مشاهدات</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-[#f3a446]/10 rounded-xl">
                        <i class="fas fa-handshake text-2xl text-[#f3a446]"></i>
                    </div>
                    <div class="mr-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $myLands->sum('offers_count') }}</h3>
                        <p class="text-gray-600">عروض مقدمة</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-xl">
                        <i class="fas fa-chart-line text-2xl text-blue-600"></i>
                    </div>
                    <div class="mr-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $myLands->where('status', 'active')->count() }}
                        </h3>
                        <p class="text-gray-600">إعلانات نشطة</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <h2 class="text-xl font-bold text-gray-900">إعلاناتي</h2>
                    <div class="flex gap-2">
                        <button
                            class="px-4 py-2 bg-[#f3a446] text-[#1a262a] rounded-xl text-sm font-bold hover:bg-[#f5b05a] transition-colors">
                            الكل
                        </button>
                        <button
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl text-sm font-medium hover:bg-gray-200 transition-colors">
                            نشط
                        </button>
                        <button
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl text-sm font-medium hover:bg-gray-200 transition-colors">
                            معلق
                        </button>
                        <button
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl text-sm font-medium hover:bg-gray-200 transition-colors">
                            مكتمل
                        </button>
                    </div>
                </div>

                <a href="{{ route('lands.create') }}"
                    class="bg-[#2f5c69] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#1a262a] transition-all transform hover:scale-105 shadow-lg">
                    <i class="fas fa-plus ml-2"></i>
                    إضافة إعلان جديد
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach($myLands as $land)
                <div
                    class="bg-white rounded-2xl shadow-lg border-2 border-transparent overflow-hidden hover:shadow-xl hover:border-[#f3a446] transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative h-48">
                        @if($land->images && count($land->images) > 0)
                            <img src="{{ $land->images[0] }}" alt="{{ $land->title }}"
                                class="w-full h-full object-cover">
                        @else
                            <div
                                class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#2f5c69] to-[#1a262a]">
                                <i class="fas fa-map text-6xl text-white opacity-10"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1.5 rounded-full text-xs font-bold shadow-lg
                                {{ $land->status === 'active' ? 'bg-green-100 text-green-800' :
                                    ($land->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ $land->status_text }}
                            </span>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1.5 rounded-full text-xs font-bold shadow-lg
                                {{ $land->transaction_type === 'sale' ? 'bg-[#f3a446]/20 text-[#f3a446]' : 'bg-[#2f5c69]/20 text-[#2f5c69]' }}
                                {{ $land->transaction_type === 'both' ? 'bg-purple-100 text-purple-800' : '' }}">
                                {{ $land->transaction_type_text }}
                            </span>
                        </div>

                        <div class="absolute bottom-4 right-4 text-right">
                            <p class="text-2xl font-bold text-white shadow-lg">{{ $land->formatted_price }}</p>
                            <p class="text-sm text-gray-200">{{ $land->created_at->format('Y-m-d') }}</p>
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-3 hover:text-[#2f5c69] transition-colors">
                            {{ $land->title }}</h3>

                        <div class="flex items-center gap-6 mb-4">
                            <div class="flex items-center text-sm text-gray-700 font-medium">
                                <i class="fas fa-map-marker-alt text-[#2f5c69] ml-2"></i>
                                <span>{{ $land->location }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-700 font-medium">
                                <i class="fas fa-ruler-combined text-[#2f5c69] ml-2"></i>
                                <span>{{ $land->formatted_area }}</span>
                            </div>
                        </div>

                        <p class="text-gray-600 mb-5 line-clamp-2">{{ Str::limit($land->description, 100) }}</p>

                        <div
                            class="flex items-center justify-between mb-5 p-4 bg-gray-50/50 rounded-xl border border-gray-200/50">
                            <div class="flex items-center text-sm font-bold text-gray-800">
                                <i class="fas fa-eye text-green-500 ml-2"></i>
                                <span>{{ $land->views }} مشاهدة</span>
                            </div>
                            <div class="flex items-center text-sm font-bold text-gray-800">
                                <i class="fas fa-handshake text-[#f3a446] ml-2"></i>
                                <span>{{ $land->offers_count }} عرض</span>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ route('lands.show', $land->id) }}"
                                class="flex-1 bg-[#f3a446] text-[#1a262a] text-center py-3 px-4 rounded-xl font-bold hover:bg-[#f5b05a] transition-colors shadow-lg hover:shadow-xl transform hover:scale-105">
                                عرض التفاصيل
                            </a>
                            <a href="{{ route('lands.edit', $land->id) }}"
                                class="flex-shrink-0 bg-gray-100 text-gray-700 py-3 px-4 rounded-xl font-bold hover:bg-gray-200 transition-colors"
                                title="تعديل">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('lands.destroy', $land->id) }}" style="display: inline;"
                                onsubmit="return confirm('هل أنت متأكد من حذف هذا الإعلان؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="flex-shrink-0 bg-red-100 text-red-700 py-3 px-4 rounded-xl font-bold hover:bg-red-200 transition-colors"
                                    title="حذف">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if(count($myLands) === 0)
            <div class="text-center py-12">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-12">
                    <i class="fas fa-list text-6xl text-gray-300 mb-6"></i>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">لا توجد إعلانات</h3>
                    <p class="text-gray-600 text-lg mb-8">ابدأ بنشر إعلانك الأول للحصول على عروض</p>
                    <a href="{{ route('lands.create') }}"
                        class="bg-[#f3a446] text-[#1a262a] px-8 py-3 rounded-xl font-bold text-lg hover:bg-[#f5b05a] transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
                        <i class="fas fa-plus ml-2"></i>
                        إضافة إعلان جديد
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
