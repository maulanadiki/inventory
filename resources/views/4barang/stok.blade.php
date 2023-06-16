@section('title','Table Barang')

@extends('layout.layout')
@section('konten')
<div class="container-fluid">
    <div class="frame base-system">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a class="jdl fs-5" href="{{url('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item fs-5 text-light">Stok Barang</li>
                </ul>
            </nav>
        </div>

        <div class="col-md-12 p-3 border rounded-3 bg-light shadow">
            <table id="stok" class="table table-striped" style="width:100%">
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
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready( function () {
    $('#stok').DataTable();
} );
</script>
@endsection