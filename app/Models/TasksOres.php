<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TasksOres extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ["units", "ore_id", "task_id"];
}
