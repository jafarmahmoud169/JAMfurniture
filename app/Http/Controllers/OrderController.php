<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItems;
use App\Models\CartItem;
use App\Models\product;
use App\Models\location;
use Illuminate\Http\Request;
use validator;
use Exception;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = order::paginate(10);
        if ($orders) {
            foreach ($orders as $order) {
                $order->payment_process=$order->payment;
            }
            return response()->json($orders, 200);
        } else
            return response()->json('no orders');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = order::find($id);
        $items=$order->items();
        if ($order) {
            return response()->json([$order,$items], 200);
        } else
            return response()->json('order not found');
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
                return response()->json(['status' => 'failed', 'message' => 'no items found']);
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
            return response()->json('order added', 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'failed',
                'validator errors' => $validator->errors(),
                'Exceptions' => $e
            ]);
        }
    }

    public function get_user_orders()
    {
        $orders = Order::where('user_id', auth()->id())->get();

        if ($orders) {
            return response()->json($orders, 200);
        } else
            return response()->json('no order found for this user');
    }


    public function change_order_status(Request $request, $id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->update(['status' => $request->status]);
            return response()->json('status changed successfully', 200);
        } else {
            return response()->json('order not found');
        }

    }
}
