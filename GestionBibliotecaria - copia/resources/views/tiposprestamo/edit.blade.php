@extends('layout.plantilla')

@section('titulo','Editar Tipo de Prestamo')

@section('contenido')

<div class="container ">

    <h1>Editar Tipo de Prestamo</h1>
    <form action="{{route('tipoprestamo.update',$tipoprestamo->Tipo_prestamoID)}}" method="post">
        @csrf
        @method('put')
        <div class="form-group row">
            <div class="col">
                <label class="control-label">Descripción:</label>
                <input type="text" name="Tipoprestamo" class="form-control input_user @error('Tipoprestamo') is-invalid @enderror" value="{{$tipoprestamo->Tipoprestamo}}" required>
                @error('Tipoprestamo') 
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="col">
                <label class="control-label">Fecha de actualización:</label>
                <input type="text" name="fecha" class="form-control input_user @error('Tipoprestamo') is-invalid @enderror" value="{{Carbon\Carbon::now()->format('d/m/Y')}}" readonly>
            </div>
            <div class="col-12">
                <label class="control-label">Observaciones:</label>
                <Textarea class="col-12" name="observacionestipoprestamo" id="observacionestipoprestamo">{{$tipoprestamo->observacionestipoprestamo}}
                </Textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Guardar</button>
        <a href="{{route('tipoprestamo.cancelar')}}" class="btn btn-danger"><i class="fas fa-ban"></i>Cancelar</a>
    
    </form>
</div>

@endsection