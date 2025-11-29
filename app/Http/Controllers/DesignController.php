<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Note: Project model import removed as it doesn't exist
use App\Models\Design;
use App\Models\Category;
use App\Models\Item;

class DesignController extends Controller
{
    public function index()
    {
        $designs = Design::with('consultant')
            ->published()
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('designs.index', compact('designs'));
    }

    public function show($id)
    {
        $design = Design::with(['consultant', 'items.category'])
            ->published()
            ->findOrFail($id);

        // Increment views count
        $design->increment('views_count');

        return view('designs.show', compact('design'));
    }

    public function create()
    {
        $categories = Category::ordered()->get();
        return view('designs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'style' => 'required|string|max:100',
            'price' => 'required|numeric|min:0|max:999999999',
            'area' => 'required|numeric|min:0|max:999999',
            'bedrooms' => 'nullable|integer|min:0|max:50',
            'bathrooms' => 'nullable|integer|min:0|max:50',
            'floors' => 'nullable|integer|min:0|max:20',
            'description' => 'required|string|min:10|max:2000',
            'features' => 'nullable|array|max:20',
            'consultant_name' => 'required|string|max:255',
            'consultant_phone' => 'nullable|string|max:20|regex:/^[0-9+\-\s()]+$/',
            'consultant_email' => 'nullable|email|max:255',
            'location' => 'nullable|string|max:255',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'pricing' => 'nullable|array'
        ], [
            'title.required' => 'عنوان التصميم مطلوب',
            'title.max' => 'عنوان التصميم يجب أن يكون أقل من 255 حرف',
            'style.required' => 'نوع التصميم مطلوب',
            'price.required' => 'السعر مطلوب',
            'price.min' => 'السعر يجب أن يكون أكبر من 0',
            'price.max' => 'السعر كبير جداً',
            'area.required' => 'المساحة مطلوبة',
            'area.min' => 'المساحة يجب أن تكون أكبر من 0',
            'description.required' => 'وصف التصميم مطلوب',
            'description.min' => 'وصف التصميم يجب أن يكون 10 أحرف على الأقل',
            'main_image.required' => 'الصورة الرئيسية مطلوبة',
            'main_image.image' => 'يجب أن تكون الصورة من نوع صورة',
            'main_image.mimes' => 'نوع الصورة غير مدعوم',
            'main_image.max' => 'حجم الصورة كبير جداً (الحد الأقصى 5 ميجابايت)',
        ]);

