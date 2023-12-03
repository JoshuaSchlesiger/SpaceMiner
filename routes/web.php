<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UserSettings;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('calculator', [CalculatorController::class, 'index'])->name('calculator');
Route::post('calculator', [CalculatorController::class, 'calculate'])->name('calculator.calculate');

Route::middleware(['auth'])->group(function () {
Route::get('task', [TasksController::class, 'index'])->name('task');
Route::post('task', [TasksController::class, 'save'])->name('task.save');
Route::get('ajax-task', [TasksController::class, 'ajaxFunction'])->name('ajax.task');

Route::get('userSettings', [UserSettings::class, "index"])->name('userSettings');

Route::get('dashboard', [DashboardController::class, "index"])->name('dashboard');
Route::post('dashboard', [DashboardController::class, "index"])->name('dashboard');
});
