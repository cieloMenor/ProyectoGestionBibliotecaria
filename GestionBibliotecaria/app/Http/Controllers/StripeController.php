<?php

namespace App\Http\Controllers;

use App\Models\ComprobanteTienda;
use App\Models\Libro;
use App\Models\User;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function index(){
        return view('pr.index');
    }

    public function checkout($id){
        \Stripe\Stripe::setApiKey('sk_test_51OIHaJAnvQUQMhsMnWwMCu8FyrkPxINucTWwiudQGCL4ufvrl1CNH2BDw5Ayz270Tp1ojbaAMkixPatSjGu7c0GC00SWf1W5Fv');
        
        $libro=Libro::find($id);
        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'pen',
                        'product_data' => [
                            'name' => $libro->Titulo
                            
                        ],
                        'unit_amount'  =>(int)($libro->Precio)*100,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('success',compact('id')),
            'cancel_url'  => route('verificar',compact('id')),
        ]);
        return redirect()->away($session->url);
    }

     public function success($id){
        $libro = Libro::find($id);
        $user = auth()->user();
        Libro::ActualizarStocklibro($id,1);
        $comprobante = new ComprobanteTienda();
        $comprobante->idcliente=$user->UsuarioID;
        $comprobante->monto = $libro->Precio;
        $comprobante->libroID = $id;
        
        date_default_timezone_set('America/Lima');		
        $fecha_actual = date("Y-m-d H:i:s"); 
        $comprobante->fecha = $fecha_actual;
        
        $comprobante->save();

        $idcomprobante= $comprobante->idcomprobante;
       

        return view('pr.index',compact('libro','idcomprobante'));
    }
    // public function success($sessionId) {
    //     // Obtén detalles de la sesión usando el ID proporcionado
    //     \Stripe\Stripe::setApiKey('tu_clave_secreta_de_stripe');
    //     $session = \Stripe\Checkout\Session::retrieve($sessionId);
    
    //     // Puedes acceder a la información de la sesión a través de $session->algo
    
    //     // Por ejemplo, si deseas los pagos realizados
    //     $pagos = $session->payment_intent;
    
    //     // También puedes pasar estos datos a la vista si es necesario
    //     return view('pr.index', compact('session', 'pagos'));
    // }
}
