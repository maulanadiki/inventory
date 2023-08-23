@section('title','Data Pembelian')

@extends('layout.layout')
@section('konten')
<div class="container-fluid">
    <div class="frame base-system">
        <div class="row text-light">
            <div class="col-md-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('home') }}" class="fs-5" >Dashboard</a></li>
                        <li class="breadcrumb-item active fs-5 text-light">Data Pembelian</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-8 text-end">
                <a href="{{route('pembelian.buat') }}" onclick="deletesession()" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                    </svg>    
                    Buat Pembelian
                </a>
            </div>
        </div>

        <div class="row justify-content-center ">
        <div class="col-md-12 p-3 bg-light border rounded-3  mt-3 shadow">
            <table id="example" class="table table-striped m-3" style="width:100%">
                <thead>
                    <tr>
                        <th class="col">#</th>
                        <th class="col">Nomor PO</th>
                        <th class="col">Grandtotal</th>
                        <th class="col">Pengajuan</th>
                        <th class="col">Bayar</th>
                        <th class="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($procurment as $dt)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$dt->nopo}} </td>
                        <td>Rp. {{number_format($dt->grandtotal) }}</td>
                        <td>@if(auth()->user()->level== 1 || auth()->user()->level== 2 )
                                @if($dt->status_pengajuan == 'Rejected')
                                <div class="dropdown">
                                    <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-x-circle"></i>  Reject
                                    </button>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('barang.status',[$dt->nopo,'Approved']  ) }}"style="color:#186340;"><i class="bi bi-check-circle"></i> Approve</a></li>
                                    <li><a class="dropdown-item" href="{{route('barang.status',[$dt->nopo,'Pending']  ) }}" style="color:#bb6902;"><i class="bi bi-exclamation-circle"></i> Pending</a></li>
                                    </ul>
                                </div>  
                                @elseif($dt->status_pengajuan == 'Approved')
                                    @if($dt->bukti_bayar == 'Pending')
                                    <div class="dropdown">
                                        <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-check-circle"></i> Approve
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{route('barang.status',[$dt->nopo,'Pending']  ) }}"  style="color:#bb6902;"><i class="bi bi-exclamation-circle"></i> Pending</a></li>
                                            <li><a class="dropdown-item" href="{{route('barang.status',[$dt->nopo,'Rejected']  ) }}"style="color:#99182c;"> <i class="bi bi-x-circle"></i> Reject</a></li>
                                        </ul>
                                    </div>
                                    @else
                                    <button class="btn btn-success "  disabled="disabled"><i class="bi bi-check-circle"></i> Approved</button>
                                    @endif

                                
                                

                                @else
                                <div class="dropdown">
                                    <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-exclamation-circle"></i> Pending
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{route('barang.status',[$dt->nopo,'Approved']  ) }}" style="color:#186340;"><i class="bi bi-check-circle"></i> Approve</a></li>
                                        <li><a class="dropdown-item" href="{{route('barang.status',[$dt->nopo,'Rejected']  ) }}" style="color:#99182c;"> <i class="bi bi-x-circle"></i> Reject</a></li>
                                    </ul>
                                </div>  
                                @endif
                            
                                @else
                                    @if($dt->status_pengajuan == 'Approved')
                                    <button class="btn btn-success "  disabled="disabled"><i class="bi bi-check-circle"></i> Approved</button>
                                    @elseif($dt->status_pengajuan == 'Rejected')
                                        <div class="dropdown">
                                            <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-x-circle"></i> Reject
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item text-danger" href="{{ route('barang.pembelian.hapus', $dt->nopo ) }}"><i class="bi bi-trash3"></i> &nbsp;Hapus</a></li>
                                            </ul>
                                        </div>
                                    @else
                                    <button class="btn btn-warning"  disabled="disabled"><i class="bi bi-exclamation-circle"></i> pending</button>
                                    @endif
                                @endif                    
                        
                        </td>
                        <td>@if(auth()->user()->level== 1 || auth()->user()->level== 2 )
                        @if($dt->status_pengajuan == 'Approved')
                            @if($dt->status_bayar == 'Pending')
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" onclick="modal('{{$dt->nopo}}')" data-bs-target="#upload">
                                    <i class="bi bi-cloud-upload"></i> Upload File
                                </button>
                            @elseif($dt->status_bayar == 'Done')
                                <button disabled="disabled" class="btn btn-success" > <i class="bi bi-check-circle"></i> Done </button>
                            @else
                                <button disabled="disabled" class="btn btn-danger"><i class="bi bi-check-circle"></i> Reject </button>
                            @endif
                        @elseif ($dt->status_pengajuan == 'Rejected')
                        <button disabled="disabled" class="btn btn-danger"><i class="bi bi-x-circle"></i> Rejected</button>
                        @else
                        <button disabled="disabled" class="btn btn-secondary">Menunggu Approval</button>
                        @endif
                        @else
                            @if($dt->status_bayar == 'Done')
                            <button disabled="disabled" class="btn btn-success"><i class="bi bi-check-circle"></i> Sudah dibayarkan</button>
                            @else
                                <button disabled="disabled" class="btn btn-secondary">Menunggu Pembayaran</button>
                            @endif
                        
                        @endif
                        </td>
                        <td>
                            <button class="btn btn-primary" onclick="detail('{{$dt->nopo}}','{{$dt->Kode_vendor }}','{{$dt->nama_vendor }}','{{$dt->bank }}','{{$dt->norek }}','{{$dt->grandtotal }}','{{$dt->bukti_bayar}}','{{$dt->status_bayar }}','{{$dt->telp }}','{{$dt->dibuat }}')" data-bs-toggle="modal" data-bs-target="#detailvendor"><i class="bi bi-folder2-open"></i></button>

                        </td>
                    </tr>
                    @endforeach
            </table>
            <br>
        </div>
    </div>
    </div>
