<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Libro</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f4f4;
        }

        header {
            text-align: center;
            padding: 20px;
            background-color: #2c3e50;
            color: #ecf0f1;
        }

        section {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card img {
            width: 100%;
            height: auto;
        }

        .card-content {
            padding: 20px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #2c3e50;
            color: #ecf0f1;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #2c3e50;
            color: #ecf0f1;
        }
    </style>
</head>
<body>

    <header>
        <h1>Detalles del Libro</h1>
    </header>

    <section class="card">
       
        <div class="card-content">
                <h3>{{$libro->Titulo}}</h3>
                <center>
                <p>Editorial: {{$libro->Editorial}}</p>
                <p>Año de Publicación: {{$libro->Añopublicacion}}</p>
                <p>Precio: $ {{$libro->Precio}}</p>
                </center>
                <form action="{{route('checkout',$libro->LibroID)}}" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button type="submit" id="checkout-live-button">Solicitar Préstamo</button>
                </form>
                
                
            </div>
    </section>

    <footer>
        <p>&copy; 2023 Tienda de Préstamos de Libros</p>
    </footer>

    <script>
        function prestarLibro(libro) {
            alert('Has prestado el libro: ' + libro + '. ¡Esperamos que disfrutes de la lectura!');
            // Aquí puedes agregar código adicional para manejar la acción de prestar el libro
        }
    </script>

</body>
</html>
