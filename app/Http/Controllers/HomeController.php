<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // جلب التصاميم المميزة من قاعدة البيانات
        $featuredDesigns = \App\Models\Design::with('consultant')
            ->published()
            ->featured()
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // إحصائيات المنصة
        $stats = [
            'total_designs' => \App\Models\Design::published()->count(),
            'total_consultants' => \App\Models\User::whereHas('userType', function ($query) {
                $query->where('name', 'consultant');
            })->count(),
            'total_tenders' => \App\Models\Tender::count(),
            'total_projects' => \App\Models\Tender::where('status', 'awarded')->count(),
        ];

        // آخر التصاميم
        $recentDesigns = \App\Models\Design::with('consultant')
            ->published()
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('home', compact('featuredDesigns', 'stats', 'recentDesigns'));
    }
}
