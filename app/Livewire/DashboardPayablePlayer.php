<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Tasks;
use App\Models\TasksOres;
use App\Models\TasksUsers;
use App\Models\Stations;
use Carbon\Carbon;

class DashboardPayablePlayer extends Component
{
    public $payablePlayer = [];
    public $playerValue = [];

    public function render()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $tasks = Tasks::where("user_id", $user->id)->where("actualCompletionDate", "<=", Carbon::now())->get()->toArray();

            foreach ($tasks as $task) {
                $task_ores_values = TasksOres::where("task_id", $task["id"])
                    ->whereNotNull("selling_value")
                    ->pluck("selling_value")
                    ->toArray();

                if (in_array(null, $task_ores_values)) {
                    continue;
                }

                $payableTaskUsers = TasksUsers::where("task_id", $task["id"])
                    ->where("paid", false)
                    ->get();

                $payableMinerCount = TasksUsers::where("task_id", $task["id"])
                    ->where("type", "miner")
                    ->count();

                $payableScoutsCount = TasksUsers::where("task_id", $task["id"])
                    ->where("type", "scout")
                    ->count();

                $profit = ($task["actualProceeds"] - $task["actualCosts"]);


                if ($payableScoutsCount > 0) {
                    $profitPerScout = $profit * ((100 - $task["minerRation"]) / 100) / $payableScoutsCount;
                    $profitPerMiner = $profit * ($task["minerRation"] / 100) / $payableMinerCount;
                } else {
                    $profitPerScout = 0;
                    $profitPerMiner = $profit / $payableMinerCount;
                }



                foreach ($payableTaskUsers as $player) {

                    if (!isset($this->payablePlayer[$player->username])) {
                        $this->payablePlayer[$player->username] = [];
                    }

                    if (!isset($this->playerValue[$player->username])) {
                        $this->playerValue[$player->username] = 0;
                    }


                    if ($player->type === "miner") {
                        $this->playerValue[$player->username] += $profitPerMiner;
                        array_push($this->payablePlayer[$player->username], [$player->id => $profitPerMiner]);
                    } else {
                        $this->playerValue[$player->username] += $profitPerScout;
                        array_push($this->payablePlayer[$player->username], [$player->id => $profitPerScout]);
                    }
                }
                // ["username" => ["10 (task_user_id)" => 234234("value"), "20 (task_user_id)" => 32423("value")]]
            }
        }
        return view('livewire.dashboard-payable-player');
    }
}
