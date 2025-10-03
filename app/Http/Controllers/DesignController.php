<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
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
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'pricing' => 'nullable|array'
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
        $design = Design::with(['items.category', 'consultant'])
                        ->published()
                        ->findOrFail($id);

        $itemsByCategory = $design->items()->with('category')->get()->groupBy('category.category_name');
        $totalAmount = $design->items()->sum('total_price');

        // Get category totals
        $categoryTotals = $design->items()
                                ->join('categories', 'items.category_id', '=', 'categories.id')
                                ->selectRaw('categories.id, categories.category_name, categories.category_order, SUM(items.total_price) as total')
                                ->groupBy('categories.id', 'categories.category_name', 'categories.category_order')
                                ->orderBy('categories.category_order')
                                ->get();

        return view('designs.show-with-pricing', compact('design', 'itemsByCategory', 'totalAmount', 'categoryTotals'));
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


