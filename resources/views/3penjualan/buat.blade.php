@section('title','Buat Pembelian')

@extends('layout.layout')
@section('konten')
<style>
.qty-barang {
    width: 5vw;
    height: 5vh;
    background-color: #f5f5f5;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    color: black;
}

.plus-item {
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

.kurang {
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

.table-primar{
    background-color:#219ebc !important;
}
</style>

<div class="container-fluid">
    <div class="frame base-system">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('home') }}" class="fs-5 ">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{url('penjualan') }}" class="fs-5 ">Data Penjualan</a>
                    </li>
                    <li class="breadcrumb-item active text-light fs-5" aria-current="page">Buat Penjualan</li>
                </ul>
            </nav>
        </div>

        <div class="col-md-12 border-3 p-3">
            <form action="{{route('penjualan.simpan') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row text-light">
                    <div class="col-md-3" style="padding:9px 14px;">Nomor Invoice</div>
                    <div class="col-md-3"><input type="text" class="form-control" name="inv" value="{{$notrans}}" placeholder="" readonly></div>
                    <div class="col-md-3" style="padding:9px 14px;">Tanggal Jual</div>
                    <div class="col-md-3"><input type="date" class="form-control " name="date"
                            value="<?php echo date('Y/m/d') ?>" id="tgl" required></div>
                </div>

                <div class="row mt-2 text-light">
                    <div class="col-md-3" style="padding:14px 14px;">Nama Customer</div>
                    <div class="col-md-3 mt-1"><input type="text" class="form-control" name="name"
                            placeholder="Max Character 20" maxlength="20"
                            onkeypress="return event.charCode < 48 || event.charCode >57" required></div>
                    <div class="col-md-3" style="padding:14px 14px;">Marketplace</div>
                    <div class="col-md-3">
                        <select name="market" class="form-select form-select-lg" aria-label=".form-select-lg example"
                            required>
                            <option value="1">Facebook</option>
                            <option value="2">Shopee</option>
                            <option value="3">lazada</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-2 text-light">
                    <div class="col-md-3" style="padding:9px 14px;">Telpon</div>
                    <div class="col-md-3">
                        <input type="text" class="form-control " name="telp" placeholder="Max Number 13" maxlength="13"
                            onkeypress="return event.charCode >= 48 && event.charCode <=57" required>
                    </div>
                    <div class="col-md-3" style="padding:9px 14px;">Alamat</div>
                    <div class="col-md-3">
                        <textarea class="form-control " placeholder="Leave a comment here" id="floatingTextarea"
                            name="alamat" required></textarea>
                    </div>
                </div>


                <div class="col-md-12 mt-2">
                    <div style="height:370px; overflow:auto;">
                        <table class="table table-hover text-light show-cart" id="table_form">
                            <thead class="table-primar">
                                <tr class='text-center'>
                                    <th class="col">Kode Barang</th>
                                    <th class="col">Nama Barang</th>
                                    <th class="col">Ukuran</th>
                                    <th class="col">Warna</th>
                                    <th class="col-">Beli</th>
                                    <th class="col-">Jual</th>
                                    <th class="col" style="width:150px;">Qty</th>
                                    <th class="col text-center">action</th>
                                </tr>
                            </thead>
                            <tbody id="tambah_item">

                            </tbody>
                        </table>
                    </div>
                </div>

                <section id="uploader" class="table-primar" >
                    <div class="row justify-content-end p-1">
                        <div class="col-md-3 fw-bold text-end text-light pt-2">Bukti Pembelian</div>
                        <div class="col-md-7"><input class="form-control" type="file" name="bukti" id="formFile"
                                accept="image/png, image/gif, image/jpeg" required></div>
                    </div>
                </section>

                <div class="col-md-12 border-top">
                    <div class="row justify-content-start mt-3">
                        <div class="col-md-4 d-flex justify-content-start">
                            <button type="button" class="btn btn-primary" style="font-size:14px;" data-bs-toggle="modal" data-bs-target="#item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>
                                Tambah Item
                            </button>
                        </div>

                        <div class="col-md-8 d-flex justify-content-end mb-3">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-save" viewBox="0 0 16 16">
                                    <path
                                        d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z" />
                                </svg>
                                Simpan
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- modalnya -->
<div class="modal fade" id="item" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel"
    aria-hidden="true" style="height:800px; overflow:auto;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">List Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover table-striped show-cart" id="table_modal" style="width:100%">
                    <thead class="thead-primary text-center">
                        <tr>
                            <th colspan="2" class="text-center">#</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Ukuran</th>
                            <th>Warna</th>
                        </tr>
                    </thead>
                    <tbody id="tambah_item">
                        @foreach($barang as $br)
                        <tr class="add-to-cart text-center" style="cursor:pointer;" data-id="{{$br->id}}"
                            data-kode="{{$br->kode_barang}}" data-nama="{{$br->nama_barang}}"
                            data-ukuran="{{$br->ukuran}}" data-warna="{{$br->warna}}" data-beli="{{$br->beli}}"
                            data-deskripsi="{{$br->deskripsi}}" data-kuantitas="{{$br->kuantitas}}">
                            <td><input class="form-check-input" type="checkbox" id="flexCheckDefault"></td>
                            <td class="col">{{$loop->iteration}} </td>
                            <td class="col">{{$br->kode_barang}}</td>
                            <td class="col">{{$br->nama_barang}}</td>
                            <td class="col">{{$br->ukuran}}</td>
                            <td class="col">{{$br->warna}}</td>
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


