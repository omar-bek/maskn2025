@extends('layouts.app')

@section('title', $design['title'] . ' - انشاءات')

@section('content')
    <!-- Breadcrumb -->
    <section class="bg-gray-100 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center space-x-2 space-x-reverse text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-blue-600">الرئيسية</a>
                <i class="fas fa-chevron-left text-gray-400"></i>
                <a href="{{ route('designs.index') }}" class="text-gray-500 hover:text-blue-600">التصاميم</a>
                <i class="fas fa-chevron-left text-gray-400"></i>
                <span class="text-gray-900">{{ $design['title'] }}</span>
            </nav>
        </div>
    </section>

    <!-- Design Details -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Main Image -->
                    <div class="bg-gray-200 h-96 rounded-lg mb-6 flex items-center justify-center">
                        <i class="fas fa-home text-6xl text-gray-400"></i>
                    </div>

                    <!-- Image Gallery -->
                    <div class="grid grid-cols-3 gap-4 mb-8">
                        @foreach ($design['images'] as $image)
                            <div class="bg-gray-200 h-24 rounded-lg flex items-center justify-center">
                                <i class="fas fa-image text-2xl text-gray-400"></i>
                            </div>
                        @endforeach
                    </div>

                    <!-- Description -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">وصف التصميم</h2>
                        <p class="text-gray-600 leading-relaxed">{{ $design['description'] }}</p>
                    </div>

                    <!-- Features -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">المميزات</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @php
                                $features =
                                    is_array($design->features)
                                        ? $design->features
                                        : json_decode($design->features ?? '[]', true) ?:
                                    [];
                            @endphp
                            @foreach ($features as $feature)
                                <div class="flex items-center">
                                    <i class="fas fa-check text-green-500 ml-3"></i>
                                    <span class="text-gray-700">{{ $feature }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Specifications -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">المواصفات</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="text-center p-4 bg-gray-50 rounded-lg">
                                <i class="fas fa-bed text-2xl text-blue-600 mb-2"></i>
                                <div class="text-2xl font-bold text-gray-900">{{ $design['bedrooms'] }}</div>
                                <div class="text-gray-600">غرف نوم</div>
                            </div>
                            <div class="text-center p-4 bg-gray-50 rounded-lg">
                                <i class="fas fa-bath text-2xl text-blue-600 mb-2"></i>
                                <div class="text-2xl font-bold text-gray-900">{{ $design['bathrooms'] }}</div>
                                <div class="text-gray-600">حمامات</div>
                            </div>
                            <div class="text-center p-4 bg-gray-50 rounded-lg">
                                <i class="fas fa-building text-2xl text-blue-600 mb-2"></i>
                                <div class="text-2xl font-bold text-gray-900">{{ $design['floors'] }}</div>
                                <div class="text-gray-600">طوابق</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Price Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6 sticky top-4">
                        <div class="text-center mb-6">
                            <div class="text-3xl font-bold text-green-600 mb-2">{{ $design['price'] }} ريال</div>
                            <div class="text-gray-600">سعر التصميم</div>
                        </div>

                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">المساحة:</span>
                                <span class="font-semibold">{{ $design['area'] }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">النمط:</span>
                                <span
                                    class="bg-teal-100 text-teal-800 px-2 py-1 rounded text-sm">{{ $design['style'] }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">المصمم:</span>
                                <span class="font-semibold">{{ $design['architect'] }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">التقييم:</span>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400 ml-1"></i>
                                    <span class="font-semibold">{{ $design['rating'] }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <button
                                class="w-full bg-teal-600 text-white py-3 rounded-lg font-semibold hover:bg-teal-700 transition duration-300">
                                <i class="fas fa-calculator ml-2"></i>
                                احسب التكلفة
                            </button>
                            <button
                                class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-300">
                                <i class="fas fa-phone ml-2"></i>
                                تواصل مع المصمم
                            </button>
                            <button
                                class="w-full border border-gray-300 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-50 transition duration-300">
                                <i class="fas fa-heart ml-2"></i>
                                أضف للمفضلة
                            </button>

                            @auth
                                @if (auth()->user()->isConsultant() && auth()->id() == $design->consultant_id)
                                    <div class="border-t pt-3 mt-3">
                                        <button onclick="editDesign()"
                                            class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 mb-2">
                                            <i class="fas fa-edit ml-2"></i>
                                            تعديل التصميم
                                        </button>
                                        <button onclick="deleteDesign()"
                                            class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition duration-300">
                                            <i class="fas fa-trash ml-2"></i>
                                            حذف التصميم
                                        </button>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>

                    <!-- Designer Info -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">معلومات المصمم</h3>
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center ml-3">
                                <i class="fas fa-user text-teal-600"></i>
                            </div>
                            <div>
                                <div class="font-semibold">{{ $design['architect'] }}</div>
                                <div class="text-gray-600 text-sm">مصمم معماري</div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-star text-yellow-400 ml-2"></i>
                                <span>4.8 تقييم</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-home ml-2"></i>
                                <span>15 تصميم</span>
                            </div>
                        </div>
                    </div>

                    <!-- Similar Designs -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">تصاميم مشابهة</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center ml-3">
                                    <i class="fas fa-home text-gray-400"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="font-semibold text-sm">فيلا عصرية</div>
                                    <div class="text-green-600 text-sm">400,000 ريال</div>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center ml-3">
                                    <i class="fas fa-home text-gray-400"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="font-semibold text-sm">بيت إسلامي</div>
                                    <div class="text-green-600 text-sm">300,000 ريال</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cost Calculator Modal -->
    <div id="costModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-md w-full p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">حاسبة التكلفة</h3>
                    <button onclick="closeCostModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">المساحة (متر مربع)</label>
                        <input type="number"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">نوع البناء</label>
                        <select
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="economy">اقتصادي</option>
                            <option value="standard">عادي</option>
                            <option value="luxury">فاخر</option>
                        </select>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">1,200,000 ريال</div>
                            <div class="text-gray-600">التكلفة التقديرية</div>
                        </div>
                    </div>
                    <button class="w-full bg-teal-600 text-white py-2 rounded-lg font-semibold hover:bg-teal-700">
                        احسب التكلفة
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openCostModal() {
            document.getElementById('costModal').classList.remove('hidden');
        }

        function closeCostModal() {
            document.getElementById('costModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('costModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCostModal();
            }
        });

        // Edit design function
        function editDesign() {
            window.location.href = '{{ route('designs.edit', $design->id) }}';
        }

        // Delete design function
        function deleteDesign() {
            if (confirm('هل أنت متأكد من حذف هذا التصميم؟ لا يمكن التراجع عن هذا الإجراء.')) {
                // Create form and submit
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('designs.destroy', $design->id) }}';

                // Add CSRF token
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);

                // Add method override
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';
                form.appendChild(methodField);

                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endsection
