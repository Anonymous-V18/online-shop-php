<?php
namespace App\Http\Controllers;
use App\Models\Product; use Illuminate\Http\Request;
class CartController extends Controller
{
    protected function getCart(){ return session()->get('cart',[]); }
    protected function saveCart($cart){ session(['cart'=>$cart]); }
    public function index(){
        $cart=$this->getCart(); $coupon=session('coupon');
        $subtotal=collect($cart)->sum(fn($i)=>$i['price']*$i['qty']);
        $discount=$coupon['amount']??0; $total=max(0,$subtotal-$discount);
        return view('cart.index', compact('cart','subtotal','discount','total','coupon'));
    }
    public function add(Request $request, Product $product){
        $qty=max(1,(int)$request->input('qty',1)); $cart=$this->getCart();
        $price=$product->sale_price?:$product->price;
        if(isset($cart[$product->id])) $cart[$product->id]['qty']+=$qty;
        else $cart[$product->id]=['name'=>$product->name,'price'=>$price,'qty'=>$qty,'thumbnail'=>$product->thumbnail_path,'slug'=>$product->slug];
        $this->saveCart($cart); return redirect()->route('cart.index')->with('success','Đã thêm vào giỏ');
    }
    public function update(Request $request, Product $product){
        $qty=max(1,(int)$request->input('qty',1)); $cart=$this->getCart();
        if(isset($cart[$product->id])) $cart[$product->id]['qty']=$qty; $this->saveCart($cart); return back();
    }
    public function remove(Product $product){ $cart=$this->getCart(); unset($cart[$product->id]); $this->saveCart($cart); return back(); }
}
