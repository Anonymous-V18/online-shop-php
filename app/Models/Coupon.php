<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable=['code','discount_type','value','max_uses','used_count','min_order_value','starts_at','ends_at','is_active'];
    protected $casts=['starts_at'=>'datetime','ends_at'=>'datetime'];
    public function isValidForTotal($total){
        $now = Carbon::now();
        if(!$this->is_active) return false;
        if($this->starts_at && $now->lt($this->starts_at)) return false;
        if($this->ends_at && $now->gt($this->ends_at)) return false;
        if($this->max_uses && $this->used_count >= $this->max_uses) return false;
        if($this->min_order_value && $total < $this->min_order_value) return false;
        return true;
    }
    public function discountAmount($total){
        return $this->discount_type==='percent' ? round($total*($this->value/100),2) : min($this->value,$total);
    }
}
