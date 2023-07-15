@extends('layout.plantilla')

@section('titulo','Proveedor')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="well well-sm">
                    <script>
                        function confirmacion(){
                            var respuesta=confirm("¿Confirmas que los datos proporcionados son precisos y verdaderos?");
                            if (respuesta==true){
                                return true
                            }else{
                                return false
                            }
                        }

                    </script>
                    <form class="form-horizontal" method="POST" style="margin-left:20px" action="{{route('ProveedorStore')}}">
                        @csrf
                        <fieldset>
                            <br>
                            <h4>
                                <legend style="margin-left:20px;">Registro de Proveedores</legend>
                            </h4>
                            <br>
                            <br>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-8">
                                    <input name="ProveedorID" type="text" placeholder="Codigo" class="form-control" id="ProveedorID">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-8">
                                    <input name="Empresa" type="text" placeholder="Nombre de la Empresa" class="form-control" id="Empresa">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope bigicon"></i></span>
                                <div class="col-md-8">
                                    <input name="Correoelectronico" type="text" placeholder="Email" class="form-control" id="Correoelectronico">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-map-marker-alt"></i></span>
                                <div class="col-md-8">
                                    <input name="Direccion" type="text" placeholder="Direccion" class="form-control" id="Direccion">
                                </div>
                            </div>


                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                                <div class="col-md-8">
                                    <input name="Telefono" type="text" placeholder="Telefono" class="form-control" id="Telefono">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 " role="group">
                                    <button type="submit" class="btn btn-outline-primary" onclick="return confirmacion()">Registrar</button>
                                    <a href="{{route('listado')}}" class="btn btn-outline-primary"><i class="">Volver</i></a>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
