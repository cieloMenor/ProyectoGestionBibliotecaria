<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPrestamo extends Model
{
    use HasFactory;
    protected $table='Tipo_prestamo';
    protected $primaryKey='Tipo_prestamoID';
    protected $fillable=['Tipoprestamo','estadotipoprestamo','fechatipoprestamo','updateipoprestamo','UsuarioID','observacionestipoprestamo'];
    public $timestamps=false;

    public function prestamos()
    { 
    return $this->hasMany('App\Prestamo','Tipo_prestamoID','Tipo_prestamoID');
    
    }
    public function users()
    {
        return $this->hasOne(User::class,'UsuarioID','UsuarioID');
    }

}
