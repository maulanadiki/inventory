@section('title','Table Karyawan')

@extends('layout.layout')
@section('konten')
<div class="container-fluid">
    <div class="frame base-system">
        <div class="row">
            <div class="col-md-4">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a class="jdl fs-5" href="{{url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item fs-5 text-light">Tabel Karyawan</li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-8 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                    </svg>
                    Daftar Karyawan</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 bg-light border rounded-3 shadow p-3">
                <table class="table table-hover " id="tabel_karyawan">
                    <thead>
                        <tr class="table-primary">
                            <th class="col" style="text-align:center;">No.</th>
                            <th class="col" style="text-align:center;">NIK</th>
                            <th class="col" style="text-align:center;">NPWP</th>
                            <th class="col" style="text-align:center;">Nama</th>
                            <th class="col" style="text-align:center;">Tempat, Tanggal Lahir</th>
                            <th class="col" style="text-align:center;">Jenis Kelamin</th>
                            <th class="col" style="text-align:center;">Jabatan</th>
                            <th class="col" style="text-align:center;">Akses</th>
                            <th class="colo"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($employe as $user)
                        <tr align="center">
                            <th style="text-align:center;" data-bs-toggle="modal" data-bs-target="#detailvendor"
                                style="cursor: pointer;"
                                onclick="employed('{{$user->nama}}','{{$user->alamat}}','{{$user->f_nik}}','{{$user->f_npwp}}','{{$user->f_tabungan}}','{{$user->nik}}','{{$user->npwp}}','{{$user->bank}}','{{$user->norek}}','{{$user->id}}')">
                                {{$loop ->iteration}}</th>
                            <td data-bs-toggle="modal" data-bs-target="#detailvendor" style="cursor: pointer;"
                                onclick="employed('{{$user->nama}}','{{$user->alamat}}','{{$user->f_nik}}','{{$user->f_npwp}}','{{$user->f_tabungan}}','{{$user->nik}}','{{$user->npwp}}','{{$user->bank}}','{{$user->norek}}','{{$user->id}}')">
                                {{$user->nik}}</td>
                            <td data-bs-toggle="modal" data-bs-target="#detailvendor" style="cursor: pointer;"
                                onclick="employed('{{$user->nama}}','{{$user->alamat}}','{{$user->f_nik}}','{{$user->f_npwp}}','{{$user->f_tabungan}}','{{$user->nik}}','{{$user->npwp}}','{{$user->bank}}','{{$user->norek}}','{{$user->id}}')">
                                {{$user->npwp}}</td>
                            <td data-bs-toggle="modal" data-bs-target="#detailvendor" style="cursor: pointer;"
                                onclick="employed('{{$user->nama}}','{{$user->alamat}}','{{$user->f_nik}}','{{$user->f_npwp}}','{{$user->f_tabungan}}','{{$user->nik}}','{{$user->npwp}}','{{$user->bank}}','{{$user->norek}}','{{$user->id}}')">
                                {{$user->nama}}</td>
                            <td data-bs-toggle="modal" data-bs-target="#detailvendor" style="cursor: pointer;"
                                onclick="employed('{{$user->nama}}','{{$user->alamat}}','{{$user->f_nik}}','{{$user->f_npwp}}','{{$user->f_tabungan}}','{{$user->nik}}','{{$user->npwp}}','{{$user->bank}}','{{$user->norek}}','{{$user->id}}')">
                                {{$user->tempat}}, {{$user->tanggal}}</td>
                            @php
                            if($user->kelamin == "L")
                            {$kelamin= "Laki - Laki";}
                            else
                            {$kelamin = "Perempuan";}
                            @endphp
                            <td data-bs-toggle="modal" data-bs-target="#detailvendor" style="cursor: pointer;"
                                onclick="employed('{{$user->nama}}','{{$user->alamat}}','{{$user->f_nik}}','{{$user->f_npwp}}','{{$user->f_tabungan}}','{{$user->nik}}','{{$user->npwp}}','{{$user->bank}}','{{$user->norek}}','{{$user->id}}')">
                                {{$kelamin}}</td>
                            @php

                            if ($user->jabatan == 1)
                            {
                            $jabatan = "OWNER" ;
                            }

                            elseif ($user->jabatan == 3)
                            {$jabatan = "PURCHASING"; }

                            elseif($user->jabatan == 2)
                            {$jabatan = "FINANCE";}

                            else
                            {
                            $jabatan = "MARKETING";
                            }


                            @endphp
                            <td>{{$jabatan}}</td>
                            <td>
                                @if ($user->akses == "Approved")
                                <div class="dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Approved
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{route('karyawan.update',[$user->email,'Pending'] )}}"style="color:#bb6902;" >
                                                <i class="bi bi-exclamation-circle"></i> Pending
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{route('karyawan.update',[$user->email,'Reject'] )}}" style="color:#99182c;">
                                                <i class="bi bi-x-circle"></i> Reject
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#" onclick="edit_karyawan('{{$user->nik}}','{{$user->npwp}}','{{$user->nama}}','{{$user->tempat}}','{{$user->tanggal}}','{{$user->kelamin}}','{{$user->telp}}','{{$user->email}}','{{$user->alamat}}','{{$user->bank}}','{{$user->norek}}','{{$user->f_nik}}','{{$user->f_npwp}}','{{$user->f_tabungan}}','{{$user->akses}}','{{$user->jabatan}}','{{$user->id}}')" data-bs-toggle="modal" data-bs-target="#edit_karyawan">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a></li>
                                    </ul>
                                </div>

                                @elseif($user->akses == "Reject")
                                <div class="dropdown">
                                    <button class="btn btn-danger dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false" >
                                        <i class="bi bi-x-circle"></i> Reject
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{route('karyawan.update',[$user->email,'Approved'] )}}" style="color:#186340;">
                                                <i class="bi bi-check-circle"></i> Approve
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{route('karyawan.update',[$user->email,'Pending'] )}}" style="color:#bb6902;">
                                                <i class="bi bi-exclamation-circle"></i> Pending
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#" onclick="edit_karyawan('{{$user->nik}}','{{$user->npwp}}','{{$user->nama}}','{{$user->tempat}}','{{$user->tanggal}}','{{$user->kelamin}}','{{$user->telp}}','{{$user->email}}','{{$user->alamat}}','{{$user->bank}}','{{$user->norek}}','{{$user->f_nik}}','{{$user->f_npwp}}','{{$user->f_tabungan}}','{{$user->akses}}','{{$user->jabatan}}','{{$user->id}}')" data-bs-toggle="modal" data-bs-target="#edit_karyawan">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                @else
                                <div class="dropdown">
                                    <button class="btn btn-warning dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-exclamation-circle"></i> Pending
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item"
                                                href="{{route('karyawan.update',[$user->email,'Approved'] )}}" style="color:#186340;"><i
                                                    class="bi bi-check-circle"></i> Approved</a></li>
                                        <li><a class="dropdown-item"
                                                href="{{route('karyawan.update',[$user->email,'Reject'] )}}" style="color:#99182c;"><i
                                                    class="bi bi-x-circle"></i> Rejected</a></li>
                                        <li><a class="dropdown-item" href="#"
                                                onclick="edit_karyawan('{{$user->nik}}','{{$user->npwp}}','{{$user->nama}}','{{$user->tempat}}','{{$user->tanggal}}','{{$user->kelamin}}','{{$user->telp}}','{{$user->email}}','{{$user->alamat}}','{{$user->bank}}','{{$user->norek}}','{{$user->f_nik}}','{{$user->f_npwp}}','{{$user->f_tabungan}}','{{$user->akses}}','{{$user->jabatan}}','{{$user->id}}')"
                                                data-bs-toggle="modal" data-bs-target="#edit_karyawan"><i
                                                    class="bi bi-pencil-square"></i> Edit</a></li>
                                    </ul>
                                </div>
                                @endif
                            </td>
                            <td><a href="{{route('karyawan.hapus',$user->email) }}" class="btn btn-danger"> <i
                                        class="bi bi-trash3"></i></a></td>

                        </tr>

                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>




    </div>
