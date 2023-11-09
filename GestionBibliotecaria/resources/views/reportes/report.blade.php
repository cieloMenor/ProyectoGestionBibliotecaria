@extends('layout.plantilla')

@section('titulo','Reporte - Gestión')

@section('contenido')

<div class="container-fluid">

    <center><h2>Reporte de prestamo de libros</h2></center>
    
    <nav class="navbar float-right">
       
        <form class="form-inline my-2" method="GET">
            Desde: <input name="fechaInicio" class="form-control me-2" type="date" placeholder="Busqueda por apellido" aria-label="Search" value="{{$fechaInicio}}" required>
              Hasta: <input name="fechaFin" class="form-control me-2" type="date" placeholder="Busqueda por apellido" aria-label="Search" value="{{$fechaFin}}" required>
            
            <button class="btn btn-success" type="submit">Buscar</button>
              
        </form>  
        <a href="{{route('reportepdf',$fechaInicio.$fechaFin)}}" class="btn btn-primary">Exportar PDF</a>
    </nav>
    
    
    <table class="table">
        <thead class="thead-default" style="background-color:#2b8190;color: #fff;">
            <tr>
                <th scope="col">ID</th>
                <th scope="col"><i class="fa fa-calendar" aria-hidden="true"></i> Registro</th>
                <th scope="col">Días</th>
                <th scope="col">Tipo</th>
                <th scope="col">Lector</th>
                <th scope="col"><i class="fa fa-calendar" aria-hidden="true"></i> Devolucion</th>
                <th scope="col">Estado</th>
            </tr>
          </thead>
          <tbody>
            @if(count($prestamos)<=0)
                <tr>
                    <td colspan="6"><b>No hay registro</b></td>
                </tr>
            @else
                @foreach ($prestamos as $item)
                <tr>
                    <td>{{$item->PrestamoID}}</td>
                        
                        <td>@php
                            $fechita = date_create($item->Fecharegistroprestamo);
                                $fechita2=date_format($fechita, 'd-m-Y');
                            
                            echo $fechita2;
                        
                        @endphp
                            
                            
                           
                        </td>
                        <td>
                            {{-- @if($item->fecharegistroPrestamo == $item->fechaDevolucionEsperadaP) --}}
                            @php

                                $date = date_create($item->Fecharegistroprestamo);
                                $fecha=date_format($date, 'Y-m-d');

                                $fecha_de_nacimiento =  $item->Fechadevolucionesperadap; //dd-mm-aaaa
                               // $hoy = date("Y-m-d");
                                $diff = date_diff(date_create($fecha), date_create($fecha_de_nacimiento));
                            
                                echo $diff->format('%d');
                            @endphp
                            
                        </td>
                        <td>{{$item->tipo->Tipoprestamo}}</td>
                        <td>{{$item->lectores->Apellidoslector}}, {{$item->lectores->Nombreslector }}</td>
                        <td>
                            @php
                            $fechita3 = date_create($item->Fechadevolucionesperadap);
                                $fechita4=date_format($fechita3, 'd-m-Y');
                            
                            echo $fechita4;
                        
                            @endphp
                            {{$item->Horadevolucionesperadap}} </td>
                        
                    <td>
                        {{$item->estadoprestamos->Estadoprestamo}}
                    </td>
                </tr>
            </tr>
            @endforeach
        @endif
    </tbody>
    
</table>
</div>
@endsection

@section('script')
<script>

</script>
@endsection