<?php

namespace App\Http\Controllers;

use App\Repository\Cart\EloquentCartRepository;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{

    protected $eloquentCart;

    public function __construct(EloquentCartRepository $eloquentCartRepository)
    {
        $this->eloquentCart = $eloquentCartRepository;
    }

    public function index()
    {
        $cart = $this->eloquentCart->getAll();
        return view('frontend.cart', compact('cart'));
    }

    public function addToCart($product_id)
    {
        if(!empty($product_id)){
            if(!$this->eloquentCart->store($product_id)){
                return $this->response(true, 'Product berhasil ditambahkan');
            }
            return $this->response(false, 'Produk tidak ditemukan');
        }
    }

    public function updateQty(Request $request, $product_id)
    {
        if(!empty($product_id)){
            if(!$this->eloquentCart->update($product_id, $request->qty)){
                return $this->response(false, 'Produk tidak ditemukan');
            }
            return $this->response(true, 'Product berhasil diupdate');
        }
    }

    public function removeCart($product_id)
    {
        if(!empty($product_id)){
            if(!$this->eloquentCart->delete($product_id)){
                return $this->response(false, 'Produk tidak ditemukan');
            }
            return $this->response(true, 'Product berhasil dihapus');
        }    
    }

    public function response($status, $message)
    {
        return [
            'status' => $status,
            'message' => $message
        ];
    }
}
