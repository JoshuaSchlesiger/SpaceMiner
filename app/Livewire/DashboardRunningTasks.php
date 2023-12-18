<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Tasks;
use App\Models\TasksOres;
use App\Models\TasksUsers;
use App\Models\Stations;
use Carbon\Carbon;
use Livewire\Attributes\On;

class DashboardRunningTasks extends Component
{
    public $tasks = [];
    public $tasks_users = [];
    public $tasks_ores = [];
    public $stations = [];
    public $percentageCompletion = [];

    public $successMessage = '';

    public function render()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $this->tasks = Tasks::where("user_id", $user->id)->where("actualCompletionDate", ">", Carbon::now())->orderBy("actualCompletionDate", "asc")->get()->toArray();

            foreach ($this->tasks as $task) {
                $this->percentageCompletion[$task["id"]] = number_format(min((strtotime(Carbon::now()->toDateTimeString()) - strtotime($task['created_at'])) / (strtotime($task['actualCompletionDate']) - strtotime($task['created_at'])) * 100, 100));
                $this->tasks_users[$task["id"]] = TasksUsers::where("task_id", $task["id"])->get();
                $this->tasks_ores[$task["id"]] = TasksOres::join("ores", "ores.id" ,"=", "tasks_ores.ore_id")->select("ores.id", "units", "ores.name")->where("task_id", $task["id"])->get();
                $this->stations[$task["id"]] = Stations::where("id", $task["station_id"])->get()->first();
            }
        }

        return view('livewire.dashboard-running-tasks');
    }

    public function showModal($taskID){
        $this->successMessage = '';
        if(!array_key_exists($taskID, $this->percentageCompletion)){
            return;
        }
        $this->dispatch('showModal', $taskID);
    }
    
    #[On('showInfoMessage')]
    public function showInfoMessage($info){
        $this->successMessage = $info;
    }
}
