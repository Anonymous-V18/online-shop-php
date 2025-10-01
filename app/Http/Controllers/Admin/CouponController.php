<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(){ $items = Coupon::latest()->paginate(20); return view('admin.coupons.index', compact('items')); }
    public function create(){ return view('admin.coupons.create'); }
    public function store(Request $r){
        $d = $r->validate([
            'code'=>'required|unique:coupons,code',
            'discount_type'=>'required|in:percent,fixed',
            'value'=>'required|numeric|min:0',
            'max_uses'=>'nullable|integer|min:0',
            'min_order_value'=>'nullable|numeric|min:0',
            'starts_at'=>'nullable|date',
            'ends_at'=>'nullable|date|after:starts_at',
            'is_active'=>'nullable|boolean',
        ]);
        $d['code'] = strtoupper($d['code']);
        $d['is_active'] = $r->boolean('is_active');
        Coupon::create($d);
        return redirect()->route('admin.coupons.index')->with('success','Created');
    }
    public function edit(Coupon $coupon){ return view('admin.coupons.edit', compact('coupon')); }
    public function update(Request $r, Coupon $coupon){
        $d = $r->validate([
            'discount_type'=>'required|in:percent,fixed',
            'value'=>'required|numeric|min:0',
            'max_uses'=>'nullable|integer|min:0',
            'min_order_value'=>'nullable|numeric|min:0',
            'starts_at'=>'nullable|date',
            'ends_at'=>'nullable|date|after:starts_at',
            'is_active'=>'nullable|boolean',
        ]);
        $d['is_active'] = $r->boolean('is_active');
        $coupon->update($d);
        return redirect()->route('admin.coupons.index')->with('success','Updated');
    }
    public function destroy(Coupon $coupon){ $coupon->delete(); return back()->with('success','Deleted'); }
    public function show(Coupon $coupon){ return view('admin.coupons.show', compact('coupon')); }
}
