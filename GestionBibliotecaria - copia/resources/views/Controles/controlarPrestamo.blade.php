@extends('layout.plantilla')

@section('titulo','Control Prestamo')

@section('contenido')

<div class="container ">
    <h1>Controlar préstamos</h1>
    <a href="{{route('controlPrestamo.create')}}" class="btn btn-primary"> <i class="fa fa-calendar" aria-hidden="true"></i> Actualizar vencimiento</a>
    {{-- Mensaje de alerta --}}
    <div id="mensaje">
        @if (session('datos'))
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                {{session('datos')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">$times;</span>
                </button>
            </div>
        @endif
    </div>
    <table class="table" >
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col"><i class="fa fa-calendar" aria-hidden="true"></i> Registro</th>
                <th scope="col">Tipo</th>
                <th scope="col"><i class="fa fa-calendar" aria-hidden="true"></i> Devolucion</th>
                <th scope="col">Faltan:</th>
                <th scope="col">Estado</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @if(count($prestamos)<=0)
            <tr>
                <td colspan="8"><b>No hay registro</b></td>
            </tr>
        @else
            @foreach($prestamos as $item) 
                <tr>
                    <td>{{$item->PrestamoID}}</td>
                    <td>{{$item->Fecharegistroprestamo}}</td>
                    <td>{{$item->tipo->Tipoprestamo}}</td>
                    <td>{{$item->Fechadevolucionesperadap}} {{$item->Horadevolucionesperadap}}</td>
                    <td>
                        @php

                            
                        date_default_timezone_set('America/Lima');		
                        $fecha_actual = date("Y-m-d H:i:s"); 
                        $fechaInicio = new DateTime($fecha_actual);
                        $fechaDev = $item->Fechadevolucionesperadap.' '.$item->Horadevolucionesperadap;
                        $fechaFin = new DateTime($fechaDev);
                        $intervalo = $fechaInicio->diff($fechaFin);
                       
                        echo $intervalo->format('%r%d')." dias," . $intervalo->format('%r%h') . " horas, " . $intervalo->format('%r%i') . " min. y " . $intervalo->format('%r%s') . " seg.";  
                                
                        @endphp
                    </td>
                    <td><a href="" class="btn btn-info">{{$item->estadoprestamos->Estadoprestamo}}</a></td>
                    <td> <a href="" class="btn btn-danger">Vencer</a> </td>

                </tr> 
            @endforeach
        @endif
        </tbody>
    </table> 
    {{--$prestamos->links()--}}
</div>
@endsection

@section('script')
<script>
    //para cerrar el mensaje
    setTimeout(function () {
        //selecciono el id mensaje y lo remuevo en 2000 segundos
        document.querySelector('#mensaje').remove();
        
    }, 2000);
</script>
@endsection