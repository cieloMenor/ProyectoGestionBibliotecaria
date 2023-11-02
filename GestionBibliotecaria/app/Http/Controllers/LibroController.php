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
        $Libro->Stock=$request->Stock;
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
}
