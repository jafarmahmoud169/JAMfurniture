<?php
namespace App\Customs\Services;

use App\Models\EmailVerificationCode;
use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use Hash;

class ResetPasswordService
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





    public function resetPassowrd($email, $code ,$new_password)
    {
        $user = User::where('email', $email)->first();
        if (!$user) {
            response()->json([
                'status' => 'failed',
                'message' => 'User Not Found'
            ], 200)->header('Access-Control-Allow-Origin', '*')->send();
            exit();
        }


        $verifiedCode = $this->verifyCode($email, $code);

        $updatePassword=$user->update(['password'=> Hash::make($new_password)]);

        if ($updatePassword) {
            $verifiedCode->delete();
            response()->json([
                'status' => 'success',
                'message' => 'Password has been Reset successfully'
            ], 200)->header('Access-Control-Allow-Origin', '*')->send();
            exit();
        } else {
            response()->json([
                'status' => 'failed',
                'message' => 'Password Reset failed , please try again later'
            ], 200)->header('Access-Control-Allow-Origin', '*')->send();
            exit();
        }
    }



    public function generateResetCode(string $email)
    {
        $checkCodeExist = EmailVerificationCode::where('email', $email)->first();
        if ($checkCodeExist)
            $checkCodeExist->delete();


        $ResetCode = rand(100000,999999);


        $saveCode = EmailVerificationCode::create([
            'email' => $email,
            'code' => $ResetCode,
            'expired_at' => now()->addMinutes(10)
        ]);
        if ($saveCode) {
            return $ResetCode;
        }
    }


    public function resendResetCode($email)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            $this->sendResetCode($user);
            return response()->json([
                'status' => 'success',
                'message' => 'Password Reset Code resent successfully'
            ],200)->header('Access-Control-Allow-Origin', '*');
        } else {
            response()->json([
                'status' => 'failed',
                'message' => 'User Not Found'
            ],200)->header('Access-Control-Allow-Origin', '*')->send();
            exit();
        }
    }




    function sendResetCode(object $user)
    {
        Notification::send($user, new ResetPasswordNotification($this->generateResetCode($user->email)));
    }
}
