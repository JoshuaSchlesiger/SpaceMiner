<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserSettings extends Component
{
    use AuthorizesRequests;

    public $visibility;
    public $whitelist; //Array
    public $username;
    public $run = 0;

    public function render()
    {
        if (Auth::check()) {
            if ($this->run === 0) {
                $user = Auth::user();
                $this->visibility = (bool) $user->show_external_tasks;
                $this->run++;
                $this->whitelist = json_decode($user->whitelisted_player, true);
            }
        }
        return view('livewire.user-settings');
    }

    public function visibilityChange()
    {
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            $user->show_external_tasks = !$this->visibility;
            $user->save();
            $this->visibility = !$this->visibility;
        }
    }

    public function addPlayer()
    {
        if (Auth::check()) {

            if ($this->whitelist === null) {
                $this->whitelist = array();
            }
            if (!isset($this->whitelist["username"])) {
                $this->whitelist["username"] = array();
            }


            if (in_array($this->username, $this->whitelist["username"])) {
                // Wenn der Benutzername bereits vorhanden ist, setze eine benutzerdefinierte Fehlermeldung
                $customMessages = [
                    'username.unique' => 'Der Benutzername ist bereits vorhanden.',
                ];

                // Zeige die Validierungsfehlermeldung
                $this->addError('username', 'Existiert bereits');

                // Optional: Reagiere auf den Fehler, z.B., indem du die Verarbeitung hier beendest
                return;
            }

            $customMessages = [
                'username.required' => "null",
                'username.min' => 'Der Benutzername muss mindestens :min Zeichen lang sein.',
                'username.max' => 'Der Benutzername darf nicht mehr als :max Zeichen lang sein.',
            ];

            // Validierung der Eingabe
            $this->validate([
                'username' => 'required|min:3|max:32',
            ], $customMessages);

            $username = $this->username;
            $this->username = "";

            array_push($this->whitelist["username"], $username);

            $user = User::find(Auth::user()->id);
            $user->whitelisted_player = json_encode($this->whitelist);
            $user->save();
            Info($this->whitelist);
        }
    }

    public function deletePlayer($index)
    {
        if (Auth::check()) {
            if (isset($this->whitelist["username"][$index])) {
                unset($this->whitelist["username"][$index]);
                $this->whitelist["username"] = array_values($this->whitelist["username"]);

                $user = User::find(Auth::user()->id);
                $user->whitelisted_player = json_encode($this->whitelist);
                $user->save();
            }
        }
    }
}
