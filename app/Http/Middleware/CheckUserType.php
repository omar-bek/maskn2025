<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $userType): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول أولاً');
        }

        $user = Auth::user();

        // Check if user is active
        if (!$user->is_active) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'حسابك غير مفعل. يرجى التواصل مع الإدارة');
        }

        // Check if user has the required user type
        if (!$user->userType || $user->userType->name !== $userType) {
            // Log unauthorized access attempt
            \Illuminate\Support\Facades\Log::warning('Unauthorized access attempt', [
                'user_id' => $user->id,
                'user_type' => $user->userType?->name,
                'required_type' => $userType,
                'url' => $request->fullUrl(),
                'ip' => $request->ip()
            ]);

            // Redirect to appropriate dashboard based on user type
            return redirect($user->getDashboardRoute())->with('error', 'غير مصرح لك بالوصول إلى هذه الصفحة');
        }

        return $next($request);
    }
}
