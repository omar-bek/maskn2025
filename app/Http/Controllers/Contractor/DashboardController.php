<?php

namespace App\Http\Controllers\Contractor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
        public function index()
    {
        $user = Auth::user();

        // Get contractor statistics from database
        $stats = [
            'tenders_participated' => 0, // Will be implemented when contractor proposals are added
            'accepted_proposals' => 0, // Will be implemented when contractor proposals are added
            'monthly_earnings' => 0, // Will be implemented when earnings table is created
            'team_members' => 5, // Will be implemented when team table is created
        ];

        // Get recent tenders (simulated for now)
        $recentTenders = [
            [
                'title' => 'بناء فيلا سكنية',
                'location' => 'الرياض',
                'status' => 'open',
                'budget' => '500,000 درهم إماراتي'
            ],
            [
                'title' => 'تطوير مجمع تجاري',
                'location' => 'دبي',
                'status' => 'open',
                'budget' => '1,200,000 درهم إماراتي'
            ]
        ];

        // Get recent bids (simulated for now)
        $recentBids = [
            [
                'tender' => 'بناء فيلا سكنية',
                'client' => 'أحمد محمد',
                'amount' => '450,000 درهم إماراتي',
                'status' => 'pending'
            ],
            [
                'tender' => 'تطوير مجمع تجاري',
                'client' => 'سارة أحمد',
                'amount' => '1,100,000 درهم إماراتي',
                'status' => 'pending'
            ]
        ];

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

        return view('contractor.dashboard', compact('stats', 'recentTenders', 'recentBids', 'teamStatus'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('contractor.profile', compact('user'));
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
