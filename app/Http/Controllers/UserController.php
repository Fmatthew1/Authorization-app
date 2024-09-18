<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function assignRole(Request $request, User $user, Role $role)
    {
        $user->assignRole($role);
        return redirect()->back()->with('success', 'Role assigned successfully');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::all();
        return view('users.index', compact('users'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|max:100',
            'role_id' => 'required|exists:roles,id'
        ]);

        $user = new User();

        $input = request();

        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->role_id = $input['role_id'];
        $user->save();
 
        // $input = $request->all();
        // $user = User::create($input);
        // $input['password'] = Hash::make($input['password']);
        //$user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $assignedRoleId = $user->role_id;
        return view('users.show', ['user' => $user, 'roles' => $roles, 'assignedRoleId' => $assignedRoleId]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('users.index')->with('success', 'User Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}
