@section('title','Form Data Barang')

@extends('layout.layout')
@section('konten')
<div class="container-fluid">
    <div class="frame base-system">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a class="fs-5" href="{{url('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="fs-5" href="{{url('barang')}}">Tabel Barang</a></li>
                <li class="breadcrumb-item fs-5 text-light">Tabel Barang</li>
            </ul>
        </div>

        <div class="col-md-12 border rounded-3 text-center text-center">
            <div class="form-center">
                <form method="post" action="{{ route('barang.simpan') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" name="k_vendor" maxlength="7"
                        placeholder="Masukan nomor KTP">
                    <input type="hidden" name="created" value="<?php echo date('d-M-Y') ?>">
                    @php
                    $barang ++;
                    $huruf = "BRG-";
                    $kode = $huruf.sprintf('%05d', $barang);
                    @endphp



                    <div class="row " style="width: 1000px;">
                        <div class="col-md-12" align="center">
                            <h3>FORM REGISTER GOODS</h2>
                                <hr>
                        </div>
                        <!-- NIK -->
                        <div class="col-md-5  d-flex justify-content-end align-items-center">KODE BARANG</div>
                        <div class="col-md-4">
                            <input type="text" class="form-control is-valid" id="inik" name="kbarang" maxlength="12"
                                placeholder="Kode Barang" value="{{$kode}}" required readonly="readonly">
                        </div>

                        <!-- NPWP -->
                        <div class="col-md-5  d-flex justify-content-end align-items-center mt-2">NAMA BARANG</div>
                        <div class="col-md-4 mt-2"><input type="text" class="form-control is-invalid" id="inpwp"
                                onkeypress="return event.charCode < 48 || event.charCode >57" name="nbarang"
                                maxlength="12" placeholder="Masukan Nama Barang" required></div>

                        <!-- nama VENDOR-->
                        <div class="col-md-5  d-flex justify-content-end align-items-center mt-2">WARNA</div>
                        <div class="col-md-4 mt-2"> <input type="text" class="form-control is-invalid"
                                onkeypress="return event.charCode < 48 || event.charCode >57" id="ivendor" name="warna"
                                maxlength="20" placeholder="Masukan warna barang" required></div>
                        <!-- NAMA PEMILIK -->
                        <div class="col-md-5  d-flex justify-content-end align-items-center mt-2">UKURAN</div>
                        <div class="col-md-4 mt-2"> <input type="text" class="form-control is-invalid"
                                onkeypress="return event.charCode >= 48 && event.charCode <=57" id="pemilik"
                                name="ukuran" maxlength="20" placeholder="Masukan ukuran" required></div>

                        <!-- NOMOR TELP -->
                        <div class="col-md-5  d-flex justify-content-end align-items-center mt-2">Harga Beli</div>
                        <div class="col-md-4 mt-2"><input type="text" class="form-control is-invalid" id="beli"
                                onkeypress="return event.charCode >= 48 && event.charCode <=57" name="beli"
                                maxlength="8" placeholder="Masukan harga beli" required></div>

                        <!-- ALAMAT -->
                        <div class="col-md-5  d-flex justify-content-end align-items-center mt-2">DESKRIPSI</div>
                        <div class="col-md-4 mt-2">
                            <textarea class="form-control" placeholder="Masukan Deskripsi" id="ialamat"
                                name="deskripsi"></textarea>
                        </div>
                        <div class="col-md-5  d-flex justify-content-end align-items-center mt-2 mb-2">FOTO BARANG</div>
                        <div class="col-md-4 mt-2 mb-2">
                            <div class="input-group">
                                <input type="file" class="form-control" id="itext"
                                    aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="fbarang"
                                    accept="image/png, image/gif, image/jpeg" required>
                            </div>
                        </div>
                        <br>
                        <hr>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mb-3 me-4" name="submit"><i class="fa fa-floppy-o"
                                aria-hidden="true"></i> SAVE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$("[class^='form-control']").on('input', function() {
    var input = $(this);
    var is_name = input.val();
    console.log(is_name);
    if (is_name === '') {
        input.removeClass("is-valid").addClass("is-invalid");
    } else {
        input.removeClass("is-invalid").addClass("is-valid");
    }
});



// $(document).ready(function(){
//         $("input").keyup(function(){
//             if($(".form-control")== null)
//             {
//                 $(this).removeClass("is-valid");
//                 $(this).addClass("is-invalid");
//             }
//             else{
//                 $(this).removeClass("is-invalid");
//             $(this).addClass("is-valid");
//             }

//         });
// });
</script>
@endsection