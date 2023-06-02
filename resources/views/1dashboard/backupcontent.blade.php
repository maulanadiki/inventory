@section('title','Dashboard')

@extends('layout.layout')
@section('konten')

<div class="container-fluid">
    <div class="row mt-4 ms-2 border shadow" style="background-color:#E8ECFC; border-radius:15px;" >
        <div class="col-md-12 ms-4 p-3">
            <span><h4>Dashboard</h4></span>
            <span>
            @if(auth()->user()->level == 3)
            <p>Purchasing</p>
            @elseif(auth()->user()->level == 4)
            <p>Marketing</p>
            @else
            <p>Super User </p>
            @endif

            
            </span>
        </div>
        <div class="col-md-12">
            <div class="row">
            @if(auth()->user()->level == 1 || auth()->user()->level == 2 )
                <div class="col-md-11 col-12 ms-3">
                <div class="row">
                    <div class="col-md-5 col-6">
                        <div class="row">
                        <div class="col-md-4 text-center d-flex justify-content-center">
                            <div class="col-md-12 border shadow text-center "  style="border-radius:10px; background-color:#FCF8E8;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-cart mt-3" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                                <h2 class="card-title text-center mt-3" ><strong>{{$pembelian}}</strong></h2>
                                <p class="card-text text-center mt-2" style="font-size:14px;"><strong>Pembelian Barang</strong></p>
                            </div>
                        </div>
                        <div class="col-md-4 text-center d-flex justify-content-center">
                            <div class="col-md-12 border shadow text-center"  style="border-radius:10px; background-color: #FCF8E8;">
                            <img src="{{asset('sendiri/box_datang.png') }}" width="60px" class="img-fluid mt-2" alt="">
                                <h2 class="card-title text-center mt-3" ><strong>{{$pembelian}}</strong></h2>
                                <p class="card-text text-center mt-2" style="font-size:14px;"><strong>Terima Barang</strong></p>
                            </div>
                        </div>
                        <div class="col-md-4 text-center d-flex justify-content-center">
                            <div class="col-md-12 border shadow text-center"  style="border-radius:10px; background-color: #FCF8E8;">
                            <img src="{{asset('sendiri/box_keluar.png') }}" width="60px" class="img-fluid mt-2" alt="">
                                <h2 class="card-title text-center mt-3" ><strong>{{$pembelian}}</strong></h2>
                                <p class="card-text text-center mt-2" style="font-size:14px;"><strong>Barang Keluar</strong></p>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-6">
                        <div class="row align-items-center">
                            <div class="col-md-4 d-flex justify-content-center" style="height:80px;">
                                <div class="col-md-11 border shadow row" style="border-radius:10px; background-color: #FCF8E8;">
                                    <div class="col-md-4 text-center align-self-center border-end">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width:80%; height:80%;" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
                                            <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.27 3.27a.997.997 0 0 0 1.414 0l1.586-1.586a.997.997 0 0 0 0-1.414l-3.27-3.27a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0Zm9.646 10.646a.5.5 0 0 1 .708 0l2.914 2.915a.5.5 0 0 1-.707.707l-2.915-2.914a.5.5 0 0 1 0-.708ZM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11Z" />
                                        </svg>
                                    </div>
                                    <div class="col-md-8 text-center align-self-center">
                                        <span class="lh-sm mt-4 "><strong>VENDOR</strong> <br>{{$vendor}} </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 d-flex justify-content-center" style="height:80px;">
                                <div class="col-md-11 border shadow row" style="border-radius:10px; background-color: #FCF8E8;">
                                <div class="col-md-4 text-center align-self-center border-end">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width:80%; height:80%;" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                                                    <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                                                    </svg>
                                    </div>
                                    <div class="col-md-8 text-center align-self-center">
                                    <span class="lh-sm mt-4 "><strong>Stok</strong> <br>{{$kuantitas}} </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 d-flex justify-content-center" style="height:80px;">
                                <div class="col-md-11 border shadow row" style="border-radius:10px; background-color: #FCF8E8;">
                                <div class="col-md-4 text-center align-self-center border-end">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width:80%; height:80%;" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </div>
                                    <div class="col-md-8 text-center align-self-center">
                                    <span class="lh-sm mt-4 "><strong>Barang</strong> <br>{{$barang}} </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 d-flex justify-content-center" style="height:100px;">
                                <div class="col-md-11 border shadow row mt-4" style="border-radius:10px; background-color: #FCF8E8;">
                                <div class="col-md-4 text-center align-self-center border-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:80%; height:80%;"  fill="currentColor" class="bi bi-people mt-3" viewBox="0 0 16 16">
                                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                                        </svg>
                                    </div>
                                    <div class="col-md-8 text-center align-self-center">
                                    <span class="lh-sm mt-4 "><strong>Karyawan</strong> <br>0 </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 d-flex justify-content-center" style="height:100px;">
                                <div class="col-md-11 border shadow row mt-4" style="border-radius:10px; background-color: #FCF8E8;">
                                <div class="col-md-4 text-center align-self-center border-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:80%; height:80%;" fill="currentColor" class="bi bi-person-workspace mt-3" viewBox="0 0 16 16">
                                            <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                                            <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z"/>
                                    </svg>
                                    </div>
                                    <div class="col-md-8 text-center align-self-center">
                                    <span class="lh-sm mt-4 "><strong>Akses</strong> <br>{{$user}} </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                @elseif (auth()->user()->level == 4)
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="col-md-12 border shadow text-center"  style="border-radius:10px; background-color: #FCF8E8;">
                                <img src="{{asset('sendiri/box_keluar.png') }}" width="60px" class="img-fluid mt-2" alt="">
                                <h2 class="card-title text-center mt-3" ><strong>{{$pembelian}}</strong></h2>
                                <p class="card-text text-center mt-2" style="font-size:14px;"><strong>Barang Keluar</strong></p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-5">
                            <div class="col-md-12 border shadow text-center"  style="border-radius:10px; background-color: #FCF8E8;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:70px; height:100%; margin:10px 0 10px 0;" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                    <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                                </svg>
                                <h2 class="card-title text-center mt-3" ><strong>{{$kuantitas}} </strong></h2>
                                <p class="card-text text-center mt-2" style="font-size:14px;"><strong>Stok Barang</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div id="donut_chart" class="shadow border border-3 rounded-3"></div>
                    </div>
                </div>

                @elseif (auth()->user()->level == 1 || auth()->user()->level == 2 ||auth()->user()->level == 3)
                    @foreach($keluar as $kl)
                        @foreach($barangss as $brg)
                                @if($kl->kode_barang == $brg->kode_barang)
                                    @php
                                        @$permintaan = $kl->qtykel;
                                        @$min = ceil(sqrt(2 * $permintaan * $rata_rata ));
                                        @$qtty = array_sum([$kl_qty]);
                                    @endphp
                                
                                    @foreach($minta as $mt)
                                    @if($kl->kode_barang == $mt->kode_barang)
                                    

                                    @php
                                    @$selisih = $brg->kuantitas - $mt->kel - $min;
                                    @endphp


                                    @endif
                                    @endforeach
                            @endif
                        @endforeach
                    @endforeach
                             @if($selisih < 0 )
                                <div class="col-md-12 col-12 text-center"><h3>Minimum Stock Barang</h3></div> 
                                    <div class="col-md-11 ms-3">
                                        <div class="overflow-auto" style="width:99%; height:220px; overflow:auto;"> 
                                            <div class="row"> 
                                                @foreach($keluar as $kl)
                                                    @foreach($barangss as $brg)
                                                        @if($kl->kode_barang == $brg->kode_barang)
                                                            <div class="col-md-4 col-4">
                                                                <div class="card text-bg-warning shadow-sm mb-3" style="max-width: 99%;">
                                                                    <div class="card-header p-0 m-0">
                                                                        <div class="d-flex justify-content-between align-items-center align-middle ps-1 pe-1">
                                                                            <p class="pt-3">{{$kl->kode_barang}} - {{$brg->nama_barang}}</p>
                                                                            <span class="badge text-bg-danger text-end ms-4">{{$selisih}}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body p-1 m-0">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <img src="{{asset('images/'.$brg->f_barang) }}" alt="" class="img-fluid">
                                                                                 </div>
                                                                            <div class="col-md-8">
                                                                                <p class="card-text pb-0 m-0">{{$brg->warna}}, {{$brg->ukuran}} Uk</p>
                                                                                <span class="card-text">Penjualan : {{$mt->mtkel}}</span><br>
                                                                                <span class="card-text">stok : {{$brg->kuantitas}}</span><br>
                                                                                <span class="card-text badge text-bg-danger">minum stok :{{$min}} </span><br>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>        
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                            @endif

                
                    
                    
                @endif
            </div>
        </div>
        <div class="col-md-12">
            @include('1dashboard.grafik')
        </div>
    </div>
