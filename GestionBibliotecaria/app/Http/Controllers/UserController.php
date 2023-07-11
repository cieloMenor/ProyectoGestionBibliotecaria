<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showlogin()
    {
        return view('login');
    }

    public function inicio()
    {
        return view('home');
    }

    public function verificarlogin(Request $request){
        $data=request()->validate([
            'Usuario'=>'required',
            'password'=>'required'
        ],
        [
            'Usuario.required'=>'Ingrese Usuario',
            'password.required'=>'Ingresa Contraseña'
        ]);
        if(Auth::attempt($data)) {
            $con='ok';
        }
        $Usuario=$request->get('Usuario');
        $query=User::where('Usuario', '=', $Usuario)->get();
        
        if($query->count()!=0) {
            $hashp=$query[0]->password;
            $password=$request->get('password');
            if(password_verify($password, $hashp)) {
                return redirect()->route('home',compact('Usuario'));
            } else {
                return back()->withErrors(['password'=>'Contraseña no valida'])
                ->withInput(request(['Usuario', 'password']));
            }
        } else {
            return back()->withErrors(['Usuario'=>'Usuario no valido'])
            ->withInput(request(['Usuario','password']));
        }
    }
    public function salir()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'Usuario'=>'required',
            'password'=>'required',
            'Correousuario'=>'required',
            'Nombresusuario'=>'required',
            'Apellidosusuario'=>'required',
            'Celularusuario'=>'required'

        ],
        [
            'Usuario.required'=>'Ingrese Usuario',
            'Correousuario.required'=>'Ingrese Correo',
            'Nombresusuario.required'=>'Ingrese nombres',
            'Apellidosusuario.required'=>'Ingrese apellidos',
            'Celularusuario.required'=>'Ingrese celular',
            'password.required'=>'Ingresa Contraseña'
        ]);
        
        $Usuario=$request->get('Usuario'); //se almacenara el valor de name ingresado
        $query=User::where('Usuario','=',$Usuario)->get();// comparación de name y se almacena en $query
        $query2=User::where('Correousuario','=',$request->get('Correousuario'))->get();
        if($query->count()!=0) //si lo encuentra, osea si no esta vacia, entonces analizara el password ahora
        {
            
            return back()->withErrors(['Usuario'=> 'Usuario ya registrado'])
            ->withInput(request(['Usuario','password','Correousuario','Nombresusuario','Apellidosusuario','Celularusuario']));                   
        }
        else{ // si no lo encuentra con el name
            if($query2->count()!=0) //si lo encuentra, osea si no esta vacia, entonces analizara el password ahora
        {
            
            return back()->withErrors(['Correousuario'=> 'Correo ya registrado'])
            ->withInput(request(['Usuario','password','Correousuario','Nombresusuario','Apellidosusuario','Celularusuario']));                   
        }
        else{
            $count = count(User::all());
            $usuario = new User();
            $usuario->UsuarioID= $count + 1;
            $usuario->Apellidosusuario = $request->Apellidosusuario;
            $usuario->Nombresusuario = $request->Nombresusuario;
            $usuario->Celularusuario = $request->Celularusuario;
            $usuario->Estadousuario = 1;
            $usuario->Usuario = $request->Usuario;
            $usuario->password = Hash::make($request->password) ;
            $usuario->token= Str::random(10);
            $usuario->RolID = 2;
            $usuario->save();

            return view('login');
        }
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
