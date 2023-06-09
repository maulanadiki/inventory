@section('title','Penerimaan Barang')

@extends('layout.layout')
@section('konten')
<div class="container-fluid mt-4 ms-2 pb-5 ps-1 pe-1 border shadow"
    style="background-color:#E8ECFC; border-radius:15px;">
    <div class="row mt-3">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ms-5">
                    <li class="breadcrumb-item"><a href="{{url('home') }}" class="fs-5 jdl ">Dashboard</a></li>
                    <li class="breadcrumb-item fs-5 active">Penerimaan Barang</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center ">
        <div class="col-md-12 bg-light border rounded-3  mt-1 shadow">
            <br>
            <table class="table table-striped table-hover" id="table-pr">
                <thead>
                    <tr class="table-primary" align="center">
                        <th class="col" style="text-align:center;">No.</th>
                        <th class="col" style="text-align:center;">Tanggal Buat</th>
                        <th class="col" style="text-align:center;">Nomor PO</th>
                        <th class="col" style="text-align:center;">Nama Vendor</th>
                        <th class="col" style="text-align:center;">Pengajuan</th>
                        <th class="col" style="text-align:center;">Pembayaran</th>
                        <th class="col" style="text-align:center;">Penerimaan</th>
                        <th class="col" style="text-align:center;">Tanda Terima</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($group as $hsl)
                    <form method="post" action="{{route('penerima',$hsl->nopo)}}">
                        @csrf
                        <tr align="center" id="cariprr" onClick="nilai('{{$hsl->bukti}}')">
                            <th style=" text-align:center;">{{$loop -> iteration}}</th>
                            <td>{{$hsl->created_at}}</td>
                            <td id="po">{{$hsl->nopo}}</td>
                            <td id="vname">{{$hsl->nama_vendor}}</td>
                            <td id="pengajuan">
                                @if($hsl->status_pengajuan === "Approved")
                                <span class="badge text-bg-success text-wrap">{{$hsl->statpo}}<span>
                                        @elseif($hsl->status_pengajuan === "Pending")
                                        <span class="badge text-bg-warning text-wrap">{{$hsl->statpo}}<span>
                                                @else
                                                <span class="badge text-bg-danger text-wrap">{{$hsl->statpo}}<span>
                                                        @endif
                            </td>
                            <td>
                                @if($hsl->status_pengajuan==="Rejected")
                                <span class="badge text-bg-danger text-wrap">Reject</span>
                                @else

                                @if($hsl->statpay =="Pending")
                                <span class="badge text-bg-warning text-wrap">{{$hsl->statpay}}</span>
                                @elseif ($hsl->statpay=="Done")
                                <span class="badge text-bg-success text-wrap">{{$hsl->statpay}}</span>
                                @else
                                <span class="badge text-bg-danger text-wrap">{{$hsl->statpay}}</span>
                                @endif

                                @endif
                            </td>
                            <td>
                                @if($hsl->statpo==="Rejected")
                                <span class="badge text-bg-danger text-wrap">Reject</span>
                                @else
                                @if($hsl->bukti_bayar =="Pending")
                                <span class="badge text-bg-warning text-wrap">{{$hsl->statpr}}</span>
                                @else
                                @if ($hsl->statpr=="pending")
                                <a href="{{route('penerima.terima',$hsl->nopo) }}"
                                    class="btn btn-warning">{{$hsl->statpr}}</a>
                                @else
                                <span class="badge text-bg-success text-wrap">{{$hsl->statpr}}</span>
                                @endif
                                @endif
                                @endif


                            </td>
                            <td>
                                @if ($hsl->bukti=="None")
                                <button class="btn btn-secondary text-dark" disabled
                                    type="submit">{{$hsl->bukti}}</button>
                                @else
                                <button class="btn btn-success" type="button" data-bs-toggle="modal"
                                    data-bs-target="#receipt" onclick="gmbr('{{$hsl->bukti}}')"
                                    style="cursor: pointer;">Receipt</button>
                                @endif

                            </td>
                            </a>
                        </tr>
                    </form>@endforeach
                </tbody>
            </table><br>
        </div>
    </div>
</div>
<!-- modalnya -->
<div class="modal fade" id="receipt" height="300" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Receipt Delivery Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="gambar">
                <img src=" " alt="..." id="bukti" width="750" height="550" id="bukti">
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#table-pr').DataTable();
});

function gmbr(bukti) {
    document.getElementById("bukti").src = "{{ asset('images/') }}/" + bukti;
};
</script>
@endsection