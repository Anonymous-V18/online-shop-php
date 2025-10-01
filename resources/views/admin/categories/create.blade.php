@extends('admin.layout')
@section('admin')
<h3>Thêm danh mục</h3>
<form method="POST" action="{{ route('admin.categories.store') }}">@csrf
  <div class="mb-2"><label class="form-label">Tên</label><input class="form-control" name="name"></div>
  <div class="mb-2"><label class="form-label">Mô tả</label><textarea class="form-control" name="description"></textarea></div>
  <div class="form-check mb-2">
    <input type="hidden" name="is_active" value="0">
    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked>
    <label class="form-check-label" for="is_active">Hiển thị</label>
  </div>
  <button class="btn btn-primary">Lưu</button>
</form>
@endsection
