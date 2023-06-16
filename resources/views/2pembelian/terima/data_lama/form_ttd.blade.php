@section('title','Form Tanda Terima')

@extends('layout.layout')
@section('konten')
<div class="row mt-3">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-9 mt-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ms-5">
                        <li class="breadcrumb-item"><a href="{{url('home') }}"  class="fs-5 jdl " >Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/penerimaan') }}"  class="fs-5 jdl " >Penerima Barang</a></li>
                        <li class="breadcrumb-item fs-5 active">Form Penerimaan Barang</li>
                    </ol>
                </nav>
            </div>
        <div class="col-md-3 mb-3 mt-3"><div class="align-self-end align-content-end text-end "><form method="get" action="{{ route('tandaterima', $cek->nopo ) }}" target="_blank">@csrf  <button class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Tanda Terima</button></div></form>
        </div>
    </div>
</div>
<div class="row justify-content-center" >
<div class="col-md-11 bg-white" style="border:4px solid #dee2e6; box-shadow: 5px 5px 10px #dee2e6; border-radius:15px;">
    <div class="col-md-12 d-flex justify-content-center mt-3">
        <div class="col-md-11" style="background-color:#E8ECFC; border:3px solid #dee2e6; border-radius:15px;">
            <section id="header">
                <div class="conteiner">
                    <div class="row justify-content-center ">
                        <div class="col-md-6">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                <th> Nomor PO </th>
                                <td>: {{$cek->nopo}}</td>
                                </tr>
                                <tr>
                                <th>Nama Vendor </th>
                                <td>: {{$cek->nama_vendor}}</td>
                                </tr>
                                <tr>
                                <th >Tanggal</th>
                                <td>: {{$cek ->created_at}}</td>
                                </tr>
                                <tr>
                                <th >Bukti</th>
                                <td>: <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onClick="gmbr('{{$cek->bukti_bayar}}')">
                                                <i class="fa fa-file-image-o" aria-hidden="true"></i> Bukti</button></td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    
                    </div>
                </div>
            </section>
        </div>
    </div>


    <div class="col-md-12 d-flex justify-content-center mt-3 mb-3">
        <div class="col-md-11" style="background-color:#E8ECFC; border:3px solid #dee2e6; border-radius:15px;">
            <form method="post" action="{{ route('prrc', $cek->nopo ) }}" enctype="multipart/form-data">
                @csrf
                <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col" id="Nopo">Nomor PO</th>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Warna</th>
                        <th scope="col">Ukuran</th>
                        <th scope="col">QTY</th>
                        <th scope="col">Harga satuan</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($data as $data)
                            <tr>
                                <td scope="row" id="no">{{$loop->iteration}}</td>
                                <td id="nomop">{{$data->nopo}}</td>
                                <td id="kbarang">
                                @foreach( $st as $stok)
                                @if($data->kode_barang == $stok->kode_barang)
                                {{$stok->kode_barang}}
                                @php
                                $hasil = $stok->kuantitas + $data->qty;
                                @endphp
                                <input type="hidden" name="kobar[]" value="{{$stok->kode_barang}}">
                                <input type="hidden" name="qty[]" value="{{ $hasil }}">
                                @endif

                            @endforeach



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

                            <tr class="table-light">
                                <th colspan="8">Grandtotal</th>

                                <th align="center">Rp. {{number_format( $cek->grandtotal )}} </th>
                            </tr>

                            <tr>
                                <th colspan="5"> Upload Tanda Terima</th>
                                <th colspan="4"><input type="file" class="form-control" id="inputGroupFile04" accept="image/png, image/gif, image/jpeg" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="foto" required></th>
                                <input type="hidden" name="status" value="Recieved">
                                <input type="hidden" name="total" value="">
                            </tr>
                </tbody>
                </table>    
                <button type="submit" class="btn btn-primary mb-3 ms-3" name="submit"> <i class="fa fa-floppy-o" aria-hidden="true"></i> Terima</button>
            </form>
            </div>

            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <img src="" alt="" id="bukti" width="460" height="600">
                                </div>
                                
                                </div>
                            </div>
        </div>
    </div>
</div>
</div>
<script>
    function gmbr(bukti) {
    document.getElementById("bukti").src ="{{ asset('images/') }}/" + bukti;
};
</script>
@endsection
