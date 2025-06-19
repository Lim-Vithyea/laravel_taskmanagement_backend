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
    Route::patch('/users/{id}',[UserController::class,'update']);
    
    //not use yet
    //Route::get('/userprofile', [UserController::class, 'getUserProfile']);
    Route::delete('/delete/{delete}', [UserController::class, 'destroy']);
    
    // Task routes
    Route::post('/createtask', [UsertaskController::class, 'create']);
    Route::get('/get_task', [UsertaskController::class, 'index']);
    Route::get('/tasks/{usertask}/edit', [UsertaskController::class, 'edit']);
    Route::patch('/tasks/{usertask}', [UsertaskController::class, 'update']);
    Route::delete('/tasks/{usertask}', [UsertaskController::class, 'destroy']);
    Route::post('/upload-profile', [UserController::class, 'uploadProfilePicture']);
    Route::get('/gettaskcount',[UsertaskController::class,'getUserTaskCount']);
    
    // Authenticated user info
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
