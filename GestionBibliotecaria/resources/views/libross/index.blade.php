@extends('layout.plantilla')

@section('titulo','Libros')

@section('contenido')

<div class="container ">
    <h1>LIBROS</h1>
    <a href="{{route('libroo.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</a>
    
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
            <th scope="col">Id</th>
            <th scope="col">Titulo</th>
            <th scope="col">NroCopias</th>
            <th scope="col">Stock Disponible</th>
            <th scope="col">Autor</th>
            <th scope="col">Estado</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody>
            @if(count($libros)<=0)
                <tr>
                    <td colspan="7"><b>No hay registro</b></td>
                </tr>
            @else
                @foreach ($libros as $item)
                <tr>
                    <td>{{$item->idlibro}}</td>
                    <td>{{$item->nombrelibro}}</td>
                    <td>{{$item->nrocopiaslibro}}</td>
                    <td>{{$item->stocklibro}}</td>
                    <td>{{$item->apellidosautor}}, {{$item->nombresautor}}</td>
                    <td > <p class="btn btn-primary">{{$item->estadolibro}}</p></td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->idlibro}}">
                            <i class="fas fa-edit"></i> Ver
                          </button>
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal{{$item->idlibro}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modalperrito" >
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">{{$item->nombrelibro}} - {{$item->nombresautor}} {{$item->apellidosautor}}</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <h4>Datos del Libro</h4>
                                  <p>IdLibro: {{$item->idlibro}}</p>
                                  <P>Titulo: {{$item->nombrelibro}}</P>
                                  <P>NroCopias Total: {{$item->nrocopiaslibro}}</P>
                                  <P>Stock Disponible: {{$item->stocklibro}}</P>
                                  <P>Autor: {{$item->apellidosautor}}, {{$item->nombresautor}}</P>
                                  <P>Fecha de Registro: {{$item->fecharegistroLibro}}</P>
                                  <p>Última Actualización: {{$item->fechaupdateLibro}}</p>
                                  <p>Estado: <h5 class="btn btn-primary">{{$item->estadolibro}}</h5></p>
                                  
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i>Cerrar</button>
                                 
                                </div>
                              </div>
                            </div>
                          </div>
                        
                        <a href="{{route('libroo.edit',$item->idlibro)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Editar</a>
                        
                        {{-- <a href="{{route('tramite.confirmar',$itemtramite->idtramite)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>--}}
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal2{{$item->idlibro}}">
                            <i class="fas fa-trash"></i>Eliminar
                          </button>
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal2{{$item->idlibro}}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                            <div class="modal-dialog modalperrito" >
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">{{$item->nombrelibro}} - {{$item->nombresautor}} {{$item->apellidosautor}}</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <p>
                                    ¿Está seguro de eliminar este libro: {{$item->nombrelibro}}?
                                  </p>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{route('libroo.destroy',$item->idlibro)}}" method="post">
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
    {{$libros->links()}}
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