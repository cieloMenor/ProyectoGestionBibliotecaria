<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestamo Exitoso</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            margin: 50px;
        }
        h2 {
            color: #28a745; /* Color verde para indicar éxito */
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
        }
        .boton-tienda {
            background-color: #007bff; /* Color azul para el fondo del botón */
            color: #fff; /* Color blanco para el texto del botón */
            transition: background-color 0.3s;
        }
        .boton-tienda:hover {
            background-color: #0056b3; /* Cambia el color de fondo en hover */
        }
    </style>
</head>
<body>

    <div>
        <h2>¡Préstamo Exitoso!</h2>
        <p>Te alegramos informarte que has realizado con éxito el préstamo del libro.</p>
        <h3>Acercarte a recoger el libro</h3>
        <p>¡Disfruta de tu lectura!</p>
        <p>Comprobante: {{$idcomprobante}}</p>
        <p>Libro:{{$libro->Titulo}}</p>
        {{-- @if(session('transaccionStripe'))
    <h2>Detalles de la Transacción de Stripe</h2>
                    <p>Session ID: {{ $session->id }}</p>
                <p>Pagos: {{ $paymentIntent }}</p>
    <p>ID de la Sesión: {{ session('transaccionStripe')->id }}</p>
    <p>Estado: {{ session('transaccionStripe')->payment_status }}</p> --}}
    <!-- Agrega más detalles según sea necesario -->

    <!-- Nota: Asegúrate de revisar la estructura de los datos en la variable de sesión y ajusta según sea necesario -->
{{-- @else
    <p>No hay detalles de transacción disponibles.</p>
@endif --}}
      <a  class="boton-tienda" href="{{route('comprobante.edit',$idcomprobante)}}" target="_blank">Comprobante</a><br><br>
        <a  class="boton-tienda" href="{{route('tienda')}}">Tienda</a>
    </div>

</body>
</html>
