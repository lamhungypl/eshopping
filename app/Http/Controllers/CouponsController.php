<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    //
    public function addCoupon(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            $newCoupon = new Coupon();

            $newCoupon->coupon_code = $data['coupon_code'];
            $newCoupon->amount = $data['amount'];
            $newCoupon->amount_type = $data['amount_type'];
            $newCoupon->expired_date = $data['expired_date'];
            $newCoupon->status = $data['status'];
            $newCoupon->save();
            return redirect()->action('CouponsController@viewCoupons')->with('flash_message_success', 'added coupons');
        }
        return view('admin.coupons.add_coupon');
        # code...
    }
    public function viewCoupons(Request $request)
    {
        # code...
        $coupons  = Coupon::get();
        return view('admin.coupons.view_coupons')->with(compact('coupons'));
    }
    public function editCoupon(Request $request, $id = null)
    {
        # code...
        if ($request->isMethod('post')) {
            # code...
            $data = $request->all();

            $newCoupon = Coupon::find($id);

            $status  = empty($data['status']) ? 0 : 1;

            $newCoupon->coupon_code = $data['coupon_code'];
            $newCoupon->amount = $data['amount'];
            $newCoupon->amount_type = $data['amount_type'];
            $newCoupon->expired_date = $data['expired_date'];
            $newCoupon->status = $status;
            $newCoupon->save();
            return redirect()->action('CouponsController@viewCoupons')->with('flash_message_success', 'updated coupons');
        }
        $couponDetails = Coupon::find($id);
        // dd($couponDetails);
        return view('admin.coupons.edit_coupon')->with(compact('couponDetails'));
    }
}
