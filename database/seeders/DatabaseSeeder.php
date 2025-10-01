<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run(): void { $this->call([LocationSeeder::class, UserSeeder::class, CatalogSeeder::class, ContentSeeder::class, CouponSeeder::class]); }
}
