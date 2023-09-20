<?php

namespace App\Http\Controllers;

use App\Models\DetallePrestamo;
use App\Models\Lector;
use App\Models\Libroo;
use App\Models\Prestamo;
use App\Models\TipoPrestamo;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

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
        
        //$fecha = Carbon::now()->toTimeString();
        foreach($prestamos as $registro) {

            $fecha_de_nacimiento =  $registro->Fechadevolucionesperadap; //dd-mm-aaaa
            $fecha = date("Y-m-d");
             $diff = (array) date_diff(date_create($fecha_de_nacimiento), date_create($fecha));
             
            $registro['diferencia_dias'] = $diff['days'];
        } 
        
        return view('prestamos.index',compact('prestamos','buscarpor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lectores = Lector::join('estado_lector','estado_lector.estado_lectorID','=','lector.estado_lectorID')
        ->where('Estadoeliminadolector','=',1)->where('Estadohablector','=',1)
        ->get();
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

            $count=Prestamo::all()->last()->PrestamoID;
            $prestamo= new Prestamo();
                    date_default_timezone_set('America/Lima');		
                    $fecha_actual = date("Y-m-d H:i:s"); 
            $prestamo->PrestamoID= $count+1;
            $prestamo->LectorID = $LectorID;
            $prestamo->Fecharegistroprestamo = $fecha_actual;
            $prestamo->Fechaupdateprestamo = $fecha_actual;
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

                $count2=DetallePrestamo::all()->last()->Prestamo_detalleID;
                $detalle = new DetallePrestamo();
                
                $detalle->Prestamo_detalleID = $count2+1;
                $detalle->PrestamoID=$idprestamo;
                $detalle->LibroID=$cod_libro[$cont];
                $detalle->Nrocopiasprestamo=$cantidad_producto[$cont];
                $detalle->NroLibrosFaltaDevo=$cantidad_producto[$cont];
                    //$nrocopias = $detalle->Nrocopiasprestamo;
                $detalle->Nombrelibro=$descripcion[$cont];
                $detalle->Estado_detalle_prestamoID=1;
                $detalle->Estadohabdetalleprestamo=1;
                $detalle->StockLibroP = $stock[$cont];
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

    public function crearlector(){
        return view('prestamos.createLector');
    }

    public function store2(Request $request){
        $data=request()->validate([
            'Dni_lector' => 'required|numeric',
            'Nombreslector' =>'required',
            'Apellidoslector' =>'required',
            'Correolector' =>'required|email|max:255',
            'Fechanaclector' => 'required',
            'Celularlector' => 'required|numeric',
            'Direccionlector' => 'required',
        ],
        [
            'Dni_lector.required'=>'Registre DNI de lector',
            'Dni_lector.numeric'=>'Registre solo valores numericos',
            'Nombreslector' =>'Registro Nombres del lector',
            'Apellidoslector' =>'Registro Apellidos del lector',
            'Correolector.required'=>'Registre correo',
            'Correolector.email'=>'Registre correo electrónico válido',
            'Correolector.max'=>'Máximo 255 caracteres para el correo',
            'Fechanaclector.required'=>'Registre fecha de nacimiento',
            'Celularlector.required'=>'Registre celular',
            'Celularlector.numeric'=>'Registre solo valores numericos',
            'Direccionlector.required'=>'Registre dirección de lector',
            
        ]);

        $dni=$request->get('Dni_lector'); //se almacenara el valor de name ingresado
        $query=Lector::where('Dni_lector','=',$dni)->get();// comparación de name y se almacena en $query
        if($query->count()!=0) //si lo encuentra, osea si no esta vacia, entonces analizara el password ahora
        {
            
            return back()->withErrors(['Dni_lector'=> 'Lector ya registrado'])
            ->withInput(request(['Dni_lector','Nombreslector','Apellidoslector','Correolector','Fechanaclector','Celularlector',
            'Direccionlector']));                   
        }
        else{ // si no lo encuentra con el name
            $count=Lector::all()->last()->LectorID;

            $lector = new Lector();
            $lector->LectorID = $count + 1;
            $lector->Dni_lector = $request->Dni_lector;
            $lector->Nombreslector = $request->Nombreslector;
            $lector->Apellidoslector = $request->Apellidoslector;
            $lector->Estado_lectorID = 1;
            $lector->Correolector = $request->Correolector;
            $lector->Fechanaclector = $request->Fechanaclector;
            $lector->Fecharegistrolector = now();
            $lector->Fechaupdatelector = now();
            $lector->Celularlector = $request->Celularlector;
            $lector->Direccionlector = $request->Direccionlector;
            $lector->Estadohablector = 1;
            $lector->Estadoeliminadolector = 1;

            $lector->save();

            return redirect()->route('prestamo.create')->with('datos2','Lector agregado con Exito ...!');

        }
    }

    public function ver($id)
    {
        $detalles=DetallePrestamo::where('PrestamoID','=',$id)->get();
        $prestamo= Prestamo::find($id);
        return view('prestamos.ver', compact('detalles','prestamo'));
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
        $detalles= DetallePrestamo::where('PrestamoID','=',$id)->get();

        foreach($detalles as $iten){
            $LibroID= $iten->LibroID;
            $copias = $iten->Nrocopiasprestamo;
            $iten->Estadohabdetalleprestamo = 0;
            $iten->save();
            
            Libroo::AumentarStocklibro($LibroID,$copias);
        }
        $prestamo= Prestamo::find($id);
        $lector = $prestamo->LectorID;

        $prestamo->Estadohabprestamo =0;
        $prestamo ->save();
        //lector actualizar a sin libro

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
        
        return redirect()->route('prestamo.index')->with('datos','Registro eliminado y stock de libros actualizados...');
    }
}
