@extends('admin.layout')
@section('admin')
<h3>Đơn hàng</h3>
<table class="table"><thead><tr><th>Mã</th><th>Khách</th><th>Tổng</th><th>Trạng thái</th><th>Ngày</th><th></th></tr></thead><tbody>
@foreach($orders as $o)
<tr><td>{{ $o->code }}</td><td>{{ $o->user->name ?? '' }}</td><td>{{ number_format($o->grand_total) }}₫</td><td>{{ $o->status }}</td><td>{{ $o->created_at }}</td>
<td><a class="btn btn-sm btn-outline-primary" href="{{ route('admin.orders.show',$o->id) }}">Xem</a></td></tr>
@endforeach
</tbody></table>
{{ $orders->links() }}
@endsection
