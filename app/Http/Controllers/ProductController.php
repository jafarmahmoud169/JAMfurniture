<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Validator;
use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = product::paginate(10);
        if ($products) {
            return response()->json([
                'status' => 'success',
                'products' => $products
            ], 200);
        } else
            return response()->json([
                'status' => 'success',
                'products' => 'No products'
            ], 200);
    }

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
                'discount' => 'numeric',
                'image' => 'required|image',
                'category_id' => 'required|numeric'
            ]);
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
            $product->save();


            return response()->json([
                'status' => 'success',
                'message' => 'Product added'
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
     * Display the specified resource.
     */
    public function show(product $product, $id)
    {
        $product = product::find($id);
        if ($product) {
            return response()->json([
                'status' => 'success',
                'product' => $product
            ], 200);
        } else
            return response()->json([
                'status' => 'failed',
                'message' => 'Product not found'
            ], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'details' => 'required|string',
                'price' => 'required|numeric',
                'amount' => 'required|numeric',
                'discount' => 'required|numeric',
                'image' => 'required|string',
                'category_id' => 'required|numeric'
            ]);

            $image = $request->file('image');
            $image_name = time() . "." . $image->getClientOriginalName();
            $image->move('images/products', $image_name);

            $product = product::find($id);
            $product->name = $request->name;
            $product->details = $request->details;
            $product->price = $request->price;
            $product->amount = $request->amount;
            $product->discount = $request->discount;
            $product->image = "/iamges/product/" . $image_name;
            $product->category_id = $request->category_id;
            $product->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Product updated'
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
            ], 200);
    }
    public function search($key)
    {
        $products = product::whereNotNull('name')
            ->where('name', 'LIKE', "%$key%")
            ->orderByDesc('id')
            ->get();

        if ($products->isNotEmpty()) {
            return response()->json([
                'status' => 'success',
                'products' => $products
            ], 200);
        } else
            return response()->json([
                'status' => 'success',
                'message' => 'No results'
            ], 200);
    }
    public function trendy_products()
    {
        $products = product::where('is_trendy', 1)->paginate(10);

        if ($products->isNotEmpty()) {
            return response()->json([
                'status' => 'success',
                'products' => $products
            ], 200);
        } else
            return response()->json([
                'status' => 'success',
                'products' => 'No trendy products'
            ], 200);
    }



    public function check_availability(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_id' => 'required',
                'quantity' => 'required'
            ]);
            $product = product::find($request->product_id);


            if ($product) {
                if ($product->amount >= $request->quantity) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'The quantity is availabil'
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'The quantity is not availabil'
                    ], 200);
                }

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
