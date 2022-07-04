<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repository\Promotion\EloquentPromotionRepository;
use App\Repository\Product\EloquentProductRepository;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $eloquentProduct;
    protected $eloquentPromotion;

    public function __construct(EloquentProductRepository $eloquentProduct, EloquentPromotionRepository $eloquentPromotion)
    {
        $this->eloquentProduct = $eloquentProduct;
        $this->eloquentPromotion = $eloquentPromotion;
    }

    public function index()
    {
        $products = $this->eloquentProduct->getAll()->take(6);
        $banners = DB::table('banners')->get();
        $mostSeller = $this->eloquentProduct->getProductMostSeller()->take(2);
        $promotion = $this->eloquentPromotion->getActivePromotion();

        return view('frontend.home', compact('products', 'banners', 'mostSeller', 'promotion'));
    }
}
