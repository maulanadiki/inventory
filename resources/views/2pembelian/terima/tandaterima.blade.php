<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Delivery Order</title>
    <link href="{{asset('/1plugin/bootstraps5.3/css/bootstrap.min.css') }}" rel="stylesheet" text="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('/sendiri/style.css') }}">
    <!-- datatable -->
    <link rel="stylesheet" href="{{asset('/1plugin/DataTables /datatables.css') }}">
    <link rel="stylesheet" href="{{asset('/1plugin/DataTables /datatables.min.css') }}">
    <!-- summornote -->
    <link rel="stylesheet" href="{{asset('/1plugin/summernote/summernote-bs4.min.css') }}">
    <!-- <script src="{{asset('/1plugin/summernote/summernote-bs4.min.js') }}" type="text/javascript" ></script> -->
    
    
    
    <!-- jquery -->
    <script src="{{asset('/1plugin/jquery-3.6.3.min.js')}}" type="text/javascript"></script>
    <!-- versi 4nya -->
    <link rel="stylesheet" href="{{asset('/fontawesome-free/css/all.css') }}">


<style rel="stylesheet" type="text/css">
.table1 {
    font-family: sans-serif;
    color: #444;
    border-collapse: collapse;
    width: 50%;
    border: 1px solid #f2f5f7;
}
 
.table1 tr td{
   
    border:1px solid #b0b3b5;
    font-weight: normal;
}
 
.table1, th, td {
    padding: 4px 10px;
    text-align: center;
}
.warna{
    background: #35A9DB;
}
table{
    font-size:12px;
}
    </style>
</head>

<body>
<div class="container-fluid">
    <div class="col-md-6 border border-3 rounded-3">
        <table class="table table-borderless">
            <thead>
            <tr>
                    <th>Nomor PO</th>
                    <th>:</th>
                    <td align="left"> {{$cek->nopo}} </td>
                    <th>Nama Vendor</th>
                    <th>:</th>
                    <td align="left">{{$cek->nama_vendor}}</td>
                </tr>
            </thead>
            <tbody>
            <tr>
                    <th>Tgl Bayar</th>
                    <th>:</th>
                    <td align="left">{{$beli ->updated_at}}</td>
                    <th>Tgl Diterima</th>
                    <th>:</th>
                    <td align="left"><?php  echo date("Y-m-d "); ?></td>
                </tr>
            </tbody>
        </table>
        <table class="table">
            <thead class="warna">
                <tr >
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>warna</th>
                    <th>Ukuran</th>
                    <th>QTY</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $data)
                <tr align="center">
                    <td id="no">{{$loop->iteration}}</td>
                    <td id="kbarang">
                    @foreach( $st as $stok)
                    @if($data->kode_barang == $stok->kode_barang)
                    {{$stok->kode_barang}}
                    @php
                    $hasil = $stok->kuantitas + $data->qty;
                    @endphp
                    @endif @endforeach
                    </td>
                    <td id="nabar">{{$data->nama_barang}}</td>
                    <td id="warna">{{$data->warna}}</td>
                    <td id="ukuran">{{$data->ukuran}}</td>
                    
                    <td id="qty">{{$data->qty}}</td>
                    <td id="harga">Rp. {{number_format($data->harga_beli,0,'','.')}}</td>
                    @php
                    @
                    @$subtotal = $data->harga_beli * $data->qty;
                    @endphp
                    <td id="Subtotal">Rp.{{number_format($subtotal,0,'','.')}}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="6">Subtotal</th>
                    <th align="center" colspan="2">Rp. {{number_format( $cek->grandtotal )}} </th>
                </tr>
            </tbody>
        </table>
        <table class="table table-borderless" id="TTD">
            <tr>
            <th><h6>Pengirim</h6></th>
            <th><h6>Penerima</h6></th>
            </tr>
            <tr><td><br><br><br></td></tr>
            <tr>
            <th><h6>(_____________)</h6></th>
            <th><h6>( <u>{{auth()->user()->name}}  <u>  )</h6></th>
            </tr>
        </table>
    </div>

</div>
    <script>
         window.addEventListener("load", window.print());
    </script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>
</html>