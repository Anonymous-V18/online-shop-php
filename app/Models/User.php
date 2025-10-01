<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name','email','phone','password','avatar_path',
        'province_id','district_id','ward_id','address_line','role'
    ];

    protected $hidden = ['password','remember_token'];

    public function orders(){ return $this->hasMany(Order::class); }
    protected $casts = [
        'province_id' => 'integer',
        'district_id' => 'integer',
        'ward_id'     => 'integer',
        'email_verified_at' => 'datetime',
    ];
}
