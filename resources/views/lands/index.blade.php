@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">بيع وتبادل الأراضي</h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    منصة موثوقة لبيع وتبادل الأراضي السكنية والتجارية في المملكة العربية السعودية
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
                        <a href="{{ route('lands.my-ads') }}"
                            class="inline-flex items-center px-5 py-2.5 bg-[#2f5c69]/10 text-[#2f5c69] rounded-xl font-medium hover:bg-[#2f5c69]/20 transition-colors">
                            <i class="fas fa-list ml-2"></i>
                            إعلاناتي
                        </a>
                        <a href="{{ route('lands.my-offers') }}"
                            class="inline-flex items-center px-5 py-2.5 bg-[#2f5c69]/10 text-[#2f5c69] rounded-xl font-medium hover:bg-[#2f5c69]/20 transition-colors">
                            <i class="fas fa-handshake ml-2"></i>
                            العروض المقدمة
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 bg-[#2f5c69]/10 rounded-xl">
                            <i class="fas fa-map-marker-alt text-2xl text-[#2f5c69]"></i>
                        </div>
                        <div class="mr-4">
                            <h3 class="text-2xl font-bold text-gray-900">150+</h3>
                            <p class="text-gray-600">أرض متاحة</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 bg-[#f3a446]/10 rounded-xl">
                            <i class="fas fa-handshake text-2xl text-[#f3a446]"></i>
                        </div>
                        <div class="mr-4">
                            <h3 class="text-2xl font-bold text-gray-900">89</h3>
                            <p class="text-gray-600">صفقة مكتملة</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-xl">
                            <i class="fas fa-users text-2xl text-green-600"></i>
                        </div>
                        <div class="mr-4">
                            <h3 class="text-2xl font-bold text-gray-900">2,500+</h3>
                            <p class="text-gray-600">مستخدم نشط</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 mb-8">
                <div class="flex items-center mb-6">
                    <i class="fas fa-filter text-2xl text-[#f3a446] ml-3"></i>
                    <h3 class="text-2xl font-bold text-gray-900">البحث والتصفية المتقدمة</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-800">المدينة</label>
                        <select
                            class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 appearance-none">
                            <option value="">جميع المدن</option>
                            <option value="riyadh">الرياض</option>
                            <option value="jeddah">جدة</option>
                            <option value="dammam">الدمام</option>
                            <option value="makkah">مكة المكرمة</option>
                            <option value="medina">المدينة المنورة</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-800">نوع الأرض</label>
                        <select
                            class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 appearance-none">
                            <option value="">جميع الأنواع</option>
                            <option value="residential">سكنية</option>
                            <option value="commercial">تجارية</option>
                            <option value="agricultural">زراعية</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-800">نوع الإعلان</label>
                        <select
                            class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 appearance-none">
                            <option value="">الكل</option>
                            <option value="sale">بيع</option>
                            <option value="exchange">تبادل</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-800">السعر</label>
                        <select
                            class="w-full border-2 border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-[#f3a446]/20 focus:border-[#f3a446] transition-all duration-300 bg-gray-50/50 appearance-none">
                            <option value="">جميع الأسعار</option>
                            <option value="0-500000">حتى 500,000 درهم</option>
                            <option value="500000-1000000">500,000 - 1,000,000 درهم</option>
                            <option value="1000000+">أكثر من 1,000,000 درهم</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($lands as $land)
                    <div
                        class="group bg-white rounded-2xl shadow-lg border-2 border-transparent overflow-hidden hover:shadow-xl hover:border-[#f3a446] transition-all duration-300 transform hover:-translate-y-1">
                        <div class="relative h-48 overflow-hidden">
                            <div
                                class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#2f5c69] to-[#1a262a] transition-transform duration-500 group-hover:scale-105">
                                <i class="fas fa-map text-6xl text-white opacity-10"></i>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute top-4 right-4">
                                <span
                                    class="px-3 py-1.5 rounded-full text-xs font-bold shadow-lg
                                {{ $land['type'] === 'بيع' ? 'bg-[#f3a446]/20 text-[#f3a446]' : 'bg-[#2f5c69]/20 text-[#2f5c69]' }}">
                                    {{ $land['type'] }}
                                </span>
                            </div>
                            <div class="absolute bottom-4 left-4">
                                <p class="text-2xl font-bold text-white shadow-lg">{{ $land['price'] }} درهم</p>
                            </div>
                        </div>

                        <div class="p-6">
                            <h3
                                class="text-2xl font-bold text-gray-900 mb-2 truncate transition-colors duration-300 group-hover:text-[#2f5c69]">
                                {{ $land['title'] }}</h3>
                            <p class="text-gray-600 mb-4 h-12 line-clamp-2">{{ $land['description'] }}</p>

                            <div class="space-y-3 mb-5 pt-4 border-t border-gray-100">
                                <div class="flex items-center text-sm text-gray-700 font-medium">
                                    <i class="fas fa-map-marker-alt text-[#2f5c69] ml-3 w-4 text-center"></i>
                                    <span>{{ $land['location'] }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-700 font-medium">
                                    <i class="fas fa-ruler-combined text-[#2f5c69] ml-3 w-4 text-center"></i>
                                    <span>{{ $land['area'] }}</span>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <a href="{{ route('lands.show', $land['id']) }}"
                                    class="flex-1 bg-[#f3a446] text-[#1a262a] text-center py-3 px-4 rounded-xl font-bold hover:bg-[#f5b05a] transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
                                    عرض التفاصيل
                                </a>
                                <button
                                    class="flex-shrink-0 bg-gray-100 text-gray-500 py-3 px-4 rounded-xl font-bold hover:bg-red-100 hover:text-red-500 transition-colors"
                                    title="إضافة للمفضلة">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <button
                    class="bg-transparent text-[#2f5c69] border-2 border-[#2f5c69] px-8 py-3 rounded-xl font-bold hover:bg-[#2f5c69] hover:text-white transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    تحميل المزيد
                </button>
            </div>

            <div
                class="mt-16 bg-gradient-to-br from-[#2f5c69] to-[#1a262a] rounded-2xl p-10 text-center text-white shadow-2xl">
                <h2 class="text-3xl font-bold mb-4">هل لديك أرض للبيع أو التبادل؟</h2>
                <p class="text-xl mb-8 opacity-90 max-w-lg mx-auto">انشر إعلانك الآن مجاناً واحصل على أفضل العروض من
                    منصتنا</p>
                <a href="{{ route('lands.create') }}"
                    class="bg-[#f3a446] text-[#1a262a] px-8 py-4 rounded-xl font-bold text-lg hover:bg-[#f5b05a] transition-all inline-block transform hover:scale-105 shadow-xl">
                    <i class="fas fa-plus ml-2"></i>
                    إضافة أرض جديدة
                </a>
            </div>
        </div>
    </div>
@endsection
