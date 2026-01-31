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
use App\Http\Controllers\EventContactController;
use App\Http\Controllers\LandingPage\HeroSectionController;
use App\Http\Controllers\LandingPage\HowUseBarcodyController;
use App\Http\Controllers\LandingPage\InvitationCategorieController;
use App\Http\Controllers\LandingPage\PlanController;
use App\Http\Controllers\LandingPage\FaqController;
use App\Http\Controllers\LandingPage\InformationController;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


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


Route::middleware('auth:sanctum')->group(function () {
    // Notification routes
    Route::get('/notifications', [\App\Http\Controllers\API\NotificationController::class, 'index']);
    Route::post('/contacts/{contact}/status', [\App\Http\Controllers\API\NotificationController::class, 'updateStatus']);
    Route::post('/notifications/{notification}/read', [\App\Http\Controllers\API\NotificationController::class, 'markAsRead']);
    
    // Contact invitation response endpoint (for contacts to respond)
    Route::post('/invitations/{contact}/respond', function (Request $request, Contact $contact) {
        $request->validate([
            'status' => 'required|in:accepted,declined'
        ]);

        if ($request->status === 'accepted') {
            $contact->markAsAccepted();
        } else {
            $contact->markAsDeclined();
        }

        return response()->json([
            'success' => true,
            'message' => 'Invitation response recorded'
        ]);
    });
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Show registration form
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Handle registration
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
// Handle login
Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// Add these routes
// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [UserauthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [UserauthController::class, 'register']);
    
    Route::get('/verify-phone', [UserauthController::class, 'showVerifyPhoneForm'])->name('verify.phone');
    Route::post('/verify-phone', [UserauthController::class, 'verifyPhone']);
    Route::get('/resend-otp', [UserauthController::class, 'resendOtp'])->name('resend.otp');
});



// Route::get('/test-whatsapp', function() {
//     try {
//         $phone = '966546421766'; // Your test number
//         $otp = rand(100000, 999999);
        
//         app()->make('App\Http\Controllers\UserauthController')
//             ->sendWhatsappOTP($phone, $otp);
            
//         return "Test OTP sent to $phone";
//     } catch (\Exception $e) {
//         return "Error: " . $e->getMessage();
//     }
// });





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

Route::get('/event-detail/{id}', [EventController::class, 'showDetail'])
     ->name('event.detail');

Route::get('/contacts/statuses', function () {
    return \App\Models\Contact::select('id', 'status')->get();
});


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


Route::middleware('auth')->group(function () {
    // Event-specific contact routes
    Route::prefix('events/{event}')->group(function () {
        // Contact Routes
        Route::get('/contactsevent', [EventContactController::class, 'index'])->name('event.contacts.index');
        
        Route::get('/contactsevent/create', [EventContactController::class, 'create'])->name('event.contacts.create');
        
        Route::post('/contactsevent', [EventContactController::class, 'store'])->name('event.contacts.store');
        
        
        Route::get('/contactsevent/{contact}/edit', [EventContactController::class, 'edit'])->name('event.contacts.edit');
        
        Route::put('/contactsevent/{contact}', [EventContactController::class, 'update'])->name('event.contacts.update');
        
        Route::delete('/contactsevent/{contact}', [EventContactController::class, 'destroy'])->name('event.contacts.destroy');
        
        // Import Contacts
        Route::get('/contactsevent/import', [EventContactController::class, 'showImportForm'])->name('event.contacts.import.form');
        
        Route::post('/contactsevent/import', [EventContactController::class, 'import'])->name('event.contacts.import');
    });
});




// Authentication Routes
Route::get('/register', [UserauthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserauthController::class, 'register']);

Route::get('/login', [UserauthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserauthController::class, 'login']);

Route::get('/login/phone', [UserauthController::class, 'showPhoneLoginForm'])->name('login.phone');

Route::get('/verify-phone', [UserauthController::class, 'showVerifyPhoneForm'])->name('verify.phone');
Route::post('/verify-phone', [UserauthController::class, 'verifyPhone']);

