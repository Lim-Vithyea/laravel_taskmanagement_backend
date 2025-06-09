<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\RedirectController;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
    public function register(Request $request){
        $incomingRequest = $request->validate([
            'name' => ['required', 'min:3', 'max:10'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:200'],
            // 'job' => ['required', 'max:30'],
            'role' => ['required']
        ]);
        $incomingRequest['password'] = bcrypt($incomingRequest['password']);
        try {
        $user = User::create($incomingRequest);
        auth()->login($user);
            return response()->json(['message' => 'User registered successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
    public function getUser(){
        $normalUser = User::where('role',2)->get();
        return response()->json($normalUser);
    }
    public function getAdmin(){
        $adminUser = User::where('role',1)->get();
        return response()->json($adminUser);
    }
    public function destroy($id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json([
            'error' => 'User not found'
        ], 404);
    }
    $user->forceDelete(); 

    return response()->json([
        'message' => 'User deleted successfully'
    ]);
}
}
