<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customs\Services\EmailVerificationService;
use App\Customs\Services\ResetPasswordService;
use Validator;
use Exception;
use Hash;

class ResetPasswordController extends Controller
{
    function sendResetCode(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "email" => 'required|email',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }


            $user = User::where('email', $request->email)->first();
            if ($user) {
                $service = new ResetPasswordService;

                $service->sendResetCode($user);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Password Reset Code sent successfully'
                ], 200)->header('Access-Control-Allow-Origin', '*');
            } else {
                response()->json([
                    'status' => 'failed',
                    'message' => 'User Not Found'
                ], 400)->header('Access-Control-Allow-Origin', '*')->send();
                exit();
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'Exceptions' => $e
            ], 400);
        }
    }






    public function resendResetCode(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email:filter'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }
            $service = new ResetPasswordService;

            return $service->resendresetCode($request->email);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'Exceptions' => $e
            ], 400);
        }
    }






    public function verifyResetCode(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email:filter',
                'code' => 'required|max:10'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }
            $service = new ResetPasswordService;

            return $service->verifyResetCode($request->email, $request->code);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'Exceptions' => $e
            ], 400);
        }
    }




    function resetPassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email:filter|max:255',
                'code' => 'required|max:255',
                'new_password' => 'string|required|min:6|confirmed'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }
            $service = new ResetPasswordService;
            return $service->resetPassowrd($request->email, $request->code, $request->new_password);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'Exceptions' => $e
            ], 400);
        }
    }

}
