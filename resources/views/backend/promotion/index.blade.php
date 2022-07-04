@extends('backend.app')

@section('content')

<a href="{{ route('promotion.create') }}" class="btn btn-primary mb-2">Tambah Data</a>

<table class="table">
    <thead>
        <tr>
            <th style="width: 10px">No</th>
            <th>Judul</th>
            <th>Gambar</th>
            <th>Produk</th>
            <th>Batas Waktu</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($promotions as $promotion)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{$promotion->title}}</td>
            <td>
                <img src="{{ asset('images/promotion/'. $promotion->image) }}" alt="" width="100">
            </td>
            <td>
                {{ $promotion->product->product_name }}
            </td>
            <td>{{ $promotion->time_limit }}</td>
            <td>
                @if ($promotion->is_active == 1)
                <span class="badge badge-success">Aktif</span>
                @else
                <span class="badge badge-danger">NonAktif</span>
                @endif
            </td>
            <td>
                <a class="btn btn-primary btn-sm" href="#">
                    <i class="fas fa-folder">
                    </i>
                    View
                </a>
                <a class="btn btn-warning btn-sm edit" href="{{ route('promotion.edit', $promotion->id) }}"> <i
                        class="fas fa-pencil-alt"></i>
                    Edit
                </a>
                <a class="btn btn-danger btn-sm delete" href="#" data-id="{{ $promotion->id }}">
                    <i class="fas fa-trash">
                    </i>
                    Delete
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@push('scripts')

<script>
    $('.delete').on('click', function () {
        var id = $(this).data('id');
        swal("Apakah anda yakin untuk menghapusnya?", {
            buttons: ["Tidak!", "Ya!"],
            dangerMode: true,
            closeOnClickOutside: false,
        }).then(value => {
            if (value) {
                $.ajax({
                    url: `/admin/promotion/${id}`,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: "DELETE"
                    },
                    success: function (response) {
                        swal("Berhasil dihapus!", {
                            icon: "success",
                        });
                        location.reload();
                    }
                });
            }
        });
    })

</script>

@endpush
