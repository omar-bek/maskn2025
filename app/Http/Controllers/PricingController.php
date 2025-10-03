<?php

namespace App\Http\Controllers;

use App\Models\Design;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PricingController extends Controller
{
    /**
     * Display the pricing page for a design
     */
    public function show($designId)
    {
        $design = Design::with(['items.category'])->findOrFail($designId);
        
        // Group items by category
        $itemsByCategory = $design->items->groupBy('category.category_name');
        
        // Calculate totals
        $totalCost = $design->items->sum('total_price');
        $totalItems = $design->items->count();
        
        return view('pricing.show', compact('design', 'itemsByCategory', 'totalCost', 'totalItems'));
    }

    /**
     * Show the form for creating a new pricing item
     */
    public function create($designId)
    {
        $design = Design::findOrFail($designId);
        $categories = Category::all();
        
        return view('pricing.create', compact('design', 'categories'));
    }

    /**
     * Store a newly created pricing item
     */
    public function store(Request $request, $designId)
    {
        $design = Design::findOrFail($designId);
        
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'nullable|string|max:50',
            'unit_price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        // Calculate total price
        $totalPrice = $validated['quantity'] * $validated['unit_price'];

        // Create the item
        Item::create([
            'design_id' => $design->id,
            'category_id' => $validated['category_id'],
            'item_name' => $validated['item_name'],
            'quantity' => $validated['quantity'],
            'unit' => $validated['unit'],
            'unit_price' => $validated['unit_price'],
            'total_price' => $totalPrice,
            'notes' => $validated['notes'],
            'item_order' => $design->items()->max('item_order') + 1,
        ]);

        return redirect()->route('designs.pricing.show', $design->id)
                        ->with('success', 'تم إضافة البند بنجاح');
    }

    /**
     * Show the form for editing a pricing item
     */
    public function edit($designId, $itemId)
    {
        $design = Design::findOrFail($designId);
        $item = Item::where('design_id', $design->id)->findOrFail($itemId);
        $categories = Category::all();
        
        return view('pricing.edit', compact('design', 'item', 'categories'));
    }

    /**
     * Update the specified pricing item
     */
    public function update(Request $request, $designId, $itemId)
    {
        $design = Design::findOrFail($designId);
        $item = Item::where('design_id', $design->id)->findOrFail($itemId);
        
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'nullable|string|max:50',
            'unit_price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        // Calculate total price
        $totalPrice = $validated['quantity'] * $validated['unit_price'];

        // Update the item
        $item->update([
            'category_id' => $validated['category_id'],
            'item_name' => $validated['item_name'],
            'quantity' => $validated['quantity'],
            'unit' => $validated['unit'],
            'unit_price' => $validated['unit_price'],
            'total_price' => $totalPrice,
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('designs.pricing.show', $design->id)
                        ->with('success', 'تم تحديث البند بنجاح');
    }

    /**
     * Remove the specified pricing item
     */
    public function destroy($designId, $itemId)
    {
        $design = Design::findOrFail($designId);
        $item = Item::where('design_id', $design->id)->findOrFail($itemId);
        
        $item->delete();

        return redirect()->route('designs.pricing.show', $design->id)
                        ->with('success', 'تم حذف البند بنجاح');
    }

    /**
     * Display pricing summary
     */
    public function summary($designId)
    {
        $design = Design::with(['items.category'])->findOrFail($designId);
        
        // Group items by category with totals
        $itemsByCategory = $design->items->groupBy('category.category_name')
            ->map(function ($items) {
                return [
                    'items' => $items,
                    'total' => $items->sum('total_price'),
                    'count' => $items->count()
                ];
            });
        
        // Calculate overall totals
        $totalCost = $design->items->sum('total_price');
        $totalItems = $design->items->count();
        $categoriesCount = $itemsByCategory->count();
        
        return view('pricing.summary', compact('design', 'itemsByCategory', 'totalCost', 'totalItems', 'categoriesCount'));
    }
}

