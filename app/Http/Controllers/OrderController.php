<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItems;
use App\Models\CartItem;
use App\Models\product;
use App\Models\location;
use Illuminate\Http\Request;
use Validator;
use Exception;
use Auth;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = order::simplePaginate(10);
        if ($orders) {
            foreach ($orders as $order) {
                $order->payment;
            }
            return response()->json([
                'status' => 'success',
                'orders' => $orders
            ], 200);
        } else
            return response()->json([
                'status' => 'success',
                'orders' => 'No orders'
            ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = order::find($id);


        if ($order) {
            $order->payment;
            $order->location;
            foreach ($order->items as $item) {
                $item->product;
            }
            return response()->json([
                'status' => 'success',
                'order' => $order,
                //'items' => $items
            ], 200);
        } else
            return response()->json([
                'status' => 'failed',
                'message' => 'Order not found'
            ], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'date_of_delivery' => 'required|string',
                'location_id' => 'required',
            ]);

            //getting order items from user's cart items
            $user_id = auth()->id();
            $items = CartItem::where('user_id', $user_id)->get();

            if ($items->isEmpty()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'No items found in the cart'
                ], 200);
            } else {
                $total_price = 0;
                foreach ($items as $cart_item) {
                    $total_price += ($cart_item->product->price) * ($cart_item->quantity);
                }
                //saving order info in orders table
                $order = new Order();
                $order->total_price = $total_price;
                $order->date_of_delivery = $request->date_of_delivery;
                $order->user_id = $user_id;
                $order->location_id = $request->location_id;
                $order->save();

                //saving order items in its table
                foreach ($items as $order_item) {
                    $item = new Orderitems();
                    $item->order_id = $order->id;
                    $item->product_id = $order_item->product_id;
                    $item->quantity = $order_item->quantity;
                    $item->price = $order_item->product->price;
                    $item->save();

                    //changing product ammount
                    $product = product::where('id', $order_item->product_id)->first();
                    $product->amount -= $order_item->quantity;
                    $product->save();

                    //delete the item from the cart after order it
                    $order_item->delete();
                }

            }
            return response()->json([
                'status' => 'success',
                'message' => 'Order added'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'validator errors' => $validator->errors(),
                'Exceptions' => $e
            ], 200);
        }

    }

    public function get_user_orders()
    {
        $orders = Order::where('user_id', auth()->id())->get();

        if ($orders->isNotEmpty()) {
            foreach ($orders as $order) {
                $order->payment;
                $order->location;
            }
            return response()->json([
                'status' => 'success',
                'orders' => $orders
            ], 200);
        } else
            return response()->json([
                'status' => 'success',
                'orders' => 'No orders'
            ], 200);
    }


    public function change_order_status(Request $request, $id)
    {
        try {
            $order = Order::find($id);
            if ($order) {
                $order->update(['status' => $request->status]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Status changed successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Order not found'
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'Exceptions' => $e
            ], 200);
        }
    }
    public function destroy($id)
    {
        $order = order::find($id);

        if ($order) {
            if ($order->user_id != Auth::id()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'You do not have permission to delete this order'
                ], 200);
            } else {
                $order->delete();
                return response()->json([
                    'status' => 'success',
                    'message' => 'order deleted'
                ], 200);
            }
        } else
            return response()->json([
                'status' => 'failed',
                'message' => 'order not found'
            ], 200);
    }
}
