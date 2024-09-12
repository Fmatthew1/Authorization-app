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
        
        return view('roles.create');
            
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
        return redirect('roles.index')->with('success','Role successfully created');
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
        return view('roles.edit', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       
        $request->validate([
            'name' => 'required|string|unique:roles,name|max:255,' . $id,
           
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        //dd($request->all());
        $role->save();

        return redirect('roles.index')->with('success', 'Role Successfully Updated');
        
        // $role = Role::findOrFail($id);

        // $validator = Validator::make($request->all(), [
        //     'name' => [
        //         'required',
        //         Rule::unique('roles')->ignore($role),
        //         'max:255',
        //     ]
        // ]);

        // if ($validator->fails()) {
        //     return redirect()
        //         ->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        // $input = request();

        // $role = Role::find($id);
        // $role->name = $input['name'];
        // $role->save();

        // return redirect('roles')->with('success', 'Role Successfully Updated');
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
