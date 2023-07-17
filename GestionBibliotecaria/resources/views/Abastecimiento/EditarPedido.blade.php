@extends('layout.plantilla')

@section('titulo','EditarPedido')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="well well-sm">
                    <form class="form-horizontal" method="POST" style="margin-left:20px" action="{{route('updateP')}}">
                        @csrf
                        <fieldset>
                            <br>
                            <h4>
                                <legend style="margin-left:20px;">Registro de Pedidos</legend>
                            </h4>
                            <br>
                            <br>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-code"></i></span>
                                <div class="col-md-8">
                                    <input name="PedidoID" type="number" placeholder="Codigo Pedido" class="form-control" id="PedidoID" value="{{$pedi->PedidoID}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="far fa-calendar-alt"></i></span>
                                <div class="col-md-8">
                                    <input name="Fecha" type="date" placeholder="Fecha" class="form-control" id="Fecha" value="{{$pedi->Fecha}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-code"></i></span>
                                <div class="col-md-8">
                                    <input name="ProveedorID" type="number" placeholder="Codigo Proveedor" class="form-control" id="ProveedorID" value="{{$pedi->ProveedorID}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-code"></i></span>
                                <div class="col-md-8">
                                    <input name="BibliotecarioID" type="number" placeholder="Codigo Bibliotecario" class="form-control" id="BibliotecarioID" value="{{$pedi->BibliotecarioID}}">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 " role="group">
                                    <button type="submit" class="btn btn-outline-primary" >Actualizar</button>
                                    <a href="{{route('listadoP')}}" class="btn btn-outline-primary"><i class="">Volver</i></a>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
