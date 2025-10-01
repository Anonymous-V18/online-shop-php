@extends('layouts.app')
@section('title','Thanh toán')
@section('content')
<h3>Thanh toán</h3>
<div class="row">
  <div class="col-md-7">
    <form method="POST" action="{{ route('checkout.place') }}">@csrf
      <div class="mb-2"><label class="form-label">Họ tên</label><input class="form-control" name="receiver_name" value="{{ old('receiver_name', auth()->user()->name) }}"></div>
      <div class="mb-2"><label class="form-label">SĐT</label><input class="form-control" name="receiver_phone" value="{{ old('receiver_phone', auth()->user()->phone) }}"></div>
       @include('components.address-picker', [
        'provinceId' => old('province_id', auth()->check() ? auth()->user()->province_id : null),
        'districtId' => old('district_id', auth()->check() ? auth()->user()->district_id : null),
        'wardId'     => old('ward_id', auth()->check() ? auth()->user()->ward_id : null),
        'addressLine'=> old('address_line', auth()->check() ? auth()->user()->address_line : null),
        'required'   => true
      ])
      <div class="mb-2">
        <label class="form-label">Thanh toán</label>
        <select class="form-select" name="payment_method"><option value="cod">COD</option><option value="bank">Chuyển khoản</option></select>
      </div>
      <button class="btn btn-primary">Đặt hàng</button>
    </form>
  </div>
  <div class="col-md-5">
    <div class="card"><div class="card-body">
      <h6>Đơn hàng</h6>
      <ul class="list-group mb-3">@foreach($cart as $pid=>$item)<li class="list-group-item d-flex justify-content-between align-items-center"><span>{{ $item['name'] }} x {{ $item['qty'] }}</span><strong>{{ number_format($item['price']*$item['qty']) }}₫</strong></li>@endforeach</ul>
      <div class="d-flex justify-content-between"><span>Tạm tính</span><strong>{{ number_format($subtotal) }}₫</strong></div>
      <div class="d-flex justify-content-between"><span>Giảm</span><strong>-{{ number_format($discount) }}₫</strong></div>
      <hr><div class="d-flex justify-content-between"><span>Tổng</span><strong>{{ number_format($total) }}₫</strong></div>
    </div></div>
  </div>
</div>
@endsection
