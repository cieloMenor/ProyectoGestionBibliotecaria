<?php

namespace App\Http\Controllers;

use App\Models\Multa;
use Illuminate\Http\Request;

class MultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'Porcentajemulta' => 'required',
            
        ],
        [
            'Porcentajemulta.required'=>'Seleccione tipo de multa',
            
        ]);
        $latestMulta = Multa::latest('Multa_lectorID')->first();

        if ($latestMulta) {
            $count = $latestMulta->Multa_lectorID;
        } else {
            // Manejar el caso en que no hay registros en la tabla
            $count = 0; // o cualquier otro valor predeterminado que desees
        }
        $Multa = new Multa();
        $Multa->cantidadlibros=$request->librosprestamo;
        
        $Multa->Multa_lectorID=$count+1;
        $Multa->MontoMultaLector=$request->Porcentajemulta*$request->librosprestamo;
        $Multa->Estado_multa_lectorID='1';
        $Multa->MultaID=$request->idMulta;
        $Multa->ServicioID=$request->ServicioID;
        $Multa->PrestamoID=$request->prestamoid;
        date_default_timezone_set('America/Lima');		
                    $fecha_actual = date("Y-m-d H:i:s"); 
        $Multa->FechamultaLector=$fecha_actual;
        $Multa->Estadohabmultalector=1;
        $Multa->save();

        return redirect()->route('prestamo.index')->with('datos','Multa agregada con Exito ...!');
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
