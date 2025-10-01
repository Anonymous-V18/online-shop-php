@extends('admin.layout')
@section('admin')
<div class="d-flex justify-content-between align-items-center">
  <h3>Sản phẩm</h3><a class="btn btn-primary" href="{{ route('admin.products.create') }}">Thêm</a>
</div>
<form class="mt-2 mb-2"><div class="input-group"><input class="form-control" name="q" value="{{ $q }}" placeholder="Tìm theo tên..."><button class="btn btn-outline-secondary">Tìm</button></div></form>
<table class="table"><thead><tr><th>Tên</th><th>Giá</th><th>Kho</th><th>Hiển thị</th><th></th></tr></thead><tbody>
@foreach($items as $it)
<tr>
  <td>{{ $it->name }}</td>
  <td>{{ number_format($it->price) }}₫</td>
  <td>{{ $it->stock }}</td>
  <td>{{ $it->is_active ? '✔' : '✖' }}</td>
  <td class="text-end">
    <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.products.edit',$it->id) }}">Sửa</a>
    <form method="POST" action="{{ route('admin.products.destroy',$it->id) }}" style="display:inline">@csrf @method('DELETE')
      <button class="btn btn-sm btn-outline-danger">Xóa</button>
    </form>
  </td>
</tr>
@endforeach
</tbody></table>
{{ $items->links() }}
@endsection
