<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Proveedor;
use App\Models\registroDetallePedido;
use App\Models\registroPedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraficoAbastecimientoController extends Controller
{
    public function index()
    {
        $librosPrestadosPorFecha = registroPedido::select(
            DB::raw('MONTHNAME(Fecha) as mes'),
            DB::raw('COUNT(PedidoID) as total')
        )
            ->groupBy(DB::raw('MONTHNAME(Fecha)'))
            ->get();

        $data = [];
        $pedidosYProveedores = [];
        foreach ($librosPrestadosPorFecha as $libro) {
            $data[] = [
                'mes' => $libro->mes,
                'total' => $libro->total
            ];
        }

        $libros = Libro::all();

        $pedidos = registroPedido::all();

        $pedidosConDatos = [];

        foreach ($pedidos as $pedido) {

            $cantidadTotal = 0;

            $detalles = registroDetallePedido::where('PedidoID', $pedido->PedidoID)->get();

            foreach ($detalles as $detalle) {
                $cantidadTotal += $detalle->Cantidad;
            }

            $pedidosYProveedores[] = [
                'Proveedor' => Proveedor::find($pedido->ProveedorID)->Empresa,
                'Fecha' => $pedido->Fecha,
                'Cantidad' => $cantidadTotal,
            ];
        }

        return view('Abastecimiento.Reportes', compact('data', 'libros', 'pedidosYProveedores'));
    }
}














  // Generar un solo array asociativo con fechas y cantidades
        /* $data = $librosPrestadosPorFecha->map(function ($item) {
            return [
                'fecha' => $item->Fecha,
                'cantidad' => $item->total
            ];
        })->all(); */