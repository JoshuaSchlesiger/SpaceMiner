<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $locale = Session::get('app_locale', 'en');
        App::setLocale($locale);

       return view('Miner/privacypolicy');
    }
}
