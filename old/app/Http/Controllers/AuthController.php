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
        // This can be left empty, as we will load data on login
    }

    public function showLoginForm()
    {
        // Check if the user is already authenticated
        if (Auth::check()) {
            return redirect()->route('admin.index'); // Redirect to admin.index if already authenticated
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
        User::create([
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
        
            // Fetch data for the dashboard
            $events = Event::with(['category', 'user'])->get();
            $users = User::all();
            $categories = Category::all();
        
            // Store data in the session and redirect to admin.index
            session(['events' => $events, 'users' => $users, 'categories' => $categories]);
        
            // Redirect to admin dashboard after successful login
            return redirect()->route('admin.index')->with('success', 'Logged in successfully!');
        }

    public function logout()
    {
        Auth::logout(); // Log the user out
        return redirect()->route('login')->with('success', 'Logged out successfully!'); // Redirect to login page
    }
}