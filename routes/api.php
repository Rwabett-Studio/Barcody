<?php

use Illuminate\Http\Request;
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
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\EventContactController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public Routes
Route::prefix('auth')->group(function () {
    Route::post('/register', [UserauthController::class, 'registerApi']);
    Route::post('/login', [UserauthController::class, 'loginApi']);
    Route::post('/send-otp', [UserauthController::class, 'sendOtp']);
    Route::post('/forgot-password', [UserauthController::class, 'forgotPassword']);
    Route::post('/reset-password', [UserauthController::class, 'resetPassword']);
    Route::post('/phone-login', [UserauthController::class, 'phoneLogin']);
    
    // OTP Verification
    Route::post('/verify-otp', [UserauthController::class, 'verifyPhoneApi']);
    Route::post('/resend-otp', [UserauthController::class, 'resendOtpApi']);
});

Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'apiIndex']);
    Route::get('/{event}', [EventController::class, 'apiShow']);
});

Route::get('/categories', [CategoryController::class, 'apiIndex']);
Route::get('/settings', [SettingController::class, 'apiIndex']);
Route::get('/social-media', [SocialMediaController::class, 'apiIndex']);
Route::get('/inboxlists', [InboxlistController::class, 'apiIndex']);
Route::get('/support-settings', [SupportsettingController::class, 'apiIndex']);
Route::get('/notifications', [NotificationController::class, 'index']);

// Authenticated Routes (Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    // Auth Routes
    
    Route::post('/events/{event}/send-invitations', [EventContactController::class, 'sendInvitations'])
    ->name('apisendInvitations');
    
    Route::prefix('auth')->group(function () {
        Route::post('/verify-phone', [UserauthController::class, 'verifyPhone']);
        Route::put('/profile', [UserauthController::class, 'updateProfile']);
        Route::post('/profile', [UserauthController::class, 'updateProfile']);

        Route::post('/logout', [UserauthController::class, 'logoutApi']);
        Route::get('/profile', [UserauthController::class, 'profileApi']);
        Route::delete('/account', [UserauthController::class, 'deleteAccountApi']);
        
        
    });

    // Contacts Routes
    Route::prefix('contacts')->group(function () {
        Route::get('/', [ContactController::class, 'apiIndex']);
        Route::get('/invited', [ContactController::class, 'apiInvited']);
        Route::get('/{contact}', [ContactController::class, 'apiShow']);
        Route::post('/', [ContactController::class, 'apiStore']);
        Route::put('/{contact}', [ContactController::class, 'apiUpdate']);
        Route::post('/{contact}', [ContactController::class, 'apiUpdate']);

        Route::delete('/{contact}', [ContactController::class, 'apiDestroy']);
        Route::post('/import', [ContactController::class, 'apiImport']);
    });

    // Event-specific Contacts
    Route::get('/events/{event}/contacts/invited', [ContactController::class, 'apiEventInvited']);

    // Events Routes
    Route::prefix('events')->group(function () {
        Route::post('/', [EventController::class, 'apiStore']);
        Route::post('/{event}', [EventController::class, 'apiUpdate']);
        Route::delete('/{event}', [EventController::class, 'apiDestroy']);
        Route::get('/{event}/contacts', [EventController::class, 'apiEventContacts']);
        Route::post('/{event}/import-contacts', [EventController::class, 'apiImportContacts']);
        Route::post('/{event}/draft', [EventController::class, 'apiMarkAsDraft']);
        Route::post('/{event}/published', [EventController::class, 'apiMarkAsPublished']);
    });

    // Categories Routes
    Route::prefix('categories')->group(function () {
        Route::post('/', [CategoryController::class, 'apiStore']);
        Route::get('/{category}', [CategoryController::class, 'apiShow']);
        Route::put('/{category}', [CategoryController::class, 'apiUpdate']);
        Route::post('/{category}', [CategoryController::class, 'apiUpdate']);

        Route::delete('/{category}', [CategoryController::class, 'apiDestroy']);
    });

    // Settings Routes
    Route::prefix('settings')->group(function () {
        Route::post('/', [SettingController::class, 'apiStore']);
        Route::put('/{setting}', [SettingController::class, 'apiUpdate']);
        Route::delete('/{setting}', [SettingController::class, 'apiDestroy']);
    });

    // Social Media Routes
    Route::prefix('social-media')->group(function () {
        Route::post('/', [SocialMediaController::class, 'apiStore']);
        Route::put('/{id}', [SocialMediaController::class, 'apiUpdate']);
        Route::delete('/{id}', [SocialMediaController::class, 'apiDestroy']);
    });

    // Inboxlist Routes
    Route::prefix('inboxlists')->group(function () {
        Route::post('/', [InboxlistController::class, 'apiStore']);
        Route::put('/{inboxlist}', [InboxlistController::class, 'apiUpdate']);
        Route::delete('/{inboxlist}', [InboxlistController::class, 'apiDestroy']);
    });

    // Support Settings Routes
    Route::prefix('support-settings')->group(function () {
        Route::post('/', [SupportsettingController::class, 'apiStore']);
        Route::put('/{supportsetting}', [SupportsettingController::class, 'apiUpdate']);
        Route::delete('/{supportsetting}', [SupportsettingController::class, 'apiDestroy']);
    });

    // Users Routes
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'apiIndex']);
        Route::post('/', [UserController::class, 'apiStore']);
        Route::get('/{user}', [UserController::class, 'apiShow']);
        Route::put('/{user}', [UserController::class, 'apiUpdate']);
        Route::post('/{user}', [UserController::class, 'apiUpdate']);

        Route::delete('/{user}', [UserController::class, 'apiDestroy']);
    });

    

    
});


Route::prefix('api')->group(function() {
    Route::post('/event/{event}/invitations', [EventContactController::class, 'apiSendInvitations']);
    Route::post('/invitations/{contact_id}/response', [EventContactController::class, 'apiProcessResponse']);
    Route::get('/invitations/thank-you', [EventContactController::class, 'apiShowThankYouPage']);
});

Route::post('/events/{event}/invitations', [EventContactController::class, 'apiSendInvitations']);


Route::post('/webhook-data', [App\Http\Controllers\EventContactController::class, 'handleWebhook']);

