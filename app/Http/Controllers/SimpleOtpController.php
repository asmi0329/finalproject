<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Carbon\Carbon;

class SimpleOtpController extends Controller
{
    /**
     * Step 2: Modified Register Logic (Generate OTP + Send Email)
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Generate OTP
        $otp = rand(100000, 999999);

        // Create user but not verified
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(5),
            'email_verified' => 0,
        ]);

        // Send OTP Email (simple way)
        try {
            Mail::raw("Your OTP code is: $otp", function($message) use ($request) {
                $message->to($request->email)
                        ->subject("Email Verification OTP");
            });
            \Log::info("OTP email sent successfully to: {$request->email}");
        } catch (\Exception $e) {
            // Log error but continue
            \Log::error("Failed to send OTP email: " . $e->getMessage());
            // For now, show user that email failed but system continues
            session(['email_failed' => true]);
        }

        return redirect()->route('verify.form')->with('email', $request->email);
    }

    /**
     * Step 3: Verify OTP
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found']);
        }

        if ($user->otp !== $request->otp) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        if (now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'OTP expired']);
        }

        // Verify user
        $user->email_verified = 1;
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return redirect('/login')->with('success', 'Account verified successfully!');
    }

    /**
     * Show registration form
     */
    public function showRegisterForm()
    {
        return view('auth.register-simple');
    }

    /**
     * Show verification form
     */
    public function showVerifyForm()
    {
        return view('auth.verify');
    }

    /**
     * Resend OTP
     */
    public function resendOtp(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found with this email address.'
            ]);
        }

        // Generate new OTP
        $otp = rand(100000, 999999);

        // Update user with new OTP
        $user->update([
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(5),
            'email_verified' => 0,
        ]);

        // Send OTP Email
        try {
            Mail::raw("Your new OTP code is: $otp", function($message) use ($request) {
                $message->to($request->email)
                        ->subject("Email Verification OTP - Resend");
            });
            
            return response()->json([
                'success' => true,
                'message' => 'New OTP code sent to your email address.'
            ]);
        } catch (\Exception $e) {
            \Log::error("Failed to resend OTP email: " . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP email. Please try again.'
            ]);
        }
    }
}
