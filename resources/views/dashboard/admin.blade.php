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
        <h4>Karantina</h4>
        <div class="col-xxl-3 col-md-3">
            <div class="card info-card ja-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                       <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-people" style="color: #4154f1; font-size: 70px;"></i></div>
                       <div class="ps-4 mt-4 mb-4">
                          <h5 style="color: #4154f1; font-weight: 700; font-size: 30px;">{{ $jumlahK }}</h5>
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
                        @if(isset($panggilK)) <h5 style="color: #2eca6a; font-weight: 700; font-size: 30px;">{{ $panggilK }}</h5>
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
                        @if(isset($nextantriK)) <h5 style="color: #ff771d; font-weight: 700; font-size: 30px;">{{ $nextantriK }}</h5>
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
                          <h5 style="color: #eb3d34; font-weight: 700; font-size: 30px;">{{ $sisaK }}</h5>
                          <span class="small fw-bold">Sisa Antrian</span>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <h4>Mutu</h4>
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
        <h4>Customer Service</h4>
        <div class="col-xxl-3 col-md-3">
            <div class="card info-card ja-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                       <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-people" style="color: #4154f1; font-size: 70px;"></i></div>
                       <div class="ps-4 mt-4 mb-4">
                          <h5 style="color: #4154f1; font-weight: 700; font-size: 30px;">{{ $jumlahCS }}</h5>
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
                        @if(isset($panggilCS)) <h5 style="color: #2eca6a; font-weight: 700; font-size: 30px;">{{ $panggilCS }}</h5>
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
                        @if(isset($nextantriCS)) <h5 style="color: #ff771d; font-weight: 700; font-size: 30px;">{{ $nextantriCS }}</h5>
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
                          <h5 style="color: #eb3d34; font-weight: 700; font-size: 30px;">{{ $sisaCS }}</h5>
                          <span class="small fw-bold">Sisa Antrian</span>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
@endsection