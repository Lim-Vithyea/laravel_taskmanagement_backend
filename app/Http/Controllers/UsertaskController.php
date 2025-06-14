<?php

namespace App\Http\Controllers;

use App\Models\Usertask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use UsersTask;

class UsertaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $user = Auth::user();
        if ($user->role == 1) {
        $tasks = Usertask::with(['employee.image', 'status', 'priority','assignedBy',])->get();
        } 
        else {
        $tasks = Usertask::with(['employee.image', 'status', 'priority','assignedBy',])
                         ->where('employee_id', $user->id)
                         ->get();
    }
    return response()->json($tasks);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $createTask = $request->validate([
        'task_title'      => ['required', 'string', 'min:3', 'max:100'],
        'task_desc'       => ['required', 'string'],
        'start_date'      => ['required', 'date'],
        'end_date'        => ['required', 'date', 'after_or_equal:start_date'],
        'employee_id'     => ['required', 'exists:users,id'],
        'status'          => ['required', 'exists:task_status,id'],
        'priority_task'   => ['required', 'exists:task_priorities,id'],
    ]);
        $createTask['assigned_by'] = auth()->id(); 
        $addTask = Usertask::create($createTask);
    try{
        return response()->json(['message' => 'Task created successfully','task' => $addTask]);
    } catch (\Exception $ee) {
        return response()->json(['error' => $ee->getMessage()], 500);
    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usertask  $usertask
     * @return \Illuminate\Http\Response
     */
    public function show(Usertask $usertask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usertask  $usertask
     * @return \Illuminate\Http\Response
     */
    public function edit(Usertask $usertask)
    {
        //
        return response()->json($usertask);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usertask  $usertask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usertask $usertask)
    {
        //
         $editTask = $request->validate([
        'task_title'      => ['required', 'string', 'min:3', 'max:100'],
        'task_desc'       => ['required', 'string'],
        'start_date'      => ['required', 'date'],
        'end_date'        => ['required', 'date', 'after_or_equal:start_date'],
        'employee_id'     => ['required', 'exists:users,id'],
        'status'          => ['required', 'exists:task_status,id'],
        'priority_task'   => ['required', 'exists:task_priorities,id'],
    ]);
    try{
        $usertask->update($editTask);
        return response()->json([
        'message' => 'Task updated successfully',
        'task' => $usertask,
    ]);
    } catch (\Exception $e){
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usertask  $usertask
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usertask $usertask)
    {
        //
         $usertask->delete();

    return response()->json(data: [
        'message' => 'Task deleted successfully'
    ]);
    }
    public function getUserTaskCount(){
        $user = Auth::user();

        $userTaskcount = Usertask::where('employee_id',$user->id)
        ->count();
        $count_inProgress = Usertask::where('status',2)
        ->where('employee_id',$user->id)
        ->count();
        $count_completed = Usertask::where('status',3)
        ->where('employee_id',$user->id)
        ->count();
        return response()->json([
            'total_task' => $userTaskcount,
            'task_inprogress' => $count_inProgress,
            'task_completed' => $count_completed,
        ]);
    }
}
