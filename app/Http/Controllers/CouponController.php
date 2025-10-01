<?php
namespace App\Http\Controllers;
use App\Models\Coupon; use Illuminate\Http\Request;
class CouponController extends Controller
{
    public function apply(Request $request){
        $request->validate(['code'=>'required|string']); $code=strtoupper(trim($request->code));
        $coupon=Coupon::where('code',$code)->first(); $cart=session('cart',[]); $subtotal=collect($cart)->sum(fn($i)=>$i['price']*$i['qty']);
        if(!$coupon || !$coupon->isValidForTotal($subtotal)) return back()->withErrors(['code'=>'Mã giảm giá không hợp lệ.']);
        $amount=$coupon->discountAmount($subtotal); session(['coupon'=>['code'=>$code,'amount'=>$amount,'type'=>$coupon->discount_type]]);
        return back()->with('success','Áp dụng mã thành công.');
    }
    public function remove(){ session()->forget('coupon'); return back(); }
}
