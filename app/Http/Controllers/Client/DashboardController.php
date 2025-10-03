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
            'tenders_created' => $user->tenders()->count(),
            'proposals_received' => $user->tenders()->withCount('proposals')->get()->sum('proposals_count'),
            'accepted_proposals' => $user->tenders()->whereHas('proposals', function ($q) {
                $q->where('status', 'accepted');
            })->count(),
            'active_tenders' => $user->tenders()->where('status', 'active')->count(),
        ];

        // Get recent tenders from database
        $recentTenders = $user->tenders()
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($tender) {
                return [
                    'title' => $tender->title,
                    'location' => $tender->location,
                    'status' => $tender->status,
                    'budget' => $tender->formatted_budget
                ];
            })
            ->toArray();

        // Get recommended consultants from database
        $recommendedConsultants = User::whereHas('userType', function ($q) {
            $q->where('name', 'consultant');
        })
            ->withCount('designs')
            ->orderBy('designs_count', 'desc')
            ->take(3)
            ->get()
            ->map(function ($consultant) {
                return [
                    'name' => $consultant->name,
                    'specialization' => 'تصميم معماري', // Will be enhanced when profile table is created
                    'rating' => 4.5, // Will be implemented when ratings table is created
                    'designs_count' => $consultant->designs_count,
                    'location' => 'الرياض' // Will be enhanced when profile table is created
                ];
            })
            ->toArray();

        // Get recent activities (simulated for now)
        $recentActivities = [
            [
                'type' => 'tender_created',
                'description' => 'تم إنشاء مناقصة جديدة: ' . ($recentTenders[0]['title'] ?? 'مناقصة جديدة'),
                'time' => 'منذ ساعتين'
            ],
            [
                'type' => 'proposal_received',
                'description' => 'تم استلام عرض جديد',
                'time' => 'منذ يوم واحد'
            ],
            [
                'type' => 'design_saved',
                'description' => 'تم حفظ تصميم جديد',
                'time' => 'منذ 3 أيام'
            ]
        ];

        return view('client.dashboard', compact('stats', 'recentActivities', 'recommendedConsultants', 'recentTenders'));
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

    public function myTenders()
    {
        $user = Auth::user();

        // Ensure only clients can access this page
        if (!$user->isClient()) {
            abort(403, 'هذه الصفحة متاحة للعملاء فقط');
        }

        $tenders = $user->tenders()
            ->with(['proposals' => function ($q) {
                $q->with('consultant');
            }])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('client.my-tenders', compact('tenders'));
    }
}
