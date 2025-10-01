<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder; use App\Models\Category; use App\Models\Brand; use App\Models\Product;
class CatalogSeeder extends Seeder
{
    public function run(): void {
        $cate1=Category::create(['name'=>'Điện thoại','slug'=>'dien-thoai','is_active'=>1]);
        $cate2=Category::create(['name'=>'Phụ kiện','slug'=>'phu-kien','is_active'=>1]);
        $b1=Brand::create(['name'=>'Apple','slug'=>'apple','is_active'=>1]);
        $b2=Brand::create(['name'=>'Samsung','slug'=>'samsung','is_active'=>1]);
        Product::create(['name'=>'iPhone 14 128GB','slug'=>'iphone-14-128gb','category_id'=>$cate1->id,'brand_id'=>$b1->id,'price'=>19990000,'sale_price'=>18990000,'stock'=>50,'short_description'=>'Hàng VN/A','description'=>'Màn hình 6.1", chip A15.','is_active'=>1]);
        Product::create(['name'=>'Galaxy S23','slug'=>'galaxy-s23','category_id'=>$cate1->id,'brand_id'=>$b2->id,'price'=>16990000,'sale_price'=>15990000,'stock'=>30,'short_description'=>'Mạnh mẽ','description'=>'Dynamic AMOLED, camera 50MP.','is_active'=>1]);
    }
}
