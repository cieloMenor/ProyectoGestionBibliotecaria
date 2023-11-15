<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DetallePrestamo extends Model
{
    use HasFactory;
    protected $table = 'prestamo_detalle'; 
    protected $primaryKey='Prestamo_detalleID';
    public $timestamps = false;
    protected $fillable = ['Estado_detalle_prestamoID','LibroID',
    'Nrocopiasprestamo', 'Nombrelibro','StockLibroP','Estadohabdetalleprestamo',
    'PrestamoID','NroLibrosFaltaDevo'
    ]; 
    
    public function libros()
    {
        return $this->hasOne(Libro::class,'LibroID','LibroID');
    }
    public function prestamos()
    {
        return $this->hasOne(Prestamo::class,'PrestamoID','PrestamoID');
    }
    public function estadodetalleprestamos()
    {
        return $this->hasOne(EstadoDetallePrestamo::class,'Estado_detalle_prestamoID','Estado_detalle_prestamoID');
    }

    public static function DetalleAPendiente($Prestamo_detalleID){
        return DB::select(
        DB::raw("UPDATE prestamo_detalle set Estado_detalle_prestamoID ='2' where Prestamo_detalleID='".$Prestamo_detalleID."'")
        );
    }

    public static function DetalleADevuelto($Prestamo_detalleID){
        return DB::select(
        DB::raw("UPDATE prestamo_detalle set Estado_detalle_prestamoID ='3' where Prestamo_detalleID='".$Prestamo_detalleID."'")
        );
    }

    public static function DisminuirNroLibrosFaltaDevo($Prestamo_detalleID,$Nrocopiaslibro){
        return DB::select(
        DB::raw("UPDATE prestamo_detalle set NroLibrosFaltaDevo = NroLibrosFaltaDevo - '".$Nrocopiaslibro."' where Prestamo_detalleID='".$Prestamo_detalleID."'")
        );
    }
}
