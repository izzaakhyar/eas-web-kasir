<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = ['name', 'price', 'image_url', 'portrait_cover', 'description'];
    protected $primaryKey = 'id';

    public function cart() {
        return $this->hasMany(Cart::class, 'product_id', 'id');
    }

    public function game() {
        return $this->hasMany(Game::class, 'product_id', 'id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')
            ->withPivot('quantity', 'price');
    }
}
