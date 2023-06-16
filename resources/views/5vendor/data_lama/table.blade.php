@section('title','Table Vendor')

@extends('layout.layout')
@section('konten')
<div class="container-fluid  mt-4 ms-2 pb-5 ps-1 pe-1 border shadow mb-3" style="background-color:#E8ECFC; border-radius:15px;" >
    <div class="row">
        <div class="col-md-5 ms-4 mt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ms-3">
                    <li class="breadcrumb-item"><a class="jdl fs-5" href="{{url('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a class="jdl text-secondary fs-5" href="#">Tabel Barang</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 ms-5 mb-2">
            <div class="col-md-12 d-flex justify-content-end mt-4">
                    <a href="{{route('vendor.buat') }}" class="btn btn-primary me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                        </svg>    
                    Vendor</a>           
            </div>
        </div>
        
    </div>
    <div class="row justify-content-center ">
        <div class="col-md-11 bg-light border rounded-3  mt-1 shadow">
            <br>
            <table id="table_vendor" class="table table-striped m-3" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Vendor</th>
                                <th>Nama</th>
                                <th>Pemilik</th>
                                <th>Telp</th>
                                <th>Bank</th>
                                <th>Alamat</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $vnd)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$vnd->kode_vendor}}</td>
                                <td>{{$vnd->nama_vendor}}</td>
                                <td>{{$vnd->nama_pemilik}}</td>
                                <td>{{$vnd->telp}}</td>
                                <td>{{$vnd->bank}}, {{$vnd->norek}}</td>
                                <td>{{$vnd->alamat}}</td>
                                <td>
                                    <a href="{{route('vendor.hapus', $vnd->id) }}" class="btn btn-danger"> <i class="bi bi-trash3"></i></a>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detail" onclick="tampil('{{$vnd->kode_vendor}}','{{$vnd->nik}}','{{$vnd->npwp}}','{{$vnd-> nama_pemilik}}','{{$vnd->nama_vendor}}','{{$vnd->telp}}','{{$vnd->alamat}}','{{$vnd->bank}}','{{$vnd->norek}}','{{$vnd->f_nik}}','{{$vnd->f_npwp}}','{{$vnd->f_tabungan}}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder2" viewBox="0 0 16 16">
                                            <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v7a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 12.5v-9zM2.5 3a.5.5 0 0 0-.5.5V6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5zM14 7H2v5.5a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5V7z"/>
                                        </svg>
                                    </button>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
            </table><br>
        </div>
    </div>
</div>

<!-- modal -->
<div class="modal fade" id="detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Data Detail Vendor</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#data">Information Detail</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#f_nik">Foto Nik</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#f_npwp">Foto NPWP</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#f_tabungan">Foto Tabungan</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active container" id="data">
                <div class="container-fluid">
                    <div class="col-md-10 mt-3 d-flex justify-content-center ms-5">
                        <div class="row border rounded-3 ms-2">
                            <div class="col-md-12 mt-3">
                                <b><p id="nama_vendor" class="fs-5 text-center m-0">a</p></b>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                
                            <table class="table">
                                <tbody id="database">
                                    <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">3</th>
                                    <td colspan="2">Larry the Bird</td>
                                    <td>@twitter</td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane container" id="f_nik">
                <img src="..." class="img-fluid" alt="Nomor Induk Kependudukan" id="fnik">
            </div>
            <div class="tab-pane container" id="f_npwp">
            <img src="..." class="img-fluid" id="fnpwp">
            </div>
            <div class="tab-pane container" id="f_tabungan">
            <img src="..." class="img-fluid" alt="Foto Tabungan" id="ftabungan">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function () {
    $('#table_vendor').DataTable();

    $(".nav-tabs a").click(function(){
    $(this).tab('show');
  });
});

function tampil(id,nik,npwp,n_pemilik,n_vendor,telp,alamat,bank,norek,f_nik,f_npwp,f_tabungan){
console.log(id,nik,npwp,n_pemilik,n_vendor,telp,alamat,bank,norek,f_nik,f_npwp,f_tabungan);

$("#nama_vendor").html(id+" - " +n_vendor)
document.getElementById("fnik").src = "{{asset('images') }}/"+f_nik;
document.getElementById("fnpwp").src = "{{asset('images') }}/"+f_npwp;
document.getElementById("ftabungan").src = "{{ asset('images/') }}/"+ f_tabungan;
const konten = "<tr>"+
                    "<th>Nik</th>"+
                    "<td> : "+ nik+"</td>"+
                    "<th>Npwp</th>"+
                    "<td> : "+npwp+"</td>"+
                "</tr>"+
                "<tr>"+
                    "<th>Pemilik</th>"+
                    "<td>: "+n_pemilik+"</td>"+
                    "<th>Telp</th>"+
                    "<td>: "+telp+"</td>"+
                "</tr>"+
                "<tr>"+
                "<th>Bank</th>"+
                "<td>: "+bank+"</td>"+
                "<th>Nomor Rekening</th>"+
                "<td>: "+norek+"</td>"+
                "</tr>"+
                "<tr>"+
                "<th>Alamat</th>"+
                "<td colspan='3' >: "+alamat+"</td>"+
                "</tr>";
                $("#database").html(konten);
            }


</script>
@endsection