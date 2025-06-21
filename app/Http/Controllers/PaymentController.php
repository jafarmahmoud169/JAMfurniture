<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;
use Exception;
use Validator;

class PaymentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function pay_for_order(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'payment_gateway'=>'required',
                'payment_phone_number' => 'required',
                'payment_process_number' => 'required',
            ]);
            $user_id = auth()->id();
            $order = Order::find($id);
            if ($order) {
                if ($order->user_id != $user_id) {
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'You do not have permission to pay for this order'
                    ], 200);
                } else {

                    $payment = new Payment();
                    $payment->user_id = $user_id;
                    $payment->payment_gateway = $request->payment_gateway;
                    $payment->payment_phone_number = $request->payment_phone_number;
                    $payment->payment_process_number = $request->payment_process_number;
                    $payment->order_id = $id;
                    $payment->save();

                    //change order status from unpaid to pending
                    $order->status = 'Pending';
                    $order->save();

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Order paied successfully'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Order not found'
                ], 201);
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
