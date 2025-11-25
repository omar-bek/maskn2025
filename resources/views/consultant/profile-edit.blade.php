@extends('layouts.app')

@section('title', 'تعديل الملف الشخصي')

@section('content')
    <div class="bg-[#1a262a] min-h-screen py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-white">تحديث الملف الشخصي</h1>
                    <p class="text-gray-300 mt-2">قم برفع صورة جديدة وضبط بيانات تواصلك وتخصصك.</p>
                </div>
                <a href="{{ route('consultant.profile') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/10 text-white border border-white/30 hover:bg-white/20 transition">
                    <i class="fas fa-arrow-left"></i>
                    العودة للملف
                </a>
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

            <div class="bg-white rounded-3xl shadow-2xl p-8">
                <form action="{{ route('consultant.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="flex items-center gap-4">
                        @php
                            $avatarUrl = $user->avatar_url ?? optional($user->profile)->avatar_url;
                        @endphp
                        <div class="w-24 h-24 rounded-2xl overflow-hidden border-2 border-[#2f5c69]/20 bg-gray-100 flex items-center justify-center">
                            @if ($avatarUrl)
                                <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-2xl font-bold text-[#2f5c69]">{{ Str::substr($user->name, 0, 2) }}</span>
                            @endif
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-semibold text-[#1a262a] mb-2">صورة الملف الشخصي</label>
                            <input type="file" name="avatar" accept="image/*"
                                class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-[#f3a446]/90 file:text-[#1a262a] hover:file:bg-[#f5b05a] border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#f3a446] focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">الأنواع المسموح بها: JPG, PNG, WebP بحد أقصى 4 ميجابايت.</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-[#1a262a] mb-2">النبذة التعريفية</label>
                        <textarea name="bio" rows="4"
                            class="w-full rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2f5c69] focus:border-transparent text-sm text-right">{{ old('bio', optional($user->profile)->bio_ar ?? (optional($user->profile)->bio ?? '')) }}</textarea>
                    </div>

                    @php
                        $currentSpecialization = data_get(optional($user->profile)->specializations, 0);
                    @endphp
                    <div>
                        <label class="block text-sm font-semibold text-[#1a262a] mb-2">التخصص</label>
                        <input type="text" name="specialization" value="{{ old('specialization', $currentSpecialization ?? '') }}"
                            class="w-full rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2f5c69] focus:border-transparent text-sm text-right">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-[#1a262a] mb-2">المدينة</label>
                        <input type="text" name="city" value="{{ old('city', $user->city) }}"
                            class="w-full rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2f5c69] focus:border-transparent text-sm text-right">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-[#1a262a] mb-2">رقم الهاتف</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                class="w-full rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2f5c69] focus:border-transparent text-sm text-right">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#1a262a] mb-2">واتساب</label>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp', $user->whatsapp) }}"
                                class="w-full rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#2f5c69] focus:border-transparent text-sm text-right">
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('consultant.profile') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-50 transition">
                            إلغاء
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center items-center gap-2 px-6 py-3 rounded-xl bg-[#f3a446] text-[#1a262a] font-semibold hover:bg-[#f5b05a] transition">
                            <i class="fas fa-save"></i>
                            حفظ التعديلات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

