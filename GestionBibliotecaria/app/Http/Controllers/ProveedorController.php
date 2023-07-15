<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function form(){
        return view('Abastecimiento.RegistroProveedor');
    }
    
    public function tabla(Request $request){
        $Proveedores=Proveedor::all();
        return view('Abastecimiento.Listado',compact('Proveedores'));
    }

    public function store(Request $request){
        $data=request()->validate([
            'Correoelectronico'=>'required',
	        'Direccion'=>'required',
	        'Empresa'=>'required',
	        'Telefono'=>'required'
        ]);
        $Proveedor=new Proveedor();
        $Proveedor->Correoelectronico=$request->Correoelectronico;
        $Proveedor->Direccion=$request->Direccion;
        $Proveedor->Empresa=$request->Empresa;
        $Proveedor->Telefono=$request->Telefono;
        $Proveedor->save();
        return redirect()->route('listado');
    }
}
