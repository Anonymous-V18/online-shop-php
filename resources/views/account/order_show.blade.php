@extends('layouts.app')
@section('title','Chi tiết đơn hàng')
@section('content')
<h3>Đơn {{ $order->code }}</h3>
<p>Trạng thái: {{ $order->status }}</p>
<p>Người nhận: {{ $order->receiver_name }} - {{ $order->receiver_phone }}</p>
<p>Địa chỉ: {{ $order->address_line }}</p>
<table class="table">
  <thead><tr><th>SP</th><th>Giá</th><th>SL</th><th>Tổng</th></tr></thead>
  <tbody>
    @foreach($order->items as $i)
    <tr><td>{{ $i->name }}</td><td>{{ number_format($i->price) }}₫</td><td>{{ $i->qty }}</td><td>{{ number_format($i->total) }}₫</td></tr>
    @endforeach
  </tbody>
</table>
<div class="text-end"><strong>Grand total: {{ number_format($order->grand_total) }}₫</strong></div>
@endsection
