<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Whitecube\LaravelCookieConsent\Facades\Cookies;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Cookie as Cookie2;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request)
    {
        if ($request->has('language')) {
            $language = $request->input('language');
            $view = $request->input('view');
            if ($language === "EN") {
                Session::put('app_locale', 'de');
                $cookie = $this->changeCookieLanguage("de");
                if (is_null($cookie)) {
                    return redirect()->route($view);
                }
                return redirect()->route($view)->withCookie($cookie);
            } else {
                $cookie = $this->changeCookieLanguage("en");
                Session::put('app_locale', 'en');
                if (is_null($cookie)) {
                    return redirect()->route($view);
                }
                return redirect()->route($view)->withCookie($cookie);
            }
        }

        return response()->json(['success' => true]);
    }

    private function changeCookieLanguage(String $lang): ?Cookie2
    {
        if (Cookies::hasConsentFor('language_remember')) {
            $cookie = Cookie::make('language', strtoupper($lang), 999999);
            return $cookie;
        } else {
            Session::put('language', strtoupper($lang));
            return null;
        }
    }
}
