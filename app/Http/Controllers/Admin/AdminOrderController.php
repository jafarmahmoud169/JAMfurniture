<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatusChangedMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Validator;
use Exception;
use App\Http\Controllers\Controller;

class AdminOrderController extends Controller
{

public function change_order_status(Request $request, $id)
{
    try {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $order = Order::find($id);
        if ($order) {
            $order->update(['status' => $request->status]);

            // Send email notification to user
            Mail::to($order->user->email)->send(
                new OrderStatusChangedMail($order, $request->status)
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Status changed and notification sent successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Order not found'
            ], 400);
        }
    } catch (Exception $e) {
        return response()->json([
            'status' => 'failed',
            'Exceptions' => $e->getMessage()
        ], 400);
    }
}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = order::Paginate(10);
        if ($orders) {
            foreach ($orders as $order) {
                $order->payment;
            }
            return response()->json([
                'status' => 'success',
                'message'=>'last 10 orders',
                'orders' => $orders
            ], 200);
        } else
            return response()->json([
                'status' => 'success',
                'message' => 'No orders yet',
                'orders' => null
            ], 200);
    }


    // public function change_order_status(Request $request, $id)
    // {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'status' => 'required',
    //         ]);
    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'status' => 'failed',
    //                 'message' => 'Validation error',
    //                 'errors' => $validator->errors()
    //             ], 422);
    //         }
    //         $order = Order::find($id);
    //         if ($order) {
    //             $order->update(['status' => $request->status]);
    //             return response()->json([
    //                 'status' => 'success',
    //                 'message' => 'Status changed successfully'
    //             ], 200);
    //         } else {
    //             return response()->json([
    //                 'status' => 'failed',
    //                 'message' => 'Order not found'
    //             ], 400);
    //         }
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'status' => 'failed',
    //             'Exceptions' => $e
    //         ], 400);
    //     }
    // }



}
