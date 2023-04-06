@extends('layouts.main')

@section('container')
<div class="pagetitle mt-3">
   <h1>Management User</h1>
   <nav>
   <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="/dashboard/admin">Home</a></li>
       <li class="breadcrumb-item active">Daftar User</li>
   </ol>
   <!-- Dropdown menu -->
      <div class="dropdown">
         <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
         Tambah Operator
         </a>
      
         <!-- Dropdown items -->
         <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
         <li><a class="dropdown-item" href="/tambahOperator/opk">Karantina</a></li>
         <li><a class="dropdown-item" href="/tambahOperator/opm">Mutu</a></li>
         <li><a class="dropdown-item" href="/tambahOperator/ocs">CS</a></li>
         </ul>
      </div>
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
                    <th scope="col">Action</th>
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
                      <td>
                        <a class="btn btn-warning" style="border-radius: 100px;" a href="{{ route('editUser', ['id' => base64_encode($item->id)]) }}"><i class="bi bi-pencil-square text-white"></i></a>
                        <a class="btn btn-danger" style="border-radius: 100px;" onclick="return confirm('Apakah anda yakin?')" a href="{{ route('hapusUser', ['id' => base64_encode($item->id)]) }}"><i class="bi bi-trash"></i></a>
                     </td>
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
                     <th scope="col">Action</th>
                     
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
                     <td>
                        <a class="btn btn-warning" style="border-radius: 100px;" a href="{{ route('editUser', ['id' => base64_encode($item->id)]) }}"><i class="bi bi-pencil-square text-white"></i></a>
                        <a class="btn btn-danger" style="border-radius: 100px;" onclick="return confirm('Apakah anda yakin?')" a href="{{ route('hapusUser', ['id' => base64_encode($item->id)]) }}"><i class="bi bi-trash"></i></a>
                     </td>
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
                     <th scope="col">Action</th>
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
                     <td>
                        <a class="btn btn-warning" style="border-radius: 100px;" a href="{{ route('editUser', ['id' => base64_encode($item->id)]) }}"><i class="bi bi-pencil-square text-white"></i></a>
                        <a class="btn btn-danger" style="border-radius: 100px;" onclick="return confirm('Apakah anda yakin?')" a href="{{ route('hapusUser', ['id' => base64_encode($item->id)]) }}"><i class="bi bi-trash"></i></a>
                     </td>
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
                     <th scope="col">Action</th>
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
                     <td>
                        <a class="btn btn-warning" style="border-radius: 100px;" a href="{{ route('editUser', ['id' => base64_encode($item->id)]) }}"><i class="bi bi-pencil-square text-white"></i></a>
                        <a class="btn btn-danger" style="border-radius: 100px;" onclick="return confirm('Apakah anda yakin?')" a href="{{ route('hapusUser', ['id' => base64_encode($item->id)]) }}"><i class="bi bi-trash"></i></a>
                     </td>
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