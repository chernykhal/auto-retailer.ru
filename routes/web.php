<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return redirect('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
Route::resource('roles', RoleController::class);
Route::resource('customers', CustomerController::class);
Route::resource('users', UserController::class);
Route::get('/users/{user}/workdays', [UserController::class, 'workDays'])->name('users.work-days');
Route::put('/users/{user}/workdays/store', [UserController::class, 'workDaysStore'])->name('users.work-days-store');

