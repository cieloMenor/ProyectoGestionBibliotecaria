<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fce4ec; /* Fondo rosado claro */
            margin: 20px;
        }

        p {
            text-align: center;
            font-family: Courier, monospace;
            color: #880e4f; /* Texto color rosa oscuro */
            font-size: 1.5em;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #e0e0e0; /* Borde gris claro */
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f8bbd0; /* Encabezado rosa claro */
        }

        tbody tr:nth-child(even) {
            background-color: #f3e5f5; /* Fondo rosa más claro para filas pares */
        }

        b {
            color: #311b92; /* Texto morado oscuro */
        }
    </style>
</head>
<body>
    <p>PEDIDOS</p>

    <table>
        <thead>
            <tr>
                <th>Codigo Pedido</th>
                <th>Fecha</th>
                <th>Codigo Proveedor</th>
                <th>Codigo Bibliotecario</th>
            </tr>
        </thead>
        <tbody>
            @if (count($pedidos) <= 0)
                <tr>
                    <td colspan="4"><b>No hay Pedidos</b></td>
                </tr>
            @else
                @foreach ($pedidos as $ItemPedidos)
                    <tr>
                        <td>{{ $ItemPedidos->PedidoID }}</td>
                        <td>{{ $ItemPedidos->Fecha }}</td>
                        <td>{{ $ItemPedidos->ProveedorID }}</td>
                        <td>{{ $ItemPedidos->BibliotecarioID }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>
