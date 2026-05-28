<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        // Keep Filament admin panel always in English
        if ($request->is('admin') || $request->is('admin/*') || $request->is('livewire/*')) {
            app()->setLocale('en');
            return $next($request);
        }

        $locale = session('locale', config('app.locale'));
        
        if (!in_array($locale, ['en', 'id'])) {
            $locale = config('app.locale');
        }
        
        app()->setLocale($locale);
        
        return $next($request);
    }
}