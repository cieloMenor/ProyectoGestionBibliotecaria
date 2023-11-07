@extends('layout.plantilla')

@section('titulo','Detalles')

@section('contenido')

<div class="container ">
    <h3>Informacion de prestamo</h3>
    <div class="row">
        <p class="col"> <strong>Tipo:</strong>   {{$prestamo->tipo->Tipoprestamo}}</p>
        <p class="col"><strong> Lector: </strong> {{$prestamo->lectores->Apellidoslector}}, {{$prestamo->lectores->Nombreslector }}</p>
    
        <div class="col"><strong>DNI:</strong>{{$prestamo->lectores->Dni_lector}}</div>
    </div>
    <div class="row">
        <p class="col"><strong>Fecha registro:</strong> {{$prestamo->Fecharegistroprestamo}}</p>
        <p class="col"><strong>Fecha actualización:</strong> {{$prestamo->Fechaupdateprestamo}}</p>
        <p class="col"><strong>Fecha entrega:</strong> {{$prestamo->Fechaentregaprestamo}}</p>
    </div>
   
    <div class="row">
        <p class="col-6"> <strong>Fecha esperada Devolucion:</strong> {{$prestamo->Fechadevolucionesperadap}} {{$prestamo->Horadevolucionesperadap}} </p>
        <p class="col-2"></p>
        <p class="col"> <strong>Estado: </strong><a href="" class="btn btn-primary">{{$prestamo->estadoprestamos->Estadoprestamo}}</a></p>

    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">N°</th>
                <th scope="col">CodigoLibro</th>
                <th scope="col">Titulo</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Stock Anterior</th>
                <th scope="col">Faltan devolver:</th>
                <th scope="col">Estado</th>
                
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
                        <td>{{$item->Nombrelibro}}</td>
                        <td>{{$item->Nrocopiasprestamo}}</td>
                        <td>{{$item->StockLibroP}}</td>
                        <td>{{$item->NroLibrosFaltaDevo}}</td>
                        <td><a href="" class="btn btn-primary">{{$item->estadodetalleprestamos->Estadodetalleprestamo}}</a></td>
                        
                        
                    </tr>
                @endforeach
                @endif
        </tbody>
    </table>
    <p>Observaciones:</p>
    <textarea name="" id="" style="width: 100%" cols="100" rows="3" readonly>{{$prestamo->Observacionesprestamo}}</textarea>
    <center><a href="{{route('prestamo.index')}}" class="btn btn-warning">Retroceder</a></center>
</div>

@endsection