<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoDetallePrestamo extends Model
{
    use HasFactory;
    protected $table='estado_detalle_prestamo';
    protected $primaryKey='Estado_detalle_prestamoID';
    protected $fillable=['Estado_detalle_prestamo'];
    public $timestamps=false;
}
