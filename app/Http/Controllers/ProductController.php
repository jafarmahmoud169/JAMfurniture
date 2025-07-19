<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
                'message' => '10 products',
                'products' => $products
            ], 200);
        } else
            return response()->json([
                'status' => 'success',
                'message' => 'No products',
                'products'=>null
            ], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(product $product, $id)
    {
        $product = product::with('ratings')->find($id);
        if ($product) {
            return response()->json([
                'status' => 'success',
                'message'=>'Product information',
                'product' => $product,
                'rating' =>json_decode( $product->averageRating())
            ], 200);
        } else
            return response()->json([
                'status' => 'failed',
                'message' => 'Product not found'
            ], 400);
    }


    public function search($key)
    {
        $products = product::whereNotNull('name')
            ->where('name', 'LIKE', "%$key%")
            ->orderByDesc('id')
            ->paginate(10);

        if ($products->isNotEmpty()) {
            return response()->json([
                'status' => 'success',
                'message'=>'Results for'.$key,
                'products' => $products
            ], 200);
        } else
            return response()->json([
                'status' => 'success',
                'message' => 'No results',
                'products'=>null
            ], 200);
    }
    public function trendy_products()
    {
        $products = product::where('is_trendy', 1)->paginate(10);

        if ($products->isNotEmpty()) {
            return response()->json([
                'status' => 'success',
                'message'=>'10 Trendy products',
                'products' => $products
            ], 200);
        } else
            return response()->json([
                'status' => 'success',
                'message' => 'No trendy products',
                'products' => null
            ], 200);
    }




    public function offers_products()
    {
        $products = product::where('discount','>',0)->paginate(10);

        if ($products->isNotEmpty()) {
            return response()->json([
                'status' => 'success',
                'message'=>'10 offers',
                'products' => $products
            ], 200);
        } else
            return response()->json([
                'status' => 'success',
                'message' => 'there is no offers right now',
                'products' => null
            ], 200);
    }
}
