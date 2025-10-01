<?php
namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index(){
        $cart=session('cart',[]); if(empty($cart)) return redirect()->route('cart.index')->with('error','Giỏ hàng trống');
        $subtotal=collect($cart)->sum(fn($i)=>$i['price']*$i['qty']); $discount=session('coupon.amount',0); $total=max(0,$subtotal-$discount);
        return view('checkout.index', compact('cart','subtotal','discount','total'));
    }
    public function placeOrder(Request $request){
        $cart=session('cart',[]); if(empty($cart)) return redirect()->route('cart.index');
        $data=$request->validate([
            'receiver_name'=>'required|string|max:150','receiver_phone'=>'required|string|max:20',
            'province_id'=>'nullable|integer','district_id'=>'nullable|integer','ward_id'=>'nullable|integer',
            'address_line'=>'required|string|max:255','payment_method'=>'required|in:cod,bank'
        ]);
        $coupon=session('coupon'); $subtotal=collect($cart)->sum(fn($i)=>$i['price']*$i['qty']); $discount=$coupon['amount']??0; $total=max(0,$subtotal-$discount);
        DB::transaction(function() use($data,$cart,$coupon,$subtotal,$discount,$total){
            $order=Order::create([
                'user_id'=>auth()->id(),'code'=>'OD'.Str::upper(Str::random(8)),'status'=>'pending',
                'subtotal'=>$subtotal,'discount_total'=>$discount,'grand_total'=>$total,'coupon_code'=>$coupon['code']??null,
                'receiver_name'=>$data['receiver_name'],'receiver_phone'=>$data['receiver_phone'],
                'province_id'=>$data['province_id']??null,'district_id'=>$data['district_id']??null,'ward_id'=>$data['ward_id']??null,
                'address_line'=>$data['address_line'],'payment_method'=>$data['payment_method']
            ]);
            foreach($cart as $pid=>$i){
                OrderItem::create(['order_id'=>$order->id,'product_id'=>$pid,'name'=>$i['name'],'price'=>$i['price'],'qty'=>$i['qty'],'total'=>$i['price']*$i['qty']]);
            }
        });
        session()->forget(['cart','coupon']); return redirect()->route('account.orders')->with('success','Đặt hàng thành công!');
    }
}
