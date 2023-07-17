<?php

namespace App\Http\Controllers;

use App\Models\DetallePrestamo;
use App\Models\Lector;
use App\Models\Libroo;
use App\Models\Prestamo;
use App\Models\TipoPrestamo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class PrestamoController extends Controller
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

        $prestamos = Prestamo::where('Estadohabprestamo','=','1')
        ->join('lector','lector.LectorID','=','prestamo.LectorID')
        ->where('lector.Apellidoslector','like','%'.$buscarpor.'%')
        ->orderby('PrestamoID')->paginate($this::PAGINATION); 

        return view('prestamos.index',compact('prestamos','buscarpor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lectores = Lector::join('estado_lector','estado_lector.estado_lectorID','=','lector.estado_lectorID')->get();
        $tipos=TipoPrestamo::all();
        $libros =Libroo::where('Estado_libroID','=',1)->get();
        return view('prestamos.create',compact('tipos','lectores','libros'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        try {
            DB::beginTransaction();
            $lector=Lector::where('Dni_lector','=',$request->Dni_lector)->get();
            $LectorID=$lector[0]->LectorID;

            $count = count(Prestamo::all());
            $prestamo= new Prestamo();

            $prestamo->PrestamoID= $count+1;
            $prestamo->LectorID = $LectorID;
            $prestamo->Fecharegistroprestamo = now();
            $prestamo->Fechaupdateprestamo = now();
            $prestamo->Tipo_prestamoID =$request->Tipo_prestamoID;
            $prestamo->Fechadevolucionesperadap = $request->Fechadevolucionesperadap;
            $prestamo->Horadevolucionesperadap = $request->Horadevolucionesperadap;
            $prestamo->Observacionesprestamo =$request->Observacionesprestamo;
            $prestamo->Estado_prestamoID =1;
            $prestamo->Estadohabprestamo =1;
            $prestamo->Tipo_prestamoID =$request->Tipo_prestamoID;
            $prestamo->Tipo_prestamoID =$request->Tipo_prestamoID;

            $idprestamo = $prestamo->PrestamoID;
            $prestamo->save();

            //agregar detalle

            $cod_libro = $request->get('cod_producto');
            $descripcion = $request->get('descripcion');
            $stock = $request->get('stock');
            $cantidad_producto = $request->get('cantidad_producto');
            
            $cont = 0;
            while ($cont<count($cod_libro)) {

                $count2 = count(DetallePrestamo::all());
                $detalle = new DetallePrestamo();
                
                $detalle->Prestamo_detalleID = $count2+1;
                $detalle->PrestamoID=$idprestamo;
                $detalle->LibroID=$cod_libro[$cont];
                $detalle->Nrocopiasprestamo=$cantidad_producto[$cont];
                    //$nrocopias = $detalle->Nrocopiasprestamo;
                $detalle->Nombrelibro=$descripcion[$cont];
                $detalle->Estado_detalle_prestamoID=1;
                $detalle->Estadohabdetalleprestamo=1;

                $detalle->save();
                /* Actualizar stock */
                Libroo::ActualizarStocklibro($cod_libro[$cont],$cantidad_producto[$cont]);
                
                $cont=$cont+1;
            }

            /*Actualizar lector a deudor*/
            Lector::ActualizarLectorADeudor($LectorID);

            DB::commit();
            return redirect()->route('prestamo.index')->with('datos','Registro Exitoso ...!');
            //code...
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
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
