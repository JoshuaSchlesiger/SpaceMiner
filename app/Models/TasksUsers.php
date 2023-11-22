<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TasksUsers extends Model
{
    use HasFactory;
    protected $fillable = ["username", "visability", "paid", "user_id", "task_id", "type"];
}
