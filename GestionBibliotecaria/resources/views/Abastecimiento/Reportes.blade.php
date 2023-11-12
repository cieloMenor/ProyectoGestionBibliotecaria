@extends('layout.plantilla')

@section('titulo', 'ListadoPedido')
@section('contenido')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <CENTER>
  <p>REPORTES</p>
  </CENTER>
 
    <div class="container mt-5 d-flex flex-wrap">

        <!-- Informe 1 -->
        <div class="col" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">CANTIDAD DE PEDIDOS POR MES</h5>
                <canvas id="PedidosPorMes" width="50" height="30"></canvas>
            </div>
        </div>

        <!-- Informe 2 -->
        <div class="col" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Stock de libros</h5>
                <canvas id="StockDeLibros" width="50" height="30"></canvas>
            </div>
        </div>

        <!-- Informe 3 -->
        <div class="col" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Cantidad de pedidos por proveedor</h5>
                <canvas id="ProveedorPedidos" width="50" height="30"></canvas>
            </div>
        </div>
    </div>

    <script>
        const data = @json($data);
        const ctx = document.getElementById('PedidosPorMes');
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

        const libros = @json($libros);
        const ctxLibros = document.getElementById('StockDeLibros');
        new Chart(ctxLibros, {
            type: 'pie',
            data: {
                labels: libros.map(libro => libro.Titulo),
                datasets: [{
                    label: 'Stock de libros',
                    data: libros.map(item => item.Stock),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
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

        const pedidos = @json($pedidosYProveedores);
        const ctxPedidos = document.getElementById('ProveedorPedidos');
        new Chart(ctxPedidos, {
            type: 'bar',
            data: {
                labels: pedidos.map(pedido => pedido.Proveedor),
                datasets: [{
                    label: '# De Pedidos',
                    data: pedidos.map(pedido => pedido.Cantidad),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
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

    <a style=" margin-left:425px;" class="btn btn-primary" href="{{ route('prueba') }}">GenerarPDF</a>
@endsection
