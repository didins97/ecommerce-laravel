@extends('frontend.app')


@section('content')
<!-- detail product -->
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div id="slider" class="owl-carousel product-slider">
                    @foreach ($product['images'] as $image)
                        <div class="product-item">
                            <img src="{{ asset('storage/images/'.$image) }}" />
                        </div>
                    @endforeach
                </div>
                <div id="thumb" class="owl-carousel product-thumb">
                    @foreach ($product['images'] as $image)
                        <div class="product-item">
                            <img src="{{ asset('storage/images/'.$image) }}" />
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-dtl">
                    <div class="product-info">
                        <div class="product-name">{{$product['name']}}</div>
                        <div class="reviews-counter">
                            <div class="rate">
                                <input type="radio" id="star5" name="rate" value="5" checked />
                                <label for="star5" title="text">5 stars</label>
                                <input type="radio" id="star4" name="rate" value="4" checked />
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" name="rate" value="3" checked />
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" name="rate" value="2" />
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" name="rate" value="1" />
                                <label for="star1" title="text">1 star</label>
                              </div>
                            <span>3 Reviews</span>
                        </div>
                        <div class="product-price-discount">
                            <span>{{Helper::getPrice($product['price'])}}</span>
                            {{-- <span class="line-through">$29.00</span> --}}
                        </div>
                    </div>
                    <p>{{ $product['desc'] }}</p>
                    <div class="row mb-3">
                        @if ($product['size'] != null)
                        <div class="col-md-6">
                            <h4>Kategori</h4>
                            <span>
                                <a href="">{{$product['cat_name']}},</a> 
                                <a href="">{{$product['child_cat_name']}}</a> 
                            </span>
                        </div>
                        <div class="col-md-6">
                            <h4>Tags</h4>
                            @if ($product['tags'] != null)
                            <span>
                                @foreach ($product['tags'] as $key => $value)
                                    <a href="#">{{$value}},</a> 
                                @endforeach
                            </span>
                            @endif
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        @if ($product['size'] != null)
                        <div class="col-md-6">
                            <label for="size">Size</label>
                            <select id="size" name="size" class="form-control">
                                <option>S</option>
                                <option>M</option>
                                <option>L</option>
                                <option>XL</option>
                            </select>
                        </div>
                        @endif
                        @if ($product['color'] != null)
                        <div class="col-md-6">
                            <label for="color">Color</label>
                            <select id="color" name="color" class="form-control">
                                <option>Blue</option>
                                <option>Green</option>
                                <option>Red</option>
                            </select>
                        </div>
                        @endif
                    </div>
                    <div class="product-count">
                        <label for="size">Quantity</label>
                        <form action="#" class="display-flex">
                            <div class="qtyminus">-</div>
                            <input type="text" name="quantity" value="1" class="qty">
                            <div class="qtyplus">+</div>
                        </form>
                        <a href="#" class="round-black-btn">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- produk related -->
<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Produk Yang Sama
            </h2>
        </div>
        <div class="row">
            @foreach ($relatedProduct as $product)
            <div class="col-sm-6 col-lg-4">
                <div class="box">
                    <div class="img-box">
                        <img src="{{ asset('storage/images/'.$product['image']) }}"
                            alt="">
                        <a href="" class="add_cart_btn">
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
