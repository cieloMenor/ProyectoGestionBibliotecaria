@extends('layout.plantilla')

@section('titulo','Editar Lector')

@section('contenido')

<div class="container ">
    <h1>Editar Lector</h1>
    <form action="{{route('lector.update',$lector->LectorID)}}" method="post">
        @method('put')
        @csrf
        <div class="form-group row">
            <div class="col-2">
                <label class="control-label">DNI:</label>
                <input class="form-control @error('Dni_lector') is-invalid @enderror" placeholder="Ingrese DNI" type="text" id="Dni_lector" name="Dni_lector" value="{{$lector->Dni_lector}} "/>
                @error('Dni_lector')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="col-5">
                <label class="control-label">Nombres:</label>
                <input class="form-control @error('Nombreslector') is-invalid @enderror" placeholder="Ingrese nombres" type="text" id="Nombreslector" name="Nombreslector" value="{{$lector->Nombreslector}}"/>
                @error('Nombreslector')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="col-5">
                <label class="control-label">Apellidos:</label>
                <input class="form-control @error('Apellidoslector') is-invalid @enderror" placeholder="Ingrese apellidos" type="text" id="Apellidoslector" name="Apellidoslector" value="{{$lector->Apellidoslector}}"/>
                @error('Apellidoslector')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-9">
                <label class="control-label">Correo:</label>
                <input class="form-control @error('Correolector') is-invalid @enderror" placeholder="Ingrese correo" type="email" id="Correolector" name="Correolector" value="{{$lector->Correolector}}"/>
                @error('Correolector')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="col-3">
                <label class="control-label"> <i class="fa fa-calendar" aria-hidden="true"></i>Nacimiento:</label>
                <input class="form-control @error('Fechanaclector') is-invalid @enderror" placeholder="Ingrese Fecha de Nacimiento" type="date" id="Fechanaclector" name="Fechanaclector" value="{{$lector->Fechanaclector}}"/>
                @error('Fechanaclector')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-3">
                <label class="control-label">Celular:</label>
                <input class="form-control @error('Celularlector') is-invalid @enderror" placeholder="Ingrese celular" type="text" id="Celularlector" name="Celularlector" value="{{$lector->Celularlector}}"/>
                @error('Celularlector')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="col-9">
                <label class="control-label"> Direccion:</label>
                <input class="form-control @error('Direccionlector') is-invalid @enderror" placeholder="Ingrese dirección" type="text" id="Direccionlector" name="Direccionlector" value="{{$lector->Direccionlector}}"/>
                @error('Direccionlector')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-5">
                <label class="control-label">Estado Habilitación:</label>
                <select name="Estadohablector" id="Estadohablector" class="form-select">
                    <option value="1" @if ($lector->Estadohablector == 1)
                        selected @endif>HABILITADO</option>
                    <option value="0" @if ($lector->Estadohablector == 0)
                        selected @endif>DESHABILITADO</option>
                </select>
            </div>
            
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Actualizar</button>
        <a href="{{route('lector.cancelar')}}" class="btn btn-danger"><i class="fas fa-ban"></i>Cancelar</a>  

    
    </form>

</div>

@endsection