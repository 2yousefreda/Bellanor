<?php

namespace App\Services;


use App\Http\Requests\EmailVerificationRequest;
use App\Notifications\LoginNotification;
use App\Notifications\EmailVerificationNotification;
use App\Notifications\ResetPasswordVerificationNotification;
use Ichtrojan\Otp\Otp;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Services\UserPrivacySettingService;
use App\Jobs\SendLoginNotificationJob;

use App\Treits\HttpResponses;

class AuthService extends UserPrivacySettingService
{

    use HttpResponses;
    /**
     * Create a new class instance.
     */


    public function Login($request)
    {

        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->Error('', 'Credentials does not match', 401);
        }
        $user = User::where('email', $request->email)->first();
        // dd($user);
        $ip = request()->ip();
// $start = microtime(true);
        SendLoginNotificationJob::dispatch($user);

        // $end = microtime(true);
// $duration = $end - $start;

// logger("Login request (with queue) took: {$duration} seconds");
        return $this->Success([
            'user' => $user,
            'token' => $user->createToken('Api Tocken of ' . $user->name)->plainTextToken
        ]);
    }
    public function Register($request)
    {

        $user = User::create($request->validated());
        $user->notify(new EmailVerificationNotification());
        return $this->Success([
            'user' => $user,
            'token' => $user->createToken('Api Tocken of ' . $user->name)->plainTextToken
        ]);
    }
    public function ResendEmailVerification($request)
    {
        $user = $request->user();
        if ($user->email_verified_at) {
            return $this->Error('', 'Email already verified', 401);
        }
        $user->notify(new EmailVerificationNotification());
        return $this->Success('', 'Email verification OTP sent successfully');
    }
    public function EmailVerification(EmailVerificationRequest $request)
    {
        $otp = new Otp();
        $otp = $otp->validate($request->email, $request->otp);
        if (!$otp->status) {
            return $this->Error('', 'Invalid OTP', 401);
        }
        $user = User::where('email', $request->email)->first();
        $user->email_verified_at = now();
        $user->save();
        $this->InitializePrivacySetting();
        return $this->Success('', 'Email verified successfully, you can now use your account');
    }
    public function ForgetPassword($request)
    {

        $user = User::where('email', $request->email)->first();
        $user->notify(new ResetPasswordVerificationNotification());
        return $this->Success('', 'Reset password OTP sent successfully');
    }
    public function ResetPassword($request)
    {
        $otp = new Otp();
        $otp = $otp->validate($request->email, $request->otp);
        if (!$otp->status) {
            return $this->Error('', 'Invalid OTP', 401);
        }
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        $user->tokens()->delete();
        return $this->Success('', 'Password reset successfully');
    }
    public function Logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return $this->Success([
            'message' => 'Logged out successfully'
        ]);
    }
}
