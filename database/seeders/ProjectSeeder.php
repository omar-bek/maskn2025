<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create a client user
        $client = User::where('email', 'client@example.com')->first();
        if (!$client) {
            $client = User::factory()->create([
                'email' => 'client@example.com',
                'name' => 'أحمد محمد',
                'user_type_id' => 1, // Client
            ]);
        }

        // Sample projects data
        $projects = [
            [
                'title' => 'فيلا عصرية في دبي',
                'description' => 'فيلا فاخرة بتصميم عصري في قلب دبي، تتميز بمساحات واسعة وإطلالات خلابة على المدينة.',
                'property_type' => 'villa',
                'style' => 'modern',
                'area' => 450.00,
                'location' => 'دبي',
                'neighborhood' => 'بر دبي',
                'floors' => 3,
                'majlis_count' => 2,
                'bedrooms' => 5,
                'guest_bedrooms' => 2,
                'bathrooms' => 6,
                'parking_spaces' => 4,
                'other_rooms' => 1,
                'finishing_level' => 'high',
                'additional_features' => ['garden', 'pool', 'elevator'],
                'additional_notes' => 'مطلوب تصميم عصري مع الحفاظ على الطابع العربي الأصيل',
                'estimated_cost' => 2500000.00,
                'budget_min' => 2000000.00,
                'budget_max' => 3000000.00,
                'status' => 'published',
            ],
            [
                'title' => 'شقة سكنية في أبو ظبي',
                'description' => 'شقة عائلية مريحة في منطقة سكنية هادئة في أبو ظبي، مناسبة للعائلة الصغيرة.',
                'property_type' => 'residential',
                'style' => 'classic',
                'area' => 180.00,
                'location' => 'أبو ظبي',
                'neighborhood' => 'الخالدية',
                'floors' => 1,
                'majlis_count' => 1,
                'bedrooms' => 3,
                'guest_bedrooms' => 0,
                'bathrooms' => 3,
                'parking_spaces' => 2,
                'other_rooms' => 0,
                'finishing_level' => 'medium',
                'additional_features' => ['garden'],
                'additional_notes' => 'تصميم كلاسيكي أنيق مع لمسات عصرية',
                'estimated_cost' => 800000.00,
                'budget_min' => 700000.00,
                'budget_max' => 900000.00,
                'status' => 'published',
            ],
            [
                'title' => 'مبنى تجاري في الشارقة',
                'description' => 'مبنى تجاري متعدد الطوابق في منطقة تجارية نشطة في الشارقة، مناسب للمكاتب والمحلات التجارية.',
                'property_type' => 'commercial',
                'style' => 'modern',
                'area' => 800.00,
                'location' => 'الشارقة',
                'neighborhood' => 'المنطقة الوسطى',
                'floors' => 5,
                'majlis_count' => 0,
                'bedrooms' => 0,
                'guest_bedrooms' => 0,
                'bathrooms' => 8,
                'parking_spaces' => 20,
                'other_rooms' => 0,
                'finishing_level' => 'high',
                'additional_features' => ['elevator', 'basement'],
                'additional_notes' => 'تصميم عصري للمباني التجارية مع مراعاة معايير الأمان والراحة',
                'estimated_cost' => 3500000.00,
                'budget_min' => 3000000.00,
                'budget_max' => 4000000.00,
                'status' => 'published',
            ],
            [
                'title' => 'فيلا تراثية في رأس الخيمة',
                'description' => 'فيلا بتصميم تراثي إسلامي في رأس الخيمة، تجمع بين الأصالة والحداثة.',
                'property_type' => 'villa',
                'style' => 'traditional',
                'area' => 320.00,
                'location' => 'رأس الخيمة',
                'neighborhood' => 'المنطقة الوسطى',
                'floors' => 2,
                'majlis_count' => 2,
                'bedrooms' => 4,
                'guest_bedrooms' => 1,
                'bathrooms' => 5,
                'parking_spaces' => 3,
                'other_rooms' => 1,
                'finishing_level' => 'high',
                'additional_features' => ['garden', 'pool'],
                'additional_notes' => 'تصميم تراثي إسلامي مع الحفاظ على الهوية العربية',
                'estimated_cost' => 1800000.00,
                'budget_min' => 1500000.00,
                'budget_max' => 2000000.00,
                'status' => 'draft',
            ],
            [
                'title' => 'شقة فاخرة في عجمان',
                'description' => 'شقة فاخرة بتصميم عصري في عجمان، تتميز بإطلالات على البحر والخدمات المتقدمة.',
                'property_type' => 'residential',
                'style' => 'modern',
                'area' => 220.00,
                'location' => 'عجمان',
                'neighborhood' => 'المنطقة الوسطى',
                'floors' => 1,
                'majlis_count' => 1,
                'bedrooms' => 4,
                'guest_bedrooms' => 1,
                'bathrooms' => 4,
                'parking_spaces' => 2,
                'other_rooms' => 0,
                'finishing_level' => 'high',
                'additional_features' => ['garden', 'elevator'],
                'additional_notes' => 'تصميم عصري فاخر مع إطلالات بحرية رائعة',
                'estimated_cost' => 1200000.00,
                'budget_min' => 1000000.00,
                'budget_max' => 1400000.00,
                'status' => 'published',
            ],
            [
                'title' => 'مكتب استشاري في أم القيوين',
                'description' => 'مكتب استشاري بتصميم عصري في أم القيوين، مناسب للاستشارات الهندسية والمعمارية.',
                'property_type' => 'commercial',
                'style' => 'modern',
                'area' => 150.00,
                'location' => 'أم القيوين',
                'neighborhood' => 'المنطقة الوسطى',
                'floors' => 2,
                'majlis_count' => 0,
                'bedrooms' => 0,
                'guest_bedrooms' => 0,
                'bathrooms' => 3,
                'parking_spaces' => 5,
                'other_rooms' => 0,
                'finishing_level' => 'medium',
                'additional_features' => ['elevator'],
                'additional_notes' => 'تصميم مكتبي عصري مع مراعاة الراحة والإنتاجية',
                'estimated_cost' => 600000.00,
                'budget_min' => 500000.00,
                'budget_max' => 700000.00,
                'status' => 'published',
            ],
            [
                'title' => 'فيلا عائلية في الفجيرة',
                'description' => 'فيلا عائلية كبيرة في الفجيرة، مناسبة للعائلات الكبيرة مع حديقة واسعة.',
                'property_type' => 'villa',
                'style' => 'classic',
                'area' => 550.00,
                'location' => 'الفجيرة',
                'neighborhood' => 'المنطقة الوسطى',
                'floors' => 3,
                'majlis_count' => 3,
                'bedrooms' => 6,
                'guest_bedrooms' => 2,
                'bathrooms' => 8,
                'parking_spaces' => 5,
                'other_rooms' => 2,
                'finishing_level' => 'high',
                'additional_features' => ['garden', 'pool', 'elevator', 'basement'],
                'additional_notes' => 'فيلا عائلية فاخرة مع جميع الخدمات والمرافق المطلوبة',
                'estimated_cost' => 3200000.00,
                'budget_min' => 2800000.00,
                'budget_max' => 3500000.00,
                'status' => 'draft',
            ],
            [
                'title' => 'شقة صغيرة في دبي',
                'description' => 'شقة صغيرة بتصميم عصري في دبي، مناسبة للشباب أو العائلات الصغيرة.',
                'property_type' => 'residential',
                'style' => 'modern',
                'area' => 120.00,
                'location' => 'دبي',
                'neighborhood' => 'ديرة',
                'floors' => 1,
                'majlis_count' => 1,
                'bedrooms' => 2,
                'guest_bedrooms' => 0,
                'bathrooms' => 2,
                'parking_spaces' => 1,
                'other_rooms' => 0,
                'finishing_level' => 'medium',
                'additional_features' => [],
                'additional_notes' => 'تصميم عصري بسيط ومناسب للميزانية',
                'estimated_cost' => 500000.00,
                'budget_min' => 450000.00,
                'budget_max' => 550000.00,
                'status' => 'published',
            ],
        ];

        foreach ($projects as $projectData) {
            Project::create(array_merge($projectData, [
                'client_id' => $client->id,
            ]));
        }

        $this->command->info('تم إنشاء ' . count($projects) . ' مشروع بنجاح!');
    }
}
