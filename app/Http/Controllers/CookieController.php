<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Whitecube\LaravelCookieConsent\Facades\Cookies;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class CookieController extends Controller
{
    public static function language($view): ?Response
    {
        if (Cookies::hasConsentFor('language_remember')) {
            if (!Cookie::has("language")) {
                $cookie = Cookie::make('language', 'EN', 999999);
                app()->setLocale('en');
                return response()->view($view)->withCookie($cookie);
            }
        } else {
            if (!Session::exists("language")) {
                Session::put('language', "EN");
                app()->setLocale('en');
            }
        }
        return null;
    }

    public static function changeLanguage(String $lang){
        if (Cookies::hasConsentFor('language_remember')) {
            if (!Cookie::has("language")) {
                $cookie = Cookie::make('language', strtoupper($lang), 999999);
                app()->setLocale($lang);
            }
        } else {
            if (!Session::exists("language")) {
                Session::put('language', strtoupper($lang));
                app()->setLocale($lang);
            }
        }
    }
}
