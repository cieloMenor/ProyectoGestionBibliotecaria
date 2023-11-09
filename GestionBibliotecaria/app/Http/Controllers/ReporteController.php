<?php

namespace App\Http\Controllers;

use App\Models\DetallePrestamo;
use App\Models\Libro;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Date;
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
        

        //grafico tres ejes
        $datos = DB::select('select l.Titulo as libro, sum(pd.Nrocopiasprestamo) as cantidad, Month(P.Fecharegistroprestamo) as Mes from prestamo p inner join prestamo_detalle pd on pd.prestamoID = p.prestamoID inner join libro l on l.libroID = pd.libroID where p.Estadohabprestamo group by l.Titulo,Month(p.Fecharegistroprestamo) order by Month(p.Fecharegistroprestamo)');
        $chartData = [];
        $labels = [];
        $datasets = [];
    
        foreach ($datos as $entry) {
            $producto = $entry->libro;
            $fecha = $entry->Mes;
            $cantidad = $entry->cantidad;
    
            if (!in_array($fecha, $labels)) {
                $labels[] = $fecha;
            }
    
            if (!array_key_exists($producto, $datasets)) {
                $datasets[$producto] = [
                    'label' => $producto,
                    'backgroundColor' => 'rgba(60,141,188,0.9)',
                    'borderColor' => 'rgba(60,141,188,0.8)',
                    'pointRadius' => false,
                    'pointColor' => '#3b8bba',
                    'pointStrokeColor' => 'rgba(60,141,188,1)',
                    'pointHighlightFill' => '#fff',
                    'pointHighlightStroke' => 'rgba(60,141,188,1)',
                    'data' => [],
                ];
            }
    
            $datasets[$producto]['data'][] = $cantidad;
        }
    
        $chartData['labels'] = $labels;
        $chartData['datasets'] = array_values($datasets);





        //otro grafico
        $valores3 = array();
        $nombres3 = array();

        $prestamos= DB::select('select e.Estadoprestamo as estado, count(p.prestamoID) as prestamos from prestamo p inner join estado_prestamo e on e.Estado_prestamoID=p.Estado_prestamoID where p.Estadohabprestamo=1 group by e.Estadoprestamo');

        // $estados= Prestamo::select(DB::raw("Estadoprestamo as estado"))
        // ->join('estado_prestamo','estado_prestamo.Estado_prestamoID','=','prestamo.Estado_prestamoID')
        // ->where('Estadohabprestamo','=','1')
        // ->whereYear('Fecharegistroprestamo','=',$valoraño)
        // ->groupBy(DB::raw("Estadoprestamo"));

        // $prestados= Prestamo::select(DB::raw("count(prestamoID) as prestados"))
        // ->join('estado_prestamo','estado_prestamo.Estado_prestamoID','=','prestamo.Estado_prestamoID')
        // ->where('Estadohabprestamo','=','1')
        // ->whereYear('Fecharegistroprestamo','=',$valoraño)
        // ->groupBy(DB::raw("Estadoprestamo"));

        foreach ($prestamos as $row) {
            
            $nombres3[] = $row->estado;
            $valores3[] = $row->prestamos;
    
         }


        return view('reportes.chartjs',compact('valores','nombres','años','valoraño','valores2','nombres2','libronombre','datos','valores3','nombres3'),['chartData' => json_encode($chartData)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $fechaInicio = $request->fechaInicio;
        $fechaFin = $request->fechaFin;
        $date = new Date();
        $fecha=date_format(now(), 'Y-m-d');

        if ($request->fechaInicio == "") {
            $fechaInicio = '2023-10-01';
        }
        else{
        $fechaInicio = $request->fechaInicio;
        }

        if ($request->fechaFin == "") {
            $fechaFin = $fecha;
        }
        else{
        $fechaFin = $request->fechaFin;
        }

        $prestamos= Prestamo::where('Estadohabprestamo','=','1')
        ->join('lector','lector.LectorID','=','prestamo.LectorID')
        ->join('estado_prestamo','estado_prestamo.Estado_prestamoID','prestamo.Estado_prestamoID')
        ->whereBetween('Fecharegistroprestamo', [$fechaInicio, $fechaFin])
        ->orderby('PrestamoID')
        ->get();


        return view('reportes.report',compact('prestamos','fechaInicio','fechaFin'));
    }

    public function pdf($id,Request $request)
    {
        //$fechaInicio = $request->fechaInicio;
        $fechaInicio = substr($id, 0, 10);
        //$fechaFin = $request->fechaFin;
        $fechaFin = substr($id, 10, 10);

        $prestamos= Prestamo::where('Estadohabprestamo','=','1')
        ->join('lector','lector.LectorID','=','prestamo.LectorID')
        ->join('estado_prestamo','estado_prestamo.Estado_prestamoID','prestamo.Estado_prestamoID')
        ->whereBetween('Fecharegistroprestamo', [$fechaInicio, $fechaFin])
        ->orderby('PrestamoID')
        ->get();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML(view('reportes.pdf', compact('prestamos')));
        //return $pdf->download('lista_perritos.pdf');
        return $pdf->stream('report.pdf');
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
