@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <h3>Đăng ký</h3>
    <form method="POST" action="{{ route('register') }}">@csrf
      <div class="row g-2">
        <div class="col-md-6"><label class="form-label">Họ tên *</label><input class="form-control" name="name" value="{{ old('name') }}" required></div>
        <div class="col-md-6"><label class="form-label">Email *</label><input class="form-control" type="email" name="email" value="{{ old('email') }}" required></div>
        <div class="col-md-6"><label class="form-label">SĐT *</label><input class="form-control" name="phone" value="{{ old('phone') }}" required></div>
        <div class="col-md-6"><label class="form-label">Mật khẩu *</label><input class="form-control" type="password" name="password" required></div>
        <div class="col-md-6"><label class="form-label">Nhập lại mật khẩu *</label><input class="form-control" type="password" name="password_confirmation" required></div>
      </div>

      <hr class="my-3">
      <h5>Địa chỉ</h5>
      @include('components.address-picker', [
        'provinceId' => old('province_id'),
        'districtId' => old('district_id'),
        'wardId'     => old('ward_id'),
        'addressLine'=> old('address_line'),
        'required'   => true
      ])

      <div class="mt-3"><button class="btn btn-primary">Tạo tài khoản</button></div>
    </form>
  </div>
</div>
@endsection
