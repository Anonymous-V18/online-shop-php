<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder; use App\Models\User; use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    public function run(): void {
        $hcm=1; $q1=1; $w1=1;
        User::create(['name'=>'Admin','email'=>'admin@example.com','phone'=>'0900000000','password'=>Hash::make('password'),'role'=>'admin','province_id'=>$hcm,'district_id'=>$q1,'ward_id'=>$w1,'address_line'=>'1 Lê Lợi']);
        User::create(['name'=>'User Demo','email'=>'user@example.com','phone'=>'0900111222','password'=>Hash::make('password'),'role'=>'user','province_id'=>$hcm,'district_id'=>$q1,'ward_id'=>$w1,'address_line'=>'2 Lê Duẩn']);
    }
}
