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
        $relatedProduct = $this->eloquentProduct->getProductRelated($product['id'])->take(6);
        // $product->load('cat_info', 'child_cat_info', 'order_details', 'tags');

        return view('frontend.detail', compact('product', 'relatedProduct'));
        // return $relatedProduct;
    }
}
