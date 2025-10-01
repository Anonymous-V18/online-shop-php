<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(){ $items = Banner::latest()->paginate(20); return view('admin.banners.index', compact('items')); }
    public function create(){ return view('admin.banners.create'); }
    public function store(Request $r){
        $d = $r->validate([
            'title'=>'required|max:150',
            'image'=>'required|image|max:4096',
            'link'=>'nullable|url',
            'is_active'=>'nullable|boolean',
        ]);
        $d['image_path'] = $r->file('image')->store('banners','public');
        $d['is_active'] = $r->boolean('is_active');
        Banner::create($d);
        return redirect()->route('admin.banners.index')->with('success','Created');
    }
    public function edit(Banner $banner){ return view('admin.banners.edit', compact('banner')); }
    public function update(Request $r, Banner $banner){
        $d = $r->validate([
            'title'=>'required|max:150',
            'image'=>'nullable|image|max:4096',
            'link'=>'nullable|url',
            'is_active'=>'nullable|boolean',
        ]);
        if($r->hasFile('image')) $d['image_path'] = $r->file('image')->store('banners','public');
        $d['is_active'] = $r->boolean('is_active');
        $banner->update($d);
        return redirect()->route('admin.banners.index')->with('success','Updated');
    }
    public function destroy(Banner $banner){ $banner->delete(); return back()->with('success','Deleted'); }
    public function show(Banner $banner){ return view('admin.banners.show', compact('banner')); }
}
