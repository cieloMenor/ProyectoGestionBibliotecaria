<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPrestamo extends Model
{
    use HasFactory;
    protected $table='tipoprestamos';
    protected $primaryKey='idtipoprestamo';
    protected $fillable=['tipoprestamo'];
    public $timestamps=false;

    public function prestamos()
    { 
    return $this->hasMany('App\Prestamo','idtipoprestamo','idtipoprestamo');
    
    }
}
