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
        return response()->json(['categories'=>$categories], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|unique:categories,name',
                'image' => 'required'
            ]);

            $image = $request->image;
            $image_name = time() . "." . $image->getClientOriginalName();
            $image->move('images/categories', $image_name);

            $category = new category;
            $category->name = $request->name;
            $category->image = '/images/categories/' . $image_name;
            $category->save();
            return response()->json([
                'status' => 'success',
                'message' => 'category added'
            ], 201);

        } catch (Exception $e) {
            $data = [$e, $validator->errors()];

            return response()->json($data, 500);
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
                return response()->json(['category'=>$category,'products'=> $products], 200);
            } else {
                return response()->json(['category'=>$category,'products'=> 'category contains no products'], 200);
            }
        } else
            return response()->json([
                'status' => 'failed',
                'message' => 'category not found'
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
                'image' => 'required|image'
            ]);

            $category = category::where('id', $id)->update(['name' => $request->name]);

            $image = $request->file('image');
            $image_name = time() . "." . $image->getClientOriginalName();
            $image->move('images/categories', $image_name);
            $category = category::where('id', $id)->update(['image' => '/images/categories/' . $image_name]);

            return response()->json([
                'status' => 'success',
                'message' => 'category updated'
            ], 200);

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
        $category = category::find($id);
        if ($category) {
            $category->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'category deleted'
            ], 200);
        } else
            return response()->json([
                'status' => 'failed',
                'message' => 'category not found'
            ], 200);
    }
}
