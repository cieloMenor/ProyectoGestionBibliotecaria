<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    table {
        font-size: 12px; 
    }
  </style>  
  <title>Ticket</title>
</head>
<body>
  <div class="container-fluid">
    <center> <p>
        <h3 >Ticket de Prestamo <br> <p>NRO. {{$prestamo->PrestamoID}}</p>  <p>Biblioteca</p></h3>
        
        <br>  Tipo:    {{$prestamo->tipo->Tipoprestamo}} <br>
        Lector: {{$prestamo->lectores->Apellidoslector}}, {{$prestamo->lectores->Nombreslector }} <br>
        DNI:  {{$prestamo->lectores->Dni_lector}} <br>
        Fecha registro:  {{$prestamo->Fecharegistroprestamo}} <br>
        Fecha devolución: {{$prestamo->Fechadevolucionesperadap}} {{$prestamo->Horadevolucionesperadap}}
        
    </p></center>
    <table class="table table-bordered mt-2" >
        <thead >
          <tr>
            <th scope="col">N°</th>
                <th scope="col">Libro</th>
                <th scope="col">Cantidad</th>
          </tr>
        </thead>
        <tbody>
            @if(count($detalles)<=0)
                <tr>
                    <td colspan="3"><b>No hay registro</b></td>
                </tr>
            @else
                @foreach ($detalles as $detalle)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$detalle->Nombrelibro}}</td>
                    <td>{{$detalle->Nrocopiasprestamo}}</td>
                    
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <p>Observaciones:</p>
    <textarea name="" id="" style="width: 100%" cols="100" rows="3" readonly>{{$prestamo->Observacionesprestamo}}</textarea>
    <div class="row" style="float: right"><br>
        <div class="col-md-8">
        </div>
        <div class="col-md-4">
            <label for="">Total : </label>
            <label for="">{{$total}} libro(s) prestado (s)</label>
        </div>
        
    </div>
</div>
</body>
</html>
  