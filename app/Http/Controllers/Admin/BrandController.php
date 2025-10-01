<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index(){ $items = Brand::paginate(15); return view('admin.brands.index', compact('items')); }
    public function create(){ return view('admin.brands.create'); }
    public function store(Request $r){
        $d = $r->validate([
            'name' => 'required|max:150',
            'description' => 'nullable',
            'is_active' => 'nullable|boolean',
        ]);
        $d['slug'] = Str::slug($d['name']);
        $d['is_active'] = $r->boolean('is_active');
        Brand::create($d);
        return redirect()->route('admin.brands.index')->with('success','Created');
    }
    public function edit(Brand $brand){ return view('admin.brands.edit', compact('brand')); }
    public function update(Request $r, Brand $brand){
        $d = $r->validate([
            'name' => 'required|max:150',
            'description' => 'nullable',
            'is_active' => 'nullable|boolean',
        ]);
        $d['slug'] = Str::slug($d['name']);
        $d['is_active'] = $r->boolean('is_active');
        $brand->update($d);
        return redirect()->route('admin.brands.index')->with('success','Updated');
    }
    public function destroy(Brand $brand){ $brand->delete(); return back()->with('success','Deleted'); }
    public function show(Brand $brand){ return view('admin.brands.show', compact('brand')); }
}
