@extends('layouts.main')

@section('container')
<div class="pagetitle mt-3">
   <h1>Management User</h1>
   <nav>
   <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="/dashboard/admin">Home</a></li>
       <li class="breadcrumb-item active">Daftar User</li>
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
             <h5 class="card-title">Daftar Operator Karantina</h5>
             <div class="table-container border">
             <table>
                <thead>
                   <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                   </tr>
                </thead>
                
                <tbody>
                  @php($no=1)
                  @if(count($opk) > 0)
                  @foreach($opk as $item)
                   <tr>
                      <td scope="row">{{ $no++ }}</td>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->email }}</td>
                   </tr>
                   @endforeach
                   @else
                   <tr>
                     <td colspan="6" class="text-center">Tidak ada user</td>
                   </tr>
                   @endif
                </tbody>
             </table>
            </div>
         </div>
      </div>

      <div class="card col-md-12 mt-2 pb-4">
        <div class="card-body">
            <h5 class="card-title">Daftar Operator Mutu</h5>
            <div class="table-container border">
            <table>
               <thead>
                  <tr>
                     <th scope="col">No</th>
                     <th scope="col">Nama</th>
                     <th scope="col">Email</th>
                  </tr>
               </thead>
               
               <tbody>
                 @php($no=1)
                 @if(count($opm) > 0)
                 @foreach($opm as $item)
                  <tr>
                     <td scope="row">{{ $no++ }}</td>
                     <td>{{ $item->name }}</td>
                     <td>{{ $item->email }}</td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="6" class="text-center">Tidak ada user</td>
                  </tr>
                  @endif
               </tbody>
            </table>
           </div>
        </div>
     </div>

     <div class="card col-md-12 mt-2 pb-4">
        <div class="card-body">
            <h5 class="card-title">Daftar Operator CS</h5>
            <div class="table-container border">
            <table>
               <thead>
                  <tr>
                     <th scope="col">No</th>
                     <th scope="col">Nama</th>
                     <th scope="col">Email</th>
                  </tr>
               </thead>
               
               <tbody>
                 @php($no=1)
                 @if(count($ocs) > 0)
                 @foreach($ocs as $item)
                  <tr>
                     <td scope="row">{{ $no++ }}</td>
                     <td>{{ $item->name }}</td>
                     <td>{{ $item->email }}</td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="6" class="text-center">Tidak ada user</td>
                  </tr>
                  @endif
               </tbody>
            </table>
           </div>
        </div>
     </div>

     <div class="card col-md-12 mt-2 pb-4">
        <div class="card-body">
            <h5 class="card-title">Daftar Pengunjung</h5>
            <div class="table-container border">
            <table>
               <thead>
                  <tr>
                     <th scope="col">No</th>
                     <th scope="col">Nama</th>
                     <th scope="col">Email</th>
                  </tr>
               </thead>
               
               <tbody>
                 @php($no=1)
                 @if(count($pengunjung) > 0)
                 @foreach($pengunjung as $item)
                  <tr>
                     <td scope="row">{{ $no++ }}</td>
                     <td>{{ $item->name }}</td>
                     <td>{{ $item->email }}</td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="6" class="text-center">Tidak ada user</td>
                  </tr>
                  @endif
               </tbody>
            </table>
           </div>
        </div>
     </div>
</div>
@endsection