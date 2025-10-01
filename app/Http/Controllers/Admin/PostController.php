<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(){ $items = Post::latest()->paginate(20); return view('admin.posts.index', compact('items')); }
    public function create(){ return view('admin.posts.create'); }
    public function store(Request $r){
        $d = $r->validate([
            'title'=>'required|max:180',
            'content'=>'required',
            'image'=>'nullable|image|max:4096',
            'is_active'=>'nullable|boolean',
        ]);
        $d['slug'] = Str::slug($d['title']);
        if($r->hasFile('image')) $d['image_path'] = $r->file('image')->store('posts','public');
        $d['is_active'] = $r->boolean('is_active');
        Post::create($d);
        return redirect()->route('admin.posts.index')->with('success','Created');
    }
    public function edit(Post $post){ return view('admin.posts.edit', compact('post')); }
    public function update(Request $r, Post $post){
        $d = $r->validate([
            'title'=>'required|max:180',
            'content'=>'required',
            'image'=>'nullable|image|max:4096',
            'is_active'=>'nullable|boolean',
        ]);
        $d['slug'] = Str::slug($d['title']);
        if($r->hasFile('image')) $d['image_path'] = $r->file('image')->store('posts','public');
        $d['is_active'] = $r->boolean('is_active');
        $post->update($d);
        return redirect()->route('admin.posts.index')->with('success','Updated');
    }
    public function destroy(Post $post){ $post->delete(); return back()->with('success','Deleted'); }
    public function show(Post $post){ return view('admin.posts.show', compact('post')); }
}
