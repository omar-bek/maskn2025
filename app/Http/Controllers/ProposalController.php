<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Proposal;
use App\Models\Tender;
use App\Models\TenderItem;
use App\Models\ProposalItem;

class ProposalController extends Controller
{
    /**
     * Display a listing of proposals for a consultant
     */
    public function index()
    {
        $proposals = Proposal::with(['tender.design', 'tender.client'])
                            ->where('consultant_id', Auth::id())
                            ->orderBy('created_at', 'desc')
                            ->paginate(12);

        return view('proposals.index', compact('proposals'));
    }

    /**
     * Show the form for creating a new proposal
     */
    public function create($tenderId)
    {
        $tender = Tender::with(['design', 'client', 'tenderItems.category'])
                        ->findOrFail($tenderId);

        // Check if tender is still open
        if (!$tender->isOpen()) {
            abort(403, 'هذه المناقصة مغلقة أو منتهية الصلاحية');
        }

        // Check if consultant already submitted a proposal
        $existingProposal = $tender->proposals()
                                  ->where('consultant_id', Auth::id())
                                  ->first();

        if ($existingProposal) {
            return redirect()->route('proposals.edit', $existingProposal->id)
                            ->with('info', 'لقد قدمت عرضاً على هذه المناقصة بالفعل');
        }

        // Group tender items by category
        $itemsByCategory = $tender->tenderItems()->with('category')->get()->groupBy('category.category_name');

        return view('proposals.create', compact('tender', 'itemsByCategory'));
    }

