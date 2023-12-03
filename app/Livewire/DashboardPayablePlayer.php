<?php

namespace App\Livewire;

use App\Http\Requests\UpdateTasksOresRequest;
use App\Models\Ores;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Tasks;
use App\Models\TasksOres;
use Livewire\Attributes\Validate;
use App\Models\TasksUsers;
use App\Livewire\DashboardFinishedTasks;
use App\Models\Stations;
use Carbon\Carbon;

class DashboardPayablePlayer extends Component
{
    protected $listeners = ['showInformationAboutTask'];

    public $payablePlayer = [];
    public $playerValue = [];
    public $changeMode = false;
    public $stations = [];
    public $ores = [];

    public $successMessage = '';

    #[Validate('required|numeric')]
    public $sellingPrice = '';
    #[Validate('required|exists:ores,name')]
    public $selectedOre;
    #[Validate('required|exists:stations,id')]
    public $sellingStation = '';

    public $selectedOreUnits = 0;

    public function render()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $tasks = Tasks::where("user_id", $user->id)->where("actualCompletionDate", "<=", Carbon::now())->get()->toArray();
            $this->stations = Stations::get()->toArray();

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
                        array_push($this->payablePlayer[$player->username], [$player->id => $profitPerMiner]);
                    } else {
                        $this->playerValue[$player->username] += $profitPerScout;
                        array_push($this->payablePlayer[$player->username], [$player->id => $profitPerScout]);
                    }
                }
                // ["username" => ["10 (task_user_id)" => 234234("value"), "20 (task_user_id)" => 32423("value")]]
            }
        }
        return view('livewire.dashboard-payable-player');
    }

    public function showInformationAboutTask($tasksInformations)
    {
        if (Auth::check()) {
            $this->changeMode = true;

            $this->ores = [];
            $this->selectedOreUnits = 0;
            $this->selectedOre = null;

            foreach ($tasksInformations as $tasksInformation) {
                foreach ($tasksInformation as $table => $attributes) {
                    if ($table === "tasks_ores") {
                        foreach ($attributes as $tasks_oresAttributes) {
                            $this->ores[$tasks_oresAttributes["name"]] = [
                                "id" => [$tasks_oresAttributes["id"]],
                                "units" => [$tasks_oresAttributes["units"]]
                            ];
                        }
                    } else {
                        // Handle other tables if needed
                    }
                }
            }
        }
    }

    public function getSelectedOreUnits()
    {
        if (Auth::check()) {
            if (!isset($this->ores[$this->selectedOre])) {
                return;
            }
            $this->selectedOreUnits = 0;
            foreach ($this->ores[$this->selectedOre]['units'] as $units) {
                $this->selectedOreUnits += $units;
            }
        }
    }

    public function hideInformationMode()
    {
        $this->changeMode = false;
    }

    public function sellTaskOres()
    {
        if (Auth::check()) {
            $this->validate();
            $selectedTaskOreArray = $this->ores[$this->selectedOre];

            $allUnits = 0;
            foreach ($selectedTaskOreArray["units"] as $units) {
                $allUnits += $units;
            }

            foreach ($selectedTaskOreArray["id"] as $key => $id) {
                $TaskOres = TasksOres::find($id);
                $TaskOres->selling_value = $this->sellingPrice * ($selectedTaskOreArray["units"][$key] / $allUnits);
                $TaskOres->selling_station_id = $this->sellingStation;
                $TaskID = $TaskOres->task_id;
                $TaskOres->save();

                $Task = Tasks::find($TaskID);
                $Task->actualProceeds += $TaskOres->selling_value;
                $Task->save();
            }

            unset($this->ores[$this->selectedOre]);
            if(empty($this->ores)){
                $this->hideInformationMode();
                $this->dispatch('renderFinisedTasks');
            }

            $this->successMessage = 'Ore sold successfully!';
            $this->resetFormAfterDelay();
        }
    }

    private function resetFormAfterDelay()
    {
        $this->resetForm();

        // Reset success message after 5 seconds
        $this->dispatch('resetSuccessMessage', ['delay' => 2500]);
    }

    private function resetForm()
    {
        // Hier setzt du die Formulardaten zurück
        $this->sellingPrice = '';
        $this->selectedOre = null;
        $this->sellingStation = '';
        $this->selectedOreUnits = 0;
    }

    public function resetSuccessMessage(){
        $this->successMessage = '';
    }
}
