<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
use App\Models\Category;
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_description',
        'product_instock',
        'product_delivery',
        'product_warranty',        
        'product_original_price',
        'product_selling_price',
        'product_featured',
        'product_onsale',
        'product_status',
        'category_id',
        'seller_id',
        'product_banner',
        
    ];

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function categories(){
        return $this->belongsTo(Category::class);
    }
    
}
