<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class UserauthController extends Controller
{
    const OTP_EXPIRY_MINUTES = 10;
    const RESET_TOKEN_EXPIRY_MINUTES = 60;
    
    
    

    // Registration Page
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                'confirmed'
            ],
        ], [
            'password.regex' => 'Password must contain at least 1 uppercase, 1 lowercase, 1 number and 1 special character'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $otp = rand(100000, 999999); // 6-digit OTP
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'otp' => $otp,
                'otp_expires_at' => Carbon::now()->addMinutes(self::OTP_EXPIRY_MINUTES)
            ]);

            // Send OTP via WhatsApp
            $this->sendWhatsappOTP($user->phone, $otp);

            return redirect()->route('verify.phone')->with([
                'phone' => $user->phone,
                'message' => 'OTP has been sent to your WhatsApp number'
            ]);

        } catch (\Exception $e) {
            Log::error('Registration Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Registration failed. Please try again.')->withInput();
        }
    }

public function sendWhatsappOTP($phone, $otp)
{
    try {
        $apiToken = env('WHATSAPP_API_TOKEN');

        if (empty($apiToken)) {
            throw new \Exception('WhatsApp API token not configured');
        }

        $formattedPhone = preg_replace('/[^0-9]/', '', $phone);

        Log::channel('whatsapp')->info('Attempting to send OTP', [
            'phone' => $formattedPhone,
            'otp' => $otp,
            'time' => now()->toDateTimeString()
        ]);

        $client = new Client(['timeout' => 20, 'verify' => false]);
        $response = $client->post('https://app.chatberry.net/api/wpbox/sendmessage', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => [
                'token' => $apiToken,
                'phone' => $formattedPhone,
                'message' => "Your Barcody OTP code is: $otp\nValid for " . self::OTP_EXPIRY_MINUTES . " minutes.",
            ]
        ]);

        $responseData = json_decode($response->getBody(), true);

        if ($response->getStatusCode() !== 200 || ($responseData['status'] ?? null) !== 'success') {
            throw new \Exception($responseData['message'] ?? 'Failed to send OTP');
        }

        Log::channel('whatsapp')->info('OTP sent successfully', [
            'phone' => $formattedPhone,
            'response' => $responseData
        ]);

        return true;

    } catch (\Exception $e) {
        Log::channel('whatsapp')->error('Failed to send OTP', [
            'error' => $e->getMessage(),
            'phone' => $phone,
            'trace' => $e->getTraceAsString()
        ]);

        throw new \Exception('Could not send OTP. Please try again.');
    }
    
    
}

    // OTP Verification
    public function showVerifyPhoneForm()
    {
        if (!session('phone')) {
            return redirect()->route('register')->with('error', 'Please register first');
        }

        return view('auth.verify-phone');
    }

    public function verifyPhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|digits:6'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $user = User::where('phone', session('phone'))
                  ->where('otp', $request->otp)
                  ->where('otp_expires_at', '>', Carbon::now())
                  ->first();

        if (!$user) {
            return back()->with('error', 'Invalid or expired OTP');
        }

        $user->update([
            'phone_verified_at' => Carbon::now(),
            'otp' => null,
            'otp_expires_at' => null
        ]);

        auth()->login($user);
        return redirect()->route('dashboard')->with('success', 'Phone verified successfully');
    }

    // Resend OTP
    public function resendOtp()
    {
        try {
            $phone = session('phone');
            if (!$phone) {
                return redirect()->route('register')->with('error', 'Phone number not found');
            }

            $user = User::where('phone', $phone)->first();
            if (!$user) {
                return redirect()->route('register')->with('error', 'User not found');
            }

            $otp = rand(100000, 999999);
            $user->update([
                'otp' => $otp,
                'otp_expires_at' => Carbon::now()->addMinutes(self::OTP_EXPIRY_MINUTES)
            ]);

            $this->sendWhatsappOTP($phone, $otp);

            return back()->with('message', 'New OTP has been sent');

        } catch (\Exception $e) {
            Log::error('Resend OTP Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to resend OTP');
        }
    }
    
    
    
    
    
    
    
    ///////////////////////////////////
    
    
    
     public function registerApi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                'confirmed'
            ],
        ], [
            'password.regex' => 'Password must contain at least 1 uppercase, 1 lowercase, 1 number and 1 special character'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $otp = rand(100000, 999999);
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'otp' => $otp,
                'otp_expires_at' => Carbon::now()->addMinutes(self::OTP_EXPIRY_MINUTES)
            ]);

            $otpSent = false;
            try {
                $this->sendWhatsappOTP($user->phone, $otp);
                $otpSent = true;
            } catch (\Exception $e) {
                Log::warning('WhatsApp OTP not sent during registration: ' . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => $otpSent ? 'OTP has been sent to your WhatsApp number' : 'Account created. OTP service unavailable, contact support.',
                'phone' => $user->phone,
                'otp_expires_in' => self::OTP_EXPIRY_MINUTES . ' minutes',
                'otp_sent' => $otpSent,
            ], 201);

        } catch (\Exception $e) {
            Log::error('API Registration Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Registration failed. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();
        $otp = rand(100000, 999999);
        $user->update(['otp' => $otp, 'otp_expires_at' => Carbon::now()->addMinutes(self::OTP_EXPIRY_MINUTES)]);

        $otpSent = false;
        try {
            $this->sendWhatsappOTP($user->phone, $otp);
            $otpSent = true;
        } catch (\Exception $e) {
            Log::warning('WhatsApp OTP not sent for forgot password: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => $otpSent ? 'OTP sent to your WhatsApp number' : 'OTP generated but WhatsApp service unavailable.',
            'phone' => $user->phone,
            'otp_sent' => $otpSent,
        ]);
    }

    // API OTP Verification
    public function verifyPhoneApi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'otp' => 'required|digits:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('phone', $request->phone)
                  ->where('otp', $request->otp)
                  ->where('otp_expires_at', '>', Carbon::now())
                  ->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP'
            ], 401);
        }

        $user->update([
            'phone_verified_at' => Carbon::now(),
            'otp' => null,
            'otp_expires_at' => null
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Phone verified successfully',
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], 200);
    }

    // API Resend OTP
    public function resendOtpApi(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'phone' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = User::where('phone', $request->phone)->first();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            $otp = rand(100000, 999999);
            $user->update([
                'otp' => $otp,
                'otp_expires_at' => Carbon::now()->addMinutes(self::OTP_EXPIRY_MINUTES)
            ]);

            $this->sendWhatsappOTP($user->phone, $otp);

            return response()->json([
                'success' => true,
                'message' => 'New OTP has been sent',
                'otp_expires_in' => self::OTP_EXPIRY_MINUTES . ' minutes'
            ], 200);

        } catch (\Exception $e) {
            Log::error('API Resend OTP Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to resend OTP',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // API Login
public function loginApi(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials'
        ], 401);
    }

    // Check if phone number exists
    if (empty($user->phone)) {
        return response()->json([
            'success' => false,
            'message' => 'Phone number does not exist for this user'
        ], 400);
    }

    // Always generate and send OTP
    $otp = rand(100000, 999999);
    $user->update([
        'otp' => $otp,
        'otp_expires_at' => Carbon::now()->addMinutes(self::OTP_EXPIRY_MINUTES)
    ]);

    try {
        $this->sendWhatsappOTP($user->phone, $otp);
        
        return response()->json([
            'success' => true,
            'message' => 'OTP has been sent to your registered number',
            'phone' => $user->phone,
            'requires_otp_verification' => true,
            'otp_expires_in' => self::OTP_EXPIRY_MINUTES . ' minutes',
            'is_phone_verified' => (bool)$user->phone_verified_at
        ], 200);
        
    } catch (\Exception $e) {
        Log::error('OTP Send Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Failed to send OTP. Please try again later.'
        ], 500);
    }
}

    // API Logout
    public function logoutApi(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out'
        ], 200);
    }

    // API User Profile
    public function profileApi(Request $request)
    {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ], 200);
    }
    
    

