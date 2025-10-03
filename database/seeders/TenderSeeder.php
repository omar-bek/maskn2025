<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tender;
use App\Models\User;
use App\Models\Design;
use App\Models\Proposal;

class TenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = User::whereHas('userType', function($q) {
            $q->where('name', 'client');
        })->get();

        $designs = Design::published()->get();

        if ($clients->isEmpty() || $designs->isEmpty()) {
            $this->command->info('No clients or designs found. Skipping tender seeding.');
            return;
        }

        $tenders = [
            [
                'title' => 'مناقصة بناء فيلا عصرية في الرياض',
                'description' => 'نبحث عن استشاري متخصص لبناء فيلا عصرية فاخرة في حي النرجس بالرياض. المشروع يتطلب تصميم عصري مع استخدام مواد عالية الجودة.',
                'requirements' => 'خبرة لا تقل عن 5 سنوات في بناء الفلل العصرية، استخدام مواد عالية الجودة، ضمان 3 سنوات على البناء',
                'budget' => 800000,
                'location' => 'الرياض، حي النرجس',
                'deadline' => now()->addDays(30),
                'status' => 'open'
            ],
            [
                'title' => 'مناقصة بناء بيت إسلامي تقليدي',
                'description' => 'مطلوب استشاري متخصص في البناء الإسلامي التقليدي لبناء بيت عائلي في جدة. نركز على الأصالة والتراث المعماري الإسلامي.',
                'requirements' => 'خبرة في العمارة الإسلامية، استخدام المواد التقليدية، تصميم يلائم المناخ الحار',
                'budget' => 600000,
                'location' => 'جدة، حي الزهراء',
                'deadline' => now()->addDays(25),
                'status' => 'open'
            ],
            [
                'title' => 'مناقصة بناء شقة عصرية في الدمام',
                'description' => 'نبحث عن استشاري لبناء شقة عصرية مكونة من 3 غرف نوم في الدمام. نركز على الاستغلال الأمثل للمساحة والتصميم العصري.',
                'requirements' => 'خبرة في بناء الشقق السكنية، تصميم عصري وعملي، استخدام تقنيات البناء الحديثة',
                'budget' => 400000,
                'location' => 'الدمام، حي الفيصلية',
                'deadline' => now()->addDays(20),
                'status' => 'open'
            ],
            [
                'title' => 'مناقصة بناء قصر فاخر في الخبر',
                'description' => 'مطلوب استشاري متخصص لبناء قصر فاخر على مساحة كبيرة في الخبر. المشروع يتطلب تصميم فاخر مع جميع المرافق الحديثة.',
                'requirements' => 'خبرة في بناء القصور الفاخرة، استخدام أفضل المواد، تصميم فاخر ومميز',
                'budget' => 1200000,
                'location' => 'الخبر، حي الشاطئ',
                'deadline' => now()->addDays(45),
                'status' => 'open'
            ]
        ];

        foreach ($tenders as $tenderData) {
            $tender = Tender::create([
                'client_id' => $clients->random()->id,
                'design_id' => $designs->random()->id,
                'title' => $tenderData['title'],
                'description' => $tenderData['description'],
                'requirements' => $tenderData['requirements'],
                'budget' => $tenderData['budget'],
                'location' => $tenderData['location'],
                'deadline' => $tenderData['deadline'],
                'status' => $tenderData['status'],
                'is_featured' => rand(0, 1),
                'views_count' => rand(10, 100)
            ]);

            // Add some proposals for some tenders
            if (rand(0, 1)) {
                $consultants = User::whereHas('userType', function($q) {
                    $q->where('name', 'consultant');
                })->get();

                $proposalsCount = rand(1, 4);
                $selectedConsultants = $consultants->random($proposalsCount);

                foreach ($selectedConsultants as $consultant) {
                    Proposal::create([
                        'tender_id' => $tender->id,
                        'consultant_id' => $consultant->id,
                        'proposal_text' => 'نحن متخصصون في هذا النوع من المشاريع ولدينا خبرة واسعة في المجال. نقدم أفضل الخدمات بأعلى معايير الجودة.',
                        'proposed_price' => $tender->budget * (0.8 + (rand(0, 40) / 100)), // 80% to 120% of budget
                        'duration_months' => rand(6, 24),
                        'terms_conditions' => 'ضمان 3 سنوات، استخدام مواد عالية الجودة، تسليم في الموعد المحدد',
                        'status' => 'pending'
                    ]);
                }
            }
        }

        $this->command->info('تم إنشاء ' . count($tenders) . ' مناقصة بنجاح!');
    }
}
