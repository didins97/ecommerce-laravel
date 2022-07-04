@extends('backend.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-4">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top " src="http://placehold.jp/3d4070/ffffff/150x150.png" alt="Card image cap">
            <div class="card-body">
              <button class="btn btn-primary text-center">Edit Gambar</button>
            </div>
          </div>
      </div>
      <div class="col-8">
        <div class="card">
            <div class="card-header">
              Profil
            </div>
            <div class="card-body">
              <form>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Name</label>
                  <input type="email" class="form-control" id="exampleFormControlInput1" value="{{ $user->name }}">
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Email address</label>
                      <input type="text" class="form-control" value="{{ $user->email }}">
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Password</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Mobile Number</label>
                      <input type="text" class="form-control" value="{{ $user->mobile_number }}">
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Address</label>
                      <textarea class="form-control">{{ $user->mobile_number}}</textarea>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            List Transaksi
          </div>
          <div class="card-body">
            
          </div>
        </div>
      </div>
    </div>
</div>
@endsection