public function updateProfile(Request $request)
{
    $user = $request->user();

    $validator = Validator::make($request->all(), [
        'name' => 'sometimes|string|max:255',
        'email' => 'sometimes|email|unique:users,email,' . $user->id,
        'phone' => 'sometimes|unique:users,phone,' . $user->id,
        'birthDay' => 'sometimes|date',
        'gender' => 'sometimes|in:male,female,other',
        'password' => [
            'sometimes',
            'min:8',
            'confirmed',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/'
        ],
        'image' => 'sometimes|file|image|mimes:jpeg,png,jpg,gif|max:2048',
    ], [
        'password.regex' => 'كلمة المرور يجب أن تحتوي على حرف كبير، وحرف صغير، ورقم، ورمز خاص'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    try {
        $updateData = [];

        if ($request->has('name')) {
            $updateData['name'] = $request->name;
        }

        if ($request->has('email')) {
            $updateData['email'] = $request->email;
        }

        if ($request->has('birthDay')) {
            $updateData['birthDay'] = $request->birthDay;
        }

        if ($request->has('gender')) {
            $updateData['gender'] = $request->gender;
        }

        if ($request->has('phone')) {
            $updateData['phone'] = $request->phone;
            $updateData['phone_verified_at'] = null;

            $otp = rand(100000, 999999);
            $updateData['otp'] = $otp;
            $updateData['otp_expires_at'] = Carbon::now()->addMinutes(10);
            // $this->sendWhatsappOTP($request->phone, $otp); // إذا لديك خدمة OTP
        }

        if ($request->has('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            Log::info('📸 صورة مستلمة', ['name' => $request->file('image')->getClientOriginalName()]);

            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            $imagePath = $request->file('image')->store('users', 'public');
            $updateData['image'] = $imagePath;
        }

        $user->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث الملف الشخصي بنجاح',
            'user' => $user->fresh()
        ]);

    } catch (\Exception $e) {
        Log::error('❌ خطأ أثناء التحديث: ' . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'حدث خطأ أثناء تحديث الملف الشخصي',
            'error' => $e->getMessage()
        ], 500);
    }
}