    /**
     * Store a newly created proposal
     */
    public function store(Request $request, $tenderId)
    {
        $tender = Tender::findOrFail($tenderId);

        // Check if tender is still open
        if (!$tender->isOpen()) {
            abort(403, 'هذه المناقصة مغلقة أو منتهية الصلاحية');
        }

        // Check if consultant already submitted a proposal
        $existingProposal = $tender->proposals()
                                  ->where('consultant_id', Auth::id())
                                  ->first();

        if ($existingProposal) {
            return redirect()->route('proposals.edit', $existingProposal->id)
                            ->with('info', 'لقد قدمت عرضاً على هذه المناقصة بالفعل');
        }

        $validated = $request->validate([
            'proposal_text' => 'required|string',
            'duration_months' => 'required|integer|min:1',
            'terms_conditions' => 'nullable|string',
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'item_prices' => 'required|array',
            'item_prices.*' => 'required|numeric|min:0',
            'item_notes' => 'nullable|array',
            'item_notes.*' => 'nullable|string',
            'item_available' => 'nullable|array',
            'item_available.*' => 'boolean',
            'item_names' => 'nullable|array',
            'item_names.*' => 'nullable|string|max:255',
            'item_quantities' => 'nullable|array',
            'item_quantities.*' => 'nullable|numeric|min:0',
            'item_units' => 'nullable|array',
            'item_units.*' => 'nullable|string|max:50',
        ]);

        // Handle file uploads
        $attachments = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $attachments[] = $file->store('proposals/attachments', 'public');
            }
        }

        $proposal = Proposal::create([
            'tender_id' => $tenderId,
            'consultant_id' => Auth::id(),
            'proposal_text' => $validated['proposal_text'],
            'proposed_price' => 0, // Will be calculated from items
            'duration_months' => $validated['duration_months'],
            'terms_conditions' => $validated['terms_conditions'],
            'attachments' => $attachments,
            'status' => 'pending'
        ]);

        // Create proposal items for tender items
        $totalProposalPrice = 0;
        $tenderItems = $tender->tenderItems;
        foreach ($tenderItems as $tenderItem) {
            $itemId = $tenderItem->id;
            $unitPrice = $validated['item_prices'][$itemId] ?? 0;
            $quantity = $tenderItem->quantity ?? 0;
            $totalPrice = $unitPrice * $quantity;
            $isAvailable = $validated['item_available'][$itemId] ?? true;
            $notes = $validated['item_notes'][$itemId] ?? null;

            ProposalItem::create([
                'proposal_id' => $proposal->id,
                'tender_item_id' => $itemId,
                'unit_price' => $unitPrice,
                'total_price' => $totalPrice,
                'notes' => $notes,
                'is_available' => $isAvailable
            ]);

            $totalProposalPrice += $totalPrice;
        }

        // Handle new items (items with keys starting with 'new_')
        foreach ($validated['item_prices'] as $itemKey => $unitPrice) {
            if (strpos($itemKey, 'new_') === 0) {
                // This is a new item
                $quantity = $validated['item_quantities'][$itemKey] ?? 0;
                $totalPrice = $unitPrice * $quantity;
                $isAvailable = $validated['item_available'][$itemKey] ?? true;
                $notes = $validated['item_notes'][$itemKey] ?? null;
                $itemName = $validated['item_names'][$itemKey] ?? 'بند جديد';
                $unit = $validated['item_units'][$itemKey] ?? null;

                // Create a new tender item for this additional item
                $newTenderItem = TenderItem::create([
                    'tender_id' => $tender->id,
                    'category_id' => 1, // Default category for additional items
                    'item_name' => $itemName,
                    'quantity' => $quantity,
                    'unit' => $unit,
                    'description' => $notes,
                    'item_order' => 9999 // High order to appear at the end
                ]);

                // Create proposal item for the new tender item
                ProposalItem::create([
                    'proposal_id' => $proposal->id,
                    'tender_item_id' => $newTenderItem->id,
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                    'notes' => $notes,
                    'is_available' => $isAvailable
                ]);

                $totalProposalPrice += $totalPrice;
            }
        }


        // Update proposal with calculated total price
        $proposal->update(['proposed_price' => $totalProposalPrice]);

        return redirect()->route('tenders.show', $tenderId)
                        ->with('success', 'تم تقديم العرض بنجاح');
    }

    /**
     * Display the specified proposal
     */
    public function show($id)
    {
        $proposal = Proposal::with(['tender.design', 'tender.client', 'consultant', 'proposalItems.tenderItem.category'])
                           ->findOrFail($id);

        // Check if user can view this proposal
        if ($proposal->consultant_id !== Auth::id() &&
            $proposal->tender->client_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بعرض هذا العرض');
        }

        return view('proposals.show', compact('proposal'));
    }

    /**
     * Show the form for editing the specified proposal
     */
    public function edit($id)
    {
        $proposal = Proposal::with(['tender.tenderItems.category', 'proposalItems'])
                           ->findOrFail($id);

        // Check if user is the owner
        if ($proposal->consultant_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بتعديل هذا العرض');
        }

        // Check if tender is still open
        if (!$proposal->tender->isOpen()) {
            abort(403, 'لا يمكن تعديل العرض، المناقصة مغلقة أو منتهية الصلاحية');
        }

        // Group tender items by category
        $itemsByCategory = $proposal->tender->tenderItems()->with('category')->get()->groupBy('category.category_name');

        return view('proposals.edit', compact('proposal', 'itemsByCategory'));
    }

    /**
     * Update the specified proposal
     */
    public function update(Request $request, $id)
    {
        $proposal = Proposal::with(['tender'])
                           ->findOrFail($id);

        // Check if user is the owner
        if ($proposal->consultant_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بتعديل هذا العرض');
        }

        // Check if tender is still open
        if (!$proposal->tender->isOpen()) {
            abort(403, 'لا يمكن تعديل العرض، المناقصة مغلقة أو منتهية الصلاحية');
        }

        $validated = $request->validate([
            'proposal_text' => 'required|string',
            'duration_months' => 'required|integer|min:1',
            'terms_conditions' => 'nullable|string',
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'item_prices' => 'required|array',
            'item_prices.*' => 'required|numeric|min:0',
            'item_notes' => 'nullable|array',
            'item_notes.*' => 'nullable|string',
            'item_available' => 'nullable|array',
            'item_available.*' => 'boolean',
            'item_names' => 'nullable|array',
            'item_names.*' => 'nullable|string|max:255',
            'item_quantities' => 'nullable|array',
            'item_quantities.*' => 'nullable|numeric|min:0',
            'item_units' => 'nullable|array',
            'item_units.*' => 'nullable|string|max:50',
        ]);

        // Handle file uploads
        $attachments = $proposal->attachments ?? [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $attachments[] = $file->store('proposals/attachments', 'public');
            }
        }

        $proposal->update([
            'proposal_text' => $validated['proposal_text'],
            'duration_months' => $validated['duration_months'],
            'terms_conditions' => $validated['terms_conditions'],
            'attachments' => $attachments
        ]);

        // Update proposal items for tender items
        $totalProposalPrice = 0;
        $tenderItems = $proposal->tender->tenderItems;
        foreach ($tenderItems as $tenderItem) {
            $itemId = $tenderItem->id;
            $unitPrice = $validated['item_prices'][$itemId] ?? 0;
            $quantity = $tenderItem->quantity ?? 0;
            $totalPrice = $unitPrice * $quantity;
            $isAvailable = $validated['item_available'][$itemId] ?? true;
            $notes = $validated['item_notes'][$itemId] ?? null;

            ProposalItem::updateOrCreate(
                [
                    'proposal_id' => $proposal->id,
                    'tender_item_id' => $itemId
                ],
                [
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                    'notes' => $notes,
                    'is_available' => $isAvailable
                ]
            );

            $totalProposalPrice += $totalPrice;
        }

        // Handle new items (items with keys starting with 'new_')
        foreach ($validated['item_prices'] as $itemKey => $unitPrice) {
            if (strpos($itemKey, 'new_') === 0) {
                // This is a new item
                $quantity = $validated['item_quantities'][$itemKey] ?? 0;
                $totalPrice = $unitPrice * $quantity;
                $isAvailable = $validated['item_available'][$itemKey] ?? true;
                $notes = $validated['item_notes'][$itemKey] ?? null;
                $itemName = $validated['item_names'][$itemKey] ?? 'بند جديد';
                $unit = $validated['item_units'][$itemKey] ?? null;

                // Create a new tender item for this additional item
                $newTenderItem = TenderItem::create([
                    'tender_id' => $proposal->tender->id,
                    'category_id' => 1, // Default category for additional items
                    'item_name' => $itemName,
                    'quantity' => $quantity,
                    'unit' => $unit,
                    'description' => $notes,
                    'item_order' => 9999 // High order to appear at the end
                ]);

                // Create proposal item for the new tender item
                ProposalItem::create([
                    'proposal_id' => $proposal->id,
                    'tender_item_id' => $newTenderItem->id,
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                    'notes' => $notes,
                    'is_available' => $isAvailable
                ]);

                $totalProposalPrice += $totalPrice;
            }
        }


        // Update proposal with calculated total price
        $proposal->update(['proposed_price' => $totalProposalPrice]);

        return redirect()->route('tenders.show', $proposal->tender_id)
                        ->with('success', 'تم تحديث العرض بنجاح');
    }

    /**
     * Remove the specified proposal
     */
    public function destroy($id)
    {
        $proposal = Proposal::with(['tender'])
                           ->findOrFail($id);

        // Check if user is the owner
        if ($proposal->consultant_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بحذف هذا العرض');
        }

        // Check if tender is still open
        if (!$proposal->tender->isOpen()) {
            abort(403, 'لا يمكن حذف العرض، المناقصة مغلقة أو منتهية الصلاحية');
        }

        // Delete attachments
        if ($proposal->attachments) {
            foreach ($proposal->attachments as $attachment) {
                Storage::disk('public')->delete($attachment);
            }
        }

        $proposal->delete();

        return redirect()->route('tenders.show', $proposal->tender_id)
                        ->with('success', 'تم حذف العرض بنجاح');
    }

    /**
     * Accept a proposal (client action)
     */
    public function accept(Request $request, $id)
    {
        $proposal = Proposal::with(['tender'])
                           ->findOrFail($id);

        // Check if user is the tender owner
        if ($proposal->tender->client_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بقبول هذا العرض');
        }

        $validated = $request->validate([
            'client_notes' => 'nullable|string'
        ]);

        // Update proposal status
        $proposal->update([
            'status' => 'accepted',
            'client_notes' => $validated['client_notes'] ?? null
        ]);

        // Update tender status
        $proposal->tender->update(['status' => 'awarded']);

        // Reject other proposals for this tender
        Proposal::where('tender_id', $proposal->tender_id)
                ->where('id', '!=', $id)
                ->update(['status' => 'rejected']);

        return redirect()->back()
                        ->with('success', 'تم قبول العرض بنجاح');
    }

    /**
     * Reject a proposal (client action)
     */
    public function reject(Request $request, $id)
    {
        $proposal = Proposal::with(['tender'])
                           ->findOrFail($id);

        // Check if user is the tender owner
        if ($proposal->tender->client_id !== Auth::id()) {
            abort(403, 'غير مصرح لك برفض هذا العرض');
        }

        $validated = $request->validate([
            'client_notes' => 'nullable|string'
        ]);

        $proposal->update([
            'status' => 'rejected',
            'client_notes' => $validated['client_notes'] ?? null
        ]);

        return redirect()->back()
                        ->with('success', 'تم رفض العرض بنجاح');
    }


}
