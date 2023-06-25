<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePrestamo extends Model
{
    use HasFactory;
    protected $table = 'detalleprestamos'; 
    public $timestamps = false;
    protected $fillable = [
    'nrocopiasprestamo', 'nombrelibro','idestadodetalleprestamo',
    ]; 
    
    public function prestamos()
    {
        return $this->hasOne(Prestamo::class,'idprestamo','idprestamo');
    }
    public function libros()
    { 
        return $this->hasMany('App\Libro','idlibro','idlibro'); 
    }
}
