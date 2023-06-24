@extends('layout.plantilla')

@section('titulo','Editar Lector')

@section('contenido')

<div class="container ">
    <h1>Editar Lector</h1>
    <form action="{{route('lector.update',$lector->DNILector)}}" method="post">
        @method('put')
        @csrf
        <div class="form-group row">
            <div class="col-2">
                <label class="control-label">DNI:</label>
                <input class="form-control @error('DNILector') is-invalid @enderror" placeholder="Ingrese DNI" type="text" id="DNILector" name="DNILector" value="{{$lector->DNILector}} " disabled/>
                @error('DNILector')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="col-5">
                <label class="control-label">Nombres:</label>
                <input class="form-control @error('NombresLector') is-invalid @enderror" placeholder="Ingrese nombres" type="text" id="NombresLector" name="NombresLector" value="{{$lector->NombresLector}}"/>
                @error('NombresLector')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="col-5">
                <label class="control-label">Apellidos:</label>
                <input class="form-control @error('ApellidosLector') is-invalid @enderror" placeholder="Ingrese apellidos" type="text" id="ApellidosLector" name="ApellidosLector" value="{{$lector->ApellidosLector}}"/>
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
                <input class="form-control @error('CorreoLector') is-invalid @enderror" placeholder="Ingrese correo" type="email" id="CorreoLector" name="CorreoLector" value="{{$lector->CorreoLector}}"/>
                @error('CorreoLector')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="col-3">
                <label class="control-label"> <i class="fa fa-calendar" aria-hidden="true"></i>Nacimiento:</label>
                <input class="form-control @error('FechaNacLector') is-invalid @enderror" placeholder="Ingrese Fecha de Nacimiento" type="date" id="FechaNacLector" name="FechaNacLector" value="{{$lector->FechaNacLector}}"/>
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
                <input class="form-control @error('CelularLector') is-invalid @enderror" placeholder="Ingrese celular" type="text" id="CelularLector" name="CelularLector" value="{{$lector->CelularLector}}"/>
                @error('CelularLector')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="col-9">
                <label class="control-label"> Direccion:</label>
                <input class="form-control @error('DireccionLector') is-invalid @enderror" placeholder="Ingrese dirección" type="text" id="DireccionLector" name="DireccionLector" value="{{$lector->DireccionLector}}"/>
                @error('DireccionLector')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-5">
                <label class="control-label">Estado Habilitación:</label>
                <select name="EstadoHabLector" id="EstadoHabLector" class="form-select">
                    <option value="1" @if ($lector->EstadoHabLector == 1)
                        selected @endif>HABILITADO</option>
                    <option value="0" @if ($lector->EstadoHabLector == 0)
                        selected @endif>DESHABILITADO</option>
                </select>
            </div>
            
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Actualizar</button>
        <a href="{{route('lector.cancelar')}}" class="btn btn-danger"><i class="fas fa-ban"></i>Cancelar</a>  

    
    </form>

</div>

@endsection