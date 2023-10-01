@extends('layout.plantilla')

@section('titulo','Nuevo Rol')

@section('contenido')

<div class="container ">

    <h1>Nuevo Usuario</h1>
    <form action="{{route('rol.store')}}" method="post">
        @csrf

        <div class="form-group row">
            <div class="col">
                <label class="control-label">Descripción:</label>
                <input type="text" name="Descripcionrol" class="form-control input_user" value="{{old('Descripcionrol')}}" placeholder="descripcion" required>
    
            </div>
            <div class="col">
                <label class="control-label">Estado:</label>
                <select name="Estadorol" id="Estadorol" class="form-select input_user col-9">
                    <option value="1" >HABILITADO</option>
                    <option value="0" >DESHABILITADO</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Guardar</button>
        <a href="{{route('rol.cancelar')}}" class="btn btn-danger"><i class="fas fa-ban"></i>Cancelar</a>
    
    </form>
</div>
@endsection