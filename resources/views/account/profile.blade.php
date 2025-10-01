@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-8">
    @if(session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <h3>Thông tin cá nhân</h3>
    <form method="POST" action="{{ route('account.profile') }}" enctype="multipart/form-data">
      @csrf

      <div class="row g-2">
        <div class="col-md-6">
          <label class="form-label">Họ tên</label>
          <input class="form-control" name="name" value="{{ old('name', auth()->user()->name) }}">
          @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
          <label class="form-label">SĐT</label>
          <input class="form-control" name="phone" value="{{ old('phone', auth()->user()->phone) }}">
          @error('phone')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
      </div>

      <div class="mb-2">
        <label class="form-label">Ảnh đại diện</label>
        <input class="form-control" type="file" name="avatar">
        @error('avatar')<div class="text-danger small">{{ $message }}</div>@enderror
        @if(auth()->user()->avatar_path)
          <img src="{{ asset('storage/'.auth()->user()->avatar_path) }}" class="mt-2 rounded" style="height:64px">
        @endif
      </div>

      <hr class="my-3">
      <h5>Địa chỉ</h5>
      @include('components.address-picker', [
        'model'    => auth()->user(),
        'required' => true,
      ])

      @error('province_id')<div class="text-danger small">{{ $message }}</div>@enderror
      @error('district_id')<div class="text-danger small">{{ $message }}</div>@enderror
      @error('ward_id')    <div class="text-danger small">{{ $message }}</div>@enderror
      @error('address_line')<div class="text-danger small">{{ $message }}</div>@enderror

      <div class="mt-3"><button class="btn btn-primary">Lưu thay đổi</button></div>
    </form>
  </div>
</div>
@endsection
