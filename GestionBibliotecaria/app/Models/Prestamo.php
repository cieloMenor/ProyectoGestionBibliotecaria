<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;
    protected $table='prestamo';
    protected $primaryKey='PrestamoID';
    protected $fillable=['Fecharegistroprestamo','Fechaupdateprestamo',
    'Fechadevolucionesperadap','Horadevolucionesperadap','LectorID','Fechaentregaprestamo',
    'Observacionesprestamo','Tipo_prestamoID','Estado_prestamoID','Estadohabprestamo'];
    public $timestamps=false;

    public function detalleprestamos()
    { 
        return $this->hasMany('App\DetallePrestamo','PrestamoID','PrestamoID'); 
    }

    public function lectores()
    {
        return $this->hasOne(Lector::class,'LectorID','LectorID');
    }
    public function tipo()
    {
        return $this->hasOne(TipoPrestamo::class,'Tipo_prestamoID','Tipo_prestamoID');
    }
    public function estadoprestamos()
    {
        return $this->hasOne(EstadoPrestamo::class,'Estado_prestamoID','Estado_prestamoID');
    }
}
