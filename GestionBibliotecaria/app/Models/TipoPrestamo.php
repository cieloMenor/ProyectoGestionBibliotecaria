<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPrestamo extends Model
{
    use HasFactory;
    protected $table='Tipo_prestamo';
    protected $primaryKey='Tipo_prestamoID';
    protected $fillable=['Tipoprestamo'];
    public $timestamps=false;

    public function prestamos()
    { 
    return $this->hasMany('App\Prestamo','Tipo_prestamoID','Tipo_prestamoID');
    
    }
}
