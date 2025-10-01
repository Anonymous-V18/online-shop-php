<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showRegister(){ return view('auth.register'); }
    public function register(Request $request){
        $data = $request->validate([
            'name'=>'required|string|max:150',
            'email'=>'required|email|unique:users,email',
            'phone'=>'required|string|max:20',
            'password'=>'required|min:6|confirmed',
            'province_id'=>'required|integer',
            'district_id'=>'required|integer',
            'ward_id'=>'required|integer',
            'address_line'=>'required|string|max:255',
        ]);
        $data['password'] = Hash::make($data['password']); $data['role']='user';
        $user = User::create($data); Auth::login($user);
        return redirect()->route('home')->with('success','Đăng ký thành công!');
    }
    public function showLogin(){ return view('auth.login'); }
    public function login(Request $request){
        $cred = $request->validate(['email'=>'required|email','password'=>'required']);
        if(Auth::attempt($cred, $request->boolean('remember'))){ $request->session()->regenerate(); return redirect()->intended('/'); }
        return back()->withErrors(['email'=>'Thông tin đăng nhập không đúng']);
    }
    public function logout(Request $request){ Auth::logout(); $request->session()->invalidate(); $request->session()->regenerateToken(); return redirect('/'); }

    public function showForgot(){ return view('auth.passwords.email'); }
    public function sendResetLink(Request $request){
        $request->validate(['email'=>'required|email']);
        $status = Password::sendResetLink($request->only('email'));
        return $status === Password::RESET_LINK_SENT ? back()->with('status', __($status)) : back()->withErrors(['email'=>__($status)]);
    }
    public function showReset($token){ return view('auth.passwords.reset', ['token'=>$token]); }
    public function resetPassword(Request $request){
        $request->validate(['token'=>'required','email'=>'required|email','password'=>'required|min:6|confirmed']);
        $status = Password::reset($request->only('email','password','password_confirmation','token'), function($user,$password){
            $user->forceFill(['password'=>Hash::make($password),'remember_token'=>Str::random(60)])->save();
            event(new PasswordReset($user));
        });
        return $status == Password::PASSWORD_RESET ? redirect()->route('login')->with('status', __($status)) : back()->withErrors(['email'=>[__($status)]]);
    }
}
