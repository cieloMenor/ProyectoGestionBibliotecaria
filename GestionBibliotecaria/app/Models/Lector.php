<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lector extends Model
{
    use HasFactory;
    protected $table='lector';
    protected $primaryKey='LectorID';
    protected $fillable=['Apellidoslector','Nombreslector','Celularlector','Direccionlector',
    'Correolector','Dni_lector','Estadoeliminadolector','Estadohablector','Fechanaclector',
    'Fecharegistrolector','Fechaupdatelector','Estado_lectorID','BibliotecarioID','UsuarioID'];
    public $timestamps=false;

    public function prestamos()
    { 
    return $this->hasMany('App\Prestamo','LectorID','LectorID');
    
    }
    public function estadoLectores()
    {
        return $this->hasOne(EstadoLector::class,'Estado_lectorID','Estado_lectorID');
    }

    public function bibliotecarios()
    {
        return $this->hasOne(Bibliotecario::class,'BibliotecarioID','BibliotecarioID');
    }
    public function usuarios()
    {
        return $this->hasOne(User::class,'UsuarioID','UsuarioID');
    }

    public static function ActualizarLectorADeudor($LectorID){
        return DB::select(
        DB::raw("UPDATE lector set Estado_lectorID = '2' where LectorID='".$LectorID."'")
        );
    }
    public static function ActualizarLectorASinLibro($LectorID){
        return DB::select(
        DB::raw("UPDATE lector set Estado_lectorID = '1' where LectorID='".$LectorID."'")
        );
    }
    public static function ActualizarLectorAMoroso($LectorID){
        return DB::select(
        DB::raw("UPDATE lector set Estado_lectorID = '3' where LectorID='".$LectorID."'")
        );
    }
}
