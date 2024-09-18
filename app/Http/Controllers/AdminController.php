<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminController extends Controller
{
   // Display list of users excluding existing admins

     // Show users who are not admins
        public function showUsers()
        {
         // Get users who do not have the 'admin' role
            $users = User::whereDoesntHave('roles', function ($query) {
               $query->where('name', 'admin');
            })->get();

            return view('admin.manage-users', compact('users'));
          // Get the admin role
      //   $adminRole = Role::where('name', 'admin')->first();
      //   // Retrieve users whose role is not admin
      //   $users = User::where('role_id', '!=', $adminRole->id)->get();
      //    //$users = User::where('role', '!=', 'admin')->get(); // Fetch non-admin users
      //    return view('admin.manage-users', compact('users'));
        }

     // Make a user an admin
        public function makeAdmin($id)
        {
         // Get the 'admin' role
         $adminRole = Role::where('name', 'admin')->first();

         if (!$adminRole) {
        // Handle if 'admin' role does not exist
        return redirect()->route('admin.manageUsers')->with('error', 'Admin role not found.');
    }

    // Find the user by ID
         $user = User::find($id);

      if ($user) {
        // Attach the 'admin' role to the user
        $user->roles()->attach($adminRole->id);

        return redirect()->route('admin.manageUsers')->with('success', 'User has been made an admin.');
    }

    // If user is not found
      return redirect()->route('admin.manageUsers')->with('error', 'User not found.');
      //   $user = User::find($id);

      //   if ($user) {
      //       $user->role_id = 1; // Update user role to admin
      //       $user->save();

      //       return redirect()->route('admin.manageUsers')->with('success', 'User has been made an admin.');
      //   }

      //   return redirect()->route('admin.manageUsers')->with('error', 'User not found.');
        }

  
}
