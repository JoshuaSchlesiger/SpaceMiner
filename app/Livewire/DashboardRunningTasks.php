<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Tasks;
use App\Models\TasksOres;
use App\Models\TasksUsers;
use App\Models\User;
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

    public $taskOfOtherUsers = [];

    #[On('renderRunningTasks')]
    public function render()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $this->tasks = Tasks::where("user_id", $user->id)->where("actualCompletionDate", ">", Carbon::now())->orderBy("actualCompletionDate", "asc")->get()->toArray();

            foreach ($this->tasks as $task) {
                $this->percentageCompletion[$task["id"]] = number_format(min((strtotime(Carbon::now()->toDateTimeString()) - strtotime($task['created_at'])) / (strtotime($task['actualCompletionDate']) - strtotime($task['created_at'])) * 100, 100));
                $this->tasks_users[$task["id"]] = TasksUsers::where("task_id", $task["id"])->get();
                $this->tasks_ores[$task["id"]] = TasksOres::join("ores", "ores.id", "=", "tasks_ores.ore_id")->select("ores.id", "units", "ores.name")->where("task_id", $task["id"])->get();
                $this->stations[$task["id"]] = Stations::where("id", $task["station_id"])->get()->first();
            }

            if ($user->show_external_tasks) {
                $this->taskOfOtherUsers = [];
                $tasksIDsOfOther = TasksUsers::where("tasks_users.user_id", $user->id)
                    ->where("visability", true)
                    ->where("paid", false)
                    ->join('tasks as tasks', 'tasks.id', '=', 'tasks_users.task_id')
                    ->where('tasks.actualCompletionDate', '>', Carbon::now())
                    ->pluck('tasks_users.task_id');

                foreach ($tasksIDsOfOther as $taskID) {

                    $taskInfo = Tasks::find($taskID);
                    $taskInfoStation = Stations::find($taskInfo->station_id);
                    $taskInfoTasks_Ores = TasksOres::where("task_id", $taskID)->join("ores", "tasks_ores.ore_id", "ores.id")->get(["tasks_ores.units", "ores.name"]);
                    $taskInfoUser = User::find($taskInfo->user_id);

                    $buffer = [];
                    $buffer[$taskID] = [];
                    $buffer[$taskID]["taskInfo"] = $taskInfo;
                    $buffer[$taskID]["taskInfoStation"] = $taskInfoStation;
                    $buffer[$taskID]["taskInfoTasks_Ores"] = $taskInfoTasks_Ores;
                    $buffer[$taskID]["taskInfoUser"] = $taskInfoUser;
                    $buffer[$taskID]["percentageCompletion"] = number_format(min((strtotime(Carbon::now()->toDateTimeString()) - strtotime($taskInfo->created_at)) / (strtotime($taskInfo->actualCompletionDate) - strtotime($taskInfo->created_at)) * 100, 100));
                    $this->taskOfOtherUsers[$taskID] = $buffer[$taskID];
                }
            } else {
                $this->taskOfOtherUsers = [];

                $userData = json_decode($user->whitelisted_player, true);
                if(!empty($userData)){

                    $tasksIDsOfOther = TasksUsers::where("tasks_users.user_id", $user->id)
                    ->where("visability", true)
                    ->where("paid", false)
                    ->join('tasks as tasks', 'tasks.id', '=', 'tasks_users.task_id')
                    ->where('tasks.actualCompletionDate', '>', Carbon::now())
                    ->pluck('tasks_users.task_id');

                    $names = $userData['username'];

                    foreach ($tasksIDsOfOther as $taskID) {

                        $taskInfo = Tasks::find($taskID);
                        $taskInfoStation = Stations::find($taskInfo->station_id);
                        $taskInfoTasks_Ores = TasksOres::where("task_id", $taskID)->join("ores", "tasks_ores.ore_id", "ores.id")->get(["tasks_ores.units", "ores.name"]);
                        $taskInfoUser = User::find($taskInfo->user_id);

                        if (!in_array($taskInfoUser->name, $names)) {
                            continue;
                        }

                        $buffer = [];
                        $buffer[$taskID] = [];
                        $buffer[$taskID]["taskInfo"] = $taskInfo;
                        $buffer[$taskID]["taskInfoStation"] = $taskInfoStation;
                        $buffer[$taskID]["taskInfoTasks_Ores"] = $taskInfoTasks_Ores;
                        $buffer[$taskID]["taskInfoUser"] = $taskInfoUser;
                        $buffer[$taskID]["percentageCompletion"] = number_format(min((strtotime(Carbon::now()->toDateTimeString()) - strtotime($taskInfo->created_at)) / (strtotime($taskInfo->actualCompletionDate) - strtotime($taskInfo->created_at)) * 100, 100));
                        $this->taskOfOtherUsers[$taskID] = $buffer[$taskID];
                    }
                }
            }
        }

        return view('livewire.dashboard-running-tasks');
    }

    public function showModal($taskID, $actionType)
    {
        $this->successMessage = '';
        if($actionType !=  "runningTaskOther") {
            if (!array_key_exists($taskID, $this->percentageCompletion)) {
                return;
            }
        }

        $this->dispatch('showModal', $taskID, $actionType);
    }

    #[On('showInfoMessage')]
    public function showInfoMessage($info)
    {
        $this->successMessage = $info;
    }
}
