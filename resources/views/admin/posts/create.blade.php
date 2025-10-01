@extends('admin.layout')
@section('admin')
<h3>Thêm bài viết</h3>
<form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">@csrf
  <div class="mb-2"><label class="form-label">Tiêu đề</label><input class="form-control" name="title"></div>
  <div class="mb-2"><label class="form-label">Ảnh bìa</label><input class="form-control" type="file" name="image"></div>
  <div class="mb-2"><label class="form-label">Nội dung</label><textarea class="form-control" name="content" rows="6"></textarea></div>
  <div class="form-check mb-2">
    <input type="hidden" name="is_active" value="0">
    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked>
    <label class="form-check-label" for="is_active">Hiển thị</label>
  </div>
  <button class="btn btn-primary">Lưu</button>
</form>
@endsection
