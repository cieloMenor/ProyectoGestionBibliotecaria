@extends('layout.plantilla')

@section('titulo','Editar Usuario')

@section('contenido')

<div class="container ">
    <h1>Mi Perfil</h1>
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
    <form method="POST" action="{{route('perfil.update',auth()->user()->UsuarioID)}}">
        @method('put')
        @csrf
        <div class="form-group row">
            <div class="col">
                <label class="control-label">Usuario:</label>
                <input type="text" name="Usuario" class="form-control input_user @error('Usuario') is-invalid @enderror" value="{{auth()->user()->Usuario}}" placeholder="username" readonly >
                @error('Usuario') 
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="col">
                <label class="control-label">Apellidos:</label>
                <input type="text" name="Apellidosusuario" class="form-control input_user @error('Apellidosusuario') is-invalid @enderror" value="{{auth()->user()->Apellidosusuario}}" placeholder="apellidos" required>
                @error('Apellidosusuario') 
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="col">
                <label class="control-label">Nombres:</label>
                <input type="text" name="Nombresusuario" class="form-control input_user @error('Nombresusuario') is-invalid @enderror" value="{{auth()->user()->Nombresusuario}}" placeholder="nombres" required>
                @error('Nombresusuario') 
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <label class="control-label">Celular:</label>
                <input type="text" name="Celularusuario" class="form-control input_user @error('Celularusuario') is-invalid @enderror" value="{{auth()->user()->Celularusuario}}" placeholder="celular" required>
                @error('Celularusuario') 
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            
            <div class=" col">
                <label class="control-label">Rol:</label>
                <select name="RolID" id="RolID" class="form-select input_user col-9">
                    @foreach ($roles as $rol)
                    <option value="{{$rol->RolID}}"  @if(auth()->user()->RolID == $rol->RolID) selected @endif >{{$rol->Descripcionrol}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <label class="control-label">Correo:</label>
                <input type="email" name="Correousuario" class="form-control input_user @error('Correousuario') is-invalid @enderror" value="{{auth()->user()->Correousuario}}" placeholder="email" required>
                @error('Correousuario') 
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
           
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Actualizar</button>
        <a href="{{route('perfil.salir')}}" class="btn btn-danger"><i class="fas fa-ban"></i>Cancelar</a>
        <a href="{{route('perfil.show',auth()->user()->UsuarioID)}}" class="btn btn-warning"><i class="fas fa-edit    "></i>Cambiar contraseña</a>

    </form>
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