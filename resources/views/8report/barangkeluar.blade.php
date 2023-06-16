<table id="brgklr" class="table table-striped dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
            <th class="col">#</th>    
                <th class="col">Tgl</th>
                <th class="col">Dibuat</th>
                <th class="col">Invoice</th>
                <th class="col">Customer</th>
                <th class="col">Telp</th>
                <th class="col">Marketplace</th>
                <th class="col">Grandotal</th>
                <th class="col"></th>
            </tr>
        </thead>
        <tbody>
        @foreach($data_jual as $data)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->tgl_jual}}</td>
            <td>
                @foreach($employe as $employed)
                @if($employed->email == $data->email)
                {{$employed->nama}}
                @endif
                @endforeach
            </td>
            <td>{{$data->invoice}}</td>
            <td>{{$data->nama_pelanggan}}</td>
            <td>{{$data->telp}}</td>
            <td>
            @if($data->market_place == 1)
            Facebook
            @elseif ($data->market_place ==2)
            Shoppe
            @else
            Lazada
            @endif

            </td>
            <td>Rp. {{number_format($data->grandtotal)}}</td>
            <td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailsell" onclick="nilai('{{$data->invoice }}','{{$data-> nama_pelanggan}}','{{$data->alamat_pelanggan }}','{{$data-> telp}}','{{$data-> tgl_jual}}','{{$data->market_place }}','{{$data->grandtotal }}','{{$data->email }}','{{$data->bukti_pembelian}}')" ><i class="bi bi-folder2-open"></i> </button></td>
        </tr>
        @endforeach
        </tbody>
        <tr class="table-dark">
            <td colspan="7" align="center">Grandtotal</td>
            <td colspan="2" >Rp. {{number_format($data_jual->sum('grandtotal') )}}</td>
        </tr>
</table>
<!-- modal detail -->
<div class="modal fade" id="detailsell" height="300" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Nomor Invoice : xxx</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-2 ">
            <p class="lh-base">Nama Cust.<br>
                Telp<br>
                Alamat<br></p>
                
            </div>
            <div class="col-md-4">
                <p class="lh-base" id="bagian_kiri"> isi datanya </p></div>
            <div class="col-md-2">
            <p class="lh-base">Tgl Jual<br>
                Penjualan<br>
                Dibuat<br></p>
            </div>
            <div class="col-md-4"><p class="lh-base" id="bagian_kanan">isi datanyaa</p></div>
        </div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home">Detail</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu1">Bukti Penjualan</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active container" id="home">
                <table class="table table-striped">
                    <thead>
                        <tr class="table-primary">
                        <th scope="col">No</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Warna</th>
                        <th scope="col">Ukuran</th>
                        <th scope="col">Pembelian</th>
                        <th scope="col">Penjualan</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="detailbeli">
                        <tr>
                        <td scope="col" id="no">No</th>
                        <td scope="col" id="kobar"></td>
                        <td scope="col" id="nabar" ></td>
                        <td scope="col" id="warna" ></td>
                        <td scope="col" id="ukuran" ></td>
                        <td scope="col" id="beli" ></td>
                        <td scope="col" id="jual" ></td>
                        <td scope="col" id="qty" ></td>
                        <td scope="col" id="subtotal" ></td>
                        </tr>

                    </tbody>
                </table><br>
            </div>
            <div class="tab-pane container" id="menu1"><img src="" class="d-block" width=1100px height=500px id="bukti" align=center></div>
        </div>
        
        
        



      </div>
        


      <div class="modal-footer">
       
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function () {
    $('#brgklr').DataTable(
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

function nilai(invoice,nama_pelanggan,alamat_pelanggan,telp,tgl_jual,market_place,grandtotal,email,bukti_pembelian){
    document.getElementById("staticBackdropLabel").innerHTML ="Nomor Invoice : " + invoice;
    document.getElementById("bagian_kiri").innerHTML =" : " + nama_pelanggan+" <br> : " + telp + " <br> : " + alamat_pelanggan;
    document.getElementById("bagian_kanan").innerHTML =" : "+ tgl_jual +"<br> : " +market_place + "<br> : " + email ;
    document.getElementById("bukti").src ="{{ asset('images/') }}/" + bukti_pembelian;
    $value = invoice;
    // console.log(invoice,nama_pelanggan,alamat_pelanggan,telp,tgl_jual,market_place);
    document.getElementById("bukti").src ="{{ asset('images/') }}/" + bukti_pembelian;
    console.log(bukti_pembelian);
    $.ajax({
    type:"get",
    url : "{{URL::to("/cselling")}}",
    dataType : "json",
    data : {"search":$value},
    success:function(res)
        {
            var nomor = 1;
            var isi = '';
            $.each(res.data,function(index,brg){
            isi += '<tr>'+
            '<td>' + nomor++ +'</td>'+
            '<td>' + brg.kode_barang +'</td>'+
            '<td>' + brg.nama_barang +'</td>'+
            '<td>' + brg.warna +'</td>'+
            '<td>' + brg.ukuran +'</td>'+
            '<td>' + brg.beli +'</td>'+
            '<td>' + brg.jual +'</td>'+
            '<td>' + brg.qty +'</td>'+
            '<td>' + brg.subtotal +'</td></tr>'
            });
            
            const $rupiah = (number)=>{
                return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
                }).format(number);
            }
        
        $baris = "<tr class='table-dark'><th colspan='7' align='center'>GrandTotal</th><th colspan='2' align='center'> "+ $rupiah(grandtotal) +"</th></tr>";
        $("#detailbeli").html(isi + $baris);
       
        }

    });
    
   
} 


</script>