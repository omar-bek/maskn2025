<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offer;
use App\Models\Project;
use App\Models\User;

class OfferSeeder extends Seeder
{
    public function run()
    {
        // Get some projects and professionals
        $projects = Project::where('status', 'published')->take(3)->get();
        $consultants = User::whereHas('userType', function($q) {
            $q->where('name', 'consultant');
        })->take(2)->get();

        $contractors = User::whereHas('userType', function($q) {
            $q->where('name', 'contractor');
        })->take(2)->get();

        $suppliers = User::whereHas('userType', function($q) {
            $q->where('name', 'supplier');
        })->take(2)->get();

        foreach ($projects as $project) {
            // Add consultant offers
            foreach ($consultants as $consultant) {
                Offer::create([
                    'project_id' => $project->id,
                    'professional_id' => $consultant->id,
                    'professional_type' => 'consultant',
                    'price' => rand(5000, 15000),
                    'duration_days' => rand(30, 90),
                    'description' => 'عرض تصميم معماري شامل مع المتابعة والإشراف على المشروع',
                    'status' => rand(1, 3) === 1 ? 'accepted' : (rand(1, 2) === 1 ? 'pending' : 'rejected'),
                ]);
            }

            // Add contractor offers
            foreach ($contractors as $contractor) {
                Offer::create([
                    'project_id' => $project->id,
                    'professional_id' => $contractor->id,
                    'professional_type' => 'contractor',
                    'price' => rand(50000, 200000),
                    'duration_days' => rand(60, 180),
                    'description' => 'عرض تنفيذ شامل للمشروع مع ضمان الجودة',
                    'status' => rand(1, 3) === 1 ? 'accepted' : (rand(1, 2) === 1 ? 'pending' : 'rejected'),
                ]);
            }

            // Add supplier offers
            foreach ($suppliers as $supplier) {
                Offer::create([
                    'project_id' => $project->id,
                    'professional_id' => $supplier->id,
                    'professional_type' => 'supplier',
                    'price' => rand(10000, 50000),
                    'duration_days' => rand(15, 45),
                    'description' => 'عرض توريد المواد والمواد الخام المطلوبة',
                    'status' => rand(1, 3) === 1 ? 'accepted' : (rand(1, 2) === 1 ? 'pending' : 'rejected'),
                ]);
            }
        }
    }
}
