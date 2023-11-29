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
    <table class="table" >
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col"><i class="fa fa-calendar" aria-hidden="true"></i> Registro</th>
                <th scope="col">Días</th>
                <th scope="col">Tipo</th>
                <th scope="col">Lector</th>
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
                        <td>{{$item->Fecharegistroprestamo}}
                           
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
                        <td>{{$item->Fechadevolucionesperadap}} {{$item->Horadevolucionesperadap}} </td>
                        <td>
                            @php
	
                                
                            date_default_timezone_set('America/Lima');		
                            $fecha_actual = date("Y-m-d H:i:s"); 
                            $fechaInicio = new DateTime($fecha_actual);
                            $fechaDev = $item->Fechadevolucionesperadap.' '.$item->Horadevolucionesperadap;
                            $fechaFin = new DateTime($fechaDev);
                            $intervalo = $fechaInicio->diff($fechaFin);
                           

                            @endphp
                            @if ($item->Estado_prestamoID ==3 || $item->Estado_prestamoID ==5)
                                0 dias, 0 horas, 0 min. y 0 seg.
                            @else
                                @php
                                echo $intervalo->format('%r%d')." dias," . $intervalo->format('%r%h') . " horas, " . $intervalo->format('%r%i') . " min. y " . $intervalo->format('%r%s') . " seg.";  
                                    
                                @endphp
                            @endif
                        </td>
                        <td> <a href=""  @if ($item->Estado_prestamoID==1) class="btn btn-warning"
                            
                        @endif  @if ($item->Estado_prestamoID==2) class="btn btn-secondary"
                            
                        @endif  @if ($item->Estado_prestamoID==3) class="btn btn-danger"
                            
                        @endif  @if ($item->Estado_prestamoID==4) class="btn btn-danger"
                            
                        @endif  @if ($item->Estado_prestamoID==5) class="btn btn-info"
                            
                        @endif  
                            
                            
                            >{{$item->estadoprestamos->Estadoprestamo}}</a></td>
                        <td> 
                            <a href="{{route('prestamo.ver',$item->PrestamoID)}}" class="btn btn-primary"> <i class="fa fa-search" aria-hidden="true"></i></a>
                            @if ($item->Estado_prestamoID ==1)
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal2{{$item->PrestamoID}}">
                                <i class="fas fa-trash"></i>
                              </button>
                              <!-- Modal -->
                              <div class="modal fade" id="exampleModal2{{$item->PrestamoID}}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                <div class="modal-dialog modalperrito" >
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Eliminacion</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <p>
                                        ¿Está seguro de eliminar este PRESTAMO:{{$item->PrestamoID}}?
                                      </p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{route('prestamo.destroy',$item->PrestamoID)}}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-check-square"></i>SI</button>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i>No</button>
                                          </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            @endif
                            
                            <a href="{{route('ticket',$item->PrestamoID)}}" class="btn btn-warning"> <i class="fas fa-file-pdf    "></i></a>
                            @if ($item->Estado_prestamoID==4)
                            <a href="{{route('prestamo.edit',$item->PrestamoID)}}" class="btn btn-danger">Multar</a>
                            @endif
                              
                        </td>
                    
                    </tr> 
                @endforeach
            @endif
        </tbody>
    </table> 
    {{$prestamos->links()}}
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