@extends('layouts.app')
@section('title','Đơn hàng')
@section('content')
<h3>Đơn hàng của tôi</h3>
<table class="table">
  <thead><tr><th>Mã</th><th>Trạng thái</th><th>Tổng</th><th>Ngày</th><th></th></tr></thead>
  <tbody>
    @foreach($orders as $o)
    <tr>
      <td>{{ $o->code }}</td>
      <td>{{ $o->status }}</td>
      <td>{{ number_format($o->grand_total) }}₫</td>
      <td>{{ $o->created_at }}</td>
      <td><a class="btn btn-sm btn-outline-primary" href="{{ route('account.orders.show',$o->id) }}">Xem</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $orders->links() }}
@endsection
