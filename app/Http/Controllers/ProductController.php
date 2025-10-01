<?php
namespace App\Http\Controllers;
use App\Models\Product; use App\Models\Category; use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){
        $q = Product::with('category','brand')->where('is_active',1);
        if($s = $request->get('q')) $q->where('name','like',"%{$s}%");
        if($c = $request->get('category')) $q->where('category_id',$c);
        if($b = $request->get('brand')) $q->where('brand_id',$b);
        if($min = $request->get('min_price')) {
            $min = preg_replace('/[^\d.]/', '', $min);
            $q->where('sale_price','>=',(float)$min);
        }
        if($max = $request->get('max_price')) {
            $max = preg_replace('/[^\d.]/', '', $max);
            $q->where('sale_price','<=',(float)$max);
        }
        $products = $q->paginate(12)->withQueryString();
        $categories = Category::where('is_active',1)->get();
        $brands = Brand::where('is_active',1)->get();
        return view('products.index', compact('products','categories','brands'));
    }
    public function show(Product $product){
        $product->load('images','reviews.user','category','brand');
        $related = Product::where('category_id',$product->category_id)->where('id','!=',$product->id)->take(4)->get();
        return view('products.show', compact('product','related'));
    }
}
