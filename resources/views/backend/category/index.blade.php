@extends('backend.app')

@section('header', 'Category')

@section('content')

<div class="row">
    <div class="col-12 col-md-8 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4>List Kategori</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Parent</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{$category->name}}</td>
                            <td><span class="badge badge-light">{{$category->parent_info->name ?? '-'}}</span></td>
                            <td>
                                <a href="#" class="btn btn-warning edit" data-id="{{ $category->id }}">Edit</a>
                                <a href="#" class="btn btn-danger delete" data-id="{{ $category->id }}">Delete</a>
                                <a href="#" class="btn btn-success">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="card-header">
                <a href="#" class="btn btn-icon btn-primary reload"><i class="far fa-edit"></i></a>
            </div>
            <div class="card-body form">
                <form action="{{ route('categories.store') }}" method="POST" id="add-form">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" name="name" class="form-control">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-check mb-3">
                        <label for="is_parent">Jadikan Parent</label><br>
                        <input type="checkbox" name='is_parent' id='is_parent' value='1' checked> Yes
                    </div>
                    <div class="form-group d-none" id="parent_cat_div">
                        <label for="">Kategori</label>
                        <select class="form-control">
                            @foreach ($parent_categories as $parent)
                            <option value="{{$parent->id}}">{{ $parent->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>


    // modal show
    $('.add-cate').click(function (e) {
        $('.modal').modal('show');
    });

    $('#is_parent').change(function () {
        // console.log($(this).is(':checked'));
        if ($(this).is(':checked')) {
            $('#parent_cat_div').addClass('d-none');
        } else {
            $('#parent_cat_div').removeClass('d-none');
            $('#parent_cat_div select').attr('name', 'parent_id');
        }
    });

    // reload 
    $('.reload').click(function (e) {
        location.reload();
    });

    $('.edit').click(function () {
        var id = $(this).data('id');
        $.ajax({
            url: `/admin/categories/${id}/edit`,
            type: "GET",
            success: function (data) {
                console.log(data);
                $('.form').html(data);
            }
        });
    });

    $('.delete').click(function(){
            var id = $(this).data('id');
            swal("Apakah anda yakin untuk menghapusnya?", {
              buttons: ["Tidak!", "Ya!"],
              dangerMode: true,
              // check apakah button ya di klik
              closeOnClickOutside: false,
            }).then((value) => {
              if (value) {
                // console.log('delete');
                $.ajax({
                    url: `/admin/categories/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{csrf_token()}}'
                    },
                    success: function(response){
                        if(response){
                            swal("Berhasil dihapus!", {
                                icon: "success",
                            });
                            location.reload();
                        } else {
                            swal("Gagal dihapus!, Kategori Masih Mempunyai Produk", {
                                icon: "error",
                            });
                        }
                    }
                });    
              }
            })
        });

</script>
@endpush
