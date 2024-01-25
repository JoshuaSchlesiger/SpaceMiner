<?php

namespace App\Http\Controllers;

use App\Models\Ores;
use App\Models\Stations;
use App\Models\Methods;
use App\Models\Refinements;
use App\Models\TasksOres;
use Illuminate\Support\Carbon;
use App\Models\Tasks;

use Illuminate\Cache\RateLimiter;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTasksRequest;
use App\Models\TasksUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;

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
        $lastTask = Tasks::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastTask && now()->diffInSeconds($lastTask->created_at) < 30) {
            return redirect()->back()->withInput($request->except('password'))->with('error', Lang::get('task.ratelimit.task.create'));
        }

        $userInputs = $request->all();
        $task = $this->calTaskValues($userInputs);
        $task["user_id"] = $request->user()->id;

        $neueTaskId = Tasks::create($task)->id;

        $combination["OresUnits"] = $this->combineTaskOresUnits($userInputs, $neueTaskId);
        $tasks_ores["task_id"] = $neueTaskId;
        foreach ($combination["OresUnits"] as $type => $units) {
            $tasks_ores["units"] = $units;
            $tasks_ores["ore_id"] = $type;
            TasksOres::create($tasks_ores);
        }

        $taskUsers["task_id"] = $neueTaskId;
        $taskUsers["paid"] = false;
        $taskUsers["visability"] = true;

        foreach ($userInputs["selectMiner"] as $key => $name) {
            $taskUsers["username"] = $name;
            $taskUsers["type"] = "miner";
            TasksUsers::create($taskUsers);
        }

        if (isset($userInputs["selectScout"])) {
            foreach ($userInputs["selectScout"] as $key => $name) {
                $taskUsers["username"] = $name;
                $taskUsers["type"] = "scout";
                TasksUsers::create($taskUsers);
            }
        }

        if ($request->has('action') && $request->input('action') == 'saveToDashboard') {

            return redirect()->route('dashboard');
        }

        return redirect()->route('task')->with('success', Lang::get('task.task.create'));
    }

    //Get old group
    public function ajaxFunction(Request $request)
    {
        $key = $request->ip(); // Verwende die IP-Adresse des Benutzers als Schlüssel

        $rateLimiter = app(RateLimiter::class);
        $maxAttempts = 3;
        $decaySeconds = 30;

        $rateLimiter->hit($key, $decaySeconds);

        // Überprüfe, ob die Rate-Limit überschritten wurde
        if ($rateLimiter->tooManyAttempts($key, $maxAttempts)) {
            return response()->json(['error' => Lang::get('task.oldgroup.ratelimit')]);
        }


        if (Auth::check()) {
            $user = Auth::user();
            $userId = $user->id;

            $lastTask = Tasks::select("id")->where("user_id", $userId)->orderBy("created_at", "DESC")->first();

            if (empty($lastTask)) {
                return response()->json([
                    'error' => Lang::get('task.oldgroup.exists')
                ]);
            }

            $miner = TasksUsers::where("task_id", $lastTask->id)->where("type", "miner")->pluck("username")->toArray();
            $scouts = TasksUsers::where("task_id", $lastTask->id)->where("type", "scout")->pluck("username")->toArray();

            // Gib eine JSON-Antwort zurück
            return response()->json([
                'miner' => $miner,
                'scouts' => $scouts
            ]);
        }
    }

    /**
     * Berechnet die Werte für die Task. Dazu gilt Zuweisung der Inputs und Berechnung durch Formeln
     */
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

    private function combineTaskOresUnits(array $userInputs, int $taskID): array
    {

        $combinedArray = array();

        // Kombiniere die Werte von oreTypes und oreUnits
        for ($i = 0; $i < count($userInputs['oreTypes']); $i++) {
            $oreType = $userInputs['oreTypes'][$i];
            $oreUnit = $userInputs['oreUnits'][$i];

            // Überprüfe, ob der Erztyp bereits im kombinierten Array existiert
            if (array_key_exists($oreType, $combinedArray)) {
                // Wenn ja, addiere die Einheiten
                $combinedArray[$oreType] += $oreUnit;
            } else {
                // Wenn nicht, füge den Erztyp mit den Einheiten hinzu
                $combinedArray[$oreType] = $oreUnit;
            }
        }

        return $combinedArray;
    }
}
