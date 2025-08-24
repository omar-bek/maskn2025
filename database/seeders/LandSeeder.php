<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Land;
use App\Models\User;

class LandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create a user for testing
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'أحمد محمد',
                'password' => bcrypt('password'),
                'user_type_id' => 1
            ]
        );

        $lands = [
            [
                'user_id' => $user->id,
                'title' => 'أرض سكنية في الرياض',
                'land_type' => 'residential',
                'area' => 500.00,
                'price' => 800000.00,
                'city' => 'riyadh',
                'district' => 'حي النرجس',
                'address' => 'شارع الملك فهد، حي النرجس، الرياض',
                'transaction_type' => 'sale',
                'description' => 'أرض سكنية مميزة في حي راقي، مناسبة لبناء فيلا فاخرة. الأرض مستوية وجاهزة للبناء مع جميع الخدمات المتوفرة.',
                'features' => ['services', 'paved', 'flat', 'security'],
                'contact_name' => 'أحمد محمد',
                'contact_phone' => '+966 50 123 4567',
                'contact_whatsapp' => '+966 50 123 4567',
                'contact_email' => 'ahmed@email.com',
                'desired_locations' => [
                    [
                        'city' => 'jeddah',
                        'district' => 'حي التحلية',
                        'area' => 600,
                        'details' => 'أرض في حي مميز'
                    ]
                ],
                'status' => 'active',
                'views' => 45,
                'images' => ['/images/land1.jpg', '/images/land1-1.jpg', '/images/land1-2.jpg']
            ],
            [
                'user_id' => $user->id,
                'title' => 'أرض تجارية في جدة',
                'land_type' => 'commercial',
                'area' => 1000.00,
                'price' => 1500000.00,
                'city' => 'jeddah',
                'district' => 'شارع التحلية',
                'address' => 'شارع التحلية، جدة',
                'transaction_type' => 'exchange',
                'description' => 'أرض تجارية في موقع استراتيجي، مناسبة لمشروع تجاري كبير',
                'features' => ['services', 'paved', 'corner', 'view'],
                'contact_name' => 'فاطمة علي',
                'contact_phone' => '+966 55 987 6543',
                'contact_whatsapp' => '+966 55 987 6543',
                'contact_email' => 'fatima@email.com',
                'desired_locations' => [
                    [
                        'city' => 'riyadh',
                        'district' => 'حي الملك فهد',
                        'area' => 800,
                        'details' => 'أرض تجارية في الرياض'
                    ]
                ],
                'status' => 'pending',
                'views' => 23,
                'images' => ['/images/land2.jpg', '/images/land2-1.jpg']
            ],
            [
                'user_id' => $user->id,
                'title' => 'أرض زراعية في الدمام',
                'land_type' => 'agricultural',
                'area' => 2000.00,
                'price' => 600000.00,
                'city' => 'dammam',
                'district' => 'طريق الملك فهد',
                'address' => 'طريق الملك فهد، الدمام',
                'transaction_type' => 'sale',
                'description' => 'أرض زراعية خصبة، مناسبة للاستثمار الزراعي والسياحي',
                'features' => ['services', 'flat', 'view'],
                'contact_name' => 'محمد عبدالله',
                'contact_phone' => '+966 54 456 7890',
                'contact_whatsapp' => '+966 54 456 7890',
                'contact_email' => 'mohammed@email.com',
                'desired_locations' => null,
                'status' => 'completed',
                'views' => 67,
                'images' => ['/images/land3.jpg']
            ],
            [
                'user_id' => $user->id,
                'title' => 'أرض سكنية في مكة المكرمة',
                'land_type' => 'residential',
                'area' => 750.00,
                'price' => 1200000.00,
                'city' => 'makkah',
                'district' => 'حي العزيزية',
                'address' => 'حي العزيزية، مكة المكرمة',
                'transaction_type' => 'sale',
                'description' => 'أرض سكنية في حي العزيزية، قريبة من الحرم المكي',
                'features' => ['services', 'paved', 'flat', 'security', 'view'],
                'contact_name' => 'علي أحمد',
                'contact_phone' => '+966 56 111 2222',
                'contact_whatsapp' => '+966 56 111 2222',
                'contact_email' => 'ali@email.com',
                'desired_locations' => null,
                'status' => 'active',
                'views' => 34,
                'images' => ['/images/land4.jpg']
            ],
            [
                'user_id' => $user->id,
                'title' => 'أرض تجارية في المدينة المنورة',
                'land_type' => 'commercial',
                'area' => 1200.00,
                'price' => 2000000.00,
                'city' => 'medina',
                'district' => 'شارع الملك عبدالله',
                'address' => 'شارع الملك عبدالله، المدينة المنورة',
                'transaction_type' => 'both',
                'description' => 'أرض تجارية في موقع مميز، مناسبة لمشروع تجاري كبير',
                'features' => ['services', 'paved', 'corner', 'security'],
                'contact_name' => 'سارة محمد',
                'contact_phone' => '+966 57 333 4444',
                'contact_whatsapp' => '+966 57 333 4444',
                'contact_email' => 'sara@email.com',
                'desired_locations' => [
                    [
                        'city' => 'jeddah',
                        'district' => 'حي الكورنيش',
                        'area' => 1000,
                        'details' => 'أرض تجارية في جدة'
                    ]
                ],
                'status' => 'active',
                'views' => 56,
                'images' => ['/images/land5.jpg']
            ],
            [
                'user_id' => $user->id,
                'title' => 'أرض زراعية في الطائف',
                'land_type' => 'agricultural',
                'area' => 3000.00,
                'price' => 450000.00,
                'city' => 'taif',
                'district' => 'طريق الهدا',
                'address' => 'طريق الهدا، الطائف',
                'transaction_type' => 'sale',
                'description' => 'أرض زراعية في الطائف، مناسبة للاستثمار الزراعي والسياحي',
                'features' => ['services', 'flat', 'view'],
                'contact_name' => 'خالد سعد',
                'contact_phone' => '+966 58 555 6666',
                'contact_whatsapp' => '+966 58 555 6666',
                'contact_email' => 'khalid@email.com',
                'desired_locations' => null,
                'status' => 'active',
                'views' => 28,
                'images' => ['/images/land6.jpg']
            ]
        ];

        foreach ($lands as $landData) {
            Land::create($landData);
        }
    }
}
