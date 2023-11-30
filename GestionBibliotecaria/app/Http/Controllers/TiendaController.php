<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function index(){
        $libross=Libro::all();

        return view('pr.tienda',compact('libross'));
    }

    public function verificar($id){
        $libro=Libro::find($id);
        return view('pr.libro',compact('libro'));
    }
}

