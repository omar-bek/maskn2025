<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'category_name' => 'الاعمال التحضيرية',
                'category_order' => 1,
                'description' => 'أعمال الحفر والتأسيس والتحضير للمشروع'
            ],
            [
                'category_name' => 'أعمال الحفر والخرسانة أسفل منسوب الدور الأرضي',
                'category_order' => 2,
                'description' => 'أعمال الحفر والخرسانة تحت الأرض'
            ],
            [
                'category_name' => 'أعمال الخرسانة للدور الأرضي وما فوق',
                'category_order' => 3,
                'description' => 'أعمال الخرسانة للأدوار الأرضية والعليا'
            ],
            [
                'category_name' => 'أعمال الطابوق',
                'category_order' => 4,
                'description' => 'أعمال بناء الجدران بالطابوق'
            ],
            [
                'category_name' => 'أعمال العزل',
                'category_order' => 5,
                'description' => 'أعمال العزل الحراري والمائي'
            ],
            [
                'category_name' => 'أعمال التشطيب',
                'category_order' => 6,
                'description' => 'أعمال التشطيب الداخلي والخارجي'
            ],
            [
                'category_name' => 'أعمال النجارة',
                'category_order' => 7,
                'description' => 'أعمال النجارة والأخشاب'
            ],
            [
                'category_name' => 'أعمال الألومنيوم والزجاج',
                'category_order' => 8,
                'description' => 'أعمال الألومنيوم والنوافذ والزجاج'
            ],
            [
                'category_name' => 'أعمال الكهرباء',
                'category_order' => 9,
                'description' => 'أعمال الشبكات الكهربائية والإضاءة'
            ],
            [
                'category_name' => 'أعمال التكييف',
                'category_order' => 10,
                'description' => 'أعمال أنظمة التكييف والتهوية'
            ],
            [
                'category_name' => 'أعمال الصحية',
                'category_order' => 11,
                'description' => 'أعمال شبكات المياه والصرف الصحي'
            ],
            [
                'category_name' => 'الأعمال الخارجية',
                'category_order' => 12,
                'description' => 'أعمال الحدائق والأسوار والطرق'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
