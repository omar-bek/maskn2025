<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userTypes = [
            [
                'name' => 'admin',
                'display_name_ar' => 'مدير',
                'display_name_en' => 'Admin',
                'description_ar' => 'مدير النظام',
                'description_en' => 'System Administrator'
            ],
            [
                'name' => 'client',
                'display_name_ar' => 'عميل',
                'display_name_en' => 'Client',
                'description_ar' => 'مستخدم يبحث عن تصميم وبناء منزل',
                'description_en' => 'User looking for house design and construction'
            ],
            [
                'name' => 'consultant',
                'display_name_ar' => 'استشاري',
                'display_name_en' => 'Consultant',
                'description_ar' => 'مصمم ومستشار معماري',
                'description_en' => 'Architectural designer and consultant'
            ],
            [
                'name' => 'contractor',
                'display_name_ar' => 'مقاول',
                'display_name_en' => 'Contractor',
                'description_ar' => 'مقاول بناء وتنفيذ المشاريع',
                'description_en' => 'Construction contractor and project executor'
            ],
            [
                'name' => 'supplier',
                'display_name_ar' => 'مورد',
                'display_name_en' => 'Supplier',
                'description_ar' => 'مورد مواد البناء والأثاث',
                'description_en' => 'Building materials and furniture supplier'
            ]
        ];

        foreach ($userTypes as $userType) {
            UserType::updateOrCreate(
                ['name' => $userType['name']],
                $userType
            );
        }
    }
}
