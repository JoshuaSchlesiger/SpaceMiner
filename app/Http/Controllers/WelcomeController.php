<?php

namespace App\Http\Controllers;
use Whitecube\LaravelCookieConsent\Facades\Cookies;


class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // app()->setLocale('de');
        return view('Miner/welcome');
    }
}
