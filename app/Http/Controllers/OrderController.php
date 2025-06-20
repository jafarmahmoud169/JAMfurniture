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
    public function check_availability($product_id, $quantity)
    {
        $product = product::find($product_id);

        if (!$product) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Product not found'
            ], 200);
        }

        if ($product->amount < $quantity) {
            return response()->json([
                'status' => 'failed',
                'message' => 'The quantity of product ' . $product_id . ' is not available',
                'product_id' => $product_id,
                'available_quantity' => $product->amount
            ], 200);
        }

        return null;
    }

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
                'order_items' => 'required',
                'date_of_delivery' => 'required|string',
                'location_id' => 'required',
            ]);

            $user_id = auth()->id();
            //check avilability then calculate total price
            $total_price = 0;
            foreach ($request["order_items"] as $order_item) {

                $response = $this->check_availability($order_item["product_id"], $order_item["quantity"]);
                if ($response) {
                    return $response;
                }

                $final_price = product::find($order_item["product_id"])->final_price();

                $total_price += ($final_price) * ($order_item['quantity']);
            }

            //saving order info in orders table
            $order = new Order();
            $order->total_price = $total_price;
            $order->date_of_delivery = $request->date_of_delivery;
            $order->user_id = $user_id;
            $order->location_id = $request->location_id;
            $order->save();

            //saving order items in its table
            foreach ($request->order_items as $order_item) {
                $item = new Orderitems();
                $item->order_id = $order->id;
                $item->product_id = $order_item["product_id"];
                $item->quantity = $order_item["quantity"];
                $item->price = product::find($order_item["product_id"])->final_price();
                $item->save();

                //changing product ammount
                $product = product::where('id', $order_item["product_id"])->first();
                $product->amount -= $order_item["quantity"];
                $product->save();
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
                $order->items;
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
