<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user->isClient()) {
            abort(403, __('app.unauthorized_client_only'));
        }

        $stats = [
            'saved_designs' => 0,
            'favorite_consultants' => 0,
            'tenders_created' => $user->tenders()->count(),
            'proposals_received' => $user->tenders()->withCount('proposals')->get()->sum('proposals_count'),
            'accepted_proposals' => $user->tenders()->whereHas('proposals', function ($q) {
                $q->where('status', 'accepted');
            })->count(),
            'active_tenders' => $user->tenders()->where('status', 'active')->count(),
        ];

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
                    'specialization' => __('app.consultant.specialization_default'),
                    'rating' => 4.5,
                    'designs_count' => $consultant->designs_count,
                    'location' => __('app.consultant.location_default')
                ];
            })
            ->toArray();

        $recentActivities = [
            [
                'type' => 'tender_created',
                'description' => __('app.activity.tender_created', [
                    'title' => ($recentTenders[0]['title'] ?? __('app.activity.new_tender'))
                ]),
                'time' => __('app.time.hours_ago')
            ],
            [
                'type' => 'proposal_received',
                'description' => __('app.activity.proposal_received'),
                'time' => __('app.time.day_ago')
            ],
            [
                'type' => 'design_saved',
                'description' => __('app.activity.design_saved'),
                'time' => __('app.time.days_ago')
            ]
        ];

        return view('client.dashboard', compact('stats', 'recentActivities', 'recommendedConsultants', 'recentTenders'));
    }

    public function profile()
    {
        $user = Auth::user();

        if (!$user->isClient()) {
            abort(403, __('app.unauthorized_client_only'));
        }

        return view('client.profile', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user();

        if (!$user->isClient()) {
            abort(403, __('app.unauthorized_client_only'));
        }

        return view('client.profile-edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if (!$user->isClient()) {
            abort(403, __('app.unauthorized_client_only'));
        }

        $validated = $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
        ]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');

            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $user->avatar = $avatarPath;
        }

        $profile = $user->profile()->firstOrCreate([]);

        if (array_key_exists('bio', $validated)) {
            $profile->bio_ar = $validated['bio'];
            $profile->bio_en = $validated['bio'];
            $profile->save();
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        foreach (['phone', 'city', 'whatsapp'] as $field) {
            if (array_key_exists($field, $validated)) {
                $user->{$field} = $validated[$field];
            }
        }

        $user->save();

        return redirect()->route('client.profile')->with('success', 'تم تحديث الملف الشخصي بنجاح.');
    }

    public function savedDesigns()
    {
        $savedDesigns = [];
        return view('client.saved-designs', compact('savedDesigns'));
    }

    public function favoriteConsultants()
    {
        $favoriteConsultants = [];
        return view('client.favorite-consultants', compact('favoriteConsultants'));
    }

    public function myTenders()
    {
        $user = Auth::user();

        if (!$user->isClient()) {
            abort(403, __('app.unauthorized_client_only'));
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