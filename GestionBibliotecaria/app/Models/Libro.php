<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Libro extends Model
{
    use HasFactory;
    protected $table='Libro';
    protected $primaryKey='LibroId';
    public $timestamps=false;
    protected $fillable=['Titulo','Stocklibro','Precio','Paginas','Isbn','Idioma','Editorial','Añopublicacion','Estado_libroID'];
   
   
    public static function ActualizarStocklibro($LibroID,$Nrocopiaslibro){
        return DB::select(
        DB::raw("UPDATE libro set Stocklibro = Stocklibro - '".$Nrocopiaslibro."' where LibroID='".$LibroID."'")
        );
    }
    public static function AumentarStocklibro($LibroID,$Nrocopiaslibro){
        return DB::select(
        DB::raw("UPDATE libro set Stocklibro = Stocklibro + '".$Nrocopiaslibro."' where LibroID='".$LibroID."'")
        );
    }
    public function estadoLibros()
    {
        return $this->hasOne(EstadoLibro::class,'Estado_libroID','Estado_libroID');
    }

}
