<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function Proveedor(Request $request){
        return view('Abastecimiento.RegistroProveedor');
    }
}
