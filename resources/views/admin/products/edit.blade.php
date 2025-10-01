@extends('admin.layout')
@section('admin')
<h3>Sửa sản phẩm</h3>
<form method="POST" action="{{ route('admin.products.update',$product->id) }}" enctype="multipart/form-data">@csrf @method('PUT')
  <div class="mb-2"><label class="form-label">Tên</label><input class="form-control" name="name" value="{{ old('name',$product->name) }}"></div>
  <div class="row">
    <div class="col-md-6 mb-2"><label class="form-label">Danh mục</label><select class="form-select" name="category_id">@foreach($categories as $c)<option value="{{ $c->id }}" @if($product->category_id==$c->id) selected @endif>{{ $c->name }}</option>@endforeach</select></div>
    <div class="col-md-6 mb-2"><label class="form-label">Hãng</label><select class="form-select" name="brand_id">@foreach($brands as $b)<option value="{{ $b->id }}" @if($product->brand_id==$b->id) selected @endif>{{ $b->name }}</option>@endforeach</select></div>
  </div>
  <div class="row">
    <div class="col-md-4 mb-2"><label class="form-label">Giá</label><input class="form-control" name="price" type="number" value="{{ $product->price }}"></div>
    <div class="col-md-4 mb-2"><label class="form-label">Giá KM</label><input class="form-control" name="sale_price" type="number" value="{{ $product->sale_price }}"></div>
    <div class="col-md-4 mb-2"><label class="form-label">Kho</label><input class="form-control" name="stock" type="number" value="{{ $product->stock }}"></div>
  </div>
  <div class="mb-2"><label class="form-label">Mô tả ngắn</label><input class="form-control" name="short_description" value="{{ $product->short_description }}"></div>
  <div class="mb-2"><label class="form-label">Mô tả</label><textarea class="form-control" name="description" rows="5">{{ $product->description }}</textarea></div>
  <div class="mb-2"><label class="form-label">Ảnh đại diện</label><input class="form-control" type="file" name="thumbnail"></div>
  <div class="form-check mb-2">
    <input type="hidden" name="is_active" value="0">
    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" @checked($product->is_active)>
    <label class="form-check-label" for="is_active">Hiển thị</label>
  </div>
  <button class="btn btn-primary">Cập nhật</button>
</form>
@endsection
