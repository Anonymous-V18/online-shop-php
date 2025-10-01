@extends('admin.layout')
@section('admin')
<h3>Thêm khách hàng</h3>
<form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">@csrf
  <div class="row g-2">
    <div class="col-md-4"><label class="form-label">Họ tên</label><input class="form-control" name="name" value="{{ old('name') }}"></div>
    <div class="col-md-4"><label class="form-label">Email</label><input class="form-control" name="email" value="{{ old('email') }}"></div>
    <div class="col-md-4"><label class="form-label">SĐT</label><input class="form-control" name="phone" value="{{ old('phone') }}"></div>
  </div>

  <hr class="my-3">
  <h5>Địa chỉ</h5>
  @include('components.address-picker', [
    'provinceId' => old('province_id'),
    'districtId' => old('district_id'),
    'wardId'     => old('ward_id'),
    'addressLine'=> old('address_line'),
    'required'   => false
  ])

  <div class="mt-3"><button class="btn btn-primary">Tạo</button></div>
</form>
@endsection
