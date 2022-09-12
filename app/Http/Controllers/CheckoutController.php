<?php

namespace App\Http\Controllers;

use use App\Http\Requests\OrderRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Services\OngkirService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    protected $ongkirService;


    public function __construct(OngkirService $ongkirService)
    {
        $this->ongkirService = $ongkirService;
    }

    public function index(Request $request)
    {
        if(auth()->check()){
            if($request->product_id > 0)
            {
                $carts = Cart::whereIn('product_id', $request->product_id)
                ->get()
                ->map(function ($cart) {
                    return [
                        'id' => $cart->id,
                        'product_id' => $cart->product_id,
                        'weight' => $cart->product->weight,
                        'qty' => $cart->qty,
                        'price' => $cart->price,
                        'name' => $cart->product->product_name,
                        'image' => $cart->product->image,
                        'subtotal' => $cart->qty * $cart->price,
                    ];
                });

                
                $total = $carts->sum('subtotal');
                $total_weight = $carts->sum('weight');

                $provinces = $this->ongkirService->province();

                return view('frontend.checkout', compact('carts', 'provinces', 'total', 'total_weight'));

                // return $carts;
            }
        }
    }

    // public function cartToCheckout(Request $request)
    // {

    //     foreach (array_keys($request->id) as $id) 
    //     {
    //         $product = Product::find($id);

    //         $products[] = [
    //             'id' => $id,
    //             'qty' => $request->id[$id],
    //             'price' => $product->price,
    //             'name' => $product->product_name,
    //             'weight' => $product->weight,
    //             'image' => $product->image,
    //             'subtotal' => $request->id[$id] * $product->price,
    //         ];
    //     }

    //     // total price and total weight
    //     $total = array_sum(array_column($products, 'subtotal'));
    //     $total_weight = array_sum(array_column($products, 'weight'));

    //     // get all province
    //     $provinces = $this->ongkirService->province();

    //     return view('frontend.checkout', compact('products', 'provinces', 'total', 'total_weight'));
        
    // }

    public function store(OrderRequest $request, Order $order)
    {
        if($request->payment_method == 'cod')
        {
            return $request->all();
            // $province = $this->ongkirService->provinceById($request->province_id);
            // $city = $this->ongkirService->cityById($request->city_id);
            // $request->merge([
            //     'payment_status' => 'dibayar', 
            //     'status' => 'on_process',
            //     'user_id' => auth()->user()->id,
            //     'invoice_number' => 'INV-' . date('Ymd') . '-' . rand(100, 999),
            //     'province' => $province['province'],
            //     'city' => $city['city'],
            // ]);
            // $order->create($request->except('payment_type', 'notes', 'province_id', 'city_id'));

            // $carts = Cart::whereIn('id', $request->cart_id)->get();
            // foreach($carts as $cart)
            // {
            //     $order->order_details()->create([
            //         'order_id' => $order->id,
            //         'product_id' => $cart->product_id,
            //         'qty' => $cart->qty,
            //         'subtotal' => $cart->price * $cart->qty,
            //     ]);
            // }

            // return OrderDetail::all();

        } else {
            // midtrans
        }

        // return redirect()->route('order.index')->with('success', 'Pesanan anda berhasil ditambahkan');
        return $order;
    }


    public function getCity(Request $request)
    {
        $cities = $this->ongkirService->city($request->id);
        return $cities;
    }

