<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Config;

class OrderController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function checkout(Request $request)
    {
        $request->request->add([
            'total_price' => 100000,
            'status' => 'Unpaid'
        ]);

        $order = Order::create($request->all());

        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        $params = array(
            'transaction_details' => array(
                'order_id'     => $order->id,
                'gross_amount' => $order->total_price
            ),
            'customer_details' => array(
                'name'  => $request->name,
                'phone' => $request->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('checkout', [
            'snapToken' => $snapToken,
            'order'     => $order
        ]);
    }

    public function afterPayment(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed    = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $order = Order::findOrFail($request->order_id);
                $order->update(['status' => 'Paid']);
            }
        }
    }
}
