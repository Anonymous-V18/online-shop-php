@extends('layouts.app')
@section('title','Giỏ hàng')
@section('content')
<h3>Giỏ hàng</h3>
@if(empty($cart))
  <p>Chưa có sản phẩm</p>
@else
  <div class="table-responsive">
  <table class="table align-middle">
    <thead><tr><th>SP</th><th>Giá</th><th>Số lượng</th><th>Tạm tính</th><th></th></tr></thead>
    <tbody>
      @foreach($cart as $pid=>$item)
      <tr>
        <td><a href="{{ route('products.show',$item['slug']) }}">{{ $item['name'] }}</a></td>
        <td>{{ number_format($item['price']) }}₫</td>
        <td>
          <form method="POST" action="{{ route('cart.update',$pid) }}" class="d-flex">@csrf
            <input class="form-control form-control-sm me-2" type="number" name="qty" value="{{ $item['qty'] }}" min="1" style="width:90px">
            <button class="btn btn-sm btn-outline-secondary">Cập nhật</button>
          </form>
        </td>
        <td>{{ number_format($item['price']*$item['qty']) }}₫</td>
        <td>
          <form method="POST" action="{{ route('cart.remove',$pid) }}">@csrf @method('DELETE')
            <button class="btn btn-sm btn-outline-danger">Xóa</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>

  <div class="row">
    <div class="col-md-6">
      <form method="POST" action="{{ route('cart.applyCoupon') }}">@csrf
        <div class="input-group">
          <input class="form-control" name="code" placeholder="Mã giảm giá" value="{{ $coupon['code'] ?? '' }}">
          <button class="btn btn-outline-primary">Áp dụng</button>
        </div>
      </form>
      @if($coupon)
        <form method="POST" action="{{ route('cart.removeCoupon') }}" class="mt-2">@csrf @method('DELETE')
          <button class="btn btn-sm btn-outline-danger">Bỏ mã {{ $coupon['code'] }}</button>
        </form>
      @endif
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between"><span>Tạm tính</span><strong>{{ number_format($subtotal) }}₫</strong></div>
          <div class="d-flex justify-content-between"><span>Giảm</span><strong>-{{ number_format($discount) }}₫</strong></div>
          <hr>
          <div class="d-flex justify-content-between"><span>Tổng</span><strong>{{ number_format($total) }}₫</strong></div>
          <a class="btn btn-primary w-100 mt-3 @if(!auth()->check()) disabled @endif" href="{{ route('checkout.index') }}">Thanh toán</a>
          @guest <div class="small text-muted mt-2">Đăng nhập để thanh toán</div> @endguest
        </div>
      </div>
    </div>
  </div>
@endif
@endsection
