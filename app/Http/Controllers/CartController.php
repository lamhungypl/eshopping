<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Coupon;
use App\Product;
use Illuminate\Http\Request;
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
}
