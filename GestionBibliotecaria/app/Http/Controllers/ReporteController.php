<?php

namespace App\Http\Controllers;

use App\Models\DetallePrestamo;
use App\Models\Libro;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$libros= Libro::all();
        //$disponibilidad[] = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        
        $valores = array();
        $nombres = array();
        if ($request->valoraño == "") {
            $valoraño = '2023';
        }
        else{
        $valoraño = $request->valoraño;
        }
        $años= DetallePrestamo::select(DB::raw("year(Fecharegistroprestamo)	as año"))
        ->join('prestamo','prestamo.prestamoID','=','prestamo_detalle.prestamoID')
        ->groupBy(DB::raw("Year(Fecharegistroprestamo)"))->get();

       // $canti = 0;
        // foreach ($libros as $row) {
        //     $revenue[] = $row["Stocklibro"];
        //     $nombres[] = $row["Titulo"];

        // }
            
        // $librosprestamos = DB::select('call reporte1');
        // $libross =DetallePrestamo::join('prestamo','prestamo.PrestamoID','=','prestamo_detalle.PrestamoID')
        // ->where('Estadohabprestamo','=',1)->get();

        //$libro= DetallePrestamo::select(DB::raw("case month(Fecharegistroprestamo) when 1 then 'Ene' when 2 then 'Feb' when 3 then 'Mar' when 4 then 'Abr' when 5 then 'May' when 6 then 'Jun' when 7 then 'Jul' when 8 then 'Ago' when 9 then 'Sep' when 10 then 'Oct' when 11 then 'Nov' when 12 then 'Dic' end as Mes"));
        
        $libro= DetallePrestamo::select(DB::raw("SUM(Nrocopiasprestamo)	as Cantidad"))
        ->join('prestamo','prestamo.prestamoID','=','prestamo_detalle.prestamoID')
        ->where('Estadohabprestamo','=','1')
        ->whereYear('Fecharegistroprestamo','=',$valoraño)
        ->groupBy(DB::raw("Month(Fecharegistroprestamo)"))
        //->pluck('Cantidad')
        ->get();

        $months= DetallePrestamo::select(DB::raw("month(Fecharegistroprestamo)	as Mes"))
        ->join('prestamo','prestamo.prestamoID','=','prestamo_detalle.prestamoID')
        ->whereYear('Fecharegistroprestamo','=',$valoraño)
        ->groupBy(DB::raw("Month(Fecharegistroprestamo)"))
        //->pluck('Mes')
        ->get();
        
        //$datas = array(0,0,0,0,0,0,0,0,0,0,0,0);
        //Nrocopiasprestamo	as Cantidad from prestamo	P inner join prestamo_detalle PD				ON PD.PrestamoID=P.PrestamoID where year(P.Fecharegistroprestamo)='2023' group by month(P.Fecharegistroprestamo) order by month(P.Fecharegistroprestamo);"))->get();
        foreach ($months as $row) {
            
        //$nombres[] = $row["Mes"];

        if ($row["Mes"] ==1) {
            $nombres[] = "Ene";
        }
        if ($row["Mes"] ==2) {
            $nombres[] = "Feb";
        }
        if ($row["Mes"] ==3) {
            $nombres[] = "Mar";
        }
        if ($row["Mes"] ==4) {
            $nombres[] = "Abr";
        }
        if ($row["Mes"] ==5) {
            $nombres[] = "May";
        }
        if ($row["Mes"] ==6) {
            $nombres[] = "Jun";
        }
        if ($row["Mes"] ==7) {
            $nombres[] = "Jul";
        }
        if ($row["Mes"] ==8) {
            $nombres[] = "Ago";
        }
        if ($row["Mes"] ==9) {
            $nombres[] = "Sep";
        }
        if ($row["Mes"] ==10) {
            $nombres[] = "Oct";
        }
        if ($row["Mes"] ==11) {
            $nombres[] = "Nov";
        }
        if ($row["Mes"] ==12) {
            $nombres[] = "Div";
        }

        }
        foreach ($libro as $row) {
            
            $valores[] = $row["Cantidad"];
    
            }

        $valores2 = array();
        $nombres2 = array();
        

        //segun clientes
        // $libronombre= DetallePrestamo::select(DB::raw("Nombrelibro as Libro"))
        // ->join('prestamo','prestamo.prestamoID','=','prestamo_detalle.prestamoID')
        // ->where('Estadohabprestamo','=','1')
        // ->whereYear('Fecharegistroprestamo','=',$valoraño)
        // ->groupBy(DB::raw("Nombrelibro"));

        $libronombre= DB::select('select l.Titulo as libro, sum(pd.Nrocopiasprestamo) as prestados from prestamo p inner join prestamo_detalle pd on pd.prestamoID = p.prestamoID inner join libro l on l.libroID = pd.libroID where p.Estadohabprestamo=1 group by l.Titulo');

        $prestados= DetallePrestamo::select(DB::raw("SUM(Nrocopiasprestamo)	as prestado"))
        ->join('prestamo','prestamo.prestamoID','=','prestamo_detalle.prestamoID')
        ->where('Estadohabprestamo','=','1')
        ->whereYear('Fecharegistroprestamo','=',$valoraño)
        ->groupBy(DB::raw("Nombrelibro"));

        foreach ($libronombre as $row) {
            
            $nombres2[] = $row->libro;
            $valores2[] = $row->prestados;
    
         }
        // foreach ($prestados as $row) {
        
        //     $valores2[] = $row["prestado"];
    
        //     }

        //otro grafico
        $prestamos= DB::select('select e.Estadoprestamo as estado, count(p.prestamoID) as prestamos from prestamo p inner join estado_prestamo e on e.Estado_prestamoID=p.Estado_prestamoID where p.Estadohabprestamo=1 group by e.Estadoprestamo');

        $prestados= Prestamo::select(DB::raw("SUM(Nrocopiasprestamo)	as prestado"))
        ->join('prestamo','prestamo.prestamoID','=','prestamo_detalle.prestamoID')
        ->where('Estadohabprestamo','=','1')
        ->whereYear('Fecharegistroprestamo','=',$valoraño)
        ->groupBy(DB::raw("Nombrelibro"));




        return view('reportes.chartjs',compact('valores','nombres','años','valoraño','valores2','nombres2','libronombre'));
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
        return "hola";
    }

    public function all(Request $request)
    {
        return "hola";
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
