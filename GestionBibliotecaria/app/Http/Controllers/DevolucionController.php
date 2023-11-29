<?php

namespace App\Http\Controllers;

use App\Models\DetalleDevolucion;
use App\Models\DetallePrestamo;
use App\Models\Devolucion;
use App\Models\Lector;
use App\Models\Libro;
use App\Models\Libroo;
use App\Models\Multa;
use App\Models\Prestamo;
use App\Models\Servicio;
use App\Models\TipoMulta;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DevolucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const PAGINATION=7;
    public function index(Request $request)
    {
        $buscarpor=$request->buscarpor;
        $devoluciones = Devolucion::where('Estadohabdevolución','=',1)
        ->where('PrestamoID','like','%'.$buscarpor.'%')
        ->paginate($this::PAGINATION);
        return view('devoluciones.index', compact('devoluciones','buscarpor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $idPrestamo=$request->get('id_prestamo');
        $fechadevolucion=$request->get('fechadevolucion');
        $estado=$request->get('estado');
        $tipo=$request->get('tipo');
        $lector=$request->get('lector');

        $prestamos=Prestamo::where('Estadohabprestamo','=',1)->get();
        $detalles=DetallePrestamo::where('PrestamoID','=',$idPrestamo)->get();
        return view('devoluciones.create', compact('prestamos','idPrestamo','detalles','fechadevolucion','estado','tipo','lector'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idPrestamo = $request->cod_prestamo;
        $devolucion= Devolucion::where('PrestamoID','=',$idPrestamo)->get();
        
        if ($devolucion->count()!=0) {
            
            
            return redirect()->route('devolucion.create')->with('datos2','Prestamo seleccionado ya esta en proceso de devolución...!');

        }
        else{

            $prestamo = Prestamo::find($idPrestamo);
            $count=Devolucion::all()->last()->DevolucionID;
            $devolucion= new Devolucion();

            $devolucion->DevolucionID= $count+1;
            $devolucion->PrestamoID = $request->cod_prestamo;
            $devolucion->Fechainiciodevolucion= $request->Fechainiciodevolucion;
                date_default_timezone_set('America/Lima');		
                $fecha_actual = date("Y-m-d H:i:s");
            $devolucion->Fecharegistrodevolucion = $fecha_actual;
            $devolucion->Dev_observaciones = $request->Dev_observaciones;
            $devolucion->Estadohabdevolución = 1;
                // date_default_timezone_set('America/Lima');		
                // $fecha_inicio= $request->Fechainiciodevolucion; 
                // $fechaInicio = new DateTime($fecha_inicio);
                // $fechaDev = $request->fechadevolucion;
                // $fechaFin = new DateTime($fechaDev);

            // if(  $fechaInicio>$fechaFin)
            // {
                
            //     Lector::ActualizarLectorAMoroso($prestamo->LectorID);
            // }
            // else{
            //     $devolucion->Conmulta=0;
            // }

            $idDevolucion=$devolucion->DevolucionID;
            
           
            $devolucion->save();

            $cod_libro = $request->get('cod_producto');
            $descripcion = $request->get('descripcion');
            $stock = $request->get('stock');
            $cantidad_producto = $request->get('cantidad_producto');
            $fecha = $request->get('fecha_detalle');
            $cont = 0;
            $multa=false;
            while ($cont<count($cod_libro)) {

                $count2=DetalleDevolucion::all()->last()->Devolucion_detalleID;
                $detalle = new DetalleDevolucion();
                
                $detalle->Devolucion_detalleID = $count2+1;
                $detalle->DevolucionID=$idDevolucion;
                $detalle->LibroID=$cod_libro[$cont];
                $detalle->Nrocopiasdevolucion=$cantidad_producto[$cont];
                $detalle->NroLibrosFaltaDevoD=$stock[$cont];
                $detalle->Fechadevolucionlibro=$fecha[$cont];
                $detalle->Estadodevolucion=1;

               $fecha =$fecha[$cont];
                $copias=$cantidad_producto[$cont];
                $stockanterior=$stock[$cont];
                $detalle->save();
                /* Actualizar stock */
                Libro::AumentarStocklibro($cod_libro[$cont],$cantidad_producto[$cont]);
                
                $prestamoDetalle=DetallePrestamo::where('PrestamoID','=',$idPrestamo)
                ->where('LibroID','=',$cod_libro[$cont])->get();

                $idDetallePrestamo = $prestamoDetalle[0]->Prestamo_detalleID;

                if($copias ==$stockanterior)
                {
                    DetallePrestamo::DetalleADevuelto($idDetallePrestamo);
                    
                }
                DetallePrestamo::DisminuirNroLibrosFaltaDevo($idDetallePrestamo,$copias);
               
                $fecha_inicio= $prestamo->Fechadevolucionesperadap.' '.$prestamo->Horadevolucionesperadap; 
                $fechaInicio = new DateTime($fecha_inicio);
                $fechaFin = new DateTime($fecha);

                $cont=$cont+1;

                if($fechaInicio<$fechaFin)
                {
                    $multa= true;
                }
            }
            $detallesPrestamo = DetallePrestamo::where('PrestamoID','=',$idPrestamo)->get();
            $final = true;
            foreach ($detallesPrestamo as $item) {

                if ($item->NroLibrosFaltaDevo != 0) {
                    $final = false;
                }
            
            }

            if ($final==true) {
                Prestamo::FinalizarPrestamo($idPrestamo);

                if ($multa==false) {
                    Lector::ActualizarLectorASinLibro($prestamo->LectorID);
                }
                
            }else if($multa==true){
                Prestamo::VencerPrestamo($idPrestamo);
            }
            if($multa==true){
                Lector::ActualizarLectorAMoroso($prestamo->LectorID);
                $devo=Devolucion::find($idDevolucion);
                $devo->Conmulta=1;
                $devo->save();
            }
            
            return redirect()->route('devolucion.index')->with('datos','Registro Exitoso con codigo: '.$idDevolucion.'.....!');
        
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
        $devolucion=Devolucion::find($id);
        $idPrestamo = $devolucion->PrestamoID;
        $detalles=DetallePrestamo::where('PrestamoID','=',$idPrestamo)->get();

        return view('devoluciones.agregar',compact('devolucion','detalles'));
    }

    public function agregar($id, Request $request){
        $libro = $request->get('idLibro');
        $cantidad = $request->get('Nrocopiasdevolucion');
        $stock = $request->get('NroLibrosFaltaDevo');
        $fecha = $request->get('fecha_detalle');
        if ($libro == 0) {
            return redirect()->route('devolucion.show',$id)->with('datos','Por favor seleccione el libro a devolver..!');
        }
        if ($cantidad == '' || $cantidad == 0 || $cantidad == null) {
            
            return redirect()->route('devolucion.show',$id)->with('datos','Por favor ingrese cantidad a devolver ..!');
        }
        else if ($cantidad <= 0) {
            return redirect()->route('devolucion.show',$id)->with('datos','Por favor debe escribir cantidad de libro a devolver mayor a 0 ');

        }
        else if ($cantidad > $stock) {
            return redirect()->route('devolucion.show',$id)->with('datos','No se tiene tal cantidad, solo hay '.$stock .' libros por devolver');

        
        }

        $count2=DetalleDevolucion::all()->last()->Devolucion_detalleID;
        $detalle = new DetalleDevolucion();
        
        $detalle->Devolucion_detalleID = $count2+1;
        $detalle->DevolucionID=$request->DevolucionID;
        $detalle->LibroID=$libro;
        $detalle->Nrocopiasdevolucion=$cantidad;
        $detalle->NroLibrosFaltaDevoD=$stock;
        $detalle->Fechadevolucionlibro=$fecha;
        $detalle->Estadodevolucion=1;

        $detalle->save();
        /* Actualizar stock */
        Libro::AumentarStocklibro($libro,$cantidad);

        $Devolucion = Devolucion::find($request->DevolucionID);
        $idPrestamo=$Devolucion->PrestamoID;
        $prestamo = Prestamo::find($idPrestamo);
    
        $prestamoDetalle=DetallePrestamo::where('PrestamoID','=',$idPrestamo)
        ->where('LibroID','=',$libro)->get();

        $idDetallePrestamo = $prestamoDetalle[0]->Prestamo_detalleID;

        if($cantidad ==$stock)
        {
            DetallePrestamo::DetalleADevuelto($idDetallePrestamo);
            
        }
        DetallePrestamo::DisminuirNroLibrosFaltaDevo($idDetallePrestamo,$cantidad);
        
        $detalles = DetallePrestamo::where('PrestamoID','=',$idPrestamo)->get();
        $final = true;
        foreach ($detalles as $item) {

            if ($item->NroLibrosFaltaDevo != 0) {
                $final = false;
            }
            
        }
        $fecha_inicio= $prestamo->Fechadevolucionesperadap.' '.$prestamo->Horadevolucionesperadap; 
        $fechaInicio = new DateTime($fecha_inicio);
        $fechaFin = new DateTime($fecha);

        if ($final==true) {
            Prestamo::FinalizarPrestamo($idPrestamo);

            if ($fechaInicio>=$fechaFin) {
                Lector::ActualizarLectorASinLibro($prestamo->LectorID);
            }
            
        }
        if ($fechaInicio<$fechaFin) {
            $Devolucion->Conmulta = 1;
            $Devolucion->save();
        }

        return redirect()->route('devolucion.index')->with('datos','Devolucion agregada con éxito...');
    }



    public function ver($id)
    {
        $devolucion = Devolucion::find($id);
        $detallesPrestamo = DetallePrestamo::where('PrestamoID','=',$devolucion->prestamos->PrestamoID)->get();
        $detalles = DetalleDevolucion::where('DevolucionID','=',$id)->get();
        return view('devoluciones.ver',compact('devolucion','detalles','detallesPrestamo'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function multalector($id)
    {
        return view('devoluciones.multalector');
    }

    public function edit($id,Request $request)
    {
        
        $idMulta = $request->idMulta;
        $tiposmulta=TipoMulta::all();
        $devolucion=Devolucion::find($id);
        $prestamoid=$devolucion->PrestamoID;
        $detalles=DetallePrestamo::where('PrestamoID','=',$prestamoid)->get();
        $librosprestamo = 0;
        foreach ($detalles as $item) {
            $librosprestamo +=$item->NroLibrosFaltaDevo;
        }

        return view('devoluciones.agregarmulta',compact('id','tiposmulta','idMulta','librosprestamo'));
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
