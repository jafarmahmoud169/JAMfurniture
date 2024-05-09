<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResendVerificationEmailCodeRequest;
use App\Http\Requests\VerifyEmailRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Http\Request;
use App\Customs\Services\EmailVerificationService;
use Validator;
use Exception;

class AuthController extends Controller
{
    public function __construct(private EmailVerificationService $Service)
    {
    }

    function login(LoginRequest $request)
    {
        $token = auth()->attempt($request->validated());
        if ($token) {
            return $this->responseWithToken($token, auth()->user());
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'invalid credential'
            ], 401);
        }
        // return dd($request);


    }
    function register(RegistrationRequest $request)
    {
        try {
            $user = User::create(
                array_merge(
                    $request->validated(),
                    ['password' => bcrypt($request->password)]
                )
            );
            if ($user) {
                $this->Service->sendVerificationCode($user);
                return $this->responseWithToken(auth()->login($user), $user);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'an error occure while trying to create user'
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
    function responseWithToken($token, $user)
    {
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'access_token' => $token,
            'type' => 'bearer'
        ]);
    }
    function verifyUserEmail(VerifyEmailRequest $request)
    {
        return $this->Service->verifyEmail($request->email, $request->code);
    }
    public function resendVerificationEmailCode(ResendVerificationEmailCodeRequest $request)
    {
        return $this->Service->resendCode($request->email);
    }
    public function userProfile()
    {
        return response()->json(auth()->user());
    }
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
}
