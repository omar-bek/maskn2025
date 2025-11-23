<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LandOffer;
use App\Models\Land;
use App\Models\User;

class LandOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create users for testing
        $landOwner = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'أحمد محمد',
                'password' => bcrypt('password'),
                'user_type_id' => 1
            ]
        );

        $offerer1 = User::firstOrCreate(
            ['email' => 'offerer1@example.com'],
            [
                'name' => 'محمد علي',
                'password' => bcrypt('password'),
                'user_type_id' => 1
            ]
        );

        $offerer2 = User::firstOrCreate(
            ['email' => 'offerer2@example.com'],
            [
                'name' => 'فاطمة أحمد',
                'password' => bcrypt('password'),
                'user_type_id' => 1
            ]
        );

        $offerer3 = User::firstOrCreate(
            ['email' => 'offerer3@example.com'],
            [
                'name' => 'علي سعد',
                'password' => bcrypt('password'),
                'user_type_id' => 1
            ]
        );

        // Get lands
        $lands = Land::all();

        if ($lands->count() > 0) {
            $offers = [
                [
                    'land_id' => $lands[0]->id, // أرض سكنية في الرياض
                    'offerer_id' => $offerer1->id,
                    'offer_type' => 'purchase',
                    'offer_price' => 750000.00,
                    'offer_message' => 'أهلاً، أنا مهتم بأرضك وأريد شراءها بسعر 750,000 درهم. هل يمكننا التواصل لمناقشة التفاصيل؟',
                    'offerer_name' => 'محمد علي',
                    'offerer_phone' => '+966 50 123 4567',
                    'offerer_email' => 'mohammed@email.com',
                    'status' => 'pending'
                ],
                [
                    'land_id' => $lands[1]->id, // أرض تجارية في جدة
                    'offerer_id' => $offerer2->id,
                    'offer_type' => 'exchange',
                    'offer_price' => null,
                    'offer_message' => 'لدي أرض في الرياض مساحتها 600 متر مربع وأريد تبادلها مع أرضك. الأرض في حي مميز وجميع الخدمات متوفرة.',
                    'offerer_name' => 'فاطمة أحمد',
                    'offerer_phone' => '+966 55 987 6543',
                    'offerer_email' => 'fatima@email.com',
                    'status' => 'accepted'
                ],
                [
                    'land_id' => $lands[2]->id, // أرض زراعية في الدمام
                    'offerer_id' => $offerer3->id,
                    'offer_type' => 'purchase',
                    'offer_price' => 580000.00,
                    'offer_message' => 'أريد شراء الأرض بسعر 580,000 درهم نقداً. هل يمكننا الاتفاق على هذا السعر؟',
                    'offerer_name' => 'علي سعد',
                    'offerer_phone' => '+966 54 456 7890',
                    'offerer_email' => 'ali@email.com',
                    'status' => 'rejected'
                ],
                [
                    'land_id' => $lands[0]->id, // أرض سكنية في الرياض
                    'offerer_id' => $offerer2->id,
                    'offer_type' => 'purchase',
                    'offer_price' => 780000.00,
                    'offer_message' => 'أهلاً، أريد شراء الأرض بسعر 780,000 درهم. أنا جاد في الشراء ويمكنني إتمام الصفقة بسرعة.',
                    'offerer_name' => 'فاطمة أحمد',
                    'offerer_phone' => '+966 55 987 6543',
                    'offerer_email' => 'fatima@email.com',
                    'status' => 'pending'
                ],
                [
                    'land_id' => $lands[4]->id, // أرض تجارية في المدينة المنورة
                    'offerer_id' => $offerer1->id,
                    'offer_type' => 'purchase',
                    'offer_price' => 1900000.00,
                    'offer_message' => 'أهلاً، أنا مهتم بأرضك التجارية وأريد شراءها بسعر 1,900,000 درهم. هل يمكننا التواصل؟',
                    'offerer_name' => 'محمد علي',
                    'offerer_phone' => '+966 50 123 4567',
                    'offerer_email' => 'mohammed@email.com',
                    'status' => 'pending'
                ]
            ];

            foreach ($offers as $offerData) {
                LandOffer::create($offerData);
            }
        }
    }
}
