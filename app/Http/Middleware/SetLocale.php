<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * The locales supported by the application.
     *
     * @var array<int, string>
     */
    protected array $supportedLocales = ['ar', 'en'];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale');

        if (! is_string($locale) || ! in_array($locale, $this->supportedLocales, true)) {
            $locale = config('app.locale');
        }

        app()->setLocale($locale);
        if (method_exists($request, 'setLocale')) {
            $request->setLocale($locale);
        }

        return $next($request);
    }
}

