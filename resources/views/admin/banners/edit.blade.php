@extends('admin.layout')
@section('admin')
<h3>Sửa banner</h3>
<form method="POST" action="{{ route('admin.banners.update',$banner->id) }}" enctype="multipart/form-data">@csrf @method('PUT')
  <div class="mb-2"><label class="form-label">Tiêu đề</label><input class="form-control" name="title" value="{{ $banner->title }}"></div>
  <div class="mb-2"><label class="form-label">Ảnh</label><input class="form-control" type="file" name="image"></div>
  <div class="mb-2"><label class="form-label">Link</label><input class="form-control" name="link" value="{{ $banner->link }}"></div>
  <div class="form-check mb-2">
    <input type="hidden" name="is_active" value="0">
    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" @checked($banner->is_active)>
    <label class="form-check-label" for="is_active">Hiển thị</label>
  </div>
  <button class="btn btn-primary">Cập nhật</button>
</form>
@endsection
