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
                    <td>{{$itemlector->index+1}}</td>
                    <td>{{$itemlector->DNILector}}</td>
                    <td>{{$itemlector->ApellidosLector}}, {{$itemlector->NombresLector}}</td>
                    <td>{{$itemlector->CorreoLector}}</td>
                    <td>
                        <?php $fecha= {{$itemlector->FechaNacLector}};
                            $hoy = new Datetime();
                            $edad = $hoy->diff($fecha);
                            
                        ?>{{--$itemlector->--}}
                        <?php $edad->y; ?></td>
                    <td>{{$itemlector->estadolector}}</td>
                    
                    @if($itemlector->EstadoHabLector == 1)
                        <td>Habilitado</td>
                    @else
                        <td>Desabilitado</td>
                    @endif
                    <td>
                        <a href="{{--route('tramite.detalle',$itemtramite->idtramite)--}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Ver</a>
                        <a href="{{--route('tramite.edit',$itemtramite->idtramite)--}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Editar</a>
                        <a href="{{--route('tramite.confirmar',$itemtramite->idtramite)--}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Eliminar</a>
                        
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