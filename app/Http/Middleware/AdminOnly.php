<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
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

        // Check if user is admin
        if (!$user->userType || $user->userType->name !== 'admin') {
            // Log unauthorized access attempt
            \Illuminate\Support\Facades\Log::warning('Unauthorized admin access attempt', [
                'user_id' => $user->id,
                'user_type' => $user->userType?->name,
                'url' => $request->fullUrl(),
                'ip' => $request->ip()
            ]);

            // Redirect to appropriate dashboard based on user type
            $dashboardRoute = $user->userType ?
                match ($user->userType->name) {
                    'client' => route('client.dashboard'),
                    'consultant' => route('consultant.dashboard'),
                    'contractor' => route('contractor.dashboard'),
                    'supplier' => route('supplier.dashboard'),
                    default => route('home')
                } : route('home');

            return redirect($dashboardRoute)->with('error', 'غير مصرح لك بالوصول إلى لوحة الإدارة');
        }

        return $next($request);
    }
}