</div>



<!-- modal Detail-->
<div class="modal fade" id="detailvendor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    <div id="judul"></div>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home">KTP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1"> NPWP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu2">TABUNGAN</a>
                    </li>
                </ul>
                <div class="tab-content mt-3">
                    <div class="tab-pane active container" id="home"><img src="" class="d-block w-100" alt="..." height="400px" width="800px" id="fnik"></div>
                    <div class="tab-pane container" id="menu1"><img src="" class="d-block w-100" alt="..." height="400px"  width="800px" id="fnpwp"></div>
                    <div class="tab-pane container" id="menu2"><img src="" class="d-block w-100" alt="..." height="400px"  width="800px" id="ftabungan"></div>
                </div>
            </div>
            <div class="modal-footer">
                

            </div>
        </div>
    </div>
</div>

<!-- Daftar Karyawan -->
<form action="{{route('karyawan.simpan') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header text-center">
            <h1 class="modal-title fs-5 " id="exampleModalLabel">Daftar Karyawan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <!-- NIK -->
                    <div class="col-md-2">NIK</div>
                    <div class="col-md-4">
                        <input type="text" class="form-control is-invalid" id="inik" onkeypress="return event.charCode >= 48 && event.charCode <=57"  name="nik" maxlength="16" placeholder="Masukan NIK" required value="{{old('nik')}}">
                    </div>

                    <!-- NPWP -->
                    <div class="col-md-2 ">NPWP</div>
                    <div class="col-md-4 ">
                        <input type="text" class="form-control is-invalid" id="inpwp" onkeypress="return event.charCode >= 48 && event.charCode <=57"  name="npwp" value="{{old('npwp')}}"maxlength="12" placeholder="Masukan NPWP"  required>
                    </div>
                    
                    <!-- NAMA-->
                    <div class="col-md-2 mt-2">NAMA</div>
                    <div class="col-md-4 mt-2"> <input type="text" class="form-control is-invalid" onkeypress="return event.charCode < 48 || event.charCode >57" id="ivendor"   name="nama" value="{{old('nama')}}"maxlength="20" placeholder="Masukan Nama"  required></div>

                    <!-- NAMA PEMILIK -->
                    <div class="col-md-2 mt-2">Tempat Tenggal Lahir</div>
                    <div class="col-md-4 mt-2">
                        <div class="row">
                        <div class="col-md-5">
                            <input type="text" class="form-control is-invalid" onkeypress="return event.charCode < 48 || event.charCode >57" id="pemilik"   name="tempat" value="{{old('tempat')}}"maxlength="20" placeholder="Masukan Nama Vendor"  required>
                        </div> 
                        <div class="col-md-7">
                            <input type="date" class="form-control is-invalid" name="lahir" value="{{old('lahir')}}" id="lahir" require></div>
                        </div>
                    </div>

                    <!-- NAMA-->
                    <div class="col-md-2 mt-2">JENIS KELAMIN</div>
                    <div class="col-md-4 mt-2">
                    <select class="form-select" aria-label="Default select example" name="kelamin" require>
                            <option value="" selected>- Kelamin -</option>
                            <option value="L">LAKI - LAKI</option>
                            <option value="P">PEREMPUAN</option>
                        </select>
                    </div>

                    <!-- NOMOR TELP -->
                    <div class="col-md-2 mt-2">NO TELP</div>
                    <div class="col-md-4 mt-2"><input type="text" class="form-control is-invalid" id="itelp" onkeypress="return event.charCode >= 48 && event.charCode <=57" name="telp" value="{{old('telp')}}"maxlength="12" placeholder="Masukan telp" required></div>
                    
                    <!-- email -->
                    <div class="col-md-2 mt-2">EMAIL</div>
                    <div class="col-md-4 mt-2"><input type="email" class="form-control is-invalid" id="email" name="email" value="{{old('email')}}" maxlength="30" placeholder="Masukan email" required></div>

                    <!-- ALAMAT -->
                    <div class="col-md-2 mt-2">ALAMAT</div>
                    <div class="col-md-4 mt-2">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="ialamat" name="alamat" value="{{old('alamat')}}"></textarea>
                            <label for="floatingTextarea">Masukan Alamat</label>
                        </div>
                    </div>

                    <!-- BANK -->
                    <div class="col-md-2 mt-2">BANK</div>
                    <div class="col-md-4 mt-2">
                    <input list="bank" class="form-select" aria-label="Default select example" id="ibank" placeholder="pilih bank" name="bank" required value="{{old('bank')}}" />
                                        <datalist id="bank">
                                        <option value="CASH ONLY">CASH ONLY</option>
                                            <option value="PANIN BANK">	PANIN BANK	</option>
                                            <option value="OCBC NISP">	OCBC NISP	</option>
                                            <option value="HSBC, Ltd.">	HSBC	</option>
                                            <option value="CIMB Niaga">	CIMB Niaga	</option>
                                            <option value="BCA">BCA	</option>
                                            <option value="BTN">BTN	</option>
                                            <option value="BTN">BTN	</option>
                                            <option value="BRI">BRI	</option>
                                            <option value="BNI">BNI	</option>
                                            <option value="BCA Syariah">	BCA Syariah	</option>
                                            <option value="Bank Yudha Bhakti">	Bank Yudha Bhakti	</option>
                                            <option value="Bank Victoria Syariah">	Bank Victoria Syariah	</option>
                                            <option value="Bank Victoria International">	Bank Victoria International, Tbk	</option>
                                            <option value="Bank UOB Indonesia (Dahulu Uob Buana)">	Bank UOB Indonesia (Dahulu Uob Buana)	</option>
                                            <option value="Bank Tabungan Pensiunan Nasional">	Bank Tabungan Pensiunan Nasional, Tbk	</option>
                                            <option value="Bank Tabungan Pensiunan Nasional (BTPN)">	Bank Tabungan Pensiunan Nasional (BTPN)	</option>
                                            <option value="Bank Syariah Muamalat Indonesia">	Bank Syariah Muamalat Indonesia	</option>
                                            <option value="Bank Syariah Mega Indonesia">	Bank Syariah Mega Indonesia	</option>
                                            <option value="Bank Syariah Mandiri">	Bank Syariah Mandiri	</option>
                                            <option value="Bank Syariah Bukopin">	Bank Syariah Bukopin	</option>
                                            <option value="Bank Syariah BRI">	Bank Syariah BRI	</option>
                                            <option value="Bank Syariah BNI">	Bank Syariah BNI	</option>
                                            <option value="Bank Sinarmas">	Bank Sinarmas, Tbk	</option>
                                            <option value="Bank Sinarmas">	Bank Sinarmas	</option>
                                            <option value="Bank Sinar Harapan Bali">	Bank Sinar Harapan Bali	</option>
                                            <option value="Bank SBI Indonesia">	Bank SBI Indonesia	</option>
                                            <option value="Bank Sahabat Sampoerna">	Bank Sahabat Sampoerna	</option>
                                            <option value="Bank Sahabat Purba Danarta">	Bank Sahabat Purba Danarta	</option>
                                            <option value="Bank Royal Indonesia">	Bank Royal Indonesia	</option>
                                            <option value="Bank Pundi Indonesia">	Bank Pundi Indonesia, Tbk	</option>
                                            <option value="Bank Permata">	Bank Permata Tbk	</option>
                                            <option value="Bank Permata">	Bank Permata	</option>
                                            <option value="Bank Panin Syariah">	Bank Panin Syariah	</option>
                                            <option value="Bank Of India Indonesia">	Bank Of India Indonesia, Tbk	</option>
                                            <option value="Bank OCBC NISP">	Bank OCBC NISP, Tbk	</option>
                                            <option value="Bank Nusantara Parahyangan,Tbk">	Bank Nusantara Parahyangan,Tbk	</option>
                                            <option value="Bank Mutiara">	Bank Mutiara, Tbk	</option>
                                            <option value="Bank Multi Arta Sentosa">	Bank Multi Arta Sentosa	</option>
                                            <option value="Bank Muamalat Indonesia">	Bank Muamalat Indonesia	</option>
                                            <option value="Bank Mitraniaga">	Bank Mitraniaga	</option>
                                            <option value="Bank Metro Express">	Bank Metro Express	</option>
                                            <option value="Bank Mestika Dharma">	Bank Mestika Dharma	</option>
                                            <option value="Bank Mega">	Bank Mega, Tbk	</option>
                                            <option value="Bank Mayora">	Bank Mayora	</option>
                                            <option value="Bank Mayapada International">	Bank Mayapada International Tbk	</option>
                                            <option value="Bank MAY Indonesia Syariah">	Bank MAY Indonesia Syariah	</option>
                                            <option value="Bank Maspion Indonesia">	Bank Maspion Indonesia	</option>
                                            <option value="Bank Mandiri">	Bank Mandiri	</option>
                                            <option value="Bank Lampung">	Bank Lampung	</option>
                                            <option value="Bank Kesejahteraan Ekonomi">	Bank Kesejahteraan Ekonomi	</option>
                                            <option value="Bank Kalimantan Tengah">	Bank Kalimantan Tengah	</option>
                                            <option value="Bank Jatim (dahulu bernama BPD Jawa Timur)">	Bank Jatim (dahulu bernama BPD Jawa Timur)	</option>
                                            <option value="Bank Jateng ( dahulu BPD Jawa Tengah )">	Bank Jateng ( dahulu BPD Jawa Tengah )	</option>
                                            <option value="Bank Jasa Jakarta">	Bank Jasa Jakarta	</option>
                                            <option value="Bank Jabar dan Banten">	Bank Jabar dan Banten	</option>
                                            <option value="Bank Jabar Banten (BJB)">	Bank Jabar Banten, Tbk (BJB)	</option>
                                            <option value="Bank Jabar Banten Syariah">	Bank Jabar Banten Syariah	</option>
                                            <option value="Bank Internasional Indonesia">	Bank Internasional Indonesia Tbk	</option>
                                            <option value="Bank Internasional Indonesia (BII)">	Bank Internasional Indonesia (BII)	</option>
                                            <option value="Bank Index Selindo">	Bank Index Selindo	</option>
                                            <option value="Bank Ina Perdana">	Bank Ina Perdana	</option>
                                            <option value="Bank ICBC Indonesia">	Bank ICBC Indonesia	</option>
                                            <option value="Bank ICB Bumiputera">	Bank ICB Bumiputera Tbk	</option>
                                            <option value="Bank Himpunan Saudara">	Bank Himpunan Saudara 1906, Tbk	</option>
                                            <option value="Bank Harda Internasional">	Bank Harda Internasional	</option>
                                            <option value="Bank Hana">	Bank Hana	</option>
                                            <option value="Bank Ganesha">	Bank Ganesha	</option>
                                            <option value="Bank Fama Internasional">	Bank Fama Internasional	</option>
                                            <option value="Bank Ekonomi Raharja">	Bank Ekonomi Raharja, Tbk	</option>
                                            <option value="Bank DKI">	Bank DKI	</option>
                                            <option value="Bank Danamon Indonesia">	Bank Danamon Indonesia Tbk	</option>
                                            <option value="Bank Danamon">	Bank Danamon	</option>
                                            <option value="Bank Cimb Niaga">	Bank Cimb Niaga, Tbk	</option>
                                            <option value="Bank Bumi Arta">	Bank Bumi Arta, Tbk	</option>
                                            <option value="Bank Bukopin">	Bank Bukopin, Tbk	</option>
                                            <option value="Bank Bri Syariah">	Bank Bri Syariah	</option>
                                            <option value="Bank BNI Syariah">	Bank BNI Syariah	</option>
                                            <option value="Bank Bisnis Internasional">	Bank Bisnis Internasional	</option>
                                            <option value="Bank Artos Indonesia">	Bank Artos Indonesia	</option>
                                            <option value="Bank Andara">	Bank Andara	</option>
                                            <option value="Bank Aceh">	Bank Aceh	</option>
                                        </datalist>
                    </div>
                    <!-- norek -->
                    <div class="col-md-2 mt-2">NOMOR REKENING</div>
                    <div class="col-md-4 mt-2"><input type="text" class="form-control is-invalid" onkeypress="return event.charCode >= 48 && event.charCode <=57" id="inorek" name="norek" value="{{old('norek')}}" maxlength="20" placeholder="Nomor Rekening"  required></div>
                    
                    <div class="col-md-2 mt-2">FOTO NIK</div>
                    <div class="col-md-4 mt-2">
                        <div class="input-group">
                                <input type="file" class="form-control" id="itext" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="f_nik" required>
                        </div>

                    </div>

                    <div class="col-md-2 mt-2 mb-2">FOTO NPWP</div>
                    <div class="col-md-4 mt-2 mb-2">
                        <div class="input-group">
                            <input type="file" class="form-control" id="itext" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="f_npwp" required>  
                        </div>
                    </div>
                    <!-- foto buku tabungan -->
                    <div class="col-md-2 mt-2 mb-2">Foto Buku Tabungan</div>
                    <div class="col-md-4 mt-2 mb-2">
                        <div class="input-group">
                            <input type="file" class="form-control" id="f_tabungan" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="f_tabungan" required>  
                        </div>
                    </div>
                    <!-- jabatan -->
                    <div class="col-md-2 mt-2">JABATAN</div>
                    <div class="col-md-4 mt-2">
                    <select class="form-select" aria-label="Default select example" name="jabatan" require>
                            <option value="" selected>- Jabatan -</option>
                            <option value="1">Owner</option>
                            <!-- <option value="2">Finance</option> -->
                            <option value="3">Purchasing</option>
                            <option value="4">Sales Marketing</option>
                        </select>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal-footer">
        
            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
        </div>
        </div>
    </div>
    </div>
