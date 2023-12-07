<?php

namespace App\Http\Controllers;

use App\Models\ComprobanteTienda;
use Barryvdh\DomPDF\PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ComprobanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comprobantes = ComprobanteTienda::all();
        return view('comprobantes.index',compact('comprobantes'));
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comprobante = ComprobanteTienda::find($id);
        $imprimir=true;
        $datosComprobante = [
             'cliente' => $comprobante->clientes->Usuario,
             'monto' => '100.00',  // Monto del comprobante
             // Otros datos relevantes...
         ];
         
        // Generar el código QR con los datos del comprobante
        $codigoQR = QrCode::size(200)->generate(json_encode($comprobante));
        //dd($codigoQR);
        return view('pr.comprobante',compact('comprobante','imprimir','codigoQR'));
    }

    // public function downloadPDF($id)
    // {
    //     $comprobante = ComprobanteTienda::find($id);
    //     $imprimir = true;
    //     $datosComprobante = [
    //         'cliente' => $comprobante->clientes->Usuario,
    //         'monto' => $comprobante->monto,  // Monto del comprobante
    //         // Otros datos relevantes...
    //     ];

    //     // Generar el código QR con los datos del comprobante
    //     $codigoQR = QrCode::size(200)->generate(json_encode($datosComprobante));

    //     // Crear el PDF
    //     // $pdf = App::make('dompdf.wrapper');
    //     // $pdf = $pdf->loadView('pr.comprobante', compact('comprobante', 'imprimir', 'codigoQR'));
    //     // // Descargar el PDF
    //     // return $pdf->download('comprobante.pdf');
    //     //simplicada:
    //     // $pdf = App::make('dompdf.wrapper');
        
    //     // return $pdf->loadView('pr.comprobante', compact('comprobante', 'imprimir', 'codigoQR'))
    //     //         ->download('comprobante.pdf');}

    //     $pdf = App::make('dompdf.wrapper');
    //     $pdf->loadHTML(view('pr.comprobante', compact('comprobante', 'imprimir', 'codigoQR')));
    //     return $pdf->download('comprobante.pdf');
    // }
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
