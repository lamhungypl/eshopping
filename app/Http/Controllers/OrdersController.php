<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    //
    public function orderHistory(Request $request)
    {
        $userId = Auth::user()->id;
        $orders = Order::with('items')->where('user_id', $userId)->get();

        return view('user.order_history')->with(compact('orders'));
    }
    public function orderDetails(Request $request, $id = null)
    {
        $userId = Auth::user()->id;
        $orderDetails = Order::with('items')->where('user_id', $userId)->first();
        // dd($orderDetails);
        return view('user.order_details')->with(compact('orderDetails'));
    }
}
