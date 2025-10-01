@extends('layouts.app')
@section('title','Liên hệ')
@section('content')
<h3>Liên hệ</h3>
<form method="POST">@csrf
  <div class="mb-2"><label class="form-label">Họ tên</label><input class="form-control" name="name"></div>
  <div class="mb-2"><label class="form-label">Email</label><input class="form-control" name="email"></div>
  <div class="mb-2"><label class="form-label">Nội dung</label><textarea class="form-control" name="message" rows="5"></textarea></div>
  <button class="btn btn-primary">Gửi</button>
</form>
@endsection
