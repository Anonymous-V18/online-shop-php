@extends('admin.layout')
@section('admin')
<h3>Sửa danh mục</h3>
<form method="POST" action="{{ route('admin.categories.update',$category->id) }}">@csrf @method('PUT')
  <div class="mb-2"><label class="form-label">Tên</label><input class="form-control" name="name" value="{{ old('name',$category->name) }}"></div>
  <div class="mb-2"><label class="form-label">Mô tả</label><textarea class="form-control" name="description">{{ old('description',$category->description) }}</textarea></div>
  <div class="form-check mb-2">
    <input type="hidden" name="is_active" value="0">
    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" @checked($category->is_active)>
    <label class="form-check-label" for="is_active">Hiển thị</label>
  </div>
  <button class="btn btn-primary">Cập nhật</button>
</form>
@endsection
