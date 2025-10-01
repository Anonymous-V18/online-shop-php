@extends('admin.layout')
@section('admin')
<div class="d-flex justify-content-between align-items-center">
  <h3>Danh mục</h3><a class="btn btn-primary" href="{{ route('admin.categories.create') }}">Thêm</a>
</div>
<table class="table mt-2"><thead><tr><th>Tên</th><th>Hiển thị</th><th></th></tr></thead><tbody>
@foreach($items as $it)
<tr>
  <td>{{ $it->name }}</td>
  <td>{{ $it->is_active ? '✔' : '✖' }}</td>
  <td class="text-end">
    <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.categories.edit',$it->id) }}">Sửa</a>
    <form method="POST" action="{{ route('admin.categories.destroy',$it->id) }}" style="display:inline">@csrf @method('DELETE')
      <button class="btn btn-sm btn-outline-danger">Xóa</button>
    </form>
  </td>
</tr>
@endforeach
</tbody></table>
{{ $items->links() }}
@endsection
