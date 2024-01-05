<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */

    public function index()
    {
        if(Cookie::get('language') === 'DE'){
            $locale = "de";
            App::setLocale($locale);
            Session::put("app_locale", "de");
        }else{
            $locale = Session::get('app_locale', 'en');
            App::setLocale($locale);

        }

        return view('Miner/welcome');
    }
}
