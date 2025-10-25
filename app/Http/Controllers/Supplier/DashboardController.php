<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\User;
// Note: Project model import removed as it doesn't exist
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get supplier statistics from database
        $stats = [
            'available_products' => 50, // Will be implemented when products table is created
            'monthly_orders' => 25, // Will be implemented when orders table is created
            'monthly_revenue' => 150000, // Will be implemented when orders table is created
            'low_stock_products' => 3, // Will be implemented when inventory table is created
            'available_projects' => 0, // Will be implemented when projects table is created
        ];

        // Get recent orders (simulated for now)
        $recentOrders = [
            [
                'id' => 'ORD-001',
                'customer' => 'علي أحمد',
                'status' => 'pending',
                'total' => '15,000'
            ],
            [
                'id' => 'ORD-002',
                'customer' => 'سارة محمد',
                'status' => 'processing',
                'total' => '25,000'
            ],
            [
                'id' => 'ORD-003',
                'customer' => 'محمد حسن',
                'status' => 'shipped',
                'total' => '18,000'
            ]
        ];

        // Get low stock products
        $lowStockProducts = [
            [
                'name' => 'أسمنت بورتلاند',
                'stock' => 50,
                'min_stock' => 100
            ],
            [
                'name' => 'حديد تسليح',
                'stock' => 25,
                'min_stock' => 80
            ]
        ];

        // Get low stock alerts
        $lowStockAlerts = [
            [
                'name' => 'أسمنت بورتلاند',
                'stock' => 50
            ],
            [
                'name' => 'حديد تسليح',
                'stock' => 25
            ],
            [
                'name' => 'طوب أحمر',
                'stock' => 15
            ]
        ];

        // Get available projects for suppliers (simulated for now)
        $availableProjects = [
            [
                'title' => 'مشروع بناء فيلا',
                'client' => 'أحمد محمد',
                'location' => 'الرياض',
                'budget' => '500,000 ريال',
                'date' => 'منذ يومين'
            ],
            [
                'title' => 'تطوير مجمع سكني',
                'client' => 'سارة أحمد',
                'location' => 'جدة',
                'budget' => '1,200,000 ريال',
                'date' => 'منذ أسبوع'
            ]
        ];

        return view('supplier.dashboard', compact('stats', 'recentOrders', 'lowStockProducts', 'lowStockAlerts', 'availableProjects'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('supplier.profile', compact('user'));
    }

    public function products()
    {
        $products = []; // Will be implemented later
        return view('supplier.products', compact('products'));
    }

    public function orders()
    {
        $orders = []; // Will be implemented later
        return view('supplier.orders', compact('orders'));
    }

    public function inventory()
    {
        $inventory = []; // Will be implemented later
        return view('supplier.inventory', compact('inventory'));
    }

    public function revenue()
    {
        $revenue = []; // Will be implemented later
        return view('supplier.revenue', compact('revenue'));
    }

    public function catalog()
    {
        $catalog = []; // Will be implemented later
        return view('supplier.catalog', compact('catalog'));
    }
}
