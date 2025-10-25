<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserType;
use App\Models\Category;
use App\Models\Design;
use App\Models\Tender;
use App\Models\Proposal;
use Illuminate\Support\Facades\Hash;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء مستخدمين تجريبيين
        $clientType = UserType::where('name', 'client')->first();
        $consultantType = UserType::where('name', 'consultant')->first();

        // إنشاء عميل تجريبي
        $client = User::firstOrCreate(
            ['email' => 'client@example.com'],
            [
                'name' => 'أحمد محمد',
                'email' => 'client@example.com',
                'password' => Hash::make('password'),
                'phone' => '+966501234567',
                'city' => 'الرياض',
                'user_type_id' => $clientType->id,
                'is_active' => true,
                'is_verified' => true,
                'email_verified_at' => now(),
            ]
        );

        // إنشاء استشاري تجريبي
        $consultant = User::firstOrCreate(
            ['email' => 'consultant@example.com'],
            [
                'name' => 'د. سارة أحمد',
                'email' => 'consultant@example.com',
                'password' => Hash::make('password'),
                'phone' => '+966501234568',
                'city' => 'جدة',
                'user_type_id' => $consultantType->id,
                'is_active' => true,
                'is_verified' => true,
                'email_verified_at' => now(),
            ]
        );

        // إنشاء فئات تجريبية
        $categories = [
            [
                'category_name' => 'الأساسات والهيكل',
                'description' => 'جميع أعمال الأساسات والهيكل الخرساني',
                'category_order' => 1,
            ],
            [
                'category_name' => 'البناء والطوب',
                'description' => 'أعمال البناء والطوب والجدران',
                'category_order' => 2,
            ],
            [
                'category_name' => 'الأسقف والجدران',
                'description' => 'أعمال الأسقف والجدران الداخلية',
                'category_order' => 3,
            ],
            [
                'category_name' => 'السباكة والكهرباء',
                'description' => 'أعمال السباكة والكهرباء',
                'category_order' => 4,
            ],
            [
                'category_name' => 'الدهانات والتشطيبات',
                'description' => 'أعمال الدهانات والتشطيبات النهائية',
                'category_order' => 5,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::firstOrCreate(
                ['category_name' => $categoryData['category_name']],
                $categoryData
            );
        }

        // إنشاء تصاميم تجريبية
        $designs = [
            [
                'title' => 'فيلا عصرية 3 غرف',
                'style' => 'عصري',
                'price' => 150000,
                'area' => 250,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'floors' => 2,
                'description' => 'تصميم فيلا عصرية أنيقة بثلاث غرف نوم وصالتين مع حديقة صغيرة',
                'features' => json_encode(['حديقة', 'موقف سيارات', 'شرفة']),
                'consultant_name' => $consultant->name,
                'consultant_phone' => $consultant->phone,
                'consultant_email' => $consultant->email,
                'location' => 'الرياض',
                'main_image' => 'designs/villa1.jpg',
                'images' => json_encode(['designs/villa1-1.jpg', 'designs/villa1-2.jpg']),
                'consultant_id' => $consultant->id,
                'status' => 'published',
                'is_featured' => true,
            ],
            [
                'title' => 'بيت إسلامي تقليدي',
                'style' => 'إسلامي',
                'price' => 200000,
                'area' => 300,
                'bedrooms' => 4,
                'bathrooms' => 3,
                'floors' => 2,
                'description' => 'تصميم بيت إسلامي تقليدي بأربع غرف نوم مع فناء داخلي',
                'features' => json_encode(['فناء داخلي', 'مصلى', 'حديقة']),
                'consultant_name' => $consultant->name,
                'consultant_phone' => $consultant->phone,
                'consultant_email' => $consultant->email,
                'location' => 'مكة المكرمة',
                'main_image' => 'designs/islamic1.jpg',
                'images' => json_encode(['designs/islamic1-1.jpg', 'designs/islamic1-2.jpg']),
                'consultant_id' => $consultant->id,
                'status' => 'published',
                'is_featured' => false,
            ],
        ];

        foreach ($designs as $designData) {
            Design::firstOrCreate(
                ['title' => $designData['title']],
                $designData
            );
        }

        // إنشاء مناقصات تجريبية
        $design1 = Design::first();
        $design2 = Design::skip(1)->first();

        $tenders = [
            [
                'title' => 'بناء فيلا عصرية في الرياض',
                'description' => 'نرغب في بناء فيلا عصرية حسب التصميم المرفق مع مراعاة أعلى معايير الجودة',
                'requirements' => 'استخدام مواد عالية الجودة، اتباع المواصفات الهندسية بدقة',
                'budget' => 500000,
                'location' => 'الرياض - حي النرجس',
                'deadline' => now()->addDays(30),
                'client_notes' => 'نرغب في البدء في أقرب وقت ممكن',
                'design_id' => $design1->id,
                'client_id' => $client->id,
                'status' => 'open',
            ],
            [
                'title' => 'بناء بيت إسلامي في مكة',
                'description' => 'مشروع بناء بيت إسلامي تقليدي مع الحفاظ على الطابع الإسلامي الأصيل',
                'requirements' => 'استخدام المواد التقليدية، اتباع التصميم الإسلامي بدقة',
                'budget' => 600000,
                'location' => 'مكة المكرمة - حي العزيزية',
                'deadline' => now()->addDays(45),
                'client_notes' => 'المشروع له طابع ديني خاص',
                'design_id' => $design2->id,
                'client_id' => $client->id,
                'status' => 'open',
            ],
        ];

        foreach ($tenders as $tenderData) {
            Tender::firstOrCreate(
                ['title' => $tenderData['title']],
                $tenderData
            );
        }

        // إنشاء عروض تجريبية
        $tender1 = Tender::first();
        $tender2 = Tender::skip(1)->first();

        $proposals = [
            [
                'tender_id' => $tender1->id,
                'consultant_id' => $consultant->id,
                'proposal_text' => 'نقدم لكم عرضنا المتميز لبناء الفيلا العصرية مع ضمان الجودة العالية والالتزام بالمواعيد المحددة',
                'proposed_price' => 480000,
                'duration_months' => 6,
                'status' => 'pending',
            ],
            [
                'tender_id' => $tender2->id,
                'consultant_id' => $consultant->id,
                'proposal_text' => 'نحن متخصصون في البناء الإسلامي التقليدي ونتعهد بتقديم أفضل جودة مع الحفاظ على الطابع الإسلامي',
                'proposed_price' => 580000,
                'duration_months' => 7,
                'status' => 'pending',
            ],
        ];

        foreach ($proposals as $proposalData) {
            Proposal::firstOrCreate(
                [
                    'tender_id' => $proposalData['tender_id'],
                    'consultant_id' => $proposalData['consultant_id'],
                ],
                $proposalData
            );
        }

        $this->command->info('تم إنشاء البيانات التجريبية بنجاح!');
        $this->command->info('العميل التجريبي: client@example.com / password');
        $this->command->info('الاستشاري التجريبي: consultant@example.com / password');
        $this->command->info('تم إنشاء ' . count($categories) . ' فئة');
        $this->command->info('تم إنشاء ' . count($designs) . ' تصميم');
        $this->command->info('تم إنشاء ' . count($tenders) . ' مناقصة');
        $this->command->info('تم إنشاء ' . count($proposals) . ' عرض');
    }
}
