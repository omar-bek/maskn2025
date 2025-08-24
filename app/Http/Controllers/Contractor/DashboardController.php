<?php

namespace App\Http\Controllers\Contractor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
        public function index()
    {
        $user = Auth::user();

        // Get contractor statistics from database
        $stats = [
            'ongoing_projects' => Project::where('selected_contractor_id', $user->id)->where('status', 'published')->count(),
            'completed_projects' => Project::where('selected_contractor_id', $user->id)->where('status', 'completed')->count(),
            'monthly_earnings' => 0, // Will be implemented when earnings table is created
            'team_members' => 5, // Will be implemented when team table is created
        ];

        // Get recent projects from database
        $recentProjects = Project::where('selected_contractor_id', $user->id)
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

        // Get recent bids (projects in contractor bidding phase)
        $recentBids = Project::whereNull('selected_contractor_id')
            ->where('status', 'contractor_bidding')
            ->with('client')
            ->latest()
            ->take(5)
            ->get()
            ->map(function($project) {
                return [
                    'project' => $project->title,
                    'client' => $project->client->name ?? 'غير محدد',
                    'amount' => number_format($project->estimated_cost) . ' ريال',
                    'status' => 'pending'
                ];
            })
            ->toArray();

        // Get team status (simulated for now)
        $teamStatus = [
            [
                'name' => 'أحمد علي',
                'role' => 'مهندس موقع',
                'status' => 'available'
            ],
            [
                'name' => 'محمد حسن',
                'role' => 'عامل بناء',
                'status' => 'available'
            ],
            [
                'name' => 'علي محمد',
                'role' => 'كهربائي',
                'status' => 'busy'
            ]
        ];

        return view('contractor.dashboard', compact('stats', 'recentProjects', 'recentBids', 'teamStatus'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('contractor.profile', compact('user'));
    }

    public function projects()
    {
        $projects = []; // Will be implemented later
        return view('contractor.projects', compact('projects'));
    }

    public function bids()
    {
        $bids = []; // Will be implemented later
        return view('contractor.bids', compact('bids'));
    }

    public function team()
    {
        $team = []; // Will be implemented later
        return view('contractor.team', compact('team'));
    }

    public function earnings()
    {
        $earnings = []; // Will be implemented later
        return view('contractor.earnings', compact('earnings'));
    }

    public function equipment()
    {
        $equipment = []; // Will be implemented later
        return view('contractor.equipment', compact('equipment'));
    }
}
