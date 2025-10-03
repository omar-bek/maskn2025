<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Design;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;

class DesignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get consultant users
        $consultants = User::whereHas('userType', function($q) {
            $q->where('name', 'consultant');
        })->get();

        if ($consultants->isEmpty()) {
            $this->command->info('No consultant users found. Skipping design seeding.');
            return;
        }

        $designs = [
            [
                'title' => 'فيلا عصرية فاخرة',
                'style' => 'عصري',
                'price' => 500000,
                'area' => 400,
                'bedrooms' => 5,
                'bathrooms' => 4,
                'floors' => 3,
                'description' => 'تصميم فيلا عصرية مع حديقة خارجية وموقف سيارات. الفيلا تتكون من 3 طوابق مع إطلالة رائعة على المدينة.',
                'features' => ['حديقة خارجية', 'موقف سيارات', 'مطبخ مجهز', 'غرفة معيشة واسعة', 'مسبح خاص', 'مصعد داخلي'],
                'consultant_name' => 'أحمد محمد',
                'consultant_phone' => '+966501234567',
                'consultant_email' => 'ahmed@example.com',
                'location' => 'الرياض',
                'is_featured' => true,
                'rating' => 4.8
            ],
            [
                'title' => 'بيت إسلامي تقليدي',
                'style' => 'إسلامي',
                'price' => 300000,
                'area' => 250,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'floors' => 2,
                'description' => 'تصميم بيت إسلامي مع فنون عربية أصيلة وحديقة داخلية',
                'features' => ['فناء داخلي', 'قبة إسلامية', 'أعمدة عربية', 'حديقة داخلية', 'مصلى'],
                'consultant_name' => 'فاطمة علي',
                'consultant_phone' => '+966502345678',
                'consultant_email' => 'fatima@example.com',
                'location' => 'جدة',
                'is_featured' => true,
                'rating' => 4.9
            ],
            [
                'title' => 'شقة حديثة أنيقة',
                'style' => 'حديث',
                'price' => 200000,
                'area' => 120,
                'bedrooms' => 2,
                'bathrooms' => 2,
                'floors' => 1,
                'description' => 'تصميم شقة حديثة مع ديكورات عصرية ومساحات مفتوحة',
                'features' => ['صالون مفتوح', 'مطبخ حديث', 'شرفة واسعة', 'ديكورات عصرية'],
                'consultant_name' => 'محمد حسن',
                'consultant_phone' => '+966503456789',
                'consultant_email' => 'mohammed@example.com',
                'location' => 'الدمام',
                'is_featured' => false,
                'rating' => 4.7
            ],
            [
                'title' => 'قصر إسلامي فاخر',
                'style' => 'إسلامي',
                'price' => 1200000,
                'area' => 800,
                'bedrooms' => 8,
                'bathrooms' => 6,
                'floors' => 3,
                'description' => 'قصر إسلامي مع حدائق وبرك مياه ونافورات',
                'features' => ['حديقة واسعة', 'بركة مياه', 'نافورات', 'قاعة استقبال', 'مصلى كبير', 'مكتبة'],
                'consultant_name' => 'علي أحمد',
                'consultant_phone' => '+966504567890',
                'consultant_email' => 'ali@example.com',
                'location' => 'الرياض',
                'is_featured' => true,
                'rating' => 5.0
            ]
        ];

        foreach ($designs as $designData) {
            $design = Design::create([
                'consultant_id' => $consultants->random()->id,
                'title' => $designData['title'],
                'description' => $designData['description'],
                'style' => $designData['style'],
                'area' => $designData['area'],
                'location' => $designData['location'],
                'price' => $designData['price'],
                'bedrooms' => $designData['bedrooms'],
                'bathrooms' => $designData['bathrooms'],
                'floors' => $designData['floors'],
                'features' => $designData['features'],
                'consultant_name' => $designData['consultant_name'],
                'consultant_phone' => $designData['consultant_phone'],
                'consultant_email' => $designData['consultant_email'],
                'status' => 'published',
                'is_featured' => $designData['is_featured'],
                'rating' => $designData['rating'],
                'views_count' => rand(50, 500)
            ]);

            // Add some sample pricing items
            $categories = Category::take(3)->get();
            foreach ($categories as $category) {
                Item::create([
                    'design_id' => $design->id,
                    'category_id' => $category->id,
                    'item_name' => 'بند تجريبي في ' . $category->category_name,
                    'quantity' => rand(10, 100),
                    'unit' => 'م²',
                    'unit_price' => rand(50, 500),
                    'total_price' => rand(500, 5000),
                    'item_order' => 1
                ]);
            }
        }

        $this->command->info('تم إنشاء ' . count($designs) . ' تصميم بنجاح!');
    }
}
