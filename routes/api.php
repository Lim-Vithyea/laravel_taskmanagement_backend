<?php 

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskPrioritiesController;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsertaskController;

Route::post('/adduser', [UserController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public endpoints (if needed)
Route::get('/getstatus', [TaskStatusController::class, 'getTaskStatuses']);
Route::get('/getprio', [TaskPrioritiesController::class, 'getPriority']);


// Authenticated routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    // User routes
    Route::get('/getuser', [UserController::class, 'getUser']);
    Route::get('/adminuser', [UserController::class, 'getAdmin']);
    Route::delete('/delete/{delete}', [UserController::class, 'destroy']);

    // Task routes
    Route::post('/createtask', [UsertaskController::class, 'create']);
    Route::get('/get_task', [UsertaskController::class, 'index']);
    Route::get('/tasks/{usertask}/edit', [UsertaskController::class, 'edit']);
    Route::patch('/tasks/{usertask}', [UsertaskController::class, 'update']);
    Route::delete('/delete/tasks/{usertask}', [UsertaskController::class, 'destroy']);

    // Authenticated user info
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
