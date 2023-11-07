@extends('layout.plantilla')

@section('titulo','Añadir Devolucion')

@section('contenido')
<div class="container">
    <h1>DEVOLUCION</h1>
    {{-- Mensaje de alerta --}}
    <div id="mensaje">
        @if (session('datos'))
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                {{session('datos')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">$times;</span>
                </button>
            </div>
        @endif
    </div>
    <form action="{{route('devolucion.agregar',$devolucion->DevolucionID)}}" method="post">
        @csrf
        <div class="  form-group row">

            <div class="col-2">
                <label class="control-label" for="">DevolucionID:</label>
                <input type="text" class="form-control" id="DevolucionID" name="DevolucionID" value="{{$devolucion->DevolucionID}}" readonly>
            </div>

            <div class="col">
                <label class="control-label" for="">Lector:</label>
                <input type="text" class="form-control" id="lector" name="lector" value="{{$devolucion->prestamos->lectores->Apellidoslector}}, {{$devolucion->prestamos->lectores->Nombreslector}}" readonly>
            </div>
            <div class="col-5">
                <label for="" class="control-label">Detalles: </label>
                <select class="form-control select2 select2-hidden-accessible selectpicker" style="width: 100%;"
                data-select2-id="1" tabindex="-1" aria-hidden="true" id="LibroID" name="LibroID"
                data-live-search="true">
                    <option value="0" selected>- Seleccione libro -</option>
                    @foreach($detalles as $item)
                        <option value="{{ $item->LibroID }}_{{ $item->Nombrelibro }}_{{ $item->libros->Idioma}}_{{ $item->Nrocopiasprestamo}}_{{ $item->NroLibrosFaltaDevo}}">{{ $item->Nombrelibro }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-1">
                <label for="">Codigo:</label>
                <input type="text" class="form-control" name="idLibro" id="idLibro" readonly="readonly">
            </div>
        </div>
        <div class="  form-group row">
           
            <div class="col-md-1">
                <label for="">Prestados:</label>
                <input type="text" class="form-control" name="Nrocopiasprestamo" id="Nrocopiasprestamo" readonly="readonly">
            </div>
            <div class="col-md-1">
                <label for="">Faltan:</label>
                <input type="text" class="form-control" name="NroLibrosFaltaDevo" id="NroLibrosFaltaDevo" readonly="readonly"  >
            </div>
            <div class="col-md-3">
                <label for="">Idioma :</label>
                <input type="text" class="form-control" name="Idioma" id="Idioma" readonly="readonly">
            </div>
            <div class="col-md-1">
                <label for="">Cantidad:</label>
                <input type="text" class="form-control" name="Nrocopiasdevolucion" id="Nrocopiasdevolucion" required value="{{old('Nrocopiasdevolucion')}}" >
            </div>
            <div class="col-3">
                @php
                     date_default_timezone_set('America/Lima');		
                    $fecha_actual = date("Y-m-d H:i:s"); 
                @endphp
               
                <label class="control-label" for="">  <i class="fa fa-calendar" aria-hidden="true"></i> Fecha:</label>
                <input type="text" class="form-control" id="fecha_detalle" name="fecha_detalle" value="{{$fecha_actual}}" required>
                
            </div>
            
            <div class="col-md-2">
                <button type="submit" id="btnadddet" class="btn btn-primary"><i class="fas fa-shopping-cart"></i>
                Agregar</button>
                <a href="{{route('devolucion.cancelar')}}" class='btn btn-danger'><i class='fas fa-ban'></i> Cancelar</a> 

            </div>
           
        </div>
    </form>

</div>

@endsection

@section('script')

<link rel="stylesheet" href="/select2/bootstrap-select.min.css">
    <script src="/select2/bootstrap-select.min.js"></script>
    <script src="/adminlte/plugins/moment/moment.min.js"></script>
    <script src="/adminlte/plugins/inputmask/jquery.inputmask.min.js"></script>
    <script src="/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    
    <script src="/js/devolucionAgregar.js"></script>

<script>
    //para cerrar el mensaje
    setTimeout(function () {
        //selecciono el id mensaje y lo remuevo en 2000 segundos
        document.querySelector('#mensaje').remove();
        
    }, 2000);
</script>
@endsection