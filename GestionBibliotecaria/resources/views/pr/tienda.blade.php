<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Préstamos de Libros</title>
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
            margin: 20px auto;
            max-width: 800px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .card {
            width: calc(33.33% - 20px);
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            width: 100%;
            height: auto;
        }

        .card-content {
            padding: 20px;
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
        <h1>Tienda de Préstamos de Libros</h1>
    </header>

    <section>
        @foreach($libross as $libro)
    
        <form class="card" method="post" action="{{route('verificar',$libro->LibroID)}}">
            @csrf()
           
            <div class="card-content">
                <h3>{{$libro->Titulo}}</h3>
                <center>
                <p>Editorial: {{$libro->Editorial}}</p>
                <p>Año de Publicación: {{$libro->Añopublicacion}}</p>
                <p>Precio: $ {{$libro->Precio}}</p>
                
                <button type="submit" >Solicitar Préstamo</button>
                </center>
            </div>
        </form>
        @endforeach
        

        

        <!-- Repite estas tarjetas según sea necesario -->

    </section>

    <footer>
        <p>&copy; 2023 Tienda de Préstamos de Libros</p>
    </footer>

    <script>
        function solicitarPrestamo(libro) {
            alert('Solicitaste un préstamo para ' + libro + '. ¡Gracias por tu solicitud!');
            // Aquí puedes agregar código adicional para manejar la solicitud
        }
    </script>

</body>
</html>
