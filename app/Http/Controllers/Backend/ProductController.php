<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestProduct;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Alert;
use App\Helpers\Images;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.product.index', [
            'products' => product::with('category')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product.create', [
            'categories' => Category::where('is_parent', '!=', null)->where('status', 'active')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestProduct $request)
    {
        // create data product
        $request['slug'] = \Str::slug($request->product_name);
        $data = $request->except('images');
        Product::create($data);

        // create images
        $data_images = Images::moveImages($request->images, 'images/products');
        $i = 0;
        foreach ($data_images as $image) {
            $product_images = new ProductImage;
            $product_images->product_id = Product::orderBy('id', 'desc')->first()->id;
            $product_images->image_path = $image;
            $i == 0 ? $product_images->status = 'active' : $product_images->status = 'inactive';
            $product_images->save();
            $i++;
        }
        
        Alert::alert('Berhasil', 'Data produk berhasil ditambahkan', 'success');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        $main_image = $product->product_image->where('status', 'active')->first();
        return view('backend.product.show', [
            'product' => $product->with('product_image', 'cat_info', 'child_cat_info')->find($product->id),
            'main_image' => $main_image,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        return view('backend.product.edit', [
            'product' => $product,
            'categories' => Category::where('is_parent', '!=', null)->where('status', 'active')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {

        // update data images
        if($request->hasFile('images'))
        {
            $product->product_image->each(function($image) {
                $image->delete();
            });

            // create data product image
            $data_images = Images::moveImages($request->images, 'images/products');
            $i = 0;
            foreach ($data_images as $image) {
                $product_images = new ProductImage;
                $product_images->product_id = Product::orderBy('id', 'desc')->first()->id;
                $product_images->image_path = $image;
                $i == 0 ? $product_images->status = 'active' : $product_images->status = 'inactive';
                $product_images->save();
                $i++;
            }
        }

        // update data product
        if($request->product_name != $product->product_name)
        {
            $request['slug'] = \Str::slug($request->product_name);
        }
        $data = $request->except('images');
        $product->update($data);

        Alert::alert('Berhasil', 'Data produk berhasil diubah', 'success');
        return redirect()->route('product.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        $product->product_image->each(function($image) {
            $image->delete();
        });
        $product->delete();
    }

    public function getChildCategories($id)
    {
        $parent_cat = Category::find($id);
        if(count($parent_cat->child_cats) > 0){
            return response()->json([
                'status' => true,
                'data' => $parent_cat->child_cats,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'data' => '', 
            ]);
        }
    }

    public function updateProductImage($id, Request $request)
    {
        // check product image yang mempunyai status 1 lalu update status menjadi 0
        $product = Product::find($request->product);
        foreach ($product->product_image as $img ) {
            if ($img->status == 'active') {
                $img->status = 'inactive';
                $img->save();
            }
        }

        // update image yang di pilih menjadi 'active'
        $produk_image = ProductImage::find($id);
        $produk_image->status = 'active';
        $produk_image->save();
    }


}
