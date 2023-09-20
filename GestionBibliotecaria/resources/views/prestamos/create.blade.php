@extends('layout.plantilla')

@section('titulo','Préstamos')

@section('contenido')
<div class="container">
    <h1>NUEVO PRESTAMO</h1>
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
    <form action="{{route('prestamo.store')}}" method="post">
        @csrf
        <div class="form-group row">
            <div class="col-2">
                <label class="control-label">Fecha:</label>
                <input class="form-control @error('Fecharegistroprestamo') is-invalid @enderror" placeholder="Ingrese DNI"  id="Fecharegistroprestamo" name="Fecharegistroprestamo" value="{{Carbon\Carbon::now()->format('d/m/Y')}}"/>
                @error('Fecharegistroprestamo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
            
            <div class="col-3">
                <label class="control-label">Lector:</label>
                <div class="row">
                    <div class="col-10">
                        <select class=" form-control select2 select2-hiddenaccessible selectpicker" style="width: 100%;" data-select2-id="1" tabindex="-1" ariahidden="true" id="LectorID" name="LectorID" data-live-search="true">
                            <option value="0" selected>- Seleccione Lector -</option>
                            @foreach($lectores as $itemlector)
                                <option value="{{ $itemlector->LectorID }}_{{ $itemlector->Dni_lector }}_{{ $itemlector->Correolector }}_{{ $itemlector->Estadolector }}" >{{ $itemlector->Apellidoslector }},{{ $itemlector->Nombreslector }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-1">
                        <a href="{{route('prestamo.crearlector')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <label class="control-label">DNI:</label>
                <input class="form-control " type="text" id="Dni_lector" name="Dni_lector" readonly="readonly"/>
            </div>
            <div class="col-3">
                <label class="control-label">Correo:</label>
                <input class="form-control " type="text" id="Correolector" name="Correolector" readonly="readonly"/>
            </div>
            <div class="col-2">
                <label class="control-label">Estado:</label>
                <input class="form-control " type="text" id="Estadolector" name="Estadolector" readonly="readonly"/>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-2">
                <label class="control-label">Tipo:</label>
                <select name="Tipo_prestamoID" id="Tipo_prestamoID" class="form-select input_user">
                    <option value="0" selected>- Seleccione -</option>
                    @foreach ($tipos as $item)
                    <option value="{{$item->Tipo_prestamoID}}">{{$item->Tipoprestamo}}</option>
                    @endforeach
                    
                </select>
            </div>
            <div class="col-2">
                <label class="control-label"><i class="fa fa-calendar" aria-hidden="true"></i>Devolucion:</label>
                <input class="form-control @error('Fechadevolucionesperadap') is-invalid @enderror" type="date" id="Fechadevolucionesperadap" name="Fechadevolucionesperadap" value="{{old('Fechadevolucionesperadap')}}"/>
                @error('Fechadevolucionesperadap')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="col-2">
                <label class="control-label">Hora:</label>
                <input class="form-control @error('Horadevolucionesperadap') is-invalid @enderror" type="time" id="Horadevolucionesperadap" name="Horadevolucionesperadap" value="{{old('Horadevolucionesperadap')}}"/>
                @error('Horadevolucionesperadap')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="col-6">
                <label class="control-label">Observaciones:</label>

                <input class="form-control @error('Observacionesprestamo') is-invalid @enderror" placeholder="Ingrese Observaciones" type="text" id="Observacionesprestamo" name="Observacionesprestamo" value="{{old('Observacionesprestamo')}}"/>
            </div>
        </div>

        <div class="row pt-3">
            
            <div class="col-md-4">
                <label for="">Libro: </label>
                <select class="form-control select2 select2-hidden-accessible selectpicker" style="width: 100%;"
                data-select2-id="1" tabindex="-1" aria-hidden="true" id="LibroID" name="LibroID"
                data-live-search="true">
                    <option value="0" selected>- Seleccione Libro -</option>
                    @foreach($libros as $itemproducto)
                        <option value="{{ $itemproducto->LibroID }}_{{ $itemproducto->Stocklibro }}_{{ $itemproducto->Idioma}}_{{ $itemproducto->Titulo}}">{{ $itemproducto->Titulo }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                <label for="">Stock :</label>
                <input type="text" class="form-control" name="Stocklibro" id="Stocklibro" readonly="readonly">
            </div>
            <div class="col-md-3">
                <label for="">Idioma :</label>
                <input type="text" class="form-control" name="Idioma" id="Idioma" readonly="readonly">
            </div>
            <div class="col-md-1">
                <label for="">Cantidad:</label>
                <input type="text" class="form-control" name="Nrocopiasprestamo" id="Nrocopiasprestamo" value="{{old('Nrocopiasprestamo')}}" >
            </div>
            <div class="col-md-2">
                <button type="button" id="btnadddet" class="btn btn-success"><i class="fas fa-shopping-cart"></i>
                Agregar</button>
                
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
        <div class="col-md-12 pt-3">
            <div class="table-responsive">
                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover" style='background-color:#FFFFFF;'>
                    <thead class="thead-default" style="background-color:#3c8dbc;color: #fff;">
                        <th width="10" class="text-center">OPCIONES</th>
                        <th class="text-center">CODIGO</th>
                        <th>DESCRIPCIÓN</th>
                        <th>STOCK</th>
                        <th class="text-center">CANTIDAD</th>
                    </thead>
                    <tfoot>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
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

        <br>
        <div class="col-md-12 text-center"> 
            <div id="guardar">
                <div class="form-group">
                    <button class="btn btn-primary" id="btnRegistrar" data-loading-text="<i class='fa a-spinner fa-spin'> </i> Registrando">
                    <i class='fas fa-save'></i> Registrar</button> 
                    
                    <a href="{{route('prestamo.cancelar')}}" class='btn btn-danger'><i class='fas fa-ban'></i> Cancelar</a> 
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
    
    <script src="/js/createdoc.js"></script>
    <script type="text/javascript"> 
        $('#fecha').datetimepicker({
        format: 'DD/MM/YYYY',
        }); 
    </script>
    <script>
        //para cerrar el mensaje
        setTimeout(function () {
            //selecciono el id mensaje y lo remuevo en 2000 segundos
            document.querySelector('#mensaje2').remove();
            
        }, 2000);
    </script>
@endsection