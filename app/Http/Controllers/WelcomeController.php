<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */

    public function index()
    {
        $locale = Session::get('app_locale', 'en');
        App::setLocale($locale);

        return view('Miner/welcome');
    }
}
