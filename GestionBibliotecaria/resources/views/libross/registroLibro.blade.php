@extends('layout.plantilla')

@section('titulo','RegistroLibro')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="well well-sm">
                    <form class="form-horizontal" method="POST" style="margin-left:20px" action="{{route('libroo.store')}}">
                        @csrf
                        <fieldset>
                            <br>
                            <h4>
                                <legend style="margin-left:20px;">Registro de Libro</legend>
                            </h4>
                            <br>
                            <br>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-code"></i></span>
                                <div class="col-md-8">
                                    <input name="LibroID" type="number" placeholder="Codigo Libro" class="form-control" id="LibroID">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-chart-bar"></i></span>
                                <div class="col-md-8">
                                    <input name="Titulo" type="text" placeholder="Titulo" class="form-control" id="Titulo">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-code"></i></span>
                                <div class="col-md-8">
                                    <input name="Edicionlibro" type="number" placeholder="Edicion Libro" class="form-control" id="Edicionlibro">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-code"></i></span>
                                <div class="col-md-8">
                                    <input name="Precio" type="number" placeholder="Precio" class="form-control" id="Precio">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-code"></i></span>
                                <div class="col-md-8">
                                    <input name="Paginas" type="number" placeholder="Paginas" class="form-control" id="Paginas">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-code"></i></span>
                                <div class="col-md-8">
                                    <input name="Isbn" type="number" placeholder="ISBN" class="form-control" id="Isbn">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-code"></i></span>
                                <div class="col-md-8">
                                    <input name="Añopublicacion" type="number" placeholder="Año de publicación" class="form-control" id="Añopublicacion">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-chart-bar"></i></span>
                                <div class="col-md-8">
                                    <input name="Editorial" type="text" placeholder="Editorial" class="form-control" id="Editorial">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-chart-bar"></i></span>
                                <div class="col-md-8">
                                    <input name="Idioma" type="text" placeholder="Idioma" class="form-control" id="Idioma">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-code"></i></span>
                                <div class="col-md-8">
                                    <input name="Stocklibro" type="number" placeholder="Stock" class="form-control" id="Stocklibro">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 " role="group">
                                    <button type="submit" class="btn btn-outline-primary" >Registrar</button>
                                    <a href="{{route('libroo.index')}}" class="btn btn-outline-primary"><i class="">Volver</i></a>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
