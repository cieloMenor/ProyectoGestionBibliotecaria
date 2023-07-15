@extends('layout.plantilla')

@section('titulo','ListadoProveedor')
@section('contenido')

<div class="container">
    <br>
    <a href="{{route('registro')}}" class="btn btn-primary"><i class="fas fa-plus">Registrar</i></a>
    <br>
    <br>
    
    <p align=center style = "font-family:courier,arial,helvética; color:crimson">
        PROVEEDORES
    </p>
    <table class="table table-bordered">
         <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                 <th>E-mail</th>
                 <th>Direccion</th>
                  <th>Telefono</th>
            </tr>
        </thead>
        <tbody>
            @if (count($Proveedores)<=0) 
                <tr>
                 <td colspan="3"><b>No hay Registro</b></td>
                </tr>
            @else 
                @foreach ($Proveedores as $ItemProveedor)
                 <tr>
                    <td>{{$ItemProveedor->ProveedorID}}</td>
                    <td>{{$ItemProveedor->Empresa}}</td>
                    <td>{{$ItemProveedor->Correoelectronico}}</td>
                    <td>{{$ItemProveedor->Direccion}}</td>
                    <td>{{$ItemProveedor->Telefono}}</td>
                 </tr>
                @endforeach
            @endif
        </tbody>
    </table>  
</div>
@endsection
