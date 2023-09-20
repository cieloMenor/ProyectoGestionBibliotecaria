@extends('layout.plantilla')

@section('titulo','Entrega')

@section('contenido')

<div class="container ">

    <h1>Nueva Entrega</h1>

    
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
    <form class="" method="GET">
    <div class=" form-group row">
        <div class="form-inline my-2 col-4">
            <nav class=" navbar float-right">
            
                {{-- <form class="form-inline my-2" method="GET"> --}}
                    <input name="buscarpor" class="form-control me-2" type="search" placeholder="Busqueda por apellido" aria-label="Search" value="{{$buscarpor}}">
                    <button id="btnbuscar" class="btn btn-success" type="submit">Buscar</button>
                {{-- </form> --}}
            </nav>
        </div>
        
        <div class="col-5">
            <label for="" class="control-label">Prestamo:</label>
            <select class=" form-control select2 select2-hiddenaccessible selectpicker" style="width: 100%;" data-select2-id="1" tabindex="-1" ariahidden="true" id="PrestamoID" name="PrestamoID" data-live-search="true">
                <option value="0" selected>- Seleccione IdPrestamo -</option>
                @foreach($prestamos as $item)
                    <option value="{{ $item->PrestamoID }}_{{ $item->Fecharegistroprestamo }}_{{ $item->estadoprestamos->Estadoprestamo }}_{{ $item->lectores->Apellidoslector}}, {{$item->lectores->Nombreslector}}_{{$item->Fechaentregaprestamo}}"
                        @if ($idPrestamo == $item->PrestamoID) selected
                        @endif>
                        {{ $item->PrestamoID}} - {{ $item->lectores->Dni_lector}} - {{ $item->lectores->Apellidoslector}}</option>
                @endforeach
            </select>
        </div>
        
        <div class="col-3">
            <label class="control-label" for="">Fecha:</label>
            <input type="text" class="form-control" id="fecha" name="fecha" value="{{$fecha}}" readonly>
        </div>
        
        <div class="col">
            <input type="text" class="form-control" id="id_prestamo" name="id_prestamo" value="{{$idPrestamo}}" readonly hidden>
        
        </div>
    </div>
    
    <div class="row form-group">
        <div class="col-4">
            <label class="control-label" for="">Estado Prestamo:</label>
            <input type="text" class="form-control" id="estado" name="estado" value="{{$estado}}" readonly>
        </div>
        <div class="col-5">
            <label class="control-label" for="">Lector:</label>
            <input type="text" class="form-control" id="lector" name="lector" value="{{$lector}}" readonly>
        </div>
        <div class="col">
            <label class="control-label" for="">Fecha entrega:</label>
            <input type="text" class="form-control" id="fechaentrega" name="fechaentrega" value="{{$fechaentrega}}" readonly>
        </div>
    </div>
    </form>
    <div class="col-md-12 pt-3">
        <div class="table-responsive">
            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover" style='background-color:#FFFFFF;'>
                <thead class="thead-default" style="background-color:#6b902b;color: #fff;">
                    <th scope="col">N°</th>
                    <th scope="col">CodigoLibro</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Stock anterior</th>
                    <th scope="col">Estado</th>
                </thead>
                <tfoot>
                </tfoot>
                <tbody>
                    @if(count($detalles)<=0)
                        <tr>
                            <td colspan="8"><b>No hay registro</b></td>
                        </tr>
                    @else
                        @foreach($detalles as $item)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$item->LibroID}}</td>
                            <td>{{$item->Nombrelibro}}</td>
                            <td>{{$item->Nrocopiasprestamo}}</td>
                            <td>{{$item->StockLibroP}}</td>
                            <td><a href="" class="btn btn-primary">{{$item->estadodetalleprestamos->Estadodetalleprestamo}}</a></td>
                            
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        
    </div>
    
    <center>
        @if ($estado =="REGISTRADO" )
            @if($idPrestamo!="" || $idPrestamo!=0 )
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2{{$idPrestamo}}">
                    Procesar
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal2{{$idPrestamo}}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                <div class="modal-dialog modalperrito" >
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Procesar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('entrega.update',$idPrestamo)}}" method="post">
                            @method('put')
                            @csrf
                            <div class="form-group row">
                                <div class="col">
                                    <label for="" class="form-label">Fecha entrega:</label>
                                <input type="date" class="form-control" name="Fechaentregaprestamo" value="" required>
                                
                                </div>
                                <div class="col">
                                    <label for="">Hora entrega:</label>
                                    <input type="time" class="form-control" name="Horaentregaprestamo" value="" required>
                                    
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger"><i class="fas fa-check-square"></i>Entregar</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i>Cancelar</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        
                    </div>
                    </div>
                </div>
                </div>

                <a href="{{route('entrega.edit',$idPrestamo)}}" class="btn btn-danger">Anular</a>
            @endif
        @endif

    </center>
</div>

@endsection
@section('script')

<link rel="stylesheet" href="/select2/bootstrap-select.min.css">
    <script src="/select2/bootstrap-select.min.js"></script>
    <script src="/adminlte/plugins/moment/moment.min.js"></script>
    <script src="/adminlte/plugins/inputmask/jquery.inputmask.min.js"></script>
    <script src="/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    
    <script src="/js/createdoc2.js"></script>

<script>
    //para cerrar el mensaje
    setTimeout(function () {
        //selecciono el id mensaje y lo remuevo en 2000 segundos
        document.querySelector('#mensaje').remove();
        
    }, 2000);
</script>
@endsection