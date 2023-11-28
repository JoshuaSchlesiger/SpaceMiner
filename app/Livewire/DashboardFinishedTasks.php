<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\Tasks;
use App\Models\TasksOres;
use App\Models\TasksUsers;
use App\Models\Stations;
use Livewire\Component;
use Carbon\Carbon;

class DashboardFinishedTasks extends Component
{

    public $tasks = [];
    public $tasks_users = [];
    public $tasks_ores = [];
    public $stations = [];

    public function render()
    {
        if (Auth::check()) {
                $user = Auth::user();
                $this->tasks = Tasks::where("user_id", $user->id)->where("actualCompletionDate", "<=", Carbon::now())->get()->toArray();
                foreach ($this->tasks as $task) {
                    $this->tasks_users[$task["id"]] = TasksUsers::where("task_id", $task["id"])->get();
                    $this->tasks_ores[$task["id"]] = TasksOres::join("ores", "ores.id" ,"=", "tasks_ores.ore_id")->select("ores.id", "units", "ores.name")->where("task_id", $task["id"])->get();
                    $this->stations[$task["id"]] = Stations::where("id", $task["station_id"])->get()->first();
                }

        }

        return view('livewire.dashboard-finished-tasks');
    }
}
