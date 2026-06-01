<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Notification;

class PaymentCallbackController extends Controller
{
    public function receive(Request $request)
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        try {
            $notification = new Notification();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        $orderCode = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $fraudStatus = $notification->fraud_status;

        $order = Order::where('order_code', $orderCode)->first();
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $order->status = 'pending';
            } else if ($fraudStatus == 'accept') {
                $order->status = 'processing';
            }
        } else if ($transactionStatus == 'settlement') {
            $order->status = 'processing';
        } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $order->status = 'cancelled';
        } else if ($transactionStatus == 'pending') {
            $order->status = 'pending';
        }

        $order->save();

        return response()->json(['status' => 'success'], 200);
    }
}
