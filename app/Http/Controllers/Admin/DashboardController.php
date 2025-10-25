<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Design;
use App\Models\Tender;
use App\Models\Proposal;
use App\Models\Category;
use App\Models\Item;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // إحصائيات عامة
        $stats = [
            'total_users' => User::count(),
            'total_consultants' => User::whereHas('userType', function ($query) {
                $query->where('name', 'consultant');
            })->count(),
            'total_clients' => User::whereHas('userType', function ($query) {
                $query->where('name', 'client');
            })->count(),
            'total_designs' => Design::count(),
            'total_tenders' => Tender::count(),
            'total_proposals' => Proposal::count(),
            'active_tenders' => Tender::where('status', 'open')->count(),
            'completed_tenders' => Tender::where('status', 'awarded')->count(),
        ];

        // إحصائيات المستخدمين الجدد (آخر 30 يوم)
        $newUsers = User::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        $newDesigns = Design::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        $newTenders = Tender::where('created_at', '>=', Carbon::now()->subDays(30))->count();

        // المستخدمين الجدد (آخر 7 أيام)
        $recentUsers = User::with('userType')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // التصاميم الجديدة
        $recentDesigns = Design::with('consultant')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // المناقصات الجديدة
        $recentTenders = Tender::with(['client', 'design'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // إحصائيات الشهر الحالي
        $monthlyStats = [
            'users_this_month' => User::whereMonth('created_at', Carbon::now()->month)->count(),
            'designs_this_month' => Design::whereMonth('created_at', Carbon::now()->month)->count(),
            'tenders_this_month' => Tender::whereMonth('created_at', Carbon::now()->month)->count(),
            'proposals_this_month' => Proposal::whereMonth('created_at', Carbon::now()->month)->count(),
        ];

        // إحصائيات الأرباح (إذا كان هناك نظام دفع)
        $revenueStats = [
            'total_revenue' => 0, // سيتم تطويرها لاحقاً
            'monthly_revenue' => 0,
            'pending_payments' => 0,
        ];

        // توزيع المستخدمين حسب النوع
        $userTypeDistribution = User::join('user_types', 'users.user_type_id', '=', 'user_types.id')
            ->select('user_types.name', DB::raw('count(*) as count'))
            ->groupBy('user_types.name')
            ->get();

        // توزيع المناقصات حسب الحالة
        $tenderStatusDistribution = Tender::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        // توزيع العروض حسب الحالة
        $proposalStatusDistribution = Proposal::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'newUsers',
            'newDesigns',
            'newTenders',
            'recentUsers',
            'recentDesigns',
            'recentTenders',
            'monthlyStats',
            'revenueStats',
            'userTypeDistribution',
            'tenderStatusDistribution',
            'proposalStatusDistribution'
        ));
    }

    public function users()
    {
        $users = User::with('userType')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function designs()
    {
        $designs = Design::with('consultant')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.designs.index', compact('designs'));
    }

    public function tenders()
    {
        $tenders = Tender::with(['client', 'design', 'proposals'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.tenders.index', compact('tenders'));
    }

    public function proposals()
    {
        $proposals = Proposal::with(['tender', 'consultant'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.proposals.index', compact('proposals'));
    }

    public function categories()
    {
        $categories = Category::withCount('items')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.categories.index', compact('categories'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
        ]);

        $user->update($validated);

        return redirect()->back()->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }

    public function settings()
    {
        return view('admin.settings.index');
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'required|string|max:500',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string|max:20',
            'maintenance_mode' => 'boolean',
        ]);

        // حفظ الإعدادات في قاعدة البيانات أو ملف الإعدادات
        // يمكن استخدام Laravel Settings package أو إنشاء جدول settings

        return redirect()->route('admin.settings')->with('success', 'تم تحديث الإعدادات بنجاح');
    }

    public function toggleUserStatus(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'مفعل' : 'معطل';
        return redirect()->back()->with('success', "تم {$status} المستخدم بنجاح");
    }

    public function deleteUser(User $user)
    {
        // حذف المستخدم مع جميع البيانات المرتبطة
        $user->delete();

        return redirect()->back()->with('success', 'تم حذف المستخدم بنجاح');
    }

    public function toggleDesignStatus(Design $design)
    {
        $design->update(['is_published' => !$design->is_published]);

        $status = $design->is_published ? 'نشر' : 'إلغاء نشر';
        return redirect()->back()->with('success', "تم {$status} التصميم بنجاح");
    }

    public function deleteDesign(Design $design)
    {
        $design->delete();

        return redirect()->back()->with('success', 'تم حذف التصميم بنجاح');
    }

    public function closeTender(Tender $tender)
    {
        $tender->update(['status' => 'closed']);

        return redirect()->back()->with('success', 'تم إغلاق المناقصة بنجاح');
    }

    public function deleteTender(Tender $tender)
    {
        $tender->delete();

        return redirect()->back()->with('success', 'تم حذف المناقصة بنجاح');
    }

    public function deleteProposal(Proposal $proposal)
    {
        $proposal->delete();

        return redirect()->back()->with('success', 'تم حذف العرض بنجاح');
    }

    public function exportUsers()
    {
        // تصدير المستخدمين إلى Excel (سيتم تطويرها لاحقاً)
        return redirect()->back()->with('info', 'ميزة التصدير قيد التطوير');
    }

    public function exportTenders()
    {
        // تصدير المناقصات إلى Excel (سيتم تطويرها لاحقاً)
        return redirect()->back()->with('info', 'ميزة التصدير قيد التطوير');
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category_order' => 'nullable|integer|min:0',
        ]);

        Category::create($validated);

        return redirect()->route('admin.categories')->with('success', 'تم إضافة الفئة بنجاح');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category_order' => 'nullable|integer|min:0',
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories')->with('success', 'تم تحديث الفئة بنجاح');
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('success', 'تم حذف الفئة بنجاح');
    }

    public function clearCache($type)
    {
        try {
            switch ($type) {
                case 'config':
                    Artisan::call('config:clear');
                    break;
                case 'route':
                    Artisan::call('route:clear');
                    break;
                case 'view':
                    Artisan::call('view:clear');
                    break;
                default:
                    return response()->json(['success' => false, 'message' => 'نوع التخزين المؤقت غير صحيح']);
            }

            return response()->json(['success' => true, 'message' => 'تم مسح التخزين المؤقت بنجاح']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء مسح التخزين المؤقت']);
        }
    }

    public function createBackup()
    {
        try {
            // إنشاء نسخة احتياطية من قاعدة البيانات
            Artisan::call('backup:run');

            return response()->json(['success' => true, 'message' => 'تم إنشاء النسخة الاحتياطية بنجاح']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء إنشاء النسخة الاحتياطية']);
        }
    }

    public function optimizeDatabase()
    {
        try {
            // تحسين قاعدة البيانات
            Artisan::call('migrate:optimize');

            return response()->json(['success' => true, 'message' => 'تم تحسين قاعدة البيانات بنجاح']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء تحسين قاعدة البيانات']);
        }
    }

    // إدارة صور الموقع
    public function siteImages()
    {
        $images = SiteSetting::where('type', 'image')->get();
        return view('admin.site-images', compact('images'));
    }

    public function uploadSiteImage(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            // حذف الصورة القديمة إذا كانت موجودة
            $oldSetting = SiteSetting::where('key', $request->key)->first();
            if ($oldSetting && $oldSetting->value) {
                Storage::delete($oldSetting->value);
            }

            // رفع الصورة الجديدة
            $path = $request->file('image')->store('site-images', 'public');

            // حفظ المسار في قاعدة البيانات
            SiteSetting::set($request->key, $path, 'image');

            return response()->json([
                'success' => true,
                'message' => 'تم رفع الصورة بنجاح',
                'url' => Storage::url($path)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء رفع الصورة: ' . $e->getMessage()
            ]);
        }
    }

    public function deleteSiteImage(Request $request)
    {
        $request->validate([
            'key' => 'required|string'
        ]);

        try {
            $setting = SiteSetting::where('key', $request->key)->first();

            if ($setting && $setting->value) {
                // حذف الملف من التخزين
                Storage::delete($setting->value);

                // حذف السجل من قاعدة البيانات
                $setting->update(['value' => null]);
            }

            return response()->json([
                'success' => true,
                'message' => 'تم حذف الصورة بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حذف الصورة: ' . $e->getMessage()
            ]);
        }
    }

    public function updateSiteSettings(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'required|string|max:500',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string|max:20',
            'contact_address' => 'required|string|max:255',
            'maintenance_mode' => 'boolean',
        ]);

        try {
            // تحديث الإعدادات النصية
            SiteSetting::set('site_name', $request->site_name);
            SiteSetting::set('site_description', $request->site_description);
            SiteSetting::set('contact_email', $request->contact_email);
            SiteSetting::set('contact_phone', $request->contact_phone);
            SiteSetting::set('contact_address', $request->contact_address);
            SiteSetting::set('maintenance_mode', $request->maintenance_mode ? '1' : '0');

            // تحديث وسائل التواصل الاجتماعي
            if ($request->has('social_media')) {
                SiteSetting::set('social_media', json_encode($request->social_media), 'json');
            }

            // تحديث الألوان
            if ($request->has('site_colors')) {
                SiteSetting::set('site_colors', json_encode($request->site_colors), 'json');
            }

            return redirect()->back()->with('success', 'تم تحديث إعدادات الموقع بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث الإعدادات: ' . $e->getMessage());
        }
    }
}
