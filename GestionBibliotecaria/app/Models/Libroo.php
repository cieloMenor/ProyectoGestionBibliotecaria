<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Libroo extends Model
{
    use HasFactory;
    protected $table='libro';
    protected $primaryKey='LibroID';
    protected $fillable=['Titulo','Nrocopiaslibro','Stocklibro','Edicionlibro',
    'Estado_libroID','Estadohablibro',
    'Añopublicacion','Editorial','Idioma','Isbn','Paginas','Precio',
    'Fecharegistrolibro','Fechaupdatelibro'];
    public $timestamps=false;
    
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
