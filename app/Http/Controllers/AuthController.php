<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Category;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{


    protected $events;
    protected $users;
    protected $categories;

    public function __construct()
    {
        $this->events = Event::query();
        $this->users = User::query();
        $this->categories = Category::query();
    }



    public function showLoginForm()
    {
        // Check if the user is already authenticated
        if (Auth::check()) {
            return view('admin.index', $this->dashboardStats()); 
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
        return view('admin.index', $this->dashboardStats()); 
    }

    public function logout()
    {
        Auth::logout(); // Log the user out
        return redirect()->route('login')->with('success', 'Logged out successfully!'); // Redirect to login page
    }

    private function dashboardStats(): array
    {
        return [
            'totalUsers' => User::count(),
            'totalEvents' => Event::count(),
            'totalCategories' => Category::count(),
            'publishedEvents' => Event::where('status', 'published')->count(),
            'draftEvents' => Event::where('status', 'draft')->count(),
            'confirmedTotal' => (int) DB::table('events')->sum('confirmed'),
            'canceledTotal' => (int) DB::table('events')->sum('canceled'),
            'failedTotal' => (int) DB::table('events')->sum('failed'),
            'scannedTotal' => (int) DB::table('events')->sum('scanned'),
            'recentEvents' => Event::orderBy('created_at', 'desc')->take(5)->get(),
        ];
    }


}
