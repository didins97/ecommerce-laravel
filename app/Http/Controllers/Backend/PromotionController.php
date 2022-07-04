<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Images;
use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionRequest;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotion::all();
        return view('backend.promotion.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promotions = Promotion::all();
        $products = Product::all();
        return view('backend.promotion.create', compact('promotions', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromotionRequest $request)
    {
        // get all data promotion
        $data = $request->all();

        // change name and move image
        $data['image'] = Images::moveImage($request->image, 'images/promotion');

        // check is_active exist or not
        if (isset($data['is_active']))
        {
            $data['is_active'] = $this->checkIsActive();
        } else {
            $data['is_active'] = false;
        }

        // create promotion
        Promotion::create($data);
        Alert::alert('Berhasil', 'Data promo berhasil ditambahkan', 'success');
        return redirect()->route('promotion.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promotion = Promotion::find($id);
        $products = Product::all();
        return view('backend.promotion.edit', compact('promotion', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PromotionRequest $request, $id)
    {
        $data = $request->all();

        if (isset($data['is_active']))
        {
            $data['is_active'] = $this->checkIsActive();
        } else {
            $data['is_active'] = false;
        }


        if($request->hasFile('image'))
        {
            $data['image'] = Images::moveImage($request->image, 'images/promotion');
            Promotion::find($id)->update($data);

            Alert::alert('Berhasil', 'Data promo berhasil diubah', 'success');
            return redirect()->route('promotion.index');
        }

        Promotion::find($id)->update($data);
        Alert::alert('Berhasil', 'Data promo berhasil diubah', 'success');
        return redirect()->route('promotion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promotion = Promotion::find($id);

        // delete image and delete promotion
        Images::deleteImage('images/promotion', $promotion->image);
        $promotion->delete();

        Alert::alert('Berhasil', 'Data promo berhasil dihapus', 'success');
        return redirect()->route('promotion.index');
    }

    public function checkIsActive()
    {
        // get all data promotion in database
        $promotions = Promotion::all();

        // check promotion if not empty
        if(!$promotions->isEmpty())
        {
            // input promotion is_active to data array
            foreach ($promotions as $promotion)
            {
                $data[] = $promotion->is_active;
            }

            // check data array is_active is true or false
            in_array(true, $data) ? $is_active= false : $is_active= true;
        } else {
            $is_active = true;
        }

        return $is_active;
    }
}
