<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tender;
use App\Models\Design;
use App\Models\Proposal;
use App\Models\TenderItem;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel;

class TenderController extends Controller
{
    /**
     * Display a listing of tenders
     */
    public function index()
    {
        $tenders = Tender::with(['client', 'design', 'proposals'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('tenders.index', compact('tenders'));
    }

    /**
     * Show the form for creating a new tender
     */
    public function create()
    {
        $designs = Design::published()->get();
        return view('tenders.create', compact('designs'));
    }

    /**
     * Show the form for creating a new tender from a specific design
     */
    public function createFromDesign($designId)
    {
        $design = Design::with(['consultant', 'items.category'])->published()->findOrFail($designId);
        return view('tenders.create-from-design', compact('design'));
    }

    /**
     * Store a newly created tender
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'design_id' => 'required|exists:designs,id',
            'title' => 'required|string|max:255|min:5',
            'description' => 'required|string|min:20|max:2000',
            'requirements' => 'nullable|string|max:1000',
            'budget' => 'nullable|numeric|min:0|max:999999999',
            'location' => 'required|string|max:255|min:3',
            'deadline' => 'required|date|after:today|before:+1 year',
            'client_notes' => 'nullable|string|max:1000',
        ], [
            'design_id.required' => 'التصميم مطلوب',
            'design_id.exists' => 'التصميم المحدد غير موجود',
            'title.required' => 'عنوان المناقصة مطلوب',
            'title.min' => 'عنوان المناقصة يجب أن يكون 5 أحرف على الأقل',
            'title.max' => 'عنوان المناقصة يجب أن يكون أقل من 255 حرف',
            'description.required' => 'وصف المناقصة مطلوب',
            'description.min' => 'وصف المناقصة يجب أن يكون 20 حرف على الأقل',
            'description.max' => 'وصف المناقصة يجب أن يكون أقل من 2000 حرف',
            'location.required' => 'الموقع مطلوب',
            'location.min' => 'الموقع يجب أن يكون 3 أحرف على الأقل',
            'deadline.required' => 'تاريخ الإغلاق مطلوب',
            'deadline.after' => 'تاريخ الإغلاق يجب أن يكون بعد اليوم',
            'deadline.before' => 'تاريخ الإغلاق يجب أن يكون خلال سنة من الآن',
            'budget.min' => 'الميزانية يجب أن تكون أكبر من 0',
            'budget.max' => 'الميزانية كبيرة جداً',
        ]);

        $tender = Tender::create([
            'client_id' => Auth::id(),
            'design_id' => $validated['design_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'requirements' => $validated['requirements'],
            'budget' => $validated['budget'],
            'location' => $validated['location'],
            'deadline' => $validated['deadline'],
            'client_notes' => $validated['client_notes'],
            'status' => 'open'
        ]);

        // Copy design items to tender items
        $design = Design::with('items.category')->findOrFail($validated['design_id']);
        foreach ($design->items as $item) {
            TenderItem::create([
                'tender_id' => $tender->id,
                'category_id' => $item->category_id,
                'item_name' => $item->item_name,
                'quantity' => $item->quantity,
                'unit' => $item->unit,
                'description' => $item->notes,
                'item_order' => $item->item_order ?? 0
            ]);
        }

        return redirect()->route('tenders.show', $tender->id)
            ->with('success', 'تم إنشاء المناقصة بنجاح');
    }

    /**
     * Display the specified tender
     */
    public function show($id)
    {
        $tender = Tender::with(['client', 'design', 'proposals.consultant', 'tenderItems.category'])
            ->findOrFail($id);

        // Increment views count
        $tender->increment('views_count');

        // Check if current user has already submitted a proposal
        $userProposal = null;
        if (Auth::check() && Auth::user()->userType && Auth::user()->userType->name === 'consultant') {
            $userProposal = $tender->proposals()
                ->with(['proposalItems.tenderItem.category'])
                ->where('consultant_id', Auth::id())
                ->first();
        }

        // Group design items by category (instead of tender items)
        $itemsByCategory = $tender->design->items()->with('category')->get()->groupBy('category.category_name');

        // Debug: Log items data
        \Illuminate\Support\Facades\Log::info('Items by category:', $itemsByCategory->toArray());

        return view('tenders.show', compact('tender', 'userProposal', 'itemsByCategory'));
    }

    /**
     * Show the form for editing the specified tender
     */
    public function edit($id)
    {
        $tender = Tender::findOrFail($id);

        // Check if user is the owner
        if ($tender->client_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بتعديل هذه المناقصة');
        }

        $designs = Design::published()->get();

        return view('tenders.edit', compact('tender', 'designs'));
    }

    /**
     * Update the specified tender
     */
    public function update(Request $request, $id)
    {
        $tender = Tender::findOrFail($id);

        // Check if user is the owner
        if ($tender->client_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بتعديل هذه المناقصة');
        }

        $validated = $request->validate([
            'design_id' => 'required|exists:designs,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
            'location' => 'required|string|max:255',
            'deadline' => 'required|date|after:today',
            'client_notes' => 'nullable|string',
        ]);

        $tender->update($validated);

        return redirect()->route('tenders.show', $tender->id)
            ->with('success', 'تم تحديث المناقصة بنجاح');
    }

    /**
     * Remove the specified tender
     */
    public function destroy($id)
    {
        $tender = Tender::findOrFail($id);

        // Check if user is the owner
        if ($tender->client_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بحذف هذه المناقصة');
        }

        // Delete associated proposals first
        $tender->proposals()->delete();

        // Delete tender
        $tender->delete();

        return redirect()->route('tenders.index')
            ->with('success', 'تم حذف المناقصة بنجاح');
    }

    /**
     * Close a tender
     */
    public function close($id)
    {
        $tender = Tender::findOrFail($id);

        // Check if user is the owner
        if ($tender->client_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بإغلاق هذه المناقصة');
        }

        $tender->update(['status' => 'closed']);

        return redirect()->back()
            ->with('success', 'تم إغلاق المناقصة بنجاح');
    }

    /**
     * Award a tender to a specific proposal
     */
    public function award(Request $request, $id)
    {
        $tender = Tender::findOrFail($id);

        // Check if user is the owner
        if ($tender->client_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بمنح هذه المناقصة');
        }

        $validated = $request->validate([
            'proposal_id' => 'required|exists:proposals,id'
        ]);

        // Update tender status
        $tender->update(['status' => 'awarded']);

        // Update proposal status
        Proposal::where('id', $validated['proposal_id'])
            ->update(['status' => 'accepted']);

        // Reject other proposals
        Proposal::where('tender_id', $id)
            ->where('id', '!=', $validated['proposal_id'])
            ->update(['status' => 'rejected']);

        return redirect()->back()
            ->with('success', 'تم منح المناقصة بنجاح');
    }

    /**
     * Show proposals comparison for a tender
     */
    public function compareProposals($id)
    {
        $tender = Tender::with([
            'design.items.category',
            'tenderItems.category',
            'proposals.consultant',
            'proposals.proposalItems.tenderItem'
        ])->findOrFail($id);

        // Check if user is the tender owner
        if ($tender->client_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بعرض مقارنة العروض');
        }

        // Group tender items by category (البنود من المناقصة + البنود الإضافية من العروض)
        $allTenderItems = $tender->tenderItems()->with('category')->get();

        // إضافة البنود الإضافية من العروض (التي أنشأها الاستشاريون)
        foreach ($tender->proposals as $proposal) {
            foreach ($proposal->proposalItems as $proposalItem) {
                if ($proposalItem->tenderItem && !$allTenderItems->contains('id', $proposalItem->tenderItem->id)) {
                    $allTenderItems->push($proposalItem->tenderItem);
                }
            }
        }

        $itemsByCategory = $allTenderItems->groupBy('category.category_name');

        return view('tenders.compare-proposals', compact('tender', 'itemsByCategory'));
    }

    /**
     * Export proposals comparison to PDF
     */
    public function exportPdf($id)
    {
        $tender = Tender::with([
            'design.items.category',
            'tenderItems.category',
            'proposals.consultant',
            'proposals.proposalItems.tenderItem'
        ])->findOrFail($id);

        // Check if user is the tender owner
        if ($tender->client_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بتصدير مقارنة العروض');
        }

        // Group tender items by category (البنود من المناقصة + البنود الإضافية من العروض)
        $allTenderItems = $tender->tenderItems()->with('category')->get();

        // إضافة البنود الإضافية من العروض (التي أنشأها الاستشاريون)
        foreach ($tender->proposals as $proposal) {
            foreach ($proposal->proposalItems as $proposalItem) {
                if ($proposalItem->tenderItem && !$allTenderItems->contains('id', $proposalItem->tenderItem->id)) {
                    $allTenderItems->push($proposalItem->tenderItem);
                }
            }
        }

        $itemsByCategory = $allTenderItems->groupBy('category.category_name');

        $pdf = PDF::loadView('tenders.export-pdf', compact('tender', 'itemsByCategory'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('مقارنة_العروض_' . $tender->title . '_' . date('Y-m-d') . '.pdf');
    }

    /**
     * Export proposals comparison to Excel
     */
    public function exportExcel($id)
    {
        $tender = Tender::with([
            'design.items.category',
            'tenderItems.category',
            'proposals.consultant',
            'proposals.proposalItems.tenderItem'
        ])->findOrFail($id);

        // Check if user is the tender owner
        if ($tender->client_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بتصدير مقارنة العروض');
        }

        // Group tender items by category (البنود من المناقصة + البنود الإضافية من العروض)
        $allTenderItems = $tender->tenderItems()->with('category')->get();

        // إضافة البنود الإضافية من العروض (التي أنشأها الاستشاريون)
        foreach ($tender->proposals as $proposal) {
            foreach ($proposal->proposalItems as $proposalItem) {
                if ($proposalItem->tenderItem && !$allTenderItems->contains('id', $proposalItem->tenderItem->id)) {
                    $allTenderItems->push($proposalItem->tenderItem);
                }
            }
        }

        $itemsByCategory = $allTenderItems->groupBy('category.category_name');

        return Excel::download(
            new \App\Exports\ProposalsComparisonExport($tender, $itemsByCategory),
            'مقارنة_العروض_' . $tender->title . '_' . date('Y-m-d') . '.xlsx'
        );
    }
}
