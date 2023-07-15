@extends('layout.plantilla')

@section('titulo','RegistrarBibliotecario')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="well well-sm">
                    <form class="form-horizontal" method="POST" style="margin-left:20px" action="{{route('storeBb')}}" >
                        @csrf
                        <fieldset>
                            <br>
                            <h4>
                                <legend style="margin-left:20px;">Registro Bibliotecario</legend>
                            </h4>
                            <br>
                            <br>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-8">
                                    <input name="BibliotecarioID" type="number" placeholder="Codigo Bibliotecario" class="form-control" id="BibliotecarioID">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope bigicon"></i></span>
                                <div class="col-md-8">
                                    <input name="Nombre" type="text" placeholder="Nombres " class="form-control" id="Nombre">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-map-marker-alt"></i></span>
                                <div class="col-md-8">
                                    <input name="Dni" type="text" placeholder="DNI" class="form-control" id="Dni">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-map-marker-alt"></i></span>
                                <div class="col-md-8">
                                    <input name="Correoelectronico" type="text" placeholder="E-mail" class="form-control" id="Correoelectronico">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-map-marker-alt"></i></span>
                                <div class="col-md-8">
                                    <input name="Telefono" type="tel" placeholder="Telefono" class="form-control" id="Telefono">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-map-marker-alt"></i></span>
                                <div class="col-md-8">
                                    <input name="Direccion" type="text" placeholder="Direccion" class="form-control" id="Direccion">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 " role="group">
                                    <button type="submit" class="btn btn-outline-primary" >Registrar</button>
                                    <a href="{{route('listadoB')}}" class="btn btn-outline-primary"><i class="">Volver</i></a>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
