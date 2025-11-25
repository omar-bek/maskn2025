@extends('layouts.app')

@section('title', 'تعديل الملف الشخصي')

@section('content')
    <div class="bg-gray-50 min-h-screen py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-10">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-gray-400">حساب العميل</p>
                    <h1 class="text-3xl font-extrabold text-[#1a262a]">تحديث الملف الشخصي</h1>
                    <p class="text-gray-500 mt-2">قم بتحديث بيانات التواصل والمعلومات الأساسية لعرضها في ملفك.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('client.profile') }}"
                        class="inline-flex items-center gap-2 px-5 py-3 rounded-xl border border-gray-200 bg-white text-[#1a262a] font-semibold hover:bg-gray-50 transition">
                        <i class="fas fa-arrow-right"></i>
                        العودة للملف
                    </a>
                    <a href="{{ route('client.dashboard') }}"
                        class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-[#1a262a] text-white font-semibold hover:bg-[#2f5c69] transition">
                        <i class="fas fa-tachometer-alt"></i>
                        لوحة التحكم
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 text-sm font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-2xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                    <ul class="space-y-1 list-disc mr-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 p-8 space-y-8">
                <form action="{{ route('client.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="flex flex-col md:flex-row gap-6 items-center">
                        @php
                            $avatarUrl = $user->avatar_url ?? optional($user->profile)->avatar_url;
                        @endphp
                        <div class="w-28 h-28 rounded-2xl overflow-hidden border-2 border-dashed border-[#2f5c69]/30 bg-gray-50 flex items-center justify-center">
                            @if ($avatarUrl)
                                <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-3xl font-bold text-[#2f5c69]">{{ Str::substr($user->name, 0, 2) }}</span>
                            @endif
                        </div>
                        <div class="flex-1 w-full">
                            <label class="block text-sm font-semibold text-[#1a262a] mb-2">صورة الملف الشخصي</label>
                            <input type="file" name="avatar" accept="image/*"
                                class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-[#f3a446]/90 file:text-[#1a262a] hover:file:bg-[#f5b05a] border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#f3a446] focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">الأنواع المسموح بها: JPG, PNG, WebP بحد أقصى 4 ميجابايت.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-[#1a262a] mb-2">الاسم الكامل</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="w-full rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2f5c69] focus:border-transparent text-sm text-right"
                                placeholder="اكتب اسمك الكامل">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#1a262a] mb-2">البريد الإلكتروني</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="w-full rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2f5c69] focus:border-transparent text-sm text-right">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#1a262a] mb-2">رقم الهاتف</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                class="w-full rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2f5c69] focus:border-transparent text-sm text-right"
                                placeholder="+966 5X XXX XXXX">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#1a262a] mb-2">واتساب</label>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp', $user->whatsapp) }}"
                                class="w-full rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2f5c69] focus:border-transparent text-sm text-right">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#1a262a] mb-2">المدينة</label>
                            <input type="text" name="city" value="{{ old('city', $user->city) }}"
                                class="w-full rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2f5c69] focus:border-transparent text-sm text-right">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-[#1a262a] mb-2">نبذة تعريفية</label>
                            <textarea name="bio" rows="4"
                                class="w-full rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2f5c69] focus:border-transparent text-sm text-right"
                                placeholder="شارك نبذة سريعة عن احتياجاتك أو أهدافك">{{ old('bio', optional($user->profile)->bio ?? optional($user->profile)->bio_ar) }}</textarea>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-center justify-end gap-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('client.profile') }}"
                            class="inline-flex items-center gap-2 px-5 py-3 rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-50 transition">
                            إلغاء
                        </a>
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#f3a446] text-[#1a262a] font-semibold hover:bg-[#f5b05a] transition">
                            <i class="fas fa-save"></i>
                            حفظ التعديلات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

