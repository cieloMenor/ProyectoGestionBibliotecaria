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
        $texto=trim($request->get('texto'));
        $Proveedores=Proveedor::where('Empresa','LIKE','%'.$texto.'%')
        ->orderBy('Empresa','asc')
        ->paginate(10);
        return view('Abastecimiento.ListadoProveedor',compact('Proveedores','texto'));
    }

    public function store(Request $request){
        $data=request()->validate([
            'Correoelectronico'=>'required',
	        'Direccion'=>'required',
	        'Empresa'=>'required',
	        'Telefono'=>'required'
        ]);
        $Proveedor=new Proveedor();
        $Proveedor->ProveedorID=$request->ProveedorID;
        $Proveedor->Correoelectronico=$request->Correoelectronico;
        $Proveedor->Direccion=$request->Direccion;
        $Proveedor->Empresa=$request->Empresa;
        $Proveedor->Telefono=$request->Telefono;
        $Proveedor->save();
        return redirect()->route('listado')->with('datos','Registro Nuevo Guardado ...!');
    }

    public function Edit($id){
        $provi=Proveedor::find($id);
        return view('Abastecimiento.EditarProveedor',compact('provi'));
    }

    public function update(Request $request){
        $upda=Proveedor::find($request->ProveedorID);
        $upda->ProveedorID=$request->ProveedorID;
        $upda->Correoelectronico=$request->Correoelectronico;
        $upda->Direccion=$request->Direccion;
        $upda->Empresa=$request->Empresa;
        $upda->Telefono=$request->Telefono;
        $upda->save();
        return redirect()->route('listado');
    }
    public function eliminar($id){
        $elimp=Proveedor::find($id);
        $elimp->delete();
        return redirect()->route('listado');
    }
}
