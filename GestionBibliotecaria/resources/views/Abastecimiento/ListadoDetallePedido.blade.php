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
                <th>Opciones</th>
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
                    <td>{{$ItemDetallesP->PedidoID}}</td>
                    <td>{{$ItemDetallesP->LibroID}}</td>
                    <td>
                        <a href="{{route('editarDP', $ItemDetallesP->Detalle_pedidoID)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Editar</a>
                        &nbsp; &nbsp; &nbsp;

                        <form action="{{route('eliminarDP', $ItemDetallesP->Detalle_pedidoID)}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Eliminar</button>
                         </form>
                        
                    <td> 
                 </tr>
                @endforeach
            @endif
        </tbody>
    </table>  
    
</div>
@endsection


