@extends('layout.plantilla')

@section('titulo','Préstamos')

@section('contenido')

<div class="container ">
    <h1>PRESTAMOS DE LIBROS</h1>
    <a href="{{route('prestamo.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Crear</a>
    
    <nav class="navbar float-right">
       
        <form class="form-inline my-2" method="GET">
            <input name="buscarpor" class="form-control me-2" type="search" placeholder="Busqueda por apellido" aria-label="Search" value="{{$buscarpor}}">
            <button class="btn btn-success" type="submit">Buscar</button>
        </form>
    </nav>
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
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col"><i class="fa fa-calendar" aria-hidden="true"></i> Registro</th>
                <th scope="col">Días</th>
                <th scope="col">Tipo</th>
                <th scope="col">Lector</th>
                <th scope="col"><i class="fa fa-calendar" aria-hidden="true"></i> Devolucion</th>
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
                        <td>{{$item->tipo->Tipoprestamo}}</td>
                        <td>{{$item->lectores->Apellidoslector}}, {{$item->lectores->Nombreslector }}</td>
                        <td>{{$item->Fechadevolucionesperadap}} {{$item->Horadevolucionesperadap}} </td>
                        <td> <a href="" class="btn btn-danger">{{$item->estadoprestamos->Estadoprestamo}}</a></td>
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
@section('script')
<script>
    //para cerrar el mensaje
    setTimeout(function () {
        //selecciono el id mensaje y lo remuevo en 2000 segundos
        document.querySelector('#mensaje').remove();
        
    }, 2000);
</script>
@endsection