@extends('layouts.main')

@section('container')
    <div class="pagetitle mt-3">
        <h1>Edit User</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Edit User</li>
        </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="card col-md-12">
                <div class="card-body">
                    <div class="mt-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <form class="row g-3 mt-3" method="GET" action="{{route('updateUser', ['id' => base64_encode($id)])}}">
                        <div class="col-md-12"> <label for="nama" class="form-label">Nama : </label> <input type="text" class="form-control" id="nama" name="nama" value="{{ $user[0]->name }}"></div>
                        <div class="col-md-12"> <label for="email" class="form-label">Email : </label> <input type="text" class="form-control" id="email" name="email" value="{{ $user[0]->email }}"></div>
                        <div class="col-md-12"> <label for="password" class="form-label">Password : </label> <input type="password" class="form-control" id="password" name="password" placeholder="Isi password baru"></div>
                        <div class="text-left mb-5 mt-4"> <a class="btn btn-danger" href="/managementUser">Batal</a><button type="submit" class="btn btn-primary ms-2">Submit</button></div>
                    </form>
                </div>
            </div> 
        </div>
    </section>
@endsection