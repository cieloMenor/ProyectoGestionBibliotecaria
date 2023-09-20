@extends('layout.plantilla')

@section('titulo','EditarBibliotecario')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="well well-sm">
                    <form class="form-horizontal" method="POST" style="margin-left:20px" action="{{route('updateB')}}" >
                        @csrf
                        <fieldset>
                            <br>
                            <h4>
                                <legend style="margin-left:20px;">Registro Bibliotecario</legend>
                            </h4>
                            <br>
                            <br>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-code"></i></span>
                                <div class="col-md-8">
                                    <input name="BibliotecarioID" type="number" placeholder="Codigo Bibliotecario" class="form-control" id="BibliotecarioID" value="{{$biblo->BibliotecarioID}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user"></i></span>
                                <div class="col-md-8">
                                    <input name="Nombre" type="text" placeholder="Nombres " class="form-control" id="Nombre" value="{{$biblo->Nombre}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-id-card"></i></span>
                                <div class="col-md-8">
                                    <input name="Dni" type="text" placeholder="DNI" class="form-control" id="Dni" value="{{$biblo->Dni}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="far fa-envelope"></i></span>
                                <div class="col-md-8">
                                    <input name="Correoelectronico" type="text" placeholder="E-mail" class="form-control" id="Correoelectronico" value="{{$biblo->Correoelectronico}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-phone"></i></span>
                                <div class="col-md-8">
                                    <input name="Telefono" type="tel" placeholder="Telefono" class="form-control" id="Telefono" value="{{$biblo->Telefono}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-map-marker-alt"></i></span>
                                <div class="col-md-8">
                                    <input name="Direccion" type="text" placeholder="Direccion" class="form-control" id="Direccion" value="{{$biblo->Direccion}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 " role="group">
                                    <button type="submit" class="btn btn-outline-primary" >Actualizar</button>
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
