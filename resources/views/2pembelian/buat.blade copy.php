@section('title','Buat Pembelian')

@extends('layout.layout')
@section('konten')
<style>
    .qty-barang{
    width: 5vw;
    height: 5vh;
    background-color: #f5f5f5;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    color: black;
    }
    .tambahkan{
        background-color: #0d6efd;
    width: 30px;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    color: white;
    align-items: center;
    display: flex;
    justify-content: center;
    text-decoration: none;
    cursor: pointer;
    }
    .kurang{
    background-color: #0d6efd;
    width: 30px;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    color: white;
    align-items: center;
    display: flex;
    justify-content: center;
    text-decoration: none;
    cursor: pointer;
    }
</style>

<div class="container-fluid">
    <div class="frame base-system">
        <!-- navigasi -->
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('home') }}" class="fs-5  " >Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{url('pembelian') }}" class="fs-5 " >Data Pembelian</a></li>
                    <li class="breadcrumb-item active text-light fs-5" aria-current="page">Buat Pembelian</li>
                </ul>
            </nav>
        </div>
        <!-- maincontent -->
        <form action="{{route('savepo') }}" method="post">
                @csrf
            <div class="col-md-12">
                <div class="container-fluid border border-3 shadow" style="border-radius:20px; background-color:#E8ECFC;">
                    <div class="row justify-content-center">
                        <!-- header -->
                        <div class="col-md-12 m-2">
                            <div class="row">
                                <div class="col-md-2 mt-2">Nomor PO</div>
                                <div class="col-md-4 mt-2"><input type="text" name="nopo" class="form-control" id="inputPassword" value="{{$notrans}}" readonly></div>
                                <div class="col-md-2 mt-2">Tanggal Dibuat</div>
                                <div class="col-md-4 mt-2"><input type="text" class="form-control" id="inputPassword" name="tanggal" value="<?php echo date('d M Y');?>" readonly></div>
                                
                                <div class="col-md-2 mt-2">Nama Vendor</div>
                                <div class="col-md-4 mt-2">
                                    <select class="form-select" aria-label="Default select example" id="vendors" name="kode_vendor" required>
                                        <option selected>- Pilih Vendor -</option>
                                        @foreach($vendor as $vendor)
                                            <option value="{{$vendor->kode_vendor}}">{{$vendor->nama_vendor}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mt-2">Kode Vendor</div>
                                <div class="col-md-4 mt-2"><input type='text' class='form-control' name='vcode' id="vcode" readonly required></div>
                                
                                <div class="col-md-2 mt-2">Nama Bank</div>
                                <div class="col-md-4 mt-2"><input type="text" class="form-control" name="vbank" id="nbank" readonly required></div>
                                <div class="col-md-2 mt-2">Nomor Rekening</div>
                                <div class="col-md-4 mt-2"><input type="text" class="form-control" name="norek" id="nnorek"  readonly required></div>
                                
                                <!-- <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div> -->
                                
                                





                            </div>
                        </div>
                        <!-- garis -->
                        <div class="col-md-11"> <hr> </div>
                        <!-- table Area -->
                        
                            <div class="col-md-12">
                                <div style="height:370px; overflow:auto;" >
                                    <table class="table table-hover table-striped show-cart" id="table_form">
                                        <thead class="table-primary">
                                            <tr class="text-center">
                                                <th class="col" >Kode Barang</th>
                                                <th class="col" >Nama Barang</th>
                                                <th class="col" >Ukuran</th>
                                                <th class="col" >Warna</th>
                                                <th class="col" >Harga Satuan</th>
                                                <th class="col" style="width:150px; text-align:center;">Qty</th>
                                                <th class="col text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tambah_item">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-12 border-top">
                                <div class="row justify-content-start mt-3 mb-3">
                                    <div class="col-md-2 d-flex justify-content-start mb-3">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                        Tambah Item
                                        </button>
                                    </div>

                                    <div class="col-md-10 d-flex justify-content-end mb-3">
                                        <button type="submit" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                                <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                            </svg>
                                    Simpan
                                        </button>
                                    </div>
                                    
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- bagian modalnya -->
        <div class="modal fade" id="item" tabindex="-1"  data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true" style="height:800px; overflow:auto;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">List Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <table class="table table-hover table-striped show-cart" id="table_modal" style="width:100%">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th class="col text-center" colspan="2">#</th>
                                    <th class="col" >Kode Barang</th>
                                    <th class="col" >Nama Barang</th>
                                    <th class="col" >Ukuran</th>
                                    <th class="col" >Warna</th>
                                </tr>
                            </thead>
                            <tbody id="tambah_item">
                            @foreach($barang as $br)
                            <tr class="add-to-cart" style="cursor:pointer;" data-id="{{$br->id}}" data-kode="{{$br->kode_barang}}" data-nama="{{$br->nama_barang}}" data-ukuran="{{$br->ukuran}}" data-warna="{{$br->warna}}" data-beli="{{$br->beli}}" data-deskripsi="{{$br->deskripsi}}" >    
                                <td><input class="form-check-input" type="checkbox" id="flexCheckDefault"></td>
                                <td>{{$loop->iteration}} </td>
                                <td>{{$br->kode_barang}}</td>
                                <td>{{$br->nama_barang}}</td>
                                <td>{{$br->ukuran}}</td>
                                <td>{{$br->warna}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
        <!-- sampe sini -->




    </div>
</div>


<!-- season storage -->
<script>
    var keranjang = (function(){
        cart=[];

        // konstruktor
        // isi dari fungsi item itu ini
        function Item (id,kode,nama,ukuran,warna,beli,deskripsi,hitung)
        {
            this.id = id;
            this.kode=kode;
            this.nama = nama;
            this.ukuran=ukuran;
            this.warna=warna;
            this.beli=beli;
            this.deskripsi=deskripsi;
            this.hitung = hitung;
        }
        // sampe sini
        // simpan cart
        function simpanCart()
        {
            sessionStorage.setItem("keranjang",JSON.stringify(cart));
        }
        // sampe sini

        // memanggil data / load data
        function loadCart()
        {
            JSON.parse(sessionStorage.getItem("keranjang"));
        }

        if(sessionStorage.getItem("keranjang") != null)
        {
            loadCart();
        }

        // menampilkan di publik
        var objek = {};
        // tambah item ke cart
        objek.TambahItemToCart = function(id,kode,nama,ukuran,warna,beli,deskripsi,hitung)
        {
            for(var item in cart)
            {
                if(cart[item].kode === kode)
                {
                    cart[item].hitung++;
                    simpanCart();
                    return;
                }
            }
            var item = new Item(id,kode,nama,ukuran,warna,beli,deskripsi,hitung);
            cart.push(item);
            simpanCart();
        };

        // menghitung jumlah item
        objek.setCountForItem = function (kode,nama,hitung)
        {
            for(var i in cart)
            {
                if(cart[i].kode===kode)
                {
                    cart[i].hitung = hitung;
                    break;
                }
            }
        };
        objek.tambahKuantitas = function (kode,nama)
        {
            for(var item in cart)
            {
                if(cart[item].kode === kode)
                {
                    cart[item].hitung++;
                    simpanCart();
                    return;
                }
            }
        }
        // hapus item dari cartnya
        // hapus item dari cartnya
        objek.removeItemFromCart = function (kode,nama)
        {
            for(var item in cart)
            {
                if(cart[item].kode === kode)
                {
                    cart[item].hitung--;
                    if(cart[item].hitung <1 )
                    {
                        cart.splice(item, 1);
                    }
                    simpanCart();
                    return;
                }
            }
            // simpanCart();
        };

        objek.removeItemFromCartAll = function(kode){
            for(var item in cart){
                if (cart[item].kode === kode) {
                    cart.splice(item, 1);
                    break;
                  }
            }
            simpanCart();
        };

        // bersihkan cart
        objek.clearCart= function()
        {
            cart =[];
            simpanCart();
        };

        // hitung cart total
        objek.totalHitung = function () 
        {
            var totalHitung = 0;
            for(var item in cart){
                totalHitung += cart[item].hitung;
            }    
            return totalHitung;
        };
        
        // total Cart
        objek.totalCart = function(){
            var totalCart = 0;
            for(var item in cart)
            {
                totalCart += cart[item].beli * cart[item].hitung;
            }
            return Number(totalCart.toFixed(2));
        }

        // list cart
        objek.listCart = function()
        {
            var cartCopy = [];
            for(i in cart)
            {
                item = cart[i];
                itemCopy ={};
                for (p in item)
                {
                    itemCopy[p] = item[p];
                }
                // itemCopy.total = Number.(item.beli * item.hitung);
                cartCopy.push(itemCopy);
            }
            return cartCopy;
        };
        return objek;
    })();

    $(".add-to-cart").click(function(event){
        event.preventDefault();
        var checkbox = this.querySelector("input[type='checkbox']");
        checkbox.checked = !checkbox.checked;
        var id = $(this).data("id");
            var kode = $(this).data("kode");
            var nama = $(this).data("nama");
            var ukuran = $(this).data("ukuran");
            var warna = $(this).data("warna");
            var beli = $(this).data("beli");
            var deskripsi = $(this).data("deskripsi");

        if(checkbox.checked){
            keranjang.TambahItemToCart(id,kode,nama,ukuran,warna,beli,deskripsi,1);
            tampilCart();
        }
        else{
            keranjang.removeItemFromCartAll(kode);
            tampilCart();
        }
    });
    // Clear items
    $(".clear-cart").click(function () {
        keranjang.clearCart();
        tampilCart();
            });


    function tampilCart(){
        var cartArray = keranjang.listCart();
        var konten ="";
        const rupiah = (number)=>{
            return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR"
            }).format(number);
        }

        for(var i in cartArray)
        {
            konten +="<tr class='text-center'>"+
                            "<td>"+cartArray[i].kode+"<input type='hidden' value='"+cartArray[i].kode+"' name='kode[]' required> </td>"+
                            "<td>"+cartArray[i].nama+"</td>"+
                            "<td>"+cartArray[i].ukuran+"</td>"+
                            "<td>"+cartArray[i].warna+"</td>"+
                            "<td>"+rupiah(cartArray[i].beli)+"<input type='hidden' value='"+cartArray[i].beli+"' name='beli[]'></td>"+
                            "<td>"+
                            
                            "<div class='input-group mb-3'>"+
                                "<a class='kurang' data-kode='"+cartArray[i].kode+"' > - </a>"+
                                "<a class='qty-barang'>"+cartArray[i].hitung+"</a>"+
                                "<input type='hidden' class='item-count form-control text-center' readonly data-kode='"+cartArray[i].kode+"' value='"+cartArray[i].hitung+"' name='qty[]' max='"+cartArray[i].kuantitas+"' required>"+
                                // "<button class='plus-item btn btn-primary input-group-addon' data-kode='"+cartArray[i].kode+"' > + </button>"+
                                "<a class='tambahkan' data-kode='"+cartArray[i].kode+"' > + </a>"+
                            "</div>"+
                            "<td><button class='btn btn-danger hapus' onclick='hapus(this)'data-kode='"+cartArray[i].kode+"' ><i class='bi bi-trash3'></i> </button> </td>"+
                            "</td>"+
                            // "<input type='number' class='item-count form-control' name='qty[]' data-kode='" +cartArray[i].kode +"' value='" +cartArray[i].hitung +"'>" +
                    "</tr>" ;
        }
        $("#tambah_item").html(konten);
    }
            // -1
            $("#tambah_item").on("click", ".kurang", function (event) {
              var kode = $(this).data("kode");
              keranjang.removeItemFromCart(kode);
              tampilCart();
            });
            $("#tambah_item").on('click','.tambahkan', function (even) {
                var name = $(this).data("name");
                var kode = $(this).data("kode");
                // keranjang.TambahItemToCart(kode,name);
                console.log(kode);
                keranjang.tambahKuantitas(kode);
                tampilCart();
                
            });
            
            $("#tambah_item").on("click", ".hapus", function (event) {
              var kode = $(this).data("kode");
              keranjang.removeItemFromCartAll(kode);
              tampilCart();
            });
            tampilCart();


            $(document).ready(function() {
                    $(document).on('change', '#vendors', function() {
                        const $vendorr = $('#vendors').val();
                        $.ajax({
                            type: 'get',
                            url: '{{URL::to('/pembelian/BuatPembelian/simpan/carivendor')}}',
                            data: {'vnd': $vendorr},
                            success: function(res) {
                                var nvendor = "";
                                var bank = "";
                                var norek = "";

                                $.each(res.data, function(index, vdr) {


                                    $("#vcode").val(vdr.kode_vendor);
                                    $("#nbank").val(vdr.bank);
                                    $("#nnorek").val(vdr.norek);
                                    console.log(vdr);
                                    nvendor +=
                                        "<input type='text' class='form-control' name='vcode' value='" +
                                        vdr.kode_vendor + "' disabled>";
                                    bank +=
                                        "<input type='text' class='form-control' name='vbank' value='" +
                                        vdr.bank + "' disabled>";
                                    norek +=
                                        "<input type='text' class='form-control' name='vnorek' value='" +
                                        vdr.norek + "' disabled>";
                                });

                                $('#kode_vendor').html(nvendor);
                                $('#bank').html(bank);
                                $('#norek').html(norek);
                            }
                        });
                    });

                });
</script>
<!-- sampe sini -->
@foreach($barang as $brg)
<script>
function value_check(kobar,nabar,ukuran,warna,beli,deskripsi){
    var panjang = document.getElementById("table_form").rows.length;
        var konten = "<tr id=row_"+panjang+">"+
                            "<td><button class='btn btn-danger' onclick='hapus(this)' ><i class='bi bi-trash3'></i> </button> </td>"+
                            "<td>"+panjang+"</td>"+
                            "<td>"+kobar+"</td>"+
                            "<td>"+nabar+"</td>"+
                            "<td>"+ukuran+"</td>"+
                            "<td>"+warna+"</td>"+
                            "<td>"+beli+"</td>"+
                            "<td><input type='text' name='qty[]' class='form-control'> </td>"+
                    "</tr>" ;
            
        $("#tambah_item").append(konten);
    }
    function hapus(id){
        $(this).remove;
    }
    $(document).ready(function() {
        $('#table_modal').DataTable();
    } );


</script>
@endforeach


@endsection