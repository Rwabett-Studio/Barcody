<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\InboxlistController;
use App\Http\Controllers\SupportsettingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminauthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserauthController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });




// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Show registration form
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Handle registration
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
// Handle login
Route::post('/signin', [AuthController::class, 'signin'])->name('signin');


Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// ##############################################################


// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//     Route::middleware('role:admin')->group(function () {
//         Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
//     });
// });



// ################################################################################

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/categories', [HomeController::class, 'categories'])->name('categories');
Route::get('/events', [HomeController::class, 'events'])->name('events');

//#############################################################

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

//#############################################################

Route::get('/events', [EventController::class, 'index'])->name('events.index');

Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events', [EventController::class, 'store'])->name('events.store');

Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');

Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

//#############################################################

Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');

Route::get('/settings/create', [SettingController::class, 'create'])->name('settings.create');
Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');

Route::get('/settings/{setting}/edit', [SettingController::class, 'edit'])->name('settings.edit');
Route::put('/settings/{setting}', [SettingController::class, 'update'])->name('settings.update');

Route::delete('/settings/{id}', [SettingController::class, 'destroy'])->name('settings.destroy');

//#############################################################

Route::get('/SocialMedia', [SocialMediaController::class, 'index'])->name('SocialMedia.index');

Route::get('/SocialMedia/create', [SocialMediaController::class, 'create'])->name('SocialMedia.create');
Route::post('/SocialMedia', [SocialMediaController::class, 'store'])->name('SocialMedia.store');

Route::get('/SocialMedia/{id}/edit', [SocialMediaController::class, 'edit'])->name('SocialMedia.edit');
Route::put('/SocialMedia/{id}', [SocialMediaController::class, 'update'])->name('SocialMedia.update');

Route::delete('/SocialMedia/{id}', [SocialMediaController::class, 'destroy'])->name('SocialMedia.destroy');

//#############################################################

Route::get('/inboxlists', [InboxlistController::class, 'index'])->name('inboxlists.index');

Route::get('/inboxlists/create', [InboxlistController::class, 'create'])->name('inboxlists.create');
Route::post('/inboxlists', [InboxlistController::class, 'store'])->name('inboxlists.store');

Route::get('/inboxlists/{inboxlist}/edit', [InboxlistController::class, 'edit'])->name('inboxlists.edit');
Route::put('/inboxlists/{inboxlist}', [InboxlistController::class, 'update'])->name('inboxlists.update');

Route::delete('/inboxlists/{inboxlist}', [InboxlistController::class, 'destroy'])->name('inboxlists.destroy');

//#############################################################

Route::get('/supportsettings', [SupportsettingController::class, 'index'])->name('supportsettings.index');

Route::get('/supportsettings/create', [SupportsettingController::class, 'create'])->name('supportsettings.create');
Route::post('/supportsettings', [SupportsettingController::class, 'store'])->name('supportsettings.store');

Route::get('/supportsettings/{supportsetting}/edit', [SupportsettingController::class, 'edit'])->name('supportsettings.edit');
Route::put('/supportsettings/{supportsetting}', [SupportsettingController::class, 'update'])->name('supportsettings.update');

Route::delete('/supportsettings/{supportsetting}', [SupportsettingController::class, 'destroy'])->name('supportsettings.destroy');

// ##############################################################



// Contact Routes
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

// Import Contacts
Route::get('/contacts/import', [ContactController::class, 'showImportForm'])->name('contacts.import.form');
Route::post('/contacts/import', [ContactController::class, 'import'])->name('contacts.import');

Route::middleware('auth')->group(function () {
    Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
});



// Protect all contact routes with the 'auth' middleware
Route::middleware('auth')->group(function () {
    // Contact Routes
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
    Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // Import Contacts
    Route::get('/contacts/import', [ContactController::class, 'showImportForm'])->name('contacts.import.form');
    Route::post('/contacts/import', [ContactController::class, 'import'])->name('contacts.import');
});