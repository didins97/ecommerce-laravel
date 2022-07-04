@extends('backend.app')

@section('header', 'Form Product')

@section('content')

<div class="card">
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" id="form-product">
        @csrf
        <div class="card-body">
            <div class="form-row">
                <div class="col-7">
                    <div class="form-message">
                        <label for="">Nama Produk</label>
                        <input type="text" class="form-control" name="product_name" value="{{ old('product_name') }}"
                            placeholder="Masukan Nama">
                        @error('product_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <label for="">Harga</label>
                    <div class="input-group mb-3 form-message">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="text" class="form-control" name="price" value="{{ old('price') }}"
                            placeholder="Masukan Harga">
                    </div>
                    @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group form-message">
                <label for="">Keterangan</label>
                <textarea id="" cols="50" rows="4" name="description"
                    class="form-control">{{ old('description') }}</textarea>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-row mb-3">
                <div class="col">
                    <div class="form-group form-message">
                        <label for="">Stok</label>
                        <input type="number" class="form-control" placeholder="Masukan Stok" name="stock"
                            value="{{ old('stok') }}" min="1">
                        @error('stock')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <label for="">Berat</label>
                    <div class="input-group mb-3 form-message">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Kg</span>
                        </div>
                        <input type="number" name="weight" class="form-control" placeholder="Berat cth(1kg)"
                            value="{{ old('weight') }}" min="1">
                    </div>
                    @error('weight')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col">
                    <div class="form-group form-message">
                        <label for="">Kategori</label>
                        <select name="cat_id" id="parent_cat" class="form-control">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $parent_cat)
                            <option value="{{ $parent_cat->id }}">{{ $parent_cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group form-message">
                        <label for="">Sub Kategori</label>
                        <select name="child_cat_id" id="child_cat" class="form-control" disabled>
                            <option value="">Pilih Sub Kategori</option>
                        </select>
                        @error('child_cat_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group form-message">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" class="form-control" name="images[]" multiple />
                    </div>
                </div>
                <div class="col">
                    <div class="form-check mb-3">
                        <label for="is_parent">Tipe</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline1" name="type" value="new"
                                class="custom-control-input" checked>
                            <label class="custom-control-label" for="customRadioInline1">NEW</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline2" name="type" value="hot"
                                class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline2">HOT</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline3" name="type" value="top"
                                class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline3">TOP</label>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
    </form>
</div>

@endsection

@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
    integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $('#parent_cat').change(function () {
        var id = $(this).val();
        $.ajax({
            url: `/admin/product/categories-child/${id}`,
            method: "POST",
            data: {
                parent_id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function (result) {
                // var data = JSON.parse(result);
                // console.log(result); 
                if (result.status) {
                    $('#child_cat').removeAttr('disabled');
                    $('#child_cat').html('');
                    $.each(result.data, function (key, value) {
                        $('#child_cat').append(
                            `<option value="${value.id}">${value.name}</option>`);
                    });
                } else {
                    $('#child_cat').html('<option value="">Tidak sub kategori</option>');
                    $('#child_cat').attr('disabled', 'disabled');
                }
            }
        });
    })

    // validate form
    $(document).ready(function () {
        $('#form-product').validate({
            rules: {
                product_name: {
                    required: true
                },
                price: {
                    required: true,
                    number: true
                },
                weight: {
                    required: true,
                    number: true,
                    min: 1
                },
                images: {
                    required: true,
                    extension: "jpg|png|jpeg"
                },
                cat_id: {
                    required: true,
                },
                child_cat_id: {
                    required: true,
                },
                stock: {
                    required: true,
                    number: true,
                    min: 1
                },
                description: {
                    required: true,
                    minlength: 10
                }
            },
            messages: {
                product_name: {
                    required: 'Nama produk harus diisi'
                },
                price: {
                    required: 'Harga harus diisi',
                    number: 'Harga harus berupa angka',
                },
                weight: {
                    required: 'Berat harus diisi',
                    number: 'Berat harus berupa angka',
                    min: 'Berat harus lebih dari 0'
                },
                images: {
                    required: 'Gambar harus diisi',
                    extension: 'Gambar harus berupa jpg, png, jpeg'
                },
                cat_id: {
                    required: 'Kategori harus diisi'
                },
                child_cat_id: {
                    required: 'Sub kategori harus diisi'
                },
                stock: {
                    required: 'Stok harus diisi',
                    number: 'Stok harus berupa angka',
                    min: 'Stok harus lebih dari 0'
                },
                description: {
                    required: 'Keterangan harus diisi',
                    minlength: 'Keterangan harus lebih dari 10 karakter'
                }
            },
            // warna message error
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-message').append(error);;
            },
        });
    });

</script>

@endpush
