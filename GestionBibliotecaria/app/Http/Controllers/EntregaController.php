<?php

namespace App\Http\Controllers;

use App\Models\DetallePrestamo;
use App\Models\Lector;
use App\Models\Libro;
use App\Models\Libroo;
use App\Models\Prestamo;
use Illuminate\Http\Request;

class EntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscarpor=$request->get('buscarpor');
        $idPrestamo=$request->get('id_prestamo');
        $fecha=$request->get('fecha');
        $estado=$request->get('estado');
        $lector=$request->get('lector');
        $fechaentrega=$request->get('fechaentrega');

        $prestamos=Prestamo::where('Estadohabprestamo','=',1)
        ->join('lector','lector.LectorID','=','prestamo.LectorID')
        ->where('lector.Apellidoslector','like','%'.$buscarpor.'%')
        ->orderby('PrestamoID')
        ->get(); 

        $detalles=DetallePrestamo::where('PrestamoID','=',$idPrestamo)->get();
        // $detalles=DetallePrestamo::join('prestamo','prestamo.PrestamoID','=','prestamo_detalle.PrestamoID')
        // ->join('lector','lector.LectorID','=','prestamo.LectorID')
        // ->where('Estadohabprestamo','=',1)
        // ->where('lector.Apellidoslector','like','%'.$buscarpor.'%')->get();

        return view('entregas.entrega', compact('buscarpor','prestamos','detalles',
        'fecha','estado','lector','idPrestamo','fechaentrega'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $prestamo=Prestamo::find($id);
        

        if($prestamo!=null){ //si existe

           
            Prestamo::AnularEntrega($id);
            $lector=$prestamo->LectorID;
            $detalles= DetallePrestamo::where('PrestamoID','=',$id)->get();

            foreach($detalles as $iten){
                $LibroID= $iten->LibroID;
                $copias = $iten->Nrocopiasprestamo;

                Libro::AumentarStocklibro($LibroID,$copias);
            }
            $LectorDeudor=Prestamo::where('LectorID','=',$lector)
            //->join('estado_prestamo','estado_prestamo.Estado_prestamoID','=','prestamo.Estado_prestamoID')
            ->where('Estadohabprestamo','=',1)
            ->get();
            $count=0;
            foreach ($LectorDeudor as $item) {
            if($item->Estado_prestamoID !=3 && $item->Estado_prestamoID!=5)
                {
                    $count++;
                }
            }

            if($count==0){
                Lector::ActualizarLectorASinLibro($lector);
            }
            return redirect()->route('entrega.index')->with('datos','Prestamo '.$id.' anulado ...!');
        }

        else{
           
            return redirect()->route('entrega.index')->with('datos','No ha elegido el prestamo que desea anular ...!');
        }

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
        $prestamo=Prestamo::find($id);
        if($prestamo!=null){ 
            $prestamo->Fechaentregaprestamo = $request->Fechaentregaprestamo.' '.$request->Horaentregaprestamo;
            $prestamo->save();
            Prestamo::ProcesarEntrega($id);
            
            $detalles= DetallePrestamo::where('PrestamoID','=',$id)->get();
            foreach($detalles as $iten){

                $iddetalle=$iten->Prestamo_detalleID;
                DetallePrestamo::DetalleAPendiente($iddetalle);
            }
            return redirect()->route('entrega.index')->with('datos','Prestamo '.$id.' entregado ...!');
        
        }
        else{
           
            return redirect()->route('entrega.index')->with('datos','No ha elegido el prestamo que desea procesar ...!');
        }
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
