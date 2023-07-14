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
    protected $fillable=['Titulo','Nrocopiaslibro','Stocklibro','AutorID',
    'Estado_libroID','Estadohablibro',
    'Fecharegistrolibro','Fechaupdatelibro'];
    public $timestamps=false;

    public static function ActualizarStocklibro($LibrooID,$Nrocopiaslibro){
        return DB::select(
        DB::raw("UPDATE libroo set Stocklibro = Stocklibro - '".$Nrocopiaslibro."' where LibrooID='".$LibrooID."'")
        );
    }
    public function estadoLibros()
    {
        return $this->hasOne(EstadoLibro::class,'Estado_libroID','Estado_libroID');
    }
}
