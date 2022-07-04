<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function parent_info() {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function child_cats(){
        return $this->hasMany(Category::class, 'parent_id', 'id')->where('status', 'active');
    }

    public function products(){
        return $this->hasMany(Product::class, 'cat_id', 'id')->where('status', 'active');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


}
