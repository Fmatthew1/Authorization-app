<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = new Role();

        $role->name = request('name');

        return view('roles.create', [
            'role' => $role
        ]);
            
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);

        $role = new Role();
        $role->name = request('name');
        $role->save();
        return redirect()->route('roles.index')->with('success','Role successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::findOrFail($id);
        return view('roles.show', ['role'=> $role]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $roles = Role::pluck('name', 'id');
        // dd($roles);

        return view('roles.edit', ['role' => $role, 'roles' => $roles]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->name;

        $validator = Validator::make($request->all(), [
            'name' => [
                // 'required',
                // Rule::unique('roles')->ignore($role),
                'max:255',
            ]
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $role->save();

        // $roleId = Role::find($id);
        // $request->validate([
        // 'name' => 'required|unique:roles|max:255',
        // Rule::unique('roles')->ignore($roleId),
            
        // ]);

        // $role = Role::find($id);
        // $role->name = $request->input('name');
        // $role->save();

        return redirect()->route('roles.index')->with('success', 'Role Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
    
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }
}
