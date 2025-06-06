<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TaskPriorities;

class TaskPrioritiesController extends Controller
{
    //
    public function getPriority () {
        $priority = TaskPriorities::all();
        return response()->json($priority);
    }
}
