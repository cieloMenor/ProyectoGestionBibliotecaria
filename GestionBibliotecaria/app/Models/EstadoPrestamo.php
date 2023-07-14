<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoPrestamo extends Model
{
    use HasFactory;
    protected $table='estado_prestamo';
    protected $primaryKey='Estado_prestamoID';
    protected $fillable=['Estadoprestamo'];
    public $timestamps=false;

    public function prestamos()
    { 
    return $this->hasMany('App\Prestamo','Estado_prestamoID','Estado_prestamoID');
    
    }

}
