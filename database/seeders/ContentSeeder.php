<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder; use App\Models\Banner; use App\Models\Post;
class ContentSeeder extends Seeder
{
    public function run(): void {
        Banner::create(['title'=>'Sale 9.9','image_path'=>'banners/sample1.jpg','link'=>'#','is_active'=>1]);
        Banner::create(['title'=>'Deal Sốc','image_path'=>'banners/sample2.jpg','link'=>'#','is_active'=>1]);
        Post::create(['title'=>'Tin công nghệ tuần này','slug'=>'tin-cong-nghe-tuan-nay','content'=>'Nội dung demo','is_active'=>1]);
    }
}
