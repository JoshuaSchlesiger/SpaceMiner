<?php

namespace App\Observers;

use App\Models\TasksUsers;
use App\Models\User;

class TasksUsersObserver
{
    /**
     * Handle the TasksUsers "creating" event.
     */
    public function creating(TasksUsers $tasksUsers): void
    {
        // Überprüfe, ob ein Benutzer mit dem angegebenen Benutzernamen existiert
        // $user = User::where('name', $tasksUsers->username)->first();
        // if ($user) {
        //     $tasksUsers->user_id = $user->id;
        //     $tasksUsers->save(); // Speichere die Änderungen
        // }
    }

    /**
     * Handle the TasksUsers "created" event.
     */
    public function created(TasksUsers $tasksUsers): void
    {
        // Überprüfe, ob ein Benutzer mit dem angegebenen Benutzernamen existiert
        $user = User::where('name', $tasksUsers->username)->first();
        if ($user) {
            $tasksUsers->user_id = $user->id;
            $tasksUsers->save(); // Speichere die Änderungen
        }
    }

    /**
     * Handle the TasksUsers "updated" event.
     */
    public function updated(TasksUsers $tasksUsers): void
    {
        //
    }

    /**
     * Handle the TasksUsers "deleted" event.
     */
    public function deleted(TasksUsers $tasksUsers): void
    {
        //
    }

    /**
     * Handle the TasksUsers "restored" event.
     */
    public function restored(TasksUsers $tasksUsers): void
    {
        //
    }

    /**
     * Handle the TasksUsers "force deleted" event.
     */
    public function forceDeleted(TasksUsers $tasksUsers): void
    {
        //
    }
}
