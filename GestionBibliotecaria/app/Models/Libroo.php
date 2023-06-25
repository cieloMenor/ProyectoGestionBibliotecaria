<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Libroo extends Model
{
    use HasFactory;
    protected $table='libross';
    protected $primaryKey='idlibro';
    protected $fillable=['nombrelibro','nrocopiaslibro','stocklibro','idautor','idestadolibro','estadoHablibro',
    'fecharegistroLibro','fechaupdateLibro'];
    public $timestamps=false;

    public static function ActualizarStocklibro($idlibro,$nrocopiasprestamo){
        return DB::select(
        DB::raw("UPDATE libross set stocklibro = stocklibro - '".$nrocopiasprestamo."' where idlibro='".$idlibro."'")
        );
    }
}
