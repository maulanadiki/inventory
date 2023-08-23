@section('title','Penerimaan Barang')

@extends('layout.layout')
@section('konten')
<style>
.nav-link:not(.active) {
    color: #f2f2f2 !important;
}
</style>

<div class="container-fluid">
    <div class="frame base-system">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb ms-3">
                    <li class="breadcrumb-item"><a class="jdl fs-5" href="{{url('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item fs-5 text-light">Report</>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="container">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#masuk">Grafik Barang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#bmasuk">Pembelian Barang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#keluar">Penjualan Barang Barang</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content"
                style="background-color:white; border:1px solid #dee2e6; border-bottom-right-radius:20px; border-bottom-left-radius:20px;">
                <div id="masuk" class="container tab-pane active"><br>
                    <h3>Grafik Barang</h3>
                    
                    @include('8report.grafik')
                </div>
                <div id="bmasuk" class="container tab-pane fade overflow-auto p-3 m-0"><br>
                    <h3>Pembelian Barang</h3>
                    @include('8report.barangMasuk')
                </div>
                <div id="keluar" class="container tab-pane fade overflow-auto p-3 m-0"><br>
                    <h3>Penjualan Barang</h3>
                    @include('8report.barangKeluar')
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