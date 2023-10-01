@extends('layout.plantilla')

@section('titulo','Tipos de multa')

@section('contenido')

<div class="container ">
    <h1>Tipos de Multa</h1>
    <br>
    <a href="{{route('tipomulta.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</a>
    
    
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
        <thead class="thead-default" style="background-color:#2b8190;color: #fff;">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Descripcion</th>
              <th scope="col">Porcentaje</th>
              <th scope="col">Fecha registro <i class="fa fa-calendar" aria-hidden="true"></i></th>
              <th scope="col">Usuario</th>
              <th scope="col">Opciones</th>
            </tr>
          </thead>
          <tbody>
            @if(count($tiposmulta)<=0)
                <tr>
                    <td colspan="6"><b>No hay registro</b></td>
                </tr>
            @else
                @foreach ($tiposmulta as $tipomulta)
                <tr>
                    <td>{{$tipomulta->MultaID}}</td>
                    <td>{{$tipomulta->Descripcionmulta}}</td>
                    <td>{{$tipomulta->Porcentajemulta}}</td>
                    <td>{{$tipomulta->Fecharegistromulta}}</td>
                    <td>{{$tipomulta->users->Usuario}}</td>
                    <td>
                        <a href="{{route('tipomulta.edit',$tipomulta->MultaID)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Editar</a>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal2{{$tipomulta->MultaID}}">
                            <i class="fas fa-trash"></i>
                          </button>
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal2{{$tipomulta->MultaID}}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                            <div class="modal-dialog modalperrito" >
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">{{$tipomulta->MultaID}}</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <p>
                                    ¿Está seguro de eliminar el tipo de multa: {{$tipomulta->Descripcionmulta}}?
                                  </p>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{route('tipomulta.destroy',$tipomulta->MultaID)}}" method="post">
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
            </tr>
            @endforeach
        @endif
    </tbody>
    
</table>
{{$tiposmulta->links()}}
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