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
            $count = count(Lector::all());

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
    public function update(Request $request, $LectorID)
    {
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
            
            $lector = Lector::find($LectorID);

            $lector->Dni_lector = $request->Dni_lector;
            $lector->Nombreslector = $request->Nombreslector;
            $lector->Apellidoslector = $request->Apellidoslector;
            $lector->Correolector = $request->Correolector;
            $lector->Fechanaclector = $request->Fechanaclector;
            $lector->Fechaupdatelector = now();
            $lector->Celularlector = $request->Celularlector;
            $lector->Direccionlector = $request->Direccionlector;
            $lector->Estadohablector = $request->Estadohablector;

            $lector->save();

            return redirect()->route('lector.index')->with('datos','Registro Actualizado ...!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($LectorID)
    {
        $lector = Lector::find($LectorID);
        $lector->Estadoeliminadolector = '0';
        $lector->Estadohablector = '0';
        $lector->save();
        return redirect()->route('lector.index')->with('datos','Registro Eliminado ...!');

    }
}
