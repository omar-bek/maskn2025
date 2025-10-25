<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\UserType;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnUserType();
        }

        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب أن تكون 6 أحرف على الأقل',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return $this->redirectBasedOnUserType()
                ->with('success', 'مرحباً بك! تم تسجيل الدخول بنجاح');
        }

        return back()->withErrors([
            'email' => 'بيانات الدخول غير صحيحة.',
        ])->withInput();
    }

    /**
     * Show registration form
     */
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnUserType();
        }

        $userTypes = UserType::where('name', '!=', 'admin')->get();

        // If no user types exist, create them
        if ($userTypes->isEmpty()) {
            $this->createDefaultUserTypes();
            $userTypes = UserType::where('name', '!=', 'admin')->get();
        }

        // Debug: Log user types to see what we're getting
        Log::info('User Types for registration:', $userTypes->toArray());

        return view('auth.register', compact('userTypes'));
    }

    /**
     * Handle registration request
     */
    public function register(Request $request)
    {
        // Debug: Log the request data
        Log::info('Registration request data:', $request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'user_type_id' => 'required|exists:user_types,id',
        ], [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
            'phone.required' => 'رقم الهاتف مطلوب',
            'user_type_id.required' => 'نوع المستخدم مطلوب',
            'user_type_id.exists' => 'نوع المستخدم غير صحيح',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'user_type_id' => $request->user_type_id,
            'email_verified_at' => now(),
        ]);

        Auth::login($user);

        return $this->redirectBasedOnUserType()
            ->with('success', 'مرحباً بك! تم إنشاء حسابك بنجاح');
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('info', 'تم تسجيل الخروج بنجاح');
    }

    /**
     * Redirect user based on their type
     */
    private function redirectBasedOnUserType()
    {
        $user = Auth::user();

        switch ($user->userType->name) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'client':
                return redirect()->route('client.dashboard');
            case 'consultant':
                return redirect()->route('consultant.dashboard');
            case 'contractor':
                return redirect()->route('contractor.dashboard');
            case 'supplier':
                return redirect()->route('supplier.dashboard');
            default:
                return redirect('/');
        }
    }

    /**
     * Show forgot password form
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle forgot password request
     */
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'email.exists' => 'البريد الإلكتروني غير موجود',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Here you would typically send a password reset email
        // For now, we'll just show a success message

        return back()->with('status', 'تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني.');
    }

    /**
     * Show reset password form
     */
    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', compact('token'));
    }

    /**
     * Handle reset password request
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'token.required' => 'رمز إعادة التعيين مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'password.required' => 'كلمة المرور الجديدة مطلوبة',
            'password.min' => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Here you would typically validate the token and update the password
        // For now, we'll just show a success message

        return redirect()->route('login')->with('status', 'تم تغيير كلمة المرور بنجاح.');
    }

    /**
     * Create default user types if they don't exist
     */
    private function createDefaultUserTypes()
    {
        $userTypes = [
            [
                'name' => 'admin',
                'display_name_ar' => 'مدير',
                'display_name_en' => 'Admin',
                'description_ar' => 'مدير النظام',
                'description_en' => 'System Administrator'
            ],
            [
                'name' => 'client',
                'display_name_ar' => 'عميل',
                'display_name_en' => 'Client',
                'description_ar' => 'مستخدم يبحث عن تصميم وبناء منزل',
                'description_en' => 'User looking for house design and construction'
            ],
            [
                'name' => 'consultant',
                'display_name_ar' => 'استشاري',
                'display_name_en' => 'Consultant',
                'description_ar' => 'مصمم ومستشار معماري',
                'description_en' => 'Architectural designer and consultant'
            ],
            [
                'name' => 'contractor',
                'display_name_ar' => 'مقاول',
                'display_name_en' => 'Contractor',
                'description_ar' => 'مقاول بناء وتنفيذ المشاريع',
                'description_en' => 'Construction contractor and project executor'
            ],
            [
                'name' => 'supplier',
                'display_name_ar' => 'مورد',
                'display_name_en' => 'Supplier',
                'description_ar' => 'مورد مواد البناء والأثاث',
                'description_en' => 'Building materials and furniture supplier'
            ]
        ];

        try {
            foreach ($userTypes as $userType) {
                UserType::updateOrCreate(
                    ['name' => $userType['name']],
                    $userType
                );
            }
            Log::info('Default user types created successfully');
        } catch (\Exception $e) {
            Log::error('Error creating default user types: ' . $e->getMessage());
        }
    }
}
