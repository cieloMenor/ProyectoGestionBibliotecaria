@extends('layout.plantilla')

@section('titulo','Usuarios')

@section('contenido')

<div class="container ">
    <h1>USUARIOS</h1>
    <br>
    <a href="{{route('usuario.create2')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</a>
    
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
              <th scope="col">Nombres y Apellidos</th>
              <th scope="col">Usuario</th>
              <th scope="col">Correo</th>
              <th scope="col">Rol</th>
              <th scope="col">Estado</th>
              <th scope="col">Opciones</th>
            </tr>
          </thead>
          <tbody>
            @if(count($usuarios)<=0)
                <tr>
                    <td colspan="7"><b>No hay registro</b></td>
                </tr>
            @else
                @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{$usuario->UsuarioID}}</td>
                    <td>{{$usuario->Apellidosusuario}}, {{$usuario->Nombresusuario}}</td>
                    <td>{{$usuario->Usuario}}</td>
                    <td>{{$usuario->Correousuario}}</td>
                    <td> <p class="btn btn-primary">{{$usuario->roles->Descripcionrol}}</p></td>
                    
                        @if($usuario->Estadousuario == 1)
                        <td > <p class="btn btn-warning">Habilitado</p></td>
                        @else
                            <td> <p class="btn btn-danger">Desabilitado</p></td>
                        @endif
                    <td>
                        <a href="{{route('usuario.edit',$usuario->UsuarioID)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Editar</a>

                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal2{{$usuario->UsuarioID}}">
                            <i class="fas fa-trash"></i>
                          </button>
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal2{{$usuario->UsuarioID}}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                            <div class="modal-dialog modalperrito" >
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">{{$usuario->Usuario}}</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <p>
                                    ¿Está seguro de eliminar al usuario: {{$usuario->Usuario}}?
                                  </p>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{route('usuario.destroy',$usuario->UsuarioID)}}" method="post">
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
    {{$usuarios->links()}}
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