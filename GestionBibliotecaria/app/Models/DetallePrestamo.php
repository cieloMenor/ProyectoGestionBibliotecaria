<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePrestamo extends Model
{
    use HasFactory;
    protected $table = 'prestamo_detalle'; 
    protected $primaryKey='Prestamo_detalleID';
    public $timestamps = false;
    protected $fillable = ['Estado_detalle_prestamoID','LibrooID',
    'Nrocopiasprestamo', 'Nombrelibro','Estadohabdetalleprestamo',
    'PrestamoID'
    ]; 
    
    public function libros()
    {
        return $this->hasOne(Libroo::class,'LibrooID','LibrooID');
    }
    public function prestamos()
    {
        return $this->hasOne(Prestamo::class,'PrestamoID','PrestamoID');
    }
    public function estadodetalleprestamos()
    {
        return $this->hasOne(EstadoDetallePrestamo::class,'Estado_detalle_prestamoID','Estado_detalle_prestamoID');
    }
}
