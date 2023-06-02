@section('title','Form Data Vendor')

@extends('layout.layout')
@section('konten')
<div class="container-fluid">
    <div class="col-md-6 mt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ms-3">
                    <li class="breadcrumb-item"><a class="jdl fs-5" href="{{url('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a class="jdl fs-5" href="{{url('/vendors') }}">Tabel Barang</a></li>
                    <li class="breadcrumb-item"><a class="jdl fs-5 text-secondary" href="#">Tabel Barang</a></li>
                </ol>
            </nav>
    </div>
    <div class="col-md-12 shadow bg-cards border rounded-3">
    <div style="width:100%;height: 700px;" class="overflow-scroll d-flex justify-content-center mt-3">
        
        <form method="post" action="{{ url('vendors/form/save') }}" enctype="multipart/form-data">
            @csrf
            
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    {{ $error }} <br/>
                    @endforeach
                </div>
                @endif

            <input type="hidden" class="form-control" name="k_vendor" maxlength="7" placeholder="Masukan nomor KTP" value="<?php
            echo "VNR"?> {{++$vendor}}">
            <input type="hidden" name="created" value="<?php echo date('d-M-Y') ?>">


        <div class="row " style="width: 1000px;">
                <div class="col-md-12" align="center" ><h3>FORM REGISTER VENDOR</h2><hr></div>
                <!-- NIK -->
                <div class="col-md-5  d-flex justify-content-end align-items-center">NIK</div>
                <div class="col-md-4"><input type="text" class="form-control is-invalid inputan" id="inik" onkeypress="return event.charCode >= 48 && event.charCode <=57"  name="nik" maxlength="16" placeholder="Masukan NIK" required></div>

                <!-- NPWP -->
                <div class="col-md-5  d-flex justify-content-end align-items-center mt-2">NPWP</div>
                <div class="col-md-4 mt-2"><input type="text" class="form-control is-invalid inputan" id="inpwp" onkeypress="return event.charCode >= 48 && event.charCode <=57"  name="npwp" maxlength="12" placeholder="Masukan NPWP"  required></div>

                <!-- nama VENDOR-->
                <div class="col-md-5  d-flex justify-content-end align-items-center mt-2">NAMA VENDOR</div>
                <div class="col-md-4 mt-2"> <input type="text" class="form-control is-invalid inputan" onkeypress="return event.charCode < 48 || event.charCode >57" id="ivendor"   name="n_vendor" maxlength="50" placeholder="Masukan Nama Vendor"  required></div>
                <!-- NAMA PEMILIK -->
                <div class="col-md-5  d-flex justify-content-end align-items-center mt-2">NAMA PEMILIK</div>
                <div class="col-md-4 mt-2"> <input type="text" class="form-control is-invalid inputan" onkeypress="return event.charCode < 48 || event.charCode >57" id="pemilik"   name="n_pemilik" maxlength="50" placeholder="Masukan Nama Vendor"  required></div>

                <!-- NOMOR TELP -->
                <div class="col-md-5  d-flex justify-content-end align-items-center mt-2">NO TELP</div>
                <div class="col-md-4 mt-2"><input type="text" class="form-control is-invalid inputan" id="itelp" onkeypress="return event.charCode >= 48 && event.charCode <=57" name="telp" maxlength="12" placeholder="Masukan telp" required></div>
                
                <!-- ALAMAT -->
                <div class="col-md-5  d-flex justify-content-end align-items-center mt-2">ALAMAT</div>
                <div class="col-md-4 mt-2">
                    <div class="form-floating">
                        <textarea class="form-control" name="alamat" placeholder="Leave a comment here" id="ialamat"></textarea>
                        <label for="floatingTextarea">Masukan Alamat</label>
                    </div>
                </div>

                <!-- BANK -->
                <div class="col-md-5  d-flex justify-content-end align-items-center mt-2">BANK</div>
                <div class="col-md-4 mt-2">
                <input list="bank" class="form-select" aria-label="Default select example" id="ibank" placeholder="pilih bank" name="bank" required />
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

                <div class="col-md-5  d-flex justify-content-end align-items-center mt-2">NOMOR REKENING</div>
                <div class="col-md-4 mt-2"><input type="text" class="form-control is-invalid inputan" onkeypress="return event.charCode >= 48 && event.charCode <=57" id="inorek" name="norek" maxlength="12" placeholder="Nomor Rekening"  required></div>

                <div class="col-md-5  d-flex justify-content-end align-items-center mt-2">FOTO NIK</div>
                <div class="col-md-4 mt-2">
                    <div class="input-group">
                            <input type="file" class="form-control" id="itext" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="f_nik" accept="image/png, image/gif, image/jpeg" required>
                    </div>

                </div>

                <div class="col-md-5  d-flex justify-content-end align-items-center mt-2 mb-2">FOTO NPWP</div>
                <div class="col-md-4 mt-2 mb-2">
                    <div class="input-group">
                        <input type="file" class="form-control" id="itext" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="f_npwp" accept="image/png, image/gif, image/jpeg" required>  
                    </div>
                </div>

                <div class="col-md-5  d-flex justify-content-end align-items-center mt-2 mb-2">FOTO BUKU TABUNGAN</div>
                <div class="col-md-4 mt-2 mb-2">
                    <div class="input-group">
                        <input type="file" class="form-control" id="itext" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="f_buku" accept="image/png, image/gif, image/jpeg" required>  
                    </div>
                </div>
                <br>
                <hr>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mb-3 " name="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> SAVE</button>
            </div>
        </form>
    </div>
    </div>

</div>

<script>
    const input = document.querySelector('inputan');
    
$('.inputan').keyup(function(){
    if( $(this).val() !== '')
    {
        $(this).addClass('is-valid');
        $(this).removeClass('is-invalid inputan');
    }
    else
    {
        $(this).addClass('is-invalid inputan');
    }
  
})
</script>
@endsection