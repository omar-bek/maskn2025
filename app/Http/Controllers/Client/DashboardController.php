<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
        public function index()
    {
        $user = Auth::user();

        // Ensure only clients can access this page
        if (!$user->isClient()) {
            abort(403, 'هذه الصفحة متاحة للعملاء فقط');
        }

        // Get client statistics from database
        $stats = [
            'saved_designs' => 0, // Will be implemented when designs table is created
            'favorite_consultants' => 0, // Will be implemented when favorites table is created
            'ongoing_projects' => $user->clientProjects()->where('status', 'published')->count(),
            'completed_projects' => $user->clientProjects()->where('status', 'completed')->count(),
        ];

        // Get recent projects from database
        $recentProjects = $user->clientProjects()
            ->latest()
            ->take(5)
            ->get()
            ->map(function($project) {
                return [
                    'title' => $project->title,
                    'location' => $project->location,
                    'status' => $project->status,
                    'budget' => number_format($project->estimated_cost) . ' ريال'
                ];
            })
            ->toArray();

        // Get recommended consultants from database
        $recommendedConsultants = User::whereHas('userType', function($q) {
                $q->where('name', 'consultant');
            })
            ->withCount('consultantProjects')
            ->orderBy('consultant_projects_count', 'desc')
            ->take(3)
            ->get()
            ->map(function($consultant) {
                return [
                    'name' => $consultant->name,
                    'specialization' => 'تصميم معماري', // Will be enhanced when profile table is created
                    'rating' => 4.5, // Will be implemented when ratings table is created
                    'projects_count' => $consultant->consultant_projects_count,
                    'location' => 'الرياض' // Will be enhanced when profile table is created
                ];
            })
            ->toArray();

        // Get recent activities (simulated for now)
        $recentActivities = [
            [
                'type' => 'project_created',
                'description' => 'تم إنشاء مشروع جديد: ' . ($recentProjects[0]['title'] ?? 'مشروع جديد'),
                'time' => 'منذ ساعتين'
            ],
            [
                'type' => 'consultant_hired',
                'description' => 'تم تعيين الاستشاري: ' . ($recommendedConsultants[0]['name'] ?? 'استشاري'),
                'time' => 'منذ يوم واحد'
            ],
            [
                'type' => 'design_saved',
                'description' => 'تم حفظ تصميم جديد',
                'time' => 'منذ 3 أيام'
            ]
        ];

        return view('client.dashboard', compact('stats', 'recentActivities', 'recommendedConsultants', 'recentProjects'));
    }

    public function profile()
    {
        $user = Auth::user();

        // Ensure only clients can access this page
        if (!$user->isClient()) {
            abort(403, 'هذه الصفحة متاحة للعملاء فقط');
        }

        return view('client.profile', compact('user'));
    }

    public function savedDesigns()
    {
        $savedDesigns = []; // Will be implemented later
        return view('client.saved-designs', compact('savedDesigns'));
    }

    public function favoriteConsultants()
    {
        $favoriteConsultants = []; // Will be implemented later
        return view('client.favorite-consultants', compact('favoriteConsultants'));
    }

    public function projects()
    {
        $user = Auth::user();

        // Ensure only clients can access this page
        if (!$user->isClient()) {
            abort(403, 'هذه الصفحة متاحة للعملاء فقط');
        }

        // Get all client projects with filters
        $query = $user->clientProjects()->with(['client']);

        // Apply status filter if provided
        $status = request('status');
        if ($status) {
            $query->where('status', $status);
        }

        // Apply search filter if provided
        $search = request('search');
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $projects = $query->latest()->paginate(10);

        // Get statistics for the client
        $stats = [
            'total_projects' => $user->clientProjects()->count(),
            'published_projects' => $user->clientProjects()->where('status', 'published')->count(),
            'draft_projects' => $user->clientProjects()->where('status', 'draft')->count(),
            'completed_projects' => $user->clientProjects()->where('status', 'completed')->count(),
        ];

        return view('client.projects', compact('projects', 'stats'));
    }

    public function offers()
    {
        $user = Auth::user();

        // Ensure only clients can access this page
        if (!$user->isClient()) {
            abort(403, 'هذه الصفحة متاحة للعملاء فقط');
        }

        // Get all projects with their offers
        $projects = $user->clientProjects()
            ->with(['offers.professional', 'offers.professional.userType'])
            ->whereHas('offers')
            ->latest()
            ->get();

        // Get statistics
        $stats = [
            'total_offers' => $projects->sum(function($project) {
                return $project->offers->count();
            }),
            'accepted_offers' => $projects->sum(function($project) {
                return $project->offers->where('status', 'accepted')->count();
            }),
            'pending_offers' => $projects->sum(function($project) {
                return $project->offers->where('status', 'pending')->count();
            }),
            'rejected_offers' => $projects->sum(function($project) {
                return $project->offers->where('status', 'rejected')->count();
            }),
        ];

        // Group offers by project
        $projectsWithOffers = $projects->map(function($project) {
            $consultantOffers = $project->offers->where('professional_type', 'consultant');
            $contractorOffers = $project->offers->where('professional_type', 'contractor');
            $supplierOffers = $project->offers->where('professional_type', 'supplier');

            return [
                'project' => $project,
                'consultant_offers' => $consultantOffers,
                'contractor_offers' => $contractorOffers,
                'supplier_offers' => $supplierOffers,
                'has_accepted_consultant' => $project->selected_consultant_id !== null,
                'has_accepted_contractor' => $project->selected_contractor_id !== null,
                'has_accepted_supplier' => $project->selected_supplier_id !== null,
            ];
        });

        return view('client.offers', compact('projectsWithOffers', 'stats'));
    }
}
