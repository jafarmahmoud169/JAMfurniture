<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\product;
use Exception;
use Validator;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function get_user_cart()
    {
        $user_id = auth()->id();

        $items = CartItem::where('user_id', $user_id)->get();

        if ($items->isNotEmpty()) {
            $total_price = 0;
            foreach ($items as $item) {
                $product = product::find($item->product_id);
                $total_price += $product->price * $item->quantity;
                $item->product = $product;
            }

            return response()->json([
                'status' => 'success',
                'items' => $items,
                'total_price' => $total_price,
            ], 200);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => "There is no items in the cart"
            ], 200);
        }

    }


    public function add_to_cart(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_id' => 'required',
            ]);
            $user_id = auth()->id();
            $product = Product::find($request->product_id);
            if ($product) {
                //check if the ptoduct already in user's cart and delete it
                $check_item_exist = CartItem::where('user_id', $user_id)->where('product_id', $request->product_id)->first();
                if ($check_item_exist)
                    $check_item_exist->delete();


                $cart_item = new CartItem();
                $cart_item->user_id = $user_id;
                $cart_item->product_id = $request->product_id;
                $cart_item->quantity = 1;
                $cart_item->save();

                return response()->json([
                    'status' => 'success',
                    'message' => "Product added to the cart"
                ], 200);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => "Product not found"
                ], 200);
            }


        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'validator errors' => $validator->errors(),
                'Exceptions' => $e
            ], 200);
        }
    }


    public function remove_from_cart(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_id' => 'required',
            ]);
            $user_id = auth()->id();
            $product = Product::find($request->product_id);
            if ($product) {
                $item = CartItem::where('user_id', $user_id)->where('product_id', $request->product_id)->first();
                if ($item) {
                    $item->delete();
                    return response()->json([
                        'status' => 'success',
                        'message' => "Product removed from the cart"
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 'failed',
                        'message' => "Product is not in the cart"
                    ], 200);
                }
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => "Product not found"
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'validator errors' => $validator->errors(),
                'Exceptions' => $e
            ], 200);
        }
    }


    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_id' => 'required',
                'quantity' => 'required'
            ]);
            $user_id = auth()->id();
            $product = Product::find($request->product_id);
            if ($product) {
                $item = CartItem::where('user_id', $user_id)->where('product_id', $request->product_id)->first();
                if ($item) {
                    $item->quantity = $request->quantity;
                    $item->save();
                    return response()->json([
                        'status' => 'success',
                        'message' => "Quantity updated"
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 'failed',
                        'message' => "Product is not in the cart"
                    ], 200);
                }
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => "Product not found"
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'validator errors' => $validator->errors(),
                'Exceptions' => $e
            ], 200);
        }
    }
}
