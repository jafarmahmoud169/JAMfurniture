<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItems;
use App\Models\product;
use App\Models\location;
use Illuminate\Http\Request;
use Auth;
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
                foreach ($order->items as $order_items) {
                    $product = product::where('id', $order_items->product_id)->pluck('name');
                    $order_items->product_name = $product['0'];
                }
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
        if ($order) {
            return response()->json($order, 200);
        } else
            return response()->json('order not found');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $location = Location::where('user_id', Auth::id())->first();
            $validator = $request->validate([
                'order_items' => 'required',
                'date_of_delivery' => 'required|string',
                'total_price' => 'required|numeric',
                'quantity' => 'required|numeric',
            ]);


            $order = new Order();
            $order->total_price = $request->total_price;
            $order->date_of_delivery = $request->date_of_delivery;
            $order->user_id = Auth::id();
            $order->location_id = $request->$location->id;
            $order->save();


            foreach ($request->order_items as $order_item) {
                $items = new Orderitems();
                $items->oder_id = $order->id;
                $items->product_id = $order_item['product_id'];
                $items->quantity = $order_item['quantity'];
                $items->price = $order_item['price'];
                $items->save();


                $product = product::where('id', $order_item['product_id'])->first();
                $product->amount -= $order_item['quantity'];
                $product->save();
            }


            return response()->json('order added', 201);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }

    public function get_order_items($id)
    {
        $order_items=OrderItems::where('order_id',$id)->get();
        if ($order_items) {
            foreach ($order_items as $order_item) {
                $product = product::where('id', $order_item->product_id)->pluck('name');
                $order_item->product_name = $product['0'];
            }
            return response()->json($order_items, 200);
        } else
            return response()->json('no items found');
    }

    public function get_user_orders()
    {
        $orders=Order::where('user_id',auth()->id())->with(
            'items',function($query){
                $query->orderBy('created_at','desc');
            })->get();

        if ($orders) {
            foreach ($orders as $order) {
                foreach ($order->items as $order_item) {
                    $product = product::where('id', $order_item->product_id)->pluck('name');
                    $order_item->product_name = $product['0'];
                }            }
            return response()->json($orders, 200);
        } else
            return response()->json('no order found for this user');
    }


    public function change_order_status(Request $request,$id){
        $order=Order::find($id);
        if ($order) {
            $order->update(['status'=>$request->status]);
            return response()->json('status changed successfully', 200);
        } else {
            return response()->json('order not found');
        }

    }
}