<!-- {{$kuantitas}} -->



</div>

<script>
    var barang_keluar = {!!json_encode($brg_kel)!!};
    var eeoq = {!!json_encode($EOQ)!!}
    console.log(barang_keluar, eeoq);

    $(document).ready(function(){

    var keluar = <?php echo json_encode($keluar); ?>;
    var options = {
        chart : {
            renderTo : 'donut_chart',
            plotBackgroundColor : null,
            plotBorderWidth : null,
            plotShadow : false,
        },
        title :{
            text:'Persentase Penjualan Barang'
        },
        tooltip:{
            pointFormat : '{series.name}: <b> {point.percentage}%</b>',
            percentageDecimals:1,
        },
        plotOptions:{
            pie:{
                allowPointSelect:true,
                cursor:'pointer',
                dataLabels:{
                    enabled:true,
                    color:'#000000',
                    connectColor:'#000000',
                    formatter:function(){
                        return '<b>' + this.point.name + '</b>: ' + this.percentage + '%';
                    }
                }
            }
        },
        series:[{
            type:'pie',
            name:'Barang'
        }]

    }
    myarray = [];
    $.each(keluar, function(index, val) {
        myarray[index] = [val.kode_barang,val.qtykel];
    });
    options.series[0].data = myarray;
    chart = new Highcharts.Chart(options);
    });

    $(document).ready(function () {
    $('#purchasing').DataTable();
});
</script>
@endsection