<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get user types
        $adminType = UserType::where('name', 'admin')->first();
        $clientType = UserType::where('name', 'client')->first();
        $consultantType = UserType::where('name', 'consultant')->first();
        $contractorType = UserType::where('name', 'contractor')->first();
        $supplierType = UserType::where('name', 'supplier')->first();

        // Admin Users
        User::create([
            'name' => 'أحمد العلي',
            'email' => 'admin@inshaat.com',
            'password' => Hash::make('password'),
            'user_type_id' => $adminType->id,
            'phone' => '+966501234567',
            'email_verified_at' => now(),
        ]);

        // Client Users
        User::create([
            'name' => 'محمد أحمد',
            'email' => 'client@example.com',
            'password' => Hash::make('password'),
            'user_type_id' => $clientType->id,
            'phone' => '+966502345678',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'فاطمة علي',
            'email' => 'client2@example.com',
            'password' => Hash::make('password'),
            'user_type_id' => $clientType->id,
            'phone' => '+966503456789',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'عبدالله محمد',
            'email' => 'client3@example.com',
            'password' => Hash::make('password'),
            'user_type_id' => $clientType->id,
            'phone' => '+966504567890',
            'email_verified_at' => now(),
        ]);

        // Consultant Users
        User::create([
            'name' => 'د. سارة الخالد',
            'email' => 'consultant@example.com',
            'password' => Hash::make('password'),
            'user_type_id' => $consultantType->id,
            'phone' => '+966505678901',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'م. أحمد المعماري',
            'email' => 'consultant2@example.com',
            'password' => Hash::make('password'),
            'user_type_id' => $consultantType->id,
            'phone' => '+966506789012',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'م. فهد الدوسري',
            'email' => 'consultant3@example.com',
            'password' => Hash::make('password'),
            'user_type_id' => $consultantType->id,
            'phone' => '+966507890123',
            'email_verified_at' => now(),
        ]);

        // Contractor Users
        User::create([
            'name' => 'شركة البناء المتحدة',
            'email' => 'contractor@example.com',
            'password' => Hash::make('password'),
            'user_type_id' => $contractorType->id,
            'phone' => '+966508901234',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'مؤسسة الإنشاءات الحديثة',
            'email' => 'contractor2@example.com',
            'password' => Hash::make('password'),
            'user_type_id' => $contractorType->id,
            'phone' => '+966509012345',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'شركة المقاولات المتقدمة',
            'email' => 'contractor3@example.com',
            'password' => Hash::make('password'),
            'user_type_id' => $contractorType->id,
            'phone' => '+966500123456',
            'email_verified_at' => now(),
        ]);

        // Supplier Users
        User::create([
            'name' => 'مؤسسة مواد البناء',
            'email' => 'supplier@example.com',
            'password' => Hash::make('password'),
            'user_type_id' => $supplierType->id,
            'phone' => '+966501234567',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'شركة الأدوات الحديثة',
            'email' => 'supplier2@example.com',
            'password' => Hash::make('password'),
            'user_type_id' => $supplierType->id,
            'phone' => '+966502345678',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'مؤسسة التجهيزات الفاخرة',
            'email' => 'supplier3@example.com',
            'password' => Hash::make('password'),
            'user_type_id' => $supplierType->id,
            'phone' => '+966503456789',
            'email_verified_at' => now(),
        ]);

        $this->command->info('تم إنشاء 13 مستخدم بنجاح!');
        $this->command->info('بيانات تسجيل الدخول:');
        $this->command->info('Admin: admin@inshaat.com / password');
        $this->command->info('Client: client@example.com / password');
        $this->command->info('Consultant: consultant@example.com / password');
        $this->command->info('Contractor: contractor@example.com / password');
        $this->command->info('Supplier: supplier@example.com / password');
    }
}
