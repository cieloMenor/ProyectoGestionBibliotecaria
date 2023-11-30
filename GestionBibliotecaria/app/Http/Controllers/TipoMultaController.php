<?php

namespace App\Http\Controllers;

use App\Models\TipoMulta;
use Illuminate\Http\Request;

class TipoMultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const PAGINATION=10;
    public function index()
    {
        $tiposmulta=TipoMulta::where('Estadomultahab','=',1)->paginate($this::PAGINATION);
        return view('tiposmulta.index', compact('tiposmulta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tiposmulta.create');
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
            'Descripcionmulta'=>'required',
            'Porcentajemulta'=>'required|numeric'

        ],
        [
            'Descripcionmulta.required'=>'Ingrese Descripcion de multa',
            'Porcentajemulta.required'=>'Ingrese Porcentaje de multa',
            'Porcentajemulta.numeric'=>'Registre solo valores numericos'
        ]);

            //$count=TipoMulta::all()->last()->MultaID;
            $latest = TipoMulta::latest('MultaID')->first();

            if ($latest) {
                $count = $latest->MultaID;
            } else {
                // Manejar el caso en que no hay registros en la tabla
                $count = 0; // o cualquier otro valor predeterminado que desees
            }
            $tipomulta = new TipoMulta();
            $tipomulta->MultaID= $count+1;
            $tipomulta->Descripcionmulta = $request->Descripcionmulta;
            $tipomulta->Porcentajemulta = $request->Porcentajemulta;
            $tipomulta->Estadomultahab=1;
            date_default_timezone_set('America/Lima');		
                $fecha_actual = date("Y-m-d H:i:s"); 
            $tipomulta->Fecharegistromulta = $fecha_actual;
            $tipomulta->Fechaupdatemulta = $fecha_actual;
            $tipomulta->UsuarioID = auth()->user()->UsuarioID;

            $tipomulta->save();

            return redirect()->route('tipomulta.index')->with('datos','Registro agregado ...!');


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
        $tipomulta=TipoMulta::find($id);
        return view('tiposmulta.edit',compact('tipomulta'));
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
        $data=request()->validate([
            'Descripcionmulta'=>'required',
            'Porcentajemulta'=>'required|numeric'

        ],
        [
            'Descripcionmulta.required'=>'Ingrese Descripcion de multa',
            'Porcentajemulta.required'=>'Ingrese Porcentaje de multa',
            'Porcentajemulta.numeric'=>'Registre solo valores numericos'
        ]);
            $tipomulta= TipoMulta::find($id);
            $tipomulta->Descripcionmulta = $request->Descripcionmulta;
            $tipomulta->Porcentajemulta = $request->Porcentajemulta;
            date_default_timezone_set('America/Lima');		
                $fecha_actual = date("Y-m-d H:i:s"); 
            $tipomulta->Fechaupdatemulta = $fecha_actual;

            $tipomulta->save();

            return redirect()->route('tipomulta.index')->with('datos','Registro actualizado ...!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipomulta= TipoMulta::find($id);
        $tipomulta->Estadomultahab = 0;
        $tipomulta->save();

        return redirect()->route('tipomulta.index')->with('datos','Registro eliminado ...!');

    }
}
