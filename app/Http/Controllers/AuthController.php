<?php

namespace App\Http\Controllers;

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


    public function change_password(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:6|confirmed'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'validator errors' => $validator->errors()
                ], 200);
            }

            $user = auth()->user();
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Current password is incorrect'
                ], 200);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Password changed successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'Exceptions' => $e
            ], 200);
        }
    }

    function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "email" => 'required|email:filter',
                "password" => "string|required|min:6"
            ]);
            $token = auth()->attempt($request->all());
            if ($token) {
                return $this->responseWithToken($token, auth()->user());
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Invalid email or password'
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'validator errors' => $validator->errors(),
                'Exceptions' => $e
            ], 200);
        }

    }
    function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "email" => 'required|email|unique:users,email',
                'first_name' => 'required|string|min:2',
                'last_name' => 'required|string|min:2',
                "password" => "string|required|min:6|confirmed"
            ]);


            $user = new User;
            $user->email = $request->email;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->password = Hash::make($request['password']);
            $user->phone_number = NULL;
            $user->save();



            if ($user) {
                $service = new EmailVerificationService;
                $service->sendVerificationCode($user);
                return $this->responseWithToken(auth()->login($user), $user);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'An error occure while trying to create user'
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'validator errors' => $validator->errors(),
                'Exceptions' => $e
            ], 200);
        }
    }
    function responseWithToken($token, $user)
    {
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'access_token' => $token
        ], 200);
    }
    function verifyUserEmail(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email:filter|max:255',
                'code' => 'required|max:255'
            ]);
            $service = new EmailVerificationService;
            return $service->verifyEmail($request->email, $request->code);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'validator errors' => $validator->errors(),
                'Exceptions' => $e
            ], 200);
        }
    }
    public function resendVerificationEmailCode(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email:filter'
            ]);
            $service = new EmailVerificationService;

            return $service->resendCode($request->email);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'validator errors' => $validator->errors(),
                'Exceptions' => $e
            ], 200);
        }
    }
    public function userProfile()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'User successfully signed out'
        ], 200);
    }
    function sendResetCode(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "email" => 'required|email',
            ]);



            $user = User::where('email', $request->email)->first();
            if ($user) {
                $service = new ResetPasswordService;

                $service->sendResetCode($user);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Password Reset Code resent successfully'
                ], 200)->header('Access-Control-Allow-Origin', '*');
            } else {
                response()->json([
                    'status' => 'failed',
                    'message' => 'User Not Found'
                ], 200)->header('Access-Control-Allow-Origin', '*')->send();
                exit();
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'validator errors' => $validator->errors(),
                'Exceptions' => $e
            ], 200);
        }
    }

    public function resendResetCode(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email:filter'
            ]);
            $service = new ResetPasswordService;

            return $service->resendresetCode($request->email);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'validator errors' => $validator->errors(),
                'Exceptions' => $e
            ], 200);
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
            $service = new ResetPasswordService;
            return $service->resetPassowrd($request->email, $request->code, $request->new_password);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'validator errors' => $validator->errors(),
                'Exceptions' => $e
            ], 200);
        }
    }



    public function profileUpdate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|min:2',
                'last_name' => 'required|string|min:2',
                'phone_number'=>'required|string|min:7'
            ]);

            $user = auth()->user();


            if ($user) {
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->phone_number = $request->phone_number;
                $user->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'user profile updated'
                ], 200);

            } else
                return response()->json([
                    'status' => 'failed',
                    'message' => 'user not found'
                ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'validator errors' => $validator->errors(),
                'Exceptions' => $e
            ], 200);
        }
    }

        public function deleteUser()
    {
        try {
            $user = auth()->user();

            if ($user) {
                $user->delete();
                auth()->logout();

                return response()->json([
                    'status' => 'success',
                    'message' => 'User deleted successfully and logged out'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'User not found'
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'Exceptions' => $e
            ], 200);
        }
    }

}
