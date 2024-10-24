<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('/register',  'register');
    Route::post('/login',  'login')->name('login');
});

Route::middleware('auth:sanctum')->group(function () {

    Route::resource('projects', ProjectController::class);
    Route::resource('projects.employees', EmployeeController::class);

    Route::post('/projects/{project_id}/employees/{id}/restore', [EmployeeController::class, 'restore']);
    Route::get('/dashboard', [ProjectController::class, 'dashboard']);
});
