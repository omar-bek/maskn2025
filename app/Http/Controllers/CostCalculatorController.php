<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CostCalculatorController extends Controller
{
    public function index()
    {
        return view('cost-calculator.index');
    }

    public function calculate(Request $request)
    {
        // سيتم إضافة منطق حساب التكلفة لاحقاً
        $data = $request->all();

        // حساب تقديري بسيط
        $area = $request->input('area', 0);
        $propertyType = $request->input('property_type', 'residential');
        $style = $request->input('style', 'modern');

        // أسعار تقديرية لكل متر مربع حسب النوع
        $pricePerSqm = [
            'residential' => [
                'modern' => 2500,
                'classic' => 2200,
                'traditional' => 2000
            ],
            'commercial' => [
                'modern' => 3500,
                'classic' => 3200,
                'traditional' => 3000
            ],
            'villa' => [
                'modern' => 4000,
                'classic' => 3800,
                'traditional' => 3500
            ]
        ];

        $basePrice = $pricePerSqm[$propertyType][$style] ?? 2500;
        $estimatedCost = $area * $basePrice;

        return response()->json([
            'estimated_cost' => number_format($estimatedCost),
            'price_per_sqm' => number_format($basePrice),
            'area' => $area,
            'property_type' => $propertyType,
            'style' => $style
        ]);
    }

    public function createProject(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'property_type' => 'required|in:residential,commercial,villa',
            'style' => 'required|in:modern,classic,traditional',
            'area' => 'required|numeric|min:1',
            'location' => 'required|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
            'estimated_cost' => 'required|numeric|min:0',
            'budget_min' => 'nullable|numeric|min:0',
            'budget_max' => 'nullable|numeric|min:0|gte:budget_min',
        ]);

        $project = \App\Models\Project::create([
            'client_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'property_type' => $request->property_type,
            'style' => $request->style,
            'area' => $request->area,
            'location' => $request->location,
            'neighborhood' => $request->neighborhood,
            'estimated_cost' => $request->estimated_cost,
            'budget_min' => $request->budget_min,
            'budget_max' => $request->budget_max,
            'status' => 'draft'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'تم إنشاء المشروع بنجاح',
            'project_id' => $project->id,
            'redirect_url' => route('projects.show', $project)
        ]);
    }
}
