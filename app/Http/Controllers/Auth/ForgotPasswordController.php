<?php
// app/Http/Controllers/Auth/ForgotPasswordController.php (NEW FILE)

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * Display the form to request a password reset link.
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Handle sending the password reset link.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = DB::selectOne('SELECT * FROM users WHERE email = ?', [$request->email]);

        if (!$user) {
            return back()->with('error', 'We can\'t find a user with that email address.');
        }

        // Create a new token
        $token = Str::random(60);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => now()]
        );

        // In a real app, you would email this link. For now, we'll show a success message
        // and the user can manually navigate to the reset URL with the token.
        $resetUrl = route('password.reset', ['token' => $token, 'email' => $request->email]);
        
        return back()->with('success', "Password reset link sent (for demo, navigate to the reset page manually). Token: $token");
    }

    /**
     * Display the password reset form.
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Handle resetting the user's password.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $resetRecord = DB::selectOne('SELECT * FROM password_reset_tokens WHERE email = ?', [$request->email]);

        if (!$resetRecord || $resetRecord->token !== $request->token) {
            return back()->with('error', 'This password reset token is invalid.');
        }

        DB::table('users')->where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Your password has been reset! You can now log in.');
    }
}