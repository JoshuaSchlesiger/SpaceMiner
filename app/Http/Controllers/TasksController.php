<?php

namespace App\Http\Controllers;

use App\Models\Ores;
use App\Models\Stations;
use App\Models\Methods;

use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ores = Ores::orderByDesc('refinedValue')
            ->select('id', 'name')
            ->get();

        $stations = Stations::orderBy('name')
            ->select('id', 'name')
            ->get();

        $methods = Methods::orderBy('factorYield', 'desc')
            ->orderBy('factorCosts')
            ->select('id', 'name')
            ->get();

        return view('Miner/task', ["ores" => $ores, 'stations' => $stations, 'methods' => $methods]);
    }
}
