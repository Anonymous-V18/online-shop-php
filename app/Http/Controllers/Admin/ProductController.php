<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $r){
        $q = $r->get('q');
        $items = Product::when($q, fn($qr)=>$qr->where('name','like',"%{$q}%"))->latest()->paginate(20);
        return view('admin.products.index', compact('items','q'));
    }
    public function create(){
        $categories = Category::all(); $brands = Brand::all();
        return view('admin.products.create', compact('categories','brands'));
    }
    public function store(Request $r){
        $d = $r->validate([
            'name'=>'required|max:180',
            'category_id'=>'required|exists:categories,id',
            'brand_id'=>'required|exists:brands,id',
            'price'=>'required|numeric|min:0',
            'sale_price'=>'nullable|numeric|min:0',
            'stock'=>'required|integer|min:0',
            'short_description'=>'nullable|string|max:500',
            'description'=>'nullable|string',
            'thumbnail'=>'nullable|image|max:4096',
            'is_active'=>'nullable|boolean',
        ]);
        $d['slug'] = Str::slug($d['name']);
        $d['is_active'] = $r->boolean('is_active');
        if($r->hasFile('thumbnail')) $d['thumbnail_path'] = $r->file('thumbnail')->store('products','public');
        Product::create($d);
        return redirect()->route('admin.products.index')->with('success','Created');
    }
    public function edit(Product $product){
        $categories = Category::all(); $brands = Brand::all();
        return view('admin.products.edit', compact('product','categories','brands'));
    }
    public function update(Request $r, Product $product){
        $d = $r->validate([
            'name'=>'required|max:180',
            'category_id'=>'required|exists:categories,id',
            'brand_id'=>'required|exists:brands,id',
            'price'=>'required|numeric|min:0',
            'sale_price'=>'nullable|numeric|min:0',
            'stock'=>'required|integer|min:0',
            'short_description'=>'nullable|string|max:500',
            'description'=>'nullable|string',
            'thumbnail'=>'nullable|image|max:4096',
            'is_active'=>'nullable|boolean',
        ]);
        $d['slug'] = Str::slug($d['name']);
        $d['is_active'] = $r->boolean('is_active');
        if($r->hasFile('thumbnail')) $d['thumbnail_path'] = $r->file('thumbnail')->store('products','public');
        $product->update($d);
        return redirect()->route('admin.products.index')->with('success','Updated');
    }
    public function destroy(Product $product){ $product->delete(); return back()->with('success','Deleted'); }
    public function show(Product $product){ return view('admin.products.index', compact('product')); }
}
