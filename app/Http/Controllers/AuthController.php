<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customs\Services\EmailVerificationService;
use Validator;
use Exception;
use Hash;

class AuthController extends Controller
{
    public function __construct(private EmailVerificationService $Service)
    {
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
                'status'=>'failed',
                'validator errors'=>$validator->errors(),
                'Exceptions'=>$e
            ],200);
        }

    }
    function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "email" => 'required|email|unique:users,email',
                'name' => 'required|string|min:2',
                "password" => "string|required|min:6|confirmed"
            ]);


            $user =new User;
            $user->email=$request->email;
            $user->name=$request->name;
            $user->password=Hash::make($request['password']);
            $user->save();



            if ($user) {
                $this->Service->sendVerificationCode($user);
                return $this->responseWithToken(auth()->login($user), $user);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'An error occure while trying to create user'
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'status'=>'failed',
                'validator errors'=>$validator->errors(),
                'Exceptions'=>$e
            ],200);
        }
    }
    function responseWithToken($token, $user)
    {
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'access_token' => $token
        ],200);
    }
    function verifyUserEmail(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email:filter|max:255',
                'code' => 'required|max:255'
            ]);
            return $this->Service->verifyEmail($request->email, $request->code);
        } catch (Exception $e) {
            return response()->json([
                'status'=>'failed',
                'validator errors'=>$validator->errors(),
                'Exceptions'=>$e
            ],200);
        }
    }
    public function resendVerificationEmailCode(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email:filter'
            ]);
            return $this->Service->resendCode($request->email);
        } catch (Exception $e) {
            return response()->json([
                'status'=>'failed',
                'validator errors'=>$validator->errors(),
                'Exceptions'=>$e
            ],200);
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
        ],200);
    }
}
