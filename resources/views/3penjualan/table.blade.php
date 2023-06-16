@section('title','Data Pembelian')

@extends('layout.layout')
@section('konten')
<div class="container-fluid">
    <div class="frame base-system">
        <div class="row">
            <div class="col-md-4">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('home') }}" class="fs-5 ">Dashboard</a></li>
                        <li class="breadcrumb-item text-light active fs-5">Data Penjualan</li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-8 text-end">
                <a href="{{route('penjualan.buat') }}" onclick="deletesession()" class="btn btn-primary ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                    </svg>
                    Buat Penjualan</a>
            </div>

            <div class="col-md-12 p-3 bg-light border rounded-3 shadow">
                <table class="table table-hover table-striped" id="penjualan">
                    <thead>
                        <tr align="center">
                            <th class="col" style="text-align:center;">No.</th>
                            <th class="col" style="text-align:center;">Tgl Dibuat</th>
                            <th class="col" style="text-align:center;">Invoice</th>
                            <th class="col" style="text-align:center;">Customer</th>
                            <th class="col" style="text-align:center;">grandtotal</th>
                            <th class="col" style="text-align:center;">Barang Keluar</th>
                            <th class="col" style="text-align:center;">Resi Pengiriman</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach($csm as $data)
                        <tr style="cursor: pointer;" align="center" style="cursor: pointer;"
                            onclick="nilai('{{$data->invoice }}','{{$data-> nama_pelanggan}}','{{$data->alamat_pelanggan }}','{{$data-> telp}}','{{$data-> tgl_jual}}','{{$data->market_place }}','{{$data->grandtotal }}','{{$data->email }}','{{$data->bukti_pembelian}}')">
                            <th style=" text-align:center;" data-bs-toggle="modal" data-bs-target="#detailsell">
                                {{$loop->iteration}}</th>
                            <td data-bs-toggle="modal" data-bs-target="#detailsell">{{$data->created_at}}</td>
                            <td id="inv" data-bs-toggle="modal" data-bs-target="#detailsell">{{$data->invoice}}</td>
                            <td id="cust" data-bs-toggle="modal" data-bs-target="#detailsell">{{$data->nama_pelanggan}}
                            </td>
                            <td id="grandtotal" data-bs-toggle="modal" data-bs-target="#detailsell">Rp.
                                {{  number_format($data->grandtotal) }}</td>
                            <td> @if(auth()->user()->level== 1 || auth()->user()->level== 2 )
                                @if ( $data->stat_keluar == "Pending" )
                                <form method="get"
                                    action="{{ route('penjualan.barang_keluar',['Approved',$data->invoice])}}">
                                    @csrf
                                    <div class="dropdown">
                                        <button class="btn btn-warning text-dark dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            PENDING
                                        </button>

                                        <ul class="dropdown-menu">
                                            <li>
                                                @foreach( $kobar as $kb)
                                                @if($data->invoice == $kb->invoice)

                                                @php
                                                $hasil = $kb->kuantitas - $kb->qty;
                                                @endphp
                                                <input type="hidden" name="kobar[]" value="{{$kb->kode_barang}}">
                                                <input type="hidden" name="qty[]" value="{{ $hasil }}">
                                                @endif

                                                @endforeach
                                                <button class="dropdown-item" type="submit"> Approved</button>
                                            </li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('penjualan.barang_keluar', ['Rejected',$data->invoice])}}">Rejected</a>
                                            </li>
                                        </ul>

                                    </div>
                                </form>
                                @elseif($data->stat_keluar == "Approved" )
                                <button type="button" class="btn btn-success" disabled>{{$data->stat_keluar}}</button>

                                @else
                                <button type="button" class="btn btn-danger" disabled>{{$data->stat_keluar}}</button>
                                @endif
                                @else
                                @if ( $data->stat_keluar == "Pending" )
                                <button type="button" class="btn btn-secondary" disabled>Menunggu Persetujuan</button>
                                @elseif($data->stat_keluar == "Approved")
                                <button type="button" class="btn btn-success" disabled>{{$data->stat_keluar}}</button>
                                @else
                                <div class="dropdown">
                                    <button class="btn btn-danger dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{$data->stat_keluar}}
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item"
                                                href="{{ route('penjualan.barang_keluar.hapus', $data->invoice ) }}">Hapus</a>
                                        </li>
                                    </ul>
                                </div>
                                @endif
                                @endif


                            </td>
                            <td>
                                @if($data->stat_keluar == "Approved")
                                @if( $data->stat_sell == "Pending")
                                <button class="btn btn-warning text-dark" data-bs-toggle="modal"
                                    data-bs-target="#uploadresi" onclick="upload('{{$data->invoice}}')">Upload
                                    Resi</button>
                                @elseif ($data->stat_sell == "Approved")
                                <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#buktiresi"
                                    onClick="resi('{{$data->bukti_resi }}') ">Cek Resi</a>
                                @else
                                <a class="btn btn-danger" disabled>Rejected</a>
                                @endif



                                @elseif ($data->stat_keluar=="Pending")
                                <button type="button" class="btn btn-warning" disabled>Waiting</button>
                                @else
                                <button type="button" class="btn btn-danger" disabled> Rejected </button>
                                @endif

                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>







    </div>
