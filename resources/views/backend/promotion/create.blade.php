@extends('backend.app')

@section('header', 'Tambah Promosi')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('promotion.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" name="title">
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Description</label>
                <textarea name="description" id="" cols="30" rows="3" class="form-control"></textarea>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Product</label>
                <select name="product_id" id="" class="form-control">
                    @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->product_name}}</option>
                    @endforeach
                </select>
                @error('product_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-check mb-3">
                <label for="is_active">Status aktif</label><br>
                <input type="checkbox" name='is_active' id='is_active' value='1' checked> Ya
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Timer</label>
                <input type="text" name="time_limit" class="form-control datetimepicker-input" id="datetimepicker5"
                    data-toggle="datetimepicker" data-target="#datetimepicker5" />
                @error('time_limit')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input image" name="image" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <small>format ukuran gambar wajib <b>1782 x 468</b></small>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary submi float-right">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"
    integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA=="
    crossorigin="anonymous"></script>
<script>
    $(function () {
        $('#datetimepicker5').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            sideBySide: true,

        });
    });

</script>

@endpush
