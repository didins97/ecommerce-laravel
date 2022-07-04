@extends('frontend.app')


@section('content')

<div class="container mt-5">
    <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
        @csrf @method('POST')
        <div class="row">
            <div class="col-md-8">
                <h4>Alamat Tagihan</h4>
                <div class="mb-3">
                    <label for="nama">Nama</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="name" id="nama" required="">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <input type="email" class="form-control" name="email" id="email" required="">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Alamat</label>
                    <input type="text" class="form-control" name="address" id="address">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="provinsi">Provinsi</label>
                        <select type="text" class="form-control" name="province_id" id="provinsi">
                            <option value="">Pilih Provinsi</option>
                            @foreach ($provinces as $item)
                            <option value="{{ $item['province_id'] }}">{{ $item['province'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="kota">Kota</label>
                        <select type="text" class="form-control" name="city_id" id="kota" disabled>
                            <option value="">Pilih Kota</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 kodepos">
                    <label for="kodepos">Kode Pos</label>
                    <input type="text" class="form-control" id="kodepos" name="postal_code">
                </div>

                <div class="mb-3">
                    <label for="payment_type">Jenis Pembayaran</label>
                    <select type="text" class="form-control" id="payment_type" name="payment_type" disabled>
                        <option value="">Pilih Jenis Pembayaran</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="mobile">Nomor Telepon</label>
                    <input type="text" class="form-control" id="mobile" name="phone"
                        placeholder="Masukan nomor yang akan dihubungi">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Catatan Lokasi</label>
                    <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Metode Pembayaran</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="payment_method" value="cod">COD
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="payment_method" value="online">ONLINE
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h4>Keranjang Anda</h4>
                <div class="card" style="width: 25rem;">
                    @foreach ($carts as $cart)
                    <input type="hidden" name="cart_id[]" value="{{$cart['id']}}">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <img src="{{ asset('/storage/images/'.$cart['image']) }}" alt="" width="60">
                            <h6 class="my-0">{{$cart['name']}}</h6>
                            <small class="text-muted">Harga Satuan : {{Helper::getPrice($cart['price'])}}</small><br>
                            <small class="text-muted">Jumlah : {{$cart['qty']}}</small>
                            <small class="text-muted">Berat : {{$cart['weight']}}</small>
                            <span class="text-muted">{{Helper::getPrice($cart['subtotal'])}}</span>
                        </li>
                    </ul>
                    @endforeach
                </div>
                <input type="hidden" name="total_product" value="{{$total}}">
                <input type="hidden" value="0" name="total_cost">
                <input type="hidden" value="{{$total_weight}}" name="total_weight">
                <div class="card" style="width: 25rem;">
                    <div class="card-body detail-cost">
                        <small class="text-muted total">total harga : {{Helper::getPrice($total)}}</small><br>
                        <small class="text-muted">total berat : {{$total_weight}}</small><br>
                    </div>
                </div>
                <div class="card" style="width: 25rem;">
                    <div class="card-body">
                        <b>TOTAL PEMBAYARAN </b> : <span class="text-muted"
                            id="total_cost">{{Helper::getPrice($total)}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="d-grid gap-2 mb-5">
                    <button class="btn btn-primary" type="submit">CHECKOUT</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection


@push('scripts')

<script>
    $(document).ready(function () {
        $('#provinsi').change(function () {
            var id = $(this).val();
            $.ajax({
                url: `/cities`,
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': id
                },
                success: function (response) {
                    $('#kota').removeAttr('disabled');
                    $('#kota').find('option').remove();
                    $.each(response, function (key, value) {
                        $('#kota').append(
                            `<option value="${value.city_id}">${value.type} ${value.city_name}</option>`
                            );
                    });
                }
            });
        });

        $('#kota').change(function () {
            var weight = $('input[name="total_weight"]').val();
            var city_id = $(this).val();

            $.ajax({
                url: `/shipping-cost`,
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'weight': weight,
                    'city_id': city_id
                },
                success: function (response) {
                    $('#payment_type').removeAttr('disabled');
                    $('#payment_type').find('option').remove();

                    // append data to payment_type
                    $.each(response[0]['costs'], function (key, value) {
                        $.each(value.cost, function (ky, vl) {
                            console.log(vl);
                            $('#payment_type').append(
                                `<option value="${vl.value}">${value.service} - ${value.description} - Estimasi Sampai ${vl.etd} - <b>Rp. ${vl.value}</b></option>`
                                );
                        });
                    });
                }
            });
        });


        $('#payment_type').change(function () {
            var total_product = $('input[name="total_product"]').val();
            var shipping_cost = $(this).val();
            var ongkir_class = $('.ongkir');

            if (ongkir_class.length > 0) {
                $('.ongkir').html(
                    `<small class="text-muted ongkir">Ongkir : Rp. ${shipping_cost}</small><br>`);
            } else {
                $('.detail-cost').append(
                    `<small class="text-muted ongkir">Ongkir : Rp. ${shipping_cost}</small><br>`);
            }

            $.ajax({
                type: "POST",
                url: "/total-cost",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'total_product': total_product,
                    'shipping_cost': shipping_cost
                },
                success: function (response) {
                    $('#total_cost').html(response['total']);   
                    $('input[name="total_cost"]').val(response['total']);
                }
            });
                


        })

    });

</script>

@endpush
