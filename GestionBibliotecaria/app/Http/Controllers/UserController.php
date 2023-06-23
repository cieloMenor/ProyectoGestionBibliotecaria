<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        //
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
