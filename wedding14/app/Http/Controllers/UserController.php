<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            'birthDay' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female,other',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required|string|in:admin,user,coordinator',
            'create_role' => 'nullable|boolean',
            'edit_role' => 'nullable|boolean',
            'delete_role' => 'nullable|boolean',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'birthDay' => $request->birthDay,
            'gender' => $request->gender,
            'role' => $request->role,
            'create_role' => $request->create_role ?? 0,
            'edit_role' => $request->edit_role ?? 0,
            'delete_role' => $request->delete_role ?? 0,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users', 'public');
            $userData['image'] = $imagePath;
        }

        User::create($userData);

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
            'birthDay' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female,other',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required|string|in:admin,user,coordinator',
            'create_role' => 'nullable|boolean',
            'edit_role' => 'nullable|boolean',
            'delete_role' => 'nullable|boolean',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthDay' => $request->birthDay,
            'gender' => $request->gender,
            'role' => $request->role,
            'create_role' => $request->create_role ?? 0,
            'edit_role' => $request->edit_role ?? 0,
            'delete_role' => $request->delete_role ?? 0,
        ];

        // Handle password update
        if ($request->password) {
            $userData['password'] = Hash::make($request->password);
        }

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $imagePath = $request->file('image')->store('users', 'public');
            $userData['image'] = $imagePath;
        }

        $user->update($userData);

        return redirect()->route('users.index')
                         ->with('success', 'User updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy(User $user)
    {
        // Delete user image if exists
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        $user->delete();

        return redirect()->route('users.index')
                         ->with('success', 'User deleted successfully.');
    }










    public function apiIndex()
    {
        $users = User::all();
        return response()->json([
            'success' => true,
            'data' => $users,
            'message' => 'Users retrieved successfully'
        ]);
    }

    // API: Create new user
    public function apiStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'birthDay' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female,other',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required|string|in:admin,user,coordinator',
            'create_role' => 'nullable|boolean',
            'edit_role' => 'nullable|boolean',
            'delete_role' => 'nullable|boolean',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'birthDay' => $request->birthDay,
            'gender' => $request->gender,
            'role' => $request->role,
            'create_role' => $request->create_role ?? 0,
            'edit_role' => $request->edit_role ?? 0,
            'delete_role' => $request->delete_role ?? 0,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users', 'public');
            $userData['image'] = $imagePath;
        }

        $user = User::create($userData);

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User created successfully'
        ], 201);
    }

    // API: Get single user
    public function apiShow(User $user)
    {
        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User retrieved successfully'
        ]);
    }

    // API: Update user
    public function apiUpdate(Request $request, User $user)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'sometimes|required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'birthDay' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female,other',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'sometimes|required|string|in:admin,user,coordinator',
            'create_role' => 'nullable|boolean',
            'edit_role' => 'nullable|boolean',
            'delete_role' => 'nullable|boolean',
        ]);

        $userData = [
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'phone' => $request->phone ?? $user->phone,
            'birthDay' => $request->birthDay ?? $user->birthDay,
            'gender' => $request->gender ?? $user->gender,
            'role' => $request->role ?? $user->role,
            'create_role' => $request->create_role ?? $user->create_role,
            'edit_role' => $request->edit_role ?? $user->edit_role,
            'delete_role' => $request->delete_role ?? $user->delete_role,
        ];

        // Handle password update
        if ($request->password) {
            $userData['password'] = Hash::make($request->password);
        }

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $imagePath = $request->file('image')->store('users', 'public');
            $userData['image'] = $imagePath;
        }

        $user->update($userData);

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User updated successfully'
        ]);
    }

    // API: Delete user
    public function apiDestroy(User $user)
    {
        // Delete user image if exists
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ]);
    }

}