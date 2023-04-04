@extends('layouts.main')

@section('container')
<div class="pagetitle mt-3">
   <h1>Daftar Antrian Mutu</h1>
   <nav>
   <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="/dashboard/operator/mutu">Home</a></li>
       <li class="breadcrumb-item active">Daftar Antrian</li>
   </ol>
   </nav>
</div>

<style>
   .table-container {
     max-height: 200px;
     overflow-y: scroll;
   }
   
   table {
     width: 100%;
     border-collapse: collapse;
   }
   
   th, td {
     padding: 8px;
     text-align: left;
     border-bottom: 1px solid #ddd;
   }
   
   th {
     background-color: #c3c3c3;
     position: sticky;
     top: 0;
   }
   
   </style>


<div class="row">
    <div class="card col-md-12 mt-2 pb-4">
         <div class="card-body">
             <h5 class="card-title">Daftar Antrian</h5>
             <div class="table-container border">
             <table>
                <thead>
                   <tr>
                      <th scope="col">No</th>
                      <th scope="col">No Antrian</th>
                      <th scope="col">No PPK</th>
                      <th scope="col">Waktu Antri</th>
                      <th scope="col">Email</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                   </tr>
                </thead>
                
                <tbody>
                  @php($no=1)
                  @if(count($AntrianM) > 0)
                  @foreach($AntrianM as $item)
                   <tr>
                      <td scope="row">{{ $no++ }}</td>
                      <td>{{ $item->no_antrian }}</td>
                      <td>{{ $item->no_ppk }}</td>
                      <td>{{ $item->tanggal_antrian }}</td>
                      <td>{{ $item->email }}</td>
                      <td>{{ $item->status }}</td>
                      <td>
                        <a class="btn btn-primary" style="border-radius: 100px;" a href="{{ route('statusDiprosesM', ['id' => base64_encode($item->id)]) }}"><i class="bi bi-check-circle text-white"></i></a>
                        <a class="btn btn-warning" style="border-radius: 100px;" a href="{{ route('statusRecallM', ['id' => base64_encode($item->id)]) }}"><i class="bi bi-telephone-forward text-white"></i></a>
                        <a class="btn btn-danger" style="border-radius: 100px;" a href="{{ route('statusCancelM', ['id' => base64_encode($item->id)]) }}"><i class="bi bi-x-circle text-white"></i></a>
                      </td>
                   </tr>
                   @endforeach
                   @else
                   <tr>
                     <td colspan="6" class="text-center">Belum ada antrian</td>
                   </tr>
                   @endif
                </tbody>
             </table>
            </div>
         </div>
      </div>

      <div class="card col-md-12 mt-2 pb-4">
         <div class="card-body">
             <h5 class="card-title">Sudah Dilayani</h5>
             <div class="table-container border">
             <table>
                <thead>
                   <tr>
                      <th scope="col">No</th>
                      <th scope="col">No Antrian</th>
                      <th scope="col">No PPK</th>
                      <th scope="col">Waktu Antri</th>
                      <th scope="col">Email</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                   </tr>
                </thead>
                
                <tbody>
                  @php($no=1)
                  @if(count($SudahAntriM) > 0)
                  @foreach($SudahAntriM as $item)
                   <tr>
                      <td scope="row">{{ $no++ }}</td>
                      <td>{{ $item->no_antrian }}</td>
                      <td>{{ $item->no_ppk }}</td>
                      <td>{{ $item->tanggal_antrian }}</td>
                      <td>{{ $item->email }}</td>
                      <td>{{ $item->status }}</td>
                      <td>
                        <a class="btn btn-primary" style="border-radius: 100px;" a href="{{ route('statusDiprosesM', ['id' => base64_encode($item->id)]) }}"><i class="bi bi-check-circle text-white"></i></a>
                        <a class="btn btn-warning" style="border-radius: 100px;" a href="{{ route('statusRecallM', ['id' => base64_encode($item->id)]) }}"><i class="bi bi-telephone-forward text-white"></i></a>
                        <a class="btn btn-danger" style="border-radius: 100px;" a href="{{ route('statusCancelM', ['id' => base64_encode($item->id)]) }}"><i class="bi bi-x-circle text-white"></i></a>
                      </td>
                   </tr>
                   @endforeach
                   @else
                   <tr>
                     <td colspan="6" class="text-center">Belum ada yang dilayani</td>
                   </tr>
                   @endif
                </tbody>
             </table>
            </div>
         </div>
      </div>
</div>
@endsection