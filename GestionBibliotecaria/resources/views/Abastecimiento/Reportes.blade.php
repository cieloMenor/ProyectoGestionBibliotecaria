@extends('layout.plantilla')

@section('titulo','ListadoPedido')
@section('contenido')

<DIV class="ROW"> 
    <DIV class="COL-6">
      <P></P>
    </DIV>
    <div class="COL-6"  style="width: 300PX; margin-left:400px">
        <canvas id="myChart" width="50" height="20"></canvas>
    </div>
</div>     
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      
    <script>
        const data = @json($data);
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: data.map(item => item.mes),
            datasets: [{
              label: '# de libros',
              data: data.map(item => item.total),
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
    </script>


@endsection