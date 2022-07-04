@extends('backend.app')

@section('header', 'Produk')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="container">
            <div class="row">
              <div class="col-sm">
                <div class="pro-img-details">
                    <img src="{{ asset('images/products/'.$main_image->image_path) }}" width="600" alt="">
                </div>
              </div>
              <div class="col-sm">
                <h4 class="pro-d-title">
                    <a href="#" class="">
                        {{$product->nm_produk}}
                    </a>
                </h4>
                <div class="product_meta mb-2">
                    <span class="posted_in"> <strong>Kategori:</strong> 
                        <a rel="tag" href="#">
                            {{$product->cat_info->name}}
                        </a> 
                        -
                        <a rel="tag" href="#">
                            {{$product->child_cat_info->name}}
                        </a></span> <br>
                    {{-- <span class="tagged_as"><strong>Brand:</strong> <a rel="tag" href="#">{{$product->brand->nama_brand}}</a></span> --}}
                </div>
                <div class="m-bot15 mb-2"> <strong>Price : </strong> <span class="amount-old">{{$product->price}}</span></div>
                <div class="form-inline mb-2">
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="quantiy" value="{{$product->stock}}" class="form-control quantity mx-sm-3" disabled>
                    </div>
                </div>
                @if ($product->product_image->count() > 1)
                    @foreach ($product->product_image as $img)
                        <a href="#" class="edit-image">
                            <img src="{{ asset('images/products/'.$img->image_path) }}" class="img-thumbnail" width="100" alt="" data-img="{{$img->id}}" data-product="{{$product->id}}">
                        </a>
                    @endforeach
                    <br><small>klik gambar untuk mengganti menjadi gambar utama</small>
                @endif
                <p>
                    <button class="btn btn-primary btn-block mt-3" type="button"><i class="fa fa-edit"></i> Edit</button>
                </p>
              </div>
            </div>
          </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $('.edit-image').on('click', function(){
            var id = $(this).find('img').data('img');
            var product = $(this).find('img').data('product');
            $.ajax({
                url: `/admin/product-image/${id}/update`,
                method: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    product: product
                },
                success: function(response){
                    location.reload();
                }
            });
        });
    </script>
@endpush