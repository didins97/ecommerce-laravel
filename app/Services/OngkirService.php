<?php

namespace App\Services;

use Kavist\RajaOngkir\Facades\RajaOngkir;

Class OngkirService
{

    public function province()
    {
        return RajaOngkir::provinsi()->all();
    }

    public function provinceById($id)
    {
        return RajaOngkir::provinsi()->find($id);
    }

    public function cityById($id)
    {
        return RajaOngkir::kota()->find($id);
    }

    public function city($id)
    {
        return RajaOngkir::kota()->dariProvinsi($id)->get();
    }

    public function cost($destination, $weight)
    {
        return RajaOngkir::ongkir([
            'origin'        => 254,     // ID kota/kabupaten asal
            'destination'   => $destination,      // ID kota/kabupaten tujuan
            'weight'        => $weight,    // berat barang dalam gram
            'courier'       => 'jne'    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();
    }

}