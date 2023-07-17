<?php

namespace App\Http\Controllers;

use App\Models\Bibliotecario;
use Illuminate\Http\Request;

class BibliotecarioController extends Controller
{
    public function createB(){
        return view('Abastecimiento.Bibliotecario');
    }

    public function tablaB(Request $request){
        $bibli=Bibliotecario::all();
        return view('Abastecimiento.DatosBibliotecario',compact('bibli'));
    }

    public function storeB(Request $request){
        $data=request()->validate([
            'Nombre'=>'required',
            'Dni'=>'required',
            'Correoelectronico'=>'required',
            'Direccion'=>'required',
            'Telefono'=>'required'
        ]);
        $Bibliotecario=new Bibliotecario();
        $Bibliotecario->BibliotecarioID=$request->BibliotecarioID;
        $Bibliotecario->Nombre=$request->Nombre;
        $Bibliotecario->Dni=$request->Dni;
        $Bibliotecario->Correoelectronico=$request->Correoelectronico;
        $Bibliotecario->Direccion=$request->Direccion;
        $Bibliotecario->Telefono=$request->Telefono;
        $Bibliotecario->save();
        return redirect()->route('listadoB');
    }

    public function editarB($id){
        $biblo=Bibliotecario::find($id);
        return view('Abastecimiento.EditarBibliotecario',compact('biblo'));
    }

    public function updateB(Request $request){
        $updaB=Bibliotecario::find($request->BibliotecarioID);
        $updaB->BibliotecarioID=$request->BibliotecarioID;
        $updaB->Nombre=$request->Nombre;
        $updaB->Dni=$request->Dni;
        $updaB->Correoelectronico=$request->Correoelectronico;
        $updaB->Direccion=$request->Direccion;
        $updaB->Telefono=$request->Telefono;
        $updaB->save();
        return redirect()->route('listadoB');
    }

    public function eliminarB($ide){
        $elimB=Bibliotecario::find($ide);
        $elimB->delete($ide);
        return redirect()->route('listadoB');

    }
}
