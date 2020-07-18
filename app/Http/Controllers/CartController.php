<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Country;
use App\Coupon;
use App\Order;
use App\OrderItem;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //
    public function applyCoupon(Request $request)
    {
        # code...
        Session::forget('CouponAmount');
        Session::forget('CouponCode');


        $data  = $request->all();
        // dd($data);
        $couponCount = Coupon::where('coupon_code', $data['coupon_code'])->count();
        // dd($couponCount);
        if ($couponCount == 0) {
            return redirect()->back()->with('flash_message_error', 'Invalid coupon');
        } else {
            $couponDetails = Coupon::where('coupon_code', $data['coupon_code'])->first();
            if ($couponDetails->status == 0) {
                return redirect()->back()->with('flash_message_error', 'This coupon is not active');
            }
            $expired_date = $couponDetails->expired_date;
            $current_date = date('Y-m-d');
            if ($expired_date < $current_date) {
                return redirect()->back()->with('flash_message_error', 'This coupon is expired');
            }

            //coupon is validated

            // get cart

            $session_id = Session::get('session_id');
            $cartList = Cart::where('session_id', $session_id)->get();
            // dd($cartList);
            $totalAmount = 0;
            $couponAmount = 0;
            $couponCode = $data['coupon_code'];
            foreach ($cartList as $item) {
                # code...
                $totalAmount = $totalAmount + $item->price * $item->quantity;
            }


            if ($couponDetails->amount_type == 'fixed') {
                $couponAmount = $couponDetails->amount;
            } else {
                $couponAmount = $totalAmount * ($couponDetails->amount / 100);
            }

            // dd($couponAmount);
            Session::put('CouponAmount', $couponAmount);
            Session::put('CouponCode', $couponCode);
            return redirect()->back()->with(compact('couponAmount', 'couponCode'))
                ->with('flash_message_success', 'Coupon code successfully applied');
        }

        return view('products.cart');
    }
    public function checkout(Request $request, $id = null)
    {
        $countries = Country::get();

        if ($request->isMethod('post')) {
            return view('checkout.order_review');
        }
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);

        $session_id = Session::get('session_id');

        $couponAmount = Session::get('CouponAmount');
        $couponCode = Session::get('CouponCode');

        $cartList = Cart::where('session_id', $session_id)->get();

        foreach ($cartList as $key => $product) {
            # code...
            $productDetails = Product::where('id', $product->product_id)->first();
            $cartList[$key]->image = $productDetails->image;
        }
        // dd($cartList);
        return view('checkout.billing_address')->with(compact('userDetails', 'countries', 'cartList', 'couponCode', 'couponAmount'));
    }
    public function orderReview(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            // dd($data);
        }
        return view('checkout.order_review');
    }
    public function placeOrder(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $newOrder = new Order();

            $newOrder->user_id = $data['user_id'];
            $newOrder->payment = $data['payment'];
            $newOrder->order_note = $data['orderNote'];
            $newOrder->coupon_code = $data['couponCode'];
            $newOrder->coupon_amount = $data['couponAmount'];
            $newOrder->subtotal = $data['subtotal'];
            $newOrder->total = $data['total'];

            // dd($newOrder);
            $newOrder->save();

            $session_id = Session::get('session_id');
            $cartOrder = Cart::where('session_id', $session_id)->get();

            // dd($cartOrder);
            foreach ($cartOrder as $key => $item) {
                # code...
                // dd($item);
                $productDetails = Product::where('id', $item->product_id)->first();
                $orderItem = new OrderItem();
                $orderItem->order_id = $newOrder->getKey();
                $orderItem->product_id = $item->product_id;
                $orderItem->product_name = $item->product_name;
                $orderItem->product_code = $item->product_code;
                $orderItem->product_color = $item->product_color;
                $orderItem->size = $item->size;
                $orderItem->price = $item->price;
                $orderItem->quantity = $item->quantity;
                $orderItem->image = $productDetails->image;
                $orderItem->save();
            }
            $request->session()->forget('session_id');
            $request->session()->forget('CouponAmount');
            $request->session()->forget('CouponCode');

            return redirect('/checkout/thankyou');
        }
        print_r('place order');
        die;
    }
    public function thankYou(Request $request)
    {
        # code...
        return view('checkout.thankyou');
    }
}