</form>


<!-- Edit Karyawan -->
<form action="{{route('karyawan.edit') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="idnya" >
    <div class="modal fade" id="edit_karyawan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header text-center">
            <h1 class="modal-title fs-5 " id="exampleModalLabel">Edit Data Karyawan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <!-- NIK -->
                    <div class="col-md-2">NIK</div>
                    <div class="col-md-4">
                        <input type="text" class="form-control is-invalid" id="enik" onkeypress="return event.charCode >= 48 && event.charCode <=57"  name="nik" maxlength="16" placeholder="Masukan NIK" required value="{{old('nik')}}">
                    </div>

                    <!-- NPWP -->
                    <div class="col-md-2 ">NPWP</div>
                    <div class="col-md-4 ">
                        <input type="text" class="form-control is-invalid" id="enpwp" onkeypress="return event.charCode >= 48 && event.charCode <=57"  name="npwp" value="{{old('npwp')}}"maxlength="12" placeholder="Masukan NPWP"  required>
                    </div>
                    
                    <!-- NAMA-->
                    <div class="col-md-2 mt-2">NAMA</div>
                    <div class="col-md-4 mt-2"> <input type="text" id="enama" class="form-control is-invalid" onkeypress="return event.charCode < 48 || event.charCode >57" name="nama" value="{{old('nama')}}"maxlength="20" placeholder="Masukan Nama"  required></div>

                    <!-- NAMA PEMILIK -->
                    <div class="col-md-2 mt-2">Tempat Tenggal Lahir</div>
                    <div class="col-md-4 mt-2">
                        <div class="row">
                        <div class="col-md-5">
                            <input type="text" class="form-control is-invalid" onkeypress="return event.charCode < 48 || event.charCode >57" id="epemilik"   name="tempat" value="{{old('tempat')}}"maxlength="20" placeholder="Masukan Nama Vendor"  required>
                        </div> 
                        <div class="col-md-7">
                            <input type="date" class="form-control is-invalid" name="lahir" value="{{old('lahir')}}" id="elahir" require></div>
                        </div>
                    </div>

                    <!-- NAMA-->
                    <div class="col-md-2 mt-2">JENIS KELAMIN</div>
                    <div class="col-md-4 mt-2">
                    <select class="form-select" aria-label="Default select example" id="ekel" name="kelamin" require>
                            <option value="" selected>- Kelamin -</option>
                            <option value="L">LAKI - LAKI</option>
                            <option value="P">PEREMPUAN</option>
                        </select>
                    </div>

                    <!-- NOMOR TELP -->
                    <div class="col-md-2 mt-2">NO TELP</div>
                    <div class="col-md-4 mt-2"><input type="text" class="form-control is-invalid" id="etelp" onkeypress="return event.charCode >= 48 && event.charCode <=57" name="telp" value="{{old('telp')}}"maxlength="12" placeholder="Masukan telp" required></div>
                    
                    <!-- email -->
                    <div class="col-md-2 mt-2">EMAIL</div>
                    <div class="col-md-4 mt-2"><input type="email" class="form-control is-invalid" id="eemail" name="email" value="{{old('email')}}" maxlength="30" placeholder="Masukan email" required></div>

                    <!-- ALAMAT -->
                    <div class="col-md-2 mt-2">ALAMAT</div>
                    <div class="col-md-4 mt-2">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="ealamat" name="alamat" value="{{old('alamat')}}"></textarea>
                            <label for="floatingTextarea">Masukan Alamat</label>
                        </div>
                    </div>

                    <!-- BANK -->
                    <div class="col-md-2 mt-2">BANK</div>
                    <div class="col-md-4 mt-2">
                    <input list="bank" class="form-select" aria-label="Default select example" id="ebank" placeholder="pilih bank" name="bank" required value="{{old('bank')}}" />
                                        <datalist id="bank">
                                        <option value="CASH ONLY">CASH ONLY</option>
                                            <option value="PANIN BANK">	PANIN BANK	</option>
                                            <option value="OCBC NISP">	OCBC NISP	</option>
                                            <option value="HSBC, Ltd.">	HSBC	</option>
                                            <option value="CIMB Niaga">	CIMB Niaga	</option>
                                            <option value="BCA">BCA	</option>
                                            <option value="BTN">BTN	</option>
                                            <option value="BTN">BTN	</option>
                                            <option value="BRI">BRI	</option>
                                            <option value="BNI">BNI	</option>
                                            <option value="BCA Syariah">	BCA Syariah	</option>
                                            <option value="Bank Yudha Bhakti">	Bank Yudha Bhakti	</option>
                                            <option value="Bank Victoria Syariah">	Bank Victoria Syariah	</option>
                                            <option value="Bank Victoria International">	Bank Victoria International, Tbk	</option>
                                            <option value="Bank UOB Indonesia (Dahulu Uob Buana)">	Bank UOB Indonesia (Dahulu Uob Buana)	</option>
                                            <option value="Bank Tabungan Pensiunan Nasional">	Bank Tabungan Pensiunan Nasional, Tbk	</option>
                                            <option value="Bank Tabungan Pensiunan Nasional (BTPN)">	Bank Tabungan Pensiunan Nasional (BTPN)	</option>
                                            <option value="Bank Syariah Muamalat Indonesia">	Bank Syariah Muamalat Indonesia	</option>
                                            <option value="Bank Syariah Mega Indonesia">	Bank Syariah Mega Indonesia	</option>
                                            <option value="Bank Syariah Mandiri">	Bank Syariah Mandiri	</option>
                                            <option value="Bank Syariah Bukopin">	Bank Syariah Bukopin	</option>
                                            <option value="Bank Syariah BRI">	Bank Syariah BRI	</option>
                                            <option value="Bank Syariah BNI">	Bank Syariah BNI	</option>
                                            <option value="Bank Sinarmas">	Bank Sinarmas, Tbk	</option>
                                            <option value="Bank Sinarmas">	Bank Sinarmas	</option>
                                            <option value="Bank Sinar Harapan Bali">	Bank Sinar Harapan Bali	</option>
                                            <option value="Bank SBI Indonesia">	Bank SBI Indonesia	</option>
                                            <option value="Bank Sahabat Sampoerna">	Bank Sahabat Sampoerna	</option>
                                            <option value="Bank Sahabat Purba Danarta">	Bank Sahabat Purba Danarta	</option>
                                            <option value="Bank Royal Indonesia">	Bank Royal Indonesia	</option>
                                            <option value="Bank Pundi Indonesia">	Bank Pundi Indonesia, Tbk	</option>
                                            <option value="Bank Permata">	Bank Permata Tbk	</option>
                                            <option value="Bank Permata">	Bank Permata	</option>
                                            <option value="Bank Panin Syariah">	Bank Panin Syariah	</option>
                                            <option value="Bank Of India Indonesia">	Bank Of India Indonesia, Tbk	</option>
                                            <option value="Bank OCBC NISP">	Bank OCBC NISP, Tbk	</option>
                                            <option value="Bank Nusantara Parahyangan,Tbk">	Bank Nusantara Parahyangan,Tbk	</option>
                                            <option value="Bank Mutiara">	Bank Mutiara, Tbk	</option>
                                            <option value="Bank Multi Arta Sentosa">	Bank Multi Arta Sentosa	</option>
                                            <option value="Bank Muamalat Indonesia">	Bank Muamalat Indonesia	</option>
                                            <option value="Bank Mitraniaga">	Bank Mitraniaga	</option>
                                            <option value="Bank Metro Express">	Bank Metro Express	</option>
                                            <option value="Bank Mestika Dharma">	Bank Mestika Dharma	</option>
                                            <option value="Bank Mega">	Bank Mega, Tbk	</option>
                                            <option value="Bank Mayora">	Bank Mayora	</option>
                                            <option value="Bank Mayapada International">	Bank Mayapada International Tbk	</option>
                                            <option value="Bank MAY Indonesia Syariah">	Bank MAY Indonesia Syariah	</option>
                                            <option value="Bank Maspion Indonesia">	Bank Maspion Indonesia	</option>
                                            <option value="Bank Mandiri">	Bank Mandiri	</option>
                                            <option value="Bank Lampung">	Bank Lampung	</option>
                                            <option value="Bank Kesejahteraan Ekonomi">	Bank Kesejahteraan Ekonomi	</option>
                                            <option value="Bank Kalimantan Tengah">	Bank Kalimantan Tengah	</option>
                                            <option value="Bank Jatim (dahulu bernama BPD Jawa Timur)">	Bank Jatim (dahulu bernama BPD Jawa Timur)	</option>
                                            <option value="Bank Jateng ( dahulu BPD Jawa Tengah )">	Bank Jateng ( dahulu BPD Jawa Tengah )	</option>
                                            <option value="Bank Jasa Jakarta">	Bank Jasa Jakarta	</option>
                                            <option value="Bank Jabar dan Banten">	Bank Jabar dan Banten	</option>
                                            <option value="Bank Jabar Banten (BJB)">	Bank Jabar Banten, Tbk (BJB)	</option>
                                            <option value="Bank Jabar Banten Syariah">	Bank Jabar Banten Syariah	</option>
                                            <option value="Bank Internasional Indonesia">	Bank Internasional Indonesia Tbk	</option>
                                            <option value="Bank Internasional Indonesia (BII)">	Bank Internasional Indonesia (BII)	</option>
                                            <option value="Bank Index Selindo">	Bank Index Selindo	</option>
                                            <option value="Bank Ina Perdana">	Bank Ina Perdana	</option>
                                            <option value="Bank ICBC Indonesia">	Bank ICBC Indonesia	</option>
                                            <option value="Bank ICB Bumiputera">	Bank ICB Bumiputera Tbk	</option>
                                            <option value="Bank Himpunan Saudara">	Bank Himpunan Saudara 1906, Tbk	</option>
                                            <option value="Bank Harda Internasional">	Bank Harda Internasional	</option>
                                            <option value="Bank Hana">	Bank Hana	</option>
                                            <option value="Bank Ganesha">	Bank Ganesha	</option>
                                            <option value="Bank Fama Internasional">	Bank Fama Internasional	</option>
                                            <option value="Bank Ekonomi Raharja">	Bank Ekonomi Raharja, Tbk	</option>
                                            <option value="Bank DKI">	Bank DKI	</option>
                                            <option value="Bank Danamon Indonesia">	Bank Danamon Indonesia Tbk	</option>
                                            <option value="Bank Danamon">	Bank Danamon	</option>
                                            <option value="Bank Cimb Niaga">	Bank Cimb Niaga, Tbk	</option>
                                            <option value="Bank Bumi Arta">	Bank Bumi Arta, Tbk	</option>
                                            <option value="Bank Bukopin">	Bank Bukopin, Tbk	</option>
                                            <option value="Bank Bri Syariah">	Bank Bri Syariah	</option>
                                            <option value="Bank BNI Syariah">	Bank BNI Syariah	</option>
                                            <option value="Bank Bisnis Internasional">	Bank Bisnis Internasional	</option>
                                            <option value="Bank Artos Indonesia">	Bank Artos Indonesia	</option>
                                            <option value="Bank Andara">	Bank Andara	</option>
                                            <option value="Bank Aceh">	Bank Aceh	</option>
                                        </datalist>
                    </div>
                    <!-- norek -->
                    <div class="col-md-2 mt-2">NOMOR REKENING</div>
                    <div class="col-md-4 mt-2"><input type="text" class="form-control is-invalid" onkeypress="return event.charCode >= 48 && event.charCode <=57" id="enorek" name="norek" value="{{old('norek')}}" maxlength="20" placeholder="Nomor Rekening"  required></div>
                    
                    <div class="col-md-2 mt-2">FOTO NIK</div>
                    <div class="col-md-4 mt-2">
                        <div class="input-group">
                                <input type="file" class="form-control" id="efnik" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="f_nik" >
                        </div>

                    </div>

                    <div class="col-md-2 mt-2 mb-2">FOTO NPWP</div>
                    <div class="col-md-4 mt-2 mb-2">
                        <div class="input-group">
                            <input type="file" class="form-control" id="efnpwp" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="f_npwp" >  
                        </div>
                    </div>
                    <!-- foto buku tabungan -->
                    <div class="col-md-2 mt-2 mb-2">Foto Buku Tabungan</div>
                    <div class="col-md-4 mt-2 mb-2">
                        <div class="input-group">
                            <input type="file" class="form-control" id="eftabungan" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="f_tabungan" >  
                        </div>
                    </div>
                    <!-- jabatan -->
                    <div class="col-md-2 mt-2">JABATAN</div>
                    <div class="col-md-4 mt-2">
                    <select class="form-select" aria-label="Default select example" name="jabatan" id="ejabatan" require>
                            <option value="" selected>- Jabatan -</option>
                            <option value="1">Owner</option>
                            <option value="2">Finance</option>
                            <option value="3">Purchasing</option>
                            <option value="4">Sales Marketing</option>
                        </select>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal-footer">
        
            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
        </div>
        </div>
    </div>
    </div>
