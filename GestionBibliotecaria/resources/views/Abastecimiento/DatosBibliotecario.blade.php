@extends('layout.plantilla')

@section('titulo','DatosBibliotecario')
@section('contenido')

<div class="container">
    <br>
    <a href="{{route('registroB')}}" class="btn btn-primary"><i class="fas fa-plus">Registrar</i></a>
    <br>
    <br>

    <p align=center style = "font-family:courier,arial,helvética; color:crimson">
        PEDIDOS
    </p>
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
                 </tr>
                @endforeach
            @endif
        </tbody>
    </table>  
    
</div>
@endsection


