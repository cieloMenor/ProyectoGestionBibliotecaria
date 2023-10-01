<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const PAGINATION=10;
    public function index()
    {
        $roles= Rol::orderby('RolID')->paginate($this::PAGINATION);;
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count=Rol::all()->last()->RolID;
        $rol = new Rol();
        $rol->RolID= $count + 1;
        $rol->Descripcionrol=$request->Descripcionrol;
        if($request->Estadorol =="1"){
            $rol->Estadorol =1;
        }
        else{
            $rol->Estadorol =0;
        }
        date_default_timezone_set('America/Lima');		
        $fecha_actual = date("Y-m-d H:i:s"); 
        $rol->fechaRegistroRol=$fecha_actual;
        $rol->fechaUpdateRol=$fecha_actual;

        $rol->save();
        return redirect()->route('rol.index')->with('datos','Registro agregado ...!');


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
        $rol= Rol::find($id);
        return view('roles.edit',compact('rol'));
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
        $rol = Rol::find($id);
        $rol->Descripcionrol=$request->Descripcionrol;
        if($request->Estadorol =="1"){
            $rol->Estadorol =1;
        }
        else{
            $rol->Estadorol =0;
        }
        date_default_timezone_set('America/Lima');		
        $fecha_actual = date("Y-m-d H:i:s");
        $rol->fechaUpdateRol=$fecha_actual;

        $rol->save();

        return redirect()->route('rol.index')->with('datos','Registro actualizado ...!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rol = Rol::find($id);
        $rol->Estadorol = 0;
        $rol->save();
        return redirect()->route('rol.index')->with('datos','Registro Eliminado ...!');

    }
}
