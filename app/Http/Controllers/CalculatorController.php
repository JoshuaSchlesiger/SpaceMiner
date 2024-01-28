<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateRequest;
use App\Models\Ores;
use App\Models\Stations;
use App\Models\Methods;
use App\Models\Refinements;


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

        return view('Miner/calculator', ["ores" => $ores, 'stations' => $stations, 'methods' => $methods]);
    }

    public function calculate(CalculateRequest $request)
    {
        $data = $request->validated();

        $returnArray = ["valuableMass" => 0, "rawProfit" => 0, "costs" => 0, "refinedProfit" => 0, "duration" => 0, "unitCount" => 0];

        if($data["type"] === "rock"){
            if($data["massStone"] === 0){
                return response()->json(['success' => $returnArray]);
            }

            foreach ($data["oreTypes"] as $key => $value) {
                if(empty($value) || empty($data["oreInput"][$key])){
                    continue;
                }

                $oreValue = Ores::where("id", $value)->select("rawValue", "refinedValue")->get()->first();
                $returnArray["rawProfit"] += ($oreValue["rawValue"] * ($data["massStone"] * ($data["oreInput"][$key] / 100)));

                $returnArray["valuableMass"] += ($data["massStone"] * ($data["oreInput"][$key] / 100));


                $refinements = Refinements::where("ore_id", $value)->where("station_id", $data["station"])
                                            ->select("factorTime", "factorCosts", "factorYield")->get()->first();

                $methods = Methods::where("id", $data["refineryMethod"])
                                            ->select("factorTime", "factorCosts", "factorYield")->get()->first();

                $returnArray["refinedProfit"] += ($oreValue["refinedValue"] * ($data["massStone"] * ($data["oreInput"][$key] / 100)) * ($refinements["factorYield"] / 100) * $methods["factorYield"]);

                $unit = (($data["massStone"] * ($data["oreInput"][$key])) * ($refinements["factorYield"] / 100) * $methods["factorYield"]);
                                              //cSCU vom ERZ
                $returnArray["unitCount"] += $unit;
                $returnArray["costs"] += $unit * ($refinements["factorCosts"] / 100) * $methods["factorCosts"];
                $returnArray["duration"] += $methods["factorTime"] * $unit * ($refinements["factorTime"] / 100);
            }

            return response()->json(['success' => $returnArray]);
        }else if($data["type"] === "ship"){
            foreach ($data["oreTypes"] as $key => $value) {

                if(empty($value) || empty($data["oreInput"][$key])){
                    continue;
                }

                $oreValue = Ores::where("id", $value)->select("rawValue", "refinedValue")->get()->first();
                $returnArray["rawProfit"] += ($oreValue["rawValue"] * ($data["oreInput"][$key]));

                $returnArray["valuableMass"] += $data["oreInput"][$key];


                $refinements = Refinements::where("ore_id", $value)->where("station_id", $data["station"])
                                            ->select("factorTime", "factorCosts", "factorYield")->get()->first();

                $methods = Methods::where("id", $data["refineryMethod"])
                                            ->select("factorTime", "factorCosts", "factorYield")->get()->first();

                $returnArray["refinedProfit"] += ($oreValue["refinedValue"] * ($data["oreInput"][$key]) * ($refinements["factorYield"] / 100) * $methods["factorYield"]);

                $unit = ((($data["oreInput"][$key]*100)) * ($refinements["factorYield"] / 100) * $methods["factorYield"]);

                                              //cSCU vom ERZ
                $returnArray["unitCount"] += $unit;
                $returnArray["costs"] += $unit * ($refinements["factorCosts"] / 100) * $methods["factorCosts"];
                $returnArray["duration"] += $methods["factorTime"] * $unit * ($refinements["factorTime"] / 100);
            }

            return response()->json(['success' => $returnArray]);
        }else{
            return response()->json(['error' => 'Konnte den Typ nicht identifizieren']);
        }

        return response()->json(['error' => 'ara ara']);
    }
}
