<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get consultant statistics from database
        $stats = [
            'designs_created' => $user->designs()->count(),
            'tenders_participated' => $user->proposals()->count(),
            'accepted_proposals' => $user->proposals()->where('status', 'accepted')->count(),
            'average_rating' => 4.5, // Will be implemented when ratings table is created
            'monthly_earnings' => $user->proposals()->where('status', 'accepted')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('proposed_price') ?? 0,
        ];

        // Get recent designs from database
        $recentDesigns = $user->designs()
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($design) {
                return [
                    'title' => $design->title,
                    'style' => $design->style,
                    'area' => $design->formatted_area,
                    'price' => $design->formatted_price
                ];
            })
            ->toArray();

        // Get recent proposals from database
        $recentProposals = $user->proposals()
            ->with('tender')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($proposal) {
                return [
                    'tender_title' => $proposal->tender->title,
                    'proposed_price' => $proposal->formatted_price,
                    'status' => $proposal->status,
                    'date' => $proposal->created_at->diffForHumans()
                ];
            })
            ->toArray();

        // Get recent earnings (simulated for now)
        $recentEarnings = [
            [
                'tender' => $recentProposals[0]['tender_title'] ?? 'مناقصة جديدة',
                'amount' => '25,000',
                'date' => 'منذ أسبوع'
            ],
            [
                'tender' => $recentProposals[1]['tender_title'] ?? 'مناقصة أخرى',
                'amount' => '15,000',
                'date' => 'منذ أسبوعين'
            ]
        ];

        return view('consultant.dashboard', compact('stats', 'recentDesigns', 'recentProposals', 'recentEarnings'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('consultant.profile', compact('user'));
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
