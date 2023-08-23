@section('title','Table Barang')

@extends('layout.layout')
@section('konten')
<div class="container-fluid">
    <div class="frame base-system">
        <div class="row">
            <div class="col-md-4">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a class="fs-5" href="{{url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item fs-5 text-light">Tabel Barang</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-8 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ubahHarga">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                    </svg>
                    Ubah Harga
                </button>
                <a href="{{route('barang.buat') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                    </svg>
                    Kode Barang
                </a>
            </div>

            <div class="col-md-12 bg-light border rounded-3 p-3">
                <table id="example" class="table table-striped pt-3 mb-2" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Barang</th>
                            <th>Nama</th>
                            <th>Warna</th>
                            <th>Ukuran</th>
                            <th>Beli</th>
                            <th style="text-align:center;">Aktivasi Kode</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $br)
                       <tr>
                       <td>{{$loop->iteration}}</td>
                        <td>{{$br->kode_barang}}</td>
                        <td>{{$br->nama_barang}}</td>
                        <td>{{$br->warna}}</td>
                        <td>{{$br->ukuran}}</td>
                        <td>Rp. {{number_format($br->beli)}}</td>
                        <td><div class="d-flex justify-content-center">
                            <div class="form-check form-switch">
                                @if($br->aktivasi_pembelian=='enable')
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked disabled>
                                @else
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" disabled>
                                @endif
                            </div></div>
                        </td>
                        <td>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="gmb('{{$br->f_barang}}')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-card-image" viewBox="0 0 16 16">
                                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                    <path
                                        d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z" />
                                </svg>
                            </button>
                        </td>
                       </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Gambar Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="" class="d-block w-100" alt="..." height="400px" width="800px" id="gambar">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<form action="{{route('barang.ubahsimpan') }}" method="post" enctype="multipart/form-data">
    @csrf
<div class="modal fade" id="ubahHarga" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Harga</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-gap-3 justify-content-md-center">
                    <div class="col-md-4">Nama Barang</div>
                    <div class="col-md-6">
                        <select class="form-select" aria-label="Nama Barang" name="nama_barang" id="nabar" required>
                            <option value="" selected >Pilih Barang</option>
                            @foreach($nabar as $nabars)
                            <option value="{{$nabars}}">{{$nabars}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">Warna Barang</div>
                    <div class="col-md-6">
                    <select class="form-select" aria-label="Nama Barang" name="warna_barang" id="warnabarang" required></select>
                    </div>
                    <div class="col-md-4">Ukuran Barang</div>
                    <div class="col-md-6">
                        <select class="form-select" aria-label="Nama Barang" name="ukuran_barang" id="ukuran" required>
                    
                        </select>
                    </div>
                    <div class="col-md-4">Harga Terbaru</div>
                    <div class="col-md-6">
                        <input type="text" id="hargaBaru" class="form-control" name="harga" style="text-align: right;" maxlength="8" required/>
                    </div>
                    <div class="col-md-4">Deskripsi</div>
                    <div class="col-md-6">
                        <textarea name="desk" cols="20" rows="3" class="form-control" required></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save changes</button>
            </div>
        </div>
    </div>
</div>
</form>


<script>
$(document).ready(function() {
    $('#example').DataTable();
});

function gmb(id) {
    document.getElementById("gambar").src = "{{ asset('images/') }}/" + id;
}

var tanpa_rupiah = document.getElementById('hargaBaru');
tanpa_rupiah.addEventListener('keyup', function(e) {
    tanpa_rupiah.value = formatRupiah(this.value);
});

function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}



// live search warna
$(document).ready(function() {
    // live seacth warna
    $(document).on('change', '#nabar', function() {
        const nabar = $(this).val();
        $.ajax({
            type: "get",
            url: '{{URL::to('/barang/ubah')}}',
            data: {nabar: nabar},
                success: function(res) {
                    var warnaOptions = "";
                    
                    $.each(res.warna, function(index, list) {
                        warnaOptions += "<option value='" + list.warna + "'>" + list.warna + "</option>";
                    });
                    
                    const uniqwarna = [...new Set(res.warna.map(item => item.warna))];

                    if(uniqwarna.length == 1){
                        const optional = uniqwarna.map(value => '<option value="">Pilih Warna</option><option value="' + value + '">' + value + '</option>').join('');
                        $("#warnabarang").html(optional);
                    }
                    else{
                        const optional = uniqwarna.map(value => '<option value="' + value + '">' + value + '</option>').join('');
                        $("#warnabarang").html(optional);
                    }
                    
                }
        });
    });

    $(document).on('change','#warnabarang', function() {
        const warna = $(this).val();
        const nabar =$("#nabar").val();
        $.ajax({
            type: "get",
            url: '{{URL::to('/barang/ubah')}}',
            data: {nabar: nabar,warna: warna},
                success: function(res) {
                    var ukurans = '';
                    console.log(res);
                    $.each(res.ukuran, function(index, uk) {
                        ukurans += "<option value='" + uk.ukuran + "'>" + uk.ukuran + "</option>";
                    });
                    const uniqukuran = [...new Set(res.ukuran.map(item => item.ukuran))];
                    const ukuranoptional= uniqukuran.map(value => '<option value="' + value + '">' + value + '</option>').join('');
                    $("#ukuran").html(ukuranoptional);
                }
        });
    });
    // live search ukuran
});
</script>
@endsection