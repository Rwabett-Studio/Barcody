<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function admin(){
        return view('admin.index', [
            'totalUsers' => User::count(),
            'totalEvents' => Event::count(),
            'totalCategories' => Category::count(),
            'publishedEvents' => Event::where('status', 'published')->count(),
            'draftEvents' => Event::where('status', 'draft')->count(),
            'confirmedTotal' => (int) DB::table('events')->sum('confirmed'),
            'canceledTotal' => (int) DB::table('events')->sum('canceled'),
            'failedTotal' => (int) DB::table('events')->sum('failed'),
            'scannedTotal' => (int) DB::table('events')->sum('scanned'),
        ]);
    }

    public function categories(){
        return view('admin.categories.index');
    }

    public function events(){
        return view('admin.events.index');
    }
}
