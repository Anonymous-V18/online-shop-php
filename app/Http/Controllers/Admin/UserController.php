<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $r){ $q=$r->get('q'); $users=User::when($q,fn($qr)=>$qr->where('name','like',"%{$q}%")->orWhere('email','like',"%{$q}%"))->latest()->paginate(20); return view('admin.users.index', compact('users','q')); }
    public function show(User $user){ return view('admin.users.index', compact('user')); }
    public function edit(User $user){ return view('admin.users.edit', compact('user')); }
    public function update(Request $r, User $user){ $d=$r->validate(['role'=>'required|in:admin,user']); $user->update($d); return redirect()->route('admin.users.index')->with('success','Updated'); }
    public function destroy(User $user){ $user->delete(); return back()->with('success','Deleted'); }
}
