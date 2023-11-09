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
  <title>Report</title>
</head>
<body>

<div class="container-fluid">

    <center><h2>Reporte de prestamos hechos en el año actual</h2></center>
    
    
    <table class="table">
        <thead class="thead-default" style="background-color:#2b8190;color: #fff;">
            <tr>
                <th scope="col">ID</th>
                <th scope="col"><i class="fa fa-calendar" aria-hidden="true"></i> Registro</th>
                <th scope="col">Días</th>
                <th scope="col">Tipo</th>
                <th scope="col">Lector</th>
                <th scope="col"><i class="fa fa-calendar" aria-hidden="true"></i> Devolucion</th>
                <th scope="col">Estado</th>
            </tr>
          </thead>
          <tbody>
           
                @foreach ($prestamos as $item)
                <tr>
                    <td>{{$item->PrestamoID}}</td>
                        
                        <td>@php
                            $fechita = date_create($item->Fecharegistroprestamo);
                                $fechita2=date_format($fechita, 'd-m-Y');
                            
                            echo $fechita2;
                        
                        @endphp
                            
                            
                           
                        </td>
                        <td>
                            {{-- @if($item->fecharegistroPrestamo == $item->fechaDevolucionEsperadaP) --}}
                            @php

                                $date = date_create($item->Fecharegistroprestamo);
                                $fecha=date_format($date, 'Y-m-d');

                                $fecha_de_nacimiento =  $item->Fechadevolucionesperadap; //dd-mm-aaaa
                               // $hoy = date("Y-m-d");
                                $diff = date_diff(date_create($fecha), date_create($fecha_de_nacimiento));
                            
                                echo $diff->format('%d');
                            @endphp
                            
                        </td>
                        <td>{{$item->tipo->Tipoprestamo}}</td>
                        <td>{{$item->lectores->Apellidoslector}}, {{$item->lectores->Nombreslector }}</td>
                        <td>
                            @php
                            $fechita3 = date_create($item->Fechadevolucionesperadap);
                                $fechita4=date_format($fechita3, 'd-m-Y');
                            
                            echo $fechita4;
                        
                            @endphp
                            {{$item->Horadevolucionesperadap}} </td>
                        
                    <td>
                        {{$item->estadoprestamos->Estadoprestamo}}
                    </td>
                </tr>
            </tr>
            @endforeach
          </tbody>
    
    </table>
</div>
</body>
</html>