<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    protected $fillable = [
        "station_id", "calculatedCompletionDate", "actualCompletionDate", "calculatedCosts", "actualCosts", "calculatedProceeds", "actualProceeds",
        "minerRation", "visible", "method_id", "user_id"
    ];
}
