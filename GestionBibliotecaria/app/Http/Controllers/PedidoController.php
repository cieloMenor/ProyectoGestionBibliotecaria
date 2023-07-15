<?php

namespace App\Http\Controllers;

use App\Models\registroPedido;
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

    public function createDp(){
        return view('Abastecimiento.RegistroDetallePedido');
    }

    public function tablaDp(Request $request){

    }

    public function storeDp(){
        
    }
}
