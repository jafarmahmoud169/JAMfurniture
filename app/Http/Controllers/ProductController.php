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
            return response()->json($products, 200);
        } else
            return response()->json('no products');
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


            return response()->json('product added', 201);
        } catch (Exception $e) {
            $data = [$e, $validator->errors()];
            return response()->json($data, 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(product $product, $id)
    {
        $product = product::find($id);
        if ($product) {
            return response()->json($product, 200);
        } else
            return response()->json('product not found');
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
            $image->move('/images/products', $image_name);

            $product = product::find($id);
            $product->name = $request->name;
            $product->details = $request->details;
            $product->price = $request->price;
            $product->amount = $request->amount;
            $product->discount = $request->discount;
            $product->image = "/iamges/product/" . $image_name;
            $product->category_id = $request->category_id;
            $product->save();

            return response()->json('product updated', 200);
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
        $product = product::find($id);
        if ($product) {
            $product->delete();
            return response()->json('product deleted', 200);
        } else
            return response()->json('product not found');
    }
    public function search($key)
    {
        $products = product::whereNotNull('name')
            ->where('name', 'LIKE', "%$key%")
            ->orderByDesc('id')
            ->get();

        if ($products) {
            return response()->json($products, 200);
        } else
            return response()->json('no products');
    }
    public function trendy_products()
    {
        $products = product::where('is_trendy', 1)->paginate(10);

        if ($products) {
            return response()->json([$products], 200);
        } else
            return response()->json('no trendy products');
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
                    return response()->json(['message'=>'the quantity is availabil'], 200);
                } else {
                    return response()->json(['message'=>'the quantity is not availabil'], 200);
                }

            } else
                return response()->json('product not found');


        } catch (Exception $e) {
            $data = [$e, $validator->errors()];
            return response()->json($data, 500);
        }
    }
}
