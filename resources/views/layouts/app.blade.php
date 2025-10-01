<!doctype html><html lang="vi"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title','Online Shop')</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body>
<nav class="navbar navbar-expand-lg bg-body-tertiary"><div class="container">
  <a class="navbar-brand" href="{{ route('home') }}">Shop</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
  <div class="collapse navbar-collapse" id="nav">
    <ul class="navbar-nav me-auto">
      <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Sản phẩm</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('faq.index') }}">FAQ</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('contact.show') }}">Liên hệ</a></li>
    </ul>
    <form class="d-flex me-3" role="search" action="{{ route('products.index') }}">
      <input class="form-control me-2" type="search" name="q" placeholder="Tìm kiếm..."><button class="btn btn-outline-success" type="submit">Tìm</button>
    </form>
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">Giỏ hàng</a></li>
      @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">{{ auth()->user()->name }}</a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ route('account.profile') }}">Tài khoản</a></li>
            <li><a class="dropdown-item" href="{{ route('account.orders') }}">Đơn hàng</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><form method="POST" action="{{ route('logout') }}">@csrf<button class="dropdown-item">Đăng xuất</button></form></li>
          </ul>
        </li>
      @else
        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Đăng nhập</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Đăng ký</a></li>
      @endauth
    </ul>
  </div>
</div></nav>
<div class="container mt-4">
  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
  @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
  @if($errors->any()) <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div> @endif
  @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body></html>
