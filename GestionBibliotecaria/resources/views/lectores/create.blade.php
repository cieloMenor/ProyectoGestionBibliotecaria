@extends('layout.plantilla')

@section('titulo','Nuevo Lector')

@section('contenido')

<div class="container ">

    <h1>Nuevo Lector</h1>
    <form action="{{route('lector.store')}}" method="post">
        @csrf
        <div class="form-group row">
            <div class="col-2">
                <label class="control-label">DNI:</label>
                <input class="form-control @error('DNILector') is-invalid @enderror" placeholder="Ingrese DNI" type="text" id="DNILector" name="DNILector" value="{{old('DNILector')}}"/>
                @error('DNILector')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="col-5">
                <label class="control-label">Nombres:</label>
                <input class="form-control @error('NombresLector') is-invalid @enderror" placeholder="Ingrese nombres" type="text" id="NombresLector" name="NombresLector" value="{{old('NombresLector')}}"/>
                @error('NombresLector')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="col-5">
                <label class="control-label">Apellidos:</label>
                <input class="form-control @error('ApellidosLector') is-invalid @enderror" placeholder="Ingrese apellidos" type="text" id="ApellidosLector" name="ApellidosLector" value="{{old('ApellidosLector')}}"/>
                @error('ApellidosLector')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-9">
                <label class="control-label">Correo:</label>
                <input class="form-control @error('CorreoLector') is-invalid @enderror" placeholder="Ingrese correo" type="email" id="CorreoLector" name="CorreoLector" value="{{old('CorreoLector')}}"/>
                @error('CorreoLector')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="col-3">
                <label class="control-label"> <i class="fa fa-calendar" aria-hidden="true"></i>Nacimiento:</label>
                <input class="form-control @error('FechaNacLector') is-invalid @enderror" placeholder="Ingrese Fecha de Nacimiento" type="date" id="FechaNacLector" name="FechaNacLector"/>
                @error('FechaNacLector')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-3">
                <label class="control-label">Celular:</label>
                <input class="form-control @error('CelularLector') is-invalid @enderror" placeholder="Ingrese celular" type="text" id="CelularLector" name="CelularLector" value="{{old('CelularLector')}}"/>
                @error('CelularLector')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="col-9">
                <label class="control-label"> Direccion:</label>
                <input class="form-control @error('DireccionLector') is-invalid @enderror" placeholder="Ingrese dirección" type="text" id="DireccionLector" name="DireccionLector" value="{{old('DireccionLector')}}"/>
                @error('DireccionLector')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Guardar</button>
        <a href="{{route('lector.cancelar')}}" class="btn btn-danger"><i class="fas fa-ban"></i>Cancelar</a>  

    </form>
</div>

@endsection