@extends('layouts.app')

@section('title', __('app.edit_profile_page_title'))

@section('content')
    <div class="bg-gray-50 min-h-screen relative mt-10">
        <div class="bg-[#1a262a] h-64 w-full absolute top-0 left-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-[#2f5c69]/30 to-[#f3a446]/10 opacity-50"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-20">
            
            <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-white tracking-wide">{{ __('app.update_profile_title') }}</h1>
                    <p class="text-gray-300 mt-2 text-sm">{{ __('app.update_profile_desc') }}</p>
                </div>
                <a href="{{ route('consultant.profile') }}"
                    class="inline-flex items-center px-5 py-2.5 rounded-xl bg-white/10 text-white border border-white/20 hover:bg-white/20 backdrop-blur-sm transition duration-200">
                    <i class="fas fa-arrow-left mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('app.back_to_profile') }}
                </a>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 text-sm font-bold shadow-lg flex items-center transform hover:scale-[1.01] transition-transform">
                    <i class="fas fa-check-circle text-emerald-500 mr-2 rtl:ml-2 rtl:mr-0 text-xl"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
                <div class="h-1.5 bg-gradient-to-r from-[#2f5c69] via-[#1a262a] to-[#f3a446]"></div>
                
                <form action="{{ route('consultant.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-8 md:p-10 space-y-8">
                    @csrf

                    <div class="flex flex-col md:flex-row items-center gap-8 p-6 bg-[#1a262a]/5 rounded-2xl border border-[#1a262a]/10">
                        @php
                            $avatarUrl = $user->avatar ? asset('storage/' . $user->avatar) : (optional($user->profile)->avatar_url ?? null);
                        @endphp
                        <div class="relative group">
                            <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-xl bg-gray-200 flex items-center justify-center ring-4 ring-[#2f5c69]/10">
                                <img id="avatar-preview" src="{{ $avatarUrl ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=2f5c69&color=fff' }}" 
                                     alt="{{ $user->name }}" class="w-full h-full object-cover">
                            </div>
                            <label class="absolute bottom-1 right-1 rtl:left-1 rtl:right-auto bg-[#f3a446] text-[#1a262a] p-2.5 rounded-full shadow-lg cursor-pointer hover:bg-[#ffb65c] transition duration-200 group-hover:scale-110">
                                <i class="fas fa-camera text-sm"></i>
                                <input type="file" name="avatar" id="avatar-input" accept="image/*" class="hidden">
                            </label>
                        </div>
                        <div class="flex-1 w-full text-center md:text-start">
                            <h3 class="text-lg font-bold text-[#1a262a] mb-1">{{ __('app.profile_picture') }}</h3>
                            <p class="text-sm text-gray-500 mb-4">{{ __('app.upload_constraints') }}</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-[#1a262a] mb-2">{{ __('app.bio') }}</label>
                            <textarea name="bio" rows="4"
                                class="w-full rounded-xl border-gray-200 bg-white focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition duration-200 text-sm text-start shadow-sm resize-none placeholder-gray-300">{{ old('bio', optional($user->profile)->bio_ar ?? (optional($user->profile)->bio ?? '')) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-[#1a262a] mb-2">{{ __('app.specialization') }}</label>
                                <input type="text" name="specialization" value="{{ old('specialization', data_get(optional($user->profile)->specializations, 0) ?? '') }}"
                                    class="w-full rounded-xl border-gray-200 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition duration-200 text-sm shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-[#1a262a] mb-2">{{ __('app.city') }}</label>
                                <input type="text" name="city" value="{{ old('city', $user->city) }}"
                                    class="w-full rounded-xl border-gray-200 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition duration-200 text-sm shadow-sm">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-[#1a262a] mb-2">{{ __('app.phone') }}</label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" dir="ltr"
                                    class="w-full rounded-xl border-gray-200 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition duration-200 text-sm shadow-sm font-mono text-start">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-[#1a262a] mb-2">{{ __('app.whatsapp') }}</label>
                                <input type="text" name="whatsapp" value="{{ old('whatsapp', $user->whatsapp) }}" dir="ltr"
                                    class="w-full rounded-xl border-gray-200 focus:ring-2 focus:ring-[#f3a446] focus:border-[#f3a446] transition duration-200 text-sm shadow-sm font-mono text-start">
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 flex items-center justify-end gap-4 border-t border-gray-100 mt-6">
                        <a href="{{ route('consultant.profile') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border-2 border-gray-100 text-gray-600 font-bold hover:bg-gray-50 transition duration-200">
                            {{ __('app.cancel') }}
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center items-center px-8 py-3 rounded-xl bg-gradient-to-r from-[#f3a446] to-[#f5b05a] text-[#1a262a] font-bold shadow-lg hover:shadow-orange-500/40 hover:-translate-y-0.5 transition duration-200">
                            <i class="fas fa-save mr-2 rtl:ml-2 rtl:mr-0"></i>
                            {{ __('app.save_changes') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('avatar-input');
            const preview = document.getElementById('avatar-preview');

            if (input && preview) {
                input.onchange = function (evt) {
                    const [file] = this.files;
                    if (file) {
                        // كود سحري يخلي المتصفح يقرأ ملف الجهاز ويعرضه فوراً
                        preview.src = URL.createObjectURL(file);
                    }
                }
            }
        });
    </script>
@endsection