<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Tasks;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;
use App\Models\TasksUsers;
use Illuminate\Support\Facades\Gate;


class DashboardModal extends Component
{
    public $show = false;
    public $selectedTaskID = -1;
    public $actionType = null;

    public function render()
    {
        return view('livewire.dashboard-modal');
    }

    #[On('showModal')]
    public function showModal($selectedTaskID, $actionType)
    {
        $this->selectedTaskID = $selectedTaskID;
        $this->show = true;
        $this->actionType = $actionType;
    }

    public function closeModal()
    {
        $this->show = false;
    }

    public function deleteTask()
    {
        if (Auth::check()) {
            // Holen Sie die Aufgabe basierend auf der übergebenen ID
            $task = Tasks::find($this->selectedTaskID);

            if ($this->actionType === "runningTaskOther") {
                TasksUsers::where("username", Auth::user()->name)->where("task_id", $task->id)->update(['visability' => 0]);
                $this->dispatch('renderRunningTasks');
                $this->dispatch('renderFinishedTasks');
            }elseif($this->actionType === "payablePlayer2"){
                TasksUsers::where("id", $this->selectedTaskID)->update(['visability' => 0]);
                $this->dispatch('renderPayablePlayer');
            }
            else {
                // Überprüfe, ob der Benutzer die Berechtigung zum Löschen der Aufgabe hat
                if (!Gate::denies('delete', $task)) {
                    // Führe hier den Löschvorgang durch
                    $task->delete();
                    if ($this->actionType === "runningTask") {
                        $this->dispatch('showInfoMessage', Lang::get('dashboard.controller.showInfoMessage.task.deleted'));
                    } elseif ($this->actionType === "payablePlayer") {
                        $this->dispatch('showInfoMessageUser', Lang::get('dashboard.controller.showInfoMessage.task.deleted'));
                        $this->dispatch('renderFinishedTasks');
                    }
                } else {
                    if ($this->actionType === "runningTask") {
                        $this->dispatch('showInfoMessage', Lang::get('dashboard.controller.showInfoMessage.task.insufficientPermission'));
                    } elseif ($this->actionType === "payablePlayer") {
                        $this->dispatch('showInfoMessageUser', Lang::get('dashboard.controller.showInfoMessage.task.insufficientPermission'));
                    }
                }
            }
        }

        // Schließe das Modal
        $this->closeModal();
    }
}
