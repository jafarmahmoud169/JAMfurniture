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

class ProfileController extends Controller
{
    public function userProfile()
    {
        return response()->json(auth()->user());
    }




    public function profileUpdate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|min:2',
                'last_name' => 'required|string|min:2',
                'phone_number' => 'required|string|min:7'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }
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
                ], 400);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'Exceptions' => $e
            ], 400);
        }
    }




    public function change_password(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:6|confirmed'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = auth()->user();
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Current password is incorrect'
                ], 400);
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
            ], 400);
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
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'Exceptions' => $e
            ], 400);
        }
    }

}
