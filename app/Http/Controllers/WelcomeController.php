<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        if(Cookies::hasConsentFor('password_remember')) {
            Info("password_remember bestätigt");
        }


        return view('Miner/welcome');
    }
}