Route::get('/forgot-password', [UserauthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [UserauthController::class, 'forgotPassword'])->name('password.email');

Route::get('/reset-password/{token}', [UserauthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [UserauthController::class, 'resetPassword'])->name('password.update');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/profile', [UserauthController::class, 'showProfile'])->name('profile.show');
    Route::post('/profile', [UserauthController::class, 'updateProfile'])->name('profile.update');
    
    Route::post('/logout', function () {
        auth()->logout();
        return redirect('/');
    })->name('logout');
});

Route::post('/events/{event}/contacts/send-invitations', [EventContactController::class, 'sendInvitations'])
    ->name('event.contacts.send.invitations');


Route::post('/events/{event}/send-invitations', [EventContactController::class, 'sendInvitations'])
    ->name('event.contacts.send.invitations');

Route::get('/invitation/response/{contact_id}', [EventContactController::class, 'showInvitationResponse'])
    ->name('invitation.response');

Route::post('/invitation/respond/{contact_id}', [EventContactController::class, 'processResponse'])
     ->name('invitation.response.submit');

Route::get('/invitation/thankyou', [EventContactController::class, 'showThankYouPage'])
    ->name('invitation.thankyou');
    
Route::post('/events/{event}/contacts/send-qrcodes', [EventContactController::class, 'sendQrCodes'])
    ->name('event.contacts.send.qrcodes');
    
    
    
    
    
    
    
    
    // Hero Section Routes
Route::resource('hero-sections', \App\Http\Controllers\LandingPage\HeroSectionController::class);
Route::prefix('hero-sections')->group(function () {
    Route::get('api', [\App\Http\Controllers\LandingPage\HeroSectionController::class, 'apiIndex'])->name('hero-sections.api.index');
    Route::get('api/{heroSection}', [\App\Http\Controllers\LandingPage\HeroSectionController::class, 'apiShow'])->name('hero-sections.api.show');
});

// How To Use Barcody Routes
Route::resource('how-use-barcodies', \App\Http\Controllers\LandingPage\HowUseBarcodyController::class);
Route::prefix('how-use-barcodies')->group(function () {
    Route::get('api', [\App\Http\Controllers\LandingPage\HowUseBarcodyController::class, 'apiIndex'])->name('how-use-barcodies.api.index');
    Route::get('api/{howUseBarcody}', [\App\Http\Controllers\LandingPage\HowUseBarcodyController::class, 'apiShow'])->name('how-use-barcodies.api.show');
});

// Invitation Categories Routes
Route::resource('invitation-categories', \App\Http\Controllers\LandingPage\InvitationCategorieController::class);
Route::prefix('invitation-categories')->group(function () {
    Route::get('api', [\App\Http\Controllers\LandingPage\InvitationCategorieController::class, 'apiIndex'])->name('invitation-categories.api.index');
    Route::get('api/{invitationCategorie}', [\App\Http\Controllers\LandingPage\InvitationCategorieController::class, 'apiShow'])->name('invitation-categories.api.show');
});

// Plans Routes
Route::resource('plans', \App\Http\Controllers\LandingPage\PlanController::class);
Route::prefix('plans')->group(function () {
    Route::get('api', [\App\Http\Controllers\LandingPage\PlanController::class, 'apiIndex'])->name('plans.api.index');
    Route::get('api/{plan}', [\App\Http\Controllers\LandingPage\PlanController::class, 'apiShow'])->name('plans.api.show');
});

// FAQs Routes
Route::resource('faqs', \App\Http\Controllers\LandingPage\FaqController::class);
Route::prefix('faqs')->group(function () {
    Route::get('api', [\App\Http\Controllers\LandingPage\FaqController::class, 'apiIndex'])->name('faqs.api.index');
    Route::get('api/{faq}', [\App\Http\Controllers\LandingPage\FaqController::class, 'apiShow'])->name('faqs.api.show');
});

// Information Section Routes
Route::resource('information-sections', \App\Http\Controllers\LandingPage\InformationController::class);
Route::prefix('information-sections')->group(function () {
    Route::get('api', [\App\Http\Controllers\LandingPage\InformationController::class, 'apiIndex'])->name('information-sections.api.index');
    Route::get('api/{information}', [\App\Http\Controllers\LandingPage\InformationController::class, 'apiShow'])->name('information-sections.api.show');
});



// routes/web.php
Route::post('/webhook-data', [App\Http\Controllers\EventContactController::class, 'handleWebhook']);




Route::post('/webhook/test', [EventContactController::class, 'handlewebhook']);




