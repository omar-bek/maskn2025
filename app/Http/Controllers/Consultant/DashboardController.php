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

        $stats = [
            'designs_created' => $user->designs()->count(),
            'tenders_participated' => $user->proposals()->count(),
            'accepted_proposals' => $user->proposals()->where('status', 'accepted')->count(),
            'average_rating' => 4.5,
            'monthly_earnings' => $user->proposals()->where('status', 'accepted')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('proposed_price') ?? 0,
        ];

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

        $recentEarnings = [
            [
                'tender' => $recentProposals[0]['tender_title'] ?? __('app.new_tender'),
                'amount' => '25,000',
                'date' => __('app.one_week_ago')
            ],
            [
                'tender' => $recentProposals[1]['tender_title'] ?? __('app.another_tender'),
                'amount' => '15,000',
                'date' => __('app.two_weeks_ago')
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
        $portfolio = [];
        return view('consultant.portfolio', compact('portfolio'));
    }

    public function inquiries()
    {
        $inquiries = [];
        return view('consultant.inquiries', compact('inquiries'));
    }

    public function earnings()
    {
        $earnings = [];
        return view('consultant.earnings', compact('earnings'));
    }
}