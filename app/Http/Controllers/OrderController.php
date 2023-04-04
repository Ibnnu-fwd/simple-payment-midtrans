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
}
