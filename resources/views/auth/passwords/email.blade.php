@extends('layouts.app')
@section('title','Quên mật khẩu')
@section('content')
<h3>Quên mật khẩu</h3>
<form method="POST" action="{{ route('password.email') }}">@csrf
  <div class="mb-2"><label class="form-label">Email</label><input class="form-control" name="email"></div>
  <button class="btn btn-primary">Gửi link đặt lại</button>
</form>
@endsection
