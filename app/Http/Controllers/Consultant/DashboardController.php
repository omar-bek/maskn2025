<?php

namespace App\Http\Controllers\Consultant;

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

        // Get consultant statistics from database
        $stats = [
            'active_projects' => Project::where('selected_consultant_id', $user->id)->where('status', 'published')->count(),
            'completed_projects' => Project::where('selected_consultant_id', $user->id)->where('status', 'completed')->count(),
            'monthly_earnings' => 0, // Will be implemented when earnings table is created
            'average_rating' => 4.5, // Will be implemented when ratings table is created
        ];

        // Get recent projects from database
        $recentProjects = Project::where('selected_consultant_id', $user->id)
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

        // Get recent inquiries (projects without consultant)
        $recentInquiries = Project::whereNull('selected_consultant_id')
            ->where('status', 'published')
            ->with('client')
            ->latest()
            ->take(5)
            ->get()
            ->map(function($project) {
                return [
                    'client_name' => $project->client->name ?? 'غير محدد',
                    'project_type' => $project->design_type ?? 'غير محدد',
                    'budget' => number_format($project->estimated_cost) . ' ريال',
                    'date' => $project->created_at->diffForHumans()
                ];
            })
            ->toArray();

        // Get recent earnings (simulated for now)
        $recentEarnings = [
            [
                'project' => $recentProjects[0]['title'] ?? 'مشروع جديد',
                'amount' => '25,000',
                'date' => 'منذ أسبوع'
            ],
            [
                'project' => $recentProjects[1]['title'] ?? 'مشروع آخر',
                'amount' => '15,000',
                'date' => 'منذ أسبوعين'
            ]
        ];

        return view('consultant.dashboard', compact('stats', 'recentProjects', 'recentInquiries', 'recentEarnings'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('consultant.profile', compact('user'));
    }

    public function projects()
    {
        $projects = []; // Will be implemented later
        return view('consultant.projects', compact('projects'));
    }

    public function portfolio()
    {
        $portfolio = []; // Will be implemented later
        return view('consultant.portfolio', compact('portfolio'));
    }

    public function inquiries()
    {
        $inquiries = []; // Will be implemented later
        return view('consultant.inquiries', compact('inquiries'));
    }

    public function earnings()
    {
        $earnings = []; // Will be implemented later
        return view('consultant.earnings', compact('earnings'));
    }
}
