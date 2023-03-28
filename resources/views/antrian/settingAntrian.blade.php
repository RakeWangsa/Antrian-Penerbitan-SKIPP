@extends('layouts.main')

@section('container')
    <div class="pagetitle mt-3">
        <h1>Setting</h1>
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Setting</a></li>
            <li class="breadcrumb-item active">Setting</li>
        </ol>
        </nav>
    </div>

    <div class="card info-card ja-card pt-4 pb-4">
        <div class="card-body">
    <form>
    <div class="row">
        <div class="col-xxl-4 col-md-3">
            <div class="card info-card ja-card border">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                       <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-hourglass-split" style="color: #4154f1; font-size: 70px;"></i></div>
                       <div class="ps-4 mt-4 mb-4">
                          <h5 style="color: #4154f1; font-weight: 700; font-size: 30px;">Karantina</h5>
                          <span class="small pt-1 fw-bold">Jeda Antrian : </span>
                          <div class="d-flex align-items-center mt-1">
                            <input type="number" class="form-control me-2" id="jedaK" name="jedaK" value="" required>
                            <span class="small fw-bold">Menit</span>
                          </div>
                          
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-md-3">
            <div class="card info-card as-card border">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                       <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-hourglass-split" style="color: #2eca6a; font-size: 70px;"></i></div>
                       <div class="ps-4 mt-4 mb-4">
                          <h5 style="color: #2eca6a; font-weight: 700; font-size: 30px;">Mutu</h5>
                          <span class="small pt-1 fw-bold">Jeda Antrian : </span>
                          <div class="d-flex align-items-center mt-1">
                            <input type="number" class="form-control me-2" required>
                            <span class="small fw-bold">Menit</span>
                          </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-md-3">
            <div class="card info-card asl-card border">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                       <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-hourglass-split" style="color: #ff771d; font-size: 70px;"></i></div>
                       <div class="ps-4 mt-4 mb-4">
                          <h5 style="color: #ff771d; font-weight: 700; font-size: 30px;">CS</h5>
                          <span class="small pt-1 fw-bold">Jeda Antrian : </span>
                          <div class="d-flex align-items-center mt-1">
                            <input type="number" class="form-control me-2" required>
                            <span class="small fw-bold">Menit</span>
                          </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
    </div>
</div>

@endsection