        // Handle file uploads
        $mainImagePath = null;
        $additionalImages = [];

        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->store('designs/images', 'public');
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $additionalImages[] = $image->store('designs/images', 'public');
            }
        }

        // Create design
        $design = Design::create([
            'consultant_id' => Auth::id() ?? 1,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'style' => $validated['style'],
            'area' => $validated['area'],
            'location' => $validated['location'] ?? 'غير محدد',
            'price' => $validated['price'],
            'bedrooms' => $validated['bedrooms'] ?? 0,
            'bathrooms' => $validated['bathrooms'] ?? 0,
            'floors' => $validated['floors'] ?? 1,
            'features' => $validated['features'] ?? [],
            'consultant_name' => $validated['consultant_name'],
            'consultant_phone' => $validated['consultant_phone'],
            'consultant_email' => $validated['consultant_email'],
            'main_image' => $mainImagePath,
            'images' => $additionalImages,
            'status' => 'published' // Auto-publish consultant designs
        ]);

        // Handle pricing data if provided
        if (isset($validated['pricing']) && is_array($validated['pricing'])) {
            foreach ($validated['pricing'] as $categoryId => $categoryItems) {
                if (is_array($categoryItems)) {
                    foreach ($categoryItems as $index => $itemData) {
                        if (!empty($itemData['item_name'])) {
                            Item::create([
                                'design_id' => $design->id,
                                'category_id' => $categoryId,
                                'item_name' => $itemData['item_name'],
                                'quantity' => $itemData['quantity'] ?? 0,
                                'unit' => $itemData['unit'] ?? '',
                                'unit_price' => $itemData['unit_price'] ?? 0,
                                'total_price' => ($itemData['quantity'] ?? 0) * ($itemData['unit_price'] ?? 0),
                                'item_order' => $index + 1
                            ]);
                        }
                    }
                }
            }
        }

        return redirect()->route('designs.index')
            ->with('success', 'تم إنشاء التصميم بنجاح');
    }

    /**
     * Show project design with detailed pricing
     */
    public function showWithPricing($id)
    {
        try {
            $design = Design::with(['items.category', 'consultant'])
                ->published()
                ->findOrFail($id);

            // Get items with category, filter out items without category
            $items = $design->items()->with('category')->get();
            
            // Group by category name, handling null categories
            $itemsByCategory = $items->filter(function ($item) {
                return $item->category !== null;
            })->groupBy(function ($item) {
                return $item->category ? $item->category->category_name : 'غير مصنف';
            });

            // Ensure it's always a collection
            if (!$itemsByCategory) {
                $itemsByCategory = collect();
            }

            $totalAmount = $design->items()->sum('total_price') ?? 0;

            // Get category totals
            $categoryTotals = $design->items()
                ->join('categories', 'items.category_id', '=', 'categories.id')
                ->selectRaw('categories.id, categories.category_name, categories.category_order, SUM(items.total_price) as total')
                ->groupBy('categories.id', 'categories.category_name', 'categories.category_order')
                ->orderBy('categories.category_order')
                ->get();

            // Ensure categoryTotals is always a collection
            if (!$categoryTotals) {
                $categoryTotals = collect();
            }

            return view('designs.show-with-pricing', compact('design', 'itemsByCategory', 'totalAmount', 'categoryTotals'));
        } catch (\Exception $e) {
            return redirect()->route('designs.index')
                ->with('error', 'حدث خطأ أثناء تحميل صفحة التسعير: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified design
     */
    public function edit($id)
    {
        $design = Design::findOrFail($id);

        // Check if user is the owner
        if ($design->consultant_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بتعديل هذا التصميم');
        }

        $categories = Category::ordered()->get();

        return view('designs.edit', compact('design', 'categories'));
    }

    /**
     * Update the specified design
     */
    public function update(Request $request, $id)
    {
        $design = Design::findOrFail($id);

        // Check if user is the owner
        if ($design->consultant_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بتعديل هذا التصميم');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'style' => 'required|string',
            'price' => 'required|numeric|min:0',
            'area' => 'required|numeric|min:0',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'floors' => 'nullable|integer|min:0',
            'description' => 'required|string',
            'features' => 'nullable|array',
            'consultant_name' => 'required|string|max:255',
            'consultant_phone' => 'nullable|string|max:20',
            'consultant_email' => 'nullable|email',
            'location' => 'nullable|string|max:255',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'pricing' => 'nullable|array'
        ]);

        // Handle image uploads
        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request->file('main_image')->store('designs/images', 'public');
        }

        if ($request->hasFile('images')) {
            $additionalImages = [];
            foreach ($request->file('images') as $image) {
                $additionalImages[] = $image->store('designs/images', 'public');
            }
            $validated['images'] = $additionalImages;
        }

        // Update design
        $design->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'style' => $validated['style'],
            'area' => $validated['area'],
            'location' => $validated['location'] ?? $design->location,
            'price' => $validated['price'],
            'bedrooms' => $validated['bedrooms'] ?? $design->bedrooms,
            'bathrooms' => $validated['bathrooms'] ?? $design->bathrooms,
            'floors' => $validated['floors'] ?? $design->floors,
            'features' => $validated['features'] ?? $design->features,
            'consultant_name' => $validated['consultant_name'],
            'consultant_phone' => $validated['consultant_phone'],
            'consultant_email' => $validated['consultant_email'],
            'main_image' => $validated['main_image'] ?? $design->main_image,
            'images' => $validated['images'] ?? $design->images,
        ]);

        // Update pricing items if provided
        if (isset($validated['pricing']) && is_array($validated['pricing'])) {
            // Delete existing items
            $design->items()->delete();

            // Create new items
            foreach ($validated['pricing'] as $categoryId => $categoryItems) {
                if (is_array($categoryItems)) {
                    foreach ($categoryItems as $index => $itemData) {
                        if (!empty($itemData['item_name'])) {
                            Item::create([
                                'design_id' => $design->id,
                                'category_id' => $categoryId,
                                'item_name' => $itemData['item_name'],
                                'quantity' => $itemData['quantity'] ?? 0,
                                'unit' => $itemData['unit'] ?? '',
                                'unit_price' => $itemData['unit_price'] ?? 0,
                                'total_price' => ($itemData['quantity'] ?? 0) * ($itemData['unit_price'] ?? 0),
                                'item_order' => $index + 1
                            ]);
                        }
                    }
                }
            }
        }

        return redirect()->route('designs.show', $design->id)
            ->with('success', 'تم تحديث التصميم بنجاح');
    }

    /**
     * Remove the specified design
     */
    public function destroy($id)
    {
        $design = Design::findOrFail($id);

        // Check if user is the owner
        if ($design->consultant_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بحذف هذا التصميم');
        }

        // Delete associated items first
        $design->items()->delete();

        // Delete design
        $design->delete();

        return redirect()->route('designs.index')
            ->with('success', 'تم حذف التصميم بنجاح');
    }
}
