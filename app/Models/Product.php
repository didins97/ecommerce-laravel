<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cat_info()
    {
        return $this->hasOne(Category::class, 'id', 'cat_id');
    }

    public function child_cat_info()
    {
        return $this->hasOne(Category::class, 'id', 'child_cat_id');
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'products_tags', 'product_id', 'tag_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected function getImagesAttribute($value)
    {
        return json_decode($value);
    }
}
