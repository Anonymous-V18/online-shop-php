<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id','code','status','subtotal','discount_total','grand_total',
        'coupon_code','receiver_name','receiver_phone',
        'province_id','district_id','ward_id','address_line',
        'payment_method','paid_at'
    ];
    protected $casts=['paid_at'=>'datetime'];
    public function user(){ return $this->belongsTo(User::class); }
    public function items(){ return $this->hasMany(OrderItem::class); }
    public function province(){ return $this->belongsTo(Province::class); }
    public function district(){ return $this->belongsTo(District::class); }
    public function ward(){ return $this->belongsTo(Ward::class); }
}