<!-- season storage -->
<script>
var tgl = document.getElementById("tgl").valueAsDate = new Date();


var keranjang = (function() {
    cart = [];

    // konstruktor
    // isi dari fungsi item itu ini
    function Item(id, kode, nama, ukuran, warna, beli, deskripsi, hitung, kuantitas) {
        this.id = id;
        this.kode = kode;
        this.nama = nama;
        this.ukuran = ukuran;
        this.warna = warna;
        this.beli = beli;
        this.deskripsi = deskripsi;
        this.hitung = hitung;
        this.kuantitas = kuantitas;
    }
    // sampe sini
    // simpan cart
    function simpanCart() {
        sessionStorage.setItem("keranjang", JSON.stringify(cart));
    }
    // sampe sini

    // memanggil data / load data
    function loadCart() {
        JSON.parse(sessionStorage.getItem("keranjang"));
    }

    if (sessionStorage.getItem("keranjang") != null) {
        loadCart();
    }

    // menampilkan di publik
    var objek = {};
    // tambah item ke cart
    objek.TambahItemToCart = function(id, kode, nama, ukuran, warna, beli, deskripsi, hitung, kuantitas) {
        for (var item in cart) {
            if (cart[item].kode === kode) {
                cart[item].hitung++;
                simpanCart();
                return;
            }
        }
        var item = new Item(id, kode, nama, ukuran, warna, beli, deskripsi, hitung, kuantitas);
        cart.push(item);
        simpanCart();
        // console.log(simpanCart() );
    };

    // menghitung jumlah item
    objek.setCountForItem = function(kode, nama, hitung) {
        for (var i in cart) {
            if (cart[i].kode === kode) {
                cart[i].hitung = hitung;
                break;
            }
        }
    };

    // hapus item dari cartnya
    objek.removeItemFromCart = function(kode, nama) {
        for (var item in cart) {
            if (cart[item].kode === kode) {
                cart[item].hitung--;
                if (cart[item].hitung < 1) {
                    cart.splice(item, 1);
                }
                simpanCart();
                return;
            }
        }
        // simpanCart();
    };

    objek.tambahKuantitas = function(kode, nama) {
        for (var item in cart) {
            if (cart[item].kode === kode) {
                cart[item].hitung++;
                simpanCart();
                return;
            }
        }
    }

    objek.removeItemFromCartAll = function(kode) {
        for (var item in cart) {
            if (cart[item].kode === kode) {
                cart.splice(item, 1);
                break;
            }
        }
        simpanCart();
    };

    // bersihkan cart
    objek.clearCart = function() {
        cart = [];
        simpanCart();
    };

    // hitung cart total
    objek.totalHitung = function() {
        var totalHitung = 0;
        for (var item in cart) {
            totalHitung += cart[item].hitung;
        }
        return totalHitung;
    };

    // total Cart
    objek.totalCart = function() {
        var totalCart = 0;
        for (var item in cart) {
            totalCart += cart[item].beli * cart[item].hitung;
        }
        return Number(totalCart.toFixed(2));
    }

    // list cart
    objek.listCart = function() {
        var cartCopy = [];
        for (i in cart) {
            item = cart[i];
            itemCopy = {};
            for (p in item) {
                itemCopy[p] = item[p];
            }
            // itemCopy.total = Number.(item.beli * item.hitung);
            cartCopy.push(itemCopy);
        }
        return cartCopy;
    };
    return objek;
})();

