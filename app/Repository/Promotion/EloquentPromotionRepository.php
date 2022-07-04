<?php

namespace App\Repository\Promotion;

use App\Models\Promotion;

Class EloquentPromotionRepository implements PromotionRepository
{
    public function getActivePromotion()
    {
        $promotion = Promotion::where('is_active', true)->first();
        return $promotion;
    }
}