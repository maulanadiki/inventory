<script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>


<div class="container-fluid mt-3 mb-3 d-flex justify-content-center">
    <div class="col-md-12">
            <div id="masuk" class="shadow border border-3 rounded-3"></div>
    </div>
</div>

<script>
  var label = {!!json_encode($data_label)!!};
  var masuk = {!!json_encode($data_masuk)!!};
  var keluar = {!!json_encode($data_keluar)!!};
  var stok = {!!json_encode($data_stk)!!};
Highcharts.chart('masuk', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Grafik Barang'
    },
    xAxis: {
        categories: label,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Grafik Barang (Pcs)'
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
        name: 'Barang Masuk',
        data: masuk

    },
    {
        name: 'Barang Keluar',
        data: keluar

    },
    {
        name: 'Stok Barang',
        data: stok

    }]
});
</script>
