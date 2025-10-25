<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Support\Facades\Hash;

class FixAdminSeeder extends Seeder
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

        // حذف المستخدم الإداري القديم إذا كان موجوداً
        User::where('email', 'admin@inshaat.com')->delete();

        // إنشاء المستخدم الإداري الجديد
        $admin = User::create([
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
        ]);

        $this->command->info('تم إنشاء المستخدم الإداري بنجاح!');
        $this->command->info('البريد الإلكتروني: admin@inshaat.com');
        $this->command->info('كلمة المرور: admin123456');
        $this->command->info('الرابط: /admin/dashboard');
        $this->command->info('نوع المستخدم: ' . $admin->userType->name);
        $this->command->info('الحالة: ' . ($admin->is_active ? 'نشط' : 'غير نشط'));
    }
}
