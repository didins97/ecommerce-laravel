@extends('frontend.app')

@section('content')

<!-- slider -->
<section>
    @include('frontend.partials.slider')
</section>
<!-- end slider -->

<!-- new product -->
<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Produk Terbaru
            </h2>
        </div>
        <div class="row">
          @foreach ($products as $product)
            <div class="col-sm-6 col-lg-4">
                <div class="box">
                    <div class="img-box">
                        <img src="{{ asset('storage/images/'.$product['image']) }}"
                            alt="">
                        <a href="" class="add_wishlist_btn" data-id={{$product['id']}}>
                            <span>
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                        </a>
                        <a href="javascript:void(0)" class="add_cart_btn" data-id="{{$product['id']}}">
                            <span>
                                Add To Cart
                            </span>
                        </a>
                    </div>
                    <div class="detail-box">
                        <h5>
                            <a href="{{ route('product.detail', $product['slug']) }}">{{ $product['name'] }}</a>
                        </h5>
                        <div class="product_info">
                            <h5>
                                {{Helper::getPrice($product['price'])}}
                            </h5>
                            <div class="star_container">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          @endforeach
        </div>
        <div class="btn_box">
            <a href="" class="view_more-link">
                View More
            </a>
        </div>
    </div>
</section>

<!-- promotion -->
<section class="section_promotion">
    @php
        $promo_date = Carbon\Carbon::parse($promotion->time_limit)->format('Y/m/d h:m:s');
    @endphp
    <div class="about-us">
        <h2>{{$promotion->title}}</h2>
        <div id="countdown" data-experied="{{$promo_date}}">
            <ul class="timer_promotion">

            </ul>
        </div>
        <p>{{$promotion->description}}</p>
    </div>
    <div class="image-wrapper">
        <img
            src="https://images.unsplash.com/photo-1531482615713-2afd69097998?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2940&q=80" />
    </div>
</section>

<!-- best saller -->
<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Produk Terlaris
            </h2>
        </div>
        <div class="row">
            @foreach ($mostSeller as $product)
            <div class="col-sm-6 col-lg-6">
                <div class="box">
                    <div class="img-box">
                        <img src="{{ asset('storage/images/'.$product['image']) }}"
                            alt="">
                            <a href="" class="add_wishlist_btn" data-id={{$product['id']}}>
                                <span>
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                </span>
                            </a>
                        <a href="javascript:void(0)" class="add_cart_btn" data-id="{{$product['id']}}">
                            <span>
                                Add To Cart
                            </span>
                        </a>
                    </div>
                    <div class="detail-box">
                        <h5>
                            <a href="#">{{$product['name']}}</a>
                        </h5>
                        <div class="product_info">
                            <h5>
                                {{Helper::getPrice($product['price'])}}
                            </h5>
                            <div class="star_container">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="btn_box">
            <a href="" class="view_more-link">
                View More
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('plugin') }}/jquery.countdown-2.2.0/jquery.countdown.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        let countDownDate = $('#countdown').data('experied');
        console.log(countDownDate);
        // console.log(typeof countDownDate);
        $('#countdown').countdown(countDownDate, function (event) {
            $(this).find('.timer_promotion').html(event.strftime('' +
                '<li><span class="days">%d</span><p class="timeRefDays">Hari</p></li>' +
                '<li><span class="hours">%H</span><p class="timeRefHours">Jam</p></li>' +
                '<li><span class="minutes">%M</span><p class="timeRefMinutes">Menit</p></li>' +
                '<li><span class="seconds">%S</span><p class="timeRefSeconds">Detik</p></li>'
            ));
            // console.log(event.strftime('%D days %H:%M:%S'));
        });
    });

    // btn-cart click
    $('.add_cart_btn').click(function () {
        let product_id = $(this).data('id');
        $.ajax({
            url: `/cart/${product_id}`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (data) {
                console.log(data);
            }
        });
    });

</script>
@endpush
