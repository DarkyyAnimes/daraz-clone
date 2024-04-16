<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class Addtocart extends Model{

    use HasFactory;              

    protected $table = 'addtocarts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id',
        'user_id',
        "quantity",
        "seller_id"
    ];

                  
    public function products(): HasMany{
        return $this->hasMany(Product::class, 'product_id', 'id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
}
