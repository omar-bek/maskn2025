<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function editProfile()
    {
        $user = Auth::user();
        return view('consultant.profile-edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'bio' => 'nullable|string|max:1000',
            'specialization' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
        ]);

        $profile = $user->profile()->firstOrCreate([]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        if (isset($validated['bio'])) {
            $profile->bio_ar = $validated['bio'];
            $profile->bio_en = $validated['bio'];
        }

        if (isset($validated['specialization'])) {
            $profile->specializations = $validated['specialization'] ? [$validated['specialization']] : [];
        }

        $profile->save();

        foreach (['city', 'phone', 'whatsapp'] as $field) {
            if (isset($validated[$field])) {
                $user->{$field} = $validated[$field];
            }
        }

        $user->save();

        return redirect()->route('consultant.profile')->with('success', 'تم تحديث الملف الشخصي بنجاح.');
    }

    public function portfolio()
    {
        $portfolio = collect([]);
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