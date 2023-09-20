@extends('layout.plantilla')

@section('titulo','Detalles')

@section('contenido')

<div class="container ">
    <h3>Informacion de devolución</h3>
    <div class="row">
        <p class="col-4"> <strong>PrestamoID:</strong>   {{$devolucion->PrestamoID}}</p>
        <p class="col-5"><strong> Lector: </strong> {{$devolucion->prestamos->lectores->Apellidoslector}}, {{$devolucion->prestamos->lectores->Nombreslector }}</p>
    
        <div class="col"><strong>DNI:</strong>{{$devolucion->prestamos->lectores->Dni_lector}}</div>
    </div>
    <div class="row">
        <p class="col-4"><strong>Fecha registro:</strong> {{$devolucion->Fecharegistrodevolucion}}</p>
        <p class="col-5"><strong>Fecha inicio de devolución:</strong> {{$devolucion->Fechainiciodevolucion}}</p>
        <p class="col"><strong>Multa:</strong>
            @if ($devolucion->Conmulta ==0)
                <a href="" class="btn btn-warning">NO</a>
            @else
                <a href="" class="btn btn-warning">SI</a>

            @endif
        </p>
    </div>
   
    <div class="row">
        <p class="col-4"> <strong>Fecha max. Devolucion:</strong> {{$devolucion->prestamos->Fechadevolucionesperadap}} {{$devolucion->prestamos->Horadevolucionesperadap}} </p>
        <p class="col-1">
            <strong>Libros prestados:</strong>
        </p>
        <p class="col-3">
           
            <select name="" id="" class="form-control">
                @foreach ($detallesPrestamo as $item)
                    <option value="">{{$item->Nombrelibro}}</option>
                @endforeach
            </select>
        </p>
        <p class="col"> <strong>Estado prestamo: </strong><a href="" class="btn btn-primary">{{$devolucion->prestamos->estadoprestamos->Estadoprestamo}}</a></p>

    </div>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">N°</th>
                <th scope="col">CodigoLibro</th>
                <th scope="col">Titulo</th>
                <th scope="col">Fecha</th>
                <th scope="col">Cantidad Devuelta</th>
                <th scope="col">Stock Anterior</th>
                
            </tr>
        </thead>
        <tbody>
            @if(count($detalles)<=0)
                <tr>
                    <td colspan="7"><b>No hay registro</b></td>
                </tr>
            @else
                @foreach($detalles as $item) 
                    <tr> 

                        <td>{{$loop->index+1}}</td>
                        <td>{{$item->LibroID}}</td>
                        <td>{{$item->libros->Titulo}}</td>
                        <td>{{$item->Fechadevolucionlibro}}</td>
                        <td>{{$item->Nrocopiasdevolucion}}</td>
                        <td>{{$item->NroLibrosFaltaDevoD}}</td>
                        
                        
                    </tr>
                @endforeach
                @endif
        </tbody>
    </table>
    <p>Observaciones:</p>
    <textarea name="" id="" style="width: 100%" cols="100" rows="3" readonly>{{$devolucion->Dev_observaciones}}</textarea>
    <center><a href="{{route('devolucion.index')}}" class="btn btn-warning">Retroceder</a></center>
</div>


@endsection