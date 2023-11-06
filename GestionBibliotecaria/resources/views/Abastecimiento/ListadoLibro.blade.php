@extends('layout.plantilla')

@section('titulo','ListadoLibro')
@section('contenido')

<div class="container">
    <br>
    <a href="{{route('registroL')}}" class="btn btn-primary"><i class="fas fa-plus">Registrar</i></a>
    <br>
    <br>

    <p align=center style = "font-family:courier,arial,helvética; color:crimson">
        LIBROS
    </p>
    <table class="table table-bordered">
         <thead>
            <tr>
                <th>Codigo Libro</th>
                <th>Titulo</th>
                <th>Precio</th>
                <th>Paginas</th>
                <th>ISBN</th>
                <th>Idioma</th>
                <th>Editorial</th>
                <th>Año Publicación</th>
                <th>Stock</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @if (count($libros)<=0) 
                <tr>
                 <td colspan="3"><b>No hay Pedidos</b></td>
                </tr>
            @else 
                @foreach ($libros as $ItemDetallesL)
                 <tr>
                    <td>{{$ItemDetallesL->LibroID}}</td>
                    <td>{{$ItemDetallesL->Titulo}}</td>
                    <td>{{$ItemDetallesL->Precio}}</td>
                    <td>{{$ItemDetallesL->Paginas}}</td>
                    <td>{{$ItemDetallesL->Isbn}}</td>
                    <td>{{$ItemDetallesL->Idioma}}</td>
                    <td>{{$ItemDetallesL->Editorial}}</td>
                    <td>{{$ItemDetallesL->Añopublicacion}}</td>
                    <td>{{$ItemDetallesL->Stock}}</td>
                    <td>
                        <a href="{{route('editarL', [$ItemDetallesL->LibroID])}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Editar</a>
                        &nbsp; &nbsp; &nbsp;

                        <form action="{{ route('eliminarLi', $ItemDetallesL->LibroID) }}" method="POST">
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


