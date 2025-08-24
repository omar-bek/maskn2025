<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get statistics
        $stats = [
            'total_users' => User::count(),
            'clients' => User::whereHas('userType', function($q) {
                $q->where('name', 'client');
            })->count(),
            'consultants' => User::whereHas('userType', function($q) {
                $q->where('name', 'consultant');
            })->count(),
            'contractors' => User::whereHas('userType', function($q) {
                $q->where('name', 'contractor');
            })->count(),
            'suppliers' => User::whereHas('userType', function($q) {
                $q->where('name', 'supplier');
            })->count(),
            'verified_users' => User::where('is_verified', true)->count(),
            'active_users' => User::where('is_active', true)->count(),
        ];

        // Get recent users
        $recentUsers = User::with('userType', 'profile')
            ->latest()
            ->take(10)
            ->get();

        // Get user types
        $userTypes = UserType::withCount('users')->get();

        // Get user statistics by type
        $userStats = [
            'clients' => User::whereHas('userType', function($q) {
                $q->where('name', 'client');
            })->count(),
            'consultants' => User::whereHas('userType', function($q) {
                $q->where('name', 'consultant');
            })->count(),
            'contractors' => User::whereHas('userType', function($q) {
                $q->where('name', 'contractor');
            })->count(),
            'suppliers' => User::whereHas('userType', function($q) {
                $q->where('name', 'supplier');
            })->count(),
            'new_users_this_month' => User::whereMonth('created_at', now()->month)->count(),
            'active_users' => User::where('is_active', true)->count(),
            'suspended_users' => User::where('is_active', false)->count(),
        ];

        // Get recent activity
        $recentActivity = []; // Will be implemented later

        return view('admin.dashboard', compact('stats', 'recentUsers', 'userTypes', 'userStats', 'recentActivity'));
    }

    public function users()
    {
        $users = User::with('userType', 'profile')
            ->latest()
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function userTypes()
    {
        $userTypes = UserType::withCount('users')->get();
        return view('admin.user-types.index', compact('userTypes'));
    }
}
