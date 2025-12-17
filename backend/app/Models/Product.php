<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'product';
    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
        'category_id',
        "material"
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
{
    return $this->image
        ? url('storage/' . $this->image)
        : url('storage/photo/default.png');
}

public function cartItems()
{
    return $this->hasMany(CartItem::class);
}

public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

}
