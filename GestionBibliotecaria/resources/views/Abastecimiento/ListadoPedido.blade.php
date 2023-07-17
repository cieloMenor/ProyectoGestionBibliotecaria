@extends('layout.plantilla')

@section('titulo','ListadoPedido')
@section('contenido')

<div class="container">
    <br>
    <a href="{{route('registroP')}}" class="btn btn-primary"><i class="fas fa-plus">Registrar</i></a>
    <br>
    <br>

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
                    <td>
                        <a href="{{route('editarP', [$ItemPedidos->PedidoID])}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Editar</a>
                        &nbsp; &nbsp; &nbsp;

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$ItemPedidos->PedidoID}}">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal-{{$ItemPedidos->PedidoID}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{route('eliminarP',$ItemPedidos->PedidoID)}}" method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Eliminacion de Capacitacion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Esta seguro que desea eliminar <b>{{$ItemPedidos->PedidoID}}</b>? <br>
                                            <i>Se eliminara todo el contenido de la capacitacion</i>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                                   
                    </td>
                 </tr>
                @endforeach
            @endif
        </tbody>
    </table>  
    
</div>
@endsection


