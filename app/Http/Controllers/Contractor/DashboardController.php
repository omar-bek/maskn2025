<?php

namespace App\Http\Controllers\Contractor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        if (!$user->isContractor()) {
            abort(403, 'غير مصرح لك بالدخول كمقاول.');
        }

        return view('contractor.profile', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user();

        if (!$user->isContractor()) {
            abort(403, 'غير مصرح لك بالدخول كمقاول.');
        }

        return view('contractor.profile-edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if (!$user->isContractor()) {
            abort(403, 'غير مصرح لك بالدخول كمقاول.');
        }

        $validated = $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'bio' => 'nullable|string|max:1000',
            'specialization' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
        ]);

        $profile = $user->profile()->firstOrCreate([]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');

            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $user->avatar = $avatarPath;
        }

        if (array_key_exists('bio', $validated)) {
            $profile->bio_ar = $validated['bio'];
            $profile->bio_en = $validated['bio'];
        }

        if (array_key_exists('specialization', $validated)) {
            $profile->specializations = $validated['specialization']
                ? [$validated['specialization']]
                : [];
        }

        if (array_key_exists('company_name', $validated)) {
            $profile->company_name = $validated['company_name'];
        }

        $profile->save();

        foreach (['city', 'phone', 'whatsapp'] as $field) {
            if (array_key_exists($field, $validated)) {
                $user->{$field} = $validated[$field];
            }
        }

        $user->save();

        return redirect()->route('contractor.profile')->with('success', 'تم تحديث الملف الشخصي بنجاح.');
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
