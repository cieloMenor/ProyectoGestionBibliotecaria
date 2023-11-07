@extends('layout.plantilla')

@section('titulo','Editar Usuario')

@section('contenido')

<div class="container ">
    <h1>Editar Usuario</h1>
    <form method="POST" action="{{route('usuario.update', $usuario->UsuarioID)}}">
        @method('put')
        @csrf
        <div class="form-group row">
            <div class="col">
                <label class="control-label">Usuario:</label>
                <input type="text" name="Usuario" class="form-control input_user @error('Usuario') is-invalid @enderror" value="{{$usuario->Usuario}}" placeholder="username" readonly >
                @error('Usuario') 
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="col">
                <label class="control-label">Apellidos:</label>
                <input type="text" name="Apellidosusuario" class="form-control input_user @error('Apellidosusuario') is-invalid @enderror" value="{{$usuario->Apellidosusuario}}" placeholder="apellidos" required>
                @error('Apellidosusuario') 
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="col">
                <label class="control-label">Nombres:</label>
                <input type="text" name="Nombresusuario" class="form-control input_user @error('Nombresusuario') is-invalid @enderror" value="{{$usuario->Nombresusuario}}" placeholder="nombres" required>
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
                <input type="text" name="Celularusuario" class="form-control input_user @error('Celularusuario') is-invalid @enderror" value="{{$usuario->Celularusuario}}" placeholder="celular" required>
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
                    <option value="{{$rol->RolID}}"  @if($usuario->RolID == $rol->RolID) selected @endif >{{$rol->Descripcionrol}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <label class="control-label">Correo:</label>
                <input type="email" name="Correousuario" class="form-control input_user @error('Correousuario') is-invalid @enderror" value="{{$usuario->Correousuario}}" placeholder="email" required>
                @error('Correousuario') 
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Actualizar</button>
        <a href="{{route('usuario.cancelar')}}" class="btn btn-danger"><i class="fas fa-ban"></i>Cancelar</a>
    </form>
</div>

@endsection