@extends('admin.layout')
@section('admin')
<h3>Sửa voucher</h3>
<form method="POST" action="{{ route('admin.coupons.update',$coupon->id) }}">@csrf @method('PUT')
  <div class="row">
    <div class="col-md-4 mb-2"><label class="form-label">Loại</label>
      <select class="form-select" name="discount_type">
        <option value="percent" @if($coupon->discount_type=='percent') selected @endif>% phần trăm</option>
        <option value="fixed" @if($coupon->discount_type=='fixed') selected @endif>Số tiền</option>
      </select>
    </div>
    <div class="col-md-4 mb-2"><label class="form-label">Giá trị</label><input class="form-control" type="number" name="value" value="{{ $coupon->value }}"></div>
    <div class="col-md-4 mb-2"><label class="form-label">Số lần tối đa</label><input class="form-control" type="number" name="max_uses" value="{{ $coupon->max_uses }}"></div>
  </div>
  <div class="row">
    <div class="col-md-6 mb-2"><label class="form-label">Từ ngày</label><input class="form-control" type="datetime-local" name="starts_at" value="{{ $coupon->starts_at }}"></div>
    <div class="col-md-6 mb-2"><label class="form-label">Đến ngày</label><input class="form-control" type="datetime-local" name="ends_at" value="{{ $coupon->ends_at }}"></div>
  </div>
  <div class="form-check mb-2">
    <input type="hidden" name="is_active" value="0">
    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" @checked($coupon->is_active)>
    <label class="form-check-label" for="is_active">Kích hoạt</label>
  </div>
  <button class="btn btn-primary">Cập nhật</button>
</form>
@endsection