</div>

<!-- modalnya -->
<form action="{{route('barang.bayar') }}" method="post" enctype="multipart/form-data" >
    @csrf
    <div class="modal fade" id="upload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Bukti Transfer</h1>
            <input type="hidden" name="id" id="idnya">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="file" name="gambar" accept="image/*" id="" class="form-control" required>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
        </div>
        </div>
    </div>
    </div>
</form>



<!-- modal detail -->
<div class="modal fade" id="detailvendor" height="300" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="nopoj">Purchase Order Number : xxx</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home">Detail Pembelian</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu1">Bukti Bayar</a>
            </li>
            
        </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active container" id="home">
                    <div class="row">
                        <div class="col-md-2 ">
                        <p class="lh-base">Kode Vendor<br>
                            Nama Vendor<br>
                            Telpon<br></p>
                            
                        </div>
                        <div class="col-md-4">
                        <p class="lh-base" id="bagkiri"> isi datanya </p></div>
                        <div class="col-md-2">
                        <p class="lh-base">Tanggal Dibuat<br>
                            Bank<br>
                            Nomor Rekening<br></p>
                        </div>
                        <div class="col-md-4"><p class="lh-base" id="bagkanan">isi datanyaa</p></div>
                    </div>
                    <table class="table table-striped" width="100%" id="detailbeli" >
                        <thead>
                            <tr class="table-primary">
                                <th scope="col">No</th>
                                <th scope="col">Item Code</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Color</th>
                                <th scope="col">Size</th>
                                <th scope="col">Buying</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="hasil">
                            

                        </tbody>
                    </table>
                </div>

                <div class="tab-pane container" id="menu1"><img src=" " alt="..." id="bukti" style="hegiht: 100px;" width="600" height="600"></div>
            
            </div>


            
      </div>
      
    </div>
  </div>
</div>
<script>
    $(document).ready(function () {
    $('#example').DataTable();
});

function modal(id)
{
    $("#idnya").val(id);
}

function detail(nopo,kode_vendor, nama_vendor,bank, norek,grandtotal,bukti_bayar,status_bayar,telp,dibuat)
{
    // console.log(nopo,kode_vendor, nama_vendor,bank, norek,grandtotal,bukti_bayar,status_bayar,telp);
    $value = nopo;
    var $rupiah = (number)=>{
                return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
                }).format(number);
            }
    $.ajax({
        
            type: 'get',
             url:'{{URL::to('/detailbeli') }}',
            dataType: 'json',
            data: {'search': $value},
            success: function(res) 
            {
                var nomor = 1;
                var isi = '';
                $.each(res.data, function(index, brg) {
                isi += '<tr>' +
                    '<td>' + nomor++ +'</td>' +
                    '<td>' + brg.kode_barang + '</td>'+
                    '<td>' + brg.nama_barang + '</td>' +
                    '<td>' + brg.warna + '</td>' +
                    '<td>' + brg.ukuran + '</td>'+
                    '<td>'+$rupiah(brg.harga_beli)+'</td>'+
                    '<td>'+brg.qty+'</td>'+
                    '<td>'+$rupiah(brg.subtotal)+'</td>'+
                '</tr>';
            });
            
            

            // console.log(rupiah);
            $baris= '<tr><th colspan="6">GrandTotal </th><th colspan="2" align="center">' + $rupiah(grandtotal) + '</th></tr>';
                $("#hasil").html(isi + $baris);
            }
        });
        document.getElementById("nopoj").innerHTML = "Purchase Order Number : "+nopo;
    document.getElementById("bagkiri").innerHTML = " : " + kode_vendor + "<br> : " + nama_vendor + "<br> : " + telp;
    document.getElementById("bagkanan").innerHTML =" : " + dibuat + "<br> : " + bank + "<br> : " + norek;
    if(bukti_bayar == 'Pending')
    {
        document.getElementById("bukti").src ="{{ asset('images/notpay/not.jpg') }}";
    }
    else{document.getElementById("bukti").src ="{{ asset('images/') }}/" + bukti_bayar;}
}



// Select all tabs
$('.nav-tabs a').click(function(){
  $(this).tab('show');
});
function deletesession(){
    sessionStorage.clear();
}
</script>

@endsection