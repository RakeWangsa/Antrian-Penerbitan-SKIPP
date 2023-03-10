@extends('layouts.main')

@section('container')
    <div class="pagetitle mt-3">
        <h1>Ambil Antrian</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Ambil Antrian</li>
        </ol>
        </nav>
    </div>
    <div class="pagetitle mt-3">
        <div class="alert alert-info alert-dismissible fade show justify-content-center col-md-12" role="alert"> <i class="bi bi-info-circle me-1"></i> 
            Silahkan pilih jenis antrian dibawah ini untuk mendapatkan nomor antrian dengan mengisikan nomor pengajuan PPK terlebih dahulu.
            Apabila belum memiliki nomor PPK silahkan memilih layanan konsultasi. 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
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
                    <form class="row g-3 mt-3" method="GET" action="{{route('ambilantrian')}}">
                        <div class="col-md-12"> <label for="noppk" class="form-label">Masukkan Nomor Pengajuan PPK</label> <input type="text" class="form-control" id="no_ppk" name="no_ppk" value="{{ old('no_ppk') }}"></div>
                        <div class="col-md-12">
                            <label for="jenislayanan" class="form-label">Pilih Jenis Layanan</label> 
                            <select id="jenislayanan" class="form-select" name="jenislayanan">
                                <option>Pilih Jenis Layanan!</option>
                                <option value="karantina">Karantina</option>
                                <option value="mutu">Mutu</option>
                                <option value="cs">Customer Service</option>
                            </select>
                        </div>
                        <div class="text-center mb-5 mt-4"> <button type="submit" class="btn btn-primary">Submit</button> <button type="reset" class="btn btn-secondary">Reset</button></div>
                    </form>
                </div>
            </div> 
        </div>
        <div class="row">
            <div class="card col-md-12 mt-2">
                <div class="card-body">
                     <h5 class="card-title">Daftar Antrian Anda</h5>
                     <table class="table table-bordered">
                        <thead>
                           <tr class="text-center">
                              <th scope="col">No</th>
                              <th scope="col">No Antrian</th>
                              <th scope="col">No PPK</th>
                              <th scope="col">Waktu Antri</th>
                              <th scope="col">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                            @php($no=1)
                            @foreach ($antrianku as $item)
                           <tr>
                              <th scope="row" class="text-center">{{ $no++ }}</th>
                              <td>{{ $item->no_antrian }}</td>
                              <td>{{ $item->no_ppk }}</td>
                              <td>{{ $item->tanggal_antrian }}</td>
                              <td class="text-center">
                                <a class="btn btn-success" style="border-radius: 100px;" a href="{{ route('cetakAntrian', ['no_ppk' => $item->no_ppk]) }}"><i class="bi bi-printer"></i></a>
                                <a class="btn btn-warning" style="border-radius: 100px;" a href="{{ route('editAntrian', ['no_ppk' => $item->no_ppk]) }}"><i class="bi bi-pencil-square text-white"></i></a>
                                <a class="btn btn-danger" style="border-radius: 100px;" onclick="return confirm('Apakah anda yakin?')" a href="{{ route('hapusAntrian', ['no_ppk' => $item->no_ppk]) }}"><i class="bi bi-trash"></i></a>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection