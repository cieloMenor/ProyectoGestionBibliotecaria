<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function index(){
        return view ('pr.index');
    }

    public function checkout($id){
        \Stripe\Stripe::setApiKey(config(key:'stripe.sk'));
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
            'success_url' => route('success'),
            'cancel_url'  => route('index'),
        ]);

        return redirect()->away($session->url);
    }

    public function success(){
        return view ('pr.index');
    }
}
