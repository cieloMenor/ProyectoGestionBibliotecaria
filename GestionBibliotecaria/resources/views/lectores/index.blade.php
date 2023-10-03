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
                    <td>{{$itemlector->LectorID}}</td>
                    <td>{{$itemlector->Dni_lector}}</td>
                    <td>{{$itemlector->Apellidoslector}}, {{$itemlector->Nombreslector}}</td>
                    <td>{{$itemlector->Correolector}}</td>
                    <td> @php
                        $fecha_de_nacimiento =  $itemlector->Fechanaclector; //dd-mm-aaaa
                            $hoy = date("Y-m-d");
                            $diff = date_diff(date_create($fecha_de_nacimiento), date_create($hoy));
                            
                        echo $diff->format('%y');
                    @endphp
                    </td>
                    <td > <p class="btn btn-primary">{{$itemlector->Estadolector}}</p></td>
                    
                    @if($itemlector->Estadohablector == 1)
                        <td > <p class="btn btn-warning">Habilitado</p></td>
                    @else
                        <td> <p class="btn btn-danger">Desabilitado</p></td>
                    @endif
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$itemlector->LectorID}}">
                            <i class="fas fa-edit"></i> Ver
                          </button>
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal{{$itemlector->LectorID}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modalperrito" >
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">{{$itemlector->Apellidoslector}} - {{$itemlector->Dni_lector}}</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <h4>Datos del Lector</h4>
                                  <p>DNI: {{$itemlector->Dni_lector}}</p>
                                  <P>Nombres: {{$itemlector->Nombreslector}}</P>
                                  <P>Apellidos: {{$itemlector->Apellidoslector}}</P>
                                  <P>Nombres: {{$itemlector->Nombreslector}}</P>
                                  <P>Celular: {{$itemlector->Celularlector}}</P>
                                  <P>Dirección: {{$itemlector->Direccionlector}}</P>
                                  <P>Fecha de registro: {{$itemlector->Fecharegistrolector}}</P>
                                  <P>Celular: {{$itemlector->Celularlector}}</P>
                                  <P>Estado: {{$itemlector->Estadolector}}</P>
                                  <P>Correo: {{$itemlector->Correolector}}</P>
                                  <P>Fecha Nacimiento: {{$itemlector->Fechanaclector}}</P>
                                  <div class="row">
                                  <p class="col">Edad:
                                    @php
                                        $fecha_de_nacimiento =  $itemlector->Fechanaclector; //dd-mm-aaaa
                                            $hoy = date("Y-m-d");
                                            $diff = date_diff(date_create($fecha_de_nacimiento), date_create($hoy));
                                            
                                        echo $diff->format('%y');
                                    @endphp
                                  </div>
                                  <p>Última Actualización: {{$itemlector->Fechaupdatelector}}</p>
                                  @if ($itemlector->bibliotecarios!= null)
                                  <p> Bibliotecario que lo registró: {{$itemlector->bibliotecarios->Nombre}}</p>
                                  @else
                                  <p> No fue registrado por un bibliotecario</p>
                                  @endif
                                  <p>Usuario que lo registró: {{$itemlector->usuarios->Usuario}}</p>

                                  <p>Estado Habilitación:
                                    @if($itemlector->Estadohablector == 1)
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
                        
                        <a href="{{route('lector.edit',$itemlector->LectorID)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Editar</a>
                        
                        {{-- <a href="{{route('tramite.confirmar',$itemtramite->idtramite)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>--}}
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal2{{$itemlector->LectorID}}">
                            <i class="fas fa-trash"></i>
                          </button>
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal2{{$itemlector->LectorID}}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                            <div class="modal-dialog modalperrito" >
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">{{$itemlector->Apellidoslector}} - {{$itemlector->LectorID}}</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <p>
                                    ¿Está seguro de eliminar este lector: {{$itemlector->Apellidoslector}}, {{$itemlector->Nombreslector}}?
                                  </p>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{route('lector.destroy',$itemlector->LectorID)}}" method="post">
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