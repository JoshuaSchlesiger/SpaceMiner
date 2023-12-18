<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Tasks;

class DashboardModal extends Component
{
    public $show = false;
    public $selectedTaskID = -1;

    public function render()
    {
        return view('livewire.dashboard-modal');
    }

    #[On('showModal')]
    public function showModal($selectedTaskID)
    {
        $this->selectedTaskID = $selectedTaskID;
        $this->show = true;
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
    
            // Überprüfe, ob der Benutzer die Berechtigung zum Löschen der Aufgabe hat
            if ($this->authorize('delete', $task)) {
                // Führe hier den Löschvorgang durch
                $task->delete();
                $this->dispatch('showInfoMessage', 'Auftrag erfolgreich gelöscht!');
            } else {
                $this->dispatch('showInfoMessage', 'Du hast keine Berechtigung, diese Auftrag zu löschen.');
            }
        }
    
        // Schließe das Modal
        $this->closeModal();
    }
}
