@extends('admin.layout')
@section('admin')
<div class="d-flex justify-content-between align-items-center">
  <h3>Voucher</h3><a class="btn btn-primary" href="{{ route('admin.coupons.create') }}">Thêm</a>
</div>
<table class="table mt-2"><thead><tr><th>Mã</th><th>Loại</th><th>Giá trị</th><th>Hiệu lực</th><th></th></tr></thead><tbody>
@foreach($items as $c)
<tr>
  <td>{{ $c->code }}</td>
  <td>{{ $c->discount_type }}</td>
  <td>{{ $c->value }}</td>
  <td>{{ $c->is_active ? '✔' : '✖' }}</td>
  <td class="text-end">
    <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.coupons.edit',$c->id) }}">Sửa</a>
    <form method="POST" action="{{ route('admin.coupons.destroy',$c->id) }}" style="display:inline">@csrf @method('DELETE')
      <button class="btn btn-sm btn-outline-danger">Xóa</button>
    </form>
  </td>
</tr>
@endforeach
</tbody></table>
{{ $items->links() }}
@endsection
