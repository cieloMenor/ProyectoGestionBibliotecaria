@extends('layout.plantilla')

@section('titulo','Crear Devolucion')

@section('contenido')
<div class="container">
    <h1>Agregar Multa</h1>
    <form action="" method="post">
        @csrf
        <div class="form-group row">
        <div class="col">
            <label for="">Devolucion:</label>
            <input type="text" class="form-control" name="Nrocopiasprestamo" id="Nrocopiasprestamo" readonly="readonly" value="{{$id}}">
        </div>
        <div class="col">
            <label for="">Servicio:</label>
            <select name="ServicioID" class="form-control" id="ServicioID">
                <option value="1">
                        MULTAS</option>
            </select>
        </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <label for="">Multa:</label>
                <select name="MultaID" class="form-control" id="MultaID">
                    <option value="0" selected>- Seleccione tipo de Multa -</option>
                    @foreach($tiposmulta as $item)
                        <option value="{{$item->MultaID }}_{{ $item->Porcentajemulta}}"
                            @if ($item->MultaID==$idMulta)
                                selected
                            @endif>
                            {{ $item->Descripcionmulta}}</option>
                    @endforeach
                </select>
                <input type="text" id="idMulta" name="idMulta">
            </div>
            <div class="col">
                <label for="">Porcentaje:</label>
                <input type="text" class="form-control" name="Porcentajemulta" id="Porcentajemulta" readonly="readonly">
            </div>
            <div class="col">
                <label for="">Nro de libros:</label>
                <input type="text" class="form-control" name="librosprestamo" id="librosprestamo" readonly="readonly" value="{{$librosprestamo}}">
            </div>
            
        </div>
        <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i></i>Guardar</button>
    </form>


</div>


@endsection

@section('script')
<script src="/js/multaAgregar.js"></script>

@endsection