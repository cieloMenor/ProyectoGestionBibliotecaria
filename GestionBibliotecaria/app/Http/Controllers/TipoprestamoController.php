<?php

namespace App\Http\Controllers;

use App\Models\TipoPrestamo;
use Illuminate\Http\Request;

class TipoprestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposprestamo = TipoPrestamo::where('estadotipoprestamo','=',1)->get();
        return view('tiposprestamo.index', compact('tiposprestamo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tiposprestamo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$count=TipoPrestamo::all()->last()->Tipo_prestamoID;
        $latest = TipoPrestamo::latest('Tipo_prestamoID')->first();

        if ($latest) {
            $count = $latest->Tipo_prestamoID;
        } else {
            // Manejar el caso en que no hay registros en la tabla
            $count = 0; // o cualquier otro valor predeterminado que desees
        }
        $tipoprestamo = new TipoPrestamo();
        $tipoprestamo->Tipo_prestamoID= $count + 1;
        $tipoprestamo->Tipoprestamo=$request->Tipoprestamo;
        $tipoprestamo->estadotipoprestamo =1;
        date_default_timezone_set('America/Lima');		
        $fecha_actual = date("Y-m-d H:i:s"); 
        $tipoprestamo->fechatipoprestamo=$fecha_actual;
        $tipoprestamo->updateipoprestamo=$fecha_actual;
        $tipoprestamo->observacionestipoprestamo=$request->observacionestipoprestamo;

        $tipoprestamo->UsuarioID = auth()->user()->UsuarioID;

        $tipoprestamo->save();
        return redirect()->route('tipoprestamo.index')->with('datos','Registro actualizado ...!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $tipoprestamo = TipoPrestamo::find($id);
        return view('tiposprestamo.edit',compact('tipoprestamo'));
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
        $tipoprestamo = TipoPrestamo::find($id);

        $tipoprestamo->Tipoprestamo=$request->Tipoprestamo;
        date_default_timezone_set('America/Lima');		
        $fecha_actual = date("Y-m-d H:i:s");
        $tipoprestamo->updateipoprestamo=$fecha_actual;
        $tipoprestamo->observacionestipoprestamo=$request->observacionestipoprestamo;
        $tipoprestamo->save();
        return redirect()->route('tipoprestamo.index')->with('datos','Registro agregado ...!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Tipoprestamo = TipoPrestamo::find($id);
        $Tipoprestamo->estadotipoprestamo = 0;
        $Tipoprestamo->save();
        return redirect()->route('tipoprestamo.index')->with('datos','Registro Eliminado ...!');

    }
}
