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
    public $selectedFinishedTask = [];
    public $selectedFinishedTaskID = -1;

    public $combinableTasks = [];
    public $combinableTasksIDs = [];


    #[On('renderFinishedTasks')]
    public function render()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $this->tasks = Tasks::where("user_id", $user->id)->where("actualCompletionDate", "<=", Carbon::now())->get()->pluck(null, 'id')->toArray();
            foreach ($this->tasks as $key => $task) {
                $this->tasks_users[$key] = TasksUsers::where("task_id", $key)->get();
                $this->tasks_ores[$key] = TasksOres::join("ores", "ores.id", "=", "tasks_ores.ore_id")->select("tasks_ores.id", "units", "ores.name", "selling_value")->where("task_id", $task["id"])->get();
                $this->stations[$key] = Stations::where("id", $task["station_id"])->get()->first();

                $checkIfAllNotNull = false;
                foreach ($this->tasks_ores[$key] as $value) {
                    if ($value->selling_value === null) {
                        $checkIfAllNotNull = true;
                    }
                }
                if (!$checkIfAllNotNull) {
                    unset($this->tasks_users[$key]);
                    unset($this->tasks_ores[$key]);
                    unset($this->stations[$key]);
                    unset($this->tasks[$key]);
                }
            }
        }

        return view('livewire.dashboard-finished-tasks');
    }

    public function showFinishedTaskInformation(int $taskID)
    {
        if (Auth::check()) {
            if (!isset($this->tasks[$taskID])) {
                return;
            }

            $this->selectedFinishedTaskID = $taskID;
            $this->selectedFinishedTask[0] = [];
            $this->selectedFinishedTask[0]["task"] = Tasks::where("id", $taskID)->first()->toArray();
            $this->selectedFinishedTask[0]["tasks_ores"] = TasksOres::join("ores", "ores.id", "=", "tasks_ores.ore_id")
                ->select("tasks_ores.id", "units", "ores.name")
                ->where("task_id", $taskID)
                ->whereNull("tasks_ores.selling_value")
                ->get()
                ->toArray();

            $this->sendTaskToEdit();

            $refineryStation = $this->selectedFinishedTask[0]["task"]["station_id"];
            $matchingKeys = array_keys(array_filter($this->stations, function ($item) use ($refineryStation) {
                return $item["id"] === $refineryStation;
            }));
            if(count($matchingKeys) > 1){
                $this->dispatch('updateShowCombineButton', true);
            }
        }
    }

    public function combineTasks($taskID)
    {
        if (Auth::check()) {
            if (!isset($this->combinableTasks[$taskID])) {
                return;
            }

            $taskAlreadyExists = array_reduce($this->selectedFinishedTask, function ($carry, $value) use ($taskID) {
                return $carry || (isset($value['task']['id']) && $value['task']['id'] === $taskID);
            }, false);
            if ($taskAlreadyExists) {
                return;
            }


            $buffer = [];
            $task = Tasks::where("id", $taskID)->first();
            if (!$task) {
                return;
            }

            $this->combinableTasksIDs[] = $taskID;
            $buffer["task"] = $task->toArray();
            $buffer["tasks_ores"] = TasksOres::join("ores", "ores.id", "=", "tasks_ores.ore_id")
                ->select("tasks_ores.id", "units", "ores.name")
                ->where("task_id", $taskID)
                ->whereNull("tasks_ores.selling_value")
                ->get()
                ->toArray();

            array_push($this->selectedFinishedTask, $buffer);

            $this->sendTaskToEdit();
        }
    }

    public function deselectTask($taskID)
    {
        if (Auth::check()) {
            if (!in_array($taskID, $this->combinableTasksIDs)) {
                return;
            }

            $index = array_search($taskID, $this->combinableTasksIDs);
            if ($index === false) {
                return;
            }
            unset($this->combinableTasksIDs[$index]);

            $this->selectedFinishedTask = array_filter($this->selectedFinishedTask, function ($value) use ($taskID) {
                return $value['task']['id'] !== $taskID;
            });

            $this->sendTaskToEdit();
        }
    }

    private function sendTaskToEdit()
    {
        $this->dispatch('showInformationAboutTask', $this->selectedFinishedTask);
    }

    #[On('getTasksToCombine')]
    public function getTasksToCombine()
    {
        $this->combinableTasks = [];

        $refineryStation = $this->selectedFinishedTask[0]["task"]["station_id"];

        $matchingKeys = array_keys(array_filter($this->stations, function ($item) use ($refineryStation) {
            return $item["id"] === $refineryStation;
        }));

        foreach ($matchingKeys as $taskID) {
            $this->combinableTasks[$taskID] = $this->tasks[$taskID];
        }

        if (empty($this->combinableTasks)) {
            $this->dispatch('showMessageForNullCombine');
        }
    }

    #[On('resetViewOfFinishedTasks')]
    public function resetViewOfFinishedTasks()
    {
        $this->selectedFinishedTaskID = -1;
        $this->combinableTasksIDs = [];
        $this->combinableTasks = [];
        $this->selectedFinishedTask = [];
    }
}
