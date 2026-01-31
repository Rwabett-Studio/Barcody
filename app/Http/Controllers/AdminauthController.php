<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminauthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.signIn');
    }

    // Show registration form
    public function showRegisterForm()
    {
        return view('admin.auth.signUp');
    }

    // Handle registration
    public function signup(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect to login page after registration
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }

    // Handle login
    public function signin(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user
        if (!Auth::attempt($request->only('email', 'password'))) {
            return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }

        // Redirect to admin dashboard after successful login
        // return redirect()->route('admin.index')->with('success', 'Logged in successfully!');
        return view('admin.index');
    }


}