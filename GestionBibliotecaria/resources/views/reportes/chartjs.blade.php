@extends('layout.plantilla')

@section('titulo','Reporte - Gráfico')

@section('contenido')

<div class="container-fluid">
  <div class="row">
    <div class="col">
      <select class="form-select" name="años" id="años">
        <option value="0" selected>Seleccionar--</option>
        @foreach ($años as $item)
        <option value="{{$item->año}}" @if($item->año== $valoraño) selected @endif >{{$item->año}}</option>
        @endforeach
      </select>
    </div>
    <div class="col">
      <form action="" method="get">
        <input type="text" name="valoraño" id="valoraño" value="{{$valoraño}}" hidden >
      
        <button class="btn btn-success" type="submit">Buscar</button>
    </form>
    </div>
  </div>
    <div class="row">
      <div class="col-md-6">
        <!-- AREA CHART -->
        <div class="card card-primary row" >
          
          <div class="card-header">
            <h3 class="card-title">N° de Libros prestados por mes</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- DONUT CHART -->
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">N° de Libros prestados por mes</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- PIE CHART -->
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">N° libros prestados por Nombre</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col (LEFT) -->
      <div class="col-md-6">
        <!-- LINE CHART -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">N° de Libros prestados por mes</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- BAR CHART -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">N° de lectores por mes</h3>
            

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="barChart" hidden ="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              
              <canvas id="densityChart" width="600" height="400"></canvas>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- STACKED BAR CHART -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">N° de prestamos por estado</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="stackedBarChart" hidden style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              <canvas id="densityChart2" width="600" height="400"></canvas>

            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col (RIGHT) -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection
@section('script')

<script>
    $(function () {
      $('#años').click(function () {
        datosCliente = document.getElementById('años').value.split('_');
        $('#valoraño').val(datosCliente[0]);;
        });
      
      /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */
      
      //$.ajax

      //--------------
      //- AREA CHART -
      //--------------
  
      // Get context with jQuery - using jQuery's .get() method.
      var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
      const valores = <?php echo json_encode($valores); ?>;
      const nombres = <?php echo json_encode($nombres); ?>;
      
      var areaChartData = {
        labels  : nombres,
        datasets: [
          {
            label               : 'N° de Libros',
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : valores
          },
          
        ]
      };
  
      var areaChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
          display: false
        },
        scales: {
          xAxes: [{
            gridLines : {
              display : false,
            }
          }],
          yAxes: [{
            gridLines : {
              display : false,
            }
          }]
        }
      }
  
      // This will get the first returned node in the jQuery collection.
      new Chart(areaChartCanvas, {
        type: 'line',
        data: areaChartData,
        options: areaChartOptions
      })
  
      //-------------
      //- LINE CHART -
      //--------------
      var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
      var lineChartOptions = $.extend(true, {}, areaChartOptions)
      var lineChartData = $.extend(true, {}, areaChartData)
      lineChartData.datasets[0].fill = false;
      lineChartOptions.datasetFill = false
  
      var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
      })
  
      //-------------
      //- DONUT CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
      var donutData        = {
        labels: nombres,
        datasets: [
          {
            data: valores,
            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
          }
        ]
      }
      var donutOptions     = {
        maintainAspectRatio : false,
        responsive : true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      
      
      new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
      })
  
      //-------------
      //- PIE CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
      const valores2 = <?php echo json_encode($valores2); ?>;
      const nombres2 = <?php echo json_encode($nombres2); ?>;

      var donutData2        = {
        labels: nombres2,
        datasets: [
          {
            data: valores2,
            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#10c0ef'],
          }
        ]
      }

      var pieData        = donutData2;
      var pieOptions     = {
        maintainAspectRatio : false,
        responsive : true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
      })
  
      //-------------
      //- BAR CHART -
      //-------------
      var matriz = [
      [1, 2, 3],
      [4, 5, 6],
      [7, 8, 9]
    ];


      

      //otrooooooooooooooooooooooooo
      var areaChartData2 = @json($chartData);
      var barChartCanvas3 = $('#barChart').get(0).getContext('2d');
      var barChartData3 = $.extend(true, {}, areaChartData2);

      var barChartOptions = {
          responsive: true,
          maintainAspectRatio: false,
          datasetFill: false
      };

      new Chart(barChartCanvas3, {
          type: 'bar',
          data: barChartData3,
          options: barChartOptions
      });
   

      //gtafico otro
      var densityCanvas = document.getElementById("densityChart");
      const valores4 = <?php echo json_encode($valores4); ?>;
      const nombres4 = <?php echo json_encode($nombres4); ?>;

      Chart.defaults.global.defaultFontFamily = "Lato";
      Chart.defaults.global.defaultFontSize = 18;

      var densityData = {
      label: 'Lectores registrados por mes',
      data: valores4,
      backgroundColor:'#19CED3'
      
      };

      var barChart = new Chart(densityCanvas, {
      type: 'bar',
      data: {
        labels: nombres4,
        datasets: [densityData]
      }
      });


      ///otro grafico2
      //gtafico otro
      var densityCanvas2 = document.getElementById("densityChart2")
      const valores3 = <?php echo json_encode($valores3); ?>;
      const nombres3 = <?php echo json_encode($nombres3); ?>;;
      

      Chart.defaults.global.defaultFontFamily = "Lato";
      Chart.defaults.global.defaultFontSize = 18;

      var densityData2 = {
      label: 'N° de prestamos por estado',
      data: valores3,
      backgroundColor:'#71EC1C'
      
      };

      var barChart2 = new Chart(densityCanvas2, {
      type: 'bar',
      data: {
        labels: nombres3,
        datasets: [densityData2]
      }
      });
  
      //---------------------
      //- STACKED BAR CHART -
      //---------------------

      var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
      var stackedBarChartData = $.extend(true, {}, barChartData)
  
      var stackedBarChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        scales: {
          xAxes: [{
            stacked: true,
          }],
          yAxes: [{
            stacked: true
          }]
        }
      }
  
      new Chart(stackedBarChartCanvas, {
        type: 'bar',
        data: stackedBarChartData,
        options: stackedBarChartOptions
      })
    })
</script>
@endsection