@extends('admin.layout')
@section('admin')
<h3>Đơn {{ $order->code }}</h3>
<p>Khách: {{ $order->user->name ?? '' }} | {{ $order->receiver_phone }}</p>
<form method="POST" action="{{ route('admin.orders.update',$order->id) }}">@csrf @method('PUT')
<select class="form-select w-auto d-inline" name="status">
  @foreach(['pending','confirmed','processing','shipped','delivered','cancelled'] as $st)
    <option value="{{ $st }}" @if($order->status==$st) selected @endif>{{ $st }}</option>
  @endforeach
</select>
<button class="btn btn-sm btn-primary ms-2">Cập nhật</button>
</form>
<table class="table mt-3"><thead><tr><th>SP</th><th>Giá</th><th>SL</th><th>Tổng</th></tr></thead><tbody>
@foreach($order->items as $i)
<tr><td>{{ $i->name }}</td><td>{{ number_format($i->price) }}₫</td><td>{{ $i->qty }}</td><td>{{ number_format($i->total) }}₫</td></tr>
@endforeach
</tbody></table>
<div class="text-end"><strong>Grand total: {{ number_format($order->grand_total) }}₫</strong></div>
@endsection
