@extends('layout.plantilla')

@section('titulo','Crear Devolucion')

@section('contenido')
<div class="container">
    <h1>Agregar Multa</h1>
    <form action="{{route('multa.store')}}" method="post">
        @csrf
        <div class="form-group row">
        <div class="col">
            <label for="">Prestamo:</label>
            <input type="text" class="form-control" name="prestamoid" id="prestamoid" readonly="readonly" value="{{$id}}">
        </div>
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                      <th scope="col">Libro prestado</th>
                      <th scope="col">Falta devolver:</th>
                    </tr>
                  </thead>
                  <tbody>
                      @if(count($detalles)<=0)
                          <tr>
                              <td colspan="2"><b>No hay registro</b></td>
                          </tr>
                      @else
                          @foreach ($detalles as $item)
                          <tr>
                            <td>{{$item->Nombrelibro}}</td>
                            <td>{{$item->NroLibrosFaltaDevo}}</td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
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
                <label for="">Tipo de Multa:</label>
                <select name="MultaID" class="form-control @error('Porcentajemulta') is-invalid @enderror" id="MultaID">
                    <option value="0" selected>- Seleccione tipo de Multa -</option>
                    @foreach($tiposmulta as $item)
                        <option value="{{$item->MultaID }}_{{ $item->Porcentajemulta}}"
                            @if ($item->MultaID==$idMulta)
                                selected
                            @endif>
                            {{ $item->Descripcionmulta}}</option>
                    @endforeach
                </select>
                @error('Porcentajemulta')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
                <input type="text" id="idMulta" name="idMulta">
            </div>
            <div class="col">
                <label for="">Porcentaje:</label>
                <input type="text" class="form-control " name="Porcentajemulta" id="Porcentajemulta" readonly="readonly">
                
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