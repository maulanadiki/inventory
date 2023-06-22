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



<div class="container-fluid d-flex justify-content-center">
    <div class="col-md-12">
            <div id="container" class="shadow border border-3 rounded-3 p-0 m-0"></div>
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


