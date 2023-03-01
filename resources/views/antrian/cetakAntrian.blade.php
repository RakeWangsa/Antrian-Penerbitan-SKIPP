<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
  <div class="container mt-4">
    <div class="card" style="border: 1px solid black">
      <div class="card-body">
        <h5 class="card-title" style="text-align: center">ANTRIAN</h5>
        <hr>
        <h6 class="card-subtitle mb-2 text-muted mt-4"style="text-align: center">Nomor Antrian</h6>
          <h1 style="text-align: center" >{{ $cetak[0]->no_antrian }}</h1>
          <h6 class="card-subtitle mb-2 text-muted mt-4"style="text-align: center">Nomor Pengajuan PPK</h6>
          <h1 style="text-align: center" >{{ $cetak[0]->no_ppk }}</h1>
          <h6 class="card-subtitle mb-2 text-muted mt-4"style="text-align: center">Jenis Layanan</h6>
          <h1 style="text-align: center" >{{ $cetak[0]->jenis_layanan }}</h1>
          <h6 class="card-subtitle mb-2 text-muted mt-4"style="text-align: center">Tanggal Antrian</h6>
          <h1 style="text-align: center" >{{ $cetak[0]->tanggal_antrian }}</h1>
        <hr>
        <div class="card-footer">
            <h6 style="text-align: center">"Terima Kasih Atas Kunjungan Anda"</h6>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script type="text/javascript">
    window.print();
  </script>
</body>
</html>