<?php

use App\Http\Controllers\TaskPriorities;
use App\Http\Controllers\TaskPrioritiesController;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsertaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//User API endpoint
Route::post('/adduser', [UserController::class, 'register']);
Route::get('/getuser',[UserController::class,'getUser']);




//Task status and priorities endpoint
Route::get('/getstatus', [TaskStatusController::class, 'getTaskStatuses']);
Route::get('/getprio', [TaskPrioritiesController::class, 'getPriority']);


//Task API endpoint
Route::post('/createtask', [UsertaskController::class, 'create']);
Route::get('/tasks/{usertask}/edit',[UsertaskController::class,'edit']);
Route::patch('/tasks/{usertask}',[UsertaskController::class,'update']);
Route::delete('/delete/tasks/{usertask}',[UsertaskController::class,'destroy']);





