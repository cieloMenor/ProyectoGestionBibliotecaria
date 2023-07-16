@extends('layout.plantilla')

@section('titulo','RegistroDetallePedido')
@section('contenido')

<div class="container">
    <br>
    <a href="{{route('registroDP')}}" class="btn btn-primary"><i class="fas fa-plus">Registrar</i></a>
    <br>
    <br>

    <p align=center style = "font-family:courier,arial,helvética; color:crimson">
        DETALLE DE LOS PEDIDOS
    </p>
    <table class="table table-bordered">
         <thead>
            <tr>
                <th>Codigo Detalle Pedido</th>
                <th>Cantidad</th>
                <th>Codigo Pedido</th>
                <th>Codigo Libro</th>
            </tr>
        </thead>
        <tbody>
            @if (count($detallesP)<=0) 
                <tr>
                 <td colspan="3"><b>No hay Pedidos</b></td>
                </tr>
            @else 
                @foreach ($detallesP as $ItemDetallesP)
                 <tr>
                    <td>{{$ItemDetallesP->Detalle_pedidoID}}</td>
                    <td>{{$ItemDetallesP->Cantidad}}</td>
                    <td>{{$ItemDetallesP>PedidoID}}</td>
                    <td>{{$ItemDetallesP->LibroID}}</td>
                 </tr>
                @endforeach
            @endif
        </tbody>
    </table>  
    
</div>
@endsection


