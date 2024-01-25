<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Cookie::get('language') === 'DE'){
            $locale = "de";
            App::setLocale($locale);
            Session::put("app_locale", "de");
        }else{
            $locale = Session::get('app_locale', 'en');
            App::setLocale($locale);
        }
        return $next($request);
    }
}
