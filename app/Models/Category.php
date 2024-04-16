<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
use App\Models\Product;
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'category_image',
        'product_id',
        'parent_category'
    ];

    public function products(){
        return $this->HasMany(Product::class);
    }
    
    
}
