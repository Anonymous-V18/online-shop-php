<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','slug','category_id','brand_id','price','sale_price','stock',
        'short_description','description','thumbnail_path','is_active'
    ];
    public function category(){ return $this->belongsTo(Category::class); }
    public function brand(){ return $this->belongsTo(Brand::class); }
    public function images(){ return $this->hasMany(ProductImage::class); }
    public function reviews(){ return $this->hasMany(ProductReview::class); }
    public function averageRating(){ return $this->reviews()->avg('rating') ?? 0; }
}
