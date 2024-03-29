<script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>


<div class="container-fluid">
    
    <div class="col-md-12 pb-3">
            <div id="grafik" class="shadow border border-3 rounded-3"></div>
    </div>
</div>

<script>
$(document).ready(function() {
    $("#cari").on("click", function() {
        var start = $('#start').val();
        var end = $('#end').val();
        // window.location.href = "{{url('report/barang')}}?start=" + start + "&end=" + end;
        console.log(start, end);
    });
});



  var label = {!!json_encode($data_label)!!};
  var masuk = {!!json_encode($data_masuk)!!};
  const keluar = {!!json_encode($data_keluar)!!};

//   console.log(keluar);
  var stok = {!!json_encode($data_stk)!!};
//   console.log(stok);
  Highcharts.chart('grafik', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Laporan Pergerakan barang'
    },
    subtitle: {
        text: 'Source: WorldClimate.com'
    },
    xAxis: {
        categories: label,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Satuan (Pcs)'
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
        name: 'Masuk',
        data: masuk

    }, {
        name: 'Keluar',
        data: keluar

    }, {
        name: 'Stok',
        data: stok

    }]
});
</script>
