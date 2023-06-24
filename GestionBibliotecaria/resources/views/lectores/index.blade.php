@extends('layout.plantilla')

@section('titulo','Lectores')

@section('contenido')

<div class="container ">
    <h1>LECTORES</h1>
    <br>
    {{-- nuevo tramite--}}
    <a href="{{route('lector.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</a>
    
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
        <thead>
          <tr>
            <th scope="col">N°</th>
            <th scope="col">DNI</th>
            <th scope="col">Lector</th>
            <th scope="col">Correo</th>
            <th scope="col">Edad</th>
            <th scope="col">Estado</th>
            <th scope="col">Estado Hab.</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody>
            @if(count($lectores)<=0)
                <tr>
                    <td colspan="7"><b>No hay registro</b></td>
                </tr>
            @else
                @foreach ($lectores as $itemlector)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$itemlector->DNILector}}</td>
                    <td>{{$itemlector->ApellidosLector}}, {{$itemlector->NombresLector}}</td>
                    <td>{{$itemlector->CorreoLector}}</td>
                    <td> @php
                        $fecha_de_nacimiento =  $itemlector->FechaNacLector; //dd-mm-aaaa
                            $hoy = date("Y-m-d");
                            $diff = date_diff(date_create($fecha_de_nacimiento), date_create($hoy));
                            
                        echo $diff->format('%y');
                    @endphp
                    </td>
                    <td > <p class="btn btn-primary">{{$itemlector->estadolector}}</p></td>
                    
                    @if($itemlector->EstadoHabLector == 1)
                        <td > <p class="btn btn-warning">Habilitado</p></td>
                    @else
                        <td> <p class="btn btn-danger">Desabilitado</p></td>
                    @endif
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$itemlector->DNILector}}">
                            <i class="fas fa-edit"></i> Ver
                          </button>
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal{{$itemlector->DNILector}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modalperrito" >
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">{{$itemlector->ApellidosLector}} - {{$itemlector->DNILector}}</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <h4>Datos del Lector</h4>
                                  <p>DNI: {{$itemlector->DNILector}}</p>
                                  <P>Nombres: {{$itemlector->NombresLector}}</P>
                                  <P>Apellidos: {{$itemlector->ApellidosLector}}</P>
                                  <P>Estado: {{$itemlector->estadolector}}</P>
                                  <P>Correo: {{$itemlector->CorreoLector}}</P>
                                  <P>Fecha Nacimiento: {{$itemlector->FechaNacLector}}</P>
                                  <div class="row">
                                  <p class="col">Edad:
                                    @php
                                        $fecha_de_nacimiento =  $itemlector->FechaNacLector; //dd-mm-aaaa
                                            $hoy = date("Y-m-d");
                                            $diff = date_diff(date_create($fecha_de_nacimiento), date_create($hoy));
                                            
                                        echo $diff->format('%y');
                                    @endphp
                                  </p>
                                  <P class="col">Celular: {{$itemlector->CelularLector}}</P>
                                  </div>
                                  <p>Fecha de Registro: {{$itemlector->FecharegistroLector}}</p>
                                  <p>Última Actualización: {{$itemlector->FechaUpdateLector}}</p>
                                  <p>Dirección: {{$itemlector->DireccionLector}}</p>
                                  <p>Estado Habilitación:
                                    @if($itemlector->EstadoHabLector == 1)
                                        <h5 class="btn btn-warning">Habilitado</h5>
                                    @else
                                        <h5 class="btn btn-danger">Desabilitado</h5>
                                    @endif
                                  </p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i>Cerrar</button>
                                 
                                </div>
                              </div>
                            </div>
                          </div>
                        
                        <a href="{{route('lector.edit',$itemlector->DNILector)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Editar</a>
                        
                        {{-- <a href="{{route('tramite.confirmar',$itemtramite->idtramite)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>--}}
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal2{{$itemlector->DNILector}}">
                            <i class="fas fa-trash"></i>
                          </button>
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal2{{$itemlector->DNILector}}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                            <div class="modal-dialog modalperrito" >
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">{{$itemlector->ApellidosLector}} - {{$itemlector->DNILector}}</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <p>
                                    ¿Está seguro de eliminar este lector: {{$itemlector->ApellidosLector}}, {{$itemlector->NombresLector}}?
                                  </p>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{route('lector.destroy',$itemlector->DNILector)}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-check-square"></i>SI</button>
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i>No</button>
                                      </form>
                                </div>
                              </div>
                            </div>
                          </div>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{$lectores->links()}}
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