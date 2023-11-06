@extends('layout.plantilla')

@section('titulo','EditarLibro')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="well well-sm">
                    <form class="form-horizontal" method="POST" style="margin-left:20px" action="{{route('updateL')}}" >
                        @csrf
                        <fieldset>
                            <br>
                            <h4>
                                <legend style="margin-left:20px;">Registro Libro</legend>
                            </h4>
                            <br>
                            <br>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-code"></i></span>
                                <div class="col-md-8">
                                    <input name="LibroID" type="number" placeholder="Codigo Libro" class="form-control" id="LibroID" value="{{$Li->LibroID}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user"></i></span>
                                <div class="col-md-8">
                                    <input name="Titulo" type="text" placeholder="Titulo " class="form-control" id="Titulo" value="{{$Li->Titulo}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-id-card"></i></span>
                                <div class="col-md-8">
                                    <input name="Stock" type="number" placeholder="Stock" class="form-control" id="Stock" value="{{$Li->Stock}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="far fa-envelope"></i></span>
                                <div class="col-md-8">
                                    <input name="Precio" type="number" step="0.01" placeholder="Precio" class="form-control" id="Precio" value="{{$Li->Precio}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-phone"></i></span>
                                <div class="col-md-8">
                                    <input name="Paginas" type="number" placeholder="Paginas" class="form-control" id="Paginas" value="{{$Li->Paginas}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-map-marker-alt"></i></span>
                                <div class="col-md-8">
                                    <input name="Isbn" type="text" placeholder="ISBN" class="form-control" id="Isbn" value="{{$Li->Isbn}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-map-marker-alt"></i></span>
                                <div class="col-md-8">
                                    <input name="Idioma" type="text" placeholder="Idioma" class="form-control" id="Idioma" value="{{$Li->Idioma}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-map-marker-alt"></i></span>
                                <div class="col-md-8">
                                    <input name="Editorial" type="text" placeholder="Editorial" class="form-control" id="Editorial" value="{{$Li->Editorial}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-map-marker-alt"></i></span>
                                <div class="col-md-8">
                                    <input name="Añopublicacion" type="number" placeholder="Año Publicación" class="form-control" id="Añopublicacion" value="{{$Li->Añopublicacion}}">
                                </div>
                            </div>
                            
                               
                               <!--  <div class="col-md-8">
                                    <input name="Estado_libroID" type="number" placeholder="Estado Libro" class="form-control" id="Estado_libroID">

                                </div> -->
                           
                            <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-map-marker-alt"></i></span>
                            <div class="col-md-8">
                            <select name="Estado_libroID" class="form-control">
                                @foreach($estadosLibros as $estadoLibro)
                                    <option value="{{ $estadoLibro->Estado_libroID }}">{{ $estadoLibro->Estadolibro }}</option>
                                @endforeach
                            </select>
                            </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 " role="group">
                                    <button type="submit" class="btn btn-outline-primary" >Actualizar</button>
                                    <a href="{{route('listadoL')}}" class="btn btn-outline-primary"><i class="">Volver</i></a>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
