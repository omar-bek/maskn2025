<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Land;
use App\Models\LandOffer;

class LandController extends Controller
{
    /**
     * عرض قائمة الأراضي
     */
    public function index(Request $request)
    {
        $query = Land::with('user')->active();

        // تطبيق الفلاتر
        if ($request->filled('city')) {
            $query->byCity($request->city);
        }

        if ($request->filled('land_type')) {
            $query->byType($request->land_type);
        }

        if ($request->filled('transaction_type')) {
            $query->byTransactionType($request->transaction_type);
        }

        $lands = $query->latest()->paginate(12);

        return view('lands.index', compact('lands'));
    }

    /**
     * عرض صفحة إنشاء أرض جديدة
     */
    public function create()
    {
        return view('lands.create');
    }

    /**
     * حفظ أرض جديدة
     */
    public function store(Request $request)
    {
        // التحقق من البيانات
        $request->validate([
            'title' => 'required|string|max:255',
            'land_type' => 'required|in:residential,commercial,agricultural,industrial',
            'area' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'transaction_type' => 'required|in:sale,exchange,both',
            'description' => 'required|string|min:10',
            'features' => 'nullable|array',
            'features.*' => 'string|in:services,paved,flat,corner,view,security',
            'contact_name' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:20',
            'contact_whatsapp' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'desired_cities' => 'nullable|array',
            'desired_cities.*' => 'string|max:255',
            'desired_districts' => 'nullable|array',
            'desired_districts.*' => 'string|max:255',
            'desired_areas' => 'nullable|array',
            'desired_areas.*' => 'numeric|min:1',
            'desired_details' => 'nullable|array',
            'desired_details.*' => 'string|max:500',
        ]);

        try {
            DB::beginTransaction();

            // تجهيز بيانات المواقع المرغوبة
            $desiredLocations = [];
            if ($request->filled('desired_cities')) {
                foreach ($request->desired_cities as $index => $city) {
                    if (!empty($city)) {
                        $desiredLocations[] = [
                            'city' => $city,
                            'district' => $request->desired_districts[$index] ?? '',
                            'area' => $request->desired_areas[$index] ?? null,
                            'details' => $request->desired_details[$index] ?? ''
                        ];
                    }
                }
            }

            // تجهيز بيانات الصور
            $images = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('lands', 'public');
                    $images[] = '/storage/' . $path;
                }
            }

            // إنشاء الأرض
            $land = Land::create([
                'user_id' => Auth::id(),
                'title' => $request->title,
                'land_type' => $request->land_type,
                'area' => $request->area,
                'price' => $request->price,
                'city' => $request->city,
                'district' => $request->district,
                'address' => $request->address,
                'transaction_type' => $request->transaction_type,
                'description' => $request->description,
                'features' => $request->features,
                'contact_name' => $request->contact_name,
                'contact_phone' => $request->contact_phone,
                'contact_whatsapp' => $request->contact_whatsapp,
                'contact_email' => $request->contact_email,
                'desired_locations' => $desiredLocations,
                'images' => $images,
                'status' => 'active'
            ]);

            DB::commit();

