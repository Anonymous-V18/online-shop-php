<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class ContactController extends Controller
{
    public function showForm(){ return view('contact'); }
    public function submit(Request $request){
        $data=$request->validate(['name'=>'required|max:150','email'=>'required|email','message'=>'required|max:2000']);
        \Log::info('Contact form', $data); return back()->with('success','Cảm ơn bạn! Chúng tôi sẽ liên hệ sớm.');
    }
}
