<?php

namespace App\Http\Controllers;

use App\Models\EstadoLibro;
use App\Models\Rol;
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
            if($query[0]->Estadousuario == 1)
            {
                $hashp=$query[0]->password;
                $password=$request->get('password');
                if(password_verify($password, $hashp)) {
                    return redirect()->route('home',compact('Usuario'));
                } else {
                    return back()->withErrors(['password'=>'Contraseña no valida'])
                    ->withInput(request(['Usuario', 'password']));
                }
            }
            else{
                return back()->withErrors(['Usuario'=>'Usuario deshabilitado'])
                    ->withInput(request(['Usuario','password']));
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

    const PAGINATION=10;
    public function index(Request $request)
    {
        $buscarpor=$request->get('buscarpor');

        $usuarios=User::where('users.Apellidosusuario','like','%'.$buscarpor.'%')
        ->orderby('UsuarioID')->paginate($this::PAGINATION);

        return view('users.index', compact('usuarios','buscarpor'));
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
    public function create2()
    {
        $roles= Rol::where('EstadoRol','=',1)->get();
        return view('users.create2', compact('roles'));
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
            $count=User::all()->last()->UsuarioID;
            $usuario = new User();
            $usuario->UsuarioID= $count + 1;
            $usuario->Apellidosusuario = $request->Apellidosusuario;
            $usuario->Nombresusuario = $request->Nombresusuario;
            $usuario->Celularusuario = $request->Celularusuario;
            $usuario->Estadousuario = 1;
            $usuario->Correousuario = $request->Correousuario;
            $usuario->Usuario = $request->Usuario;
            $usuario->password = Hash::make($request->password) ;
            $usuario->token= Str::random(10);
            $usuario->RolID = $request->RolID;
            $usuario->save();


            return redirect()->route('login');
            // if($request->valor == 1)
            // {
            //     Auth::logout();
            //     return redirect()->route('login');
            // }
            // else{
            //     return redirect()->route('usuario.index')->with('datos','Registro agregado ...!');

            // }
            
        }
        }
    }

    public function store2(Request $request)
    {
        $data=request()->validate([
            'Usuario'=>'required',
            'password'=>'required',
            'Correousuario'=>'required',
            'Nombresusuario'=>'required',
            'Apellidosusuario'=>'required',
            'Celularusuario'=>'required',
            // 'imagenusuario' => 'required'

        ],
        [
            'Usuario.required'=>'Ingrese Usuario',
            'Correousuario.required'=>'Ingrese Correo',
            'Nombresusuario.required'=>'Ingrese nombres',
            'Apellidosusuario.required'=>'Ingrese apellidos',
            'Celularusuario.required'=>'Ingrese celular',
            'password.required'=>'Ingresa Contraseña'
            // 'imagenusuario.required' =>'Suba la foto del usuario',
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
            $count=User::all()->last()->UsuarioID;
            $usuario = new User();
            $usuario->UsuarioID= $count + 1;
            $usuario->Apellidosusuario = $request->Apellidosusuario;
            $usuario->Nombresusuario = $request->Nombresusuario;
            $usuario->Celularusuario = $request->Celularusuario;
            $usuario->Estadousuario = 1;
            $usuario->Correousuario = $request->Correousuario;
            $usuario->Usuario = $request->Usuario;
            $usuario->password = Hash::make($request->password) ;
            $usuario->token= Str::random(10);
            $usuario->RolID = $request->RolID;

            // if($request->hasFile('imagenusuario')){
            //     $imagenusuario = $request->file('imagenusuario');
            //     $destination = 'img/usuarios/';
            //     $filename = time().'-'.$imagenusuario->getClientOriginalName();
            //     $mover = $request->file('imagenusuario')->move($destination,$filename);
            //     $usuario->imagenusuario = $destination . $filename;
            // }
            $usuario->save();
            
            
           return redirect()->route('usuario.index')->with('datos','Registro agregado ...!');

            
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
        $usuario = User::find($id);
        $usuario->Estadousuario = 1;
        $usuario->save();
        return redirect()->route('usuario.index')->with('datos','Registro Habilitado ...!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        $roles = Rol::all();
        return view('users.edit',compact('usuario','roles'));
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
        return redirect()->route('usuario.index')->with('datos','Registro Actualizado ...!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->Estadousuario = 0;
        $usuario->save();
        return redirect()->route('usuario.index')->with('datos','Registro Eliminado ...!');

    }
}
