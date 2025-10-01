<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\Order; use App\Models\Product; use App\Models\User;
class DashboardController extends Controller
{
    public function index(){ $stats=['orders'=>Order::count(),'products'=>Product::count(),'users'=>User::count(),'revenue'=>Order::sum('grand_total')]; $latestOrders=Order::latest()->take(10)->get(); return view('admin.dashboard', compact('stats','latestOrders')); }
}
