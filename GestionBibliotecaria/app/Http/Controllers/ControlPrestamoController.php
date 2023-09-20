<?php

namespace App\Http\Controllers;

use App\Models\Devolucion;
use App\Models\Lector;
use App\Models\Prestamo;
use DateTime;
use Illuminate\Http\Request;

class ControlPrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestamos = Prestamo::where('Estado_prestamoID','=',2)
        ->where('Estadohabprestamo','=',1)->get();
        return view('controles.controlarPrestamo',compact('prestamos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prestamos = Prestamo::where('Estado_prestamoID','=',2)
        ->where('Estadohabprestamo','=',1)->get();

        $hayVencido =false;
        foreach ($prestamos as $item) {
            $idPrestamo = $item->PrestamoID;
            $idLector = $item->LectorID;
            $fecha_actual = date("Y-m-d H:i:s");  
            $fecha_dev= $item->Fechadevolucionesperadap.' '.$item->Horadevolucionesperadap; 
            $fechaInicio = new DateTime($fecha_actual);
            $fechaFin = new DateTime($fecha_dev);

            if ($fechaInicio>$fechaFin) {
                Prestamo::VencerPrestamo($idPrestamo);
                Lector::ActualizarLectorAMoroso($idLector);
                Devolucion::AgregarMulta($idPrestamo);
                $hayVencido = true;
            }
            
        }
        if ($hayVencido == true) {
            return redirect()->route('controlPrestamo.index')->with('datos','Prestamos Vencidos actualizados con éxito...');

        }
        else{
            return redirect()->route('controlPrestamo.index')->with('datos','Prestamos actualizados pero ninguno está en fecha de vencerse..!');

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
