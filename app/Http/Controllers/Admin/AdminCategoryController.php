<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\category;
use App\Models\product;
use Exception;
use Illuminate\Http\Request;
use Validator;

class AdminCategoryController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
                ], 422);
            }


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
                'Exceptions' => $e
            ], 400);
        }
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
                ], 422);
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
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'Exceptions' => $e
            ], 400);
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
            ], 400);
    }
}
