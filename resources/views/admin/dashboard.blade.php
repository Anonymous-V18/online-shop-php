@extends('admin.layout')
@section('admin')
<h3>Dashboard</h3>
<div class="row text-center">
  <div class="col-md-3"><div class="card"><div class="card-body"><div>Orders</div><strong>{{ $stats['orders'] }}</strong></div></div></div>
  <div class="col-md-3"><div class="card"><div class="card-body"><div>Products</div><strong>{{ $stats['products'] }}</strong></div></div></div>
  <div class="col-md-3"><div class="card"><div class="card-body"><div>Users</div><strong>{{ $stats['users'] }}</strong></div></div></div>
  <div class="col-md-3"><div class="card"><div class="card-body"><div>Revenue</div><strong>{{ number_format($stats['revenue']) }}₫</strong></div></div></div>
</div>
@endsection
