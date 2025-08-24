<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    public function create(Project $project)
    {
        $user = Auth::user();

        // Check if user can submit offer for this project
        if (!$this->canSubmitOffer($user, $project)) {
            abort(403, 'لا يمكنك تقديم عرض لهذا المشروع');
        }

        return view('offers.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $user = Auth::user();

        if (!$this->canSubmitOffer($user, $project)) {
            abort(403, 'لا يمكنك تقديم عرض لهذا المشروع');
        }

        $request->validate([
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|min:10',
            'duration_days' => 'nullable|integer|min:1',
            'terms_conditions' => 'nullable|string',
            'attachments.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120'
        ]);

        $attachments = [];

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('offer-files', $fileName, 'public');
                $attachments[] = $filePath;
            }
        }

        $professionalType = $this->getProfessionalType($user);

        Offer::create([
            'project_id' => $project->id,
            'professional_id' => $user->id,
            'professional_type' => $professionalType,
            'price' => $request->price,
            'description' => $request->description,
            'duration_days' => $request->duration_days,
            'terms_conditions' => $request->terms_conditions,
            'attachments' => $attachments,
            'status' => 'pending'
        ]);

        return redirect()->route('projects.show', $project)
            ->with('success', 'تم تقديم العرض بنجاح');
    }

    public function show(Offer $offer)
    {
        $user = Auth::user();

        // Check if user can view this offer
        if (!$this->canViewOffer($user, $offer)) {
            abort(403, 'ليس لديك صلاحية لعرض هذا العرض');
        }

        return view('offers.show', compact('offer'));
    }

    public function respond(Request $request, Offer $offer)
    {
        $user = Auth::user();

        if (!$user->isClient() || $offer->project->client_id !== $user->id) {
            abort(403, 'ليس لديك صلاحية للرد على هذا العرض');
        }

        $request->validate([
            'status' => 'required|in:accepted,rejected',
            'notes' => 'nullable|string'
        ]);

        $offer->update([
            'status' => $request->status,
            'client_notes' => $request->notes,
            'responded_at' => now()
        ]);

        return redirect()->route('projects.show', $offer->project)
            ->with('success', 'تم الرد على العرض بنجاح');
    }

    public function withdraw(Offer $offer)
    {
        $user = Auth::user();

        if ($offer->professional_id !== $user->id) {
            abort(403, 'لا يمكنك سحب هذا العرض');
        }

        $offer->update([
            'status' => 'withdrawn'
        ]);

        return redirect()->route('projects.show', $offer->project)
            ->with('success', 'تم سحب العرض بنجاح');
    }

    private function canSubmitOffer($user, $project)
    {
        // Consultants can submit offers to published projects
        if ($user->isConsultant() && $project->status === 'published') {
            return true;
        }

        // Contractors can submit offers to contractor bidding projects
        if ($user->isContractor() && $project->status === 'contractor_bidding') {
            return true;
        }

        // Suppliers can submit offers to supplier bidding projects
        if ($user->isSupplier() && $project->status === 'supplier_bidding') {
            return true;
        }

        return false;
    }

    private function canViewOffer($user, $offer)
    {
        // Client can view offers for their projects
        if ($user->isClient() && $offer->project->client_id === $user->id) {
            return true;
        }

        // Professional can view their own offers
        if ($offer->professional_id === $user->id) {
            return true;
        }

        return false;
    }

    private function getProfessionalType($user)
    {
        if ($user->isConsultant()) {
            return 'consultant';
        } elseif ($user->isContractor()) {
            return 'contractor';
        } elseif ($user->isSupplier()) {
            return 'supplier';
        }

        abort(403, 'نوع المستخدم غير صحيح');
    }
}
