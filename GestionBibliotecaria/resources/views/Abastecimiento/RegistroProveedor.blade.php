@extends('layout.plantilla')

@section('titulo','Proveedor')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="well well-sm">
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
    <table class="table table-bordered">
         <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                 <th>E-mail</th>
                 <th>Direccion</th>
                  <th>Telefono</th>
            </tr>
        </thead>
        <tbody>
            @if (count($Proveedores)<=0) 
                <tr>
                 <td colspan="3"><b>No hay Registro</b></td>
                </tr>
            @else 
                @foreach ($Proveedores as $ItemProveedor)
                 <tr>
                    <td>{{$ItemProveedor->ProveedorID}}</td>
                    <td>{{$ItemProveedor->Empresa}}</td>
                    <td>{{$ItemProveedor->Correoelectronico}}</td>
                    <td>{{$ItemProveedor->Direccion}}</td>
                    <td>{{$ItemProveedor->Telefono}}</td>
                 </tr>
                @endforeach
            @endif
        </tbody>
    </table>  
@endsection
