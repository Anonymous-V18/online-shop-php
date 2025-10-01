<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class AccountController extends Controller
{
    public function profile(){ $user=auth()->user(); return view('account.profile', compact('user')); }
    public function updateProfile(Request $request){
        $user=auth()->user();
        $data=$request->validate(['name'=>'required|max:150','phone'=>'required|max:20','address_line'=>'required|max:255','province_id'=>'required|integer','district_id'=>'required|integer','ward_id'=>'required|integer']);
        $user->update($data); return back()->with('success','Cập nhật thành công');
    }
    public function orders(){ $orders=auth()->user()->orders()->latest()->paginate(10); return view('account.orders', compact('orders')); }
    public function orderShow($id){ $order=auth()->user()->orders()->with('items')->findOrFail($id); return view('account.order_show', compact('order')); }
}
