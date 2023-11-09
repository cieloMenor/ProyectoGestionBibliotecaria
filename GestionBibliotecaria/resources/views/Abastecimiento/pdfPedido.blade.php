<p align=center style = "font-family:courier,arial,helvética; color:crimson">
        PEDIDOS
    </p>
    <table class="table table-bordered">
         <thead>
            <tr>
                <th>Codigo Pedido</th>
                <th>Fecha</th>
                <th>Codigo Proveedor</th>
                <th>Codigo Bibliotecario</th>
                
            </tr>
        </thead>
        <tbody>
            @if (count($pedidos)<=0) 
                <tr>
                 <td colspan="3"><b>No hay Pedidos</b></td>
                </tr>
            @else 
                @foreach ($pedidos as $ItemPedidos)
                 <tr>
                    <td>{{$ItemPedidos->PedidoID}}</td>
                    <td>{{$ItemPedidos->Fecha}}</td>
                    <td>{{$ItemPedidos->ProveedorID}}</td>
                    <td>{{$ItemPedidos->BibliotecarioID}}</td>
                </tr>
        </tbody>
    </table> 