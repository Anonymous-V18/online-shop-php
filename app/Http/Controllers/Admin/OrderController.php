<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\Order; use Illuminate\Http\Request;
class OrderController extends Controller
{
    public function index(Request $r){ $status=$r->get('status'); $orders=Order::when($status,fn($q)=>$q->where('status',$status))->latest()->paginate(20); return view('admin.orders.index', compact('orders','status')); }
    public function show(Order $order){ $order->load('items.product','user'); return view('admin.orders.show', compact('order')); }
    public function update(Request $r, Order $order){ $d=$r->validate(['status'=>'required|in:pending,confirmed,processing,shipped,delivered,cancelled']); $order->update($d); return back()->with('success','Order updated'); }
}
