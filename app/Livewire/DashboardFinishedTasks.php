<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\Tasks;
use App\Models\TasksOres;
use App\Models\TasksUsers;
use App\Models\Stations;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;

class DashboardFinishedTasks extends Component
{
    public $tasks = [];
    public $tasks_users = [];
    public $tasks_ores = [];
    public $stations = [];
    public $selectedFinishedTask = [];
    public $selectedFinishedTaskID = -1;

    public $combinationMode = false;
    public $blockSelect = false;
    public $combinableTasks = [];
    public $combinableTasksIDs = [];


    public $userPayMode = false;
    public $selectedUserName = null;
    public $selectedUserTotalAmount = 0;
    public $selectedUserPartAmountArray = [];

    public $selectedAmountID = null;

    #[On('renderFinishedTasks')]
    public function render()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $this->tasks = Tasks::where("user_id", $user->id)->where("actualCompletionDate", "<=", Carbon::now())->get()->pluck(null, 'id')->toArray();
            foreach ($this->tasks as $taskID => $task) {
                $this->tasks_users[$taskID] = TasksUsers::where("task_id", $taskID)->get();
                $this->tasks_ores[$taskID] = TasksOres::join("ores", "ores.id", "=", "tasks_ores.ore_id")->select("tasks_ores.id", "units", "ores.name", "selling_value")->where("task_id", $task["id"])->get();
                $this->stations[$taskID] = Stations::where("id", $task["station_id"])->get()->first();

                if (!$this->combinationMode) {
                    $checkIfAllNotNull = false;
                    foreach ($this->tasks_ores[$taskID] as $value) {
                        if ($value->selling_value === null) {
                            $checkIfAllNotNull = true;
                        }
                    }
                    if (!$checkIfAllNotNull) {
                        unset($this->tasks_users[$taskID]);
                        unset($this->tasks_ores[$taskID]);
                        unset($this->stations[$taskID]);
                        unset($this->tasks[$taskID]);
                    }
                }
            }
        }

        return view('livewire.dashboard-finished-tasks');
    }

    #[On('setToUserPayMode')]
    public function setToUserPayMode($username, $userInformation)
    {
        $this->userPayMode = true;
        $this->selectedUserName = $username;
        $this->selectedUserTotalAmount = array_sum($userInformation);
        $this->selectedUserPartAmountArray = $userInformation;
    }

    public function resetUserPayMode()
    {
        $this->userPayMode = false;
        $this->selectedUserName = null;
        $this->selectedUserTotalAmount = 0;
        $this->selectedUserPartAmountArray = [];
        $this->dispatch('resetSelectedPlayer');
    }

    public function fullpayUser()
    {
        foreach ($this->selectedUserPartAmountArray as $id => $amount) {
            $tasksUser = TasksUsers::find($id);
            if ($this->authorize('update', $tasksUser)) {
                $tasksUser->paid = true;
                $tasksUser->save();
                $this->dispatch('showInfoMessageUser', 'User erfolgreich bezahlt!');
                $this->resetUserPayMode();
            } else {
                $this->dispatch('showInfoMessageUser', 'Du hast keine Berechtigung, diesen User zu bezahlen.');
            }
        }
    }

    public function selectedAmountPay()
    {
        if($this->selectedAmountID === null){
            $this->addError('selectedAmountID', 'Please select an option');
            return;
        }

        $tasksUser = TasksUsers::find($this->selectedAmountID);
        if ($this->authorize('update', $tasksUser)) {
            $tasksUser->paid = true;
            $tasksUser->save();

            $this->selectedUserTotalAmount -= $this->selectedUserPartAmountArray[$this->selectedAmountID];
            unset($this->selectedUserPartAmountArray[$this->selectedAmountID]);
            $this->selectedAmountID = null;

            if(empty($this->selectedUserPartAmountArray)){
                $this->resetUserPayMode();
                $this->dispatch('showInfoMessageUser', 'User erfolgreich bezahlt!');
                return;
            }
            
            $this->dispatch('showInfoMessageUser', 'User teilweise erfolgreich bezahlt!');
        } else {
            $this->dispatch('showInfoMessageUser', 'Du hast keine Berechtigung, diesen User zu bezahlen.');
        }
    }

    #region Taskarea
    public function showFinishedTaskInformation(int $taskID)
    {
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
        if (count($matchingKeys) > 1) {
            $this->dispatch('updateShowCombineButton', true);
        }
    }

    //Funktion für die Oberfläche
    public function combineTasks($taskID)
    {
        if (!isset($this->combinableTasks[$taskID])) {
            return;
        }
        if ($this->blockSelect) {
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

    //Funktion für die Oberfläche
    public function deselectTask($taskID)
    {
        if (!in_array($taskID, $this->combinableTasksIDs)) {
            return;
        }

        if ($this->blockSelect) {
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

    private function sendTaskToEdit()
    {
        $this->dispatch('showInformationAboutTask', $this->selectedFinishedTask);
    }

    #[On('getTasksToCombine')]
    public function getTasksToCombine()
    {
        $this->combinableTasks = [];
        $this->combinationMode = true;

        $refineryStation = $this->selectedFinishedTask[0]["task"]["station_id"];

        $matchingKeys = array_keys(array_filter($this->stations, function ($item) use ($refineryStation) {
            return $item["id"] === $refineryStation;
        }));

        foreach ($matchingKeys as $taskID) {
            $this->combinableTasks[$taskID] = $this->tasks[$taskID];
        }

        if (empty($this->combinableTasks)) {
            return;
        }
    }

    #[On('resetViewOfFinishedTasks')]
    public function resetViewOfFinishedTasks()
    {
        $this->selectedFinishedTaskID = -1;
        $this->combinableTasksIDs = [];
        $this->combinableTasks = [];
        $this->selectedFinishedTask = [];
        $this->combinationMode = false;
    }

    #[On('blockCombination')]
    public function blockCombination()
    {
        if (empty($this->combinableTasks)) {
            return;
        }

        $this->blockSelect = true;
        $newArray = [];
        foreach ($this->selectedFinishedTask as $taskInfo) {
            $newArray[$taskInfo["task"]["id"]] = $this->combinableTasks[$taskInfo["task"]["id"]];
        }
        $this->combinableTasks = $newArray;
    }
    #endregion
}
