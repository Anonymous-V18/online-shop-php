@extends('layouts.app')
@section('title','Đặt lại mật khẩu')
@section('content')
<h3>Đặt lại mật khẩu</h3>
<form method="POST" action="{{ route('password.update') }}">@csrf
  <input type="hidden" name="token" value="{{ $token }}">
  <div class="mb-2"><label class="form-label">Email</label><input class="form-control" name="email"></div>
  <div class="row">
    <div class="col"><label class="form-label">Mật khẩu</label><input class="form-control" type="password" name="password"></div>
    <div class="col"><label class="form-label">Nhập lại</label><input class="form-control" type="password" name="password_confirmation"></div>
  </div>
  <button class="btn btn-primary mt-3">Cập nhật</button>
</form>
@endsection
