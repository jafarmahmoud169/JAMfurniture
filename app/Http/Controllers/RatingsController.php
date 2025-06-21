<?php

namespace App\Http\Controllers;

use App\Models\Ratings;
use App\Models\product;

use Illuminate\Http\Request;
use Validator;
use Exception;
class RatingsController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'product_id' => 'required',
                'rating' => 'min:1|max:5|required|integer'
            ]);
            throw_if($validator->fails());
                $product = product::find($request->product_id);
                if ($product) {
                    Ratings::create([
                        'user_id' => auth()->id(),
                        'product_id' => $request->product_id,
                        'rating' => $request->rating
                    ]);

                    $product->updateTrendStatus();


                    return response()->json([
                        'status' => 'success',
                        'message' => 'rating added'
                    ], 201);
                } else
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Product not found'
                    ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'validator errors' => $validator->errors(),
                'Exceptions' => $e
            ], 200);
        }
    }

}