</form>

<script type="text/javascript">
function employed(nama, alamat, f_nik, f_npwp, f_tabungan, ktp, npwp, norek, bank, id) {

    document.getElementById("judul").innerHTML = nama;

    document.getElementById("fnik").src = "{{ asset('images/ktp') }}/" + f_nik;
    document.getElementById("fnpwp").src = "{{ asset('images/npwp') }}/" + f_npwp;
    document.getElementById("ftabungan").src = "{{ asset('images/tabungan') }}/" + f_tabungan;
    // document.getElementById("ktp").innerHTML = ktp;
    // document.getElementById("npwp").innerHTML = npwp;
    // document.getElementById("tabungan").innerHTML = bank + " - " + norek;
    // document.getElementById("beri").value = ktp;
    // document.getElementById("tolak").value = ktp;
    // document.getElementById("oke").value = id;
    $('.nav-tabs a').click(function(){
        $(this).tab('show');
    })


}

$('.form-control').keyup(function(){
    if( $(this).val()!== '')
    {
        $(this).addClass('is-valid');
        $(this).removeClass('is-invalid inputan');
    }
    else
    {
        $(this).addClass('is-invalid inputan');
    }
  
});

$(document).ready( function () {
    $('#tabel_karyawan').DataTable();
} );

function edit_karyawan(nik,npwp,nama,tempat,tanggal,kelamin,telp,email,alamat,bank,norek,f_nik,f_npwp,f_tabungan,akses,jabatan,id){
    // console.log(nik,npwp,nama,tempat,tanggal,kelamin,telp,email,alamat,bank,norek,f_nik,f_npwp,f_tabungan,akses);
// console.log(tanggal);

const ymd = tanggal.split('-');
const y=ymd[0];
const m=ymd[1];
const d=ymd[2];
// console.log($("elahir").val());
console.log(norek);
document.getElementById('idnya').value =id;
document.getElementById('enik').value =nik;
document.getElementById('enpwp').value =npwp;
document.getElementById('enama').value =nama;
document.getElementById('epemilik').value =tempat;
document.getElementById('elahir').value =tanggal;
document.getElementById('ekel').select =kelamin;
document.getElementById('etelp').value =telp;
document.getElementById('eemail').value =email;
document.getElementById('ealamat').value =alamat;
document.getElementById('ebank').value =bank;
document.getElementById('enorek').value = norek;
// document.getElementById('efnik').value =f_nik;
// document.getElementById('efnpwp').value =f_npwp;
// document.getElementById('eftabungan').value =f_tabungan;
document.getElementById('ejabatan').value = jabatan;
}
</script>
@endsection