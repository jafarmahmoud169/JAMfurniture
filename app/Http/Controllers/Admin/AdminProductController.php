<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;
use Validator;
use Exception;
use App\Http\Controllers\Controller;
use App\Jobs\SendDiscountNotification;

class AdminProductController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'details' => 'required|string',
                'price' => 'required|numeric',
                'amount' => 'required|numeric',
                'discount' => 'required|numeric',
                'image' => 'required|image',
                'category_id' => 'sometimes|numeric|exists:categories,id',
                'dimensions' => 'required',
                'colors' => 'required',
                'material' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $image = $request->file('image');
            $image_name = time() . "." . $image->getClientOriginalName();
            $image->move('images/products', $image_name);


            $product = new product();
            $product->name = $request->name;
            $product->details = $request->details;
            $product->image = "/images/products/" . $image_name;
            $product->price = $request->price;
            $product->amount = $request->amount;
            $product->discount = $request->discount;
            $product->category_id = $request->category_id;
            $product->dimensions = $request->dimensions;
            $product->colors = $request->colors;
            $product->material = $request->material;


            $product->save();


            return response()->json([
                'status' => 'success',
                'message' => 'Product added'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'Exceptions' => $e
            ], 400);
        }

    }

    // public function update(Request $request, $id)
    // {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'name' => 'required|string',
    //             'details' => 'required|string',
    //             'price' => 'required|numeric',
    //             'amount' => 'required|numeric',
    //             'discount' => 'required|numeric',
    //             'image' => 'required|string',
    //             'category_id' => 'required|numeric',
    //             'is_trendy' => 'required',
    //             'dimensions'=>'required',
    //             'colors'=>'required',
    //             'material'=>'required'
    //         ]);

    //         if (!Category::find($request->category_id))
    //             return response()->json([
    //                 'status' => 'failed',
    //                 'message' => 'Category not found'
    //             ], 200);

    //         $image = $request->file('image');
    //         $image_name = time() . "." . $image->getClientOriginalName();
    //         $image->move('images/products', $image_name);

    //         $product = product::find($id);
    //         if($product){
    //         $product->name = $request->name;
    //         $product->details = $request->details;
    //         $product->price = $request->price;
    //         $product->is_trendy = $request->is_trendy;
    //         $product->amount = $request->amount;
    //         $product->discount = $request->discount;
    //         $product->image = "/iamges/product/" . $image_name;
    //         $product->category_id = $request->category_id;
    //         $product->dimensions = $request->dimensions;
    //         $product->colors = $request->colors;
    //         $product->material = $request->material;
    //         $product->save();

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Product updated'
    //         ], 200);
    //     }else{
    //         return response()->json([
    //             'status' => 'failed',
    //             'message' => 'Product not found'
    //         ], 200);
    //     }
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'status' => 'failed',
    //                 //             'Exceptions' => $e
    //         ], 200);
    //     }
    // }
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|string',
                'details' => 'sometimes|string',
                'price' => 'sometimes|numeric',
                'amount' => 'sometimes|numeric',
                'discount' => 'sometimes|numeric',
                'image' => 'sometimes|image',
                'category_id' => 'sometimes|numeric|exists:categories,id',
                'is_trendy' => 'sometimes|boolean',
                'dimensions' => 'sometimes|string',
                'colors' => 'sometimes|string',
                'material' => 'sometimes|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $product = Product::find($id);
            if (!$product) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Product not found'
                ], 400);
            }

            // Handle image upload if present
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = time() . "_" . $image->getClientOriginalName();
                $image->move(public_path('images/products'), $image_name);
                $product->image = "/images/products/" . $image_name;
            }

            // Update other fields
            $product->fill($request->only([
                'name',
                'details',
                'price',
                'amount',
                'discount',
                'category_id',
                'is_trendy',
                'dimensions',
                'colors',
                'material'
            ]));

            $product->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Product updated successfully',
                'product' => $product
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Unexpected error',
                'exception' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = product::find($id);
        if ($product) {
            $product->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted'
            ], 200);
        } else
            return response()->json([
                'status' => 'failed',
                'message' => 'Product not found'
            ], 400);
    }




    public function applyDiscount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'discount' => 'required|numeric|min:0',
            'product_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }
        $product = Product::find($request->product_id);
        if (!$product) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Product not found'
            ], 400);
        }
        $product->discount = $request->discount;
        $product->save();

        // Trigger queued job
        if ($request->discount !=0) {
        SendDiscountNotification::dispatch($product);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Discount updated and notifications dispatched',
        ], 200);
    }
}
