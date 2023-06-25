<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoPrestamo extends Model
{
    use HasFactory;
    protected $table='estadoprestamos';
    protected $primaryKey='idestadoprestamo';
    protected $fillable=['estadoprestamo'];
    public $timestamps=false;

    public function prestamos()
    { 
    return $this->hasMany('App\Prestamo','idestadoprestamo','idestadoprestamo');
    
    }

}
