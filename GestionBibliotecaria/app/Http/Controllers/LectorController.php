<?php

namespace App\Http\Controllers;

use App\Models\Lector;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LectorController extends Controller
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

        
        $lectores = Lector::where('Estadoeliminadolector','=',1)
        ->join('estado_lector','estado_lector.Estado_lectorID','lector.Estado_lectorID')
        ->where('lector.Apellidoslector','like','%'.$buscarpor.'%')->orderby('LectorID')->paginate($this::PAGINATION);
        
        //$edades=[];
        //$x =0;
        // foreach ($lectores as $item) {
        //     $edad=Carbon::parse($item->FechaNacLector)->age;
        //     dump($edad);

        //     //$lectores[$x]->edad=$edad;
        //    $edades +=[$edad];
            
        //     // $edades[$x]->edad=$edad;
        //     // $x++;
        // }
         

        return view('lectores.index',compact('lectores','buscarpor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lectores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=request()->validate([
            'DNILector' => 'required|numeric',
            'NombresLector' =>'required',
            'ApellidosLector' =>'required',
            'CorreoLector' =>'required|email|max:255',
            'FechaNacLector' => 'required',
            'CelularLector' => 'required|numeric',
            'DireccionLector' => 'required',
        ],
        [
            'DNILector.required'=>'Registre DNI de lector',
            'DNILector.numeric'=>'Registre solo valores numericos',
            'NombresLector' =>'Registro Nombres del lector',
            'ApellidosLector' =>'Registro Apellidos del lector',
            'CorreoLector.required'=>'Registre correo',
            'CorreoLector.email'=>'Registre correo electrónico válido',
            'CorreoLector.max'=>'Máximo 255 caracteres para el correo',
            'FechaNacLector.required'=>'Registre fecha de nacimiento',
            'horaregistrotramite.required'=>'Registre hora de registro',
            'CelularLector.required'=>'Registre celular',
            'CelularLector.numeric'=>'Registre solo valores numericos',
            'DireccionLector.required'=>'Registre dirección de lector',
            
        ]);

        $dni=$request->get('DNILector'); //se almacenara el valor de name ingresado
        $query=Lector::where('DNILector','=',$dni)->get();// comparación de name y se almacena en $query
        if($query->count()!=0) //si lo encuentra, osea si no esta vacia, entonces analizara el password ahora
        {
            
            return back()->withErrors(['DNILector'=> 'Lector ya registrado'])
            ->withInput(request(['DNILector','NombresLector','ApellidosLector','CorreoLector','FechaNacLector','CelularLector',
            'DireccionLector']));                   
        }
        else{ // si no lo encuentra con el name

            $lector = new Lector();
            $lector->DNILector = $request->DNILector;
            $lector->NombresLector = $request->NombresLector;
            $lector->ApellidosLector = $request->ApellidosLector;
            $lector->idestadolector = 1;
            $lector->CorreoLector = $request->CorreoLector;
            $lector->FechaNacLector = $request->FechaNacLector;
            $lector->FecharegistroLector = now();
            $lector->FechaUpdateLector = now();
            $lector->CelularLector = $request->CelularLector;
            $lector->DireccionLector = $request->DireccionLector;
            $lector->EstadoHabLector = 1;
            $lector->EstadoEliminadoLector = 1;

            $lector->save();

            return redirect()->route('lector.index')->with('datos','Registro Exitoso ...!');

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
    public function edit($DNILector)
    {
        $lector = Lector::find($DNILector);
        return view('lectores.edit',compact('lector'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $DNILector)
    {
        $data=request()->validate([
            'NombresLector' =>'required',
            'ApellidosLector' =>'required',
            'CorreoLector' =>'required|email|max:255',
            'FechaNacLector' => 'required',
            'CelularLector' => 'required|numeric',
            'DireccionLector' => 'required',
        ],
        [
            'NombresLector' =>'Registro Nombres del lector',
            'ApellidosLector' =>'Registro Apellidos del lector',
            'CorreoLector.required'=>'Registre correo',
            'CorreoLector.email'=>'Registre correo electrónico válido',
            'CorreoLector.max'=>'Máximo 255 caracteres para el correo',
            'FechaNacLector.required'=>'Registre fecha de nacimiento',
            'horaregistrotramite.required'=>'Registre hora de registro',
            'CelularLector.required'=>'Registre celular',
            'CelularLector.numeric'=>'Registre solo valores numericos',
            'DireccionLector.required'=>'Registre dirección de lector',
            
        ]);
            
            $lector = Lector::find($DNILector);
            $lector->NombresLector = $request->NombresLector;
            $lector->ApellidosLector = $request->ApellidosLector;
            $lector->CorreoLector = $request->CorreoLector;
            $lector->FechaNacLector = $request->FechaNacLector;
            $lector->FechaUpdateLector = now();
            $lector->CelularLector = $request->CelularLector;
            $lector->DireccionLector = $request->DireccionLector;
            $lector->EstadoHabLector = $request->EstadoHabLector;

            $lector->save();

            return redirect()->route('lector.index')->with('datos','Registro Actualizado ...!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($DNILector)
    {
        $lector = Lector::find($DNILector);
        $lector->EstadoEliminadoLector = '0';
        $lector->EstadoHabLector = '0';
        $lector->save();
        return redirect()->route('lector.index')->with('datos','Registro Eliminado ...!');

    }
}
