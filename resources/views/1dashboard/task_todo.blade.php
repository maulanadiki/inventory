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
                @if(auth()->user()->level == 1 || auth()->user()->level == 2)
                <!-- pengajuan hari ini -->
                <div style="width:50%; overflow:auto;">
                    <h4>Pengajuan Hari ini</h4>
                    <?php $tglHariIni = date('Y-m-d');?>
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
                                    @foreach($procurment as $pro)
                                    @if($pro->dibuat == $tglHariIni)
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
                                                                <li><a class="dropdown-item" data-bs-target="#upload"
                                                                        onclick="modal('{{$pro->nopo}}')"
                                                                        data-bs-toggle="modal"
                                                                        style="cursor:pointer;">Approved</a></li>
                                                                <li><a class="dropdown-item"
                                                                        href="{{route('task_status',[$pro->nopo,'Rejected']  ) }}">Rejected</a>
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
                                                                $selisih = $uploadedDate->diff($currentDate);
                                                                $selisihJam = $selisih->format('%H jam');
                                                                $selisihmnt = $selisih->format('%i menit');
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
                                                <tr class="table-info">
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
                                    @foreach($receive as $rc)
                                    <?php
                                    $tgl = Carbon::parse($rc->updated_at);
                                    $tglrc = $tgl->format('Y-m-d');
                                        $update = Carbon::parse($rc->updated_at);
                                        $curr = Carbon::now();
                                        $sel = $update->diff($curr);
                                        $seljam = $sel->format('%H jam');
                                        $selmnt = $sel->format('%i menit');
                                    ?>
                                    @if($tglrc == $tglHariIni)
                                    <div style="border:2px solid black; padding:2px; margin-bottom:10px;">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <td colspan="3">Nomor PO : <b>{{$rc->nopo}}</b></td>
                                                    <td colspan="2" class="text-end">
                                                        <div class="dropdown">
                                                            <a href="{{route('penerima.terima',$rc->nopo) }}"
                                                                class="btn btn-warning">Terima Barang </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5">
                                                        Di bayarkan sejak : <b style="font-size:1.1em;">
                                                            @if($seljam > 1)
                                                            {{$seljam}} , {{$selmnt}}
                                                            @else
                                                            {{$selmnt}}
                                                            @endif
                                                        </b> yang lalu
                                                    </td>
                                                </tr>
                                                <tr align="center">
                                                    <td class="col">Kode</td>
                                                    <td class="col" colspan="2">Nama Vendor</td>
                                                    <td class="col" colspan="2">Grandtotal</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($vendors as $vnd)
                                                @if($vnd->nopo == $rc->nopo)
                                                <tr class="text-center">
                                                    <td>{{$vnd->kode_vendor}}</td>
                                                    <td colspan="2">{{$vnd->nama_vendor}}</td>
                                                    <td colspan="2">Rp. {{number_format($vnd->grandtotal)}}</td>

                                                </tr>

                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif
                                    @endforeach
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
                                                                        <button class="dropdown-item" type="submit">
                                                                            Approved</button>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                            href="{{ route('task.barang_keluar', ['Rejected',$sl->invoice])}}">Rejected</a>
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
                                                                $selisihWaktunya = $selisihh->format('%H jam, %i menit');
                                                            ?>
                                                        Dibuat sejak : {{$selisihWaktunya}}
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
                                                <tr class="table-info">
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
                                                                <li><a class="dropdown-item" data-bs-target="#upload"
                                                                        onclick="modal('{{$pro->nopo}}')"
                                                                        data-bs-toggle="modal"
                                                                        style="cursor:pointer;">Approved</a>
                                                                </li>
                                                                <li><a class="dropdown-item"
                                                                        href="{{route('task_status',[$pro->nopo,'Rejected']  ) }}">Rejected</a>
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
                                                                $selisih = $uploadedDate->diff($currentDate);
                                                                $selisihWaktu = $selisih->format('%d hari,%H jam');
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
                                                <tr class="table-info">
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
                                    @foreach($receive as $rc)
                                    <?php
                                    $tgl = Carbon::parse($rc->updated_at);
                                    $tglrc = $tgl->format('Y-m-d');
                                        $update = Carbon::parse($rc->updated_at);
                                        $curr = Carbon::now();
                                        $sel = $update->diff($curr);
                                        $seljam = $sel->format('%H jam');
                                        $selmnt = $sel->format('%i menit');
                                    ?>
                                    @if($tglrc !== $tglHariIni)
                                    <div style="border:2px solid black; padding:2px; margin-bottom:10px;">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <td colspan="3">Nomor PO : <b>{{$rc->nopo}}</b></td>
                                                    <td colspan="2" class="text-end">
                                                        <div class="dropdown">
                                                            <a href="{{route('penerima.terima',$rc->nopo) }}"
                                                                class="btn btn-warning">Terima Barang </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5">
                                                        Di bayarkan sejak : <b style="font-size:1.1em;">
                                                            @if($seljam > 1)
                                                            {{$seljam}} , {{$selmnt}}
                                                            @else
                                                            {{$selmnt}}
                                                            @endif
                                                        </b> yang lalu
                                                    </td>
                                                </tr>
                                                <tr align="center">
                                                    <td class="col">Kode</td>
                                                    <td class="col" colspan="2">Nama Vendor</td>
                                                    <td class="col" colspan="2">Grandtotal</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($vendors as $vnd)
                                                @if($vnd->nopo == $rc->nopo)
                                                <tr class="text-center">
                                                    <td>{{$vnd->kode_vendor}}</td>
                                                    <td colspan="2">{{$vnd->nama_vendor}}</td>
                                                    <td colspan="2">Rp. {{number_format($vnd->grandtotal)}}</td>

                                                </tr>

                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif
                                    @endforeach
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
                                    @foreach($sell as $sl)
                                    <?php
                                    $createdDate = Carbon::parse($sl->created_at);
                                    $tanggal = $createdDate->format('Y-m-d');
                                    ?>
                                    @if($tanggal !== $tglHariIni)
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
                                                                        <button class="dropdown-item" type="submit">
                                                                            Approved</button>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                            href="{{ route('task.barang_keluar', ['Rejected',$sl->invoice])}}">Rejected</a>
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
                                                <tr align="center">
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
                                                <tr class="table-info">
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
                @elseif(auth()->user()->level == 3 )
                <!-- pengajuan hari ini -->
                <div style="width:50%; overflow:auto;">
                    <h4>Pengajuan Hari ini</h4>
                    <?php $tglHariIni = date('Y-m-d');?>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo"aria-expanded="true"  aria-controls="collapseTwo">
                                    Penerimaan Barang
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @foreach($receive as $rc)
                                    <?php
                                        $tgl = Carbon::parse($rc->updated_at);
                                        $tglrc = $tgl->format('Y-m-d');
                                            $update = Carbon::parse($rc->updated_at);
                                            $curr = Carbon::now();
                                            $sel = $update->diff($curr);
                                            $seljam = $sel->format('%H jam');
                                            $selmnt = $sel->format('%i menit');
                                        ?>
                                    @if($tglrc == $tglHariIni)
                                    <div style="border:2px solid black; padding:2px; margin-bottom:10px;">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <td colspan="3">Nomor PO : <b>{{$rc->nopo}}</b></td>
                                                    <td colspan="2" class="text-end">
                                                        <div class="dropdown">
                                                            <a href="{{route('penerima.terima',$rc->nopo) }}"
                                                                class="btn btn-warning">Terima Barang </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5">
                                                        Di bayarkan sejak : <b style="font-size:1.1em;">
                                                            @if($seljam > 1)
                                                            {{$seljam}} , {{$selmnt}}
                                                            @else
                                                            {{$selmnt}}
                                                            @endif
                                                        </b> yang lalu
                                                    </td>
                                                </tr>
                                                <tr align="center">
                                                    <td class="col">Kode</td>
                                                    <td class="col" colspan="2">Nama Vendor</td>
                                                    <td class="col" colspan="2">Grandtotal</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($vendors as $vnd)
                                                @if($vnd->nopo == $rc->nopo)
                                                <tr class="text-center">
                                                    <td>{{$vnd->kode_vendor}}</td>
                                                    <td colspan="2">{{$vnd->nama_vendor}}</td>
                                                    <td colspan="2">Rp. {{number_format($vnd->grandtotal)}}</td>

                                                </tr>

                                                @endif
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
                                    @foreach($receive as $rc)
                                    <?php
                                    $tgl = Carbon::parse($rc->updated_at);
                                    $tglrc = $tgl->format('Y-m-d');
                                        $update = Carbon::parse($rc->updated_at);
                                        $curr = Carbon::now();
                                        $sel = $update->diff($curr);
                                        $seljam = $sel->format('%H jam');
                                        $selmnt = $sel->format('%i menit');
                                    ?>
                                    @if($tglrc !== $tglHariIni)
                                    <div style="border:2px solid black; padding:2px; margin-bottom:10px;">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <td colspan="3">Nomor PO : <b>{{$rc->nopo}}</b></td>
                                                    <td colspan="2" class="text-end">
                                                        <div class="dropdown">
                                                            <a href="{{route('penerima.terima',$rc->nopo) }}"
                                                                class="btn btn-warning">Terima Barang </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5">
                                                        Di bayarkan sejak : <b style="font-size:1.1em;">
                                                            @if($seljam > 1)
                                                            {{$seljam}} , {{$selmnt}}
                                                            @else
                                                            {{$selmnt}}
                                                            @endif
                                                        </b> yang lalu
                                                    </td>
                                                </tr>
                                                <tr align="center">
                                                    <td class="col">Kode</td>
                                                    <td class="col" colspan="2">Nama Vendor</td>
                                                    <td class="col" colspan="2">Grandtotal</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($vendors as $vnd)
                                                @if($vnd->nopo == $rc->nopo)
                                                <tr class="text-center">
                                                    <td>{{$vnd->kode_vendor}}</td>
                                                    <td colspan="2">{{$vnd->nama_vendor}}</td>
                                                    <td colspan="2">Rp. {{number_format($vnd->grandtotal)}}</td>

                                                </tr>

                                                @endif
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

<!-- modal -->
<form action="{{route('task.barang') }}" method="post" enctype="multipart/form-data">
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
                    <input type="text" name="nopo" id="nomorpo">
                    <button type="submit" class="btn btn-primary">Approved pengajuan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
function modal(nopo) {
    $('#nomorpo').val(nopo);
}
</script>

@endsection