            return redirect()->route('lands.my-ads')
                ->with('success', 'تم إضافة الأرض بنجاح! يمكنك الآن متابعة إعلانك في صفحة إعلاناتي.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'حدث خطأ أثناء حفظ الأرض. يرجى المحاولة مرة أخرى.');
        }
    }

    /**
     * عرض تفاصيل أرض معينة
     */
    public function show($id)
    {
        $land = Land::with(['user', 'offers'])->findOrFail($id);

        // زيادة عدد المشاهدات
        $land->increment('views');

        return view('lands.show', compact('land'));
    }

    /**
     * عرض صفحة تعديل أرض
     */
    public function edit($id)
    {
        $land = Land::findOrFail($id);

        // التحقق من أن المستخدم يملك الأرض
        if ($land->user_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بتعديل هذه الأرض');
        }

        return view('lands.edit', compact('land'));
    }

    /**
     * تحديث أرض
     */
    public function update(Request $request, $id)
    {
        $land = Land::findOrFail($id);

        // التحقق من أن المستخدم يملك الأرض
        if ($land->user_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بتعديل هذه الأرض');
        }

        // التحقق من البيانات
        $request->validate([
            'title' => 'required|string|max:255',
            'land_type' => 'required|in:residential,commercial,agricultural,industrial',
            'area' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'transaction_type' => 'required|in:sale,exchange,both',
            'description' => 'required|string|min:10',
            'features' => 'nullable|array',
            'features.*' => 'string|in:services,paved,flat,corner,view,security',
            'contact_name' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:20',
            'contact_whatsapp' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'desired_cities' => 'nullable|array',
            'desired_cities.*' => 'string|max:255',
            'desired_districts' => 'nullable|array',
            'desired_districts.*' => 'string|max:255',
            'desired_areas' => 'nullable|array',
            'desired_areas.*' => 'numeric|min:1',
            'desired_details' => 'nullable|array',
            'desired_details.*' => 'string|max:500',
        ]);

        try {
            DB::beginTransaction();

            // تجهيز بيانات المواقع المرغوبة
            $desiredLocations = [];
            if ($request->filled('desired_cities')) {
                foreach ($request->desired_cities as $index => $city) {
                    if (!empty($city)) {
                        $desiredLocations[] = [
                            'city' => $city,
                            'district' => $request->desired_districts[$index] ?? '',
                            'area' => $request->desired_areas[$index] ?? null,
                            'details' => $request->desired_details[$index] ?? ''
                        ];
                    }
                }
            }

            // تجهيز بيانات الصور
            $images = $land->images ?? [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('lands', 'public');
                    $images[] = '/storage/' . $path;
                }
            }

            // تحديث الأرض
            $land->update([
                'title' => $request->title,
                'land_type' => $request->land_type,
                'area' => $request->area,
                'price' => $request->price,
                'city' => $request->city,
                'district' => $request->district,
                'address' => $request->address,
                'transaction_type' => $request->transaction_type,
                'description' => $request->description,
                'features' => $request->features,
                'contact_name' => $request->contact_name,
                'contact_phone' => $request->contact_phone,
                'contact_whatsapp' => $request->contact_whatsapp,
                'contact_email' => $request->contact_email,
                'desired_locations' => $desiredLocations,
                'images' => $images
            ]);

            DB::commit();

            return redirect()->route('lands.my-ads')
                ->with('success', 'تم تحديث الإعلان بنجاح!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'حدث خطأ أثناء تحديث الأرض. يرجى المحاولة مرة أخرى.');
        }
    }

    /**
     * عرض إعلانات المستخدم
     */
    public function myAds()
    {
        $myLands = Land::where('user_id', Auth::id())
            ->withCount('offers')
            ->latest()
            ->get();

        return view('lands.my-ads', compact('myLands'));
    }

    /**
     * عرض العروض المقدمة على أراضي المستخدم
     */
    public function myOffers()
    {
        $offers = LandOffer::with(['land', 'offerer'])
            ->whereHas('land', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->latest()
            ->get();

        return view('lands.my-offers', compact('offers'));
    }

    /**
     * تحديث حالة العرض (قبول/رفض)
     */
    public function updateOfferStatus(Request $request, $offerId)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected'
        ]);

        $offer = LandOffer::with('land')->findOrFail($offerId);

        // التحقق من أن المستخدم يملك الأرض
        if ($offer->land->user_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بتحديث هذا العرض');
        }

        $offer->update(['status' => $request->status]);

        $status = $request->status === 'accepted' ? 'مقبول' : 'مرفوض';

        return redirect()->route('lands.my-offers')
            ->with('success', "تم $status العرض بنجاح!");
    }

    /**
     * حذف إعلان
     */
    public function destroy($id)
    {
        $land = Land::findOrFail($id);

        // التحقق من أن المستخدم يملك الأرض
        if ($land->user_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بحذف هذه الأرض');
        }

        try {
            // حذف الصور من التخزين
            if ($land->images) {
                foreach ($land->images as $image) {
                    $path = str_replace('/storage/', '', $image);
                    if (Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->delete($path);
                    }
                }
            }

            $land->delete();

            return redirect()->route('lands.my-ads')
                ->with('success', 'تم حذف الإعلان بنجاح!');

        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء حذف الإعلان. يرجى المحاولة مرة أخرى.');
        }
    }

    /**
     * تقديم عرض على أرض
     */
    public function submitOffer(Request $request, $landId)
    {
        $land = Land::findOrFail($landId);

        // التحقق من أن المستخدم لا يقدم عرض على أرضه
        if ($land->user_id === Auth::id()) {
            return back()->with('error', 'لا يمكنك تقديم عرض على أرضك الخاصة');
        }

        $request->validate([
            'offer_type' => 'required|in:purchase,exchange',
            'offer_price' => 'nullable|numeric|min:1',
            'offer_message' => 'required|string|min:10',
            'offerer_name' => 'required|string|max:255',
            'offerer_phone' => 'required|string|max:20',
            'offerer_email' => 'nullable|email|max:255',
        ]);

        try {
            LandOffer::create([
                'land_id' => $land->id,
                'offerer_id' => Auth::id(),
                'offer_type' => $request->offer_type,
                'offer_price' => $request->offer_price,
                'offer_message' => $request->offer_message,
                'offerer_name' => $request->offerer_name,
                'offerer_phone' => $request->offerer_phone,
                'offerer_email' => $request->offerer_email,
                'status' => 'pending'
            ]);

            return redirect()->route('lands.show', $land->id)
                ->with('success', 'تم تقديم عرضك بنجاح! سيتم التواصل معك قريباً.');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'حدث خطأ أثناء تقديم العرض. يرجى المحاولة مرة أخرى.');
        }
    }

    /**
     * عرض صفحة تقديم عرض
     */
    public function showSubmitOffer($landId)
    {
        $land = Land::findOrFail($landId);

        // التحقق من أن المستخدم لا يقدم عرض على أرضه
        if ($land->user_id === Auth::id()) {
            return redirect()->route('lands.show', $land->id)
                ->with('error', 'لا يمكنك تقديم عرض على أرضك الخاصة');
        }

        return view('lands.submit-offer', compact('land'));
    }
}
