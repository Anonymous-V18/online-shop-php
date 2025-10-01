<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){ $items = Category::paginate(15); return view('admin.categories.index', compact('items')); }
    public function create(){ return view('admin.categories.create'); }
    public function store(Request $r){
        $d = $r->validate([
            'name' => 'required|max:150',
            'description' => 'nullable',
            'is_active' => 'nullable|boolean',
        ]);
        $d['slug'] = Str::slug($d['name']);
        $d['is_active'] = $r->boolean('is_active');
        Category::create($d);
        return redirect()->route('admin.categories.index')->with('success','Created');
    }
    public function edit(Category $category){ return view('admin.categories.edit', compact('category')); }
    public function update(Request $r, Category $category){
        $d = $r->validate([
            'name' => 'required|max:150',
            'description' => 'nullable',
            'is_active' => 'nullable|boolean',
        ]);
        $d['slug'] = Str::slug($d['name']);
        $d['is_active'] = $r->boolean('is_active');
        $category->update($d);
        return redirect()->route('admin.categories.index')->with('success','Updated');
    }
    public function destroy(Category $category){ $category->delete(); return back()->with('success','Deleted'); }
    public function show(Category $category){ return view('admin.categories.show', compact('category')); }
}
