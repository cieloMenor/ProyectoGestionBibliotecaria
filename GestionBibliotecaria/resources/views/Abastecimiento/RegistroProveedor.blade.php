@extends('layout.plantilla')

@section('titulo','Proveedor')
@section('contenido')

<div class="container" >
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <form class="form-horizontal"  method="post" style="margin-left:20px">
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
                                <input id="fname" name="name" type="text" placeholder="Nombre de la Empresa" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="email" name="email" type="text" placeholder="Email" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-map-marker-alt"></i></span>
                            <div class="col-md-8">
                                <input id="lname" name="name" type="text" placeholder="Direccion" class="form-control">
                            </div>
                        </div>


                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="phone" name="phone" type="text" placeholder="Telefono" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-primary btn-lg">Registrar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection