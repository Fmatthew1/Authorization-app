<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
   // Display list of users excluding existing admins
//    public function index()
//    {
//        $users = User::where('role', 'user')->get(); // Only select users with the role 'user'
//        return view('admin.users', compact('users'));
//    }

     // Show users who are not admins
        public function showUsers()
        {
         $users = User::where('role', '!=', 'admin')->get(); // Fetch non-admin users
         return view('admin.manage-users', compact('users'));
        }

     // Make a user an admin
        public function makeAdmin($id)
        {
        $user = User::find($id);

        if ($user) {
            $user->role = 'admin'; // Update user role to admin
            $user->save();

            return redirect()->route('admin.manageUsers')->with('success', 'User has been made an admin.');
        }

        return redirect()->route('admin.manageUsers')->with('error', 'User not found.');
        }

    // Make a user an admin
    // public function makeAdmin($id)
    // {
    //     $user = User::find($id);

    //     if ($user && $user->role === 'user') { // Ensure only users can be made admins
    //         $user->role = 'admin';
    //         $user->save();

    //         return redirect()->route('admin.users')->with('success', 'User has been made an admin.');
    //     }

    //     return redirect()->route('admin.users')->with('error', 'User not found or already an admin.');
    // }
}
