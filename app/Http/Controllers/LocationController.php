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
            return response()->json(['locations'=>$locations], 200);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => "user have no locations"
            ]);
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
            ]);
            location::create([
                'city' => $request->city,
                'street' => $request->street,
                'building' => $request->building,
                'user_id' => Auth::id(),
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Location added'
            ], 201);
        } catch (Exception $e) {
            $data = [$e, $validator->errors()];

            return response()->json($data, 500);
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
            ]);

            $location = Location::find($id);
            if ($location->user_id != Auth::id()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'you dont have permission to edit this location'
                ], 200);
            }
            if ($location) {

                $location->city = $request->city;
                $location->street = $request->street;
                $location->building = $request->building;
                $location->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'location updated'
                ], 200);
            } else
                return response()->json([
                    'status' => 'failed',
                    'message' => 'location not found'
                ], 200);
        } catch (Exception $e) {
            $data = [$e, $validator->errors()];

            return response()->json($data, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $location = Location::find($id);
        if ($location->user_id != Auth::id()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'you dont have permission to delete this location'
            ], 200);
        }
        if ($location) {
            $location->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'location deleted'
            ], 200);
        } else
            return response()->json([
                'status' => 'failed',
                'message' => 'location not found'
            ], 200);
    }
}
