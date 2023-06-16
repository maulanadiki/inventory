@section('title','Penerimaan Barang')

@extends('layout.layout')
@section('konten')
<div class="col-md-12 mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ms-3">
            <li class="breadcrumb-item"><a class="jdl fs-5" href="{{url('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a class="jdl text-secondary fs-5" href="#">Report</a></li>
        </ol>
    </nav>
</div>

<div class="container mt-3">
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
  <div class="tab-content" style="background-color:white; border:1px solid #dee2e6; border-bottom-right-radius:20px; border-bottom-left-radius:20px;">
    <div id="masuk" class="container tab-pane active"><br>
      <h3>Grafik Barang</h3>
      @include('8report.grafikmasuk')
    </div>
    <div id="bmasuk" class="container tab-pane fade"><br>
      <h3>Pembelian Barang</h3>
      @include('8report.barangmasuk')
    </div>
    <div id="keluar" class="container tab-pane fade"><br>
      <h3>Penjualan Barang</h3>
     @include('8report.barangkeluar')
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  $(".nav-tabs a").click(function(){
    $(this).tab('show');
  });
});
</script>
@endsection