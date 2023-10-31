<?php

namespace App\Http\Controllers;

use App\Models\Libroo;
use Illuminate\Http\Request;

class LibrooController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const PAGINATION=10;
    public function index(Request $request)
    {
        $buscarpor=$request->get('buscarpor');

        
        $libros = Libroo::where('Estadohablibro','=','1')
        ->join('estado_libro','estado_libro.Estado_libroID','=','libro.Estado_libroID')
        ->where('libro.Titulo','like','%'.$buscarpor.'%')
        ->orderby('LibroID')->paginate($this::PAGINATION);
        
        return view('libross.index',compact('libros','buscarpor'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('libross.registroLibro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=request()->validate([
           'Añopublicacion'=>'required',
           'Editorial'=>'required',
           'Idioma '=>'required',
           'Isbn '=>'required',
           'Paginas'=>'required',
           'Precio'=>'required',
           'Titulo'=>'required',
           'Edicionlibro'=>'required',
           'Estadohablibro'=>'required',
           'Nrocopiaslibro'=>'required',
           'Stocklibro'=>'required'
        ]);
        $libros= new Libroo();
        $libros->LibroID = $request->LibroID;
        $libros->Añopublicacion = $request->Añopublicacion;
        $libros->Editorial = $request->Editorial;
        $libros->Idioma = $request->Idioma;
        $libros->Isbn = $request->Isbn;
        $libros->Paginas = $request->Paginas;
        $libros->Precio = $request->Precio;
        $libros->Titulo = $request->Titulo;
        $libros->Edicionlibro = $request->Edicionlibro;
        $libros->Estadohablibro = $request->Estadohablibro;
        $libros->Nrocopiaslibro = $request->Nrocopiaslibro;
        $libros->Stocklibro = $request->Stocklibro;
        $libros->save();
        return redirect()->route('listadoL');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tabla(Request $request)
    {
        $libros=Libroo::all();
        return view('libross.index');
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
