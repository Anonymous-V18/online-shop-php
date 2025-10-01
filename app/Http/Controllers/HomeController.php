<?php
namespace App\Http\Controllers;
use App\Models\Banner; use App\Models\Product; use App\Models\Post;
class HomeController extends Controller
{
    public function index(){
        $banners = Banner::where('is_active',1)->latest()->take(5)->get();
        $featured = Product::where('is_active',1)->latest()->take(8)->get();
        $news = Post::where('is_active',1)->latest()->take(3)->get();
        return view('home', compact('banners','featured','news'));
    }
}
