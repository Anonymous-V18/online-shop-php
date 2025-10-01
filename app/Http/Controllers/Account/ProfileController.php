<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('account.profile');
    }


    public function update(UpdateProfileRequest $request)
    {
        $u = $request->user();
        $d = $request->validated();

        $u->name         = $d['name'];
        $u->phone        = $d['phone'];
        $u->province_id  = (int) $d['province_id'];
        $u->district_id  = (int) $d['district_id'];
        $u->ward_id      = (int) $d['ward_id'];
        $u->address_line = $d['address_line'];

        if ($request->hasFile('avatar')) {
            $u->avatar_path = $request->file('avatar')->store('avatars', 'public');
        }

        $u->save();

        return back()->with('status', 'Cập nhật hồ sơ thành công');
    }
}
