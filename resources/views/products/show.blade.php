@extends('layouts.app')
@section('title',$product->name)
@section('content')
<div class="row">
  <div class="col-md-6">
    <img class="img-fluid rounded" src="{{ $product->thumbnail_path ? asset('storage/'.$product->thumbnail_path) : 'https://via.placeholder.com/600x450' }}">
  </div>
  <div class="col-md-6">
    <h3>{{ $product->name }}</h3>
    <div class="text-muted">{{ $product->brand->name ?? '' }} | {{ $product->category->name ?? '' }}</div>
    <div class="display-6">{{ number_format($product->sale_price ?? $product->price) }}₫</div>
    <form method="POST" action="{{ route('cart.add',$product->id) }}">@csrf
      <div class="input-group my-3" style="max-width:220px">
        <input class="form-control" type="number" name="qty" value="1" min="1">
        <button class="btn btn-primary">Thêm vào giỏ</button>
      </div>
    </form>
    <p>{{ $product->short_description }}</p>
  </div>
</div>
<div class="mt-4">
  <h5>Mô tả</h5>
  <div>{!! nl2br(e($product->description)) !!}</div>
</div>
<div class="mt-4">
  <h5>Đánh giá ({{ $product->reviews->count() }}) - Điểm: {{ number_format($product->averageRating(),1) }}/5</h5>
  @auth
  <form method="POST" action="{{ route('reviews.store',$product->id) }}">@csrf
    <div class="row g-2">
      <div class="col-auto">
        <select name="rating" class="form-select">@for($i=1;$i<=5;$i++)<option value="{{ $i }}">{{ $i }}</option>@endfor</select>
      </div>
      <div class="col"><input class="form-control" name="content" placeholder="Cảm nhận của bạn..."></div>
      <div class="col-auto"><button class="btn btn-success">Gửi</button></div>
    </div>
  </form>
  @endauth
  <ul class="list-group mt-3">
    @foreach($product->reviews as $r)
    <li class="list-group-item">
      <strong>{{ $r->user->name }}</strong> - {{ $r->rating }}/5
      <div>{{ $r->content }}</div>
      @if(auth()->check() && (auth()->id()==$r->user_id || auth()->user()->role==='admin'))
        <form method="POST" action="{{ route('reviews.destroy',$r->id) }}" class="mt-1">@csrf @method('DELETE')
          <button class="btn btn-sm btn-link text-danger">Xóa</button>
        </form>
      @endif
    </li>
    @endforeach
  </ul>
</div>
@endsection
