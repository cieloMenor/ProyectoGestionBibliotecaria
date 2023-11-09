<?php

namespace App\Http\Controllers;

use App\Models\registroDetallePedido;
use App\Models\registroPedido;
use Barryvdh\DomPDF\Facade\PDF as PDF;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function createP(){
        return view('Abastecimiento.RegistroPedido');
    }

    public function tablaP(Request $request){
        $pedidos=registroPedido::all();
        return view('Abastecimiento.ListadoPedido',compact('pedidos'));
    }

    public function storeP(Request $request){
        $data=request()->validate([
            'PedidoID'=>'required',
            'Fecha'=>'required',
            'ProveedorID'=>'required',
            'BibliotecarioID'=>'required'
        ]);
        $RegistroPedido= new registroPedido();
        $RegistroPedido->PedidoID=$request->PedidoID;
        $RegistroPedido->Fecha=$request->Fecha;
        $RegistroPedido->BibliotecarioID=$request->BibliotecarioID;
        $RegistroPedido->ProveedorID=$request->ProveedorID;
        $RegistroPedido->save();
        return redirect()->route('listadoP');
    }

    public function editarP($id){
        $pedi=registroPedido::find($id);
        return view('Abastecimiento.EditarPedido',compact('pedi'));
    }

    public function updateP(Request $request){
        $updaP=registroPedido::find($request->PedidoID);
        $updaP->PedidoID=$request->PedidoID;
        $updaP->Fecha=$request->Fecha;
        $updaP->BibliotecarioID=$request->BibliotecarioID;
        $updaP->ProveedorID=$request->ProveedorID;
        $updaP->save();
        return redirect()->route('listadoP');
    }

    public function eliminarP($ide){
        $elimP=registroPedido::find($ide);
        $elimP->delete($ide);
        return redirect()->route('listadoP');
    }

    public function editarDP($id){
        $Depedi=registroDetallePedido::find($id);
        return view('Abastecimiento.EditarDetallePedido',compact('Depedi'));
    }



    public function createDp(){
        return view('Abastecimiento.RegistroDetallePedido');
    }

    public function tablaDp(Request $request){
        $detallesP=registroDetallePedido::all();
        return view('Abastecimiento.ListadoDetallePedido',compact('detallesP'));
    }

    public function storeDp(Request $request){
        $data=request()->validate([
            'Detalle_pedidoID'=>'required',
            'Cantidad'=>'required',
            'PedidoID'=>'required'
        ]);
        $PedidoDetalle= new registroDetallePedido();
        $PedidoDetalle->Detalle_pedidoID=$request->Detalle_pedidoID;
        $PedidoDetalle->Cantidad=$request->Cantidad;
        $PedidoDetalle->PedidoID=$request->PedidoID;
        $PedidoDetalle->LibroID=$request->LibroID;
        $PedidoDetalle->save();
        return redirect()->route('listadoDP');
    }

    public function updateDP(Request $request){
        $updaDP=registroDetallePedido::find($request->Detalle_pedidoID);
        $updaDP->Detalle_pedidoID=$request->Detalle_pedidoID;
        $updaDP->Cantidad=$request->Cantidad;
        $updaDP->PedidoID=$request->PedidoID;
        $updaDP->LibroID=$request->LibroID;
        $updaDP->save();
        return redirect()->route('listadoDP');
    }

    public function eliminarDP($id){
        registroDetallePedido::where('Detalle_pedidoID',$id)->delete();
        return redirect()->route('listadoDP');

    }

    public function prueba(){
        $pedidos=registroPedido::all();
        $pdf = PDF::loadview('Abastecimiento.pdfPedido',compact('pedidos'));
        return $pdf->download('pedidos.pdf');
      }

}