/**
 * Phone-only login (send OTP)
 */
public function phoneLogin(Request $request)
{
    $validator = Validator::make($request->all(), [
        'phone' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    $user = User::where('phone', $request->phone)->first();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Phone number not registered'
        ], 404);
    }

        if (empty($user->phone)) {
            return response()->json([
                'success' => false,
                'message' => 'Phone number does not exist for this user'
            ], 400);
        }
    // Generate new OTP
    $otp = rand(100000, 999999);
    $user->update([
        'otp' => $otp,
        'otp_expires_at' => Carbon::now()->addMinutes(self::OTP_EXPIRY_MINUTES)
    ]);

    try {
        $this->sendWhatsappOTP($user->phone, $otp);
        
        return response()->json([
            'success' => true,
            'message' => 'OTP has been sent to your registered number',
            'phone' => $user->phone,
            'requires_otp_verification' => true,
            'otp_expires_in' => self::OTP_EXPIRY_MINUTES . ' minutes'
        ]);
        
    } catch (\Exception $e) {
        Log::error('Phone Login OTP Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Failed to send OTP. Please try again later.'
        ], 500);
    }
}

public function deleteAccountApi(Request $request)
{
    $user = $request->user();
    
    try {
        // Logout all devices
        $user->tokens()->delete();
        
        // Delete user account
        $user->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Your account has been permanently deleted'
        ], 200);
        
    } catch (\Exception $e) {
        Log::error('Account Deletion Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Failed to delete account. Please try again.'
        ], 500);
    }
}


    
    
    
}