@extends('layout.plantilla')

@section('titulo','Inicio')


@section('contenido')
<div class="container ">

    <h2 id="ss">Sistema de Gestión Bibliotecaria</h2>

    <div class="imagenhome" id="imagenhome" name="imagenhome">
      {{-- <center>
        <img src="/img/logo.png" width="40%" style="filter:brightness(105%)">
      </center> --}}
    </div>
    {{-- Mensaje de alerta --}}
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
    {{-- <style>
      .imagenhome{
        background-image:url("../public/img/logo.png");
      } 
    </style>--}}
    
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
