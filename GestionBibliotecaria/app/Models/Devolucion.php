<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Devolucion extends Model
{
    use HasFactory;
    protected $table='devolucion';
    protected $primaryKey='DevolucionID';
    protected $fillable=['Conmulta','PrestamoID','Dev_observaciones','Estadohabdevolución',
    'Fechainiciodevolucion','Fecharegistrodevolucion'];

    public $timestamps=false;

    public function prestamos()
    {
        return $this->hasOne(Prestamo::class,'PrestamoID','PrestamoID');
    }

    public static function AgregarMulta($PrestamoID){
        return DB::select(
        DB::raw("UPDATE devolucion set Conmulta =1 where PrestamoID='".$PrestamoID."'")
        );
    }
}
