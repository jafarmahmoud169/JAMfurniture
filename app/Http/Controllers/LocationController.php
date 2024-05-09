<?php

namespace App\Http\Controllers;

use App\Models\location;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Exception;
class LocationController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator=Validator::make($request->all(), [
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
            return response()->json('Location added', 201);

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
        $validator=Validator::make($request->all(), [
            'city' => 'required',
            'street' => 'required',
            'building' => 'required',
        ]);

        $location = Location::find($id);

        if ($location) {

            $location->city = $request->city;
            $location->street = $request->street;
            $location->building = $request->building;
            $location->save();

            return response()->json('location updated', 200);
        } else
            return response()->json('location not found');
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
        if ($location) {
            $location->delete();
            return response()->json('location deleted', 200);
        } else
            return response()->json('location not found');

    }
}
