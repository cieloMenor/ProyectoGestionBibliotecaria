@extends('layout.plantilla')

@section('titulo','ListadoProveedor')
@section('contenido')

<div class="container">
    <br>
    <a href="{{route('registro')}}" class="btn btn-primary"><i class="fas fa-plus">Registrar</i></a>
    <br>
    <br>
    <div id="mensaje">
        @if (session('datos'))
        <div class="alert alert-danger" role="alert">
            {{session('datos')}}
            <button type="button" class="close" data-dismiss='alert' aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>

    <p align=center style="font-family:courier,arial,helvética; color:crimson">
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
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @if (count($Proveedores)<=0) <tr>
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
                    <td>
                        <a href="{{route('editar', [$ItemProveedor->ProveedorID])}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Editar</a>
                        &nbsp; &nbsp; &nbsp;

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$ItemProveedor->ProveedorID}}">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal-{{$ItemProveedor->ProveedorID}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{route('eliminar',$ItemProveedor->ProveedorID)}}" method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Eliminacion de Capacitacion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Esta seguro que desea eliminar <b>{{$ItemProveedor->ProveedorID}}</b>? <br>
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

@section('script')
<script>
    setTimeout(function() {
        document.querySelector('#mensaje').remove();
    }, 5000);
</script>

@endsection