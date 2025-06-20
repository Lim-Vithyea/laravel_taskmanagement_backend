<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\RedirectController;
use Illuminate\Validation\Rule;
use App\Models\UserImage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function register(Request $request){
        $incomingRequest = $request->validate([
            'name' => ['required', 'min:3', 'max:40'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:200'],
            'role' => ['required']
        ]);
        $incomingRequest['password'] = bcrypt($incomingRequest['password']);
        try {
        User::create($incomingRequest);
        // auth()->login($user);
            return response()->json(['message' => 'User registered successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
    public function getUser(){

        $normalUser = User::with('image')->where('role',2)->get();
        return response()->json($normalUser);
    }
    public function getAdmin(){

        $adminUser = User::with('image')->where('role',1)->get();
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


    //this function allow user to uplaod an image into our backend storage
    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();
          if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // Store the image
        $path = $request->file('image')->store('profile_images', 'public');
        // Store image in separate table
        $userImage = UserImage::updateOrCreate(
            ['user_id' => $user->id],
            ['image_path' => $path]
        );

        return response()->json(['message' => 'Image uploaded successfully', 'image' => $userImage]);
    }

    //currently don't need this function yet
    // public function getUserProfile(){
    //     $user = auth()->user();
    //     $userwithimage = User::with('image')->where('id',$user->id)->first();
    //     return response()->json($userwithimage);
    // }

    //this is for user edit their profile
    
    // public function userSelfUpdate(Request $request, $id){
    //     $user = auth()->user();
    //     $request->validate([
    //         'name' => 'sometimes|required|string|min:3|max:50',
    //         'email' => "sometimes|required|email|unique:users,email,$id",
    //         'password' => 'nullable|min:8|confirmed',
    //         'role' => 'nullable|in:1,2'
    //     ]);

    //     $user = User::findOrFail($id);
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->role = $request->role;

    //     if ($request->filled('password')) {
    //     $user->password = Hash::make($request->password);
    //     }
    //         $user->save();

    //         return response()->json([
    //             'message' => 'User updated successfully',
    //             'user' => $user
    //         ]);
    //     }
    
        //this is for admin
    public function update(Request $request, $id)
    {
        // $authUser = auth()->user();

        // if ($authUser->id != $id) {
        //     return response()->json(['message' => 'You can only update your own account.'], 403);
        // }

        $request->validate([
            'name' => 'sometimes|required|string|min:3|max:50',
            'email' => "sometimes|required|email|unique:users,email,$id",
            'password' => 'nullable|min:8|confirmed',
            'role' => 'nullable|in:1,2'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
        }
            $user->save();

            return response()->json([
                'message' => 'User updated successfully',
                'user' => $user
            ]);
        }


}
