<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\Tasks;
use App\Models\TasksOres;
use App\Models\TasksUsers;
use App\Models\Stations;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\Attributes\On;

class DashboardFinishedTasks extends Component
{
    public $tasks = [];
    public $tasks_users = [];
    public $tasks_ores = [];
    public $stations = [];
    private $selectedFinishedTask = [];
    public $selectedFinishedTaskID = -1;

    protected $listeners = ['renderFinishedTasks', "resetViewOfFinishedTasks"];

    #[On('renderFinishedTasks')]
    public function render()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $this->tasks = Tasks::where("user_id", $user->id)->where("actualCompletionDate", "<=", Carbon::now())->get()->toArray();
            foreach ($this->tasks as $key => $task) {
                $this->tasks_users[$task["id"]] = TasksUsers::where("task_id", $task["id"])->get();
                $this->tasks_ores[$task["id"]] = TasksOres::join("ores", "ores.id", "=", "tasks_ores.ore_id")->select("tasks_ores.id", "units", "ores.name", "selling_value")->where("task_id", $task["id"])->get();
                $this->stations[$task["id"]] = Stations::where("id", $task["station_id"])->get()->first();


                $checkIfAllNotNull = false;
                foreach ($this->tasks_ores[$task["id"]] as $value) {
                    if($value->selling_value === null){
                        $checkIfAllNotNull = true;
                    }
                }
                if(!$checkIfAllNotNull){
                    unset($this->tasks_users[$task["id"]]);
                    unset($this->tasks_ores[$task["id"]]);
                    unset($this->stations[$task["id"]]);
                    unset($this->tasks[$key]);
                }
            }
        }
        return view('livewire.dashboard-finished-tasks');
    }

    public function showFinishedTaskInformation(int $taskID)
    {
        if (Auth::check()) {
            $taskFound = collect($this->tasks)->contains('id', $taskID);

            if (!$taskFound) {
                return;
            }

            $this->selectedFinishedTask[0] = [];
            $this->selectedFinishedTask[0]["task"] = Tasks::where("id", $taskID)->first();
            $this->selectedFinishedTaskID = $taskID;
            $this->selectedFinishedTask[0]["tasks_ores"] = TasksOres::join("ores", "ores.id", "=", "tasks_ores.ore_id")
            ->select("tasks_ores.id", "units", "ores.name")
            ->where("task_id", $taskID)
            ->whereNull("tasks_ores.selling_value")
            ->get();

            $this->dispatch('showInformationAboutTask', $this->selectedFinishedTask);
        }
    }

    public function getSelectedFinishedTask()
    {
        return $this->selectedFinishedTask;
    }

    public function resetViewOfFinishedTasks(){
        $this->selectedFinishedTaskID = -1;
    }
}
