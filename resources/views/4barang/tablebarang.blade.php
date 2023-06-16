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
                <a href="{{route('barang.buat') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                    </svg>
                    Kode Barang</a>
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
                            <td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    onclick="gmb('{{$br->f_barang}}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-card-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                        <path
                                            d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z" />
                                    </svg>
                                </button></td>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
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

<script>
    $(document).ready(function () {
    $('#example').DataTable();
});

function gmb(id)
{
    console.log(id);
    document.getElementById("gambar").src = "{{ asset('images/') }}/" + id;
}
</script>
@endsection