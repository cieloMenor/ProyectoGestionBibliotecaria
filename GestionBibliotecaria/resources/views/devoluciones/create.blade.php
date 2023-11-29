@extends('layout.plantilla')

@section('titulo','Crear Devolucion')

@section('contenido')
<div class="container">
    <h1>NUEVA DEVOLUCION</h1>
    {{-- Mensaje de alerta --}}
    <div id="mensaje2">
        @if (session('datos2'))
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                {{session('datos2')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">$times;</span>
                </button>
            </div>
        @endif
    </div>

    <form class="" method="GET">
        <div class=" form-group row">
            <div class="form-inline col-4">
                <nav class=" navbar float-right row">
                
                    {{-- <form class="form-inline my-2" method="GET"> --}}
                        <label for="" class="control-label col">Prestamo:</label>
                        <select class=" col form-control me-2" type="search" id="PrestamoID"  name="PrestamoID"  aria-label="Search">
                            <option value="0" selected>- Seleccione IdPrestamo -</option>
                            @foreach($prestamos as $item)
                                <option value="{{ $item->PrestamoID }}_{{ $item->Fechadevolucionesperadap }} {{ $item->Horadevolucionesperadap }}_{{ $item->tipo->Tipoprestamo }}_{{ $item->estadoprestamos->Estadoprestamo }}_{{ $item->lectores->Apellidoslector}}, {{$item->lectores->Nombreslector}}_{{$item->Fechaentregaprestamo}}"
                                    @if ($item->PrestamoID==$idPrestamo)
                                        selected
                                    @endif>
                                    {{ $item->PrestamoID}} - {{ $item->lectores->Dni_lector}} - {{ $item->lectores->Apellidoslector}}</option>
                            @endforeach
                        </select>
                        <button  id="btnbuscar" name="btnbuscar" class="btn btn-success col" type="submit">Buscar</button>
                    {{-- </form> --}}
                </nav>
            </div>
            <div class="col-3">
                <label class="control-label" for=""><i class="fa fa-calendar" aria-hidden="true"></i> Devolucion Esperada:</label>
                <input type="text" class="form-control" id="fechadevolucion" name="fechadevolucion" value="{{$fechadevolucion}}" readonly>
            </div>
            <div class="col-2">
                <label class="control-label" for=""> Tipo:</label>
                <input type="text" class="form-control" id="tipo" name="tipo" value="{{$tipo}}" readonly>
            </div>
            <div class="col">
                <label class="control-label" for=""> Estado:</label>
                <input type="text" class="form-control" id="estado" name="estado" value="{{$estado}}" readonly>
            </div>
            
            
        </div>
        <div class="  form-group row">
            <div class="col">
                <label class="control-label" for="">Lector:</label>
                <input type="text" class="form-control" id="lector" name="lector" value="{{$lector}}" readonly>
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
                <input type="text" class="form-control" name="Nrocopiasdevolucion" id="Nrocopiasdevolucion" value="{{old('Nrocopiasdevolucion')}}" >
            </div>
            <div class="col-3">
                @php
                     date_default_timezone_set('America/Lima');		
                    $fecha_actual = date("Y-m-d H:i:s"); 
                @endphp
               
                <label class="control-label" for="">  <i class="fa fa-calendar" aria-hidden="true"></i> Fecha:</label>
                <input type="text" class="form-control" id="fecha_detalle" name="fecha_detalle" value="{{$fecha_actual}}">
                
            </div>
            <div class="col-md-2">
                <button type="button" id="btnadddet" class="btn btn-primary"><i class="fas fa-shopping-cart"></i>
                Agregar</button>
                
            </div>
            <div class="col-1">
                <input type="text" class="form-control" id="id_prestamo" name="id_prestamo" value="{{$idPrestamo}}" readonly hidden>            
            </div>
        </div>
    </form>
    <form action="{{route('devolucion.store')}}" method="post">
        @csrf
        <div class="form-group row">
            <div class="col-3">
                
                <label class="control-label" for=""><i class="fa fa-calendar" aria-hidden="true"></i> Devolucion Inicio:</label>
                <input type="text" class="form-control" id="Fechainiciodevolucion" name="Fechainiciodevolucion" value="{{$fecha_actual}}">
                        
            </div>
            
            <div class="col">
                <label class="control-label" for="">Observaciones:</label>
                <input type="text" class="form-control" id="Dev_observaciones" name="Dev_observaciones" value="">
                
            </div>
            
        </div>
        {{-- Mensaje de alerta --}}
        <div id="mensaje">
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">$times;</span>
                </button>
            </div>
        </div>
        <div class="col-md-12 pt-5">
            <div class="table-responsive">
                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover" style='background-color:#FFFFFF;'>
                    <thead class="thead-default" style="background-color:#1a08e1;color: #fff;">
                        <th  class="text-center">OPCIONES</th>
                        <th class="text-center">CODIGO</th>
                        <th class="col-4">DESCRIPCIÓN</th>
                        <th class="col-3">FALTAN DEVOLVER:</th>
                        <th class="text-center col-3">FECHA:</th>
                        <th class="text-center col-2"> DEVOLVER:</th>
                    </thead>
                    <tfoot>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-1">
            <input type="text" class="form-control" id="cod_prestamo" name="cod_prestamo" value="{{$idPrestamo}}" readonly hidden>            
            <input type="text" class="form-control" id="fechadevolucion" name="fechadevolucion" value="{{$fechadevolucion}}" readonly hidden>

        </div>
        <div class="row">
            <div class="col-md-8">
            </div>
            <div class="col-md-2">
                <label for="">Total : </label>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control text-right" name="total" id="total" readonly="readonly">
            
            </div>
        </div>
        <div class="col-md-12 text-center"> 
            <div id="guardar">
                <div class="form-group">
                    <button class="btn btn-primary" id="btnRegistrar" data-loading-text="<i class='fa a-spinner fa-spin'> </i> Registrando">
                    <i class='fas fa-save'></i> Registrar</button> 
                    
                    <a href="{{route('devolucion.cancelar')}}" class='btn btn-danger'><i class='fas fa-ban'></i> Cancelar</a> 
                </div> 
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
    
    <script src="/js/devolucion.js"></script>

<script>
    //para cerrar el mensaje
    setTimeout(function () {
        //selecciono el id mensaje y lo remuevo en 2000 segundos
        document.querySelector('#mensaje2').remove();
        
    }, 2000);
</script>
@endsection