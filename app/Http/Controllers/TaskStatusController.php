<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    
    public function getTaskStatuses()
{
    $statuses = TaskStatus::all();
    return response()->json($statuses);
}
}
