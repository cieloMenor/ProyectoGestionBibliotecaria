<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lector extends Model
{
    use HasFactory;
    protected $table='lector';
    protected $primaryKey='LectorID';
    protected $fillable=['Apellidoslector','Nombreslector','Celularlector','Direccionlector',
    'Correolector','Dni_lector','Estadoeliminadolector','Estadohablector','Fechanaclector',
    'Fecharegistrolector','Fechaupdatelector','Estado_lectorID'];
    public $timestamps=false;

    public function prestamos()
    { 
    return $this->hasMany('App\Prestamo','LectorID','LectorID');
    
    }
    public function estadoLectores()
    {
        return $this->hasOne(EstadoLibro::class,'Estado_lectorID','Estado_lectorID');
    }
}
