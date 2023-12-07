@extends('layout.plantilla')

@section('titulo','Comprobantes Tienda')

@section('contenido')

<div class="container ">
    <h1>COMPROBANTES DE TIENDA DE LIBROS</h1>
    <br>
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
    <table class="table">
        <thead>
          <tr>
            <th scope="col">N°</th>
            <th scope="col">Cliente</th>
            <th scope="col">Fecha</th>
            <th scope="col">Libro</th>
            <th scope="col">Monto</th>
            <th scope="col">Estado</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody>
            @if(count($comprobantes)<=0)
                <tr>
                    <td colspan="7"><b>No hay registro</b></td>
                </tr>
            @else
                @foreach ($comprobantes as $item)
                <tr>
                    {{-- <td>{{$loop->index+1}}</td> --}}
                    
                    <td>{{$item->idcomprobante}}</td>
                    <td>{{$item->clientes->Apellidosusuario}}, {{$item->clientes->Nombresusuario}}</td>
                    <td>
                        @php
                        $date = date_create($item->fecha);
                        $fecha=date_format($date, 'd-m-Y');

                        echo $fecha;
                    @endphp
                    </td>
                    <td>{{$item->libros->Titulo}}</td>
                    <td>
                        S/ <?php
                            $num = $item->monto;
                            echo(number_format($num, 2)); ?>
                    </td>
                    <td></td>
                    <td>
                        <a href="{{route('comprobante.edit',$item->idcomprobante)}}" target="_blank" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

@endsection

@section('script')
<script>
    //para cerrar el mensaje
    setTimeout(function () {
        //selecciono el id mensaje y lo remuevo en 2000 segundos
        document.querySelector('#mensaje').remove();
        
    }, 2000);
</script>
@endsection