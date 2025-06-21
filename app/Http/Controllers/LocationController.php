<?php

namespace App\Http\Controllers;

use App\Models\location;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Exception;

class LocationController extends Controller
{
    public function get_user_locations()
    {
        $user_id = auth()->id();

        $locations = Location::where('user_id', $user_id)->get();

        if ($locations->isNotEmpty()) {
            return response()->json([
                'status' => 'success',
                'locations' => $locations
            ], 200);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => "User have no locations"
            ], 200);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'city' => 'required',
                'street' => 'required',
                'building' => 'required',
                'more_details'=> 'required',
                'zip_code'=> 'required',
                'apartment_number'=> 'required'
            ]);
            location::create([
                'city' => $request->city,
                'street' => $request->street,
                'building' => $request->building,
                'user_id' => Auth::id(),
                'more_details'=> $request->more_details,
                'zip_code'=> $request->zip_code,
                'apartment_number'=> $request->apartment_number
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Location added'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'validator errors' => $validator->errors(),
                'Exceptions' => $e
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'city' => 'required',
                'street' => 'required',
                'building' => 'required',
                'more_details'=> 'required',
                'zip_code'=> 'required',
                'apartment_number'=> 'required'
            ]);

            $location = Location::find($id);

            if ($location) {
                if ($location->user_id != Auth::id()) {
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'You do not have permission to edit this location'
                    ], 200);
                } else {

                    $location->city = $request->city;
                    $location->street = $request->street;
                    $location->building = $request->building;
                    $location->more_details = $request->more_details;
                    $location->zip_code = $request->zip_code;
                    $location->apartment_number = $request->apartment_number;
                    $location->save();

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Location updated'
                    ], 200);
                }
            } else
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Location not found'
                ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'validator errors' => $validator->errors(),
                'Exceptions' => $e
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $location = Location::find($id);

        if ($location) {
            if ($location->user_id != Auth::id()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'You do not have permission to delete this location'
                ], 200);
            } else {
                $location->delete();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Location deleted'
                ], 200);
            }
        } else
            return response()->json([
                'status' => 'failed',
                'message' => 'Location not found'
            ], 200);
    }
}
