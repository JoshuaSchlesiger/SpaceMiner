<?php

namespace App\Http\Controllers;

use App\Models\Ores;
use App\Models\Stations;
use App\Models\Methods;
use App\Models\Refinements;
use Illuminate\Support\Carbon;
use App\Models\Tasks;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTasksRequest;

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

    public function save(StoreTasksRequest $request)
    {
        Info($request->all());

        $userInputs = $request->all();


        $task = $this->calTaskValues($userInputs);
        $task["user_id"] = $request->user()->id;
        Tasks::create($task);



        if ($request->has('action') && $request->input('action') == 'saveToDashboard') {

            return redirect()->route('dashboard');
        }

        return redirect()->route('task')->with('success', 'Das Formular wurde erfolgreich gesendet!');;
    }

    private function calTaskValues(array $userInputs): array
    {
        $task = [];
        $task['station_id'] = $userInputs['refineryStation'];
        $task['method_id'] = $userInputs['method'];
        $task['actualCosts'] = $userInputs['costs'];
        $task['minerRation'] = $userInputs['payoutRatio'];

        $currentTime = Carbon::now();
        list($hours, $minutes) = explode(":", $userInputs['duration']);
        $currentTime->addHours($hours)->addMinutes($minutes);
        $task['actualCompletionDate'] = $currentTime->toDateTime();

        $task['visible'] = true;

        $task["calculatedProceeds"] = 0;
        $task["calculatedCosts"] = 0;
        $task["calculatedCompletionDate"] = 0;

        foreach ($userInputs['oreTypes'] as $key => $oreTyeID) {

            $oreValue = Ores::where("id", $oreTyeID)->select("rawValue", "refinedValue")->get()->first();
            $refinement = Refinements::where("ore_id", $oreTyeID)->where("station_id", $userInputs["refineryStation"])
                ->select("factorTime", "factorCosts", "factorYield")->get()->first();
            $method = Methods::where("id", $userInputs["method"])
                ->select("factorTime", "factorCosts", "factorYield")->get()->first();


            $task["calculatedProceeds"] += ($oreValue["refinedValue"] * ($userInputs["oreUnits"][$key] / 100)) * ($refinement["factorYield"] / 100) * $method["factorYield"];
            $task["calculatedCosts"] += $userInputs["oreUnits"][$key] * ($refinement["factorCosts"] / 100) * $method["factorCosts"];
            $task["calculatedCompletionDate"] += $method["factorTime"] * $userInputs["oreUnits"][$key] * ($refinement["factorTime"] / 100);
        }

        $currentTime->addMinutes($task["calculatedCompletionDate"]);
        $task['calculatedCompletionDate'] = $currentTime->toDateTime();

        return $task;
    }
}
