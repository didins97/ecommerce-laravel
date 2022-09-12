<?php

namespace App\Http\Controllers;

use App\Repository\Product\EloquentProductRepository;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function __construct(EloquentProductRepository $eloquentProduct)
    {
        $this->eloquentProduct = $eloquentProduct;
    }

    public function index($slug)
    {
        $product = $this->eloquentProduct->getProductBySlug($slug);
        $relatedProduct = $this->eloquentProduct->getProductRelated($slug)->take(3);

        return view('frontend.detail', compact('product', 'relatedProduct'));
    }

    public function addReview(Request $request, $slug)
    {
        return $slug;
        // if(auth()->check()) {
        //     if($this->eloquentProduct->insertProductReview($request, $id )) {
        //         return 'success';
        //     }
        // }
    }
}
