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
                        {{-- <div class="reviews-counter">
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
                        </div> --}}
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

<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Ulasan Produk
            </h2>
        </div>

        <div class="product-info-tabs">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="description-tab" data-bs-toggle="tab" role="tab" data-bs-target="#description" aria-controls="#description" aria-selected="true" type="button">Reviews ({{$product['reviews_count']}})</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" role="tab" aria-controls="review" type="button" aria-selected="false">Your Review</a>
                  </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active mt-3" id="description" role="tabpanel" aria-labelledby="description-tab">
                    <div class="row">
                        <div class="col">
                        @foreach ($product['reviews'] as $pr)
                          <div class="d-flex flex-start">
                            <img class="rounded-circle shadow-1-strong me-3"
                              src="{{$pr['user']['image'] != '' ? asset('storage/images/'.$pr['user']['image']) : asset('img/avatar-5.png') }}" alt="avatar" width="65"
                              height="65" />
                                <div class="flex-grow-1 flex-shrink-1">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-1">
                                        {{$pr['user']['name']}} <span class="small">- {{$pr['created_at'] != '' ? $pr['created_at']->diffForHumans() : ''}}</span>
                                    </p>
                                    <div class="star_container">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    </div>
                                    <p class="small mb-0">
                                    {{$pr['comment']}}
                                    </p>
                                </div>
                                @if ($pr['replies'] != null)
                                @foreach ($pr['replies'] as $reply)
                                    <div class="d-flex flex-start mt-4">
                                    <a class="me-3" href="#">
                                        <img class="rounded-circle shadow-1-strong"
                                        src="{{asset('img/avatar-5.png') }}" alt="avatar"
                                        width="65" height="65" />
                                    </a>
                                    <div class="flex-grow-1 flex-shrink-1">
                                        <div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="mb-1">
                                            Admin <span class="small">- {{$reply['created_at'] != '' ? $reply['created_at']->diffForHumans() : ''}}</span>
                                            </p>
                                        </div>
                                        <p class="small mb-0">
                                            {{$reply['comment']}}
                                        </p>
                                        </div>
                                    </div>
                                    </div>
                                @endforeach
                                @endif
                            </div>
                          </div>
                          @endforeach
                        </div>
                      </div>
                  </div>
                  <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                      {{-- <div class="review-heading">REVIEWS</div> --}}
                      {{-- <p class="mb-20">There are no reviews yet.</p> --}}
                      <form class="review-form" method="POST" action="{{ route('product.review', $product['slug']) }}">
                        @csrf
                        <div class="form-group">
                            <label>Your rating</label>
                            <div class="reviews-counter">
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Your message</label>
                            <textarea class="form-control" name="comment" rows="10"></textarea>
                        </div>
                        @auth
                            <button class="round-black-btn" type="submit">Submit Review</button>
                        @endauth
                        @guest
                            <button class="round-black-btn">Login</button>
                        @endguest
                    </form>
                  </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
    
@endpush
