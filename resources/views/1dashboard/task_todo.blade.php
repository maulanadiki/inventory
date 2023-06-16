

@section('title','List Tugas')

@extends('layout.layout')
@section('konten')
<?php 
use Carbon\Carbon; 
?>
<div class="container-fluid">
    <div class="frame base-system shadow">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('home') }}" class="fs-5">Dashboard</a></li>
                    <li class="breadcrumb-item active fs-5 text-light">Pekerjaan Tertunda</li>
                </ul>
            </nav>
        </div>

        <div class="col-md-12 bg-light p-3">
            <div style="position:relative; display:flex; flex-direction:row; gap:20px; height:70vh;">
                <!-- pengajuan hari ini -->
                <div style="width:50%; overflow:auto;">
                    <h4>Pengajuan Hari ini</h4>

                    <?php 
                    $nilai = [];
                    $tglHariIni = date('Y-m-d');
                    foreach($beli as $no_po => $data){
                        foreach ($data as $i){
                            $nilai = $i[6];
                            break;
                        }
                    }
                    
                    ?>

                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Pembelian
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @foreach ($beli as $no_po => $data)
                                    @foreach($procurment as $pro)
                                    @if($pro->nopo == $no_po)
                                        @if($tglHariIni == $nilai)
                                            <div style="border:2px solid black; padding:2px; margin-bottom:5px;">
                                                <table class="table table-borderless">
                                                    <thead>
                                                        <tr>
                                                            <td colspan="4">Nomor PO : <b>{{$no_po}}</b> </td>
                                                            <td colspan="2" class="text-end">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-warning dropdown-toggle"
                                                                        type="button" data-bs-toggle="dropdown"
                                                                        aria-expanded="false">
                                                                        Pending
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a class="dropdown-item" href="{{route('barang.status',[$no_po,'Approved']  ) }}">Approved</a></li>
                                                                        <li><a class="dropdown-item" href="{{route('barang.status',[$no_po,'Rejected']  ) }}">Rejected</a></li>

                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4">
                                                            <?php
                                                                $uploadedDate = Carbon::parse($pro->created_at);
                                                                $currentDate = Carbon::now();
                                                                $selisih = $uploadedDate->diff($currentDate);
                                                                $selisihWaktu = $selisih->format('%d hari, %H jam, %i menit');
                                                            ?>
                                                            Dibuat Sejak : {{$selisih->format('%H Jam, %i menit')}}</td>
                                                        </tr>

                                                        <tr align="center">
                                                            <td class="col">#</td>
                                                            <td class="col">Kode Barang</td>
                                                            <td class="col">Nama Barang</td>
                                                            <td class="col">Ukuran</td>
                                                            <td class="col">QTY</td>
                                                            <td class="col">Subtotal</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data as $item)
                                                        <tr class="text-center">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $item[0] }}</td>
                                                            <td>{{ $item[1] }}</td>
                                                            <td>{{ $item[2] }}</td>
                                                            <td>{{ $item[3] }}</td>
                                                            <td>Rp.{{ number_format($item[4]) }}</td>
                                                        </tr>
                                                        
                                                        @endforeach
                                                        <tr class="table-primary">
                                                            <td colspan="4"><b> Grandtotal </b></td>
                                                            <td colspan="2"><b> Rp. {{number_format($item[4])}}</b></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                    
                                    @endif
                                    @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Penerimaan Barang
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    penerimaan
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Penjualan
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                @foreach ($jual as $inv => $data)
                                    <div style="border:2px solid black; padding:2px; margin-bottom:5px;">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <td colspan="4">Invoice : <b>{{$inv}}</b></td>
                                                    <td colspan="2" class="text-end">
                                                        <div class="dropdown">
                                                            <button class="btn btn-warning dropdown-toggle"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                Pending
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="#">Approved</a></li>
                                                                <li><a class="dropdown-item" href="#">Rejected</a></li>

                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr align="center">
                                                    <td class="col">#</td>
                                                    <td class="col">Kode Barang</td>
                                                    <td class="col">Nama Barang</td>
                                                    <td class="col">Ukuran</td>
                                                    <td class="col">QTY</td>
                                                    <td class="col">Subtotal</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $item)
                                                <tr class="text-center">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item[0] }}</td>
                                                    <td>{{ $item[1] }}</td>
                                                    <td>{{ $item[2] }}</td>
                                                    <td>{{ $item[3] }}</td>
                                                    <td>Rp.{{ number_format($item[4]) }}</td>
                                                </tr>
                                                
                                                @endforeach
                                                <tr class="table-primary">
                                                    <td colspan="4"><b> Grandtotal </b></td>
                                                    <td colspan="2"><b> Rp. {{number_format($item[5])}}</b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> 
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- pengajuan terpending -->
                <div style="width:50%; height:100%; overflow:auto;">
                    <h4>Pengajuan Terpending</h4>
                    <div class="accordion" id="terpending">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#terpending_beli" aria-expanded="true"
                                    aria-controls="terpending_beli">
                                    Pembelian
                                </button>
                            </h2>
                            <div id="terpending_beli" class="accordion-collapse collapse show" data-bs-parent="#terpending">
                            <div class="accordion-body">
                                    @foreach ($beli as $no_po => $data)
                                    @foreach($procurment as $pro)
                                    @if($pro->nopo == $no_po)
                                        @if($tglHariIni != $nilai)
                                            <div style="border:2px solid black; padding:2px; margin-bottom:5px;">
                                                <table class="table table-borderless">
                                                    <thead>
                                                        <tr>
                                                            <td colspan="4">Nomor PO : <b>{{$no_po}}</b> </td>
                                                            <td colspan="2" class="text-end">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-warning dropdown-toggle"
                                                                        type="button" data-bs-toggle="dropdown"
                                                                        aria-expanded="false">
                                                                        Pending
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a class="dropdown-item" href="{{route('barang.status',[$no_po,'Approved']  ) }}">Approved</a></li>
                                                                        <li><a class="dropdown-item" href="{{route('barang.status',[$no_po,'Rejected']  ) }}">Rejected</a></li>

                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4">
                                                            <?php
                                                                $uploadedDate = Carbon::parse($pro->created_at);
                                                                $currentDate = Carbon::now();
                                                                $selisih = $uploadedDate->diff($currentDate);
                                                                $selisihWaktu = $selisih->format('%d hari, %H jam');
                                                            ?>
                                                            Dibuat Sejak :<b> {{$selisihWaktu}} </b></td>
                                                        </tr>

                                                        <tr align="center">
                                                            <td class="col">#</td>
                                                            <td class="col">Kode Barang</td>
                                                            <td class="col">Nama Barang</td>
                                                            <td class="col">Ukuran</td>
                                                            <td class="col">QTY</td>
                                                            <td class="col">Subtotal</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data as $item)
                                                        <tr class="text-center">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $item[0] }}</td>
                                                            <td>{{ $item[1] }}</td>
                                                            <td>{{ $item[2] }}</td>
                                                            <td>{{ $item[3] }}</td>
                                                            <td>Rp.{{ number_format($item[4]) }}</td>
                                                        </tr>
                                                        
                                                        @endforeach
                                                        <tr class="table-primary">
                                                            <td colspan="4"><b> Grandtotal </b></td>
                                                            <td colspan="2"><b> Rp. {{number_format($item[4])}}</b></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                    @else
                                    GAGAL
                                    @endif
                                    @endforeach
                                    @endforeach
                                </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#terpending_terima" aria-expanded="false"
                                    aria-controls="terpending_terima">
                                    Penerimaan Barang
                                </button>
                            </h2>
                            <div id="terpending_terima" class="accordion-collapse collapse"
                                data-bs-parent="#terpending">
                                <div class="accordion-body">
                                    penerimaan barang.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#terpending_jual" aria-expanded="false"
                                    aria-controls="terpending_jual">
                                    Penjualan
                                </button>
                            </h2>
                            <div id="terpending_jual" class="accordion-collapse collapse" data-bs-parent="#terpending">
                                <div class="accordion-body">
                                    penjualan barang
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
$(document).ready(function() {
    $(".nav-tabs a").click(function() {
        $(this).tab('show');
    });
});
</script>
@endsection