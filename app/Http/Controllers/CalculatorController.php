<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateRequest;
use App\Models\Ores;
use App\Models\Stations;
use App\Models\Methods;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class CalculatorController extends Controller
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

        return view('Miner/Calculator', ["ores" => $ores, 'stations' => $stations, 'methods' => $methods]);
    }

    public function calculate(CalculateRequest $request)
    {
        $data = json_decode(($request->validated())["data"]);
        //Log::alert(print_r($data, true));

        $returnArray = ["valuableMass" => 0, "rawProfit" => 0, "costs" => 0, "refinedProfit" => 0, "duration" => 0, "unitCount" => 0];

        if($data->type === "rock"){
            if(empty($data->massStone) || $data->massStone === 0){
                return response()->json(['success' => $returnArray]);
            }

            $returnArray["valuableMass"] = $data->massStone;

            foreach ($data->oreTypes as $key => $value) {
                if(empty($value) || empty($data->oreInput[$key])){
                    continue;
                }
                
                $oreValue = Ores::where("id", $value)->select("rawValue", "refinedValue")->get()->first();
                $returnArray["rawProfit"] += ($oreValue->rawValue * $data->oreInput[$key]);
                
            }

            return response()->json(['success' => $returnArray]);
        }else if($data->type === "ship"){

        }else{
            return response()->json(['error' => 'Konnte den Typ nicht identifizieren']);
        }

        return response()->json(['success' => 'Abigail']);
    }
}
