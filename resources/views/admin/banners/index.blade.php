@extends('admin.layout')
@section('admin')
<div class="d-flex justify-content-between align-items-center">
  <h3>Banner</h3><a class="btn btn-primary" href="{{ route('admin.banners.create') }}">Thêm</a>
</div>
<table class="table mt-2"><thead><tr><th>Tiêu đề</th><th>Hiển thị</th><th></th></tr></thead><tbody>
@foreach($items as $b)
<tr>
  <td>{{ $b->title }}</td>
  <td>{{ $b->is_active ? '✔' : '✖' }}</td>
  <td class="text-end">
    <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.banners.edit',$b->id) }}">Sửa</a>
    <form method="POST" action="{{ route('admin.banners.destroy',$b->id) }}" style="display:inline">@csrf @method('DELETE')
      <button class="btn btn-sm btn-outline-danger">Xóa</button>
    </form>
  </td>
</tr>
@endforeach
</tbody></table>
{{ $items->links() }}
@endsection
