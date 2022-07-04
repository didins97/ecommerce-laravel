@extends('frontend.app')

@section('css')

<style>
    /* footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
        } */

</style>

@endsection

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('checkout') }}" method="POST" id="checkout" enctype="multipart/form-data">
                @csrf
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col"><input class="form-check-input all-check" type="checkbox" value=""
                                    id="defaultCheck1">
                            </th>
                            <th scope="col">Produk</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Kuantitas</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $item)
                        @php
                        $subtotal = $item['price'] * $item['qty'];
                        @endphp
                        <tr>
                            <td>
                                <input class="form-check-input" type="checkbox" name="product_id[]" value="{{$item['product_id']}}"
                                    data-subtotal="{{$subtotal}}">
                            </td>

                            <td>
                                <img src="{{ asset('/storage/images/'.$item['image']) }}" alt="" width="60">
                                {{$item['name']}}
                            </td>
                            <td>{{ $item['price'] }}</td>
                            <td>
                                <input type="number" class="form-control input-number input-qty" name="qty[]"
                                    value="{{$item['qty']}}" data-product="{{$item['product_id']}}">
                            </td>
                            <td class="subtotal">{{$subtotal}}</td>
                            <td>
                                <button type="button" class="btn btn-sm wishlist"><i class="fa fa-heart"></i></button>
                                <button type="button" class="btn wishlist btn-sm btn-remove"
                                    data-product="{{$item['product_id']}}">Remove</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="order_total">
                    <div class="order_total_content">
                        <div class="order_total_title">Order Total:</div>
                        <div class="order_total_amount">0</div>
                    </div>
                </div>
                <button type="submit" class="btn btn-checkout mb-5">Checkout</button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
    $(document).ready(function () {

        // $('.btn-checkout').on('click', function () {
        //     $('#checkout').submit();
        // });

        $('#checkout').on('submit', function () {
            $('.input-qty').prop('disabled', true);
            $('.all-check').prop('disabled', true);
        })

        $('.btn-remove').on('click', function () {
            let product_id = $(this).data('product');

            $.ajax({
                type: "POST",
                url: `/cart-remove/${product_id}`,
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: "DELETE"
                },
                success: function (response) {
                    console.log(response);
                    location.reload();
                }
            });
        });


        $('input:checkbox').on('click', function () {
            let subtotal = $(this).data('subtotal');
            let total = $('.order_total_amount').text();

            if (this.checked) {
                total = parseInt(total) + parseInt(subtotal);
            } else {
                total = parseInt(total) - parseInt(subtotal);
            }
            $('.order_total_amount').text(total);
        });



        $('.input-qty').on('change', function () {
            let qty = $(this).val();
            let product = $(this).data('product');

            $.ajax({
                type: "PATCH",
                url: `/cart/${product}`,
                data: {
                    _token: "{{ csrf_token() }}",
                    qty: qty,
                },
                success: function (response) {
                    location.reload();
                    // console.log(response);
                }
            });
        })

    });

</script>

@endpush
