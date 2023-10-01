@extends('layout.plantilla')

@section('titulo','Editar Rol')

@section('contenido')

<div class="container ">

    <h1>Editar Rol</h1>
    <form action="{{route('rol.update',$rol->RolID)}}" method="post">
        @csrf
        @method('put')
        <div class="form-group row">
            <div class="col">
                <label class="control-label">RolID:</label>
                <input type="text" name="RolID" class="form-control input_user" value="{{$rol->RolID}}" placeholder="descripcion" required readonly>
    
            </div>
            <div class="col">
                <label class="control-label">Descripción:</label>
                <input type="text" name="Descripcionrol" class="form-control input_user" value="{{$rol->Descripcionrol}}" placeholder="descripcion" required>
    
            </div>
            <div class="col">
                <label class="control-label">Estado:</label>
                <select name="Estadorol" id="Estadorol" class="form-select input_user col-9">
                    <option value="1" @if($rol->Estadorol==1) selected @endif>HABILITADO</option>
                    <option value="0" @if($rol->Estadorol==0) selected @endif >DESHABILITADO</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Actualizar</button>
        <a href="{{route('rol.cancelar')}}" class="btn btn-danger"><i class="fas fa-ban"></i>Cancelar</a>
    
    </form>
</div>
@endsection