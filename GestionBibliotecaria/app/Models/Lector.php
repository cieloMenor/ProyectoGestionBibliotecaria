<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lector extends Model
{
    use HasFactory;
    protected $table='lectores';
    protected $primaryKey='DNIlector';
    protected $fillable=['NombresLector','ApellidosLector','idestadolector','CorreoLector','FechaNacLector',
    'FecharegistroLector','FechaUpdateLector','CelularLector',
    'DireccionLector','EstadoHabLector'];
    public $timestamps=false;
}
