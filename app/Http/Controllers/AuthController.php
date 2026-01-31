<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Category;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    protected $events;
    protected $users;
    protected $categories;

    public function __construct()
    {
        $this->events = Event::with(['category', 'user'])->get();
        $this->users = User::all();
        $this->categories = Category::all();
    }



    public function showLoginForm()
    {
        // Check if the user is already authenticated
        if (Auth::check()) {
            $events = Event::with(['category', 'user'])->get();
            $users = User::all();
            $categories = Category::all();

            return view('admin.index', compact('events', 'users', 'categories')); 
        }
    
        // If not authenticated, show the login form
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
        $events = Event::with(['category', 'user'])->get();
        $users = User::all();
        $categories = Category::all();

        return view('admin.index', compact('events', 'users', 'categories')); 
    }

    public function logout()
    {
        Auth::logout(); // Log the user out
        return redirect()->route('login')->with('success', 'Logged out successfully!'); // Redirect to login page
    }


}