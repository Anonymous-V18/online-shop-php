@extends('layouts.app')
@section('title','Đăng nhập')
@section('content')
<h3>Đăng nhập</h3>
<form method="POST">@csrf
  <div class="mb-2"><label class="form-label">Email</label><input class="form-control" name="email"></div>
  <div class="mb-2"><label class="form-label">Mật khẩu</label><input class="form-control" type="password" name="password"></div>
  <div class="form-check mb-2"><input type="checkbox" class="form-check-input" name="remember" id="remember"><label for="remember" class="form-check-label">Ghi nhớ</label></div>
  <button class="btn btn-primary">Đăng nhập</button>
  <a class="btn btn-link" href="{{ route('password.request') }}">Quên mật khẩu?</a>
</form>
@endsection
