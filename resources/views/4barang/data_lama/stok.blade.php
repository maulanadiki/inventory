@section('title','Table Barang')

@extends('layout.layout')
@section('konten')
<div class="container-fluid mt-4 ms-2 pb-5 ps-1 pe-1 border shadow" style="background-color:#E8ECFC; border-radius:15px;" >
    <div class="row">
        <div class="col-md-6 mt-3 ms-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ms-3">
                    <li class="breadcrumb-item"><a class="jdl fs-5" href="{{url('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a class="jdl text-secondary fs-5">Stok Barang</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row justify-content-center ">
        <div class="col-md-11 bg-light border rounded-3  mt-1 shadow">
            <br>
            <table id="stok" class="table table-striped m-3" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Barang</th>
                                <th>Nama</th>
                                <th>Warna</th>
                                <th>Ukuran</th>
                                <th>Beli</th>
                                <th>Kuantitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $br)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$br->kode_barang}}</td>
                                <td>{{$br->nama_barang}}</td>
                                <td>{{$br->warna}}</td>
                                <td>{{$br->ukuran}}</td>
                                <td>Rp. {{number_format($br->beli)}}</td>
                                <td>{{$br->kuantitas}}</td>
                            </tr>
                            @endforeach
                        </tbody>
            </table><br>
        </div>
    </div>
</div>

<script>
    $(document).ready( function () {
    $('#stok').DataTable();
} );
</script>
@endsection