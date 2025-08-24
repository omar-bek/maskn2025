<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // سيتم إضافة البيانات من قاعدة البيانات لاحقاً
        $featuredDesigns = [
            [
                'id' => 1,
                'title' => 'فيلا عصرية فاخرة',
                'style' => 'عصري',
                'price' => '500,000',
                'area' => '400 متر مربع',
                'image' => '/images/design1.jpg',
                'description' => 'تصميم فيلا عصرية مع حديقة خارجية وموقف سيارات'
            ],
            [
                'id' => 2,
                'title' => 'بيت إسلامي تقليدي',
                'style' => 'إسلامي',
                'price' => '300,000',
                'area' => '250 متر مربع',
                'image' => '/images/design2.jpg',
                'description' => 'تصميم بيت إسلامي مع فنون عربية أصيلة'
            ],
            [
                'id' => 3,
                'title' => 'شقة حديثة أنيقة',
                'style' => 'حديث',
                'price' => '200,000',
                'area' => '120 متر مربع',
                'image' => '/images/design3.jpg',
                'description' => 'تصميم شقة حديثة مع ديكورات عصرية'
            ]
        ];

        return view('home', compact('featuredDesigns'));
    }
}


