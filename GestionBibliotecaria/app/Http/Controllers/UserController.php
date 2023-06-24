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
            'name'=>'required',
            'password'=>'required'
        ],
        [
            'name.required'=>'Ingrese Usuario',
            'password.required'=>'Ingresa Contraseña'
        ]);
        if(Auth::attempt($data)) {
            $con='ok';
        }
        $name=$request->get('name');
        $query=User::where('name', '=', $name)->get();
        
        if($query->count()!=0) {
            $hashp=$query[0]->password;
            $password=$request->get('password');
            if(password_verify($password, $hashp)) {
                return redirect()->route('home',compact('name'));
            } else {
                return back()->withErrors(['password'=>'Contraseña no valida'])
                ->withInput(request(['name', 'password']));
            }
        } else {
            return back()->withErrors(['name'=>'Usuario no valido'])
            ->withInput(request(['name']));
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
            'name'=>'required',
            'password'=>'required'
        ],
        [
            'name.required'=>'Ingrese Usuario',
            'password.required'=>'Ingresa Contraseña'
        ]);
        
        $name=$request->get('name'); //se almacenara el valor de name ingresado
        $query=User::where('name','=',$name)->get();// comparación de name y se almacena en $query
        if($query->count()!=0) //si lo encuentra, osea si no esta vacia, entonces analizara el password ahora
        {
            
            return back()->withErrors(['password'=> 'Usuario ya registrado'])
            ->withInput(request(['name','password']));                   
        }
        else{ // si no lo encuentra con el name

            $usuario = new User();
            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $usuario->password = Hash::make($request->password) ;
            $usuario->token= Str::random(10);
            $usuario->created_at = Date('y-m-d');
            $usuario->updated_at = Date('y-m-d');
            $usuario->save();

            return view('home');
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
