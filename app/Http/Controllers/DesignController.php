<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DesignController extends Controller
{
    public function index()
    {
        $designs = [
            [
                'id' => 1,
                'title' => 'فيلا عصرية فاخرة',
                'style' => 'عصري',
                'price' => '500,000',
                'area' => '400 متر مربع',
                'image' => '/images/design1.jpg',
                'description' => 'تصميم فيلا عصرية مع حديقة خارجية وموقف سيارات',
                'architect' => 'أحمد محمد',
                'rating' => 4.8
            ],
            [
                'id' => 2,
                'title' => 'بيت إسلامي تقليدي',
                'style' => 'إسلامي',
                'price' => '300,000',
                'area' => '250 متر مربع',
                'image' => '/images/design2.jpg',
                'description' => 'تصميم بيت إسلامي مع فنون عربية أصيلة',
                'architect' => 'فاطمة علي',
                'rating' => 4.9
            ],
            [
                'id' => 3,
                'title' => 'شقة حديثة أنيقة',
                'style' => 'حديث',
                'price' => '200,000',
                'area' => '120 متر مربع',
                'image' => '/images/design3.jpg',
                'description' => 'تصميم شقة حديثة مع ديكورات عصرية',
                'architect' => 'محمد حسن',
                'rating' => 4.7
            ],
            [
                'id' => 4,
                'title' => 'قصر إسلامي فاخر',
                'style' => 'إسلامي',
                'price' => '1,200,000',
                'area' => '800 متر مربع',
                'image' => '/images/design4.jpg',
                'description' => 'قصر إسلامي مع حدائق وبرك مياه',
                'architect' => 'علي أحمد',
                'rating' => 5.0
            ]
        ];

        return view('designs.index', compact('designs'));
    }

    public function show($id)
    {
        $design = [
            'id' => $id,
            'title' => 'فيلا عصرية فاخرة',
            'style' => 'عصري',
            'price' => '500,000',
            'area' => '400 متر مربع',
            'bedrooms' => 5,
            'bathrooms' => 4,
            'floors' => 3,
            'image' => '/images/design1.jpg',
            'description' => 'تصميم فيلا عصرية مع حديقة خارجية وموقف سيارات. الفيلا تتكون من 3 طوابق مع إطلالة رائعة على المدينة.',
            'architect' => 'أحمد محمد',
            'rating' => 4.8,
            'features' => [
                'حديقة خارجية',
                'موقف سيارات',
                'مطبخ مجهز',
                'غرفة معيشة واسعة',
                'مسبح خاص',
                'مصعد داخلي'
            ],
            'images' => [
                '/images/design1-1.jpg',
                '/images/design1-2.jpg',
                '/images/design1-3.jpg'
            ]
        ];

        return view('designs.show', compact('design'));
    }

    public function create()
    {
        return view('designs.create');
    }

    public function store(Request $request)
    {
        // سيتم إضافة التحقق من البيانات وحفظها لاحقاً
        return redirect()->route('designs.index')->with('success', 'تم إضافة التصميم بنجاح');
    }
}


