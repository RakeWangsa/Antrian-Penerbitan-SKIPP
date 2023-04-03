@extends('layouts.main')

@section('container')
    <div class="pagetitle mt-3">
        <h1>Dashboard</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Dashboard Operator</li>
        </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-xxl-3 col-md-3">
            <div class="card info-card ja-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                       <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-people" style="color: #4154f1; font-size: 70px;"></i></div>
                       <div class="ps-4 mt-4 mb-4">
                          <h5 style="color: #4154f1; font-weight: 700; font-size: 30px;">{{ $jumlahM }}</h5>
                          <span class="small pt-1 fw-bold">Jumlah Antrian</span>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-md-3">
            <div class="card info-card as-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                       <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-person-check" style="color: #2eca6a; font-size: 70px;"></i></div>
                       <div class="ps-4 mt-4 mb-4">
                        @if(isset($panggilM)) <h5 style="color: #2eca6a; font-weight: 700; font-size: 30px;">{{ $panggilM }}</h5>
                        @else <h5 style="color: #2eca6a; font-weight: 700; font-size: 30px;">-</h5> @endif
                          <span class="small pt-1 fw-bold">Antrian Sekarang</span>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-md-3">
            <div class="card info-card asl-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                       <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-person-plus" style="color: #ff771d; font-size: 70px;"></i></div>
                       <div class="ps-4 mt-4 mb-4">
                        @if(isset($nextantriM)) <h5 style="color: #ff771d; font-weight: 700; font-size: 30px;">{{ $nextantriM }}</h5>
                        @else <h5 style="color: #ff771d; font-weight: 700; font-size: 30px;">-</h5> @endif
                          <span class="small pt-1 fw-bold">Antrian Selanjutnya</span>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-md-3">
            <div class="card info-card sa-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                       <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-person" style="color: #eb3d34; font-size: 70px;"></i></div>
                       <div class="ps-4 mt-4 mb-4">
                          <h5 style="color: #eb3d34; font-weight: 700; font-size: 30px;">{{ $sisaM }}</h5>
                          <span class="small fw-bold">Sisa Antrian</span>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-12 col-md-12">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Panggil Antrian</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">No Antrian</th>
                            <th scope="col" class="text-center">Panggil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="text-align: center">
                            @if(isset($panggilM))
                                <td>{{ $panggilM }}</td>
                                <td>
                                    <button class="btn btn-success" style="border-radius: 100px;" onclick="playAudio('{{ $panggilM }}')"><i class="bi bi-telephone"></i></button>
                                    <audio id="myAudio_{{ $panggilM }}">
                                    <source src="{{ asset('audio/'.$panggilM.'.mp3') }}" type="audio/mpeg">
                                    </audio>
                                    <script>
                                    function playAudio(panggil) {
                                        var audio = document.getElementById("myAudio_" + panggil);
                                        audio.currentTime = 0; // untuk memulai ulang audio dari awal
                                        audio.play();
                                    }
                                    </script>
                                    <a class="btn btn-warning" style="border-radius: 100px;" a href="#"><i class="bi bi-telephone-plus"></i></a>
                                </td>
                                @else
                                <td>Tidak ada antrian</td>
                                <td></td>
                            @endif
                        </tr>
                        @foreach ($antrisisaM as $item)
                        <tr style="text-align: center">
                                <td>{{ $item->no_antrian }}</td>
                                <td>
                                    <button class="btn btn-success" style="border-radius: 100px;" onclick="playAudio('{{ $item->no_antrian }}')"><i class="bi bi-telephone"></i></button>
                                    <audio id="myAudio_{{ $item->no_antrian }}">
                                    <source src="{{ asset('audio/'.$item->no_antrian.'.mp3') }}" type="audio/mpeg">
                                    </audio>
                                    <script>
                                    function playAudio(panggil) {
                                        var audio = document.getElementById("myAudio_" + panggil);
                                        audio.currentTime = 0; // untuk memulai ulang audio dari awal
                                        audio.play();
                                    }
                                    </script>
                                    <a class="btn btn-warning" style="border-radius: 100px;" a href="#"><i class="bi bi-telephone-plus"></i></a>
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection