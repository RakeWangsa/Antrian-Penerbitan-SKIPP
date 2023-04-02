<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.head')
    </head>
    <body>
        <header id="header" class="header fixed-top d-flex align-items-center">
            <marquee scrollamount="10" style="font-size: 35px; font-weight: 700;" >SELAMAT DATANG DI SISTEM ANTRIAN ONLINE</marquee>
        </header>
        <div class="row" style="margin-top: 130px; margin-left: 20px;">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-xxl-6 col-md-6">
                        <div class="card info-card no-card">
                            <div class="card-body3">
                                <h5 class="card-title text-center" style="font-size: 30px; font-weight: 400;">NOMOR ANTRIAN</h5>
                                @if(isset($call))<p class="text-center fw-bold" style="font-size: 100px; font-weight: 700;">{{$call->no_antrian}}</p>
                                @else <p class="text-center fw-bold" style="font-size: 30px; font-weight: 700;">Tidak ada antrian</p>@endif
                                <h5 class="card-title text-center" style="font-size: 30px; font-weight: 400;">@if(isset($call)) LOKET {{ strtoupper($call->jenis_layanan) }}@endif</h5>
                            </div>
                        </div>   
                    </div>
                    <div class="col-xxl-6 col-md-6">
                        <div class="card-body4">
                            <div class="d-flex align-items-center responsive-embed-youtube">
                                <iframe src="https://www.youtube.com/embed/brVjycsfvmY?controls=0" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card2 no-card">
                            <div class="card-body3">
                                <h5 class="card-title text-center">KARANTINA</h5>
                                <p class="text-center fw-bold">@if(isset($panggilK)){{$panggilK}}@else Tidak ada antrian @endif</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card2 no-card">
                            <div class="card-body3">
                                <h5 class="card-title text-center">MUTU</h5> 
                                <p class="text-center fw-bold">@if(isset($panggilM)){{$panggilM}}@else Tidak ada antrian @endif</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card2 no-card">
                            <div class="card-body3">
                                <h5 class="card-title text-center">CUSTOMER SERVICE</h5>
                                <p class="text-center fw-bold">@if(isset($panggilCS)){{$panggilCS}}@else Tidak ada antrian @endif</p> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <script>
            if (document.cookie.indexOf('reload') >= 0) {
                setTimeout(function() {
                    location.reload();
                }, 30000); //atur waktu sesuai keinginan Anda
            }
        </script>
    </body>
</html>