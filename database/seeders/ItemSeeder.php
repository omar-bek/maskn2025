<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Category;
use App\Models\Project;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories
        $categories = Category::all()->keyBy('category_name');

        // Get first project for sample data
        $project = Project::first();

        if (!$project) {
            return; // No projects to seed items for
        }

        $sampleItems = [
            // الأعمال التحضيرية
            'الأعمال التحضيرية' => [
                [
                    'item_name' => 'حفر وتأسيس القواعد',
                    'quantity' => 150.00,
                    'unit' => 'م³',
                    'unit_price' => 25.00,
                    'item_order' => 1,
                    'notes' => 'حفر يدوي وميكانيكي'
                ],
                [
                    'item_name' => 'صب القواعد المسلحة',
                    'quantity' => 120.00,
                    'unit' => 'م³',
                    'unit_price' => 450.00,
                    'item_order' => 2,
                    'notes' => 'خرسانة عادية ومسلحة'
                ],
                [
                    'item_name' => 'الردم حول القواعد',
                    'quantity' => 80.00,
                    'unit' => 'م³',
                    'unit_price' => 15.00,
                    'item_order' => 3
                ]
            ],

            // الأعمال الإنشائية
            'الأعمال الإنشائية' => [
                [
                    'item_name' => 'بناء الجدران الخارجية',
                    'quantity' => 200.00,
                    'unit' => 'م²',
                    'unit_price' => 85.00,
                    'item_order' => 1,
                    'notes' => 'طوب أحمر عادي'
                ],
                [
                    'item_name' => 'بناء الجدران الداخلية',
                    'quantity' => 150.00,
                    'unit' => 'م²',
                    'unit_price' => 65.00,
                    'item_order' => 2,
                    'notes' => 'طوب خفيف'
                ],
                [
                    'item_name' => 'صب الأعمدة المسلحة',
                    'quantity' => 25.00,
                    'unit' => 'م³',
                    'unit_price' => 480.00,
                    'item_order' => 3,
                    'notes' => 'خرسانة مسلحة'
                ],
                [
                    'item_name' => 'صب البلاطات المسلحة',
                    'quantity' => 180.00,
                    'unit' => 'م²',
                    'unit_price' => 120.00,
                    'item_order' => 4,
                    'notes' => 'بلاطات خرسانية مسلحة'
                ]
            ],

            // أعمال التشطيبات
            'أعمال التشطيبات' => [
                [
                    'item_name' => 'تبييض الجدران الداخلية',
                    'quantity' => 350.00,
                    'unit' => 'م²',
                    'unit_price' => 12.00,
                    'item_order' => 1,
                    'notes' => 'تبييض بالجير'
                ],
                [
                    'item_name' => 'دهان الجدران الداخلية',
                    'quantity' => 350.00,
                    'unit' => 'م²',
                    'unit_price' => 18.00,
                    'item_order' => 2,
                    'notes' => 'دهان أكريليك'
                ],
                [
                    'item_name' => 'بلاط أرضيات الصالات',
                    'quantity' => 80.00,
                    'unit' => 'م²',
                    'unit_price' => 45.00,
                    'item_order' => 3,
                    'notes' => 'بلاط سيراميك'
                ],
                [
                    'item_name' => 'بلاط أرضيات المطابخ والحمامات',
                    'quantity' => 40.00,
                    'unit' => 'م²',
                    'unit_price' => 55.00,
                    'item_order' => 4,
                    'notes' => 'بلاط مقاوم للماء'
                ]
            ],

            // أعمال السباكة
            'أعمال السباكة' => [
                [
                    'item_name' => 'تركيب شبكة المياه الرئيسية',
                    'quantity' => 100.00,
                    'unit' => 'م',
                    'unit_price' => 35.00,
                    'item_order' => 1,
                    'notes' => 'مواسير PVC'
                ],
                [
                    'item_name' => 'تركيب شبكة الصرف الصحي',
                    'quantity' => 80.00,
                    'unit' => 'م',
                    'unit_price' => 40.00,
                    'item_order' => 2,
                    'notes' => 'مواسير PVC للمجاري'
                ],
                [
                    'item_name' => 'تركيب الأدوات الصحية',
                    'quantity' => 6.00,
                    'unit' => 'قطعة',
                    'unit_price' => 350.00,
                    'item_order' => 3,
                    'notes' => 'مراحيض وحمامات'
                ]
            ],

            // أعمال الكهرباء
            'أعمال الكهرباء' => [
                [
                    'item_name' => 'تركيب شبكة الكهرباء الرئيسية',
                    'quantity' => 120.00,
                    'unit' => 'م',
                    'unit_price' => 25.00,
                    'item_order' => 1,
                    'notes' => 'كابلات نحاسية'
                ],
                [
                    'item_name' => 'تركيب لوحات الكهرباء',
                    'quantity' => 3.00,
                    'unit' => 'قطعة',
                    'unit_price' => 450.00,
                    'item_order' => 2,
                    'notes' => 'لوحات توزيع رئيسية'
                ],
                [
                    'item_name' => 'تركيب مفاتيح الإضاءة',
                    'quantity' => 25.00,
                    'unit' => 'قطعة',
                    'unit_price' => 35.00,
                    'item_order' => 3,
                    'notes' => 'مفاتيح عادية ومزدوجة'
                ]
            ]
        ];

        foreach ($sampleItems as $categoryName => $items) {
            $category = $categories[$categoryName] ?? null;

            if ($category) {
                foreach ($items as $itemData) {
                    $itemData['project_id'] = $project->id;
                    $itemData['category_id'] = $category->id;
                    $itemData['total_price'] = $itemData['quantity'] * $itemData['unit_price'];

                    Item::create($itemData);
                }
            }
        }
    }
}
