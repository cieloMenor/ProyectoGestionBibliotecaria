<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles= Rol::all();
        return view('perfil.index', compact('roles'));
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
        $data=request()->validate([
            'password'=>'required',
            'nuevopassword'=>'required',
            'reppassword'=>'required'

        ],
        [
            'password.required'=>'Ingresa actual Contraseña',
            'nuevopassword.required'=>'Ingresa nueva Contraseña',
            'reppassword.required'=>'Ingresa repetición de nueva Contraseña'
        ]);
        $Usuario=$request->get('Usuario'); //se almacenara el valor de name ingresado
        $query=User::where('Usuario','=',$Usuario)->get();
        $hashp=$query[0]->password;

        $usuario= User::find($query[0]->UsuarioID);
        $password=$request->get('password');
        if(password_verify($password, $hashp)) {
            $nuevopassword=$request->get('nuevopassword');
            $reppassword=$request->get('reppassword');
            if($nuevopassword == $reppassword) {
                $usuario->password = Hash::make($request->nuevopassword);
                $usuario->save();
                return redirect()->route('perfil.index')->with('datos','Contraseña actualizada con éxito ...!');
            }
            else{
                return back()->withErrors(['nuevopassword'=>'Las contraseñas no coinciden','reppassword'=>'Las contraseñas no coinciden'])
            ->withInput(request(['Usuario', 'password','nuevopassword','reppassword']));
            }
        } else {
            return back()->withErrors(['password'=>'Contraseña no valida'])
            ->withInput(request(['Usuario', 'password','nuevopassword','reppassword']));
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
        return view('perfil.cambiarcontraseña');
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
        $data=request()->validate([
            'Correousuario'=>'required',
            'Nombresusuario'=>'required',
            'Apellidosusuario'=>'required',
            'Celularusuario'=>'required',

        ],
        [
            'Correousuario.required'=>'Ingrese Correo',
            'Nombresusuario.required'=>'Ingrese nombres',
            'Apellidosusuario.required'=>'Ingrese apellidos',
            'Celularusuario.required'=>'Ingrese celular'
        ]);

        $usuario =  User::find($id);
        $usuario->Correousuario = $request->Correousuario;
        $usuario->Nombresusuario = $request->Nombresusuario;
        $usuario->Apellidosusuario = $request->Apellidosusuario;
        $usuario->Celularusuario = $request->Celularusuario;
        $usuario->RolID = $request->RolID;

        $usuario->save();
        return redirect()->route('perfil.index')->with('datos','Perfil actualizado ...!');

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
