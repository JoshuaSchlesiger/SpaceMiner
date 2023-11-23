<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserSettings extends Component
{
    public $visibility = null;
    public $whitelist = null;

    public function render()
    {
        $user = Auth::user();
        $this->visibility = (bool) $user->show_external_tasks;

        return view('livewire.user-settings');
    }
}
