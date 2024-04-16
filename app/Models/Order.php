<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\User;
use \App\Models\Seller;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id',
        'user_id',        
        'order_id',        
        "quantity",
        'seller_id'
    ];

                  
    public function products(): HasMany{
        return $this->hasMany(Product::class, 'product_id', 'id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function sellers(): BelongsTo {
        return $this->belongsTo(Seller::class, 'seller_id');
    }
}
