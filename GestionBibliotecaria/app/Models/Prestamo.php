<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;
    protected $primaryKey='idprestamo';
    protected $fillable=['fecharegistroPrestamo','fechaupdatePrestamo','fechaDevolucionEsperadaP','horaDevolucionEsperadaP','DNILector',
    'observacionesPrestamo','idtipoprestamo','idestadoprestamo','estadoHabprestamo'];
    public $timestamps=false;

    public function detalleprestamos()
    { 
        return $this->hasMany('App\DetallePrestamo','idprestamo','idprestamo'); 
    }

    public function lectores()
    {
        return $this->hasOne(Lector::class,'DNILector','DNILector');
    }
    public function tipo()
    {
        return $this->hasOne(TipoPrestamo::class,'idtipoprestamo','idtipoprestamo');
    }
    public function estadoprestamos()
    {
        return $this->hasOne(EstadoPrestamo::class,'idestadoprestamo','idestadoprestamo');
    }
}
