@extends('layout.plantilla')

@section('titulo','Cambiar ocntraseña')

@section('contenido')

<div class="container ">
    <h1>Cambiar mi contraseña</h1>
    <form method="POST" action="{{route('perfil.store')}}">
        
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
        </div>
        <div class="row">
            <div class="col">
                <label class="control-label">Actual Password:</label>
                <input type="password" name="password" class="form-control input_pass @error('password') is-invalid @enderror" value="{{old('password')}}" placeholder="password" required>
                @error('password') 
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="col">
                <label class="control-label">Nuevo Password:</label>
                <input type="password" name="nuevopassword" class="form-control input_pass @error('nuevopassword') is-invalid @enderror" value="{{old('nuevopassword')}}" placeholder="nuevopassword" required>
                @error('nuevopassword') 
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="col">
                <label class="control-label">Ingresa de nuevo el Password nuevo:</label>
                <input type="password" name="reppassword" class="form-control input_pass @error('reppassword') is-invalid @enderror" value="{{old('reppassword')}}" placeholder="password" required>
                @error('reppassword') 
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Cambiar</button>
        <a href="{{route('perfil.cancelar')}}" class="btn btn-danger"><i class="fas fa-ban"></i>Cancelar</a>  
    </form>
</div>
@endsection