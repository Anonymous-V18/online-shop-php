<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder; use App\Models\Coupon;
class CouponSeeder extends Seeder
{
    public function run(): void {
        Coupon::create(['code'=>'GIAM10','discount_type'=>'percent','value'=>10,'max_uses'=>1000,'is_active'=>1,'starts_at'=>now()->subDay(),'ends_at'=>now()->addMonth()]);
    }
}
