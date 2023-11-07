@extends('layout.plantilla')

@section('titulo','Editar Tipo de Multa')

@section('contenido')

<div class="container ">

    <h1>Editar Tipo de Multa</h1>
    <form action="{{route('tipomulta.update',$tipomulta->MultaID)}}" method="post">
        @csrf
        @method('put')
        <div class="form-group row">
            <div class="col-6">
                <label class="control-label">Descripción:</label>
                <input type="text" name="Descripcionmulta" class="form-control input_user @error('Descripcionmulta') is-invalid @enderror" value="{{$tipomulta->Descripcionmulta}}" required>
                @error('Descripcionmulta') 
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-6">
                <label class="control-label">Porcentaje:</label>
                <input type="text" name="Porcentajemulta" id="Porcentajemulta" class="form-control input_user @error('Porcentajemulta') is-invalid @enderror" value="{{$tipomulta->Porcentajemulta}}" required>
            </div>
            
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Guardar</button>
        <a href="{{route('tipomulta.cancelar')}}" class="btn btn-danger"><i class="fas fa-ban"></i>Cancelar</a>
    
    </form>
</div>

@endsection