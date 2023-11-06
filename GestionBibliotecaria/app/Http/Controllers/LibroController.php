<?php

namespace App\Http\Controllers;

use App\Models\EstadoLibro;
use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function createL(){
        $estadosLibros=EstadoLibro::all();
        return view('Abastecimiento.registroLibro',compact('estadosLibros'));
    }

    public function tablaL(Request $request){
        $libros=Libro::all();
        return view('Abastecimiento.ListadoLibro',compact('libros'));
    }

    public function storeL(Request $request){
        $data=request()->validate([
            'LibroID'=>'required',
            'Titulo'=>'required',
            'Stock'=>'required',
            'Precio'=>'required',
            'Paginas'=>'required',
            'Isbn'=>'required',
            'Idioma'=>'required',
            'Editorial'=>'required',
            'Añopublicacion'=>'required',
            'Estado_libroID'=>'required'
        ]);
        $Libro=new Libro();
        $Libro->LibroID=$request->LibroID;
        $Libro->Titulo=$request->Titulo;
        $Libro->Stocklibro=$request->Stock;
        $Libro->Precio=$request->Precio;
        $Libro->Paginas=$request->Paginas;
        $Libro->Isbn=$request->Isbn;
        $Libro->Idioma=$request->Idioma;
        $Libro->Editorial=$request->Editorial;
        $Libro->Añopublicacion=$request->Añopublicacion;
        $Libro->Estado_libroID=$request->Estado_libroID;
        $Libro->save();
        return redirect()->route('listadoL');
    }

    public function editarL($id){
        $Li=Libro::find($id);
        $estadosLibros=EstadoLibro::all();
        return view('Abastecimiento.EditarLibro',compact('Li','estadosLibros'));
    }

    public function updateL(Request $request){
        $updaL=Libro::find($request->LibroID);
        $updaL->LibroID=$request->LibroID;
        $updaL->Stock=$request->Stock;
        $updaL->Precio=$request->Precio;
        $updaL->Paginas=$request->Paginas;
        $updaL->Isbn=$request->Isbn;
        $updaL->Idioma=$request->Idioma;
        $updaL->Editorial=$request->Editorial;
        $updaL->Añopublicacion=$request->Añopublicacion;
        $updaL->Estado_libroID=$request->Estado_libroID;
        $updaL->save();
        return redirect()->route('listadoL');
    }

    public function eliminarL($id){
        Libro::where('LibroID',$id)->delete();
        return redirect()->route('listadoL');

    }
}
