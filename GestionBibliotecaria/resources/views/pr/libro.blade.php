<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
                <button type="submit" id="checkout-live-button">Solicitar Compra</button>
                </form>
                <div class="row">
                    <div class="col">
                        <center><a href="{{route('tienda')}}" class="btn btn-danger">Cancelar</a></center>
                    </div>
                </div>
                
            </div>
    </section>

    <footer>
        <p>&copy; 2023 Tienda de Libros</p>
    </footer>

    <script>
        function prestarLibro(libro) {
            alert('Has prestado el libro: ' + libro + '. ¡Esperamos que disfrutes de la lectura!');
            // Aquí puedes agregar código adicional para manejar la acción de prestar el libro
        }
    </script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>
