@section('title','Penerimaan Barang')

@extends('layout.layout')
@section('konten')
<?php 
use Carbon\Carbon; 
?>
<div class="container-fluid">
    <div class="frame base-system">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('home') }}" class="fs-5">Dashboard</a></li>
                    <li class="breadcrumb-item fs-5 active text-light ">Penerimaan Barang</li>
                </ul>
            </nav>
        </div>
        <div class="col-md-12 p-3 bg-light border rounded-3 shadow">
            <table id="example" class="table table-striped m-3" style="width:100%">
                <thead>
                    <tr align="center">
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
                    <?php
                            $a = Carbon::parse($hsl->created_at);
                            $tgl = $a->format('d-M-Y');
                            $hari = $a->format('D');

                            switch($hari){
                                case "Mon":
                                    $hari =  "Senin";
                                    break;
                                case "Tue":
                                    $hari =  "Selasa";
                                    break;
                                case "Wed":
                                    $hari =  "Rabu";
                                    break;
                                case "Thu":
                                    $hari =  "Kamis";
                                    break;
                                case "Fri":
                                    $hari =  "Jum'at";
                                    break;
                                case "Sat":
                                    $hari =  "Sabtu";
                                    break;
                                case "Sun":
                                    $hari =  "Minggu";
                                    break;
                                default:
                                $hari =  "error hari";
                            }
                        ?>

                    <form method="post" action="{{route('penerima',$hsl->nopo)}}">
                        @csrf
                        <tr align="center" id="cariprr" onClick="nilai('{{$hsl->bukti}}')">
                            <th style=" text-align:center;">{{$loop -> iteration}}</th>
                            <td>{{$tgl}}</td>
                            <td id="po">{{$hsl->nopo}}</td>
                            <td id="vname">{{$hsl->nama_vendor}}</td>
                            <td id="pengajuan">
                                @if($hsl->status_pengajuan === "Approved")
                                <span class="badge text-bg-success text-wrap"><i class="bi bi-check-circle"></i> {{$hsl->statpo}}<span>
                                        @elseif($hsl->status_pengajuan === "Pending")
                                        <span class="badge text-bg-warning text-wrap"><i class="bi bi-exclamation-circle"> </i> {{$hsl->statpo}}<span>
                                                @else
                                                <span class="badge text-bg-danger text-wrap"><i class="bi bi-x-circle"></i> {{$hsl->statpo}}<span>
                                                        @endif
                            </td>
                            <td>
                                @if($hsl->status_pengajuan==="Rejected")
                                <span class="badge text-bg-danger text-wrap"><i class="bi bi-x-circle"></i> Rejected</span>
                                @else

                                @if($hsl->statpay =="Pending")
                                <span class="badge text-bg-warning text-wrap"><i class="bi bi-exclamation-circle"> </i>{{$hsl->statpay}}</span>
                                @elseif ($hsl->statpay=="Done")
                                <span class="badge text-bg-success text-wrap"><i class="bi bi-check-circle"></i> {{$hsl->statpay}}</span>
                                @else
                                <span class="badge text-bg-danger text-wrap"><i class="bi bi-x-circle"></i> {{$hsl->statpay}}</span>
                                @endif

                                @endif
                            </td>
                            <td>
                                @if($hsl->statpo==="Rejected")
                                <span class="badge text-bg-danger text-wrap"><i class="bi bi-x-circle"></i> Rejected</span>
                                @else
                                @if($hsl->bukti_bayar =="Pending")
                                <span class="badge text-bg-warning text-wrap"><i class="bi bi-exclamation-circle"> </i> {{$hsl->statpr}}</span>
                                @else
                                @if ($hsl->statpr=="pending")
                                <a href="{{route('penerima.terima',$hsl->nopo) }}"
                                    class="btn btn-warning text-dark">{{$hsl->statpr}}</a>
                                @else
                                <span class="badge text-bg-success text-wrap"><i class="bi bi-check-circle"></i> {{$hsl->statpr}}</span>
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
                                    style="cursor: pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-card-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                        <path
                                            d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z" />
                                    </svg>
                                    Receipt</button>
                                @endif

                            </td>
                            </a>
                        </tr>
                    </form>@endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


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
    $('#example').DataTable();
});

function gmbr(bukti) {
    document.getElementById("bukti").src = "{{ asset('images/') }}/" + bukti;
};
</script>
@endsection