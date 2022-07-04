@extends('backend.app');

@section('header', 'Produk');

@section('content');
<a href="{{ route('product.create') }}" class="btn btn-primary mb-2">Tambah Data</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Harga</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $pr)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{$pr->product_name}}</td>
            <td>{{$pr->price}}</td>
            <td>
                @if ($pr->status == 'active')
                <span class="badge badge-success">Active</span>
                @else
                <span class="badge badge-danger">Inactive</span>
                @endif
            </td>
            <td>
                <a href="{{ route('product.edit', $pr->id) }}" class="btn btn-warning edit">Edit</a>
                <a href="#" class="btn btn-danger delete" data-id="{{ $pr->id }}">Delete</a>
                <a href="{{ route('product.show', $pr->id) }}" class="btn btn-success">View</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@push('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function () {
        $('.delete').click(function () {
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
                        url: `/admin/product/${id} `,
                        type: 'DELETE',
                        data: {
                            _token: '{{csrf_token()}}'
                        },
                        success: function (response) {
                            swal("Berhasil dihapus!", {
                                icon: "success",
                            });
                            location.reload();
                        }
                    });
                }
            })
        });
    });

</script>
@endpush
