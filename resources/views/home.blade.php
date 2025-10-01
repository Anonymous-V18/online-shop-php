@extends('layouts.app')
@section('title','Trang chủ')
@section('content')
<div id="banner" class="mb-4">
  <div class="row">
    @foreach($banners as $b)
    <div class="col-md-6 col-lg-4 mb-3">
      <a href="{{ $b->link ?? '#' }}">
        <img class="img-fluid rounded" src="{{ $b->image_path ? asset('storage/'.$b->image_path) : 'https://via.placeholder.com/800x300' }}" alt="banner">
      </a>
    </div>
    @endforeach
  </div>
</div>
<h3 class="mb-3">Sản phẩm nổi bật</h3>
<div class="row">
  @foreach($featured as $p)
  <div class="col-6 col-md-3 mb-4">
    <div class="card h-100">
      <img src="{{ $p->thumbnail_path ? asset('storage/'.$p->thumbnail_path) : 'https://via.placeholder.com/400x300' }}" class="card-img-top">
      <div class="card-body d-flex flex-column">
        <h6 class="card-title">{{ $p->name }}</h6>
        <div class="mt-auto">
          <div class="fw-bold">{{ number_format($p->sale_price ?? $p->price) }}₫</div>
          <a href="{{ route('products.show',$p->slug) }}" class="btn btn-sm btn-primary mt-2">Xem</a>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
<h3 class="mt-4 mb-3">Tin mới</h3>
<ul>@foreach($news as $n)<li>{{ $n->title }}</li>@endforeach</ul>
@endsection
