@extends('layouts.app')
@section('title','Sản phẩm')
@section('content')
<div class="row">
  <div class="col-md-3">
    <div class="card mb-3"><div class="card-body">
      <form>
        <div class="mb-2">
          <label class="form-label">Danh mục</label>
          <select class="form-select" name="category">
            <option value="">-- Tất cả --</option>
            @foreach($categories as $c)
              <option value="{{ $c->id }}" @if(request('category')==$c->id) selected @endif>{{ $c->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-2">
          <label class="form-label">Hãng</label>
          <select class="form-select" name="brand">
            <option value="">-- Tất cả --</option>
            @foreach($brands as $b)
              <option value="{{ $b->id }}" @if(request('brand')==$b->id) selected @endif>{{ $b->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-2">
          <label class="form-label">Khoảng giá</label>
          <div class="d-flex gap-2">
            <input class="form-control" name="min_price" value="{{ request('min_price') }}" placeholder="Từ">
            <input class="form-control"  name="max_price" value="{{ request('max_price') }}" placeholder="Đến">
          </div>
        </div>
        <button class="btn btn-primary w-100">Lọc</button>
      </form>
    </div></div>
  </div>
  <div class="col-md-9">
    <div class="row">
      @foreach($products as $p)
      <div class="col-6 col-lg-4 mb-4">
        <div class="card h-100">
          <img src="{{ $p->thumbnail_path ? asset('storage/'.$p->thumbnail_path) : 'https://via.placeholder.com/400x300' }}" class="card-img-top">
          <div class="card-body d-flex flex-column">
            <h6 class="card-title">{{ $p->name }}</h6>
            <div class="mt-auto">
              <div class="fw-bold">{{ number_format($p->sale_price ?? $p->price) }}₫</div>
              <a href="{{ route('products.show',$p->slug) }}" class="btn btn-sm btn-outline-primary mt-2">Chi tiết</a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    {{ $products->links() }}
  </div>
</div>
@endsection
