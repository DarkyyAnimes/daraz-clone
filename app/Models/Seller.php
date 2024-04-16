<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Product;
use App\Models\Addtocart;

class Seller extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'sellers';

    protected $fillable = [
        'store_name',
        'store_email',
        'password', // Corrected column name
        'store_phone_no',     
        'store_address',
        'store_image_path',
        'store_logo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

  
        public function products(){
            return $this->hasMany(Product::class);
        }

        public function carts(){
            return $this->hasMany(Addtocart::class);
        }

        public function orders(){
            return $this->hasMany(Order::class, 'seller_id');
        }
  
}
