@extends('admin.layout')
@section('admin')
<h3>Khách hàng</h3>
<form class="mb-2"><div class="input-group"><input class="form-control" name="q" value="{{ $q }}"><button class="btn btn-outline-secondary">Tìm</button></div></form>
<table class="table"><thead><tr><th>Tên</th><th>Email</th><th>Role</th><th></th></tr></thead><tbody>
@foreach($users as $u)
<tr><td>{{ $u->name }}</td><td>{{ $u->email }}</td><td>{{ $u->role }}</td><td class="text-end"><a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.users.edit',$u->id) }}">Sửa</a></td></tr>
@endforeach
</tbody></table>
{{ $users->links() }}
@endsection
