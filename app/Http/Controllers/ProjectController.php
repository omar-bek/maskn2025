<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Offer;
use App\Models\ProjectFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isClient()) {
            $projects = $user->clientProjects()->latest()->paginate(10);
        } elseif ($user->isConsultant()) {
            $projects = Project::where('status', 'published')
                ->orWhere('selected_consultant_id', $user->id)
                ->latest()
                ->paginate(10);
        } elseif ($user->isContractor()) {
            $projects = Project::where('status', 'contractor_bidding')
                ->orWhere('selected_contractor_id', $user->id)
                ->latest()
                ->paginate(10);
        } elseif ($user->isSupplier()) {
            $projects = Project::where('status', 'supplier_bidding')
                ->orWhere('selected_supplier_id', $user->id)
                ->latest()
                ->paginate(10);
        } else {
            $projects = collect();
        }

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'property_type' => 'required|in:residential,commercial,villa',
            'style' => 'required|in:modern,classic,traditional',
            'area' => 'required|numeric|min:1',
            'location' => 'required|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
            'estimated_cost' => 'required|numeric|min:0',
            'budget_min' => 'nullable|numeric|min:0',
            'budget_max' => 'nullable|numeric|min:0|gte:budget_min',
        ]);

        $project = Project::create([
            'client_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'property_type' => $request->property_type,
            'style' => $request->style,
            'area' => $request->area,
            'location' => $request->location,
            'neighborhood' => $request->neighborhood,
            'estimated_cost' => $request->estimated_cost,
            'budget_min' => $request->budget_min,
            'budget_max' => $request->budget_max,
            'status' => 'draft'
        ]);

        return redirect()->route('projects.show', $project)
            ->with('success', 'تم إنشاء المشروع بنجاح');
    }

    public function show(Project $project)
    {
        $user = Auth::user();

        // Check if user has access to this project
        if (!$this->canAccessProject($user, $project)) {
            abort(403, 'ليس لديك صلاحية للوصول لهذا المشروع');
        }

        $offers = $project->offers()->with('professional')->get();
        $files = $project->files()->with('uploadedBy')->get();

        return view('projects.show', compact('project', 'offers', 'files'));
    }

    public function publish(Project $project)
    {
        $user = Auth::user();

        if (!$user->isClient() || $project->client_id !== $user->id) {
            abort(403, 'ليس لديك صلاحية لنشر هذا المشروع');
        }

        $project->update([
            'status' => 'published',
            'published_at' => now()
        ]);

        return redirect()->route('projects.show', $project)
            ->with('success', 'تم نشر المشروع بنجاح');
    }

    public function selectConsultant(Project $project, Offer $offer)
    {
        $user = Auth::user();

        if (!$user->isClient() || $project->client_id !== $user->id) {
            abort(403, 'ليس لديك صلاحية لاختيار الاستشاري');
        }

        if ($offer->professional_type !== 'consultant') {
            abort(400, 'هذا العرض ليس من استشاري');
        }

        // Reject all other consultant offers
        $project->consultantOffers()->where('id', '!=', $offer->id)->update(['status' => 'rejected']);

        // Accept the selected offer
        $offer->update(['status' => 'accepted']);

        // Update project status to allow contractors and suppliers to bid
        $project->update([
            'status' => 'contractor_bidding',
            'selected_consultant_id' => $offer->professional_id,
            'consultant_selected_at' => now()
        ]);

        return redirect()->route('projects.show', $project)
            ->with('success', 'تم اختيار الاستشاري بنجاح');
    }

    public function selectContractor(Project $project, Offer $offer)
    {
        $user = Auth::user();

        if (!$user->isClient() || $project->client_id !== $user->id) {
            abort(403, 'ليس لديك صلاحية لاختيار المقاول');
        }

        if ($offer->professional_type !== 'contractor') {
            abort(400, 'هذا العرض ليس من مقاول');
        }

        // Reject all other contractor offers
        $project->contractorOffers()->where('id', '!=', $offer->id)->update(['status' => 'rejected']);

        // Accept the selected offer
        $offer->update(['status' => 'accepted']);

        // Update project status to allow suppliers to bid
        $project->update([
            'status' => 'supplier_bidding',
            'selected_contractor_id' => $offer->professional_id,
            'contractor_selected_at' => now()
        ]);

        return redirect()->route('projects.show', $project)
            ->with('success', 'تم اختيار المقاول بنجاح');
    }

    public function selectSupplier(Project $project, Offer $offer)
    {
        $user = Auth::user();

        if (!$user->isClient() || $project->client_id !== $user->id) {
            abort(403, 'ليس لديك صلاحية لاختيار المورد');
        }

        if ($offer->professional_type !== 'supplier') {
            abort(400, 'هذا العرض ليس من مورد');
        }

        // Reject all other supplier offers
        $project->supplierOffers()->where('id', '!=', $offer->id)->update(['status' => 'rejected']);

        // Accept the selected offer
        $offer->update(['status' => 'accepted']);

        // Update project status to completed since all professionals are selected
        $project->update([
            'status' => 'in_progress',
            'selected_supplier_id' => $offer->professional_id,
            'supplier_selected_at' => now()
        ]);

        return redirect()->route('projects.show', $project)
            ->with('success', 'تم اختيار المورد بنجاح');
    }

    public function uploadDesign(Project $project, Request $request)
    {
        $user = Auth::user();

        if (!$user->isConsultant() || $project->selected_consultant_id !== $user->id) {
            abort(403, 'ليس لديك صلاحية لرفع التصميم');
        }

        $request->validate([
            'design_file' => 'required|file|mimes:pdf,jpg,jpeg,png,zip,rar|max:10240',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $file = $request->file('design_file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('project-files', $fileName, 'public');

        ProjectFile::create([
            'project_id' => $project->id,
            'uploaded_by' => $user->id,
            'file_type' => 'design',
            'original_name' => $file->getClientOriginalName(),
            'file_name' => $fileName,
            'file_path' => $filePath,
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'title' => $request->title,
            'description' => $request->description,
            'visibility' => 'public'
        ]);

        // Update project status
        $project->update([
            'status' => 'design_ready',
            'design_ready_at' => now()
        ]);

        return redirect()->route('projects.show', $project)
            ->with('success', 'تم رفع التصميم بنجاح');
    }

    private function canAccessProject($user, $project)
    {
        // Client can access their own projects
        if ($user->isClient() && $project->client_id === $user->id) {
            return true;
        }

        // Selected professionals can access the project
        if ($project->selected_consultant_id === $user->id ||
            $project->selected_contractor_id === $user->id ||
            $project->selected_supplier_id === $user->id) {
            return true;
        }

        // Consultants can see published projects
        if ($user->isConsultant() && $project->status === 'published') {
            return true;
        }

        // Contractors can see contractor bidding projects
        if ($user->isContractor() && $project->status === 'contractor_bidding') {
            return true;
        }

        // Suppliers can see supplier bidding projects
        if ($user->isSupplier() && $project->status === 'supplier_bidding') {
            return true;
        }

        return false;
    }

    public function edit(Project $project)
    {
        $user = Auth::user();

        // Check if user can edit this project
        if (!$user->isClient() || $project->client_id !== $user->id) {
            abort(403, 'ليس لديك صلاحية لتعديل هذا المشروع');
        }

        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $user = Auth::user();

        // Check if user can edit this project
        if (!$user->isClient() || $project->client_id !== $user->id) {
            abort(403, 'ليس لديك صلاحية لتعديل هذا المشروع');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'property_type' => 'required|in:residential,commercial,villa,apartment',
            'style' => 'required|in:modern,classic,traditional',
            'area' => 'required|numeric|min:1',
            'location' => 'required|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
            'estimated_cost' => 'required|numeric|min:0',
            'budget_min' => 'nullable|numeric|min:0',
            'budget_max' => 'nullable|numeric|min:0|gte:budget_min',
            'finishing_level' => 'nullable|string|max:255',
            'additional_features' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'property_type' => $request->property_type,
            'style' => $request->style,
            'area' => $request->area,
            'location' => $request->location,
            'neighborhood' => $request->neighborhood,
            'estimated_cost' => $request->estimated_cost,
            'budget_min' => $request->budget_min,
            'budget_max' => $request->budget_max,
            'finishing_level' => $request->finishing_level,
            'additional_features' => $request->additional_features,
            'notes' => $request->notes,
        ]);

        return redirect()->route('projects.show', $project)
            ->with('success', 'تم تحديث المشروع بنجاح');
    }

    public function destroy(Project $project)
    {
        $user = Auth::user();

        // Check if user can delete this project
        if (!$user->isClient() || $project->client_id !== $user->id) {
            abort(403, 'ليس لديك صلاحية لحذف هذا المشروع');
        }

        // Check if project can be deleted (not published or in progress)
        if ($project->status !== 'draft') {
            return response()->json([
                'success' => false,
                'message' => 'لا يمكن حذف المشروع إلا إذا كان في حالة مسودة'
            ], 400);
        }

        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'تم حذف المشروع بنجاح'
        ]);
    }
}
