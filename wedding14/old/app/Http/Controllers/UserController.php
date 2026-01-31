<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('admin.users.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,user,coordinator',
            'roles' => 'nullable|array', // Validate roles as an array
            'roles.*' => 'in:create,edit,delete', // Validate each role value
        ]);
    
        // Map roles to individual fields
        $roles = $request->roles ?? [];
        $createRole = in_array('create', $roles) ? 1 : 0;
        $editRole = in_array('edit', $roles) ? 1 : 0;
        $deleteRole = in_array('delete', $roles) ? 1 : 0;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'create_role' => $createRole,
            'edit_role' => $editRole,
            'delete_role' => $deleteRole,
        ]);

        return redirect()->route('users.index')
                         ->with('success', 'User created successfully.');
    }

    // Display the specified resource
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    // Show the form for editing the specified resource
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update the specified resource in storage
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|in:admin,user,coordinator',
            'create_role' => 'nullable|boolean', 
            'edit_role' => 'nullable|boolean', 
            'delete_role' => 'nullable|boolean', 
        ]);
    
        // Map roles to individual fields
        $roles = $request->roles ?? [];
        $createRole = in_array('create', $roles) ? 1 : 0;
        $editRole = in_array('edit', $roles) ? 1 : 0;
        $deleteRole = in_array('delete', $roles) ? 1 : 0;

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'create_role' => $request->create_role ?? 0, // Default to 0 if not checked
            'edit_role' => $request->edit_role ?? 0, // Default to 0 if not checked
            'delete_role' => $request->delete_role ?? 0, // Default to 0 if not checked
        ]);

        if ($request->password) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('users.index')
                         ->with('success', 'User updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
                         ->with('success', 'User deleted successfully.');
    }
}