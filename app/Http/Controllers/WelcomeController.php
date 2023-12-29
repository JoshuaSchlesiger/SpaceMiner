<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CookieController;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->has('language')) {

            $language = $request->input('language');
            if($language === "EN"){
                CookieController::changeLanguage("de");
            }else{
                CookieController::changeLanguage("en");
            }

        }

        $language = CookieController::language('Miner/welcome');
        if (!is_null($language)) {
            return $language;
        }
        return view('Miner/welcome');
    }
}
