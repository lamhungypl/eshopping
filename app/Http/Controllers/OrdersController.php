<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
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
    public function viewOrders(Request $request)
    {

        $orders = Order::with('items')->orderBy('id', 'desc')->get();
        // $user = User::find($orders->user_id);
        foreach ($orders as $order) {
            $users[] = User::findOrFail($order->user_id);
        }
        // dd($users);
        return view('admin.orders.view_orders')->with(compact('orders', 'users'));
    }
    public function viewAdminOrder(Request $request, $id = null)
    {
        $order = Order::with('items')->where('id', $id)->first();
        $user = User::find($order->user_id);
        // dd($user);

        return view('admin.orders.view_order_details')->with(compact('order', 'user'));
    }
}