</div>


<!-- modal upload resi -->
<div class="modal fade" id="uploadresi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('penjualan.simpan_resi')}}" enctype="multipart/form-data" method="post">
            @csrf
            <div id="hasilnya"></div>
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="uploadres">Upload Resi</h1>
                    <input type="hidden" name="id" id="invnya">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body1">

                    <input class="form-control mt-3" type="file" id="formFile" name="resi"
                        accept="image/png, image/gif, image/jpeg" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mb-3" style="width: 110px;"> <i class="fa fa-floppy-o"
                            aria-hidden="true"></i> Simpan</button>
                </div>

            </div>
        </form>
    </div>
</div>

<!-- modal detail -->
<div class="modal fade" id="detailsell" height="300" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nomor Invoice : xxx</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2 ">
                        <p class="lh-base">Nama Cust.<br>
                            Telp<br>
                            Alamat<br></p>

                    </div>
                    <div class="col-md-4">
                        <p class="lh-base" id="bagkiri"> isi datanya </p>
                    </div>
                    <div class="col-md-2">
                        <p class="lh-base">Tgl Jual<br>
                            Penjualan<br>
                            Dibuat<br></p>
                    </div>
                    <div class="col-md-4">
                        <p class="lh-base" id="bagkanan">isi datanyaa</p>
                    </div>
                </div>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home">Detail</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1">Bukti Penjualan</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active container" id="home">
                        <table class="table table-striped">
                            <thead>
                                <tr class="table-primary">
                                    <th scope="col">No</th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Warna</th>
                                    <th scope="col">Ukuran</th>
                                    <th scope="col">Pembelian</th>
                                    <th scope="col">Penjualan</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="detailbeli">
                                <tr>
                                    <td scope="col" id="no">No</th>
                                    <td scope="col" id="kobar"></td>
                                    <td scope="col" id="nabar"></td>
                                    <td scope="col" id="warna"></td>
                                    <td scope="col" id="ukuran"></td>
                                    <td scope="col" id="beli"></td>
                                    <td scope="col" id="jual"></td>
                                    <td scope="col" id="qty"></td>
                                    <td scope="col" id="subtotal"></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane container" id="menu1"><img src="" class="d-block" width=1100px height=500px
                            id="bukti" align=center></div>
                </div>






            </div>



            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<!-- bukti resi -->
<div class="modal fade" id="buktiresi" height="300" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Resi Pengiriman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="" class="d-block" width=1100px height=500px id="resi" align=center>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
    $('#penjualan').DataTable();
});

function resi(invoice){
    document.getElementById("resi").src ="{{ asset('images/') }}/" + invoice;
// console.log(invoice);
}

function nilai(invoice,nama_pelanggan,alamat_pelanggan,telp,tgl_jual,market_place,grandtotal,email,bukti_pembelian){
    document.getElementById("staticBackdropLabel").innerHTML ="Nomor Invoice : " + invoice;
    document.getElementById("bagkiri").innerHTML =" : " + nama_pelanggan+" <br> : " + telp + " <br> : " + alamat_pelanggan;
    document.getElementById("bagkanan").innerHTML =" : "+ tgl_jual +"<br> : " +market_place + "<br> : " + email ;
    document.getElementById("bukti").src ="{{ asset('images/') }}/" + bukti_pembelian;
    $value = invoice;
    var $rph = (number)=>{
                return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
                }).format(number);
            }
    $.ajax({
    type:"get",
    url : "{{URL::to("/cselling")}}",
    dataType : "json",
    data : {"search":$value},
    success:function(res)
        {
            var nomor = 1;
            var isi = '';
            $.each(res.data,function(index,brg){
            isi += '<tr>'+
            '<td>' + nomor++ +'</td>'+
            '<td>' + brg.kode_barang +'</td>'+
            '<td>' + brg.nama_barang +'</td>'+
            '<td>' + brg.warna +'</td>'+
            '<td>' + brg.ukuran +'</td>'+
            '<td>' + $rph(brg.beli) +'</td>'+
            '<td>' + $rph(brg.jual) +'</td>'+
            '<td>' + brg.qty +'</td>'+
            '<td>' + $rph(brg.subtotal) +'</td></tr>'
            });
            
            const $rupiah = (number)=>{
                return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
                }).format(number);
            }
        
        $baris = "<tr class='table-dark'><th colspan='7' align='center'>GrandTotal</th><th colspan='2' align='center'> "+ $rupiah(grandtotal) +"</th></tr>";
        $("#detailbeli").html(isi + $baris);
       
        }

    });
    
   
} 

$('.nav-tabs a').click(function(){
  $(this).tab('show');
});

function deletesession(){
    sessionStorage.clear();
}

function upload(inv){
    $("#invnya").val(inv);
}
</script>
@endsection