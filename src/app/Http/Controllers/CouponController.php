<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function confirm(Request $request)
    {
        $coupon = Coupon::where('code',$request->coupon)->first();
        if(!$coupon){
            return back()->withErrors('クーポン番号が違います');
        }
        session()->put('coupon',[
            'name'=>$coupon->code,
            'discount'=>$coupon->discount(\Cart::getSubTotal()),
            'value'=>$coupon->type == 'fixed' ? $coupon->value:null,
            'percent_off'=>$coupon->type == 'percent' ? $coupon->percent_off:null,
        ]);
        return back()->with('success_message','クーポンが適用されました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('coupon');
        return back()->with('success_message','クーポンをキャンセルしました');
    }
}
