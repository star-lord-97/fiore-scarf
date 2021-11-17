<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function mainImage()
    {
        return $this->hasMany(ProductImage::class)->where("main", 1);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class)->where('units', '>', 0);
    }

    public function existsInUserCart()
    {
        return boolval(Cart::where('product_id', $this->id)->where('user_id', auth('api')->user()->id)->get()->count());
    }

    public function existsInUserWishlist()
    {
        return boolval(Wishlist::where('product_id', $this->id)->where('user_id', auth('api')->user()->id)->get()->count());
    }
}
