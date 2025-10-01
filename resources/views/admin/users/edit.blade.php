@extends('admin.layout')
@section('admin')
<h3>Sửa khách hàng</h3>
<form method="POST" action="{{ route('admin.users.update',$user->id) }}" enctype="multipart/form-data">@csrf @method('PUT')
  <div class="row g-2">
    <div class="col-md-4"><label class="form-label">Họ tên</label><input class="form-control" name="name" value="{{ old('name',$user->name) }}"></div>
    <div class="col-md-4"><label class="form-label">Email</label><input class="form-control" name="email" value="{{ old('email',$user->email) }}"></div>
    <div class="col-md-4"><label class="form-label">SĐT</label><input class="form-control" name="phone" value="{{ old('phone',$user->phone) }}"></div>
  </div>
  <div class="row g-2 mt-2">
      <div class="col-md-4">
        <label class="form-label">Vai trò</label>
        <select class="form-select" name="role" required>
          <option value="user"  @selected(old('role',$user->role)==='user')>User</option>
          <option value="admin" @selected(old('role',$user->role)==='admin')>Admin</option>
        </select>
        @error('role')<div class="text-danger small">{{ $message }}</div>@enderror
      </div>
      <div class="col-md-4">
        <label class="form-label">Mật khẩu mới (tuỳ chọn)</label>
        <input type="password" class="form-control" name="password" placeholder="Để trống nếu không đổi">
        @error('password')<div class="text-danger small">{{ $message }}</div>@enderror
      </div>
      <div class="col-md-4">
        <label class="form-label">Ảnh đại diện</label>
        <input type="file" class="form-control" name="avatar">
        @error('avatar')<div class="text-danger small">{{ $message }}</div>@enderror
      </div>
    </div>


  <hr class="my-3">
  <h5>Địa chỉ</h5>
  @include('components.address-picker', [
    'provinceId' => old('province_id', $user->province_id),
    'districtId' => old('district_id', $user->district_id),
    'wardId'     => old('ward_id', $user->ward_id),
    'addressLine'=> old('address_line', $user->address_line),
    'required'   => false
  ])

  <div class="mt-3"><button class="btn btn-primary">Lưu</button></div>
</form>
@endsection
