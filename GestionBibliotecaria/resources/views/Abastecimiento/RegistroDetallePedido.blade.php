@extends('layout.plantilla')

@section('titulo','RegistroPedido')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="well well-sm">
                    <form class="form-horizontal" method="POST" style="margin-left:20px" action="{{route('')}}">
                        @csrf
                        <fieldset>
                            <br>
                            <h4>
                                <legend style="margin-left:20px;">Registro de Detalle Pedido</legend>
                            </h4>
                            <br>
                            <br>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-8">
                                    <input name="" type="number" placeholder="Codigo Detalle Pedido" class="form-control" id="">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope bigicon"></i></span>
                                <div class="col-md-8">
                                    <input name="" type="number" placeholder="Cantidad" class="form-control" id="">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-map-marker-alt"></i></span>
                                <div class="col-md-8">
                                    <input name="" type="number" placeholder="Codigo Pedido" class="form-control" id="">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 " role="group">
                                    <button type="submit" class="btn btn-outline-primary" >Registrar</button>
                                    <a href="{{route('')}}" class="btn btn-outline-primary"><i class="">Volver</i></a>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
