<?php 

namespace App\Repository\Product;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

Class EloquentProductRepository implements ProductRepository
{
    public function getAll()
    {
        $products = Product::with('cat_info', 'child_cat_info', 'tags')
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->responseProducts($products);
    }


    public function getProductBySlug($slug)
    {
        $product = Product::withCount([
            'reviews as reviews_count' => function (Builder $q) {
                $q->where('status', 'active');
            }])->with([
            'reviews' => function ($q) {
                $q->where('is_parent', 1)
                ->with(['user' => function($q) {
                    $q->select('id', 'name', 'photo_path');
                },

                'replies' => function($q) {
                    $q->where('status', 'active')
                    ->with(['user' => function($q) {
                        $q->select('id', 'name', 'role', 'photo_path');
                    }]);
                }

                ])->withCount(['replies' => function($q) {
                    $q->where('status', 'active');
                }])->where('status', 'active')->get();

            },'cat_info', 'child_cat_info'
        ])
        ->where('slug', $slug)
        ->first();

        return $product;

        // $product = Product::where('slug', $slug)->with([

        //     'reviews' => function ($q) {
        //         $q->where('is_parent', 1)
        //         ->with(['user' => function($q) {
        //             $q->select('id', 'name', 'photo_path');
        //         },

        //         'replies' => function($q) {
        //             $q->where('status', 'active')
        //             ->with(['user' => function($q) {
        //                 $q->select('id', 'name', 'role', 'photo_path');
        //             }]);
        //         }

        //         ])->withCount(['replies' => function($q) {
        //             $q->where('status', 'active');
        //         }])->where('status', 'active')->get();

        //     },
        // ])->first();

        // $product->loadCount(['reviews' => function ($q) {
        //     $q->where('status', 'active');
        // }]);

        // return $product;
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

    public function getProductRelated($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $products = Product::where('status', 'active')
            ->where('slug', '!=', $slug)
            ->where('cat_id', $product->cat_id)
            ->orWhere('child_cat_id', $product->child_cat_id)
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
            'images' => $product->images,
            'cat_name' => $product->cat_info->name,
            'child_cat_name' => $product->child_cat_info->name,
            'cat_id' => $product->cat_id,
            'child_cat_id' => $product->child_cat_id,
            'tags' => $product->tags->pluck('name', 'slug')->toArray(),
            'size' => $product->size_id,
            'color' => $product->color_id,
            'desc' => $product->description,
            'reviews_count' => $product->reviews_count,
            'reviews' => $product->reviews
        ];
    }

    public function insertProductReview($request, $id)
    {
        return Review::create([
            'user_id' => auth()->user()->id,
            'product_id' => $id,
            'rating' => $request->rate,
            'comment' => $request->comment,
            'is_parent' => auth()->user()->role == 'user' ? 1 : 0,
            'parent_id' => asset($request->parent_id) ? $request->parent_id : 0,
            'status' => 'active'
        ]);
    }

}