$(".add-to-cart").click(function(event) {
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
    var kuantitas = $(this).data("kuantitas");
    if(checkbox.checked){
    keranjang.TambahItemToCart(id, kode, nama, ukuran, warna, beli, deskripsi, 1, kuantitas);
    tampilCart();
    }
    else{
    keranjang.removeItemFromCartAll(kode);
    tampilCart();
    }

});
// Clear items
$(".clear-cart").click(function() {
    keranjang.clearCart();
    tampilCart();
});


function tampilCart() {
    var cartArray = keranjang.listCart();
    var konten = "";

    var $rupp = (number) => {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR"
        }).format(number);
    }

    for (var i in cartArray) {

        konten += "<tr class='text-center'>" +
            
            "<td>" + cartArray[i].kode + "<input type='hidden' value='" + cartArray[i].kode + "' name='kode[]'> </td>" +
            "<td>" + cartArray[i].nama + "</td>" +
            "<td>" + cartArray[i].ukuran + "</td>" +
            "<td>" + cartArray[i].warna + "</td>" +
            "<td>" + $rupp(cartArray[i].beli) + "<input type='hidden' value='" + cartArray[i].beli +
            "' name='beli[]'></td>" +
            "<td><input type='number' class='form-control' name='jual[]' min='1000'  max='999999' required> </td>" +
            "<td>" +

            "<div class='input-group mb-3'>" +
            "<a class='kurang' data-kode='" + cartArray[i].kode + "' > - </a>" +
            "<a class='qty-barang'>" + cartArray[i].hitung + "</a>" +
            "<input type='hidden' class='item-count form-control text-center juaal' data-kode='" + cartArray[i].kode +
            "' value='" + cartArray[i].hitung + "' name='qty[]' max='" + cartArray[i].kuantitas + "' required>" +
            "<a class='plus-item input-group-addon' data-kode='" + cartArray[i].kode + "' > + </a>" +
            "</div>" +

            "</td>" +
            "<td><button class='btn btn-danger hapus' onclick='hapus(this)'data-kode='" + cartArray[i].kode +
            "' ><i class='bi bi-trash3'></i> </button> </td>" +
            // "<input type='number' class='item-count form-control' name='qty[]' data-kode='" +cartArray[i].kode +"' value='" +cartArray[i].hitung +"'>" +
            "</tr>";
        // document.querySelector('').readOnly = true;

    }
    $("#tambah_item").html(konten);
    // $('.juaal').attr("readonly", true);
}
// -1
$("#tambah_item").on("click", ".kurang", function(event) {
    var kode = $(this).data("kode");
    keranjang.removeItemFromCart(kode);
    //   console.log(kode);
    tampilCart();
});


$("#tambah_item").on('click', '.plus-item', function(even) {
    var name = $(this).data("name");
    var kode = $(this).data("kode");
    // keranjang.TambahItemToCart(kode,name);
    console.log(kode);
    keranjang.tambahKuantitas(kode);
    tampilCart();

});



$("#tambah_item").on("click", ".hapus", function(event) {
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
            url: '{{URL::to(' / pembelian / BuatPembelian / simpan / carivendor ')}}',
            data: {
                'vnd': $vendorr
            },
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
function value_check(kobar, nabar, ukuran, warna, beli, deskripsi) {
    var panjang = document.getElementById("table_form").rows.length;
    var konten = "<tr id=row_" + panjang + ">" +
        "<td><button class='btn btn-danger' onclick='hapus(this)' ><i class='bi bi-trash3'></i> </button> </td>" +
        "<td>" + panjang + "</td>" +
        "<td>" + kobar + "</td>" +
        "<td>" + nabar + "</td>" +
        "<td>" + ukuran + "</td>" +
        "<td>" + warna + "</td>" +
        "<td>" + beli + "</td>" +
        "<td><input type='text' name='qty[]' class='form-control'> </td>" +
        "</tr>";

    $("#tambah_item").append(konten);
}

function hapus(id) {
    $(this).remove;
}
$(document).ready(function() {
    $('#table_modal').DataTable();
});
</script>
@endforeach
@endsection