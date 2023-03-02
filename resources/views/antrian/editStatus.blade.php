@extends('layouts.main')

@section('container')
    <div class="pagetitle mt-3">
        <h1>Edit Status</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Edit Status</li>
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
                    <form class="row g-3 mt-3" method="GET" action="{{route('submitStatus', ['no_ppk' => $no_ppk])}}">
                        <div class="col-md-12"> <label for="noppk" class="form-label">Nomor Pengajuan PPK : </label> <input type="text" class="form-control" id="no_ppk" name="no_ppk" value="{{ $no_ppk }}" readonly></div>
                        <div class="col-md-12">
                            <label for="status" class="form-label">Pilih Status Baru : </label>
                            <select id="status" class="form-select" name="status">
                                <option value="Menunggu">Menunggu</option>
                                <option value="Diproses">Diproses</option>
                                <option value="Recall">Recall</option>
                                <option value="Cancel">Cancel</option>
                            </select>
                        </div>
                        <div class="text-left mb-5 mt-4"> <a class="btn btn-danger" href="/daftar/antrian/karantina">Batal</a><button type="submit" class="btn btn-primary ms-2">Submit</button></div>
                    </form>
                </div>
            </div> 
        </div>
    </section>
@endsection