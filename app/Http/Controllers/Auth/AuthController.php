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

class AuthController extends Controller
{

    function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "email" => 'required|email:filter',
                "password" => "string|required|min:6"
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $token = auth()->attempt($request->all());
            if ($token) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Login successfully',
                    'user' => auth()->user(),
                    'access_token' => $token
                ], 200);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Invalid email or password'
                ], 401);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'Exceptions' => $e
            ], 400);
        }

    }
    public function logout()
    {
        auth()->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'User successfully signed out'
        ], 200);
    }


    function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "email" => 'required|unique:users,email',
                'first_name' => 'required|string|min:2',
                'last_name' => 'required|string|min:2',
                "password" => "string|required|min:6|confirmed",
                'wants_notifications'=>'required'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = new User;
            $user->email = $request->email;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->password = Hash::make($request['password']);
            $user->phone_number = NULL;
            $user->wants_notifications=$request->wants_notifications;
            $user->save();



            if ($user) {
                $service = new EmailVerificationService;
                $service->sendVerificationCode($user);
                return response()->json([
                    'status' => 'success',
                    'message'=>'user registered successfully',
                    'user' => $user,
                    'access_token' => auth()->login($user)
                ], 200);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'An error occure while trying to create user'
                ], 400);
            }

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'Exceptions' => $e
            ], 400);
        }
    }
    function verifyUserEmail(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email:filter|max:255',
                'code' => 'required|max:25'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }
            $service = new EmailVerificationService;
            return $service->verifyEmail($request->email, $request->code);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'Exceptions' => $e
            ], 400);
        }
    }
    public function resendVerificationEmailCode(Request $request)
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
            $service = new EmailVerificationService;

            return $service->resendCode($request->email);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'Exceptions' => $e
            ], 400);
        }
    }

}
