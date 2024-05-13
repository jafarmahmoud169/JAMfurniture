<?php
namespace App\Customs\Services;

use App\Models\EmailVerificationCode;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;

class EmailVerificationService
{
    public function verifyCode($email, $Code)
    {
        $Code = EmailVerificationCode::where('email', $email)->where('code', $Code)->first();
        if ($Code) {
            if ($Code->expired_at >= now()) {
                return $Code;
            } else {
                $Code->delete();
                response()->json([
                    'status' => 'failed',
                    'message' => 'Code Expired'
                ], 200)->header('Access-Control-Allow-Origin', '*')->send();
                exit();
            }
        } else {
            response()->json([
                'status' => 'failed',
                'message' => 'Invalid Code'
            ], 200)->header('Access-Control-Allow-Origin', '*')->send();
            exit();
        }
    }


    public function checkIfEmailIsVerified($user)
    {
        if ($user->email_verified_at) {
            response()->json([
                'status' => 'failed',
                'message' => 'Email has already been verified'
            ], 200)->header('Access-Control-Allow-Origin', '*')->send();
            exit();
        }
    }


    public function verifyEmail($email, $Code)
    {
        $user = User::where('email', $email)->first();
        if (!$user) {
            response()->json([
                'status' => 'failed',
                'message' => 'User Not Found'
            ], 200)->header('Access-Control-Allow-Origin', '*')->send();
            exit();
        }
        $this->checkIfEmailIsVerified($user);
        $verifiedCode = $this->verifyCode($email, $Code);
        if ($user->markEmailAsVerified()) {
            $verifiedCode->delete();
            response()->json([
                'status' => 'success',
                'message' => 'Email has been verified successfully'
            ], 200)->header('Access-Control-Allow-Origin', '*')->send();
            exit();
        } else {
            response()->json([
                'status' => 'failed',
                'message' => 'Email verification failed ,please try again later'
            ], 200)->header('Access-Control-Allow-Origin', '*')->send();
            exit();
        }
    }
//    ->header('Access-Control-Allow-Origin', '*')



    public function generateVerificationCode(string $email)
    {
        $checkCodeExist = EmailVerificationCode::where('email', $email)->first();
        if ($checkCodeExist)
            $checkCodeExist->delete();


        $verificationCode = 111111;


        $saveCode = EmailVerificationCode::create([
            'email' => $email,
            'code' => $verificationCode,
            'expired_at' => now()->addMinutes(60)
        ]);
        if ($saveCode) {
            return $verificationCode;
        }
    }


    public function resendCode($email)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            $this->sendVerificationCode($user);
            return response()->json([
                'status' => 'success',
                'message' => 'verification link resent successfully'
            ],200)->header('Access-Control-Allow-Origin', '*');
        } else {
            response()->json([
                'status' => 'failed',
                'message' => 'User Not Found'
            ],200)->header('Access-Control-Allow-Origin', '*')->send();
            exit();
        }
    }




    function sendVerificationCode(object $user)
    {
        Notification::send($user, new EmailVerificationNotification($this->generateVerificationCode($user->email)));
    }
}
