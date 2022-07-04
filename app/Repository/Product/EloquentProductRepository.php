<?php 

namespace App\Repository\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

Class EloquentProductRepository implements ProductRepository
{
    public function getAll()
    {
        $products = Product::with('cat_info', 'child_cat_info', 'tags')
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();
            // ->map(function($product) {
            //     return [
            //         'name' => $product->product_name,
            //         'price' => $product->price,
            //         'image' => $product->image,
            //         'id' => $product->id,
            //         'cat_name' => $product->cat_info->name,
            //         'child_cat_name' => $product->child_cat_info->name,
            //         'type' => $product->type
            //     ];
            // });

        return $this->responseProducts($products);
    }


    public function getProductBySlug($slug)
    {
        $product = Product::with('cat_info', 'child_cat_info', 'tags')
            ->where('slug', $slug)
            ->where('status', 'active')
            ->first();

        return $this->responseProduct($product);
    }

    public function getProductMostSeller()
    {
        $products = Product::with('cat_info', 'child_cat_info')
            ->select(DB::raw('products.*, SUM(order_details.qty) as total_qty'))
            ->join('order_details', 'products.id', '=', 'order_details.product_id')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->where('orders.status', 'delivered')
            ->groupBy('products.id')
            ->orderBy('total_qty', 'desc')
            ->get();

        return $this->responseProducts($products);
    }

    public function getProductRelated($id)
    {
        $product = Product::find($id);
        $products = Product::where('cat_id', $product->cat_id)
            ->OrWhere('child_cat_id', $product->child_cat_id)
            ->where('id', '!=', $id)
            ->where('status', 'active')
            ->inRandomOrder()
            ->get();

        return $this->responseProducts($products);
    }


    public function responseProducts($products)
    {
        return $products->map(function($product) {
            return [
                'id' => $product->id,
                'slug' => $product->slug,
                'name' => $product->product_name,
                'price' => $product->price,
                'image' => $product->image,
                'cat_name' => $product->cat_info->name,
                'child_cat_name' => $product->child_cat_info->name,
                'featured' => $product->featured,
            ];
        });
    }

    public function responseProduct($product)
    {
        
        return [
            'id' => $product->id,
            'slug' => $product->slug,
            'name' => $product->product_name,
            'price' => $product->price,
            'image' => $product->image,
            'images' => json_decode($product->images),
            'cat_name' => $product->cat_info->name,
            'child_cat_name' => $product->child_cat_info->name,
            'cat_id' => $product->cat_id,
            'child_cat_id' => $product->child_cat_id,
            'tags' => $product->tags->pluck('name', 'slug')->toArray(),
            'size' => $product->size_id,
            'color' => $product->color_id,
            'desc' => $product->description,
        ];
    }

}