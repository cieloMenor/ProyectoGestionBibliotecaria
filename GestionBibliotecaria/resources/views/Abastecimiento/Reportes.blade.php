@extends('layout.plantilla')

@section('titulo','ListadoPedido')
@section('contenido')

<DIV class="ROW"> 
    <DIV class="COL-6">
      <P></P>
    </DIV>
    <div class="COL-6"  style="width: 480PX; margin-left:180px;">
      <p style="margin-left: 100px;">CANTIDAD DE PEDIDOS POR MES</p>
        <canvas id="myChart" width="50" height="30"></canvas>
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
              backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(201, 203, 207, 0.2)'
              ],
              borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
              ],
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

<BR></BR>
<a  style=" margin-left:425px;" class="btn btn-primary" href="{{route('prueba')}}">GenerarPDF</a>



@endsection