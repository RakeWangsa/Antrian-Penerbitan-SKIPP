@extends('layouts.main')

@section('container')
<div class="pagetitle mt-3">
   <h1>Daftar Antrian</h1>
   <nav>
   <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="/dashboard/operator/karantina">Home</a></li>
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
             <h5 class="card-title">Daftar Antrian Karantina</h5>
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
                   </tr>
                </thead>
                
                <tbody>
                  @php($no=1)
                  @if(count($antrianK) > 0)
                  @foreach($antrianK as $item)
                   <tr>
                      <td scope="row">{{ $no++ }}</td>
                      <td>{{ $item->no_antrian }}</td>
                      <td>{{ $item->no_ppk }}</td>
                      <td>{{ $item->tanggal_antrian }}</td>
                      <td>{{ $item->email }}</td>
                      <td>{{ $item->status }}</td>
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
             <h5 class="card-title">Daftar Antrian Mutu</h5>
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
                   </tr>
                </thead>
                
                <tbody>
                  @php($no=1)
                  @if(count($antrianM) > 0)
                  @foreach($antrianM as $item)
                   <tr>
                      <td scope="row">{{ $no++ }}</td>
                      <td>{{ $item->no_antrian }}</td>
                      <td>{{ $item->no_ppk }}</td>
                      <td>{{ $item->tanggal_antrian }}</td>
                      <td>{{ $item->email }}</td>
                      <td>{{ $item->status }}</td>
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
            <h5 class="card-title">Daftar Antrian CS</h5>
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
                  </tr>
               </thead>
               
               <tbody>
                 @php($no=1)
                 @if(count($antrianCS) > 0)
                 @foreach($antrianCS as $item)
                  <tr>
                     <td scope="row">{{ $no++ }}</td>
                     <td>{{ $item->no_antrian }}</td>
                     <td>{{ $item->no_ppk }}</td>
                     <td>{{ $item->tanggal_antrian }}</td>
                     <td>{{ $item->email }}</td>
                     <td>{{ $item->status }}</td>
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
</div>
@endsection