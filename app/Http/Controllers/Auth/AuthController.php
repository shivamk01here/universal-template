<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\Frontend\CartController;

class AuthController extends Controller
{
    /**
     * Display the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate(['email' => 'required|email', 'password' => 'required']);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // ** MERGE CART LOGIC **
            CartController::mergeGuestCartToUserCart();

            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }
            // Redirect to checkout if they came from there, otherwise to home
            return redirect()->intended(route('checkout.index'));
        }

        
        return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->onlyInput('email');
    }

    /**
     * Display the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $otp = '545454'; // Static OTP for now

        // Store registration data in the session temporarily
        $request->session()->put('registration_data', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        // In a real app, you would email the OTP here.
        // For now, we return a success response to trigger the modal.
        return response()->json(['success' => 'OTP sent successfully.']);
    }

    /**
     * Step 2 of Registration: Verify OTP and create the user.
     */
    public function verifyAndCreateUser(Request $request)
    {
        $request->validate(['otp' => 'required|numeric']);
        $regData = $request->session()->get('registration_data');

        // Check if registration data exists and OTP is valid
        if (!$regData || $regData['otp'] !== $request->otp || now()->gt($regData['otp_expires_at'])) {
            return response()->json(['error' => 'Invalid or expired OTP.'], 422);
        }

        // OTP is correct, now create the user
        $userId = DB::table('users')->insertGetId([
            'name' => $regData['name'],
            'email' => $regData['email'],
            'password' => $regData['password'],
            'is_verified' => 1,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Clean up session
        $request->session()->forget('registration_data');

        // Log the new user in
        Auth::loginUsingId($userId);
        CartController::mergeGuestCartToUserCart();

        return response()->json([
            'success' => 'Account verified successfully!',
            'redirect_url' => route('home')
        ]);
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function showOtpForm()
    {
        return view('auth.verify-otp');
    }
}
