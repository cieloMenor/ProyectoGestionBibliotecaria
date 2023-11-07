@extends('layout.plantilla')

@section('titulo','DatosBibliotecario')
@section('contenido')

<div class="container">
    <br>
    <a href="{{route('registroB')}}" class="btn btn-primary"><i class="fas fa-plus">Registrar</i></a>
    <br>
    <br>

    <p align=center style = "font-family:courier,arial,helvética; color:crimson">
        BIBLIOTECARIO
    </p>

    <div class="row">

    
    <div class="col-6" style="margin-right: 300px;">      
    </div>
    <div class="col-6" style="margin-left: 800px;">
            <form action="{{route('listadoB')}}" method="get">
                <div class="form-row" >
                    <div class="col-sm-4  my-4">
                        <input type="text" class="form-control" name="texto" value="{{$texto}}" placeholder="Busqueda por DNI">
                    </div>
                    <div class="col-auto my-4">
                    <input type="submit" class="btn btn-primary" value="Buscar">
                    </div>
                </div>
            </form>
    </div>
    </div>

    <table class="table table-bordered">
         <thead>
            <tr>
                <th>Codigo Bibliotecario</th>
                <th>Nombres</th>
                <th>DNI</th>
                <th>E-mail</th>
                <th>Dirección</th>
                <th>Telefono</th>
            </tr>
        </thead>
        <tbody>
            @if (count($bibli)<=0) 
                <tr>
                 <td colspan="3"><b>No hay Pedidos</b></td>
                </tr>
            @else 
                @foreach ($bibli as $ItemBibli)
                 <tr>
                    <td>{{$ItemBibli->BibliotecarioID}}</td>
                    <td>{{$ItemBibli->Nombre}}</td>
                    <td>{{$ItemBibli->Dni}}</td>
                    <td>{{$ItemBibli->Correoelectronico}}</td>
                    <td>{{$ItemBibli->Direccion}}</td>
                    <td>{{$ItemBibli->Telefono}}</td>
                    <td>
                        <a href="{{route('editarB', [$ItemBibli->BibliotecarioID])}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Editar</a>
                        &nbsp; &nbsp; &nbsp;

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$ItemBibli->BibliotecarioID}}">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal-{{$ItemBibli->BibliotecarioID}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{route('eliminarB',$ItemBibli->BibliotecarioID)}}" method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Eliminacion de Capacitacion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Esta seguro que desea eliminar <b>{{$ItemBibli->BibliotecarioID}}</b>? <br>
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


