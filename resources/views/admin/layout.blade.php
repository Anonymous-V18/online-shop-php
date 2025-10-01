@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-3">
    <div class="list-group">
      <a class="list-group-item list-group-item-action" href="{{ route('admin.dashboard') }}">Dashboard</a>
      <a class="list-group-item list-group-item-action" href="{{ route('admin.products.index') }}">Sản phẩm</a>
      <a class="list-group-item list-group-item-action" href="{{ route('admin.categories.index') }}">Danh mục</a>
      <a class="list-group-item list-group-item-action" href="{{ route('admin.brands.index') }}">Hãng</a>
      <a class="list-group-item list-group-item-action" href="{{ route('admin.orders.index') }}">Đơn hàng</a>
      <a class="list-group-item list-group-item-action" href="{{ route('admin.users.index') }}">Khách hàng</a>
      <a class="list-group-item list-group-item-action" href="{{ route('admin.coupons.index') }}">Voucher</a>
      <a class="list-group-item list-group-item-action" href="{{ route('admin.banners.index') }}">Banner</a>
      <a class="list-group-item list-group-item-action" href="{{ route('admin.posts.index') }}">Tin tức</a>
    </div>
  </div>
  <div class="col-md-9">@yield('admin')</div>
</div>
@endsection
