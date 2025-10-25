<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء نوع المستخدم الإداري إذا لم يكن موجوداً
        $adminType = UserType::firstOrCreate(
            ['name' => 'admin'],
            [
                'name' => 'admin',
                'display_name' => 'مدير النظام',
                'description' => 'مدير النظام مع صلاحيات كاملة',
                'permissions' => json_encode([
                    'manage_users' => true,
                    'manage_designs' => true,
                    'manage_tenders' => true,
                    'manage_proposals' => true,
                    'manage_categories' => true,
                    'manage_settings' => true,
                    'view_analytics' => true,
                    'export_data' => true,
                    'system_maintenance' => true,
                ])
            ]
        );

        // إنشاء المستخدم الإداري
        $admin = User::firstOrCreate(
            ['email' => 'admin@inshaat.com'],
            [
                'name' => 'مدير النظام',
                'email' => 'admin@inshaat.com',
                'password' => Hash::make('admin123456'),
                'phone' => '+966501234567',
                'city' => 'الرياض',
                'user_type_id' => $adminType->id,
                'is_active' => true,
                'is_verified' => true,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // إنشاء أنواع المستخدمين الأخرى إذا لم تكن موجودة
        $userTypes = [
            [
                'name' => 'client',
                'display_name' => 'عميل',
                'description' => 'عميل يبحث عن تصميم أو بناء منزل',
                'permissions' => json_encode([
                    'create_tenders' => true,
                    'view_designs' => true,
                    'manage_profile' => true,
                ])
            ],
            [
                'name' => 'consultant',
                'display_name' => 'استشاري',
                'description' => 'استشاري معماري يقدم التصاميم والعروض',
                'permissions' => json_encode([
                    'create_designs' => true,
                    'submit_proposals' => true,
                    'manage_portfolio' => true,
                    'view_tenders' => true,
                ])
            ],
            [
                'name' => 'contractor',
                'display_name' => 'مقاول',
                'description' => 'مقاول بناء ينفذ المشاريع',
                'permissions' => json_encode([
                    'view_projects' => true,
                    'manage_team' => true,
                    'update_project_status' => true,
                ])
            ],
            [
                'name' => 'supplier',
                'display_name' => 'مورد',
                'description' => 'مورد مواد بناء وأثاث',
                'permissions' => json_encode([
                    'manage_products' => true,
                    'view_orders' => true,
                    'update_inventory' => true,
                ])
            ]
        ];

        foreach ($userTypes as $userType) {
            UserType::firstOrCreate(
                ['name' => $userType['name']],
                $userType
            );
        }

        $this->command->info('تم إنشاء المستخدم الإداري بنجاح!');
        $this->command->info('البريد الإلكتروني: admin@inshaat.com');
        $this->command->info('كلمة المرور: admin123456');
        $this->command->info('الرابط: /admin/dashboard');
    }
}
