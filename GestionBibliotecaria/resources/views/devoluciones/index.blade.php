@extends('layout.plantilla')

@section('titulo','Devolucion')

@section('contenido')

<div class="container ">

    <h1>Listado de Devoluciones</h1>
    <a href="{{route('devolucion.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Crear</a>
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
    <nav class="navbar float-right">
       
        <form class="form-inline my-2" method="GET">
            <input name="buscarpor" class="form-control me-2" type="search" placeholder="codigo" aria-label="Search" value="{{$buscarpor}}">
            <button class="btn btn-success" type="submit">Buscar por prestamo</button>
        </form>
    </nav>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">PrestamoID</th>
                <th scope="col"><i class="fa fa-calendar" aria-hidden="true"></i> Fecha Inicio</th>
                <th scope="col">Tipo Prestamo</th>
                <th scope="col">Lector</th>
                <th scope="col">Devolvió faltando:</th>
                <th scope="col">Multa</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @if(count($devoluciones)<=0)
                <tr>
                    <td colspan="8"><b>No hay registro</b></td>
                </tr>
            @else
                @foreach($devoluciones as $item)
                <tr>
                    <td>{{$item->DevolucionID}}</td>
                    <td>{{$item->PrestamoID}}</td>
                    <td>{{$item->Fechainiciodevolucion}}</td>
                    <td>{{$item->prestamos->tipo->Tipoprestamo}}</td>
                    <td>{{$item->prestamos->lectores->Apellidoslector}}, {{$item->prestamos->lectores->Nombreslector}}</td>
                    <td>
                        @php
                            
                            date_default_timezone_set('America/Lima');		
                            $fecha_inicio= $item->prestamos->Fechadevolucionesperadap.' '.$item->prestamos->Horadevolucionesperadap; 
                            $fechaFin= new DateTime($fecha_inicio);
                            $fechaDev = $item->Fechainiciodevolucion;
                            $fechaInicio = new DateTime($fechaDev);
                            $intervalo = $fechaInicio->diff($fechaFin);
                           
                            echo $intervalo->format('%r%d')." dias," . $intervalo->format('%r%h') . " hs, " . $intervalo->format('%r%i') . " min. y " . $intervalo->format('%r%s') . " seg.";  

                        @endphp
                    
                    
                    </td>
                    <td> 
                        @if ($item->Conmulta==1)
                        <a href="{{route('devolucion.edit',$item->DevolucionID)}}" class="btn btn-danger">SI</a>
                        @else
                        <a href="" class="btn btn-warning">NO</a>
                        @endif
                    </td>
                    <td class="">
                        <a href="{{route('devolucion.ver',$item->DevolucionID)}}" class="btn btn-primary">Ver</a>
                        <a href="{{route('devolucion.show',$item->DevolucionID)}}" class="btn btn-info"><i class="fas fa-plus"></i></a>
                        
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table> 
    {{$devoluciones->links()}}
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