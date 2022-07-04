<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'time_limit',
        'image',
        'product_id',
        'is_active',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getTimeLimitAttribute($value)
    {
        return Carbon::parse($value)->format('Y/m/d h:m:s');
    }
}
