<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use Exception;
use Illuminate\Http\Request;
use Validator;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = category::all();
        return response()->json([
            'status' => 'success',
            'categories' => $categories
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|unique:categories,name',
            ]);



            $category = new category;
            $category->name = $request->name;
            $category->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Category added'
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
    public function show_products($id)
    {
        $category = category::find($id);
        $products = product::where('category_id', $id)->paginate(10);

        if ($category) {
            if ($products->isNotEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'category' => $category,
                    'products' => $products
                ], 200);
            } else {
                return response()->json([
                    'status' => 'success',
                    'category' => $category,
                    'products' => 'Category contains no products'
                ], 200);
            }
        } else
            return response()->json([
                'status' => 'failed',
                'message' => 'Category not found'
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|unique:categories,name',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 200);
            }

            $category = Category::find($id);

            if ($category) {
                $category->name = $request->name;
                $category->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Category updated'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Category not found'
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong',
                'exception' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = category::find($id);
        if ($category) {
            $category->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Category deleted'
            ], 200);
        } else
            return response()->json([
                'status' => 'failed',
                'message' => 'Category not found'
            ], 200);
    }
}
