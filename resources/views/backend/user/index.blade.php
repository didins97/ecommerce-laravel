@extends('backend.app')

@section('header', 'User')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <th>
                <figure class="avatar mr-2">
                    <img src="{{ asset('backend') }}/assets/img/avatar/avatar-5.png" alt="...">
                  </figure>
                {{$user->name}}
            </th>
            <td>{{$user->email}}</td>
            <td>
                @if ($user->role == 'admin')
                <span class="badge badge-primary">Admin</span>
                @else
                <span class="badge badge-warning">User</span>
                @endif
            </td>
            <td>
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning edit">Edit</a>
                <a href="#" class="btn btn-danger delete" data-id="{{ $user->id }}">Delete</a>
                <a href="{{ route('user.show', $user->id) }}" class="btn btn-success">View</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection