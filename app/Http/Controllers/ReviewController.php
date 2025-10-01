<?php
namespace App\Http\Controllers;
use App\Models\Product; use App\Models\ProductReview; use Illuminate\Http\Request;
class ReviewController extends Controller
{
    public function store(Request $request, Product $product){
        $d=$request->validate(['rating'=>'required|integer|min:1|max:5','content'=>'nullable|string|max:2000']);
        $d['user_id']=auth()->id(); $d['product_id']=$product->id; ProductReview::create($d); return back();
    }
    public function update(Request $request, ProductReview $review){
        abort_unless($review->user_id===auth()->id(), 403);
        $d=$request->validate(['rating'=>'required|integer|min:1|max:5','content'=>'nullable|string|max:2000']); $review->update($d); return back();
    }
    public function destroy(ProductReview $review){
        abort_unless($review->user_id===auth()->id() || auth()->user()->role==='admin', 403);
        $review->delete(); return back();
    }
}
