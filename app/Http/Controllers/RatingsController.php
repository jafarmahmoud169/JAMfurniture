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
    // public function store(Request $request)
    // {
    //     try {

    //         $validator = Validator::make($request->all(), [
    //             'product_id' => 'required',
    //             'rating' => 'min:1|max:5|required|integer'
    //         ]);
    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'status' => 'failed',
    //                 'message' => 'Validation error',
    //                 'errors' => $validator->errors()
    //             ], 422);
    //         }
    //         $product = product::find($request->product_id);
    //         if ($product) {
    //             Ratings::create([
    //                 'user_id' => auth()->id(),
    //                 'product_id' => $request->product_id,
    //                 'rating' => $request->rating
    //             ]);

    //             $product->updateTrendStatus();


    //             return response()->json([
    //                 'status' => 'success',
    //                 'message' => 'rating added'
    //             ], 201);
    //         } else
    //             return response()->json([
    //                 'status' => 'failed',
    //                 'message' => 'Product not found'
    //             ], 400);

    //     } catch (Exception $e) {
    //         return response()->json([
    //             'status' => 'failed',
    //             'Exceptions' => $e
    //         ], 400);
    //     }
    // }
public function store(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'rating' => 'min:1|max:5|required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $product = product::find($request->product_id);
        if ($product) {
            Ratings::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'product_id' => $request->product_id,
                ],
                [
                    'rating' => $request->rating,
                ]
            );

            $product->updateTrendStatus();

            return response()->json([
                'status' => 'success',
                'message' => 'rating updated or added'
            ], 201);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Product not found'
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
