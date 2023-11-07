@extends('layout.plantilla')

@section('titulo','Roles')

@section('contenido')

<div class="container ">
    <h1>ROLES</h1>
    <br>
    <a href="{{route('rol.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</a>
    
    
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
              <th scope="col">Descripción</th>
              <th scope="col">Fecha</th>
              <th scope="col">Estado</th>
              <th scope="col">Opciones</th>
            </tr>
          </thead>
          <tbody>
            @if(count($roles)<=0)
                <tr>
                    <td colspan="5"><b>No hay registro</b></td>
                </tr>
            @else
                @foreach ($roles as $rol)
                <tr>
                    <td>{{$rol->RolID}}</td>
                    <td>{{$rol->Descripcionrol}}</td>
                    <td>{{$rol->fechaRegistroRol}}</td>
                    @if($rol->Estadorol == 1)
                    <td > <p class="btn btn-warning">Habilitado</p></td>
                    @else
                        <td> <p class="btn btn-danger">Desabilitado</p></td>
                    @endif
                    <td>
                        <a href="{{route('rol.edit',$rol->RolID)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Editar</a>
                        @if($rol->Estadorol == 1)
                          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal2{{$rol->RolID}}">
                            <i class="fas fa-trash"></i>
                          </button>
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal2{{$rol->RolID}}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                            <div class="modal-dialog modalperrito" >
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">{{$rol->Descripcionrol}}</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <p>
                                    ¿Está seguro de eliminar el rol: {{$rol->RolID}}?
                                  </p>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{route('rol.destroy',$rol->RolID)}}" method="post">
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
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
        
    </table>
    {{$roles->links()}}
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