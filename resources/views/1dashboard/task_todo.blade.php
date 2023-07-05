@section('title','List Tugas')

@extends('layout.layout')
@section('konten')
<?php 
use Carbon\Carbon; 

$tglHariIni = date('Y-m-d');
?>
<div class="container-fluid">
    <div class="frame base-system shadow">
        <!-- navigasi -->
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('home') }}" class="fs-5">Dashboard</a></li>
                    <li class="breadcrumb-item active fs-5 text-light">Pekerjaan Tertunda</li>
                </ul>
            </nav>
        </div>

        <!-- menu utama -->
        <div class="col-md-12 bg-light p-3">
            <div style="position:relative; display:flex; flex-direction:row; gap:20px; height:70vh;">
            <!-- menu utama untuk owner -->
            @if(auth()->user()->level == 1 || auth()->user()->level == 2)
                <!-- pengajuan hari ini -->
                    <div style="width:50%;">
                        <h4>Pengajuan Hari Ini</h4>
                        <div class="accordion" id="accordionExample">
                            <!-- Pembelian Hari ini -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Pembelian Barang
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        @foreach($procurment as $pro)
                                        @if($pro->dibuat == $tglHariIni)
                                        <div style="border:2px solid black; padding:2px; margin-bottom:10px;">
                                            <table class="table table-borderless table-striped">
                                                <thead>
                                                    <tr>
                                                        <td colspan="3">Nomor PO : <b>{{$pro->nopo}}</b></td>
                                                        <td colspan="2" class="text-end">
                                                            <div class="dropdown">
                                                                <button class="btn btn-warning dropdown-toggle"
                                                                    type="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                    Pending
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item text-success"
                                                                            data-bs-target="#upload"
                                                                            onclick="modal('{{$pro->nopo}}')"
                                                                            data-bs-toggle="modal"
                                                                            style="cursor:pointer;"><i
                                                                                class="bi bi-check-circle"></i> Approve</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item text-danger"
                                                                            href="{{route('task_status',[$pro->nopo,'Rejected']  ) }}"><i
                                                                                class="bi bi-x-circle"></i> Reject</a>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5">

                                                            <?php
                                                                    $uploadedDate = Carbon::parse($pro->created_at);
                                                                    $currentDate = Carbon::now();
                                                                    $selisihwk = $uploadedDate->diff($currentDate);
                                                                    $selisihJam = $selisihwk->format('%H jam');
                                                                    $selisihmnt = $selisihwk->format('%i menit');
                                                                ?>
                                                            Dibuat sejak : <b style="font-size:1.1em;">
                                                                @if($selisihJam > 1)
                                                                {{$selisihJam}} , {{$selisihmnt}}
                                                                @else
                                                                {{$selisihmnt}}
                                                                @endif
                                                            </b> yang lalu
                                                        </td>
                                                    </tr>
                                                    <tr align="center" class="table-primary">
                                                        <td class="col">Kode Barang</td>
                                                        <td class="col">Nama Barang</td>
                                                        <td class="col">Ukuran</td>
                                                        <td class="col">QTY</td>
                                                        <td class="col">Subtotal</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($pembelian as $pb)
                                                    @if($pb->no_po == $pro->nopo)
                                                    <tr class="text-center">
                                                        <td>{{$pb->kode_barang}}</td>
                                                        <td>{{$pb->nama_barang}}</td>
                                                        <td>{{$pb->ukuran}}</td>
                                                        <td>{{$pb->qty}}</td>
                                                        <td>Rp. {{number_format($pb->subtotal)}}</td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                    <tr class="table-primary">
                                                        <td colspan="3"><b> Grandtotal</b></td>
                                                        <td colspan="2" class="text-center"><b>Rp
                                                                {{number_format($pro->grandtotal)}}</b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- penerimaan Hari ini -->
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
                                        @foreach ($reec as $rec => $data)
                                        <?php
                                            date_default_timezone_set('Asia/Jakarta');
                                            $nilai = explode('/',$rec);
                                            $tgl = Carbon::parse($nilai[1]);
                                            $curr = Carbon::now();
                                            $sel = $tgl->diff($curr);
                                            $seljam = $sel->format('%H jam');
                                            $selmnt = $sel->format('%i menit');
                                            $hrini= $curr->format('d-m-y');
                                            $upini = $tgl->format('d-m-y');

                                            ?>

                                        @if($upini == $hrini)
                                        <div style="border:2px solid black; padding:2px; margin-bottom:10px;">
                                            <table class="table table-borderless table-striped">
                                                <thead>
                                                    <tr>
                                                        <td colspan="5" class="text-start">
                                                            <div class="dropdown">
                                                                <a href="{{route('penerima.terima',$nilai[0]) }}"
                                                                    class="btn btn-warning">Terima Barang </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">Nomor PO</td>
                                                        <td colspan="3">: <b>{{ $nilai[0] }}</b></td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2">Grandtotal</td>
                                                        <td colspan="3">:<b> Rp. {{ number_format($nilai[2]) }}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">Disetujui Sejak</td>
                                                        <td colspan="3">: <b>
                                                                @if($seljam < 1) {{$selmnt}} @else {{ $seljam }} ,
                                                                    {{$selmnt}} @endif </b>

                                                        </td>
                                                    </tr>
                                                    <tr class="table-primary text-center">
                                                        <td>Kode</td>
                                                        <td>Nama</td>
                                                        <td>ukuran</td>
                                                        <td>qty</td>
                                                        <td>Subtotal</td>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    @foreach( $data as $dt)
                                                    <tr class="text-center">
                                                        <td class="col">{{$dt[1]}}</td>
                                                        <td class="col">{{$dt[2]}}</td>
                                                        <td class="col">{{$dt[4]}}</td>
                                                        <td class="col">{{$dt[5]}}</td>
                                                        <td class="col">Rp. {{number_format($dt[6])}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif

                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Penjualan Hari Ini -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                        Penjualan Barang
                                    </button>
                                </h2>
                                <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        @foreach($sell as $sl)
                                            <?php
                                            $createdDate = Carbon::parse($sl->created_at);
                                            $tanggal = $createdDate->format('Y-m-d');
                                            ?>
                                            @if($tanggal == $tglHariIni)
                                            <div style="border:2px solid black; padding:2px; margin-bottom:10px;">
                                                <table class="table table-borderless">
                                                    <thead>
                                                        <tr>
                                                            <td colspan="3">Nomor PO : <b>{{$sl->invoice}}</b></td>
                                                            <td colspan="2" class="text-end">
                                                                <form method="get"
                                                                    action="{{ route('task.barang_keluar',['Approved',$sl->invoice])}}">
                                                                    @csrf
                                                                    <div class="dropdown">
                                                                        <button
                                                                            class="btn btn-warning text-dark dropdown-toggle"
                                                                            type="button" data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            PENDING
                                                                        </button>

                                                                        <ul class="dropdown-menu">
                                                                            <li>
                                                                                @foreach( $kobar as $kb)
                                                                                @if($sl->invoice == $kb->invoice)

                                                                                @php
                                                                                $hasil = $kb->kuantitas - $kb->qty;
                                                                                @endphp
                                                                                <input type="hidden" name="kobar[]"
                                                                                    value="{{$kb->kode_barang}}">
                                                                                <input type="hidden" name="qty[]"
                                                                                    value="{{ $hasil }}">
                                                                                @endif

                                                                                @endforeach
                                                                                <button class="dropdown-item text-success"
                                                                                    type="submit">
                                                                                    <i class="bi bi-check-circle"></i>
                                                                                    Approve</button>
                                                                            </li>
                                                                            <li><a class="dropdown-item text-danger"
                                                                                    href="{{ route('task.barang_keluar', ['Rejected',$sl->invoice])}}"><i
                                                                                        class="bi bi-x-circle"></i> Reject</a>
                                                                            </li>
                                                                        </ul>

                                                                    </div>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5">
                                                                <?php
                                                                $uploadedDate = Carbon::parse($sl->created_at);
                                                                $currentDate = Carbon::now();
                                                                $perbedaan = $uploadedDate->diff($currentDate);
                                                                $perbedaanj= $perbedaan->format('%H Jam');
                                                                $perbedaanm= $perbedaan->format('%i Menit');
                                                                ?>
                                                            Dibuat Sejak :
                                                            @if($perbedaanj < 1)
                                                            <b>{{$perbedaanm}}</b> yang lalu
                                                            @else
                                                            <b>{{$perbedaanj}} {{$perbedaanm}}</b> yang lalu
                                                            @endif
                                                            </td>
                                                        </tr>
                                                        <tr align="center" class="table-primary">
                                                            <td class="col">Kode Barang</td>
                                                            <td class="col">Nama Barang</td>
                                                            <td class="col">Ukuran</td>
                                                            <td class="col">QTY</td>
                                                            <td class="col">Subtotal</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($penjualan as $pj)
                                                        @if($pj->invoice == $sl->invoice)
                                                        <tr>
                                                            <td>{{$pj->kode_barang}}</td>
                                                            <td>{{$pj->nama_barang}}</td>
                                                            <td>{{$pj->ukuran}}</td>
                                                            <td>{{$pj->qty}}</td>
                                                            <td>Rp. {{number_format($pj->subtotal)}}</td>
                                                        </tr>
                                                        @endif

                                                        @endforeach
                                                        <tr class="table-primary">
                                                            <td colspan="3"><b> Grandtotal</b></td>
                                                            <td colspan="2" class="text-center"><b>Rp
                                                                    {{number_format($sl->grandtotal)}}</b></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <!-- Pengajuan Terpending -->
                    <div style="width:50%; height:100%; overflow:auto;">
                        <h4>Pengajuan Terpending</h4>
                        <div class="accordion" id="terpending">
                            <!-- pengajuan PO H+1 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#terpending_beli" aria-expanded="true"
                                        aria-controls="terpending_beli">
                                        Pembelian
                                    </button>
                                </h2>
                                <div id="terpending_beli" class="accordion-collapse collapse show"
                                    data-bs-parent="#terpending">
                                    <div class="accordion-body">
                                        @foreach($procurment as $pro)
                                        @if($pro->dibuat !== $tglHariIni)
                                        <div style="border:2px solid black; padding:2px; margin-bottom:10px;">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <td colspan="3">Nomor PO : <b>{{$pro->nopo}}</b></td>
                                                        <td colspan="2" class="text-end">
                                                            <div class="dropdown">
                                                                <button class="btn btn-warning dropdown-toggle"
                                                                    type="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                    Pending
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item text-success"
                                                                            data-bs-target="#upload"
                                                                            onclick="modal('{{$pro->nopo}}')"
                                                                            data-bs-toggle="modal"
                                                                            style="cursor:pointer;"><i
                                                                                class="bi bi-check-circle"></i> Approve</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item text-danger"
                                                                            href="{{route('task_status',[$pro->nopo,'Rejected']  ) }}"><i
                                                                                class="bi bi-x-circle"></i> Reject</a>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5">

                                                            <?php
                                                                    $uploadedDate = Carbon::parse($pro->created_at);
                                                                    $currentDate = Carbon::now();
                                                                    $selisihal = $uploadedDate->diff($currentDate);
                                                                    $selisihWaktu = $selisihal->format('%d hari,%H jam');
                                                                ?>
                                                            Dibuat sejak : <b style="font-size:1.1em;">{{$selisihWaktu}}</b>
                                                            yang lalu
                                                        </td>
                                                    </tr>
                                                    <tr align="center">
                                                        <td class="col">Kode Barang</td>
                                                        <td class="col">Nama Barang</td>
                                                        <td class="col">Ukuran</td>
                                                        <td class="col">QTY</td>
                                                        <td class="col">Subtotal</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($pembelian as $pb)
                                                    @if($pb->no_po == $pro->nopo)
                                                    <tr class="text-center">
                                                        <td>{{$pb->kode_barang}}</td>
                                                        <td>{{$pb->nama_barang}}</td>
                                                        <td>{{$pb->ukuran}}</td>
                                                        <td>{{$pb->qty}}</td>
                                                        <td>Rp. {{number_format($pb->subtotal)}}</td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                    <tr class="table-primary">
                                                        <td colspan="3"><b> Grandtotal</b></td>
                                                        <td colspan="2" class="text-center"><b>Rp
                                                                {{number_format($pro->grandtotal)}}</b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- penerimaan barang H+1 -->
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
                                        @foreach ($reec as $rec => $data)
                                        <?php
                                        $nilai = explode('/',$rec);
                                        $tgl = Carbon::parse($nilai[1]);
                                        $curr = Carbon::now();
                                        $sel = $tgl->diff($curr);
                                        $selh = $sel->format('%D Hari');
                                        $selj = $sel->format('%H Jam');
                                        $hrini1= $curr->format('d-m-y');
                                        $upini1 = $tgl->format('d-m-y');
                                        ?>
                                        @if($upini1 != $hrini1)
                                        <div style="border:2px solid black; padding:2px; margin-bottom:10px;">
                                            <table class="table table-borderless table-striped">
                                                <thead>
                                                    <tr>
                                                        <td colspan="5" class="text-start">
                                                            <div class="dropdown">
                                                                <a href="{{route('penerima.terima',$nilai[0]) }}"
                                                                    class="btn btn-warning">Terima Barang </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">Nomor PO</td>
                                                        <td colspan="3">: <b>{{ $nilai[0] }}</b></td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2">Grandtotal</td>
                                                        <td colspan="3">:<b> Rp. {{ number_format($nilai[2]) }}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">Disetujui Sejak</td>
                                                        <td colspan="3">: <b>{{ $selh }} , {{$selj}}</b></td>
                                                    </tr>
                                                    <tr class="table-primary text-center">
                                                        <td>Kode</td>
                                                        <td>Nama</td>
                                                        <td>ukuran</td>
                                                        <td>qty</td>
                                                        <td>Subtotal</td>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    @foreach( $data as $dt)
                                                    <tr class="text-center">
                                                        <td class="col">{{$dt[1]}}</td>
                                                        <td class="col">{{$dt[2]}}</td>
                                                        <td class="col">{{$dt[4]}}</td>
                                                        <td class="col">{{$dt[5]}}</td>
                                                        <td class="col">Rp. {{number_format($dt[6])}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Penjualan barang H+1 -->
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
                                        @foreach($sell as $sl)
                                        <?php
                                        $createdDate = Carbon::parse($sl->created_at);
                                        $tanggal = $createdDate->format('Y-m-d');
                                        ?>
                                        @if($tanggal !== $tglHariIni)
                                        <div style="border:2px solid black; padding:2px; margin-bottom:10px;">
                                            <table class="table table-borderless table-striped">
                                                <thead>
                                                    <tr>
                                                        <td colspan="3">Nomor PO : <b>{{$sl->invoice}}</b></td>
                                                        <td colspan="2" class="text-end">
                                                            <form method="get"
                                                                action="{{ route('task.barang_keluar',['Approved',$sl->invoice])}}">
                                                                @csrf
                                                                <div class="dropdown">
                                                                    <button
                                                                        class="btn btn-warning text-dark dropdown-toggle"
                                                                        type="button" data-bs-toggle="dropdown"
                                                                        aria-expanded="false">
                                                                        PENDING
                                                                    </button>

                                                                    <ul class="dropdown-menu">
                                                                        <li>
                                                                            @foreach( $kobar as $kb)
                                                                            @if($sl->invoice == $kb->invoice)

                                                                            @php
                                                                            $hasil = $kb->kuantitas - $kb->qty;
                                                                            @endphp
                                                                            <input type="hidden" name="kobar[]"
                                                                                value="{{$kb->kode_barang}}">
                                                                            <input type="hidden" name="qty[]"
                                                                                value="{{ $hasil }}">
                                                                            @endif

                                                                            @endforeach
                                                                            <button class="dropdown-item text-success"
                                                                                type="submit">
                                                                                <i class="bi bi-check-circle"></i>
                                                                                Approve</button>
                                                                        </li>
                                                                        <li><a class="dropdown-item text-danger"
                                                                                href="{{ route('task.barang_keluar', ['Rejected',$sl->invoice])}}"><i
                                                                                    class="bi bi-x-circle"></i> Reject</a>
                                                                        </li>
                                                                    </ul>

                                                                </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5">

                                                            <?php
                                                                    $uploadedDate = Carbon::parse($sl->created_at);
                                                                    $currentDate = Carbon::now();
                                                                    $selisihh = $uploadedDate->diff($currentDate);
                                                                    $selisihWaktunya = $selisihh->format('%d Hari,%H Jam');
                                                                ?>
                                                            Dibuat sejak :<b style="font-size:1.1em">
                                                                {{$selisihWaktunya}}</b> yang lalu
                                                        </td>
                                                    </tr>
                                                    <tr align="center" class="table-primary">
                                                        <td class="col">Kode Barang</td>
                                                        <td class="col">Nama Barang</td>
                                                        <td class="col">Ukuran</td>
                                                        <td class="col">QTY</td>
                                                        <td class="col">Subtotal</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($penjualan as $pj)
                                                    @if($pj->invoice == $sl->invoice)
                                                    <tr>
                                                        <td>{{$pj->kode_barang}}</td>
                                                        <td>{{$pj->nama_barang}}</td>
                                                        <td>{{$pj->ukuran}}</td>
                                                        <td>{{$pj->qty}}</td>
                                                        <td>Rp. {{number_format($pj->subtotal)}}</td>
                                                    </tr>
                                                    @endif

                                                    @endforeach
                                                    <tr class="table-primary">
                                                        <td colspan="3"><b> Grandtotal</b></td>
                                                        <td colspan="2" class="text-center"><b>Rp
                                                                {{number_format($sl->grandtotal)}}</b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <!-- menu utama utuk pruchasing -->
            @elseif(auth()->user()->level == 3 )
            <!-- pengajuan hari ini -->
            <div style="width:50%; overflow:auto;">
                    <h4>Pengajuan Hari ini</h4>
                    <?php $tglHariIni = date('Y-m-d');?>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    Penerimaan Barang
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @foreach ($reec as $rec => $data)
                                    <?php
                                        date_default_timezone_set('Asia/Jakarta');
                                        $nilai = explode('/',$rec);
                                        $tgl = Carbon::parse($nilai[1]);
                                        $curr = Carbon::now();
                                        $sel = $tgl->diff($curr);
                                        $seljam = $sel->format('%H jam');
                                        $selmnt = $sel->format('%i menit');
                                        $hrini= $curr->format('d-m-y');
                                        $upini = $tgl->format('d-m-y');

                                        ?>

                                    @if($upini == $hrini)
                                    <div style="border:2px solid black; padding:2px; margin-bottom:10px;">
                                        <table class="table table-borderless table-striped">
                                            <thead>
                                                <tr>
                                                    <td colspan="5" class="text-start">
                                                        <div class="dropdown">
                                                            <a href="{{route('penerima.terima',$nilai[0]) }}"
                                                                class="btn btn-warning">Terima Barang </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Nomor PO</td>
                                                    <td colspan="3">: <b>{{ $nilai[0] }}</b></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="2">Grandtotal</td>
                                                    <td colspan="3">:<b> Rp. {{ number_format($nilai[2]) }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Disetujui Sejak</td>
                                                    <td colspan="3">: <b>
                                                            @if($seljam < 1) {{$selmnt}} @else {{ $seljam }} ,
                                                                {{$selmnt}} @endif </b>

                                                    </td>
                                                </tr>
                                                <tr class="table-primary text-center">
                                                    <td>Kode</td>
                                                    <td>Nama</td>
                                                    <td>ukuran</td>
                                                    <td>qty</td>
                                                    <td>Subtotal</td>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                @foreach( $data as $dt)
                                                <tr class="text-center">
                                                    <td class="col">{{$dt[1]}}</td>
                                                    <td class="col">{{$dt[2]}}</td>
                                                    <td class="col">{{$dt[4]}}</td>
                                                    <td class="col">{{$dt[5]}}</td>
                                                    <td class="col">Rp. {{number_format($dt[6])}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- pengajuan terpending -->
                <div style="width:50%; height:100%; overflow:auto;">
                    <h4>Pengajuan Terpending</h4>
                    <div class="accordion" id="terpending">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#terpending_terima" aria-expanded="true"
                                    aria-controls="terpending_terima">
                                    Penerimaan Barang
                                </button>
                            </h2>
                            <div id="terpending_terima" class="accordion-collapse collapse show"
                                data-bs-parent="#terpending">
                                <div class="accordion-body">
                                    @foreach ($reec as $rec => $data)
                                    <?php
                                    $nilai = explode('/',$rec);
                                    $tgl = Carbon::parse($nilai[1]);
                                    $curr = Carbon::now();
                                    $sel = $tgl->diff($curr);
                                    $selh = $sel->format('%D Hari');
                                    $selj = $sel->format('%H Jam');
                                    $hrini1= $curr->format('d-m-y');
                                    $upini1 = $tgl->format('d-m-y');
                                    ?>
                                    @if($upini1 != $hrini1)
                                    <div style="border:2px solid black; padding:2px; margin-bottom:10px;">
                                        <table class="table table-borderless table-striped">
                                            <thead>
                                                <tr>
                                                    <td colspan="5" class="text-start">
                                                        <div class="dropdown">
                                                            <a href="{{route('penerima.terima',$nilai[0]) }}"
                                                                class="btn btn-warning">Terima Barang </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Nomor PO</td>
                                                    <td colspan="3">: <b>{{ $nilai[0] }}</b></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="2">Grandtotal</td>
                                                    <td colspan="3">:<b> Rp. {{ number_format($nilai[2]) }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Disetujui Sejak</td>
                                                    <td colspan="3">: <b>{{ $selh }} , {{$selj}}</b></td>
                                                </tr>
                                                <tr class="table-primary text-center">
                                                    <td>Kode</td>
                                                    <td>Nama</td>
                                                    <td>ukuran</td>
                                                    <td>qty</td>
                                                    <td>Subtotal</td>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                @foreach( $data as $dt)
                                                <tr class="text-center">
                                                    <td class="col">{{$dt[1]}}</td>
                                                    <td class="col">{{$dt[2]}}</td>
                                                    <td class="col">{{$dt[4]}}</td>
                                                    <td class="col">{{$dt[5]}}</td>
                                                    <td class="col">Rp. {{number_format($dt[6])}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
</div>

@endsection