<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use Exception;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = category::all();
        return response()->json([
            'status' => 'success',
            'message'=>'all categories',
            'categories' => $categories
        ], 200);
    }



    /**
     * Display the specified resource.
     */
    public function show_products($id)
    {
        $category = category::find($id);
        $products = product::where('category_id', $id)->paginate(10);

        if ($category) {
            if ($products->isNotEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'message' => '10 products of this category',
                    'category' => $category,
                    'products' => $products
                ], 200);
            } else {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Category contains no products',
                    'category' => $category,
                    'products' => null
                ], 200);
            }
        } else
            return response()->json([
                'status' => 'failed',
                'message' => 'Category not found'
            ], 400);
    }

}
