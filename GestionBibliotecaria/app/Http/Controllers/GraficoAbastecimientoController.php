<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\registroPedido;
use Illuminate\Http\Request;

class GraficoAbastecimientoController extends Controller
{
    public function index(){
        $librosPrestadosPorFecha = registroPedido::select(\DB::raw('MONTHNAME(Fecha) as mes'),
          \DB::raw('COUNT(PedidoID) as total'))
         ->groupBy(\DB::raw('MONTHNAME(Fecha)'))
         ->get();
        $data = [];
        foreach ($librosPrestadosPorFecha as $libro) {
            $data[] = [
                'mes' => $libro->mes,
                'total' => $libro->total];}
        return view ('Abastecimiento.Reportes',compact('data'));
    }
}














  // Generar un solo array asociativo con fechas y cantidades
        /* $data = $librosPrestadosPorFecha->map(function ($item) {
            return [
                'fecha' => $item->Fecha,
                'cantidad' => $item->total
            ];
        })->all(); */