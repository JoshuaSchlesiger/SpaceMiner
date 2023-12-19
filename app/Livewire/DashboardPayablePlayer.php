<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Tasks;
use App\Models\TasksOres;
use Livewire\Attributes\Validate;
use App\Models\TasksUsers;
use App\Models\SellingStation;
use Carbon\Carbon;
use Livewire\Attributes\On;

class DashboardPayablePlayer extends Component
{
    public $payablePlayer = [];
    public $playerValue = [];
    public $changeMode = false;
    public $showCombineButton = false;
    public $stations = [];
    public $ores = [];

    public $successMessage = '';

    #[Validate('required|numeric')]
    public $sellingPrice = '';
    #[Validate('required|exists:ores,name')]
    public $selectedOre;
    #[Validate('required|exists:selling_stations,id')]
    public $sellingStation = '';
    public $selectedOreUnits = 0;

    public $tasksInformations;
    public $selectedTaskID = null;

    public $selectedPlayer = null;

    public function render()
    {
        if (Auth::check()) {
            $this->payablePlayer = [];
            $this->playerValue = [];

            $user = Auth::user();
            $tasks = Tasks::where("user_id", $user->id)->where("actualCompletionDate", "<=", Carbon::now())->get()->toArray();
            $this->stations = SellingStation::get()->toArray();

            foreach ($tasks as $task) {
                $task_ores_values = TasksOres::where("task_id", $task["id"])
                    ->pluck("selling_value")
                    ->toArray();

                if (in_array(null, $task_ores_values) || empty($task_ores_values)) {
                    continue;
                }

                $payableTaskUsers = TasksUsers::where("task_id", $task["id"])
                    ->where("paid", false)
                    ->get();

                $payableMinerCount = TasksUsers::where("task_id", $task["id"])
                    ->where("type", "miner")
                    ->count();

                $payableScoutsCount = TasksUsers::where("task_id", $task["id"])
                    ->where("type", "scout")
                    ->count();

                $profit = ($task["actualProceeds"] - $task["actualCosts"]);

                if ($payableScoutsCount > 0) {
                    $profitPerScout = $profit * ((100 - $task["minerRation"]) / 100) / $payableScoutsCount;
                    $profitPerMiner = $profit * ($task["minerRation"] / 100) / $payableMinerCount;
                } else {
                    $profitPerScout = 0;
                    $profitPerMiner = $profit / $payableMinerCount;
                }

                foreach ($payableTaskUsers as $player) {

                    if (!isset($this->payablePlayer[$player->username])) {
                        $this->payablePlayer[$player->username] = [];
                    }

                    if (!isset($this->playerValue[$player->username])) {
                        $this->playerValue[$player->username] = 0;
                    }


                    if ($player->type === "miner") {
                        $this->playerValue[$player->username] += $profitPerMiner;
                        $this->payablePlayer[$player->username][$player->id] = $profitPerMiner;
                    } else {
                        $this->playerValue[$player->username] += $profitPerScout;
                        $this->payablePlayer[$player->username][$player->id] =  $profitPerScout;
                    }
                }
            }
        }
        return view('livewire.dashboard-payable-player');
    }

    #region Userarea
    public function setToUserPayMode($username){
        if(!array_key_exists($username, $this->payablePlayer)){
            return;
        }
        $this->selectedPlayer = $username;
        $this->successMessage = '';
        $this->dispatch('setToUserPayMode', $username, $this->payablePlayer[$username]);
    }

    #[On('resetSelectedPlayer')]
    public function resetSelectedPlayer(){
        $this->selectedPlayer = null;
    }
   
    
    #[On('showInfoMessageUser')]
    public function showInfoMessageUser($successMessage){
        $this->successMessage = $successMessage;
    } 
    #endregion

    #region Taskarea
    #[On('showInformationAboutTask')]
    public function showInformationAboutTask($tasksInformations)
    {
        $this->resetForm();
        $this->resetErrorBag();
        $this->changeMode = true;
        $this->showCombineButton = false; // Wird direkt danach wieder geprüft, ist also zum zurücksetzen
        $this->successMessage = '';

        $this->ores = [];
        $this->selectedOreUnits = 0;
        $this->selectedOre = null;

        if(!empty($tasksInformations[0])){
            $this->selectedTaskID = $tasksInformations[0]["task"]["id"];
        }

        foreach ($tasksInformations as $tasksInformation) {
            foreach ($tasksInformation as $table => $attributes) {
                if ($table === "tasks_ores") {
                    foreach ($attributes as $tasks_oresAttributes) {
                        if (!isset($this->ores[$tasks_oresAttributes["name"]])) {
                            $this->ores[$tasks_oresAttributes["name"]] = [];
                            $this->ores[$tasks_oresAttributes["name"]]["id"] = [];
                            $this->ores[$tasks_oresAttributes["name"]]["units"] = [];
                        }
                        array_push($this->ores[$tasks_oresAttributes["name"]]["id"], $tasks_oresAttributes["id"]);
                        array_push($this->ores[$tasks_oresAttributes["name"]]["units"], $tasks_oresAttributes["units"]);
                    }
                }
            }
        }
    }

    public function getSelectedOreUnits()
    {
        $this->successMessage = '';
        if (!isset($this->ores[$this->selectedOre])) {
            return;
        }
        $this->selectedOreUnits = 0;
        foreach ($this->ores[$this->selectedOre]['units'] as $units) {
            $this->selectedOreUnits += $units;
        }
    }

    public function hideInformationMode()
    {
        $this->dispatch('resetViewOfFinishedTasks');
        $this->changeMode = false;
    }

    public function sellTaskOres()
    {
        $this->validate();
        $selectedTaskOreArray = $this->ores[$this->selectedOre];

        $allUnits = 0;
        foreach ($selectedTaskOreArray["units"] as $units) {
            $allUnits += $units;
        }

        $taskIDs = [];
        foreach ($selectedTaskOreArray["id"] as $key => $id) {
            $TaskOres = TasksOres::find($id);
            $TaskOres->selling_value = $this->sellingPrice * ($selectedTaskOreArray["units"][$key] / $allUnits);
            $TaskOres->selling_station_id = $this->sellingStation;
            $TaskID = $TaskOres->task_id;
            if (!in_array($TaskID, $taskIDs)) {
                $taskIDs[] = $TaskID;
            }
            $TaskOres->save();

            $Task = Tasks::find($TaskID);
            $Task->actualProceeds += $TaskOres->selling_value;
            $Task->save();
        }

        //Wird immer ausgeführt, aber bricht in der Funktion dann ab wenn combine leer
        if (count($selectedTaskOreArray["id"]) > 0) {
            $this->dispatch('blockCombination', $taskIDs);
        }

        unset($this->ores[$this->selectedOre]);
        if (empty($this->ores)) {
            $this->hideInformationMode();
            $this->dispatch('renderFinishedTasks');
        }

        $this->successMessage = 'Ore sold successfully!';
        $this->resetForm();
    }

    private function resetForm()
    {
        // Hier setzt du die Formulardaten zurück
        $this->sellingPrice = '';
        $this->selectedOre = null;
        $this->sellingStation = '';
        $this->selectedOreUnits = 0;
    }

    public function sendTaskToCombine()
    {
        $this->showCombineButton = false;
        $this->dispatch('getTasksToCombine');
    }

    #[On('updateShowCombineButton')]
    public function updateShowCombineButton($bool)
    {
        $this->showCombineButton = $bool;
    }

    public function deleteTask($actionType)
    {
        $this->dispatch('showModal', $this->selectedTaskID, $actionType);
        $this->hideInformationMode();
    }

    #endregion
}
