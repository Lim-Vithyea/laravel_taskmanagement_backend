<?php

namespace App\Http\Controllers;

use App\Models\Usertask;
use Illuminate\Http\Request;

class UsertaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    // Update task with validated data
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

    return response()->json([
        'message' => 'Task deleted successfully'
    ]);
    }
}
