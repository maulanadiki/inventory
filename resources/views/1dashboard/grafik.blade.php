<script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!-- <div class="col-md-6">
<div class="container-fluid mt-3 mb-3 d-flex justify-content-center">
    <div class="col-md-12">
            <div id="donut_chart" class="shadow border border-3 rounded-3"></div>
    </div>
</div>
</div> -->



<div class="container-fluid d-flex justify-content-center flex-column bg-light p-3 shadow border border-3 rounded-3 mt-3">
    <div class="col-md-12 mt-3">
        <div class="row ps-3">
            <div class="form-check col-md-2">
                <input class="form-check-input" type="radio" name="radio" id="bulanan" value="bulan" checked>
                <label class="form-check-label" for="flexRadioDefault1">
                Bulanan
                </label>
            </div>
            <div class="form-check col-md-8">
                <input class="form-check-input" type="radio" name="radio" value="tanggal" id="tgl">
                
                <label class="form-check-label" for="flexRadioDefault2">
                    <div class="row">
                        <div class="col-md-2">Mulai</div>
                        <div class="col-md-4"><input type="date" name="start" id="start" class="form-control" value="{{ date('Y-m-d') }}"></div>
                        <div class="col-md-2">Akhir</div>
                        <div class="col-md-4"><input type="date" name="end" id="end" class="form-control" required disabled></div>
                    </div>
                </label>
            </div>
            <div class="col-md-1"><button type="submit" id="cari" class="btn btn-primary">Cari</button> </div>
        </div>
    </div>    
    <div class="col-md-12 mt-3">
            <div id="container" class="p-0 m-0"></div>
    </div>
</div>

<script>
    var level = "{{auth()->user()->level}}";
    var data_tgl = {!!json_encode($data_label)!!};
    var data_pembelian = {!!json_encode($data_beli)!!};
    var data_penjualan = {!!json_encode($data_jual)!!};
    var today = new Date();
    var bulan = today.toLocaleString('default', { month: 'long' });

    switch (bulan){
        case "January":
            bulan = "Januari";
            break;
        case "February":
            bulan = "Februari";
            break;
        case "March":
            bulan = "Maret";
            break;
        case "April":
            bulan = "April";
            break;
        case "May":
            bulan = "Mei";
            break;
        case "June":
            bulan = "Juni";
            break;
        case "July":
            bulan = "Juli";
            break;
        case "August":
            bulan = "Agustus";
            break;
        case "September":
            bulan = "September";
            break;
        case "October":
            bulan = "Oktober";
            break;
        case "November":
            bulan = "November";
            break;
        case "December":
            bulan = "Desember";
            break;
        
    }

    //   dd(data_penjualan);
  if(level == 1 || level == 2)
  {
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Keluar Masuk Barang Bulan '+ bulan
        },
        
        xAxis: {
            categories: data_tgl,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Satuan /pcs'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} Pcs</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Pembelian',
            data: data_pembelian

        }, {
            name: 'Penjualan',
            data: data_penjualan

        }]
    });
  }
  else if(level == 3)
  {
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Keluar Masuk Barang ' + bulan
        },
        
        xAxis: {
            categories: data_tgl,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Data Keluar Masuk Barang (pcs)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} Pcs</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Pembelian',
            data: data_pembelian

        }]
    });
  }
  else
  {
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Keluar Masuk Barang '+bulan
        },
        
        xAxis: {
            categories: data_tgl,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Data Keluar Masuk Barang (pcs)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} Pcs</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Penjualan',
            data: data_penjualan

        }]
    });
  }
    
</script>

<script>
    $(document).ready(function(){
        const radio_tgl = $('#tgl');
        const radio_bln = $('#bulanan');
        const start = $('#start');
        const end = $('#end');

        $('#start').on('change', function(){
            const startDate = new Date($(this).val());
            const maxEndDate = new Date(startDate);
            maxEndDate.setMonth(maxEndDate.getMonth() + 1);

            const year = maxEndDate.getFullYear();
            const month = (maxEndDate.getMonth() + 1).toString().padStart(2, '0');
            const day = maxEndDate.getDate().toString().padStart(2, '0');

            const maxDate = `${year}-${month}-${day}`;

            $('#end').prop('max', maxDate);
            $('#end').prop('disabled', false);
            
        });



        $(radio_bln).on('click', function(){
            radio_tgl.prop('checked', false);
            start.val("{{ date('Y-m-d') }}");
            end.val("{{ date('Y-m-d') }}");
        });

        $(radio_tgl).on('click', function(){
            radio_bln.prop('checked', false);
        });
        $(start || end).on('click', function(){
            radio_tgl.prop('checked', true);
            radio_bln.prop('checked', false);
        });
    });

      
    $("#cari").on("click", function() {
        const type = $("input[type='radio']:checked").val();
       const mulai = $("#start").val();
       const akhir = $("#end").val();
        
       let list_tgl = [];
       let data_beli =[];
       let data_jual =[];
    //    penjumlahan per tanggal yang dipilih
       if(type == "tanggal")
       {
        if($("#end").is(":disabled"))
        {
            window.alert("Tanggal harus diisi");
        }
        else{
           $.ajax({
            type:"get",
            url:'{{URL::to('/grafik/cari')}}',
            data:{mulai: mulai, akhir: akhir,radio:type},
            success: function(res) {
                list_tgl =res.list_tgl;
                 data_beli =res.data_beli;
                 data_jual = res.data_jual;
                continueWithData();
            }
           });
        }

       }
    //    penjumlahan bulanannya disni
       else{
        console.log("ini tampilan tahunan");
       }

       function continueWithData(){
        const label = list_tgl.map(date=>{
            const format = date.split('-');
            return `${format[1]}-${format[2]}`;
        });

        Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Keluar Masuk Barang '
        },
        
        xAxis: {
            categories: label,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Data Keluar Masuk Barang (pcs)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} Pcs</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Pembelian',
            data: data_beli

        },{
            name: 'Penjualan',
            data: data_jual
        }]
    });        




           console.log(label, data_beli);
       }
    });
</script>

