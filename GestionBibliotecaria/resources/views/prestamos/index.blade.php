@extends('layout.plantilla')

@section('titulo','Préstamos')

@section('contenido')

<div class="container ">
    <h1>PRESTAMOS DE LIBROS</h1>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Código</th>
                <th scope="col">Fecha registro</th>
                <th scope="col">Días</th>
                <th scope="col">Tipo</th>
                <th scope="col">Lector</th>
                <th scope="col">Estado</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @if(count($prestamos)<=0)
                <tr>
                    <td colspan="7"><b>No hay registro</b></td>
                </tr>
            @else
                @foreach($prestamos as $item) 
                    <tr> 
                        <td>{{$item->idprestamo}}</td>
                        <td>{{$item->fecharegistroPrestamo}}</td>
                        <td>
                            {{-- @if($item->fecharegistroPrestamo == $item->fechaDevolucionEsperadaP) --}}
                            @php
                                // $fecharegistrosolodate=$item->fecharegistroPrestamo;
                                // $fechadevolsolodate=$item->fechaDevolucionEsperadaP;
                                
                                // $fecharegistrosolodate->date_format('Y-m-d');
                                // $fechadevolsolodate->date_format('Y-m-d');

                                $fecha_de_registro =  $item->fecharegistroPrestamo; //dd-mm-aaaa
                                    $fecha_devolucion = $item->fechaDevolucionEsperadaP;
                                    $diff = date_diff(date_create($fecha_devolucion), date_create($fecha_de_registro));
                            @endphp 
                            @if($item->fecharegistroPrestamo == $item->fechaDevolucionEsperadaP)
                                @php
                                    echo $diff->format('%h');
                                @endphp
                            @else
                                @php
                                    // $horaInicio = new DateTime($item->fecharegistroPrestamo);
                                    // $horaTermino = new DateTime($item->fechaDevolucionEsperadaP);

                                    // $interval = $horaInicio->diff($horaTermino);
                                    // echo $interval->format('%H');
                                    echo $diff->format('%d');
                                @endphp
                            @endif
                        </td>
                        <td>{{$item->tipo->tipoprestamo}}</td>
                        <td>{{$item->lectores->ApellidosLector}}, {{$item->lectores->NombresLector}}</td>
                        <td>{{$item->estadoprestamos->estadoprestamo}}</td>
                        <td> 

                        </td>
                    
                    </tr> 
                @endforeach
            @endif
        </tbody>
    </table> 
    {{ $prestamos->links()}}
</div>

@endsection