<table id="brgmasuk" class="table table-striped dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th class="col">#</th>
                <th class="col">tanggal</th>
                <th class="col">Dibuat</th>
                <th class="col">Nomor PO</th>
                <th class="col">Nama Vendor</th>
                <th class="col">Subtotal</th>
                <th class="col">Status Pengajuan</th>
                <th class="col">Status Bayar</th>
                <th class="col">.</th>
            </tr>
        </thead>
        <tbody>

            @foreach($data_beli as $dt)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$dt->dibuat}}</td>
                <td>
                @foreach($employe as $emp)
                @if($emp->email == $dt->email)
                    {{$emp->nama}}
                @endif
                @endforeach


                </td>
                <td>{{$dt->nopo}}</td>
                <td>{{$dt->nama_vendor}}</td>
                <td>Rp. {{number_format($dt->grandtotal)}}</td>
                <td>{{$dt->status_pengajuan}}</td>
                <td>{{$dt->status_bayar}}</td>
                <td>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailvendor" onclick="detail('{{$dt->nopo}}','{{$dt->Kode_vendor }}','{{$dt->nama_vendor }}','{{$dt->bank }}','{{$dt->norek }}','{{$dt->grandtotal }}','{{$dt->bukti_bayar}}','{{$dt->status_bayar }}','{{$dt->telp }}','{{$dt->dibuat }}')"> <i class="bi bi-folder2-open"></i> </button>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tr class="table-dark">
                <td class="col text-center" colspan="5">GrandTotal</td>
                <td class="col" colspan="4">Rp. {{number_format($data_beli->sum('grandtotal') )}}</td>
            </tr>
    </table>


<!-- modalnya pembelian-->
<div class="modal fade" id="detailvendor" height="300" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="nopoj">Purchase Order Number : xxx</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home">Detail Pembelian</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu2">Bukti Bayar</a>
            </li>
            
        </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active container" id="home">
                    <div class="row">
                        <div class="col-md-2 ">
                        <p class="lh-base">Vendor Code<br>
                            Vendor Name<br>
                            Call Number<br></p>
                            
                        </div>
                        <div class="col-md-4">
                        <p class="lh-base" id="bagkiri"> isi datanya </p></div>
                        <div class="col-md-2">
                        <p class="lh-base">Created Date<br>
                            Bank<br>
                            Account Number<br></p>
                        </div>
                        <div class="col-md-4"><p class="lh-base" id="bagkanan">isi datanyaa</p></div>
                    </div>
                    <table class="table table-striped" width="100%" id="modal-table">
                        <thead>
                            <tr class="table-primary">
                                <th scope="col">No</th>
                                <th scope="col">Kode Barang</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Warna</th>
                                <th scope="col">Ukuran</th>
                                <th scope="col">Beli</th>
                                <th scope="col">QTY</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="hasil">
                            

                        </tbody>
                    </table>
                </div>

                <div class="tab-pane container" id="menu2"><img src=" " alt="..." id="bukti2" style="hegiht: 100px;" width="600" height="600"></div>
            
            </div>


            
      </div>
      
    </div>
  </div>
</div>

<script>
    $(document).ready(function () {
        $('#brgmasuk').DataTable(
            {
            dom: 'Bfrtip',
            buttons: [
                {
                    extend:    'excelHtml5',
                    text:      '<i class="fa fa-file-excel-o"></i> Excel',
                    titleAttr: 'Excel'
                },
                {
                    extend:    'csvHtml5',
                    text:      '<i class="bi bi-filetype-csv"></i> CSV',
                    titleAttr: 'CSV'
                },
                {
                    extend:    'pdfHtml5',
                    text:      '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: 'PDF'
                },
                {
                    extend:    'print',
                    text:      '<i class="bi bi-printer-fill"></i> print',
                    titleAttr: 'print'
                }
                // 'print'
                

                // 'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        }
        );
    });
    function detail(nopo,kode_vendor, nama_vendor,bank, norek,grandtotal,bukti_bayar,status_bayar,telp,dibuat)
    {
        // console.log(nopo,kode_vendor, nama_vendor,bank, norek,grandtotal,bukti_bayar,status_bayar,telp);
        $value = nopo;
        const $rupiah = (number)=>{
                    return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                    }).format(number);
                }
        $.ajax({
                type: 'get',
                url:'{{URL::to('/detailbeli') }}',
                dataType: 'json',
                data: {'search': $value},
                success: function(res) 
                {
                    const $rupiah = (number)=>{
                    return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                    }).format(number);
                }

                    var nomor = 1;
                    var isi = '';
                    $.each(res.data, function(index, brg) {
                    isi += '<tr>' +
                        '<td>' + nomor++ +'</td>' +
                        '<td>' + brg.kode_barang + '</td>'+
                        '<td>' + brg.nama_barang + '</td>' +
                        '<td>' + brg.warna + '</td>' +
                        '<td>' + brg.ukuran + '</td>'+
                        '<td>'+ $rupiah(brg.harga_beli)+'</td>'+
                        '<td>'+brg.qty+'</td>'+
                        '<td>'+ $rupiah(brg.subtotal)+'</td>'+
                    '</tr>';
                });
                
                

                // console.log(rupiah);
                $baris= '<tr><th colspan="6">GrandTotal </th><th colspan="2" align="center">' + $rupiah(grandtotal) + '</th></tr>';
                    $("#hasil").html(isi + $baris);
                }
            });
            document.getElementById("nopoj").innerHTML = "Purchase Order Number : "+nopo;
        document.getElementById("bagkiri").innerHTML = " : " + kode_vendor + "<br> : " + nama_vendor + "<br> : " + telp;
        document.getElementById("bagkanan").innerHTML =" : " + dibuat + "<br> : " + bank + "<br> : " + norek;
        document.getElementById("bukti2").src ="{{ asset('images/') }}/" + bukti_bayar;
    }
</script>