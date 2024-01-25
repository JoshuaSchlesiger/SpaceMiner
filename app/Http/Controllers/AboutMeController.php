<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class AboutMeController extends Controller
{
    public function index()
    {
       return view('Miner/aboutme');
    }
}
