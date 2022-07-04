<?php

namespace App\Repository\Cart;

use App\Models\Cart;
use App\Models\Product;

Class EloquentCartRepository implements CartRepository
{
    public function getAll()
    {
        if(!auth()->check()) {
            $cart = session()->get('cart');
        } else {
            $cart = Cart::where('user_id', auth()->user()->id)
                ->get()
                ->map(function ($cart) {
                    return [
                        'id' => $cart->id,
                        'product_id' => $cart->product_id,
                        'qty' => $cart->qty,
                        'price' => $cart->price,
                        'name' => $cart->product->product_name,
                        'image' => $cart->product->image,
                    ];
                });
        }

        return !$cart ?  [] : $cart;

    }

    public function store($id)
    {
        // check if user is logged in
        if(!auth()->check()){
            $cart = session()->get('cart');
            if(!$cart){
                $product = Product::find($id);
                $cart = [
                    $id => [
                        'product_id' => $id,
                        'name' => $product->product_name,
                        'qty' => request()->qty ? request()->qty : 1,
                        'image' => $product->image,
                        'weight' => $product->weight,
                        'price' => $product->price,
                    ]
                ];
                session()->put('cart', $cart);
            } else {
                if(!isset($cart[$id])){
                    $product = Product::find($id);
                    $cart[$id] = [
                            'product_id' => $id,
                            'name' => $product->product_name,
                            'qty' => request()->qty ? request()->qty : 1,
                            'image' => $product->image,
                            'weight' => $product->weight,
                            'price' => $product->price,
                    ];
                    session()->put('cart', $cart);
                } else {
                    request('qty') ? $cart[$id]['qty'] = request('qty') : $cart[$id]['qty']++;
                    session()->put('cart', $cart);
                }
            }  
        } else {

            // $this->localStorageToDatabase();

            $cart = Cart::where('product_id', $id)->first();
            if(!$cart){
                $cart = new Cart();
                $cart->user_id = auth()->user()->id;
                $cart->product_id = $id;
                $cart->qty = 1;
                $cart->price = Product::find($id)->price;
                $cart->save();
            } else {
                $cart->qty = request()->qty ? request()->qty : $cart->qty + 1;
                $cart->save();
            }
        }
    }

    public function update($product_id, $qty)
    {
        if(!auth()->check()){
            $cart = session()->get('cart');
            $cart[$product_id]['qty'] = $qty;
            session()->put('cart', $cart);
            return true;
        } else {
            $cart = Cart::where('product_id', $product_id)->first();
            $cart->qty = $qty;
            $cart->save();
            return true;
        }

        // $cart = Cart::where('product_id', $product_id)->first();

        // if($cart){
        //     if($qty > $cart->product->stock){
        //         return false;
        //     }
        //     $cart->qty = $qty;
        //     $cart->save();
        // }

        // return true;
    }

    public function delete($product_id)
    {
        if(!auth()->check()){
            $cart = session()->get('cart');
            unset($cart[$product_id]);
            session()->put('cart', $cart);
            return true;
        } else {
            $cart = Cart::where('product_id', $product_id)->first();
            $cart->delete();
            return true;
        }
    }

    // public function localStorageToDatabase()
    // {
    //     $cart = session()->get('cart');
    //     if(!$cart){
    //         foreach($cart as $data){
    //             $cart = new Cart();
    //             $cart->product_id = $data['product_id'];
    //             $cart->qty = $data['qty'];
    //             $cart->price = $data['price'];
    //             $cart->save();
    //         }
    //         session()->forget('cart');
    //     }
    // }
}